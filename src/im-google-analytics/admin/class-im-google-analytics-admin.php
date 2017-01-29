<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/admin
 * @author     InMomentum <hello@inmomentum.io>
 */
class Im_Google_Analytics_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * All options available in the plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    All options available.
     */
    private $plugin_options;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since      1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        // Assign options and their default values
        $this->plugin_options = array(
            'tracking_id'        => 'UA-000000-01',
            'settings_status'    => 1,
        );
    }

    /**
     * Create admin menu.
     *
     * @since    1.0.0
     */
    public function create_admin_menu()
    {
        add_submenu_page('options-general.php', 'IM Google Analytics', 'IM Google Analytics', 'manage_options', 'im-google-analytics', array( $this, 'render_admin_page' ), 100);
    }

    /**
     * Render admin page.
     *
     * @since    1.0.0
     */
    public function render_admin_page()
    {
        include_once 'partials/im-google-analytics-admin-settings.php';
    }

    /**
     * Register settings.
     *
     * @since    1.0.0
     */
    public function register_settings()
    {
        register_setting('im_google_analytics_settings', 'im_google_analytics_options', array( $this, 'sanitize_options' ));

        $this->convert_legacy_settings();
        $this->set_default_settings();
    }

    /**
     * Assign default values for settings.
     *
     * @since    1.0.0
     */
    private function set_default_settings()
    {
        if (is_array(get_option('im_google_analytics_options'))) {
            $current_options = get_option('im_google_analytics_options');
            $plugins_options = $this->plugin_options;

            foreach ($this->plugin_options as $option => $value) {
                if (!isset($current_options[$option])) {
                    $current_options[$option] = $value;
                }
            }

            update_option('im_google_analytics_options', $current_options);
        } else {
            add_option('im_google_analytics_options', $this->plugin_options);
        }
    }

    /**
     * Convert legacy settings.
     *
     * @since    1.0.0
     */
    private function convert_legacy_settings()
    {
        // Silence is golden
    }

    /**
     * Method for sanitizing options.
     *
     * @since    1.0.0
     * @param    array    $options    The options.
     * @return   array                The sanitized options.
     */
    public function sanitize_options($options)
    {
        foreach ($options as $option => $value) {
            switch ($option) {

                case 'tracking_id':
                    $regex = '/^\p{L}{2}-\p{N}{1,}-\p{N}{1,}\K.*$/u';
                    $options['tracking_id'] = $this->sanitize_string($regex, $value, $option);
                    break;

                case 'settings_status':
                    $options['settings_status'] = $this->sanitize_boolean($value, $option);
                    break;

            }
        }

        return $options;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        $screen = get_current_screen();

        if ($screen->base == 'settings_page_im-google-analytics') {
            wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/im-google-analytics-admin.css', array(), $this->version, 'all');
        }
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        $screen = get_current_screen();

        if ($screen->base == 'settings_page_im-google-analytics') {
            wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/im-google-analytics-css-admin.js', array( 'jquery' ), $this->version, true);
        }
    }

    /**
     * Sanitize a string based option with regular expression.
     *
     * @since    1.0.0
     * @param    string    $regex    The regex used to sanitize the string.
     * @param    string    $input    The string.
     * @return   string              The sanitized string or the options default value.
     */
    private function sanitize_string($regex, $input, $option)
    {
        $input = preg_replace($regex, '', $input);

        if (! preg_match($regex, $input)) {
            $input = $this->plugin_options[$option];
            add_settings_error($option, $option, __('There seem to have been some kind of problem while saving your tracking ID. Please try again.', 'im-google-analytics'), 'error');
        }

        return $input;
    }

    /**
     * Sanitize a boolean option.
     *
     * @since    1.0.0
     * @param    boolean    $input    The boolean.
     * @return   boolean              The sanitized boolean or the options default value.
     */
    private function sanitize_boolean($input, $option)
    {
        if (! ($input == 0 || $input == 1)) {
            $input = $this->plugin_options[$option];
            add_settings_error($option, $option, __("There seem to have been some problem while saving the settings for the plugin. Please try again.", 'im-google-analytics'), 'error');
        }

        return $input;
    }
}

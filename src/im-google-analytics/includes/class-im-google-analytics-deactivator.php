<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://inmomentum.io/
 * @since      1.0.0
 *
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Im_Google_Analytics
 * @subpackage Im_Google_Analytics/includes
 * @author     InMomentum <hello@inmomentum.io>
 */
class Im_Google_Analytics_Deactivator
{

    /**
     * Runs during deactivation of plugin.
     *
     * Runs when deactivating plugin. It will clean up the registered settings and it's values.
     *
     * @since    1.0.0
     */
    public static function deactivate()
    {
        delete_option('im_google_analytics_options');
        unregister_setting('im_google_analytics_settings', 'im_google_analytics_options');
    }
}

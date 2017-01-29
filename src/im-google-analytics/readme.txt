=== Plugin Name ===
Contributors: inmomentum
Donate link: http://inmomentum.io/
Tags: google analytics, analytics
Requires at least: 3.0.1
Tested up to: 4.7.2
Stable tag: 1.0.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

An easy-to-use Google Analytics plugin for WordPress.

== Description ==

Do you need Google Analytics for your WordPress website?
IM Google Analytics is an easy-to-use Google Analytics plugin for WordPress.
Enter your Google Analytics tracking id and you're good to go!

== Installation ==

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't even need to leave your web browser. To do an automatic install, log in to your WordPress admin panel, navigate to the Plugins menu and click Add New.

In the search field type "IM Google Analytics" and click Search Plugins. Once you've found the plugin you can view details about it such as the point release, rating and description. Most importantly of course, you can install it by clicking _Install Now_.

= Manual installation =

The manual installation method involves downloading the plugin and uploading it to your web server via your favorite FTP application.

* Download the plugin file to your computer and unzip it
* Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installation's `wp-content/plugins/` directory.
* Activate the plugin from the Plugins menu within the WordPress admin.

== Frequently Asked Questions ==

= Is it possible to move the location of the Google Analytics script? =

No. The newer version of Google Analytics tracking code is known to be using asynchronous tracking code, which Google claims is significantly more sensitive and accurate, and is able to track even very short activities on the website.
The previous version delayed page loading and so, for performance reasons, it was generally placed just before the </body> body close HTML tag.
But the newer version can be placed in the <head></head> tags.

== Screenshots ==

1. You'll find the configuration under Settings -> IM Google Analytics.
2. An overview over the very easy-to-use settings.

== Changelog ==

= 1.0.0 =
* Initial Release

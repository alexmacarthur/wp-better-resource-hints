<?php
/**
* Plugin Name: Better Resource Hints
* Description: Easy preloading, prefetching, HTTP/2 server pushing, and more for your CSS and JavaScript.
* Version: 1.1.3
* Author: Alex MacArthur
* Author URI: http://macarthur.me
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

namespace BetterResourceHints;

require_once(ABSPATH . 'wp-admin/includes/plugin.php');

require_once 'src/Settings.php';
require_once 'src/Filters.php';
require_once 'src/Preconnector.php';
require_once 'src/Preloader.php';
require_once 'src/Prefetcher.php';
require_once 'src/Utilities.php';

if (!defined('WPINC')) {
    die;
}

define('BETTER_RESOURCE_HINTS_OPTIONS_PREFIX', 'better_resource_hints');
define('BETTER_RESOURCE_HINTS_ADMIN_SETTINGS_PAGE_SLUG', 'better_resource_hints');

class App
{

    /**
     * Initialize the plugin.
     *
     * @return object App Instance of class.
     */
    public static function go()
    {
        $GLOBALS[ __CLASS__ ] = new self;
        return $GLOBALS[ __CLASS__ ];
    }

    /**
     * Retrive array of plugin data.
     *
     * @return array
     */
    public static function getPluginData()
    {
        return get_plugin_data(__FILE__);
    }

    public function __construct()
    {
        new Filters;
        new Settings;
        new Preloader;
        new Prefetcher;
        new Preconnector;

        add_action('admin_enqueue_scripts', array($this, 'enqueue_styles_and_scripts' ));
    }

    /**
   * Enqueue necessary admin scripts & styles.
   *
   * @return void
   */
    public function enqueue_styles_and_scripts()
    {
        $plugin_data = self::getPluginData();
        wp_enqueue_style('better-resource-hints', plugin_dir_url(__FILE__) . 'src/assets/css/style.css', [], $plugin_data['Version']);
        wp_enqueue_script('better-resource-hints', plugin_dir_url(__FILE__) . 'src/assets/js/scripts.min.js', [], $plugin_data['Version'], true);
    }
}

App::go();

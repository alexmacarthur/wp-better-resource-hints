<?php
/**
* Plugin Name: Better Resource Hints
* Description: Easy preloading, prefetching, HTTP/2 server pushing, and more for your CSS and JavaScript.
* Version: 1.1.1
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

if ( !defined( 'WPINC' ) ) {
  die;
}

class App {

	private static $instance;

	protected static $plugin_data = null;
  protected static $options_prefix = 'better_resource_hints';
  protected static $admin_settings_page_slug = 'better_resource_hints';
  protected static $copy = array(
    'public' => 'Better Resource Hints'
  );

  public static function init() {
    if(!isset(self::$instance) && !(self::$instance instanceof App)) {
			self::$instance = new App;
		}
  }

  public function __construct() {
		self::$plugin_data = get_plugin_data(__DIR__ . '/better-resource-hints.php');

		new Filters;
    new Settings;
		new Preloader;
		new Prefetcher;
		new Preconnector;

		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_styles_and_scripts' ));
	}

	/**
   * Enqueue necessary admin scripts & styles.
   *
   * @return void
   */
  public function enqueue_styles_and_scripts() {
    wp_enqueue_style( 'better-resource-hints', plugin_dir_url( __FILE__ ) . 'src/assets/css/style.css', array(), self::$plugin_data['Version']);
    wp_enqueue_script( 'better-resource-hints', plugin_dir_url( __FILE__ ) . 'src/assets/js/scripts.min.js', array(), self::$plugin_data['Version'], true);
  }

}

App::init();

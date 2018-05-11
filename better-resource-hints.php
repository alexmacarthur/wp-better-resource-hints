<?php
/**
* Plugin Name: Better Resource Hints
* Description: Easy preloading, prefetching, and HTTP/2 server pushing for your CSS and JavaScript.
* Version: 1.1.0
* Author: Alex MacArthur
* Author URI: http://macarthur.me
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

namespace BetterResourceHints;

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
    wp_enqueue_style( 'better-resource-hints', plugin_dir_url( __FILE__ ) . 'src/assets/css/style.css', array(), null);
    wp_enqueue_script( 'better-resource-hints', plugin_dir_url( __FILE__ ) . 'src/assets/js/scripts.min.js', array(), false, true);
  }

}

App::init();

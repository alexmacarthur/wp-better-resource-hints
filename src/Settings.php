<?php


namespace BetterResourceHints;

require_once 'Utilities.php';

class Settings extends App {

  public $options;
  public $github_url = '';
  public $wordpress_url = '';
  public $twitter_url = '';
  public $website_url = 'http://macarthur.me/#contact';

  /**
   * Add actions, set up stuffs.
   */
  public function __construct() {
    $this->options = Utilities::get_options();
    add_action( 'admin_init', array($this, 'register_main_setting'));
		add_action( 'admin_init', array($this, 'register_settings'));
		add_action(	'admin_menu', array($this, 'better_resource_hints_settings_page'));
  }

  /**
   * Add submenu page for settings.
   *
   * @return void
   */
  public function better_resource_hints_settings_page() {
		add_submenu_page('options-general.php', self::$copy['public'] . ' Settings', self::$copy['public'], 'edit_posts', self::$options_prefix, array($this, 'settings_page_callback'));
  }

  /**
   * Generate markup for settings page.
   *
   * @return void
   */
  public function settings_page_callback() {
  ?>
    <div id="BRCSettingsPage" class="wrap">
      <h1><?php echo self::$copy['public']; ?> Settings</h1>

      <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
          <div id="post-body-content" class="postbox-container">
            <form method="post" action="options.php">
              <?php wp_nonce_field('update-options'); ?>
              <?php
                settings_fields( self::$options_prefix . '_settings' );
                do_settings_sections( self::$admin_settings_page_slug );
                submit_button();
              ?>
            </form>
          </div>

          <div id="postbox-container-1" class="postbox-container">
            <?php include 'inc/promo.php'; ?>
          </div>
        </div>
      </div>
    </div>

  <?php
  }

  /**
   * Register the main setting for storing settings.
   *
   * @return void
   */
  public function register_main_setting() {
    register_setting( self::$options_prefix . '_settings', self::$options_prefix);
  }

  /**
   * Register Default fallback and force settings.
   *
   * @return void
   */
  public function register_settings () {
    add_settings_section( self::$options_prefix . '_tabs', '', array( $this, 'cb_tabs' ), self::$admin_settings_page_slug );
  }

  /**
   * Outputs field markup.
   *
   * @return void
   */
  public function cb_tabs() {
		$activeTab = isset($_GET['active-tab']) ? $_GET['active-tab'] : '';
		?>
		<div class="Tabs">
			<ul class="Tabs-list">
				<li class="Tabs-tab">
					<a
					data-tab-id="preload"
					class="<?php if($activeTab === 'preload' || $activeTab === '') echo 'is-selected'; ?>">
						Preloading
					</a>
				</li>
				<li class="Tabs-tab">
					<a
					data-tab-id="prefetch"
					class="<?php if($activeTab === 'prefetch') echo 'is-selected'; ?>">
						Prefetching
					</a>
				</li>
			</ul>

			<?php
			echo '<div class="Tabs-block ' . ($activeTab === 'preload' || $activeTab === '' ? 'is-selected' : '') . '" data-tab-content="preload">';
				echo "<p>Preloading an asset instructs the browser to download it immediately at a high priorty. All of this happens in the background, so page load isn't blocked while these resources are being downloaded, improving metrics like overall page load time and time to interactive. It's best to preload assets that are definitely needed, but discovered late on the page.</p>";
				include plugin_dir_path(__FILE__) . 'inc/preloaded-scripts.php';
				include plugin_dir_path(__FILE__) . 'inc/preloaded-styles.php';
				include plugin_dir_path(__FILE__) . 'inc/preloaded-server-push.php';
			echo '</div>';

			echo '<div class="Tabs-block ' . ($activeTab === 'prefetch' ? 'is-selected' : '') .'" data-tab-content="prefetch">';
				echo "<p>Prefetching an asset instructs the browser to download it in the background as a low priority, so that you can cache it for future use on other pages. Because of this, you should only prefetch assets that AREN'T needed on the current page, but on pages the user is likely to visit in the future.</p>";
				include plugin_dir_path(__FILE__) . 'inc/prefetched-scripts.php';
				include plugin_dir_path(__FILE__) . 'inc/prefetched-styles.php';
				include plugin_dir_path(__FILE__) . 'inc/prefetched-server-push.php';
			echo '</div>';
		echo '</div>';
	}
}

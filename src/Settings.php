<?php


namespace BetterResourceHints;

require_once 'Utilities.php';

class Settings
{
    public $options;
    public $github_url = '';
    public $wordpress_url = '';
    public $twitter_url = '';
    public $website_url = 'http://macarthur.me/#contact';

    /**
     * Add actions, set up stuffs.
     */
    public function __construct()
    {
        $this->options = Utilities::get_options();
        add_action('admin_init', array($this, 'register_main_setting'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_menu', array($this, 'better_resource_hints_settings_page'));
        add_action('wp_logout', array($this, 'reset_active_tab'));
    }

    public function reset_active_tab()
    {
        $options = get_option(BETTER_RESOURCE_HINTS_OPTIONS_PREFIX);
        unset($options['last-active-tab']);
        update_option(BETTER_RESOURCE_HINTS_OPTIONS_PREFIX, $options);
    }

    /**
     * Add submenu page for settings.
     *
     * @return void
     */
    public function better_resource_hints_settings_page()
    {
        add_submenu_page('options-general.php', 'Better Resource Hints Settings', 'Better Resource Hints', 'edit_posts', BETTER_RESOURCE_HINTS_OPTIONS_PREFIX, array($this, 'settings_page_callback'));
    }

    /**
     * Generate markup for settings page.
     *
     * @return void
     */
    public function settings_page_callback()
    {
        ?>
    <div id="BRCSettingsPage" class="wrap">
      <h1>Better Resource Hints Settings</h1>

      <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
          <div id="post-body-content" class="postbox-container">
            <form method="post" action="options.php">
              <?php wp_nonce_field('update-options'); ?>
              <?php
                settings_fields(BETTER_RESOURCE_HINTS_OPTIONS_PREFIX . '_settings');
        do_settings_sections(BETTER_RESOURCE_HINTS_ADMIN_SETTINGS_PAGE_SLUG);
        submit_button(); ?>
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
    public function register_main_setting()
    {
        register_setting(BETTER_RESOURCE_HINTS_OPTIONS_PREFIX . '_settings', BETTER_RESOURCE_HINTS_OPTIONS_PREFIX);
    }

    /**
     * Register Default fallback and force settings.
     *
     * @return void
     */
    public function register_settings()
    {
        add_settings_section(BETTER_RESOURCE_HINTS_OPTIONS_PREFIX . '_tabs', '', array( $this, 'cb_tabs' ), BETTER_RESOURCE_HINTS_ADMIN_SETTINGS_PAGE_SLUG);
    }

    /**
     * Outputs field markup.
     *
     * @return void
     */
    public function cb_tabs()
    {
        $lastActiveTab = Utilities::get_option("last-active-tab");
        $lastActiveTab = $lastActiveTab ?: 'preload'; ?>

		<div class="TabHolder">
			<div class="Tab">
				<input type="radio" id="tab-preload" value="preload" class="Tab-input" name="<?php echo Utilities::get_field_name("last-active-tab"); ?>" <?php checked($lastActiveTab, 'preload'); ?>>
				<label for="tab-preload" class="Tab-label">Preload</label>
				<div class="Tab-content">
					<?php
                        echo "<p>Preloading an asset instructs the browser to download it immediately at a high priorty. All of this happens in the background, so page load isn't blocked while these resources are being downloaded, improving metrics like overall page load time and time to interactive. It's best to preload assets that are definitely needed, but discovered late on the page.</p>";
        include plugin_dir_path(__FILE__) . 'inc/preloaded-scripts.php';
        include plugin_dir_path(__FILE__) . 'inc/preloaded-styles.php';
        include plugin_dir_path(__FILE__) . 'inc/preloaded-server-push.php'; ?>
				</div>
			</div>

			<div class="Tab">
				<input type="radio" id="tab-prefetch" value="prefetch" class="Tab-input" name="<?php echo Utilities::get_field_name("last-active-tab"); ?>" <?php checked($lastActiveTab, 'prefetch'); ?>>
				<label for="tab-prefetch" class="Tab-label">Prefetch</label>
				<div class="Tab-content">
					<?php
                        echo "<p>Prefetching an asset instructs the browser to download it in the background as a low priority, so that you can cache it for future use on other pages. Because of this, you should only prefetch assets that AREN'T needed on the current page, but on pages the user is likely to visit in the future.</p>";
        include plugin_dir_path(__FILE__) . 'inc/prefetched-scripts.php';
        include plugin_dir_path(__FILE__) . 'inc/prefetched-styles.php';
        include plugin_dir_path(__FILE__) . 'inc/prefetched-server-push.php'; ?>
				</div>
			</div>

			<div class="Tab">
				<input type="radio" id="tab-preconnect" value="preconnect" class="Tab-input" name="<?php echo Utilities::get_field_name("last-active-tab"); ?>" <?php checked($lastActiveTab, 'preconnect'); ?>>
				<label for="tab-preconnect" class="Tab-label">Preconnect</label>
				<div class="Tab-content">
					<?php
                        echo "<p>Preconnect hints perform DNS lookups, TLS negotiations, TCP handshakes before any HTTP requests are made, reducing latency. It's a beefier version of the dns-prefetch hint, but is less widely supported.</p>";
        echo "<p>By default, WordPress enables dns-prefetch for all externally hosted assets. Enabling this option will add a preconnect hint to each asset that is DNS prefetched.</p>";
        include plugin_dir_path(__FILE__) . 'inc/preconnect-assets.php';
        include plugin_dir_path(__FILE__) . 'inc/preconnect-server-push.php'; ?>
				</div>
			</div>

		</div>
		<?php
    }
}

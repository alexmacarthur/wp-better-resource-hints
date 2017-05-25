<?php

namespace BetterResourceHints;

class Preloader extends App {

  public function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_load_css_js'));
		add_action('wp_head', array($this, 'preload_javascript'), 1);
		add_action('wp_head', array($this, 'preload_css'), 1);
		add_filter('better_resource_hints_preload_tag', array($this, 'change_rel_type'), 10, 3);
		add_filter('better_resource_hints_should_preload', array($this, 'default_script_preloading'), 10, 4);
	}

	/**
	 * If no option is set (like, it's a fresh install), preload footer scripts by default.
	 *
	 * @param boolean $should
	 * @param object $resource
	 * @param string $type
	 * @param mixed $option
	 *
	 * @return void
	 */
	public function default_script_preloading($should, $resource, $type, $option) {
		if(
			!$option &&
			$type === 'scripts' &&
			(isset($resource->extra['group']) && $resource->extra['group'] === 1)
		) {
			return true;
		}

		return $should;
	}

	public function preload_css() {
		$this->generate_preload_markup('styles');
	}

	public function preload_javascript() {
		$this->generate_preload_markup('scripts');
	}

  	public function enqueue_load_css_js() {
    	wp_enqueue_script( 'loadcss', plugin_dir_url( __FILE__ ) . 'assets/js/preload.min.js', array(), null);
  	}

	/**
	 * If we're generating preload tags for CSS, change them to stylesheets and remove from queue.
	 *
	 * @param string $tag HTML tag
	 * @param string $handle
	 * @param string $type
	 * @return void
	 */
	public function change_rel_type($tag, $handle, $type) {

		if($type === 'styles') {
			global ${'wp_' . $type};
			$queue = ${'wp_' . $type}->queue;
			unset(${'wp_' . $type}->queue[array_search($handle, $queue)]);

			return str_replace('as=', 'onload="this.rel=\'stylesheet\'" as=', $tag);
		}

		return $tag;
	}

	private function generate_preload_markup($type = 'scripts') {
		global ${'wp_' . $type};
		$handlesToPreload = [];

		$preloadOption = Utilities::get_option('preload_'. $type . '_option');
		$noSpaces = Utilities::strip_spaces(Utilities::get_option('preload_'. $type. '_handles'));
		$specificHandlesToPreload = explode(',', $noSpaces ?: '');

		//-- @todo In the future, check if user would like to preload $specificHandlesToPreload's dependencies as well.
		// foreach($specificHandlesToPreload as $handle) {
		// 	$specificHandlesToPreload = array_merge($specificHandlesToPreload, Utilities::collect_all_deps($handle));
		// }

		//-- Gather all enqueued scripts and dependencies.
		foreach(${'wp_' . $type}->queue as $handle) {
			$handlesToPreload[] = $handle;
			$handlesToPreload = array_merge($handlesToPreload, Utilities::collect_all_deps($handle, $type));
		}

		//-- Loop through and print preload tags.
		foreach($handlesToPreload as $handle) {
			$resource = ${'wp_' . $type}->registered[$handle];

			if(empty($resource->src)) continue;

			if(
				//-- Only footer scripts!
				$preloadOption === ('footer_' . $type) && isset($resource->extra['group']) && $resource->extra['group'] === 1

				//-- All scripts!
				|| $preloadOption === ('all_' . $type)

				//-- Only scripts specified!
				|| $preloadOption === ('choose_' . $type) && in_array($handle, $specificHandlesToPreload)

				//-- Allow this to be manually enabled.
				|| apply_filters('better_resource_hints_should_preload', false, $resource, $type, $preloadOption)
			) {
				$singular = substr_replace($type, "", -1);
				$source = $resource->src . ($resource->ver ? "?ver={$resource->ver}" : "");

				if(Utilities::get_option("preload_assets_enable_server_push")) {
					Utilities::construct_server_push_headers('preload', $source, $singular);
				}

				echo apply_filters('better_resource_hints_preload_tag', "<link rel='preload' href='{$source}' as='{$singular}'/>\n", $handle, $type);
			}
		}
	}
}

<?php

namespace BetterResourceHints;

class Utilities extends App {

	public static function strip_spaces($string) {
		return trim(preg_replace('/\s+/', '', $string));
	}

	/**
	 * Send a 'Link' header.
	 *
	 * @param string $rel Type of header you'd like to push (prefetch, preload, etc.).
	 * @param string $src Source of the asset to be pushed.
	 * @param string $type Type of the asset to be pushed.
	 * @return void
	 */
	public static function construct_server_push_headers($rel, $src, $type = null) {

		if(headers_sent()) return;
		if(strpos($src, site_url()) === false) return;

		$header = sprintf(
			'Link: <%s>; rel=%s; ',
			esc_url( parse_url($src, PHP_URL_PATH) ),
			$rel
		);

		if($type) {
			$header .= 'as=' . $type;
		}

		header(apply_filters(self::$options_prefix . '_header', $header, $rel, $src, $type), false);
	}

  /**
   * Gets serialized settings in options table.
   *
   * @return array
   */
  public static function get_options() {
    return get_option(self::$options_prefix);
	}

	public static function collect_all_deps($handle, $type = 'scripts') {
		global ${'wp_' . $type};
		$handles = [];

		foreach(${'wp_' . $type}->registered[$handle]->deps as $dep) {
			$handles[] = $dep;
			$handles = array_merge($handles, self::collect_all_deps($dep, $type));
		}

		return array_unique($handles);
	}

  /**
   * Gets specific option value.
   *
   * @param  string $key Option key
   * @return string
   */
  public static function get_option($key) {
    if(isset(self::get_options()[$key])) {
      return self::get_options()[$key];
    }

    return false;
  }

  /**
   * Gets full name of particular field, with prefix appended.
   *
   * @param  string $name Name of field
   * @return string
   */
  public static function get_field_name($name) {
    return self::$options_prefix . '[' . $name . ']';
  }
}

<?php

namespace BetterResourceHints;

class Filters {

	public function __construct() {
		add_filter('style_loader_tag', array($this, 'add_id_to_style_tags'), 10, 4);
		add_filter('script_loader_tag', array($this, 'add_id_to_script_tags'), 10, 3);
	}

	public function add_id_to_style_tags($html, $handle, $href, $media) {
		return str_replace('<link ', '<link data-handle="' . $handle . '" ', $html);
	}

	public function add_id_to_script_tags($tag, $handle, $src) {
		return str_replace('<script ', '<script data-handle="' . $handle . '" ', $tag);
	}
}

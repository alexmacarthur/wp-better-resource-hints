<?php

namespace BetterResourceHints;

class Prefetcher
{
    public function __construct()
    {
        add_action('wp_head', array($this, 'prefetch_javascript'), 1);
        add_action('wp_head', array($this, 'prefetch_styles'), 1);
    }

    public function prefetch_javascript()
    {
        $this->generate_prefetch_markup('scripts');
    }

    public function prefetch_styles()
    {
        $this->generate_prefetch_markup('styles');
    }

    /**
     * Only allow users to prefetch by specific handle,
     * because we don't want to prefetch all admin scripts
     * if that option is selected.
     *
     * @param string $type
     * @return void
     */
    private function generate_prefetch_markup($type = 'scripts')
    {
        global ${'wp_' . $type};
        $singularType = substr_replace($type, "", -1);
        $handlesToPrefetch = [];

        $noSpaces = Utilities::strip_spaces(Utilities::get_option('prefetch_'. $type. '_handles'));
        $specificHandlesToPrefetch = explode(',', $noSpaces ?: '');

        //-- @todo In the future, check if user would like to preload $specificHandlesToPrefetch's dependencies as well.
        // foreach($specificHandlesToPrefetch as $handle) {
        // 	$specificHandlesToPrefetch = array_merge($specificHandlesToPrefetch, Utilities::collect_all_deps($handle));
        // }

        //-- Loop through and print preload tags.
        foreach (array_unique($specificHandlesToPrefetch) as $handle) {
            $resource = isset(${'wp_' . $type}->registered[$handle])
                ? ${'wp_' . $type}->registered[$handle]
                : false;

            if ($resource === false) {
                continue;
            }
            if (empty($resource->src)) {
                continue;
            }

            $methodToCheckIfAssetIsEnqueued = 'wp_' . $singularType . '_is';
            if ($methodToCheckIfAssetIsEnqueued($handle)) {
                continue;
            }

            $source = $resource->src . ($resource->ver ? "?ver={$resource->ver}" : "");

            if (Utilities::get_option("prefetch_assets_enable_server_push")) {
                Utilities::construct_server_push_headers('prefetch', $source);
            }

            echo apply_filters('better_resource_hints_prefetch_tag', "<link rel='prefetch' href='{$source}'/>\n", $handle, $type);
        }
    }
}

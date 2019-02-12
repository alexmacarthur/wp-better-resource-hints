<?php

namespace BetterResourceHints;

class Preconnector
{
    private $hostsToPreconnect = array();

    public function __construct()
    {
        add_filter('wp_resource_hints', array($this, 'preconnect_hosts'), 11, 2);
    }

    /**
     * If enabled, generate a preconnect tag for each asset that's dns-prefetched.
     *
     * @param array $urls
     * @param string $type
     * @return array
     */
    public function preconnect_hosts($urls, $type)
    {
        if (Utilities::get_option('preconnect_hosts_option') === 'no_assets') {
            return $urls;
        }

        foreach ($urls as $url) {
            if (Utilities::get_option("preconnect_hosts_enable_server_push")) {
                Utilities::construct_server_push_headers('preconnect', $url, null, false);
            }

            if (gettype($url) !== 'string') {
                continue;
            }

            $parsedURL = wp_parse_url($url);
            unset($parsedURL["scheme"]);

            $reconstructedURL = isset($parsedURL['host'])
                ? '//' . $parsedURL['host']
                : '//' . join("", $parsedURL);

            echo apply_filters('better_resource_hints_preconnect_tag', "<link rel='preconnect' href='{$reconstructedURL}'/>\n", $reconstructedURL);
        }

        return $urls;
    }
}

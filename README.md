# Better Resource Hints
Easy preloading, prefetching, HTTP/2 server pushing, and more for your CSS and JavaScript.

## Description
Better Resource Hints will make your WordPress site or application more faster and generally more performant by intelligently leveraging resource hints like prefetch, preload, preconnect, and server push.

As it stands, WordPress isn't that bad about providing a base level of these hints. In fact, a basic, dedicated API has been [shipped since version 4.6.](https://make.wordpress.org/core/2016/07/06/resource-hints-in-4-6/). However, this functionality only scratches the service, providing only `dns-prefetch` tags out of the box, and there's growing opportunity to take advantage of different hints as they are introduced and gain more browser support. Specifically, this plugin focuses on the following types of hints for your styles and JavaScript assets:

**Preconnecting** - This hint is similar to "dns-prefetch," but a more beefier version. Instead of just resolving the DNS, the preconnect hint handles TLS negotiations and TCP handshakes, resulting in reduced page latency. 

**Preloading** - Preloadin occurs when the browser is told it can start downloading an asset in the background early during page load, instead of waiting until the asset is explicitly called to start the process. This hint is most beneficial for assets loaded later on in the page, but are nonetheless essential to the page's functionality. More often than not, this is a JavaScript file. Enabling this results in an overall faster load time, and quicker time to interactive.

**Prefetching** - Prefetching assets is similar to preloading, but the assets are downloaded in low priority for the purpose of caching them for later use. For example, if a user hits your home page and is likely to go to a page that uses a heavy JavaScript file, it's wise to prefetch that asset on the home page, so it's cached and ready to go on the next. Again, the result is a quicker subsequent page load, quicker time to interactive, and an improved overall user experience. This is different from DNS prefetching, which will only resolve the DNS of a resource's host, and not actually download the resource itself.

**Server Push** - If enabled, server push will tell your server to start delivering an asset before the browser even asks for it. This results in a much faster delivery of key assets, and be toggled on for both preloaded, prefetched, and preconnected assets. **Note: This feature requires a server that supports server push, and is the most experimental strategy this plugin provides.**

As with any sort of performance-enhancing technique, just be aware that they should be used judiciously, and that the results you see will depend on the size the of resources your site loads, as well as how your server is configured. For additional reading, see some of the resources below:

[Preload, Prefetch, & Priorities in Chrome](https://medium.com/reloading/preload-prefetch-and-priorities-in-chrome-776165961bbf)
[Preloading Key Requests](https://developers.google.com/web/tools/lighthouse/audits/preload)
[Preload: What's It Good For?](https://www.smashingmagazine.com/2016/02/preload-what-is-it-good-for/)
[Resource Hints – What is Preload, Prefetch, and Preconnect?](https://www.keycdn.com/blog/resource-hints/)

### What Makes This Plugin Stand Apart?
There's no shortage of plugins out there that aim to leverage resource hints for boosting performance. However, I've seen that several of them make the following mistakes:

**Inflexible Hint Management** Many similar plugins only provide very limited flexibility in their options, and only allow setting hints globally for every page, regardless of whether the resources are actually needed on the page. This can often result in unecessarily bloaging your bandwidth, since hints on several pages are effectively useless. In some cases, this could actually lead to a less performant site. This plugin attempts to provide options to manage hints more flexibily and intelligently, meaning you won't be unecessarily preloading assets in the background when they're not even needed on the page. 

**Misunderstanding What Different Hints Do** I've come across some plugins that fail to understand and leverage different hints like they were designed. For example, promising that assets are being preloaded, when they're actually being prefetched. These and other hints have very different purposes, and should not be interchangably used if you want them to impact your site in the most effective way. This plugin attemps to leverage these hints in way to maximize their effectiveness. For example, BHR won't prefetch any assets that are enqueued on the page, because that's just now how the prefetch hint is designed to be used.

Is Better Resource Hints perfect? Absolutely not. That's why I encourage any constructive feedback or bug reports to be sent my way immediately, so that I can't improve this plugin as quickly as possible. 

### A Note About Preloading CSS

Because of their high placement on a page, if the option is enabled, your CSS files will be asyncronously preloaded, and _then_ turned into a stylesheet once they've completely loaded. The advantage to doing this is that while the files are downloading, they won't block the rest of the page from rendering, resulting an overall faster page load.

However, this also means that there may be a flash of unstyled content on the page for a brief moment as the files download. To prevent this, it's recommended to only preload CSS files that are not critical to the initial view of the page. This will allow you to gain some performance points without sacrificing use experience as the page loads.

## Filters

The following filters are exposed for your use.

```php
/**
* Modify the HTML link generated for preconnecting hosts.
*
* @param string $link (HTML tag)
* @param string $url (URL of the host)
* @return string
*/
add_filter('better_resource_hints_preconnect_tag', function ($link, $url) {
	return $url;
}, 10, 2);
```

```php
/**
* Modify the HTML link generated for prefetching hosts.
*
* @param string $link (HTML tag)
* @param string $handle (WP handle of the resource
* @param string $type (script or style)
* @return string
*/
add_filter('better_resource_hints_prefetch_tag', function ($link, $handle, $type) {
	return $url;
}, 10, 3);
```

```php
/**
* Modify the HTML link generated for preloading hosts.
*
* @param string $link (HTML tag)
* @param string $handle (WP handle of the resource
* @param string $type (script or style)
* @return string
*/
add_filter('better_resource_hints_preload_tag', function ($link, $handle, $type) {
	return $url;
}, 10, 3);
```

## Installation
1. Download the plugin and upload to your plugins directory, or install the plugin through the WordPress plugins page.
2. Activate the plugin through the 'Plugins' page.
3. Use the Settings -> Better Resource Hints screen to choose whether and which assets to preload, prefetch, and server push.

## What Happens Out of the Box?
Upon activation, Better Resource Hints will optimize your resource hints in a conservative, low-risk way by only doing two things out of the box:

1. Preloading JavaScript assets enqueued in the footer.
2. Setting preconnect hints for all third party hosts that already have dns-preconnect hints.

## Using the Plugin

After activation, you are able to adjust settings to tweak optimization as seen fit. As a means of testing your optimizations, use a tool like [Google Lighthouse](https://developers.google.com/web/tools/lighthouse/) to measure the impact of these changes on your site's performance.

As mentioned, the techniques used here are largely supported by modern browsers, but your results may vary depending on the amount of assets being loaded on your site, as well as your server configuration.

### Changelog

#### 1.0.0
* Initial release.

#### 1.1.0
* Introduce support for generating preconnect hints. 
* Improve user interface. 
* Improve documentation.

## Feedback
You like it? [Email](mailto:alex@macarthur.me) or [tweet](http://www.twitter.com/amacarthur) me. You hate it? [Email](mailto:alex@macarthur.me) or [tweet](http://www.twitter.com/amacarthur) me.

Regardless of how you feel, your review would be greatly appreciated!

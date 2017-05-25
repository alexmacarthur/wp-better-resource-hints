# Better Resource Hints
Easy preloading, prefetching, HTTP/2 server pushing for your CSS and JavaScript.

## Description
Better Resource Hints will make your WordPress site faster using modern, performance-enhancing resource hints supported by most of today's browsers and servers.

As it stands, WordPress isn't that bad about leveraging a base level of resource hints. A basic API has been [shipped since version 4.6.](https://make.wordpress.org/core/2016/07/06/resource-hints-in-4-6/). However, this functionality only scratches the service, providing only `dns-prefetch` tags out of the box. Better Resource Hints helps you leverage some of the most effective, cutting-edge techniques available to most browsers today, and more importantly, it allows you to implement these tactics in an unintimidating yet flexible way. Specifically, this plugin focuses on the following types of hints for your styles and JavaScript assets:

**Preloading** - This occurs when the browser is told it can start downloading an asset in the background early during page load, instead of waiting until the asset is explicitly called to start the process. This hint is most beneficial for assets loaded later on in the page, but are nonetheless essential to the page's functionality. More often than not, this is a JavaScript file. Enabling this results in an overall faster load time, and quicker time to interactive.

**Prefetching** - Prefetching assets is similar to preloading, but the assets are downloaded in low priority for the purpose of caching them for later use. For example, if a user hits your home page and is likely to go to a page that uses a heavy JavaScript file, it's wise to prefetch that asset on the home page, so it's cached and ready to go on the next. Again, the result is a quicker subsequent page load, quicker time to interactive, and an improved overall user experience. This is different from DNS prefetching, which will only resolve the DNS of a resource's host, and not actually download the resource itself.

**Server Push** - If enabled, server push will tell your server to start delivering an asset before the browser even asks for it. This results in a much faster delivery of key assets, and be toggled on for both preloaded and prefetched assets. **Note: This feature requires a server that supports server push, and is the most experimental strategy this plugin provides.**

As with any sort of performance-enhancing technique, just be aware that they should be used judiciously, and that the results you see will depend on the amount of resource your site loads, as well as how your server is configured. For additional reading, see some of the resources below:

[Preload, Prefetch, & Priorities in Chrome](https://medium.com/reloading/preload-prefetch-and-priorities-in-chrome-776165961bbf)
[Preloading Key Requests](https://developers.google.com/web/tools/lighthouse/audits/preload)
[Preload: What's It Good For?](https://www.smashingmagazine.com/2016/02/preload-what-is-it-good-for/)

#### About Preloading CSS

Because of their high placement on a page, if the option is enabled, your CSS files will be asyncronously preloaded, and _then_ turned into a stylesheet once they've completely loaded. The advantage to doing this is that while the files are downloading, they won't block the rest of the page from rendering, resulting an overall faster page load.

However, this also means that there may be a flash of unstyled content on the page for a brief moment as the files download. To prevent this, it's recommended to only preload CSS files that are not critical to the initial view of the page. This will allow you to gain some performance points without sacrificing use experience as the page loads.

## Installation
1. Download the plugin and upload to your plugins directory, or install the plugin through the WordPress plugins page.
2. Activate the plugin through the 'Plugins' page.
3. Use the Settings -> Better Resource Hints screen to choose whether and which assets to preload, prefetch, and server push.

## Using the Plugin

Upon activation, Better Resource Hints will optimize your resource hints in a consevrative, low-risk way by only preloading JavaScript assets enqueued in the footer. Beyond this, you are able to adjust settings to tweak optimization as seen fit. As a means of testing your optimizations, use a tool like [Google Lighthouse](https://developers.google.com/web/tools/lighthouse/) to measure the impact of these changes on your site's performance.

As mentioned, the techniques used here are largely supported by modern browsers, but your results may vary depending on the amount of assets being loaded on your site, as well as your server configuration.

### Changelog

#### 1.0.0
* Initial release.

## Feedback
You like it? [Email](mailto:alex@macarthur.me) or [tweet](http://www.twitter.com/amacarthur) me. You hate it? [Email](mailto:alex@macarthur.me) or [tweet](http://www.twitter.com/amacarthur) me.

Regardless of how you feel, your review would be greatly appreciated!

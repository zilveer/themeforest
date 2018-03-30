=== Plugin Name ===
Contributors: sirzooro
Tags: search, seo, widget, google
Requires at least: 2.7
Tested up to: 2.9.9
Stable tag: 1.2

This plugin shows recent searches in a sidebar widget.

== Description ==

This plugin shows recent searches in a sidebar widget. You can use this to tell your visitors what others are searching for. You can also use it to increase your site (i.e. number of pages indexed by Search Engines).

New searches are added to the beginning of the list. If search query is already on the list, it is moved to the beginning.

All links are SEO-friendly (usually `site.com/search/searchterm`).

You can add `rel="nofollow"` to links if you want. If you want to make sure search results will not be indexed, please install [Meta SEO Pack](http://wordpress.org/extend/plugins/meta-seo-pack/) plugin - it can do it for you.

Available translations:

* English
* Polish (pl_PL) - done by me
* Italian (it_IT) - thanks [Gianni](http://gidibao.net/)
* Belorussian (be_BY) - thanks FatCow
* Dutch (nl_NL) - thanks [Rene](http://wpwebshop.com/)

[Changelog](http://wordpress.org/extend/plugins/recent-searches-widget/changelog/)

== Installation ==

1. Upload `recent-searches-widget` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add Recent Searches widget to your Sidebar, configure and enjoy :)

== Frequently Asked Questions ==

= How to insert widget anywhere in my theme? =

Starting from version 1.1 it is possible to insert special theme tag to insert Recent Searches Widget anywhere in your theme. To do this, use new `rsw_show_recent_searches()` tag. By default it shows list of last searches using bullet list, like in sidebar. If you want to change this, you can pass up to three parameters when you call `rsw_show_recent_searches()`. They will be used to display HTML code at beginning of the list, at end of it, and between list elements. Default use (without parameters) is equivalent for following call:

`rsw_show_recent_searches( "<ul>\n<li>", "</li>\n</ul>", "</li>\n<li>" );`

If you want to use numbered list, you can use this:

`rsw_show_recent_searches( "<ol>\n<li>", "</li>\n</ol>" );`

When you want to put all items in one line and separate them by commas, please use following call:

`rsw_show_recent_searches( "", "", ", " );`

== Changelog ==

= 1.2 =
* Fix: slashes in SEO-friendly search links should be double-encoded;
* Added Dutch translation (thanks Rene)

= 1.1.3 =
* Added Belorussian translation (thanks FatCow)

= 1.1.2 =
* Marked as compatible with WP 2.9.x

= 1.1.1 =
* Added Italian translation (thanks Gianni)

= 1.1 =
* Fix for corrupted config bug;
* Added theme tag `rsw_show_recent_searches()`;
* Marked as compatible with WP 2.8.5

= 1.0.1 =
* Added Polish translation

= 1.0 =
* Initial version

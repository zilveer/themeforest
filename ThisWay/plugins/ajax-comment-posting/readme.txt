=== Ajax Comment Posting ===
Contributors: regua
Tags: comments, ajax, post, comment, edit, refresh
Requires at least: 2.7
Tested up to: 2.9.1
Stable tag: 2.0

Posts comments without refreshing the page and validates the comment form using Ajax.

== Description ==

There are many comment-related plugins in Wordpress plugin directory. However, if you'd like to find just a simple, reliable comment-posting Ajax plugin, you won't find any. That's why I developed a simple and small yet functional Ajax Comment Posting (ACP) plugin. Not only will it post your comment without refreshing the page, but it will also make sure that you've filled all the form fields correctly.

The plugin works well in all major Web browsers, and switches to the traditional comment posting if JavaScript is disabled.

As the new Google Analytics code conflicted with the plugin, a built-in support for GA has been added. Read the FAQ for more information.

ACP should work with all CAPTCHA word-verification plugins, but I personally suggest using [Akismet](http://codex.wordpress.org/Akismet "The Akismet anti-spam plugin").

You can easily add some more functionality to your comment form using [jQuery](http://jquery.com "The jQuery JavaScript framework"), the best JavaScript framework, which is used by ACP to handle the Ajax requests and all JavaScript-related operations. The plugin is written in the simplest form, the code is kept clean and it's easy to see what a particular part of the code is responsible for.

== Installation ==

1. Upload the plugin directory `ajax-comment-posting` to the `wp-content/plugins` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. That's it!

== Frequently Asked Questions ==

= Why isn't my plugin working or it works differently than it should? =

It's probably your WordPress theme's fault. ACP needs several things to be present in your comments.php file (in the theme's default directory). The submit button has to have a `submit` id, the comment form has to have a `commentform` id, the container with the comments has to have a `commentlist` class.
Most WordPress themes meet these requirements. If yours doesn't - either correct it by yourself or let me know.

Also, another cause of the plugin dysfunctioning may be Google Analytics. See the next question.

= Does it work with Google Analytics? =

It does, just not with the default Google Analytics code. You can either use the [Google Analyticator](http://wordpress.org/extend/plugins/google-analyticator "Google Analitycator") plugin or insert the code manually following [Google's instructions](http://code.google.com/apis/analytics/docs/tracking/asyncTracking.html "Google Analytics asynchronous code").

= Why doesn't the plugin work with WP Ajax Edit Comments? =

ACP works well with the [WP AJAX Edit Comments](http://wordpress.org/extend/plugins/wp-ajax-edit-comments/ "WP AJAX Edit Comments") plugin up to version 2.1, allowing you to edit and manage comments in an Ajax way, and the users to edit their own comments for a specified amount of time.

= How can I customise the look of the error and success messages? =

You can either change the `acp.css` file in the plugin's directory, or just delete the file and add `error` and `success` classes to your CSS stylesheet.

= The loading icon doesn't show. What can I do? =

You can manually set the direct path to the loading image in the `acp.js` file (line 23).

= How can I change or remove the loading icon? =

The loading icon is the file `loading.gif` inside ACP's directory. If you want to remove the icon, just delete the icon image file and you'll get a 'Loading...' message instead. Also, you can edit the `acp.js` file (line 23).

= I don't want the email address field to be validated. How do I do that? =

Just delete or comment the lines 51-60 in the `acp.js` file.

= How does the plugin work? =

Firstly, it validates the form - checks if you've entered a name, (valid) email address and the comment (if you're a logged-in user, you obviously don't have to enter the name and email). Then it submits the form using Ajax (Asynchronous JavaScript and XML), checks if the server returned an error and adjusts the display method to the server response. Also, after a successful submission, it appends your newly posted comment to the comment list (or creates one if not present) and displays a nice, green-coloured message.

= Can you help me with it? =

Yes, but you may need to wait some time for my response. You can always use the support forums here on WordPress.org.
In case of a bug report or help request, please include your comments.php file from your theme's directory as an attachment to the email / message, and explain your problem thoroughly giving all needed details: your WordPress and ACP version, other Ajax-based plugins you are using, etc.

== Thanks ==

HUGE thanks to [Aen Tan](http://aendirect.com "Aen's homepage") for solving a WP 2.3.1 bug, correcting my mistakes and preventing the plugin from conflicting with Prototype.

Also, I'd like to thank [Annand Ramsahai](http://baiganchoka.com), [Max Karreth](http://guimkie.com "Max's homepage"), [Gene Steinberg](http://macnightowl.com/ "Gene's homepage"), [Rayne Bair](http://www.wifetalks.com/knits/ "Rayne's homepage") and [Dave Anderson](http://cv.67design.com/ "Dave's homepage") for pointing some errors and suggesting the further development of the plugin.

=== Plugin Name ===
Contributors: shantzg001
Donate link: http://tech.shantanugoel.com/projects/wordpress/shantz-wordpress-qotd
Tags: wordpress, plugin, quotes, quote of the day, qotd, Post, posts, pages, Page, widget
Requires at least: 1.5
Tested up to: 2.5
Stable tag: 1.2.2

Shantz WP QOTD is the coolest plugin to add quotes to your wordpress blog posts and sidebars in a few easy clicks.

== Description ==

There are many quotes plugins out there. This one has been started by me (Shantanu Goel) with a view to have the best of features and options, ease of use and multiple sources to get the quotes from.
(For Complete Details, go to [my tech blog](http://tech.shantanugoel.com/projects/wordpress/shantz-wordpress-qotd "Shantz WordPress QOTD"))

Features:

* Add quotes to all your posts automatically.

* Widget support - Can also have a widget in the sidebar for quotes.

* Customize and style your quotes with your own text and tags.

* Multiple sources for quotes (paste in admin page, get from file implemented, fetch from web/rss soon to come)

* Multiple patterns for quotes - Random Quote, Quote of the day (all posts display quote of the day), Quote of that day (all posts display quote for their own days)

* Pattern for widget can be different

* Customization for widget can be different

* Add quotes to top or bottom of posts

* Custom template tag to add quote anywhere you want

* Custom quote boundary decalarator tags/Multiline quote support

* Enable/Disable the quotes without deactivating the plugin 

* Option to exclude pages from displaying quotes

Coming Soon:

* Fetch from web/RSS support

* Quotes Categories

* Pics support for quotes

* Anything else you want

* File selection

And more...

== Installation ==

The Shantz-WP-QOTD plugin can be installed in following easy steps:

1. Unzip "shantz-wp-qotd" archive and put all files into your "plugins" folder (/wp-content/plugins/). It is advisable to create a sub directory into the plugins folder, like /wp-content/plugins/shantz-wp-qotd/

2. Activate the plugin

3. Go to Options > Shantz WP Quotes, adjust your settings and save them.

4. For adding and configuring widget to sidebar, go to Presentation > Widgets.

== Frequently Asked Questions ==
For quick updates and resolutions, go to [shantz-wp-qotd home page](http://tech.shantanugoel.com/projects/wordpress/shantz-wordpress-qotd "My Technophilic Musings")

= How to add quotes anywhere in the posts/pages? =
Use the tag "`<!-- shantz-wp-qotd {option} -->`" anywhere in your post (without the quotes).
Note:
1. {option} (including the braces) has to be replaced by the quote pattern that you want: qotd, qottd or r. qotd is quote of the day, qottd is quote of that day and r is random.
2. The tag has to be added using the code editor and not the visual editor, otherwise it will replace the <, > with their HTML equivalents.

= How to use the custom separator/multi-line quotes? =
By default, if you leave the custom separator box blank, the plugin uses a newline character as the separator. However, if you have quotes that have multiple lines, you can change this to a tag of your choice, say [quote]. Now, in your quotes file (or quotes pasted in admin panel options) add this tag at the end of each quote and you are done.

= What is the format for saving quotes? =
In text box in admin page, as well as in the file, the quotes have to be saved as one on each line. Each quote is separate by newline.

= Where is the file with quotes located =
For the get from file option, a file "quotes.txt" has to be present in the same directory where shantz-wp-qotd.php is residing. A sample quotes.txt has been given with this plugin (with some quotes from southpark, simpsons, matrix and deus ex)

= I checked the option "exclude pages" but my pages are still displaying quotes =
Check your WordPress version. This option is effective only for Version 2.1 and above

= How to upgrade to a new version = 
Simply overwrite the old files with the new ones.

= My question isn't listed here =
Put it up at [shantz-wp-qotd home page](http://tech.shantanugoel.com/projects/wordpress/shantz-wordpress-qotd "My Technophilic Musings"). I will answer it at the earliest

== Screenshots ==
You can also see the plugin in action on [my site](http://tech.shantanugoel.com/projects/wordpress/shantz-wordpress-qotd "My Technophilic Musings")

1. Config Screen
2. Widget Config
3. Plugin in Action

You can also see the plugin in action on [my site](http://tech.shantanugoel.com/projects/wordpress/shantz-wordpress-qotd "My Technophilic Musings")

== Arbitrary section ==
For more updates, go to [shantz-wp-qotd home page](http://tech.shantanugoel.com/projects/wordpress/shantz-wordpress-qotd "My Technophilic Musings")

Version History/ChangeLog:

* Version 1.2.2
	* Fixed a bug because of which quotes were blank some times.

* Version 1.2.1
	* Option to exclude pages from displaying quotes is also compatible with wordpress version < 2.1

* Version 1.2.0
	* Added option to exclude pages from displaying quotes
	* Fixed a bug that quotes source selection checkboxes always remain checked after updating settings.
	* Cosmetic: Fixed a few spelling mistakes :)

* Version 1.1.0.1
	* Cosmetic: Changed readme.txt according to wp-extend standards

* Version 1.1.0
	* Added Custom tag support for adding quotes anywhere in your posts/pages
	* Added Custom quote separator support and multi-line quotes support

* Version 1.0.1
	* Fixed some styling related issues for text to be added before or after the quote displayed in the widget

* Version 1.0.0
	* Initial version

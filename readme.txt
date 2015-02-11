=== SpyThemes Easy Website Screenshots ===
Contributors: ambiantepl
Tags: screenshots, website screenshot, thumbnails, thumbnail
Donate link: http://spythemes.com/blog/easy-website-screenshots/
Requires at least: 3.9.3
Tested up to: 4.1
Stable tag: 1.0.0
License: GPLv2 or later

Generator of website screenshots with built-in cache engine that preserves bandwidth and speeds up the process. Customizable look and behaviour.

== Description ==
This plugin generates website screenshots.

Built-in cache engine preserves bandwidth and speeds up the process. You can set default image quality and maximum cache period. Plugin supports shortcode that let\'s you customize cache age and image quality per single screenshat. You can also add custom css class to every screenshot. 

Plugin uses AJAX so it doesn\'t block your website. AJAX loader image can be turned on and off.





== Installation ==
1. Upload the /spt-easy-website-screenshots folder to /plugins
2. Activate plugin

OR

1. Upload file spt-easy-website-screenshots.zip via \"Plugins\"->\"Add news\"-\"Upload\" form
2. Activate plugin

3. To change default settings go to the plugin options page at \"Settings\"->\"Easy website screenshots\"

== Frequently Asked Questions ==
1. How are the screeshots created?
The screenshots are taken from Google Page Insights API via AJAX call

2. What\'s cache for?
All screenshots are downloaded to /wp-content/uploads/spt-easy-website-screenshots-cache/ folder and served from there until the caching period expire. This makes the plugin much faster. 

3. How to place website screenshot in post/page?
Use [spt-shot u=\"foobar.foo\" c=\"60\" q=\"100\" s=\"my_left\"] shortcode; All parameters except u are optional.

u - website url; with or without http://; for SSL secured websites it might be necessary to include https:// part at the URL beginning
c - (optional) maximum cache period in seconds; 60 seconds in example; default: 7 days;
q - (optional) screenshot JPEG quality where 0 = worst and 100 = best; default: 80;
s - (optional) custom css class for selected screenshot

For more info and examples please visit the official homepage at http://spythemes.com/blog/easy-website-thumbnails/

== Screenshots ==
1. http://spythemes.com/blog/wp-content/uploads/2015/02/easy-website-screenshots-wordpress-plugin-s-full.jpg
2. http://spythemes.com/blog/wp-content/uploads/2015/02/easy-website-screenshots-wordpress-plugin-s-slogan.jpg

== Changelog ==
1.0.0 Initial release

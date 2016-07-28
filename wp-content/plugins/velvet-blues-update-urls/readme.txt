=== Velvet Blues Update URLs ===
Contributors: justingreerbbi
Donate link: https://justin-greer.com/
Tags: permalinks, urls, links, update links, move wordpress, location, update urls, update permalinks, move, link, url, permalink, excerpt, content links, excerpt links, custom field links, meta, post meta
Requires at least: 3.8
Tested up to: 4.6
Stable tag: 3.2.5
License: GPLv2 or later

Updates all urls and content links in your website.

== Description ==

If you move your WordPress website to a new domain name, you will find that internal links to pages and references to images are not updated. Instead, these links and references will point to your old domain name. This plugin fixes that problem by helping you change old urls and links in your website.

= Features: =
*   Users can choose to update links embedded in content, excerpts, or custom fields
*   Users can choose whether to update links for attachments
*   View how many items were updated

== Installation ==

Installation and uninstallation are extremely simple. You can use WordPress' automatic install or follow the manual instructions below.

= Installing: =

1. Download the package.
2. Extract it to the "plugins" folder of your WordPress directory.
3. In the Admin Panel, go to "Plugins" and activate it.
4. Go to Tools -> Update URLs to use it.

= Uninstalling: =

1. In the Admin Panel, go to "Plugins" and deactivate the plugin.
2. Go to the "plugins" folder of your WordPress directory and delete the files/folder for this plugin.

= Usage: =

Using this plugin is very simple. Once it has been activated, navigate to Tools -> Update URLs and follow the instructions.

== Frequently Asked Questions ==

= Why are my urls not updated? =

URLs are only replaced when an exact match is found. Be sure that you have entered the correct url and hit submit. (Note: Matching is case-sensitive.)    

= Why do I see the message "You do not have sufficient permissions to access this page"? =

Make sure that the plugin is activated and that you are an administrator level user.  

== Screenshots ==

1. The Admin screen for the plugin. screenshot-1.png

== Change Log ==

= 3.2.5 =
* This plugin is not maintained and updated by justingreerbbi (Justin Greer Interactive, LLC)
* Updated label ID for better UX when selecting url location options.
* Added use if is_serialized() to remove PHP NOTICES about offsets during url update process.
* Confirmed compatibility to with WP 4.6 and updated stable tag.

= 3.2.3 =
* Confirmed compatibility with WordPress 4.0.x releases.
* Updated readme file.

= 3.2.2 =
* Relocated Update URLs tab to Tools section. It is now found under Tools->Update URLs
* Added additional serialization checks for postmeta.

= 3.2.1 =
* Bug fixes.
* Added Turkish language file.

= 3.2 =
* Confirmed compatibility with WordPress 3.6.x releases.
* Added option to replace urls within Links.
* Updated success and error dialogs and other text throught plugin.

= 3.1 =
* Confirmed compatibility with WordPress 3.5 release.

= 3.0 =
* Confirmed compatibility with latest WordPress releases and added support for future versions.
* Redesigned interface.
* Added the ability to update links in custom fields.
* Improved security against potential cross-site attacks by adding nonces and a referrer check and added exit to script if accessed directly.
* New error messages and field validation.
* Made changing ALL GUIDs optional, and turned off by default.
* Internationalized plugin.
* Updated License to GPLv2 or later.
* Fixed Typos

= 2.0.1 =
* Confirmed compatibility with WordPress 3.1.x releases.
* Updated FAQs and Contributors.

= 2.0 =
* Added the ability to update links in excerpt fields.
* Updated code for full compatibility with WordPress 3.0 releases.

= 1.0.3 =
* Confirmed compatibility with recent WordPress releases.

= 1.0.2 =
* Fixed PHP short tag problem, so as to be compatible with all configurations.

= 1.0.1 =
* Fixed possible interactions with other plugins.
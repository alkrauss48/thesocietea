=== UpdraftPlus WordPress Backup Plugin ===
Contributors: Backup with UpdraftPlus, DavidAnderson, DNutbourne, aporter, snightingale
Tags: backup, restore, database backup, wordpress backup, cloud backup, s3, dropbox, google drive, onedrive, ftp, backups
Requires at least: 3.2
Tested up to: 4.7
Stable tag: 1.13.1
Author URI: https://updraftplus.com
Donate link: https://david.dw-perspective.org.uk/donate
License: GPLv3 or later

Backup and restoration made easy. Complete backups; manual or scheduled (backup to S3, Dropbox, Google Drive, Rackspace, FTP, SFTP, email + others).

== Description ==

<a href="https://updraftplus.com">UpdraftPlus</a> simplifies backups (and restoration). Backup into the cloud (Amazon S3 (or compatible), Dropbox, Google Drive, Rackspace Cloud, DreamObjects, FTP, Openstack Swift, UpdraftPlus Vault and email) and restore with a single click. Backups of files and database can have separate schedules. The paid version also backs up to Microsoft OneDrive, Microsoft Azure, Google Cloud Storage, SFTP, SCP, and WebDAV.

<strong>Top-quality:</strong> UpdraftPlus is the highest-ranking backup plugin on wordpress.org, with <strong>over a million currently active installs</strong>. Widely tested and reliable, this is the world's #1 most popular and mostly highly rated scheduled backup plugin. Millions of backups completed!

[vimeo https://vimeo.com/154870690]

* Supports WordPress backups to UpdraftPlus Vault, Amazon S3 (or compatible), Dropbox, Rackspace Cloud Files, Google Drive, Google Cloud Storage, DreamHost DreamObjects, FTP, OpenStack (Swift) and email. Also (via a paid add-on) backup to Microsoft OneDrive, Microsoft Azure, Google Cloud Storage, FTP over SSL, SFTP, SCP, and WebDAV (and compatible services, e.g. Yandex, Cubby, OwnCloud). Examples of S3-compatible providers: Cloudian, Connectria, Constant, Eucalyptus, Nifty, Nimbula, Cloudn.
* Quick restore (both file and database backups)
* Backup automatically on a repeating schedule
* Site duplicator/migrator: can copy sites, and (with add-on) duplicate them at new locations
* Restores and migrates backup sets from other backup plugins (Premium) (currently supported: BackWPUp, BackupWordPress, Simple Backup, WordPress Backup To Dropbox)
* Files and database backups can have separate schedules
* Remotely control your backups on every site from a single dashboard with UpdraftCentral - <a href="https://updraftcentral.com">hosted for you</a> or <a href="https://wordpress.org/plugins/updraftcentral/">self-hosted</a>
* Failed uploads are automatically resumed/retried
* Large sites can be split into multiple archives
* Select which files to backup (plugins, themes, content, other)
* Select which components of a backup to restore
* Download backup archives direct from your WordPress dashboard
* Database backups can be encrypted for security (Premium)
* Debug mode - full logging of the backup
* Internationalised (translations welcome - see below)
* <a href="https://updraftplus.com">Premium version and support available (including free remote backup storage) - https://updraftplus.com</a>
* Supported on all current PHP versions (5.2 - 7.1)

From our <a href="https://www.youtube.com/user/UpdraftPlus/videos">YouTube channel</a>, here's how to install:

https://www.youtube.com/watch?v=7ReY7Z19h2I&rel=0

= Don't risk your backups on anything less =

Your WordPress backups are worth the same as your entire investment in your website. The day may come when you get hacked, or your hosting company does, or they go bust - without good backups, you lose everything. Do you really want to entrust all your work to a backup plugin with only a few thousand downloads, or that has no professional backup or support? Believe us - writing a reliable backup plugin that works consistently across the huge range of WordPress deployments is hard.

= UpdraftPlus Premium =

UpdraftPlus Backup/Restore is not crippled in any way - it is fully functional for backing up and restoring your site. What we do have is various extra features (including site cloning), and guaranteed support, available <a href="https://updraftplus.com/">from our website, updraftplus.com</a>. See <a href="https://updraftplus.com/comparison-updraftplus-free-updraftplus-premium/">a comparison of the free/Premium versions, here</a>.

If you need WordPress multisite backup compatibility (you'll know if you do), <a href="https://updraftplus.com/shop/">then you need UpdraftPlus Premium</a>.

= UpdraftCentral - Remote control =

As well as controlling your backups from within WordPress, you can also control all your sites' backups from a single dashboard, with <a href="https://updraftcentral.com">UpdraftCentral</a>. UpdraftCentral can control both free and Premium versions of UpdraftPlus, and comes in two versions:

* Hosted dashboard: <a href="https://updraftplus.com/my-account/updraftcentral-remote-control/">a ready-to-go dashboard on updraftplus.com</a>, with 5 free licences for everyone (<a href="https://updraftcentral.com">read more here</a>).
* Host your own: Host the dashboard on your own WP install, with <a href="https://wordpress.org/plugins/updraftcentral/">the free self-install plugin</a>

= Professional / Enterprise support agreements available =

UpdraftPlus Backup/Restore is written by professional WordPress developers. If your site needs guaranteed support, then we are available. Just  <a href="https://updraftplus.com/shop/">go to our shop.</a>

= More premium plugins =

If you are in the market for other WordPress premium plugins (especially WooCommerce addons), then try our shop, here: https://www.simbahosting.co.uk/s3/shop/

= Are you multi-lingual? Can you translate? =

Are you able to translate UpdraftPlus into another language? Are you ready to help speakers of your language? UpdraftPlus Backup/Restore itself is ready and waiting - the only work needed is the translating. The translation process is easy, and web-based - go here for instructions: <a href="https://updraftplus.com/translate/">https://updraftplus.com/translate/</a>. (Or if you're an expert WordPress translator already, then just pick out the .pot file from the wp-content/plugins/updraftplus/languages/ directory - if you scan for translatable strings manually, then you need to get these functions: _x(), __(), _e(), _ex(), log_e()).

Many thanks to the existing translators - listed at: https://updraftplus.com/translate/

= Other support =

We hang out in the WordPress support forum for this plugin - https://wordpress.org/support/plugin/updraftplus - however, to save time so that we can spend it on development, please read the plugin's FAQs - <a href="https://updraftplus.com/support/frequently-asked-questions/">https://updraftplus.com/support/frequently-asked-questions/</a> - before going there, and ensure that you have updated to the latest released version of UpdraftPlus backup/restore.

== Installation ==

<a href="https://updraftplus.com/download/">Full instructions for installing this plugin.</a>

== Frequently Asked Questions ==

<a href="https://updraftplus.com/support/frequently-asked-questions/"><strong>Please go here for the full FAQs - there are many more than below.</strong></a> Below are just a handful which particularly apply to the free wordpress.org version, or which bear repeating.

= Can UpdraftPlus do (something)? =

Check out <a href="https://updraftplus.com/updraftplus-full-feature-list/">our full list of features</a>, and our <a href="https://updraftplus.com/shop/">add-ons shop</a> and <a href="https://updraftplus.com/comparison-updraftplus-free-updraftplus-premium/">free/Premium comparison table</a>.

= I found a bug. What do I do? =

Note - this FAQ is for users of the free plugin. If you're a paying customer, then you should go here: https://updraftplus.com/support/ - please don't ask question in the WordPress.Org forum about purchases, as that's against their rules.

Next, please make sure you read this FAQ through - it may already have the answer you need. If it does, then please consider a donation (e.g. buy our "No Adverts" add-on - <a href="https://updraftplus.com/shop/">https://updraftplus.com/shop/</a>); it takes time to develop this plugin and FAQ.

If it does not, then contact us (<a href="http://wordpress.org/support/plugin/updraftplus">the forum is the best way</a>)! This is a complex backup plugin and the only way we can ensure it's robust is to get bug reports and fix the problems that crop up. Please make sure you are using the latest version of the plugin, and that you include the version in your bug report - if you are not using the latest, then the first thing you will be asked to do is upgrade.

Please include the backup log if you can find it (there are links to download logs on the UpdraftPlus settings page; or you may be emailed it; failing that, it is in the directory wp-content/updraft, so FTP in and look for it there). If you cannot find the log, then I may not be able to help so much, but you can try - include as much information as you can when reporting (PHP version, your blog's site, the error you saw and how you got to the page that caused it, any other relevant plugins you have installed, etcetera). http://pastebin.com is a good place to post the log.

If you know where to find your PHP error logs (often a file called error_log, possibly in your wp-admin directory (check via FTP)), then that's even better (don't send multi-megabytes; just send the few lines that appear when you run a backup, if any).

If you are a programmer and can debug and send a patch, then that's even better.

= Anything essential to know? =

After you have set up UpdraftPlus, you must check that your WordPress backups are taking place successfully. WordPress is a complex piece of software that runs in many situations. Don't wait until you need your backups before you find out that they never worked in the first place. Remember, there's no warranty and no guarantees - this is free software.

= My enormous website is hosted by a dirt-cheap provider who starve my account of resources, and UpdraftPlus runs out of time! Help! Please make UpdraftPlus deal with this situation so that I can save two dollars! =

UpdraftPlus supports resuming backup runs right from the beginning, so that it does not need to do everything in a single go; but this has limits. If your website is huge and your web hosting company gives your tiny resources on an over-loaded server, then go into the "Expert settings" and reduce the size at which zip files are split (versions 1.6.53 onwards). UpdraftPlus is known to successfully back up websites that run into the multiple-gigabytes on web servers that are not resource-starved.

= My site was hacked, and I have no backups! I thought UpdraftPlus was working! Can I kill you? =

No, there's no warranty or guarantee, etc. It's completely up to you to verify that UpdraftPlus is creating your backups correctly. If it doesn't then that's unfortunate, but this is a free plugin.

= I am not running the most recent version of UpdraftPlus. Should I upgrade? =

Yes; especially before you submit any support requests.

= Do you have any other free plugins? =

Thanks for asking; yes, we've got a few. Check out this profile page - https://profiles.wordpress.org/DavidAnderson/ .

== Changelog ==

The <a href="https://updraftplus.com/news/">UpdraftPlus backup blog</a> is the best place to learn in more detail about any important changes.

N.B. Paid versions of UpdraftPlus Backup / Restore have a version number which is 1 higher in the first digit, and has an extra component on the end, but the changelog below still applies. i.e. changes listed for 1.13.1 of the free version correspond to changes made in 2.13.1.x of the paid version.

= 1.13.1 - 09/May/2017 =

* REFACTOR: Completed re-factoring of the remote storage modules, so that now all remote storage code has completed this current stage of re-factoring (more to come in future - laying the foundation for a significant new feature)
* FIX: Added a nonce to the Dropbox deauth link. This is a minor security issue - someone personally targetting you, who knew that you were logged in to your WordPress admin, and who could persuade you to visit a personally-crafted web page, could cause the connection between UpdraftPlus and your Dropbox to be broken. The only impact of this is that the sending of your next backup to Dropbox would fail, and you would be alerted about the need to re-connect.
* FIX: Import settings now handle the new remote storage options format
* TWEAK: Added a version check when saving settings to prevent errors or lost settings
* TWEAK: 'Existing Backups' table now shows an icon for each remote destination that the backup was sent to
* TWEAK: Update SSL CA certificates file
* TWEAK: If, when uploading to S3, a file is not found, handle it slightly more elegantly
* TWEAK: Work with some WebDAV servers that previously sent empty responses to OPTIONS requests

= 1.12.40 - 01/Apr/2017 =

* TWEAK: The in-page log file display had stopped continuously updating in 1.12.32
* FIX: In some circumstances, settings for the storage modules refactored in 1.12.37 could fail to show
* FIX: The free version of 1.12.37/38 in some circumstances could fail to complete Dropbox authentication

= 1.12.38 - 31/Mar/2017 =

* TWEAK: Dropbox API v2 call to de-authorise a token was failing
* FIX: Prevent a fatal error when attempting to use a backup method with no options set

= 1.12.37 - 31/Mar/2017 =

* FEATURE: Browse the contents of a backup from within your WordPress dashboard, and (with Premium) download individual files from it
* FIX: Fix an issue that could occasionally cause corruption of interrupted Dropbox backups. All Dropbox users are recommended to update asap.
* TWEAK: Remove debugging statement inadvertently left in 1.12.36
* TWEAK: Re-factored remote storage handlers via add-ons so that there was a cleaner and more consistent class hierarchy (preparation for future improvements). N.B. If you subsequently downgrade to an older version of UpdraftPlus, you will need to re-enter the settings for some remote storage options.
* TWEAK: List of checksum algorithms run over backups and logged now includes SHA256, and is filterable (SHA1 now considered deprecated)
* TWEAK: Allow chunked database encryption to try and resume in the event of an error
* TWEAK: Improve the premium/extension tab content
* TWEAK: Fix an issue whereby the UpdraftVault settings section could show a bogus problem with checking quota immediately after initial setup
* TWEAK: When requesting a download, work around buggy browser/server that continued after Connection: close
* TWEAK: Improve the UI experience when downloading a log file for display fails
* TWEAK: Prevent PHP notice if another plugin cancels a cron event
* TWEAK: Tweak semaphore handling and enhance logging

= 1.12.35 - 03/Mar/2017 =

* FIX: Fix an issue causing corruption of interrupted Dropbox backups. All Dropbox users are recommended to update asap.
* TWEAK: Fix a regression that prevented information about a faulty WP scheduler from being shown in recent releases (incomplete fix in 1.12.34)
* TWEAK: submit_button() needs to be available (possible UpdraftCentral fatal when requesting filesystem creds)
* TWEAK: Remove an ES5 JavaScript construct (incompatible with some old browsers)
* TWEAK: Fix incorrect variable name in routine that triggered WP automatic update check
* TWEAK: Fix a logic error whereby if Google Drive and Google Cloud were both in use and partially set up, a notice about completing the setup of Cloud could fail to show

= 1.12.34 - 23/Feb/2017 =

* FEATURE: Added the ability to allow other plugins to call an automatic backup more easily
* FEATURE: Added the ability to select which tables you want to backup when using the 'Backup now' modal (Premium)
* FIX: Re-scanning a Dropbox that contained more than 1000 backup archives only fetched the first 1000 (this was previously awaiting on Dropbox fixing a related bug on their API servers).
* FIX: Escape table names to allow table names with hyphens in, when reading data
* FIX: The "Advanced Tools" tab was appearing with no contents if you chose an unwritable backup directory (regression)
* TRANSLATIONS: Remove bundled Swedish (sv), Spanish (Spain) (es_ES) and Czeck (Čeština‎, cs_CZ) translations, since these are now retrieved from wordpress.org.
* TWEAK: Prevent a JavaScript message being logged when loading UD infrastructure on non-UD settings pages (e.g. plugins that integrate to do backups via UD)
* TWEAK: Make it easier for other plugins to get/set UpdraftPlus options with less code
* TWEAK: Make sure that the get_plugins() function is available before using it when generating notices
* TWEAK: Add the updraftplus_exclude_directory and updraftplus_exclude_file filters allowing arbitrary backup exclusions from code
* TWEAK: Add a work-around for a bug in some server/Firefox combinations in handling of the Content-Length header with non-ASCII characters
* TWEAK: Cause an informational message to be shown in the Rackspace module if php-json is not enabled
* TWEAK: Fix a regression that prevented information about a faulty WP scheduler from being shown in recent releases
* TWEAK: Made alert regarding plupload's 'HTTP -200' error, when upload of file fails, more informative.
* TWEAK: Internal changes to the remote storage method API (future improvements which build on these are planned)

= 1.12.32 - 26/Jan/2017 =

* FEATURE: Add UpdraftCentral (https://updraftcentral.com) UpdraftVault listener
* FEATURE: Encryption and decryption is now chunked, meaning that large databases of any size can be encrypted without being prevented by memory limits
* FIX: Fix a bug whereby if a backup set containing a manual "more files" element was imported via a remote scan, then an error would show concerning it when attempting to restore.
* FIX: On certain combinations of changing the "more files to back up" settings, these changes might not be reflected in the "Backup Now" dialog without a page reload
* FIX: Remove a PHP 5.5+-only construction that crept into 1.12.31
* TWEAK: Allow UpdraftCentral command classes to provide commands via the __call method
* TWEAK: Move the existing backups table into the templating system
* TWEAK: When trying to restore before cleaning up a previous restore, the detailed error message shown needed tweaking
* TWEAK: Some refactoring of the dashboard JavaScript, to abstract/harmonise all AJAX calls
* TWEAK: Removed the triple click and replaced it with standard double click
* TWEAK: Some refactoring of the UpdraftCentral command interface, to facilitate reduction of duplicated dashboard control code
* TWEAK: One less HTTP round-trip when deleting from the dashboard
* TWEAK: Updated advanced tools to allow UpdraftCentral to use wipe settings and export / import
* TWEAK: Revamped the 'Premium / Extensions' tab in the free version
* TWEAK: Work around HTTP 400 error from Dropbox on servers with several-year old version of curl, caused by bad interaction between curl and Dropbox over a specific header
* TWEAK: Add a notice advising of WP-Optimize (https://wordpress.org/plugins/wp-optimize/) to the available notices
* TWEAK: Prevent an unwanted PHP log notice when using Google Drive
* TWEAK: More file directories are now added using a directory browser
* TWEAK: Update plugin update checker library (paid versions) to version 3.1, which fixes some PHP 7 issues

= 1.12.30 - 23/Dec/2016 =

* FIX: Fix a Dropbox APIv2 issue where paths containing certain characters were incorrectly being encoded
* FEATURE: Add UpdraftCentral (https://updraftcentral.com) comment-control and advanced tools listeners 
* TWEAK: Starting an operation to retrieve a remote backup from UpdraftCentral succeeded, but gave a UI error in UC when doing so
* TWEAK: Fix a Dropbox APIv2 issue where Team storage displayed an incorrect value
* TWEAK: Support for the new AWS S3 Canada Central 1 and London regions
* TWEAK: Some re-factoring of the settings page output code for easier maintenance
* TWEAK: Some re-factoring of the notices code, to allow re-use in other projects
* TWEAK: Make sure that a UpdraftCentral_Commands class is available before loading any external command classes, so that they can rely on its presence

1.12.29 - 22/Nov/2016

* FIX: Fix a PHP error in the notices code (regression in 1.12.28)
* FIX: Manual database search and replace now outputs logged operation information (regression in 1.12.28)

1.12.28 - 21/Nov/2016

* TWEAK: The UPDRAFTPLUS_DROPBOX_API_V1 constant will be ignored from 28th June 2017 (when Dropbox turn off that API entirely)
* TWEAK: A new internal infrastructure for handling user-visible notices in the dashboard and reports
* TWEAK: Small layout tweak to fix a malformatted error message

1.12.27 - 17/Nov/2016

* FIX: The WP 4.7 compatibility tweak in 1.12.26 introduced a regression that caused the question to appear when unwanted on other WP versions.

1.12.26 - 16/Nov/2016

* COMPATIBILITY: On WordPress 4.7, the behaviour of shiny updates has changed, necessitating a small tweak to prevent an unwanted "do you really want to move away from this page?" question from the browser on the updates/plugins pages in some situations.
* TWEAK: When the Dropbox quota state seems to imply that the next upload will fail, do not register this as an error before it actually happens.
* TWEAK: When an error occurs when re-scanning Dropbox, make sure the error details are logged in the browser developer console
* FIX: Fix ability to rescan a Dropbox sub-folder (regression in 1.12.25)

= 1.12.25 - 12/Nov/2016 =

* COMPATIBILITY: Dropbox APIv2 capability (see: https://updraftplus.com/dropbox-api-version-1-deprecation/) in 1.12.24 was not complete - this release now avoids all APIv1 use
* TWEAK: The 'site information' advanced tool now contains information on loaded Apache modules.
* TWEAK: Small layout tweak to fix a malformatted error message

= 1.12.24 - 08/Nov/2016 =

* FIX: When importing a single site into a multisite install as a new site (experimental feature), the main multisite URL was being incorrectly adjusted
* FIX: Fix a bug with remote scans not returning more database archives correctly
* COMPATIBILITY: Add Dropbox APIv2 capability (see: https://updraftplus.com/dropbox-api-version-1-deprecation/)
* FEATURE: Look for mysqldump.exe in likely locations on Windows, for faster database backups
* TWEAK: UpdraftVault, Amazon S3 and DreamObjects downloaders have been rewritten without race conditions
* TWEAK: Introduce an abstraction layer for reporting on the status of restore operations
* TWEAK: Deleting remote backup sets from the dashboard is now batched for sets with many archives, to avoid potential PHP timeouts on slow remote services
* TWEAK: Updated bundled phpseclib library to version 1.0.4
* TWEAK: Introduce an internal templating layer, for improved long-term maintainability
* TWEAK: When importing a single site into a multisite install as a new site, remove any cron entries for backup runs on the new site
* TWEAK: Fix an inconsequential off-by-one in the chunked downloading algorithm so that the behaviour is as documented
* TWEAK: Improve accessibility of Labelauty components with keyboard navigation
* TWEAK: Tweak the algorithm for scheduling resumptions, to improve efficiency in the (once) seen corner-case of PHP usually having a predictable run-time, but with an instance of a much longer run-time
* TWEAK: Slightly more logging when an S3 error condition occurs, allowing easier diagnosis
* TWEAK: Add support for the new US East (Ohio) region to S3
* TWEAK: OneDrive authentication can now detect a block by CloudFlare, and direct the user accordingly
* TWEAK: If there are remote storage methods needing authentication, then pop up a box showing this to the user - so that it does not rely on them spotting the dashboard notice or having read the instructions

= 1.12.23 - 04/Oct/2016 =

* FIX: Fix a bug in URL replacement when cloning from a flat configuration to a WP-in-own-directory configuration
* FIX: The button for testing connections to extra databases added to the backup was not working
* FIX: Direct dashboard logins from UpdraftCentral were not working on WP 3.2 - 3.4 sites
* COMPATIBILITY: Will upgrade Dropbox OAuthv1 tokens to OAuthv2 (to handle Dropbox API v1 deprecation in summer 2017)
* TWEAK: Deleting an already-deleted backup set from UpdraftCentral now produces a more informative error message
* TWEAK: When restoring only a single site out of a multisite install, store less data in memory on irrelevant tables, and do less logging when skipping tables
* TWEAK: Update bundled UDRPC library to version 1.4.9 - fixes a bug with the admin URL used for contact via UpdraftCentral on multisite
* TWEAK: Explicitly store the UpdraftPlus object as a global
* TWEAK: Prevent a pointless "unsaved settings" warning if settings were changed then the 'wipe' button used
* TWEAK: When using the Importer add-on, allow backups from WordPress Backup to Dropbox to be wrapped in an extra 'wpb2d' folder
* TWEAK: Strengthen protections against resuming an already-complete backup after migration on servers with misbehaving WP schedulers
* TWEAK: Touch already-existing but incomplete files being downloaded, to reduce possibility of two processes downloading at once
* TWEAK: Add a link to more information about UpdraftCentral in the advanced tool
* TWEAK: The UPDRAFTPLUS_MYSQLDUMP_EXECUTABLE define can now be used on Windows (you will need to define a path to take advantage of it)
* TWEAK: Introduce the UPDRAFTPLUS_SKIP_CPANEL_QUOTA_CHECK constant to allow skipping of trying to check cPanel quota

= 1.12.21 - 08/Sep/2016 =

* FIX: Fix a bug in the updater code that caused updates checks to be run more often than intended
* TWEAK: Improve/tidy layout of the "Advanced Tools" tab
* TWEAK: Make it more obvious in the file uploading widget when an upload is 100% complete
* TWEAK: Prevent spurious OneDrive message being shown when re-scanning remote storage and not using OneDrive
* TWEAK: OneDrive storage now uses the refresh token yes frequently (less HTTP calls)

= 1.12.20 - 29/Aug/2016 =

* FEATURE: OpenStack uploads (including Rackspace Cloudfiles) can now adapt their upload rate to network conditions, leading to much faster uploads on many networks
* FEATURE: Updated the OneDrive configuration to make it easier to setup. A custom Microsoft Developer App is no longer required
* FEATURE: The "Advanced Tools" tab now has tools for importing and exporting settings
* TWEAK: Honour the "do not verify SSL certificates" setting with WebDAV storage on PHP 5.6+
* TWEAK: When there's a connection problem to updraftplus.com when claiming licences, provide more error info and guidance
* TWEAK: In particular circumstances (malfunctioning WP scheduler, expert option to keep backups after despatching remotely selected (non-default)), zips could be sent to Google Drive more than once
* TWEAK: Tweak issue in 1.12.18 with automatic backup pop-up appearing under another pop-up if you update themes via the themes pop-up (instead of the direct link)
* TWEAK: When rescanning remote storage, don't log a potentially confusing message for an unconfigured storage module
* TWEAK: Show a visual indicator and advice if an invalid hostname is entered for WebDAV
* TWEAK: Removed the no-longer-useful debug backup buttons
* TWEAK: Add a message when generating a key on a server without php-openssl, with information about how to make it faster
* TWEAK: Prevent PHP installs which print PHP logging information to the browser from messing up the WebDAV settings in some situations
* TWEAK: If PHP reports the current memory limit as a non-positive integer, do not display any message to the user about a low memory limit
* TWEAK: If the user deletes their Google API project, then show clearer information on what to do when a backup fails
* TWEAK: If you changed your OneDrive client ID, UD will now more clearly advise you of the need to re-authenticate
* COMPATABILITY: Updated the OneDrive authentication procedure to make it compatible with the new Microsoft Developer Apps

= 1.12.18 - 03/Aug/2016 =

* TWEAK: When Microsoft OneDrive quota is insufficient, the advisory message from UD now includes the available quota (as well as the used)
* FEATURE: The Azure add-on/Premium now supports new-style Azure storage, as well as classic
* FEATURE: The Rackspace enhanced wizard can now be accessed via UpdraftCentral
* TWEAK: Fix a regression in recent WP versions which caused remote keys to not always be retained after a migration
* TWEAK: When logging Azure upload locations, include the account name
* TWEAK: Make the entering of settings for WebDAV more user-friendly
* TWEAK: Update bundled select2 to version 4.0.3
* TWEAK: Clarify error message when a 'more files' location is not found
* TWEAK: Add redirection_404 to the list of tables likely to be large, and not needing search/replacing
* COMPATIBILITY: Compatible with WP 4.6 (previous paid versions have incompatibilities with the changes made to 'shiny updates/installs/deletes' in WP 4.6)

= 1.12.17 - 19/Jul/2016 =

* FIX: Previous free release included empty translation files
* TWEAK: Add 'snapshots' to the default list of directories to exclude from the uploads backup (is used by another backup plugin - avoid backups-of-backups)
* TWEAK: Add et_bloom_stats to the list of tables likely to be large, and not needing search/replacing

= 1.12.16 - 07/Jul/2016 =

* TWEAK: Log FTP progress upload less often (slight resource usage improvement)
* TWEAK: For multi-archive backup sets, the HTML title attribute of download buttons had unnecessary duplicated information
* TWEAK: Improve OneDrive performance by cacheing directory listings
* TWEAK: Detect and handle a case in which OneDrive incorrectly reports a file as incompletely uploaded
* FIX: OneDrive scanning of large directories for existing backup sets was only detecting the first 200 files

= 1.12.15 - 06/Jul/2016 =

* TWEAK: S3 now supports the new Mumbai region
* TWEAK: If the user enters an AWS/S3 access key that looks prima facie invalid, then mention this in the error output
* TWEAK: Make the message that the user is shown in the case of no network connectivity to updraftplus.com when connecting for updates (paid versions) clearer
* TWEAK: Extend cacheing of enumeration of uploads that was introduced in 1.11.1 to other data in wp-content also
* TWEAK: Avoid fatal error in Migrator if running via WP-CLI with the USER environment variable unset
* TWEAK: When DB_CHARSET is defined but empty, treat it the same as if undefined
* TWEAK: Add updraftplus_remotesend_udrpc_object_obtained action hook, allowing customisation of HTTP transport options for remote sending
* TWEAK: Introduced new UPDRAFTPLUS_RESTORE_ALL_SETTINGS constant to assist in complicated load-balancing setups with duplicate install on the same URL
* TWEAK: Update bundled tripleclick script to fix bug in teardown handler
* TWEAK: Update bundled UDRPC library to version 1.4.8
* TWEAK: Patch Labelauty to be friendly to screen-readers
* TWEAK: Suppress the UD updates check on paid versions that immediately follows a WP automatic core security update
* TWEAK: Handle missing UpdraftCentral command classes more elegantly
* FEATURE: Endpoint handlers for forthcoming updates and user mangement features in UpdraftCentral
* TRANSLATIONS: Remove bundled German (de_DE) translation, since this is now retrieved from wordpress.org
* FIX: Fix inaccurate reporting of the current Vault quota usage in the report email
* FIX: Fix logic errors in processing return codes when no direct MySQL/MySQLi connection was possible in restoring that could cause UpdraftPlus to wrongly conclude that restoring was not possible

= 1.12.13 - 07/Jun/2016 =

* TWEAK: Default the S3 secret key field type to 'password' instead of 'text'
* TWEAK: Do more checks for active output buffers prior to spooling files to the browser (to prevent memory overflows)
* TWEAK: Update bundled UDRPC library to version 1.4.7

= 1.12.12 - 25/May/2016 =

* FIX: When restoring a plugins backup on multisite, old plugins were inactivated but not always removed
* TWEAK: Use POST instead of GET for OneDrive token requests - some new accounts seem to have begun requiring this
* TWEAK: When backing up user-configured directories, don't log confusing/misleading messages for unzippable directory symlinks
* TRANSLATIONS: wordpress.org is now serving up translations for fr_FR, pt_PT and ro_RO, so these can/have been removed from the plugin zip (1.2Mb released)

= 1.12.11 - 19/May/2016 =

* FIX: 1.12.8 (paid versions only) contained a regression that prevented S3 access if the user had a custom policy that did not include location permission. This fix means that the work-around of adding that permission to the policy is no longer required.
* FIX: Fix a regression in 1.12.8 that prevented non-existent DreamObjects buckets from being created
* FIX: Fix inaccurate reporting of the current Vault quota usage in the report email since 1.12.8
* FIX: The short-lived 1.12.10 had a duplicate copy of the plugin in the release zip
* TWEAK: Detect a particular obscure PHP bug in some versions that is triggered by the Amazon S3 SDK, and automatically switch to the older SDK if it is hit (N.B. Not compatible with Frankfurt region).
* TWEAK: Audit/update all use of wp_remote_ functions to reflect API changes in the upcoming WP 4.6
* TWEAK: Tweak to the settings saving, to avoid a false-positive trigger of a particular rule found in some mod_security installs
* TWEAK Update bundled UDRPC library to version 1.4.5

= 1.12.9 - 11/May/2016 =

* FIX: In yesterday's 1.12.8, some previously accessible Amazon S3 buckets could no longer be accessed

= 1.12.8 - 10/May/2016 =

* FEATURE: Support S3's "infrequent access" storage class (Premium)
* FIX: Fix bug in SFTP uploading algorithm that would corrupt archives if a resumption was necessary
* TWEAK: Add information on UpdraftVault quota to reporting emails
* TWEAK: Update the bundled AWS library to version 2.8.30
* TWEAK: Update the bundled Symfony library to version 2.8.5
* TWEAK: Update the bundled phpseclib library to version 1.0.2 (which includes a fix for SFTP on PHP 5.3)
* TWEAK: Improve the overlapping runs detection when writing out individual database tables, for helping servers with huge tables without mysqldump
* TWEAK: Prevent restoration from replacing the local record of keys of remote sites to send backups to (Migrator add-on)
* TWEAK: Re-order the classes in class-zip.php, to help misbehaving XCache (and perhaps other opcode cache) instances
* TWEAK: Do not include transient update availability data in the backup (which will be immediately out-of-date)
* TWEAK: Updated the URLs of various S3-compatible providers to use SSL, where available
* TWEAK: Added an endpoint drop-down for Dreamobjects, using their new/updated endpoint (currently only one choice, but they will have more in future)
* TWEAK: Suppress a log message from UpdraftVault when that message is not in use
* TWEAK: When key creation times out in the Migrator, display the error message in the UI

= 1.12.6 - 30/Apr/2016 =

* FIX: UpdraftVault quota usage was being shown incorrectly in recounts on sites connected to accounts backing up multiple sites
* TWEAK: In accordance with Barracuda's previous announcement, copy.com no longer exists - https://techlib.barracuda.com/CudaDrive/EOL
* TWEAK: Allow particular log lines to be cancelled
* TWEAK: Explicitly set the separator when calling http_build_query(), to prevent problems with non-default configurations
* TWEAK: Tweak the algorithm for sending data to a remote UD installation to cope with eventually-consistent filesystems that are temporarily inconsistent
* TWEAK: Make the automatic backups advert prettier
* TWEAK: Detect and combine file and database backups running on different schedules which coincide
* TWEAK: Update bundled Select2 to version 4.0.2
* TWEAK: Update UDRPC library to version 1.4.3

Older changes are found in the changelog.txt file in the plugin directory.

== Screenshots ==

1. Main dashboard - screenshots are from UpdraftPlus Premium, so may reference some features that are not part of the free version

2. Configuring your backups

3. Restoring from a backup

4. Showing and downloading backup sets


== License ==

    Copyright 2011-16 David Anderson

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

Furthermore, reliance upon any non-English translation is at your own risk. UpdraftPlus can give no guarantees that translations from the original English are accurate.

We recognise and thank the following for code and/or libraries used and/or modified under the terms of their open source licences; see: https://updraftplus.com/acknowledgements/


== Upgrade Notice ==
* 1.13.1: Complete remote storage module re-factoring. Minor Dropbox security fix. Fix import settings function. Other small tweaks.

=== Plugin Name ===
Contributors: StephenCronin
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sjc@scratch99.com&currency_code=&amount=&return=&item_name=WP-KeywordLuv
Tags: dofollow, keywordluv
Requires at least: 2.8.0
Tested up to: 3.8
Stable tag: 3.0
License: GPLv2 or later
Reward your commentators by separating their name from their keywords, in the link to their website, giving them improved anchor text.

== Description ==
Reward your commentators by separating their name from their keywords, in the link to their website, giving them improved anchor text. For example, leaving "Stephen @ Custom WordPress Plugins" in the name field, will result in the following: Stephen from [Custom WordPress Plugins](http://scratch99.com/services/). Requires a DoFollow plugin to be effective.

= WARNING =
**The KeywordLuv plugin is no longer recommended for use.**

**What was a great idea in 2008 is no longer effective and may even be harmful in 2014. Your commentators will not receive any benefit. In fact, if most of their links come from comments, they are likely to be penalised by Google. Additionally, if you have many low quality comments on your site, it may even affect your ranking.**

**If you are not yet using KeywordLuv, please do not start using it.**

**If you are already using KeyworldLuv, it is recommended that you update to the latest version and switch the plugin into reverse mode on the Settings page. Comments will remain in the system, but will revert to using the name for comments using the KeywordLuv syntax, which may help.**

= Original Idea =
There are many articles about the value of having your keywords in the anchor text of backlinks to your site. This helps your site rank well for those keywords with the search engines, bringing you more traffic. 
One source of backlinks are comments on DoFollow blogs, but the anchor text is normally your name. While this helps you rank well for your name, it's practically worthless for your keywords. That's why some commentators put keywords in the name field, but they risk being marked as spammers.
I understand people's desire to get the best value from their link, but I'm tired of answering comments with "Hi Miami Hotels". I'd like them to leave their name, without it effecting their keyword benefit. Enter KeywordLuv... 
By using KeywordLuv (and a Dofollow plugin) you give your commentators better links, rewarding them and encouraging more people to comment. 

= Spam =
I originally intended this as something to help out my regular commentators, but the plugin was quickly picked up on by spammers. Using this plugin is likely to increase comments on your site, but it is likely to be spammers who are after the link. Use at your own risk.

= Effectiveness in 2012 =
This plugin was effective back in 2008 when it was released, but now has less effect (if any). Google passes very little value for comment links these days. In fact, if a high percentage of the people leaving comments on your blog are linking to low value sites, it could hurt your site. In addition, if all of a commentators inbound links are from blog comments, there is good chance it could actually hurt your commentators too. Use at your own risk!

= Dofollow =
For your commentators to benefit from KeywordLuv, your blog REQUIRES A SEPARATE DOFOLLOW PLUGIN to remove the nofollow tag. KeywordLuv does not do this and without it, YOUR COMMENTATORS WILL NOT RECEIVE ANY BENEFIT. While KeywordLuv could remove the nofollow tag, there are many existing plugins that do this AND provide advanced features I don't want to replicate.

= Compatibility: dofollow plugins =
KeywordLuv hasn't been tested with most DoFollow plugins but problems are very unlikely. If you do encounter any, please let me know.

= Compatibility: WordPress themes =
There is a compatibility issue with some themes. If your theme uses comment_author_link() to retrieve the comment author link, KeywordLuv will work fine. If it uses comment_author() and comment_author_url() to build the comment author link, then it will do nothing.
This issue, along with the possible workarounds, is outlined on the [Theme Compatibility Issue page](http://scratch99.com/wordpress-plugin-keywordluv/keywordluv-theme-compatibility-issue/).

= Usage =
When your readers leave a comment, they should leave their name and keywords in the Name field, using the following format: name@keywords.
When posts are displayed, the plugin searches for the @ character, strips it out and moves the name to front (outside the link).

= Telling your commentators =
This plugin is really to help your commentators, so you need to tell them how to use it. By default, the plugin adds a message to the comment form telling users to enter YourName@YourKeywords in the comment field. You can customise this message in the KeywordLuv options page in the Admin area.
Note: This message does not appear if you are logged in, as logged in users normally don't have a Name field to enter YourName@YourKeywords into.
The problem with this message is that there is no way to control exactly where it will appear. It depends on your theme. In some themes, it may not appear at all.
If you are comfortable editing your theme, the best solution is for you to disable the message (in the KeywordLuv options page in the Admin area) and add your own message exactly where you want it (in comments.php). 

= If you disable the plugin =
Whatever the commentator enters in the Name field is what's actually stored in the database. KeywordLuv simply changes the way it's displayed. If you decide you no longer want to use the plugin, simply deactivate it and commentator's names will revert to what's in the database. For example, if they enter "Stephen@Custom WordPress Plugins", that's what's stored. If the plugin is active, it will display:
	"Stephen from [Custom WordPress Plugins](http://scratch99.com/services/) Says:"
If the plugin is disabled, it will display:
	"[Stephen@Custom WordPress Plugins](http://scratch99.com/services) Says:"

= Acknowledgments: =
* Thanks to Julio Potier, a [WordPress Security Consultant](http://secu.boiteaweb.fr/), for his advice on security issues

= Support: =
This plugin is officially not supported (due to my time constraints), but if you [contact me](http://scratch99.com/contact/), I will try to help if I can (no promises).

= Disclaimer =
This plugin is released under the [GNU General Public License](http://www.gnu.org/copyleft/gpl.html) version 2 or later. I do not accept any responsibility for any damages or losses, direct or indirect, that may arise from using the plugin or these instructions. This software is provided as is, with absolutely no warranty. Please refer to the full version of the GPL license for more information.

== Installation ==
1. Download the plugin file and unzip it.
1. Upload the `keywordluv` folder to the `wp-content/plugins/` folder.
1. Activate the KeywordLuv plugin within WordPress.
Alternatively, you can install the plugin automatically through the WordPress Admin interface by going to Plugins -> Add New and searching for KeywordLuv.

== Upgrade Notice ==
It is recommended that you update this plugin through the WordPress Admin interface.

== Changelog ==

= 3.0 (2 January 2014) =
* Added a warning that using the plugin in 2014 may actually have a negative SEO effect.
* Added the ability to reverse the effect for comments using the KeywordLuv syntax, so real names are shown instead of keywords.

= 2.1 (18 February 2013) =
* Security enhancement: minimising risk from security flaw (high impact, but low risk, currently unexploitable).
* Security enhancement: escaping output where possible, ensuring user input can't cause any harm.
* Bug fix: Fixed longstanding problem with commentators who do not leave link.

= 2.0 (19 July 2012) =
* Updated version number to flag update (1.1 is not > 1.03 apparently).
* Includes all changes from 1.1 as well:
 * Removed link to plugin home page, which now 404s.
 * Removed redundant version check functionality, no longer needed as WordPress handles this now.
 * Optimised code to minimise memort usage.
 * Admin styles improved to fit current version of WordPress.
 * Improved code readability.
 * Other improvements inline with WordPress best practice.

= 1.1 (19 July 2012) =
* Removed link to plugin home page, which now 404s.
* Removed redundant version check functionality, no longer needed as WordPress handles this now.
* Optimised code to minimise memort usage.
* Admin styles improved to fit current version of WordPress.
* Improved code readability.
* Other improvements inline with WordPress best practice.

= 1.03 (7th April 2008) =
* Now works better with the CommentLuv plugin. CommentLuv wasn't stripping the keywords from the YourName's Last Blog Post phrase, which looked a little strange. KeywordLuv now intercepts the comment before it's written and strips the keywords out (only in the comment body).

= 1.02 (3rd April 2008) =
* Reverted to the original logic from 1.0, with the new logic from 1.01 being incorporated into a Compatibility Mode. This means the majority of users can run in normal mode which has no problems, while people with incompatible themes can run Compatibility Mode which has an issue (see http://scratch99.com/keywordluv-theme-compatibility-issue/)

= 1.01 (1st April 2008) =
* Placed comment form message inside paragraph tags to stop it running into other comment form messages
* Rewrote the logic and created the keywordluv_name() function to help people who have incompatible themes

= 1.0 (30th March 2008) =
* Initial Release


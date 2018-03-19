=== Hatchbuck ===
Contributors: projectarmy,viktorix,supporthero
Tags: hatchbuck,crm,marketing automation,forms,website tracking,projectarmy,embed forms,sales,leadgen,lead generation,pop ups,scroll box
Donate link: https://www.projectarmy.net
Requires at least: 3.0
Tested up to: 4.9.4
Stable tag: 1.3.2
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Integrate Hatchbuck with your WordPress website to capture and nurture more leads.

== Description ==
Hatchbuck for WordPress allows you to easily embed Hatchbuck forms inside any pages or posts using simple shortcodes. It makes it very easy to insert website tracking code on any page, post or site-wide. We've added some extra tools to help Hatchbuckers capture more leads and build their email lists. **ProjectArmy is a certified Hatchbuck partner.**

= Features =
Current version includes:

* Embed Hatchbuck forms with shortcodes anywhere in WordPress
* Insert website tracking code on any page, post or site-wide
* Admin toolbar shortcuts to your Hatchbuck app
* Scroll box to capture more leads (NEW)
* Addons to extend plugin's functionality

= Todo =
This is what we got so far on our road map:

* Gravity Forms integration
* Additional lead generation tools
* Possibly form analytics

= Support =
Submit your issues, feedback, and suggestions in the WordPress support forum.

= Additional Resources =
For additional information and resources:

* Visit [ProjectArmy](https://www.projectarmy.net/) to learn how we can help you turn your WordPress into a lead generating machine.
* Visit [Hatchbuck](http://www.hatchbuck.com/) to learn more about marketing automation and sales software.

= Special Thank You =
This plugin is based on [Insert HTML Snippet](https://wordpress.org/plugins/insert-html-snippet/) plugin by [f1logic](https://profiles.wordpress.org/f1logic/).

== Installation ==
1. Visit "Plugins" page and click on "Add New".
1. In the search box, search for "Hatchbuck".
1. Click on "Install" button.
1. Click on "Activate" link.
1. Once activated, you will have a new menu option called "Hatchbuck".

Plugin includes a video tutorials. Visit "Help" tab to watch them. You can find all video on our [Youtube channel](https://www.youtube.com/channel/UCMtWvpEKuxpy-c5mHTLSF4g).

== Frequently Asked Questions ==
= How do I embed form shortcode into my template file? =

Please use `do_shortcode()` function. For example: `<?php echo do_shortcode('[hatchbuck form="HTML-form"]'); ?>`

= Where do I find Hatchbuck API keys? =

Go to Account Settings > Data > API to get API key.
Go to Account Settings > Data > API > Tags to get a specific tag key.

= Will Hatchbuck track scroll box subscribers? =

At this point no. Hatchbuck API does not allow to set a tracking cookie, so we can't track visitors that completed scroll box form. The moment Hatchbuck allows cookie to be set in API, we'll add that functionality.

**Tip:** Add an email confirmation for scroll box subscribers, asking them to click on a link in your email to confirm subscription. When they click that link, Hatchbuck will begin tracking them.

= Where can I get support? =

Please visit "Support" tab above to request help on WordPress.org forums. We try to respond in a timely fashion.

= Can you style and/or create forms for me? =

Yes, we can help you with Hatchbuck forms. We can style them any way you like, help you reduce spam submissions, create multi-step forms, and much more. [Contact us with your request &raquo;](https://www.projectarmy.net/value/hatchbuck-consultation/)

= Where can I submit bugs and/or feature requests? =

Visit plugin's [GitHub page](https://github.com/ProjectArmy/Hatchbuck-for-WordPress/issues) to submit bugs and feature requests.

== Screenshots ==
1. This is the main page where you can add and manage your Hatchbuck forms.
2. Plugin addons page where you can enable and disable addons.
3. Insert shortcode on any page/post through visual editor.
4. Scroll box addon settings page and scroll box screenshot.

== Changelog ==

= 1.3.2 =
* wp_enqueue_script/style was called incorrectly in admin/menu.php (Bug #9)
* WP Widget uses __construct now to improve compatability
* Improved compatability with PHP 7.2, older PHP versions will still use create_function

= 1.3.1 =
* Fixed PHP notice issue
* Updated sidebar

= 1.3 =
* New addon: **Scroll box** with Hatchbuck API
* New addon: Site-wide tracking
* Updated settings, text and help section
* Added ACE Editor to highlight syntax when adding forms
* Cleaned up code and UI
* Updated branding to match new Hatchbuck logo

= 1.2.3 =
* Fixed PHP 7.0 compatability issue

= 1.2.2 =
* Fixed add_query_arg vulnerability
* Fixed issue with orange button setting (Bug #3)
* Limited hatchbuck.js to admin, so it doesn't show in frontend

= 1.2.1 =
* Fix for metabox issue certain users have

= 1.2 =
* Fixed metabox error/issue

= 1.1 =
* Fixed and consolidated javascript fixing possible bug with another plugin (Bug #2)
* Added new page Addons
* Added new setting to enable/disable tracking metabox per post type
* Added first Addon: Form Widget to display forms in sidebars

= 1.0 =
Initial release.

== Upgrade Notice ==

= 1.3 =
Check your page tracking code after upgrade. We highly recommend switching to "Site Wide Tracking", instead of "Page Specific Tracking". Plus, watch new video tutorials. We've added a new scroll box feature.
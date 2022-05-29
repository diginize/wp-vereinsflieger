=== WP Vereinsflieger ===
Text Domain: wp-vereinsflieger
Domain Path: /languages
Contributors: skennecke
Donate link: https://paypal.me/diginize
Tags: SSO, Vereinsflieger, Luftsport
Requires at least: 5.0
Tested up to: 6.0
Stable tag: 1.1.0
Requires PHP: 7.2.5
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Single-Sign-On for Vereinsflieger.de

== Description ==

This plugin allows users to login with their existing account on Vereinsflieger.de.

Features:

* Login using your Vereinsflieger.de account
* No extra registration for your members needed
* Works with enabled 2 factor authentication
* Keeps your wordpress account up to date (name, email, ...)
* Prevents disabled users from Vereinsflieger.de to login

To get this plugin to work you have to request an app key from the Vereinsflieger.de support. You also need to know your club's CID which you can find in the administration area of your Vereinsfieger.de account.

Disclaimer: Vereinsflieger.de was not involved in the development, neither ordered the development of this plugin.

== Frequently Asked Questions ==

= Where do I get the AppKey? =

Please contact the Vereinsflieger.de support and ask them for one.

= What is a CID? =

The CID is the identifier for you club in Vereinsflieger.de. You can find it in the administration area for your club in Vereinsflieger.de.

= Can I restrict the access to some sites or blog posts to members? =

Sorry, currently this is not possible. For the future this is planned. You will then also be able to restrict access to roles which the user has in Vereinsflieger.de

= Some of our members use 2 factor authentication, does this work? =

Yes, accounts with 2FA enabled can also login using this plugin.

= The login with Vereinsflieger is failing but my credentials are correct. =

Please try to verify if your login form is under attack. Vereinsflieger blocks your AppKey temporary if they detect a potential DOS attack.
You can prevent this by adding a captcha to your login form - e.g. [reCaptcha by BestWebSoft](https://wordpress.org/plugins/google-captcha/).

= Where can I report bugs or suggest new features?  =

Please open a new issue in the GitHub repository (https://github.com/Diginize/wp-vereinsflieger).

= How can I contribute to this plugin? =

Contribution is always appreciated. Please have a look into our GitHub repository for further information (https://github.com/Diginize/wp-vereinsflieger).

== Changelog ==

= 1.1.0 =
* Enhance error reporting in case Vereinsflieger-API returns with a server error.

= 1.0.10 =
* Fix an error caused by changed behaviour of Vereinsflieger API

= 1.0.9 =
* Fix an error in German translated links

= 1.0.8  =
* Fix issue which changes the wordpress user's password on every login
* Added option, to allow users linked with Vereinsflieger still using their wordpress credentials
* Added a link at the plugin page to the plugin's settings

= 1.0.6 =
* Added translations (de + en)

= 1.0.5 =
* Added icons

= 1.0 =
* First version

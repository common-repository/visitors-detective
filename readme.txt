=== Visitors Detective ===
Contributors: Buzzcop
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=K337ZLYFKW252&lc=IT&item_name=Visitors%20Detective&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: visitors,logs,ip,users
Requires at least: 2.x
Tested up to: 3.0
Stable tag: 1.0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple visits reporting with any features and block/unlock ip

== Description ==

Visitors Detective is a simple plugin for wordpress with which you can see all your visitors on log list with a user-friendly navigation system.

What can you do with Visitors Detective?

-You can see all external visits with:
The ip
The nation where they come from
The from site and the visit page of your website
The date of the visit
And the user if registered

-Then this plugin create a good logs user-friendly

-You can search any types in the visits logs

-Simple navigation

-You can block/unlock the indesiderate ip


Compatible with all 3.x wordpress version and with all major browser

               
Good blogging!

== Installation ==

-Move 'Visitors Detective' folder on plugins in wp-content

-Make sure of haven't a table with 'visitors' name on your db

-Go to plugin on wordpress admin menu and active Visitors Detective

-Now if you want see the external visits or block any ip go to settings and go
to Visitors Detective and enjoy!

== Frequently Asked Questions ==

= Why i see any times some stranges nation of 2 characters? =
This is the nation on $_SERVER['HTTP_ACCEPT_LANGUAGE'] if isn't include on the general
switch of the nations you can add a case before the default

`case '2 characters find':
     return 'Name nation';
     break;`
At `wp-content/plugins/Visitors Detective/inc/vv_adding.php`

== Screenshots ==

http://sweld.altervista.org/scc/1.png

http://sweld.altervista.org/scc/2.png

== Changelog ==

= 1.0.5 =
* Official relase
* Stable

== Upgrade Notice ==

Nothing for now
=== WP Awesome Countimator ===
Contributors: jessicarenee408
Tags: counter, counter up, counter plugin, jquery countimator, numbers counter, animated counter, count up plugin
Requires at least: 3.8
Tested up to: 4.7.2
Stable tag: trunk
License: GPLv2
License URI: http://www.gnu.org/licenses/license-list.html#GPLCompatibleLicenses

Animated Number Countimator - Count Up - Create individual jquery counter using shortcodes - count up.

== Description ==
Awesome Animated Number Counter Plugin to Count Up - Create individual jquery counter using shortcodes. Utilizes the jquery countimator plugin  to create countimator count up blocks to showcase different stats, features, or numbers on your site.

This plugin is used by a quick an easy shortcode that allows you to fully customize the styles for the value, title, and icon per shortcode -- or set your default styles globally in the options menu.

== Installation ==
1. Download and Install
2. Activate the Awesome Counter Plugin.
3. Set default styles in the "ACP Settings" option page.
4. Insert a counter by using the [counter title="Title" value="2400"] shortcode
5. Use shortcode attributes to change the default options and styling for that counter only.



== Frequently Asked Questions ==
1. What attributes can I use in the shortcode?

**** Required:
title
value

- Optional: These will overwrite the defaults set in the ACP Settings option page
value_size - must specify px, em, rem, i.e. 20px or 2rem
value_color - color name or hex code
format  - format of value, i.e. % or $ or monthly or /hr etc.
title_size 
title_color
icon - name of font-awesome icon, i.e. fa-envelope
icon_size
icon_color
class - Custom class, use bootstrap classes to create columns, i.e. - col-md-3
duration - duration of counting, default 3400

**** Example:

[counter title="Projects" value="365" title_size="32px" title_color="#323232" value_size="65px" format="%" value_color="aqua" icon="fa-diamond" icon_size="28px" class="col-md-4"]
[counter title="Clients" value="163" title_size="32px" title_color="#323232" value_size="65px" format="%" value_color="aqua" icon="fa-diamond" icon_size="28px" class="col-md-4"]
[counter title="Cups of Coffee" value="3857" title_size="32px" title_color="#323232" value_size="65px" value_color="aqua" icon="fa-diamond" icon_size="28px" class="col-md-4"]

This would create 3 different counters, in a 3 column responsive, bootstrap grid layout.

== Screenshots ==
1. https://cldup.com/Kex2iPXkWr.jpg
2. https://cldup.com/I7hWM28Bv2.jpg
3. https://cldup.com/0h7zZFiKlA.jpg
=== Plugin Name ===
Contributors: pskli
Tags: timeline, achievement, event, success, history
Requires at least: 4.8
Tested up to: 5.0.2
Requires PHP: 5.6
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
Create highly-customizable timelines in WordPress and display achievements in a chronological way.
 
== Description ==
 
# WP Timeliner [PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)
**Easily create timelines in WordPress and display achievements in a chronological way.**
Display your timelines via a Gutenberg block, via a shortcode or using the Timeline taxonomy archive page.
This plugin provides [lots of hooks](https://github.com/psaikali/wp-timeliner/wiki/Hooks) and an extensible theming system to let developers extend it and customize it.

## Philosophy
The plugin creates a new "Achievement" post type, alongside with a new "Timeline" taxonomy. 
Achievements are assigned to a timeline term, allowing them to be grouped  together on a specific timeline.

Displaying a timeline can whether be done:
- _manually_ via a Gutenberg block anywhere on your site, 
- _automatically_ via each Timeline term archive page where achievements will be displayed chronologically (disabled by default but can be enabled via plugins settings page)

## Documentation
[Please head to our wiki](https://github.com/psaikali/wp-timeliner/wiki) in order to learn how to use and extend WP Timeliner plugin.
- [List of hooks available](https://github.com/psaikali/wp-timeliner/wiki/Hooks)
- [How to create a timeline theme](https://github.com/psaikali/wp-timeliner/wiki/Themes)

## Built with
- [Carbon Fields library](https://carbonfields.net) for managing the plugin admin settings page and the multiple metaboxes and fields.
- [Carbon Fields Icon Field addon](https://github.com/htmlburger/carbon-field-icon) for managing the Achievements icon fields.

## Authors
* **Pierre Saïkali** - *Initial work* - [Mosaika](https://mosaika.fr) / [Saika.li](https://saika.li)
See also the list of [contributors](https://github.com/psaikali/wp-timeliner/graphs/contributors) who participated in this project.
 
== Screenshots ==
 
1. Example of a timeline created with this plugin.
2. Managing different timelines is simple!
3. Every single timeline achievement is a unique post categorized in one or multiple timelines.
4. You can add timelines directly within the brand new Gutenberg block editor.
5. Plugin options page.
 
== Changelog ==
 
= 1.0.0 - 2019-01-04 =
* First version of the plugin \o/
# WP Timeliner [![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com)

<p align="center"><img width="200" height="200" src="https://d2ddoduugvun08.cloudfront.net/items/3o0v061L3D003W061p2z/repo-icon.png"></p>

**Easily create timelines in WordPress and display achievements in a chronological way.**

Display your timelines via a Gutenberg block, via a shortcode or using the Timeline taxonomy archive page.

This plugin provides [lots of hooks](https://github.com/psaikali/wp-timeliner/wiki/Hooks) and an extensible theming system to let developers extend it and customize it.

## Philosophy
The plugin creates a new "Achievement" post type, alongside with a new "Timeline" taxonomy. 
Achievements are assigned to a timeline term, allowing them to be grouped  together on a specific timeline.

Displaying a timeline can whether be done:
- _manually_ via a Gutenberg block anywhere on your site, 
- _automatically_ via each Timeline term archive page where achievements will be displayed chronologically (disabled by default but can be enabled via plugins settings page)

## Getting Started

### Installing

#### Via composer
Add this GitHub repository to the list of available repos and install the plugin:
```
composer config repositories.pskli git https://github.com/psaikali/wp-timeliner.git
composer require pskli/wp-timeliner
```
#### Via Git
Clone this repository in your `wp-content` folder and you're good to go!
```
cd path/to/wp-content
git clone git@github.com:psaikali/wp-timeliner.git
```
#### Via WordPress.org (soon)
Not available yet. Check back soon!

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

## License

This project is licensed under the GNU License - see the [LICENSE.md](LICENSE.md) file for details
# Psite Optimizer WordPress plugin

Turns off unnecessary WordPress features and speeds up page loading.

## Introduction

Psite Optimizer enable website administrators to optimize web pages. During page generation WordPress adds some meta and
link elements and load css styles and JavaScripts that are not required for by websites, or not even welcome at all.
With Psite Optimizer you can remove any or all of following elements:

* DNS prefetch links
* Generator meta element
* Windows Live Writer manifest link
* Weblog client link
* WordPress Page/Post shortlinks
* Post relational links
* Emoji support
* REST API discovery link
* oEmbed's discovery support
* RSS Feed links

## Requirements

Psite Optimizer requires WordPress 5.6 or higher running on PHP 7.2 or later. Plugin is probably compatible with lower
versions of WordPress, but it is not tested.

## Installation

Plugin is in development phase so there is no installation package yet. To install plugin copy or clone this repository
to wp-content/plugins folder of your WordPress installation.

## Configuration

After installation go to WordPress Admin > Plugins and activate the plugin. On activation, plugin adds custom
"Optimization" options page in Admin Menu under Settings submenu. Check/uncheck options in Admin > Settings >
Optimization page to enable/disable optimizations. By default, all optimizations are turned off.

## Contributing

Please note we have a [code of conduct](CODE_OF_CONDUCT.md), please follow it in all your interactions with the project.

When contributing to this repository, please first discuss the change you wish to make via repository issues. Feel free
to create new issues if any of existing doesn't suit your needs.

### Submitting changes

1. Fork this repository and make desired changes.
2. Commit changes to your fork. Please always write a clear log message for your commits.
2. Open a new GitHub Pull Request.
3. Ensure the PR description clearly describes the problem and solution. Include the relevant issue number if
   applicable.
4. Submit Pull Request.

## License

Psite Optimizer plugin is free software: you can redistribute it and/or modify it under the terms of the GNU General
Public License as published by the Free Software Foundation, version 3 of the License.

Psite Optimizer plugin is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
details.

You should have received a copy of the GNU General Public License along with Psite Optimizer plugin. If not,
see http://www.gnu.org/licenses/gpl-3.0.html.
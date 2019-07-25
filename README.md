# ProjectPages MantisBT Plugin

[![app-type](https://img.shields.io/badge/category-mantisbt%20plugins-blue.svg)](https://github.com/spmeesseman)
[![app-lang](https://img.shields.io/badge/language-php-blue.svg)](https://github.com/spmeesseman)
[![app-publisher](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-app--publisher-e10000.svg)](https://github.com/spmeesseman/app-publisher)
[![semantic-release](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantic--release-e10079.svg)](https://github.com/semantic-release/semantic-release)

[![authors](https://img.shields.io/badge/authors-scott%20meesseman-6F02B5.svg?logo=visual%20studio%20code)](https://github.com/spmeesseman)
[![GitHub issues open](https://img.shields.io/github/issues-raw/spmeesseman/mantisbt%2dplugins.svg?maxAge=2592000&logo=github)](https://github.com/spmeesseman/mantisbt-plugins/issues)
[![GitHub issues closed](https://img.shields.io/github/issues-closed-raw/spmeesseman/mantisbt%2dplugins.svg?maxAge=2592000&logo=github)](https://github.com/spmeesseman/mantisbt-plugins/issues)

- [ProjectPages MantisBT Plugin](#ProjectPages-MantisBT-Plugin)
  - [Description](#Description)
  - [Installation](#Installation)
  - [Usage](#Usage)
  - [Future Maybes](#Future-Maybes)

## Description

This plugin allows for setting up navigation bar links based on the current project.  Navbar buttons can be shown per individual project, for all projects but not 'All Projects', at either the beginning or end of the navigation bar.

## Installation

Install the plugin using the default installation procedure for a MantisBT plugin.

## Usage

Example config_inc.php entry using IFramed plugin:

    $g_plugin_ProjectPages_main_menu_options_front = array(
        array(
            'title'        => 'Home',
            'access_level' => VIEWER,
            'url'          => 'plugin.php?page=IFramed/main&title=Home&url=https://my.domain.com/websvn/filedetails.php%3Frepname=pja%26path=%2Fproject_name%2Ftrunk%2FREADME.md%26usemime=1',
            'icon'         => 'fa-home',
            'project_id'   => -1
        )
    );

    $g_plugin_ProjectPages_main_menu_options_back = array(
        array(
            'title'        => 'Read Me',
            'access_level' => VIEWER,
            'url'          => 'plugin.php?page=IFramed/main&title=Home&url=https://my.domain.com/websvn/filedetails.php%3Frepname=pja%26path=%2Fproject_name%2Ftrunk%2FREADME.md%26usemime=1',
            'icon'         => 'fa-book',
            'project_id'   => -1
        ),
        array(
            'title'        => 'Developer Doc',
            'access_level' => DEVELOPER,
            'url'          => 'plugin.php?page=IFramed/main&title=Developer%20Doc&url=https://my.domain.com/doc/developernotes.md',
            'icon'         => 'fa-book',
            'project_id'   => 0
        ),
        array(
            'title'        => 'History File',
            'access_level' => REPORTER,
            'url'          => 'plugin.php?page=IFramed/main&title=History.txt&url=https://my.domain.com/websvn/filedetails.php%3Frepname=pja%26path=%2Fproject_name%2Ftrunk%2Fdoc%2Fhistory.txt%26usemime=1',
            'icon'         => 'fa-history',
            'project_id'   => 0
        ),
        array(
            'title'        => 'WebSVN',
            'access_level' => DEVELOPER,
            'url'          => 'plugin.php?page=IFramed/main&title=WebSVN&url=https://my.domain.com/websvn/listing.php%3Frepname=pja%26path=%2Fproject_name%2Ftrunk%2F',
            'icon'         => 'fa-code-fork',
            'project_id'   => 0
        )
    );

## Future Maybes

- Support for user level link access (as opposed to project level)
- Support for inerse user level link access (a list of users to 'not' display a page for)
- Support for an array of project ids to display a page for (instead of only 1 project id)
- Support for an array of project ids to 'not' display a page for (display for all other projects)

# ProjectPages MantisBT Plugin

![app-type](https://img.shields.io/badge/category-mantisbt%20plugins-blue.svg)
![app-lang](https://img.shields.io/badge/language-php-blue.svg)
[![app-publisher](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-app--publisher-e10000.svg)](https://github.com/spmeesseman/app-publisher)
[![authors](https://img.shields.io/badge/authors-scott%20meesseman-6F02B5.svg?logo=visual%20studio%20code)](https://github.com/spmeesseman)

[![MantisBT issues open](https://app1.spmeesseman.com/projects/plugins/ApiExtend/api/issues/countbadge/ProjectPages/open)](https://app1.spmeesseman.com/projects/set_project.php?project=ProjectPages&make_default=no&ref=bug_report_page.php)
[![MantisBT issues closed](https://app1.spmeesseman.com/projects/plugins/ApiExtend/api/issues/countbadge/ProjectPages/closed)](https://app1.spmeesseman.com/projects/set_project.php?project=ProjectPages&make_default=no&ref=bug_report_page.php)
[![MantisBT version current](https://app1.spmeesseman.com/projects/plugins/ApiExtend/api/versionbadge/ProjectPages/current)](https://app1.spmeesseman.com/projects/set_project.php?project=ProjectPages&make_default=no&ref=plugin.php?page=Releases/releases)
[![MantisBT version next](https://app1.spmeesseman.com/projects/plugins/ApiExtend/api/versionbadge/ProjectPages/next)](https://app1.spmeesseman.com/projects/set_project.php?project=ProjectPages&make_default=no&ref=plugin.php?page=Releases/releases)

- [ProjectPages MantisBT Plugin](#ProjectPages-MantisBT-Plugin)
  - [Description](#Description)
  - [Installation](#Installation)
  - [Issues and Feature Requests](#Issues-and-Feature-Requests)
  - [Usage](#Usage)
    - [Usage - Configuration Parameters](#Usage---Configuration-Parameters)
    - [Usage - Configuration Example](#Usage---Configuration-Example)
  - [Patches](#Patches)
  - [Todos](#Todos)

## Description

This plugin allows for setting up navigation bar links based on the current project.  Navbar buttons can be shown per individual project, for all projects but not 'All Projects', at either the beginning or end of the navigation bar.

## Installation

Extract the release archive to the MantisBT installations plugins folder:

    cd /var/www/mantisbt/plugins
    wget -O ProjectPages.zip https://github.com/mantisbt-plugins/Releases/releases/download/v1.0.0/ProjectPages.zip
    unzip ProjectPages.zip
    rm -f ProjectPages.zip

Ensure to use the latest released version number in the download url: [![MantisBT version current](https://app1.spmeesseman.com/projects/plugins/ApiExtend/api/versionbadge/ProjectPages/current)](https://app1.spmeesseman.com/projects) (version badge available via the [ApiExtend Plugin](https://github.com/mantisbt-plugins/ApiExtend))

Install the plugin using the default installation procedure for a MantisBT plugin in `Manage -> Plugins`.

## Issues and Feature Requests

Issues and requests should be submitted on my [MantisBT](https://app1.spmeesseman.com/projects/set_project.php?project=ProjectPages&make_default=no&ref=bug_report_page.php) site.

## Usage

Two config values can be used to populate the MantisBT navigation sidebar:

- $g_plugin_ProjectPages_main_menu_options_front
- $g_plugin_ProjectPages_main_menu_options_back

Respectively, each of these configs will place buttons at the front, or the back, of the navigation bar.

The structure of a button config is as follows:

    $g_plugin_ProjectPages_main_menu_options_back = array(
        array(
            'title'        => 'Home',
            'access_level' => VIEWER,
            'url'          => 'plugin.php?page=IFramed/main&title=Home&url=https://my.domain.com/project_name',
            'icon'         => 'fa-home',
            'project_id'   => array ( 4, 5 )
        )
    )

### Usage - Configuration Parameters

|Config Name|Descriptions|Required|
|-|-|-|
|title|The title pf the page, the text used in the button.  Note that this match match the `title` in the `url` query string for the button to properly highlight when the page is the currently selected one.  See the [Patches](#Patches) section for more details.|Yes|
|access_level|The access level to be used to determine whether the button should be displayed to the currently logged in user|Yes|
|url|The url of the page to be navigated to when the button id clicked|Yes|
|icon|The Font Awesome icon css class|Yes|
|project_id|An array of ids that the button will be displayed for|Yes|
|no_project_id|An array of ids that the button will NOT be displayed for (an exclusion list)|No|
|project_name|An array of project names that the button will be displayed for|Yes|
|no_project_name|An array of project names that the button will NOT be displayed for (an exclusion list)|No|

Note that one of either `project_id` or `project_name` is required, but not both.

The  `project_id` can be used for special configurations, where:

- `-1` is all projects except for the 'All Projects' project
- `-2` is all projects

Note that the keyword `project_name` in the URL text is replaced with the currently loaded MantisBT project's name.

### Usage - Configuration Example

Example config_inc.php entry using ProjectPages plugin (and the IFramed plugin):

    $g_plugin_ProjectPages_main_menu_options_front = array(
        array(
            'title'        => 'Home',
            'access_level' => VIEWER,
            'url'          => 'plugin.php?page=IFramed/main&title=Home&url=https://my.domain.com/project_name',
            'icon'         => 'fa-home',
            'project_id'   => array ( 4, 5 )
        ),
        array(
            'title'        => 'Dashboard',
            'access_level' => VIEWER,
            'url'          => 'plugin.php?page=IFramed/main&title=Dashboard&url=https://my.domain.com/project_name/dashboard',
            'icon'         => 'fa-home',
            'project_name' => array ( "Tickets", "Issues" )
        )
    );

    $g_plugin_ProjectPages_main_menu_options_back = array(
        array(
            'title'        => 'Read Me',
            'access_level' => VIEWER,
            'url'          => 'plugin.php?page=IFramed/main&title=Read%20Me&url=https://my.domain.com/websvn/filedetails.php%3Frepname=pja%26path=%2Fproject_name%2Ftrunk%2FREADME.md%26usemime=1',
            'icon'         => 'fa-book',
            'project_id'   => array ( -1 )
        ),
        array(
            'title'        => 'WebSVN',
            'access_level' => DEVELOPER,
            'url'          => 'plugin.php?page=IFramed/main&title=WebSVN&url=https://my.domain.com/websvn/listing.php%3Frepname=pja%26path=%2Fproject_name%2Ftrunk%2F',
            'icon'         => 'fa-code-fork',
            'project_id'   => array ( -1 ),
            'no_project_name' => array ( "UnversionedProjectName" )
        )
    );

## Patches

To enable navigation buttons to be 'highlighted' when selected, the core MantisBT file '/core/layout_api.php' requires modification.  The complete file can be found in the patches directory of this plugin, taken from MantisBT 2.21.1 and customized.  Note there are other customizations present in this file, the code that is specific to this functionality can be found that the beginning of the layout_sidebar_menu() function:

    if( $p_page == $p_active_sidebar_page ||
        $p_page == basename( $_SERVER['SCRIPT_NAME'] ) ||
        stripos(str_replace("%20", " ", $_SERVER['QUERY_STRING']), "title=".$p_title) != FALSE ||
        (strpos($_SERVER['QUERY_STRING'], 'Source/index') != FALSE && ( $p_title == 'Repositories' || $p_title == 'Search' ) ) ||
        (strpos($_SERVER['QUERY_STRING'], 'Taskodrome/main') != FALSE && $p_title == 'Scrum Board' ) ) {
        echo '<li class="active">' . "\n";
    } else {
        echo '<li>' . "\n";
    }

## Todos

- [ ] Support for user level link access (as opposed to project level)
- [ ] Support for inverse user level link access (a list of users to 'not' display a page for)

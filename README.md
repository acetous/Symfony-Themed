# Support for multiple Themes in Symfony

This will allow you to use multiple themes for symfony, each with it's own templates and stylesheets.

## New directory for templates

The templates have to be stored in `sf_root_dir/themes/application/themename/module`. A theme named `default` has to be present. Layouts have to be placed in `sf_root_dir/themes/themename/application`.

Example:

 * `sf_root_dir/themes/default/frontend/layout.php` is the new place for your layout
 * `sf_root_dir/themes/default/frontend/post/indexSuccess.php` is the new place for the success-template when calling the index-action on the post-module


## Stylesheets

Create stylesheets for your theme. You'll need to create one for each application.

Example:

 * `default-frontend.css`
 * `default-backend.css`

Please include this stylesheets in your themes root directory. They need to be copied into the `/web/css` folder.

## Only change what you need

All themes (except `default`) will load the default-templates if a custom one is not found. This way you just need to create the template files you want to alter.

Apart from that the default-stylesheet will be included if a custom one cannot be found.

# Installation

 * Copy this classes to you `lib` directory (the task to `lib/task` and filter to `lib/filter`).
 * Move your templates.
 * Edit your `filters.yml`. Add one filter for the themes logic:
   <pre>rendering: ~
   security:  ~
   themes:
     class: ThemedFilter
   cache:     ~
   execution: ~
   </pre>
 * Done!

## Setup a theme

Just run the `./symfony themed:setup` task to setup all themes or `./symfony themed:setup name` to setup a specific theme.

# Anatomy of a theme

This shows the basic directory structure in your project's root folder:

<pre>
/apps
/config
/lib
/themes
  /default
    /frontend
      /post
        /indexSuccess.php
        /showSuccess.php
      /layout.php
    /backend
      /post
        /indexSuccess.php
        /editSuccess.php
      /layout.php
    /default-frontend.css
    /default-backend.css
/web
</pre>
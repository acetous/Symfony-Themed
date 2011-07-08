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

Please include this stylesheets in your themes `css` directory. They need to be copied into the `/web/css` folder.

## Only change what you need

All themes (except `default`) will load the default-templates if a custom one is not found. This way you just need to create the template files you want to alter.

Apart from that the default-stylesheet will be included if a custom one cannot be found.

# Installation

 * Copy this classes to you `lib` directory.
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
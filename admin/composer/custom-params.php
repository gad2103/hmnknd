<?php
// TODO consider making this a class, or alternatively having a loader file that is called by main theme class

add_action('admin_init', 'vc_add_custom_styles');

function vc_add_custom_styles () {
  wp_enqueue_style('vc-font-awesome', STYLES_VENDOR_URL . '/font-awesome/font-awesome.min.css'); 
  wp_enqueue_style('vc-glyphicons', STYLES_VENDOR_URL . '/bootstrap/glyphicons.min.css'); 
}

function vc_icons_settings($settings, $value) {
  $dependency = vc_generate_dependencies_attributes($settings);
  $icons_json = file_get_contents(get_template_directory() . '/assets/fonts/icons.json'); //TODO create constants for all the local directories
  $icons = json_decode($icons_json, true);
  $data['settings'] = $settings;
  $data['value'] = $value;
  $data['dependency'] = $dependency;
  $data['icons'] = $icons;
  return Timber::compile('params/vc_icons.twig',$data); //TODO make sure compile not render is the correct method to use here
}
add_shortcode_param('vc_icons','vc_icons_settings');

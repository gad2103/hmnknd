<?php
// TODO consider making this a class, or alternatively having a loader file that is called by main theme class
// TODO move script adding to scripts file to centralize all script loading

add_action('admin_init', 'vc_add_custom_scripts');

function vc_add_custom_scripts () {
  wp_enqueue_style('vc-font-awesome', STYLES_VENDOR_URL . '/font-awesome/font-awesome.min.css'); 
  wp_enqueue_style('vc-glyphicons', STYLES_VENDOR_URL . '/bootstrap/glyphicons.min.css'); 
  wp_enqueue_style('hmnknd_vc_admin_customizations', get_template_directory_uri() . '/admin/assets/css/vc_admin_styles.css');
  wp_enqueue_script('hmnknd_admin_scripts', THEME_ADMIN_ASSETS_URL . '/js/admin-scripts.js');
}

function vc_icons_settings($settings, $value) {
  $dependency = vc_generate_dependencies_attributes($settings);
  $icons_json = file_get_contents(get_template_directory() . '/assets/fonts/icons.json'); //TODO create constants for all the local directories
  $icons = json_decode($icons_json, true);
  $data['settings'] = $settings;
  $data['value'] = $value;
  $data['dependency'] = $dependency;
  $data['icons'] = $icons;
  $data['filter_class'] = 'vc-icon-searchbox';
  return Timber::compile('params/vc_icons.twig',$data); //TODO make sure compile not render is the correct method to use here
}
add_shortcode_param('vc_icons','vc_icons_settings', THEME_ADMIN_ASSETS_URL . '/js/vc-icons.js');

function vc_settings_slider($settings, $value) {
  $dependency = vc_generate_dependencies_attributes($settings);
  $data['settings'] = $settings;
  $data['value'] = $value;
  $data['dependency'] = $dependency;
  $data['prompt'] = __('Slide For Value');
  return Timber::compile('params/vc_settings_slider.twig',$data); //TODO make sure compile not render is the correct method to use here
}
add_shortcode_param('vc_settings_slider', 'vc_settings_slider', THEME_ADMIN_ASSETS_URL . '/js/vc-settings-slider.js');

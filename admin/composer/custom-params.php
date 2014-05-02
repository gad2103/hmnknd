<?php
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

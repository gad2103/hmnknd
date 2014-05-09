<?php

function bartag_func( $atts, $content=null ) {

  $atts_default = array(
    "class" => '',
    "icon" => '',
  );
  $data = TwigPrepare::shortcodes($atts, $atts_default);
  $content = wpb_js_remove_wpautop($content);
  $data['content'] = $content;

  return Timber::compile('shortcodes/bartag.twig', $data);
}


add_shortcode('bartag', 'bartag_func');

vc_map( 
  array(
    "name" => __('Section Header'),
    "base" => 'bartag',
    "description" => 'Styled separator with text and icon',
    "class" => '',
    "show_settings_on_create" => true,
    "weight" => '',
    "category" => __('Testing'),
    "admin_enqueue_css" => '',
    "admin_enqueue_js" => THEME_ADMIN_ASSETS_URL . '/js/vc-icons.js',
    "icon" => '',
    "js_view" => '',
    "params" => array(
      array(
        "type" => 'vc_icons',
        "holder" => '',
        "class" => '',
        "heading" => 'Section Header Icon',
        "param_name" => 'icon',
        "value" => '',
        "description" => 'This icon will appear in your section header',
        "admin_label" => true,
        "dependency" => '',
        "edit_field_class" => '',
        "group" => '',
      ),
      array(
        "type" => 'textfield',
        "holder" => '',
        "class" => '',
        "heading" => 'Section Header Text',
        "param_name" => 'class',
        "value" => '',
        "description" => 'This will be the large, bold text for your header. Think of it like a title for the section.',
        "admin_label" => true,
        "dependency" => '',
        "edit_field_class" => '',
        "group" => '',
      ),
    )
  )
);

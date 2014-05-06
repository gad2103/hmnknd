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
    "name" => __('Bar tag test'),
    "base" => 'bartag',
    "description" => '',
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
        "heading" => 'Icon choice heading',
        "param_name" => 'icon',
        "value" => '',
        "description" => 'this is the description',
        "admin_label" => true,
        "dependency" => '',
        "edit_field_class" => '',
        "group" => '',
      ),
      array(
        "type" => 'textfield',
        "holder" => '',
        "class" => '',
        "heading" => 'textfield choice heading',
        "param_name" => 'class',
        "value" => '',
        "description" => 'this is the description',
        "admin_label" => true,
        "dependency" => '',
        "edit_field_class" => '',
        "group" => '',
      ),
    )
  )
);
/*vc_map( array(
  "name" => __("Bar tag test"),
  "base" => "bartag",
  "class" => "",
  "description" => '',
  "class" => '',
  "show_settings_on_create" => true,
  "weight" => '',
  "category" => __('Testing'),
  "admin_enqueue_css" => '',
  "admin_enqueue_js" => '',
  "icon" => '',
  "js_view" => '',
  "params" => array(
    array(
      "type" => "textfield",
      "holder" => "",
      "class" => "",
      "heading" => __("Text"),
      "param_name" => "foo",
      "value" => __("Default params value"),
      "description" => "Description for foo param."
    ),
  )
) );
 */

<?php
function section_header_func( $atts, $content=null ) {
  $atts_default = array(
    "class" => '',
    "icon" => '',
    "header" => '',
    "subheader" => '',
  );
  $data = TwigPrepare::getInstance()->shortcodes($atts, $atts_default);
  $content = wpb_js_remove_wpautop($content);
  $data['content'] = $content;
  return Timber::compile('shortcodes/section_header.twig', $data);
}


add_shortcode('section_header', 'section_header_func');

vc_map( 
  array(
    "name" => __('Section Header'),
    "base" => 'section_header',
    "description" => 'Styled separator with text and icon',
    "class" => '',
    "show_settings_on_create" => false,
    "weight" => '',
    "category" => __('Testing'),
    "admin_enqueue_css" => '',
    //"admin_enqueue_js" => THEME_ADMIN_ASSETS_URL . '/js/vc-icons.js',
    "icon" => '',
    "js_view" => '',
    "params" => array(
      array(
        "type" => 'textfield',
        "holder" => 'h1',
        "class" => 'hmnknd',
        "heading" => 'Section Header Text',
        "param_name" => 'header',
        "value" => '',
        "description" => 'This will be the large, bold text for your header. Think of it like a title for the section.',
        "admin_label" => false,
        "dependency" => '',
        "edit_field_class" => 'col-md-12',
        "group" => '',
      ),
      array(
        "type" => 'vc_icons',
        "holder" => 'div',
        "class" => '',
        "heading" => 'Section Header Icon',
        "param_name" => 'icon',
        "value" => '',
        "description" => 'This icon will appear in your section header',
        "admin_label" => false,
        "dependency" => '',
        "edit_field_class" => 'col-md-12',
        "group" => '',
      ),
      array(
        "type" => 'textarea',
        "holder" => 'div',
        "class" => 'hmnknd',
        "heading" => 'Section Header Blurb',
        "param_name" => 'subheader',
        "value" => '',
        "description" => 'Add a little blurb to explain your header.',
        "admin_label" => false,
        "dependency" => '',
        "edit_field_class" => 'col-md-12',
        "group" => '',
      ),
      array(
        "type" => 'textfield',
        "class" => '',
        "heading" => 'Extra class header',
        "param_name" => 'el_class',
        "value" => '',
        "description" => 'Add extra classes to this element for reference in your stylesheet.',
        "admin_label" => false,
        "dependency" => '',
        "group" => '',
        "edit_field_class" => 'col-md-12',
      ),
    )
  )
);

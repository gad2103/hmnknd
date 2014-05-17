<?php
//TODO cleanup, consider making an object with methods so that there is not so much repetition. Also use twig macros for lists so you have only one file difference for nested vs not nested.
function list_func( $atts, $content=null ) {
  $atts_default = array(
    "class" => '',
    "orientation" => '',
    "header" => '',
    "icon" => '',
    "icon_side" => '',
  );
  $data = TwigPrepare::getInstance()->shortcodes($atts, $atts_default);
  $content = wpb_js_remove_wpautop($content, true);
  $list = TwigPrepare::getInstance()->prepare_list($content);
  $data['content'] = $list;
  $data['icon_side'] = ( $data['icon_side'] == 'right of list item' ) ? "pull-right" : "";
  return Timber::compile('shortcodes/list.twig', $data);
}

add_shortcode('vc_list', 'list_func');

function nested_lists_func( $atts, $content=null ) {
  $atts_default = array(
    "class" => '',
    "orientation" => '',
    "header" => '',
  );
  $data = TwigPrepare::getInstance()->shortcodes($atts, $atts_default);
  $content = wpb_js_remove_wpautop($content);
  $data['content'] = $content;
  return Timber::compile('shortcodes/nested_lists.twig', $data);
}


add_shortcode('vc_list_nested', 'nested_lists_func');

function single_list_item_func( $atts, $content=null ) {
  $atts_default = array(
    "icon" => '',
    "icon_side" => '',
  );
  $data = TwigPrepare::getInstance()->shortcodes($atts, $atts_default);
  $data['icon_side'] = ( $data['icon_side'] == 'right of list item' ) ? "pull-right" : ""; //TODO move this to external function when making a class
  $content = wpb_js_remove_wpautop($content, true);
  $list = TwigPrepare::getInstance()->prepare_list($content);
  $data['content'] = $list;
  //TODO check if item is single or is a list. if its a single pass to template if list pass to another?
  return Timber::compile('shortcodes/single_list_item.twig', $data);
}

add_shortcode('single_list_item', 'single_list_item_func');

vc_map( 
  array(
    "name" => __('Nested List With Icons Outter'),
    "base" => 'vc_list_nested',
    "as_parent" => array( 'only' => 'single_list_item'),
    "content_element" => true,
    "description" => '',
    "class" => '',
    "show_settings_on_create" => true,
    "weight" => '',
    "category" => __('Testing'),
    "admin_enqueue_css" => '',
    //"admin_enqueue_js" => THEME_ADMIN_ASSETS_URL . '/js/vc-icons.js',
    "icon" => '',
    "params" => array(
      array(
        "type" => 'textfield',
        "holder" => 'h4',
        "class" => 'hmnknd',
        "heading" => 'List Header Text',
        "param_name" => 'header',
        "value" => '',
        "description" => 'Add a title to your list.',
        "admin_label" => false,
        "dependency" => '',
        "group" => '',
        "edit_field_class" => 'col-md-12',
      ),
      array(
        "type" => 'dropdown',
        "class" => 'hmnknd',
        "heading" => 'List orientation',
        "param_name" => 'orientation',
        "value" => array('vertical-list', 'horizontal-list', 'horizontal-centered-list'),
        "description" => 'Choose which side your icon will appear on.',
        "admin_label" => false,
        "dependency" => '',
        "group" => '',
        "edit_field_class" => 'col-md-12',
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

vc_map( array(
  "name" => __("Nested List With Icons Inner"),
  "base" => 'single_list_item',
  "content_element" => true,
  "as_child" => array('only' => 'vc_list_nested'),
  "show_settings_on_create" => true,
  "class" => "hmnknd_list_item",
  "params" => array(
    array(
      "type" => "textarea_html",
      "heading" => "list item content",
      "holder" => "div",
      "param_name" => "content",
      "description" => "Add the content to your list item",
      "edit_field_class" => 'col-md-12',
    ),
    array(
      "type" => 'dropdown',
      "class" => 'hmnknd',
      "heading" => 'Icon Side',
      "param_name" => 'icon_side',
      "value" => array('left of list item', 'right of list item'),
      "description" => 'Choose which side your icon will appear on.',
      "admin_label" => false,
      "dependency" => '',
      "edit_field_class" => 'col-md-12',
      "group" => '',
    ),
    array(
      "type" => 'vc_icons',
      "class" => 'hidden hmnknd_single_list',
      "heading" => 'List Bullet Icon',
      "holder" => 'div',
      "param_name" => 'icon',
      "value" => '',
      "description" => 'Choose an icon for each item in your list',
      "admin_label" => false,
      "dependency" => '',
      "edit_field_class" => 'col-md-12',
      "group" => '',
    ),
  )
) );

vc_map( 
  array(
    "name" => __('Single List Icon Bullets'),
    "base" => 'vc_list',
    "content_element" => true,
    "description" => '',
    "class" => '',
    "show_settings_on_create" => true,
    "weight" => '',
    "category" => __('Testing'),
    "admin_enqueue_css" => '',
    //"admin_enqueue_js" => THEME_ADMIN_ASSETS_URL . '/js/vc-icons.js',
    "icon" => '',
    "params" => array(
      array(
        "type" => 'textfield',
        "holder" => 'h4',
        "class" => 'hmnknd',
        "heading" => 'List Header Text',
        "param_name" => 'header',
        "value" => '',
        "description" => 'Add a title to your list.',
        "admin_label" => false,
        "dependency" => '',
        "group" => '',
        "edit_field_class" => 'col-md-12',
      ),
      array(
        "type" => 'dropdown',
        "class" => 'hmnknd',
        "heading" => 'List orientation',
        "param_name" => 'orientation',
        "value" => array('vertical', 'horizontal', 'horizontal-centered'),
        "description" => 'Choose which side your icon will appear on.',
        "admin_label" => false,
        "dependency" => '',
        "group" => '',
        "edit_field_class" => 'col-md-12',
      ),
      array(
        "type" => "textarea_html",
        "heading" => "list item content",
        "holder" => "div",
        "param_name" => "content",
        "description" => "Add the content to your list item",
        "edit_field_class" => 'col-md-12',
      ),
      array(
        "type" => 'dropdown',
        "class" => 'hmnknd',
        "heading" => 'Icon Side',
        "param_name" => 'icon_side',
        "value" => array('left of list item', 'right of list item'),
        "description" => 'Choose which side your icon will appear on.',
        "admin_label" => false,
        "dependency" => '',
        "edit_field_class" => 'col-md-12',
        "group" => '',
      ),
      array(
        "type" => 'vc_icons',
        "class" => 'hidden hmnknd_single_list',
        "heading" => 'List Bullet Icon',
        "holder" => 'div',
        "param_name" => 'icon',
        "value" => '',
        "description" => 'Choose an icon for each item in your list',
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

if( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_Vc_List_Nested extends HMNKNDShortCodesContainer {
  }
}
if( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_Single_List_Item extends WPBakeryShortCode {
  }
}

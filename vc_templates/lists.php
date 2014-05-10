<?php
function lists_func( $atts, $content=null ) {
  $atts_default = array(
    "class" => '',
    "orientation" => '',
    "header" => '',
  );
  $data = TwigPrepare::shortcodes($atts, $atts_default);
  $content = wpb_js_remove_wpautop($content);
  $data['content'] = $content;
  return Timber::compile('shortcodes/lists.twig', $data);
}


add_shortcode('lists', 'lists_func');

function single_list_item_func( $atts, $content=null ) {
  $atts_default = array(
    "icon" => '',
    "icon_side" => '',
  );
  $data = TwigPrepare::shortcodes($atts, $atts_default);
  $data['icon_side'] = ( $data['icon_side'] == 'right of list item' ) ? "pull-right" : "";
  $content = wpb_js_remove_wpautop($content);
  $data['content'] = $content;
  return Timber::compile('shortcodes/single_list_item.twig', $data);
}

add_shortcode('single_list_item', 'single_list_item_func');

vc_map( 
  array(
    "name" => __('Lists With Icons'),
    "base" => 'lists',
    "as_parent" => array( 'only' => 'single_list_item'),
    "content_element" => true,
    "description" => '',
    "class" => '',
    "show_settings_on_create" => true,
    "weight" => '',
    "category" => __('Testing'),
    "admin_enqueue_css" => '',
    "admin_enqueue_js" => THEME_ADMIN_ASSETS_URL . '/js/vc-icons.js',
    "icon" => '',
    "js_view" => 'VcColumnView',
    "params" => array(
      array(
        "type" => 'textfield',
        "holder" => 'h6',
        "class" => 'hmnknd',
        "heading" => 'List Header Text',
        "param_name" => 'header',
        "value" => '',
        "description" => 'Add a title to your list.',
        "admin_label" => false,
        "dependency" => '',
        "edit_field_class" => '',
        "group" => '',
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
        "edit_field_class" => '',
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
        "edit_field_class" => '',
        "group" => '',
      ),
    )
  )
);

vc_map( array(
  "name" => __("Single List Item"),
  "base" => 'single_list_item',
  "content_element" => true,
  "as_child" => array('only' => 'lists'),
  "show_settings_on_create" => true,
  "class" => "hmnknd_list_item",
  "params" => array(
    array(
      "type" => "textarea_html",
      "heading" => "list item content",
      "holder" => "div",
      "param_name" => "content",
      "description" => "Add the content to your list item"
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
        "edit_field_class" => '',
        "group" => '',
      ),
      array(
        "type" => 'vc_icons',
        "class" => '',
        "heading" => 'List Bullet Icon',
        "param_name" => 'icon',
        "value" => '',
        "description" => 'Choose an icon for each item in your list',
        "admin_label" => false,
        "dependency" => '',
        "edit_field_class" => '',
        "group" => '',
      ),
  )
) );

if( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_Lists extends WPBakeryShortCodesContainer {
  }
}
if( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_Single_List_Item extends WPBakeryShortCode {
  }
}

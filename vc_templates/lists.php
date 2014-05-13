<?php

function xmlstr_to_array($xmlstr) {
  $doc = new DOMDocument();
  $doc->loadXML($xmlstr);
  $root = $doc->documentElement;
  $output = domnode_to_array($root);
  $output['@root'] = $root->tagName;
  return $output;
}

function domnode_to_array($node) {
  $output = array();
  switch ($node->nodeType) {

  case XML_CDATA_SECTION_NODE:
  case XML_TEXT_NODE:
    $output = trim($node->textContent);
    break;

  case XML_ELEMENT_NODE:
    for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
      $child = $node->childNodes->item($i);
      $v = domnode_to_array($child);
      if(isset($child->tagName)) {
        $t = $child->tagName;
        if(!isset($output[$t])) {
          $output[$t] = array();
        }
        $output[$t][] = $v;
      }
      elseif($v || $v === '0') {
        $output = (string) $v;
      }
    }
    if($node->attributes->length && !is_array($output)) { //Has attributes but isn't an array
      $output = array('@content'=>$output); //Change output into an array.
    }
    if(is_array($output)) {
      if($node->attributes->length) {
        $a = array();
        foreach($node->attributes as $attrName => $attrNode) {
          $a[$attrName] = (string) $attrNode->value;
        }
        $output['@attributes'] = $a;
      }
      foreach ($output as $t => $v) {
        if(is_array($v) && count($v)==1 && $t!='@attributes') {
          $output[$t] = $v[0];
        }
      }
    }
    break;
  }
  return $output;
}
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


add_shortcode('vc_list', 'lists_func');

function single_list_item_func( $atts, $content=null ) {
  $atts_default = array(
    "icon" => '',
    "icon_side" => '',
  );
  $data = TwigPrepare::shortcodes($atts, $atts_default);
  $data['icon_side'] = ( $data['icon_side'] == 'right of list item' ) ? "pull-right" : "";
  $content = wpb_js_remove_wpautop($content);
  $data['content'] = $content;
  //TODO check if item is single or is a list. if its a single pass to template if list pass to another?
  $html =  DOMDocument::loadHTML($content);
  $doc = $html->getElementsByTagName('li');
  $list=[];
  foreach ($doc as $n)
  {
        $value = $n->nodeValue;
            $list[] = $value;
  }
  var_dump($list);
  return Timber::compile('shortcodes/single_list_item.twig', $data);
}

add_shortcode('single_list_item', 'single_list_item_func');

vc_map( 
  array(
    "name" => __('Lists With Icons'),
    "base" => 'vc_list',
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
        "value" => array('vertical', 'horizontal', 'horizontal-centered'),
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
  "name" => __("Single List Item"),
  "base" => 'single_list_item',
  "content_element" => true,
  "as_child" => array('only' => 'vc_list'),
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

if( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_Vc_List extends HMNKNDShortCodesContainer {
  }
}
if( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_Single_List_Item extends WPBakeryShortCode {
  }
}

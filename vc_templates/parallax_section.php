<?php
function parallax_section_func( $atts, $content=null ) {
  $atts_default = array(
    "el_class" => '',
    "bg_image" => '',
    "speed" => '',
  );
  $data = TwigPrepare::getInstance()->shortcodes($atts, $atts_default);
  $link_to = wp_get_attachment_image_src( $data['bg_image'], 'large' );
  $link_to = $link_to[0];
  $data['bg_img'] =  $link_to;
  $content = wpb_js_remove_wpautop($content, true);
  $data['content'] = $content;
  return Timber::compile('shortcodes/parallax_section.twig', $data);
}


add_shortcode('parallax_section', 'parallax_section_func');

vc_map( 
  array(
    "name" => __('Parallax Section'),
    "base" => 'parallax_section',
    "description" => 'Parallax section with parallax background effect',
    "class" => '',
    "show_settings_on_create" => true,
    "weight" => '',
    "category" => __('Testing'),
    "icon" => '',
    "js_view" => '',
    "params" => array(
      array(
        "type" => "attach_image",
        "heading" => __('The Section Background Image'),
        "param_name" => "bg_image",
        "description" => __('Add the background image for the parallax section'),
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
        "type" => 'vc_settings_slider',
        "class" => '',
        "heading" => 'Background movement speed',
        "holder" => 'div',
        "param_name" => 'speed',
        "value" => 0.25,
        "description" => 'Set the background movement speed relative to the window scroll speed',
        "admin_label" => false,
        "dependency" => '',
        "edit_field_class" => 'col-md-12',
        "group" => '',
        "min" => 0.1,
        "max" => 0.75,
        "interval" => 0.05,
        "orientation" => "horizontal",
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

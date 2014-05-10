<?php

class TwigPrepare {

  public static function shortcodes($atts, $atts_map_array) {

    extract( shortcode_atts($atts_map_array, $atts) );

    $shortcode_data = [];
    foreach( $atts_map_array as $name => $default ) {
      $shortcode_data[$name] = ( $$name ) ? $$name : $default;
    }

    return $shortcode_data;
  }
}

/*class VCHelper {

  public function make_map_array($settings) {

    $out=[];

    foreach( $settings['shortcode'] as $setting ) {
 */

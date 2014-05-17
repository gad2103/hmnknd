<?php

class TwigPrepare {

  public static $list = [];

  private static $instance = null;

  public static function getInstance() {
    if (!self::$instance)
      self::$instance = new TwigPrepare();
    return self::$instance;
  }

  function __construct() {
    require_once THEME_DIR . '/lib/PQLite/PQLite.php';
  }

  public function shortcodes($atts, $atts_map_array) {

    extract( shortcode_atts($atts_map_array, $atts) );

    $shortcode_data = [];
    foreach( $atts_map_array as $name => $default ) {
      $shortcode_data[$name] = ( $$name ) ? $$name : $default;
    }

    return $shortcode_data;
  }

  public function prepare_list($html_str, $type = null) { 

    self::$list = [];

    $html = preg_replace('~>\s+<~m', '><', $html_str); 
    $html = '<div id="prepare_wrap">' . $html . '</div>';
    $pquery = new PQLite($html);
    $pquery->find('#prepare_wrap')->getChildren()->each(array(&$this, 'build_tag_array'));
    return self::$list;
  }

  public function build_tag_array($node) {

    if ( !$node->getChildren()->get(0)->getNumTags() && $node->getFirstTagName() != 'li' ) {
      self::$list['parent'][] = $node->getOuterHTML();
    } else if ( $node->getChildren()->get(0)->getFirstTagName()  == 'li' ) { //assuming no nested lis 
      $node->getChildren()->each(array($this, 'build_tag_array'));
    } else {
      self::$list['parent']['children'][] = $node->getInnerHTML();
    }
  }

}

/*class VCHelper {

  public function make_map_array($settings) {

    $out=[];

    foreach( $settings['shortcode'] as $setting ) {
 */

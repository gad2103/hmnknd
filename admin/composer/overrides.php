<?php 
if( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class HMNKNDShortCodesContainer extends WPBakeryShortCodesContainer {
    public function contentAdmin($atts, $content = null) {
      $width = $el_class = '';
      extract(shortcode_atts($this->predefined_atts, $atts));
      $output = '';

      $column_controls = $this->getColumnControls($this->settings('controls'));
      $column_controls_bottom =  $this->getColumnControls('add', 'bottom-controls');
      for ( $i=0; $i < count($width); $i++ ) {
        $output .= '<div '.$this->mainHtmlBlockParams($width, $i).'>';
        $output .= $column_controls;
        $output .= '<div class="wpb_element_wrapper">';
        $output .= '<div '.$this->containerHtmlBlockParams($width, $i).'>';
        if ( isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '' ) {
          if ( true) {
            $custom_markup = str_ireplace("%content%", $content, $this->settings["custom_markup"]);
          } else if ( $content == '' && isset($this->settings["default_content_in_template"]) && $this->settings["default_content_in_template"] != '' ) {
            $custom_markup = str_ireplace("%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"]);
          }
          $output .= do_shortcode($custom_markup);
        } else { 
          $output .= do_shortcode( shortcode_unautop($content) );
        }
        $output .= '</div>';
        if ( isset($this->settings['params']) ) {
          $inner = '';
          foreach ($this->settings['params'] as $param) {
            $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
            if ( is_array($param_value)) {
              reset($param_value);
              $first_key = key($param_value);
              $param_value = $param_value[$first_key];
            }
            $inner .= $this->singleParamHtmlHolder($param, $param_value);
          }
          $output .= $inner;
        }
        $output .= '</div>';
        $output .= $column_controls_bottom;
        $output .= '</div>';
      }
      return $output;
    }

  }
}


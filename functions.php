<?php

  // Initialize Redux Options Framework
  /*if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/ReduxFramework/ReduxCore/framework.php' );
  }
  if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxFramework/sample/sample-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/ReduxFramework/sample/sample-config.php' );
  }*/

  // Custom Framework Includes
  require_once locate_template('/lib/activation.php');
  require_once locate_template('/lib/scripts.php');

	add_theme_support('post-formats');
	add_theme_support('post-thumbnails');
	add_theme_support('menus');

	add_filter('get_twig', 'add_to_twig');
	add_filter('timber_context', 'add_to_context');

	add_action('wp_enqueue_scripts', 'load_scripts');

	define('THEME_URL', get_template_directory_uri());

	function add_to_context($data){
		/* this is where you can add your own data to Timber's context object */
		$data['qux'] = 'I am a value set in your functions.php file';
		$data['menu'] = new TimberMenu();
		return $data;
	}

	function add_to_twig($twig){
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension(new Twig_Extension_StringLoader());
		$twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));
		return $twig;
	}

	function myfoo($text){
    	$text .= ' bar!';
    	return $text;
	}

	function load_scripts(){
		wp_enqueue_script('jquery');
	}

  /* Tabs
  ---------------------------------------------------------- */
  /*$tab_id_1 = time().'-1-'.rand(0, 100);
  $tab_id_2 = time().'-2-'.rand(0, 100);
  vc_map( array(
    "name"  => __("Tabs Minimal", "js_composer"),
    "base" => "vc_tabs_minimal",
    "show_settings_on_create" => false,
    "is_container" => true,
    "icon" => "icon-wpb-ui-tab-content",
    "category" => __('Content', 'js_composer'),
    "description" => __('Tabbed content minimal style', 'js_composer'),
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Widget title", "js_composer"),
        "param_name" => "title",
        "description" => __("Enter text which will be used as widget title. Leave blank if no title is needed.", "js_composer")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Auto rotate tabs", "js_composer"),
        "param_name" => "interval",
        "value" => array(__("Disable", "js_composer") => 0, 3, 5, 10, 15),
        "std" => 0,
        "description" => __("Auto rotate tabs each X seconds.", "js_composer")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "js_composer"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
      )
    ),
    "custom_markup" => '
    <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
    <ul class="tabs_controls">
    </ul>
    %content%
    </div>'
    ,
    'default_content' => '
    [vc_tab title="'.__('Tab 1','js_composer').'" tab_id="'.$tab_id_1.'"][/vc_tab]
    [vc_tab title="'.__('Tab 2','js_composer').'" tab_id="'.$tab_id_2.'"][/vc_tab]
    ',
    "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
  ) );*/



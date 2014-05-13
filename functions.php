<?php
define("THEME_DIR", get_template_directory());
define("THEME_DIR_URL", get_template_directory_uri());
//define("THEME_NAME", $options["theme_name"]);
//if ( defined( "ICL_LANGUAGE_CODE" )) {$lang="_".ICL_LANGUAGE_CODE;} else {$lang = "";}
//define( "THEME_OPTIONS", $options["theme_name"] . '_options' . $lang );
//define("THEME_SLUG", $options["theme_slug"]);

/* ------ */
define("THEME_STYLES_URL", THEME_DIR_URL . "/assets/css"); // good for styles and javascript b/c of absolute path
define("STYLES_VENDOR_URL", THEME_DIR_URL . "/assets/css/vendor"); // good for styles and javascript b/c of absolute path
//define("THEME_LESS", THEME_DIR_URI . "/less");
//define("THEME_IMAGES", THEME_DIR_URI . "/images");
define("THEME_JS", THEME_DIR_URL . "assets/js");

define('FONT_BASE_DIR', THEME_DIR . 'assets/fonts');
define('FONT_VENDOR_DIR', THEME_DIR . 'assets/fonts/vendor');
define('FONT_BASE_URL', THEME_DIR_URL . 'assets/fonts');
define('FONT_VENDOR_URL', THEME_DIR_URL . 'assets/fonts/vendor');
//define("THEME_CACHE_URI", THEME_DIR_URI . "/cache");

/* ------ */
define("THEME_FRAMEWORK", THEME_DIR . "/framework");
//define("THEME_PLUGINS", THEME_FRAMEWORK . "/plugins");
//define("THEME_ACTIONS", THEME_FRAMEWORK . "/actions");
//define("THEME_PLUGINS_URI", THEME_DIR_URI . "/framework/plugins" );
//define("THEME_SHORTCODES", THEME_FRAMEWORK . "/shortcodes");
//define("THEME_WIDGETS", THEME_FRAMEWORK . "/widgets");
//define("THEME_SLIDERS", THEME_FRAMEWORK . "/sliders");
//define("THEME_HELPERS", THEME_FRAMEWORK . "/helpers");
//define("THEME_FUNCTIONS", THEME_FRAMEWORK . "/functions");
//define("THEME_CLASSES", THEME_FRAMEWORK . "/classes");

/* ------ */
define('THEME_ADMIN', THEME_FRAMEWORK . '/admin');
//define('THEME_METABOXES', THEME_ADMIN . '/metaboxes');
//define('THEME_ADMIN_POST_TYPES', THEME_ADMIN . '/post-types');
//define('THEME_GENERATORS', THEME_ADMIN . '/generators');
//define('THEME_ADMIN_URI', THEME_DIR_URI . '/framework/admin');
define('THEME_ADMIN_ASSETS_URL', THEME_DIR_URL . '/admin/assets');

// Initialize Redux Options Framework
  /*if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/ReduxFramework/ReduxCore/framework.php' );
  }
  if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxFramework/sample/sample-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/ReduxFramework/sample/sample-config.php' );
  }*/

// TODO make this more automated perhaps a loader.php in all relevant directories will load everything and this will call all the loaders
$framework_dependencies = array(
  '/lib/',
  '/lib/timber/',
  '/admin/composer/',
  '/vc_templates/',
);


function require_all($dirs) {
    /*foreach( $files as $file ) {
      //locate_template($file, true, true);
      require_once THEME_DIR . $file;
    }*/
  foreach ( $dirs as $dir ) {
    foreach( glob(THEME_DIR . $dir . '*.php') as $file ) {
      require_once $file;
    }
  }
};

// Load framework in one line
require_all($framework_dependencies);

add_theme_support('post-formats');
add_theme_support('post-thumbnails');
add_theme_support('menus');

add_filter('get_twig', 'add_to_twig');
add_filter('timber_context', 'add_to_context');

add_action('wp_enqueue_scripts', 'load_scripts');

define('THEME_URL', get_template_directory_uri());

function add_to_context($data){
  /* this is where you can add your own data to Timber's context object */
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



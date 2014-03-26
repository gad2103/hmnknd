<?php

/*;
 * The jumbotron core options for the Shoestrap theme
 */
if ( !function_exists( 'shoestrap_module_headers_options' ) ) :
function shoestrap_module_headers_options($sections) {

	//Background Patterns Reader
	$bg_pattern_images_path = get_template_directory() . '/lib/modules/background/patterns';
	$bg_pattern_images_url  = get_template_directory_uri() . '/lib/modules/background/patterns/';
	$bg_pattern_images      = array();

	if ( is_dir( $bg_pattern_images_path ) && $bg_pattern_images_dir = opendir( $bg_pattern_images_path ) ) :
		while ( ( $bg_pattern_images_file = readdir( $bg_pattern_images_dir ) ) !== false ) :
			if( stristr( $bg_pattern_images_file, '.png' ) !== false || stristr( $bg_pattern_images_file, '.jpg' ) !== false ) :
				$bg_pattern_images[] = $bg_pattern_images_url . $bg_pattern_images_file;
			endif;
		endwhile;
	endif;

	$url = admin_url( 'widgets.php' );
	$fields[] = array( 
		'id'          => 'help9',
		'title'       => __( 'Extra Branding Area', 'shoestrap' ),
		'desc'        => __( "You can enable an extra branding/header area. In this header you can add your logo, and any other widgets you wish.
											To add widgets on your header, visit <a href='$url'>this page</a> and add your widgets to the <strong>Header</strong> Widget Area.", 'shoestrap' ),
		'type'        => 'info',
	);

	$fields[] = array( 
		'title'       => __( 'Display the Header.', 'shoestrap' ),
		'desc'        => __( 'Turn this ON to display the header. Default: OFF', 'shoestrap' ),
		'id'          => 'header_toggle',
		'customizer'  => array(),
		'default'     => 0,
		'type'        => 'switch',
	);

	$fields[] = array( 
		'title'       => __( 'Display branding on your Header.', 'shoestrap' ),
		'desc'        => __( 'Turn this ON to display branding ( Sitename or Logo )on your Header. Default: ON', 'shoestrap' ),
		'id'          => 'header_branding',
		'customizer'  => array(),
		'default'     => 1,
		'type'        => 'switch',
		'required'    => array('header_toggle','=',array('1')),
	);

	$fields[] = array( 
		'title'       => __( 'Header Background Color', 'shoestrap' ),
		'desc'        => __( 'Select the background color for your header. Default: #EEEEEE.', 'shoestrap' ),
		'id'          => 'header_bg',
		'default'     => '#EEEEEE',
		'customizer'  => array(),
		'transparent' => false,    
		'type'        => 'color',
		'required'    => array('header_toggle','=',array('1')),
	);

	$fields[] = array( 
		'title'       => __( 'Header Background Opacity', 'shoestrap' ),
		'desc'        => __( 'Select the background opacity for your header. Default: 100%.', 'shoestrap' ),
		'id'          => 'header_bg_opacity',
		'default'     => 100,
		'min'         => 0,
		'step'        => 1,
		'max'         => 100,
		'compiler'    => true,
		'type'        => 'slider',
		'required'    => array('header_toggle','=',array('1')),
	);

	$fields[] = array( 
		'title'       => __( 'Header Text Color', 'shoestrap' ),
		'desc'        => __( 'Select the text color for your header. Default: #333333.', 'shoestrap' ),
		'id'          => 'header_color',
		'default'     => '#333333',
		'customizer'  => array(),
		'transparent' => false,    
		'type'        => 'color',
		'required'    => array('header_toggle','=',array('1')),
	);

	$fields[] = array( 
		'title'       => __( 'Header Top Margin', 'shoestrap' ),
		'desc'        => __( 'Select the top margin of header in pixels. Default: 0px.', 'shoestrap' ),
		'id'          => 'header_margin_top',
		'default'     => 0,
		'min'         => 0,
		'max'         => 200,
		'type'        => 'slider',
		'required'    => array('header_toggle','=',array('1')),
	);

	$fields[] = array( 
		'title'       => __( 'Header Bottom Margin', 'shoestrap' ),
		'desc'        => __( 'Select the bottom margin of header in pixels. Default: 0px.', 'shoestrap' ),
		'id'          => 'header_margin_bottom',
		'default'     => 0,
		'min'         => 0,
		'max'         => 200,
		'type'        => 'slider',
		'required'    => array('header_toggle','=',array('1')),
	);

	// Jumbotron Options
	$section = array(
		'title' => __('Headers', 'shoestrap'),
		'icon'  => 'el-icon-bullhorn icon-large'
	);

	$url = admin_url( 'widgets.php' );
	$fields[] = array(
		'id'        => 'help8',
		'title'     => __( 'Jumbotron', 'shoestrap'),
		'desc'      => __( "A 'Jumbotron', also known as 'Hero' area,
										is an area in your site where you can display in a prominent position things that matter to you.
										This can be a slideshow, some text or whatever else you wish.
										This area is implemented as a widget area, so in order for something to be displayed
										you will have to add a widget from <a href='$url'>here</a>.", 'shoestrap' ),
		'type'      => 'info'
	);

	$fields[] = array(
		'title'     => __('Jumbotron Background Color', 'shoestrap'),
		'desc'      => __('Select the background color for your Jumbotron area. Please note that this area will only be visible if you assign a widget to the \'Jumbotron\' Widget Area. Default: #EEEEEE.', 'shoestrap'),
		'id'        => 'jumbotron_bg',
		'default'   => '#EEEEEE',
		'compiler'  => true,
		'transparent'=> false,    
		'type'      => 'color'
	);


	$fields[] = array(
		'title'     => __('Background position', 'shoestrap'),
		'desc'      => __('Changes how the background image or pattern is displayed from scroll to fixed position. Default: Fixed.', 'shoestrap'),
		'id'        => 'jumbotron_background_fixed_toggle',
		'default'   => 1,
		'on'        => __('Fixed', 'shoestrap'),
		'off'       => __('Scroll', 'shoestrap'),
		'type'      => 'switch'
	);

	$fields[] = array(
		'title'     => __('Use a Background Image', 'shoestrap'),
		'desc'      => __('Enable this option to upload a custom background image for your site. This will override any patterns you may have selected. Default: OFF.', 'shoestrap'),
		'id'        => 'jumbotron_background_image_toggle',
		'default'   => 0,
		'type'      => 'switch'
	);

	$fields[] = array(
		'title'     => __('Upload a Custom Background Image', 'shoestrap'),
		'desc'      => __('Upload a Custom Background image using the media uploader, or define the URL directly.', 'shoestrap'),
		'id'        => 'jumbotron_background_image',
		'required'  => array('jumbotron_background_image_toggle','=',array('1')),
		'default'   => '',
		'type'      => 'media',
		'customizer'=> array(),
	);

	$fields[] = array(
		'title'     => __('Background Image Positioning', 'shoestrap'),
		'desc'      => __('Allows the user to modify how the background displays. By default it is full width and stretched to fill the page. Default: Full Width.', 'shoestrap'),
		'id'        => 'jumbotron_background_image_position_toggle',
		'default'   => 0,
		'required'  => array('jumbotron_background_image_toggle','=',array('1')),
		'on'        => __('Custom', 'shoestrap'),
		'off'       => __('Full Width', 'shoestrap'),
		'type'      => 'switch'
	);

	$fields[] = array(
		'title'     => __('Background Repeat', 'shoestrap'),
		'desc'      => __('Select how (or if) the selected background should be tiled. Default: Tile', 'shoestrap'),
		'id'        => 'jumbotron_background_repeat',
		'required'  => array('jumbotron_background_image_position_toggle','=',array('1')),
		'default'   => 'repeat',
		'type'      => 'select',
		'options'   => array(
			'no-repeat'  => __( 'No Repeat', 'shoestrap' ),
			'repeat'     => __( 'Tile', 'shoestrap' ),
			'repeat-x'   => __( 'Tile Horizontally', 'shoestrap' ),
			'repeat-y'   => __( 'Tile Vertically', 'shoestrap' ),
		),
	);

	$fields[] = array(
		'title'     => __('Background Alignment', 'shoestrap'),
		'desc'      => __('Select how the selected background should be horizontally aligned. Default: Left', 'shoestrap'),
		'id'        => 'jumbotron_background_position_x',
		'required'  => array('jumbotron_background_image_position_toggle','=',array('1')),
		'default'   => 'repeat',
		'type'      => 'select',
		'options'   => array(
			'left'    => __( 'Left', 'shoestrap' ),
			'right'   => __( 'Right', 'shoestrap' ),
			'center'  => __( 'Center', 'shoestrap' ),
		),
	);

	$fields[] = array(
		'title'     => __('Use a Background Pattern', 'shoestrap'),
		'desc'      => __('Select one of the already existing Background Patterns. Default: OFF.', 'shoestrap'),
		'id'        => 'jumbotron_background_pattern_toggle',
		'default'   => 0,
		'type'      => 'switch'
	);

	$fields[] = array(
		'title'     => __('Choose a Background Pattern', 'shoestrap'),
		'desc'      => __('Select a background pattern.', 'shoestrap'),
		'id'        => 'jumbotron_background_pattern',
		'required'  => array('jumbotron_background_pattern_toggle','=',array('1')),
		'default'   => '',
		'tiles'     => true,
		'type'      => 'image_select',
		'options'   => $bg_pattern_images,
	);

	$fields[] = array(
		'title'     => __('Display Jumbotron only on the Frontpage.', 'shoestrap'),
		'desc'      => __('When Turned OFF, the Jumbotron area is displayed in all your pages. If you wish to completely disable the Jumbotron, then please remove the widgets assigned to its area and it will no longer be displayed. Default: ON', 'shoestrap'),
		'id'        => 'jumbotron_visibility',
		'customizer'=> array(),
		'default'   => 1,
		'type'      => 'switch'
	);

	$fields[] = array(
		'title'     => __('Full-Width', 'shoestrap'),
		'desc'      => __('When Turned ON, the Jumbotron is no longer restricted by the width of your page, taking over the full width of your screen. This option is useful when you have assigned a slider widget on the Jumbotron area and you want its width to be the maximum width of the screen. Default: OFF.', 'shoestrap'),
		'id'        => 'jumbotron_nocontainer',
		'customizer'=> array(),
		'default'   => 1,
		'type'      => 'switch'
	);

	$fields[] = array(
		'title'     => __('Use fittext script for the title.', 'shoestrap'),
		'desc'      => __('Use the fittext script to enlarge or scale-down the font-size of the widget title to fit the Jumbotron area. Default: OFF', 'shoestrap'),
		'id'        => 'jumbotron_title_fit',
		'customizer'=> array(),
		'default'   => 0,
		'type'      => 'switch',
	);

	$fields[] = array(
		'title'     => __('Center-align the content.', 'shoestrap'),
		'desc'      => __('Turn this on to center-align the contents of the Jumbotron area. Default: OFF', 'shoestrap'),
		'id'        => 'jumbotron_center',
		'customizer'=> array(),
		'default'   => 0,
		'type'      => 'switch',
	);

	$fields[] = array(
		'title'     => __('Jumbotron Font', 'shoestrap'),
		'desc'      => __('The font used in jumbotron.', 'shoestrap'),
		'id'        => 'font_jumbotron',
		'compiler'  => true,
		'default'   => array(
			'font-family' => 'Arial, Helvetica, sans-serif',
			'font-size'   => 20,
			'color'       => '#333333',
			'google'      => 'false',
			'units'       => 'px'
		),
		'preview'   => array(
			'text'    => __( 'This is my preview text!', 'shoestrap' ), //this is the text from preview box
			'size'    => '30px' //this is the text size from preview box
		),
		'type'      => 'typography',
	);

	$fields[] = array(
		'title'     => __('Jumbotron Header Overrides', 'shoestrap'),
		'desc'      => __('By enabling this you can specify custom values for each <h*> tag. Default: Off', 'shoestrap'),
		'id'        => 'font_jumbotron_heading_custom',
		'default'   => 0,
		'compiler'  => true,
		'type'      => 'switch',
		'customizer'=> array(),
	);

	$fields[] = array(
		'title'     => __('Jumbotron Headers Font', 'shoestrap'),
		'desc'      => __('The main font for your site.', 'shoestrap'),
		'id'        => 'font_jumbotron_headers',
		'compiler'  => true,
		'default'   => array(
			'font-family' => 'Arial, Helvetica, sans-serif',
			'color'       => '#333333',
			'google'      => 'false'
		),
		'preview'   => array(
			'text'    => __( 'This is my preview text!', 'shoestrap' ), //this is the text from preview box
			'size'    => '30px' //this is the text size from preview box
		),
		'type'      => 'typography',
		'required'  => array('font_jumbotron_heading_custom','=',array('1')),
	);

	$fields[] = array(
		'title'     => 'Jumbotron Border',
		'desc'      => __('Select the border options for your Jumbotron', 'shoestrap'),
		'id'        => 'jumbotron_border',
		'type'      => 'border',
		'all'       => false, 
		'left'      => false, 
		'top'       => false, 
		'right'     => false,
		'default'   => array(
			'border-top'      => '0',
			'border-bottom'   => '0',
			'border-style'    => 'solid',
			'border-color'    => '#428bca',
		),
	);

	$section['fields'] = $fields;

	$section = apply_filters( 'shoestrap_module_headers_options_modifier', $section );
	
	$sections[] = $section;
	return $sections;

}
endif;
add_filter( 'redux/options/'.REDUX_OPT_NAME.'/sections', 'shoestrap_module_headers_options', 80 ); 

include_once( dirname( __FILE__ ) . '/functions.extra-header.php' );
include_once( dirname(__FILE__).'/functions.jumbotron.php' );
include_once( dirname(__FILE__).'/variables.php' );

add_filter( 'shoestrap_compiler', 'shoestrap_admin_headers_styles' );
function shoestrap_admin_headers_styles( $bootstrap ) {
	return $bootstrap . '
	@import "' . get_template_directory() . '/lib/modules/headers/styles.less";';
}
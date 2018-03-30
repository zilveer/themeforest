<?php

function shiftnav_get_settings_fields(){

	$prefix = SHIFTNAV_PREFIX;


	$main_assigned = '';
	if(!has_nav_menu('shiftnav')){
		$main_assigned = 'No Menu Assigned';
	}
	else{
    	$menus = get_nav_menu_locations();
    	$menu_title = wp_get_nav_menu_object($menus['shiftnav'])->name;
    	$main_assigned = $menu_title;
    }

    $main_assigned = '<span class="shiftnav-main-assigned">'.$main_assigned.'</span>  <p class="shiftnav-desc-understated">The menu assigned to the <strong>ShiftNav [Main]</strong> theme location will be displayed.  <a href="'.admin_url( 'nav-menus.php?action=locations' ).'">Assign a menu</a></p>';
	


	$fields = array(
		

		$prefix.'shiftnav-main' => array(

			array(
				'name'	=> 'menu_assignment',
				'label'	=> __( 'Assigned Menu' , 'shiftnav' ),
				'desc'	=> $main_assigned,
				'type'	=> 'html',

			),

			array(
				'name' => 'display_main',
				'label' => __( 'Display Main ShiftNav', 'shiftnav' ),
				'desc' => __( '', 'shiftnav' ),
				'type' => 'checkbox',
				'default' => 'on'
			),

			
			/*
			array(
				'name'	=> 'edge',
				'label'	=> __( 'Edge' , 'shiftnav' ),
				'type'	=> 'radio',
				'options' => array(
					'left' => 'Left',
					'right'=> 'Right',
				),
				'default' => 'left'

			),
			*/

			array(
				'name'	=> 'edge',
				'label'	=> __( 'Edge' , 'shiftnav' ),
				'type'	=> 'radio',
				'options' => array(
					'left' => 'Left',
					'right'=> 'Right',
				),
				'default' => 'left'

			),

			array(
				'name'	=> 'skin',
				'label'	=> __( 'Skin' , 'shiftnav' ),
				'type'	=> 'select',
				'options' => shiftnav_get_skin_ops(),
				'default' => 'standard-dark',
				//'options' => get_registered_nav_menus()

			),

			array(
				'name' => 'display_site_title',
				'label' => __( 'Display Site Title', 'shiftnav' ),
				'desc' => __( 'Display the site title in the menu', 'shiftnav' ),
				'type' => 'checkbox',
				'default' => 'on'
			),


			/*
			array(
				'name' => 'inherit_ubermenu_icons',
				'label' => __( 'Inherit UberMenu Icons', 'shiftnav' ),
				'desc' => __( 'Display the icon from the UberMenu icon setting if no icon is selected', 'shiftnav' ),
				'type' => 'checkbox',
				'default' => 'off'
			),
			*/

		),
			// array( 
			// 	'name'	=> 'section_toggle',
			// 	'label'	=> '<h4 class="shiftnav-settings-section">'.__( 'Top Bar Toggle Settings' , 'shiftnav' ).'</h4>',
			// 	'desc'	=> '<span class="shiftnav-desc-understated">'.__( 'These settings control the main ShiftNav toggle' , 'shiftnav' ).'</span>',
			// 	'type'	=> 'html',
			// ),


		$prefix.'togglebar' => array(
			array(
				'name' => 'display_toggle',
				'label' => __( 'Display Toggle Bar', 'shiftnav' ),
				'desc' => __( '', 'shiftnav' ),
				'type' => 'checkbox',
				'default' => 'on'
			),
			array(
				'name' => 'breakpoint',
				'label' => __( 'Toggle Breakpoint', 'shiftnav' ),
				'desc' => __( 'Show the toggle bar only below this pixel width.  Leave blank to show at all times.  Do not include "px"', 'shiftnav' ),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'hide_theme_menu',
				'label' => __( 'Hide Theme Menu', 'shiftnav' ),
				'desc' => __( 'Enter the selector of the theme\'s menu if you wish to hide it below the breakpoint above.  For example, <code>#primary-nav</code> or <code>.topnav</code>.', 'shiftnav' ),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name'	=> 'toggle_content',
				'label'	=> __( 'Toggle Content' , 'shiftnav' ),
				'desc'	=> __( '[shift_toggle_title]' , 'shiftnav' ),
				'type'	=> 'textarea',
				'default' => '[shift_toggle_title]', //get_bloginfo( 'title' )
			),
			array(
				'name'	=> 'align',
				'label' => __( 'Align Text' , 'shiftnav' ),
				'desc'	=> __( 'Align text left, right, or center.  Applies to inline elements only.', 'shiftnav' ),
				'type'	=> 'radio',
				'options' => array(
					'center'=> 'Center',
					'left'	=> 'Left',
					'right'	=> 'Right',
				),
				'default' => 'center',
			),

			array(
				'name'	=> 'background_color',
				'label'	=> __( 'Background Color' , 'shiftnav' ),
				'desc'	=> __( '' , 'shiftnav' ),
				'type'	=> 'color',
				//'default' => '#1D1D20',
			),

			array(
				'name'	=> 'text_color',
				'label'	=> __( 'Text Color' , 'shiftnav' ),
				'desc'	=> __( '' , 'shiftnav' ),
				'type'	=> 'color',
				//'default' => '#eeeeee',
			),
			

			/*
			array(
				'name' => 'display_condition',
				'label' => __( 'Display on', 'shiftnav' ),
				'desc' => __( '', 'shiftnav' ),
				'type' => 'multicheck',
				'options' => array(
					'all' 	=> 'All',
					'posts' => 'Posts',
					'pages' => 'Pages',
					'home' 	=> 'Home Page',
					'blog'	=> 'Blog Page',
				),
				'default' => array( 'all' => 'all' )
			),
			*/
			
		),
		
	);
	
	$fields = apply_filters( 'shiftnav_settings_panel_fields' , $fields );

	$fields[$prefix.'general'] = array(
		
		
		array(
			'name' 		=> 'admin_tips',
			'label' 	=> __( 'Show Tips to Admins', 'shiftnav' ),
			'desc' 		=> __( 'Display tips to admin users', 'shiftnav' ),
			'type' 		=> 'checkbox',
			'default' 	=> 'on'
		),

		array(
			'name' 		=> 'lock_body',
			'label' 	=> __( 'Lock Scroll', 'shiftnav' ),
			'desc' 		=> __( 'Prevent the content from scrolling horizontally when the menu is active.  On some themes, may also prevent vertical scrolling.', 'shiftnav' ),
			'type' 		=> 'checkbox',
			'default' 	=> 'on'
		),

		array(
			'name' 		=> 'load_fontawesome',
			'label' 	=> __( 'Load Font Awesome', 'shiftnav' ),
			'desc' 		=> __( 'If you are already loading Font Awesome 4 elsewhere in your setup, you can disable this.', 'shiftnav' ),
			'type' 		=> 'checkbox',
			'default' 	=> 'on'
		),

		array(
			'name' => 'inherit_ubermenu_conditionals',
			'label' => __( 'Inherit UberMenu Conditionals', 'shiftnav' ),
			'desc' => __( 'Display menu items based on UberMenu Conditionals settings', 'shiftnav' ),
			'type' => 'checkbox',
			'default' => 'off'
		),

		/*
		array(
			'name' => 'radio',
			'label' => __( 'Radio Button', 'shiftnav' ),
			'desc' => __( 'A radio button', 'shiftnav' ),
			'type' => 'radio',
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		),
		array(
			'name' => 'multicheck',
			'label' => __( 'Multile checkbox', 'shiftnav' ),
			'desc' => __( 'Multi checkbox description', 'shiftnav' ),
			'type' => 'multicheck',
			'options' => array(
				'one' => 'One',
				'two' => 'Two',
				'three' => 'Three',
				'four' => 'Four'
			)
		),
		array(
			'name' => 'selectbox',
			'label' => __( 'A Dropdown', 'shiftnav' ),
			'desc' => __( 'Dropdown description', 'shiftnav' ),
			'type' => 'select',
			'default' => 'no',
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No'
			)
		)
		*/
		
	);


	return $fields;
}

function shiftnav_get_settings_sections(){

	$prefix = SHIFTNAV_PREFIX;

	$sections = array(
		/*array(
			'id' => $prefix.'basics',
			'title' => __( 'Basic Configuration', 'shiftnav' )
		),*/
		array(
			'id' => $prefix.'shiftnav-main',
			'title' => __( 'Main ShiftNav Settings', 'shiftnav' )
		),
		array(
			'id' => $prefix.'togglebar',
			'title' => __( 'Toggle Bar', 'shiftnav' )
		)
	);

	$sections = apply_filters( 'shiftnav_settings_panel_sections' , $sections );

	$sections[] = array(
		'id'	=> $prefix.'general',
		'title'	=> __( 'General Settings' , 'shiftnav' ),
	);

	return $sections;

}

/**
 * Registers settings section and fields
 */
function shiftnav_admin_init() {

	$prefix = SHIFTNAV_PREFIX;
 
 	$sections = shiftnav_get_settings_sections();
 	$fields = shiftnav_get_settings_fields();

 	//set up defaults so they are accessible
	_SHIFTNAV()->set_defaults( $fields );

	
	$settings_api = _SHIFTNAV()->settings_api();

	//set sections and fields
	$settings_api->set_sections( $sections );
	$settings_api->set_fields( $fields );

	//initialize them
	$settings_api->admin_init();

}
add_action( 'admin_init', 'shiftnav_admin_init' );

function shiftnav_init_frontend_defaults(){
	if( !is_admin() ){
		_SHIFTNAV()->set_defaults( shiftnav_get_settings_fields() );
	}
}
add_action( 'init', 'shiftnav_init_frontend_defaults' );

/**
 * Register the plugin page
 */
function shiftnav_admin_menu() {
	add_submenu_page(
		'themes.php',
		'ShiftNav Settings',
		'ShiftNav',
		'manage_options',
		'shiftnav-settings',
		'shiftnav_settings_panel'
	);
	//add_options_page( 'Settings API', 'Settings API', 'manage_options', 'settings_api_test', 'shiftnav_plugin_page' );
}
 
add_action( 'admin_menu', 'shiftnav_admin_menu' );


function shiftnav_get_nav_menu_ops(){
	$menus = wp_get_nav_menus( array('orderby' => 'name') );
	$m = array( '_none' => 'Choose Menu, or use Theme Location Setting' );
	foreach( $menus as $menu ){
		$m[$menu->slug] = $menu->name;
	}
	return $m;
}

function shiftnav_get_theme_location_ops(){
	$locs = get_registered_nav_menus();
	$default = array( '_none' => 'Select Theme Location or use Menu Setting' );
	//$locs = array_unshift( $default, $locs );
	$locs = $default + $locs;
	//shiftp( $locs );
	return $locs;
}


/**
 * Display the plugin settings options page
 */
function shiftnav_settings_panel() {
	
	$settings_api = _SHIFTNAV()->settings_api();
 
	echo '<div class="wrap">';
	settings_errors();

	echo '<h2>ShiftNav</h2>';

	do_action( 'shiftnav_settings_before' );	
 
	$settings_api->show_navigation();
	$settings_api->show_forms();

	do_action( 'shiftnav_settings_after' );
 
	echo '</div>';
}




/**
 * Get the value of a settings field
 *
 * @param string $option settings field name
 * @param string $section the section name this field belongs to
 * @param string $default default text if it's not found
 * @return mixed
 */
function shiftnav_op( $option, $section, $default = null ) {
 
	$options = get_option( SHIFTNAV_PREFIX.$section );

	if ( isset( $options[$option] ) ) {
		return $options[$option];
	}

	if( $default == null ){
		//$default = _SHIFTNAV()->settings_api()->get_default( $option, SHIFTNAV_PREFIX.$section );
		$default = _SHIFTNAV()->get_default( $option, SHIFTNAV_PREFIX.$section );
	}

	return $default;
}
function shiftnav_get_instance_options( $instance ){
	//echo SHIFTNAV_PREFIX.$instance;
	$defaults = _SHIFTNAV()->get_defaults( SHIFTNAV_PREFIX.$instance );
	$options = get_option( SHIFTNAV_PREFIX.$instance , $defaults );
	if( !is_array( $options ) || count( $options ) == 0 ) return $defaults;
	return $options;
}

function shiftnav_admin_panel_styles(){
	?>
<style>
.form-table th{
	padding-left:15px;	
}
h2.nav-tab-wrapper{
	padding-left:0;
}


.shiftnav_instance_manager{

}
a.shiftnav_instance_toggle{

	float:right;
}
.shiftnav_instance_container_wrap,
.shiftnav_instance_notice_wrap{
	position:fixed;
	z-index:999;
	background:#444;
	background:rgba(0,0,0,.7);

	left:0;
	top:0;
	width:100%;
	height:100%;

	display:none;
}
.shiftnav_instance_container,
.shiftnav_instance_notice{
	display:table;
	height:auto;

	background:#e9e9e9;
	padding:20px;

	width: 50%;
	overflow: auto;
	margin: auto;
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
}

.shiftnav_instance_container h3{
	margin-top:0;
}

form.shiftnav_instance_form{
	float:left;
	width:100%;
	margin:0 0 20px 0;

}

input.shiftnav_instance_input{
	padding:10px;
	height:40px;
	box-sizing:border-box;
	display:block;
	float:left;
	width:80%;
	margin:0;

	border:none;
}
a.shiftnav_instance_button{
	display:inline-block;
	padding:10px;
	height:40px;
	
	box-sizing:border-box;
	margin:0;
	background:#12B365;
	text-align:center;
	color:#fff;
	font-weight:bold;
	cursor:pointer;
	text-decoration: none;
}
.shiftnav_instance_container a.shiftnav_instance_button{
	float:left;
	width:20%;
}
.shiftnav_instance_form_desc{
	display:block;
	clear:both;
	margin:20px 0;
}
a.shiftnav_instance_button_delete{
	background:#B31212;	
}

code.shiftnav-highlight-code{
	border-left:2px solid #12B365;
	background:#eee; /*#C4E9D7;*/
	padding:10px;
	display:block;
	float:left;
	font-size:11px;
	max-width:500px;
}
.form-table p.shiftnav-sub-desc{
	clear:both;
	display:block;
	padding:10px 0;
}

.shiftnav-desc-row{
	display:block;
	float:left;
	clear:both;
	margin-bottom:10px;
}
.shiftnav-code-snippet-type{
	float:left;
	clear:both;
	width:60px;
	padding:10px;
	font-size:11px;
	text-transform: uppercase;
	text-align:right;
}

h4.shiftnav-settings-section{
	color:#666;
	font-size:16px;
}
.shiftnav-desc-understated{
	font-size:12px;
	color:#999;
	font-style:italic;
}
.image-setting-wrap{
	float:left;
}
.image-setting-wrap img{
	max-width:200px;
	background:#eee;
}
.set-image-wrapper input.button{
	clear:both;
	float:left;
	margin:10px 10px 10px 0;
}
.remove-button{
	font-size:10px;
	float:left;
	padding:15px;
}
</style>
	<?php
}
add_action( 'admin_head-appearance_page_shiftnav-settings' , 'shiftnav_admin_panel_styles' );

function shiftnav_admin_panel_assets( $hook ){

	if( $hook == 'appearance_page_shiftnav-settings' ){
		wp_enqueue_script( 'shiftnav' , SHIFTNAV_URL . 'admin/assets/admin.settings.js' );
	}
}
add_action( 'admin_enqueue_scripts' , 'shiftnav_admin_panel_assets' );



function shiftnav_check_menu_assignment(){
	$display = shiftnav_op(  'display_main' , 'shiftnav-main' );

	if( $display == 'on' ){
		if( !has_nav_menu( 'shiftnav' ) ){
			?>
			<div class="update-nag"><strong>Important!</strong> There is no menu assigned to the <strong>ShiftNav [Main]</strong> Menu Location.  <a href="<?php echo admin_url( 'nav-menus.php?action=locations' ); ?>">Assign a menu</a></div>
			<br/><br/>
			<?php
		}
	}
}
add_action( 'shiftnav_settings_before' , 'shiftnav_check_menu_assignment' );

function shiftnav_allow_html( $str ){
	return $str;
}
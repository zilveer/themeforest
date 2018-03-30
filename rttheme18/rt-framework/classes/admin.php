<?php
#-----------------------------------------
#	RT-Theme admin.php
#	version: 1.0
#-----------------------------------------

#
#	Admin Class
#

class RTThemeAdmin extends RTTheme{

	private $panel_pages = array(); 
	private $admin_notices = array();

	function admin_init(){ 

		//panel pages
		$this->panel_pages = array(
			'rt_general_options'    => __("General Options", "rt_theme_admin"),
			'rt_template_options'   => __('Template Builder', 'rt_theme_admin'),
			'rt_styling_options'    => __('Styling Options' , 'rt_theme_admin'),
			'rt_header_options'     => __('Header Options' , 'rt_theme_admin'),
			'rt_footer_options'     => __('Footer Options' , 'rt_theme_admin'),
			'rt_typography_options' => __('Typography Options' , 'rt_theme_admin'),
			'rt_sidebar_options'    => __('Sidebar Creator' , 'rt_theme_admin'),
			'rt_blog_options'       => __('Blog Options' , 'rt_theme_admin'),
			'rt_portfolio_options'  => __('Portfolio Options' , 'rt_theme_admin'),
			'rt_product_options'    => __('Product Options', 'rt_theme_admin'),
			'rt_social_options'     => __('Social Media Options', 'rt_theme_admin'),
			'rt_woocommerce_options'=> __('WooCommerce Options', 'rt_theme_admin'),
			'rt_setup_assistant'    => __('Setup Assistant', 'rt_theme_admin')
		); 

		//check woocommerce
		if ( ! class_exists( 'Woocommerce' ) ) {
			unset($this->panel_pages["rt_woocommerce_options"]);
		}

		// Load text domain
		load_theme_textdomain('rt_theme_admin', get_template_directory().'/rt-framework/admin/languages' );

		//admin notices 
		add_action('admin_notices', array(&$this,'rt_admin_notices')); 	

		//Export Templates 
		add_action('admin_init', array(&$this,'rt_admin_export_templates')); 

		//Import Templates 
		add_action('admin_init', array(&$this,'rt_admin_import_templates')); 

		//Theme Version
		$this->rt_get_theme_version();

		//Load Admin Functions
		$this->load_admin_functions();
		 
		//Load Admin Classes
		$this->load_admin_classes(); 

		//First time check or reset 
		add_action('admin_init', array(&$this,'rt_first_time')); 

		//Update Notifier
		add_action('admin_menu', array(&$this,'update_notifier_menu'));		

		//Setup Admin Menu
		add_action('admin_menu', array(&$this,'rt_admin_menus'));
		
		//Load Scripts
		add_action('admin_enqueue_scripts', array(&$this,'load_admin_scripts'));
		
		//Load Styles
		add_action('admin_enqueue_scripts', array(&$this,'load_admin_styles'));

		//Create Metaboxes
		$this->create_metaboxes();		 
		
		//Call Ajax function
		add_action('wp_ajax_my_action', array(&$this,'rt_admin_ajax') );

		//javascript variables
		add_filter("admin_head", array(&$this,'javascript_variables'));

		//javascript messages
		add_filter("admin_head", array(&$this,'javascript_messages'));  
	
		// Hook into the 'wp_before_admin_bar_render' action
		add_action( 'wp_before_admin_bar_render', array(&$this,'custom_toolbar') , 999 ); 

	} 



	#
	#	Export Templates
	#
	function rt_admin_export_templates(){
		global $RTThemePageLayoutOptionsClass;		 
		if( ( isset( $_GET['templateBuilder'] ) && $_GET['templateBuilder']=="true" ) &&  ( isset( $_GET['export_template'] ) && $_GET['export_template']=="true" ) ){  
			$selectedTemplate = isset( $_GET['selectedTemplate'] ) ? $_GET['selectedTemplate'] : ""; 
			$RTThemePageLayoutOptionsClass->rt_export_page_templates( $selectedTemplate );	  
			die();
		}
	}


	#
	#	Import Templates
	#
	function rt_admin_import_templates(){ 
							  
		global $RTThemePageLayoutOptionsClass, $wp_filesystem;

		//check if import form submitted
		if( ! isset( $_GET['templateBuilder'] )  || ! isset( $_GET['import_template'] ) ){  
			return false;
		}
			
		if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );

		$uploadedfile = isset( $_FILES['import'] ) ? $_FILES['import'] : "";

		if ( ! $uploadedfile ) {
			return false; 
		}

		//check upload error
		if ( $uploadedfile && $uploadedfile["error"] ) {
			$error = __("Error!", "rt_theme_admin") . $uploadedfile["error"];

			array_push( $this->admin_notices, array("text"=>$error,"type"=>"error") );

			return false;
		}

		//check file type
		if ( $uploadedfile && $uploadedfile["type"] != "text/plain" ) {
			$error = __("Invalid file type!", "rt_theme_admin"); 

			array_push( $this->admin_notices, array("text"=>$error,"type"=>"error") );

			return false;
		}

		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

		if ( isset( $movefile ) ) {

			//check file error
			if ( $movefile && isset( $movefile["error"] ) ) {
				$error = __("Error!", "rt_theme_admin") . $movefile["error"];
 
				array_push( $this->admin_notices, array("text"=>$error,"type"=>"error") );

				return false;
			}

			//Get Credentials
			$url = wp_nonce_url('admin.php?page=rt_template_options&templateBuilder=true&import_template=true','rt-theme-import');
			if (false === ( $creds = request_filesystem_credentials($url, '', false, false, null ) ) ) {
				return; // stop processing here
			}

			//Initialize WP_Filesystem_Base   
			if ( ! WP_Filesystem( $creds ) ) {
				request_filesystem_credentials($url, '', true, false, null);
				return;
			}

			$file_content = $wp_filesystem->get_contents( $movefile["file"] );			

			//file is valid and there is no error - import the templates 
			$import_templates = $RTThemePageLayoutOptionsClass->rt_import_page_templates($file_content);	  

			if( $import_templates ) {
				//imported successfully
				array_push( $this->admin_notices, array("text"=>__("Templates imported successfully.","rt_theme_admin"),"type"=>"updated") );			
			}else{
				//error
				array_push( $this->admin_notices, array("text"=>__("ERROR: Templates could not be imported!","rt_theme_admin"),"type"=>"error") );		
			}

		} else {
		    //Possible file upload attack!
		    return false;
		}

	}	


	#
	#	Fist time loading or resetted
	#
	function rt_first_time() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return ;
		}

		//Save Default Options - First time loading or options resetted 
		if( get_option(RT_THEMESLUG.'_'.RT_UTHEME_NAME.'_defaults') != 'saved' || ( isset($_GET['reset_settings']) && $_GET['reset_settings']=='true' ) ){ 

			//reset options
			$this->rt_admin_reset(); 

		}
	}

	#
	#	Reset Theme Options
	#
	function rt_admin_reset(){

		if ( ! current_user_can( 'manage_options' ) ) {
			return ;
		}

		global $RTThemePageLayoutOptionsClass;
		
		if( isset( $_GET['reset_settings'] ) ){
			$options_to_reset = $_GET['page'];
		}else{
			$options_to_reset = "all";
		}


		if( $options_to_reset  == "all" ){

			//reset options
			$this->rt_save_defaults();

			//Delete all templates
			$RTThemePageLayoutOptionsClass->rt_delete_templates();

			//create default templates		
			$RTThemePageLayoutOptionsClass->rt_create_default_templates();

			//theme options resetted for the first time and detault templates installed
			update_option(RT_THEMESLUG.'_'.RT_UTHEME_NAME.'_defaults','saved'); 

		}elseif( $options_to_reset  == "rt_template_options" ){

			//Delete all templates
			$RTThemePageLayoutOptionsClass->rt_delete_templates();

			//create default templates		
			$RTThemePageLayoutOptionsClass->rt_create_default_templates();
 
			array_push( $this->admin_notices, array("text"=>__("TEMPLATE BUILDER RESETTED","rt_theme_admin"),"type"=>"updated") );	

		}else{

			//reset options
			$this->rt_save_defaults(); 

			array_push( $this->admin_notices, array("text"=>__("OPTIONS RESETTED","rt_theme_admin"),"type"=>"updated") );

		}

	} 
 


	#
	#	Admin notices
	#
	function rt_admin_notices(){  

		if( is_array( $this->admin_notices ) ){
			foreach ( $this->admin_notices as $key => $value) {
				echo '<div id="notice" class="'.$value["type"].'"><p>'.$value["text"].'</p></div>';
			}
		}
	}   


	#
	#	Save Default Values	& Create T.Builder Tables
	#
	
	function rt_save_defaults() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return ;
		}

		if( isset( $_GET['reset_settings'] ) ){
			$options_to_reset = $_GET['page'];
		}else{
			$options_to_reset = "all";
		}
		

		//save defaults
		foreach($this->panel_pages  as $menu_slug => $page_title){
 
			if( $menu_slug != "rt_sidebar_options" && $menu_slug != "rt_template_options" && $menu_slug != "rt_setup_assistant" && $menu_slug != "update_notifications" ){			
				
				if( $options_to_reset == "all" || $options_to_reset == $menu_slug ){

					include(RT_THEMEADMINDIR . "/options/$menu_slug.php");
		
					if(is_array($options)){
						foreach($options as $k => $v){
							$id = isset( $v['id'] ) ? $v['id'] : "";
							$default = isset( $v['default'] ) ? $v['default'] : "";
							$dont_save = isset( $v['dont_save'] ) ? $v['dont_save'] : "";

							if( $default && ! $dont_save) {
								update_option( $id, stripslashes( $default) );
							}else{
								update_option( $id, '' );
							}
						}
					} 
				} 
			}
		} 
	}


	#
	#	Add Toolbar Menus
	#
	function custom_toolbar() {
		global $wp_admin_bar;
 
		$args = array(
			'id'     => 'rt_icons',
			'title'  => '<div><span class="icon-rocket-1"></span>'.__( 'Icons', 'rt_theme_admin' ) .'</div>',		
			'group'  => false 
		);

		$wp_admin_bar->add_menu( $args ); 
	}
	 
	#
	#	Load Admin Classes
	#
	
	function load_admin_classes() {
		global $RTThemePageLayoutOptionsClass, $pageLayoutClass;

		//Template builder
		include(RT_THEMEFRAMEWORKDIR . "/template_builder/page_layouts.php"); 
		include(RT_THEMEFRAMEWORKDIR . "/template_builder/page_layout_options.php");  

		//Shortcode Helper
		include(RT_THEMEFRAMEWORKDIR . "/classes/shortcode_helper.php");  	 
		 
	}   

	#
	#	Admin Ajax Process
	#

	function rt_admin_ajax() {
		global $wpdb,$RTThemePageLayoutOptionsClass,$pageLayoutClass,$rt_sidebars_class;

		if( isset( $_POST['iconSelector'] ) ){//icon selection
			$this->icon_selection();
			return ;
		}

		if( isset( $_POST['shortcode_helper'] ) ){//icon selection	
			$rt_shortcode_helper = new rt_shortcode_helper;
			echo $rt_shortcode_helper->create_shortcode_list();
			return ;
		} 

		if( isset( $_POST['rt_theme_gallery'] ) ){ // returns new gallery form
 
			$rt_gallery_upload_options = new rt_meta_box_gallery();
			$rt_gallery_upload_options -> createPhotoForm(); 	

			return ;
		}

		//admin access only jobs
		if ( ! current_user_can( 'manage_options' ) ) {
			return ;
		}
		
		if(! isset($_POST['saveoptions'] ) && !isset( $_POST['rt_theme_gallery'] )  && !isset( $_POST['clone'] ) && !isset( $_POST['generateForms'] ) && !isset( $_POST['new_template'] ) && !isset( $_POST['templateBuilder'] ) && ! isset( $_POST['sidebarCreator'] ) ){ // returns an option box for the template builder			

			$theTemplateID 	= $_POST['theTemplateID'];
			$theGroupID 	= $_POST['theGroupID'];
			$selectedItem 	= $_POST['selectedItem'];  
			$randomClass  	= $_POST['randomClass'];
			$options  		= "";			
	
			//create a box as requested
			if( isset( $selectedItem )){
				$function_name = 'rt_generate_'.$selectedItem; 
				$class_name = $function_name.'_class'; 
 					 
				require_once(RT_THEMEFRAMEWORKDIR . "/template_builder/modules/{$selectedItem}.php"); 
				$class_name = new $class_name;
				$class_name->$function_name($theGroupID,$theTemplateID,$options,$randomClass);
			} 

		}elseif( isset( $_POST['delete_template'] ) && isset( $_POST['templateID'] ) ) { //deletes a template
  
			echo $RTThemePageLayoutOptionsClass->rt_delete_templates( $_POST['templateID'] ); 
			 
			echo __('Template deleted successfully', 'rt_theme_admin');	

		}elseif( isset( $_POST['clone'] ) && isset( $_POST['thisTemplateID'] ) &&  $_POST['thisTemplateID'] != "" ){//clone template


			//get the cloned tempalte
			$cloned_Template = $pageLayoutClass->get_template_data( $_POST['thisTemplateID'] );			

			//new template ID
			$new_Template_ID = "templateid_".rand(100000, 1000000);

			//new template name 
			$new_Template_Name = $cloned_Template->templates[ $_POST['thisTemplateID'] ]->templateName." [clone]";
 
			//New name and ID
			$new_Template  =  new stdClass; 
			$new_Template->templates[ $new_Template_ID ] =  new stdClass;
			$new_Template->templates[ $new_Template_ID ] =  $cloned_Template->templates[ $_POST['thisTemplateID'] ]; 
			$new_Template->templates[ $new_Template_ID ]->templateID = $new_Template_ID; 
			$new_Template->templates[ $new_Template_ID ]->templateName = $new_Template_Name; 
 
			//save the object	 
			update_option( RT_THEMESLUG."_".$new_Template_ID, $new_Template);

			//get the saved template names
			$saved_template_names = get_option(RT_THEMESLUG.'_template_names_array');
 

			//add the new template name to the list
			if( is_array ( $saved_template_names ) ){
 
				//new template array
				$newTemplateArray  = array(
										$new_Template_ID => array(
											"name" => $new_Template_Name,
											"is_default_template" => false,
											"default_template_data" => ''
										)
									);
 
				//update the list
				update_option(RT_THEMESLUG.'_template_names_array',  array_merge( $saved_template_names, $newTemplateArray ) ); 

			}

			echo __('Template cloned successfully', 'rt_theme_admin');	

		}elseif( isset( $_POST['generateForms'] ) && isset( $_POST['thisTemplateID'] ) &&  $_POST['thisTemplateID'] != "" ){//generate template forms

			$pageLayoutClass->generate_template_content_forms( $_POST['thisTemplateID'] ); 

		}elseif( ( isset( $_POST['templateBuilder'] ) && $_POST['templateBuilder']=="true" ) &&  ( isset( $_POST['new_template'] ) && $_POST['new_template']=="true" ) ){//create new template

			$RTThemePageLayoutOptionsClass->rt_save_page_templates();	 

			echo __('New template created successfully', 'rt_theme_admin');	 

		}elseif( ( isset( $_POST['templateBuilder'] ) && $_POST['templateBuilder']=="true" ) &&  ( isset( $_POST['export_template'] ) && $_POST['export_template']=="true" ) ){//export template

			$RTThemePageLayoutOptionsClass->rt_export_page_templates();	 

			echo __('Templates exported successfully', 'rt_theme_admin');	 

		}elseif( ( isset( $_POST['sidebarCreator'] ) && $_POST['sidebarCreator']=="true" ) &&  ( isset( $_POST['new_sidebar'] ) && $_POST['new_sidebar']=="true" ) ){//create new sidebar

			$rt_sidebars_class->create_sidebar( $_POST['sidebarID'], $_POST['sidebarName'] );	 
  
			echo __('New sidebar created successfully', 'rt_theme_admin');	 

		}elseif( ( isset( $_POST['sidebarCreator'] ) && $_POST['sidebarCreator']=="true" ) &&  ( isset( $_POST['update_sidebar'] ) && $_POST['update_sidebar']=="true" ) ){//update sidebar

			$rt_sidebars_class->update_sidebar( $_POST['sidebarID'], $_POST['sidebarName'] );	 
  
			echo __('Sidebar updated successfully', 'rt_theme_admin');	  

		}elseif( ( isset( $_POST['sidebarCreator'] ) && $_POST['sidebarCreator']=="true" ) &&  ( isset( $_POST['enable_sidebar'] )) ){//enable / disable sidebar

			$rt_sidebars_class->enable_sidebar( $_POST['sidebarID'], $_POST['visibility'] );	 

		}elseif( ( isset( $_POST['sidebarCreator'] ) && $_POST['sidebarCreator']=="true" ) &&  ( isset( $_POST['delete_sidebar'] )) ){//delete sidebar

			$rt_sidebars_class->delete_sidebar( $_POST['sidebarID'] );	 

		}else{ //	Save options via AJAX
			
			if( isset( $_POST['templateBuilder'] ) && $_POST['templateBuilder']=="true" ){ // save template options
				$RTThemePageLayoutOptionsClass->rt_save_page_templates();	  
			}
			
			else{ // save regular options 
				include(RT_THEMEADMINDIR . "/options/".$_POST['formid'].".php");				
				$this->rt_save_options($options,$_POST);  

				//add mark to flush rewrite rules
				if( $_POST['formid'] == "rt_product_options" || $_POST['formid'] == "rt_portfolio_options" ) {
					update_option("rt_rewrite_rules","");
				}
			}

			echo __('Options saved successfully', 'rt_theme_admin');	
		} 

		die();
		
	} 

	#
	#	Icon Selection
	#
	
	function icon_selection() {  
		
		echo'
			<div class="rt_modal icon-selection">
				<div class="window_bar">
					<div class="title">'. __('Icons', 'rt_theme_admin').'</div>
					<div class="left"><input type="text" name="icon_search" id="rt_icon_search" value="" placeholder="'. __('search', 'rt_theme_admin').'"><span id="rt_icon_search_result"></span></div>
					<div class="icon_selection_close rt_modal_control" title="'. __('Close', 'rt_theme_admin').'"><span class="icon-cancel"></span></div>
				</div>
			<div class="modal_content"><ul class="list-icons">
		';

		$json = "";

		//the json file of the fontello
		$fontello_json_file =  "/css/fontello/config.json";

		//get json file of the fontello font url with locate media file check if a json file is exist in the child theme
		$fontello_json_url = rt_locate_media_file( $fontello_json_file ) ; 

		//try with wp_remote_fopen first
		$json = wp_remote_fopen( $fontello_json_url ); 
 
		//try to include if no json returned
		if ( ! json_decode($json) ){
			ob_start(); 

			if( file_exists( get_stylesheet_directory(). $fontello_json_file ) ){
				include( get_stylesheet_directory(). $fontello_json_file ); 
			}else{
				include( get_template_directory() . $fontello_json_file  ); 
			}
				
			$json = ''.ob_get_contents().'';
			ob_end_clean(); 
		}

		//paste the list output
		if ( $json ){
			$json_output = json_decode($json);

			if( $json_output ){
				$icon_prefix = $json_output->css_prefix_text;

				$format = '<li class="%2$s%1$s"><span>%2$s%1$s</span></li>';
				echo sprintf($format, "blank", "");

				foreach ( $json_output->glyphs as $icon_name )
				{			     
					echo sprintf($format, $icon_name->css, $icon_prefix);
				}			
			}
		}	

		echo '</ul></div>';

	}


	#
	#	Load Admin Functions
	#
	
	function load_admin_functions() {		
		include(RT_THEMEFRAMEWORKDIR . "/admin/functions/update_notifier.php");	
	}
	
	#
	#	Update Notifier
	#	

	function update_notifier_menu() {  
		global $rt_update_xml, $rt_themeupdatestatus;
			$rt_themeupdatestatus = get_option(RT_THEMESLUG.'_update_notifications');
			$update = ""; 
			
			if($rt_themeupdatestatus){
				$rt_update_xml 	= rt_get_latest_theme_version(RT_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server

				if( (float) $rt_update_xml->latest > (float) $this->version ) { // Compare current theme version with the remote XML version
					$update = '<span class="update-plugins count-1"><span class="update-count">'.$rt_update_xml->latest.'</span></span>';
				}
			}
				 
				$k = array('update_notifications' => __("Theme Updates ",'rt_theme_admin') .$update);
				array_merge($this->panel_pages, $k);
				$this->panel_pages = array_merge($this->panel_pages, $k);
	}
		
		
	#
	#	Javascript Messages
	#

	function javascript_messages(){
	
		$jMessages=array( 
					"sidebar_names_confirm" => __("Sidebar names cannot be empty.",'rt_theme_admin'),					
					"sidebar_delete_confirm" => __("Are you sure you want to delete this sidebar?",'rt_theme_admin'),
					"new_sidebar_name_confirm" => __("Write a sidebar name for the new sidebar.",'rt_theme_admin'),
					"new_sidebar_content_confirm" => __("Select contents for the sidebar.",'rt_theme_admin'),
					"box_delete_confirm" => __("Are you sure you want to delete this box?",'rt_theme_admin'),
					"line_delete_confirm" => __("Are you sure you want to delete this line?",'rt_theme_admin'),
					"column_delete_confirm" => __("This column and it\'s modules will be deleted. Do you want to proceed?",'rt_theme_admin'),
					"row_delete_confirm" => __("This row and it\'s modules will be deleted. Do you want to proceed?",'rt_theme_admin'),
					"row_count_error" => __("You need at least one row in your template. Create a new row before delete this one.",'rt_theme_admin'),					
					"template_delete_confirm" => __("Are you sure you want to delete this template?",'rt_theme_admin'),
					"template_names_confirm" => __("Template names cannot be empty.",'rt_theme_admin'),
					"template_contents_confirm" => __("You have no contents for this tempalte, please add one.",'rt_theme_admin'),			
					"delete_confirm" => __("Are you sure you want to delete?",'rt_theme_admin'),					
					"header_row_limits" => __("Header row only accepts slider modules!",'rt_theme_admin'),	
					"select_a_template"	=> __("Select a template to save.",'rt_theme_admin'),				
					"save_control_message"	=> __('Template changed! Do you want to close without saving the changes?','rt_theme_admin'),		
					"err_max_input_vars"	=> __('It is impossible to save the template! \n ERR: The template is too big! Increase the "max_input_vars" to a higher value in your php.ini. To do so you might need to contact your hosting provider or consult your control panel settings.','rt_theme_admin'),
					"reset_template_builder"	=> __('Are you sure that you want reset template builder and delete all the templates you created?','rt_theme_admin')
				);
		
		if($jMessages){
			$output = "\n";
			$output .= '<script type="text/javascript">'."\n";
			$output .= '//<![CDATA['."\n";
				foreach($jMessages as $k => $v){
					$output .= 'var '.$k.'=\''.$v.'\';'."\n";
				}
			$output .= '//]]>'."\n";
			$output .= '</script>'."\n";
		}

		echo $output;	
	
	}

	#
	#	Javascript Variables
	#

	function javascript_variables(){

		$max_input_vars = ini_get('max_input_vars');
		$max_input_vars = ! empty( $max_input_vars ) && is_numeric( $max_input_vars ) ? $max_input_vars : 0 ;

		//variables as array
		$jVariables=array( 
					"RT_THEMEADMINURI" => RT_THEMEADMINURI,
					"frameworkurl"	 => RT_THEMEADMINURI.'/pages/rt-fonts.php',
					"max_input_vars" => $max_input_vars
					);
		
		if($jVariables){
			$output = "\n";
			$output .= '<script type="text/javascript">'."\n";
			$output .= '//<![CDATA['."\n";
				foreach($jVariables as $k => $v){
					$output .= 'var '.$k.'=\''.$v.'\';'."\n";
				}
			$output .= '//]]>'."\n";
			$output .= '</script>'."\n";
		}  
		
		echo $output;	
	}
	

	#
	#	Admin Panel
	#

	function rt_admin_menus(){
	
		$capability = 'edit_theme_options'; // Administrator can acsess the panel pages
		
		add_menu_page(RT_THEMENAME, RT_THEMENAME, $capability, 'rt_general_options', array(&$this, 'load_menu_page'), RT_THEMEADMINURI .'/images/generic.png');
		
		foreach($this->panel_pages  as $menu_slug => $page_title){
			add_submenu_page( 'rt_general_options', $page_title, $page_title, $capability, $menu_slug , array(&$this, 'load_menu_page'));
		}
		
	
	}

	#
	#	Load Menu Pages
	#
	
	function load_menu_page(){
		global $RTThemePageLayoutOptionsClass,$pageLayoutClass,$rt_sidebars_class;
		
		if( isset( $_GET['page'] ) ){

			//Admin Header
			$this->admin_header();    

			if($_GET['page']=="update_notifications"){//update notifier
				
				include(RT_THEMEFRAMEWORKDIR . "/admin/pages/update_notifications.php");
			
			}elseif($_GET['page']=="rt_setup_assistant"){//setup assistant 
				
				require_once(RT_THEMEFRAMEWORKDIR . "/classes/rt_setup_assistant.php");

			}elseif($_GET['page']=="rt_setup_assistant"){//setup assistant 
				
				require_once(RT_THEMEFRAMEWORKDIR . "/classes/rt_setup_assistant.php"); 

			}elseif($_GET['page']=="rt_template_options"){//template options  
				
				$pageLayoutClass->generate_template_forms(); 

			}elseif($_GET['page']=="rt_sidebar_options"){//sidebar creator
				
				$rt_sidebars_class->create_sidebar_list();  

			}else{
				
				include(RT_THEMEADMINDIR . "/options/" . $_GET['page'].'.php'); 
				
				//Generate this form
				$this->rt_generate_form_page($options);

			}

			//Admin Footer
			$this->admin_footer();
		}
	}


	
	#
	#	Save Options
	#
	
	function rt_save_options($options){

		if ( ! current_user_can( 'manage_options' ) ) {
			return ;
		}

		foreach ($options as $value) { 

		$id=isset($value['id']) ? $value['id'] : "";
		$id_array=str_replace("[]","", $id);
		$request_value = ""; 

			if(isset($_POST[$id_array]) && is_array($_POST[$id_array])){ 
				$request_value = serialize( $_POST[ $id_array ] ); 
			}else{

				$special_fields = array(RT_THEMESLUG."_space_for_head", RT_THEMESLUG."_space_for_footer", RT_THEMESLUG."_custom_css" );

				if( isset( $_POST[ $id ] ) ){

					if( in_array( $id , $special_fields ) ){
						$request_value = $_POST[ $id ];
					}else{
						$request_value = stripslashes( $_POST[ $id ] );		
					}

				}


			}

			$default_value = isset( $value['default'] ) ? $value['default'] : "";
			$dont_save = isset( $value['dont_save'] ) ? $value['dont_save'] : "";

			if( isset( $request_value ) && $request_value != "" &&  ( ( $request_value != $default_value ) || ( ! $dont_save ) ) ) {
				update_option( $id, $request_value );
			}else{
				update_option( $id, '' );
			}

		}
	}

	#
	#	Load Admin Scripts
	#

	function load_admin_scripts(){
		global $pagenow;

		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-droppable');
		wp_enqueue_script('jquery-ui-draggable'); 
		wp_enqueue_script('jquery-ui-mouse'); 
		wp_enqueue_script('jquery-ui-tabs'); 
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-ui-mouse');  
		wp_enqueue_script('jquery-effects-core');  
		wp_enqueue_script('jquery-effects-scale');  
		wp_enqueue_script('jquery-effects-fade');  
		wp_enqueue_script('jquery-effects-highlight');  
		wp_enqueue_script('jquery-effects-transfer');  
		wp_enqueue_script('jquery-ui-button');  

		wp_enqueue_script('jquery-mousewheel', RT_THEMEADMINURI . '/js/jquery.mousewheel.js');


		if( $pagenow == "edit-tags.php" || $pagenow == "term.php" || $pagenow == "post.php" || $pagenow == "post-new.php" || ( isset( $_GET['page'] ) && isset( $this->panel_pages[$_GET['page']] ) ) ){
			if(function_exists( 'wp_enqueue_media' ) ){
				wp_enqueue_media();
			}else{
				wp_enqueue_style('thickbox');
				wp_enqueue_script('media-upload');
				wp_enqueue_script('thickbox');
			}
		}

		wp_enqueue_script('jquery-custom-select', RT_THEMEADMINURI.'/js/jquery.customselect.min.js');		 
		wp_enqueue_script('spectrum', RT_THEMEADMINURI . '/js/spectrum/spectrum.js'); 
		wp_enqueue_script('clue-tip', RT_THEMEADMINURI . '/js/jquery.cluetip.min.js');
		wp_enqueue_script('jquery-tools', RT_THEMEADMINURI . '/js/rangeinput.js');
		wp_enqueue_script('jquery-amselect', RT_THEMEADMINURI . '/js/jquery.asmselect.js');  

		
		if( isset( $_GET['page'] ) && $_GET['page'] == "rt_template_options" ){

			$api_key = get_option(RT_THEMESLUG.'_google_api_key');

			if(  ! empty( $api_key ) ){
				$googlemaps_url = add_query_arg( 'key', urlencode( $api_key ), "//maps.googleapis.com/maps/api/js" );

				wp_enqueue_script('googlemaps',$googlemaps_url,array(), '1.0.0'); 	 
				wp_enqueue_script('jquery-gmaps-latlon-picker', RT_THEMEADMINURI . '/js/jquery-gmaps-latlon-picker.js');
			}
		}

		wp_enqueue_script('admin-scripts', RT_THEMEADMINURI . '/js/script.js','','',true);

		
	}

	#
	#	Load Admin Styles
	#
	
	function load_admin_styles(){
		wp_enqueue_style('admin-style', RT_THEMEADMINURI . '/css/admin.css');   
		wp_enqueue_style('spectrum-style', RT_THEMEADMINURI . '/js/spectrum/spectrum.css'); 
		wp_enqueue_style('clue-tip-style', RT_THEMEADMINURI . '/css/jquery.cluetip.css');		
		add_editor_style('editor-style.css'); //editor style   
		
		wp_register_style('fontello', rt_locate_media_file( '/css/fontello/css/fontello.css' )); 	
		wp_enqueue_style('fontello');  
	}

   
	#
	#	Get Theme Data
	#
	
	function rt_get_theme_version(){ 

		$rt_theme_data = wp_get_theme(); 

		if( is_child_theme() ){
			$rt_theme_data = $rt_theme_data->parent(); 			
		}
		
		return $this->version = $rt_theme_data['Version'];
	}



	#
	#	Check sidebar array 
	#	 
 
	function get_current_post_type() {
		global $post, $typenow, $current_screen;
		
		if($post && $post->post_type) {
			return $post->post_type;
		}elseif($typenow) {
			return $typenow;
		}elseif($current_screen && $current_screen->post_type) {
			return $current_screen->post_type;
		}elseif(isset($_REQUEST['post_type'])) {
			return sanitize_key( $_REQUEST['post_type'] );
		}elseif(isset($_GET['post'])) {
			$thispost = get_post($_GET['post']);
			return $thispost->post_type;
		} else {
			return "post";
		}
	}


	#
	#	Create Metaboxes
	#

	function create_metaboxes() {			

		//load metabox class
		include(RT_THEMEFRAMEWORKDIR . "/classes/metaboxes.php"); 

		//portfolio
		include(RT_THEMEADMINDIR . "/options/portfolio_custom_fields.php"); 
		$rt_portfolio_custom_fields = new rt_meta_boxes($settings,$customFields); 

		//staff
		include(RT_THEMEADMINDIR . "/options/staff_custom_fields.php"); 
		$rt_staff_custom_fields = new rt_meta_boxes($settings,$customFields);

		//testimonial
		include(RT_THEMEADMINDIR . "/options/testimonial_custom_fields.php"); 
		$rt_testimonial_custom_fields = new rt_meta_boxes($settings,$customFields);

		//products
		include(RT_THEMEADMINDIR . "/options/product_custom_fields.php"); 
		$rt_product_custom_fields = new rt_meta_boxes($settings,$customFields);

		//posts
		include(RT_THEMEADMINDIR . "/options/post_custom_fields.php"); 

		//common for all
		include(RT_THEMEADMINDIR . "/options/common_custom_fields.php"); 
		$rt_common_custom_fields_template = new rt_meta_boxes($settings,$customFields);		

		//gallery upload options
		include(RT_THEMEFRAMEWORKDIR . "/classes/metabox-gallery.php"); 
		$rt_gallery_upload_options = new rt_meta_box_gallery();
		$rt_gallery_upload_options -> rt_meta_gallery_init();


	}
	
	#
	#	Create Admin Header
	#

	function admin_header(){		 
		
		echo '<div class="rt-admin-wrapper" id="'.$_GET['page'].'">';
		 
		echo '<!-- Left Side --><div class="box left-col">';
		echo '<!-- theme info --><div class="theme_name">'. RT_THEMENAME .'</div>';
		echo '<div class="theme_name_2">'.__('THEME OPTIONS','rt_theme_admin').'</div><br /><br />';
		echo '<div class="infoline"><div class="version">'.__('Version','rt_theme_admin').' '.$this->version.'</div> <div>|</div> <div class="version"><a href="admin.php?page=update_notifications">'.__('Changelog','rt_theme_admin').'</a></div>';
		echo '</div> <!-- / theme info --><br /><br /><!-- theme menu --><ul class="theme_menu">';

		//sub menus
		$sub_menus=array( 
			"rt_styling_options" => array(
				"info" => "Info",
				"global" => "Global Style",
				"top_bar" => "Top Links Area",	
				"header_logo" => "Header Logo Area", 
				"header" => "Sub-Header Area",							
				"main_navigation" => "Navigation Bar",				
				"content1" => "Default Content Area",
				"content2" => "Alternate Content Area 1",
				"content3" => "Alternate Content Area 2",
				"footer" => "Footer Area",
				"bottom_bar" => "Sub-Footer Area",
				"custom_css" => "Custom CSS"
			)
		);


		foreach($this->panel_pages  as $menu_slug => $page_title){
			if($_GET['page']==$menu_slug){
				$active = "active";
			}else{
				$active = "";
			}			

			//if there is sub menu for the menu item
			$the_sub_menu = $add_class = $active_class = "";
			if( isset( $sub_menus[$menu_slug] ) ){
				
				$the_sub_menu .= '<ul class="admin_sub_menu">';
				$i=1;
				foreach ( $sub_menus[$menu_slug] as $key => $value ) {
					$active_class = $i == 1 ? " active" : "";
					$the_sub_menu .= sprintf('<li class="%1$s %3$s" data-scope="%1$s"><span class="icon-angle-right">%2$s</span></li>',$key, $value, $active_class);
					$i++;
				}
				$the_sub_menu .= "</ul>";
				$add_class = "has_sub_menu";
			}

			echo '<li class="'.$menu_slug.' '.$active.' '.$add_class.' "><a href="'.RT_WPADMINURI.'admin.php?page='.$menu_slug.'">'.$page_title.'</a>'.$the_sub_menu.'</li>';				
			
		}
		
		echo '</ul><!-- / theme menu --></div><!-- / Left Side --><!-- Right Side --><div class="box right-col">';

		if($this->panel_pages[$_GET['page']]){
			echo '<h3 class="page_title">'.$this->panel_pages[$_GET['page']].'</h3>';
		}

	}

	#
	#	Create Admin Footer
	#

	function admin_footer(){ 
		echo '</div><!-- / Right Side --><div class="clear"></div></div>';
	}
 
	#
	#	Reset Link
	#
	
	function rt_generate_reset_link($part=""){

		$this_page = $this->panel_pages[ $_GET['page'] ];
 
		$confirm_message = sprintf(__('Are you sure that you want to reset all the %s?','rt_theme_admin'), $this_page);
		$button_name=__('Reset '.$this_page.'','rt_theme_admin');
  
		$reset_link ='
			<a href="?page='. $_GET['page']  .'&reset_settings=true" class="reset" title="Clicking the &#39;Reset all '.$this_page. '&#39; button will reset all settings for all the '.$this_page. ' and erase all your settings/changes you made in this entire group of theme settings." 
			  onclick="return confirm(\''. $confirm_message .'\')"
			  >'.$button_name.'</a>
			
			';

		return $reset_link;

	}

	#
	#	Create Form Page
	#
	
	function rt_generate_form_page($options, $purpose="", $rt_templateID =""){
	 
		// start form
		if( $purpose != "template_builder" ){
			echo '<form action="admin.php?page='. $_GET['page'].'" method="POST" id="'.$_GET['page'].'" >';   
		}  
 
		// hidden rich text editor
		if( $purpose == "template_builder" ) {
			$settings = array('wpautop'=>false);
			echo wp_editor("","rt_hidden_rich_editor",$settings); 	


			$api_key = get_option(RT_THEMESLUG.'_google_api_key');
			
			if( ! empty( $api_key ) ){

				//map location finder
				echo '
					<div class="gllpLatlonPicker hide" id="custom_id">
					<fieldset>
					<span class="close">x</span>
						<ul>
							<li class="text_align_right">'.__('Search','rt_theme_admin').':</li>
							<li><input type="text" class="gllpSearchField"></li>
							<li><input type="button" class="gllpSearchButton template_button light" value="'.__('search','rt_theme_admin').'"></li>		
						</ul>
						<div class="gllpMap">'.__('Google Maps','rt_theme_admin').'</div>
						<ul>
							<li class="text_align_right">'.__('lat/lon','rt_theme_admin').':</li>
							<li><input type="text" class="gllpLatitude" value="20"/></li>
							<li>/</li>
							<li><input type="text" class="gllpLongitude" value="20"/></li>
							<li><input type="button" class="select_map template_button light" value="'.__('select','rt_theme_admin').'"></li>
							<input type="hidden" class="gllpZoom" value="1"/>
							<input type="hidden" class="selected_field" value="1"/>
							<input type="button" class="gllpUpdateButton" value="'.__('update map','rt_theme_admin').'">
						</ul>
					</fieldset>	
					</div>
					';
				}


			}
		
		// floating save button
		if( $purpose != "template_builder" ){
			echo '<div class="floating_save_button"><a title="'.__('Save Options','rt_theme_admin').'" class="rt_options_ajax_save"></a></div>';
		}
		
		// generate form fields
		$this->rt_generate_forms($options,$rt_templateID);	    

		//bottom save & reset
		if( $purpose != "template_builder" ){
			echo '<table>';
			echo '    <tr>';
			echo '	<td class="col1" colspan="2">';
			echo '		<button type="button" id="footer_submit" class="template_button">'.__('Save Options','rt_theme_admin').'</button> ';
			echo __('or','rt_theme_admin');
			echo $this->rt_generate_reset_link("regular_options");
			echo '	</td></tr>';
			echo '</table><br />';
		}
		
		// end form
		if( $purpose != "template_builder" ) {
			echo '<input type="hidden" name="action" value="save" class="save">';    
			echo '</form>';
		}
	 
	}
	 

	#
	#	Create Admin Forms
	#

	function rt_generate_forms( $options, $rt_templateID = "") { 
		global $RTThemePageLayoutOptionsClass, $pageLayoutClass;		

		foreach($options as $k => $v){
			
					  
			$id 			=  (!empty($v['id'])) ? $v['id'] : ""; 
			$name 			=  (!empty($v['name'])) ? $v['name'] : "";
			$desc 			=  (!empty($v['desc'])) ? $v['desc'] : "";
			$purpose 		=  (!empty($v['purpose'])) ? $v['purpose'] : "";
			$class 			=  (!empty($v['class'])) ? $v['class'] : "";
			$fontSystem 	=  (!empty($v['font-system'])) ? $v['font-system'] : "";
			$hr 			=  (!empty($v['hr'])) ? $v['hr'] : "";
			$purpose 		=  (!empty($v['purpose'])) ? $v['purpose'] : "";
			$content_type	=  (!empty($v['content_type'])) ? $v['content_type'] : "";
			$table_class	=  isset($v['table_class']) ? $v['table_class'] : "";
			$css_id			=  isset($v['css_id']) ? $v['css_id'] : $id;
			$rt_templateID  =  isset($v['templateID']) ? $v['templateID'] : $rt_templateID;  
			$placeholder	=  isset($v['placeholder']) ? $v['placeholder'] : "";
			$placeholder 	=  $class == "icon_selection" ? __("click to select","rt_theme_admin") : $placeholder;

			$field_value 	= get_option( $id );
			
			//page templates 			
			if($purpose=="page_layouts"){ 
				$function_name = 'rt_generate_'.$content_type; 
				$class_name = 'rt_generate_'.$content_type.'_class'; 

				if($content_type!="") { 
					$GroupID = isset( $v['options']['group_id'] ) ? $v['options']['group_id']  : "" ;					 
					require_once(RT_THEMEFRAMEWORKDIR . "/template_builder/modules/{$content_type}.php"); 
					$class_name = new $class_name;
					$class_name->$function_name($v['options']['group_id'],$rt_templateID,$v['options'],"");
				}  
			}
	  
			//default value
			if( ( isset( $v['default'] ) &&  $v['default'] != "" )  && ( isset( $v['dont_save'] ) && ! empty( $v['dont_save'] ) ) && $field_value == "" ){

				$field_value = $v['default'];
			}
			
			//exact value
			if( isset( $v['value'] ) && $v['value'] != "" ){


				$field_value=$v['value'];
			}
			  

			//side button
			if(!empty($v['sidebuttonName'])){
				$side_button='<input type="button" value="'.$v['sidebuttonName'].'" id="'.$id.'" class="'.$v['sidebuttonClass'].'"/>';
			}else{
				$side_button ="";
			}

			//labels
			$desc_row = ! empty( $desc ) ? '<tr><td colspan="2"><div class="info icon-info-circled desc"><p>'.$desc.'</p></div></td></tr>' : "";
			$help_icon = ! empty( $desc ) ? '<span title="'.__('click to show tips','rt_theme_admin').'" class="tooltip_icon icon-help-circled"></span>' : "";
			$label =  ! empty( $name ) ? '<table class="table-row"> '.$desc_row.' <tr><th><div> '.$help_icon.'<label for="'.$css_id.'">'.$name.'</label></div></th>' : '<table class="table-row"><tr>';
			
			switch ($v['type']){


				#
				#	Form Start
				#
				case 'form_start';			

				$template_id = isset( $v['template_id'] ) ? $v['template_id'] : $_GET['template_id'] ;
				$the_form_class = isset( $v['form_class'] ) ? $v['form_class'] : "";
				$template_name = isset( $v['template_name'] ) ? $v['template_name'] : ""; 

				echo '<form action="admin.php?page='. $_GET['page'].'" method="POST" id="'.$template_id.'" class="'.$the_form_class.'">';		 
				$pageLayoutClass->create_grid($template_id, $template_name, $class, "first"); //create holder 

				break;

				#
				#	Form End
				#
				case 'form_end';			
				 
				$pageLayoutClass->create_grid("", "", "", "second");  
				echo '<input type="hidden" name="action" value="save" class="save">';    
				echo '</form>';	
				
				break;				


				#
				#	List Templates
				#
				case 'list_templates';			
					
				$pageLayoutClass->list_templates($v['templateID']);
				
				break;				



				#
				#	table Start
				#
				case 'table_start';		

				echo '<table class="table_master '.$class.'"><tr><td class="td_master">';		
				
				break;

				#
				#	table End
				#
				case 'table_end';			

				echo '</td></tr></table>';	
				
				break;				
				#

				#
				#	td split
				#
				case 'td_col';			

				echo '</td><td class="td_master '.$class.'">';	
				
				break;		 


				#
				#	div start
				#
				case 'div_start';

				$the_div_id = isset( $id ) ? $id : "" ;
				$the_div_class = isset( $v['div_class'] ) ? $v['div_class'] : "" ;

				echo '<div id="'.$the_div_id.'" class="'.$the_div_class.'">';

				break;


				#
				#	div end
				#
				case 'div_end';

				echo '</div>';

				break;


				case 'tab_titles';
				#	tab titles

				$titles_output = '<ul>';

				foreach ($v['tab_names'] as $tab_id => $tab_name) {									
					$add_class = ! empty( $tab_name[1] ) ? "with_icon" : "";
					$icon_output = ! empty( $tab_name[1] ) ? '<span class="'.$tab_name[1].'"></span>' : "";
					$titles_output .= sprintf( '<li class="%s"><a href="#%s">%s %s</a></li>',$add_class, $tab_id,$icon_output,$tab_name[0]);
				}

				$titles_output .= "</ul>";

				echo $titles_output;
				 								
				break;
				
				#
				#	col start
				#
				case 'col_start';

				$layout = isset( $v['layout'] ) ? $v['layout'] : "two" ;
				$holder_class = isset( $v['holder_class'] ) ? $v['holder_class'] : "" ;

				echo '<div class="boxes '.$holder_class.'"><div class="box '.$layout.'">';

				break;

				#
				#	col split
				#
				case 'col_split';

				$layout = isset( $v['layout'] ) ? $v['layout'] : "two" ;

				echo '</div><div class="box '.$layout.'">';

				break;

				#
				#	col end
				#
				case 'col_end'; 

				echo '</div></div>';

				break;


				#
				#	ul start
				#
				case 'ul_start';

				$the_ul_id = isset( $id ) ? $id : "" ;
				$the_ul_class = isset( $v['ul_class'] ) ? $v['ul_class'] : "" ;

				echo '<ul id="'.$the_ul_id.'" class="'.$the_ul_class.'">';

				break;


				#
				#	ul end
				#
				case 'ul_end';

				echo '</ul>';

				break;									

				#
				#	Info
				#
				case 'info';			
					
				echo '<div class="info icon-info-circled"><p>'.$desc.'</p></div>'; 		
				
				break;
				 
				
				#
				#	Grid  (rows)
				#
				case 'grid';		


					$theTemplateID = explode("_", $id);
					$theTemplateID = is_array( $theTemplateID ) ? $theTemplateID[1] : "";  
					$theGroupID = explode("_", $id);
					$theGroupID = is_array( $theGroupID ) ? $theGroupID[2] : "";
					$contet_type = "grid";
					$header_purpose = isset( $v["header_purpose"] ) && $v["header_purpose"] == TRUE ? $v["header_purpose"] : FALSE;
					$footer_purpose = isset( $v["footer_purpose"] ) && $v["footer_purpose"] == TRUE ? $v["footer_purpose"] : FALSE;

					if($v['part']=="first" || $v['part']=="full"){
						echo '
							<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'">
							<input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'">
							<input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'">							
							<input type="hidden" name="'.$id.'" value="first" id="'.$id.'">	 	
							<input type="hidden" class="header_purpose" name="templateid_'.$theTemplateID.'_'.$theGroupID.'_grid[header_purpose]" value="'.$header_purpose.'">					
							<input type="hidden" class="footer_purpose" name="templateid_'.$theTemplateID.'_'.$theGroupID.'_grid[footer_purpose]" value="'.$footer_purpose.'">					
							<table class="page-template-grid-table">
							<tr><td>
						'; 

						if( ! $header_purpose && ! $footer_purpose ){							
							echo '<ul id="sortable-'.$id.'" class="rt-ui-sortable content_purpose">';
						}

						if( $header_purpose ){
							echo '<ul id="sortable-'.$id.'" class="rt-ui-sortable header_purpose">';
						}

						if( $footer_purpose ){
							echo '<ul id="sortable-'.$id.'" class="rt-ui-sortable footer_purpose">';
						}

					} 

					if($v['part']=="second" || $v['part']=="full"){ 
						echo '
							</ul></td></tr> 
							</table> 
							<input type="hidden" name="second-theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'">
							<input type="hidden" name="second-theGroupID_'.$theGroupID.'" value="'.$theGroupID.'">
							<input type="hidden" name="second-source_type_'.$theGroupID.'" value="'.$contet_type.'">
							<input type="hidden" name="second-'.$id.'" value="second" id="second_'.$id.'">
							<input type="hidden" class="header_purpose" name="second-templateid_'.$theTemplateID.'_'.$theGroupID.'_grid[header_purpose]" value="'.$header_purpose.'">
							<input type="hidden" class="footer_purpose" name="second-templateid_'.$theTemplateID.'_'.$theGroupID.'_grid[footer_purpose]" value="'.$footer_purpose.'">
						';
					}
				
				break;
				
				#
				#	Column
				#
				case 'column'; 

					$contet_type = "column"; 

					$layout_values	= array(   
						1 => array ("one"=>"1:1"),
						2 => array ("four-five"=>"4:5"),
						3 => array ("three-four"=>"3:4"),
						4 => array ("two-three"=>"2:3"),
						5 => array ("two"=>"1:2"),
						6 => array ("three"=>"1:3"),
						7 => array ("four"=>"1:4"),
						8 => array ("five"=>"1:5")
					);  	

					$theTemplateID = explode("_", $id);
					$theTemplateID = is_array( $theTemplateID ) ? $theTemplateID[1] : "";  
					$theGroupID = explode("_", $id);
					$theGroupID = is_array( $theGroupID ) ? $theGroupID[2] : "";
					$layout = isset( $v["layout"] ) && $v["layout"] != "" ? $v["layout"] : 1;  
					$layout_class_array = $layout_values[$layout];
					$layout_class_name = is_array( $layout_class_array ) ?  key($layout_class_array) : "one" ;
					$layout_class_math = $layout_class_array[$layout_class_name];

					

					if($v['part']=="first" || $v['part']=="full"){ 

						echo '
							<li class="rt-ui-sortable column '.$layout_class_name.'">
							<input type="hidden" name="theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'">
							<input type="hidden" name="theGroupID_'.$theGroupID.'" value="'.$theGroupID.'">
							<input type="hidden" name="source_type_'.$theGroupID.'" value="'.$contet_type.'"> 
							<input type="hidden" class="layout_value" name="templateid_'.$theTemplateID.'_'.$theGroupID.'_column[layout]" value="'.$layout.'" id="templateid_'.$theTemplateID.'_'.$theGroupID.'_column[layout]">  
							<input type="hidden" name="'.$id.'" value="first" id="'.$id.'">  		  			 		
							<div class="columnheader clearfix">
							<h5><span class="text">'.$layout_class_math.'</span> '.__('Column','rt_theme_admin').'</h5>
							<div class="move"></div>
							<div class="column_delete" title="'.__('delete this column','rt_theme_admin').'""></div>
							<span class="decr" title="'.__('decrease the column width','rt_theme_admin').'""></span>
							<span class="incr" title="'.__('increase the column width','rt_theme_admin').'""></span>
							</div>
							<div class="column_padding">
							<ul class="rt-ui-sortable">  
						';

						
					} 

					if($v['part']=="second" || $v['part']=="full"){ 
						echo '
							</ul></div> 						
							<input type="hidden" name="second-theTemplateID_'.$theGroupID.'" value="'.$theTemplateID.'">
							<input type="hidden" name="second-theGroupID_'.$theGroupID.'" value="'.$theGroupID.'">
							<input type="hidden" name="second-source_type_'.$theGroupID.'" value="'.$contet_type.'"> 						
							<input type="hidden" name="second-'.$id.'" value="second" id="'.$id.'_second"></li>
						';
					}
 
				break;				
				

				#
				#	Icon List
				#
				case 'icon_list';			
				
				extract($v); 
 
				if ( isset( $add_new )  && !empty( $add_new ) ){					 

					echo '<button type="button" class="template_button green rt_add_new_list_line icon-plus-squared-1">'.__('add new line','rt_theme_admin') .' </button>';  

				}else{

					echo '
					<li class="list_item '.$class_name.' ">
						<div>
							<div class="form_element">
								<input placeholder="select icon" type="text" name="'.$icon_id.'" value="'.stripslashes(htmlentities($icon_value,ENT_QUOTES, "UTF-8")).'" id="'.$icon_id.'" class="icon_selection">
								<input placeholder="text" type="text" name="'.$text_id.'" value="'.stripslashes(htmlentities($text_value,ENT_QUOTES, "UTF-8")).'" id="'.$text_id.'">
								<span class="s_delete"></span>
								<span class="s_move"></span>
							</div>
						</div>
					</li>
					';
				}

				break;


				#
				#	Map List
				#
				case 'map_location';			
				
				extract($v); 
 
				if ( isset( $add_new )  && !empty( $add_new ) ){
					
					echo '<button type="button" class="template_button green rt_add_new_map_location icon-plus-squared-1">'.__('add new location','rt_theme_admin') .' </button>';  

				}else{

					echo '
					<li class="list_item '.$class_name.' ">
						<div>
							<div class="form_element">
								<input placeholder="select latitude, longitude" type="text" name="'.$geo_id.'" value="'.stripslashes(htmlentities($geo_value,ENT_QUOTES, "UTF-8")).'" id="'.$geo_id.'" class="geo_selection">
								<input placeholder="place title" type="text" name="'.$title_id.'" value="'.stripslashes(htmlentities($title_value,ENT_QUOTES, "UTF-8")).'" id="'.$title_id.'">
								<input placeholder="description" type="text" name="'.$text_id.'" value="'.stripslashes(htmlentities($text_value,ENT_QUOTES, "UTF-8")).'" id="'.$text_id.'">
								<span class="s_delete"></span>
								<span class="s_move"></span>
							</div>
						</div>
					</li>
					';
				}

				break;


				#
				#	Headings
				#
				case 'heading';			
				echo '<table class="seperator"><tr><td class="col1" colspan="2"><h4 class="sub_title icon-angle-down">'.$v['name'].'</h4>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '</td></tr></table>'; 		
				
				break;

				#
				#	Info Text - with icon
				#
				case 'info_text_only';			
					
				echo '<table><tr><td class="col1" colspan="2"><div class="info_text">'.$desc.'</div></td></tr></table>'; 	
				
				break;
			
				#
				#	Info Text - without icon
				#
				case 'info_text';			
				
				echo '<table><tr><td class="col1" colspan="2"><label for="'.$id.'">'.$name.'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '</td></tr></table>';		
				
				break;
			
			
				#
				#	Text Fields
				#
				case 'text';			
				echo $label.'<td class="col2"><div class="form_element"><input autocomplete="off" placeholder="'.$placeholder.'" type="text" name="'.$id.'" value="'.stripslashes(htmlentities($field_value,ENT_QUOTES, "UTF-8")).'" id="'.$id.'" class="'.$class.'"></div></td>';
				echo '</tr></table>';		
				
				break;


				#
				#	Hidden Fields
				#
				case 'hidden';			
				
				echo '<input type="hidden" name="'.$id.'" value="'.$field_value.'" id="'.$id.'">';
				
				break;
			
	
				#
				#	Button
				#
				case 'button';
				
				echo '<input type="button" value="'.$v['name'].'" id="'.$id.'" class="'.$v['class'].' button"/>';		
				
				break; 

				#
				#	Send Button
				#
				case 'send_button';
				
				echo '<table><tr><td class="col2"><input type="submit" value="'.$v['name'].'" id="'.$id.'" class="'.$v['class'].' button"/></tr></table>';		
				
				break; 			
			
				#
				#	Upload
				#
				case 'upload';
				
				echo $label.'
				<td class="col2">
				<div class="form_element upload"><input autocomplete="off" type="text" name="'.$id.'" value="'.$field_value.'" id="'.$id.'" class="upload_field">  
				<button data-inputid="'.$id.'" class="icon-upload template_button light rttheme_upload_button" type="button">'.__('Upload','rt_theme_admin').'</button>
				</div>';


				//the file extention
				$ext = pathinfo($field_value, PATHINFO_EXTENSION);

				//is the file an image?
				if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif" ){
					$ext_image = true;
				}else{
					$ext_image = false;
				}												


				echo ($field_value && $ext_image ) ? '<div data-holderid="'.$id.'" class="uploaded_file visible">' : '<div data-holderid="'.$id.'" class="uploaded_file ">'; 

					if($field_value){
						echo '<img class="loadit" src="'.$field_value.'"  data-image="'.$id.'" >';
					}else{ 
						echo '<img class="loadit" src="'.RT_THEMEADMINURI.'/images/blank.png"  data-image="'.$id.'">';	 			
					}  

				echo '<span class="icon-cancel delete_single" title="'.__("remove image","rt_theme_admin").'" data-inputid="'.$id.'"></span>';
				echo '</div>';
				echo '</td></tr></table>';		
				
				break;

				#
				#	Radio Buttons
				#
				case 'radio';

				echo $label.'<td class="col2"><div class="check"> ';				    				 
			

					echo '<table class="image_radio '.$class.' "><tr>';
					$field_counter = 1;
					foreach($v['options'] as $option_value => $option_name){					
						//if array
						if(is_array($option_name)){
							$option_name = $option_name[1];
						}
						
						if($class == "pattern_list" || $class == "layout_selector"){
							if ($field_value==$option_value){
								 echo '<td><div class="first_div '.$class.'"><div class="radio_cover checked radio_'.$option_value.' '.$class.'">';
								 echo '<input type="radio" name="'.$id.'" value="'.$option_value.'" checked></div></div>';
								 echo '<label>'.$option_name.'</label>';
								 echo '</td>';
							}else{
								 echo '<td><div class="first_div '.$class.'"><div class="radio_cover radio_'.$option_value.' '.$class.'">';
								 echo '<input type="radio" name="'.$id.'" value="'.$option_value.'"></div></div>';
								 echo '<label>'.$option_name.'</label>';
								 echo '</td>';
							}
						}else{
							if ($field_value==$option_value){
								echo '<span class="radio_button_holder">';
								echo '<input type="radio" name="'.$id.'" value="'.$option_value.'" checked id="'.$id.'-'.$field_counter.'">';
								echo '<label for="'.$id.'-'.$field_counter.'">'.$option_name.'</label>';
								echo '</span>';
							}else{
								echo '<span class="radio_button_holder">';
								echo '<input type="radio" name="'.$id.'" value="'.$option_value.'" id="'.$id.'-'.$field_counter.'">';
								echo '<label for="'.$id.'-'.$field_counter.'">'.$option_name.'</label>';
								echo '</span>';
							}
						}
						$field_counter++;
					}
					echo '</tr></table>';
					
					
				echo '</div></td></tr></table>';	 
				break;


				#
				#	Checkbox
				#
				case 'checkbox2';
				
				$purpose_class =  isset( $v['classic'] ) ? "" : "rt_checkbox";


				echo '<table class="table-row"><tr><td><div class="form_element check '.$purpose_class.' "><input autocomplete="off" class="checkbox '.$class.'" type="checkbox" name="'.$id.'"';
					
					if($field_value=="checked" || $field_value=="on"){
						echo ' checked="checked" '; 
						$label_class="icon-check";
					}else{
						$label_class="icon-check-empty";
					}
					
					echo 'id="'.$id.'"/><div class="'.$label_class.'">'.$name.'';

					echo ! empty( $desc ) ? '<div class="desc">'.$desc.'</div>' : "";

				echo '</label></div></td></tr></table>'; 

				break;

				#
				#	Checkbox 2
				#
				case 'checkbox'; 
				$check_desc = isset( $v['check_desc'] ) ? $v['check_desc'] : "" ;

				echo $label.'<td><div class="form_element check rt_checkbox"><input autocomplete="off" class="checkbox '.$class.'" type="checkbox" name="'.$id.'"';
					
					if($field_value=="checked" || $field_value=="on"){
						echo ' checked="checked" '; 
						$label_class="icon-check";
					}else{
						$label_class="icon-check-empty";
					}
					
					echo 'id="'.$id.'"/><div class="'.$label_class.'">'.$check_desc.''; 

				echo '</div></div></td></tr></table>'; 

				break;
				
				#
				#	Select
				#
				case 'select'; 
				
				echo $label.'<td class="col2">';

				//font demo
				$fontDemo 	=  (!empty($v['font-demo'])) ? $v['font-demo'] : "";
				
				if(!empty($fontDemo)){


				//font-family name
				if( isset($this->rt_google_fonts[$field_value][0]) ){					
					$font_family_name = $this->rt_google_fonts[$field_value][0];	
					$font_type = "google";				
				}elseif( isset( $this->rt_websafe_fonts[$field_value] ) ){				
					$font_family_name = $this->rt_websafe_fonts[$field_value];	
					$font_type = "websafe";				
				}else{
					$font_family_name = "";	
					$font_type = "";				
				} 
		 
				echo !empty( $font_family_name ) ? '<iframe scrolling="no" id="'.$id.'_iframe" class="fontdemo" src="'.RT_THEMEADMINURI.'/pages/rt-fonts.php?font_face='.$field_value.'&system='.$font_type.'&family_name='.$font_family_name.'">Your browser does not support iframes.</iframe>' : '<iframe scrolling="no" id="'.$id.'_iframe" class="fontdemo empty"
				>Your browser does not support iframes.</iframe>';
		
				} 
				 
				$extraClass  =  (!empty($v['sidebuttonName'])) ? "withbutton": '';
				
				echo '<div class="form_element selectbox"><select autocomplete="off" name="'.$id.'" id="'.$id.'" class="'.$class.' '.$fontSystem.' '. $extraClass .' ">';
					
					if(isset($v['select']) && $v['select']) echo '<option value="">'.$v['select'].'</option>'; 

					foreach($v['options'] as $option_value => $option_name){					
						//if array
						if(is_array($option_name)){
							$option_name = $option_name[1];
							//font-family name
							$font_family_name = isset($this->rt_google_fonts[$option_value][0]) ? $this->rt_google_fonts[$option_value][0] : ""; 
							$font_type =  isset($this->rt_google_fonts[$option_value][0]) ? "google" : ""; 
						}else{
							$font_family_name = isset($this->rt_websafe_fonts[$option_value]) ? $this->rt_websafe_fonts[$option_value] : ""; 
							$font_type = isset($this->rt_websafe_fonts[$option_value]) ? "websafe" : ""; 
						}
	
						if( strpos( $option_value, "optgroup_start" ) !== false ){
							echo '<optgroup label="'.$option_name.'">';
						}elseif( strpos( $option_value,"optgroup_end" ) !== false ){					
							echo '</optgroup>';
						}else{
							if ($field_value==$option_value){
								echo '<option value="'.$option_value.'" data-font-family="'.$font_family_name.'" data-font-type="'.$font_type.'" selected>'.$option_name.'</option>';
							}else{
								echo '<option value="'.$option_value.'" data-font-family="'.$font_family_name.'" data-font-type="'.$font_type.'" >'.$option_name.'</option>';
							}							
						}
					} 
						
				echo '</select>';
				echo $side_button;
				echo '</div></td></tr></table>';		
				
				break;
	
	
				#
				#	Multiple Select
				#
				case 'selectmultiple';
				
				echo $label.'<td class="col2"><div class="form_element selectbox">'; 
				
				if(!empty($purpose)){
					$saved_array=$v['default'];
				}else{
					$saved_array=$field_value;
					if(!is_array($saved_array)) $saved_array = unserialize($field_value);	
				}
				 
				if(isset($v['select'])) {
					echo '<select multiple name="'.$id.'" id="'.$id.'" class="multiple '.$class.' '.$fontSystem.'"  title="'.$v['select'].'">';  
				}else{
					echo '<select multiple name="'.$id.'" id="'.$id.'" class="multiple '.$class.' '.$fontSystem.'"  title="'.__('Select','rt_theme_admin').'">';
				}
			
					$selected = "";
					foreach($v['options'] as $option_value => $option_name){
					
						//if value selected
						if(is_array($saved_array)){
							
							foreach($saved_array as $a_key => $a_value){
								if (	$a_value ==  $option_value ){
									$selected="selected";  
								}								
							}
						}
			
						//if array
						if(is_array($option_name)){
							$option_name = $option_name[1];
						}
						
						if(!$option_value) $option_value=" ";
			
						echo '<option value="'.$option_value.'" '.$selected.'>'.$option_name.'</option>';
						$selected="";
					}
					
	
				echo '</select></div></td></tr></table>';		
				
				break;		
				
				
				#
				#	Color Picker
				#
				case 'colorpicker';
				
				echo $label.'<td class="col2"><div class="color_field"><div class="form_element color"><input autocomplete="off" type="text" name="'.$id.'" value="'.$field_value.'" id="'.$id.'" class="'.$class.'"></div>';
				echo '</tr></table>';				 
				
				break;
	
				#
				#	Range input
				#
				case 'rangeinput';			
				
				echo $label.'<td class="col2"><div class="form_element rangeinput"><input type="text" class="range '.$class.'" name="'.$id.'" id="'.$id.'" min="'.$v['min'].'" max="'.$v['max'].'" step="1" value="'.$field_value.'" /></div></td>';
				echo '</tr></table>';		
				
				break;
			
				#
				#	Textarea
				#
				case 'textarea';
				echo $label.'<td class="col2"><div class="form_element"><textarea name="'.$id.'" id="'.$css_id.'" autocomplete="off">'.stripslashes($field_value).'</textarea></div>';
				echo '</td></tr></table>';

				break;

				#
				#	Textarea tinyMCE
				#
				case 'textarea_tinyMCE';
							
		 
				echo $label.'<td class="col2"><div class="form_element">';

					echo '
					<div id="wp-'.$css_id.'-wrap" class="wp-core-ui wp-editor-wrap tmce-active"> 
						<div id="wp-'.$css_id.'-editor-tools" class="wp-editor-tools hide-if-no-js">  
							<div id="wp-'.$css_id.'-media-buttons" class="wp-media-buttons">
								<a id="'.$css_id.'-insert-media-button" class="button insert-media add_media" title="'.__('Add Media').'" data-editor="'.$css_id.'" href="#">
									<span class="wp-media-buttons-icon"></span>
									'.__('Add Media').'
								</a>
							</div>

							<div class="wp-editor-tabs">
								<a id="content-html" class="rt_switchEditors wp-switch-editor switch-html" data-switchto="text">'.__('HTML').'</a>
								<a id="content-tmce" class="rt_switchEditors wp-switch-editor switch-tmce" data-switchto="visual">'.__('Visual').'</a>
							</div>

						</div>
						<div id="wp-'.$css_id.'-editor-container" class="wp-editor-container">
							<textarea name="'.$id.'" id="'.$css_id.'" class="wp-editor-area">'.stripslashes($field_value).'</textarea>
						</div>
					</div>
					'; 

				echo '</div></td></tr></table>';

				 
				break;
	
				#
				#	Div sidebar
				#
				case 'div'; 
				echo '<div id="'.$id.'" class="sidebar_div '.$class.'">';
				echo '<div class="sidebar_title">'.$v['name'].'<div class="openclose '.$id.'">+</div></div><div class="table_holder">'; 
				break;
	
				
				#	Sidebar Divend 
				#
				case 'divend'; 
				echo '</div></div>'; 
				break; 	 
					
				#	HTML Content
				#
				case 'html_content'; 
					
					echo $v["value"]; 

				break; 	 

				#
				#	HR
				#
				case 'hr'; 
				echo "<hr />";
				break; 	 
				}		

				if($hr=="true") echo "<hr />";
				
		}
	}


}
?>

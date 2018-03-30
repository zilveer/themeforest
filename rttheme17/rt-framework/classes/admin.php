<?php
#-----------------------------------------
#	RT-Theme admin.php
#	version: 1.0
#-----------------------------------------

#
#	Admin Class
#

class RTThemeAdmin extends RTTheme{

	public $panel_pages = array(
			'rt_general_options'    => 'General Options',
			'rt_template_options'   => 'Template Builder',			
			'rt_header_options'     => 'Header Options' ,
			'rt_footer_options'     => 'Footer Options' ,
			'rt_background_options' => 'Background Options' ,			
			'rt_typography_options' => 'Typography Options' ,
			'rt_styling_options'    => 'Styling Options' ,
			'rt_menu_options'       => 'Menu Styling Options' , 
			'rt_sidebar_options'    => 'Sidebar Creator' ,
			'rt_blog_options'       => 'Blog Options' ,
			'rt_portfolio_options'  => 'Portfolio Options' ,
			'rt_product_options'    => 'Product Options',
			'rt_social_options'     => 'Social Media Options',
			'rt_woocommerce_options'=> 'WooCommerce Options', 	
			'rt_setup_assistant'    => 'Setup Assistant',			
		);
	 
	
	function admin_init(){
		  
		//check woocommerce
		if ( ! class_exists( 'Woocommerce' ) ) {
			unset($this->panel_pages["rt_woocommerce_options"]);
		}

		//Theme Version
		$this->rt_get_theme_version();

		//Load Admin Functions
		$this->load_admin_functions();
		 
		//Load Admin Classes
		$this->load_admin_classes();
		
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
	} 


	#
	#	Load Admin Classes
	#
	
	function load_admin_classes() {
		global $RTThemePageLayoutOptionsClass;
		
		//Page layout options
		include(THEMEFRAMEWORKDIR . "/classes/page_layout_options.php");  
		 
	}   


	#
	#	Admin Ajax Process
	#

	function rt_admin_ajax() {
		global $wpdb,$RTThemePageLayoutOptionsClass;

		//gallery metaboxes
		if( ! isset( $_POST['saveoptions'] ) && isset( $_POST['rt_theme_gallery'] ) ){ // returns new gallery form
			$rt_gallery_upload_options = new rt_meta_box_gallery();
			$rt_gallery_upload_options -> createPhotoForm(); 	
		}

		//admin only actions
		if ( ! current_user_can( 'manage_options' ) ) {
			return ;
		}		
		
		if(!isset($_POST['saveoptions']) && !isset($_POST['rt_theme_gallery'])){ // returns an option box for the template builder
			$theTemplateID = $_POST['theTemplateID'];
			$theGroupID    = $_POST['theGroupID'];
			$selectedItem  = $_POST['selectedItem'];  
			$randomClass   = $_POST['randomClass'];
			$options  		= "";			
	
			//create a box as requested
			if($selectedItem == "portfolio_box") 	{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_portfolio_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "home_page_boxes") 	{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_homepage_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "sidebar_box") 	{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_sidebar_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "default_content") 	{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_default_content_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "all_content_boxes"){	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_all_content_boxes($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "banner_box")		{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_banner_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "slider_box")		{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_slider_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "revolution_box")		{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_revolution_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "product_box")		{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_product_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "woo_products_box")	{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_woo_products_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "google_map")		{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_google_map($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "contact_form")	{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_contact_form($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "contact_info_box")	{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_contact_info_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "blog_box")		{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_blog_box($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "heading_bar")		{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_heading_bar($theGroupID,$theTemplateID,$options,$randomClass); }
			if($selectedItem == "code_box")		{	$ItemToSend = $RTThemePageLayoutOptionsClass->rt_generate_code_box($theGroupID,$theTemplateID,$options,$randomClass); }

			echo  $ItemToSend;
		

		}else{ //	Save options via AJAX
			
			if( isset( $_POST['formid'] ) ){
				
				if($_POST['formid']=="rt_template_options"){ // save template options
					$RTThemePageLayoutOptionsClass->rt_save_page_templates();			
				}

				if($_POST['formid']=="rt_sidebar_options"){ // save sidebar options				
					update_option('rt_sidebar_options', $this->rt_check_sidebar_array($_POST));						
				}				
				
				if($_POST['formid']!="rt_template_options" &&	$_POST['formid']!="rt_sidebar_options"){ // save regular options
					include(THEMEADMINDIR . "/options/".$_POST['formid'].".php");				
					$this->rt_save_options($options,$_POST);			

					//add mark to flush rewrite rules
					if( $_POST['formid'] == "rt_product_options" || $_POST['formid'] == "rt_portfolio_options" ) {
						update_option("rt_rewrite_rules","");
					}				
				}

				echo __('Options saved successfully', 'rt_theme_admin');	
			}
			
		}
			
		die();
		
	}


	#
	#	Load Admin Functions
	#
    
	function load_admin_functions() {
		include(THEMEFRAMEWORKDIR . "/admin/functions/shortcode_editor.php");
		include(THEMEFRAMEWORKDIR . "/admin/functions/update_notifier.php");	
	}
	
	#
	#	Update Notifier
	#
		// Adds an update notification to the WordPress Dashboard menu
		function update_notifier_menu() {  
			global $xml,$theme_data,$themeupdatestatus;
				$themeupdatestatus = get_option(THEMESLUG.'_update_notifications');
				$update = "";
				
				if($themeupdatestatus){
					$xml 		= get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
					$theme_data	= wp_get_theme(); // Read theme current version from the style.css
					if( (float)$xml->latest > (float)$theme_data['Version']) { // Compare current theme version with the remote XML version
						$update = '<span class="update-plugins count-1"><span class="update-count">'.$xml->latest.'</span></span>';
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
					"template_delete_confirm" => __("Are you sure you want to delete this template?",'rt_theme_admin'),
					"template_names_confirm" => __("Template names cannot be empty.",'rt_theme_admin'),
					"template_contents_confirm" => __("You have no contents for this tempalte, please add one.",'rt_theme_admin'),			
					"delete_confirm" => __("Are you sure you want to delete?",'rt_theme_admin'),					
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
 
  		if(function_exists('icl_object_id')) { // check WPML plguin installed
 			$admin_ajax_url = admin_url('admin-ajax.php?lang='. ICL_LANGUAGE_CODE .'');
 		}else{
 			$admin_ajax_url = admin_url('admin-ajax.php');
 		}
 		 
		echo '<script type="text/javascript">'."\n";
		echo '//<![CDATA['."\n";
		echo 'var admin_ajaxurl = "'.$admin_ajax_url.'"; '."\n";
		echo '//]]>'."\n";
		echo '</script>'."\n";

		$jVariables=array( 
					"THEMEADMINURI" => THEMEADMINURI,
					"frameworkurl"	 => THEMEADMINURI.'/pages/rt-fonts.php'
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
		
		add_menu_page(THEMENAME, THEMENAME, $capability, 'rt_general_options', array(&$this, 'load_menu_page'), THEMEADMINURI .'/images/generic.png');
		
		foreach($this->panel_pages  as $menu_slug => $page_title){
			add_submenu_page( 'rt_general_options', $page_title, $page_title, $capability, $menu_slug , array(&$this, 'load_menu_page'));
		}
		
	
	}

	#
	#	Load Menu Pages
	#
    
	function load_menu_page(){
		global $RTThemePageLayoutOptionsClass;
 
		//Admin Header
		$this->admin_header();    
		
		if($_GET['page']=="rt_sidebar_options"){//sidebar options
			
			if ('save' == isset($_REQUEST['action']) ) {
 
				update_option('rt_sidebar_options', $this->rt_check_sidebar_array($_POST));

				echo '<div class="ok_box">';
				echo '	<p>'.__('New sidebar created successfully', 'rt_theme_admin').'</p>';
				echo '</div>';
			}
			
			require_once(THEMEFRAMEWORKDIR . "/classes/sidebar.php");			

		}elseif($_GET['page']=="rt_template_options"){//page layouts
			
			if ('save' == isset($_REQUEST['action']) ) {
		
		 		$RTThemePageLayoutOptionsClass->rt_save_page_templates();	

				echo '<div class="ok_box">';
				echo '	<p>'.__('New Template created successfully', 'rt_theme_admin').'</p>';
				echo '</div>';
			}
			
			require_once(THEMEFRAMEWORKDIR . "/classes/page_layouts.php");
			
		}elseif($_GET['page']=="update_notifications"){//update notifier
			
			include(THEMEFRAMEWORKDIR . "/admin/pages/update_notifications.php");
		
		}elseif($_GET['page']=="rt_setup_assistant"){//setup assistant 
			
			require_once(THEMEFRAMEWORKDIR . "/classes/rt_setup_assistant.php");
			
		}else{

			include(THEMEADMINDIR . "/options/" . $_GET['page'].'.php');
			
			if ('save' == isset($_REQUEST['action']) ) {
			    $this->rt_save_options($options);
			}	
			
			//Generate this form
			$this->rt_generate_form_page($options);
			
		}

		//Admin Footer
		$this->admin_footer();
	}


	
	#
	#	Save Options
	#
	
	function rt_save_options($options){
		
		foreach ($options as $value) { 

		$id=@$value['id'];
		$id_array=str_replace("[]","", $id);

			if(@is_array($_REQUEST[$id_array])){ 
				$request_value=@serialize($_REQUEST[ $id_array ]); 
			}else{
				$request_value=@stripslashes($_REQUEST[ $id ]) ;
			}

			if( @isset( $request_value ) &&  ( ( $request_value != @$value['default'] ) || (@!$value['dont_save']) ) ) {
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
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-ui-mouse');

		if( function_exists( 'wp_enqueue_media' ) ){
			wp_enqueue_media();
		}else{
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
		}	 

		wp_enqueue_script('iphone-style-checkboxes', THEMEADMINURI . '/js/iphone-style-checkboxes.js');
		wp_enqueue_script('color-picker', THEMEADMINURI . '/js/colorpicker.js');
		wp_enqueue_script('clue-tip', THEMEADMINURI . '/js/jquery.cluetip.min.js');
		wp_enqueue_script('jquery-tools', THEMEADMINURI . '/js/rangeinput.js');
		wp_enqueue_script('jquery-amselect', THEMEADMINURI . '/js/jquery.asmselect.js');  

		wp_enqueue_script('admin-scripts', THEMEADMINURI . '/js/script.js','','',true);		
	}

	#
	#	Load Admin Styles
	#
	
	function load_admin_styles(){
		wp_enqueue_style('admin-style', THEMEADMINURI . '/css/admin.css');
		wp_enqueue_style('iphone-style-checkboxes', THEMEADMINURI . '/css/checkboxes.css');
		wp_enqueue_style('color-picker-style', THEMEADMINURI . '/css/colorpicker.css');
		wp_enqueue_style('clue-tip-style', THEMEADMINURI . '/css/jquery.cluetip.css');		
		add_editor_style('editor-style.css'); //editor style  
	}

   
	#
	#	Get Theme Data
	#
	
	function rt_get_theme_version(){
		$theme_data = wp_get_theme(); 
		return $this->version = $theme_data['Version'];
	}

	#
	#	Create Metaboxes
	#

	function create_metaboxes() {
		//load metabox class
		include(THEMEFRAMEWORKDIR . "/classes/metaboxes.php"); 
		
		//page header custom fields - all post types
		include(THEMEADMINDIR . "/options/page_header_custom_fields.php"); 
		$rt_page_header_custom_fields = new rt_meta_boxes($settings,$customFields);

		//background custom fields - all post types
		include(THEMEADMINDIR . "/options/background_custom_fields.php"); 
		$rt_background_custom_fields = new rt_meta_boxes($settings,$customFields);

		//portfolio
		include(THEMEADMINDIR . "/options/portfolio_custom_fields.php"); 
		$rt_portfolio_custom_fields = new rt_meta_boxes($settings,$customFields);

		//slider
		include(THEMEADMINDIR . "/options/slider_custom_fields.php"); 
		$rt_slider_custom_fields = new rt_meta_boxes($settings,$customFields);

		//home page
		include(THEMEADMINDIR . "/options/home_custom_fields.php"); 
		$rt_home_page_custom_fields = new rt_meta_boxes($settings,$customFields);

		//products
		include(THEMEADMINDIR . "/options/product_custom_fields.php"); 
		$rt_product_custom_fields = new rt_meta_boxes($settings,$customFields);

		//posts
		include(THEMEADMINDIR . "/options/post_custom_fields.php"); 

		//common for posts and pages
		include(THEMEADMINDIR . "/options/common_custom_fields.php"); 
		$rt_common_custom_fields_template = new rt_meta_boxes($settings,$customFields);
		
		//common for custom fields - products and posts
		include(THEMEADMINDIR . "/options/common_custom_fields_custom_posts.php"); 
		$rt_common_custom_fields_custom_posts = new rt_meta_boxes($settings,$customFields); 

		//gallery upload options
		include(THEMEFRAMEWORKDIR . "/classes/metabox-gallery.php"); 
		$rt_gallery_upload_options = new rt_meta_box_gallery();
		$rt_gallery_upload_options -> rt_meta_gallery_init();


	}
	
	#
	#	Create Admin Header
	#

	function admin_header(){		 
		
		echo '<div class="rt-admin-wrapper">';
		 
		echo '	<!-- Left Side -->';
		echo '	<div class="box left-col">';
		echo '	<!-- theme info -->';
		echo '    <div class="theme_name">'. THEMENAME .'</div>';
		echo '    <div class="theme_name_2">'.__('THEME OPTIONS','rt_theme_admin').'</div>';
		echo '    <br /><br />';
		echo '	    <div class="infoline">';
		echo '		    <div class="version">'.__('Version','rt_theme_admin').' '.$this->version.'</div> <div>|</div> <div class="version"><a href="admin.php?page=update_notifications">'.__('Changelog','rt_theme_admin').'</a></div>';
		echo '	    </div> ';
		echo '	<!-- / theme info -->';
		
		echo '	<br /><br />';
			
		echo '	<!-- theme menu -->';
		echo '	<ul class="theme_menu">';

		foreach($this->panel_pages  as $menu_slug => $page_title){
			if($_GET['page']==$menu_slug){
				$active = "active";
			}else{
				$active = "";
			}
			echo '<li class="'.$menu_slug.' '.$active.'"><a href="'.WPADMINURI.'admin.php?page='.$menu_slug.'">'.$page_title.'</a></li>';
		}
		
		echo '	</ul>';
		echo '	<!-- / theme menu -->';			
			
		echo '</div>';
		echo '<!-- / Left Side -->';
		
		echo '<!-- Right Side -->';
		echo '<div class="box right-col">';

			
		if($this->panel_pages[$_GET['page']]){
			echo '	<h3 class="page_title">'.$this->panel_pages[$_GET['page']].'</h3>';
			echo '	<hr /> ';
		}

	}

	#
	#	Create Admin Footer
	#

	function admin_footer(){ 
	echo <<<FOOTER
		</div>
		<!-- / Right Side -->
		
		 <div class="clear"></div>
		</div>
FOOTER;
	}

	#
	#	Create Color Pickers
	#
	
	function color_picker($id,$hex){
	 
		echo '<script type="text/javascript" language="javascript">'. "\n";
		echo 'jQuery(document).ready(function(){'. "\n";
			echo 'jQuery(\'.'.$id.'.colorSelector\').ColorPicker({'. "\n";
			echo 'color: \''.$hex.'\','. "\n";
			echo 'onShow: function (colpkr) {'. "\n";
			echo '	jQuery(colpkr).fadeIn(500);'. "\n";
			echo '	return false;'. "\n";
			echo '},'. "\n";
			echo 'onHide: function (colpkr) {'. "\n";
			echo '	jQuery(colpkr).fadeOut(500);'. "\n";
			echo '	return false;'. "\n";
			echo '},'. "\n";
			echo 'onChange: function (hsb, hex, rgb) {'. "\n";
			echo '	jQuery(\'.'.$id.'.colorSelector div\').css(\'backgroundColor\', \'#\' + hex);'. "\n";
			echo '	jQuery(\'#'.$id.'\').attr(\'value\',\'#\' + hex);'. "\n";
			echo '}'. "\n";
			echo '});'. "\n";
		echo '});'. "\n";
		echo '</script>'. "\n";
	}


	#
	#	Create Form Page
	#
	
	function rt_generate_form_page($options){
	 
		echo '<form action="admin.php?page='. $_GET['page'].'" method="POST" id="'.$_GET['page'].'" >';
		
		//save button
		echo '<a title="'.__('Save Options','rt_theme_admin').'" class="rt_options_ajax_save"></a>';
		
		$this->rt_generate_forms($options);
	    
			echo '<table>';
			echo '    <tr>';
			echo '	<td class="col1" colspan="2">';
			echo '		<input type="button" id="footer_submit" value="'.__('Save Options','rt_theme_admin').'"> ';
			echo __('or','rt_theme_admin');
			echo ' <a href="?page=rt_general_options&reset_settings=true" class="reset" ';
			echo 'onclick="return confirm(\''.__('Are you sure that you want to reset all the theme settings?','rt_theme_admin').'\');"';
			echo '>'.__('reset settings','rt_theme_admin').'</a>';
			echo '	</td>';
			echo '</table><br />';
		
		echo '<input type="hidden" name="action" value="save" class="save">';    
		echo '</form>';
	 
	}
 

	#
	#	Check sidebar array 
	#	
	function rt_check_sidebar_array(){
		if(is_array($_POST)){
			
			$start_unset_count = 0;
			
			foreach($_POST as $key => $value){
				if(stristr($key, '_sidebar_name') == TRUE && $value=="") {					
					unset($_POST[$key]);
					$start_unset_count = 1;
				}
				
				if($start_unset_count>0){
					unset($_POST[$key]);
					$start_unset_count++;
				}

				if($start_unset_count==6){
					$start_unset_count = 0;
				}				
			}
		}
		
		
		$newPost = isset($newPost) ? $newPost : $_POST;		
		return $_POST;
	}
	 

	#
	#	Create Admin Forms
	#

	function rt_generate_forms($options) { 
		global $RTThemePageLayoutOptionsClass;
		
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
			$field_value 	= get_option($id);
			
			//page templates
			
			
			if($purpose=="page_layouts"){
				
				if($content_type=="home_page_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_homepage_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}
 
				if($content_type=="portfolio_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_portfolio_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}

				if($content_type=="sidebar_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_sidebar_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}

				if($content_type=="default_content") {
					$RTThemePageLayoutOptionsClass->rt_generate_default_content_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}
				
				if($content_type=="all_content_boxes") {
					$RTThemePageLayoutOptionsClass->rt_generate_all_content_boxes($v['options']['group_id'],$v['id'],$v['options'],"");
				}

				if($content_type=="banner_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_banner_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}	

				if($content_type=="slider_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_slider_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}
				
				if($content_type=="revolution_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_revolution_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}

				if($content_type=="product_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_product_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}

				if($content_type=="woo_products_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_woo_products_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}

				if($content_type=="google_map") {
					$RTThemePageLayoutOptionsClass->rt_generate_google_map($v['options']['group_id'],$v['id'],$v['options'],"");
				}

				if($content_type=="contact_form") {
					$RTThemePageLayoutOptionsClass->rt_generate_contact_form($v['options']['group_id'],$v['id'],$v['options'],"");
				}

				if($content_type=="contact_info_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_contact_info_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}
				
				if($content_type=="blog_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_blog_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}					

				if($content_type=="heading_bar") {
					$RTThemePageLayoutOptionsClass->rt_generate_heading_bar($v['options']['group_id'],$v['id'],$v['options'],"");
				}

				if($content_type=="code_box") {
					$RTThemePageLayoutOptionsClass->rt_generate_code_box($v['options']['group_id'],$v['id'],$v['options'],"");
				}	
			}
			
			//help
			if(!empty($v['help'])){
				$help ='<td class="col3"><a class="question" href="#" rel="'.THEMEADMINURI.'/pages/help.php?tipID='.$v['id'].'&tipName='.$v['name'].'&adminURI='.THEMEADMINURI.'" title="'.$v['name'].'"></a></td>';
			}else{
				$help ='<td class="col3"> </td>';
			}
			
			//default value
			if(!empty($v['default']) && !empty($v['dont_save']) && empty($field_value)){
				$field_value=$v['default'];
			}
			
			//exact value
			if(!empty($v['value'])){
				$field_value=$v['value'];
			}
			
			
			//side button
			if(!empty($v['sidebuttonName'])){
				$side_button='<input type="button" value="'.$v['sidebuttonName'].'" id="'.$v['id'].'" class="'.$v['sidebuttonClass'].'"/>';
			}else{
				$side_button ="";
			}
			
			switch ($v['type']){
			
				#
				#	Info
				#
				case 'info';			
					
				echo '<div class="info">'.$desc.'</div>'; 		
				
				break;
				
				
				#
				#	Grid
				#
				case 'grid';			
					
					if($v['part']=="first" || $v['part']=="full"){
						echo '<table class="page-template-grid-table">';
						echo '<tr><td><ul id="sortable-'.$v['id'].'" class="rt-ui-sortable">';
					}
					
					if($v['part']=="second" || $v['part']=="full"){
						echo '</ul></td></tr>';
						echo '</table>';
					}
				
				break;
				
				
				#
				#	Headings
				#
				case 'heading';			
				
				echo '<table class="seperator">';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><h4 class="sub_title">'.$v['name'].'</h4>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '</table>'; 		
				
				break;

				#
				#	Info Text - with icon
				#
				case 'info_text_only';			
					
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><div class="info_text">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '</table>'; 	
				
				break;
			
				#
				#	Info Text - without icon
				#
				case 'info_text';			
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$name.'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>'; 
				echo '</table>';		
				
				break;
			
			
				#
				#	Text Fields
				#
				case 'text';			
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$id.'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element"><input type="text" name="'.$v['id'].'" value="'.htmlentities($field_value,ENT_QUOTES, "UTF-8").'" id="'.$v['id'].'" class="'.$class.'"></div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break;


				#
				#	Hidden Fields
				#
				case 'hidden';			
				
				echo '<input type="hidden" name="'.$v['id'].'" value="'.$field_value.'" id="'.$v['id'].'">';
				
				break;
			
	
				#
				#	Button
				#
				case 'button';
				
				echo '<table>'; 
				echo '    <tr>';
				echo '	<td class="col2"><input type="button" value="'.$v['name'].'" id="'.$v['id'].'" class="'.$v['class'].' button"/>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break; 

				#
				#	Send Button
				#
				case 'send_button';
				
				echo '<table>'; 
				echo '    <tr>';
				echo '	<td class="col2"><input type="submit" value="'.$v['name'].'" id="'.$v['id'].'" class="'.$v['class'].' button"/>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break; 			 

				#
				#	Upload
				#
				case 'upload';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';

				echo '
				<td class="col2">
				<div class="form_element upload"><input autocomplete="off" type="text" name="'.$id.'" value="'.$field_value.'" id="'.$id.'" class="upload_field">  
				<button data-inputid="'.$id.'" class="template_button light rttheme_upload_button" type="button">'.__('Upload','rt_theme_admin').'</button>
				</div>';
 

				echo ($field_value) ? '<div data-holderid="'.$id.'" class="uploaded_file visible">' : '<div data-holderid="'.$id.'" class="uploaded_file ">'; 

					if($field_value){
						echo '<img class="loadit" src="'.$field_value.'"  data-image="'.$id.'" >';
					}else{ 
						echo '<img class="loadit" src="'.THEMEADMINURI.'/images/blank.png"  data-image="'.$id.'">';	 			
					}  

				echo '<span class="delete_single" title="'.__("remove image","rt_theme_admin").'" data-inputid="'.$id.'"><img src="'.THEMEADMINURI.'/images/delete.png" class="delete_image '.$id.'" id="delete_'.$id.'"></span>';
				echo '</div>';
				echo '</td></tr></table>';		
				
				break;


				#
				#	Radio Buttons
				#
				case 'radio';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="check"> ';				    				 
			

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
								 echo '<input type="radio" name="'.$v['id'].'" value="'.$option_value.'" checked></div></div>';
								 echo '<label>'.$option_name.'</label>';
								 echo '</td>';
							}else{
								 echo '<td><div class="first_div '.$class.'"><div class="radio_cover radio_'.$option_value.' '.$class.'">';
								 echo '<input type="radio" name="'.$v['id'].'" value="'.$option_value.'"></div></div>';
								 echo '<label>'.$option_name.'</label>';
								 echo '</td>';
							}
						}else{
							if ($field_value==$option_value){
								echo '<span class="radio_button_holder">';
								echo '<input type="radio" name="'.$v['id'].'" value="'.$option_value.'" checked id="'.$v['id'].'-'.$field_counter.'">';
								echo '<label for="'.$v['id'].'-'.$field_counter.'">'.$option_name.'</label>';
								echo '</span>';
							}else{
								echo '<span class="radio_button_holder">';
								echo '<input type="radio" name="'.$v['id'].'" value="'.$option_value.'" id="'.$v['id'].'-'.$field_counter.'">';
								echo '<label for="'.$v['id'].'-'.$field_counter.'">'.$option_name.'</label>';
								echo '</span>';
							}
						}
						$field_counter++;
					}
					echo '</tr></table>';
					
					
				echo '</div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';	 
				break;


				#
				#	Checkbox
				#
				case 'checkbox';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element check"><input class="'.$class.'" type="checkbox" name="'.$v['id'].'"';
				    
				    if($field_value=="checked" || $field_value=="on"){
					echo ' checked="checked" '; 
				    }
				    
				echo 'id="'.$v['id'].'"/></div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';	 
				break;
				
				#
				#	Select
				#
				case 'select';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				
				//font demo
				$fontDemo 	=  (!empty($v['font-demo'])) ? $v['font-demo'] : "";
				
				if(!empty($fontDemo)){
				//font-family name
				$font_family_name = isset($this->google_fonts[$field_value][0]) ? $this->google_fonts[$field_value][0] : "";
				echo '    <tr>';
				echo '	<td class="col1" colspan="2">';
				echo '	<iframe scrolling="no" id="'.$v['id'].'_iframe" class="fontdemo" src="'.THEMEADMINURI.'/pages/rt-fonts.php?font='.$field_value.'&system='.$v['font-system'].'&family_name='.$font_family_name.'">Your browser does not support iframes.</iframe>';
				echo '	</td>';
				echo '    </tr>';
				} 
				 
				$extraClass  =  (!empty($v['sidebuttonName'])) ? "withbutton": '';
				
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element">';
				echo '	<select name="'.$v['id'].'" id="'.$v['id'].'" class="'.$class.' '.$fontSystem.' '. $extraClass .' ">';
					
					if(isset($v['select']) && $v['select']) echo '<option value="">'.$v['select'].'</option>';
					    
					foreach($v['options'] as $option_value => $option_name){					
						//if array
						if(is_array($option_name)){
							$option_name = $option_name[1];
							//font-family name
							$font_family_name = isset($this->google_fonts[$option_value][0]) ? $this->google_fonts[$option_value][0] : ""; 
						}else{
							$font_family_name = "";
						}
			
					    if ($field_value==$option_value){
						echo '<option value="'.$option_value.'" class="'.$font_family_name.'__" selected>'.$option_name.'</option>';
					    }else{
						echo '<option value="'.$option_value.'" class="'.$font_family_name.'___" >'.$option_name.'</option>';
					    }
					} 
					    
				echo '	</select>';
				echo $side_button;
				echo '</div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break;
	
	
				#
				#	Multiple Select
				#
				case 'selectmultiple';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				 
	
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element">';

				
				
				if(!empty($purpose)){
					$saved_array=$v['default'];
				}else{
					$saved_array=$field_value;
					if(!is_array($saved_array)) $saved_array = unserialize($field_value);	
				}
				 
				if(isset($v['select'])) {
					echo '<select multiple name="'.$v['id'].'" id="'.$v['id'].'" class="multiple '.$class.' '.$fontSystem.'"  title="'.$v['select'].'">';  
				}else{
					echo '<select multiple name="'.$v['id'].'" id="'.$v['id'].'" class="multiple '.$class.' '.$fontSystem.'"  title="'.__('Select','rt_theme_admin').'">';
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
					
	
				echo '	</select>'; 
				echo '</div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break;		
				
				
				#
				#	Color Picker
				#
				case 'colorpicker';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="color-picker-holder"><div class="form_element color"><input type="text" name="'.$v['id'].'" value="'.$field_value.'" id="'.$v['id'].'"></div>';
				echo '	<div class="'.$v['id'].' colorSelector"><div style="background-color: '.$field_value.'"></div></div></div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';
				
				$this ->color_picker($v['id'],$field_value);
				
				break;
	
				#
				#	Range input
				#
				case 'rangeinput';			
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element"><input type="text" class="range '.$class.'" name="'.$v['id'].'" id="'.$v['id'].'" min="'.$v['min'].'" max="'.$v['max'].'" step="1" value="'.$field_value.'" /></div></td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';		
				
				break;
			
				#
				#	Textarea
				#
				case 'textarea';
				
				echo '<table>';
				echo '    <tr>';
				echo '	<td class="col1" colspan="2"><label for="'.$v['id'].'">'.$v['name'].'</label>';
				if($desc) echo '<div class="desc">'.$desc.'</div>';
				echo '	</td>';
				echo '    </tr>';
				echo '    <tr>';
				echo '	<td class="col2"><div class="form_element"><textarea name="'.$v['id'].'" id="'.$v['id'].'">'.htmlspecialchars($field_value).'</textarea></div>';
				echo '	</td>';
				echo $help;
				echo '    </tr>';
				echo '</table>';
					 
				 
				break;
	
				#
				#	Div sidebar
				#
				case 'div'; 
				echo '<div id="'.$v['id'].'" class="sidebar_div '.$class.'">';
				echo '<div class="sidebar_title">'.$v['name'].'<div class="openclose '.$v['id'].'">+</div></div><div class="table_holder">'; 
				break;
	
				#
				#	Divend 
				#
				case 'divend'; 
				echo '</div></div>'; 
				break; 			
	

				#
				#	Grid tempalte buldider
				#
				case 'template_grids'; 
				echo '<div id="'.$v['id'].'" class="sidebar_div '.$class.'">';
				echo '<div class="sidebar_title">'.$v['name'].'<div class="openclose '.$v['id'].'">+</div></div>'; 
				break;
	

				#
				#	Grid end
				#
				case 'template_gridsend'; 
				echo '</div>'; 
				break;
			
				}
		
				
				#
				#	HR
				#
				if($hr=="true") echo "<hr />";
				
				
				#
				#	
				#
		}
	}


}
?>

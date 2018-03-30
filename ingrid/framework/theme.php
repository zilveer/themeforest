<?php
error_reporting(E_ALL);



// theme url
	$framework_url = get_template_directory_uri().'/framework/';
	$theme_text_domain = 'ingrid';	


// version compare	
	$wp_version = get_bloginfo('version');
	$GLOBALS['nu_wp_version'] = '';
	if(version_compare($wp_version,'3.6-beta1','>=')){
		//$GLOBALS['nu_wp_version'] = '1';
	}
	
	
	
// dashboard widget 
	function my_custom_dashboard_widgets_tp() {
		global $wp_meta_boxes;	
		add_meta_box( 'custom_help_widget', 'Welcome!', 'custom_dashboard_help', 'dashboard', 'normal', 'high' );	
	}

	function custom_dashboard_help() {	
		echo '<p id="themeprince"><a href="http://www.themeprince.com/" target="_blank"><img src="'.get_template_directory_uri().'/images/themeprince.jpg" style="float: left; margin-right: 15px;" /></a>
			<span class="themeprince_h4">Thank you for choosing Theme Prince!</span><br /><br />
			We appriciate that you decided to use one of our themes. Please read the included documentation carefully and in case something is not working properly, use
			our <a href="http://www.themeprince.com/">support forum</a> to receive help. All reported bugs will be fixed and updated.		
			Don\'t forget to <a href="http://www.themeprince.com/" target="_blank">visit our site</a> regularly because we release a new theme every month!
			<br /><br />
			Kind regards,<br />
			<a href="http://www.themeprince.com/" target="_blank">Theme Prince</a><br /><br />
		</p>';	
	}
	add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets_tp');

	
	
// sets up the content width value based on the theme's design and stylesheet
	if ( ! isset( $content_width ) ){
		$content_width = 980;
	}
	
	
 
// set up theme defaults
	function tp_fw_setup() {
		
		// makes theme available for translation
		load_theme_textdomain( 'ingrid', get_template_directory() . '/languages' );
		
		// this theme styles the visual editor with editor-style.css to match the theme style
		if(is_admin()){
			require_once('includes/editor_styles.inc.php');	
		}
		add_editor_style();

		// adds rss feed links to <head> for posts and comments
		add_theme_support( 'automatic-feed-links' );

		// this theme supports a variety of post formats
		add_theme_support( 'post-formats', array( 'aside', 'link', 'image', 'gallery', 'quote', 'audio', 'video' ) );	
				
		// this theme uses wp_nav_menu() in one location
		register_nav_menu( 'primary', __( 'Primary Menu', 'ingrid' ) );
				
		// support shortcodes in text widgets
		add_filter( 'widget_text', 'do_shortcode');
				
				
		// replaces the excerpt "more" text by a link
		function new_excerpt_more() {
			   global $post;
			return '<br /><br /><a class="moretag" href="'. get_permalink($post->ID) . '">'.__('Read more &rarr;','ingrid').'</a>';
		}
		//add_filter('excerpt_more', 'new_excerpt_more');		
		
		//remove gallery inline style
		add_filter( 'use_default_gallery_style', '__return_false' );
		
		

		//change default gravatar
		add_filter( 'avatar_defaults', 'newgravatar' );  		  
		function newgravatar ($avatar_defaults) {  
			$myavatar = get_template_directory_uri() . '/images/avatar.jpg';  
			$avatar_defaults[$myavatar] = "inGrid user";  
			return $avatar_defaults;  
		}  

		
		// this theme uses a custom image size for featured images, displayed on "standard" posts
		add_theme_support( 'post-thumbnails' );
		
		// set thumbnail sizes with wp, forget custom imagecrop scripts		
		set_post_thumbnail_size( 347, 158, true ); // width, height, crop = true		
		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'widget-thumb', 80, 55, true ); // name, width, height, crop = true			
			add_image_size( 'grid-one-one', 241, 144, true ); // name, width, height, crop = true
			add_image_size( 'grid-one-two', 241, 292, true ); // name, width, height, crop = true
			add_image_size( 'grid-two-one', 486, 144, true ); // name, width, height, crop = true
			add_image_size( 'grid-two-two', 486, 292, true ); // name, width, height, crop = true			
		}
		
	}
	add_action( 'after_setup_theme', 'tp_fw_setup' );
	
		

// enqueues scripts and styles for backend
	function tp_fw_backend_scripts_styles(){
	
		$myStyleUrl = get_template_directory_uri() . '/css/admin.css';
		wp_register_style('myStyleSheets', $myStyleUrl);
        wp_enqueue_style('myStyleSheets');        		
		
		print '
		<script type="text/javascript">
		var templateDir = "'. get_template_directory_uri() .'";
		</script>
		';
		
		if(!empty($_GET['page']) && $_GET['page'] == 'tp_theme_layout'){					
			
			wp_deregister_script('farbtastic');
			wp_register_script( 'farbtastic', get_template_directory_uri() . '/js/farbtastic.js');
			wp_enqueue_script('farbtastic');
			
			
			wp_deregister_style('farbtastic');
			wp_register_style('farbtastic', get_template_directory_uri() . '/css/farbtastic.css');
			wp_enqueue_style( 'farbtastic' );			
			
			wp_register_script( 'tos', get_template_directory_uri() . '/js/tp_theme_layout.js');
			wp_enqueue_script( 'tos' );
			
			if(function_exists( 'wp_enqueue_media' )){
				wp_enqueue_media();
			}else{
				wp_enqueue_script('jquery');  
		  
				wp_enqueue_script('thickbox');  
				wp_enqueue_style('thickbox');  
		  
				wp_enqueue_script('media-upload');  
				wp_enqueue_script('wptuts-upload');  
			}
		
			wp_register_script( 'admin_mediaup', get_template_directory_uri() . '/js/admin_media_upload.js');
			wp_enqueue_script( 'admin_mediaup' );
		}
		
		if(!empty($_GET['post']) && $_GET['post'] != ''){
			if(function_exists( 'wp_enqueue_media' )){
				wp_enqueue_media();
			}else{
				wp_enqueue_script('jquery');  
		  
				wp_enqueue_script('thickbox');  
				wp_enqueue_style('thickbox');  
		  
				wp_enqueue_script('media-upload');  
				wp_enqueue_script('wptuts-upload');  
			}
		
			wp_register_script( 'admin_mediaup', get_template_directory_uri() . '/js/admin_media_upload.js');
			wp_enqueue_script( 'admin_mediaup' );
		}

		if(!empty($_GET['page']) && $_GET['page']=='tp_theme_typography'){			
			
			//enqueue font-face
			wp_register_style('admin_fontface_fonts', get_template_directory_uri() . '/css/admin_fontface_fonts.css');
            wp_enqueue_style( 'admin_fontface_fonts'); 			
			
			$tp_typography_custom_fonts = unserialize(get_option('tp_typography_custom_fonts'));
			if($tp_typography_custom_fonts != ''){
				$impf = implode(',',$tp_typography_custom_fonts);
				wp_register_style('load_admin_custom_fonts', get_template_directory_uri() . '/framework/includes/load_admin_custom_fonts.inc.php?fonts='.$impf);
				wp_enqueue_style( 'load_admin_custom_fonts' );
			}
			
			wp_deregister_script('farbtastic');
			wp_register_script( 'farbtastic', get_template_directory_uri() . '/js/farbtastic.js');
			wp_enqueue_script('farbtastic');
			
			
			wp_deregister_style('farbtastic');
			wp_register_style('farbtastic', get_template_directory_uri() . '/css/farbtastic.css');
			wp_enqueue_style( 'farbtastic' );			
			
			wp_register_script( 'tos', get_template_directory_uri() . '/js/tp_theme_typography.js');
			wp_enqueue_script( 'tos' );
		}			
		
		if(!empty($_GET['page']) && $_GET['page'] == 'tp_theme_general'){
			if(function_exists( 'wp_enqueue_media' )){
				wp_enqueue_media();
			}else{
				wp_enqueue_script('jquery');  
		  
				wp_enqueue_script('thickbox');  
				wp_enqueue_style('thickbox');  
		  
				wp_enqueue_script('media-upload');  
				wp_enqueue_script('wptuts-upload');  
			}
		
			wp_register_script( 'admin_mediaup', get_template_directory_uri() . '/js/admin_media_upload.js');
			wp_enqueue_script( 'admin_mediaup' );
		}
		
		if(strstr($_SERVER['SCRIPT_NAME'],'/post-new.php') OR strstr($_SERVER['SCRIPT_NAME'],'/post.php') OR strstr($_SERVER['SCRIPT_NAME'],'/widgets.php')){
			wp_register_script( 'admin_scg', get_template_directory_uri() . '/js/admin_scripts.js');
			wp_enqueue_script( 'admin_scg' );			
		}		
				
		if(strstr($_SERVER['SCRIPT_NAME'],'/post-new.php') OR strstr($_SERVER['SCRIPT_NAME'],'/post.php')){
			wp_register_script( 'admin_blogcats', get_template_directory_uri() . '/js/admin_blog_categories.js');
			wp_enqueue_script( 'admin_blogcats' );			
			
			wp_register_script( 'admin_mediaup', get_template_directory_uri() . '/js/admin_media_upload.js');
			wp_enqueue_script( 'admin_mediaup' );
		}				
				
		if(strstr($_SERVER['SCRIPT_NAME'],'/widgets.php')){			
			wp_register_script( 'widg', get_template_directory_uri() . '/js/widgets.js');
			wp_enqueue_script( 'widg' );			
		}		
	
	
	}
	add_action('admin_enqueue_scripts', 'tp_fw_backend_scripts_styles');

	

//frontend scipts and styles
	function tp_frontend_load(){
	
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');	
		wp_enqueue_script('jquery-ui-tabs');	
		
		//retina JS				
		if(get_option('tp_retina') != 'off'){
			wp_enqueue_script( 'retina_js', get_template_directory_uri() . '/js/retina.min.js', '', '', true );
		}
		
		//font awesome
		wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome.min.css',array(),null,'all');		
		
		wp_register_script('audio-player', get_template_directory_uri().'/js/audio-player.js', false);
		wp_enqueue_script('audio-player');
		
		wp_register_script('prettyphoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', false);
		wp_enqueue_script('prettyphoto');
		
		wp_register_style('prettyphoto', get_template_directory_uri().'/css/prettyPhoto.css', false);
		wp_enqueue_style('prettyphoto');
		
		if(is_page_template('page-fw_slider.php')){
			wp_register_script('tp-fws', get_template_directory_uri().'/js/tp_fw_slider.js', false);
			wp_enqueue_script('tp-fws');
		}
			
		wp_register_script('tp-carousel', get_template_directory_uri().'/js/tp_carousel.js', false);
		wp_enqueue_script('tp-carousel');
			
		wp_enqueue_script('jquery-masonry');
		
		if(is_page_template('page-pinterest.php')){		
			wp_register_script('ajaxLoop',get_template_directory_uri().'/js/ajaxLoop.js',array('jquery'));  
			wp_enqueue_script('ajaxLoop');  
		}
		
		if( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
			wp_enqueue_script( 'comment-reply' );
		}

		
		//load basic javascripts and functions
		wp_enqueue_script('startup', get_template_directory_uri().'/js/startup.js', array('jquery'));	
	
	
		//load stylesheets
		$tp_responsive = get_option('tp_responsive');
		if($tp_responsive != 'off'){
			wp_enqueue_style('ingrid-css', get_stylesheet_uri(),array(),null,'all and (min-width: 990px)');
		}else{
			wp_enqueue_style('ingrid-css', get_stylesheet_uri(),array(),null,'all');
		}
		
		
		if($tp_responsive != 'off'){
			wp_enqueue_style('tablet-css',get_template_directory_uri().'/style-tablet-responsive.css',array(),null,'all and (min-width: 781px) and (max-width: 989px)');
			wp_enqueue_style('mobile-css',get_template_directory_uri().'/style-mobile-responsive.css',array(),null,'all and (max-width: 780px)');
		}
		
		
		//ie-only style sheets
		global $wp_styles;
		wp_register_style('tp-ltie9', get_template_directory_uri(). '/css/ie.css',array(),null);
		$wp_styles->add_data('tp-ltie9', 'conditional', 'lt IE 9');		
		wp_enqueue_style('tp-ltie9');
		
		wp_register_style('tp-ltie9-def', get_template_directory_uri(). '/style.css',array(),null);
		$wp_styles->add_data('tp-ltie9-def', 'conditional', 'lt IE 9');		
		wp_enqueue_style('tp-ltie9-def');
		
		wp_register_style('tp-ltie8', get_template_directory_uri(). '/css/stop_ie.css',array(),null);
		$wp_styles->add_data('tp-ltie8', 'conditional', 'lt IE 8');		
		wp_enqueue_style('tp-ltie8');
		
	
	}
	add_action( 'wp_enqueue_scripts', 'tp_frontend_load' );
	
	
	
//load user style settings in the end of head
	function tp_frontend_last(){
		print '
		<!-- load user style settings -->
		<style type="text/css">';
		require_once('includes/load_styles.inc.php');
		print '</style>
		';
	}
	add_action('wp_head','tp_frontend_last');
	
/******************************************************************************************/
// register widgetized areas, and load custom ones also!
	function tp_fw_widgets_init() {
	
		// located at the sidebar.
		register_sidebar( array(
			'name' => __( 'Sidebar Widget Area', 'ingrid' ),
			'id' => 'sidebar-widget-area',
			'description' => __( 'The sidebar widget area', 'ingrid' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// area 2, located in the footer.
		register_sidebar( array(
			'name' => __( 'First Footer Widget Area', 'ingrid' ),
			'id' => 'first-footer-widget-area',
			'description' => __( 'The first footer widget area', 'ingrid' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// area 3, located in the footer. 
		register_sidebar( array(
			'name' => __( 'Second Footer Widget Area', 'ingrid' ),
			'id' => 'second-footer-widget-area',
			'description' => __( 'The second footer widget area', 'ingrid' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// area 4, located in the footer.
		register_sidebar( array(
			'name' => __( 'Third Footer Widget Area', 'ingrid' ),
			'id' => 'third-footer-widget-area',
			'description' => __( 'The third footer widget area', 'ingrid' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

		// area 5, located in the footer.
		register_sidebar( array(
			'name' => __( 'Fourth Footer Widget Area', 'ingrid' ),
			'id' => 'fourth-footer-widget-area',
			'description' => __( 'The fourth footer widget area', 'ingrid' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		
		
		$ub_custom_widget_areas = maybe_unserialize(get_option('ub_custom_widget_areas'));
		if(!empty($ub_custom_widget_areas)){
		foreach($ub_custom_widget_areas as $ub_c_w_a){
			//register them
					register_sidebar( array(
						'name' => $ub_c_w_a['title'],
						'id' => $ub_c_w_a['id'],
						'description' => __( 'A custom widget area', 'ingrid' ),
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget' => '</aside>',
						'before_title' => '<h3 class="widget-title">',
						'after_title' => '</h3>',
					) );
		}
		}
		
	}	
	add_action( 'widgets_init', 'tp_fw_widgets_init' );

/******************************************************************************************/
// remove custom widget area
	if ( is_admin() ) {		
		if(strstr($_SERVER['REQUEST_URI'],'/widgets.php?remove_w_a')){			
			$expurl = explode('widgets.php?remove_w_a=',$_SERVER['REQUEST_URI']);
			$ub_custom_widget_areas = maybe_unserialize(get_option('ub_custom_widget_areas'));	
			$nu_ub_wa_a = Array();
			foreach($ub_custom_widget_areas as $ubw_a){
				if($ubw_a['id'] != end($expurl)){
					$nu_ub_wa_a[] = $ubw_a;
				}
			}
			update_option('ub_custom_widget_areas',maybe_serialize($nu_ub_wa_a));
			header("Location: widgets.php");
		}
	}
	
/******************************************************************************************/	
// removes the default styles that are packaged with the Recent Comments widget
	function tp_fw_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
	add_action( 'widgets_init', 'tp_fw_remove_recent_comments_style' );
	
		

/******************************************************************************************/	
// load widgets
	require_once('widgets/recent_posts.php');
	require_once('widgets/popular_posts.php');
	require_once('widgets/flickr.php');
	require_once('widgets/tabs.php');	
	require_once('widgets/tags.php');	
	require_once('widgets/facebook.php');	
	require_once('widgets/embed.php');	
	require_once('widgets/contact_info.php');	

	
/******************************************************************************************/
// frontend only!
	if ( !is_admin() ) {	
		// load shortcodes
			require_once('shortcodes/shortcodes.php');			
	}	
	

/******************************************************************************************/	
// shortcode generator
	if ( is_admin() ) {	
		require_once(TEMPLATEPATH . "/framework/includes/shortcode_generator.inc.php");
	}


/******************************************************************************************/
// widget area selector/creator	for PAGE only	
	if ( is_admin() ) {		
		require_once(TEMPLATEPATH . "/framework/includes/widget_areas.inc.php");
	}

	
	

/******************************************************************************************/
// pages - revolution slider settings
	if ( is_admin() ) {
		$new_meta_boxes_page_pingrid  = array(
			"sc_gen" => array(
			"name" => "tp_page_title",
			"std" => "",
			"title" => "Grid Box Settings"
			)
		);
		
		function new_meta_boxes_page_pingrid() {		
			global $post, $new_meta_boxes_page_pingrid;
						
			$tp_page_pingrid_excerpt = get_post_meta($post->ID, 'tp_page_pingrid_excerpt', true);		
			$tp_page_pingrid_date = get_post_meta($post->ID, 'tp_page_pingrid_date', true);		
			$tp_page_pingrid_comm = get_post_meta($post->ID, 'tp_page_pingrid_comm', true);		
			$tp_page_pingrid_commtxt = get_post_meta($post->ID, 'tp_page_pingrid_commtxt', true);		
			$tp_page_pingrid_author = get_post_meta($post->ID, 'tp_page_pingrid_author', true);		
			$tp_page_pingrid_review = get_post_meta($post->ID, 'tp_page_pingrid_review', true);		
			$tp_page_pingrid_limit = get_post_meta($post->ID, 'tp_page_pingrid_limit', true);		
						
			print '			
			<p><input type="checkbox" name="tp_page_pingrid_excerpt" id="tp_page_pingrid_excerpt" value="1"'; if($tp_page_pingrid_excerpt == '1'){print ' checked="checked"';} print ' /> <label for="tp_page_pingrid_excerpt">'.__('Hide excerpt','ingrid').'</label></p>	
			<p><input type="checkbox" name="tp_page_pingrid_date" id="tp_page_pingrid_date" value="1"'; if($tp_page_pingrid_date == '1'){print ' checked="checked"';} print ' /> <label for="tp_page_pingrid_date">'.__('Hide date','ingrid').'</label></p>	
			<p><input type="checkbox" name="tp_page_pingrid_comm" id="tp_page_pingrid_comm" value="1"'; if($tp_page_pingrid_comm == '1'){print ' checked="checked"';} print ' /> <label for="tp_page_pingrid_comm">'.__('Hide comments number','ingrid').'</label></p>	
			<p><input type="checkbox" name="tp_page_pingrid_commtxt" id="tp_page_pingrid_commtxt" value="1"'; if($tp_page_pingrid_commtxt == '1'){print ' checked="checked"';} print ' /> <label for="tp_page_pingrid_commtxt">'.__('Show last approved comment','ingrid').'</label></p>				
			<p><input type="checkbox" name="tp_page_pingrid_author" id="tp_page_pingrid_author" value="1"'; if($tp_page_pingrid_author == '1'){print ' checked="checked"';} print ' /> <label for="tp_page_pingrid_author">'.__('Hide author','ingrid').'</label></p>	
			<p><input type="checkbox" name="tp_page_pingrid_review" id="tp_page_pingrid_review" value="1"'; if($tp_page_pingrid_review == '1'){print ' checked="checked"';} print ' /> <label for="tp_page_pingrid_review">'.__('Hide review','ingrid').'</label></p>							
			<p><label for="tp_page_pingrid_limit">'.__('Number of posts to load','ingrid').'</label> <input type="text" style="width: 30px;" name="tp_page_pingrid_limit" id="tp_page_pingrid_limit" value="'.$tp_page_pingrid_limit.'" /> <span class="description">'.__('Default: 9','ingrid').'</span></p>				
			';
			
		}
		
		function create_meta_box_page_pingrid() {
			global $theme_name;
			if ( function_exists('add_meta_box') ) {
				add_meta_box( 'new-meta-boxes-page_pingrid', 'Grid Box Settings', 'new_meta_boxes_page_pingrid', 'page', 'side', 'default' );		
			}
		}
		add_action('admin_menu', 'create_meta_box_page_pingrid');

		//save meta box values 
			function save_postdata_page_pingrid(){		
				global $post, $new_meta_boxes_page_pingrid;
								
				if(!empty($_POST['tp_page_pingrid_excerpt']) && is_object($post)){ update_post_meta($post->ID,'tp_page_pingrid_excerpt',$_POST['tp_page_pingrid_excerpt']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_page_pingrid_excerpt'); }
				if(!empty($_POST['tp_page_pingrid_date']) && is_object($post)){ update_post_meta($post->ID,'tp_page_pingrid_date',$_POST['tp_page_pingrid_date']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_page_pingrid_date'); }
				if(!empty($_POST['tp_page_pingrid_comm']) && is_object($post)){ update_post_meta($post->ID,'tp_page_pingrid_comm',$_POST['tp_page_pingrid_comm']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_page_pingrid_comm'); }
				if(!empty($_POST['tp_page_pingrid_commtxt']) && is_object($post)){ update_post_meta($post->ID,'tp_page_pingrid_commtxt',$_POST['tp_page_pingrid_commtxt']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_page_pingrid_commtxt'); }
				if(!empty($_POST['tp_page_pingrid_author']) && is_object($post)){ update_post_meta($post->ID,'tp_page_pingrid_author',$_POST['tp_page_pingrid_author']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_page_pingrid_author'); }
				if(!empty($_POST['tp_page_pingrid_review']) && is_object($post)){ update_post_meta($post->ID,'tp_page_pingrid_review',$_POST['tp_page_pingrid_review']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_page_pingrid_review'); }
				if(!empty($_POST['tp_page_pingrid_limit']) && is_object($post)){ update_post_meta($post->ID,'tp_page_pingrid_limit',$_POST['tp_page_pingrid_limit']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_page_pingrid_limit'); }
				
			}
			add_action('save_post', 'save_postdata_page_pingrid');
	}	
	
	
		
	
	
	
	

/******************************************************************************************/
// pages - revolution slider settings
	if ( is_admin() ) {
		$new_meta_boxes_page_revslider  = array(
			"sc_gen" => array(
			"name" => "tp_page_title",
			"std" => "",
			"title" => "Revolution Slider"
			)
		);
		
		function new_meta_boxes_page_revslider() {		
			global $post, $new_meta_boxes_page_revslider;
						
			$tp_page_revslider_id = get_post_meta($post->ID, 'tp_page_revslider_id', true);		
			$tp_page_revslider_nosep = get_post_meta($post->ID, 'tp_page_revslider_nosep', true);		
			
			
			print '
			<p><strong>'.__('Alias Name of Slider to Show','ingrid').'</strong></p>		
			<p><input type="text" class="widefat" name="tp_page_revslider_id" value="'.$tp_page_revslider_id.'" /></p>	
			<div class="vspace"></div>			
			<p><strong>'.__('Hide bottom separator','ingrid').'</strong></p>		
			<p>'.__('Here you can disable the bottom separator line below the slider','ingrid').'</p>
			<p><input id="tp_page_revslider_nosep" name="tp_page_revslider_nosep" type="checkbox" value="1"'; if($tp_page_revslider_nosep == '1'){print ' checked="checked"';} print ' /> <label for="tp_page_revslider_nosep">'.__('Disable bottom separator line','ingrid').'</label></p>
			';
			
		}
		
		function create_meta_box_page_revslider() {
			global $theme_name;
			if ( function_exists('add_meta_box') ) {
				add_meta_box( 'new-meta-boxes-page_revslider', 'Revolution Slider', 'new_meta_boxes_page_revslider', 'page', 'side', 'default' );		
			}
		}
		add_action('admin_menu', 'create_meta_box_page_revslider');

		//save meta box values 
			function save_postdata_page_revslider(){		
				global $post, $new_meta_boxes_page_revslider;
				
				if(!empty($_POST['tp_page_revslider_id']) && is_object($post)){ update_post_meta($post->ID,'tp_page_revslider_id',$_POST['tp_page_revslider_id']); }
				if(!empty($_POST['tp_page_revslider_nosep']) && is_object($post)){ update_post_meta($post->ID,'tp_page_revslider_nosep',$_POST['tp_page_revslider_nosep']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_page_revslider_nocurvy'); }
				
			}
			add_action('save_post', 'save_postdata_page_revslider');
	}	
	
	
		
	

/******************************************************************************************/
// pages - full width slider settings
	if ( is_admin() ) {
		$new_meta_boxes_page_fwslider  = array(
			"sc_gen" => array(
			"name" => "tp_page_title",
			"std" => "",
			"title" => "Full Width Slider"
			)
		);
		
		function new_meta_boxes_page_fwslider() {		
			global $post, $new_meta_boxes_page_fwslider;
			
			$tp_page_fwslider_pause = get_post_meta($post->ID, 'tp_page_fwslider_pause', true);		
			$tp_page_fwslider_speed = get_post_meta($post->ID, 'tp_page_fwslider_speed', true);		
			$tp_page_fwslider_images = get_post_meta($post->ID, 'tp_page_fwslider_images', true);		
			$tp_page_fwslider_nocurvy = get_post_meta($post->ID, 'tp_page_fwslider_nocurvy', true);		
			
			
			print '
			<p><strong>'.__('Select Images','ingrid').'</strong></p>
			<p class="description tp-fws-select">';
				if(!empty($tp_page_fwslider_images)){
					$arrfwi = explode(',',$tp_page_fwslider_images);
					print count($arrfwi) . ' image(s) selected';
				}
			print '</p>
			<p><a href="#" id="tp-fws-select'; if(!function_exists( 'wp_enqueue_media' )){print '-old';} print '">'.__('Click here to select images','ingrid').'</a>
				<input type="hidden" name="tp-fws-images" id="tp-fws-images" value="'.$tp_page_fwslider_images.'" />
			</p>';
			
			if(!empty($tp_page_fwslider_images)){
				print '<p><a href="#" id="tp-fws-remove">'.__('Click here to remove images','ingrid').'</a></p>';
			}
			
			print '			
			<div class="vspace"></div>
			<p><strong>'.__('Slider Options','ingrid').'</strong></p>
			<p><label>'.__('Pause between fades','ingrid').'</label>&nbsp;&nbsp;&nbsp;<input type="text" class="small-text" name="tp_page_fwslider_pause" value="'.$tp_page_fwslider_pause.'" /><span class="description">'.__('milisecs','ingrid').'</span></p>	
			<p><label>'.__('Fading animation speed','ingrid').'</label>&nbsp;&nbsp;&nbsp;<input type="text" class="small-text" name="tp_page_fwslider_speed" value="'.$tp_page_fwslider_speed.'" /><span class="description">'.__('milisecs','ingrid').'</span></p>	
			<div class="vspace"></div>
			<p><strong>'.__('Curvy bottom line','ingrid').'</strong></p>		
			<p>'.__('You can disable the curvy bottom line here if it doesn\'t fit with your current page background.','ingrid').'</p>
			<p><input id="tp_page_fwslider_nocurvy" name="tp_page_fwslider_nocurvy" type="checkbox" value="1"'; if($tp_page_fwslider_nocurvy == '1'){print ' checked="checked"';} print ' /> <label for="tp_page_fwslider_nocurvy">'.__('Disable curvy bottom line','ingrid').'</label></p>
			';
			
		}
		
		function create_meta_box_page_fwslider() {
			global $theme_name;
			if ( function_exists('add_meta_box') ) {
				add_meta_box( 'new-meta-boxes-page_fwslider', 'Full Width Slider', 'new_meta_boxes_page_fwslider', 'page', 'side', 'default' );		
			}
		}
		add_action('admin_menu', 'create_meta_box_page_fwslider');

		//save meta box values 
			function save_postdata_page_fwslider(){		
				global $post, $new_meta_boxes_page_fwslider;
				
				if(!empty($_POST['tp-fws-images']) && is_object($post)){ update_post_meta($post->ID,'tp_page_fwslider_images',$_POST['tp-fws-images']); }
				if(!empty($_POST['tp_page_fwslider_pause']) && is_object($post)){ update_post_meta($post->ID,'tp_page_fwslider_pause',$_POST['tp_page_fwslider_pause']); }
				if(!empty($_POST['tp_page_fwslider_speed']) && is_object($post)){ update_post_meta($post->ID,'tp_page_fwslider_speed',$_POST['tp_page_fwslider_speed']); }
				if(!empty($_POST['tp_page_fwslider_nocurvy']) && is_object($post)){ update_post_meta($post->ID,'tp_page_fwslider_nocurvy',$_POST['tp_page_fwslider_nocurvy']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_page_fwslider_nocurvy'); }
				
			}
			add_action('save_post', 'save_postdata_page_fwslider');
	}	
	
	
	

	
/******************************************************************************************/		
// posts - enable tags, social sharing, author
	if ( is_admin() ) {
		$new_meta_boxes_post_bottom  = array(
			"sc_gen" => array(
			"name" => "tp_page_title",
			"std" => "",
			"title" => "Post Settings"
			)
		);
		
		function new_meta_boxes_post_bottom() {		
			global $post, $new_meta_boxes_post_bottom;
			
			$tp_post_bottom_tags = get_post_meta($post->ID, 'tp_post_bottom_tags', true);		
			$tp_post_bottom_social_fb = get_post_meta($post->ID, 'tp_post_bottom_social_fb', true);		
			$tp_post_bottom_social_twitter = get_post_meta($post->ID, 'tp_post_bottom_social_twitter', true);		
			$tp_post_bottom_social_gplus = get_post_meta($post->ID, 'tp_post_bottom_social_gplus', true);		
			$tp_post_bottom_social_pin = get_post_meta($post->ID, 'tp_post_bottom_social_pin', true);		
			$tp_post_bottom_author = get_post_meta($post->ID, 'tp_post_bottom_author', true);		
			$tp_post_grid_size = get_post_meta($post->ID, 'tp_post_grid_size', true);		
			
			
			print '
			<p><strong>'.__('Tags','ingrid').'</strong></p>
			<p><input id="tp_post_bottom_tags" name="tp_post_bottom_tags" type="checkbox" value="1"'; if($tp_post_bottom_tags == '1'){print ' checked="checked"';} print ' /> <label for="tp_post_bottom_tags">'.__('Display tags below post','ingrid').'</label></p>
			<div class="vspace"></div>
			<p><strong>'.__('Social Sharing','ingrid').'</strong></p>
			<p><input id="tp_post_bottom_social_fb" name="tp_post_bottom_social_fb" type="checkbox" value="1"'; if($tp_post_bottom_social_fb == '1'){print ' checked="checked"';} print ' /> <label for="tp_post_bottom_social_fb">'.__('Show Facebook button','ingrid').'</label></p>
			<p><input id="tp_post_bottom_social_twitter" name="tp_post_bottom_social_twitter" type="checkbox" value="1"'; if($tp_post_bottom_social_twitter == '1'){print ' checked="checked"';} print ' /> <label for="tp_post_bottom_social_twitter">'.__('Show Twitter button','ingrid').'</label></p>
			<p><input id="tp_post_bottom_social_gplus" name="tp_post_bottom_social_gplus" type="checkbox" value="1"'; if($tp_post_bottom_social_gplus == '1'){print ' checked="checked"';} print ' /> <label for="tp_post_bottom_social_gplus">'.__('Show G+ button','ingrid').'</label></p>
			<p><input id="tp_post_bottom_social_pin" name="tp_post_bottom_social_pin" type="checkbox" value="1"'; if($tp_post_bottom_social_pin == '1'){print ' checked="checked"';} print ' /> <label for="tp_post_bottom_social_pin">'.__('Show Pinterest button','ingrid').'</label></p>		
			<div class="vspace"></div>
			<p><strong>'.__('Author','ingrid').'</strong></p>
			<p><input id="tp_post_bottom_author" name="tp_post_bottom_author" type="checkbox" value="1"'; if($tp_post_bottom_author == '1'){print ' checked="checked"';} print ' /> <label for="tp_post_bottom_author">'.__('Display author below post','ingrid').'</label></p>
			<div class="vspace"></div>
			<p><strong>'.__('Box Size in Modern Grid','ingrid').'</strong></p>
			<p>				
				<select name="tp_post_grid_size">
					<option value="">1x1</option>
					<option value="one-two"'; if($tp_post_grid_size == 'one-two'){ print ' selected="selected"'; }  print '>1x2</option>
					<option value="two-one"'; if($tp_post_grid_size == 'two-one'){ print ' selected="selected"'; }  print '>2x1</option>
					<option value="two-two"'; if($tp_post_grid_size == 'two-two'){ print ' selected="selected"'; }  print '>2x2</option>
				</select>
				<span class="description">'.__('Width * Height','ingrid').'</span>
			</p>
			';
			
		}
		
		function create_meta_box_post_bottom() {
			global $theme_name;
			if ( function_exists('add_meta_box') ) {
				add_meta_box( 'new-meta-boxes-post_bottom', 'Post Settings', 'new_meta_boxes_post_bottom', 'post', 'side', 'default' );		
			}
		}
		add_action('admin_menu', 'create_meta_box_post_bottom');

		//save meta box values 
			function save_postdata_post_bottom(){		
				global $post, $new_meta_boxes_post_bottom;
				
				if(empty($_GET['post_type'])){
					if(!empty($_POST['tp_post_bottom_tags'])){ update_post_meta($post->ID,'tp_post_bottom_tags',$_POST['tp_post_bottom_tags']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_bottom_tags'); }
					if(!empty($_POST['tp_post_bottom_social_fb'])){ update_post_meta($post->ID,'tp_post_bottom_social_fb',$_POST['tp_post_bottom_social_fb']);  }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_bottom_social_fb'); }
					if(!empty($_POST['tp_post_bottom_social_twitter'])){ update_post_meta($post->ID,'tp_post_bottom_social_twitter',$_POST['tp_post_bottom_social_twitter']);  }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_bottom_social_twitter'); }
					if(!empty($_POST['tp_post_bottom_social_gplus'])){ update_post_meta($post->ID,'tp_post_bottom_social_gplus',$_POST['tp_post_bottom_social_gplus']);  }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_bottom_social_gplus'); }
					if(!empty($_POST['tp_post_bottom_social_pin'])){ update_post_meta($post->ID,'tp_post_bottom_social_pin',$_POST['tp_post_bottom_social_pin']);  }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_bottom_social_pin'); }
					if(!empty($_POST['tp_post_bottom_author'])){ update_post_meta($post->ID,'tp_post_bottom_author',$_POST['tp_post_bottom_author']);  }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_bottom_author'); }
					if(!empty($_POST['tp_post_grid_size'])){ update_post_meta($post->ID,'tp_post_grid_size',$_POST['tp_post_grid_size']);  }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_grid_size'); }
				}	
				
			}
			add_action('save_post', 'save_postdata_post_bottom');
	}	
	



/******************************************************************************************/
// posts - review function
	if ( is_admin() ) {	
		$new_meta_boxes_post_review  = array(
			"sc_gen" => array(
			"name" => "tp_page_title",
			"std" => "",
			"title" => "Review Box"
			)
		);
		
		function new_meta_boxes_post_review() {		
			global $post, $new_meta_boxes_post_review;
			
			$tp_post_review_style = get_post_meta($post->ID, 'tp_post_review_style', true);		
			$tp_post_review_title = get_post_meta($post->ID, 'tp_post_review_title', true);		
			$tp_post_review_position = get_post_meta($post->ID, 'tp_post_review_position', true);			
			$tp_post_review_lines = get_post_meta($post->ID, 'tp_post_review_lines', true);		$tp_post_review_lines = maybe_unserialize($tp_post_review_lines);						
			$tp_post_review_lines_scores = get_post_meta($post->ID, 'tp_post_review_lines_scores', true);		$tp_post_review_lines_scores = maybe_unserialize($tp_post_review_lines_scores);						
			$tp_post_review_overall = get_post_meta($post->ID, 'tp_post_review_overall', true);		if(empty($tp_post_review_overall)){$tp_post_review_overall = 'Text';}
			$tp_post_review_overall_score = get_post_meta($post->ID, 'tp_post_review_overall_score', true);		if(empty($tp_post_review_overall_score)){$tp_post_review_overall_score = 'Score';}
			$tp_post_review_showoverall = get_post_meta($post->ID, 'tp_post_review_showoverall', true);	
			
			print '
			<p><strong>'.__('Review Style','ingrid').'</strong></p>
			<p><select name="tp_post_review_style" id="tp_post_review_style">
					<option value=""'; if($tp_post_review_style == ''){print ' selected="selected"';} print '>'.__('Review is disabled','ingrid').'</option>
					<option value="stars"'; if($tp_post_review_style == 'stars'){print ' selected="selected"';} print '>'.__('Stars 1 to 5','ingrid').'</option>
					<option value="score"'; if($tp_post_review_style == 'score'){print ' selected="selected"';} print '>'.__('Score 1 to 10','ingrid').'</option>
					<option value="percent"'; if($tp_post_review_style == 'percent'){print ' selected="selected"';} print '>'.__('Percent 1 to 100','ingrid').'</option>
				</select>
			</p>
			
			<div class="vspace"></div>
			<p><strong>'.__('Review Box Position','ingrid').'</strong></p>
			<p>
				<select name="tp_post_review_position" id="tp_post_review_position">
					<option value=""'; if($tp_post_review_position == ''){print ' selected="selected"';} print '>Left aligned in text</option>
					<option value="right"'; if($tp_post_review_position == 'right'){print ' selected="selected"';} print '>Right aligned in text</option>
					<option value="fw-before"'; if($tp_post_review_position == 'fw-before'){print ' selected="selected"';} print '>Full width size before text</option>
					<option value="fw-after"'; if($tp_post_review_position == 'fw-after'){print ' selected="selected"';} print '>Full width size after text</option>
				</select>
			</p>				
			
			<div class="vspace"></div>
			<p><strong>'.__('Review Title','ingrid').'</strong></p>
			<p><input type="text" class="widefat" name="tp_post_review_title" value="'.$tp_post_review_title.'" /></p>			
			
			
			<div class="vspace"></div>
			<p><strong>'.__('Add/Remove Review Lines','ingrid').'</strong></p>
			';
				//load lines if set
				if(!empty($tp_post_review_lines)){
					$fctr = '0'; $copy = '';
					foreach($tp_post_review_lines as $line){
						print '<p class="review_line'.$copy.'"><input type="text" class="" name="tp_post_review_lines[]" value="'.$line.'" /><input type="text" class="small-text" name="tp_post_review_lines_scores[]" value="'.$tp_post_review_lines_scores[$fctr].'" /></p>';
						$fctr++;
						$copy = ' copy';
					}
				}else{
					print '
					<p class="review_line">
						<input type="text" class="" name="tp_post_review_lines[]" value="Text" /><input type="text" class="small-text" name="tp_post_review_lines_scores[]" value="Score" />
					</p>
					';
				}
			print '
			<p><input class="button" type="button" value="+" id="tp_post_review_add" />	<input class="button" type="button" value="-" id="tp_post_review_del" /></p>			

			<div class="vspace"></div>
			<p><strong>'.__('Overall Score','ingrid').'</strong></p>
			<p>
				<input type="text" class="" name="tp_post_review_overall" value="'.$tp_post_review_overall.'" />
				<input type="text" class="small-text" name="tp_post_review_overall_score" value="'.$tp_post_review_overall_score.'" />
			</p>			
			<p><input type="checkbox" value="1" name="tp_post_review_showoverall" id="tp_post_review_showoverall"'; if($tp_post_review_showoverall == '1'){print ' checked="checked"';} print ' /> <label for="tp_post_review_showoverall">'.__('Display overall score on blog page').'</label></p>
			';
			
		}
		
		function create_meta_box_post_review() {
			global $theme_name;
			if ( function_exists('add_meta_box') ) {
				add_meta_box( 'new-meta-boxes-post_review', 'Review Box', 'new_meta_boxes_post_review', 'post', 'side', 'default' );		
			}
		}
		add_action('admin_menu', 'create_meta_box_post_review');

		//save meta box values 
			function save_postdata_post_review(){		
				global $post, $new_meta_boxes_post_review;
				
			
				if(!empty($_POST['tp_post_review_style'])){ update_post_meta($post->ID,'tp_post_review_style',$_POST['tp_post_review_style']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_review_style'); }
				if(!empty($_POST['tp_post_review_position'])){ update_post_meta($post->ID,'tp_post_review_position',$_POST['tp_post_review_position']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_review_position'); }
				if(!empty($_POST['tp_post_review_title'])){ update_post_meta($post->ID,'tp_post_review_title',$_POST['tp_post_review_title']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_review_title'); }
				if(!empty($_POST['tp_post_review_lines']) && !empty($_POST['tp_post_review_lines_scores'])){
					update_post_meta($post->ID,'tp_post_review_lines',maybe_serialize($_POST['tp_post_review_lines']));
					update_post_meta($post->ID,'tp_post_review_lines_scores',maybe_serialize($_POST['tp_post_review_lines_scores']));
				}elseif(is_object($post)){
					delete_post_meta($post->ID,'tp_post_review_lines');
					delete_post_meta($post->ID,'tp_post_review_lines_scores');
				}
				if(!empty($_POST['tp_post_review_overall']) && $_POST['tp_post_review_overall'] != 'Text'){ update_post_meta($post->ID,'tp_post_review_overall',$_POST['tp_post_review_overall']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_review_overall'); }
				if(!empty($_POST['tp_post_review_overall_score']) && $_POST['tp_post_review_overall'] != 'Score'){ update_post_meta($post->ID,'tp_post_review_overall_score',$_POST['tp_post_review_overall_score']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_review_overall_score'); }
				if(!empty($_POST['tp_post_review_showoverall'])){ update_post_meta($post->ID,'tp_post_review_showoverall',$_POST['tp_post_review_showoverall']); }elseif(is_object($post)){ delete_post_meta($post->ID,'tp_post_review_showoverall'); }
				
				
			}
			add_action('save_post', 'save_postdata_post_review');
		
		
	}	
	
/******************************************************************************************/
// page with full width title - title settings
	if ( is_admin() ) {	
		$new_meta_boxes_ptitle  = array(
			"sc_gen" => array(
			"name" => "tp_page_title",
			"std" => "",
			"title" => "Full Width Page Title"
			)
		);
		
		function new_meta_boxes_ptitle() {		
			global $post, $new_meta_boxes_ptitle;
			
			$tp_page_title = get_post_meta($post->ID, 'tp_page_title', true);		
			$tp_page_stitle = get_post_meta($post->ID, 'tp_page_stitle', true);		
			
			echo '
			<p><strong>'.__('Page Title','ingrid').'</strong></p>
			<p><input id="tp_page_title" name="tp_page_title" type="text" class="widefat" value="'.$tp_page_title.'" /></p>
			
			<p><strong>'.__('Page SubTitle','ingrid').'</strong></p>
			<p><input id="tp_page_stitle" name="tp_page_stitle" type="text" class="widefat" value="'.$tp_page_stitle.'" /></p>
			';
			
		}
		
		function create_meta_box_ptitle() {
			global $theme_name;
			if ( function_exists('add_meta_box') ) {
				add_meta_box( 'new-meta-boxes-ptitle', 'Full Width Page Title', 'new_meta_boxes_ptitle', 'page', 'side', 'high' );		
			}
		}
		add_action('admin_menu', 'create_meta_box_ptitle');

		//save meta box values 
			function save_postdata_ptitle(){		
				global $post, $new_meta_boxes_ptitle;
				
				//save custom page title
				if(!empty($_POST['tp_page_title']) || !empty($_POST['tp_page_stitle'])){
					update_post_meta($post->ID,'tp_page_title',$_POST['tp_page_title']);
					update_post_meta($post->ID,'tp_page_stitle',$_POST['tp_page_stitle']);
				}
			}
			add_action('save_post', 'save_postdata_ptitle');
	}	
	
	
/******************************************************************************************/	
// blog template - category selector
	if ( is_admin() ) {		
		$new_meta_boxes_blogcats  = array(
			"sc_gen" => array(
			"name" => "ub_blog_cats",
			"std" => "",
			"title" => "Post Categories"
			)
		);

		function new_meta_boxes_blogcats() {
			global $post, $new_meta_boxes_pfcats;
			
			$ub_blog_cats = get_post_meta($post->ID, 'ub_blog_cats', true);		
			$tax_terms = get_terms('category');
			
			echo'<p>If you will use this page to display posts, select which categories you\'d like to display:</p>
				<p>
				<select name="ub_blog_cats[]" id="ub_blog_cats" multiple="multiple" style="height: 120px; width: 100%; float: left;">';
				if($ub_blog_cats == '' || empty($ub_blog_cats) || $ub_blog_cats[0] == ''){
					echo '<option value="" selected="selected">All categories</option>';
					
					if($tax_terms != ''){
						foreach ($tax_terms as $tax_term) {
							echo '
							<option value="'. $tax_term->slug .'">' . $tax_term->name . '</option>
							';
						}	
					}			
					
				}else{
					echo '<option value="">All categories</option>';
					
					
					if($tax_terms != ''){				
						foreach ($tax_terms as $tax_term) {
							$selected = '';
							foreach($ub_blog_cats as $pf_cat){
								if($pf_cat == $tax_term->slug){
									$selected = ' selected="selected"';
								}
							}
							
							echo '
							<option value="'. $tax_term->slug .'"'.$selected.'>' . $tax_term->name . '</option>
							';
						}	
					}
				}
					
				
			echo '		
				</select>
				</p>
			';	
		}

		function create_meta_box_blogcats() {
			global $theme_name;
			if ( function_exists('add_meta_box') ) {
				add_meta_box( 'new-meta-boxes-blogcats', 'Post Categories', 'new_meta_boxes_blogcats', 'page', 'side', 'default' );		
			}
		}
		add_action('admin_menu', 'create_meta_box_blogcats');
		
		//save meta box values 
			function save_postdata_blogcats(){		
				global $post, $ub_blog_cats;
							
				//save blog cats
				if(!empty($_POST['ub_blog_cats'])){
					update_post_meta($post->ID,'ub_blog_cats',$_POST['ub_blog_cats']);
				}
			}
			add_action('save_post', 'save_postdata_blogcats');
		
	}	
	
	
/******************************************************************************************/	
// 	post format excerpt contents

		
	if ( is_admin() ) {				
		//if(version_compare($wp_version,'3.6-beta1','<')){  // if WP 3.6+, we don't need this
			
		
			$new_meta_boxes_postf  = array(
				"sc_gen" => array(
				"name" => "tp_postf",
				"std" => "",
				"title" => "Post Format Content"
				)
			);

			function new_meta_boxes_postf() {
				global $post, $new_meta_boxes_postf;
				
				$tp_postf_link = get_post_meta($post->ID, 'tp_postf_link', true);		
				$tp_postf_audio = get_post_meta($post->ID, 'tp_postf_audio', true);		
				$tp_postf_video = get_post_meta($post->ID, 'tp_postf_video', true);		
				
				
				echo'
				<div id="postf-link" class="postf-contents">
					<p><strong>Link URL:</strong></p>
					<p><input type="text" class="widefat" name="tp_postf_link" value="'.$tp_postf_link.'" /></p>			
				</div>
				<div id="postf-audio" class="postf-contents">
					<p><strong>Audio</strong> - Link to MP3 File or Audio Player Embed Code (e.g.: SoundCloud):</p>
					<p><textarea class="widefat" name="tp_postf_audio" rows="2">'.$tp_postf_audio.'</textarea></p>			
				</div>
				<div id="postf-video" class="postf-contents">
					<p><strong>Video Embed Code:</strong></p>
					<p><textarea class="widefat" name="tp_postf_video" rows="2">'.$tp_postf_video.'</textarea></p>			
				</div>
				';	
			}

			function create_meta_boxes_postf() {
				global $theme_name;
				if ( function_exists('add_meta_box') ) {
					add_meta_box( 'new-meta-boxes-postf', 'Post Format Content', 'new_meta_boxes_postf', 'post', 'normal', 'high' );		
				}
			}
			add_action('admin_menu', 'create_meta_boxes_postf');
			
			//save meta box values 
				function save_postdata_postf(){		
					global $post;
								
					//save blog cats
					if(!empty($_POST['tp_postf_link'])){
						update_post_meta($post->ID,'tp_postf_link',$_POST['tp_postf_link']);
					}
					if(!empty($_POST['tp_postf_audio'])){
						update_post_meta($post->ID,'tp_postf_audio',$_POST['tp_postf_audio']);
					}
					if(!empty($_POST['tp_postf_video'])){
						update_post_meta($post->ID,'tp_postf_video',$_POST['tp_postf_video']);
					}
				}
				add_action('save_post', 'save_postdata_postf');	
		//}
	}	
	
	
/******************************************************************************************/
// comment functions
	function validate_gravatar($email) {
		// Craft a potential url and test its headers
		$hash = md5(strtolower(trim($email)));
		$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
		$headers = @get_headers($uri);
		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = FALSE;
		} else {
			$has_valid_avatar = TRUE;
		}
		return $has_valid_avatar;
	}

	
	function url_filtered($fields)	{		
		if(isset($fields['url']))
		unset($fields['url']);
		return $fields;
	}
	add_filter('comment_form_default_fields', 'url_filtered');
	
	function tp_comments( $comment, $args, $depth ){		
		print '
		<li>';
		
		if(!validate_gravatar(get_comment_author_email())){
			//replace to theme avatar
			print '<img class="avatar avatar-60 photo" width="60" height="60" src="'.get_template_directory_uri().'/images/avatar.jpg" alt="">';
			
		}else{
			//default
			print get_avatar($comment,'60');
		}
		
		print '
			<p class="comment-author">'.get_comment_author().'<br /></p>		
			<p class="comment-info">';
				printf( __( '%1$s., %2$s','ingrid'), get_comment_date(),  get_comment_time() ); 
				edit_comment_link( __( '(Edit)' ,'urbanoid_fw'), ' ' );					
				print ' / ';
				
				comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('Reply','ingrid') ) ) );
			print '</p>		
			<p class="comment">'.get_comment_text().'</p>';
					
	}
	
	
	
/******************************************************************************************/	
// captcha random char generator
	function generateCode($characters='4') {
		  // list all possible characters, similar looking characters and vowels have been removed 
		  $possible = '987654321ZYXWVTSRQPNMLKJHGFDCB';
		  $code = '';
		  $i = 0;
		  while ($i < $characters) { 
			 $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			 $i++;
		  }
		  return $code;
	}

	
/******************************************************************************************/
// gets the current post type in the WordPress Admin
	function get_current_post_type() {
		global $post, $typenow, $current_screen;
		//we have a post so we can just get the post type from that
		if ( $post && $post->post_type )
		return $post->post_type;
		//check the global $typenow - set in admin.php
		elseif( $typenow )
		return $typenow;
		//check the global $current_screen object - set in sceen.php
		elseif( $current_screen && $current_screen->post_type )
		return $current_screen->post_type;
		//lastly check the post_type querystring
		elseif( isset( $_REQUEST['post_type'] ) )
		return sanitize_key( $_REQUEST['post_type'] );
		//we do not know the post type!
		return null;
	}	
	
	

/******************************************************************************************/	
// get current url	
	function curPageURL() {
		 $pageURL = 'http';
		 if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
	}
	
	
	
/******************************************************************************************/	
// add menu subtitle option
	class description_walker extends Walker_Nav_Menu
	{
		  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
		  {
			   global $wp_query;
			   $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			   $class_names = $value = '';

			   $classes = empty( $item->classes ) ? array() : (array) $item->classes;

			   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			   $class_names = ' class="'. esc_attr( $class_names ) . '"';

			   $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

			   $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			   $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			   $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			   $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

			   $prepend = '<strong>';
			   $append = '</strong>';
			   $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

			   if($depth != 0)
			   {
						 $description = $append = $prepend = "";
			   }

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
				$item_output .= $description.$args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
				}
	}

	
	
	
/******************************************************************************************/
// theme option pages
	if ( is_admin() ) {		
		// add pages to admin
		function ub_add_pages() {
			global $framework_url;		
						
			add_menu_page('Theme Options', 'Theme Options', 'manage_options', 'tp_theme_general', 'tp_theme_general', $framework_url.'icon.png' );	
				add_submenu_page('tp_theme_general', 'General', 'General', 'manage_options', 'tp_theme_general', 'tp_theme_general');
				add_submenu_page('tp_theme_general', 'Layout Stylings', 'Layout Stylings', 'manage_options', 'tp_theme_layout', 'tp_theme_layout');
				add_submenu_page('tp_theme_general', 'Typography', 'Typography', 'manage_options', 'tp_theme_typography', 'tp_theme_typography');		
				add_submenu_page('tp_theme_general', 'Sidebar and Footer', 'Sidebar and Footer', 'manage_options', 'tp_theme_sidebar_footer', 'tp_theme_sidebar_footer');
				add_submenu_page('tp_theme_general', 'Sample Content', 'Sample Content', 'manage_options', 'tp_theme_sample_content', 'tp_theme_sample_content');
		}
		add_action('admin_menu', 'ub_add_pages');

		require_once(TEMPLATEPATH . "/framework/includes/theme_options-general.inc.php");
		require_once(TEMPLATEPATH . "/framework/includes/theme_options-layout.inc.php");
		require_once(TEMPLATEPATH . "/framework/includes/theme_options-typography.inc.php");
		require_once(TEMPLATEPATH . "/framework/includes/theme_options-sidebar_footer.inc.php");
		require_once(TEMPLATEPATH . "/framework/includes/theme_options-sample_content.inc.php");
	}
	
	

/******************************************************************************************/	
// retina images	

	

		function tp_retina_support_create_images( $file, $width, $height, $crop = false ) {
			if ( $width || $height ) {
				$resized_file = wp_get_image_editor( $file );
				if ( ! is_wp_error( $resized_file ) ) {
					$filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
		 
					$resized_file->resize( $width * 2, $height * 2, $crop );
					$resized_file->save( $filename );
		 
					$info = $resized_file->get_size();
		 
					return array(
						'file' => wp_basename( $filename ),
						'width' => $info['width'],
						'height' => $info['height'],
					);
				}
			}
			return false;
		}

		function tp_delete_retina_support_images( $attachment_id ) {
			$meta = wp_get_attachment_metadata( $attachment_id );
			$upload_dir = wp_upload_dir();			
			if(isset( $meta['file'] )){
				$path = pathinfo( $meta['file'] );
			}
			if(is_array($meta) && isset($path)){
			foreach ( $meta as $key => $value ) {
				if ( 'sizes' === $key ) {
					foreach ( $value as $sizes => $size ) {
						$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
						$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
						if ( file_exists( $retina_filename ) )
							unlink( $retina_filename );
					}
				}
			}
			}
		}
		

		function tp_retina_support_attachment_meta( $metadata, $attachment_id ) {
			foreach ( $metadata as $key => $value ) {
				if ( is_array( $value ) ) {
					foreach ( $value as $image => $attr ) {
						if ( is_array( $attr ) )
							tp_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
					}
				}
			}
		 
			return $metadata;
		}	
		
		
	if(get_option('tp_retina') != 'off'){	
		add_filter( 'delete_attachment', 'tp_delete_retina_support_images' );
		add_filter( 'wp_generate_attachment_metadata', 'tp_retina_support_attachment_meta', 10, 2 );
	}
			
	
	

/******************************************************************************************/
// request to install plugins / add plugin install page
	if ( is_admin() ) {
		require_once('includes/plugin-activation.php');

		add_action('tgmpa_register', 'tp_reg_plugins');
		function tp_reg_plugins() {
			global $theme_text_domain;
			
			$plugins = array(
				array(
					'name'     				=> 'Slider Revolution', // The plugin name
					'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
					'source'   				=> get_template_directory_uri() . '/framework/plugins/revslider.zip', // The plugin source
					'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '5.2.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				),
				array(
					'name'     				=> 'Contact Form 7', // The plugin name
					'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
					'source'   				=> get_template_directory_uri() . '/framework/plugins/contact-form-7.zip', // The plugin source
					'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '4.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				),
				array(
					'name'     				=> 'Pagination', // The plugin name
					'slug'     				=> 'wp-paginate', // The plugin slug (typically the folder name)
					'source'   				=> get_template_directory_uri() . '/framework/plugins/wp-paginate.zip', // The plugin source
					'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				)
			);
			
			$config = array(
				'domain'       		=> 'ingrid',         	// Text domain - likely want to be the same as your theme.
				'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
				'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
				'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
				'menu'         		=> 'install-required-plugins', 	// Menu slug
				'has_notices'      	=> true,                       	// Show admin notices or not
				'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
				'message' 			=> '',							// Message to output right before the plugins table
				'strings'      		=> array(
					'page_title'                       			=> __( 'Install Required Plugins', 'ingrid' ),
					'menu_title'                       			=> __( 'Install Plugins', 'ingrid' ),
					'installing'                       			=> __( 'Installing Plugin: %s', 'ingrid' ), // %1$s = plugin name
					'oops'                             			=> __( 'Something went wrong with the plugin API.', 'ingrid' ),
					'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
					'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
					'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
					'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
					'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
					'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
					'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
					'return'                           			=> __( 'Return to Required Plugins Installer', 'ingrid' ),
					'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'ingrid' ),
					'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'ingrid' ), // %1$s = dashboard link
					'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
				)
			);
		
			tgmpa($plugins, $config);
		
		}
	}
	
	
	
?>
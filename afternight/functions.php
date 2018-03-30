<?php
    define('_LIMIT_' , 10 );
    define('BLOCK_TITLE_LEN' , 50 );
    
    define('DEFAULT_AVATAR'   , get_template_directory_uri()."/images/default_avatar.jpg" );
	define('DEFAULT_AVATAR_100'   , get_template_directory_uri()."/images/default_avatar_100.jpg" );
	define('DEFAULT_AVATAR_LOGIN'   , get_template_directory_uri()."/images/default_avatar_login.png" );
    define( '_TN_'      , wp_get_theme() );
    define('BRAND'      , '' );
	define('ZIP_NAME'   , 'afternight' );
	
	$content_width = 600;
	
    add_action('admin_bar_menu', 'de_cosmotheme');
     
	include 'lib/php/main.php';
	include 'lib/php/localize-js.php';
    
    
    include 'lib/php/actions.register.php';
    include 'lib/php/menu.register.php';

    if( function_exists( 'add_theme_support' ) ){ 
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
    }

    image::add_size();

  	add_theme_support( 'custom-background' ); /*requires WP v >= 3.4  */

  	add_theme_support( 'structured-post-formats', array(
	    'link', 'video', 'image'
	) );

	add_theme_support( 'post-formats' , array( 'image' , 'video' , 'audio','gallery', 'quote'  ) );
	add_editor_style('editor-style.css');
	
	

    /* Localization */
    load_theme_textdomain( 'cosmotheme' );
    load_theme_textdomain( 'cosmotheme' , get_template_directory() . '/languages' );
    
    if ( function_exists( 'load_child_theme_textdomain' ) ){
        load_child_theme_textdomain( 'cosmotheme' );
    }

	function remove_post_format_fields() {
		remove_meta_box( 'formatdiv' , 'post' , 'side' ); 
		remove_meta_box( 'formatdiv' , 'portfolio' , 'side' ); 
	}
	add_action( 'admin_menu' , 'remove_post_format_fields' );
    
	if(is_admin() && ini_get('allow_url_fopen') == '1'){
		/*New version check*/	
		if( options::logic( 'cosmothemes' , 'show_new_version' ) ){
			function versionNotify(){
				echo api_call::compareVersions(); 
			}
		
			// Add hook for admin <head></head>
			add_action('admin_head', 'versionNotify');
		}

	}

    /* Cosmothemes Backend link */
    function de_cosmotheme() {
        global $wp_admin_bar;    
        if ( !is_super_admin() || !is_admin_bar_showing() ){
            return;
        }
        $wp_admin_bar -> add_menu( array(
            'id' => 'cosmothemes',
            'parent' => '',
            'title' => _TN_,
            'href' => admin_url( 'admin.php?page=cosmothemes__general' )
            ) );   
    }

	add_filter('excerpt_length', 'cosmo_excerpt_length');
	function cosmo_excerpt_length($length) {
		return 70;  /* Or whatever you want the length to be. */
	}

    /*allow subscribers to upload files*/
	if ( current_user_can('subscriber') && !current_user_can('upload_files') )
	add_action('admin_init', 'allow_subscriber_uploads');

	function allow_subscriber_uploads() {
		$subscriber = get_role('subscriber');
		$subscriber->add_cap('upload_files');
	}

	if( !options::logic( 'general' , 'show_admin_bar' ) ){
		add_filter( 'show_admin_bar', '__return_false' );
	}

	/*Default pages creation*/
//delete_option('first-install-settings');
	if(!get_option( 'first-install-settings' ) ){
		
		$default_custom_pages = array('Post item','My added posts','My account','My Liked Posts'); /*create this pages only ones, this pages will be by defaut assigned in the theme settings. The user can change them. */
		
		foreach($default_custom_pages as $page){
			$default_page = get_page_by_title( $page ); 
		    
		    if( !($default_page && isset($default_page->ID)) ){
		    	$pages = array(
					'post_title' => $page,
					'post_content' => '',
					'post_status' => 'publish',
					'post_type' => 'page'
				);

				$def_page = wp_insert_post($pages);	

				if( is_numeric($def_page) && $def_page > 0){
					//assign page template (for example for 'My bookmarks' page -> 'my_bookmarks.php' template will be assigned)
					update_post_meta($def_page, '_wp_page_template', str_replace(' ','_', strtolower($page)).'.php'); 
				}    
		    }
						
		}

        include get_template_directory() . '/lib/templates/init_templates.php';

		add_option( 'first-install-settings', 'pages created' );
	}

	add_editor_style('editor-style.css');
	
	//get_template_part( '/videojs/video-js' ); 
	get_template_part( '/video-audio-player/mediaelement-js-wp' );


	/*exclude some pages from search result*/
	function filter_where($where = '') {
		if ( is_search() ) {
		
			$def_pages = array(options::get_value( 'general' , 'my_liked_posts' ),
								options::get_value( 'general' , 'user_profile_page' ) ,
								options::get_value( 'general' , 'my_posts_page' ),
								options::get_value( 'upload' , 'post_item_page' )
								);
			$ids = array();
			foreach($def_pages as $pag){
				
                if( is_numeric($pag) ){
                    $ids[] = $pag;
                }
			}
			$exclude = $ids;

			for($x=0;$x<count($exclude);$x++){
			  $where .= " AND ID != ".$exclude[$x];
			}
		}
		return $where;
	}
	add_filter('posts_where', 'filter_where');


	function load_css() {
		

		wp_register_style( 'default_stylesheet',get_stylesheet_directory_uri() . '/style.css' );
		wp_enqueue_style( 'default_stylesheet' );

		$files = scandir( get_template_directory()."/css/autoinclude" );
		foreach( $files as $file ){
			if( is_file( get_template_directory()."/css/autoinclude/$file" ) ){
				wp_register_style( $file.'-style',get_template_directory_uri() . '/css/autoinclude/'.$file );
				wp_enqueue_style( $file.'-style' );
			}
		}

		if(options::logic( 'blog_post' , 'enb_lightbox' )){
			wp_register_style( 'prettyPhoto',get_template_directory_uri() . '/css/prettyPhoto.css' );
			wp_enqueue_style( 'prettyPhoto' );
		}

		load_google_fonts();

		//wp_enqueue_script( 'foundation' , get_template_directory_uri() . '/js/foundation.js' , array( 'jquery' ),false,true );
		wp_enqueue_script( 'superfish' , get_template_directory_uri() . '/js/jquery.superfish.js' , array( 'jquery' ),false,true );
		wp_enqueue_script( 'supersubs' , get_template_directory_uri() . '/js/jquery.supersubs.js' , array( 'jquery' ),false,true );
		wp_enqueue_script( 'tour' , get_template_directory_uri() . '/js/tour.js' , array( 'jquery' ),false,true );
		wp_enqueue_script( 'tabs' , get_template_directory_uri() . '/js/jquery.tabs.pack.js' , array( 'jquery' ),false,true );
		wp_enqueue_script( 'scrollto' , get_template_directory_uri() . '/js/jquery.scrollTo-1.4.2-min.js' , array( 'jquery' ),false,true );
		wp_enqueue_script( 'elastislide' , get_template_directory_uri() . '/js/jquery.elastislide.js' , array( 'jquery' ),false,true );
		wp_enqueue_script( 'newmasonry' , get_template_directory_uri() . '/js/jquery.isotope.min.js' , array( 'jquery' ) );
	
		wp_enqueue_script( 'slabtext' , get_template_directory_uri() . '/js/jquery.slabtext.min.js' , array( 'jquery' ),false,true ); /*for auto resizing text on view port change*/

		wp_enqueue_script( 'functions' , get_template_directory_uri() . '/js/functions.js' , array( 'jquery' , 'tabs' , 'scrollto','elastislide' ),false,true );
		wp_enqueue_script( 'jquery-cookie' , get_template_directory_uri() . '/js/jquery.cookie.js' , array( 'jquery' ),false,true );

		if(options::logic( 'blog_post' , 'enb_lightbox' )){
			$enb_lightbox = true;
			wp_enqueue_script( 'prettyPhoto' , get_template_directory_uri() . '/js/jquery.prettyPhoto.js' , array( 'jquery' ),false,true );
		} else { $enb_lightbox = false; }
        wp_localize_script( 'functions', 'prettyPhoto_enb', array(
            'enb_lightbox'          => $enb_lightbox
            )
        );	
		
		if(!is_user_logged_in()){
			//wp_enqueue_script( 'login' , get_template_directory_uri() . '/js/login.js' , array( 'jquery' ) );
			wp_localize_script( 'functions', 'login_localize', localize_vars_login());
		}

		$logo_font_family = explode('&',options::get_value('styling' , 'logo_font_family'));
        $logo_font_family = $logo_font_family[0];
        $logo_font_family = str_replace( '+',' ',$logo_font_family );

		wp_localize_script( 'functions', 'logo_font', $logo_font_family);

		
		/*call this only on front page*/
		wp_enqueue_script( 'easing' , get_template_directory_uri() . '/js/jquery.easing.js' , array( 'jquery' ),false,true );
		wp_enqueue_script( 'jscroll' , get_template_directory_uri() . '/js/jquery.jscroll.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'waitforimages' , get_template_directory_uri() . '/js/jquery.waitforimages.js' , array( 'jquery' ),false,true );

		if ( is_singular() ){ 
			wp_enqueue_script( "comment-reply" );
		} 
        
        // embed the javascript file that makes the AJAX request
		wp_register_script( 'actions', get_template_directory_uri().'/lib/js/actions.js' , array('jquery') );

        wp_enqueue_script( 'actions' );

        if(is_page() ) {
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox'); 
            
            wp_enqueue_style( 'ui-lightness');
            wp_enqueue_style('thickbox');
        }

        global $wp_query;
		wp_localize_script( 'actions', 'MyAjax', array(
		    // URL to wp-admin/admin-ajax.php to process the request
		    'ajaxurl'          => admin_url( 'admin-ajax.php' ),
            'wpargs' => array( 'wpargs' => $wp_query -> query ),
		 
		    // generate a nonce with a unique ID "myajax-post-comment-nonce"
		    // so that you can check it later when an AJAX request is sent
		    'getMoreNonce' => wp_create_nonce( 'myajax-getMore-nonce' ),
		    )
		);



		
		wp_localize_script( 'login', 'MyAjax', array(
		    // URL to wp-admin/admin-ajax.php to process the request
		    'ajaxurl'          => admin_url( 'admin-ajax.php' )
		    )
		);
	}

	add_action('wp_enqueue_scripts', 'load_css');
	if (!is_admin()) {
		add_action('wp_head', 'get_custom_css');
	}

	/*autoset_featured function to set automatically first attached image as featured image on image format post*/
	add_action('draft_to_publish', 'autoset_featured');
	add_action('new_to_publish', 'autoset_featured');
	add_action('pending_to_publish', 'autoset_featured');
	add_action('future_to_publish', 'autoset_featured');

	/*filter to modify the output of wp_get_attachment_link*/
	add_filter( 'wp_get_attachment_link', 'modify_attachment_link', 10, 4 );

	/*enable shortcodes in excerpts*/
	add_filter( 'the_excerpt', 'shortcode_unautop');
	add_filter( 'the_excerpt', 'do_shortcode');

	/*make shortcodes work in text widgets*/
	add_filter( 'widget_text', 'shortcode_unautop');
	add_filter( 'widget_text', 'do_shortcode');

	
	/*Make Archives.php Include Custom Post Types, this function is used in archived.php*/
	function namespace_add_custom_types( $query ) {
		/*make sure we run this only in front end for post format archives.*/
	  	if( is_tax( 'post_format' ) && empty( $query->query_vars['suppress_filters'] ) && !is_admin()  ) {
		    $query->set( 'post_type', array(
		     	'post', 'portfolio'
			));
		  return $query;
		}
	}
	add_post_type_support( 'portfolio', 'post-formats' );

	add_action('draft_to_publish_portfolio', 'autoset_featured');
	add_action('new_to_publish_portfolio', 'autoset_featured');
	add_action('pending_to_publish_portfolio', 'autoset_featured');
	add_action('future_to_publish_portfolio', 'autoset_featured');

	init_default_skins(); /* this function is available in lib/php/main.php .  It creates the default post skins settings */ 

	/* action for color picker*/
	add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
	function mw_enqueue_color_picker( $hook_suffix ) {
	    // first check that $hook_suffix is appropriate for your admin page
	    wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script( 'wp-color-picker' );
	}


	/**
	 * As WP 4.0 added wp_texturize, we'll need the next function to disable texturizing the shortcodes.
	 */
	
	function disable_texturize_for_shortcodes( $shortcodes ) {
		global $shortcode_tags;

		foreach ($shortcode_tags as $key => $value) {
			$shortcodes[] = $key;
		}
	    

	    return $shortcodes;
	}
	add_filter( 'no_texturize_shortcodes', 'disable_texturize_for_shortcodes' );

?>
<?php
    /* aditional options and meta-data init menu, register functions and options labels */
    add_action('admin_menu', array( 'options' , 'menu' ) );
    
    add_action('admin_init', array( 'options' , 'register' ) );
    /* register resource */
    add_action('init', array( 'resources' , 'register' ) , 1 );
    
    add_action('admin_init', array( 'includes' , 'load_css' ) , 1 );
    add_action('admin_init', array( 'includes' , 'load_js' ) , 1 );

    /* on delete action */
    add_action( 'delete_post', 'clear_meta' );
	
	/* ajax actions */
	/* meta actions */
	add_action('wp_ajax_meta_save', array( 'meta' , 'save' ) );
    add_action('wp_ajax_meta_delete' , array( 'meta' , 'delete') );
    add_action('wp_ajax_meta_sort' , array( 'meta' , 'sort') );
    add_action('wp_ajax_meta_update' , array( 'meta' , 'update') );

    /* facebook connect */
    if( !( options::get_value( 'social' , 'facebook_secret' ) == '' || options::get_value( 'social' , 'facebook_app_id' ) == '' ) ){
        if( is_user_logged_in () ){
            add_action('wp_ajax_fb_user' , array( 'facebook' , 'user') );
            add_action('wp_ajax_fb_login', array( 'facebook' , 'login' ) );
        }else{
            add_action('wp_ajax_nopriv_fb_user' , array( 'facebook' , 'user') );
            add_action('wp_ajax_nopriv_fb_login', array( 'facebook' , 'login' ) );
        }
    }
    
    /*login page*/
    add_action( 'wp_ajax_nopriv_cosmo_login' , array( 'login' , 'login_me' ) );
    add_action( 'wp_ajax_nopriv_cosmo_register' , array( 'login' , 'register' ) );
    add_action( 'wp_ajax_cosmo_login' , array( 'login' , 'login_me' ) );
    add_action( 'wp_ajax_cosmo_register' , array( 'login' , 'register' ) );

    add_action('wp_ajax_load_more' , array( 'post' , 'load_more' ) );
    add_action('wp_ajax_nopriv_load_more' , array( 'post' , 'load_more' ) );

    /*action for bulk update layout settings for posts*/
    add_action('wp_ajax_update_post_layout_meta', array( 'meta' , 'update_post_layout_meta' ) );

    
    add_action('wp_ajax_search' , array( 'post' , 'search' ) );
    add_action('wp_ajax_min_likes' , array( 'like' , 'min_likes' ) );
    add_action('wp_ajax_sim_likes' , array( 'like' , 'sim_likes' ) );
	add_action('wp_ajax_reset_likes' , array( 'like' , 'reset_likes' ) );

    /* save and delete template actions */
    add_action('wp_ajax_save_templates' , array( 'options' , 'save_templates' ) );
    add_action('wp_ajax_delete_template' , array( 'options' , 'delete_template' ) );    
    
    /* options actions */
    add_action( 'wp_ajax_text_preview' , array( 'text' , 'preview' ) );

    /* add like action */
    add_action( 'wp_ajax_like' , array( 'like' , 'set' ) );
    add_action( 'wp_ajax_nopriv_like' , array( 'like' , 'set' ) );
    
    /* add add_image_post action */
    add_action( 'wp_ajax_add_image_post' , array( 'post' , 'add_image_post' ) );
    add_action( 'wp_ajax_nopriv_add_image_post' , array( 'post' , 'add_image_post' ) );

    
    /* add add_video_post action */
    add_action( 'wp_ajax_add_video_post' , array( 'post' , 'add_video_post' ) );
    add_action( 'wp_ajax_nopriv_add_video_post' , array( 'post' , 'add_video_post' ) );

    
    /* add add_text_post action */
    add_action( 'wp_ajax_add_text_post' , array( 'post' , 'add_text_post' ) );
    add_action( 'wp_ajax_nopriv_add_text_post' , array( 'post' , 'add_text_post' ) );
    
	/* add add_file_post action */
    add_action( 'wp_ajax_add_file_post' , array( 'post' , 'add_file_post' ) );
    add_action( 'wp_ajax_nopriv_add_file_post' , array( 'post' , 'add_file_post' ) );

	/* add add_audio_post action */
    add_action( 'wp_ajax_add_audio_post' , array( 'post' , 'add_audio_post' ) );
    add_action( 'wp_ajax_nopriv_add_audio_post' , array( 'post' , 'add_audio_post' ) );

    /* add add_text_post action */
    add_action( 'wp_ajax_play_video' , array( 'post' , 'play_video' ) );
    add_action( 'wp_ajax_nopriv_play_video' , array( 'post' , 'play_video' ) );
    
    add_action( 'wp_ajax_go_random' , array( 'post' , 'random_posts' ) );
    add_action( 'wp_ajax_nopriv_go_random' , array( 'post' , 'random_posts' ) );
	
	/*action for cosmo news */
	add_action( 'wp_ajax_set_cosmo_news' , array( 'options' , 'set_cosmo_news' ) );

	/*action for removing post from front end*/
	add_action('wp_ajax_remove_post' , array( 'post' , 'remove_post' ) );

	/* extra actions */
	add_action('wp_ajax_get_rows'       ,   array('extra' , 'get') );
    add_action('wp_ajax_extra_add'      ,   array('extra' , 'add') );
    add_action('wp_ajax_extra_del'      ,   array('extra' , 'del') );
    add_action('wp_ajax_extra_update'   ,   array('extra' , 'update') );
    add_action('wp_ajax_extra_sort'     ,   array('extra' , 'sort') );

    /* new action */
    //add_action('wp_ajax_post_relation'  , 'get_post_relation' );
    add_action('wp_ajax_search_relation'  , 'search_relation' );

    /* contact form action */
    if(is_user_logged_in () ){
        add_action('wp_ajax_contact' , array('contact' , 'send_mail') );
    }else{
        add_action('wp_ajax_nopriv_contact' , array('contact' , 'send_mail') );
    }

    /* columns shortcodes */
    add_shortcode('twocol_one', array( 'shcode' , 'de_twocol_one' ) );
    add_shortcode('twocol_one_first', array( 'shcode' , 'de_twocol_one_first' ) );
    add_shortcode('twocol_one_last', array( 'shcode' , 'de_twocol_one_last' ) );
    add_shortcode('threecol_one', array( 'shcode' , 'de_threecol_one' ) );
    add_shortcode('threecol_one_first', array( 'shcode' , 'de_threecol_one_first' ) );
    add_shortcode('threecol_one_last', array( 'shcode' , 'de_threecol_one_last' ) );
    add_shortcode('threecol_two', array( 'shcode' , 'de_threecol_two' ) );
    add_shortcode('threecol_two_first', array( 'shcode' , 'de_threecol_two_first' ) );
    add_shortcode('threecol_two_last', array( 'shcode' , 'de_threecol_two_last' ) );
    add_shortcode('fourcol_one', array( 'shcode' , 'de_fourcol_one' ) );
    add_shortcode('fourcol_one_first', array( 'shcode' , 'de_fourcol_one_first' ) );
    add_shortcode('fourcol_one_last', array( 'shcode' , 'de_fourcol_one_last' ) );
    add_shortcode('fourcol_two', array( 'shcode' , 'de_fourcol_two' ) );
    add_shortcode('fourcol_two_first', array( 'shcode' , 'de_fourcol_two_first' ) );
    add_shortcode('fourcol_two_last', array( 'shcode' , 'de_fourcol_two_last' ) );
    add_shortcode('fourcol_three', array( 'shcode' , 'de_fourcol_three' ) );
    add_shortcode('fourcol_three_first', array( 'shcode' , 'de_fourcol_three_first' ) );
    add_shortcode('fourcol_three_last', array( 'shcode' , 'de_fourcol_three_last' ) );
    add_shortcode('fivecol_one', array( 'shcode' , 'de_fivecol_one' ) );
    add_shortcode('fivecol_one_first', array( 'shcode' , 'de_fivecol_one_first' ) );
    add_shortcode('fivecol_one_last', array( 'shcode' , 'de_fivecol_one_last' ) );
    add_shortcode('fivecol_two', array( 'shcode' , 'de_fivecol_two' ) );
    add_shortcode('fivecol_two_first', array( 'shcode' , 'de_fivecol_two_first' ) );
    add_shortcode('fivecol_two_last', array( 'shcode' , 'de_fivecol_two_last' ) );
    add_shortcode('fivecol_three', array( 'shcode' , 'de_fivecol_three' ) );
    add_shortcode('fivecol_three_first', array( 'shcode' , 'de_fivecol_three_first' ) );
    add_shortcode('fivecol_three_last', array( 'shcode' , 'de_fivecol_three_last' ) );
    add_shortcode('fivecol_four', array( 'shcode' , 'de_fivecol_four' ) );
    add_shortcode('fivecol_four_first', array( 'shcode' , 'de_fivecol_four_first' ) );
    add_shortcode('fivecol_four_last', array( 'shcode' , 'de_fivecol_four_last' ) );

    /* extra shortcode */
    add_shortcode('button', array( 'shcode' , 'add_button' ) );
    add_shortcode('hr', array( 'shcode' , 'add_hr' ) );
    add_shortcode('divider', array( 'shcode' , 'add_divider' ) );
    add_shortcode('quote', array( 'shcode' , 'add_quote' ) );
    add_shortcode('box', array( 'shcode' , 'add_box' ) );
    add_shortcode('unordered_list', array( 'shcode' , 'add_unordered_list' ) );
    add_shortcode('ordered_list', array( 'shcode' , 'add_ordered_list' ) );
    add_shortcode('highlight', array( 'shcode' , 'add_highlight' ) );
    add_shortcode('dropcap', array( 'shcode' , 'add_dropcap' ) );
    add_shortcode('toggle', array( 'shcode' , 'add_toggle' ) );

    add_shortcode('demo', array( 'shcode' , 'de_demo' ) );
    add_shortcode('tabs', array( 'shcode' , 'add_tabs' ) );
    add_shortcode('accordion', array( 'shcode' , 'add_accordion' ) );

    /* contact form*/
    add_shortcode('contact', array( 'shcode' , 'contact' ) );

    add_filter('the_content', 'do_shortcode');  /*we need this to be able to have nested shortcodes*/
    add_filter('widget_text', 'do_shortcode');

    /* contact builder actions */
    add_action('wp_ajax_load_contact' , array( 'contact_builder' ,'load_contact' ) );
    add_action('wp_ajax_set_contact_meta' , array( 'contact_builder' ,'set_contact_meta' ) );
    add_action('wp_ajax_get_contact_map' , array( 'contact_builder' ,'get_contact_map' ) );

    /*actions for latest custom posts widget*/
    add_action( 'wp_ajax_get_taxonomies'                    , array( 'widget_custom_post' , 'get_taxonomies' ) );
    add_action( 'wp_ajax_get_terms'                         , array( 'widget_custom_post' , 'get_terms' ) );

    /* widgets */
    /* general widgets */
    register_widget("widget_tweets");
    register_widget("widget_flickr");
    register_widget("widget_contact");

    register_widget("widget_submit");
    register_widget("widget_tabber");
    register_widget("widget_tags");
    register_widget("widget_comments");
    register_widget("widget_latest_posts");
	register_widget("widget_top_authors");
    register_widget("widget_category_icons");
	register_widget("widget_featured_posts");
	register_widget("widget_testimonials");
    register_widget("widget_instagram");
    register_widget("widget_custom_post");
    


    /* register sidebars */
    if ( function_exists('register_sidebar') ) {
        register_sidebar(array(
			'name' => __( 'Main Sidebar', 'cosmotheme' ),
			'id' => 'main',
			'before_widget' => '<aside id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h5 class="widget-title"><span>',
			'after_title' => '</span></h5><div class="widget-delimiter">&nbsp;</div>',
		));

        register_sidebar(array(
            'name' => __( 'Second Sidebar', 'cosmotheme' ),
            'id' => 'secondary',
            'before_widget' => '<aside id="%1$s" class="widget"><div class="%2$s">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h5 class="widget-title"><span>',
            'after_title' => '</span></h5><div class="widget-delimiter">&nbsp;</div>',
        ));
        

        register_sidebar(array(
			'name' => __( 'First', 'cosmotheme' ),
			'id' => 'footer-first',
            'description'   => __('Use this sidebar in templates to be able to view its content.','cosmotheme'),
			'before_widget' => '<aside id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h5 class="widget-title"><span>',
			'after_title' => '</span></h5><div class="widget-delimiter">&nbsp;</div>',
		));

        register_sidebar(array(
			'name' => __( 'Second', 'cosmotheme' ),
			'id' => 'footer-second',
            'description'   => __('Use this sidebar in templates to be able to view its content.','cosmotheme'),
			'before_widget' => '<aside id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h5 class="widget-title"><span>',
			'after_title' => '</span></h5><div class="widget-delimiter">&nbsp;</div>',
		));

        register_sidebar(array(
			'name' => __( 'Third', 'cosmotheme' ),
			'id' => 'footer-third',
            'description'   => __('Use this sidebar in templates to be able to view its content.','cosmotheme'),
			'before_widget' => '<aside id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h5 class="widget-title"><span>',
			'after_title' => '</span></h5><div class="widget-delimiter">&nbsp;</div>',
		));

        
        /*register_sidebar(array(
			'name' => __( 'Footer Fourth', 'cosmotheme' ),
			'id' => 'footer-fourth',
			'before_widget' => '<aside id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5><div class="widget-delimiter">&nbsp;</div>',
		));*/

		/*register_sidebar(array(
			'name' => __( 'Social media icons', 'cosmotheme' ),
			'id' => 'social-media',
			'before_widget' => '<aside id="%1$s" class="widget"><div class="%2$s">',
			'after_widget' => '</div></aside>',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5><div class="widget-delimiter">&nbsp;</div>',
		));*/

        $sidebars = options::get_value( '_sidebar' );
        
        /* register dinamic sidebar */
        if( is_array( $sidebars ) && !empty( $sidebars ) ){
            foreach( $sidebars as $sidebar ){
                register_sidebar(array(
                    'name' => $sidebar['title'] ,
                    'id' => trim( strtolower( str_replace( ' ' , '-' , $sidebar['title'] ) ) ),
                    'before_widget' => '<aside id="%1$s" class="widget"><div class="%2$s">',
                    'after_widget' => '</div></aside>',
                    'before_title' => '<h5 class="widget-title"><span>',
                    'after_title' => '</span></h5><div class="widget-delimiter">&nbsp;</div>',
                ));
            }
        }
    }
?>
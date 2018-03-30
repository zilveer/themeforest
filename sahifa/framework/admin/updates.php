<?php
if( get_option('tie_active') ) {
	if( get_option('tie_active') < 3 ){
		$old_options  = array(
			"tie_logo_setting",
			"tie_logo",
			"tie_logo_margin",
			"tie_favicon",
			"tie_gravatar",
			"tie_timthumb",
			"tie_top_right",
			"tie_top_date",
			"tie_todaydate_format",
			"tie_random_article",
			"tie_breadcrumbs",
			"tie_breadcrumbs_delimiter",
			"tie_css",
			"tie_header_code",
			"tie_footer_code",
			"tie_sidebar_pos",
			"tie_on_home",
			"tie_home_layout",
			"tie_home_tabs_box",
			"tie_post_featured",
			"tie_post_authorbio",
			"tie_post_nav",
			"tie_post_meta",
			"tie_post_author",
			"tie_post_date",
			"tie_post_cats",
			"tie_post_comments",
			"tie_post_tags",
			"tie_comment_validation",
			"tie_share_post",
			"tie_share_tweet",
			"tie_share_twitter_username",
			"tie_share_facebook",
			"tie_share_google",
			"tie_share_linkdin",
			"tie_share_stumble",
			"tie_share_pinterest",
			"tie_related",
			"tie_related_number",
			"tie_related_query",
			"tie_footer_top",
			"tie_footer_social",
			"tie_footer_widgets",
			"tie_footer_one",
			"tie_footer_two",
			"tie_share_buttons",
			"tie_archives_socail",
			"tie_blog_display",
			"tie_category_desc",
			"tie_category_rss",
			"tie_tag_rss",
			"tie_author_bio",
			"tie_author_rss",
			"tie_search_cats",
			"tie_search_exclude_pages",
			"tie_sidebar_home",
			"tie_sidebar_page",
			"tie_sidebar_post",
			"tie_sidebar_archive",
			"tie_breaking_news",
			"tie_breaking_title",
			"tie_breaking_number",
			"tie_breaking_effect",
			"tie_breaking_speed",
			"tie_breaking_time",
			"tie_breaking_type",
			"tie_breaking_tag",
			"tie_rss_url",
			"tie_slider",
			"tie_slider_type",
			"tie_slider_pos",
			"tie_slider_number",
			"tie_flexi_slider_effect",
			"tie_flexi_slider_speed",
			"tie_flexi_slider_time",
			"tie_elastic_slider_effect",
			"tie_elastic_slider_autoplay",
			"tie_elastic_slider_interval",
			"tie_elastic_slider_speed",
			"tie_slider_query",
			"tie_slider_tag",
			"tie_slider_cat",
			"tie_slider_posts",
			"tie_slider_pages",
			"tie_slider_custom",
			"tie_banner_top",
			"tie_banner_top_img",
			"tie_banner_top_url",
			"tie_banner_top_alt",
			"tie_banner_top_tab",
			"tie_banner_top_adsense",
			"tie_banner_bottom",
			"tie_banner_bottom_img",
			"tie_banner_bottom_url",
			"tie_banner_bottom_alt",
			"tie_banner_bottom_tab",
			"tie_banner_bottom_adsense",
			"tie_banner_above",
			"tie_banner_above_img",
			"tie_banner_above_url",
			"tie_banner_above_alt",
			"tie_banner_above_tab",
			"tie_banner_above_adsense",
			"tie_banner_below",
			"tie_banner_below_img",
			"tie_banner_below_url",
			"tie_banner_below_alt",
			"tie_banner_below_tab",
			"tie_banner_below_adsense",
			"tie_ads1_shortcode", 
			"tie_ads2_shortcode",
			"tie_theme_skin",
			"tie_background_type",
			"tie_background_pattern",
			"tie_background_pattern_color",
			"tie_background_full",
			"tie_exclude_shortcodes",
			"tie_notify_theme",
			"tie_dashboard_logo",
			"tie_global_color",
			"tie_links_color",
			"tie_links_decoration",
			"tie_links_color_hover",
			"tie_links_decoration_hover",
			"tie_topbar_links_color",
			"tie_topbar_links_color_hover",
			"tie_todaydate_background",
			"tie_todaydate_color",
			"tie_breaking_title_bg",
			"tie_footer_title_color",
			"tie_footer_links_color",
			"tie_footer_links_color_hover",
			"tie_breaking_cat",
			"tie_sidebars",
			"tie_social",
			"tie_home_tabs",
			"tie_background",
			"tie_topbar_background",
			"tie_header_background",
			"tie_footer_background",
			"tie_typography_general",
			"tie_typography_top_menu",
			"tie_typography_main_nav",
			"tie_typography_page_title",
			"tie_typography_post_title",
			"tie_typography_post_meta",
			"tie_typography_post_entry",
			"tie_typography_boxes_title",
			"tie_typography_widgets_title",
			"tie_typography_footer_widgets_title",
			"tie_typography_post_h1",
			"tie_typography_post_h2",
			"tie_typography_post_h3",
			"tie_typography_post_h4",
			"tie_typography_post_h5",
			"tie_typography_post_h6"
		);
		
		$current_options = array();
		foreach( $old_options as $option ){
			if( get_option( $option ) ){
				$new_option = preg_replace('/tie_/', '' , $option);
				if( $option == 'tie_home_tabs' ){
					$tie_home_tabs = explode (',' , get_option( $option ) );
					$current_options[$new_option] = $tie_home_tabs  ;
				}else{			
					$current_options[$new_option] =  get_option( $option ) ;
				}
				update_option( 'tie_options' , $current_options );
				delete_option($option);
			}
		}
		update_option( 'tie_active' , 3 );
		echo '<script>location.reload();</script>';
		die;
	}
	
					
	elseif( get_option('tie_active') < 4 ){
		$categories_obj = get_categories('hide_empty=0');
		foreach ($categories_obj as $pn_cat) {
			$category_id = $pn_cat->cat_ID;
			
			$cat_sidebar = tie_get_option( 'sidebar_cat_'.$category_id );
			$cat_slider  = tie_get_option( 'slider_cat_'.$category_id  );
			$cat_bg 	 = tie_get_option( 'cat'.$category_id.'_background' );
			$cat_full_bg = tie_get_option( 'cat'.$category_id.'_background_full' );
			$cat_color   = tie_get_option( 'cat_'.$category_id.'_color' );
			
			$new_cat = array();
			$new_cat['cat_sidebar'] =  $cat_sidebar;
			$new_cat['cat_slider']  = $cat_slider;
			$new_cat['cat_color'] = $cat_color;
			$new_cat['cat_background'] = $cat_bg;
			$new_cat['cat_background_full'] = $cat_full_bg;
			
			update_option( "tie_cat_".$category_id , $new_cat );
		}


		$theme_options = get_option( 'tie_options' );
		
		if( !empty($theme_options['theme_skin']) ){
			if( $theme_options['theme_skin'] == 'red' )
				$theme_options['theme_skin'] = '#ef3636';
			elseif( $theme_options['theme_skin'] == 'blue' )
				$theme_options['theme_skin'] = '#37b8eb';
			elseif( $theme_options['theme_skin'] == 'green' )
				$theme_options['theme_skin'] = '#81bd00';
			elseif( $theme_options['theme_skin'] == 'pink' )
				$theme_options['theme_skin'] = '#e95ca2';
			elseif( $theme_options['theme_skin'] == 'black' )
				$theme_options['theme_skin'] = '#000';
			elseif( $theme_options['theme_skin'] == 'yellow' )
				$theme_options['theme_skin'] = '#ffbb01';
			elseif( $theme_options['theme_skin'] == 'purple' )
				$theme_options['theme_skin'] = '#7b77ff';
		}
		$theme_options['post_og_cards'] = true;
		$theme_options['slider_caption'] = true;
		$theme_options['slider_caption_length'] = 100;

		$theme_options['box_meta_score'] 	= true;
		$theme_options['box_meta_date'] 	= true;
		$theme_options['box_meta_comments'] = true;
		
		$theme_options['arc_meta_score'] 	= true;
		$theme_options['arc_meta_date'] 	= true;
		$theme_options['arc_meta_comments'] = true;
		
		$theme_options['modern_scrollbar']  = true;

		update_option( 'tie_options' , $theme_options );


		update_option( 'tie_active' , 4.1 );
		echo '<script>location.reload();</script>';
		die;
	}

	
	elseif( get_option('tie_active') < 5 ){
			
		if( get_option ( 'show_on_front' ) == 'posts' ){
		
			$post = array(
				'post_name'      => 'home',
				'post_title'     => 'Home',
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'comment_status' => 'closed'
			); 	
			$post_id = wp_insert_post( $post, $wp_error );

			//Set the new page as Homepage
			update_option ( 'show_on_front', 'page' );
			update_option ( 'page_on_front', $post_id );
					
			// Move Builder To pages
			$tie_get_blocks = get_option( 'tie_home_cats' );
			$home_tabs_active = tie_get_option('home_tabs_box');
			$home_tabs = tie_get_option('home_tabs');
		
			if( !empty( $tie_get_blocks ) && is_array( $tie_get_blocks ) && tie_get_option('on_home') == 'boxes' && !empty( $post_id ) ){
				$tie_new_blocks = $tie_get_blocks;
				
				if( $home_tabs_active && $home_tabs ){
					$tie_tabs_block = array( 'boxid' => 'tabs_111372', 'cat' => $home_tabs, 'type' => 'tabs' );
					$tie_new_blocks[] = $tie_tabs_block;
				}
			}
			elseif( tie_get_option('on_home') != 'boxes' && !empty( $post_id ) ){
			
				if( tie_get_option( 'blog_display' ) == 'content' ){
					$tie_new_blocks = array( array( 'title' => '', 'number' => '15', 'offset' => '', 'pagi' => 'true', 'boxid' => 'recent_111372', 'display' => 'content', 'type' => 'recent' ));
				}elseif( tie_get_option( 'blog_display' ) == 'full_thumb' ){
					$tie_new_blocks = array( array( 'title' => '', 'number' => '15', 'offset' => '', 'pagi' => 'true', 'boxid' => 'recent_111372', 'display' => 'full_thumb', 'type' => 'recent' ));
				}else{
					$tie_new_blocks = array( array( 'title' => '', 'number' => '15', 'offset' => '', 'pagi' => 'true', 'boxid' => 'recent_111372', 'display' => 'blog', 'type' => 'recent' ));
				}
			
			}
			
			if( !empty( $tie_new_blocks ) && !empty( $post_id ) ){
				update_post_meta( $post_id, 'tie_builder_active',	'yes' );
				update_post_meta( $post_id, 'tie_builder',		 	$tie_new_blocks );
				
				update_post_meta( $post_id, 'home_exc_length',		tie_get_option('home_exc_length') );
				update_post_meta( $post_id, 'box_meta_score',		tie_get_option('box_meta_score') );
				update_post_meta( $post_id, 'box_meta_author',		tie_get_option('box_meta_author') );
				update_post_meta( $post_id, 'box_meta_date',		tie_get_option('box_meta_date') );
				update_post_meta( $post_id, 'box_meta_cats',		tie_get_option('box_meta_cats') );
				update_post_meta( $post_id, 'box_meta_comments',	tie_get_option('box_meta_comments') );
				update_post_meta( $post_id, 'box_meta_views',		tie_get_option('box_meta_views') );
			}
			
			//Store Slider
			if ( tie_get_option( 'slider' ) && !empty( $post_id ) ) {
				update_post_meta( $post_id, 'slider' , true );
				update_post_meta( $post_id, 'slider_type',				tie_get_option('slider_type') );
				update_post_meta( $post_id, 'slider_caption_length',	tie_get_option('slider_caption_length') );
				update_post_meta( $post_id, 'slider_pos',				tie_get_option('slider_pos') );
				
				update_post_meta( $post_id, 'elastic_slider_effect',	tie_get_option('elastic_slider_effect') );
				update_post_meta( $post_id, 'elastic_slider_interval',	tie_get_option('elastic_slider_interval') );
				update_post_meta( $post_id, 'elastic_slider_speed',		tie_get_option('elastic_slider_speed') );
					
				update_post_meta( $post_id, 'flexi_slider_effect',		tie_get_option('flexi_slider_effect') );
				update_post_meta( $post_id, 'flexi_slider_speed',		tie_get_option('flexi_slider_speed') );
				update_post_meta( $post_id, 'flexi_slider_time',		tie_get_option('flexi_slider_time') );
					
				update_post_meta( $post_id, 'slider_number',			tie_get_option('slider_number') );
				update_post_meta( $post_id, 'slider_query',				tie_get_option('slider_query') );
					
				update_post_meta( $post_id, 'slider_cat',				tie_get_option('slider_cat') );
				update_post_meta( $post_id, 'slider_tag',				tie_get_option('slider_tag') );
				update_post_meta( $post_id, 'slider_posts',				tie_get_option('slider_posts') );
				update_post_meta( $post_id, 'slider_pages',				tie_get_option('slider_pages') );
				update_post_meta( $post_id, 'slider_custom',			tie_get_option('slider_custom') );
					
				if( tie_get_option('slider_caption') )
					update_post_meta( $post_id, 'slider_caption' , true );
			}

		}

		$theme_options							= get_option( 'tie_options' );
		$theme_options['theme_layout'] 			= 'boxed';
		$theme_options['lightbox_all'] 			= true;
		$theme_options['lightbox_gallery'] 		= true;
		$theme_options['top_search'] 			= true;
		$theme_options['live_search'] 			= true;
		$theme_options['top_social'] 			= true;
		$theme_options['post_views'] 			= true;
		$theme_options['share_post_type'] 		= 'counter';
		$theme_options['related_number_full']	= '4';
		$theme_options['check_also'] 			= true;
		$theme_options['check_also_position'] 	= 'right';
		$theme_options['check_also_number'] 	= '1';
		$theme_options['check_also_query'] 		= 'category';
		$theme_options['homepage_cats_colors'] 	= true;
		$theme_options['lazy_load'] 			= true;
		$theme_options['sticky_sidebar'] 		= true;

		update_option( 'tie_options' , $theme_options );	

		update_option( 'tie_active' , 5 );
		echo '<script>location.reload();</script>';
		die;
	}

	elseif( get_option('tie_active') < '5.1.0' ){

		$theme_options							= get_option( 'tie_options' );
		$theme_options['mobile_menu_active'] 	= true;
		$theme_options['mobile_menu_search'] 	= true;
		$theme_options['mobile_menu_social'] 	= true;
		$theme_options['share_buttons_pages'] 	= true;


		update_option( 'tie_options' , $theme_options );	

		update_option( 'tie_active' , '5.1.0' );
		echo '<script>location.reload();</script>';
		die;
		
	}

	elseif( get_option('tie_active') < '5.2.0' ){

		//Update Theme options
		global $tie_default_texts;
		$theme_options							= get_option( 'tie_options' );
		$theme_options['reading_indicator'] 	= true;
		foreach ( $tie_default_texts as $value ) {
			if( !is_array( $value ) ){
				$value 				= htmlspecialchars  ( $value );
				$tie_sanitize_title	= tie_sanitize_title( $value );
				$sanitize_title 	= sanitize_title    ( $value );

				if( $tie_sanitize_title != $sanitize_title ) {
					$theme_options[ $tie_sanitize_title ] = $theme_options[ $sanitize_title ];
				}
			}
		}
		update_option( 'tie_options' , $theme_options );	

		//Update Categories custom options
		$tie_cats_options = '';
		$categories_obj = get_categories();
		foreach ($categories_obj as $pn_cat) {
			$category_id = $pn_cat->cat_ID ;
			$old_cat_options = get_option( "tie_cat_$category_id" );
			if( $old_cat_options ){
				$tie_cats_options[ $category_id ] =  $old_cat_options;
			}
			delete_option( "tie_cat_$category_id" );
		}
		update_option( 'tie_cats_options' , $tie_cats_options );	

		//Update Theme Version
		update_option( 'tie_active' , '5.2.0' );
		echo '<script>location.reload();</script>';
		die;
		
	}


	elseif( get_option('tie_active') < '5.3.0' ){

		//Update Theme options
		$theme_options					= get_option( 'tie_options' );
		$theme_options['smoth_scroll'] 	= true;

		$renamed_options = array( 'top_menu', 'main_nav', 'mobile_menu_hide_icons', 'rss_icon' );
		foreach ( $renamed_options as $option ) {
			if( tie_get_option( $option ) ){
				unset( $theme_options[ $option ] );
			}
			else{
				$theme_options[ $option ] = true;
			}
		}

		update_option( 'tie_options' , $theme_options );	
	
		//Update Theme Version
		update_option( 'tie_active' , '5.3.0' );
		echo '<script>location.reload();</script>';
		die;
		
	}

}

//For Debugging 
//update_option( 'tie_active' , '5.2.0' );

?>
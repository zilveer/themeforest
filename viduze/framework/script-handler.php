<?php

	/*	
	*	CrunchPress Include Script File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	*   @ Package   The Church Theme
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file manage to embed the stylesheet and javascript to each page
	*	based on the content of that page.
	*	---------------------------------------------------------------------
	*/
	
		add_action('init', 'register_all_cp_scripts');
	function register_all_cp_scripts(){
	
		if( $GLOBALS['pagenow'] != 'wp-login.php' ){
			if(is_admin()){
			
				/*wp_enqueue_style('cp-back-office', TH_FW_BE_URL.'/assets/stylesheet/cp-backend.css');*/
				add_action('add_meta_boxes', 'register_meta_script');
				
			}else{
				 add_action('wp_enqueue_scripts','register_non_admin_styles');
				 add_action('wp_enqueue_scripts','register_non_admin_scripts');
			}
	
		  }
		}
		
		// Call Stylesheets
	add_action('init', 'register_all_theme_scripts');
	function register_all_theme_scripts(){
	
		if( $GLOBALS['pagenow'] != 'wp-login.php' ){
			if(is_admin()){
			
				/*wp_enqueue_style('cp-back-office', TH_FW_BE_URL.'/assets/stylesheet/cp-backend.css');*/
				add_action('add_meta_boxes', 'register_meta_script');
				
			}else{
				 wp_enqueue_style('style', CP_THEME_PATH_URL.'/style.css');
				 wp_enqueue_style('style-custom', CP_THEME_PATH_URL.'/stylesheet/style-custom.php');
				 //wp_enqueue_style('rtl', CP_THEME_PATH_URL.'/stylesheet/rtl.css');
			     wp_enqueue_style('flexslider', CP_THEME_PATH_URL.'/stylesheet/flexslider.css');
  			     wp_enqueue_style('bootstrap', CP_THEME_PATH_URL.'/stylesheet/bootstrap.css');
				 wp_enqueue_style('bootstrap-responsive', CP_THEME_PATH_URL.'/stylesheet/bootstrap-responsive.css');
                 wp_enqueue_style('skin', CP_THEME_PATH_URL.'/stylesheet/skin.css');
		 	     wp_enqueue_style('prettyph', CP_THEME_PATH_URL.'/stylesheet/prettyph.css');
                 wp_enqueue_style('jscrollpane', CP_THEME_PATH_URL.'/stylesheet/jquery.jscrollpane.css');
				 wp_enqueue_style('font-awesome-min', CP_THEME_PATH_URL.'/stylesheet/font-awesome.min.css');
				 wp_enqueue_style('font-awesome', CP_THEME_PATH_URL.'/stylesheet/font-awesome.css');
			     }
	
			}
		}
		
	/* 	---------------------------------------------------------------------
	*	This section include the back-end script
	*	---------------------------------------------------------------------
	*/ 
	
	
	function load_admin_things() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
    }

     add_action( 'admin_enqueue_scripts', 'load_admin_things' );

	
	function register_meta_script(){
		global $post_type;
		
		wp_enqueue_style('ie-style',TH_FW_BE_URL . '/stylesheet/ie-style.php?path=' . TH_FW_BE_URL);		
		
		// register style and script when access to the "page" post_type page
		if( $post_type == 'page' ){
		
			wp_enqueue_style('meta-css',TH_FW_BE_URL.'/assets/stylesheet/meta-css.css');
			wp_enqueue_style('page-dragging',TH_FW_BE_URL.'/assets/stylesheet/page-dragging.css');
			wp_enqueue_style('image-picker',TH_FW_BE_URL.'/assets/stylesheet/image-picker.css');
			wp_enqueue_style('confirm-dialog',TH_FW_BE_URL.'/assets/stylesheet/jquery.confirm.css');

			wp_deregister_script('image-picker');
			wp_register_script('image-picker', TH_FW_BE_URL.'/assets/javascript/image-picker.js', false, '1.0', true);
			wp_enqueue_script('image-picker');
		
			wp_deregister_script('page-dragging');
			wp_register_script('page-dragging', TH_FW_BE_URL.'/assets/javascript/page-dragging.js', false, '1.0', true);
			wp_enqueue_script('page-dragging');
			
			wp_deregister_script('edit-box');
			wp_register_script('edit-box', TH_FW_BE_URL.'/assets/javascript/edit-box.js', false, '1.0', true);
			wp_enqueue_script('edit-box');

			wp_deregister_script('confirm-dialog');
			wp_register_script('confirm-dialog', TH_FW_BE_URL.'/assets/javascript/jquery.confirm.js', false, '1.0', true);
			wp_enqueue_script('confirm-dialog');
			
		// register style and script when access to the "post" post_type page
		}else if( $post_type == 'post' || $post_type == 'portfolio' || $post_type == 'gallery'){
		
			wp_enqueue_style('meta-css',TH_FW_BE_URL.'/assets/stylesheet/meta-css.css');
			wp_enqueue_style('image-picker',TH_FW_BE_URL.'/assets/stylesheet/image-picker.css');
			wp_enqueue_style('confirm-dialog',TH_FW_BE_URL.'/assets/stylesheet/jquery.confirm.css');
			
			wp_deregister_script('post-effects');
			wp_register_script('post-effects', TH_FW_BE_URL.'/assets/javascript/post-effects.js', false, '1.0', true);
			wp_enqueue_script('post-effects');
			
			wp_deregister_script('image-picker');
			wp_register_script('image-picker', TH_FW_BE_URL.'/assets/javascript/image-picker.js', false, '1.0', true);
			wp_localize_script( 'image-picker', 'URL', array('crunchpress' => CP_THEME_PATH_URL ));
			wp_enqueue_script('image-picker');
			
			wp_deregister_script('confirm-dialog');
			wp_register_script('confirm-dialog', TH_FW_BE_URL.'/assets/javascript/jquery.confirm.js', false, '1.0', true);
			wp_enqueue_script('confirm-dialog');
		
		// register style and script when access to the "testimonial" post_type page		
		}else if( $post_type == 'testimonial' ){
			wp_enqueue_style('meta-css',TH_FW_BE_URL.'/assets/stylesheet/meta-css.css');
		}else if( $post_type == 'price_table' ){
		    wp_enqueue_style('meta-css',TH_FW_BE_URL.'/assets/stylesheet/meta-css.css');
			wp_deregister_script('price-table-script');
			wp_register_script('price-table-script', TH_FW_BE_URL.'/assets/javascript/price-table-script.js', false, '1.0', true);
			wp_enqueue_script('price-table-script');
		}
	}
	
	
	// register script in CrunchPress panel
	function register_crunchpress_panel_scripts($hook_suffix){

		//wp_enqueue_style('ie-style',CP_THEME_PATH_URL . 'stylesheet/ie-style.php?path=' . CP_THEME_PATH_URL);	
	    if($hook_suffix == 'toplevel_page_options') {
		wp_register_script('jquery-ui',TH_FW_BE_URL.'/assets/javascript/jquery-ui.js', false, '1.0', false);
		wp_register_script('jquery',TH_FW_BE_URL.'/assets/javascript/jquery.js', false, '1.0', false);
		wp_register_script('cufon',TH_FW_BE_URL.'/assets/javascript/cufon.js', false, '1.0', false);
		wp_register_script('cp-panel',TH_FW_BE_URL.'/assets/javascript/cp-panel.js', false, '1.0', false);
		wp_localize_script( 'cp-panel', 'URL', array('crunchpress' => TH_FW_BE_URL, 'sample_text' => FONT_SAMPLE_TEXT ));
		wp_register_script('mini-color',TH_FW_BE_URL.'/assets/javascript/jquery.miniColors.js', false, '1.0', false);
		wp_register_script('confirm-dialog',TH_FW_BE_URL.'/assets/javascript/jquery.confirm.js', false, '1.0', false);
		wp_register_script('dummy_content',TH_FW_BE_URL.'/assets/javascript/dummy_content.js', false, '1.0', false);
		
		
		wp_enqueue_script('jquery-ui');
        wp_enqueue_script('jquery');
		wp_enqueue_script('cufon');
		wp_enqueue_script('cp-panel');
		wp_enqueue_script('mini-color');
    	wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('confirm-dialog');
		wp_enqueue_script('dummy_content');
		
		wp_enqueue_style('jquery-ui',TH_FW_BE_URL.'/assets/stylesheet/jquery-ui-1.8.16.custom.css');
		wp_enqueue_style('cp-panel',TH_FW_BE_URL.'/assets/stylesheet/cp-panel.css');
		wp_enqueue_style('mini-color',TH_FW_BE_URL.'/assets/stylesheet/jquery.miniColors.css');
		wp_enqueue_style('thickbox');
		wp_enqueue_style('confirm-dialog',TH_FW_BE_URL.'/assets/stylesheet/jquery.confirm.css');
	}
}

	/* 	---------------------------------------------------------------------
	*	this section include the front-end script
	*	---------------------------------------------------------------------
	*/ 
	
	// Register all stylesheet

	function register_non_admin_styles(){
	
		global $post;
		
		wp_enqueue_style('shortcodes',FW_FE_CSS.'/shortcodes.css');
		// Navigation Menu
		//wp_enqueue_style('prettyPhoto',FW_FE_CSS.'/prettyPhoto.css');
		
		if( is_search() || is_archive() ){
			wp_enqueue_style('flex-slider',FW_FE_CSS.'/flexslider.css');
		// Post post_type
		}else if( isset($post) && $post->post_type == 'post' || 
			isset($post) && $post->post_type == 'portfolio' ){
		
			// If using slider (flex slider)	
			global $cp_post_thumbnail;
			$cp_post_thumbnail = get_post_meta($post->ID,'post-option-inside-thumbnail-types', true);
			if( $cp_post_thumbnail == 'Slider'){
				wp_enqueue_style('flex-slider',FW_FE_CSS.'/flexslider.css');
			}
			
		// Page post_type
		}else if( isset($post) && $post->post_type == 'page' ){
		
			global $cp_page_xml, $cp_top_slider_type, $cp_top_slider_xml;
			$cp_page_xml = get_post_meta($post->ID,'page-option-item-xml', true);
			
			$cp_top_slider_type = get_post_meta($post->ID,'page-option-top-slider-types', true);
			
			$cp_top_slider_xml = get_post_meta($post->ID,'page-option-top-slider-xml', true);
			
			// If using carousel slider
			if(	strpos($cp_page_xml,'<slider-type>Carousel Slider</slider-type>') > -1 ){
				wp_enqueue_style('picachoose', FW_FE_CSS.'/pikachoose.css');
			}
			
			// If using nivo slider
			if( strpos($cp_page_xml,'<slider-type>Nivo Slider</slider-type>') > -1 ||
				$cp_top_slider_type == 'Nivo Slider' ){
				wp_enqueue_style('nivo-slider',FW_FE_CSS.'/nivo-slider.css');
				wp_enqueue_style('nivo-slider-style',FW_FE_CSS.'/nivo-slider-style.css');
			}			
			
			if(	strpos($cp_page_xml,'<slider-type>Flex Slider</slider-type>') > -1 || 
				strpos($cp_page_xml, '<Portfolio>') > -1 ||
				strpos($cp_page_xml, '<Blog>') > -1 ||
				strpos($cp_page_xml, '<Blog-Slider>') > -1 ||
				$cp_top_slider_type == 'Flex Slider'){
				wp_enqueue_style('flex-slider',FW_FE_CSS.'/flexslider.css');
			}
		}
	}
	
	

	// Register all scripts
	function register_non_admin_scripts(){
	
		global $post, $cp_is_responsive,  $crunchpress_element, $crunchpress_element, $wp_scripts;
		
		wp_register_script('query-1.8.3',  CP_THEME_PATH_URL.'/javascript/jquery-1.8.3.js', false, '1.0', true);
		wp_register_script('modernizr',  CP_THEME_PATH_URL.'/javascript/modernizr.js', false, '1.0', true);
		wp_register_script('bootstrap',  CP_THEME_PATH_URL.'/javascript/bootstrap.min.js', false, '1.0', true);
		wp_register_script('prettyPhoto',  CP_THEME_PATH_URL.'/javascript/prettyph.js', false, '1.0', true);
		wp_register_script('fitvids',  CP_THEME_PATH_URL.'/javascript/jquery.fitvids.js', false, '1.0', true);
		
		wp_register_script('jquery.flexslider',  CP_THEME_PATH_URL.'/javascript/jquery.flexslider.js', false, '1.0', true);
		wp_register_script('jquery.jcarousel.min',  CP_THEME_PATH_URL.'/javascript/jquery.jcarousel.min.js', false, '1.0', true);
		wp_register_script('jquery.jscrollpane.min',  CP_THEME_PATH_URL.'/javascript/jquery.jscrollpane.min.js', false, '1.0', true);
		wp_register_script('jquery.scrollTo-min',  CP_THEME_PATH_URL.'/javascript/jquery.scrollTo-min.js', false, '1.0', true);
		wp_register_script('functions',  CP_THEME_PATH_URL.'/javascript/functions.js', false, '1.0', true);
		
	    global $cp_page_xml, $cp_top_slider_type, $cp_top_slider_xml;	
	
		//wp_enqueue_script('query-1.8.3');
		wp_enqueue_script('modernizr');
		wp_enqueue_script('isotope');
		wp_enqueue_script('prettyPhoto');
	    wp_enqueue_script('fitvids');
		wp_enqueue_script('bootstrap');
		wp_enqueue_script('jquery.flexslider');
		wp_enqueue_script('jquery.jcarousel.min');
		wp_enqueue_script('jquery.jscrollpane.min');
		wp_enqueue_script('jquery.scrollTo-min');
	    wp_enqueue_script('functions');
			 
	   
	
	 	// Search and archive page
		if( is_search() || is_archive() ){

			$flex_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_flex_slider']);
			$flex_setting = array_merge($flex_setting, array('controlsContainer'=>'.flexslider'));
		
			wp_deregister_script('flex-slider');
			wp_register_script('flex-slider', FW_FE_JS.'/jquery.flexslider.js', false, '1.0', true);
			wp_localize_script( 'flex-slider', 'FLEX', $flex_setting);
			wp_enqueue_script('flex-slider');	
		
		// Post post_type
		}else if( isset($post) &&  $post->post_type == 'post' || 
			isset($post) &&  $post->post_type == 'portfolio'  ){
		
			// If using slider (flex slider)
			global $cp_post_thumbnail;

			if( $cp_post_thumbnail == 'Slider'){
                $flex_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_flex_slider']);
				$flex_setting = array_merge($flex_setting, array('controlsContainer'=>'.slider-wrapper'));
   			    wp_deregister_script('flex-slider');
				wp_register_script('flex-slider', FW_FE_JS.'/jquery.flexslider.js', false, '1.0', true);
				wp_localize_script( 'flex-slider', 'FLEX', $flex_setting);
				wp_enqueue_script('flex-slider');
				}
		
		// Page post_type
		}else if( isset($post) &&  $post->post_type == 'page' ){
			global $cp_page_xml, $cp_top_slider_type, $cp_top_slider_xml;
			// If using carousel slider
			if(	strpos($cp_page_xml,'<slider-type>Carousel Slider</slider-type>') > -1 ){
				$pikachoose_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_carousel_slider']);
				wp_deregister_script('pikachoose');
				wp_register_script('pikachoose', FW_FE_JS.'/jquery.pikachoose.js', false, '1.0', false);
				wp_localize_script( 'pikachoose', 'PIKACHOOSE', $pikachoose_setting);
				wp_enqueue_script('pikachoose');
			}
			// If using nivo slider
			if( strpos($cp_page_xml,'<slider-type>Nivo Slider</slider-type>') > -1 || $cp_top_slider_type == 'Nivo Slider' ){
				$nivo_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_nivo_slider']);
				wp_deregister_script('nivo-slider');
				wp_register_script('nivo-slider', FW_FE_JS.'/jquery.nivo.slider.pack.js', false, '1.0', true);
				wp_localize_script( 'nivo-slider', 'NIVO', $nivo_setting);
				wp_enqueue_script('nivo-slider');
			}
			// If using flex slider
			if( strpos($cp_page_xml, '<slider-type>Flex Slider</slider-type>') > -1 ||
				strpos($cp_page_xml, '<Portfolio>') > -1 ||
				strpos($cp_page_xml, '<Blog>') > -1 ||
				strpos($cp_page_xml, '<Blog-Slider>') > -1 ||
				$cp_top_slider_type == 'Flex Slider'){
				$flex_setting = get_cp_slider_option_array($crunchpress_element['cp_panel_flex_slider']);
				$flex_setting = array_merge($flex_setting, array('controlsContainer'=>'.flexslider'));		
				wp_deregister_script('flex-slider');
				wp_register_script('flex-slider', FW_FE_JS.'/jquery.flexslider.js', false, '1.0', true);
				wp_localize_script( 'flex-slider', 'FLEX', $flex_setting);
				wp_enqueue_script('flex-slider');	
			}
			// If use contact-form
			if( strpos($cp_page_xml,'<Contact-Form>') > -1 ){
				wp_deregister_script('contact-form');
				wp_register_script('contact-form', FW_FE_JS.'/cp-contactform.js', false, '1.0', true);
				wp_localize_script( 'contact-form', 'MyAjax', array( 'ajaxurl' => AJAX_URL ) );
				wp_enqueue_script('contact-form');
			}
		}
	
		// Comment Script
		if(is_singular() && comments_open() && get_option('thread_comments')){
			wp_enqueue_script( 'comment-reply' ); 
		}
	}
<?php

	/*	
	*	Goodlayers Include Script
	*	---------------------------------------------------------------------
	*	This file collects all script from the various resources and 
	*	enqueue it when necessary
	*	---------------------------------------------------------------------
	*/		
	
	if( !class_exists('gdlr_include_script') ){
	
		class gdlr_include_script{
			
			public $script_list = array(
				'script' => array(),
				'style' => array()
			);
			
			function __construct(){
				add_action('get_header', array(&$this, 'register_scripts'));
				add_action('wp_enqueue_scripts', array(&$this, 'enquque_styles'));
				add_action('wp_enqueue_scripts', array(&$this, 'enquque_scripts'));
			}
			
			function register_scripts(){
				$this->script_list = apply_filters('gdlr_enqueue_scripts', $this->script_list);
			}

			function enquque_styles(){
				global $wp_styles;
				
				wp_enqueue_style( 'style', get_stylesheet_uri() );
				foreach( $this->script_list['style'] as $script_slug => $script_url ){
					if( preg_match('#([^!]+)!(.+)#', $script_slug, $match) ){
						wp_enqueue_style($match[1], $script_url);
						$wp_styles->add_data($match[1], 'conditional', $match[2]);
					}else{
						wp_enqueue_style($script_slug, $script_url);
					}					
				}
			}
			
			function enquque_scripts(){
				global $is_IE;
				wp_enqueue_script('jquery');

				foreach( $this->script_list['script'] as $script_slug => $script_url ){
					if( preg_match('#([^!]+)!IE#', $script_slug, $match) ){
						if( $is_IE ){
							wp_enqueue_script($match[1], $script_url, array(), '1.0', true);
						}
					}else{
						wp_enqueue_script($script_slug, $script_url, array(), '1.0', true);
					}
				}
				
				if (is_singular() && comments_open() && get_option( 'thread_comments' )){
					wp_enqueue_script('comment-reply');				
				}				
			}

		}
		
	}
	
?>
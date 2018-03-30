<?php

/**
 * Custom functions for this theme. Overrides for default functions.php file go in here.
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( '_boutique_theme_version' ) ) {
	define( '_boutique_theme_version', '1.23.5' );
}

if ( ! class_exists( 'boutiqueThemeManager', false ) ) {
	// includes core theme manager class and default settings.
	require_once( get_template_directory() . '/dtbaker.theme_manager.class.php' );
}



if ( ! function_exists( 'boutique_get_theme_mod' ) ) {
	function boutique_get_theme_mod( $key, $default ) {
		if ( function_exists( 'icl_translate' ) ) {
			return icl_translate( 'Theme Mod', $key, get_theme_mod( $key, $default ) );
		}

		return get_theme_mod( $key, $default );
	}
}


if ( class_exists( 'boutiqueThemeManager', false ) ) {

	class boutiqueThemeManager_custom extends boutiqueThemeManager {

		/**
		 * Holds the current instance of the theme manager
		 *
		 * @var boutiqueThemeManager
		 */
		private static $instance = null;

		/**
		 * @return boutiqueThemeManager
		 */
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		public function start() {

			// add all parent filters here
			add_filter('boutique_blog_links',array($this,'boutique_blog_links'));
			add_action('boutique_blog_summary_inner_before',array($this,'boutique_blog_summary_inner_before'));
			add_filter('dtbaker_google_map_styles',array($this,'dtbaker_google_map_styles'),1);
			add_filter('dtbaker_insert_image_styles',array($this,'dtbaker_insert_image_styles'));
			add_filter('dtbaker_visual_column_styles',array($this,'dtbaker_visual_column_styles'));
			add_filter('comment_form_defaults',array($this,'comment_form_defaults'));
			add_filter('dtbaker_icon_layouts',array($this,'dtbaker_icon_layouts'));
			add_filter('dtbaker_banner_field_options',array($this,'dtbaker_banner_field_options'));
			add_filter('shortcode_atts_dtbaker_banner',array($this,'shortcode_atts_dtbaker_banner'), 10, 4);
			add_filter('dtbaker_line_layouts',array($this,'dtbaker_line_layouts'));
			add_filter('em_paginate',array($this,'em_paginate'));
			add_filter('woocommerce_pagination_args',array($this,'woocommerce_pagination_args'));
			add_filter('boutique_pagination_args',array($this,'woocommerce_pagination_args'));
			add_filter('boutique_theme_files',array($this,'boutique_theme_files'));
			add_action('boutique_blog_single_after',array($this,'boutique_blog_single_after'));
			add_action('wp_loaded',array($this,'wp_loaded'),100);
			add_action('boutique_blog_summary_after',array($this,'boutique_blog_summary_after'),100);
			add_shortcode('boutique_little_box',array($this,'boutique_little_box'));

			parent::start();



		}

		public function boutique_theme_files($files) {
			//$files[] = 'dtbaker.visual_composer.php';
			return $files;
		}

		public function boutique_blog_summary_after(){
			echo do_shortcode('[dtbaker_line type="bird"]');
		}


		public function wp_loaded(){
			// this hack allows our theme defaults to override the auto generated one earlier on in the hook cycle
			if(class_exists('boutique_featured_image_options')) {
				boutique_featured_image_options::$default_style = get_theme_mod( 'boutique_thumbnail_style',boutique_featured_image_options::$default_style );
			}

		}

		public function em_paginate($html){
			if(strpos($html,'<ul>') !== false)return $html;
			$html = preg_replace('#<a[^>]*>[^<]*</a>#imsU','<li>$0</li>',$html);
			$html = preg_replace('#<strong><span class="page-numbers current">([^<]*)</span></strong>#imsU','<li><span class="page-numbers current">$1</span></li>',$html);
			$html = preg_replace('#<span class="em-pagination"[^>]*>(.*)</span>#ims','<div class="boutique_pagination_wrap"><ul class="em-pagination">$1</ul></div>',$html);
			$html = preg_replace('#<li><a class="prev[^>]*>&lt;&lt;</a></li>#','',$html);
			$html = preg_replace('#<li><a class="next[^>]*>&gt;&gt;</a></li>#','',$html);
			$html = preg_replace('#(<a class="prev[^>]*>)([^<]*)</a>#','$1' . __('&larr; Back', 'boutique-kids') .'</a>',$html);
			$html = preg_replace('#(<a class="next[^>]*>)([^<]*)</a>#','$1' . __('Next &rarr;', 'boutique-kids') .'</a>',$html);
			return $html;
		}

		public function woocommerce_pagination_args($args){
			$args['prev_text'] = __('&larr; Back', 'boutique-kids');
			$args['next_text'] = __('Next &rarr;', 'boutique-kids');
			return $args;
		}

		public function dtbaker_icon_layouts($layouts){
			$layouts = array();
			$layouts[] = array('text'=>'Horizontal','value'=>'horizontal');
			$layouts[] = array('text'=>'Vertical','value'=>'vertical');
			$layouts[] = array('text'=>'Small Square','value'=>'square');
			return $layouts;
		}
		//$out = apply_filters( "shortcode_atts_{$shortcode}", $out, $pairs, $atts, $shortcode );

		public function shortcode_atts_dtbaker_banner($out, $pairs, $atts, $shortcode){
			$out['title'] = isset($atts['title']) ? $atts['title'] : '';
			$out['link'] = isset($atts['link']) ? $atts['link'] : '';
			return $out;
		}
		public function dtbaker_banner_field_options($field_options){
			unset($field_options['type']);
			unset($field_options['text']);
			$field_options['title'] = array(
				'name' => 'title',
				'type' => 'textbox',
				'label' => 'Banner Title'
			);
			$field_options['link'] = array(
				'name' => 'link',
				'type' => 'textbox',
				'label' => 'Button Text'
			);
			$field_options['innercontent'] = array(
				'name' => 'innercontent',
				'type' => 'textbox',
				'label' => 'Banner Text'
			);
			return $field_options;
		}

		public function dtbaker_line_layouts($layouts){
			$layouts = array();
			$layouts[] = array('text'=>'Heart','value'=>'heart');
			$layouts[] = array('text'=>'Bird','value'=>'bird');
			$layouts[] = array('text'=>'Circle Text','value'=>'circle');
			$layouts[] = array('text'=>'Rectangle Text','value'=>'rectangle');
			return $layouts;
		}

		public function boutique_little_box($args, $innercontent=''){
			ob_start();
			?>
			<div class="share-post-wrapper">
			<div class="share-post">
			<?php echo !empty($args['title']) ? '<div class="title">' . esc_html($args['title']).'</div>' : ''; ?>
			<?php echo do_shortcode(preg_replace('#<[^>]+>#','',$innercontent));?>
			</div>
			</div>
			<?php
			return ob_get_clean();
		}

		public function boutique_get_header_style() {
			return array(
				'background_color' => get_theme_mod( 'color_background_fancy_header', 'f8f4e9' ),
				'page_header_mode' => get_theme_mod( 'page_header_mode', '1' ),
			);
		}

		public function boutique_page_header_before() {
			if ( $style = $this->boutique_get_header_style() ) {
				if ( $style['page_header_mode'] == 2 ) {
					echo '<div class="boutique_page_header page_header_fancy" style="background-color:#'.esc_attr($style['background_color']).'">';
				} else {
					echo '<div class="boutique_page_header">';
				}
			}
		}

		public function boutique_page_header_after() {
			if ( $style = $this->boutique_get_header_style() ) {
				echo '<br class="clear"/>';
				if($style['page_header_mode'] == 2){
					echo '</div>';
				}else{
					if($style['page_header_mode'] == 1){
						echo do_shortcode('[dtbaker_line type="bird"]');
					}
					echo '</div>';
				}
			}
		}

		public function comment_form_defaults($defaults){
			$defaults['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>';
			return $defaults;
		}
		public function boutique_blog_single_after(){
			$template_file = locate_template('share-post.php');
			if ( $template_file && is_readable( $template_file ) ) {
				include $template_file;
			}
		}
		public function dtbaker_visual_column_styles($params){
			$params['column_styles'] = array();
			// we import the widget styles as well.
			$theme_settings = $this->get_theme_settings();
			if ( ! empty( $theme_settings['plugins']['dtbaker_visual_columns']['config']['column_styles'] ) ) {
				foreach($theme_settings['plugins']['dtbaker_visual_columns']['config']['column_styles'] as $key=>$val){
					$params['column_styles']['column_style '.$key] = $val;
				}
			}
			return $params;
		}
		public function dtbaker_insert_image_styles($styles){
			/*$styles = array();
			$styles['border2'] = __('Line Border');
			$styles['border1'] = __('Solid Border');*/
			return $styles;
		}

		public function boutique_blog_links($links){
			if( !is_single() && isset($links['date'])){
				unset($links['date']);
			}
			return $links;
		}

		public function boutique_blog_summary_inner_before(){
			?>
			<div class="blog_date">
				<span class="day"><?php echo get_the_date('j');?></span>
				<span class="month"><?php echo get_the_date('M');?></span>
				<span class="year"><?php echo get_the_date('Y');?></span>
			</div>
			<?php
		}

		public function setup_background() {
			// overload our background method from parent.
			$args = array(
				'default-color' => 'FFFFFF',
				'default-image' => '',
			);
			add_theme_support( 'custom-background', $args );
		}

		public function wp_enqueue_scripts(){
			wp_enqueue_script( 'boutique_flexslider', get_template_directory_uri() . '/flexslider/jquery.flexslider-min.js', array( 'jquery' ), _boutique_theme_version );
			wp_enqueue_style( 'boutique_flexslider', get_template_directory_uri() . '/flexslider/flexslider.css', array( ), _boutique_theme_version );

			parent::wp_enqueue_scripts();


		}
		public function body_class( $classes ) {
			$classes   = parent::body_class( $classes );
			$classes[] = 'boutique-menu-color-' . esc_attr( get_theme_mod( 'menu_color', 'brown' ) );
			$classes[] = 'boutique-border-color-' . esc_attr( get_theme_mod( 'border_color', 'blue' ) );

			return $classes;
		}

		public function setup_images() {
			parent::setup_images();
			add_image_size( 'boutique_gallery', 818, 400, true );
			add_image_size( 'boutique_large', 970 );
			add_image_size( 'boutique_blog-small', 187, 146, true );
			add_image_size( 'boutique_blog-large', 930 );
			add_image_size( 'boutique_gallery1', 160, 140, true);
			add_image_size( 'boutique_gallery2', 540, 350, true);
			set_post_thumbnail_size( 187, 146, true );
		}

		public function dtbaker_google_map_styles($styles){

			return array();


		}
	}

	require_once get_template_directory().'/plugins/envato_setup/envato_setup_init.php';



	if ( is_readable( get_template_directory() . '/shortcodes/fancy_border.php' ) ) {
		include_once( get_template_directory() . '/shortcodes/fancy_border.php' );
	}
	if ( is_readable( get_template_directory() . '/shortcodes/fancy_posts.php' ) ) {
		include_once( get_template_directory() . '/shortcodes/fancy_posts.php' );
	}


	boutiqueThemeManager_custom::get_instance()->start();
}


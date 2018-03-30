<?php if(! defined('ABSPATH')) { return; }
/**
 * Custom Classes
 *
 * @package  Kallyas
 * @category Custom Classes
 * @author Team Hogash
 * @since 3.8.0
 */

if(! class_exists('WpkZn'))
{
	/**
	 * Class WpkZn
	 *
	 * @category Custom Classes
	 * @author Team Hogash
	 */
	class WpkZn
	{

		/**
		 * Retrieve all sidebars from the theme.
		 * @since 4.0.0
		 * @return array
		 */
		public static function getThemeSidebars(){
			$sidebars = array ();
			$sidebars['defaultsidebar'] = __( 'Default Sidebar', 'zn_framework' );
			if ( $unlimited_sidebars = zget_option( 'unlimited_sidebars', 'unlimited_sidebars' ) ) {
				foreach ( $unlimited_sidebars as $sidebar ) {
					if (isset($sidebar['sidebar_name']) && !empty($sidebar['sidebar_name'])) {
						$sidebars[ $sidebar['sidebar_name'] ] = $sidebar['sidebar_name'];
					}
				}
			}
			return $sidebars;
		}

		/**
		 * Retrieve all headers from the theme.
		 * @since 4.0.0
		 * @return array
		 */
		public static function getThemeHeaders( $addnone = false ){

			$headers = array ();
			if($addnone == true){
				$headers[0] = 'None';
			}
			$headers['zn_def_header_style'] = __( 'Default style', 'zn_framework' );
			$saved_headers = zget_option( 'header_generator', 'unlimited_header_options', false, array() );
			foreach ( $saved_headers as $header ) {
				if ( isset ( $header['uh_style_name'] ) && ! empty ( $header['uh_style_name'] ) ) {
					$header_name             = strtolower( str_replace( ' ', '_', $header['uh_style_name'] ) );
					$header_name             = sanitize_html_class( $header_name );
					$headers[ $header_name ] = $header['uh_style_name'];
				}
			}

			return $headers;
		}

		/**
		 * Retrieve all blog categories as an associative array: id => name
		 * @since 4.0.0
		 * @return array
		 */
		public static function getBlogCategories(){
			$args = array (
				'type'         => 'post',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'id',
				'order'        => 'ASC',
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'taxonomy'     => 'category',
				'pad_counts'   => false
			);
			$blog_categories = get_categories( $args );

			$categories = array ();
			foreach ( $blog_categories as $category ) {
				$categories[ $category->cat_ID ] = $category->cat_name;
			}
			return $categories;
		}

		/**
		 * Retrieve all shop categories as an associative array: id => name
		 * @requires plugin WooCommerce installed and active
		 * @since 4.0.0
		 * @return array
		 */
		public static function getShopCategories(){
			$args = array (
				'type'         => 'shop',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'id',
				'order'        => 'ASC',
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'taxonomy'     => 'product_cat',
				'pad_counts'   => false
			);

			$shop_categories = get_categories( $args );

			$categories = array ();
			if ( ! empty( $shop_categories ) ) {
				foreach ( $shop_categories as $category ) {
					if ( isset( $category->cat_ID ) && isset( $category->cat_name ) ) {
						$categories[ $category->cat_ID ] = $category->cat_name;
					}
				}
			}
			return $categories;
		}

		/**
		 * @wpk
		 * Retrieve all product tags
		 * @since v4.1
		 * @return array
		 */
		public static function getShopTags(){
			$terms = get_terms( 'product_tag', array(
				'orderby' => 'name',
				'order' => 'ASC',
				'hide_empty' => false,
			) );
			if(! $terms || is_wp_error($terms)){
				return array();
			}
			$temp = array();
			foreach($terms as $tag){
				$temp[$tag->term_id] = esc_attr($tag->name);
			}
			return $temp;
		}



		/**
		 * Retrieve the list of all Portfolio Categories
		 * @since 4.0.0
		 * @return array
		 */
		public static function getPortfolioCategories(){
			$args = array (
				'type'         => 'portfolio',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'id',
				'order'        => 'ASC',
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'taxonomy'     => 'project_category',
				'pad_counts'   => false
			);
			$port_categories = get_categories( $args );
			$categories = array ();
			if ( ! empty( $port_categories ) ) {
				foreach ( $port_categories as $category ) {
					if ( isset( $category->cat_ID ) && isset( $category->cat_name ) ) {
						$categories[ $category->cat_ID ] = $category->cat_name;
					}
				}
			}
			return $categories;
		}

		/**
		 * Retrieve the list of tags (as links) for the specified post
		 * @param int $postID
		 * @param string $sep The separator
		 * @return string
		 */
		public static function getPostTags($postID, $sep = '')
		{
			$out = '';
			$tagsArray = array();
			$tags = wp_get_post_tags($postID, array('orderby' => 'name', 'order' => 'ASC'));
			if(empty($tags)){
				return $out;
			}
			foreach($tags as $tag){
				$tagsArray[$tag->name] = get_tag_link($tag->term_id);
			}
			foreach($tagsArray as $name => $link){
				$out .= '<a class="kl-blog-tag" href="'.$link.'" rel="tag">'.$name.'</a>';
				if(! empty($sep)){
					$out .= $sep;
				}
			}
			$out = rtrim($out, $sep);
			return $out;
		}
	}

}



if(! class_exists('WpkPageHelper')) {
	/**
	 * Class WpkPageHelper
	 *
	 * Helper class to manage various aspects from pages
	 *
	 * @package  Kallyas
	 * @category UI
	 * @author   Team Hogash
	 * @since    4.0.0
	 */
	class WpkPageHelper
	{

		/**
		 * Display the proper sub-header based on the provided arguments
		 *
		 * @param array $args The list of arguments
		 */
		public static function zn_get_subheader( $args = array(), $is_pb_element = false )
		{

			$config = zn_get_pb_template_config();
			if( $config['template'] !== 'no_template' && ! $is_pb_element ){
				// We have a subheader template... let's get it's possition
				$pb_data = get_post_meta( $config['template'], 'zn_page_builder_els', true );

				if( $config['location'] == 'before' ){
					ZNPB()->zn_render_uneditable_content( $pb_data, $config['template'] );
					self::render_sub_header( $args );
				}
				elseif( $config['location'] == 'replace' ){
					ZNPB()->zn_render_uneditable_content( $pb_data, $config['template'] );
				}
				elseif( $config['location'] == 'after' ){
					self::render_sub_header( $args );
					ZNPB()->zn_render_uneditable_content( $pb_data, $config['template'] );
				}
			}
			else{
				self::render_sub_header( $args );
			}

		}

		public static function render_sub_header( $args = array() ){
			$id = zn_get_the_id();

			// Breadcrumb / Date
			$default_bread = zget_option( 'def_header_bread', 'general_options', false, 1 );
			$default_date = zget_option( 'def_header_date', 'general_options', false, 1 );

			// Title / Subtitle
			$show_title = zget_option( 'def_header_title', 'general_options', false, 1 );
			$show_subtitle = zget_option( 'def_header_subtitle', 'general_options', false, true );

			$def_subheader_alignment = zget_option( 'def_subheader_alignment', 'general_options', false, 'right' );
			$def_subheader_textcolor = zget_option( 'def_subh_textcolor', 'general_options', false, 'light' );

			$defaults = array(
				'headerClass' => 'zn_def_header_style',
				'title' => get_the_title( $id ),
				'layout' => zget_option( 'zn_disable_subheader', 'general_options' ),
				'def_header_bread' => $default_bread,
				'def_header_date' => $default_date,
				'def_header_title' => $show_title,
				'show_subtitle' => $show_subtitle,
				'extra_css_class' => '',
				'bottommask' => zget_option( 'def_bottom_style', 'general_options', false, 'none' ),
				'bottommask_bg' => '',
				'bg_source' => '',
				'is_element' => false,
				'inherit_head_pad' => true,
				'subheader_alignment' => $def_subheader_alignment,
				'subheader_textcolor' => $def_subheader_textcolor,
				'title_tag' => 'h2',
				'subtitle_tag' => 'h4'
		   );

			$saved_headers = zget_option( 'header_generator', 'unlimited_header_options', false, array() );

			// Combine defaults with the options saved in post meta
			if ( is_singular() ) {
			// if ( is_singular() || is_home() || is_shop() ) {
				$post_defaults = array();
				$title_bar_layout = get_post_meta( $id, 'zn_zn_disable_subheader', true );

				//@wpk: empty means Default - Set from theme options
				if(empty($title_bar_layout)){
					// "no" means show subheader
					if('no' == ($state = zget_option( 'zn_disable_subheader', 'general_options' ))){
						$post_defaults = array(
							'layout' => $state,
							'subtitle' => get_post_meta( $id, 'zn_page_subtitle', true ),
						);
						$saved_title = get_post_meta( $id, 'zn_page_title', true );
						if ( !empty( $saved_title ) ) {
							$post_defaults['title'] = $saved_title;
						}
					}
				}
				else {
					$post_defaults = array(
						'layout' => $title_bar_layout,
						'subtitle' => get_post_meta( $id, 'zn_page_subtitle', true ),
					);
					$saved_title = get_post_meta( $id, 'zn_page_title', true );
					if ( !empty( $saved_title ) ) {
						$post_defaults['title'] = $saved_title;
					}
				}

				// Sub-header style
				$zn_subheader_style = get_post_meta( $id, 'zn_subheader_style', true );
				if ( !empty( $zn_subheader_style ) ) {
					$post_defaults['headerClass'] = 'uh_' . $zn_subheader_style;
				}

				// Get Subheader settings from Unlimited Subheader style
				foreach ( $saved_headers as $header ) {
					if ( isset ( $header['uh_style_name'] ) && ! empty ( $header['uh_style_name'] ) ) {
						$header_name = strtolower( str_replace( ' ', '_', $header['uh_style_name'] ) );
						if($zn_subheader_style == $header_name){
							// Bottom Mask
							$defaults['bottommask'] = $header['uh_bottom_style'];
							// Text Color
							if(isset($header['uh_textcolor'])){
								$defaults['subheader_textcolor'] = $header['uh_textcolor'];
							}
						}
					}
				}

				$defaults = wp_parse_args( $post_defaults, $defaults );
			}
			elseif ( is_tax() || is_category() ) {
				global $wp_query;
				$cat = $wp_query->get_queried_object();
				if ( $cat && isset( $cat->term_id ) ) {
					$id = $cat->term_id;
					$ch = get_option( 'wpk_zn_select_custom_header_' . $id, false );
					if ( !empty( $ch ) ) {

						if ( 'zn_def_header_style' != $ch ) {
							$defaults['headerClass'] = 'uh_' . $ch;
						}

						// Get Subheader settings from Unlimited Subheader style
						foreach ( $saved_headers as $header ) {
							if ( isset ( $header['uh_style_name'] ) && ! empty ( $header['uh_style_name'] ) ) {
								$header_name = strtolower( str_replace( ' ', '_', $header['uh_style_name'] ) );
								if($ch == $header_name){
									// Bottom Mask
									$defaults['bottommask'] = $header['uh_bottom_style'];
									// Text Color
									if(isset($header['uh_textcolor'])){
										$defaults['subheader_textcolor'] = $header['uh_textcolor'];
									}
								}
							}
						}

					}
				}
			}
			else{
				// Check if we havea custom header for the blog
				if(is_home()){
					$blog_header = zget_option( 'blog_sub_header', 'blog_options', false, 'zn_def_header_style' );
					if( $blog_header !== 'zn_def_header_style'){
						$defaults['headerClass'] = 'uh_' .$blog_header;
					}
				}
			}
			$args = wp_parse_args( $args, $defaults );
			$args = apply_filters( 'zn_sub_header', $args );

			// If the subheader shouldn't be shown
			if ( $args['layout'] == 'yes' ) {
				return;
			}

			// Get title/subtitle's tag
			$title_heading = apply_filters('zn_subheader_title_tag', $args['title_tag']);
			$subtitle_tag = apply_filters('zn_subheader_subtitle_tag', $args['subtitle_tag']);

			// Breadcrumb / Date defaults
			$args_def_header_bread = $args['def_header_bread'] != '' ? $args['def_header_bread'] : $default_bread;
			$args_def_header_date = $args['def_header_date'] != '' ? $args['def_header_date'] : $default_date;
			// Check for Breadcrumbs or Date
			$br_date = $args_def_header_bread || $args_def_header_date;

			// Compose Classes array
			$extra_classes = array();

			$bottom_mask = $args['bottommask'];
			if ( $bottom_mask != 'none' ) {
				$extra_classes[] = 'maskcontainer--' . $bottom_mask;
			}

			$is_element = $args['is_element'];
			if ( $is_element ) {
				$extra_classes[] = 'page-subheader--custom';
			}
			else {
				$extra_classes[] = 'page-subheader--auto';
			}

			// Inherit heading & padding from Unlimited Subheader styles
			// Enabled by default for autogenerated pages and via option in Custom Subheader Element
			$inherit_head_pad = $args['inherit_head_pad'];
			if ( $inherit_head_pad ) {
				$extra_classes[] = 'page-subheader--inherit-hp';
			}

			$extra_classes[] = $args['headerClass'];
			$extra_classes[] = $args['extra_css_class'];

			// Get Site Header's Position (relative | absolute)
			$header_pos = 'psubhead-stheader--absolute';
			$headerLayoutStyle = zn_get_header_layout();
			if ( zget_option( 'head_position', 'general_options', false, '1' ) != 1 ) {
				if ( $headerLayoutStyle != 'style7' ) {
					$header_pos = 'psubhead-stheader--relative';
				}
			}
			$extra_classes[] = $header_pos;

			// Subheader Alignment
			if(!$br_date){
				$extra_classes[] = 'sh-titles--' . ($args['subheader_alignment'] != '' ? $args['subheader_alignment'] : $def_subheader_alignment);
			}

			// Subheader Text color scheme
			$extra_classes[] = 'sh-tcolor--' . ($args['subheader_textcolor'] != '' ? $args['subheader_textcolor'] : $def_subheader_textcolor);

			// Get markup
			include(locate_template('components/theme-subheader/subheader-default.php'));
		}

		/**
		 * Display the custom bottom mask markup
		 *
		 * @param  [type] $bm The mask ID
		 *
		 * @return [type]     HTML Markup to be used as mask
		 */
		public static function zn_bottommask_markup( $bm, $bgcolor = false ) {}

		/**
		 * Display the custom bottom mask markup
		 *
		 * @param  [type] $bm The mask ID
		 *
		 * @return [type]     HTML Markup to be used as mask
		 */
		public static function zn_background_source( $args = array() )
		{
			$defaults = array(
				'uid' => '',
				'source_type' => '',
				'source_background_image' => array(
					'image' => '',
					'repeat' => 'repeat',
					'attachment' => 'scroll',
					'position' => array(
						'x' => 'left',
						'y' => 'top'
					),
					'size' => 'auto',
				),
				'source_vd_yt' => '',
				'source_vd_vm' => '',
				'source_vd_self_mp4' => '',
				'source_vd_self_ogg' => '',
				'source_vd_self_webm' => '',
				'source_vd_embed_iframe' => '',
				'source_vd_vp' => '',
				'source_vd_autoplay' => 'yes',
				'source_vd_loop' => 'yes',
				'source_vd_muted' => 'yes',
				'source_vd_controls' => 'yes',
				'source_vd_controls_pos' => 'bottom-right',
				'source_overlay' => 0,
				'source_overlay_color' => '',
				'source_overlay_opacity' => '100',
				'source_overlay_color_gradient' => '',
				'source_overlay_color_gradient_opac' => '100',
				'source_overlay_gloss' => '',
				'source_overlay_custom_css' => '',
				'enable_parallax' => '',
				'mobile_play' => 'no',
			);

			$args = wp_parse_args( $args, $defaults );
			$bg_source = '';
			$sourceType = $args['source_type'];
			$parallax = $sourceType && $args['enable_parallax'] == 'yes' && !ZNPB()->is_active_editor;
			$bg_container_class='';

			if ( $sourceType ):

				if ( $parallax ) {
					$bg_container_class = 'znParallax-background';
				}
				// IMAGE
				if ( $sourceType == 'image' ) {
					$background_styles = array();
					$background_image = $args['source_background_image']['image'];
					$background_styles[] = 'background-image:url(' . $args['source_background_image']['image'] . ')';
					$background_styles[] = 'background-repeat:' . $args['source_background_image']['repeat'];
					$background_styles[] = 'background-attachment:' . $args['source_background_image']['attachment'];
					$background_styles[] = 'background-position:' . $args['source_background_image']['position']['x'] . ' ' . $args['source_background_image']['position']['y'];
					$background_styles[] = 'background-size:' . $args['source_background_image']['size'];

					if ( !empty( $background_image ) ) {
						if ( $parallax ) {
							$bg_source .= '<img class="kl-bg-source__bgimage" src="' . $args['source_background_image']['image'] . '">';
						}
						else{
							$bg_source .= '<div class="kl-bg-source__bgimage" style="' . implode( ';', $background_styles ) . '"></div>';
						}
					}
				}
				// SELF HOSTED // YOUTUBE // VIMEO
				else if ( $sourceType == 'video_self' || $sourceType == 'video_youtube' || $sourceType == 'video_vimeo' ) {

					$args['video_overlay'] = 1;

					$bg_source .= self::zn_klvideo($args);

				}
				// IFRAME
				else if ( $sourceType == 'embed_iframe' ) {
					$source_vd_embed_iframe = $args['source_vd_embed_iframe'];
					$source_vd_vp = $args['source_vd_vp'];

					if ( !empty( $source_vd_embed_iframe ) ) {
						$video_attributes = array(
							'loop' => $args['source_vd_loop'] == 'yes' ? 1 : 0,
							'autoplay' => $args['source_vd_autoplay'] == 'yes' ? 1 : 0
						);
						// Source Video
						$bg_source .= '<div class="kl-bg-source__iframe-wrapper">';
						$bg_source .= '<div class="kl-bg-source__iframe iframe-valign iframe-halign">';
						$bg_source .= get_video_from_link( $source_vd_embed_iframe, 'no-adjust', '100%', null, $video_attributes );
						if(!empty($source_vd_vp)) {
							$bg_source .= '<div style="background-image:url('.$source_vd_vp.');" class="kl-bg-source__iframe-poster"></div>';
						}
						$bg_source .= '</div>';
						$bg_source .= '</div>';
					}
				}
			endif;

			// Overlays
			$bg_overlay = '';
			if ( $args['source_overlay'] != 0 ) {
				$overlay_color = $args['source_overlay_color'];
				$overlay_color_final = $overlay_color;

				// backwards compatibility, check if has separate opacity
				if(strpos($overlay_color, 'rgba') === false ){
					$overlay_opac = $args['source_overlay_opacity'];
					$overlay_color_final = zn_hex2rgba_str( $overlay_color, $overlay_opac );
				}

				$ovstyle = 'background-color:' . $overlay_color_final;
				// Gradient
				if ( $args['source_overlay'] == 2 || $args['source_overlay'] == 3 ) {

					$gr_overlay_color = $args['source_overlay_color_gradient'];
					$gr_overlay_color_final = $gr_overlay_color;

					// backwards compatibility, check if has separate opacity
					if(strpos($gr_overlay_color, 'rgba') === false ){
						$overlay_gr_opac = $args['source_overlay_color_gradient_opac'];
						$gr_overlay_color_final = zn_hex2rgba_str( $gr_overlay_color, $overlay_gr_opac );
					}

					// Gradient Horizontal
					if ( $args['source_overlay'] == 2 ) {
						$ovstyle = 'background:' . $overlay_color_final . '; background: -moz-linear-gradient(left, ' .
								   $overlay_color_final . ' 0%, ' . $gr_overlay_color_final .
								   ' 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,' .
								   $overlay_color_final . '), color-stop(100%,' . $gr_overlay_color_final .
								   ')); background: -webkit-linear-gradient(left, ' . $overlay_color_final . ' 0%,' .
								   $gr_overlay_color_final . ' 100%); background: -o-linear-gradient(left, ' .
								   $overlay_color_final . ' 0%,' . $gr_overlay_color_final .
								   ' 100%); background: -ms-linear-gradient(left, ' . $overlay_color_final . ' 0%,' .
								   $gr_overlay_color_final . ' 100%); background: linear-gradient(to right, ' .
								   $overlay_color_final . ' 0%,' . $gr_overlay_color_final . ' 100%); ';
					}
					// Gradient Vertical
					if ( $args['source_overlay'] == 3 ) {
						$ovstyle = 'background: ' . $overlay_color_final . '; background: -moz-linear-gradient(top,  ' .
								   $overlay_color_final . ' 0%, ' . $gr_overlay_color_final .
								   ' 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' .
								   $overlay_color_final . '), color-stop(100%,' . $gr_overlay_color_final .
								   ')); background: -webkit-linear-gradient(top,  ' . $overlay_color_final . ' 0%,' .
								   $gr_overlay_color_final . ' 100%); background: -o-linear-gradient(top,  ' .
								   $overlay_color_final . ' 0%,' . $gr_overlay_color_final .
								   ' 100%); background: -ms-linear-gradient(top,  ' . $overlay_color_final . ' 0%,' .
								   $gr_overlay_color_final . ' 100%); background: linear-gradient(to bottom,  ' .
								   $overlay_color_final . ' 0%,' . $gr_overlay_color_final . ' 100%); ';
					}

				}

				// Custom CSS Gradient
				elseif ( $args['source_overlay'] == 4 ) {
					$custom_css_ov = $args['source_overlay_custom_css'];
					$custom_css_ov = preg_replace('!/\*.*?\*/!s', '', $custom_css_ov);
					$custom_css_ov = preg_replace('/\n\s*\n/', "", $custom_css_ov);
					$ovstyle = esc_attr($custom_css_ov);
				}

				$extraclass = '';
				if(isset($args['uid']) && !empty($args['uid']) ){
					$extraclass = 'ov-'.$args['uid'];
				}
				$bg_overlay .= '<div class="kl-bg-source__overlay '.$extraclass.'" style="' . $ovstyle . '"></div>';

			}
			// Gloss Overlays
			if ( $args['source_overlay_gloss'] == 1 ) {
				$bg_overlay .= '<div class="kl-bg-source__overlay-gloss"></div>';
			}
			if ( $bg_source != '' || $bg_overlay != '' ) {
				echo '<div class="kl-bg-source '.$bg_container_class.'">';

				if($parallax){
					echo '<div class="kl-bg-source__parallaxWrapper">';
				}

				echo $bg_source;

				if($parallax){
					echo '</div>';
				}

				echo $bg_overlay;

				echo '</div>';
			}

			// Display mobile play video button
			if($args['mobile_play'] == 'yes'){

				$mp_video = '';

				if($sourceType == 'embed_iframe'){
					$mp_video = $args['source_vd_embed_iframe'];
				}
				elseif($sourceType == 'video_youtube'){
					$mp_video = 'https://www.youtube.com/watch?v='.$args['source_vd_yt'];
				}
				elseif($sourceType == 'video_vimeo'){
					$mp_video = 'https://www.vimeo.com/'.$args['source_vd_vm'];
				}
				if(!empty($mp_video)){
					echo '<a data-lightbox="iframe" href="'.$mp_video.'" class="bg-video-mobile-modal visible-xs visible-sm" data-text="'. __('PLAY VIDEO', 'zn_framework') .'"><i class="glyphicon glyphicon-play"></i></a>';
				}
			}

		}

		/**
		 * Generate markup for videos
		 * @param  array  $args [description]
		 * @return [type]       [description]
		 */
		public static function zn_klvideo( $args = array() )
		{
			$defaults = array(
				'wrapper_class' => '',
				'source_type' => '',
				'source_vd_yt' => '',
				'source_vd_vm' => '',
				'source_vd_self_mp4' => '',
				'source_vd_self_ogg' => '',
				'source_vd_self_webm' => '',
				'source_vd_vp' => '',
				'source_vd_autoplay' => 'yes',
				'source_vd_loop' => 'yes',
				'source_vd_muted' => 'yes',
				'source_vd_controls' => 'yes',
				'source_vd_controls_pos' => 'bottom-right',
				'mobile_play' => 'no',
				'video_overlay' => 0,
			);

			$args = wp_parse_args( $args, $defaults );

			echo '<div class="kl-video-container '.$args['wrapper_class'].'">';

				$video_options = array(
					"video_ratio" 		=> "1.7778",
					"loop" 				=> $args['source_vd_loop'] == 'yes' ? 'true' : 'false',
					"autoplay"			=> $args['source_vd_autoplay'] == 'yes' ? 'true' : 'false',
					"muted"				=> $args['source_vd_muted'] == 'yes' ? 'true' : 'false',
					"controls"			=> $args['source_vd_controls'] == 'yes' ? 'true' : 'false',
					"controls_position"	=> $args['source_vd_controls_pos'],
					"mobile_play" 		=> $args['mobile_play'],
					"fallback_image" 	=> $args['source_vd_vp'],
					"video_overlay" 	=> $args['video_overlay'],
					// 'sizing' => 'fill',
					// 'start' => '0',
				);

				if($args['source_type'] == 'video_self'){
					if($args['source_vd_self_mp4']) 	$video_options['mp4'] = $args['source_vd_self_mp4'];
					if($args['source_vd_self_webm']) 	$video_options['webm'] = $args['source_vd_self_webm'];
					if($args['source_vd_self_ogg']) 	$video_options['ogg'] = $args['source_vd_self_ogg'];
				}

				if($args['source_type'] == 'video_youtube'){
					if($args['source_vd_yt'])
						$video_options['youtube'] = $args['source_vd_yt'];
				}

				if($args['source_type'] == 'video_vimeo'){
					if($args['source_vd_vm'])
						$video_options['vimeo'] = $args['source_vd_vm'];
				}

				echo '<div class="kl-video kl-video--valign kl-video--halign" data-setup=\''.json_encode($video_options).'\' '.WpkPageHelper::zn_schema_markup('video').'></div>';
			echo '</div>';

		}


		/**
		 * Schema.org additions
		 * @param 	string 	Type of the element
		 * @return  string  HTML Attribute
		 */

		public static function zn_schema_markup($type, $echo = false) {

		    if (empty($type)) return false;

			$disable = apply_filters('zn_schema_markup_disable', false);

			if($disable == true) return;

		    $attributes = '';
		    $attr = array();

		    switch ($type) {
		        case 'body':
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/WebPage';
		            break;

		        case 'header':
		            $attr['role'] = 'banner';
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/WPHeader';
		            break;

		        case 'nav':
		            $attr['role'] = 'navigation';
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/SiteNavigationElement';
		            break;

		        case 'title':
		            $attr['itemprop'] = 'headline';
		            break;

		        case 'subtitle':
		            $attr['itemprop'] = 'alternativeHeadline';
		            break;

		        case 'sidebar':
		            $attr['role'] = 'complementary';
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/WPSideBar';
		            break;

		        case 'footer':
		            $attr['role'] = 'contentinfo';
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/WPFooter';
		            break;

		        case 'main':
		            $attr['role'] = 'main';
		            $attr['itemprop'] = 'mainContentOfPage';
		            if (is_search()) {
		                $attr['itemtype'] = 'https://schema.org/SearchResultsPage';
		            }

		            break;

		        case 'author':
		            $attr['itemprop'] = 'author';
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/Person';
		            break;

		        case 'person':
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/Person';
		            break;

		        case 'comment':
		            $attr['itemprop'] = 'comment';
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/UserComments';
		            break;

		        case 'comment_author':
		            $attr['itemprop'] = 'creator';
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/Person';
		            break;

		        case 'comment_author_link':
		            $attr['itemprop'] = 'creator';
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/Person';
		            $attr['rel'] = 'external nofollow';
		            break;

		        case 'comment_time':
		            $attr['itemprop'] = 'commentTime';
		            $attr['itemscope'] = 'itemscope';
		            $attr['datetime'] = get_the_time('c');
		            break;

		        case 'comment_text':
		            $attr['itemprop'] = 'commentText';
		            break;

		        case 'author_box':
		            $attr['itemprop'] = 'author';
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/Person';
		            break;

		        case 'video':
		            $attr['itemprop'] = 'video';
		            $attr['itemtype'] = 'https://schema.org/VideoObject';
		            break;

		        case 'audio':
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/AudioObject';
		            break;

		        case 'blog':
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/Blog';
		            break;

		        case 'blogpost':
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/Blog';
		            break;

		        case 'name':
		            $attr['itemprop'] = 'name';
		            break;

		        case 'url':
		            $attr['itemprop'] = 'url';
		            break;

		        case 'email':
		            $attr['itemprop'] = 'email';
		            break;

		        case 'post_time':
		            $attr['itemprop'] = 'datePublished';
		            break;

		        case 'post_content':
		            $attr['itemprop'] = 'text';
		            break;

		        case 'creative_work':
		            $attr['itemscope'] = 'itemscope';
		            $attr['itemtype'] = 'https://schema.org/CreativeWork';
		            break;
		    }

		    foreach ($attr as $key => $value) {
		        $attributes.= $key . '="' . $value . '" ';
		    }

		    if ($echo) {
		        echo $attributes;
		    }
		    else {
		        return $attributes;
		    }
		}


		/**
		 * Display the page header for Documentation pages
		 * Will be removed in 4.1
		 *
		 * @internal
		 * @deprecated 4.0.11
		 */
		public static function zn_get_documentation_header(){}

		/**
		 * Display the site header
		 * Will be removed in 4.1
		 *
		 * @since 4.0
		 * @deprecated 4.0.10
		 */
		public static function displaySiteHeader(){}
	}
}

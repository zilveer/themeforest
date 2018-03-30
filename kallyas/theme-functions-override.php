<?php if(! defined('ABSPATH')){ return; }
/**
 * All functions in this file can be overridden in a child theme.
 * This file is loaded in functions.php
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */

/**
 * Load custom functions after the theme loads
 */
if ( ! function_exists( 'wpk_zn_on_init' ) ) {
	/**
	 * Load custom functions after the theme loads
	 * @hooked to after_setup_theme
	 * @see functions.php
	 */
	function wpk_zn_on_init(){

		// LOAD WOOCOMMERCE CONFIG FILE
		if ( znfw_is_woocommerce_active() ) {
			locate_template( array ( 'woocommerce/zn-woocommerce-init.php' ), true, false );
		}

		// Check Sensei plugin
		if ( class_exists( 'WooThemes_Sensei' ) ){
			include( THEME_BASE . '/template_helpers/vendors/sensei/functions-sensei.php' );
		}

		// Load generic vendors
		include( THEME_BASE . '/template_helpers/vendors/general/general-vendor.php' );

		// Check Geo Directory plugin
		if ( !is_admin() && defined( 'GEODIRECTORY_PLUGIN_DIR' ) ){
			include( THEME_BASE . '/template_helpers/vendors/geo-directory/functions-geo-directory.php' );
		}

		// Check PostLoveHgFrontend plugin
		if ( class_exists( 'PostLoveHgFrontend' ) ){
			include( THEME_BASE . '/template_helpers/vendors/hogash-post-love/config.php' );
		}

	}
}

/**
 * Add theme support
 */
if ( ! function_exists( 'wpk_zn_on_after_setup_theme' ) ) {
	/**
	 * Add theme support
	 *
	 * @hooked to after_setup_theme
	 * @see functions.php
	 */
	function wpk_zn_on_after_setup_theme(){
		load_theme_textdomain( 'zn_framework', THEME_BASE . '/languages' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'nav-menus' );
		add_theme_support( 'title-tag' );

		/* Add post formats
		 *  @since v4.0.12
		 *  , 'gallery'
		 */
		add_theme_support( 'post-formats', array( 'video', 'quote', 'audio', 'link', 'gallery' ) );

		// Add image sizes
		set_post_thumbnail_size( 280, 187 );
		add_image_size( 'full-width-image', 1170 );

		add_theme_support( 'post-thumbnails' );
		add_image_size( 'lp_bi_image', 750, 350, true );


	}
}

/**
 * Shortcodes fixer
 */
if ( ! function_exists( 'shortcode_empty_paragraph_fix' ) ) {
	/**
	 * Shortcodes fixer
	 *
	 * @param $content
	 * @hooked to the_content
	 * @see functions.php
	 * @return string
	 */
	function shortcode_empty_paragraph_fix( $content ){
		$array = array ('<p>[' => '[', ']</p>' => ']', ']<br />' => ']');
		return $content = strtr( $content, $array );
	}
}

/**
 * Check if we are on the taxonomy archive page. We will display all items if it is selected
 */
if ( ! function_exists( 'zn_portfolio_taxonomy_pagination' ) ) {
	/**
	 * Check if we are on the taxonomy archive page. We will display all items if it is selected
	 * @param $query
	 * @hooked to pre_get_posts
	 * @see functions.php
	 */
	function zn_portfolio_taxonomy_pagination( $query ){

		$portfolio_style = zget_option( 'portfolio_style', 'portfolio_options', false, 'portfolio_sortable' );
		$portfolio_per_page_show = zget_option( 'portfolio_per_page_show', 'portfolio_options', false, '4' );
		$load_more = zget_option( 'ptf_sort_loadmore', 'portfolio_options', false, 'no' );

		if ( ( is_tax( 'project_category' ) || is_post_type_archive( 'portfolio' ) ) && $query->is_main_query() ) {
			if( $portfolio_style === 'portfolio_sortable' && $load_more !== 'yes' ){
				set_query_var( 'posts_per_page', '-1' );
			}
			else{
				set_query_var( 'posts_per_page', $portfolio_per_page_show );
			}

		}

	}
}

/**
 * Calculate proper layout size
 */
if ( ! function_exists( 'zn_get_size' ) ) {
	/**
	 * Calculate proper layout size
	 * @param      $size
	 * @param null $sidebar
	 * @param int  $extra
	 * @return array
	 */
	function zn_get_size( $size, $sidebar = null, $extra = 0 ){

		$new_size = array ();

		$span_sizes = array (
			"four"               => "col-sm-3",
			"one-third"          => "col-sm-4",
			"span5"              => "col-sm-5",
			"eight"              => "col-sm-6",

			// wpk - custom sizes
			// @see: image Box 2
			"span7" => 'col-sm-7',
			"span10" => 'col-sm-10',
			"span11" => 'col-sm-11',

			"two-thirds"         => "col-sm-8",
			"twelve"             => "col-sm-9",
			"sixteen"            => "col-sm-12",
			"portfolio_sortable" => 'portfolio_sortable',

			'span3'  => 'col-sm-3',
			'span4'  => 'col-sm-4',
			'span6'  => 'col-sm-6',
			'span8'  => 'col-sm-8',
			'span9'  => 'col-sm-9',
			'span11' => 'col-sm-11',
			'span12' => 'col-sm-12',

		);

		// Image sizes for: 1170 LAYOUT
		$zn_width = zget_option( 'zn_width', 'layout_options', false, '1170' );
		if ( $zn_width == '1170' ) {

			$image_width = array (
				"four"               => 270, // col-sm-3
				"one-third"          => 370, // col-sm-4
				"span5"              => 470, // col-sm-5
				"eight"              => 570, // col-sm-6
				"two-thirds"         => 770, // col-sm-8
				"twelve"             => 870, // col-sm-9
				"sixteen"            => 1170, // col-sm-12
				"span2"              => 170, // col-sm-2
				"span3"              => 270, // col-sm-3
				"span4"              => 370, // col-sm-4
				"span6"              => 570, // col-sm-6
				"span7"              => 670, // col-sm-7
				"span8"              => 770, // col-sm-8
				"span9"              => 870, // col-sm-9
				"span10"             => 970, // col-sm-10
				"span11"             => 1070, // col-sm-11
				"span12"             => 1170, // col-sm-12
				"portfolio_sortable" => 260   // col-sm-*?
			);
		}
		elseif( $zn_width == 'custom'){

			$zn_custom_width = (int)zget_option( 'custom_width' , 'layout_options', false, '1170' );

			$gutter_size = 15*2;
			$onecol = ($zn_custom_width / 12);

			$image_width = array (
				"four"               => ((($onecol * 3) - $gutter_size)+$extra), // col-sm-3
				"one-third"          => ((($onecol * 4) - $gutter_size)+$extra), // col-sm-4
				"span5"              => ((($onecol * 5) - $gutter_size)+$extra), // col-sm-5
				"eight"              => ((($onecol * 6) - $gutter_size)+$extra), // col-sm-6
				"two-thirds"         => ((($onecol * 8) - $gutter_size)+$extra), // col-sm-8
				"twelve"             => ((($onecol * 9) - $gutter_size)+$extra), // col-sm-9
				"sixteen"            => ((($onecol * 12) - $gutter_size)+$extra), // col-sm-12
				"span2"              => ((($onecol * 2) - $gutter_size)+$extra), // col-sm-2
				"span3"              => ((($onecol * 3) - $gutter_size)+$extra), // col-sm-3
				"span4"              => ((($onecol * 4) - $gutter_size)+$extra), // col-sm-4
				"span6"              => ((($onecol * 6) - $gutter_size)+$extra), // col-sm-6
				"span7"              => ((($onecol * 7) - $gutter_size)+$extra), // col-sm-7
				"span8"              => ((($onecol * 8) - $gutter_size)+$extra), // col-sm-8
				"span9"              => ((($onecol * 9) - $gutter_size)+$extra), // col-sm-9
				"span10"             => ((($onecol * 10) - $gutter_size)+$extra), // col-sm-10
				"span11"             => ((($onecol * 11) - $gutter_size)+$extra), // col-sm-11
				"span12"             => ((($onecol * 12) - $gutter_size)+$extra), // col-sm-12
				"portfolio_sortable" => ((($onecol * 3) - $gutter_size)+$extra)   // col-sm-*?
			);
		}

		// Image sizes for anything but 1170 LAYOUT
		else {
			$image_width = array (
				"four"               => 220, // DONE
				"one-third"          => 370,
				"eight"              => 460, // DONE
				"two-thirds"         => 770,
				"twelve"             => 870,
				"sixteen"            => 960, // DONE
				"span3"              => 220, // DONE
				"span4"              => 300, // DONE
				"span5"              => 460,
				"span6"              => 460, // DONE
				"span7"              => 670,
				"span8"              => 770,
				"span9"              => 870,
				"span10"             => 970,
				"span11"             => 1070,
				"span12"             => 960, // DONE
				"portfolio_sortable" => 210
			);
		}

		if ( $sidebar ) {
			$image_width[ $size ] = $image_width[ $size ] - 300 - $extra;
		}

		elseif ( isset ( $extra ) ) {
			$image_width[ $size ] = $image_width[ $size ] - $extra;
		}

		$n_height = $image_width[ $size ] / ( 16 / 9 );

		if ( isset ( $span_sizes[ $size ] ) ) {
			$new_size['sizer'] = $span_sizes[ $size ];
		}

		if ( isset ( $image_width[ $size ] ) ) {
			$new_size['width'] = $image_width[ $size ];
		}

		$new_size['height'] = $n_height;

		return $new_size;
	}
}

/**
 * Add the "gallery" shortcode
 */
if ( ! function_exists( 'zn_custom_gallery' ) ) {
	/**
	 * Add the "gallery" shortcode
	 * @param array $attr
	 * @hooked to add_shortcode
	 * @see functions.php
	 * @return mixed|string|void
	 */

	function zn_custom_gallery( $attr ){
		global $post;

		static $instance = 0;

		$instance ++;

		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) ) {
				$attr['orderby'] = 'post__in';
			}
			$attr['include'] = $attr['ids'];
		}

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] ) {
				unset( $attr['orderby'] );
			}
		}

		// declare vars
		$id      = 0;
		$order   = 'RAND';
		$orderby = 'none';
		$size    = 0;
		$itemtag = $captiontag = $icontag = '';
		$columns = 0;

		extract( shortcode_atts( array (
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => ''
		), $attr ) );

		$id = intval( $id );

		if ( 'RAND' == $order ) {
			$orderby = 'none';
		}

		if ( ! empty( $include ) ) {
			$_attachments = get_posts( array (
				'include'        => $include,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			) );
			$attachments = array ();
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}
		}
		elseif ( ! empty( $exclude ) ) {
			$attachments = get_children( array (
				'post_parent'    => $id,
				'exclude'        => $exclude,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			) );
		}
		else {
			$attachments = get_children( array (
				'post_parent'    => $id,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			) );
		}

		if ( empty( $attachments ) ) {
			return '';
		}

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment ) {
				$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
			}
			return $output;
		}

		$itemtag = tag_escape( $itemtag );
		$captiontag = tag_escape( $captiontag );
		$icontag = tag_escape( $icontag );
		$valid_tags = wp_kses_allowed_html( 'post' );

		if ( ! isset( $valid_tags[ $itemtag ] ) ) {
			$itemtag = 'dl';
		}
		if ( ! isset( $valid_tags[ $captiontag ] ) ) {
			$captiontag = 'dd';
		}
		if ( ! isset( $valid_tags[ $icontag ] ) ) {
			$icontag = 'dt';
		}

		$columns = intval( $columns );
		$itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
		$float = is_rtl() ? 'right' : 'left';
		$selector = "gallery-{$instance}";
		$gallery_style = $gallery_div = '';

		if ( apply_filters( 'use_default_gallery_style', true ) )
		{
			$gallery_style = "<style type=\"text/css\">
				#{$selector} {
					margin: auto;
				}
				#{$selector} .gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
				}
				#{$selector} .gallery-caption {
					margin-left: 0;
				}
			</style><!-- see gallery_shortcode() in wp-includes/media.php -->
			";
		}

		$size_class = sanitize_html_class( $size );
		$gallery_div = "<div id=\"$selector\" class=\"gallery galleryid-{$id} mfp-gallery mfp-gallery--images gallery-columns-{$columns} gallery-size-{$size_class}\">";
		$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
		$num_ids = count( $attachments );
		$i = 1;
		$c = 1;
		$num_columns = 12 / $columns;
		$uid = uniqid( 'pp_' );

		foreach ( $attachments as $id => $attachment ) {
			if ( $c == 1 || $c % ( $columns + 1 ) == 0 ) {
				$output .= '<div class="row zn_image_gallery ">';
				$c = 1;
			}

			if ( $captiontag && trim( $attachment->post_excerpt ) ) {
				$title_caption = wptexturize( $attachment->post_excerpt );
			}
			else {
				$title_caption = '';
			}

			$output .= '<div class="col-sm-' . $num_columns . '">';
			$output .= '<a href="' . wp_get_attachment_url( $id ) . '" title="' . $title_caption . '" class="hoverBorder">';
			$output .= wp_get_attachment_image( $id, $size, 0, $attr );

			// Show caption
			$output .= '<span class="gallery_caption">';
			$output .= $title_caption;
			$output .= '</span>';

			$output .= '</a>';
			$output .= '</div>';

			if ( ( $columns > 0 && $i % $columns == 0 ) || $i == $num_ids ) {
				$output .= '</div>';
			}

			$i ++;
			$c ++;
		}
		$output .= '</div>';
		return $output;
	}
}
remove_shortcode( 'gallery' );
add_shortcode( 'gallery', 'zn_custom_gallery' );

/**
 * Add extra data to head
 */
if ( ! function_exists( 'zn_head' ) ) {
	/**
	 * Add extra data to head
	 * @hooked to wp_head
	 * @see functions.php
	 */
	function zn_head(){
		?>

		<!--[if lte IE 8]>
		<script type="text/javascript">
			var $buoop = {
				vs: { i: 10, f: 25, o: 12.1, s: 7, n: 9 }
			};

			$buoop.ol = window.onload;

			window.onload = function(){
				try {
					if ($buoop.ol) {
						$buoop.ol()
					}
				}
				catch (e) {}

				var e = document.createElement("script");
				e.setAttribute("type", "text/javascript");
				e.setAttribute("src", "<?php echo get_current_scheme();?>://browser-update.org/update.js");
				document.body.appendChild(e);
			};
		</script>
		<![endif]-->

		<!-- for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	<?php
	}
}

/**
 * Page pre-loading
 */
if ( ! function_exists( 'zn_page_loading' ) ) {
	/**
	 * Page pre-loading
	 */
	function zn_page_loading(){
		$page_preloader = zget_option( 'page_preloader' , 'general_options', false, 'no' );
		if ( $page_preloader != 'no' ) {

			echo '<div id="page-loading">';

				$page_preloader_img = zget_option( 'page_preloader_img' , 'general_options', false, '' );

				if($page_preloader == 'yes'){
					echo '<div class="preloader-pulsating-circle border-custom"></div>';
				}
				else if($page_preloader == 'yes_spinner'){
					echo '<div class="preloader-material-spinner"><svg class="preloader-material-svg" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="preloader-material-circle" fill="none" stroke-width="3" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg></div>';
				}
				else if($page_preloader == 'yes_persp'){
					echo '<div class="preloader-perspective-anim kl-main-bgcolor"></div>';
				}
				else if($page_preloader == 'yes_img_persp' && !empty($page_preloader_img)){
					echo '<div class="preloader-perspective-img"><img src="'.$page_preloader_img.'"></div>';
				}
				else if($page_preloader == 'yes_img_breath' && !empty($page_preloader_img)){
					echo '<div class="preloader-breath-img"><img src="'.$page_preloader_img.'"></div>';
				}
				else if($page_preloader == 'yes_img' && !empty($page_preloader_img)){
					echo '<div class="preloader-img"><img src="'.$page_preloader_img.'"></div>';
				}

			echo '</div>';
		}
	}
}

/**
 * Display Google analytics to page
 */
if ( ! function_exists( 'add_googleanalytics' ) ) {
	/**
	 * Display Google analytics to page
	 * @hooked to wp_footer
	 * @see functions.php
	 */
	function add_googleanalytics(){
		if ( $google_analytics = zget_option( 'google_analytics', 'general_options' ) ) {
			echo stripslashes( $google_analytics );
		}
	}
}

/**
 * Register menus
 */
if ( ! function_exists( 'zn_register_menu' ) ) {
	/**
	 * Register menus
	 * @hooked to init
	 * @see functions.php
	 */
	function zn_register_menu(){
		if ( function_exists( 'wp_nav_menu' ) ) {
			register_nav_menus( array (
				'main_navigation' => esc_html__( 'Main Navigation', 'zn_framework' )
			) );
			register_nav_menus( array (
				'header_navigation' => esc_html__( 'Header Navigation ( Top Bar )', 'zn_framework' ),
			) );
			register_nav_menus( array (
				'footer_navigation' => esc_html__( 'Footer Navigation', 'zn_framework' ),
			) );
		}
	}
}


/**
 * Load video iframe from link
 */
if ( ! function_exists( 'get_video_from_link' ) ) {
	/**
	 * Load video iframe from link
	 * @param string $string
	 * @param null   $css
	 * @param int $width
	 * @param int $height
	 * @return mixed|null|string
	 */
	function get_video_from_link( $string, $css = null, $width = 425, $height = 239, $video_attributes = null ){
		// Save old string in case no video is provided
		$old_string = $string;
		$video_url = parse_url( $string );

		$extra_options = array();
		$extra_options_str = '';

		if(!empty($video_attributes) && is_array($video_attributes)){
			$extra_options[] = 'autoplay='.(isset($video_attributes['autoplay']) && !empty($video_attributes['autoplay']) ? $video_attributes['autoplay'] : 0);
			$extra_options[] = 'loop='.(isset($video_attributes['loop']) && !empty($video_attributes['loop']) ? $video_attributes['loop'] : 0);
			$extra_options[] = 'controls='.(isset($video_attributes['controls']) && !empty($video_attributes['controls']) ? $video_attributes['controls'] : 0);
		}

		if ( $video_url['host'] == 'www.youtube.com' || $video_url['host'] == 'youtube.com' || $video_url['host'] == 'www.youtu.be' || $video_url['host'] == 'youtu.be' ) {

			if(!empty($video_attributes) && is_array($video_attributes)){
				// Youtube Specific
				$extra_options[] = 'modestbranding='.(isset($video_attributes['yt_modestbranding']) && !empty($video_attributes['yt_modestbranding']) ? $video_attributes['yt_modestbranding'] : 1);
				$extra_options[] = 'autohide='.(isset($video_attributes['yt_autohide']) && !empty($video_attributes['yt_autohide']) ? $video_attributes['yt_autohide'] : 1);
				$extra_options[] = 'showinfo='.(isset($video_attributes['yt_showinfo']) && !empty($video_attributes['yt_showinfo']) ? $video_attributes['yt_showinfo'] : 0);
				$extra_options[] = 'rel='.(isset($video_attributes['yt_rel']) && !empty($video_attributes['yt_rel']) ? $video_attributes['yt_rel'] : 0);
			}

			preg_match( '#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#', $string, $matches );
			$string = '<iframe class="' . $css . '" width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $matches[0] . '?playlist=' . $matches[0] . '&amp;iv_load_policy=3&amp;enablejsapi=0&amp;wmode=opaque&amp;feature=player_embedded&amp;'.implode('&amp;', $extra_options).'" allowfullscreen></iframe>';
		}
		elseif ( $video_url['host'] == 'www.dailymotion.com' ) {
			$id = strtok( basename( $old_string ), '_' );
			$string = '<iframe width="' . $width . '" height="' . $height . '" src="//www.dailymotion.com/embed/video/' . $id . '?'.implode('&amp;', $extra_options).'"></iframe>';
		}

		elseif( $video_url['host'] == 'vimeo.com' || $video_url['host'] == 'www.vimeo.com' ) {

			if(!empty($video_attributes) && is_array($video_attributes)){
				// Vimeo Specific
				$extra_options[] = 'title='.(isset($video_attributes['vim_title']) && !empty($video_attributes['vim_title']) ? $video_attributes['vim_title'] : 1);
				$extra_options[] = 'byline='.(isset($video_attributes['vim_byline']) && !empty($video_attributes['vim_byline']) ? $video_attributes['vim_byline'] : 1);
				$extra_options[] = 'portrait='.(isset($video_attributes['vim_portrait']) && !empty($video_attributes['vim_portrait']) ? $video_attributes['vim_portrait'] : 1);
			}

			$string = preg_replace(
				array (
					'#http://(www\.)?vimeo\.com/([^ ?\n/]+)((\?|/).*?(\n|\s))?#i',
					'#https://(www\.)?vimeo\.com/([^ ?\n/]+)((\?|/).*?(\n|\s))?#i'
				),
				'<iframe '.WpkPageHelper::zn_schema_markup('video').' class="youtube-player ' . $css . '" src="//player.vimeo.com/video/$2?'.implode('&amp;', $extra_options).'" width="' . $width . '" height="' . $height . '" allowFullScreen></iframe>', $string );
		}
		else {
			$string = '<iframe '.WpkPageHelper::zn_schema_markup('video').' class="' . $css . '" width="' . $width . '" height="' . $height . '" src="' . $old_string.'"></iframe>';
		}

		// If no video link was provided return the full link
		return ( $string != $old_string ) ? $string: null;
	}
}

/**
 * Comments display function
 */
if ( ! function_exists( 'zn_comment' ) ) {
	/**
	 * Comments display function
	 * @param $comment
	 * @param $args
	 * @param $depth
	 */
	function zn_comment( $comment, $args, $depth ){
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class('kl-comment'); ?> id="li-comment-<?php comment_ID() ?>"  <?php echo WpkPageHelper::zn_schema_markup('comment'); ?>>
			<div id="comment-<?php comment_ID(); ?>" class="kl-comment__wrapper">
				<div class="comment-author vcard kl-comment__author" <?php echo WpkPageHelper::zn_schema_markup('comment_author'); ?>>
					<?php echo get_avatar( $comment, $size = '50' ); ?>
					<?php printf( __( '<cite class="fn">%s</cite>', 'zn_framework' ), get_comment_author_link() ) ?> <?php echo __( "says :", 'zn_framework' ); ?> <?php comment_reply_link( array_merge( $args, array (
						'depth'     => $depth,
						'max_depth' => $args['max_depth']
					) ) ) ?>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'zn_framework' ) ?></em>
					<br/>
				<?php endif; ?>

				<div class="comment-meta commentmetadata kl-comment__meta">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="kl-comment__meta-link" <?php echo WpkPageHelper::zn_schema_markup('comment_time'); ?>>
						<?php printf( __( '%1$s at %2$s', 'zn_framework' ), get_comment_date(), get_comment_time() ) ?>
					</a>
					<?php edit_comment_link( __( '(Edit)', 'zn_framework' ), '  ', '' ) ?>
				</div>
				<div class="kl-comment__text" <?php echo WpkPageHelper::zn_schema_markup('comment_text'); ?>>
					<?php comment_text() ?>
				</div>

				<div class="zn-separator sep_normal zn-margin-d kl-comments-sep"></div>
			</div>
	<?php
	}
}

//<editor-fold desc=">>> REGISTER SIDEBARS">

if(! function_exists('wpkRegisterSidebars')){
	/**
	 * Register theme sidebars
	 * @hooked to widgets_init
	 * @since 4.0.0
	 */
	function wpkRegisterSidebars()
	{

		if ( function_exists( 'register_sidebar' ) ) {
			/**
			 * Default sidebar
			 */
			register_sidebar( array (
				'name'          => 'Default Sidebar',
				'id'            => 'defaultsidebar',
				'description'   => esc_html__( "This is the default sidebar. You can choose from the theme's options page where
										the widgets from this sidebar will be shown.", 'zn_framework' ),
				'before_widget' => '<div id="%1$s" class="widget zn-sidebar-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle zn-sidebar-widget-title title">',
				'after_title'   => '</h3>'
			));
			/**
			 * Hidden Panel sidebar
			 */
			register_sidebar( array (
				'name'          => 'Hidden Panel Sidebar',
				'id'            => 'hiddenpannelsidebar',
				'description'   => esc_html__( "This is the sidebar for the hidden panel in the header. You can choose from the
								theme's options page where the widgets from this sidebar will be shown.", 'zn_framework' ),
				'before_widget' => '<div id="%1$s" class="widget support-panel-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle title support-panel-widgettitle">',
				'after_title'   => '</h3>'

			));
			// Footer sidebar 1
			$footer_row1_widget_positions = zget_option( 'footer_row1_widget_positions', 'general_options', false, '{"3":[["4","4","4"]]}' );

			$f_row1 = key( json_decode( stripslashes( $footer_row1_widget_positions ) ) );
			if ( $f_row1 > 1 ) {
				register_sidebars( $f_row1, array (
					'name'          => 'Footer row 1 - widget %d',
					'id'            => "znfooter",
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widgettitle title m_title m_title_ext text-custom">',
					'after_title'   => '</h3>'
				));
			}
			else {
				register_sidebars( 1, array (
					'name'          => 'Footer row 1 - widget 1',
					'id'            => "znfooter",
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widgettitle title m_title m_title_ext text-custom">',
					'after_title'   => '</h3>'
				));
			}

			// Footer sidebar 2
			$footer_row2_widget_positions = zget_option( 'footer_row2_widget_positions', 'general_options', false, '{"3":[["4","4","4"]]}' );

			$f_row1 = key( json_decode( stripslashes( $footer_row2_widget_positions ) ) );
			if ( $f_row1 > 1 ) {
				register_sidebars( $f_row1, array (
					'name'          => 'Footer row 2 - widget %d',
					'id'            => "znfooter",
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widgettitle title m_title m_title_ext text-custom">',
					'after_title'   => '</h3>'
				) );
			}
			else {
				register_sidebars( 1, array (
					'name'          => 'Footer row 2 - widget 1',
					'id'            => "znfooter",
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widgettitle title m_title m_title_ext text-custom">',
					'after_title'   => '</h3>'
				) );
			}

			// global $wp_registered_sidebars;
			// Dynamic sidebars
			if ( $unlimited_sidebars = zget_option( 'unlimited_sidebars', 'unlimited_sidebars' ) ) {
				foreach ( $unlimited_sidebars as $sidebar ) {
					if ( $sidebar['sidebar_name'] ) {

						// $i = count($wp_registered_sidebars) + 1;

						register_sidebar( array (
							'name'          => $sidebar['sidebar_name'],
							'id' => zn_sanitize_widget_id( $sidebar['sidebar_name'] ),
							'before_widget' => '<div id="%1$s" class="widget zn-sidebar-widget %2$s">',
							'after_widget'  => '</div>',
							'before_title'  => '<h3 class="widgettitle zn-sidebar-widget-title title">',
							'after_title'   => '</h3>'
						));
					}
				}
			}
		}
	}
}
//</editor-fold desc=">>> REGISTER SIDEBARS">


/**
 * Get current scheme
 */
if ( ! function_exists( 'get_current_scheme' ) ) {
	/**
	 * Get current scheme
	 * @return string
	 */
	function get_current_scheme(){
		$scheme = 'http';
		if ( isset( $_SERVER["HTTPS"] ) && ( $_SERVER["HTTPS"] == "on" ) ) {
			$scheme .= "s";
		}
		return $scheme;
	}
}

/**
 * Get current page URL
 */
if ( ! function_exists( 'current_page_url' ) ) {
	/**
	 * Get current page URL
	 * @return string
	 */
	function current_page_url(){
		$pageURL = get_current_scheme() . '://';
		if ( isset( $_SERVER["SERVER_PORT"] ) && ( (int) $_SERVER["SERVER_PORT"] != 80 ) ) {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		}
		else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}

/**
 * Remove the "Read More" tag from excerpt
 */
if ( ! function_exists( 'clear_excerpt_more' ) ) {
	/**
	 * Remove the "Read More" tag from excerpt
	 * @param $more
	 * @hooked to excerpt_more
	 * @see functions.php
	 * @return string
	 */
	function clear_excerpt_more( $more ){
		return '';
	}
}


/**
 * Flush WP Rewrite rules
 */
if ( ! function_exists( 'zn_rewrite_flush' ) ) {
	/**
	 * Flush WP Rewrite rules
	 * @hooked to after_switch_theme
	 * @see functions.php
	 */
	function zn_rewrite_flush(){
		flush_rewrite_rules();
	}
}

/**
 * Register the Custom Post Type: Portfolio
 */
if ( ! function_exists( 'zn_portfolio_post_type' ) ) {
	/**
	 * Register the Custom Post Type: Portfolio
	 * @hooked to init
	 * @see functions.php
	 */
	function zn_portfolio_post_type(){
		$permalinks = get_option( 'zn_permalinks' );
		$slug = true;

		if (isset($permalinks['portfolio']) && !empty( $permalinks['portfolio'] ) ) {
			$slug = array( 'slug' => $permalinks['portfolio'] );
		}

		$labels = array (
			'name'               => __( 'Portfolios', 'zn_framework' ),
			'singular_name'      => __( 'Portfolio Item', 'zn_framework' ),
			'add_new'            => __( 'Add New Portfolio Item', 'zn_framework' ),
			'all_items'          => __( 'All Portfolio Items', 'zn_framework' ),
			'add_new_item'       => __( 'Add New Portfolio', 'zn_framework' ),
			'edit_item'          => __( 'Edit Portfolio Item', 'zn_framework' ),
			'new_item'           => __( 'New Portfolio Item', 'zn_framework' ),
			'view_item'          => __( 'View Portfolio Item', 'zn_framework' ),
			'search_items'       => __( 'Search Portfolio Items', 'zn_framework' ),
			'not_found'          => __( 'No Portfolio Items found', 'zn_framework' ),
			'not_found_in_trash' => __( 'No Portfolio Items found in trash', 'zn_framework' ),
			'parent_item_colon'  => __( 'Parent Portfolio:', 'zn_framework' ),
			'menu_name'          => __( 'Portfolio Items', 'zn_framework' ),
		);

		$args = array (
			'labels'              => $labels,
			'description'         => "",
			'public'              => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 100,
			'menu_icon'           => THEME_BASE_URI.'/images/portfolio.png',
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'supports'            => array ( 'title', 'editor', 'excerpt' ),
			'has_archive'         => true,
			'rewrite'             => $slug,
			'query_var'           => true,
			'can_export'          => true
		);
		register_post_type( 'portfolio', $args );
	}
}

/**
 * Register the Portfolio Post Taxonomy
 */
if ( ! function_exists( 'zn_portfolio_category' ) ) {
	/**
	 * Register the Portfolio Post Taxonomy
	 * @hooked to init
	 * @see functions.php
	 */
	function zn_portfolio_category(){
		$slug = true;
		$permalinks = get_option( 'zn_permalinks' );

		if (isset($permalinks['project_category']) && !empty( $permalinks['project_category'] ) ) {
			$slug = array ( 'slug' => $permalinks['project_category'] );
		}

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array (
			'name'              => __( 'Portfolio Categories', 'zn_framework' ),
			'singular_name'     => __( 'Portfolio Category', 'zn_framework' ),
			'search_items'      => __( 'Search Portfolio Categories', 'zn_framework' ),
			'all_items'         => __( 'All Portfolio Categories', 'zn_framework' ),
			'parent_item'       => __( 'Parent Portfolio Category', 'zn_framework' ),
			'parent_item_colon' => __( 'Parent Portfolio Category:', 'zn_framework' ),
			'edit_item'         => __( 'Edit Portfolio Category', 'zn_framework' ),
			'update_item'       => __( 'Update Portfolio Category', 'zn_framework' ),
			'add_new_item'      => __( 'Add New Portfolio Category', 'zn_framework' ),
			'new_item_name'     => __( 'New Portfolio Category Name', 'zn_framework' ),
			'menu_name'         => __( 'Portfolio categories', 'zn_framework' ),

		);

		register_taxonomy( 'project_category', 'portfolio', array (
			'hierarchical' => true,
			'labels'       => $labels,
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => $slug,
		));
	}
}

add_action( 'init', 'zn_portfolio_tags' );
add_filter( 'zn_allowed_post_types', 'zn_add_portfolio_slugs' );
add_filter( 'zn_allowed_taxonomies', 'zn_add_portfolio_taxonomy_slugs' );

if ( ! function_exists( 'zn_portfolio_tags' ) ) {
	function zn_portfolio_tags() {
		$slug = true;
		$permalinks = get_option( 'zn_permalinks' );

		if ( ! empty( $permalinks['portfolio_tags'] ) ) {
			$slug = array( 'slug' => $permalinks['portfolio_tags'] );
		}

		register_taxonomy(
			'portfolio_tags',
			'portfolio',
			array(
				'label'        => __( 'Portfolio tags', 'zn_framework' ),
				'rewrite'      => $slug,
				'hierarchical' => false,
			)
		);
	}
}

if ( ! function_exists( 'zn_add_portfolio_slugs' ) ) {
	function zn_add_portfolio_slugs( $post_types ) {
		$post_types['portfolio'] = 'Portfolio';
		$post_types['documentation'] = 'Documentation';

		return $post_types;
	}
}
if ( ! function_exists( 'zn_add_portfolio_taxonomy_slugs' ) ) {
	function zn_add_portfolio_taxonomy_slugs( $taxonomies ) {

		$taxonomies['portfolio'] = array(
			array(
				'id'   => 'project_category',
				'name' => 'Portfolio categories',
			),
			array(
				'id'   => 'portfolio_tags',
				'name' => 'Portfolio tags',
			),
		);

		$taxonomies['documentation'] = array(
			array(
				'id'   => 'documentation_category',
				'name' => 'Documentation categories',
			),
		);

		return $taxonomies;
	}
}



/**
 * Register the Documentation Custom Post Type
 */
if ( ! function_exists( 'zn_documentation_post_type' ) ) {
	/**
	 * Register the Documentation Custom Post Type
	 * @hooked to init
	 * @see functions.php
	 */
	function zn_documentation_post_type(){
		$slug = true;
		$permalinks = get_option( 'zn_permalinks' );

		if ( ! empty( $permalinks['documentation'] ) ) {
			$slug = array ( 'slug' => $permalinks['documentation'] );
		}

		$labels = array (
			'name'               => __( 'Documentation', 'zn_framework' ),
			'singular_name'      => __( 'Documentation Item', 'zn_framework' ),
			'add_new'            => __( 'Add New Documentation Item', 'zn_framework' ),
			'all_items'          => __( 'All Documentation Items', 'zn_framework' ),
			'add_new_item'       => __( 'Add New Documentation', 'zn_framework' ),
			'edit_item'          => __( 'Edit Documentation Item', 'zn_framework' ),
			'new_item'           => __( 'New Documentation Item', 'zn_framework' ),
			'view_item'          => __( 'View Documentation Item', 'zn_framework' ),
			'search_items'       => __( 'Search Documentation Items', 'zn_framework' ),
			'not_found'          => __( 'No Documentation Items found', 'zn_framework' ),
			'not_found_in_trash' => __( 'No Documentation Items found in trash', 'zn_framework' ),
			'parent_item_colon'  => __( 'Parent Documentation:', 'zn_framework' ),
			'menu_name'          => __( 'Documentation Items', 'zn_framework' ),
		);

		$args = array (
			'labels'              => $labels,
			'description'         => "",
			'public'              => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 100,
			'menu_icon'           => THEME_BASE_URI.'/images/portfolio.png',
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'supports'            => array ( 'title', 'editor' ),
			'has_archive'         => true,
			'rewrite'             => $slug,
			'query_var'           => true,
			'can_export'          => true
		);
		register_post_type( 'documentation', $args );
	}
}

/**
 * Register the Documentation Post Taxonomy
 */
if ( ! function_exists( 'zn_documentation_category' ) ) {
	/**
	 * Register the Documentation Post Taxonomy
	 * @hooked to init
	 * @see functions.php
	 */
	function zn_documentation_category(){
		$slug = true;
		$permalinks = get_option( 'zn_permalinks' );

		if ( ! empty( $permalinks['documentation_category'] ) ) {
			$slug = array ( 'slug' => $permalinks['documentation_category'] );
		}

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array (
			'name'              => __( 'Documentation Categories', 'zn_framework' ),
			'singular_name'     => __( 'Documentation Category', 'zn_framework' ),
			'search_items'      => __( 'Search Documentation Categories', 'zn_framework' ),
			'all_items'         => __( 'All Documentation Categories', 'zn_framework' ),
			'parent_item'       => __( 'Parent Documentation Category', 'zn_framework' ),
			'parent_item_colon' => __( 'Parent Documentation Category:', 'zn_framework' ),
			'edit_item'         => __( 'Edit Documentation Category', 'zn_framework' ),
			'update_item'       => __( 'Update Documentation Category', 'zn_framework' ),
			'add_new_item'      => __( 'Add New Documentation Category', 'zn_framework' ),
			'new_item_name'     => __( 'New Documentation Category Name', 'zn_framework' ),
			'menu_name'         => __( 'Documentation categories', 'zn_framework' ),
		);

		register_taxonomy( 'documentation_category', 'documentation', array (
			'hierarchical' => true,
			'labels'       => $labels,
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => $slug,
		) );
	}
}

/**
 * Display the breadcrumb menu
 */
if ( ! function_exists( 'zn_breadcrumbs' ) ) {
	/**
	 * Display the breadcrumb menu
	 */
	function zn_breadcrumbs(){
		global $post, $wp_query;

		$delimiter   = '&raquo;';
		$home        = __( 'Home', 'zn_framework' );
		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show

		$before = '<span class="current">'; // tag before the current crumb
		$after  = '</span>'; // tag after the current crumb

		$prepend = '';

		$breadcrumb_style = 'bread-style--' . zget_option( 'def_subh_bread_stl', 'general_options', false, 'black' );

		if ( znfw_is_woocommerce_active() ) {

			$shop_page_id = wc_get_page_id( 'shop' );
			$shop_page = get_post( $shop_page_id );


			if ( $shop_page_id && get_option( 'page_on_front' ) !== $shop_page_id ) {
				$prepend = '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '">' . get_the_title( wc_get_page_id( 'shop' ) );
				$prepend .= '</a></li>';
			}

		}

		$homeLink = home_url();

		if ( is_front_page() ) {
			echo '<ul vocab="http://schema.org/" typeof="BreadcrumbList" class="breadcrumbs fixclear '. $breadcrumb_style .'"><li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' . $homeLink . '">' . $home . '</a></li></ul>';
		}
		elseif ( is_home() ) {

			$title = zget_option( 'archive_page_title', 'blog_options' );
			$title = do_shortcode( $title );

			echo '<ul vocab="http://schema.org/" typeof="BreadcrumbList" class="breadcrumbs fixclear '. $breadcrumb_style .'"><li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' . $homeLink . '">' . $home . '</a></li><li>' . $title . '</li></ul>';
		}

		else
		{
			$bClass = 'breadcrumbs fixclear '. $breadcrumb_style;
			echo '<ul vocab="http://schema.org/" typeof="BreadcrumbList"';
			if(is_search()){
				$bClass  .=' th-search-page-mtop';
			}

			echo ' class="'.$bClass.'"><li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' . $homeLink . '">' . $home . '</a></li>';
			if ( is_category() )
			{
				$thisCat = get_category( get_query_var( 'cat' ), false );

				if ( $thisCat->parent != 0 ) {
					$cats = get_category_parents( $thisCat->parent, true, '|zn_preg|' );
				}
				else $cats = get_category_parents( $thisCat, true, '|zn_preg|' );

				if(! empty($cats) && ! is_wp_error($cats)) {
					$cats = explode( '|zn_preg|', $cats );
					foreach ( $cats as $s_cat ) {
						if ( ! empty ( $s_cat ) ) {
							$s_cat = str_replace( '<a', '<a property="item" typeof="WebPage" ', $s_cat );
							echo '<li property="itemListElement" typeof="ListItem">' . $s_cat . '</li>';
						}
					}
				}
				echo '<li>' . __( "Archive from category ", 'zn_framework' ) . '"' . single_cat_title( '', false ) . '"</li>';
			}
			elseif ( is_tax( 'product_cat' ) )
			{
				echo $prepend;

				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				$parents = array ();
				$parent = $term->parent;

				while ( $parent ) {
					$parents[] = $parent;
					$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
					$parent = $new_parent->parent;
				}

				if ( ! empty( $parents ) ) {
					$parents = array_reverse( $parents );

					foreach ( $parents as $parent ) {
						$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
						echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage"  href="' .
							get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a></li>';
					}
				}
				$queried_object = $wp_query->get_queried_object();
				echo '<li>' . $queried_object->name . '</li>';
			}
			elseif ( is_tax( 'project_category' ) || is_post_type_archive( 'portfolio' ) )
			{
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

				if ( ! empty( $term->parent ) ) {
					$parents = array ();
					$parent = $term->parent;

					while ( $parent ) {
						$parents[] = $parent;
						$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
						$parent = $new_parent->parent;
					}

					if ( ! empty( $parents ) ) {
						$parents = array_reverse( $parents );

						foreach ( $parents as $parent ) {
							$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
							echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage"  href="' .
								get_term_link( $item->slug, 'project_category' ) . '">' . $item->name . '</a></li>';
						}
					}
				}
				$queried_object = $wp_query->get_queried_object();
				$menuItem = $queried_object->name;
				//@wpk: #68 - Replace "portfolio" with the one set by the user in the permalinks page
				if ( strcasecmp( 'portfolio', $queried_object->name ) == 0 ) {
					$menuItem = $queried_object->rewrite['slug'];
				}
				echo '<li>' . $menuItem . '</li>';
			}
			elseif ( is_tax( 'documentation_category' ) )
			{
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				$parents = array ();
				$parent = $term->parent;

				while ( $parent ) {
					$parents[] = $parent;
					$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
					$parent = $new_parent->parent;
				}

				if ( ! empty( $parents ) ) {
					$parents = array_reverse( $parents );

					foreach ( $parents as $parent ) {
						$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ) );
						echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage"  href="' .
							get_term_link( $item->slug, 'documentation_category' ) . '">' . $item->name . '</a></li>';
					}
				}
				$queried_object = $wp_query->get_queried_object();
				echo '<li>' . $queried_object->name . '</li>';
			}
			elseif ( is_search() )
			{
				echo '<li>' . __( "Search results for ", 'zn_framework' ) . '"' . get_search_query() . '"</li>';
			}
			elseif ( is_day() )
			{
				echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage"  href="' .
					get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
				echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage"  href="' .
					get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a></li>';
				echo '<li>' . get_the_time( 'd' ) . '</li>';
			}
			elseif ( is_month() )
			{
				echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage"  href="' .
					get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
				echo '<li>' . get_the_time( 'F' ) . '</li>';
			}
			elseif ( is_year() )
			{
				echo '<li>' . get_the_time( 'Y' ) . '</li>';
			}
			elseif ( is_post_type_archive( 'product' ) && get_option( 'page_on_front' ) !== wc_get_page_id( 'shop' ) ) {
				$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : ucwords( get_option( 'woocommerce_shop_slug' ) );

				if ( is_search() ) {
					echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' .
						get_post_type_archive_link( 'product' ) . '">' . $_name . '</a></li><li>' .
						__( 'Search results for &ldquo;', 'zn_framework' ) . get_search_query() . '</li>';
				}
				elseif ( is_paged() ) {
					echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' .
						get_post_type_archive_link( 'product' ) . '">' . $_name . '</a></li>';
				}
				else {
					echo '<li>' . $_name . '</li>';
				}
			}
			elseif ( is_single() && ! is_attachment() )
			{
				if ( get_post_type() == 'portfolio' )
				{
					// Show category name
					$cats = get_the_term_list( $post->ID, 'project_category', ' ', '|zn_preg|', '|zn_preg|' );
					$cats = explode( '|zn_preg|', $cats );
					if ( ! empty ( $cats[0] ) ) {
						$s_cat = str_replace( '<a', '<a property="item" typeof="WebPage" ', $cats[0] );
						echo '<li property="itemListElement" typeof="ListItem">' . $s_cat . '</li>';
					}
					// Show post name
					echo '<li>' . get_the_title() . '</li>';
				}
				elseif ( get_post_type() == 'product' )
				{
					echo $prepend;

					// 'orderby' => 'term_id': Fixes empty category when category and parent are not listed in the correct order
					if ( $terms = wp_get_object_terms( $post->ID, 'product_cat', array( 'orderby' => 'term_id' ) ) ) {

						$term = end( $terms );
						$parents = array ();
						$parent = $term->parent;

						while ( $parent ) {
							$parents[] = $parent;
							$new_parent = get_term_by( 'id', $parent, 'product_cat' );
							$parent = $new_parent->parent;
						}

						if ( ! empty( $parents ) ) {
							$parents = array_reverse( $parents );

							foreach ( $parents as $parent ) {
								$item = get_term_by( 'id', $parent, 'product_cat' );
								echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' .
									get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a></li>';
							}
						}
						echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' .
							get_term_link( $term->slug, 'product_cat' ) . '">' . $term->name . '</a></li>';
					}
					echo '<li>' . get_the_title() . '</li>';
				}

				elseif ( get_post_type() != 'post' )
				{
					$post_type = get_post_type_object( get_post_type() );
					$slug = $post_type->rewrite;
					echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' . $homeLink . '/' .
						$slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';

					if ( $showCurrent == 1 ) {
						echo '<li>' . get_the_title() . '</li>';
					}
				}
				else {
					if ( 'post' == get_post_type() ) {

						// If we are on the posts page and static page is set for blog, add the Post page name
						if ( 'page' == get_option( 'show_on_front' ) ) {
							$posts_page = get_option( 'page_for_posts' );
							if ( $posts_page != '' && is_numeric( $posts_page ) ) {
								$page = get_page( $posts_page );

								echo '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="' . esc_attr( get_the_title( $posts_page ) ) . '" href="' . esc_url( get_permalink( $posts_page ) ) . '">' . get_the_title( $posts_page ) . '</a></li>';
							}
						}
					}


					// Show category name
					$cat = get_the_category();
					$cat = $cat[0];
					$cats = get_category_parents( $cat, true, '|zn_preg|' );
					if(! empty($cats) && ! is_wp_error($cats)) {
						$cats = explode( '|zn_preg|', $cats );
						foreach ( $cats as $s_cat ) {
							if ( ! empty ( $s_cat ) ) {
								$s_cat = str_replace( '<a', '<a property="item" typeof="WebPage" ', $s_cat );
								echo '<li property="itemListElement" typeof="ListItem">' . $s_cat . '</li>';
							}
						}
					}
					// Show post name
					echo '<li>' . get_the_title() . '</li>';
				}
			}
			elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() )
			{
				$post_type = get_post_type_object( get_post_type() );
				if ( ! empty ( $post_type->labels->singular_name ) ) {
					echo '<li>' . $post_type->labels->singular_name . '</li>';
				}
			}
			elseif ( is_attachment() )
			{
				$parent = get_post( $post->post_parent );
				$cat = get_the_category( $parent->ID );
				if ( ! empty( $cat ) ) {
					$cat = $cat[0];
					$cats = get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
					if(! empty($cats) && ! is_wp_error($cats)) {
						echo $cats;
					}
					echo '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>';
					echo '<li>' . get_the_title() . '</li>';
				}
				else {
					echo '<li>' . get_the_title() . '</li>';
				}
			}
			elseif ( is_page() && ! is_subpage() )
			{
				if ( $showCurrent == 1 ) {
					echo '<li>' . get_the_title() . '</li>';
				}
			}
			elseif ( is_page() && is_subpage() )
			{
				$parent_id = $post->post_parent;
				$breadcrumbs = array ();
				while ( $parent_id ) {
					$page = get_post( $parent_id );
					$breadcrumbs[] = '<li property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="' .
						get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>';
					$parent_id = $page->post_parent;
				}

				$breadcrumbs = array_reverse( $breadcrumbs );

				for ( $i = 0; $i < count( $breadcrumbs ); $i ++ ) {
					echo $breadcrumbs[ $i ];
				}

				if ( $showCurrent == 1 ) {
					echo '<li>' . get_the_title() . '</li>';
				}
			}
			elseif ( is_tag() ) {
				echo '<li>' . __( "Posts tagged ", 'zn_framework' ) . '"' . single_tag_title( '', false ) . '"</li>';
			}
			elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo '<li>' . __( "Articles posted by ", 'zn_framework' ) . ( isset( $userdata->display_name ) ? $userdata->display_name : '' ) . '</li>';
			}
			elseif ( is_404() ) {
				echo '<li>' . __( "Error 404 ", 'zn_framework' ) . '</li>';
			}
			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ' (';
				}
				echo '<li>' . __( 'Page', 'zn_framework' ) . ' ' . get_query_var( 'paged' ) . '</li>';
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ')';
				}
			}
			echo '</ul>';
		}
	}
}

/**
* Check if this is a subpage
*/
if ( ! function_exists( 'is_subpage' ) ) {
	/**
	 * Check if this is a subpage
	 * @return bool|int
	 */
	function is_subpage(){
		global $post;                              // load details about this page
		if ( is_page() && $post->post_parent ) {   // test to see if the page has a parent
			return $post->post_parent;             // return the ID of the parent post
		}
		return false;
	}
}


/**
 * Login Form - Stop redirecting if ajax is used
 */
if ( ! function_exists( 'zn_stop_redirecting' ) ) {
	/**
	 * Login Form - Stop redirecting if ajax is used
	 * @param $redirect_to
	 * @param $request
	 * @param $user
	 * @hooked to login_redirect
	 * @see functions.php
	 * @return mixed
	 */
	function zn_stop_redirecting( $redirect_to, $request, $user ){
		if ( empty ( $_POST['ajax_login'] ) ) {
			return $redirect_to;
		}
	}
}

/**
 * Login system
 */
if ( ! function_exists( 'zn_do_login' ) ) {
	/**
	 * Login system
	 * @hooked to wp_ajax_nopriv_zn_do_login
	 * @see functions.php
	 */
	function zn_do_login(){
		// @wpk: pre-validate request
		$rm = strtoupper($_SERVER['REQUEST_METHOD']);
		if('POST' !== $rm){
			exit(__('Invalid request.', 'zn_framework'));
		}
		if(! isset($_POST['zn_form_action'])){
			exit(__('Invalid request.', 'zn_framework'));
		}
		if(! in_array($_POST['zn_form_action'], array('login', 'register', 'reset_pass'))){
			exit(__('Invalid request.', 'zn_framework'));
		}
		if ( $_POST['zn_form_action'] == 'login' )
		{
			$user = wp_signon();

			if ( is_wp_error( $user ) ) {
				echo '<div id="login_error" class="zn-notification zn-notification--error">' . $user->get_error_message() . '</div>';
			}
			else {
				echo 'success';
			}
			exit;
		}
		elseif ( $_POST['zn_form_action'] == 'register' )
		{
			$zn_error         = false;
			$zn_error_message = array ();

			// Defaults
			$password =
			$username =
			$username =
			$email = '';

			if ( ! empty( $_POST['user_login'] ) ) {
				if ( username_exists( $_POST['user_login'] ) ) {
					$zn_error           = true;
					$zn_error_message[] = __( 'The username already exists', 'zn_framework' );
				}
				else {
					$username = $_POST['user_login'];
				}
			}
			else {
				$zn_error           = true;
				$zn_error_message[] = __( 'Please enter an username', 'zn_framework' );
			}

			if ( ! empty( $_POST['user_password'] ) ) {
				$password = $_POST['user_password'];
			}
			else {
				$zn_error           = true;
				$zn_error_message[] = __( 'Please enter a password', 'zn_framework' );
			}

			if ( ( empty( $_POST['user_password'] ) && empty( $_POST['user_password2'] ) ) || $_POST['user_password'] != $_POST['user_password2'] ) {
				$zn_error           = true;
				$zn_error_message[] = __( 'Passwords do not match', 'zn_framework' );
			}

			if ( ! empty( $_POST['user_email'] ) ) {
				if ( ! email_exists( $_POST['user_email'] ) ) {
					if ( ! filter_var( $_POST['user_email'], FILTER_VALIDATE_EMAIL ) ) {
						$zn_error           = true;
						$zn_error_message[] = __( 'Please enter a valid EMAIL address', 'zn_framework' );
					}
					else {
						$email = $_POST['user_email'];
					}
				}
				else {
					$zn_error           = true;
					$zn_error_message[] = __( 'This email address has already been used', 'zn_framework' );
				}
			}
			else {
				$zn_error = true;
				$zn_error_message[] = __( 'Please enter an email address', 'zn_framework' );
			}

			if ( $zn_error ) {
				echo '<div id="login_error" class="zn-notification zn-notification--error">';

				foreach ( $zn_error_message as $error ) {
					echo $error . '<br />';
				}
				echo '</div>';
			}
			else {

				$user_data = array (
					'ID'           => '',
					'user_pass'    => $password,
					'user_login'   => $username,
					'display_name' => $username,
					'user_email'   => $email,
					// Use default role or another role, e.g. 'editor'
					'role'         => get_option( 'default_role' )
				);

				$user_id = wp_insert_user( $user_data );

				if ( ! function_exists( 'wp_new_user_notification' ) ) {
					include_once( trailingslashit( ABSPATH ) . 'wp-includes/pluggable.php' );
				}

				if( znfw_is_woocommerce_active() ){
					do_action( 'woocommerce_created_customer', $user_id, $user_data, $password );
				}
				else{
					wp_new_user_notification( $user_id, $password );
				}

				echo '<div id="login_error" class="zn-notification zn-notification--success">' . __( 'Your account has been created. <a href="#login_panel" class="kl-login-box">You can now login</a>.', 'zn_framework' ) . '</div>';
			}
			exit;
		}
		elseif ( $_POST['zn_form_action'] == 'reset_pass' )
		{
			echo do_action( 'login_form', 'resetpass' );
		}
	}
}


/**
 * Frontend: Load theme's default stylesheets
 */
if(! function_exists('wpkLoadGlobalStylesheetsFrontend')) {
	/**
	 * Frontend: Load theme's default stylesheets
	 * @hooked to wp_enqueue_scripts.
	 * @see functions.php
	 */
	function wpkLoadGlobalStylesheetsFrontend()
	{
		wp_enqueue_style( 'kallyas-styles', get_stylesheet_uri(), false, ZN_FW_VERSION );
		wp_enqueue_style( 'th-bootstrap-styles', THEME_BASE_URI . '/css/bootstrap.min.css', false, ZN_FW_VERSION );

		$suffix = ( (defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG) || defined( 'ZN_FW_DEBUG' ) && ZN_FW_DEBUG == true ) ? '' : '.min';
		wp_enqueue_style( 'th-theme-template-styles', THEME_BASE_URI . '/css/template' . $suffix . '.css', array('kallyas-styles'), ZN_FW_VERSION );

	}
}

if(! function_exists('wpkLoadPrintRtl')) {
	/**
	 * Frontend: Load theme's print and RTL stylesheets
	 * @hooked to wp_enqueue_scripts.
	 * @see functions.php
	 */
	function wpkLoadPrintRtl()
	{
		// PRINT STYLESHEET
		wp_enqueue_style( 'th-theme-print-stylesheet', THEME_BASE_URI . '/css/print.css', array('kallyas-styles'), ZN_FW_VERSION, 'print' );
		// RTL STYLESHEET
		if ( is_rtl() ) {
			wp_enqueue_style(  'kallyas-rtl',  THEME_BASE_URI ."/css/rtl.css", array('kallyas-styles'), ZN_FW_VERSION );
		}
	}
}

if(! function_exists('wpkLoadPluginsCss')) {
	/**
	 * Frontend: Load theme's plugins overrides stylesheets
	 * @hooked to wp_enqueue_scripts.
	 * @see functions.php
	 */
	function wpkLoadPluginsCss()
	{
		// Woocommerce Own Stylesheet
		if ( zn_is_plugin_installed('woocommerce') && zn_is_plugin_active('woocommerce/woocommerce.php') && znfw_is_woocommerce_active() ) {
			wp_enqueue_style( 'woocommerce-overrides', THEME_BASE_URI . '/css/plugins/kl-woocommerce.css', array('kallyas-styles'), ZN_FW_VERSION );
		}
		// BuddyPress Own Stylesheet
		if ( zn_is_plugin_installed('buddypress') && zn_is_plugin_active('buddypress/bp-loader.php') ) {
			wp_enqueue_style( 'buddypress-overrides', THEME_BASE_URI . '/css/plugins/kl-buddypress.css', array('kallyas-styles'), ZN_FW_VERSION );
		}
		// BBpress Own Stylesheet
		if ( zn_is_plugin_installed('bbpress') && zn_is_plugin_active('bbpress/bbpress.php') ) {
			wp_enqueue_style( 'bbpress-overrides', THEME_BASE_URI . '/css/plugins/kl-bbpress.css', array('kallyas-styles'), ZN_FW_VERSION );
		}
		// Event Calendar WD Own Stylesheet
		if ( zn_is_plugin_installed('event-calendar-wd') && zn_is_plugin_active('event-calendar-wd/ecwd.php') ) {
			wp_enqueue_style( 'ecwd-overrides', THEME_BASE_URI . '/css/plugins/kl-calendar.css', array('kallyas-styles'), ZN_FW_VERSION );
		}
		// Bookly plugin
		if ( zn_is_plugin_installed('bookly-responsive-appointment-booking-tool') && zn_is_plugin_active('bookly-responsive-appointment-booking-tool/main.php') ) {
			wp_enqueue_style( 'bookly', THEME_BASE_URI . '/css/plugins/kl-bookly.css', array('kallyas-styles'), ZN_FW_VERSION );
		}
		// print_z(get_option( 'active_plugins', array() ));
	}
}

if(! function_exists('wpkLoadDynamicCss')) {
	/**
	 * Frontend: Load theme's dynamic CSS
	 * @hooked to wp_enqueue_scripts.
	 * @see functions.php
	 */
	function wpkLoadDynamicCss()
	{
		// Generated css file - The options needs to be saved in order to generate new file
		$uploads = wp_upload_dir();
		$saved_date = zget_option( 'saved_date', 'advanced', false, ZN_FW_VERSION );
		wp_enqueue_style( 'th-theme-options-styles', trailingslashit($uploads['baseurl']) . 'zn_dynamic.css', array('kallyas-styles'), $saved_date  );
	}
}


/**
 * Frontend: Load theme's default scripts
 */
if(! function_exists('wpkLoadGlobalScriptsFrontend')) {
	/**
	 * Frontend: Load theme's default scripts
	 * @hooked to wp_enqueue_scripts.
	 * @see functions.php
	 */
	function wpkLoadGlobalScriptsFrontend() {

		$suffix = ( (defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG) || defined( 'ZN_FW_DEBUG' ) && ZN_FW_DEBUG == true ) ? '' : '.min';

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-plugins', THEME_BASE_URI . '/js/plugins'.$suffix.'.js', array( 'jquery' ), ZN_FW_VERSION, true );

		// Adds JavaScript to pages with the comment form to support sites with
		// threaded comments (when in use).
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Register scripts without loading
		wp_register_script( 'caroufredsel', THEME_BASE_URI . '/addons/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );

		wp_enqueue_script( 'scrollmagic', THEME_BASE_URI . '/addons/scrollmagic/scrollmagic-tweenlite.js', array ( 'jquery' ), ZN_FW_VERSION, true );

		// if( (defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG) || defined( 'ZN_FW_DEBUG' ) && ZN_FW_DEBUG == true ){
			// wp_enqueue_script( 'scrollmagic_indicators', THEME_BASE_URI . '/addons/scrollmagic/debug.addIndicators.min.js', array ( 'scrollmagic' ), ZN_FW_VERSION, true );
		// }

	}
}

/**
 * Frontend: Only load scripts and stylesheets when needed
 */
if(! function_exists('wpkSmartScriptLoaderFrontend')) {
	/**
	 * Frontend: Only load scripts and stylesheets when needed
	 * @hooked to wp_enqueue_scripts.
	 * @see functions.php
	 */
	function wpkSmartScriptLoaderFrontend()
	{
//<editor-fold desc=">>> SCRIPTS">
		$res_menu_trigger = zget_option( 'header_res_width', 'general_options', false, 992 );
		$suffix = ( (defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG) || defined( 'ZN_FW_DEBUG' ) && ZN_FW_DEBUG == true ) ? '' : '.min';
		// Load the theme scripts
		wp_enqueue_script( 'zn-script', THEME_BASE_URI . '/js/znscript'.$suffix.'.js', array ( 'jquery' ), ZN_FW_VERSION, true );
		wp_localize_script( 'zn-script', 'zn_do_login', array (
			'ajaxurl' => admin_url( 'admin-ajax.php', 'relative' ),
			'add_to_cart_text' => __( 'Item Added to cart!', 'zn_framework' ),
		) );
		wp_localize_script( 'zn-script', 'ZnThemeAjax', array(
			'ajaxurl'          => admin_url( 'admin-ajax.php', 'relative' ),
			'zn_back_text'     => __( 'Back', 'zn_framework' ),
			'res_menu_trigger' => ( int )$res_menu_trigger,
		) );

		// Smooth Scroll
		$sm_scroll = zget_option( 'smooth_scroll', 'general_options' , false, 'no' );
		if ( $sm_scroll != 'no' ) {
			wp_localize_script( 'zn-script', 'ZnSmoothScroll', array(
				'type' => $sm_scroll,
				'osx' => zget_option( 'smooth_scroll_osx', 'general_options' , false, 'no' ),
			));
		}

//</editor-fold desc=">>> SCRIPTS">
	}
}


/**
 * Check if the coming soon option enabled and display the custom page set in theme options
 */
add_action( 'template_redirect', 'zn_coming_soon_page', 1000 );
if ( ! function_exists( 'zn_coming_soon_page' ) ) {
	/**
	 * Check if the coming soon option enabled and display the custom page set in theme options
	 * @hooked to template_redirect
	 */
	function zn_coming_soon_page(){
		global $pagenow;

		if ( zget_option( 'cs_enable', 'coming_soon_options', false, 'no' ) == 'yes' && !is_user_logged_in() && !is_admin() && $pagenow != 'wp-login.php')
		{
			$csTemplate = zget_option('cs_page_template', 'coming_soon_options', false, '__zn_default__');
			global $post;
			if(isset($post->ID) && $post->ID <> $csTemplate)
			{
				wp_redirect(get_permalink($csTemplate));
				exit;
			}
		}
	}
}

/**
 * Check if the coming soon option enabled and display the default template
 */
add_action( 'wp_loaded', 'zn_coming_soon_page_default', 26 );
if (! function_exists('zn_coming_soon_page_default')){
	/**
	 * Check if the coming soon option enabled and display the default template
	 * @hooked to wp_loaded
	 */
	function zn_coming_soon_page_default(){
		global $pagenow;

		if ( zget_option( 'cs_enable', 'coming_soon_options', false, 'no' ) == 'yes' && !is_user_logged_in() && !is_admin() && $pagenow != 'wp-login.php')
		{
			$csTemplate = zget_option('cs_page_template', 'coming_soon_options', false, '__zn_default__');
			if('__zn_default__' == $csTemplate) {
				get_template_part( 'page', 'coming-soon' );
				exit;
			}
		}
	}
}
/**
 * Check for boxed layout or full and add specific CSS class by filter
 */
if ( ! function_exists( 'zn_body_class_names' ) ) {
	/**
	 * Check for boxed layout or full and add specific CSS class by filter
	 * @param $classes
	 * @hooked to body_class
	 * @see functions.php
	 * @return array
	 */
	function zn_body_class_names( $classes )
	{
		// [wpk] Flags
		// @since 4.0.9
		// Simple flag to indicate whether or not the class has been added to body
		$boxed = false;
		// Simple flag so we don't have to check again below
		$except = false;

		$zn_home_boxed_layout = zn_get_layout_option( 'zn_home_boxed_layout', 'layout_options', false, 'def' );
		if ( ( zn_get_layout_option( 'zn_boxed_layout', 'layout_options', false, 'no' ) == 'yes' ) ||
			( is_front_page() && $zn_home_boxed_layout == 'yes' ) ) {
			$classes[] = 'boxed';
			$boxed = true;
		}
		if ( is_front_page() && $zn_home_boxed_layout == 'no' ) {
			$classes = array_diff( $classes, array ( "boxed" ) );
			$boxed = false;
			$except = true;
		}

		// [wpk] Check boxed layout option for current page
		// @since v4.0.9
		if(! $except )
		{
			$isBoxedLayout = (zn_get_layout_option( 'zn_boxed_layout', 'layout_options', false, 'no' ) == 'yes');
			$pageBoxedLayout = get_post_meta( get_the_ID(), 'zn_page_override_boxed_layout', true );

			if('def' == $pageBoxedLayout){
				if(! $isBoxedLayout && $boxed){
					$classes = array_diff( $classes, array ( "boxed" ) );
				}
			}
			elseif('yes' == $pageBoxedLayout){
				if(! $isBoxedLayout && !$boxed){
					$classes[] = 'boxed';
				}
			}
			elseif('no' == $pageBoxedLayout){
				if($isBoxedLayout && $boxed){
					$classes = array_diff( $classes, array ( "boxed" ) );
				}
			}
		}


		if ( zget_option('zn_width','layout_options') == '1170' ) {
			$classes[] = 'res1170';
		}
		elseif ( zget_option('zn_width','layout_options') == '960' ) {
			$classes[] = 'res960';
		}

		$menu_follow = zn_get_layout_option( 'menu_follow', 'general_options' , false, 'no' );
		if ( $menu_follow == 'yes' ) {
			$classes[] = 'kl-follow-menu';
		} else if( $menu_follow == 'sticky' ) {
			$classes[] = 'kl-sticky-header';
		}

		$classes[] = 'kl-skin--'.zget_option( 'zn_main_style', 'color_options', false, 'light' );

		if ( zn_is_plugin_installed('event-calendar-wd') && zn_is_plugin_active('event-calendar-wd/ecwd.php') ) {
			$classes[] = 'ecwd-kallyas';
		}

		return $classes;
	}
}


//<editor-fold desc=">>> AFTER_BODY ACTIONS">
/**
 * Add page loading
 */
if ( ! function_exists( 'zn_add_page_loading' ) ) {
	/**
	 * Add page loading
	 * @hooked to zn_after_body
	 * @see functions.php
	 */
	function zn_add_page_loading(){
		zn_page_loading();
	}
}

/**
 * Open Graph
 */
if ( ! function_exists( 'zn_add_open_graph' ) ) {
	/**
	 * Open Graph
	 * @hooked to zn_after_body
	 * @see functions.php
	 */
	function zn_add_open_graph(){
		?>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		<?php
	}
}

//</editor-fold desc=">>> AFTER_BODY ACTIONS">


//<editor-fold desc=">>> ZN_HEAD_RIGHT_AREA">



/**
 * Recursive wp_parse_args WordPress function which handles multidimensional arrays
 * @url http://mekshq.com/recursive-wp-parse-args-wordpress-function/
 * @param  array &$a Args
 * @param  array $b  Defaults
 */
function zn_wp_parse_args( &$a, $b ) {
	$a = (array) $a;
	$b = (array) $b;
	$result = $b;
	foreach ( $a as $k => &$v ) {
		if ( is_array( $v ) && isset( $result[ $k ] ) ) {
			$result[ $k ] = zn_wp_parse_args( $v, $result[ $k ] );
		} else {
			$result[ $k ] = $v;
		}
	}
	return $result;
}


//</editor-fold desc=">>> ZN_HEAD_RIGHT_AREA">


/**
 * Retrieve the post attachment URL
 */
if ( ! function_exists( 'echo_first_image' ) ) {
	/**
	 * Retrieve the post attachment URL
	 * @return bool|string
	 */
	function echo_first_image(){
		global $post;

		$id = $post->ID;

		// Check if the post has any images
		$post = get_post( $id );

		preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );

		if(isset($matches[1][0])){
			if ( ! empty( $matches[1][0] ) && basename( $matches[1][0] ) != 'trans.gif' ) {
				return esc_url( $matches[1][0] );
			}
			elseif (isset($matches[1][1]) && ! empty( $matches[1][1] ) ) {
				return esc_url( $matches[1][1] );
			}
		}

		return '';
	}
}

//<editor-fold desc=">>> WPK">


/*
 * Display the dismissible admin notice regarding the usage of the Cute3D Slider
 */
if ( ! function_exists( 'kallyasShowCuteSliderNotice' ) ) {
	/**
	 * Display the notification regarding the usage of the 3D Cute Slider
	 */
	function kallyasShowCuteSliderNotice()
	{
		do_action( 'wpk_dismissible_notice',
			'error',
			__( 'The plugin 3D Cute Slider is no longer supported by its author and it was removed from Envato Marketplace.
			We will try to continue offering support for it as much as we can but we strongly recommend you to replace its
			usage with an other slider or continue using it at your own risk.', 'zn_framework' ),
			'kallyas-dismiss-notice' );
	}
}

/**
 * Add option to select custom header in Edit Category page
 */
if ( ! function_exists( 'wpk_zn_edit_category_form' ) ) {
	/**
	 * Add option to select custom header in Edit Category page
	 * @param $term
	 * @hooked to sanitize_text_field( $_REQUEST['taxonomy'] ) . '_edit_form'
	 * @see functions.php
	 */
	function wpk_zn_edit_category_form( $term )
	{ ?>
		<h2><?php echo ZN()->theme_data['name'] .' '. _e( 'Options ', 'zn_framework' ); ?></h2>
		<table class="form-table">
			<tbody>
			<tr class="form-field form-required term-name-wrap">
				<th scope="row">
					<label for="wpk_zn_select_custom_header"><?php _e( 'Select Sub-header', 'zn_framework' ); ?></label>
				</th>
				<td>
					<?php
					// GET ALL CUSTOM HEADERS
					$allHeaders = WpkZn::getThemeHeaders(true);
					if ( ! empty( $allHeaders ) ) {
						echo '<select name="wpk_zn_select_custom_header" id="wpk_zn_select_custom_header">';
						// Check option to display the previously checked option
						$optData      = get_option( 'wpk_zn_select_custom_header_' . $term->term_id );
						$selectedSlug = 'zn_def_header_style'; // use default by default
						if ( ! empty( $optData ) ) {
							$selectedSlug = $optData;
						}
						foreach ( $allHeaders as $slug => $name ) {
							echo '<option value="' . $slug . '"';
							if ( $slug == $selectedSlug ) {
								echo ' selected="selected"';
							}
							echo '>' . $name . '</option>';
						}
						echo '</select>';
					}
					?>
					<p class="description"><?php _e( 'The custom sub-header you want to display for this category. To create a subheader please access <strong>Kallyas options > Unlimited Sub-headers</strong> .', 'zn_framework' ); ?></p>
				</td>
			</tr>
			</tbody>
		</table>
	<?php
	}
}

/**
 * Save the custom header set in the edit category screen
 */
if ( ! function_exists( 'wpk_zn_filterProductCatPost' ) ) {
	/**
	 * Save the custom header set in the edit category screen
	 */
	function wpk_zn_filterProductCatPost(){
		if ( 'POST' == strtoupper($_SERVER['REQUEST_METHOD']) ) {
			if ( isset( $_POST['action'] ) && ( $_POST['action'] == 'editedtag' ) ) {
				if ( isset( $_POST['taxonomy'] ) ) {
					if ( isset( $_POST['wpk_zn_select_custom_header'] ) && ! empty( $_POST['wpk_zn_select_custom_header'] ) ) {
						if ( isset( $_POST['tag_ID'] ) && ! empty( $_POST['tag_ID'] ) ) {
							$customHeaderSlug = sanitize_text_field( $_POST['wpk_zn_select_custom_header'] );
							if(  $_POST['wpk_zn_select_custom_header'] == 'zn_def_header_style' ){
								delete_option( 'wpk_zn_select_custom_header_' . absint( $_POST['tag_ID'] ) );
							}
							else{
								update_option( 'wpk_zn_select_custom_header_' . absint( $_POST['tag_ID'] ), $customHeaderSlug );
							}
						}
					}
				}
			}
		}
	}
}


//</editor-fold desc=">>> WPK">

/** Rev slider : hide update notices **/
if(function_exists( 'set_revslider_as_theme' )){
	add_action( 'init', 'zn_set_revslider_as_theme' );
	function zn_set_revslider_as_theme() {
		set_revslider_as_theme();
	}
}

/** Add support for new title tag in WP 4.1 **/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function zn_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'zn_render_title' );
}

/** Change default pagination prev and next text with icons */
add_filter( 'zn_pagination', 'zn_change_pagination_texts' );
function zn_change_pagination_texts( $args ){
		$args['previous_text'] = '<span class="zn_icon" data-zniconfam="glyphicons_halflingsregular" data-zn_icon="&#xe257;"></span>';
		$args['older_text'] = '<span class="zn_icon" data-zniconfam="glyphicons_halflingsregular" data-zn_icon="&#xe258;"></span>';
	return $args;
}

// Chrome v45 admin menu fix
function chromefix_inline_css()
{
	if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Chrome' ) !== false )
	{
		wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' );
	}
}
add_action('admin_enqueue_scripts', 'chromefix_inline_css');


if(! function_exists('th_wpml_get_url_for_language')) {
	/**
	 * Retrieve the appropriate url for the specified $language. Requires WPML installed and active.
	 *
	 * @param string $original_url
	 * @see:
	 * @return string
	 */
	function th_wpml_get_url_for_language( $original_url )
	{
		// Check if WPML plugin active and get the View Page url for the selected language
		if(! function_exists('is_plugin_active')){
			include_once(ABSPATH.'wp-admin/includes/plugin.php');
		}
		if(is_plugin_active('sitepress-multilingual-cms/sitepress.php') && defined('ICL_LANGUAGE_CODE')) {
			$post_id = url_to_postid( $original_url );
			$lang_post_id = icl_object_id( $post_id, 'page', true, ICL_LANGUAGE_CODE );
			$url = '';
			if ( $lang_post_id != 0 ) {
				$url = get_permalink( $lang_post_id );
			}
			else {
				// No page found, it's most likely the homepage
				global $sitepress;
				if(isset($sitepress) && is_object($sitepress)) {
					$url = $sitepress->language_url( ICL_LANGUAGE_CODE );
				}
			}
			return $url;
		}
		return $original_url;
	}
}

/**
 * Resolved pagination of custom queries on homepage
 */
add_filter('redirect_canonical','pif_disable_redirect_canonical');
function pif_disable_redirect_canonical($redirect_url) {
	if ( is_front_page() && get_query_var('page') ) $redirect_url = false;
	return $redirect_url;
}

/**
 * Function to return type of target for links
 * @since  v4.0.9
 */
if(! function_exists('zn_get_target')) {

	function zn_get_target($target = '_self'){
		$link_target = '';
		if($target == '_blank' || $target == '_self'){
			$link_target = 'target="' . $target  . '"';
		}
		else if($target == 'modal_image' || $target == 'modal'){
			$link_target = 'data-lightbox="image"';
		}
		else if($target == 'modal_iframe'){
			$link_target = 'data-lightbox="iframe"';
		}
		else if($target == 'modal_inline'){
			$link_target = 'data-lightbox="inline"';
		}
		else if($target == 'modal_inline_dyn'){
			$link_target = 'data-lightbox="inline-dyn"';
		}
		else if($target == 'smoothscroll'){
			$link_target = 'data-target="smoothscroll"';
		}
		return $link_target;
	}
}


/**
 * Display a list of link targets
 */
if( !function_exists('zn_get_link_targets') ){
	function zn_get_link_targets( $exclude = array() ){

		$targets = array(
			'_self'         => __( "Same window", 'zn_framework' ),
			'_blank'        => __( "New window", 'zn_framework' ),
			'modal'         => __( "Modal Image", 'zn_framework' ),
			'modal_iframe'  => __( "Modal Iframe", 'zn_framework' ),
			'modal_inline'  => __( "Modal Inline content", 'zn_framework' ),
			'modal_inline_dyn'  => __( "Modal Inline Dynamic (eg: pass Title to Form)", 'zn_framework' ),
			'smoothscroll'  => __( "Smooth Scroll to Anchor", 'zn_framework' )
		);

		if(!empty($exclude)){
			foreach ($exclude as $v) {
				if(array_key_exists($v, $targets)){
					unset($targets[$v]);
				}
			}
		}

		return $targets;
	}
}

/**
 * Function to add a JS with the color palette, for colorpickers
 * @since  v4.0.9
 */
add_action('znfw_scripts', 'zn_add_color_palette_js');

if(! function_exists('zn_add_color_palette_js')) {

	function zn_add_color_palette_js(){

		// if( ! ZNPB()->is_active_editor ||  ){
		//     return;
		// }

		$palettejs = '';
		$palette = zget_option( 'zn_add_colors', 'color_options', false, '' );
		if(!empty( $palette ) && is_array( $palette ) ){

			// Get last
			$plt_arrkeys = array_keys($palette);
			$last_key = end($plt_arrkeys);
			// Start JS
			$palettejs .= '<script type="text/javascript">/* <![CDATA[ */';
			$palettejs .= 'var zn_color_palette = [';
			// Add some default colors
			$palettejs .= "'".zget_option( 'zn_main_color', 'color_options', false, '#cd2122' )."',";
			$palettejs .= "'#FFF',";
			$palettejs .= "'#000',";
			foreach ($palette as $key => $value) {
				$palettejs .= "'".$value['zn_color']."'";
				// separate with comma
				if($key != $last_key){ $palettejs .= ','; }
			}
			$palettejs .= '];';
			$palettejs .= '/* ]]> */</script>';
		}
		echo $palettejs;
	}

}

add_action( 'wp_ajax_nopriv_zn_loadmore', 'zn_loadmore' );
add_action( 'wp_ajax_zn_loadmore', 'zn_loadmore' );
function zn_loadmore(){

	global $zn_config;

	$queryArgs = array(
		'post_type' => 'portfolio',
		'paged' => $_POST['offset'],
		'posts_per_page' => $_POST['ppp'],
	);

	if( !empty( $_POST['categories'] ) ){
		$queryArgs['tax_query'] = array(
			array(
				'taxonomy' => 'project_category',
				'field' => 'id',
				'terms' => explode(',',$_POST['categories'])
			),
		);
	}

	$zn_config['ptf_show_title'] = $_POST['show_item_title'];
	$zn_config['ptf_show_desc'] = $_POST['show_item_desc'];

	query_posts($queryArgs);
	if( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'inc/loop','portfolio_sortable_content' );
		}
	}

	die();
}

/**
 * Prepare individual sides css for boxmodel fields
 */
if(!function_exists('zn_add_boxmodel')){
	function zn_add_boxmodel( $boxmodel_val = '', $type = 'position' ){
		$boxmodel_css = '';
		$sep = '-';
		if($type == 'position'){
			$sep = '';
			$type = '';
		}
		if( is_array($boxmodel_val) ){
			foreach ($boxmodel_val as $edge => $val) {
				if( $val != '' && $edge != 'linked'){
					if( is_numeric($val) ){
						$val = $val.'px';
					}
					$boxmodel_css .= $type.$sep.$edge.':'.$val.';';
				}
			}
		}
		return $boxmodel_css;
	}
}

/**
 * Wrap CSS into media query
 */
if(!function_exists('zn_wrap_mediaquery')){
	function zn_wrap_mediaquery( $breakpoint = 'lg', $selector = ''){

		$mq = array();
		$mq['start'] = '';
		$mq['end'] = '';

		if(!empty($selector)) {
			$selector = $selector.'{';
		}

		$mq_lg = $selector;
		$mq_md = '@media screen and (min-width: 992px) and (max-width: 1199px){';
		$mq_sm = '@media screen and (min-width: 768px) and (max-width:991px){';
		$mq_xs = '@media screen and (max-width: 767px){';
		$mq_end = '}';

		if($breakpoint == 'lg'){
			$mq['start'] = $mq_lg;
			$mq['end'] = $mq_end;
		}
		elseif($breakpoint == 'md'){
			$mq['start'] = $mq_md.$selector;
			$mq['end'] = $mq_end.$mq_end;
		}
		elseif($breakpoint == 'sm'){
			$mq['start'] = $mq_sm.$selector;
			$mq['end'] = $mq_end.$mq_end;
		}
		elseif($breakpoint == 'xs'){
			$mq['start'] = $mq_xs.$selector;
			$mq['end'] = $mq_end.$mq_end;
		}

		return $mq;
	}
}

/**
 * Create CSS of Boxmodel option-types
 */
if(!function_exists('zn_push_boxmodel_styles')){
	function zn_push_boxmodel_styles($args = array()){

		$css = '';

		$defaults = array(
			'selector' => '',
			'type' => 'position',
			'lg' =>  array(),
			'md' =>  array(),
			'sm' =>  array(),
			'xs' =>  array(),
		);

		$args = wp_parse_args( $args, $defaults );

		if(empty($args['selector'])) return;

		$brp = array('lg', 'md', 'sm', 'xs');

		foreach ($brp as $k) {

			if(isset($args[$k]) && !empty($args[$k])) {

				$brp_css = zn_add_boxmodel( $args[$k], $args['type']);

				if( !empty($brp_css) ){
					$mq = zn_wrap_mediaquery($k, $args['selector'] );
					$css .= $mq['start'];
						if( !empty($brp_css)){
							$css .= $brp_css;
						}
					$css .= $mq['end'];
				}
			}
		}

		return $css;
	}
}


/**
 * Create CSS for typography option-types (with breakpoints)
 */
if(!function_exists('zn_typography_css')){
	function zn_typography_css($args = array()){

		$css = '';
		$defaults = array(
			'selector' => '',
			'lg' =>  array(),
			'md' =>  array(),
			'sm' =>  array(),
			'xs' =>  array(),
		);
		$args = wp_parse_args( $args, $defaults );

		if(empty($args['selector'])) return;

		$brp = array('lg', 'md', 'sm', 'xs');

		foreach ($brp as $k) {

			if(is_array($args[$k]) & !empty($args[$k])) {

				$brp_css = '';
				foreach ($args[$k] as $key => $value) {
					if($value != '') {
						if( $key == 'font-family' ){
							$brp_css .= $key .':'. zn_convert_font($value).';';
						}
						else {
							$brp_css .= $key .':'. $value.';';
						}
					}
				}

				if( !empty($brp_css) ){
					$mq = zn_wrap_mediaquery($k, $args['selector'] );
					$css .= $mq['start'];
						if( !empty($brp_css)){
							$css .= $brp_css;
						}
					$css .= $mq['end'];
				}
			}
		}

		return $css;
	}
}


if( !function_exists('zn_get_button_styles') ){
	function zn_get_button_styles(){
		return array (
			'btn-fullcolor'                     => __( "Flat (main color)", 'zn_framework' ),
			'btn-fullcolor btn-custom-color'    => __( "Flat (custom color)", 'zn_framework' ),
			'btn-fullwhite'                     => __( "Flat (white)", 'zn_framework' ),
			'btn-fullblack'                     => __( "Flat (black)", 'zn_framework' ),
			'btn-lined'                         => __( "Lined (light)", 'zn_framework' ),
			'btn-lined lined-dark'              => __( "Lined (dark)", 'zn_framework' ),
			'btn-lined lined-gray'              => __( "Lined (gray)", 'zn_framework' ),
			'btn-lined lined-custom'            => __( "Lined (main color)", 'zn_framework' ),
			'btn-lined btn-custom-color'        => __( "Lined (custom color)", 'zn_framework' ),
			'btn-lined lined-full-light'        => __( "Lined-Full (light)", 'zn_framework' ),
			'btn-lined lined-full-dark'         => __( "Lined-Full (dark)", 'zn_framework' ),
			'btn-lined btn-skewed'              => __( "Lined-Skewed (light)", 'zn_framework' ),
			'btn-lined btn-skewed lined-dark'   => __( "Lined-Skewed (dark)", 'zn_framework' ),
			'btn-lined btn-skewed lined-gray'   => __( "Lined-Skewed (gray)", 'zn_framework' ),
			'btn-fullcolor btn-skewed'          => __( "Flat-Skewed (main color)", 'zn_framework' ),
			'btn-fullcolor btn-skewed btn-custom-color' => __( "Flat-Skewed (custom color)", 'zn_framework' ),
			'btn-fullwhite btn-skewed'          => __( "Flat-Skewed (white)", 'zn_framework' ),
			'btn-fullblack btn-skewed'          => __( "Flat-Skewed (black)", 'zn_framework' ),
			'btn-fullcolor btn-bordered'        => __( "Flat Bordered (main color)", 'zn_framework' ),
			'btn-fullcolor btn-bordered btn-custom-color' => __( "Flat Bordered (custom color)", 'zn_framework' ),
			'btn-default'                       => __( "Bootstrap - Default", 'zn_framework' ),
			'btn-primary'                       => __( "Bootstrap - Primary", 'zn_framework' ),
			'btn-success'                       => __( "Bootstrap - Success", 'zn_framework' ),
			'btn-info'                          => __( "Bootstrap - Info", 'zn_framework' ),
			'btn-warning'                       => __( "Bootstrap - Warning", 'zn_framework' ),
			'btn-danger'                        => __( "Bootstrap - Danger", 'zn_framework' ),
			'btn-link'                          => __( "Bootstrap - Link", 'zn_framework' ),
			'btn-text'                          => __( "Simple linked text", 'zn_framework' ),
			'btn-text btn-custom-color'         => __( "Simple linked text (Custom Color)", 'zn_framework' ),
			'btn-underline btn-underline--thin' => __( "Simple Underline Thin", 'zn_framework' ),
			'btn-underline btn-underline--thick' => __( "Simple Underline Thick", 'zn_framework' ),
		);
	}
}


/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 *
 * <?php
 * $thumb = get_post_thumbnail_id();
 * $image = vt_resize($thumb, '', 140, 110, true);
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
*/
if ( ! function_exists( 'vt_resize' ) )
{
	/**
	 * @param null $attach_id
	 * @param null $img_url
	 * @param int $width
	 * @param int $height
	 * @param bool $crop
	 *
	 * @return array
	 */
	function vt_resize( $attach_id = null, $img_url = null, $width = 0, $height = 0, $crop = false )
	{

		if ( $attach_id ) {
			$img_url = wp_get_attachment_url( $attach_id );
		}
		$image =  mr_image_resize( $img_url, $width, $height, true , 'c' , false );


		if( is_array( $image ) && !empty( $image['url'] ) ){
			return $image;
		}
		else{
			return array(
				'url'    => $img_url,
				'width'  => $width,
				'height' => $height
			);
		}

	}
}

/**
 * Add the Kallyas Options menu entry in the admin bar
 * This method is deprecated, use WpkZn::addKallyasOptionsAdminBar() instead.
 * @param $wp_admin_bar
 * @hooked to admin_bar_menu
 * @see functions.php
 */
add_action( 'admin_bar_menu', 'addKallyasOptionsAdminBar', 100 );
function addKallyasOptionsAdminBar($wp_admin_bar){
	if ( is_user_logged_in() ) {
		if ( current_user_can( 'administrator' ) )
		{
			$mainMenuArgs = array (
				'id'    => 'kallyas-theme-options-menu-item',
				'title' => ZN()->theme_data['name'] .' '. __( 'Options', 'zn_framework' ),
				'href'  => admin_url( 'admin.php?page=zn-about' ),
				'meta'  => array (
					'class' => 'wpk-kallyas-options-menu-item'
				)
			);
			$wp_admin_bar->add_node( $mainMenuArgs );

			// Set parent
			$parentMenuID = $mainMenuArgs['id'];

			// Add the theme's pages
			$pages = null;

			if ( is_file(THEME_BASE.'/template_helpers/options/theme-pages.php') ) {
				include( THEME_BASE . '/template_helpers/options/theme-pages.php' );
				//global $admin_pages;
				$pages = $admin_pages;// apply_filters( 'zn_theme_pages', $admin_pages );
			}

			if(! empty($pages))
			{
				foreach( $pages as $slug => $entry )
				{
					$menuID = 'kallyas-theme-options-menu-item-'.$slug;
					$menuUrl = admin_url( 'admin.php?page=zn_tp_'.$slug );
					$submenuArgs = array(
						'parent' => $parentMenuID,
						'id'    => $menuID,
						'title' => $entry['title'],
						'href'  => $menuUrl,
						'meta'  => array (
							'class' => 'wpk-kallyas-options-menu-item'
						)
					);
					$wp_admin_bar->add_node( $submenuArgs );

					// check for submenus
					if(isset($entry['submenus']) && ! empty($entry['submenus']))
					{
						foreach( $entry['submenus'] as $item )
						{
							// Let's avoid duplicates
							if( strcasecmp($entry['title'], $item['title']) == 0){
								continue;
							}

							$submenuArgs = array(
								'parent' => $menuID,
								'id'    => 'kallyas-theme-options-submenu-item-'.$item['slug'],
								'title' => $item['title'],
								'href'  => $menuUrl.'#'.$item['slug'],
								'meta'  => array (
									'class' => 'wpk-kallyas-options-menu-item'
								)
							);
							$wp_admin_bar->add_node( $submenuArgs );
						}
					}
				}
			}
		}
	}
}

/**
 * Load the styles to customize the Kallyas Options menu entry in the admin bar
 * @hooked to admin_head
 * @hooked to wp_head
 * @see functions.php
 */
add_action( 'admin_head', 'addKallyasOptionsStylesAdminBar', 100 );
add_action( 'wp_head', 'addKallyasOptionsStylesAdminBar', 100 );
function addKallyasOptionsStylesAdminBar(){
	?>
	<style type="text/css" id="wpk_local_adminbar_notice_styles"> /*
		#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item:hover div,
		#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item:active div,
		#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item:focus div,
		#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item div {
			color: #eee;
			cursor: default;
			background: #222;
			position: relative;
		}
		#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item:hover div {
			color: #45bbe6 !important;
		}
		#wpadminbar .ab-top-menu .wpk-kallyas-options-menu-item > .ab-item:before {
			content: '\f111';
			top: 2px;
		} */
	</style>
<?php }

	/**
	 * Add font mime types
	 */
	add_filter('upload_mimes', 'zn_add_webfont_upload_mimes');
	function zn_add_webfont_upload_mimes($existing_mimes) {
		$existing_mimes['woff'] = 'application/font-woff';
		$existing_mimes['woff2'] = 'application/font-woff2';
		$existing_mimes['ttf'] = 'application/font-ttf';
		$existing_mimes['eot'] = 'application/vnd.ms-fontobject';
		$existing_mimes['svg'] = 'image/svg+xml';
		return $existing_mimes;
	}

	/*--------------------------------------------------------------------------------------------------
		Set-up post data
	--------------------------------------------------------------------------------------------------*/


	if ( !function_exists('zn_setup_post_data') ){
		function zn_setup_post_data( $post_format, $post_content = 'content' ) {

			global $post;

			$opt_archive_content_type = zget_option( 'sb_archive_content_type', 'blog_options', false, 'full' );

			// CHECK TO SEE IF WE NEED TO WRAP THE ARTICLE
			$post_data['before'] = ''; // Before the opening article tag
			$post_data['after'] = ''; // After the closing article tag

			$post_data['before_head'] = '';
			$post_data['after_head'] = '';

			$post_data['before_content'] = ''; // After the opening article tag
			$post_data['after_content'] = ''; // Before the closing article tag

			// Posts defaults
			$post_data['media']   = get_post_media();
			$post_data['title']   = get_the_title();
			$post_data['content'] = ( (is_archive() || is_home()) && $opt_archive_content_type == 'excerpt' ) ? get_the_excerpt() : get_the_content();

			if($post_format == 'video' || $post_format == 'audio'){
				$post_data['content'] = get_the_content();
			}

			// Separate post content and media
			$post_data            = apply_filters( 'post-format-'. $post_format , $post_data );

			if( ! empty( $post_data['content'] ) && $post_content === 'excerpt' ){
				$post_data['content'] = get_the_excerpt();
			}

			$post_data['content'] = ( (is_archive() || is_home()) && $opt_archive_content_type == 'excerpt' ) ? get_the_excerpt() : apply_filters( 'the_content', $post_data['content'] );

			return $post_data;
		}
	}

	if ( !function_exists('get_post_media') ) {

		function get_post_media() {
			$image = '';
			if ( is_single() ) {
				if ( has_post_thumbnail() ) {
					$thumb   = get_post_thumbnail_id();
					$f_image = wp_get_attachment_url( $thumb );
					$alt   = get_post_meta( $thumb, '_wp_attachment_image_alt', true );
					$title = get_the_title( $thumb );
					if ( $f_image ) {
						if ( zget_option( 'sb_use_full_image', 'blog_options', false, 'no' ) == 'yes' ) {
							$featured_image = wp_get_attachment_image_src( $thumb, 'full' );
							if ( isset( $featured_image[0] ) && ! empty( $featured_image[0] ) ) {
								$image = '<a data-lightbox="image" href="' . $featured_image[0] .
										 '" class="hoverBorder pull-left full-width kl-blog-post-img"><img src="' .
										 $featured_image[0] . '" '.ZngetImageSizesFromUrl($featured_image[0], true).' alt="' . ZngetImageAltFromUrl( $featured_image[0] ) .
										 '" title="' . ZngetImageTitleFromUrl( $featured_image[0] ) . '"/></a>';
							}
						} else {
							$feature_image = wp_get_attachment_url( $thumb );
							$image         = vt_resize( '', $f_image, 420, 280, true );
							$image         = '<a data-lightbox="image" href="' . $feature_image .
											 '" class="hoverBorder pull-left kl-blog-post-img kl-blog-post--default-view" ><img src="' .
											 $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $alt . '" title="' . $title . '"/></a>';
						}
					}
				}
			} else {
				$usePostFirstImage = ( zget_option( 'zn_use_first_image', 'blog_options', false, 'yes' ) == 'yes' );
				$th_alt   = '';
				$th_title = '';
				$hasFirstAttachedImage = false;
				if ( has_post_thumbnail() && ! post_password_required() ) {
					$thumb   = get_post_thumbnail_id( get_the_id() );
					$f_image = wp_get_attachment_url( $thumb );
					$th_alt   = get_post_meta( $thumb, '_wp_attachment_image_alt', true );
					$th_title = get_the_title( $thumb );
				} elseif ( $usePostFirstImage && ! post_password_required() ) {
					$f_image = echo_first_image();
					$th_alt   = ZngetImageAltFromUrl( $f_image );
					$th_title = ZngetImageTitleFromUrl( $f_image );
					$hasFirstAttachedImage = true;
				}
				if ( ! empty ( $f_image ) ) {
					$featPostClass             = is_sticky( get_the_id() ) ? 'featured-post kl-blog--featured-post' : '';
					$sb_archive_use_full_image = zget_option( 'sb_archive_use_full_image', 'blog_options', false, 'no' );
					// Image Ratio
					$ratio = 1.77; // 16:9
					// $ratio = 1.33; // 4:3
					if ( ! empty( $featPostClass ) ) {
						$resized_image = vt_resize( '', $f_image, 1140, 480, true );
						$image         = '<div class="zn_full_image kl-blog-full-image">';
						if ( isset( $resized_image['url'] ) && ! empty( $resized_image['url'] ) ) {
							$image .= '<img class="zn_post_thumbnail kl-blog-post-thumbnail" src="' . $resized_image['url'] . '" width="' . $resized_image['width'] . '" height="' . $resized_image['height'] . '" alt="' . $th_alt . '" title="' . $th_title . '"/>';
						}
						$image .= '</div>';
					} elseif ( $sb_archive_use_full_image == 'yes' ) {
						if( $hasFirstAttachedImage ){
							$image_sizes = ZngetImageSizesFromUrl( $f_image, true );
							$image = '<div class="zn_full_image kl-blog-full-image"><a href="' . get_permalink() . '" class="kl-blog-full-image-link hoverBorder"><img class="kl-blog-full-image-img" src="' . $f_image . '" '.$image_sizes.' alt="' . $th_alt . '" title="' . $th_title . '" /></a></div>';
						}
						else{
							$image = '<div class="zn_full_image kl-blog-full-image"><a href="' . get_permalink() . '" class="kl-blog-full-image-link hoverBorder">' . get_the_post_thumbnail( get_the_id(), 'full-width-image', array( 'class' => 'kl-blog-full-image-img' ) ) . '</a></div>';
						}
					} else {
						$width         = zget_option( 'sb_archive_def_cwidth', 'blog_options', false, '460' );
						$height        = ceil($width / $ratio);
						$resized_image = vt_resize( '', $f_image, $width, $height, true );
						$image = '<div class="zn_post_image kl-blog-post-image">';
						$image .= '<a href="' . get_permalink() . '" class="kl-blog-post-image-link hoverBorder pull-left">';
						if ( isset( $resized_image['url'] ) && ! empty( $resized_image['url'] ) ) {
							$image .= '<img class="zn_post_thumbnail kl-blog-post-thumbnail" src="' . $resized_image['url'] . '" width="' . $resized_image['width'] . '" height="' . $resized_image['height'] . '" alt="' . $th_alt . '" title="' . $th_title . '" />';
						}
						$image .= '</a>';
						$image .= '</div>';
					}
				}
			}

			return $image;
		}
	}

	add_filter( 'post-format-standard', 'zn_post_standard', 10, 1 );
	add_filter( 'post-format-video', 'zn_post_video' );
	add_filter( 'post-format-audio', 'zn_post_audio');
	add_filter( 'post-format-quote', 'zn_post_quote' );
	add_filter( 'post-format-link', 'zn_post_link' );
	add_filter( 'post-format-gallery', 'zn_post_gallery', 10, 2 );

	// STANDARD POST
	if ( !function_exists('zn_post_standard') ){
		function zn_post_standard( $current_post ){
			$current_post['title']   = zn_wrap_titles( $current_post['title'] );
			return $current_post;
		}
	}


	// VIDEO POST
	if ( !function_exists('zn_post_video') ){
		function zn_post_video( $current_post ) {

			$current_post['content'] = preg_replace( '|^\s*(https?://[^\s"]+)\s*$|im', "[embed]$1[/embed]", $current_post['content'] );
			$current_post['title']   = zn_wrap_titles( $current_post['title'] );

			preg_match("!\[embed.+?\]|\[video.+?video\]!", $current_post['content'] , $match_video);

			if(!empty($match_video))
			{
				global $wp_embed;
				$video = $match_video[0];
				$current_post['before_head'] = '<div class="zn_iframe_wrap zn_post_media_container" '.WpkPageHelper::zn_schema_markup('video').'>'. do_shortcode( $wp_embed->run_shortcode( $video ) ) .'</div>';
				$current_post['media']       = '';
				$current_post['content']     = str_replace($match_video[0], "", $current_post['content']);
			}

			return $current_post;

		}
	}


if ( !function_exists('zn_post_audio') ){
	function zn_post_audio( $current_post ){

		$current_post['title']   = zn_wrap_titles( $current_post['title'] );
		//preg_match("!\[audio.+?\]\[\/audio\]!", $current_post['content'], $match_audio );
		preg_match("!\[embed.+?\]|\[audio.+?audio\]!", $current_post['content'] , $match_audio);
		if(!empty($match_audio))
		{
			global $wp_embed;
			$current_post['before_head']   = '<div class="zn_iframe_wrap zn_post_media_container" '.WpkPageHelper::zn_schema_markup('audio').'>'.do_shortcode( $wp_embed->run_shortcode( $match_audio[0] ) ) .'</div>';
			$current_post['media']   = '';
			$current_post['content'] = str_replace($match_audio[0], "", $current_post['content']);
		}
		else
		{

			preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $current_post['content'], $matches_iframe);

			if ( ! empty( $matches_iframe[0] ) ) {

				$current_post['before_head']   = '<div class="zn_iframe_wrap zn_post_media_container">'.$matches_iframe[0] .'</div>';
				$current_post['media']   = '';
				$current_post['content'] = str_replace($matches_iframe[0], "", $current_post['content']);
			}

		}

		return $current_post;
	}
}

// QUOTE POST
if ( !function_exists('zn_post_quote') ){
	function zn_post_quote( $current_post ){

		$old_title = $current_post['title'];
		$current_post['title'] = '<div class="kl-quote-post"><blockquote class="kl-quote-post-blockquote"><p>'.$current_post['content'].'</p><h5 class="kl-quote-post-title">'.$current_post['title'].'</h5></blockquote></div>';
		$current_post['content'] = '';
		$current_post['media'] = '';

		return $current_post;

	}
}

// LINK POST
if ( !function_exists('zn_post_link') ){
	function zn_post_link( $current_post ) {

		$post_link = ( $has_url = get_url_in_content( $current_post['content'] ) ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
		$current_post['title'] = '<div class="kl-link-post"> <span class="kl-link-post-icon text-custom glyphicon glyphicon-link"></span> <a href="'. esc_url( $post_link ).'" class="kl-link-post-url h3-typography"> '.$current_post['title'].' </a> </div>';
		$current_post['content'] = '';
		$current_post['media'] = '';

		return $current_post;

	}
}

// GALLERY POST
if ( !function_exists('zn_post_gallery') ){
	function zn_post_gallery( $current_post ) {

		preg_match("!\[(?:zn_)?gallery.+?\]!", $current_post['content'], $match_gallery);

		$current_post['title']   = zn_wrap_titles( $current_post['title'] );

		if(!empty($match_gallery))
		{
			$gallery = $match_gallery[0];

			if(strpos($gallery, 'zn_') === false)   $gallery = str_replace("gallery", 'zn_gallery', $gallery);
			// if(strpos($gallery, 'style') === false) $gallery = str_replace("]", " size=\"$size\"]", $gallery);

			$current_post['before_head']   = do_shortcode( $gallery );
			$current_post['media']   = '';
			$current_post['content'] = str_replace( $match_gallery[0], "", $current_post['content'] );

		}

		return $current_post;

	}
}

/*--------------------------------------------------------------------------------------------------
	Gallery shortcode
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_gallery' ) ) {
	function zn_gallery( $atts ) {

		extract( shortcode_atts( array(
			'order'   => 'ASC',
			'ids'     => '',
			'size'    => 'col-sm-9',
			'style'   => 'thumbnails',
			'columns' => 3,
		), $atts ) );

		$output = '';

		$attachments = get_posts( array(
				'include'        => $ids,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => 'post__in',
			)
		);

		if ( ! empty( $attachments ) && is_array( $attachments ) ) {

			$output .= '<div class="znPostGallery cfs--showOnMouseover u-mb-30 cfs--wrapper ">';
			$output .= '<ul class="zn_general_carousel cfs--default" data-fancy="false" data-transition="fade" data-direction="left" data-autoplay="1" data-timout="9000" data-easing="easeOutExpo">';
			foreach ( $attachments as $attachment ) {

				$imgAttr = array( 'class' => "img-responsive" );
				$img = zn_get_image( $attachment->ID, '1170','470', $imgAttr, true );

				$output .= '<li class="cfs--item">';
				$output .= $img;
				$output .= '</li>';
			}

			$output .= '	</ul>';

			$output .= '<div class="znPostGallery-navigationPagination">';
			$output .= '<div class="cfs-svgNav cfs-navs">';
				$output .= '<span class="cfs-svgNav-arr cfs-svgNav-prev cfs--prev">';
					$output .= '<svg viewBox="0 0 256 256"><polyline fill="none" stroke="black" stroke-width="16" stroke-linejoin="round" stroke-linecap="round" points="184,16 72,128 184,240"/></svg>';
				$output .= '</span>';
				$output .= '<span class="cfs-svgNav-arr cfs-svgNav-next cfs--next">';
					$output .= '<svg viewBox="0 0 256 256"><polyline fill="none" stroke="black" stroke-width="16" stroke-linejoin="round" stroke-linecap="round" points="72,16 184,128 72,240"/></svg>';
				$output .= '</span>';
			$output .= '</div>';
			$output .= '<div class="znPostGallery-pagination cfs--pagination"></div>';
			$output .= '</div>';

			$output .= '	</div>';

		}

		return $output;

	}
}
add_shortcode( 'zn_gallery', 'zn_gallery' );

/*--------------------------------------------------------------------------------------------------
	Wrap post titles based on page
--------------------------------------------------------------------------------------------------*/
if ( !function_exists('zn_wrap_titles') ){
	function zn_wrap_titles( $title , $link = true ){

		$title_tag = apply_filters('zn_blog_archive_titletag','h3');

		if ( $link ) {
			$title   = is_single() ? '<h1 class="page-title kl-blog-post-title entry-title" '.WpkPageHelper::zn_schema_markup('title').'>'. $title .'</h1>' : '<'.$title_tag.' class="itemTitle kl-blog-item-title" '.WpkPageHelper::zn_schema_markup('title').'><a href="'. esc_url( get_permalink() ) .'" rel="bookmark">'. $title .'</a></'.$title_tag.'>';
		}
		else {
			$title   = is_single() ? '<h1 class="page-title kl-blog-post-title entry-title" '.WpkPageHelper::zn_schema_markup('title').'>'. $title .'</h1>' : '<'.$title_tag.' class="article_title entry-title">'. $title .'</'.$title_tag.'>';
		}

		return $title;
	}
}


/**
 * Get element classes that are globally applied in Misc. tab.
 */
if ( !function_exists('zn_get_element_classes') ){
	function zn_get_element_classes($options){

		$classes = array();

		if(!empty($options) ){

			// add breakpoint classes
			if(array_key_exists('znpb_hide_breakpoint', $options)) {
				foreach ($options['znpb_hide_breakpoint'] as $breakpoint) {
					$classes[] = 'hidden-' . $breakpoint;
				}
			}

			// add custom element css class
			if(array_key_exists('css_class', $options)) {
				$classes[] = $options['css_class'];
			}

			// add custom animation css class
			if(array_key_exists('appear_animation', $options)) {
				$classes[] = $options['appear_animation'];
			}
		}
		return implode(' ', $classes);
	}
}

/**
 * Get element attributes that are globally applied in Misc. tab.
 */
if ( !function_exists('zn_get_element_attributes') ){
	function zn_get_element_attributes($options){

		$attributes = array();

		if(!empty($options) ){

			// add custom element animation attribute
			if( array_key_exists('appear_animation', $options) && array_key_exists('appear_delay', $options) ) {
				if($options['appear_animation'] != 'wow no_animation' && $options['appear_animation'] != 'no_animation') {
					$attributes[] = 'data-wow-delay="'.$options['appear_delay'].'ms"';
				}
			}

		}
		return implode(' ', $attributes);
	}
}

if ( ! function_exists( 'zn_animations_scripts' ) ) {
	function zn_animations_scripts() {
		wp_enqueue_style( 'animate.css', THEME_BASE_URI . '/addons/wowjs/animate.min.css', '', ZN_FW_VERSION );
		wp_enqueue_script( 'wowjs', THEME_BASE_URI . '/addons/wowjs/wow.js', array( 'jquery' ), ZN_FW_VERSION );
	}
}

add_action('init', 'zn_enable_animations');
if ( ! function_exists( 'zn_enable_animations' ) ) {
	function zn_enable_animations() {
		if( zget_option( 'zn_animations', 'layout_options', false, 'no' ) == 'yes'){
			add_filter( 'zn_pb_options', 'zn_animation_helper', 20 );
			add_action( 'wp_enqueue_scripts', 'zn_animations_scripts', 20 );
		}
	}
}

/* Animations helper */
if ( ! function_exists( 'zn_animation_helper' ) ) {
	function zn_animation_helper( $options ) {

		if( empty( $options ) ) { return $options; }

		$default_options = array(
			array(
				'id'          => 'appear_animation',
				'name'        => 'Appear animation',
				'description' => 'Select the appear animation for this element when it comes into the viewport',
				'type'        => 'select',
				'std'         => '',
				'options'         => array(
					'no_animation'          => 'None' ,
					'bounceIn wow'      => 'Bounce in',
					'bounceInDown wow'  => 'Bounce in down',
					'bounceInLeft wow'  => 'Bounce in left',
					'bounceInRight wow'  => 'Bounce in right',
					'bounceInUp wow'  => 'Bounce in up',
					'fadeIn wow'  => 'Fade In',
					'fadeInDown wow'  => 'Fade in down',
					'fadeInDownBig wow'  => 'Fade in down big',
					'fadeInLeft wow'  => 'Fade in left',
					'fadeInLeftBig wow'  => 'Fade in left big',
					'fadeInRight wow'  => 'Fade in right',
					'fadeInRightBig wow'  => 'Fade in right big',
					'fadeInUp wow'  => 'Fade in up',
					'fadeInUpBig wow'  => 'Fade in up big',
					'flip wow'  => 'Flip',
					'flipInX wow'  => 'flipInX',
					'flipInY wow'  => 'flipInY',
					'lightSpeedIn wow'  => 'lightSpeedIn',
					'rotateIn wow'  => 'rotateIn',
					'rotateInDownLeft wow'  => 'rotateInDownLeft',
					'rotateInDownRight wow'  => 'rotateInDownRight',
					'rotateInUpLeft wow'  => 'rotateInUpLeft',
					'rotateInUpRight wow'  => 'rotateInUpRight',
					'rollIn wow'  => 'rollIn',
					'zoomIn wow'  => 'zoomIn',
					'zoomInDown wow'  => 'zoomInDown',
					'zoomInLeft wow'  => 'zoomInLeft',
					'zoomInRight wow'  => 'zoomInRight',
					'zoomInUp wow'  => 'zoomInUp',
					'slideInDown wow'  => 'slideInDown',
					'slideInLeft wow'  => 'slideInLeft',
					'slideInRight wow'  => 'slideInRight',
					'slideInUp wow'  => 'slideInUp',

					// Hidding animations
					'bounceOut wow'  => 'Bounce out',
					'bounceOutDown wow'  => 'Bounce out down',
					'bounceOutLeft wow '  => 'Bounce out left',
					'bounceOutRight wow'  => 'Bounce out right',
					'bounceOutUp wow'  => 'Bounce out up',
					'fadeOut wow'  => 'Fade out',
					'fadeOutDown wow'  => 'Fade out down',
					'fadeOutDownBig wow'  => 'Fade out down big',
					'fadeOutLeft wow'  => 'Fade out left',
					'fadeOutLeftBig wow'  => 'Fade out left big',
					'fadeOutRight wow'  => 'Fade out right',
					'fadeOutRightBig wow'  => 'Fade out right big',
					'fadeOutUp wow'  => 'Fade out up',
					'fadeOutUpBig wow'  => 'Fade out up big',
					'lightSpeedOut wow'  => 'lightSpeedOut',
					'rotateOut wow'  => 'rotateOut',
					'rotateOutDownLeft wow'  => 'rotateOutDownLeft',
					'rotateOutDownRight wow'  => 'rotateOutDownRight',
					'rotateOutUpLeft wow'  => 'rotateOutUpLeft',
					'rotateOutUpRight wow'  => 'rotateOutUpRight',
					'hinge wow'  => 'hinge',
					'zoomOut wow'  => 'zoomOut',
					'zoomOutDown wow'  => 'zoomOutDown',
					'zoomOutLeft wow'  => 'zoomOutLeft',
					'zoomOutRight wow'  => 'zoomOutRight',
					'zoomOutUp wow'  => 'zoomOutUp',
					'slideOutDown wow'  => 'slideOutDown',
					'slideOutLeft wow'  => 'slideOutLeft',
					'slideOutRight wow'  => 'slideOutRight',
					'slideOutUp wow'  => 'slideOutUp',
					'flipOutX wow'  => 'flipOutX',
					'flipOutY wow'  => 'flipOutY',
					'rollOut wow'  => 'rollOut',
				),
			),
			array(
				'id'          => 'appear_delay',
				'name'        => 'Appear delay',
				'description' => 'Enter the number of milliseconds the animation is delayed after the element comes into the viewport. Please note that some elements can contain multiple elements that will animate progressively based on this value.',
				'type'        => 'slider',
				'std'         => '700',
				'class'       => 'zn_full',
				'helpers'     => array(
					'min' => '0',
					'max' => '3000',
					'step' => '10'
				),
			),
		);

		if( isset( $options['has_tabs'] ) ){

			if( ! empty( $options['znpb_misc'] ) ){

				$restricted = false;
				if( isset( $options['restrict'] ) && ! empty( $options['restrict'] ) ){
					if(in_array( 'appear_animation', $options['restrict'] )){
						$restricted = true;
					}
				}

				if(!$restricted){
					$znpb_misc = $options['znpb_misc'];
					$znpb_misc_merged = array_merge( $znpb_misc['options'], $default_options );
					$options['znpb_misc']['options'] = $znpb_misc_merged;
				}

			}
		}
		else{
			$options = array_merge( $options, $default_options );
		}

		return $options;

	}
}



add_action( 'wp_ajax_nopriv_zn_mailchimp_register', 'zn_mailchimp_register' );
add_action( 'wp_ajax_zn_mailchimp_register', 'zn_mailchimp_register' );
function zn_mailchimp_register(){

	$msg = '';
	if ( isset ( $_POST['zn_mc_email'] ) ) {

		$mailchimp_api = zget_option( 'mailchimp_api', 'general_options' );
		if ( ! empty ( $mailchimp_api ) ) {

			include_once( THEME_BASE . '/template_helpers/widgets/mailchimp/MCAPI.class.php' );
			$api_key = $mailchimp_api;

			$mcapi = new MCAPI( $api_key );

			if(zget_option( 'mailchimp_secure', 'general_options', false, 'no' ) == 'yes'){
				$mcapi->useSecure(true);
			}

			$merge_vars = Array (
				'EMAIL' => $_POST['zn_mc_email']
			);

			$list_id = $_POST['zn_mailchimp_list'];

			if ( $mcapi->listSubscribe( $list_id, $_POST['zn_mc_email'], $merge_vars ) ) {
				// It worked!
				$msg = '<div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . __( 'Success!&nbsp; Check your inbox or spam folder for a message containing a confirmation link.', 'zn_framework' ) . '</div>';
			}
			else {
				// An error occurred, return error message
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>' . __( 'Error:', 'zn_framework' ) . '</strong>&nbsp; ' . $mcapi->errorMessage . '</div>';
			}
		}
	}
	echo $msg; // Don't esc_html this, b/c we've already escaped it
	wp_die();
}


// Enable font size & font family selects in the editor
if ( ! function_exists( 'zn_mce_buttons' ) ) {
	function zn_mce_buttons( $buttons ) {
		array_push( $buttons, 'fontselect' ); // Add Font Select
		array_push( $buttons, 'fontsizeselect' ); // Add Font Size Select
		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'zn_mce_buttons' );

// Customize mce editor font sizes
if ( ! function_exists( 'zn_mce_text_sizes' ) ) {
	function zn_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = "10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 32px 48px";
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'zn_mce_text_sizes' );

if(!function_exists('zn_convert_font')){
	function zn_convert_font($fontfamily){

		$fonts = array(
			'arial'=>'Arial, sans-serif',
			'verdana'=>'Verdana, Geneva, sans-serif',
			'trebuchet'=>'"Trebuchet MS", Helvetica, sans-serif',
			'georgia' =>'Georgia, serif',
			'times'=>'"Times New Roman", Times, serif',
			'tahoma'=>'Tahoma, Geneva, sans-serif',
			'palatino'=>'"Palatino Linotype", "Book Antiqua", Palatino, serif',
			'helvetica'=>'Helvetica, Arial, sans-serif'
		);

		if(array_key_exists($fontfamily, $fonts)){
			$fontfamily = $fonts[$fontfamily];
		} else {
			// Google Font
			$fontfamily = '"'.$fontfamily.'", Helvetica, Arial, sans-serif;';
		}

		return $fontfamily;
	}
}


add_action( 'wp_head', 'zn_add_meta_color' );
if(!function_exists('zn_add_meta_color')){
	function zn_add_meta_color(){
		?>
			<meta name="theme-color" content="<?php echo zget_option( 'zn_main_color', 'color_options', false, '#cd2122' ); ?>">
		<?php
	}
}

add_action( 'wp_head', 'zn_add_meta_viewport' );
if(!function_exists('zn_add_meta_viewport')){
	function zn_add_meta_viewport(){
		?>
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<?php
	}
}

if(!function_exists('zn_convert_bgcolor_overlay')){
	/**
	 * Function to convert fields stored with color and opacity, but separately, to convert into alpha supporting colorpicker and maintain backwards compatibility
	 * @param  string $color Color stored
	 * @param  string $alpha Opacity stored
	 * @return strong        Color string converted to rgba.
	 */
	function zn_convert_bgcolor_overlay($options = array(), $color, $alpha, $default = ''){

		$std_bgcolor_with_opacity = $default;

		if(!empty($options) ){
			if( isset($color) && !empty($color)) {
				if(array_key_exists($color, $options)) {
					$std_bgcolor_with_opacity = $options[$color];
					if( isset($alpha) && !empty( $alpha ) ){
						if(array_key_exists($alpha, $options)) {
							$std_bgcolor_with_opacity = zn_hex2rgba_str($std_bgcolor_with_opacity, $options[$alpha] ) ;
						}
					}
				}
			}
		}

		return $std_bgcolor_with_opacity;
	}
}

if(!function_exists('zn_smart_slider_css')){
	/**
	 * Function to generate custom CSS based on breakpoints
	 */
	function zn_smart_slider_css( $opt, $selector, $def_property = 'height', $def_unit = 'px' ){
		$css = '';

		if( is_array($opt) && !empty($opt) ){

			$breakp = isset($opt['breakpoints']) ? $opt['breakpoints'] : '';
			$prop = isset($opt['properties']) ? $opt['properties'] : $def_property;

			// Default Unit
			$unit_lg = isset($opt['unit_lg']) ? $opt['unit_lg'] : $def_unit;

			$css .= $selector . ' {'.$prop.':'.$opt['lg'].$unit_lg.';}';

			if( !empty($breakp) ){
				if( isset($opt['md']) && !empty($opt['md']) ){
					$md_val = $opt['md'].$opt['unit_md'];
					if($opt['md'] == 'auto'){
						$md_val = $opt['md'];
					}
					$css .= '@media (min-width:992px) and (max-width:1199px) {'.$selector.' {'.$prop.':'.$md_val.';} }';
				}
				if( isset($opt['sm']) && !empty($opt['sm']) ){
					$sm_val = $opt['sm'].$opt['unit_sm'];
					if($opt['sm'] == 'auto'){
						$sm_val = $opt['sm'];
					}
					$css .= '@media (min-width:768px) and (max-width:991px) {'.$selector.' {'.$prop.':'.$sm_val.';} }';
				}
				if( isset($opt['xs']) && !empty($opt['xs']) ){
					$xs_val = $opt['xs'].$opt['unit_xs'];
					if($opt['xs'] == 'auto'){
						$xs_val = $opt['xs'];
					}
					$css .= '@media (max-width:767px) {'.$selector.' {'.$prop.':'.$xs_val.';} }';
				}
			}
		} else {
			if(!empty($opt)){
				$css .= $selector . ' {'.$def_property.':'.$opt.$def_unit.';}';
			}
		}

		return $css;
	}
}

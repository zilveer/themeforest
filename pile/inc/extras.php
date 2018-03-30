<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Pile
 * @since   Pile 2.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function pile_body_classes( $classes ) {
	if ( pile_option( 'enable_copyright_overlay' ) ) {
		$classes[] = 'is--copyright-protected';
	}

	if ( is_customize_preview() ) {
		$classes[] = 'is--customizer-preview';
	}

	return $classes;
}
add_filter( 'body_class', 'pile_body_classes' );

/**
 * Add the CSS class for 3D effect of the the grid, if the option is activated
 *
 * @param $classes
 *
 * @return array
 */
function pile_portfolio_3d_classes( $classes ) {
	// Should we apply a drop-dead-when-you-see-it 3D effect?
	$pile_3d_effect = pile_option( 'pile_3d_effect' );
	if ( empty( $pile_3d_effect ) ) {
		$classes[] = 'pile--no-3d';
	} else {
		$classes[] = 'pile--' . pile_option( 'pile_3d_target_rule' );
		$classes[] = ' pile--' . pile_option( 'pile_3d_target' );
	}

	return $classes;
}
add_filter( 'pile_portfolio_classes', 'pile_portfolio_3d_classes', 15, 1 );

/**
 * Add the CSS classes depending on the column sizes settings
 *
 * @param $classes
 *
 * @return array
 */
function pile_portfolio_column_sizes_classes( $classes ) {
	$large_no  = pile_option( 'pile_large_columns' );
	//apply the default if nothing else
	if ( empty( $large_no ) ) {
		$large_no = 3;
	}
	$classes[] = 'pile-large-col-' . $large_no;

	$medium_no = pile_option( 'pile_medium_columns' );
	//apply the default if nothing else
	if ( empty( $medium_no ) ) {
		$medium_no = 2;
	}
	$classes[] = 'pile-medium-col-' . $medium_no;

	$small_no  = pile_option( 'pile_small_columns' );
	//apply the default if nothing else
	if ( empty( $small_no ) ) {
		$small_no = 1;
	}
	$classes[] = 'pile-small-col-' . $small_no;

	return $classes;
}
add_filter( 'pile_portfolio_classes', 'pile_portfolio_column_sizes_classes', 20, 1 );

/**
 * Add the infinite scroll class if the option is activated
 *
 * @param $classes
 *
 * @return array
 */
function pile_portfolio_infinite_scroll_class( $classes ) {
	// Should we use infinite scroll?
	$infinite_scroll = get_post_meta( get_the_ID(), '_pile_portfolio_infiniteZZ_scroll', true );

	if ( $infinite_scroll ) {
		$classes[] = 'infinite-scroll';
	}

	return $classes;
}
add_filter( 'pile_portfolio_classes', 'pile_portfolio_infinite_scroll_class', 10, 1 );

function pile_option( $option, $default = null ) {
	global $pagenow, $pixcustomify_plugin;

	// if there is set an key in url force that value
	if ( isset( $_GET[ $option ] ) && ! empty( $option ) ) {
		return $_GET[ $option ];
	} elseif ( ! empty( $pixcustomify_plugin ) && $pixcustomify_plugin->has_option( $option ) ) {
		// if this is a customify value get it here
		return $pixcustomify_plugin->get_option( $option, $default );
	}

	return $default;
}

function pile_get_hero_slides_ids( $post = null ){
	if ( empty( $post ) ) {
		$post = get_queried_object();
	}

	if ( empty( $post ) ) {
		return false;// it doesn't matter, all hope is lost
	}

	$to_return = array();

	/* We can get slides from 3 sources: images, videos and featured projects */

	// First get the Hero Images attachment ids
	$attachment_ids = trim( get_post_meta( $post->ID, '_pile_second_image', true ) );
	if ( ! empty( $attachment_ids ) ) {
		$attachment_ids = explode( ',', $attachment_ids );
		$to_return = array_merge( $to_return, $attachment_ids );
	}

	// Secondly, the Hero Videos attachment ids
	$videos_ids = trim( get_post_meta( $post->ID, '_videos_backgrounds', true ) );
	if ( ! empty( $videos_ids ) ) {
		$videos_ids = explode( ',', $videos_ids );
		$to_return = array_merge( $to_return, $videos_ids );
	}

	// if we have made it thus far and still haven't found some images or videos, but there is some hero content, add the 0 id to the list
	// this way the hero loop will work, bypassing the attachment part (there is no attachment with the id 0)
	// also, this prevents from mistakenly counting the number of slides needed (1 instead of 2 for example -> we would assume no slide would be needed)
	if ( empty( $to_return ) && pile_has_hero_description( $post ) ) {
		$to_return[] = 0;
	}

	// Thirdly, the Featured Projects
	$featured_projects = trim( get_post_meta( $post->ID, '_pile_portfolio_featured_projects', true ) );
	if ( ! empty( $featured_projects ) ) {
		$featured_projects = explode( ',', $featured_projects );
		$to_return = array_merge( $to_return, $featured_projects );
	}

	// now return the slides in this order: images, videos, projects
	return $to_return;
}

/**
 * Get the image src attribute.
 *
 * @return string|false
 */
function pile_image_src( $target, $size = null ) {
	if ( isset( $_GET[ $target ] ) && ! empty( $target ) ) {
		return pile_get_attachment_image_src( $_GET[ $target ], $size );
	} else { // empty target, or no query
		$image = pile_option( $target );
		if ( is_numeric( $image ) ) {
			return pile_get_attachment_image_src( $image, $size );
		}
	}
	return false;
}

function pile_get_attachment_image_src( $id, $size = null ) {
	//bail if not given an attachment id
	if ( empty( $id ) || ! is_numeric( $id ) ) {
		return false;
	}

	$array = wp_get_attachment_image_src( $id, $size );

	if ( isset( $array[0] ) ) {
		return $array[0];
	}

	return false;
}

/**
 * Load custom javascript set by theme options
 */
function pile_callback_load_custom_js() {
	$custom_js = pile_option( 'custom_js' );
	if ( ! empty( $custom_js ) ) {
		//first lets test is the js code is clean or has <script> tags and such
		//if we have <script> tags than we will not enclose it in anything - raw output
		if ( strpos( $custom_js, '</script>' ) !== false ) {
			echo $custom_js . "\n";
		} else {
			echo "<script>\n(function($){\n" . $custom_js . "\n})(jQuery);\n</script>\n";
		}
	}
}
// custom javascript handlers - make sure it is the last one added
add_action( 'wp_head', 'pile_callback_load_custom_js', 999 );

function pile_callback_load_custom_js_footer() {
	$custom_js = pile_option( 'custom_js_footer' );
	if ( ! empty( $custom_js ) ) {
		//first lets test is the js code is clean or has <script> tags and such
		//if we have <script> tags than we will not enclose it in anything - raw output
		if ( strpos( $custom_js, '</script>' ) !== false ) {
			echo $custom_js . "\n";
		} else {
			echo "<script>\n(function($){\n" . $custom_js . "\n})(jQuery);\n</script>\n";
		}
	}
}
add_action( 'wp_footer', 'pile_callback_load_custom_js_footer', 999 );

/**
 * Load custom styles set by the page
 */
function pile_callback_load_custom_page_css() {
	global $post;

	$output = '';
	$custom_css = get_post_meta(get_the_ID(), 'custom_css_style', true);
	if ( ! empty( $custom_css ) ) {
		$output = "<div id=\"customCSS\" data-css=\"" . $custom_css . "\"></div>\n";
	}

	echo $output;
}
add_action( 'pile_page_custom_css', 'pile_callback_load_custom_page_css');

/**
 * Invoked in wpgrade-config.php
 */
function pile_callback_addthis() {
	//lets determine if we need the addthis script at all
	$social_share = false;
	if ( is_singular() && ( pile_option( 'blog_single_show_share_links' ) || pile_option( 'portfolio_single_show_share_links' ) ) ) {
		$social_share = true;
	}
	if ( is_page() ) {
		$social_share = get_post_meta( get_the_ID(), '_pile_page_enabled_social_share', true );
		if ( get_page_template_slug() == 'page-templates/contact.php' ) {
			$social_share = get_post_meta( get_the_ID(), '_pile_gmap_enabled_social_share', true );
		}
	}

	if ( $social_share ) :
		wp_enqueue_script( 'addthis-api' );

		//here we will configure the AddThis sharing globally
		?>
<script type="text/javascript">
	addthis_config = {
		<?php if ( pile_option( 'share_buttons_enable_tracking' ) && pile_option( 'share_buttons_enable_addthis_tracking' ) ) :
		echo 'username : "'.pile_option('share_buttons_addthis_username').'",';
		endif; ?>
		ui_click : false,
		ui_delay : 100,
		ui_offset_top: 16,
		ui_offset_left: -12,
		ui_use_css : true,
		data_track_addressbar : false,
		data_track_clickback : false
		<?php if ( pile_option( 'share_buttons_enable_tracking' ) && pile_option( 'share_buttons_enable_ga_tracking' ) ) :
			echo ', data_ga_property: "' . pile_option( 'share_buttons_ga_id' ) . '"';
			if ( pile_option( 'share_buttons_enable_ga_social_tracking' ) ) :
				echo ', data_ga_social : true';
			endif;
		endif; ?>
		};

	addthis_share = {
		url : "<?php echo get_permalink(); ?>",
		title : "<?php wp_title( '|', true, 'right' ); ?>",
		description : "<?php echo trim( strip_tags( get_the_excerpt() ) ) ?>"
	};
</script>
	<?php endif;
}
add_action( 'wp_enqueue_scripts', 'pile_callback_addthis' );


/**
 * Gallery filters
 */
add_filter( 'use_default_gallery_style', '__return_false' );


/*
 * Add custom filter for gallery shortcode output
 */
function pile_custom_post_gallery( $output, $attr ) {

	global $post, $wp_locale;
	static $instance = 0;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );
	extract( shortcode_atts( array(
		'order'       => 'ASC',
		'orderby'     => 'menu_order ID',
		'id'          => $post ? $post->ID : 0,
		'itemtag'     => $html5 ? 'figure' : 'dl',
		'icontag'     => $html5 ? 'div' : 'dt',
		'captiontag'  => $html5 ? 'figcaption' : 'dd',
		'columns'     => 3,
		'size'        => 'thumbnail',
		'include'     => '',
		'exclude'     => '',
		'link'        => '',
		'mkslideshow' => false,
	), $attr, 'gallery' ) );

	$id = intval( $id );
	if ( 'RAND' == $order ) {
		$orderby = 'none';
	}

	if ( ! empty( $include ) ) {
		$_attachments = get_posts( array(
			'include'        => $include,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby
		) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}
	} elseif ( ! empty( $exclude ) ) {
		$attachments = get_children( array(
			'post_parent'    => $id,
			'exclude'        => $exclude,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby
		) );
	} else {
		$attachments = get_children( array(
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

	//If we need to make a slideshow out of this gallery
	//else just let if be
	if ( "true" === $mkslideshow ) {

		$output .= '
				<div class="pixslider  pixslider--gallery-slideshow  js-pixslider"
				     data-arrows
				     data-imagescale="none"
				     data-autoheight
				     data-slidertransition="slide"
				     >';
		foreach ( $attachments as $id => $attachment ) :

			$full_img          = wp_get_attachment_image_src( $attachment->ID, 'full-size' );
			$attachment_fields = get_post_custom( $attachment->ID );

			// prepare the video url if there is one
			$video_url = ( isset( $attachment_fields['_video_url'][0] ) && ! empty( $attachment_fields['_video_url'][0] ) ) ? esc_url( $attachment_fields['_video_url'][0] ) : '';

			// should the video auto play?
			$video_autoplay = ( isset( $attachment_fields['_video_autoplay'][0] ) && ! empty( $attachment_fields['_video_autoplay'][0] ) && $attachment_fields['_video_autoplay'][0] === 'on' ) ? $attachment_fields['_video_autoplay'][0] : '';

			$output .= '<div class="gallery-item' . ( ! empty( $video_url ) ? ' video' : '' ) . ( ( $video_autoplay == 'on' ) ? ' video_autoplay' : '' ) . '" itemscope
						     itemtype="http://schema.org/ImageObject"
						     data-caption="' . htmlspecialchars( $attachment->post_excerpt ) . '"
						     data-description="' . htmlspecialchars( $attachment->post_content ) . '"' . ( ( ! empty( $video_autoplay ) ) ? 'data-video_autoplay="' . $video_autoplay . '"' : '' ) . '>
							<img src="' . $full_img[0] . '" class="attachment-blog-big rsImg"
							     alt="' . $attachment->post_excerpt . '"
							     itemprop="contentURL" ' . ( ( ! empty( $video_url ) ) ? ' data-rsVideo="' . $video_url . '"' : '' ) . ' />
						</div>';
		endforeach;
		$output .= '</div>';

	}

	//if we reach this point then we haven't modified the regular galleries
	return $output;
}
add_filter( 'post_gallery', 'pile_custom_post_gallery', 10, 2 );

function pile_overwrite_gallery_atts( $out, $pairs, $atts ) {

	//if we need to make a slideshow then output full size images
	if ( isset( $atts['mkslideshow'] ) && $atts['mkslideshow'] == true ) {
		$out['size'] = 'full-size';
	} elseif ( isset( $atts['columns'] ) ) { //else smaller images depending on no. of columns
		switch ( $atts['columns'] ) {
			case '1':
				$out['size'] = 'large-size';
				break;
			case '2':
				$out['size'] = 'medium-size';
				break;
		}

	}

	return $out;
}
//use different image sizes depending on the number of columns
add_filter( 'shortcode_atts_gallery', 'pile_overwrite_gallery_atts', 10, 3 );

/**
 * Clean up uploaded file names
 * @author toscho
 * @url    https://github.com/toscho/Germanix-WordPress-Plugin
 */
function pile_sanitize_file_name( $filename ) {
	$filename = html_entity_decode( $filename, ENT_QUOTES, 'utf-8' );
	$filename = pile_translit( $filename );
	$filename = pile_lower_ascii( $filename );
	$filename = pile_remove_doubles( $filename );

	return $filename;
}

add_filter( 'sanitize_file_name', 'pile_sanitize_file_name', 10 );


function pile_lower_ascii( $str ) {
	$str   = strtolower( $str );
	$regex = array(
		'pattern'     => '~([^a-z\d_.-])~',
		'replacement' => ''
	);
	// Leave underscores, otherwise the taxonomy tag cloud in the
	// backend won’t work anymore.
	return preg_replace( $regex['pattern'], $regex['replacement'], $str );
}

/**
 * Reduces repeated meta characters (-=+.) to one.
 */
function pile_remove_doubles( $str ) {
	$regex = apply_filters( 'germanix_remove_doubles_regex', array(
		'pattern'     => '~([=+.-])\\1+~',
		'replacement' => "\\1"
	) );

	return preg_replace( $regex['pattern'], $regex['replacement'], $str );
}

/**
 * Replaces non ASCII chars.
 */
function pile_translit( $str ) {
	$utf8 = array(
		'Ä'  => 'Ae',
		'ä'  => 'ae',
		'Æ'  => 'Ae',
		'æ'  => 'ae',
		'À'  => 'A',
		'à'  => 'a',
		'Á'  => 'A',
		'á'  => 'a',
		'Â'  => 'A',
		'â'  => 'a',
		'Ã'  => 'A',
		'ã'  => 'a',
		'Å'  => 'A',
		'å'  => 'a',
		'ª'  => 'a',
		'ₐ'  => 'a',
		'ā'  => 'a',
		'Ć'  => 'C',
		'ć'  => 'c',
		'Ç'  => 'C',
		'ç'  => 'c',
		'Ð'  => 'D',
		'đ'  => 'd',
		'È'  => 'E',
		'è'  => 'e',
		'É'  => 'E',
		'é'  => 'e',
		'Ê'  => 'E',
		'ê'  => 'e',
		'Ë'  => 'E',
		'ë'  => 'e',
		'ₑ'  => 'e',
		'ƒ'  => 'f',
		'ğ'  => 'g',
		'Ğ'  => 'G',
		'Ì'  => 'I',
		'ì'  => 'i',
		'Í'  => 'I',
		'í'  => 'i',
		'Î'  => 'I',
		'î'  => 'i',
		'Ï'  => 'Ii',
		'ï'  => 'ii',
		'ī'  => 'i',
		'ı'  => 'i',
		'I'  => 'I' // turkish, correct?
	,
		'Ñ'  => 'N',
		'ñ'  => 'n',
		'ⁿ'  => 'n',
		'Ò'  => 'O',
		'ò'  => 'o',
		'Ó'  => 'O',
		'ó'  => 'o',
		'Ô'  => 'O',
		'ô'  => 'o',
		'Õ'  => 'O',
		'õ'  => 'o',
		'Ø'  => 'O',
		'ø'  => 'o',
		'ₒ'  => 'o',
		'Ö'  => 'Oe',
		'ö'  => 'oe',
		'Œ'  => 'Oe',
		'œ'  => 'oe',
		'ß'  => 'ss',
		'Š'  => 'S',
		'š'  => 's',
		'ş'  => 's',
		'Ş'  => 'S',
		'™'  => 'TM',
		'Ù'  => 'U',
		'ù'  => 'u',
		'Ú'  => 'U',
		'ú'  => 'u',
		'Û'  => 'U',
		'û'  => 'u',
		'Ü'  => 'Ue',
		'ü'  => 'ue',
		'Ý'  => 'Y',
		'ý'  => 'y',
		'ÿ'  => 'y',
		'Ž'  => 'Z',
		'ž'  => 'z' // misc
	,
		'¢'  => 'Cent',
		'€'  => 'Euro',
		'‰'  => 'promille',
		'№'  => 'Nr',
		'$'  => 'Dollar',
		'℃'  => 'Grad Celsius',
		'°C' => 'Grad Celsius',
		'℉'  => 'Grad Fahrenheit',
		'°F' => 'Grad Fahrenheit' // Superscripts
	,
		'⁰'  => '0',
		'¹'  => '1',
		'²'  => '2',
		'³'  => '3',
		'⁴'  => '4',
		'⁵'  => '5',
		'⁶'  => '6',
		'⁷'  => '7',
		'⁸'  => '8',
		'⁹'  => '9' // Subscripts
	,
		'₀'  => '0',
		'₁'  => '1',
		'₂'  => '2',
		'₃'  => '3',
		'₄'  => '4',
		'₅'  => '5',
		'₆'  => '6',
		'₇'  => '7',
		'₈'  => '8',
		'₉'  => '9' // Operators, punctuation
	,
		'±'  => 'plusminus',
		'×'  => 'x',
		'₊'  => 'plus',
		'₌'  => '=',
		'⁼'  => '=',
		'⁻'  => '-' // sup minus
	,
		'₋'  => '-' // sub minus
	,
		'–'  => '-' // ndash
	,
		'—'  => '-' // mdash
	,
		'‑'  => '-' // non breaking hyphen
	,
		'․'  => '.' // one dot leader
	,
		'‥'  => '..' // two dot leader
	,
		'…'  => '...' // ellipsis
	,
		'‧'  => '.' // hyphenation point
	,
		' '  => '-' // nobreak space
	,
		' '  => '-' // normal space
		// Russian
	,
		'А'  => 'A',
		'Б'  => 'B',
		'В'  => 'V',
		'Г'  => 'G',
		'Д'  => 'D',
		'Е'  => 'E',
		'Ё'  => 'YO',
		'Ж'  => 'ZH',
		'З'  => 'Z',
		'И'  => 'I',
		'Й'  => 'Y',
		'К'  => 'K',
		'Л'  => 'L',
		'М'  => 'M',
		'Н'  => 'N',
		'О'  => 'O',
		'П'  => 'P',
		'Р'  => 'R',
		'С'  => 'S',
		'Т'  => 'T',
		'У'  => 'U',
		'Ф'  => 'F',
		'Х'  => 'H',
		'Ц'  => 'TS',
		'Ч'  => 'CH',
		'Ш'  => 'SH',
		'Щ'  => 'SCH',
		'Ъ'  => '',
		'Ы'  => 'YI',
		'Ь'  => '',
		'Э'  => 'E',
		'Ю'  => 'YU',
		'Я'  => 'YA',
		'а'  => 'a',
		'б'  => 'b',
		'в'  => 'v',
		'г'  => 'g',
		'д'  => 'd',
		'е'  => 'e',
		'ё'  => 'yo',
		'ж'  => 'zh',
		'з'  => 'z',
		'и'  => 'i',
		'й'  => 'y',
		'к'  => 'k',
		'л'  => 'l',
		'м'  => 'm',
		'н'  => 'n',
		'о'  => 'o',
		'п'  => 'p',
		'р'  => 'r',
		'с'  => 's',
		'т'  => 't',
		'у'  => 'u',
		'ф'  => 'f',
		'х'  => 'h',
		'ц'  => 'ts',
		'ч'  => 'ch',
		'ш'  => 'sh',
		'щ'  => 'sch',
		'ъ'  => '',
		'ы'  => 'yi',
		'ь'  => '',
		'э'  => 'e',
		'ю'  => 'yu',
		'я'  => 'ya'
	);

	$str = strtr( $str, $utf8 );

	return trim( $str, '-' );
}

function pile_cachebust_string( $filepath ) {
	$filemtime = @filemtime( $filepath );

	if ( $filemtime == null ) {
		$filemtime = @filemtime( utf8_decode( $filepath ) );
	}

	if ( $filemtime != null ) {
		return date( 'YmdHi', $filemtime );
	} else { // can't get filemtime, fallback to cachebust every month
		return date( 'Ym' );
	}
}

function pile_limit_words( $string, $word_limit, $more_text = ' [&hellip;]' ) {
	$words  = explode( " ", $string );
	$output = implode( " ", array_splice( $words, 0, $word_limit ) );

	//check fi we actually cut something
	if ( count( $words ) > $word_limit ) {
		$output .= $more_text;
	}

	return $output;
}


/**
 * Retrieve boundary post. - Extended by us to also keep notice of the current post post type
 *
 * Boundary being either the first or last post by publish date within the constraints specified
 * by $in_same_term or $excluded_terms.
 *
 * @since 2.8.0
 *
 * @param bool         $in_same_term   Optional. Whether returned post should be in a same taxonomy term.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded term IDs.
 * @param bool         $start          Optional. Whether to retrieve first or last post.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 * @return mixed Array containing the boundary post object if successful, null otherwise.
 */
function pile_get_boundary_post( $in_same_term = false, $excluded_terms = '', $start = true, $taxonomy = 'category' ) {
	//get rid of the action added by Simple Custom Post Order - naughty naughty
	//it breaks our ordering
	global $scporder;
	if ( isset($scporder) ) {
		remove_action( 'pre_get_posts', array ($scporder, 'scporder_pre_get_posts') );
	}

	$post = get_post();
	if ( ! $post || ! is_single() || is_attachment() || ! taxonomy_exists( $taxonomy ) )
		return null;

	$query_args = array(
		'posts_per_page' => 1,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'post_type' => $post->post_type,
		'orderby' => array ('menu_order' => $start ? 'DESC' : 'ASC', 'date' => $start ? 'ASC' : 'DESC')
	);

	$term_array = array();

	if ( ! is_array( $excluded_terms ) ) {
		if ( ! empty( $excluded_terms ) )
			$excluded_terms = explode( ',', $excluded_terms );
		else
			$excluded_terms = array();
	}

	if ( $in_same_term || ! empty( $excluded_terms ) ) {
		if ( $in_same_term )
			$term_array = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

		if ( ! empty( $excluded_terms ) ) {
			$excluded_terms = array_map( 'intval', $excluded_terms );
			$excluded_terms = array_diff( $excluded_terms, $term_array );

			$inverse_terms = array();
			foreach ( $excluded_terms as $excluded_term )
				$inverse_terms[] = $excluded_term * -1;
			$excluded_terms = $inverse_terms;
		}

		$query_args[ 'tax_query' ] = array( array(
			'taxonomy' => $taxonomy,
			'terms' => array_merge( $term_array, $excluded_terms )
		) );
	}

	$result = get_posts( $query_args );

	//we don't want an array
	if ( isset($result[0]) ) return $result[0];

	return $result;
}

/**
 * Checks if a post type object needs password aproval
 * @return array. if the form was submitted it returns an array with the success status and a message
 */
function pile_is_password_protected() {
	global $post;
	$private_post = array( 'allowed' => false, 'error' => '' );

	if ( isset( $_POST['submit_password'] ) ) { // when we have a submision check the password and its submision
		if ( isset( $_POST['submit_password_nonce'] ) && wp_verify_nonce( $_POST['submit_password_nonce'], 'password_protection' ) ) {
			if ( isset ( $_POST['post_password'] ) && ! empty( $_POST['post_password'] ) ) { // some simple checks on password
				// finally test if the password submitted is correct
				if ( $post->post_password === $_POST['post_password'] ) {
					$private_post['allowed'] = true;

					// ok if we have a correct password we should inform wordpress too
					// otherwise the mad dog will put the password form again in the_content() and other filters
					global $wp_hasher;
					if ( empty( $wp_hasher ) ) {
						require_once( ABSPATH . 'wp-includes/class-phpass.php' );
						$wp_hasher = new PasswordHash( 8, true );
					}
					setcookie( 'wp-postpass_' . COOKIEHASH, $wp_hasher->HashPassword( stripslashes( $_POST['post_password'] ) ), 0, COOKIEPATH );

				} else {
					$private_post['error'] = '<h4 class="text--error">' . esc_html__( 'Wrong Password', 'pile ' ) . '</h4>';
				}
			}
		}
	}

	if ( isset( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ) && get_permalink() == wp_get_referer() ) {
		$private_post['error'] = '<h4 class="text--error">Wrong Password</h4>';
	}

	return $private_post;
}

function pile_prepare_password_for_custom_post_types() {

	global $pile_private_post;
	$pile_private_post = pile_is_password_protected();
}
add_action( 'wp', 'pile_prepare_password_for_custom_post_types' );

function pile_get_img_alt( $image ) {
	$img_alt = trim( strip_tags( get_post_meta( $image, '_wp_attachment_image_alt', true ) ) );
	return $img_alt;
}

/**
 * Add custom mime types (like svg)
 *
 * @param array $mimes An associative array of allowed mime types
 *
 * @return array
 */
function pile_custom_mime_types( $mimes ) {

	// only admins should be allowed to upload SVG files
	if ( ! is_admin() ) {
		return $mimes;
	}

	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'pile_custom_mime_types' );

/**
 * Get the hero background color meta value. It will return the default color string in case the meta is empty or invalid (like '#')
 *
 * @param int $post_ID Optional. The post ID. We will use the current post ID in case null
 * @param string $default Optional. The default hexa color string to return in case the meta value is empty
 *
 * @return bool|string
 */
function pile_get_the_hero_background_color( $post_ID = null, $default = '#333' ){
	if ( empty( $post_ID ) ) {
		$post_ID = get_the_ID();
	}

	//bail if we don't have a $post_ID
	if ( empty( $post_ID ) ) {
		return false;
	}

	if ( get_post_type( $post_ID ) == 'page' ) {
		$color = get_post_meta( $post_ID, '_hero_background_color', true );
	} else {
		$color = get_post_meta( $post_ID, '_pile_project_color', true );
	}

	//use a default color in case something went wrong - actually a gray
	if ( empty( $color ) || '#' == $color ) {
		$color = $default;
	}

	return $color;
}

/**
 * AJAX calls
 */
function pile_get_project_color() {

	if ( ! isset( $_REQUEST['attachment_src'] ) ) {
		wp_send_json_error( 'no attachment src' );
	}

	$attachment_src = $_REQUEST['attachment_src'];

	include 'classes/class-tonesque.php';

	if ( class_exists( 'Tonesque' ) ) {
		$tonesque = new Tonesque( $attachment_src );
		// get color in hex format
		$color = $tonesque->color();
		wp_send_json_success( $color );
	}

	wp_send_json_error( 'fail to load class' );
}
add_action( 'wp_ajax_pile_get_project_color', 'pile_get_project_color' );

add_action( 'pile_djax_container_start', 'pile_djax_container_start', 10 );
function pile_djax_container_start() {
	/**
	 * Display static content like:
	 * - a serialized list with the enqueued resources on page load
	 */
	do_action( 'pile_before_dynamic_content' );
}

/**
 * The use of this hook is deprecated.
 * We could replace it with a simple markup like "</div><!-- #djaxContent -->".
 * But we'll keep it cuz it looks useful.
 */
add_action( 'pile_djax_container_end', 'pile_djax_container_end', 10 );
function pile_djax_container_end() {
	//echo do_action( 'pile_generate_dynamic_scripts' );
}

add_action( 'pile_before_dynamic_content', 'pile_before_dynamic_content', 10 );
function pile_before_dynamic_content() {

	/**
	 * Localize a static list with resourses already loaded on the first page load this lists will be filled on
	 * each d-jax request which has new resources
	 *
	 * Note: make this dependent to wpgrade-main-scripts because we know for sure it is there
	 */
	wp_localize_script( 'pile-main-scripts', 'pile_static_resources', array(
		'scripts' => wpgrade::get_queued_scripts(),
		'styles'  => wpgrade::get_queued_styles()
	) );
}

add_action( 'wp_footer', 'pile_last_function', 999999999 );
/**
 * Display dynamic generated data while running dJax requests :
 *
 * a script which will load others scripts on the run
 */
function pile_last_function() {
	/**
	 * Display dynamic generated data while runing d-jax requests :
	 *
	 * a script which will load others scripts on the run
	 */
	// let's try a crazy shit
	$dynamic_scripts = wpgrade::get_queued_scripts();
	$dynamic_styles  = wpgrade::get_queued_styles(); ?>
	<div id="pile_scripts_and_styles" data-scripts='<?php echo json_encode( $dynamic_scripts ); ?>' data-styles='<?php echo json_encode( $dynamic_styles ); ?>'></div>
	<?php
}

/**
 * Some admin calls
 */

// Add "Next page" button to TinyMCE
function pile_add_next_page_button( $mce_buttons ) {
	$pos = array_search( 'wp_more', $mce_buttons, true );
	if ( $pos !== false ) {
		$tmp_buttons   = array_slice( $mce_buttons, 0, $pos + 1 );
		$tmp_buttons[] = 'wp_page';
		$mce_buttons   = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos + 1 ) );
	}

	return $mce_buttons;
}

add_filter( 'mce_buttons', 'pile_add_next_page_button' );


/*
 * Add custom styling for the media popup
 */
function pile_custom_style_for_mediabox() { ?>
	<style>
		.media-sidebar {
			width: 400px;
		}

		.media-sidebar .field p.desc {
			color: #666;
			font-size: 11px;
			margin-top: 3px;
		}

		.media-sidebar .field p.help {
			display: none;
		}

		/*
		 * Options Specific Rules
		 */
		.media-sidebar .setting[data-setting="description"] textarea {
			min-height: 100px;
		}

		.media-sidebar table.compat-attachment-fields input[type=checkbox], .media-sidebar table.compat-attachment-fields input[type=checkbox] {
			margin: 0 6px 0 0;
		}

		table.compat-attachment-fields {
			margin-top: 12px;
		}

		.media-sidebar tr.compat-field-video_autoplay {
			margin: -12px 0 0 0;
		}

		.media-sidebar tr.compat-field-video_autoplay th.label {
			opacity: 0;
		}

		.media-sidebar tr.compat-field-external_url {

		}

		.attachments-browser .attachments, .attachments-browser .uploader-inline,
		.attachments-browser .media-toolbar {
			right: 433px;
		}

		.compat-item .field {
			width: 65%;
		}
	</style>
	<?php
}

add_action( 'print_media_templates', 'pile_custom_style_for_mediabox' );

/*
 * Add custom settings to the gallery popup interface
 */

function pile_custom_gallery_settings() {
	// define your backbone template;
	// the "tmpl-" prefix is required,
	// and your input field should have a data-setting attribute
	// matching the shortcode name ?>
	<script type="text/html" id="tmpl-mkslideshow">
		<label class="setting">
			<span><?php _e( 'Make this gallery a slideshow', 'pile' ) ?></span>
			<input type="checkbox" data-setting="mkslideshow">
		</label>
	</script>
	<script>
		jQuery(document).ready(function () {
			"use strict";
			// add your shortcode attribute and its default value to the
			// gallery settings list; $.extend should work as well...
			_.extend(wp.media.gallery.defaults, {
				mkslideshow: false
			});

			// merge default gallery settings template with yours
			wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
				template: function (view) {
					return wp.media.template('gallery-settings')(view)
						+ wp.media.template('mkslideshow')(view);
				}
			});

		});
	</script>
<?php }

add_action( 'print_media_templates', 'pile_custom_gallery_settings' );

/*
 * Add custom fields to attachments
 */

function pile_register_attachments_custom_fields() {
	//add video support for attachments
	if ( ! function_exists( 'add_video_url_field_to_attachments' ) ) {

		function add_video_url_field_to_attachments( $form_fields, $post ) {
			$link_media_to_value = get_post_meta( $post->ID, "_link_media_to", true );

			if ( ! isset( $form_fields["link_media_to"] ) ) {

				$select_options = array(
					'none'             => esc_html__( 'None', 'pile' ),
					'media_file'       => esc_html__( 'Media File', 'pile' ),
					'custom_image_url' => esc_html__( 'Custom Image URL', 'pile' ),
					'custom_video_url' => esc_html__( 'Custom Video URL', 'pile' ),
					'external'         => esc_html__( 'External URL', 'pile' )
				);

				$select_html = '<select name="attachments[' . $post->ID . '][link_media_to]" id="attachments[' . $post->ID . '][link_media_to]">';

				foreach ( $select_options as $key => $option ) {

					$selected = '';

					if ( $link_media_to_value == $key ) {
						$selected = 'selected="selected"';
					}

					$select_html .= '<option value="' . $key . '" ' . $selected . '>' . $option . '</option>';
				}

				$select_html .= '</select>';

				$form_fields["link_media_to"] = array(
					'label' => esc_html__( 'Linked To', 'pile' ),
					'input' => 'html',
					'html'  => $select_html
				);
			}

			if ( ! isset( $form_fields["video_url"] ) && ! empty( $link_media_to_value ) && $link_media_to_value == 'custom_video_url' ) {
				$form_fields["video_url"] = array(
					"label" => esc_html__( "Custom Video URL", 'pile' ),
					"input" => "text", // this is default if "input" is omitted
					"value" => esc_url( get_post_meta( $post->ID, "_video_url", true ) ),
					"helps" => __( "<p class='desc'>Attach a video to this image <span class='small'>(YouTube or Vimeo)</span>.</p>", 'pile' ),
				);
			}

			if ( ! isset( $form_fields["custom_image_url"] ) && ! empty( $link_media_to_value ) && $link_media_to_value == 'custom_image_url' ) {
				$form_fields["custom_image_url"] = array(
					"label" => esc_html__( "Custom Image URL", 'pile' ),
					"input" => "text", // this is default if "input" is omitted
					"value" => esc_url( get_post_meta( $post->ID, "_custom_image_url", true ) ),
					"helps" => __( "<p class='desc'>Link this image to a custom url.</p>", 'pile' ),
				);
			}

			if ( ! isset( $form_fields["video_autoplay"] ) && ! empty( $link_media_to_value ) && $link_media_to_value == 'custom_video_url' ) {

				$meta = get_post_meta( $post->ID, "_video_autoplay", true );
				// Set the checkbox checked or not
				if ( $meta == 'on' ) {
					$checked = ' checked="checked"';
				} else {
					$checked = '';
				}

				$form_fields["video_autoplay"] = array(
					"label" => esc_html__( "Video Autoplay", 'pile' ),
					"input" => "html",
					"html"  => '<input' . $checked . ' type="checkbox" name="attachments[' . $post->ID . '][video_autoplay]" id="attachments[' . $post->ID . '][video_autoplay]" /><label for="attachments[' . $post->ID . '][video_autoplay]">' . __( 'Enable Video Autoplay?', 'pile' ) . '</label>'
				);
			}

			if ( ! isset( $form_fields["external_url"] ) && ! empty( $link_media_to_value ) && $link_media_to_value == 'external' ) {
				$form_fields["external_url"] = array(
					"label" => esc_html__( "External URL", 'pile' ),
					"input" => "text",
					"value" => esc_url( get_post_meta( $post->ID, "_external_url", true ) ),
					"helps" => __( "<p class='desc'>Set this image to link to an external website.</p>", 'pile' ),
				);
			}

			return $form_fields;
		}
	}

	add_filter( "attachment_fields_to_edit", "add_video_url_field_to_attachments", 99999, 2 );

	/**
	 * Save custom media metadata fields
	 * Be sure to validate your data before saving it
	 * http://codex.wordpress.org/Data_Validation
	 *
	 * @param WP_Post $post       The $post data for the attachment
	 * @param array $attachment The $attachment part of the form $_POST ($_POST[attachments][postID])
	 *
	 * @return $post
	 */

	if ( ! function_exists( 'add_image_attachment_fields_to_save' ) ) {

		function add_image_attachment_fields_to_save( $post, $attachment ) {

			if ( isset( $attachment['link_media_to'] ) ) {
				update_post_meta( $post['ID'], '_link_media_to', $attachment['link_media_to'] );
			}

			if ( isset( $attachment['custom_image_url'] ) ) {
				update_post_meta( $post['ID'], '_custom_image_url', esc_url( $attachment['custom_image_url'] ) );
			}

			if ( isset( $attachment['video_url'] ) ) {
				update_post_meta( $post['ID'], '_video_url', esc_url( $attachment['video_url'] ) );
			}

			if ( isset( $attachment['video_autoplay'] ) ) {
				update_post_meta( $post['ID'], '_video_autoplay', 'on' );
			} else {
				update_post_meta( $post['ID'], '_video_autoplay', 'off' );
			}


			if ( isset( $attachment['external_url'] ) ) {
				update_post_meta( $post['ID'], '_external_url', esc_url( $attachment['external_url'] ) );
			}

			return $post;
		}
	}

	add_filter( "attachment_fields_to_save", "add_image_attachment_fields_to_save", 9999, 2 );
}
add_action( 'init', 'pile_register_attachments_custom_fields' );

// Customize the "wp_link_pages()" to be able to display both numbers and prev/next links
function pile_add_next_and_number( $args ) {
	if ( $args['next_or_number'] == 'next_and_number' ) {
		global $page, $numpages, $multipage, $more, $pagenow;
		$args['next_or_number'] = 'number';
		$prev                   = '';
		$next                   = '';
		if ( $multipage and $more ) {
			$i = $page - 1;
			if ( $i and $more ) {
				$prev .= _wp_link_page( $i );
				$prev .= $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
				$prev = apply_filters( 'wp_link_pages_link', $prev, 'prev' );
			}
			$i = $page + 1;
			if ( $i <= $numpages and $more ) {
				$next .= _wp_link_page( $i );
				$next .= $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>';
				$next = apply_filters( 'wp_link_pages_link', $next, 'next' );
			}
		}
		$args['before'] = $args['before'] . $prev;
		$args['after']  = $next . $args['after'];
	}

	return $args;
}
add_filter( 'wp_link_pages_args', 'pile_add_next_and_number' );

function pile_callback_help_pointers_setup() {

	// Define our pointers
	// -------------------
	$pointers = array(
		array(
			// unique id for this pointer
			'id'       => 'add-archive-menu-item-warning',
			// this is the page hook we want our pointer to show on
			'screen'   => 'nav-menus',
			// the css selector for the pointer to be tied to, best to use ID's
			'target'   => '#submit-post-type-archives',
			'title'    => esc_html__( 'Warning', 'pile' ),
			'content'  => esc_html__( 'This menu item does NOT work if you changed the slug for the custom post type. If you haven\'t change it, dissmis this!', 'pile' ),
			'position' => array(
				'edge'  => 'top', # values: top, bottom, left, right
				'align' => 'middle' # values: top, bottom, left, right, middle
			)
		)

		// more as needed
	);

	// Info about custom post types drag and drop
	// ------------------------------------------

	// require plugin.php to use is_plugin_active()
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	include_once 'classes/WP_Help_Pointer.php';

	if ( is_plugin_active( 'simple-page-ordering/simple-page-ordering.php' ) ) {
		$pointers[] = array(
			// unique id for this pointer
			'id'       => 'info-about-draganddrop-on-postypes',
			// this is the page hook we want our pointer to show on
			'screen'   => 'edit-page',
			// the css selector for the pointer to be tied to, best to use ID's
			'target'   => '#the-list.ui-sortable .type-page:nth(1)',
			'title'    => esc_html__( 'Did you know ?', 'pile' ),
			'content'  => esc_html__( ' You can order pages with drag and drop.', 'pile' ),
			'position' => array(
				'edge'  => 'top', # values: top, bottom, left, right
				'align' => 'middle' # values: top, bottom, left, right, middle
			)
		);
	}

	// Initialize
	// ----------

	$myPointers = new WP_Help_Pointer();
	$myPointers->setup( $pointers );
}
add_action( 'admin_enqueue_scripts', 'pile_callback_help_pointers_setup' );


/**
 * Add classes and markup for paginated pages links
 *
 * @param string $link
 * @param string $key
 *
 * @return string
 */
function pile_pagination_custom_markup( $link, $key ) {
	$current = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : '1';
	$class   = '';
	switch ( $key ) {
		case $current:
			$class .= 'class="pagination-item pagination-item--current"';
			$link = '<span>' . $link . '</span>';
			break;
		case 'prev':
			$class .= 'class="pagination-item pagination-item--prev"';
			break;
		case 'next':
			$class .= 'class="pagination-item pagination-item--next"';
			break;
		default:
			break;
	}

	$link = '<li ' . $class . '>' . $link . '</li>';

	return $link;
}
add_filter( 'wp_link_pages_link', 'pile_pagination_custom_markup', 10, 2 );

/**
 * Borrowed from CakePHP
 * Truncates text.
 * Cuts a string to the length of $length and replaces the last characters
 * with the ending if the text is longer than length.
 * ### Options:
 * - `ending` Will be used as Ending and appended to the trimmed string
 * - `exact` If false, $text will not be cut mid-word
 * - `html` If true, HTML tags would be handled correctly
 *
 * @param string  $text    String to truncate.
 * @param integer $length  Length of returned string, including ellipsis.
 * @param array   $options An array of html attributes and options.
 *
 * @return string Trimmed string.
 * @access public
 * @link   http://book.cakephp.org/view/1469/Text#truncate-1625
 */

function truncate( $text, $length = 100, $options = array() ) {
	$default = array(
		'ending' => '...',
		'exact'  => true,
		'html'   => false
	);
	$options = array_merge( $default, $options );
	extract( $options );

	if ( $html ) {
		if ( mb_strlen( preg_replace( '/<.*?>/', '', $text ) ) <= $length ) {
			return $text;
		}
		$totalLength = mb_strlen( strip_tags( $ending ) );
		$openTags    = array();
		$truncate    = '';

		preg_match_all( '/(<\/?([\w+]+)[^>]*>)?([^<>]*)/', $text, $tags, PREG_SET_ORDER );
		foreach ( $tags as $tag ) {
			if ( ! preg_match( '/img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param/s', $tag[2] ) ) {
				if ( preg_match( '/<[\w]+[^>]*>/s', $tag[0] ) ) {
					array_unshift( $openTags, $tag[2] );
				} else if ( preg_match( '/<\/([\w]+)[^>]*>/s', $tag[0], $closeTag ) ) {
					$pos = array_search( $closeTag[1], $openTags );
					if ( $pos !== false ) {
						array_splice( $openTags, $pos, 1 );
					}
				}
			}
			$truncate .= $tag[1];

			$contentLength = mb_strlen( preg_replace( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $tag[3] ) );
			if ( $contentLength + $totalLength > $length ) {
				$left           = $length - $totalLength;
				$entitiesLength = 0;
				if ( preg_match_all( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $tag[3], $entities, PREG_OFFSET_CAPTURE ) ) {
					foreach ( $entities[0] as $entity ) {
						if ( $entity[1] + 1 - $entitiesLength <= $left ) {
							$left --;
							$entitiesLength += mb_strlen( $entity[0] );
						} else {
							break;
						}
					}
				}

				$truncate .= mb_substr( $tag[3], 0, $left + $entitiesLength );
				break;
			} else {
				$truncate .= $tag[3];
				$totalLength += $contentLength;
			}
			if ( $totalLength >= $length ) {
				break;
			}
		}
	} else {
		if ( mb_strlen( $text ) <= $length ) {
			return $text;
		} else {
			$truncate = mb_substr( $text, 0, $length - mb_strlen( $ending ) );
		}
	}
	if ( ! $exact ) {
		$spacepos = mb_strrpos( $truncate, ' ' );
		if ( isset( $spacepos ) ) {
			if ( $html ) {
				$bits = mb_substr( $truncate, $spacepos );
				preg_match_all( '/<\/([a-z]+)>/', $bits, $droppedTags, PREG_SET_ORDER );
				if ( ! empty( $droppedTags ) ) {
					foreach ( $droppedTags as $closingTag ) {
						if ( ! in_array( $closingTag[1], $openTags ) ) {
							array_unshift( $openTags, $closingTag[1] );
						}
					}
				}
			}
			$truncate = mb_substr( $truncate, 0, $spacepos );
		}
	}
	$truncate .= $ending;

	if ( $html ) {
		foreach ( $openTags as $tag ) {
			$truncate .= '</' . $tag . '>';
		}
	}

	return $truncate;
}

/*
 * COMMENT LAYOUT
 */
function wpgrade_comments( $comment, $args, $depth ) {
	static $comment_number;

	if ( ! isset( $comment_number ) )
		$comment_number = $args['per_page'] * ( $args['page'] - 1 ) + 1; else {
		$comment_number ++;
	}

	$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?>>
	<article id="comment-<?php echo $comment->comment_ID; ?>" class="comment-article  media">
		<?php if ( pile_option( 'comments_show_numbering' ) ): ?>
			<span class="comment-number"><?php echo $comment_number ?></span>
		<?php endif; ?>
		<?php if ( pile_option( 'comments_show_avatar' ) && get_comment_type( $comment->comment_ID ) == 'comment' ): ?>
			<aside class="comment__avatar  media__img">
				<!-- custom gravatar call -->
				<?php
				$bgauthemail = md5( strtolower( trim( get_comment_author_email() ) ) );

				if ( is_ssl() ) {
					$host = 'https://secure.gravatar.com';
				} else {
					$host = sprintf( "http://%d.gravatar.com", ( hexdec( $bgauthemail[0] ) % 2 ) );
				}
				?>
				<img src="<?php echo $host; ?>/avatar/<?php echo $bgauthemail; ?>?s=60" class="comment__avatar-image" height="60" width="60" style="background-image: <?php echo get_template_directory_uri() . '/library/images/nothing.gif'; ?>; background-size: 100% 100%"/>
			</aside>
		<?php endif; ?>
		<div class="media__body">
			<header class="comment__meta comment-author">
				<?php printf( '<span class="comment__author-name">%s</span>', get_comment_author_link() ) ?>
				<time class="comment__time" datetime="<?php comment_time( 'c' ); ?>">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment__timestamp"><?php printf( __( '<span class="italic">on</span> %s at %s', 'pile' ), get_comment_date(), get_comment_time() ); ?> </a>
				</time>
				<div class="comment__links">
					<?php
					edit_comment_link( __( 'Edit', 'pile' ), '  ', '' );
					comment_reply_link( array_merge( $args, array( 'depth'     => $depth,
					                                               'max_depth' => $args['max_depth']
					) ) );
					?>
				</div>
			</header>
			<!-- .comment-meta -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<div class="alert info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'pile' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment__content comment">
				<?php comment_text() ?>
			</section>
		</div>
	</article>
	<!-- </li> is added by WordPress automatically -->
	<?php
} // don't remove this bracket!

/**
 * Replace the [...] wordpress puts in when using the the_excerpt() method.
 */
function pile_excerpt_more( $excerpt ) {
	return pile_option( 'blog_excerpt_more_text' );
}
add_filter( 'excerpt_more', 'pile_excerpt_more' );

/**
 * Remove the URL hash #more-... in the provided link, preventing scrolling
 *
 * @param string $link
 *
 * @return string
 */
function pile_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );

	return $link;
}
add_filter( 'the_content_more_link', 'pile_remove_more_link_scroll' );

/**
 * Handle the initialization of custom loops for pages with custom templates
 *
 * @param WP_Query $query
 */
function pile_portfolio_archive_page_template_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
		$page_ID = $query->get('page_id');
		if ( empty( $page_ID ) ) {
			$page_ID = $query->queried_object_id;
		}

		if ( ! empty( $page_ID ) ) {
			$posts_per_page = intval( get_post_meta( $page_ID, '_pile_portfolio_projects_per_page', true ) );
			if ( empty( $posts_per_page ) ) {
				$posts_per_page = get_option( 'posts_per_page' );
			}

			$query_args = array(
				'post_type'      => 'pile_portfolio',
				'posts_per_page' => $posts_per_page,
				'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ) ,
				'suppress_filters' => false
			);

			//here we test to see if we need to exclude the featured projects
			$featured_projects = trim( get_post_meta( $page_ID, '_pile_portfolio_featured_projects', true ) );
			$exclude_featured  = get_post_meta( $page_ID, '_pile_portfolio_exclude_featured', true );
			if ( $exclude_featured ) {
				//get the featured posts so we can exclude them from the loop
				$featured_projects_IDs = explode( ',', $featured_projects );
				//make sure it is an array
				if ( ! empty( $featured_projects_IDs ) && ! is_array( $featured_projects_IDs ) ) {
					$featured_projects_IDs = array( $featured_projects_IDs );
				}
				$query_args['post__not_in'] = $featured_projects_IDs;
			}

			include_once 'classes/PreGetPostsForPages.php';

			$new_query = new PreGetPostsForPages(
				'page-templates/portfolio-archive.php',       // Page slug we will target
				'template-parts/content-portfolio', //Template part which will be used to display posts, name should be without .php extension
				false,      // Should get_template_part support post formats
				$query_args  // Array of valid arguments that will be passed to WP_Query/pre_get_posts
			);
			$new_query->init();
		}
	}
}
add_action( 'parse_query', 'pile_portfolio_archive_page_template_query');

/**
 * Add the pile item wrapper with the appropriate classes
 *
 * @param int $pile_item_index
 */
function pile_wrap_content_portfolio_before( $pile_item_index ) {
	// Extra post classes
	$classes = array( 'pile-item', 'pile-item--archive', 'one-whole', 'lap-one-half', 'desk-one-third' );

	$column =  pile_option( 'pile_3d_target' );
	$large_no  = pile_option( 'pile_large_columns' );
	$medium_no = pile_option( 'pile_medium_columns' );
	$small_no  = pile_option( 'pile_small_columns' );

	//apply the default if nothing else
	if ( empty( $large_no ) ) {
		$large_no = 3;
	}

	//apply the default if nothing else
	if ( empty( $medium_no ) ) {
		$medium_no = 2;
	}

	//apply the default if nothing else
	if ( empty( $small_no ) ) {
		$small_no = 1;
	}

	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-image';
	}

	if ( "column" == $column ) {

		if ( $pile_item_index % $large_no % 2 ) {
			$classes[] = 'pile-item-large-3d';
		}

		if ( $pile_item_index % $medium_no % 2 ) {
			$classes[] = 'pile-item-medium-3d';
		}

		if ( $pile_item_index % $small_no % 2 ) {
			$classes[] = 'pile-item-small-3d';
		}

	} else {

		if ( ( floor( $pile_item_index / $large_no ) + $pile_item_index ) % 2 ) {
			$classes[] = 'pile-item-large-3d';
		}

		if ( ( floor( $pile_item_index / $medium_no ) + $pile_item_index ) % 2 ) {
			$classes[] = 'pile-item-medium-3d';
		}

		if ( ( floor( $pile_item_index / $small_no ) + $pile_item_index ) % 2 ) {
			$classes[] = 'pile-item-small-3d';
		}

	}

	//output the div with the class attribute ?>

	<div <?php post_class( $classes ); ?>>

<?php
}
add_action( 'pregetpostsforpages_counter_before_template_part', 'pile_wrap_content_portfolio_before', 10, 1 );

/**
 * Closes the pile item wrapper
 *
 * @param int $pile_item_index
 */
function pile_wrap_content_portfolio_after( $pile_item_index ) { ?>

	</div><!-- .pile-item.pile-item--archive.one-whole.lap-one-half.desk-one-third -->

<?php
}
add_action( 'pregetpostsforpages_counter_after_template_part', 'pile_wrap_content_portfolio_after', 10, 1 );

/**
 * fix the sticky posts logic by preventing them to appear again
 *
 * @param WP_Query $query
 */
function pile_pre_get_posts_sticky_posts( $query ) {

	// Do nothing if not home or not main query.
	if ( ! $query->is_home() || ! $query->is_main_query() ) {
		return;
	}

	$page_on_front = get_option( 'page_on_front' );

	// Do nothing if the blog page is not the front page
	if ( ! empty( $page_on_front ) ) {
		return;
	}

	$sticky = get_option( 'sticky_posts' );

	// Do nothing if no sticky posts
	if ( empty( $sticky ) ) {
		return;
	}

	// We need to respect post ids already in the blacklist of hell
	$post__not_in = $query->get( 'post__not_in' );

	if ( ! empty( $post__not_in ) ) {
		$sticky = array_merge( (array) $post__not_in, $sticky );
		$sticky = array_unique( $sticky );
	}

	$query->set( 'post__not_in', $sticky );

}

add_action( 'pre_get_posts', 'pile_pre_get_posts_sticky_posts' );

/*
 * Ajax loading projects
 */
add_action( 'wp_ajax_pile_load_next_projects', 'pile_load_next_projects' );
add_action( 'wp_ajax_nopriv_pile_load_next_projects', 'pile_load_next_projects' );
function pile_load_next_projects() {
	global $post;

	if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'pile_ajax' ) ) {
		wp_send_json_error();
	}

	$pageID = $_REQUEST['pageid'];

	//set the query args
	$args = array( 'post_type' => 'pile_portfolio' );

	if ( isset( $_REQUEST['posts_number'] ) && 'all' == $_REQUEST['posts_number'] ) {
		$args['posts_per_page'] = 999;
	} else {
		$args['posts_per_page'] = intval( get_post_meta( $pageID, '_pile_portfolio_projects_per_page', true ) );
	}

	if ( isset( $_REQUEST['taxonomy'] ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => $_REQUEST['taxonomy'],
				'field'    => 'term_id',
				'terms'    => array( $_REQUEST['term_id'] ),
			),
		);
	}

	//check if we have a offset in $_REQUEST
	if ( isset( $_REQUEST['offset'] ) ) {
		$args['offset'] = (int) $_REQUEST['offset'];
	}

	$posts = get_posts( $args );
	if ( ! empty( $posts ) ) {
		ob_start();

		// initialize the item counter
		$pile_item_index = 0;
		foreach ( $posts as $post ) : setup_postdata( $post );
			//increase the counter beforehand since we start at 0
			$pile_item_index++;

			pile_wrap_content_portfolio_before( $pile_item_index );

			get_template_part( 'template-parts/content-portfolio' );

			pile_wrap_content_portfolio_after( $pile_item_index );

		endforeach;

		/* Restore original Post Data */
		wp_reset_postdata();

		wp_send_json_success( array(
			'posts' => ob_get_clean(),
		) );
	} else {
		wp_send_json_error();
	}
}

/*
 * Due to the fact that we need a wrapper for center aligned images and for the ones with alignnone, we need to wrap the images without a caption
 * The images with captions already are wrapped by the figure tag
 */
function pile_wrap_images_in_figure( $content ) {
	if( !is_single() ) return $content;

	$classes = array ('aligncenter', 'alignnone', 'alignleft', 'alignright');

	foreach ($classes as $class) {

		//this regex basically tells this
		//match all the images that are not in captions and that have the X class
		//when an image is wrapped by an anchor tag, match that too
		$regex = '~\[caption[^\]]*\].*\[\/caption\]|((?:<a[^>]*>\s*)?<img.*class="[^"]*' . $class . '[^"]*[^>]*>(?:\s*<\/a>)?)~i';

		$callback = new PileWrapImagesInFigureCallback( $class );

		// Replace the matches
		$content = preg_replace_callback(
			$regex,
			// in the callback function, if Group 1 is empty,
			// set the replacement to the whole match,
			// i.e. don't replace
			array( $callback, 'callback' ),
			$content );
	}

	return $content;
}
add_filter( 'the_content', 'pile_wrap_images_in_figure' );

//We need to use a class so we can pass the $class variable to the callback function
class PileWrapImagesInFigureCallback {
	private $class;

	function __construct( $class ) {
		$this->class = $class;
	}

	public function callback( $match ) {
		if ( empty( $match[1] ) ) {
			return $match[0];
		}

		return '<figure class="' . $this->class . '">' . $match[1] . '</figure>';
	}
}

/**
 * Add "Styles" drop-down
 */
add_filter( 'mce_buttons_3', 'pile_mce_editor_buttons3' );
function pile_mce_editor_buttons3( $buttons ) {
	array_unshift( $buttons, 'formatselect' );
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}

add_filter( 'mce_buttons_2', 'pile_mce_editor_buttons2' );
function pile_mce_editor_buttons2( $buttons ) {

	$key = array_search( 'formatselect', $buttons );

	if( $key !== false ) {
		unset( $buttons[ $key ] );
	}

	return $buttons;
}

/**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'tiny_mce_before_init', 'pile_mce_before_init' );
function pile_mce_before_init( $settings ) {

	$style_formats = array(
		array( 'title' => __( 'Description Text', 'pile' ), 'selector' => 'p', 'classes' => 'desc' ),
		array( 'title' => __( 'Dropcap', 'pile' ), 'inline' => 'span', 'classes' => 'dropcap' ),
		array( 'title' => __( 'Highlight', 'pile' ), 'inline' => 'span', 'classes' => 'highlight' ),
		array( 'title' => __( 'Two Columns', 'pile' ), 'selector' => 'p', 'classes' => 'twocolumn', 'wrapper' => true )
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;
}

if ( class_exists( 'Tinymce_Advanced' ) ) {

	function pile_propose_editor_font_sizes( $init ) {
		$init['fontsize_formats'] =  '50% 60% 70% 80% 90% 100% 110% 120% 130% 140% 150% 175% 200%';

		return $init;
	}
	add_filter( 'tiny_mce_before_init', 'pile_propose_editor_font_sizes', 15 );
}

/**
 * Insert a array entry after a certain key
 *
 * @param int|string $key
 * @param array $array
 * @param int|string $new_key
 * @param mixed $new_value
 *
 * @return array|bool
 */
function pile_array_insert_after($key, array &$array, $new_key, $new_value) {
	if (array_key_exists($key, $array)) {
		$new = array();
		foreach ($array as $k => $value) {
			$new[$k] = $value;
			if ($k === $key) {
				$new[$new_key] = $new_value;
			}
		}
		return $new;
	}
	return false;
}

/**
 * Add title and caption back to images
 */
function pile_add_title_caption_to_attachment( $markup, $id ) {
	$att     = get_post( $id );
	$title   = '';
	$caption = '';
	if ( ! empty( $att->post_title ) ) {
		$title = $att->post_title;
	}
	if ( ! empty( $att->post_excerpt ) ) {
		$caption = $att->post_excerpt;
	}

	return str_replace( '<a ', '<a data-title="' . $title . '" data-alt="' . $caption . '" ', $markup );
}
add_filter( 'wp_get_attachment_link', 'pile_add_title_caption_to_attachment', 10, 5 );


function pile_callback_the_password_form( $form ) {
	global $post;
	$post   = get_post( $post );
	$postID = $post->ID;
	$label  = 'pwbox-' . ( empty( $postID ) ? rand() : $postID );
	$form   = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post" class="password-protection-form">
		<p>' . esc_html__( "This post is password protected. To view it please enter your password below:", 'pile' ) . '</p>
		<div class="grid">
			<div class="grid__item  one-whole">
				<input name="post_password" id="' . $label . '" type="password" size="20" placeholder="' . esc_html__( "Password", 'pile' ) . '"/>
			</div>
			<div class="grid__item  one-whole">
				<input type="submit" name="Access" value="' . esc_attr__( "Access", 'pile' ) . '" class="btn post-password-submit"/>
			</div>
		</div>
	</form>';

	// on form submit put a wrong password msg.
	if ( get_permalink() != wp_get_referer() ) {
		return $form;
	}

	// No cookie, the user has not sent anything until now.
	if ( ! isset ( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ) ) {
		return $form;
	}

	require_once ABSPATH . 'wp-includes/class-phpass.php';
	$hasher = new PasswordHash( 8, true );

	$hash = wp_unslash( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] );
	if ( 0 !== strpos( $hash, '$P$B' ) ) {
		return $form;
	}

	if ( ! $hasher->CheckPassword( $post->post_password, $hash ) ) {

		// We have a cookie, but it does not match the password.
		$msg  = '<span class="wrong-password-message">' . esc_html__( 'Sorry, your password did not match', 'pile' ) . '</span>';
		$form = $msg . $form;
	}

	return $form;
}
add_action( 'the_password_form', 'pile_callback_the_password_form' );

/**
 * Test if the current post is of a given post type
 *
 * @param string $type
 *
 * @return bool
 */
function pile_is_post_type( $type ) {
	global $wp_query;

	if ( ! empty( $wp_query->post ) && $type == get_post_type( $wp_query->post->ID ) ) {
		return true;
	}

	return false;
}

/**
 * Determine if a certain value represents a true or false
 * True is: 1, true, on, yes, y
 * The rest are false
 * @link http://php.net/manual/en/function.is-bool.php#113693
 *
 * @param mixed $var
 *
 * @return bool
 */
function pile_toBool( $var ) {
	if ( ! is_string( $var ) ) {
		return (bool) $var;
	}

	switch ( strtolower( $var ) ) {
		case '1':
		case 'true':
		case 'on':
		case 'yes':
		case 'y':
			return true;
		default:
			return false;
	}
}

// Add Project Shortcode
function pile_create_project_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'id' => '',
			), $atts )
	);

	if ( ! isset( $id ) && empty( $id ) ) {
		$post = get_post( $id );
	}

	if (  ! empty( $post ) && ! is_wp_error( $post ) ) {
		global $post;
	}

	if ( in_array( 'next', $atts ) || in_array( 'Next', $atts ) ) {
		ob_start();
		get_template_part( 'template-parts/next-project' );
		return ob_get_clean();
	}

	if ( in_array( 'categories', $atts ) || in_array( 'Categories', $atts ) ) {
		ob_start();
		get_template_part( 'templates/shortcodes/project/categories' );
		return ob_get_clean();
	}

	if ( in_array( 'title', $atts ) || in_array( 'Title', $atts ) ) {
		return get_the_title();
	}
}
//we will register the shortcode with both lovercase and uppercase
add_shortcode( 'project', 'pile_create_project_shortcode' );
add_shortcode( 'Project', 'pile_create_project_shortcode' );

// Add Page Shortcode
function pile_create_page_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
			array(
				'id' => '',
			), $atts )
	);

	if ( ! isset( $id ) && empty( $id ) ) {
		$post = get_post( $id );
	}

	if (  ! empty( $post ) && ! is_wp_error( $post ) ) {
		global $post;
	}

	if ( in_array( 'title', $atts ) || in_array( 'Title', $atts ) ) {
		return get_the_title();
	}
}
//we will register the shortcode with both lovercase and uppercase
add_shortcode( 'page', 'pile_create_page_shortcode' );
add_shortcode( 'Page', 'pile_create_page_shortcode' );

/**
 * When the theme is activated, all of the active widgets are deactived so that the footer widget area doesn't get filled with default widgets
 *
 * @since Pile 2.0.0
 */
function pile_remove_default_widgets() {
	global $wpdb;

	if ( ! get_option( 'acme_cleared_widgets' ) ) {
		$query   = "SELECT COUNT( * ) AS num_posts FROM {$wpdb->posts} WHERE post_type = %s";
		$results = (array) $wpdb->get_results( $wpdb->prepare( $query, 'pile_portfolio' ), ARRAY_A );

		if ( empty( $results[0]['num_posts'] ) ) {
			update_option( 'sidebars_widgets', array() );
		}
		update_option( 'acme_cleared_widgets', true );
	}

}
add_action( 'after_setup_theme', 'pile_remove_default_widgets' );

/**
 * Get the "Display the post content".
 * It is the core the_content function but that returns rather than echo
 *
 * @since 2.0.1
 *
 * @param string $more_link_text Optional. Content for when there is more text.
 * @param bool   $strip_teaser   Optional. Strip teaser content before the more text. Default is false.
 */
function pile_get_the_content( $more_link_text = null, $strip_teaser = false) {
	$content = get_the_content( $more_link_text, $strip_teaser );

	/**
	 * Filter the post content.
	 *
	 * @since 0.71
	 *
	 * @param string $content Content of the current post.
	 */
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	return $content;
}

if ( ! function_exists( 'pile_menu_item_color' ) ) {
	function pile_menu_item_color($atts, $item, $args, $depth) {
		$atts['data-color'] = trim( pile_get_the_hero_background_color( $item->object_id ) );
		return $atts;
	}
}

add_filter('nav_menu_link_attributes', 'pile_menu_item_color', 10, 4);

if ( ! function_exists( 'pile_show_mini_cart' ) ) {
	function pile_show_mini_cart() {
		return class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_shop() || is_cart() || is_checkout() ) && pile_option( 'show_cart_menu' );
	}
}

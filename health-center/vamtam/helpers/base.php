<?php

function wpv_post_meta_default( $meta, $global, $post_id = null ) {
	if ( is_null( $post_id ) ) {
		$post_id = wpv_get_the_ID();
	}

	$global = wpv_sanitize_bool( wpv_get_option( $global ) );
	$local = wpv_sanitize_bool( wpv_post_meta( $post_id, $meta, true ) );
	$local_raw = wpv_post_meta( $post_id, $meta );

	if ( $local === 'default' || empty( $local_raw ) ) {
		return $global;
	}

	return $local;
}

function wpv_get_the_ID() {
	global $post;

	return (wpv_has_woocommerce() && is_woocommerce() && !is_singular(array('page', 'product'))) ? woocommerce_get_page_id( 'shop' ) : (isset($post) ? $post->ID : null);
}

/**
 * Wrapper around get_post_meta which takes special pages into account
 *
 * @uses get_post_meta()
 *
 * @param  int    $post_id Post ID.
 * @param  string $key     Optional. The meta key to retrieve. By default, returns data for all keys.
 * @param  bool   $single  Whether to return a single value.
 * @return mixed           Will be an array if $single is false. Will be value of meta data field if $single is true.
 */
function wpv_post_meta($post_id, $meta='', $single=false) {
	$real_id = wpv_get_the_ID();

	if($real_id && $post_id != $real_id)
		$post_id = $real_id;

	return get_post_meta($post_id, $meta, $single);
}

/**
 * helper function - returns second argument when the first is empty, otherwise returns the first
 *
 */
function wpv_default($value, $default) {
	if(empty($value))
		return $default;
	return $value;
}

/*
 * gets the width in px of the central column depending on current post settings
 */

if(!function_exists('wpv_get_central_column_width')):
function wpv_get_central_column_width() {
	global $post, $content_width;

	if(defined('WPV_LAYOUT')) {
		$layout_type = WPV_LAYOUT;
	} else if(is_single()){
		$layout_type = get_post_meta($post->ID, 'layout-type', 'left-only');
	} else {
		$layout_type = 'full';
	}

	$central_width = $content_width;
	$left_sidebar = (float)wpv_get_option('left-sidebar-width');
	$right_sidebar = (float)wpv_get_option('right-sidebar-width');
	switch($layout_type) {
		case 'left-only':
		case 'left-sidebar':
			$central_width = floor((100-$left_sidebar)/100*$central_width);
		break;

		case 'right-only':
		case 'right-sidebar':
			$central_width = floor((100-$right_sidebar)/100*$central_width);
		break;

		case 'left-right':
		case 'two-sidebars':
			$central_width = floor((100-$left_sidebar-$right_sidebar)/100*$central_width);
		break;
	}

	$column = array(1,1);

	if(isset($GLOBALS['wpv_column_stack']) && is_array($GLOBALS['wpv_column_stack'])) {
		foreach($GLOBALS['wpv_column_stack'] as $c) {
			$c = explode('/', $c);
			$column[0] *= $c[0];
			$column[1] *= $c[1];
		}
	}

	$column = $column[0]/$column[1];

	return round($central_width * $column);
}
endif;

// turns a string as four_fifths to a value in pixels, works only for the central column
if(!function_exists('wpv_str_to_width')):
function wpv_str_to_width($frac = 'full') {
	$width = wpv_get_central_column_width();
	if($frac != 'full') {
		$frac = explode('_', $frac);
		$map = array(
			'one' => 1,
			'two' => 2,
			'half' => 2,
			'three' => 3,
			'third' => 3,
			'thirds' => 3,
			'four' => 4,
			'fourth' => 4,
			'fourths' => 4,
			'five' => 5,
			'fifth' => 5,
			'fifths' => 5,
			'six' => 6,
			'sixth' => 6,
			'sixths' => 6,
		);

		$frac[0] = $map[$frac[0]];
		$frac[1] = $map[$frac[1]];

		$width = ($width - ($frac[1]-1)*20)/$frac[1]*$frac[0] + ($frac[0]-1)*20;
	}

	return $width;
}
endif;

function wpv_url_to_image( $src, $size = 'full', $attr = '' ) {
	$attachment_id = wpv_get_attachment_id($src);

	if ( $attachment_id !== false && wp_attachment_is_image( $attachment_id ) ) {
		echo wp_get_attachment_image( $attachment_id, $size, $attr ); // xss ok
	} else {
		// fallback, typically used on fresly imported demo content

		echo '<img src="' . esc_url( $src ) . '" alt="" />';
	}
}

function wpv_get_portfolio_options($group, $rel_group) {
	global $post;

	$res = array();

	$res['image'] = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', true);
	$res['type'] = wpv_default(get_post_meta(get_the_id(), 'portfolio_type', true), 'image');

	$res['width'] = '';
	$res['height'] = '';
	$res['iframe'] = '';
	$res['link_target'] = '_self';
	$res['rel'] = ($group == 'true')? ' rel="'.$rel_group.'"' : '';

	// calculate some options depending on the portfolio item's type
	if($res['type'] == 'image' || $res['type'] == 'html') {
		$res['href'] =  $res['image'][0];
		$res['lightbox'] = ' vamtam-lightbox';
	} elseif($res['type'] == 'video') {
		$res['href'] = get_post_meta(get_the_id(), 'wpv-portfolio-format-video', true);

		if(empty($res['href']))
			$res['href'] = $res['image'][0];
	} elseif($res['type'] == 'link') {
		$res['href'] = get_post_meta(get_the_ID(), 'wpv-portfolio-format-link', true);

		$res['link_target'] = get_post_meta(get_the_ID(), '_link_target', true);
		$res['link_target'] = $res['link_target'] ? $res['link_target'] : '_self';

		$res['lightbox'] = ' no-lightbox';
		$res['rel'] = '';

	} elseif($res['type'] == 'gallery') {
		list($res['gallery'], ) = WpvPostFormats::get_first_gallery(get_the_content(), null, WpvPostFormats::get_thumb_name(array('p' => $post)));
	} elseif($res['type'] == 'document') {
		if(is_single()) {
			$res['href'] = $res['image'][0];
			$res['lightbox'] = ' vamtam-lightbox';
		} else {
			$res['href'] = get_permalink();
			$res['lightbox'] = ' no-lightbox';
		}
		$res['rel'] = '';
	}

	return $res;
}

function wpv_custom_js() {
	$custom_js = wpv_get_option('custom_js');

	if(!empty($custom_js)):
?>
	<script><?php echo $custom_js; ?></script>
<?php
	endif;
}
add_action('wp_footer', 'wpv_custom_js', 10000);

function wpv_ga_script() {
	$an_key = wpv_get_option('analytics_key');
	if($an_key):
?>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo $an_key?>', 'auto');
		ga('require', 'displayfeatures');
		ga('send', 'pageview');
	</script>
<?php
	endif;
}
add_action('wp_head', 'wpv_ga_script', 10000);

function wpv_sub_shortcode($name, $content, &$params, &$sub_contents) {
	if(!preg_match_all("/\[$name\b(?P<params>.*?)(?:\/)?\](?:(?P<contents>.*?)\[\/$name\])?/s", $content, $matches)) {
		return false;
	}

	$params = array();
	$sub_contents = $matches['contents'];

	// this is from wp-includes/formatting.php
	/* translators: opening curly double quote */
	$opening_quote = _x( '&#8220;', 'opening curly double quote', 'default' );
	/* translators: closing curly double quote */
	$closing_quote = _x( '&#8221;', 'closing curly double quote', 'default' );
	/* translators: double prime, for example in 9" (nine inches) */
	$double_prime = _x( '&#8243;', 'double prime', 'default' );

	foreach($matches['params'] as $param_str) {
		$param_str = str_replace( array( $opening_quote, $closing_quote, $double_prime, '&#8220;', '&#8221;' ), '"', $param_str );
		$params[]  = shortcode_parse_atts($param_str);
	}

	return true;
}

/**
 * @see http://wordpress.stackexchange.com/a/7094/8344
 */
function wpv_get_attachment_id( $url ) {
	$dir = wp_upload_dir();
	$dir = trailingslashit($dir['baseurl']);

	if( false === strpos( $url, $dir ) )
		return false;

	$file = basename($url);

	$query = array(
		'post_type' => 'attachment',
		'fields' => 'ids',
		'meta_query' => array(
			array(
				'value' => $file,
				'compare' => 'LIKE',
			)
		)
	);

	$query['meta_query'][0]['key'] = '_wp_attached_file';
	$ids = get_posts( $query );

	foreach( $ids as $id ) {
		$attachment = wp_get_attachment_image_src($id, 'full');
		if( $url == array_shift( $attachment ) )
			return $id;
	}

	$query['meta_query'][0]['key'] = '_wp_attachment_metadata';
	$ids = get_posts( $query );

	foreach( $ids as $id ) {

		$meta = wp_get_attachment_metadata($id);

		if(isset($meta['sizes']) && is_array($meta['sizes'])) {
			foreach( $meta['sizes'] as $size => $values ) {
				if( $values['file'] == $file && $url == array_shift( wp_get_attachment_image_src($id, $size) ) ) {
					return $id;
				}
			}
		}
	}

	return false;
}

function wpv_get_attachment_file( $src ) {
	$attachment_id = wpv_get_attachment_id($src);
	$upload_dir    = wp_upload_dir();

	if ( $attachment_id !== false && wp_attachment_is_image( $attachment_id ) ) {
		$file = get_attached_file( $attachment_id );

		$file = preg_replace( '/^('. preg_quote( $upload_dir['basedir'] . '/', '/' ) .')?/', $upload_dir['basedir'].'/', $file );

		return $file;
	}

	return str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $src );
}

function wpv_prepare_url($url) {
	while(preg_match('#/[-\w]+/\.\./#', $url)) {
		$url = preg_replace('#/[-\w]+/\.\./#', '/', $url);
	}

	return $url;
}

function wpv_ajaxed_post_portfolio() {
	if(wpv_is_reduced_response()) {
		echo 'title|';
			WpvTemplates::site_title();
			wpv_reduced_delim();

		echo 'hsidebars|';
			$header_placed = wpv_get_header_sidebars();
			wpv_reduced_delim();

		echo 'ptitle|';
			WpvTemplates::page_header($header_placed);
			wpv_reduced_delim();

		echo 'breadcrumbs|';
			WpvTemplates::breadcrumbs();
			wpv_reduced_delim();

		echo 'content|';
	}
}
add_action('wp', 'wpv_ajaxed_post_portfolio');

function wpv_is_reduced_response() {
	return current_theme_supports('wpv-reduced-ajax-single-response') &&
			is_singular(array('post', 'portfolio', 'page')) &&
			isset($_SERVER['HTTP_X_VAMTAM']) &&
			$_SERVER['HTTP_X_VAMTAM'] == 'reduced-response';
}

function wpv_reduced_footer() {
	wpv_reduced_delim();
	echo 'scripts|';
	print_footer_scripts();
}

function wpv_reduced_delim() {
	echo '-----VAMTAM-----SPLIT-----';
}

function wpv_sanitize_portfolio_item_type($type) {
	if($type == 'gallery' || $type == 'video' || $type == 'image')
		return $type;

	return 'image';
}
add_filter('wpv_fancy_portfolio_item_type', 'wpv_sanitize_portfolio_item_type');

function wpv_fix_shortcodes($content) {
	// array of custom shortcodes requiring the fix
	$block = join("|", apply_filters('wpv_escaped_shortcodes', include(WPV_THEME_METABOXES . 'shortcode.php')));

	// opening tag
	$rep = preg_replace("/(<p>\s*)?\[($block)(\s[^\]]+)?\](\s*<\/p>|<br \/>)?/","[$2$3]", $content);

	// closing tag
	$rep = preg_replace("/(?:<\/p>\n*)?(?:<p>\s*)?\[\/($block)](?:\s*<\/p>|<br \/>)?/","[/$1]", $rep);

	return $rep;
}
add_filter('the_content', 'wpv_fix_shortcodes');

function wpv_get_portfolio_terms() {
	$terms = get_the_terms(get_the_id(), 'portfolio_category');
	$terms_slug = $terms_name = array();
	if (is_array($terms)) {
		foreach($terms as $term) {
			$terms_slug[] = preg_replace('/[\pZ\pC]+/u', '-', $term->slug);
			$terms_name[] = $term->name;
		}
	}

	return array($terms_slug, $terms_name);
}

function wpv_recursive_preg_replace($regex, $replace, $subject) {
	if(is_array($subject) || is_object($subject)) {
		foreach($subject as &$sub) {
			$sub = wpv_recursive_preg_replace($regex, $replace, $sub);
		}
		unset($sub);
	}
	if(is_string($subject)) {
		$subject = preg_replace($regex, $replace, $subject);
	}
	return $subject;
}
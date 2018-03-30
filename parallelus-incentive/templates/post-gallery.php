<?php global $custom_query, $column_left, $column_right, $headerClass;
/**
 * 
 * The template for displaying posts in the Gallery post format
 *
 */

$headerClass = ($column_left) ? 'span'.$column_left : '';

// Image size
$shortcode = ( isset($custom_query->query) ) ? $custom_query->query : false;
$size  = get_post_image_size( 'full-width-thumb', $shortcode );

if (is_single()) {
	// see if we have custom size for single post
	$custom_size = '';
	$width  = get_options_data('blog-options', 'single-image-width');
	$height = get_options_data('blog-options', 'single-image-height');
	if ( (isset($width) && !empty($width)) || (isset($height) && !empty($height)) ) {
		$custom_size[0] = (isset($width) && !empty($width)) ? $width : 0;
		$custom_size[1] = (isset($height) && !empty($height)) ? $height : 0;
		$size = $custom_size;
	}
} else {
	// see if we have custom size for post lists
	$width = get_options_data('blog-options', 'image-width');
	$height = get_options_data('blog-options', 'image-height');
	if ( (isset($width) && !empty($width)) || (isset($height) && !empty($height)) ) {
		$custom_size[0] = (isset($width) && !empty($width)) ? $width : 0;
		$custom_size[1] = (isset($height) && !empty($height)) ? $height : 0;
		if (!is_array($size)) {
			$size = $custom_size;
		}
	}
}

// Check for specific width and height settings
$max_w = '';
$max_h = '';
$style = '';
if (is_array($size)) {
	if ($size[0] != 0) $max_w = 'max-width: '.$size[0].'px;';
	if ($size[1] != 0) $max_h = 'max-height: '.$size[0].'px;';
	$style = 'style="'.$max_w.' '.$max_h.'"';
	$size = $size[0].'x'.$size[1];
}

$rotatorParams = array(
	'columns'      => 1, 
	'type'         => 'post-gallery',
	'image_size'   => $size,
	'transition'   => 'fade', 
	'slide_paging' => 'true', 
	'autoplay'     => 'true',
	'interval'     => '3500',
	'class'        => 'slideshow'
);

?>

<header class="post-header <?php echo $headerClass ?>">
	<div class="featured-image" <?php echo $style ?>>
		<div class="styled-image <?php echo get_post_format() ?>"><?php echo theme_content_rotator( $rotatorParams ); ?></div>
	</div>
</header>

<?php get_template_part( 'templates/post'); ?>
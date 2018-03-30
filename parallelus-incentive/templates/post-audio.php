<?php global $custom_query, $column_left, $column_right, $max_columns;
/**
 * The template for displaying audio format posts
 */

// Media
$headerClass = ($column_left) ? 'span'.$column_left : ''; ?>
<header class="post-header <?php echo $headerClass ?>">
	<?php 

	// Featured Image: Audio Player "Poster"
	if ( has_post_thumbnail() ) :

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

		if (is_single() && !get_options_data('blog-options', 'single-post-image', false)) {
			$media =  false;
		} else {
			if (is_array($size)) {
				$thumb = get_post_thumbnail_id($post->ID);
				$crop = (  $size[0] == 0 || $size[1] == 0 ) ? false : true;
				$image = vt_resize( $thumb, '', $size[0], $size[1], $crop );
				$media = '<img src="'. $image['url'] .'" width="'. $image['width'] .'" height="'. $image['height'] .'">';
			} else {
				$media = get_the_post_thumbnail($post->ID, $size);
			}

			$media .= '<div class="inner-overlay"></div>'; 

			// Show the image (linked if blog list) ?>
			<div class="featured-image">
			<?php if ( is_single() ) : ?>
				<div class="styled-image <?php echo get_post_format() ?>"><?php echo $media; ?></div>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>" class="styled-image <?php echo get_post_format() ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo $media ?></a>
			<?php endif; // is_single() ?>
			</div>
			<?php 
		}

	endif;

	// Audio Player
	theme_audio_player($post->ID); 

	?>
</header>

<?php 
// Set a column width if using columns and we have media (an image)
if ($column_right && $headerClass) : ?>
<div class="span<?php echo  $column_right ?>">
<?php endif; 

	// Post title
	theme_post_title();

	// Post Content
	theme_post_content();


if ($column_right && $headerClass) : ?>
</div><!-- .span# -->
<?php endif; ?>
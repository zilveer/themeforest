<?php

/**
 * template part for blog single bold style header heading single.php. views/blog/components
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.1
 */

global $mk_options;

if (mk_get_blog_single_style() != 'bold') return false;

$image_array = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full');
$hero_image_background = $image_array[0];
$hero_image_background_css = (!Mk_Image_Resize::is_default_thumb($hero_image_background)) ? 'background-image:url(' . esc_url( $hero_image_background ) . ');' : '';


$blog_type_theme_options = esc_attr( $mk_options['single_blog_style'] );

// Option to set hero image full height or custom
$full_height = !empty($mk_options['single_bold_hero_full_height']) ? esc_attr( $mk_options['single_bold_hero_full_height'] ) : 'true';
$full_height_attr = ($full_height == 'true') ? 'data-mk-component="FullHeight"' : '';

// Option to set the hero image height when full height option is disabled
$hero_custom_height = !empty($mk_options['bold_single_hero_height']) ? intval( $mk_options['bold_single_hero_height'] ) : 800;
$hero_custom_height_css = ($full_height == 'false') ? ('height:'.$hero_custom_height.'px') : '';


$blog_type = get_post_meta($post->ID, '_single_blog_style', true);


if ( $blog_type == '' || $blog_type == 'default' ) {
	$blog_style = $blog_type_theme_options;
}else {
	$blog_style = $blog_type;
}
?>

<div class="mk-blog-hero center-y <?php echo esc_attr( $blog_style ); ?>-style js-el" style="<?php echo $hero_image_background_css . $hero_custom_height_css; ?>" <?php echo $full_height_attr; ?>>
	<div class="content-holder">
		<h1 class="the-title">
			<?php the_title(); ?>
		</h1>
		<div class="mk-author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 75 ); ?>
		</div>
		<div class="mk-author-name">
			<?php echo esc_attr__( 'By', 'mk_framework' ); ?>
			<a class="mk-author-name" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
				 <?php the_author_meta('display_name'); ?>
			</a>	
		</div>
		
		<time class="mk-publish-date" datetime="<?php the_date('Y-m-d') ?>">
			<a href="<?php echo get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ); ?>"><?php echo get_the_date(); ?></a>
		</time>
	</div>
</div>
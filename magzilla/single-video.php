<?php 
/**
 * The Template for displaying all single blog posts
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/
global $ft_option;
global $post_layout;
global $source_name;
global $source_url;
global $related_css;
global $fave_container;
global $fave_sidebar;
global $single_sidebar_pos;
global $post_layout;
global $css_classes;
global $css_classes_2;
global $stick_sidebar;

if( $ft_option['sticky_sidebar'] != 0 ) {
	$stick_sidebar = 'magzilla_sticky';
}

?>

<?php get_header(); ?>


<?php
if( get_post_meta( get_the_ID(), '_favethemes_video_posttype_meta', true ) ):

	$fave_meta = get_post_meta( get_the_ID(), '_favethemes_video_posttype_meta', true );

	if( $ft_option['single_video_default_settings'] != 1 ) {

		$fave_sidebar = $fave_meta['fave_sidebar'];
		$single_sidebar_pos = $fave_meta['fave_use_sidebar'];
		$post_layout = $fave_meta['post_layout'];

	} else {

		$single_sidebar_pos = $ft_option['single_video_default_sidebar_position'];
		$post_layout = $ft_option['single_video_default_template'];
		$fave_sidebar = $ft_option['single_video_custom_sidebar'];

	}

else:

	if( $ft_option['single_video_default_settings'] != 1 ) {
		$post_layout = 'a';
		$fave_sidebar = 'video-sidebar';
		$fave_sticky_sidebar = '';
		$single_sidebar_pos = 'right';
		
	} else {

		$single_sidebar_pos = $ft_option['single_video_default_sidebar_position'];
		$post_layout = $ft_option['single_video_default_template'];
		$fave_sidebar = $ft_option['single_video_custom_sidebar'];

	}

endif;


if( $single_sidebar_pos == 'right' ) {
	$css_classes = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
	$css_classes_2 = "col-lg-4 col-md-4 col-sm-4 col-xs-12";

	$related_css = "fave_related_post col-lg-6 col-md-6 col-sm-6 col-xs-6";

} elseif ( $single_sidebar_pos == 'left' ) {
	$css_classes = 'col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-4 col-md-push-4 col-sm-push-4';
	$css_classes_2 = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-pull-8 col-md-pull-8 col-sm-pull-8";

	$related_css = "fave_related_post col-lg-6 col-md-6 col-sm-6 col-xs-6";

} elseif ( $single_sidebar_pos == "none" ) {

	$css_classes = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
	$related_css = "fave_related_post col-lg-4 col-md-4 col-sm-4 col-xs-6";
}

?>

<div class="<?php echo $fave_container; ?>">
	
	<?php 
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		
		fave_setViews( get_the_id() );

		get_template_part( 'single-video/single-template', $post_layout );


	endwhile; endif;
	?>
	
</div>


<?php get_footer(); ?>
<?php

/**
 * template part for blog single content single.php. views/blog/components
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */

global $mk_options;

?>
<div class="clearboth"></div>
<div class="mk-single-content clearfix">
	<?php the_content(); ?>
</div>

<?php 
	/* Displays page-links for paginated posts (i.e. includes the <!--nextpage--> Quicktag one or more times) */
	wp_link_pages('before=<div class="mk-page-links">' . esc_html__( 'Pages:', 'mk_framework' ) . '&after=</div>'); 
?>

<?php if($mk_options['diable_single_tags'] == 'true' && get_post_meta( $post->ID, '_disable_tags', true ) != 'false') : ?>
		<div class="single-post-tags">
			<?php 
			if(mk_get_blog_single_style() == 'bold') {
				the_tags('', ' ', '');
			} else {
				the_tags('', ', ', '');
			}	
			 ?>
		</div>
<?php endif; ?>
<?php
/**
 * The template part for displaying content part for standard post format posts. It decide the template structure for standard post format
 *
 */
global $unik_data, $post;
$blog_image_size = $unik_data['blog_image_size']; 
$carousel_images = get_post_meta($post->ID, THEMENAME.'_post_carousel');
?>
	
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if($blog_image_size == 'medium' && !is_single() && (!empty($carousel_images) or has_post_thumbnail( $post->ID ) )): /* blog-medium */?>
	<div class="row">
		<div class="col-sm-6">
			<?php get_template_part('inc/blog','image'); ?>
		</div>
		<div class="col-sm-6">
			<?php get_template_part('inc/blog','header'); ?>
			<?php the_excerpt(); ?>	
		</div>		
	</div>
	
<?php else: /* blog-large */ ?>	
	<div class="clearfix">
		<?php get_template_part('inc/blog','header'); ?>
		<?php get_template_part('inc/blog','image'); ?>
		<?php get_template_part('inc/blog','content'); ?>
	</div>
	
	<?php if($unik_data['social_sharing_box']==1 && is_single()){ get_template_part('inc/social','share'); }?><!-- share box -->
	
	<!-- author bio -->
	<?php if ( is_single() && get_the_author_meta( 'description' ) && $unik_data['author_info']==1 ) : ?>
		<?php get_template_part( 'author-bio' ); ?>
	<?php endif; ?>
	
<?php endif; ?>	

</article>
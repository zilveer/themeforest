<?php
/**
 * It is for displaying content for post format gallery
 *
 */
 
global $unik_data;
$blog_image_size = $unik_data['blog_image_size']; 
?>
	
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if($blog_image_size == 'medium' && !is_single()): /* blog-medium */?>
	<div class="row">
		<div class="col-sm-6">
			<?php get_template_part('inc/gallery','images'); ?>
		</div>
		
		<div class="col-sm-6">
			<?php get_template_part('inc/blog','header'); ?>
			<?php the_excerpt(); ?>		
		</div>
		
	</div>
	
<?php else: /* blog-large */ ?>	
	<div class="clearfix">
		<?php get_template_part('inc/blog','header'); ?>
		<?php get_template_part('inc/gallery','images'); ?>
		<?php get_template_part('inc/blog','content'); ?>
	</div>
	
	<?php if($unik_data['social_sharing_box']==1 && is_single()){ get_template_part('inc/social','share'); } /* social box */ ?>
	
	<!-- author bio -->
	<?php if ( is_single() && get_the_author_meta( 'description' ) && $unik_data['author_info']==1 ) : ?>
		<?php get_template_part( 'author-bio' ); ?>
	<?php endif; ?>
	
<?php endif; ?>	

</article>
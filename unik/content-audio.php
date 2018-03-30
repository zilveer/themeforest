<?php
/**
 * The template part is for displaying content area of post format audio.
 *
 */
 
global $unik_data;

	$blog_image_size = $unik_data['blog_image_size']; 



?>
	
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if($blog_image_size == 'medium' && !is_single() && (get_post_meta($post->ID,THEMENAME.'_featured_audio',true) || get_post_meta($post->ID,THEMENAME.'_featured_audio_url',true))): /* blog-medium */?>
	
	<div class="row">
		<div class="col-sm-6 audio-part">
			<?php get_template_part('inc/audio','upload'); ?>
		</div>
		<div class="col-sm-6 audio-content">
			<?php get_template_part('inc/blog','header'); ?>
			<?php the_excerpt(); ?>		
		</div>

	</div><!-- medium image layout -->
	
<?php else: /* blog-large */ ?>	
	<div class="clearfix">
		<?php get_template_part('inc/blog','header'); ?>
		<?php get_template_part('inc/audio','upload'); ?>
		<?php get_template_part('inc/blog','content'); ?>
	</div>
	
	<?php if($unik_data['social_sharing_box']==1 && is_single()){ get_template_part('inc/social','share'); }?>
	<!-- author bio -->
	<?php if ( is_single() && get_the_author_meta( 'description' ) && $unik_data['author_info']==1 ) : ?>
		<?php get_template_part( 'author-bio' ); ?>
	<?php endif; ?>
<?php endif; ?>	
	<!-- entry content -->
</article>
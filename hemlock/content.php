<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<div class="post-header">
		
		<?php if(!get_theme_mod('sp_post_cat')) : ?>
			<span class="cat"><?php sp_category(', '); ?></span>
		<?php endif; ?>
		
		<?php if(is_single()) : ?>
			<h1><?php the_title(); ?></h1>
		<?php else : ?>
			<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>
		
		<?php if(!get_theme_mod('sp_post_date')) : ?>
			<span class="date"><?php the_time( get_option('date_format') ); ?></span>
		<?php endif; ?>
		
	</div>
	
	<?php if(has_post_format('gallery')) : ?>
	
		<?php $images = get_post_meta( $post->ID, '_format_gallery_images', true ); ?>
		
		<?php if($images) : ?>
		<div class="post-image">
		<ul class="bxslider">
		<?php foreach($images as $image) : ?>
			
			<?php $the_image = wp_get_attachment_image_src( $image, 'full-thumb' ); ?> 
			<?php $the_caption = get_post_field('post_excerpt', $image); ?>
			<li><img src="<?php echo $the_image[0]; ?>" <?php if($the_caption) : ?>title="<?php echo $the_caption; ?>"<?php endif; ?> /></li>
			
		<?php endforeach; ?>
		</ul>
		</div>
		<?php endif; ?>
	
	<?php elseif(has_post_format('video')) : ?>
	
		<div class="post-image">
			<?php $sp_video = get_post_meta( $post->ID, '_format_video_embed', true ); ?>
			<?php if(wp_oembed_get( $sp_video )) : ?>
				<?php echo wp_oembed_get($sp_video); ?>
			<?php else : ?>
				<?php echo $sp_video; ?>
			<?php endif; ?>
		</div>
	
	<?php elseif(has_post_format('audio')) : ?>
	
		<div class="post-image audio">
			<?php $sp_audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
			<?php if(wp_oembed_get( $sp_audio )) : ?>
				<?php echo wp_oembed_get($sp_audio); ?>
			<?php else : ?>
				<?php echo $sp_audio; ?>
			<?php endif; ?>
		</div>
	
	<?php else : ?>
		
		<?php if(has_post_thumbnail()) : ?>
		<?php if(!get_theme_mod('sp_post_thumb')) : ?>
		<div class="post-image">
			<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('full-thumb'); ?></a>
		</div>
		<?php endif; ?>
		<?php endif; ?>
		
	<?php endif; ?>
	
	<div class="post-entry">
	
		<?php the_content(__('Continue Reading...', 'solopine')); ?>
		<?php wp_link_pages(); ?>
		
		<?php if(!get_theme_mod('sp_post_tags')) : ?>
		<?php if(is_single()) : ?>
			<div class="post-tags">
				<?php the_tags("",""); ?>
			</div>
		<?php endif; ?>
		<?php endif; ?>
		
	</div>
	
	<?php if(!get_theme_mod('sp_post_share')) : ?>
	<div class="post-share">
		
		<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(the_permalink()); ?>"><span class="share-box"><i class="fa fa-facebook"></i></span></a>
		<a target="_blank" href="https://twitter.com/intent/tweet/?text=Check%20out%20this%20article:%20<?php print solopine_social_title( get_the_title() ); ?>%20-%20<?php echo urlencode(the_permalink()); ?>"><span class="share-box"><i class="fa fa-twitter"></i></span></a>
		<?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
		<a target="_blank" data-pin-do="none" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(the_permalink()); ?>&media=<?php echo $pin_image; ?>&description=<?php print solopine_social_title( get_the_title() ); ?>"><span class="share-box"><i class="fa fa-pinterest"></i></span></a>
		<a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode(the_permalink()); ?>"><span class="share-box"><i class="fa fa-google-plus"></i></span></a>
		<?php comments_popup_link( '<span class="share-box"><i class="fa fa-comment-o"></i></span>', '<span class="share-box"><i class="fa fa-comment-o"></i></span>', '<span class="share-box"><i class="fa fa-comment-o"></i></span>', '', ''); ?>
		
	</div>
	<?php endif; ?>
	
	<?php if(!get_theme_mod('sp_post_author')) : ?>
	<?php if(is_single()) : ?>
		<?php get_template_part('inc/templates/about_author'); ?>
	<?php endif; ?>
	<?php endif; ?>
	
	<?php if(!get_theme_mod('sp_post_related')) : ?>
	<?php if(is_single()) : ?>
		<?php get_template_part('inc/templates/related_posts'); ?>
	<?php endif; ?>
	<?php endif; ?>
	
	<?php comments_template( '', true );  ?>
	
	<?php if(!get_theme_mod('sp_post_nav')) : ?>
	<?php if(is_single()) : ?>
		<?php get_template_part('inc/templates/post_pagination'); ?>
	<?php endif; ?>
	<?php endif; ?>
	
</article>
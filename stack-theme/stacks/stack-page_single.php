<?php if( get_the_content() != '' ): ?>
<div class="stack stack-page-content" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">
	
	<div class="span8">
	<div class="padding-right-20">	
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if( get_post_thumbnail_id() && theme_options( 'blog', 'single_featured_img' ) != 'off' ): ?>
		<div class="post-thumb-box">
			<?php echo gen_responsive_image_block( get_post_thumbnail_id(), array(
					array( 'width' => 290, 'media' => '(max-width: 767px)' ),
					array( 'width' => 290*2, 'media' => '(max-width: 767px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
					array( 'width' => 456, 'media' => '(min-width: 768px)' ),
					array( 'width' => 456*2, 'media' => '(min-width: 768px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
					array( 'width' => 600, 'media' => '(min-width: 980px)' ),
					array( 'width' => 600*2, 'media' => '(min-width: 980px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
				) 
			); ?>
		</div>
		<?php endif; ?>	

		<?php the_content(); ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'theme_front' ), 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		<div class="clear"></div>

		<!-- Author Box -->
		<?php if( is_single() && theme_options( 'blog', 'single_author_box' ) == 'on' ): ?>
			<?php get_template_part('part', 'author-box'); ?>
		<?php endif; ?>

		<!-- Comment -->
		<?php if( comments_open() && !( is_page() && theme_options('page', 'comment_enable') == 'off' ) ): ?>
			<?php comments_template(); ?>
		<?php endif; ?>
	</div>
	</div>
	</div>

	<aside class="span4 sidebar">
		<?php 
			global $post;
			if ( get_post_meta($post->ID, '_general_custom_sidebar', true) ) dynamic_sidebar( get_post_meta($post->ID, '_general_custom_sidebar', true) );
			else dynamic_sidebar( 'blog' );
		?>
	</aside>
	
</div>
</div>
</div>
<?php endif; ?>
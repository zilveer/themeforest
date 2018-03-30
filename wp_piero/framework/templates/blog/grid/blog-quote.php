<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header">
			<div class="cs-blog-content cs-blog-media cs-blog-quote">
				<div class="cs-quote-text">
					<?php $quote_type = get_post_meta($post->ID, 'cs_post_quote_type', true);
					$quote_content = '';
					if($quote_type == 'custom'){
					?>
						<?php echo get_post_meta($post->ID, 'cs_post_quote', true); ?>
						<?php if(get_post_meta($post->ID, 'cs_post_author', true)): ?>
						<div class="author"><span><?php echo esc_attr(get_post_meta($post->ID, 'cs_post_author', true)); ?></span></div>
						<?php endif; ?>
					<?php } else {
						echo get_the_excerpt();
					}?>
				</div>
				<?php echo cshero_info_category_render('categories'); ?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
				<?php echo cshero_info_bar_render(); ?>
			</div>
			<?php cshero_content_render(); ?>
			<?php echo cshero_info_footer_render(); ?>
		</div><!-- .entry-content -->
		
	</div>
</article><!-- #post-## -->

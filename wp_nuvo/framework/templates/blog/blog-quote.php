<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(cshero_generetor_blog_column()); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header cs-blog-quote">
			<div class="cs-blog-content table">
				<span class="icon-left table-cell"></span>
					<div class="cs-content-text table-cell">
						<?php $quote_type = get_post_meta($post->ID, 'cs_post_quote_type', true);
						$quote_content = '';
						if($quote_type == 'custom'){
						?>
							<?php echo get_post_meta($post->ID, 'cs_post_quote', true); ?>
							<?php if(get_post_meta($post->ID, 'cs_post_author', true)): ?>
							<span class="author"><?php echo esc_attr(get_post_meta($post->ID, 'cs_post_author', true)); ?></span>
							<?php endif; ?>
						<?php } else {
							the_excerpt();
						}?>
					</div>
				<span class="icon-right table-cell"></span>
			</div>
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_info_bar_render(); ?>
			</div>
		</header><!-- .entry-header -->
	</div>
</article><!-- #post-## -->

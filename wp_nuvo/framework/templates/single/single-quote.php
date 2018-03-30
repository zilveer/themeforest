<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog cs-blog-item">
		<header class="cs-blog-header cs-blog-quote">
			<?php if(get_post_meta($post->ID, 'cs_post_quote_type', true) == 'custom'):?>
			<div class="cs-blog-content table">
				<span class="icon-left table-cell"></span>
					<div class="cs-content-text table-cell">
						<?php echo get_post_meta($post->ID, 'cs_post_quote', true); ?>
						<?php if(get_post_meta($post->ID, 'cs_post_author', true)): ?>
						<span class="author"><?php echo esc_attr(get_post_meta($post->ID, 'cs_post_author', true)); ?></span>
						<?php endif; ?>
					</div>
				<span class="icon-right table-cell"></span>
			</div>
			<?php endif; ?>
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php if($smof_data['show_post_title'] == '1'): ?>
				<div class="cs-blog-title"><h3><?php the_title(); ?></h3></div>
				<?php endif; ?>
				<!-- .info-bar -->
				<?php echo cshero_info_bar_render(); ?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php
				the_content();
				wp_link_pages( array(
					'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . esc_html__( 'Pages:','wp_nuvo') . '</span>',
					'after'       => '</div>',
					'link_before' => '<span class="page-numbers">',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
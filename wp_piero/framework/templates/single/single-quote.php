<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	<?php if(get_post_meta($post->ID, 'cs_post_quote_type', true) == 'custom'):?>
		<div class="single-post-media single-post-quote">
			<?php echo get_post_meta($post->ID, 'cs_post_quote', true); ?>
			<?php if(get_post_meta($post->ID, 'cs_post_author', true)): ?>
			<<?php echo esc_attr($smof_data['detail_title_heading']);?> class="author"><?php echo esc_attr(get_post_meta($post->ID, 'cs_post_author', true)); ?></<?php echo esc_attr($smof_data['detail_title_heading']);?>>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<header class="single-post-header">
		<?php echo cshero_post_details_info_render();?>
		<?php if($smof_data['show_post_title'] == '1'): ?>
			<div class="single-post-title"><<?php echo $smof_data['detail_title_heading'];?> class="cs-entry-title"><?php the_title(); ?></<?php echo $smof_data['detail_title_heading'];?>></div>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="single-post-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:',THEMENAME) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-numbers">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
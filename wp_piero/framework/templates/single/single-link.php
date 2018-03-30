<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post blog-grid'); ?>>
	<div class="cs-blog-media single-post-media single-post-thumbnail">
	<div class="cs-blog-thumbnail">
		<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment()) { ?>
			<?php the_post_thumbnail(); ?>
		<?php } else { ?>
			<img alt="<?php the_title();?>" title="<?php echo the_title();?>" src="<?php echo get_template_directory_uri();?>/assets/images/no-image.jpg" />
		<?php } ?>
		<?php echo cshero_post_link_render('link'); ?>
	</div>
	</div>
	<header class="single-post-header">
		<?php echo cshero_post_details_info_render();?>
		<?php if($smof_data['show_post_title'] == '1'): ?>
			<div class="single-post-title"><<?php echo esc_attr($smof_data['detail_title_heading']);?> class="cs-entry-title"><?php the_title(); ?></<?php echo esc_attr($smof_data['detail_title_heading']);?>></div>
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
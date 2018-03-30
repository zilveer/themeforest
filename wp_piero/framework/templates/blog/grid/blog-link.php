<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header">
			<div class="cs-blog-media">
    			<div class="cs-blog-thumbnail">
    				<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment()) { ?>
    					<?php the_post_thumbnail(); ?>
    				<?php } else { 
    					$no_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
    					echo '<img alt="'.$the_title.'" title="'.$the_title.'" src="'.$no_image.'" />';
    				} ?>
    				<?php echo cshero_info_category_render('categories'); ?>
    				<?php echo cshero_post_link_render('link'); ?>
    			</div><!-- .entry-thumbnail -->
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


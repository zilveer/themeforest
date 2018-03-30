<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(cshero_generetor_blog_column()); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header">
		    <div class="blog-title-top">
    		    <div class="date-box table-cell">
    				<div class="date left">
                        <span class="day"><?php echo get_the_date('j'); ?></span>
                        <span class="month"><?php echo get_the_date('M'); ?></span>
    				</div>
    				<span class="icon-type-post right"><i class="<?php echo cshero_get_icon_post_type(); ?>"></i></span>
    			</div>
			    <?php echo cshero_title_render(); ?>
			</div>
			<div class="cs-blog-media">
			<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
			<div class="cs-blog-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .entry-thumbnail -->
			<?php endif; ?>
			</div>
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_info_bar_render(); ?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php cshero_content_render(); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->


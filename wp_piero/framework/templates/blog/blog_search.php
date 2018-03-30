<?php
/**
 * @package cshero
 */
global $cs_span,$masonry_filter;
$class='cs-masonry-layout-item '.$cs_span.' ';
if($masonry_filter){
	global $cs_cat_class;
	$class .= "category-".$cs_cat_class;
}
?>
<?php global $smof_data; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header">
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
			<div class="cs-blog-media">
				<div class="cs-blog-thumbnail">
					<?php the_post_thumbnail(); ?>
					<?php echo cshero_info_category_render('categories'); ?>
					<?php echo cshero_read_more_overlay_render();?>
				</div><!-- .entry-thumbnail -->
			</div>
			<?php endif; ?>
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php
					echo cshero_title_render();
					echo cshero_info_bar_render();
				?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php 
			$content = get_the_excerpt();
			if($content != ''){
				echo $content;
			}
			if($smof_data['search_view']=='Read More'){
				echo cshero_read_more_render();
			}
			?>
		</div><!-- .entry-content -->
		<div class="cs-meta-bottom-wrap">
			<?php echo cshero_info_footer_render(); ?>
		</div>
	</div>
</article><!-- #post-## -->

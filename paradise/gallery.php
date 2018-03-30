<?php
	get_header();
	if ( have_posts() ): the_post();
	get_template_part('part', 'title');
?>
	<!-- Start Content Wrapper -->
	<div id="content_wrapper">
		<div class="box">
<?php
	$terms = array();
	$terms[0] = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$childrens = get_term_children( $terms[0]->term_id, 'gallery' );
	foreach ($childrens as $children) {
		$terms[] = get_term($children, 'gallery');
	}
?>
			<!-- View By Box -->
			<div class="splitter_wrap">
				<strong><?php _e('View by:', TEMPLATENAME); ?></strong>
				<ul id="filter" class="splitter">
					<?php foreach($terms as $key => $term): ?>
					<li><a href="#top" rel="<?php echo $term->slug; ?>" title="<?php echo $term->name; ?>"><?php echo $term->name; ?></a></li>
					<?php endforeach; ?>
				</ul>
				<div class="clear"></div>
			</div>
			<!-- Portfolio Full Box -->
			<ul id="portfolio" class="image-grid">
<?php
	do {
		$gallery_categories = get_the_terms($post->ID, 'gallery');
		$term_classes = array();
		foreach($gallery_categories as $cat) {
			$term_classes[] = $cat->slug;
		}
		$term_classes = implode(' ', $term_classes);

		$video_link = get_post_meta(get_the_ID(), 'video_link', true);
		$image_id = get_post_thumbnail_id();
		$full_thumbnail = wp_get_attachment_image_src($image_id, 'full');
?>
				<li id="id<?php echo the_ID(); ?>" class="<?php echo $term_classes; ?>">
					<?php if (has_post_thumbnail()): ?>
					<a href="<?php if (!empty($video_link)) echo $video_link; else echo $full_thumbnail[0]; ?>" rel="prettyPhoto[gallery]">
					<?php
					the_post_thumbnail('gallery', array('title' => false, 'class' => 'pic')); ?>
					</a>
					<?php else: ?>
					<img src="<?php echo get_bloginfo('template_url'); ?>/timthumb.php?src=<?php echo get_bloginfo('template_url').'/images/no_image.gif&w=140&h=140'; ?>" class="pic" title="" alt="" />
					<?php endif; ?>
				</li>
<?php
		if (!have_posts())
			break;
		the_post();
	} while (1);
?>
			</ul>
			<?php /* Display navigation to next/previous pages when applicable */
			if ($wp_query->max_num_pages > 1): ?>
			<!-- Start Paging -->
				<?php	if (function_exists('wp_pagenavi')):
						echo wp_pagenavi();
				else: ?>
			<div class="navigation" id="nav-below">
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', TEMPLATENAME)); ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', TEMPLATENAME)); ?></div>
			</div><!-- #nav-below -->
				<?php endif; ?>
			<!-- End Paging -->
			<?php endif; ?>
			<div class="clear"></div>
		</div>
	</div>
	<!-- End Content Wrapper -->
<?php
	endif;
	get_footer();
 ?>
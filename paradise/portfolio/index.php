<?php
	get_header();
	$columns = (isset($_GET['columns'])) ? $_GET['columns'] : '';
	if ($columns)
		update_option('portfolio_layout', $columns);
	$portfolio_layout = get_option('portfolio_layout');
	if ( have_posts() ): the_post();

	get_template_part('part', 'title');
	$_readmore_text = get_option('portfolio_more_text');
?>
	<!-- Start Content Wrapper -->
	<div id="content_wrapper">
		<div class="box">
			<!-- Portfolio Full Box -->
			<ul id="<?php echo $portfolio_layout; ?>">
<?php
	do {
		$target_link = get_post_meta(get_the_ID(), 'target_link', true);
		$video_link = get_post_meta(get_the_ID(), 'video_link', true);
		$image_id = get_post_thumbnail_id();
		$full_thumbnail = wp_get_attachment_image_src($image_id, 'full');
?>
				<li>
					<a href="<?php if (!empty($video_link)) echo $video_link; else echo $full_thumbnail[0]; ?>" rel="prettyPhoto[gallery2]" class="gall">
					<?php if (has_post_thumbnail()): ?>
						<?php the_post_thumbnail($portfolio_layout, array('title' => false)); ?>
					<?php else: ?>
					<?php
						if ($portfolio_layout == 'portfolio2') {
							$_tw = 510;
							$_th = 250;
						} elseif ($portfolio_layout == 'portfolio3') {
							$_tw = 440;
							$_th = 230;
						} else {
							$_tw = 280;
							$_th = 180;
						}
					?>
					<img src="<?php echo get_bloginfo('template_url'); ?>/timthumb.php?src=<?php echo get_bloginfo('template_url')."/images/no_image.gif&w={$_tw}&h={$_th}"; ?>" title="" alt="" />
					<?php endif; ?>
						<?php if (!empty($video_link)): ?>
						<span class="hover_vid"></span><!-- Thumbnail for hover effect -->
						<?php else: ?>
						<span class="hover_img"></span><!-- Thumbnail for hover effect -->
						<?php endif; ?>
					</a>
					<h2><?php the_title(); ?></h2>
					<?php the_excerpt(); ?>
					<?php if (!empty($_readmore_text)): ?>
					<a href="<?php the_permalink(); ?>" title="<?php echo $_readmore_text; ?>" class="btn"><?php echo $_readmore_text; ?></a>
					<?php endif; ?>
					<div class="clear"></div>
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
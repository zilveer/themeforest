<?php
/* ------------------------------------------------------------------------------------------------------------

	Template Name: Blog

------------------------------------------------------------------------------------------------------------ */
?>
<?php get_header(); ?>
<?php
	$l = _sg('Layout')->getLayout();
	$sb = _sg('Sidebars')->getSidebar('content');
	$usb = ($l != 'portfolio_4' AND $sb != SG_Module::USE_NONE);

	$prc = _sg('Blog')->getRequiredCategories();
	$args = array(
		'posts_per_page' => _sg('Blog')->getPostsCount(),
		'paged' => sg_paged(),
	);
	if (!empty($prc)) $args['category__in'] = $prc;

	query_posts($args);
?>
<div class="ef-row <?php echo ($l == 'page_l' OR $l == 'page_r') ? 'ef-blog-classic' : 'clearfix'; ?>">
	<?php if ($usb) echo '<div class="ef-recent ' . (($l == 'page_l' OR $l == 'blog_grid_l') ? 'alignright' : 'alignleft') . '">'; ?>
		<?php if (have_posts()) { ?>
			<?php if ($l != 'page_l' AND $l != 'page_r') echo '<div id="ef-bloglist">'; ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php
					$ts = ($l == 'page_l' OR $l == 'page_r') ? 'sg_post' : 'sg_post_small';
					$img = get_the_post_thumbnail(null, $ts, array('alt' => get_the_title()));
					$img_e = (empty($img)) ? FALSE : TRUE;
				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('ef-blog-post ' . (($l == 'page_l' OR $l == 'page_r') ? 'bottom-3_em clearfix' : 'ef-col1-4 bottom-2_4em' )); ?>>
					<div class="ef-col">
						<?php if ($img_e) { ?>
							<div class="proj-img bottom-1_2em">
								<?php if (_sg('Post', TRUE)->getType(get_the_ID()) == 'slider' AND _sg('Post', TRUE)->showSlider(get_the_ID())) { ?>
									<div class="ef-post-slider">
										<ul class="slides">
											<?php echo '<li>' . $img . '</li>'; _sg('Post', TRUE)->eSlider(get_the_ID(), 'sg_post_small'); ?>
										</ul>
									</div>
								<?php } elseif (($l == 'page_l' OR $l == 'page_r') AND _sg('Post', TRUE)->getType(get_the_ID()) == 'video') { ?>
									<?php _sg('Post', TRUE)->eVideo(get_the_ID()); ?>
								<?php } else { ?>
									<a href="<?php the_permalink(); ?>"><?php echo $img; ?></a>
								<?php } ?>
							</div>
						<?php } ?>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<div class="extras-descrp"><?php echo sg_the_tag_list('category', ', '); ?></div>
						<div class="ef-date-comments">
							<div><?php the_time('d'); ?><span><?php the_time('M'); ?></span></div>
							<div><?php echo sg_comments_count() . '<span>' . ((sg_comments_count() == 1) ? __('Comment', SG_TDN) : __('Comments', SG_TDN)) . '</span>'; ?></div>
						</div>
						<p><?php echo str_replace('<p>', '', str_replace('</p>', '<br />', sg_text_trim(get_the_excerpt(), 300))); ?></p>
						<a class="ef-read-more" href="<?php the_permalink(); ?>"><span><?php _e('More', SG_TDN); ?></span></a>
					</div>
				</div>
			<?php endwhile; ?>
			<?php if ($l != 'page_l' AND $l != 'page_r') echo '</div>'; ?>
		<?php } else {
			echo '<div style="padding-left:40px;">' . sg_message(__('Blog is empty', SG_TDN)) . '&nbsp;</div>';
		} ?>
	<?php if ($usb) echo '</div>'; ?>
	<?php if ($usb) { ?>
		<div class="ef-sidebar">
			<div class="ef-col">
				<?php
					if ($sb == SG_Module::USE_DEFAULT) {
						sg_right_sidebar();
						sg_right_sidebar_b();
					} else {
						if (!dynamic_sidebar($sb)) {
							sg_empty_sidebar(_sg('Sidebars')->getSidebarName($sb));
						}
					}
				?>
			</div>
		</div>
	<?php } ?>
</div>
<?php sg_pagination($wp_query->max_num_pages); ?>
<?php get_footer(); ?>
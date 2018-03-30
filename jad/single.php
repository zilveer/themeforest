<?php get_header(); ?>
<?php
	$l = _sg('Layout')->getLayout();
	$sb = _sg('Sidebars')->getSidebar('content');
?>
<?php if (sg_get_tpl() == 'our-team|default' OR sg_get_tpl() == 'extra|default' OR is_attachment()) { ?>
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	<?php } else {
		echo sg_message(__('Sorry, no posts matched your criteria', SG_TDN));
	} ?>
<?php } else { ?>
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php if (_sg('HandF')->showNear()) sg_navigation(_sg('HandF')->nearType()); ?>
			<?php if (sg_get_tpl() == 'portfolio|default') { ?>
				<div class="ef-row clearfix">
					<div class="ef-col ef-gu6 ef-proj-thumbs">
						<?php if (_sg('PortfolioPost')->getType() == 'video') { ?>
							<div class="proj-video">
								<?php _sg('PortfolioPost')->eVideo(); ?>
							</div>
						<?php } else { ?>
							<?php
								$img = get_the_post_thumbnail(null, 'sg_portfolio_large');
								$img_e = (empty($img)) ? FALSE : TRUE;
							?>
							<?php if ($img_e) { ?>
								<div class="proj-img">
									<a class="ef-view" href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" rel="ef-group"><?php echo $img; ?></a>
								</div>
								<?php if (_sg('PortfolioPost')->showSlider()) { ?>
									<?php _sg('PortfolioPost')->eSlider(FALSE, 'sg_portfolio_large'); ?>
								<?php }  ?>
							<?php } ?>
						<?php } ?>
					</div>
					<div class="ef-col ef-gu6 ef-proj-details">
						<div id="theFixed" class="ef-gu6">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div class="ef-blog-classic ef-row">
					<div class="ef-recent <?php echo ($l == 'page_l') ? 'alignright' : 'alignleft'; ?>">
						<?php
							$img = (_sg('Post')->showThumbnail()) ? get_the_post_thumbnail(null, 'sg_post') : '';
							$img_e = (empty($img)) ? FALSE : TRUE;
						?>
						<div id="post-<?php the_ID(); ?>" <?php post_class('bottom-3_em ef-blog-post clearfix'); ?>>
							<div class="ef-col">
								<?php if ($img_e) { ?>
									<div class="proj-img bottom-1_2em">
										<?php if (_sg('Post')->getType() == 'slider' AND _sg('Post')->showSlider()) { ?>
											<div class="ef-post-slider">
												<ul class="slides">
													<?php echo '<li><a class="ef-view" href="' . wp_get_attachment_url(get_post_thumbnail_id()) . '" rel="ef-group">' . $img . '</a></li>';
													_sg('Post')->eSlider(FALSE, 'sg_post'); ?>
												</ul>
											</div>
										<?php } elseif (_sg('Post')->getType() == 'video') { ?>
											<?php _sg('Post')->eVideo(); ?>
										<?php } else { ?>
											<a class="ef-view" href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" rel="ef-group"><?php echo $img; ?></a>
										<?php } ?>
									</div>
								<?php } ?>
								<div class="extras-descrp"><?php echo sg_the_tag_list('category', ', '); ?></div>
								<div class="ef-date-comments">
									<div><?php the_time('d'); ?><span><?php the_time('M'); ?></span></div>
									<div><?php echo sg_comments_count() . '<span>' . ((sg_comments_count() == 1) ? __('Comment', SG_TDN) : __('Comments', SG_TDN)) . '</span>'; ?></div>
								</div>
								<?php the_content(); ?>
							</div>
						</div>
						<?php if (_sg('Post')->showComments()) comments_template(); ?>
					</div>
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
				</div>
			<?php } ?>
		<?php endwhile; ?>
	<?php } else {
		echo sg_message(__('Sorry, no posts matched your criteria', SG_TDN));
	} ?>
<?php } ?>
<?php get_footer(); ?>
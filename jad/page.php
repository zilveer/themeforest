<?php get_header(); ?>
<?php
	the_post();
	$l = _sg('Layout')->getLayout();
	$sb = _sg('Sidebars')->getSidebar('content');
	$usb = ($l != 'page_n' AND $sb != SG_Module::USE_NONE);
	$content = get_the_content();
?>
<?php if (!empty($content)) { ?>
	<?php if ($usb) { ?>
		<div class="ef-row clearfix">
			<div class="ef-recent <?php echo ($l == 'page_l') ? 'alignright' : 'alignleft'; ?>">
				<div class="ef-col">
					<?php wp_reset_query(); the_content();?>
				</div>
			</div>
			<div class="ef-sidebar">
				<div class="ef-col">
					<?php if (!dynamic_sidebar($sb)) sg_empty_sidebar(_sg('Sidebars')->getSidebarName($sb)); ?>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<?php wp_reset_query(); the_content();?>
	<?php } ?>
<?php } ?>
<?php if (_sg('Page')->getBottomType() == 'team') { ?>
	<?php
		$args = array();
		$args['post_type'] = 'our-team';
		$args['posts_per_page'] = -1;
		$args['order'] = 'ASC';
		if (_sg('Page')->getTeamCategory() != 0) {
			$args['post__in'] = get_objects_in_term(_sg('Page')->getTeamCategory(), 'our-team_category');
		}
		query_posts($args);
		$i = 0;
	?>
	<?php if (!empty($content)) echo '<hr class="ef-blank" /><hr class="bottom-2_4em" />'; ?>
	<?php if (_sg('Page')->showTeamTitle()) { ?>
		<div class="divider-title bottom-3_em"><span><span><?php _sg('Page')->eTeamTitle(); ?></span></span></div>
	<?php } ?>
	<?php if (have_posts()) { ?>
		<div class="ef-from-blog clearfix">
			<?php while (have_posts()) : the_post(); $i++; ?>
				<?php $ot_person = _sg('OurTeam', TRUE)->getPerson(get_the_ID()); ?>
				<?php if ($i % 5 == 0) echo '<div class="clear"></div>'; ?>
				<div class="ef-col1-4 bottom-2_4em">
					<?php if (!empty($ot_person->photo)) { ?>
						<div class="proj-img"><?php echo $ot_person->photo; ?></div>
					<?php } ?>
					<div class="ef-indent">
						<h3><?php the_title(); ?></h3>
						<?php if (!empty($ot_person->position)) { ?>
							<div class="extras-descrp"><?php _e($ot_person->position); ?></div>
						<?php } ?>
						<?php the_content(); ?>
						<?php echo $ot_person->soc; ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php } else {
		$empty_extras = __('Team is empty', SG_TDN);
		echo sg_message($empty_extras);
	} ?>
<?php } ?>
<?php if (_sg('Page')->getBottomType() == 'extra') { ?>
	<?php
		$args = array();
		$args['post_type'] = 'extra';
		$args['posts_per_page'] = -1;
		$args['order'] = 'ASC';
		if (_sg('Page')->getExtrasCategory() != 0) {
			$args['post__in'] = get_objects_in_term(_sg('Page')->getExtrasCategory(), 'extra_category');
		}
		query_posts($args);
	?>
	<?php if (!empty($content)) echo '<hr class="ef-blank" />'; ?>
	<?php if (_sg('Page')->showExtrasTitle()) { ?>
		<div class="divider-title bottom-3_em"><span><span><?php _sg('Page')->eExtrasTitle(); ?></span></span></div>
	<?php } ?>
	<?php if (have_posts()) { ?>
		<div class="ef-row ef-extras">
			<?php while (have_posts()) : the_post(); ?>
				<div class="ef-col ef-gu4 bottom-1_2em">
					<?php _sg('Extra', TRUE)->eExtraIcon(get_the_ID()); ?>
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<div class="extras-descrp bottom-1_2em"><?php _sg('Extra', TRUE)->eDescription(get_the_ID()); ?></div>
					<p><?php echo str_replace('<p>', '', str_replace('</p>', '<br />', sg_text_trim(get_the_excerpt(), 180))); ?></p>
				</div>
			<?php endwhile; ?>
		</div>
	<?php } else {
		$empty_extras = __('Extras is empty', SG_TDN);
		echo sg_message($empty_extras);
	} ?>

<?php } ?>
<?php get_footer(); ?>
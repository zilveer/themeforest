<?php get_header(); ?>

<?php get_template_part('inc_section'); ?>

<div class="row main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php
			$event_date 	= explode("-",get_post_meta($post->ID, 'ci_cpt_events_date', true));
			$event_time 	= get_post_meta($post->ID, 'ci_cpt_events_time', true);
			$event_location = get_post_meta($post->ID, 'ci_cpt_events_location', true);
			$event_venue 	= get_post_meta($post->ID, 'ci_cpt_events_venue', true);
			$event_status 	= get_post_meta($post->ID, 'ci_cpt_events_status', true);
			$event_wording	= get_post_meta($post->ID, 'ci_cpt_events_button', true);
			$recurrent 		= get_post_meta($post->ID, 'ci_cpt_event_recurrent', true);
			$recurrence 	= get_post_meta($post->ID, 'ci_cpt_event_recurrence', true);
			$event_url		= "#";

			switch ($event_status) {
				case "buy":
					if ($event_wording == "") $event_wording 	= __('Buy Tickets','ci_theme'); 
					$event_url		= get_post_meta($post->ID, 'ci_cpt_events_tickets', true);
					break;
				case "sold":
					if ($event_wording == "") $event_wording 	= __('Sold Out','ci_theme'); 
					break;
				case "canceled":
					if ($event_wording == "") $event_wording 	= __('Canceled','ci_theme'); 
					break;
				case "watch":
					if ($event_wording == "") $event_wording 	= __('Watch Live','ci_theme');
					$event_url		= get_post_meta($post->ID, 'ci_cpt_events_live', true); 
					break;
			}
		?>

		<div class="nine columns">
			<div class="content-inner">
				<h2><?php the_title(); ?></h2>
				<div id="meta-wrap" class="group">
					<ul class="single-meta">
						<?php if($recurrent=='enabled'): ?>
							<li><span><?php _e('When:','ci_theme'); ?></span> <?php echo strip_tags($recurrence); ?></li>
						<?php else: ?>
							<li><span><?php _e('Date:','ci_theme'); ?></span> <?php echo $event_date[2]; ?> - <?php echo ci_the_month($event_date[1]); ?> - <?php echo $event_date[0]; ?></li>
							<li><span><?php _e('Time:','ci_theme'); ?></span> <?php echo $event_time; ?></li>
						<?php endif; ?>
						<li><span><?php _e('Location:','ci_theme'); ?></span> <?php echo $event_location; ?></li>
						<li><span><?php _e('Venue:','ci_theme'); ?></span> <?php echo $event_venue; ?></li>
						<?php if(!empty($event_status)): ?>
							<?php $new_window = in_array($event_status, array('buy', 'watch')) && ci_setting('events_url_buttons_new_win')=="enabled" ? ' target="_blank" ' : ''; ?>
							<li><span>&nbsp;</span><a href="<?php echo esc_url($event_url); ?>" class="btn <?php echo esc_attr($event_status); ?>" <?php echo $new_window; ?>><?php echo $event_wording; ?></a></li>
						<?php endif; ?>
					</ul>
				</div><!-- /meta-wrap -->
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div><!-- /content-inner -->
		</div><!-- /nine columns -->

		<div class="three columns">
			<div class="widget widget-single-event">
				<div class="widget-content">
					<?php $event_thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'large', true); ?>
					<a href="<?php echo $event_thumb_url[0]; ?>" data-rel="prettyPhoto">
						<?php the_post_thumbnail('ci_width', array('class'=> "scale-with-grid")); ?>
					</a>
				</div><!-- widget-content -->
			</div><!-- /widget -->

			<div id="single-sidebar">
				<?php dynamic_sidebar('events-sidebar'); ?>
			</div>
		</div><!-- /three columns -->

	<?php endwhile; endif; ?>
</div><!-- /row -->

<?php get_footer(); ?>
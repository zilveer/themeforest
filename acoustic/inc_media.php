<?php if (ci_setting('latest_media') == 'enabled'): ?>

<div class="row latest-media">
	<div class="twelve columns">
		<h3 class="widget-title"><?php _e('LATEST MEDIA','ci_theme'); ?></h3>

		<div class="row latest-media-generate ">
			<?php
				$i = 1;
				$args = array(
					'posts_per_page' => 4,
					'orderby'        => 'rand',
					'post_type'      => array(
						'cpt_videos',
						'cpt_galleries'
					),
				);
				$latest_media = new WP_Query($args);
			?>
			<?php while ( $latest_media->have_posts() ) : $latest_media->the_post(); ?>

				<?php $cpt = get_post_type( $post->ID ); ?>

				<?php if ($cpt == 'cpt_videos'): ?>
					<?php
						$video_url 	= get_post_meta($post->ID, 'ci_cpt_videos_url', true);
						$video_type = get_post_meta($post->ID, 'ci_cpt_videos_self', true);	
					?>
					<div class="three columns">
						<div class="media-block media-video widget-content">
							<a href="<?php if ($video_type == 1): echo "#player" . $i . "-wrap"; else: echo esc_url($video_url); endif; ?>" data-rel="pp_video">
								<span class="media-act"></span>
								<?php the_post_thumbnail('ci_video_thumb'); ?>
							</a>
							<div class="media-block-details title-pair">
								<h3 class="pair-title"><?php the_title(); ?></h3>
								<a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','ci_theme'); ?></a>
							</div>
							<?php if ($video_type == 1): ?>
								<div id="player<?php echo $i; ?>-wrap" class="video-player hidden">
									<video width="480" height="360" src="<?php echo esc_url($video_url); ?>" controls="controls" preload="none"></video>
								</div><!-- /player-wrap -->
							<?php $i++; endif; ?>
						</div>
					</div><!-- /media-block -->
				<?php else: ?>
					<?php
						$gal_location = get_post_meta($post->ID, 'ci_cpt_galleries_location', true);
						$gal_venue    = get_post_meta($post->ID, 'ci_cpt_galleries_venue', true);
					 ?>
					<div class="three columns">
						<div class="media-block media-photo widget-content">
							<a href="<?php the_permalink(); ?>">
								<span class="media-act"></span>
								<?php the_post_thumbnail('ci_video_thumb'); ?>
							</a>
							<div class="media-block-details title-pair">
								<h3 class="pair-title"><?php echo $gal_venue; ?></h3>
								<p class="pair-sub"><?php echo $gal_location; ?></p>
								<a href="<?php the_permalink(); ?>" class="btn"><?php _e('View set','ci_theme'); ?></a>
							</div>
						</div>
					</div><!-- /media-block -->
				<?php endif; ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</div><!-- /latest-media -->

<?php endif; ?>
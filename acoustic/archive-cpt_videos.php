<?php get_header(); ?>

<?php get_template_part('inc_section'); ?>

<div class="row main">
	<div class="twelve columns">
		<ol class="row listing video-listing">
			<?php
				$i = 1;
				ci_column_classes(ci_setting('archive_tpl'), 12, true);
			?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php
					$video_url 	= get_post_meta($post->ID, 'ci_cpt_videos_url', true);
					$video_type = get_post_meta($post->ID, 'ci_cpt_videos_self', true);
				?>
				<li class="<?php echo ci_column_classes(ci_setting('archive_tpl'), 12); ?> columns">
					<div class="media-block widget-content">
						<a href="<?php echo ($video_type == 1 ? "#player".$i."-wrap" : esc_url($video_url)); ?>" data-rel="pp_video">
							<span class="media-act"></span>
							<?php the_post_thumbnail('ci_video_thumb'); ?>
						</a>
						<div class="album-info">
							<h4 class="pair-title"><?php the_title(); ?></h4>
							<?php if ($post->post_content != ""): ?><a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','ci_theme'); ?></a><?php endif; ?>
						</div>
						<?php if ($video_type == 1): ?>
							<div id="player<?php echo $i; ?>-wrap" class="video-player hidden">
								<video width="480" height="360" src="<?php echo esc_url($video_url); ?>" controls="controls" preload="none"></video>
							</div><!-- /player-wrap -->
						<?php endif; ?>
					</div><!-- widget-content -->
				</li>
			<?php $i++; endwhile; endif; ?>

		</ol><!-- /discography -->
		<?php ci_pagination(); ?>
	</div><!-- /twelve columns -->
</div><!-- /row -->

<?php get_footer(); ?>
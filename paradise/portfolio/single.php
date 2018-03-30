<?php
	get_header();
	if ( have_posts() ): the_post();
	get_template_part('part', 'title');
?>
	<!-- Start Content Wrapper -->
	<div id="content_wrapper">
		<div class="box">
			<!-- Portfolio Full Box -->
			<div id="portfolio_single">
<?php
	do {
//		$target_link = get_post_meta(get_the_ID(), 'target_link', true);
		$video_link = get_post_meta(get_the_ID(), 'video_link', true);
		$image_id = get_post_thumbnail_id();
		$full_thumbnail = wp_get_attachment_image_src($image_id, 'full');
?>
				<!-- Start Post -->

					<div class="portfolio_item">
						<a href="<?php if (!empty($video_link)) echo $video_link; else echo $full_thumbnail[0]; ?>" rel="prettyPhoto[gallery2]" class="gall">
						<?php if (has_post_thumbnail()): ?>
							<?php the_post_thumbnail('portfolio_single', array('title' => false)); ?>
						<?php else: ?>
							<img src="<?php echo get_bloginfo('template_url'); ?>/timthumb.php?src=<?php echo get_bloginfo('template_url')."/images/no_image.gif&w=510&h=250"; ?>" title="" alt="" />
						<?php endif; ?>

							<?php if (!empty($video_link)): ?>
							<span class="hover_vid"></span><!-- Thumbnail for hover effect -->
							<?php else: ?>
							<span class="hover_img"></span><!-- Thumbnail for hover effect -->
							<?php endif; ?>
						</a>
						<?php if (get_option('portfolio_show_comments')): ?>
						<div class="commentbox"><a href="<?php echo get_comments_link(); ?>" title="<?php comments_number(); ?>"><?php comments_number('0', '1', '%'); ?></a></div>
						<?php endif; ?>
						<?php
							$target_link = metaboxesGenerator::the_superlink('target_link');
							$taget_text = get_option('portfolio_target_text');
							if (!empty($target_link)):
						?>
						<p><a href="<?php echo $target_link; ?>" title="<?php echo $taget_text; ?>" class="btn" target="_blank"><?php echo $taget_text; ?></a></p>
						<?php endif; ?>
						<div class="clear"></div>
						<div class="proj_description">
							<?php if (get_option('portfolio_show_date')): ?>
							<p><strong><?php _e('Release Date:', TEMPLATENAME); ?></strong> <?php echo get_the_date('m/d/Y'); ?></p>
							<?php endif; ?>
							<?php if (get_option('portfolio_show_clients')): ?>
							<p><?php echo get_the_term_list( $post->ID, 'clients', '<strong>Client(s):</strong> ', ', ', '' ); ?></p>
							<?php endif; ?>
							<?php if (get_option('portfolio_show_division')): ?>
							<p><?php echo get_the_term_list( $post->ID, 'divisions', '<strong>Division(s):</strong> ', ', ', '' ); ?></p>
							<?php endif; ?>
						</div>
								<?php
							if (get_option('portfolio_show_comments'))
								comments_template();
						?>
					</div>
					<div class="portfolio_description">
						<h2><?php _e('Project Description:', TEMPLATENAME); ?></h2>
						<div class="clear"></div>
						<?php the_content(); ?>
					</div>
						  <div class="clear"></div>

<?php
		if (!have_posts())
			break;
		the_post();
	} while (1);
?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!-- End Content Wrapper -->
<?php
	endif;
	get_footer();
 ?>
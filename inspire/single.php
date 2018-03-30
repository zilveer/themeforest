<?php get_header(); ?>

		<?php 
			//get user like string from cookie for use in later check
			$like_string = mb_cookie_get_key_value ("inspire_cookie", "likes");
			$likes = get_post_meta(get_the_ID(), 'inspire_likes', true);
			if (empty($likes)) $likes = 0;

			$inspire_options_post = get_option('inspire_options_post');

			$layout = $inspire_options_post['post_style'];		//single, full, full_sidebar

			switch ($layout) {
				case "single":
					$featured_img_width = 650;
					break;
				case "full":
					$featured_img_width = 990;
					break;
				case "full_sidebar":
					$featured_img_width = 990;
					break;
				default:
					$featured_img_width = 650;
					break;
			}
			$post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
			if ($post_thumbnail_src[1] < $featured_img_width) $featured_img_width = $post_thumbnail_src[1];

			//get attachments
			 $args = array(
			   'post_type' => 'attachment',
			   'numberposts' => -1,
			   'post_status' => null,
			   'post_parent' => $post->ID
			  );

			  $project_attachments = get_posts( $args );
			  //var_dump($project_attachments);

		?>

		<!-- FEATURED IMAGE FOR FULL_SIDEBAR-->
		<?php
			if (has_post_thumbnail(get_the_ID()) && $layout == "full_sidebar" && isset($inspire_options_post['show_featured'])) { 
			?>
				<div class='post-img full'>
					<div class='flexslider flexslider_single'>
						<ul class="slides">
							<?php printf("<li><a href='%s'><img width='%d' src='%s'></a></li>", esc_url($post_thumbnail_src[0]), esc_attr($featured_img_width), esc_url($post_thumbnail_src[0])); ?>

							<?php 
								for ($i = 0; $i < count($project_attachments); $i++) {
									if (get_post_thumbnail_id(get_the_ID()) != $project_attachments[$i]->ID) {
										$attachment_src = wp_get_attachment_image_src($project_attachments[$i]->ID, 'full');
										printf("<li><a href='%s'><img width='%d' src='%s'></a></li>", esc_url($attachment_src[0]), esc_attr($featured_img_width), esc_url($attachment_src[0]));
									}
								}

							?>
						</ul>
					</div>
				</div>
			<?php
			}
		?>

		<div id="content" class="<?php echo $layout; ?>">


			<!-- BEGIN LOOP -->
			<?php while ( have_posts() ) : the_post(); ?>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class($layout); ?> data-post_ID="<?php the_ID(); ?>" data-nonce="<?php echo wp_create_nonce('like_post'); ?>">


					<!-- FEATURED IMAGE FOR SINGLE & FULL-->
					<?php
						if (has_post_thumbnail(get_the_ID()) && ( $layout == "single" || $layout == "full") && isset($inspire_options_post['show_featured'])) {
						?>
							<div class='post-img'>
								<div class='flexslider flexslider_single'>
									<ul class="slides">
										<?php printf("<li><a href='%s'><img width='%d' src='%s'></a></li>", esc_url($post_thumbnail_src[0]), esc_attr($featured_img_width), esc_url($post_thumbnail_src[0])); ?>

										<?php 
											for ($i = 0; $i < count($project_attachments); $i++) {
												if (get_post_thumbnail_id(get_the_ID()) != $project_attachments[$i]->ID) {
													$attachment_src = wp_get_attachment_image_src($project_attachments[$i]->ID, 'full');
													printf("<li><a href='%s'><img width='%d' src='%s'></a></li>", esc_url($attachment_src[0]), esc_attr($featured_img_width), esc_url($attachment_src[0]));
												}
											}

										?>
									</ul>
								</div>
							</div>
						<?php
						}
					?>


					<!-- TITLE AND META -->
					<div class="post-title">
						
						<h1><?php the_title(); ?></h1>
						<span class="heart<?php if (mb_is_value_in_delim_string($like_string,get_the_ID(),",")) echo " liked"; ?>"><?php echo $likes; ?></span>
						<span class="meta"><?php _e('Posted by', 'loc_inspire'); ?> <?php the_author_posts_link(); ?> - <?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?> - <?php the_category(', ') ?></span>
						
					</div>
					
					<!-- MAIN CONTENT AND TAGS -->
					<div class="post-entry">

						<?php the_content(); ?>
						
						<?php wp_link_pages(); ?>
						
						<div class="clearfix"></div>
						
						<div class="tags">
							<?php the_tags("",""); ?>
						</div>
						
					</div>
					
					<!-- POST PAGINATION -->
					<?php if (isset($inspire_options_post ['show_pagination'])) get_template_part('inc/templates/template_post_pagination'); ?>

					<!-- SHARE THE LOVE -->
					<?php if (isset($inspire_options_post ['show_share'])) get_template_part('inc/templates/template_post_share'); ?>

					<!-- COMMENTS -->
					<?php if (isset($inspire_options_post ['show_comments'])) comments_template( '', true ); ?>

						
				</div>
				<!-- class: post -->

			<?php endwhile; ?>
			<!-- END LOOP -->
			
		</div> <!-- id:content -->

<?php if ($layout == "single" || $layout == "full_sidebar") get_sidebar(); ?>
			
<?php get_footer(); ?>
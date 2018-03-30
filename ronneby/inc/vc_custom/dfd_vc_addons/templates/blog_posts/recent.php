<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$uniqid = uniqid('dfd-blog-module-');
?>
<div class="dfd-blog-loop dfd-blog-posts-module <?php echo esc_attr($el_class) ?>" id="<?php echo esc_attr($uniqid) ?>">
	<div class="dfd-blog-wrap">
		
		<div class="dfd-blog <?php echo esc_attr($anim_class) ?>" <?php echo $data_atts ?>>
		<?php
			$i = 0;
			while ($wp_query->have_posts()) : $wp_query->the_post();
				$i++;

				$permalink = get_permalink();

				$post_class = 'post';
				
				if($i == 1) {
					$post_class .= ' dfd-title-'.$heading_position;

					$excerpt = '';

					if($enable_excerpt) {
						$excerpt = get_the_excerpt();

						if(!empty($excerpt))
							$excerpt = '<div class="entry-content"><p>'.$excerpt.'</p></div>';
					}
					?>
					<div class="<?php echo esc_attr($post_class) ?>">
						<div class="cover">
							<?php
							if($heading_position == 'top')
								include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/heading.php'));

							?>
							<div class="entry-media <?php echo esc_attr($media_class) ?>">
							<?php
								$caption = get_the_title();
								if (has_post_thumbnail()) {

									$thumb = get_post_thumbnail_id();
									$img_src = wp_get_attachment_image_src($thumb, 'full');
									$img_url = (isset($img_src[0]) && !empty($img_src[0])) ? $img_src[0] : get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
									$meta = wp_get_attachment_metadata($thumb);
									if(isset($meta['image_meta']['caption']) && $meta['image_meta']['caption'] != '') {
										$caption = $meta['image_meta']['caption'];
									} else if(isset($meta['image_meta']['title']) && $meta['image_meta']['title'] != '') {
										$caption = $meta['image_meta']['title'];
									}

								} else {
									$img_url = get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
								}
								?>
								<div class="entry-thumb">
									<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($caption); ?>"/>
									<?php include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/comments_likes.php')); ?>
								</div>
							</div>

							<?php
							if($heading_position == 'bottom')
								include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/heading.php'));
							?>

							<?php echo $excerpt; ?>

							<?php if($read_more || $share) : ?>
								<div class="dfd-read-share clearfix">
									<?php if($read_more) : ?>
										<div class="read-more-wrap">
											<a href="<?php echo esc_url($permalink) ?>" class="more-button <?php echo esc_attr($read_more_style) ?>" title="<?php __('Read more','dfd') ?>" data-lang="en"><?php _e('More', 'dfd'); ?></a>
										</div>
									<?php endif; ?>
									<?php if($share) : ?>
										<div class="dfd-share-cover dfd-share-<?php echo esc_attr($share_style);  ?>">
											<?php get_template_part('templates/entry-meta/mini','share-blog') ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php
				} else {
					?>
					<div class="<?php echo esc_attr($post_class) ?> dfd-additional-post">
						<div class="cover">
							<?php
							$caption = get_the_title();
							if (has_post_thumbnail()) {

								$thumb = get_post_thumbnail_id();
								$img_src = wp_get_attachment_image_src($thumb, array(150,150));
								$img_url = (isset($img_src[0]) && !empty($img_src[0])) ? $img_src[0] : get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
								$meta = wp_get_attachment_metadata($thumb);
								if(isset($meta['image_meta']['caption']) && $meta['image_meta']['caption'] != '') {
									$caption = $meta['image_meta']['caption'];
								} else if(isset($meta['image_meta']['title']) && $meta['image_meta']['title'] != '') {
									$caption = $meta['image_meta']['title'];
								}

							} else {
								$img_url = get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
							}
							?>
							<div class="entry-thumb">
								<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($caption); ?>"/>
							</div>
							<?php include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/additional-heading.php')); ?>
						</div>
					</div>
					<?php
				}
				?>
			<?php
			endwhile;
		wp_reset_postdata();
		?>
		</div>
	</div>
</div>

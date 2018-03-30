<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="dfd-blog-loop dfd-blog-posts-module <?php echo esc_attr($el_class) ?>" <?php echo $data_atts ?>>
	<div class="dfd-blog-wrap">

<?php
		while ($wp_query->have_posts()) : $wp_query->the_post();

			$permalink = get_permalink();

			$excerpt = get_the_excerpt();

			if(!empty($excerpt))
				$excerpt = '<div class="entry-content"><p>'.$excerpt.'</p></div>';

			$post_class = get_post_class();

			$post_class = implode(' ', $post_class);
			
			$post_class .= ' '.$content_effect;
			
			$enable_title = $enable_meta = true;
			
			?>
			<div class="<?php echo esc_attr($post_class) ?>">
				<div class="cover">
					<?php
					/*
					if(isset($content_config) && !empty($content_config)) {
						$columns = explode('|', $content_config);	
					} else {
						$columns = array('four','eight');
					}
					*/
					if (has_post_thumbnail()) {

						$thumb = get_post_thumbnail_id();
						$img_src = wp_get_attachment_image_src($thumb, array(150,150));
						if(isset($img_src[0]) && !empty($img_src[0])) {
							$img_url = $img_src[0];
						}
						
					} else {
						$img_url = get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
					}
					?>

					<div class="clearfix">
						<div class="entry-thumb">
							<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title(); ?>"/>
							<?php //include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/comments_likes.php')); ?>
						</div>
						<div class="content-wrap">
							<?php
							include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/heading.php'));

							echo $excerpt;
							?>
						</div>
					</div>
					<?php if($share) : ?>
						<div class="dfd-share-cover dfd-share-<?php echo esc_attr($share_style);  ?>">
							<?php get_template_part('templates/entry-meta/mini','share-blog') ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php
		endwhile;
	wp_reset_postdata();
	?>
	</div>
</div>
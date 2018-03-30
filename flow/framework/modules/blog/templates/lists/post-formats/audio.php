<?php 

$post_image_size = 'full';

$title_tag = 'h3';
if($blog_type == 'masonry' || $blog_type == 'masonry-full-width'){
	if(isset($image_size)){
		$post_image_size = $image_size;
	}
	$title_tag = 'h4';
}

$params['title_tag'] = $title_tag;

$image_params = array(
	'image_size' => $post_image_size
);

?>


<article id="post-<?php the_ID(); ?>" <?php post_class($featured_class); ?>>
	<div class="eltd-post-content">
		<?php if($featured_class != ''){ ?>
			<div class="eltd-featured-triangle-holder">
				<div class="eltd-featured-triangle"></div>
				<span class="icon_star_alt"></span>
			</div>	
		<?php } ?>
		<?php

		if ( get_post_meta(get_the_ID(), "eltd_post_soundcloud_link_meta", true) !== "" ) {
			flow_elated_get_module_template_part('templates/parts/soundcloud', 'blog');
		} else {
			flow_elated_get_module_template_part('templates/lists/parts/image', 'blog','', $image_params);
			flow_elated_get_module_template_part('templates/parts/audio', 'blog');
			?>
			<div class="eltd-post-text">
				<div class="eltd-post-text-inner">
					<div class="eltd-post-info eltd-category">
						<?php flow_elated_post_info(array(
							'category' => 'yes'
						))?>
					</div>
					<?php flow_elated_get_module_template_part('templates/lists/parts/title', 'blog', '', $params); ?>
					<?php
					flow_elated_excerpt($excerpt_length);
					$args_pages = array(
						'before'           => '<div class="eltd-single-links-pages"><div class="eltd-single-links-pages-inner">',
						'after'            => '</div></div>',
						'link_before'      => '<span>',
						'link_after'       => '</span>',
						'pagelink'         => '%'
					);

					wp_link_pages($args_pages);
					flow_elated_read_more_button();
					?>
					<div class ="eltd-post-info-wrapper">
						<div class="eltd-post-info eltd-left-section">
							<?php flow_elated_post_info(array(
								'date' => 'yes',
								'comments' => 'yes',
								'like' => 'yes'
							))
							?>
						</div>
						<div class ="eltd-post-info eltd-right-section">
							<?php flow_elated_post_info(array(
								'share' => 'yes'
							))
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</article>
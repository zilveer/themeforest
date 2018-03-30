<?php 

$image_params = array(
	'image_size' => 'flow_elated_split_column_landscape'
);

$style_attr = flow_elated_get_post_back_image();

$params = array(
	'title_tag' => 'h4'
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
		
		<div class="eltd-left-section" <?php echo flow_elated_get_inline_style($style_attr)?>>
			<?php 					
				flow_elated_get_module_template_part('templates/lists/parts/image', 'blog','', $image_params);
			?>
		</div>
		
		<div class="eltd-right-section">
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
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
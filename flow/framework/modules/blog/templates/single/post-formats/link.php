<article id="post-<?php the_ID(); ?>" <?php post_class($featured_class); ?>>
	<div class="eltd-post-content" style="background-image: url(' <?php echo flow_elated_kses_img($image[0]); ?> ')">
		<?php if($featured_class != ''){ ?>
			<div class="eltd-featured-triangle-holder">
				<div class="eltd-featured-triangle"></div>
				<span class="icon_star_alt"></span>
			</div>
		<?php } ?>
		<div class="eltd-post-text">
			<div class="eltd-post-text-inner">
				<div class="eltd-link-icon">
					<i class="icon_link"></i>
				</div>
				<?php flow_elated_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<div class="eltd-post-info-author">
					<?php flow_elated_post_info(array(
						'author' => 'yes',
					));
					?>
				</div>
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
	</div>
	<div class="eltd-link-text-holder">
		<?php the_content(); ?>
	</div>
</article>
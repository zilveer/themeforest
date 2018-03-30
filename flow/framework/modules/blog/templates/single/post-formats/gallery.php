<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="eltd-post-content">
		<?php flow_elated_get_module_template_part('templates/single/parts/gallery', 'blog'); ?>
		<div class="eltd-post-text">
			<div class="eltd-post-text-inner clearfix">
				<div class="eltd-post-info eltd-category">
					<?php flow_elated_post_info(array(
						'category' => 'yes'
					))?>
				</div>
				<?php flow_elated_get_module_template_part('templates/single/parts/title', 'blog'); ?>
				<div class="eltd-text-holder">
					<?php the_content(); ?>
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
	<?php do_action('flow_elated_before_blog_article_closed_tag'); ?>
</article>
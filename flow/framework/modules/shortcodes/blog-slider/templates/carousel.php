<div class="eltd-blog-carousel-item">
	<div class="eltd-blog-carousel-item-inner">
		<?php the_post_thumbnail('flow_elated_landscape'); ?>
		<div class="eltd-blog-carousel-post-info">
			<div class="eltd-blog-carousel-categories">
				<?php the_category(', '); ?>
			</div>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_title('<h4 class="eltd-blog-slide-title">', '</h4>'); ?>
			</a>
			<?php
			flow_elated_post_info(array(
				'date' => 'yes'
			));
			echo flow_elated_get_button_html(array(
				'text' => esc_html__("Read More", "flow"),
				'link' => get_the_permalink(),
				'custom_class' => 'eltd-btn-green'
			));
			?>
		</div>
	</div>
</div>
<?php get_header(); ?>
	<div class="category-title-container">
		<h2 class="category-title"><?php _e( '(404)' , 'ocmx' ); ?></h2>
		<p><?php _e("The page you are looking for does not exist.", "ocmx"); ?></p>
	</div>

	<?php $wpquery = new WP_Query( array('post_type' => 'post') ); ?>
	<ul class="post-list opacity_zero">
		<?php if ($wpquery->have_posts()) :
			while ($wpquery->have_posts()) :
				$wpquery->the_post(); setup_postdata($post);
				get_template_part("/functions/post-list");
			endwhile;
		else :
			get_template_part("/functions/post-empty");
		endif; ?>
	</ul>
	<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>

<?php get_footer(); ?>
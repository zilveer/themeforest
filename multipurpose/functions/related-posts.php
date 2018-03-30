<?php
function related_projects($project) {
	$cats = array();
	$skills = array();

	$c = wp_get_object_terms($project->ID, 'project-categories');
	foreach($c as $k => $v) {
		$cats[] = $v->term_id;
	}

	$s = wp_get_object_terms($project->ID, 'project-categories');
	foreach($s as $k => $v) {
		$skills[] = $v->term_id;
	}

	$options = array(
		'post_type' => 'project',
		'post_status' => 'publish',
		'tax_query' => array(
		'relation' => 'OR',
			array(
				'taxonomy' => 'project-categories',
				'field' => 'id',
				'terms' => $cats,
				'include_children' => false
			),
			array(
				'taxonomy' => 'project-skills',
				'field' => 'id',
				'terms' => $skills,
				'include_children' => false
			)
		),
		'posts_per_page' => -1,
		'post__not_in' => array($project->ID)
	);
	$related = new WP_Query($options);
	if ($related->have_posts()) : ?>
		<section class="columns content-slider">
			<nav class="controls"><a href="#" class="prev">previous</a><a href="#" class="next">next</a></nav>
			<h2 class="underline"><span><?php esc_attr_e('Related projects', 'multipurpose'); ?></span></h2>
				<div class="slider-box projects-slider">
					<?php while($related->have_posts()) : $related->the_post();
					$post = get_post(get_the_id());
					?><article>
					<?php if(has_post_thumbnail()) : 
					$th_file = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'large');
					?>
					<div class="img"><?php the_post_thumbnail('project-thumbnail-related', array()); ?>
						<div class="actions">
							<ul>
								<?php 
								$project_image_link_hidden = get_post_meta(get_the_id(), 'project_image_link_hidden', true);
								if (!$project_image_link_hidden) : ?>
								<li><a href="<?php echo $th_file[0]; ?>" class="action view"><?php esc_attr_e('View', 'multipurpose'); ?></a></li>
								<?php endif; ?>
								<li><a href="<?php the_permalink(); ?>" class="action go"><?php esc_attr_e('See details', 'multipurpose'); ?></a></li>
							</ul>
						</div>
					</div>
					<?php endif; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php  if(!has_post_thumbnail()): ?>
						<p><?php echo multipurpose_custom_excerpt(15, $post); ?></p>
					<?php endif; ?>
				</article><?php endwhile; ?>
			</div>
		</section>
	<?php endif;
	 wp_reset_postdata();
}

function related_posts($post) {
	$cids = wp_get_post_categories($post->ID);

	$options = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'category__in' => $cids,
		'posts_per_page' => -1,
		'post__not_in' => array($post->ID)
	);
	$related = new WP_Query($options);
	if ($related->have_posts()) : ?>
		<section class="columns content-slider">
			<nav class="controls"><a href="#" class="prev"><?php esc_attr_e('previous', 'multipurpose');?></a><a href="#" class="next"><?php esc_attr_e('next', 'multipurpose');?></a></nav>
			<h2 class="underline"><span><?php esc_attr_e('Related posts', 'multipurpose'); ?></span></h2>
				<div class="slider-box">
					<?php while($related->have_posts()) : $related->the_post(); 
					?><article>
					<?php if(has_post_thumbnail()) : ?>
					<div class="img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail-related', array()); ?></a></div>
					<?php endif; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php 
					if(!has_post_thumbnail()) echo multipurpose_custom_excerpt(15, $post); ?>
				</article><?php endwhile; ?>
			</div>
		</section>
	<?php endif;
	 wp_reset_postdata();
}
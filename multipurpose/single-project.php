<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php 
		if (has_post_thumbnail()) {
			$feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'project-thumbnail-large');
			$feat_img = $feat_img[0];
		}
		$project_url = get_post_meta($post->ID, 'project_meta_url', true);
		$project_copyright = get_post_meta($post->ID, 'project_meta_copyright', true);
		$project_video = get_post_meta($post->ID, 'project_meta_video', true);
		
		$cats = wp_get_post_terms($post->ID, 'project-categories', array());
		$cat_list = array();
		foreach($cats as $c) {
			$cat_list[] = esc_attr($c->name);
		}
		$cat_list = implode(", ", $cat_list);

		$skill_list = array();
		$skills = wp_get_post_terms($post->ID, 'project-skills', array());
		foreach($skills as $s) {
			$skill_list[] = esc_attr($s->name);
		}
		$skill_list = implode(", ", $skill_list);
	?>

	<h1><?php the_title(); ?></h1>
	<?php

	$project_layout_global = get_theme_mod('project_layout');
	$project_layout_local = get_post_meta($post->ID, 'project_meta_layout', true);

	if($project_layout_global == 'project_decide') $project_layout = $project_layout_local;
	else $project_layout = $project_layout_global;

	if ($project_layout == 'full') :
	?>
	<article class="project wide">
		<?php if($project_video): ?>
			<div class="video"><?php echo $project_video; ?></div>
		<?php else :
			if(has_post_thumbnail()) : ?>
			<p><img src="<?php echo $feat_img; ?>" alt="<?php the_title(); ?>"></p>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($project_url || $project_copyright) : ?>
			<p class="copyright">
				<?php if($project_url): ?><a href="<?php echo esc_url($project_url); ?>"><?php esc_attr_e('View project', 'multipurpose'); ?></a><br><?php endif; ?>
				<?php if($project_copyright): ?>&copy; <?php echo esc_attr($project_copyright) ?><?php endif; ?>
			</p>
		<?php endif; ?>

		<div class="descr">
			<?php the_content(); ?>
		</div>
		<dl>
			<dt><?php esc_attr_e('Skills needed', 'multipurpose'); ?>:</dt>
			<dd><?php echo $skill_list; ?></dd>
			<dt><?php esc_attr_e('Categories', 'multipurpose'); ?>:</dt>
			<dd><?php echo $cat_list; ?></dd>
		</dl>
	</article>
	
	<?php else: ?>

	<article class="project">
		<div class="img">
			<?php 
			if($project_video):
				echo $project_video; 
			else :
				if(has_post_thumbnail()) : ?>
					<img src="<?php echo $feat_img; ?>" alt="<?php the_title(); ?>">
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="descr">
			<?php if ($project_url || $project_copyright) : ?>
			<p class="copyright">
				<?php if($project_url): ?><a href="<?php echo esc_url($project_url); ?>"><?php esc_attr_e('View project', 'multipurpose'); ?></a><br><?php endif; ?>
				<?php if($project_copyright): ?>&copy; <?php echo esc_attr($project_copyright) ?><?php endif; ?></p>
			<?php endif; ?>

			<?php the_content(); ?>
			<dl>
				<dt><?php esc_attr_e('Skills needed', 'multipurpose'); ?>:</dt>
				<dd><?php echo $skill_list; ?></dd>
				<dt><?php esc_attr_e('Categories', 'multipurpose'); ?>:</dt>
				<dd><?php echo $cat_list; ?></dd>
			</dl>
		</div>
	</article>
	<?php endif; ?>

	<nav class="project-nav">
		<span class="prev"><?php next_post_link('%link');?></span>
		<span class="next"><?php previous_post_link('%link');?></span>
	</nav>

	<?php related_projects($post) ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>

		
		
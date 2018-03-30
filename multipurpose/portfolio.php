<?php
/*
* Template name: Portfolio
*/
get_header(); 
?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article class="page">
			<?php 
			$hide_title = get_post_meta(get_the_id(), 'hide_title', true);
			if(!$hide_title) : ?>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
			<?php the_content(); ?>
		</article>
	<?php endwhile; endif; ?>

	<?php
	$portfolio_layout = get_theme_mod('portfolio_layout'); 
	switch($portfolio_layout) {
		case 5:
			$ppp = get_theme_mod('projects_per_page_masonry') ? get_theme_mod('projects_per_page_masonry') : 12;
			$item_col_class = 'brick';
			$item_list_class = 'masonry m4';
			break;
		case 4: 
			$ppp = get_theme_mod('projects_per_page4') ? get_theme_mod('projects_per_page4') : 12;
			$item_col_class = 'col4';
			$item_list_class = 'columns';
			break;
		case 3: 
			$ppp = get_theme_mod('projects_per_page3') ? get_theme_mod('projects_per_page3') : 9;
			$item_col_class = 'col3';
			$item_list_class = 'columns';
			break;
		case 2:
			$ppp = get_theme_mod('projects_per_page2') ? get_theme_mod('projects_per_page2') : 10;
			$item_col_class = 'col2';
			$item_list_class = 'columns';
			break;
		case 1: 
			$ppp = get_theme_mod('projects_per_page1') ? get_theme_mod('projects_per_page1') : 5;
			$item_col_class = 'col1';
			$item_list_class = 'columns';
			break;
		default: 
			$ppp = 10;
			$item_col_class = 'col1';
			$item_list_class = 'columns';
			break;
	}
	?>
	<section class="<?php echo $item_list_class ?> portfolio">
		<?php
		$options = array('hierarchical' => false);
		$categories = get_terms('project-categories', $options);
		if (count($categories)) :
		?>
		<div class="filters">
			<p><?php esc_attr_e('Show', 'multipurpose'); ?>:</p>
			<ul>
				<li><a href="#all"><?php esc_attr_e('All', 'multipurpose'); ?></a></li>
				<?php foreach ($categories as $cat) : ?>
				<li><a href="#<?php echo esc_attr($cat->slug); ?>"><?php echo esc_attr($cat->name); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<?php 
			$args = array(
				'post_type' => 'project',
				'post_status' => 'publish',
				'posts_per_page' => $ppp,
				'paged' => get_query_var('paged')
			);
			$projects_query = new WP_Query($args);
			if($projects_query->have_posts()) while($projects_query->have_posts()) {
				$projects_query->the_post();

				$cats = wp_get_post_terms($post->ID, 'project-categories', array());
				$category_classes = '';
				foreach($cats as $cat) {
					$category_classes .= " ".esc_attr($cat->slug);
				}
				?>

				<article class="col <?php echo $item_col_class . $category_classes; ?>">
					<?php 
					$video_code = trim(get_post_meta($post->ID, 'project_meta_video', true));
					if(has_post_thumbnail()) :
						$th_file = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
					
						if(trim($video_code) != '') : ?>
						<div class="video-code"><?php echo $video_code; ?></div>
						<?php endif; ?>
					<?php 
					if($item_col_class == 'col1') $th_size = 'project-thumbnail-medium';
					else $th_size =  'project-thumbnail';
					?>
					<div class="img"><?php the_post_thumbnail($th_size, array()); ?>
						<div>
							<ul>
								<?php 
								$project_image_link_hidden = get_post_meta($post->ID, 'project_image_link_hidden', true);
								if (!$project_image_link_hidden) : ?>
								<li><a href="<?php echo $th_file[0]; ?>" class="action view"><?php esc_attr_e('View', 'multipurpose'); ?></a></li>
								<?php endif; ?>
								<li><a href="<?php the_permalink(); ?>" class="action go"><?php esc_attr_e('See details', 'multipurpose'); ?></a></li>
							</ul>
						</div>
					</div><?php endif; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php echo multipurpose_custom_excerpt(20, $post); ?></p>
				</article>
				<?php
			}
		?>
	</section>
	<div class='wp-pagenavi'>
		<?php echo paginate_links(array(
			'base' => get_pagenum_link(1) . '%_%',  
        	'format' => 'page/%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $projects_query->max_num_pages,
			'prev_text' => esc_attr__('Previous page', 'multipurpose'),
			'next_text' => esc_attr__('Next page', 'multipurpose'),
		)); ?> 
	</div>
<?php get_footer(); ?>
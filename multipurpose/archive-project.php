<?php get_header(); ?>
<?php if (have_posts()) : ?>
<article class="page">
	<h1><?php esc_attr_e( 'Project Archive', 'multipurpose' ); ?></h1>
</article>

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

<section class="columns portfolio">
	

	<?php 
		$portfolio_layout = get_theme_mod('portfolio_layout'); 
		switch($portfolio_layout) {
			case 4: 
				$item_col_class = 'col4';
				break;
			case 3: 
				$item_col_class = 'col3';
				break;
			case 2:
				$item_col_class = 'col2';
				break;
			case 1: 
				$item_col_class = 'col1';
				break;
			default: 
				$item_col_class = 'col1';
				break;
		}

		while(have_posts()) : the_post();

			$cats = wp_get_post_terms($post->ID, 'project-categories', array());
			$category_classes = '';
			foreach($cats as $cat) {
				$category_classes .= " ".esc_attr($cat->slug);
			}
			?><article class="col <?php echo $item_col_class . $category_classes; ?>">
					<?php 
					$video_code = trim(get_post_meta($post->ID, 'project_meta_video', true));
					if(has_post_thumbnail()) :
						$th_file = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
					
					if(trim($video_code) != '') : ?>
						<div class="video-code"><?php echo $video_code; ?></div>
					<?php endif; ?>
					<div class="img"><?php the_post_thumbnail('project-thumbnail-medium'); ?>
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
				</article><?php
		endwhile;
	?>
</section>
<?php endif; ?>
<div class='wp-pagenavi'>
	<?php 
	global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),  
    	'format' => '/page/%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'prev_text' => esc_attr__('Previous page', 'multipurpose'),
		'next_text' => esc_attr__('Next page', 'multipurpose'),
	));
	 ?> 
</div>
<?php get_footer(); ?>
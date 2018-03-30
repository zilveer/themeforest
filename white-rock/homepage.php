<?php
// Template Name: HomePage
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
	
	<!-- The featured slider is called from the header.php located in the slider-progression.php file -->
	
	<div id="main" class="site-main">
		<div class="width-container">

	<?php if(of_get_option('homepage_sidebar', '0')): ?><div id="container-sidebar"><!-- sidebar content container --><?php endif; ?>
	
	<!-- this code pull in the homepage content -->
	<?php while(have_posts()): the_post(); ?>
		<?php $cc = get_the_content(); if($cc != '') { ?>
			<div class="content-container">
				<div class="container-spacing">		
				<?php the_content(); ?>	
				<div class="clearfix"></div>
				</div><!-- close .content-container-spacing -->
			</div><!-- close .content-container -->
		<?php } ?>
	<?php endwhile; ?>
	
	
	<!-- Homepage Child Pages Start -->
	<?php
	$args = array(
		'post_type' => 'page',
		'numberposts' => -1,
		'post' => null,
		'post_parent' => $post->ID,
	    'order' => 'ASC',
	    'orderby' => 'menu_order'
	);
	$features = get_posts($args);
	$features_count = count($features);
	if($features):
		$count = 1;
		foreach($features as $post): setup_postdata($post);
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id, 'large');
			if($count >= of_get_option('child_pages_column', '3')+1) { $count = 1; }
	?>
		
		<div class="grid<?php echo of_get_option('child_pages_column', '3'); ?>column <?php if($count == of_get_option('child_pages_column', '3')): ?>lastcolumn<?php endif; ?>">
			<h3><?php the_title(); ?></h3>
			<?php if($image_url[0]): ?><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>" class="aligncenter">
			<?php endif; ?>
			<?php the_content(); ?>
		</div>
	<?php if($count == of_get_option('child_pages_column', '3')): ?><div class="homepage-feature-box"></div><div class="clearfix"></div><?php endif; ?>
	<?php $count ++; endforeach; ?>
	<?php endif; ?>
	<!-- Homepage Child Pages End -->
	
<div class="clearfix"></div>
<?php if(of_get_option('homepage_sidebar', '0')): ?></div><!-- close #container-sidebar -->
<?php get_sidebar(); ?><?php endif; ?>
<?php get_footer(); ?>
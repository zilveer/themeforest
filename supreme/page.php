<?php get_header(); ?>
	
<?php
	$options = get_option('sf_supreme_options');
	$page_layout = $options['page_layout'];
	if (isset($_GET['layout'])) {
		$page_layout = $_GET['layout'];
	}

	$show_page_title = get_post_meta($post->ID, 'sf_page_title', true);
	$top_spacing = get_post_meta($post->ID, 'sf_top_spacing', true);
	$spacing = "";
	if ($top_spacing) {
	$spacing = "top-spacing";
	} else {
	$spacing = "";
	}
	$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = strtolower(get_post_meta($post->ID, 'sf_left_sidebar', true));
	$right_sidebar = strtolower(get_post_meta($post->ID, 'sf_right_sidebar', true));
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar';
	} elseif ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar';
	} elseif ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
?>

<?php if ($show_page_title) { ?>	

	<div class="page-heading clearfix">
	
		<h1><?php the_title(); ?></h1>
		
		<?php if(function_exists('bcn_display')) { ?>	
		<div class="breadcrumbs-wrap">
			<div id="breadcrumbs">
				<?php bcn_display(); ?>
			</div>
		</div>
		<?php } ?>
		
		<div class="heading-divider"></div>
		
	</div>
<?php } ?>

<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		
	<?php if (have_posts()) : the_post(); ?>

	<!-- OPEN article -->
	<?php if ($sidebar_config == "left-sidebar") { ?>
	<div <?php post_class('clearfix two-thirds column omega '. $spacing); ?> id="<?php the_ID(); ?>">
	<?php } elseif ($sidebar_config == "right-sidebar") { ?>
	<div <?php post_class('clearfix two-thirds column alpha '. $spacing); ?> id="<?php the_ID(); ?>">
	<?php } else { ?>
	<div <?php post_class('clearfix '. $spacing); ?> id="<?php the_ID(); ?>">
	<?php } ?>
	
		<?php if ($sidebar_config == "both-sidebars") { ?>
			
			<section class="page-content eight columns omega clearfix">
			
				<?php the_content(); ?>
				
			</section>
				
			<aside class="sidebar left-sidebar four columns alpha">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
		
		<?php } else { ?>
		
		<section class="page-content clearfix">

			<?php the_content(); ?>
			
		</section>
		
		<?php } ?>	
	
	<!-- CLOSE article -->
	</div>

	<?php endif; ?>
	
	<?php if ($sidebar_config == "left-sidebar") { ?>
		
		<aside class="sidebar left-sidebar one-third column alpha">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>

	<?php } else if ($sidebar_config == "right-sidebar") { ?>
		
		<aside class="sidebar right-sidebar one-third column omega">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
		
	<?php } else if ($sidebar_config == "both-sidebars") { ?>
		
		<aside class="sidebar right-sidebar four columns omega">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
	
	<?php } ?>

</div>

<!-- WordPress Hook -->
<?php get_footer(); ?>
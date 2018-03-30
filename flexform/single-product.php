<?php	
	$options = get_option('sf_flexform_options');
	$default_show_page_heading = $options['default_show_page_heading'];
	$default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
	$default_sidebar_config = $options['default_product_sidebar_config'];
	$default_left_sidebar = strtolower($options['default_product_left_sidebar']);
	$default_right_sidebar = strtolower($options['default_product_right_sidebar']);
	
	$show_page_title = get_post_meta($post->ID, 'sf_page_title', true);
	$page_title_one = get_post_meta($post->ID, 'sf_page_title_one', true);
	$page_title_two = get_post_meta($post->ID, 'sf_page_title_two', true);
	$page_title_bg = get_post_meta($post->ID, 'sf_page_title_bg', true);
	
	if ($show_page_title == "") {
		$show_page_title = $default_show_page_heading;
	}
	if ($page_title_bg == "") {
		$page_title_bg = $default_page_heading_bg_alt;
	}
	
	$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = strtolower(get_post_meta($post->ID, 'sf_left_sidebar', true));
	$right_sidebar = strtolower(get_post_meta($post->ID, 'sf_right_sidebar', true));
	
	if ($sidebar_config == "") {
		$sidebar_config = $default_sidebar_config;
	}
	if ($left_sidebar == "") {
		$left_sidebar = $default_left_sidebar;
	}
	if ($right_sidebar == "") {
		$right_sidebar = $default_right_sidebar;
	}
		
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
?>

<?php get_header('shop'); ?>

<?php if (have_posts()) : the_post(); ?>

<?php if ($show_page_title) { ?>	
	<div class="row">
		<div class="page-heading span12 clearfix alt-bg <?php echo $page_title_bg; ?>">
			<?php if ($page_title_one) { ?>
			<h1><?php echo $page_title_one; ?></h1>
			<?php } else { ?>
			<h1><?php the_title(); ?></h1>
			<?php } ?>
			<?php if ($page_title_one) { ?>
			<h3><?php echo $page_title_two; ?></h3>
			<?php } ?>
		</div>
	</div>
<?php } ?>

<?php 
	// BREADCRUMBS
	echo sf_breadcrumbs();
?>
	
<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">

	<!-- OPEN article -->
	<?php if ($sidebar_config == "left-sidebar") { ?>
	<article <?php post_class('clearfix span8'); ?> id="<?php the_ID(); ?>">
	<?php } elseif ($sidebar_config == "right-sidebar") { ?>
	<article <?php post_class('clearfix span8'); ?> id="<?php the_ID(); ?>">
	<?php } else { ?>
	<article <?php post_class('clearfix row'); ?> id="<?php the_ID(); ?>">
	<?php } ?>
	
	<?php if ($sidebar_config == "both-sidebars") { ?>
		<div class="page-content span6 clearfix">
	<?php } else if ($sidebar_config == "no-sidebars") { ?>
		<div class="page-content span12 clearfix">
	<?php } else { ?>
		<div class="page-content clearfix">
	<?php } ?>
										
			<section class="article-body-wrap">
				
				<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
					
			</section>
			
		</div>
		
		<?php if ($sidebar_config == "both-sidebars") { ?>
		<aside class="sidebar left-sidebar span3">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>
		<?php } ?>
	
	<!-- CLOSE article -->
	</article>

	<?php if ($sidebar_config == "left-sidebar") { ?>
			
		<aside class="sidebar left-sidebar span4">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>

	<?php } else if ($sidebar_config == "right-sidebar") { ?>
		
		<aside class="sidebar right-sidebar span4">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
		
	<?php } else if ($sidebar_config == "both-sidebars") { ?>

		<aside class="sidebar right-sidebar span3">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
	
	<?php } ?>
			
</div>

<?php endif; ?>

<?php get_footer('shop'); ?>
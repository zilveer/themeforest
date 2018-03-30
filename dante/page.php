<?php get_header(); ?>
	
<?php
	$options = get_option('sf_dante_options');
	
	$default_show_page_heading = $options['default_show_page_heading'];
	$default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
	$default_sidebar_config = $options['default_sidebar_config'];
	$default_left_sidebar = strtolower($options['default_left_sidebar']);
	$default_right_sidebar = strtolower($options['default_right_sidebar']);
	$sidebar_width = $options['sidebar_width'];
	
	$pb_active = sf_get_post_meta($post->ID, '_spb_js_status', true);

	$sidebar_config = sf_get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = strtolower(sf_get_post_meta($post->ID, 'sf_left_sidebar', true));
	$right_sidebar = strtolower(sf_get_post_meta($post->ID, 'sf_right_sidebar', true));
	
	if ($sidebar_config == "") {
		$sidebar_config = $default_sidebar_config;
	}
	if ($left_sidebar == "") {
		$left_sidebar = $default_left_sidebar;
	}
	if ($right_sidebar == "") {
		$right_sidebar = $default_right_sidebar;
	}
	
	sf_set_sidebar_global($sidebar_config);
	
	$page_wrap_class = $post_class_extra = $sidebar_class = '';
	if ($sidebar_config == "left-sidebar") {
		$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
		if ($sidebar_width == "reduced") {
			$post_class_extra = 'push-right col-sm-9';
			$sidebar_class = 'col-sm-3';
		} else {
			$post_class_extra = 'push-right col-sm-8';
			$sidebar_class = 'col-sm-4';
		}
	} else if ($sidebar_config == "right-sidebar") {
		$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
		if ($sidebar_width == "reduced") {
			$post_class_extra = 'col-sm-9';
			$sidebar_class = 'col-sm-3';
		} else {
			$post_class_extra = 'col-sm-8';
			$sidebar_class = 'col-sm-4';
		}
	} else if ($sidebar_config == "both-sidebars") {
		$page_wrap_class = 'has-both-sidebars row';
		$post_class_extra = 'col-sm-9';
		$sidebar_class = 'col-sm-3';
	} else {
		$page_wrap_class = 'has-no-sidebar';
	}

	$remove_bottom_spacing = sf_get_post_meta($post->ID, 'sf_no_bottom_spacing', true);
	$remove_top_spacing = sf_get_post_meta($post->ID, 'sf_no_top_spacing', true);
	
	if ($remove_bottom_spacing) {
	$page_wrap_class .= ' no-bottom-spacing';
	}
	if ($remove_top_spacing) {
	$page_wrap_class .= ' no-top-spacing';
	}
	
	$options = get_option('sf_dante_options');
	$disable_pagecomments = false;
	if (isset($options['disable_pagecomments']) && $options['disable_pagecomments'] == 1) {
	$disable_pagecomments = true;
	}
	
	
?>

<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		
	<?php if (have_posts()) : the_post(); ?>

	<!-- OPEN page -->
	<div class="clearfix <?php echo $post_class_extra; ?>" id="<?php the_ID(); ?>">
	
		<?php if ($sidebar_config == "both-sidebars") { ?>
			<div class="row">	
				<div class="page-content col-sm-8">
					<?php the_content(); ?>
					<div class="link-pages"><?php wp_link_pages(); ?></div>
					
					<?php if ( comments_open() && !$disable_pagecomments ) { ?>
					<div id="comment-area">
						<?php comments_template('', true); ?>
					</div>
					<?php } ?>
				</div>
					
				<aside class="sidebar left-sidebar col-sm-4">
					<div class="sidebar-widget-wrap sticky-widget">
                        <?php dynamic_sidebar( $left_sidebar ); ?>
                    </div>
				</aside>
			</div>
		<?php } else { ?>
			<div class="page-content clearfix">
	
				<?php the_content(); ?>
				
				<div class="link-pages"><?php wp_link_pages(); ?></div>
				
				<?php if ( comments_open() && !$disable_pagecomments ) { ?>
					<?php if ($sidebar_config == "no-sidebars" && $pb_active == "true") { ?>
					<div id="comment-area" class="container">
					<?php } else { ?>
					<div id="comment-area">
					<?php } ?>
						<?php comments_template('', true); ?>
					</div>
				<?php } ?>				
			</div>
		<?php } ?>	
	
	<!-- CLOSE page -->
	</div>

	<?php endif; ?>
	
	<?php if ($sidebar_config == "left-sidebar") { ?>
		<aside class="sidebar left-sidebar <?php echo $sidebar_class; ?>">
			<div class="sidebar-widget-wrap sticky-widget">
			    <?php dynamic_sidebar( $left_sidebar ); ?>
			</div>
		</aside>
	<?php } else if ($sidebar_config == "right-sidebar") { ?>
		<aside class="sidebar right-sidebar <?php echo $sidebar_class; ?>">
			<div class="sidebar-widget-wrap sticky-widget">
			    <?php dynamic_sidebar( $right_sidebar ); ?>
			</div>
		</aside>
	<?php } else if ($sidebar_config == "both-sidebars") { ?>
		<aside class="sidebar right-sidebar col-sm-3">
			<div class="sidebar-widget-wrap sticky-widget">
			    <?php dynamic_sidebar( $right_sidebar ); ?>
			</div>
		</aside>
	<?php } ?>

</div>

<!--// WordPress Hook //-->
<?php get_footer(); ?>
<?php 

	//VARS
	$canon_options = get_option('canon_options'); 
	$canon_options_post = get_option('canon_options_post'); 

	// DEV MODE VARS
	if ($canon_options['dev_mode'] == "checked") {
		if (isset($_GET['blog_layout'])) { $canon_options_post['blog_layout'] = wp_filter_nohtml_kses($_GET['blog_layout']); }
		if (isset($_GET['blog_style'])) { $canon_options_post['blog_style'] = wp_filter_nohtml_kses($_GET['blog_style']); }
		if (isset($_GET['cat_layout'])) { $canon_options_post['cat_layout'] = wp_filter_nohtml_kses($_GET['cat_layout']); }
		if (isset($_GET['cat_style'])) { $canon_options_post['cat_style'] = wp_filter_nohtml_kses($_GET['cat_style']); }
		if (isset($_GET['archive_layout'])) { $canon_options_post['archive_layout'] = wp_filter_nohtml_kses($_GET['archive_layout']); }
		if (isset($_GET['archive_style'])) { $canon_options_post['archive_style'] = wp_filter_nohtml_kses($_GET['archive_style']); }
	}

	//DETERMINE PAGE TYPE (home, page or category)
	$page_type = mb_get_page_type();
	
	//DETERMINE ARCHIVE STYLE
	if ($page_type == 'home' || $page_type == 'page') {						// blog
		$wp_query->query = array();											// blog page comes with a query for page, needs to be reset.
		$layout = $canon_options_post['blog_layout'];
		$style	= $canon_options_post['blog_style'];
	} elseif ($page_type == 'category') {									// category
		$layout = $canon_options_post['cat_layout'];
		$style	= $canon_options_post['cat_style'];
	} else {
		$layout = $canon_options_post['archive_layout'];					// all other archives
		$style	= $canon_options_post['archive_style'];
	}

	// to make pagination work on page if used as static homepage
	if (get_query_var('paged')) {
		$paged = get_query_var('paged'); 
	} elseif (get_query_var('page')) {
		$paged = get_query_var('page'); 
	} else {
		$paged = 1; 
	}

	$args = array_merge($wp_query->query, array(
		'post_status'       => 'publish',
		'orderby'           => 'date',
		'paged'             => $paged,
	));

	// $temp = $wp_query;
	if (!class_exists('Tribe__Events__Main')) { $wp_query = null; }
	$wp_query = new WP_Query($args); 

?>


    	<!-- Start Outter Wrapper -->
    	<div class="outter-wrapper body-wrapper canon-archive canon-archive-<?php echo esc_attr($style); ?>">		
    		<div class="wrapper clearfix">
    			
    			<!-- Main Column -->
    			<div class="<?php if ($layout == "sidebar") { echo "col-3-4"; } else { echo "col-1-1"; } ?>">
    				
    				
					<!-- ARCHIVE HEADER -->
					<?php get_template_part('inc/templates/template_archive_header'); ?>

					<!-- FEATURE -->
					<?php if ($page_type == 'home' || $page_type == 'page') { get_template_part('inc/templates/template_archive_feature'); } ?>

					<!-- LOOP -->
					<?php get_template_part("inc/templates/template_archive_loop_" . $style); ?>

                    <!-- PAGINATION -->
                    <?php get_template_part("inc/templates/template_paginate_links"); ?>

   				</div>
                <!-- end main column -->
    			
    			
				<!-- SIDEBAR -->
				<?php if ($layout == 'sidebar') { get_sidebar("archive"); } ?>
    			
    			
    		</div>
    		<!-- end wrapper -->
    	</div>
    	<!-- end outter-wrapper -->
    	

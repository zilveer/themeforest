<?php get_header(); global $gp_settings; ?>


<!-- BEGIN CONTENT -->

<div id="content">


	<!-- BEGIN BREADCRUMBS -->

	<?php if($gp_settings['breadcrumbs'] == "Show") { ?><div id="breadcrumb"><?php echo gp_breadcrumbs(); ?></div><?php } ?>
	
	<!-- END BREADCRUMBS -->
		
		
	<!-- BEGIN TITLE -->
	
	<h1 class="page-title"><?php _e('Page Not Found', 'gp_lang'); ?></h1>

	<!-- END TITLE -->
	
	
	<!-- BEGIN POST CONTENT -->
	
	<h4><?php _e('Oops, it looks like this page does not exist. If you are lost try using the search box.', 'gp_lang'); ?></h4>
	
	<div class="sc-divider"></div>
	
	<h4><?php _e('Search The Site', 'gp_lang'); ?></h4>
	<?php get_search_form(); ?>
	
	<!-- END POST CONTENT -->


</div>

<!-- END CONTENT -->


<?php get_sidebar(); ?>


<?php get_footer(); ?>
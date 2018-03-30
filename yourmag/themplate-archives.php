
<?php
/*
Template Name: Sitemap
*/
?>

<?php get_header(); ?>

<div id="main_content"> 
	
<?php if (get_option('op_crumbs') == 'on') { ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
<div class="inner">
<?php } ?>
<div id="content_bread_panel">	
<div class="inner">
<?php if (function_exists('wp_breadcrumbs')) wp_breadcrumbs(); ?>
</div>
</div>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>
<?php } ?>	
	
<div class="inner">	
<div id="content" class="EqHeightDiv">
  
<?php get_template_part('includes/archive_layout'); ?>
		 
</div>


<?php get_sidebar('right'); ?>	
	
</div>
</div>

<div class="clear"></div>
	
<?php get_footer(); ?>

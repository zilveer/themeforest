<?php
/*
Template Name: Error 404
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



<div class="error404_content">

<h1 class="error404"><?php echo get_option('op_page_not_found'); ?></h1>

<h1><?php echo get_option('op_try_searching'); ?></h1>
<?php get_search_form(); ?>

<h1><?php echo get_option('op_look_archives'); ?></h1>

<?php get_template_part('includes/archive_layout'); ?>

</div>		 

</div>

<?php get_sidebar('right'); ?>

</div>
</div>

<div class="clear"></div>
	
<?php get_footer(); ?>


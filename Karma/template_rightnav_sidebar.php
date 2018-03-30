<?php
/*
Template Name: Right Nav + Sidebar 
*/
?>
<?php 
get_header(); 
get_template_part( 'theme-template-part-slider', 'childtheme' ); 

//grab custom menu settings
$custom_menu_slug = get_post_meta($post->ID, 'truethemes_custom_sub_menu',true);
?>

<nav role="navigation" id="sub_nav" class="nav_right_sub_nav">
	
	<?php get_template_part('theme-template-part-horizontal-sub-menu'); ?>
    
</nav><!-- END sub_nav -->

<?php
function removeEmptyTags($html_replace) {
	$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
	return preg_replace($pattern, '', $html_replace);
}
?>

<main role="main" id="content" class="content_sidebar content_left_sidebar">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
get_template_part('theme-template-part-inline-editing','childtheme');
comments_template('/page-comments.php', true); ?>
</main><!-- END main #content -->

<aside role="complementary" id="sidebar" class="left_sidebar">
<?php generated_dynamic_sidebar(); ?>
</aside><!-- END sidebar -->

</div><!-- END main-area -->
<?php get_footer(); ?>
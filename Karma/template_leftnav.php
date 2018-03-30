<?php
/*
Template Name: Left Nav
*/
?>
<?php 
get_header(); 
get_template_part( 'theme-template-part-slider', 'childtheme' ); 

//grab custom menu settings
$custom_menu_slug = get_post_meta($post->ID, 'truethemes_custom_sub_menu',true);
?>


<nav role="navigation" id="sub_nav">
	<?php

		get_template_part('theme-template-part-horizontal-sub-menu');
		
		//check for custom sidebar on this page
		global $post;
		$custom_sidebar = get_post_meta($post->ID,'sbg_selected_sidebar_replacement',true);
		if(!empty($custom_sidebar[0])):
	?>
    <div class="sub_nav_sidebar">
    <?php generated_dynamic_sidebar(); ?>
    </div><!-- END sub_nav_sidebar -->
    <?php endif; //end custom sidebar check ?>
</nav><!-- END sub_nav -->

<?php
function removeEmptyTags($html_replace)
{
$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
return preg_replace($pattern, '', $html_replace);
}
?>

<main role="main" id="content" class="content-left-nav">
	<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif;
		get_template_part('theme-template-part-inline-editing','childtheme');
		comments_template('/page-comments.php', true); ?>
</main><!-- END main #content -->
</div><!-- END main-area -->

<?php get_footer(); ?>
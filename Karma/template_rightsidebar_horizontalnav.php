<?php
/*
Template Name: Right Sidebar
*/
?>
<?php 
get_header(); 
get_template_part('theme-template-part-slider', 'childtheme'); 
get_template_part('theme-template-part-horizontal-sub-menu');
?>
        
<main role="main" id="content">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
get_template_part('theme-template-part-inline-editing','childtheme');
comments_template('/page-comments.php', true); ?>
</main><!-- END main #content -->

<aside role="complementary" id="sidebar" class="right_sidebar">
<?php generated_dynamic_sidebar(); ?>
</aside><!-- END sidebar -->
</div><!-- END main-area -->

<?php get_footer(); ?>
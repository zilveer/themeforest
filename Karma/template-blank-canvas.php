<?php
/*
Template Name: Blank Canvas
*/
?>
<?php 
get_header(); 
get_template_part( 'theme-template-part-slider', 'childtheme' ); 
?>
    
    <main role="main" id="content" class="content_full_width">
    <?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
    comments_template('/page-comments.php', true);
    get_template_part('theme-template-part-inline-editing','childtheme'); ?>
    </main><!-- END main #content -->
</div><!-- END main-area -->

<?php get_footer(); ?>
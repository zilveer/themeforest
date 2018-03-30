<?php
/*
Template Name: Fullscreen
*/
?>
<?php get_header(); ?>

<!-- Start Page -->
<section class="<?php echo get_post_meta(get_queried_object_id(), 'layout', true); ?> container">
  
  <div class="page_content">
      
    <?php while (have_posts()) : the_post(); ?>
  
        <?php the_content(); ?>

    <?php endwhile; ?>
    <div class="clear"></div>
  </div>
  
  <?php if(get_post_meta(get_queried_object_id(), 'layout', true) == "sidebar_right" || get_post_meta(get_queried_object_id(), 'layout', true) == "sidebar_left") { ?>
   <?php get_sidebar(); ?>
  <?php } ?>
  
</section>

<?php get_footer(); ?>
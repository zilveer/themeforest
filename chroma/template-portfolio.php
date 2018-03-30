<?php
/*
Template Name: Portfolio
*/
?>
<?php get_header(); ?>

<!-- Start Page -->
<section class="<?php echo get_post_meta(get_queried_object_id(), 'layout', true); ?> container">
  
  <div class="page_content">
      
    <?php while (have_posts()) : the_post(); ?>
  
	    <?php the_content(); ?>

	    <?php
	     if(class_exists("T2T_Toolkit")) {
	       $shortcode = new T2T_Shortcode_Portfolio();
	       echo $shortcode->handle_shortcode(array(
	        "posts_to_show"         => T2T_Toolkit::get_post_meta(get_the_ID(), "posts_to_show", true, -1),
	        "posts_per_row"         => T2T_Toolkit::get_post_meta(get_the_ID(), "posts_per_row", true, 2),
	        "description_length"    => T2T_Toolkit::get_post_meta(get_the_ID(), "description_length", true, 150),
	        "category"              => T2T_Toolkit::get_post_meta(get_the_ID(), "category", true, null),
	        "show_category_filter"  => T2T_Toolkit::get_post_meta(get_the_ID(), "show_category_filter", true, true)
	       ));
	     }
	    ?>

    <?php endwhile; ?>
    <div class="clear"></div>
  </div>
  
  <?php if(get_post_meta(get_queried_object_id(), 'layout', true) == "sidebar_right" || get_post_meta(get_queried_object_id(), 'layout', true) == "sidebar_left") { ?>
   <?php get_sidebar(); ?>
  <?php } ?>
  
</section>

<?php get_footer(); ?>
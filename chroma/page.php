<?php get_header(); ?>

<!-- Start Page -->
<section class="<?php echo get_post_meta(get_queried_object_id(), 'layout', true); ?> container">
	
	<div class="page_content">
	    
    <?php while (have_posts()) : the_post(); ?>
      <?php
      if(class_exists("T2T_Toolkit")) {
        // retrieve the slider to use, if any
        $slider = T2T_Toolkit::get_post_meta(get_the_ID(), "slider", true, "none");

        // check to make sure the slider option is supported
        if(in_array($slider, array(
          T2T_SlitSlider::get_name(), T2T_ElasticSlider::get_name(), T2T_FlexSlider::get_name()))) {

          if($slider == T2T_ElasticSlider::get_name()) {
            // create the shortcode
            $shortcode = new T2T_Shortcode_ElasticSlider();

            // render the shortcode
            echo $shortcode->handle_shortcode(array(
              "posts_to_show"  => -1,
              "width"          => "full",
              "controls_color" => "light"
            ));          
          }
          elseif($slider == T2T_SlitSlider::get_name()) {
            // create the shortcode
            $shortcode = new T2T_Shortcode_SlitSlider();

            // render the shortcode
            echo $shortcode->handle_shortcode(array(
              "posts_to_show"  => -1,
              "width"          => "full",
              "controls_color" => "light"
            ));          
          }
          elseif($slider == T2T_FlexSlider::get_name()) {}
        }
      }
      ?>

			<?php the_content(); ?>

      <?php 
        wp_link_pages(array(
          "before" => "<div class=\"post_pagination\">",
          "after"  => "</div>",
          "link_before" => "<span>",
          "link_after" => "</span>"
        )); 
      ?>
      
      <?php the_tags(); ?>

  	<?php endwhile; ?>
  	<div class="clear"></div>
  </div>
	
  <?php if(get_post_meta(get_queried_object_id(), 'layout', true) == "sidebar_right" || get_post_meta(get_queried_object_id(), 'layout', true) == "sidebar_left") { ?>
	 <?php get_sidebar(); ?>
  <?php } ?>
	
</section>

<?php get_footer(); ?>
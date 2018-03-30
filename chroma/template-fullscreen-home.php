<?php
/*
Template Name: Home
*/
?>
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
              "controls_color" => "light",
              "height"         => T2T_Toolkit::get_post_meta(get_the_ID(), "slider_height", true, "")
            ));          
          }
          elseif($slider == T2T_SlitSlider::get_name()) {
            // create the shortcode
            $shortcode = new T2T_Shortcode_SlitSlider();

            // render the shortcode
            echo $shortcode->handle_shortcode(array(
              "posts_to_show"  => -1,
              "width"          => "full",
              "controls_color" => "light",
              "height"         => T2T_Toolkit::get_post_meta(get_the_ID(), "slider_height", true, "")
            ));          
          }
          elseif($slider == T2T_FlexSlider::get_name()) {
            // create the shortcode
            $shortcode = new T2T_Shortcode_FlexSlider();

            // render the shortcode
            echo $shortcode->handle_shortcode(array(
              "posts_to_show"  => -1,
              "width"          => "full",
              "controls_color" => "light",
              "height"         => T2T_Toolkit::get_post_meta(get_the_ID(), "slider_height", true, "")
            ));    
          }
        }
        else {
          echo "<div class=\"splash\">";
          echo "  <span class=\"slide-content\">";
          echo "    <span class=\"title\">" . get_bloginfo("name") . "</span>";
          echo "    <span class=\"caption\">" . get_bloginfo("description") . "</span>";
          echo "  </span>";
          echo "</div>";
        }

      }
      ?>

      <?php the_content(); ?>

      <?php
      if(class_exists("T2T_Toolkit")) {

        $show_album = T2T_Toolkit::get_post_meta(get_the_ID(), "show_album", true, true);
        if(filter_var($show_album, FILTER_VALIDATE_BOOLEAN)) {
          $shortcode = new T2T_Shortcode_Album();
          echo $shortcode->handle_shortcode(array(
            "album_id"           => get_post_meta(get_the_ID(), "album_album_id", true),
            "posts_to_show"      => T2T_Toolkit::get_post_meta(get_the_ID(), "album_posts_to_show", true, -1),
            "posts_per_row"      => T2T_Toolkit::get_post_meta(get_the_ID(), "album_posts_per_row", true, 4),
            "album_layout_style" => T2T_Toolkit::get_post_meta(get_the_ID(), "album_album_layout_style", true, "masonry"),
            "masonry_style"      => T2T_Toolkit::get_post_meta(get_the_ID(), "album_masonry_style", true, "natural")
          ));
        }

        $show_posts = T2T_Toolkit::get_post_meta(get_the_ID(), "show_posts", true, true);
        if(filter_var($show_posts, FILTER_VALIDATE_BOOLEAN)) {
          $shortcode = new T2T_Shortcode_Post_List();
          echo $shortcode->handle_shortcode(array(
            "title"                => T2T_Toolkit::get_post_meta(get_the_ID(), "posts_posts_title", true, ""),
            "posts_to_show"        => T2T_Toolkit::get_post_meta(get_the_ID(), "posts_posts_to_show", true, 4),
            "layout"               => T2T_Toolkit::get_post_meta(get_the_ID(), "posts_layout", true, "grid"),
            "description_length"   => T2T_Toolkit::get_post_meta(get_the_ID(), "posts_description_length", true, 100),
            "category"             => T2T_Toolkit::get_post_meta(get_the_ID(), "posts_category", true, null),
            "show_featured_images" => T2T_Toolkit::get_post_meta(get_the_ID(), "posts_show_featured_images", true, true)
          ));
        }

        $show_testimonials = T2T_Toolkit::get_post_meta(get_the_ID(), "show_testimonials", true, true);
        if(filter_var($show_testimonials, FILTER_VALIDATE_BOOLEAN)) {
          $testimonials_to_show = T2T_Toolkit::get_post_meta(get_the_ID(), "testimonials_posts_to_show", true, 0);
          if($testimonials_to_show == -1 || $testimonials_to_show > 0) {
            $shortcode = new T2T_Shortcode_Testimonial_List();
            echo $shortcode->handle_shortcode(array(
              "title"             => T2T_Toolkit::get_post_meta(get_the_ID(), "testimonials_title", true, ""),
              "posts_to_show"      => $testimonials_to_show,
              "posts_per_row"      => T2T_Toolkit::get_post_meta(get_the_ID(), "testimonials_posts_per_row", true, 4),
              "description_length" => T2T_Toolkit::get_post_meta(get_the_ID(), "testimonials_description_length", true, 100),
              "category"           => T2T_Toolkit::get_post_meta(get_the_ID(), "testimonials_category", true, null)
            ));
          }
        }
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
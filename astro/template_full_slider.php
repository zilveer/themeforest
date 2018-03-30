<?php
/*
Template Name: Page - Fullscreen Slider
*/
?>
<?php 
  get_header(); 
  if (get_field('fullscreen_slider_autoplay')=="1")
    $autoplay="true";
  else
    $autoplay="false";
  $delay=get_field('fullscreen_slider_delay');
  if (get_field('fullscreen_slider_hover')=="1")
    $hover_behave="false";
  else
    $hover_behave="true";
  $fill_height="super_height zero_shadow";
  $inside_filter="";
  if (get_field('pirenko_slide_set')!="")
  {
    $filter=get_field('pirenko_slide_set');
    foreach ($filter as $child)
    {
      //ADD THE CATEGORIES TO THE FILTER
      $inside_filter.=$child->slug.", ";
    }
  }
  $f_color=$prk_astro_options['active_color'];
  if (get_field('f_color')!="")
      $f_color=get_field('f_color');
?>
<div id="centered_block">
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
    <div id="content">
        <div id="main" role="main" class="main_with_sections">
            <?php
                echo do_shortcode('[prk_slider id="astro_slider-'.get_the_ID().'" category="'.$inside_filter.'" autoplay="'.$autoplay.'" delay="'.$delay.'" sl_size="'.$fill_height.'" hover="'.$hover_behave.'" f_color="'.$f_color.'"]');
              ?>
            <div class="clearfix"></div>
            <div id="full_slider_page_content" class="prk_no_composer show_later">
              <?php
                while (have_posts()) : the_post();
                  the_content();   
                endwhile; 
              ?>
           <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
</div>
<?php get_footer(); ?>
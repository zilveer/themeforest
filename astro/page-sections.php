<?php
/*
Template Name: Page - With Sections
*/
?>
<?php 
  get_header();
  $show_title=true;
  $show_slider="no";
  if (get_field('hide_title')=="1") {
      $show_title=false;
  }
  if (get_field('featured_slider')=="yes") {
      $show_slider=get_field('featured_slider');
  }
  if (get_field('featured_slider_autoplay')=="1")
    $autoplay="true";
  else
    $autoplay="false";
  $delay=get_field('featured_slider_delay');
  $inside_filter="";
  if (get_field('slide_filter')!="")
  {
    $filter=get_field('slide_filter');
    foreach ($filter as $child)
    {
      //ADD THE CATEGORIES TO THE FILTER
      $inside_filter.=$child->slug.", ";
    }
  }
?>
<div id="centered_block">
<div id="main_block" class="row block_with_sections page-<?php echo get_the_ID(); ?>">
    <?php
      echo prk_output_featured_image(get_the_ID());
      if ($show_title==true)
      {
          prk_output_title("advanced");
          $extra_class=" with_title";
      }
      else
      {
        $extra_class="";
      }
    ?>
    <div id="content">
        <div id="main" role="main" class="main_with_sections<?php echo $extra_class; ?>">
            <?php
                if ($show_slider=="yes")
                {
                    echo do_shortcode('[prk_slider id="astro_slider-'.get_the_ID().'" category="'.$inside_filter.'" autoplay="'.$autoplay.'" delay="'.$delay.'" sl_size=""]');
                }
                echo '<div class="twelve">'; 
                while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
                <div class="clearfix"></div>
                </div>
              <?php endwhile; /* End loop */ ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</div>
<?php get_footer(); ?>
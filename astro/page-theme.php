<?php
/*
Template Name: Page - Classic layout
*/
?>
<?php 
	get_header(); 
  $show_sidebar=$prk_astro_options['right_sidebar'];
  if ($show_sidebar=="1")
    $show_sidebar=true;
  else
    $show_sidebar=false;
  $show_title=true;
  $show_slider=false;
	if (get_field('show_sidebar')=="1") {
    $show_sidebar=true;
  }
  if (get_field('show_sidebar')=="no") {
    $show_sidebar=false;
  }
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
<div id="centered_block" class="prk_inner_block columns centered main_no_sections">
<div id="main_block" class="row page-<?php echo get_the_ID(); ?>">
    <?php
        if ($show_title==true)
        {
            prk_output_title("advanced");
        }
    ?>
    <div id="content">
      	<div id="main" role="main" class="main_no_sections prk_theme_page">
            <?php
                if ($show_slider=="yes")
                {
                    echo do_shortcode('[prk_slider id="astro_slider-'.get_the_ID().'" category="'.$inside_filter.'" autoplay="'.$autoplay.'" delay="'.$delay.'" sl_size="super_width"]');
                }
                if ($show_sidebar)
                {
                  echo '<div class="twelve columns sidebarized">';
                }
                else
                {
                  echo '<div class="twelve columns unsidebarized">';
                }
                echo '<div class="prk_no_composer">'; 
                while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php
                  echo '<div class="clearfix"></div>';
                  echo '</div>';
                echo '</div>';
            	endwhile;
              if ($show_sidebar) 
              {
                  ?>
                <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?> inside right_floated zero_right" role="complementary">
                    <?php get_sidebar(); ?>
                </aside>
                 </div>
                <?php
              }
            ?>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php get_footer(); ?>
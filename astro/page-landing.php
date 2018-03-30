<?php
/*
Template Name: Page - Landing
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
  <div id="centered_block" class="astro_landing_page">
    <div id="main_block" class="row block_with_sections page-<?php echo get_the_ID(); ?>">
        <div id="content">
            <div id="main" role="main" class="main_with_sections">
                <div class="twelve centerized_father">
                    <div class="twelve centerized_child">
                        <?php
                            while (have_posts()) : the_post();
                                the_content();
                            endwhile; /* End loop */
                        ?>
                        <div id="astro_buttons" class="prk_inner_block wpb_row vc_row-fluid prk_section centered columns">
                            <div class="vc_span12 wpb_column column_container">
                              <?php 
                                if (get_field('normalscreen_text')!="")
                                {
                                  ?>
                                  <div class="theme_button">
                                    <a id="landing_go_normal" href="<?php echo get_field('ext_url') ?>" class="fade_anchor_menu landing_link">
                                      <?php echo get_field('normalscreen_text') ?>
                                    </a>
                                  </div>
                                  <?php
                                }
                              ?>
                              <?php 
                                if (get_field('fullscreen_text')!="")
                                {
                                  ?>
                                  <div class="theme_button">
                                    <a id="landing_go_full" href="<?php echo get_field('ext_url') ?>" class="fade_anchor_menu landing_link">
                                      <?php echo get_field('fullscreen_text') ?>
                                    </a>
                                  </div>
                                  <?php
                                }
                              ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
<?php
  if (get_field('image_back')!="") {
    $image=wp_get_attachment_image_src(get_field('image_back'),'full');
    ?>
        <div id="astro_full_back" data-image="<?php echo $image[0]; ?>"></div>
    <?php
  }
  get_footer(); 
?>
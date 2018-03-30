<?php
/*
Template Name: Homepage :: 3D
*/
?>
<?php get_header(); ?>

  <div class="cu3er-slider-wrap">
  <?php
  $slider_id = get_option('ka_cu3er_slider_id');
  $slider_output = '[CU3ER slider=\''.$slider_id.'\']';
  echo '<div id="CU3ER'.$slider_id.'" class="embedCU3ER">'.do_shortcode($slider_output).'</div><!-- END CU3ER -->';
  ?>
  </div><!-- END cu3er-slider-wrap -->
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main">
<div class="main-area home-main-area flash-main-area">
<div class="main-holder home-holder">
<main role="main" id="content" class="content_full_width">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
get_template_part('theme-template-part-inline-editing','childtheme');
comments_template('/page-comments.php', true); ?>
</main><!-- END main #content -->
</div><!-- END main-holder -->
</div><!-- END main-area -->


<?php get_footer(); ?>
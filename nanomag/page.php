<?php
/*
  The main template file for display page
 */
?>
<?php get_header();
$GLOBALS['sbg_sidebar'] = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true); 
?>
<section id="content_main" class="clearfix">
<div class="row main_content">
<?php 
if (have_posts()) {while (have_posts()) { the_post();
?>
<div class="content_wraper three_columns_container">

   <!-- Start content -->
    <div class="eight columns content_display_col1 page_with_sidebar" id="content">
 <div <?php post_class('widget_container content_page'); ?>> 
  
           <?php echo jelly_breadcrumbs_options(); ?>
                                <h1 class="single-post-title page-title"><?php the_title(); ?></h1>
                                <?php the_content(); ?>
                       
           
<div class="brack_space"></div>
        </div>

  </div>
  <!-- End content -->
  
    <!-- Start sidebar -->
                <?php echo jelly_sidebar_page_general_show();?>
  <!-- End sidebar -->

          
</div>
 <?php }}  ?>

</div>
 </section>
<!-- end content --> 

<?php get_footer(); ?>



<?php get_header(); ?>
 
<section id="content_main" class="clearfix">
<div class="row main_content">
<div class="content_wraper three_columns_container">
   <!-- Start content -->
    <div class="eight columns content_display_col1 page_with_sidebar" id="content">
 <div <?php post_class('widget_container content_page woocommerce_content_page'); ?>> 
   <?php echo jelly_breadcrumbs_options(); ?>
          <?php woocommerce_content(); ?> 
<div class="brack_space"></div>
        </div>

  </div>
  <!-- End content -->
   
    <!-- Start sidebar -->
	<div class="four columns content_display_col3" id="sidebar">

                <?php dynamic_sidebar('woocommerce-sidebar');?>
  </div>
  <!-- End sidebar -->

          
</div>
</div>
 </section>
<!-- end content --> 

<?php get_footer(); ?>



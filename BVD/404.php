<?php get_header(); ?>

<div id="main_content">
  <div class="center1 padding" id="top_light4">
    <div class="center_box">
      <?php get_sidebar(2); ?>
      <div class="center_right" >
	<h2 class="center">Error 404 - Not Found</h2>
      </div>
      <!-- end center_right-->
    </div>
    <!-- end center_box-->
    <div id="testimonials">
      <div id="testimonials_inner">
       <!-- call for the wp-testimonial plugin -->
		<?php sfstst_onerandom(); ?>
      </div>
    </div>
  </div>
  <!--end center 1 -->
</div>
<!-- end main content-->
<?php get_footer(); ?>

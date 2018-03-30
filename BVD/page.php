<?php get_header(); ?>

<div id="main_content">
  <div class="center1 padding" id="top_light4">
    <div class="center_box">
      <?php get_sidebar(); ?>
      <div class="center_right" >
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h2>
          <?php the_title(); ?>
        </h2>
        <div class="subtitle">The best design agency in the world</div>
        <?php the_content('<strong>Read the rest of this page &raquo;</strong>'); ?>
        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        <?php endwhile; endif; ?>
        <?php edit_post_link('Edit this page', '<p><strong>', '</strong></p>'); ?>
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

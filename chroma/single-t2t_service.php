<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <!-- Start Service -->
  <section class="container"> 

  <div class="page_content">
    
    <?php if(post_password_required(get_the_id())) { ?>
      
      <article class="password_form">
        <?php echo get_the_password_form(); ?>
      </article>
      
    <?php } else { ?>
    
    <?php echo the_content(); ?>
    
    <?php } ?>

   </div>
  </section>
  <!--End Service -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>
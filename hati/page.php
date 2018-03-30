<?php get_header(); if (have_posts()) the_post(); ?>
  
  <?php 
    $pid = get_post_thumbnail_id();
    if ( $pid )
      echo do_shortcode("[gallery slider=0 ids={$pid}]");
  ?>

  <div class="main wrap group post <?php if (!$pid) echo 'nopad' ?>">
  
    <div class="headings">
      <h1><?php the_title() ?></h1>
    </div>
    <!-- /headings-->
    
    <div class="clear"></div>
    <?php the_content(); wp_link_pages(); ?>
  
  </div>

<?php get_footer() ?>
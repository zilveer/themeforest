<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
  <section class="full_width container">

  <?php if(post_password_required(get_the_id())) { ?>
  
  <div class="page_content password_form">
    <?php echo get_the_password_form(); ?>
  </div>
    
  <?php } else { ?>

  <?php if(!empty($post->post_content)) { ?>
    <div class="page_content">
      <?php the_content(); ?>
    </div>
  <?php } ?>
    
  <?php

  $post_id = get_the_id();

  // initialize options to send to the toString function
  $albumOptions = array(
    "album_id"      => $post_id,
    "posts_to_show" => -1
  );

  $albumOptions["posts_per_row"] = T2T_Toolkit::get_post_meta(
    $post_id, 
    'album_photos_per_row', 
    true, 
    4);  
    
  // options to pass to the toString function
  $albumOptions["album_layout_style"] = T2T_Toolkit::get_post_meta(
    $post_id, 
    'album_layout_style', 
    true, 
    "grid"); 

  // options to pass to the toString function
  $albumOptions["masonry_style"] = T2T_Toolkit::get_post_meta(
    $post_id, 
    'masonry_style', 
    true, 
    "natural");  
    
  // initialize the shortcode we want to use
  $album_shortcode = new T2T_Shortcode_Album();
  
  // avoid relying on the wp regex by hard coding shortcode here,
  // instead directly use the callback that the shortcode calls
  echo $album_shortcode->handle_shortcode($albumOptions);
  ?>
  
  <?php } ?>

  </section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
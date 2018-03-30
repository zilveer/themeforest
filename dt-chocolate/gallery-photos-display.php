<?php global $term; ?>

<div class="hidden post_<?php echo $term->term_id; ?>">
<div class="big_gallery_bg hidden">
<div class="big_gallery">

  <a href="#" class="go_back"><?php _e('Back', LANGUAGE_ZONE); ?></a>
  <h1><?php echo $term->name; ?></h1>

  <div class="multipics">
    <?php
       query_posts("dt_gallery_cat=".$term->slug.'&posts_per_page=-1&orderby=date&order=ASC');
    ?>
    <?php while ( have_posts() ) : the_post();
       global $postoptions_photos;
       $orig_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
       
       $orig_image = default_attachment($orig_image);
       
       $k = $orig_image[1] / $orig_image[2];
       $orig_image = $orig_image[0];
       
       $size = $postoptions_photos->get_post_option('post_size');
       
      if ($size == "s")
         $w = 220;
      if ($size == "m")
         $w = 460;
      if ($size == "l")
         $w = 700;
       
       //$w = 220;
       
       $h = ceil($w / $k);

       $tmp_src = dt_clean_thumb_url($orig_image);

       $small_image = get_template_directory_uri().'/thumb.php?src='.$tmp_src.'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1';
       $big_image = $orig_image;
    ?>
       <a href="<?php echo $big_image; ?>" class="go_pic size_<?php echo $size; ?>" style=" background: url('<?php echo $small_image; ?>')" title="<?php echo the_title(); ?>"><img height="<?php echo $h; ?>" src="<?php echo $small_image; ?>" alt="" /><i></i></a>
    <?php endwhile; ?>
  </div>

  <a href="#" class="go_back"><?php _e('Back', LANGUAGE_ZONE); ?></a>
</div>
</div>
</div>

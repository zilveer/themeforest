<?php global $term, $h; ?>
    <?php while ( have_posts() ) : the_post();
       global $postoptions_photos;
       
       $orig_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
       
       $orig_image = default_attachment($orig_image);
       
       if ($orig_image[2] <= 0) continue;
       
       $k = $orig_image[1] / $orig_image[2];
       $orig_image = $orig_image[0];
       
       $postoptions_photos->post_id = get_the_ID();
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
       
<div class="galonelvel with_href folio_box col_<?php echo $size; ?>" title="<?php the_title(); ?>">
  <a style="display: none;" href="<?php echo $big_image; ?>"></a>
  <div class="folio" style="background: url(<?php echo $small_image; ?>) 0 0; height: <?php echo $h; ?>px; width: <?php echo $w; ?>px;">  
   <i style="height: <?php echo $h; ?>px; width: <?php echo $w; ?>px;"></i>
  </div>
</div>
       
    <?php endwhile; ?>

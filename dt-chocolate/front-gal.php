<?php

global $postgallery;
$show = $postgallery->get_post_option('show');
$arr = $postgallery->get_post_option('show_'.$show);
$arr = explode(",", $arr);
$arr = (array)$arr;

$myterms = apply_filters( 'taxonomy-images-get-terms', '', array('taxonomy'=> 'dt_gallery_cat'));

$images = array();

global $term, $h;

foreach ($myterms as $term)
{

   if ($show == "all")
   {
   
   }
   elseif ($show == "only")
   {
      if ( !in_array( $term->term_id, $arr ) )
         continue;
   }
   elseif ($show == "except")
   {
      if ( in_array( $term->term_id, $arr ) )
         continue;
   }
   
   $term->pic = wp_get_attachment_image_src( $term->image_id, 'large' );
   
   $term->pic = default_attachment($term->pic);
   
   if (!$term->pic[0]) continue;
   
   $k = $term->pic[1] / $term->pic[2];
   
   
   $term->pic = $term->pic[0];
   
   $size = taxonomy_get_size( $term->term_id );
   if ($size == "s")
      $w = 220;
   if ($size == "m")
      $w = 460;
   if ($size == "l")
      $w = 700;
      
   $h = ceil($w / $k);

   $tmp_src = dt_clean_thumb_url($term->pic);
   $term->pic = get_template_directory_uri().'/thumb.php?src='.$tmp_src.'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1';
   
   query_posts("dt_gallery_cat=".$term->slug);
   
   while ( have_posts() ) : the_post();
       global $postoptions_photos;
       $size_orig_image = $orig_image = default_attachment( wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' ) );
       
       if (!$orig_image[0]) continue;
       
       $k = $orig_image[1] / $orig_image[2];
       $orig_image = $orig_image[0];
       
       $size = $postoptions_photos->get_post_option('post_size');
      if ($size == "s")
         $w = 220;
      if ($size == "m")
         $w = 460;
      if ($size == "l")
         $w = 700;
       
       $h = ceil($w / $k);

       $tmp_src = dt_clean_thumb_url($orig_image);
       $small_image = get_template_directory_uri().'/thumb.php?src='.$tmp_src.'&amp;w=102&amp;h=62&amp;zc=1';
       $big_image = $orig_image;
       
       $images[] = array(
          "size_orig_image" => $size_orig_image,
          "big_image" => $big_image,
          "small_image" => $small_image,
          "size" => $size,
          "title" => get_the_title(),
          "h" => $h,
          "w" => $w,
       );
       
   endwhile;
}

?>

<ul id="big-image">
<?php
   $reverse = $images;
   $reverse = array_reverse($reverse);
   foreach ($reverse as $image)
   {
   ?>
      <li><img src="<?php echo $image['big_image']; ?>" alt="<?php echo $image['size_orig_image'][1]; ?>|<?php echo $image['size_orig_image'][2]; ?>" title="" /></li>
   <?php
   }
?>
</ul>

<div id="big-mask"></div>

<div id="slider">
  <div>
    <ul>
      <?php
         foreach ($images as $image)
         {
         ?>
            <li><a href="#"><img src="<?php echo $image['small_image']; ?>" width="102" height="62" alt="" /><i></i></a></li>
         <?php
         }
      ?>
    </ul>
  </div>
</div>

<div id="slider_controls">
  <div>
    <ul>
      <li><a href="#"><img src="<?php echo $images[0]['small_image']; ?>" alt="" width="102" height="62" /></a></li>
    </ul>
    <a href="#" id="control_play"></a>
    <a href="#" id="control_pause"></a>
    <a href="#" id="control_f"></a>
    <a href="#" id="control_b"></a>
  </div>
</div>

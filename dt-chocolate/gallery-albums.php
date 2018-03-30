  <div id="content">
    <div id="multicol">

<?php

global $postgallery;
$show = $postgallery->get_post_option('show');
$arr = $postgallery->get_post_option('show_'.$show);
$arr = explode(",", $arr);
$arr = (array)$arr;

//$myterms = get_terms('dt_gallery_cat');
$myterms = apply_filters( 'taxonomy-images-get-terms', '', array('taxonomy'=> 'dt_gallery_cat'));

//print_r($myterms);

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
   get_template_part('gallery-album-display');
   get_template_part('gallery-photos-display');
}

?>

   </div>
   
  </div>

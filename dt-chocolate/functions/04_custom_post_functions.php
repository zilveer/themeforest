<?php

global $tumblog_items;
$tumblog_items = array(
  'articles'      => get_option('woo_articles_term_id'),
  'images'        => get_option('woo_images_term_id'),
  'audio'         => get_option('woo_audio_term_id'),
  'video'         => get_option('woo_video_term_id'),
  'quotes'        => get_option('woo_quotes_term_id'),
  'links'         => get_option('woo_links_term_id')
);

function the_post_class($empty = FALSE)
{

   global $post;
   if ($post->post_type == "page") return "";

   $id = get_the_ID();
   $tumblog_list = get_the_term_list( $id, 'tumblog', '' , '|' , ''  );
   if ( is_object($tumblog_list) ) return ($empty ? "" : "text");
   $tumblog_list = strip_tags($tumblog_list);
   $tumblog_array = explode('|', $tumblog_list);
   $tumblog_results = '';
   $sentinel = false;

   global $tumblog_items;
   
   foreach ($tumblog_array as $location_item) {
      $tumblog_id = get_term_by( 'name', $location_item, 'tumblog' );
      
      //continue;
      
      //var_dump($tumblog_id);
      
      //if (!$tumblog_id) continue;
      if (!is_object($tumblog_id)) continue;
      
      if ( $tumblog_items['articles'] == $tumblog_id->term_id && !$sentinel ) {
              $tumblog_results = 'text';
              $sentinel = true;
      } elseif ($tumblog_items['images'] == $tumblog_id->term_id && !$sentinel ) {
              $tumblog_results = 'photo';
              $sentinel = true;
      } elseif ($tumblog_items['audio'] == $tumblog_id->term_id && !$sentinel) {
              $tumblog_results = 'audio';
              $sentinel = true;
      } elseif ($tumblog_items['video'] == $tumblog_id->term_id && !$sentinel) {
              $tumblog_results = 'video';
              $sentinel = true;
      } elseif ($tumblog_items['quotes'] == $tumblog_id->term_id && !$sentinel) {
              $tumblog_results = 'quote';
              $sentinel = true;
      } elseif ($tumblog_items['links'] == $tumblog_id->term_id && !$sentinel) {
              $tumblog_results = 'link';
              $sentinel = true;
      } else {
              if (!$empty)
                 $tumblog_results = 'text';
              $sentinel = false;
      }
   }  
   
  if (!$empty && !$tumblog_results)
     $tumblog_results = 'text';
   
   return $tumblog_results;     

}

function the_post_before()
{
   $type = the_post_class();

   $show = 0;
   
   /*
   global $post;
   $cats = wp_get_post_categories($post->ID);

   foreach (get_pages() as $p)
   {
      $pp = new Portfolio(array("post" => $p->ID));
      $c = $pp->get_cat();
      if (in_array($c, $cats)) $show = 1;
   }
   */

   if ($show) return;

   if ($type)
   {
      $_type = $type;
      if ($_type == "photo")
         $_type = "image";
      $func = "woo_tumblog_".$_type."_content";
      if (function_exists($func))
         echo $func(get_the_ID());
   }
}

function get_type_link($type, $no_more = FALSE)
{

   $_type = $type;
   if ($_type == "text") 
      $_type = "articles";
   if ($_type == "photo") 
      $_type = "images";
   if ($_type == "quote") 
      $_type = "quotes";
   if ($_type == "link") 
      $_type = "links";
      
   global $tumblog_items;
	
 	$category_id = $tumblog_items[$_type];
 	
 	$term = get_term($category_id, 'tumblog');
 	$href = $category_link = get_term_link( $term, 'tumblog' );
 
   if (is_object($href))
   {
      if ($no_more) 
         return "";
      return get_type_link("article", TRUE);
   }
   
   return $href;
}

function dt_permalink($s) {
   $type = the_post_class();
   if ( $type == "link" )
   {
      echo get_post_meta(get_the_ID(),'link-url',true);
   }
   else
   {
      echo $s;
   }
}
add_filter('the_permalink', 'dt_permalink', 99);

?>

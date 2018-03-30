<?php
/*
Template Name: Audio Style 1 (4 COLUMNS)
*/
?>

<?php get_header(); ?>

<div id="content">

   <div class="title-head"><h1><?php
$prefix = false;
if (function_exists('is_tag') && is_tag()) {
    $prefix = true;
} elseif (is_archive()) {
    wp_title(' ');
} elseif (is_page()) {
    the_title();
}
?></h1></div>

<?php
$term      = get_queried_object()->slug;
$audios_nr = of_get_option('nr_audio');
$query     = array(
    'post_type' => 'audio',
    'posts_per_page' => $audios_nr,
    'paged' => $paged,
    'taxonomy' => 'audios',
	'term' => $term
);
$wp_query  = new WP_Query($query);

echo '
   <div class="adpage clearfix">
      <div class="wz-media">';
while ($wp_query->have_posts()):
    $wp_query->the_post();
    global $post;
    $title       = get_the_title();
    $results     = $wp_query->post_count;
    $items_count = 0;
    $items_count++;
    $image_id    = get_post_thumbnail_id();
    $cover       = wp_get_attachment_image_src($image_id, 'audio-style1');
    $cover_large = wp_get_attachment_image_src($image_id, 'photo-large');
    $custom      = get_post_custom($post->ID);
    $genre       = $custom["audio_genre"][0];
    $no_cover    = get_template_directory_uri();
    echo '                                       
         <div class="adpage1-col wz-last">
            <div class="adpage1-cover">
               <div class="wz-wrap wz-hover">';
    if ($image_id) {
        echo '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
    } else {
        echo '
                  <img src="' . $no_cover . '/images/no-cover/audio-1arc.png" alt="no image" />';
    } 
    echo '	
                  <div class="he-view">
                     <div class="bg a0" data-animate="fadeIn">
                        <a href="' . get_permalink() . '" class="adpage1-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="adpage1-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
                     </div>
				  </div>			
               </div>          
            </div><!-- end .adpage1-cover -->
            <a href="' . get_permalink() . '">
               <div class="adpage-info">			
                  <div class="adpage-title">' . $title . '</div>	
                  <div class="adpage-des">';   
    if ($genre != null) {
        echo ' ' . $genre . '';
    }
    echo '
                  </div>
               </div><!-- end .adpage-info -->
            </a>  
         </div><!-- end .adpage1-col wz-last -->';
endwhile;
echo '
      </div><!-- end .wz-media -->
   </div><!-- end .adpage clearfix -->';

if (function_exists("pag_full_wz")) {
    pag_full_wz();
}
?>

</div><!-- end #content -->

<?php get_footer(); ?>
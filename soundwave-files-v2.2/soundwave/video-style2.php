<?php
/*
Template Name: Video Style 2 (3 COLUMNS)
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
$paged     = (get_query_var('paged')) ? get_query_var('paged') : 1;
$term      = get_queried_object()->slug;
$videos_nr = of_get_option('nr_videos');
$query     = array(
    'post_type' => 'video',
    'posts_per_page' => $videos_nr,
    'paged' => $paged,
    'taxonomy' => 'videos',
	'term' => $term
);
$wp_query  = new WP_Query($query);

echo '
   <div class="vdpage clearfix">
      <div class="wz-media">';
while ($wp_query->have_posts()):
    $wp_query->the_post();
    global $post;
    $title       = get_the_title();
    $results     = $wp_query->post_count;
    $items_count = 0;
    $items_count++;
    $video          = get_post_meta($post->ID, "video_link", true);
    $venue          = get_post_meta($post->ID, "vd_venue", true);
    $data_video     = get_post_meta($post->ID, 'vd_date', true);
    $time           = strtotime($data_video);
    $pretty_date_yy = date('Y', $time);
    $pretty_date_M  = date('F', $time);
    $pretty_date_d  = date('d', $time);
    $image_id       = get_post_thumbnail_id();
    $cover          = wp_get_attachment_image_src($image_id, 'video-style2');
    $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
    $no_cover       = get_template_directory_uri();
    echo '                                       
         <div class="vdpage2-col wz-last">
            <div class="vdpage2-cover">
               <div class="wz-wrap wz-hover">';
    if ($image_id) {
        echo '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
    } else {
        echo '
                  <img src="' . $no_cover . '/images/no-cover/media-2arc.png" alt="no image" />';
    }
    echo '
                  <div class="he-view">
                     <div class="bg a0" data-animate="fadeIn">
                        <a href="' . $video . '" class="vdpage2-link a2" data-animate="zoomIn" data-rel="prettyPhoto"></a>
                        <a href="' . $cover_large[0] . '" class="vdpage2-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
                     </div>
                  </div>			
               </div>
            </div><!-- end .vdpage2-cover -->
            <a href="' . $video . '" data-rel="prettyPhoto">
               <div class="vdpage-info">		
                  <div class="vdpage-title">' . $title . '</div>';
    if ($data_video) {
        echo '
                  <div class="vdpage-des">' . $pretty_date_d . ' ' . $pretty_date_M . ' ' . $pretty_date_yy . '</div>';
    } else {
        echo '
                  <div class="vdpage-des">' . $venue . ' </div>';
    }
    
    echo '
               </div><!-- end .vdpage-info -->
            </a>	  
         </div><!-- end .vdpage2-col wz-last -->';
endwhile;
echo '
      </div><!-- end .wz-media -->
   </div><!-- end .vdpage clearfix -->';

if (function_exists("pag_full_wz")) {
    pag_full_wz();
}
?>
  
</div><!-- end #content -->

<?php get_footer(); ?>
<?php
/*
Template Name: Photo Style 1 (4 COLUMNS)
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
$photos_nr = of_get_option('nr_photos');
$query     = array(
    'post_type' => 'photo',
    'posts_per_page' => $photos_nr,
    'paged' => $paged,
    'taxonomy' => 'photos',
	'term' => $term
);
$wp_query  = new WP_Query($query);

echo '
   <div class="phpage clearfix">
      <div class="wz-media">';
while ($wp_query->have_posts()):
    $wp_query->the_post();
    global $post;
    $title       = get_the_title();
    $results     = $wp_query->post_count;
    $items_count = 0;
    $items_count++;
    $image_id       = get_post_thumbnail_id();
    $venue          = get_post_meta($post->ID, "ph_venue", true);
    $data_photo     = get_post_meta($post->ID, 'ph_date', true);
    $time           = strtotime($data_photo);
    $pretty_date_yy = date('Y', $time);
    $pretty_date_M  = date('F', $time);
    $pretty_date_d  = date('d', $time);
    $cover          = wp_get_attachment_image_src($image_id, 'photo-style1');
    $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
    $no_cover       = get_template_directory_uri();
    echo '                                       
         <div class="phpage1-col wz-last">
            <div class="phpage1-cover">
               <div class="wz-wrap wz-hover">';
    if ($image_id) {
        echo '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
    } else {
        echo '
                  <img src="' . $no_cover . '/images/no-cover/media-1arc.png" alt="no image" />';
    }
    echo '	
                  <div class="he-view">
                     <div class="bg a0" data-animate="fadeIn">
                        <a href="' . get_permalink() . '" class="phpage1-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="phpage1-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
                     </div>
                  </div>			
				</div>
            </div><!-- end .phpage1-cover-->
            <a href="' . get_permalink() . '">
				<div class="phpage-info">				
                  <div class="phpage-title">' . $title . '</div>';  
    if ($data_photo) {
        echo '
                     <div class="phpage-des">' . $pretty_date_d . ' ' . $pretty_date_M . ' ' . $pretty_date_yy . '</div>';
    } else {
        echo '
                     <div class="phpage-des">' . $venue . ' </div>';
    }    
    echo '
				</div><!-- end .phpage-info -->
            </a>		  
         </div><!-- end .phpage1-col wz-last -->';
endwhile;
echo '
      </div><!-- end .wz-media -->
   </div><!-- end .phpage clearfix -->';

if (function_exists("pag_full_wz")) {
    pag_full_wz();
}
?>
    
</div><!-- end #content -->
	
<?php get_footer(); ?>
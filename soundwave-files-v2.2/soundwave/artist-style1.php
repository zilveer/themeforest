<?php
/*
Template Name: Artist Style 1 (4 COLUMNS)
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
$artists_nr = of_get_option('nr_artists');
$query     = array(
    'post_type' => 'artist',
    'posts_per_page' => $artists_nr,
    'paged' => $paged,
    'taxonomy' => 'artists',
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
    $at_born        = get_post_meta($post->ID, 'at_born', true);
    $at_genres      = get_post_meta($post->ID, 'at_genres', true);
    $time           = strtotime($at_born);
    $pretty_date_yy = date('Y', $time);
    $pretty_date_M  = date('F', $time);
    $pretty_date_d  = date('d', $time);
    $cover          = wp_get_attachment_image_src($image_id, 'artist-style1');
    $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
    $no_cover       = get_template_directory_uri();
    echo '                                       
         <div class="atpage1-col wz-last">
            <div class="atpage1-cover">
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
                        <a href="' . get_permalink() . '" class="atpage1-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="atpage1-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
					 </div>
				   </div>			
               </div>
            </div><!-- end .atpage1-cover -->
            <a href="' . get_permalink() . '">
               <div class="phpage-info">
                  <div class="phpage-title">' . $title . '</div>';    
    if ($at_born) {
        echo '
                  <div class="phpage-des">' . $pretty_date_d . ' ' . $pretty_date_M . ' ' . $pretty_date_yy . '</div>';
    } else {
        echo '
                  <div class="phpage-des">' . $at_genres . ' </div>';
    }
    echo '
               </div><!-- end .phpage-info -->
            </a>
		  
         </div><!-- end .atpage1-col wz-last -->';
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
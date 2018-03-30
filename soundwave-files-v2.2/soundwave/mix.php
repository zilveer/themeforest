<?php
/*
Template Name: Dj Mixes
*/
?>

<?php get_header(); ?>

<div id="content">

<?php
$page_layout = sidebar_layout();
switch ($page_layout) {
    case "layout-sidebar-left":
        echo '
   <div class="col-right-media">';
        break;  
    case "layout-sidebar-right":
        echo '
   <div class="col-left-media">';
        break;  
    case "layout-full":
        echo '
   <div class="title-head"><h1>Please select left or right from  "Sidebar layout settings" of this page.</h1></div>';
        break;
}
echo '
      <div class="title-head"><h1>';
$prefix = false;
if (function_exists('is_tag') && is_tag()) {
    $prefix = true;
} elseif (is_archive()) {
    wp_title(' ');
} elseif (is_page()) {
    the_title();
}
echo '</h1></div>';

$term      = get_queried_object()->slug;
$mixes_nr  = of_get_option('nr_mixes');
$query     = array(
    'post_type' => 'mix',
    'posts_per_page' => $mixes_nr,
    'paged' => $paged,
    'taxonomy' => 'mixes',
	'term' => $term
);
$wp_query  = new WP_Query($query);

echo '
      <div class="ev2page clearfix">';
while ($wp_query->have_posts()):
    $wp_query->the_post();
    global $post;
    $results        = $wp_query->post_count;
    $data           = get_post_meta($post->ID, 'mx_date', true);
    $buy            = get_post_meta($post->ID, 'mx_buy', true);
    $time           = strtotime($data);
    $pretty_date_yy = date('Y', $time);
    $pretty_date_M  = date('M', $time);
    $pretty_date_d  = date('d', $time);
    $mx_genre       = get_post_meta($post->ID, 'mx_genre', true);
    $image_id       = get_post_thumbnail_id();
    $cover          = wp_get_attachment_image_src($image_id, 'mix-page');
    $no_cover       = get_template_directory_uri();
    $playlist       = null;
    $args        = array(
        'post_type' => 'attachment',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => $post->ID
    );
    $attachments = get_posts($args);
    $arrImages =& get_children('post_type=attachment&orderby=title&order=ASC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID());
    echo '
         <div class="home-width">
            <div class="mxpage-col">
               <div class="mxpage-cover">  ';
    if ($image_id) {
        echo '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
    } else {
        echo '
                  <img src="' . $no_cover . '/images/no-cover/mix.png" alt="no image" />';
    }
    echo '
               </div>
               <h2 class="mxpage-title">' . get_the_title() . '</h2>';
    echo '
               <div class="mxpage-genre">' . $mx_genre . '</div> 
               <div class="mxpage-data">' . $pretty_date_d . ' ' . $pretty_date_M . ' ' . $pretty_date_yy . '</div>';
    if ($arrImages) {
        foreach ($arrImages as $attachment) {
            $playlist .= '
                     <li class="play mediamx"><a href="' . wp_get_attachment_url($attachment->ID) . '" title="' . $attachment->post_title . '" rel="' . $cover[0] . '" data-meta="#player-meta-mix" class="no-ajax"></a></li>';
        }
    }
    echo '
               <div id="mxpage-media">  
                  <ul class="fap-my-playlist">  
' . $playlist . '';
    if ($buy) {
        echo '
                     <a href="' . $buy . '"><div class="shop"></div></a>';
    }
    echo '
                  </ul>  
                  <span id="player-meta-mix">
                     <div class="player-mix-info1">' . $mx_genre . '</div>
                     <div class="player-mix-info2">' . $pretty_date_d . ' ' . $pretty_date_M . ' ' . $pretty_date_yy . '</div>
                  </span>
               </div>		
            </div><!-- end .mxpage-col -->
         </div><!-- end .home-width -->';
endwhile;

if (function_exists("pag_half_wz")) {
    pag_half_wz();
}
echo '
      </div><!-- end .ev2page clearfix -->
   </div><!-- end .col -->';
switch ($page_layout) {
    case "layout-sidebar-left":
        echo '
   <div class="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (is_active_sidebar('sidebar-mix')) {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-mix'));
        } else {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        }
        echo '
   </div><!-- end .sidebar-left -->';
        break;    
    case "layout-sidebar-right":
        echo '
   <div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (is_active_sidebar('sidebar-mix')) {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-mix'));
        } else {
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        }
        echo '
   </div><!-- end .sidebar-right -->';
        break;       
}
?>

</div><!-- end #content -->
	
<?php get_footer(); ?>
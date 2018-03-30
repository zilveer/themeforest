<?php
add_shortcode("video", "video_shortcode");
function video_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 3,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
        "orderby" => "ID",
        "videos" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'video',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
			'cat' => $cat
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => $orderby,
		'order' => $order,
        'post_type' => 'video',
        'tax_query' => array(
            array(
                'taxonomy' => 'videos',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_video = new WP_Query($query);
    }
    $items_src .= '    
   <div class="home-shr clearfix">
	  <div class="vdshr-col">
		 <div class="home-width">';
    while ($wp_query_video->have_posts()):
        $wp_query_video->the_post();
        global $post;
        $fix            = the_excerpt_max(0);
        $title          = get_the_title($fix);
        $video          = get_post_meta($post->ID, "video_link", true);
        $image_id       = get_post_thumbnail_id();
        $venue          = get_post_meta($post->ID, "vd_venue", true);
        $data_video     = get_post_meta($post->ID, 'vd_date', true);
        $time           = strtotime($data_video);
        $pretty_date_yy = date('Y', $time);
        $pretty_date_M  = date('F', $time);
        $pretty_date_d  = date('d', $time);
        $cover          = wp_get_attachment_image_src($image_id, 'video-shortcode');
        $cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
        $no_cover       = get_template_directory_uri();
        $items_src .= '
            <div class="vdshr-fix wz-last">
               <div class="vdshr-cover">
                  <div class="wz-wrap wz-hover">';
        if ($image_id) {
            $items_src .= '
                     <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
                     <img src="' . $no_cover . '/images/no-cover/media-shr.png" alt="no image" />';
        }
        $items_src .= '	
                     <div class="he-view">
                        <div class="bg a0" data-animate="fadeIn">
                           <a href="' . $video . '" class="vdshr-link a2" data-animate="zoomIn" data-rel="prettyPhoto"></a>
                           <a href="' . $cover_large[0] . '" class="vdshr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
                        </div>
                     </div>			
                  </div>
               </div><!-- end .vdshr-cover -->  
               <a href="' . $video . '" data-rel="prettyPhoto">
                  <div class="vdshr-info">	
                     <div class="vdshr-title">' . $title . '</div>';
        if ($data_video) {
            $items_src .= '
                     <div class="vdshr-des">' . $pretty_date_d . ' ' . $pretty_date_M . ' ' . $pretty_date_yy . '</div>';
        } else {
            $items_src .= '
                     <div class="vdshr-des">' . $venue . ' </div>';
        }
        $items_src .= '
                  </div>
               </a>
            </div><!-- end .vdshr-fix wz-last -->';
    endwhile;
    wp_reset_query();
    $items_src .= '    
		 </div><!-- end .home-width -->
	  </div><!-- end .vdshr-col -->
   </div><!-- end .home-shr clearfix -->';
    return $items_src;
}
?>
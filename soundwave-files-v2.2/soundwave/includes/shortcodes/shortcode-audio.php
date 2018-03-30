<?php
add_shortcode("audio", "audio_shortcode");
function audio_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 3,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
        "orderby" => "ID",
        "audios" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'audio',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => $orderby,
		'order' => $order,
        'post_type' => 'audio',
        'tax_query' => array(
            array(
                'taxonomy' => 'audios',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_audio = new WP_Query($query);
    }
    $items_src .= ' 
   <div class="home-shr clearfix">
	  <div class="adshr-col">
		 <div class="home-width">';
    while ($wp_query_audio->have_posts()):
        $wp_query_audio->the_post();
        global $post;
        $fix         = the_excerpt_max(0);
        $custom      = get_post_custom($post->ID);
        $title       = get_the_title();
        $image_id    = get_post_thumbnail_id();
        $cover       = wp_get_attachment_image_src($image_id, 'audio-shortcode');
        $cover_large = wp_get_attachment_image_src($image_id, 'photo-large');
        $genre       = $custom["audio_genre"][0];
        $no_cover    = get_template_directory_uri();
        $items_src .= '
            <div class="adshr-fix wz-last">
               <div class="adshr-cover">
                  <div class="wz-wrap wz-hover">';
        if ($image_id) {
            $items_src .= '
                     <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
                     <img src="' . $no_cover . '/images/no-cover/audio-shr.png" alt="no image" />';
        }
        $items_src .= '	
                     <div class="he-view">
                        <div class="bg a0" data-animate="fadeIn">
                           <a href="' . get_permalink() . '" class="adshr-link a2" data-animate="zoomIn"></a>
                           <a href="' . $cover_large[0] . '" class="adshr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
						</div>
                     </div>			
                  </div>
               </div><!-- end .adshr-cover -->  
               <a href="' . get_permalink() . '">
                  <div class="adshr-info">	
                     <div class="adshr-title">' . $title . '</div>
                     <div class="adshr-des">';  
        if ($genre != null) {
            $items_src .= ' ' . $genre . '';
        }
        $items_src .= '
                     </div>
		
                  </div>
               </a>
            </div><!-- end .adshr-fix wz-last -->';
    endwhile;
    wp_reset_query();
    $items_src .= ' 
		 </div><!-- end .home-width -->
	  </div><!-- end .adshr-col -->
   </div><!-- end .home-shr fixed -->';
    return $items_src;
}
?>
<?php
add_shortcode("mix", "mix_shortcode");
function mix_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 4,
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
            'post_type' => 'mix',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => $orderby,
		'order' => $order,
        'post_type' => 'mix',
        'tax_query' => array(
            array(
                'taxonomy' => 'mixes',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_mix = new WP_Query($query);
    }
    $items_src .= ' 
   <div class="home-shr clearfix">
		 <div class="home-width">';
    while ($wp_query_mix->have_posts()):
        $wp_query_mix->the_post();
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
        $items_src .= '
           <div class="mxpage-col">
               <div class="mxpage-cover">  ';
    if ($image_id) {
         $items_src .= '
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
    } else {
        $items_src .= '
                  <img src="' . $no_cover . '/images/no-cover/mix.png" alt="no image" />';
    }
     $items_src .= '
               </div>
               <h2 class="mxpage-title">' . get_the_title() . '</h2>';
    $items_src .= '
               <div class="mxpage-genre">' . $mx_genre . '</div> 
               <div class="mxpage-data">' . $pretty_date_d . ' ' . $pretty_date_M . ' ' . $pretty_date_yy . '</div>';
    if ($arrImages) {
        foreach ($arrImages as $attachment) {
            $playlist .= '
                     <li class="play mediamx"><a href="' . wp_get_attachment_url($attachment->ID) . '" title="' . $attachment->post_title . '" rel="' . $cover[0] . '" data-meta="#player-meta-mix" class="no-ajax"></a></li>';
        }
    }
     $items_src .= '
               <div id="mxpage-media">  
                  <ul class="fap-my-playlist">  
' . $playlist . '';
    if ($buy) {
        $items_src .= '
                     <a href="' . $buy . '"><div class="shop"></div></a>';
    }
     $items_src .= '
                  </ul>  
                  <span id="player-meta-mix">
                     <div class="player-mix-info1">' . $mx_genre . '</div>
                     <div class="player-mix-info2">' . $pretty_date_d . ' ' . $pretty_date_M . ' ' . $pretty_date_yy . '</div>
                  </span>
               </div>		
            </div><!-- end .mxpage-col -->';
    endwhile;
    wp_reset_query();
    $items_src .= ' 
		 </div><!-- end .home-width -->
   </div><!-- end .home-shr fixed -->';
    return $items_src;
}
?>
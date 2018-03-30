<?php
add_shortcode("blog1sty", "blog1style_shortcode");
add_shortcode("blog2sty", "blog2style_shortcode");
function blog1style_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 4,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
        "orderby" => "ID",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query          = array(
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
            'category_name' => $cat
        );
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '	
   <div class="home-shr clearfix">
      <div class="home-width">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $image_id     = get_post_thumbnail_id();
        $cover        = wp_get_attachment_image_src($image_id, 'blog-home');
        $cover_large  = wp_get_attachment_image_src($image_id, 'photo-large');
		$num_comments = get_comments_number();
        $items_src .= '
         <div class="bl1shr-col">';
        if ($image_id) {
            $items_src .= '
            <div class="bl1shr-cover">
               <div class="wz-wrap wz-hover">
                  <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />
                  <div class="he-view">
                     <div class="bg a0" data-animate="fadeIn">
                        <a href="' . get_permalink() . '" class="bl1shr-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="bl1shr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>	
                     </div>
                  </div>	  
               </div> 
            </div><!-- end .blog-home-cover --> ';
        }
        $items_src .= '
            <h2 class="bl1shr-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
            <div class="bl1shr-text">
               <p>' . the_excerpt_max(280) . '</p>
            </div>	  
            <div class="bl1shr-info">
               <p class="bl1shr-user">' . get_the_author() . '</p> 
               <p class="bl1shr-date">' . get_the_time('F jS, Y') . '</p> 
               <p class="bl1shr-comment">';
			if ($num_comments == 0) {  
				$items_src .= '' . __('No comments', 'wizedesign') . '';  
			} elseif ($num_comments == 1) {  
				$items_src .= '' . __('One comment', 'wizedesign') . '';  
			} else {  
				$items_src .= '' .$num_comments . ' ' . __('comments', 'wizedesign') . '';  
			} 
			$items_src .= '</p>  
            </div><!-- end .bl1shr-info -->
         </div><!-- end .bl1shr-col -->';
    endwhile;
    wp_reset_query();
    $items_src .= '
      </div><!-- end .home-width -->
   </div><!-- end .home-shr clearfix -->';
    return $items_src;
}
function blog2style_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 4,
        "cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
        "orderby" => "ID",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query          = array(
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
            'category_name' => $cat
        );
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
   <div class="home-shr clearfix">
      <div class="home-width">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $image_id    = get_post_thumbnail_id();
        $cover       = wp_get_attachment_image_src($image_id, 'blog-home-half');
        $cover_large = wp_get_attachment_image_src($image_id, 'photo-large');
		$no_cover    = get_template_directory_uri();
        $items_src .= '
         <div class="bl2shr-col">';
            $items_src .= '
            <div class="bl2shr-cover">
               <div class="wz-wrap wz-hover">';
        if ($image_id) {
            $items_src .= '
					<img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
					<img src="' . $no_cover . '/images/no-cover/blog-2shr.png" alt="no image" />';
        }
            $items_src .= '
                  <div class="he-view">
                     <div class="bg a0" data-animate="fadeIn">
                        <a href="' . get_permalink() . '" class="bl2shr-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="bl2shr-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
                     </div>
                  </div>	  
               </div> 
            </div><!-- end .bl2shr-cover --> ';
        $items_src .= '
        <h2 class="bl2shr-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
		<div class="bl2shr-text">
        <p>' . the_excerpt_max(240) . '</p>
		</div>
			<div class="bl2shr-info">
               <p class="bl2shr-user">' . get_the_author() . '</p> 
               <p class="bl2shr-date">' . get_the_time('F jS, Y') . '</p>  
			</div><!-- end .bl2shr-info -->
         </div><!-- end .bl2shr-col -->     ';
    endwhile;
    wp_reset_query();
    $items_src .= '
      </div><!-- end .home-width -->
   </div><!-- end .home-shr clearfix -->';
    return $items_src;
}
?>
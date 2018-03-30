<?php
global $unf_options;
add_filter('post_gallery', 'my_post_gallery', 10, 2);

function my_post_gallery($output, $attr) {

    global $post;

	if ( has_post_format( 'gallery' ) ) {

		if ( !is_single()) {

	    if (isset($attr['orderby'])) {
	        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
	        if (!$attr['orderby'])
	            unset($attr['orderby']);
	    }

	    extract(shortcode_atts(array(
	        'order' => 'ASC',
	        'orderby' => 'menu_order ID',
	        'id' => $post->ID,
	        'itemtag' => 'dl',
	        'icontag' => 'dt',
	        'captiontag' => 'dd',
	        'columns' => 3,
	        'size' => 'thumbnail',
	        'include' => '',
	        'exclude' => ''
	    ), $attr));

	    $id = intval($id);
	    if ('RAND' == $order) $orderby = 'none';

	    if (!empty($include)) {
	        $include = preg_replace('/[^0-9,]+/', '', $include);
	        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

	        $attachments = array();
			 global $unf_options;
	        //setup image count
	        $i = 0;
	        foreach ($_attachments as $key => $val) {
		        //count to 3 and break
		        if ( $unf_options['unf_limitslidesingallery'] == '1' ) {
		        if($i==3) break;
		        }
		        //add to count
				$i++;
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    }
		$galid = $post->ID;
	    if (empty($attachments)) return '';

	    // Here's your actual output, you may customize it to your need
		// ADD THESE BACK TO OUTPUT
		//<a href=\"#\" class=\"left left".$galid." icon icon-left-open-big carousel-control hidden-xs\"></a>
		//<a href=\"#\" class=\"right right".$galid." icon icon-right-open-big carousel-control hidden-xs\"></a>
	    $output = "
		<div class='gallery-post-loading swiper-loading".$galid."'>
		<img src='".get_template_directory_uri()."/library/img/loading-white.svg' alt='loading' height='32' width='32' data-no-retina=''>
		</div>
	    <div class='swiper-container swiper-container".$galid."'>";
	    $output .= "


	    <div class='swiper-wrapper'>\n";

	    // Now you loop through each attachment
	    foreach ($attachments as $id => $attachment) {
	        $img = wp_get_attachment_image_src($id, 'post-featured');
	        $galpermalink = get_the_permalink();

	        $output .= "<div class='swiper-slide'>\n";
	        $output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
	        $output .= "</div>\n";
	    }

	    if (!empty($unf_options['unf_galleryseemore'])) {
			$seemoretext = $unf_options['unf_galleryseemore'];
	    } else {
			$seemoretext = "See the full Gallery <i class='icon icon-right-circled'></i>";
	    };

		//if ( $unf_options['unf_limitslidesingallery'] == '1' ) {
		//$output .= "<div class='swiper-slide visit-the-gallery' style='height:413px;'><a href='$galpermalink' class='gallery-seemore'>$seemoretext</div>";
		//}
	    $output .= "</div>\n";
	    $output .= "</div>\n";

	    $output .="

<script>
jQuery('.swiper-container".$galid."').hide();
jQuery(window).load(function() {
	'use strict';
	jQuery('.swiper-loading".$galid."').hide();
	jQuery('.swiper-container".$galid."').fadeIn();
	jQuery(function(){
	  var mySwiper = jQuery('.swiper-container".$galid."').swiper({
	    //Your options here:
	   // pagination: '.pagination',
	    keyboardControl: true,
	    paginationClickable: true,
	    autoplay:5000,
	    speed:500,
	    mode:'horizontal',
	    loop: true,
	    calculateHeight: true,
	    nextButton: '.right".$galid."',
		prevButton: '.left".$galid."',
	  });

	})
});

</script>
";
	    return $output;

		}
	} // if is gallery
}
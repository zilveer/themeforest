<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$images = explode(',', $images_gallery);
$el_class = $this->getExtraClass($el_class);

// Columns
$gallery_full = null;
if ($gallery_wall==true) {
	$gallery_full = 'gallery-full-width wall-effect';

	if ( $gallery_columns_count=="2clm") { $gallery_columns_count = 'col-full-6'; }
	if ( $gallery_columns_count=="3clm") { $gallery_columns_count = 'col-full-4'; }
	if ( $gallery_columns_count=="4clm") { $gallery_columns_count = 'col-full-3'; }
	if ( $gallery_columns_count=="5clm") { $gallery_columns_count = 'col-full-2'; }
	if ( $gallery_columns_count=="6clm") { $gallery_columns_count = 'col-full-1'; }
} 

else {
	$gallery_full = 'gallery-normal-width';

	if ( $gallery_columns_count=="2clm") { $gallery_columns_count = 'col-md-6'; }
	if ( $gallery_columns_count=="3clm") { $gallery_columns_count = 'col-md-4'; }
	if ( $gallery_columns_count=="4clm") { $gallery_columns_count = 'col-md-3'; }
	if ( $gallery_columns_count=="5clm") { $gallery_columns_count = 'col-md-3'; }
	if ( $gallery_columns_count=="6clm") { $gallery_columns_count = 'col-md-3'; }
}

// Carousel Portfolio
if ($gallery_layout=="carousel-gallery") {
	if ($gallery_wall==true) {
		$gallery_full = 'gallery-full-width wall-effect';
	} else {
		$gallery_full = 'gallery-normal-width';
	}
	$gallery_columns_count = 'col-carousel-1';
}

// Carousel
$carousel_mode = null;
$carousel_data = null;
if ($gallery_layout == 'carousel-gallery') {
	$carousel_mode = ' carousel-enabled';
	$carousel_data = ' data-items="'.$carousel_gallery_item.'" data-navigation="'.$carousel_gallery_navigation.'" data-pagination="'.$carousel_gallery_pagination.'" data-autoplay="'.$carousel_gallery_autoplay.'" data-items-tablet="'.$carousel_gallery_item_tablet.'" data-items-mobile="'.$carousel_gallery_item_mobile.'"';
} else {
	$carousel_mode = null;
	$carousel_data = null;
}

// Custom ID for fancygallery
$gallery_fancy = null;
$gallery_cont_id = null;
$gallery_fancy = 'gallery_fancy_'.uniqid().'';
$gallery_cont_id = 'gallery-image-'.uniqid().'';

$output .= '
<div class="az-gallery row '.$gallery_full.' '. $el_class .'">';
$output .= '
<div id="'.$gallery_cont_id.'" class="isotope az-gallery-image '.$gallery_layout.'">';
$output .= '
<div id="gallery_image_'.uniqid().'" class="gallery-az '.$carousel_mode.'" '.$carousel_data.'>';

if(!empty($images_gallery)){
	// Randomize Images
	if ($gallery_random_image==true) {
		shuffle($images);
	}
	
	foreach($images as $image):
		$src = wp_get_attachment_image_src( $image, 'full' );
		$src_thumb = wp_get_attachment_image_src( $image, 'gallery-thumb' );
		$src_masonry = wp_get_attachment_image_src ( $image, 'gallery-masonry-thumb' );
		$src_thumb_wall = wp_get_attachment_image_src( $image, 'gallery-wall-thumb' );

		$alt = ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : 'Insert Alt Text';

		$output .= '
		<div class="item-gallery '.$gallery_columns_count.'">';

		$output .= '
		<a class="gallery-photo fancybox-thumb" title="'.$alt.'" href="'.$src[0].'" data-fancybox-group="'.$gallery_fancy.'">
			<span class="overlay-bg-gallery"></span><i class="gallery-icon fancy-image"></i>';
		if ($gallery_layout == "masonry-gallery") {
			$output .= '
			<img src="'.$src_masonry[0].'" width="'.$src_masonry[1].'" height="'.$src_masonry[2].'" alt="'.$alt.'" class="img-full-responsive" />';
		} else {
		if ($gallery_wall==true) {
			$output .= '
			<img src="'.$src_thumb_wall[0].'" width="'.$src_thumb_wall[1].'" height="'.$src_thumb_wall[2].'" alt="'.$alt.'" class="img-full-responsive" />';
		} else {
			$output .= '
			<img src="'.$src_thumb[0].'" width="'.$src_thumb[1].'" height="'.$src_thumb[2].'" alt="'.$alt.'" class="img-full-responsive" />';
		}
		}
		$output .= '
		</a>';
		$output .= '
		</div>';
	endforeach;
}

$output .= '
</div>';
$output .= '
</div>';
$output .= '
</div>';

if ($gallery_layout == 'grid-gallery' || $gallery_layout == 'masonry-gallery') {
$output .= '
<script type="text/javascript">
jQuery(document).ready(function(){
	var container = jQuery("#'.$gallery_cont_id.'");

	container.imagesLoaded(function() {
		container.isotope({
          itemSelector : ".item-gallery",
          transitionDuration: 0
        });
    }).done( function( instance ) {
    	container.velocity({ opacity: 1 }, 850, "easeInOutExpo" );
  	});
});
</script>';
}

echo $output;

?>
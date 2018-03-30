<?php
global $post;

$imagesize = 'Full Size';

/* Check if post has images */
$images = get_children(array(
	'post_parent' => $post->ID, 
	'post_type' => 'attachment', 
	'post_mime_type' => 'image', 
	'orderby' => 'menu_order', 
	'order' => 'DESC')
	);

$i=0;
$l=0;

if( !empty( $images )) :
// Get image id's and info in list 

echo '<div id="gallery-0" class="fullscreen_gallery_container">';
echo '<div class="postgallery"></div>';
echo '<div class="postgallery-overlay"></div>';

echo '<a href="#" id="goback"></a>';


echo '<a href="#" class="fg_next"></a>';
echo '<a href="#" class="fg_prev "></a>';
echo '<div class="gallery_caption"></div>';
echo '<div id="thumbs"><ul class="inlinegallery">'."\n"; 	
	
		foreach($images as $image):
		$title =  $image->post_title;
		$description =  $image->post_content;
		$image_thumb = wp_get_attachment_image_src($image->ID, 'Micro');
		$image = wp_get_attachment_image_src($image->ID, $imagesize);
		echo '<li class="gallery-0-link_'.$i.'"><a href="'.$image[0].'" title="'.$imageCaption[$i].'" data-rel="'.$image[2].'" data-title="'.$title.'" data-description="'.$description.'" data-count="'.$i.'"><img src="'.$image_thumb[0].'"/></a></li>'."\n";
		//echo $post-ID;
		$i++;
		endforeach;
	
// Images are loaded into #postgallery with ajax/jquery
echo '</ul></div>';

echo '<div id="preloader"></div>';
echo '</div>';



endif;
?>
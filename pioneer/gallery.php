<?php
if(empty($galleryCount)){$galleryCount = 0;}

global $post;

if($mediasize == 'large'){ $imagesize = 'Thumbnail-galleryfullwidth'; $imagewidth = EPIC_FULLWIDTH_WIDTH; $height = EPIC_FULLWIDTH_GALLERY_HEIGHT; $class = 'Thumbnail-galleryfullwidth';}
if($mediasize == 'regular'){ $imagesize = 'Thumbnail-galleryregular'; $imagewidth = EPIC_REGULAR_WIDTH; $height = EPIC_REGULAR_GALLERY_HEIGHT; $class = 'Thumbnail-galleryregular';}
if($mediasize == 'portfolio'){ $imagesize = 'Thumbnail-portfolio'; $imagewidth = EPIC_REGULAR_WIDTH; $height = '0'; $class = 'Thumbnail-portfolio';}

/* Check if post has images */
$images = get_children(array(
	'post_parent' => $post->ID, 
	'post_type' => 'attachment', 
	'post_mime_type' => 'image', 
	'orderby' => 'menu_order', 
	'order' => 'DESC')
	);

?>
<div class="flexslider galleryslider clearfix">
	
	
<ul class="slides">

<?php

$resizemethod = get_option('epic_image_resize');

if (!empty($images) ):
        foreach($images as $image):
            $photos[] = wp_get_attachment_url($image->ID, 'Gallery-fullwidth');
            $imageid[] = $image->ID;
            $title[] = $image->post_title;
            $excerpt[] = $image->post_excerpt;
        endforeach;
    endif;
 
    $count = count($photos);
    
    $i = 0;
    
    while ($i < $count) {
		
		echo '<li>';
		
		if($resizemethod == 'wordpress'){
			$result.= $photos[$i];
		}
		
		elseif($resizemethod == 'vt-resize') {
		
		$imagem = vt_resize( $imageid[$i], '' , $imagewidth, $height, true );
		echo '<figure class="'.$class.'"><img src="'.$imagem["url"].'"/>';
		if($title[$i] || $excerpt[$i]){
		echo '<div class="gallery-slide-title"><span class="image-title">'.$title[$i].'</span><span class="image-excerpt">'.$excerpt[$i].'</span></div>';
		}
		}
		
		
		echo '</figure></li>'."\n";
		$i++;
	}
?>
</ul>
	
</div>
<script>
  jQuery(function () {
   jQuery('.flexslider').flexslider({
   controlNav: false
   });
     });
</script>	

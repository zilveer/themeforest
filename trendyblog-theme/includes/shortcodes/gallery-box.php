<?php
add_shortcode('df-gallery', 'gallery_handler');
function gallery_handler($atts, $content=null, $code="") {
	if(isset($atts['url'])) {
		if(substr($atts['url'],-1) == '/') {
			$atts['url'] = substr($atts['url'],0,-1);
		}
		$vars = explode('/',$atts['url']);
		$slug = $vars[count($vars)-1];
		$page = get_page_by_path($slug,'OBJECT',DF_POST_GALLERY);
		if(is_object($page)) {
			$id = $page->ID;
			if(is_numeric($id)) {
				$gallery_style = get_post_meta ( $id, "_".THEME_NAME."_gallery_style", true );
				$galleryImages = get_post_meta ( $id, THEME_NAME."_gallery_images", true ); 
				$imageIDs = explode(",",$galleryImages);
				$count = count($imageIDs);


				$content.=	'<div class="gallery_preview">';
					$content.=	'<div class="gallery_preview_images">';
						$counter = 1;
	            		foreach($imageIDs as $imgID) { 
	            			if ($counter==5) break;
	            			if($imgID) {
		            			$file = wp_get_attachment_url($imgID);
		            			$image = get_post_thumb(false, 387, 300, false, $file);
								if($counter==1) { $class='featured-photo '; } else { $class=false; }				
								$content.=	'<div class="img_block">';
								$content.=	'<a href="'.esc_url($atts['url']).'?page='.$counter.'"><img src="'.$image['src'].'" alt="'.esc_attr__($page->post_title).'" data-id="'.$counter.'" class="'.$class.'"/></a>';
								$content.=	'</div>';
								$counter++;
							}
						} 
					$content.=	'</div>';
					$content.=	'<div class="gallery_preview_content">';
						$content.=	'<h4><a href="'.esc_url($atts['url']).'" class="gal-link">'.$page->post_title.'</a></h4>';
						if($page->post_excerpt) { 
								$content.=	'<p>'.$page->post_excerpt.'</p>'; 
							} else {
								$content.=	'<p>'.df_WordLimiter($page->post_content, 30).'</p>'; 
							}
					$content.=	'<div class="meta">';
						$content.=	'<a href="'.esc_url($atts['url']).'" class="btn btn_red">'.esc_html__('View Gallery', THEME_NAME).'</a>';
						$content.=	'<span><i class="fa fa-camera"></i> '.DF_image_count($id).' '.esc_html__('Photos', THEME_NAME).'</span>';
					$content.=	'</div>';
				$content.=	'</div>';
			$content.=	'</div>';
			} else {
				$content.= "Incorrect URL attribute defined";
			}
		} else {
			$content.= "Incorrect URL attribute defined";
		}
		
	} else {
		$content.= "No url attribute defined!";
	
	}
	return $content;
}


?>
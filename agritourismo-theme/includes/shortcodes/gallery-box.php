<?php
add_shortcode('ot-gallery', 'gallery_handler');
function gallery_handler($atts, $content=null, $code="") {
	if(isset($atts['url'])) {
		if(substr($atts['url'],-1) == '/') {
			$atts['url'] = substr($atts['url'],0,-1);
		}
		$vars = explode('/',$atts['url']);
		$slug = $vars[count($vars)-1];
		$page = get_page_by_path($slug,'OBJECT','gallery');
		if(is_object($page)) {
			$id = $page->ID;
			$gallery_style = get_post_meta ( $id, THEME_NAME."_gallery_style", true );
			if($gallery_style=="lightbox") { $classL = 'light-show '; } else { $classL = false; }
			if(is_numeric($id)) {
				$content.=	'<div class="gallery-preview">';
					$content.=	'<ul>';
						$args = array( 'post_type' => 'attachment', 'numberposts' => 5, 'post_status' => null, 'post_parent' => $id, 'order' => 'ASC', 'orderby'=> 'menu_order'); 
						$attachments = get_posts($args);
						$counter = 1;
						if ($attachments) {
							foreach($attachments as $attach) {
								$file = wp_get_attachment_url($attach->ID);
								$image = get_post_thumb(false, 105, 105, false, $file);
								if($counter==1) { $class=' class="active"'; } else { $class=false; }				
								$content.=	'<li'.$class.'><a href="'.$atts['url'].'?page='.$counter.'" class="'.$classL.'"  data-id="gallery-'.$id.'"><img src="'.$image['src'].'" alt="'.$page->post_title.'" title="'.$page->post_title.'" data-id="'.$counter.'"/></a></li>';
									
								$counter++;
							}
						} else {
							$content.= "<li>Gallery is empty</li>";
						}
					$content.=	'</ul>';
					$content.=	'<div class="gallery-preview-content">';
						$content.=	'<span class="right">'.OT_attachment_count($id).' '.__("photos in gallery", THEME_NAME).'</span>';
						$content.=	'<h3><a href="'.$atts['url'].'">'.$page->post_title.'</a></h3>';
						if($page->post_excerpt) { 
							$content.=	'<p>'.$page->post_excerpt.'</p>'; 
						} else {
							$content.=	'<p>'.WordLimiter($page->post_content, 30).'</p>'; 
						}
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

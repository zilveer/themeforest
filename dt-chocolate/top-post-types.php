<?php

	$types = array(
	   "article",
	   "image",
	   "link",
	   "audio",
	   "video",
	   "quote"
	);
	
	$c=0;
	foreach ($types as $type)
	{
	   $_type = $type;
	   if ($_type == "article") 
	      $_type = "text";
	   if ($_type == "image") 
	      $_type = "photo";

	 $tumblog_items = array(	'article'	=> get_option('woo_articles_term_id'),
									'image' 	=> get_option('woo_images_term_id'),
									'audio' 	=> get_option('woo_audio_term_id'),
									'video' 	=> get_option('woo_video_term_id'),
									'quote'	=> get_option('woo_quotes_term_id'),
									'link' 	=> get_option('woo_links_term_id')
								);
	
 	$category_id = $tumblog_items[$type];
 	
 	$term = get_term($category_id, 'tumblog');
 	// Get the URL of Articles Tumblog Taxonomy
 	$href = $category_link = get_term_link( $term, 'tumblog' );
 
   if (is_object($href)) continue;
   
   
   if ($term->count <= 0) continue;
   
	 
	   echo '
         <a href="'.$href.'" class="'.$_type.'">'.($type).'</a>
	   ';
	}

?>

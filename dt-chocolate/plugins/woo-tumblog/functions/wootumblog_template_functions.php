<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Woo Tumblog Output Functions
-- woo_tumblog_content()
-- woo_tumblog_article_content()
-- woo_tumblog_image_content()
-- woo_tumblog_audio_content()
-- woo_tumblog_video_content()
-- woo_tumblog_quote_content()
-- woo_tumblog_link_content()
-- woo_tumblog_the_title()
-- woo_tumblog_taxonomy_link()

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Woo Tumblog Output Functions  */
/*-----------------------------------------------------------------------------------*/

function woo_tumblog_content($return = false) {
	
	global $post;
	$post_id = $post->ID;
    
    // Test for Post Formats
	if (get_option('woo_tumblog_content_method') == 'post_format') {
		
		if ( has_post_format( 'aside' , $post_id )) {
  			$content = woo_tumblog_article_content($post_id);
		} elseif (has_post_format( 'image' , $post_id )) {
			$content = woo_tumblog_image_content($post_id);
		} elseif (has_post_format( 'audio' , $post_id )) {
			$content = woo_tumblog_audio_content($post_id);
		} elseif (has_post_format( 'video' , $post_id )) {
			$content = woo_tumblog_video_content($post_id);
		} elseif (has_post_format( 'quote' , $post_id )) {
			$content = woo_tumblog_quote_content($post_id);
		} elseif (has_post_format( 'link' , $post_id )) {
			$content = woo_tumblog_link_content($post_id);
		} else {
			$content = '';
		}
	
	} else {
		
		//check if it is a tumblog post
    	
    	//check which tumblog
    	$tumblog_list = get_the_term_list( $post_id, 'tumblog', '' , '|' , ''  );
    	
    	$tumblog_array = explode('|', $tumblog_list);
    		
    	$tumblog_items = array(	'articles'	=> get_option('woo_articles_term_id'),
    							'images' 	=> get_option('woo_images_term_id'),
    							'audio' 	=> get_option('woo_audio_term_id'),
    							'video' 	=> get_option('woo_video_term_id'),
    							'quotes'	=> get_option('woo_quotes_term_id'),
    							'links' 	=> get_option('woo_links_term_id')
    							);
    	//switch between tumblog taxonomies
    	$tumblog_list = strip_tags($tumblog_list);
    	$tumblog_array = explode('|', $tumblog_list);
    	$tumblog_results = '';
    	$sentinel = false;
    	foreach ($tumblog_array as $tumblog_item) {
    	  	$tumblog_id = get_term_by( 'name', $tumblog_item, 'tumblog' );
    	  	if ( $tumblog_items['articles'] == $tumblog_id->term_id && !$sentinel ) {
    	  		$content = woo_tumblog_article_content($post_id);
    	   	} elseif ($tumblog_items['images'] == $tumblog_id->term_id && !$sentinel ) {
    	   		$content = woo_tumblog_image_content($post_id);
    	   	} elseif ($tumblog_items['audio'] == $tumblog_id->term_id && !$sentinel) {
    	   		$content = woo_tumblog_audio_content($post_id);
    	   	} elseif ($tumblog_items['video'] == $tumblog_id->term_id && !$sentinel) {
    	   		$content = woo_tumblog_video_content($post_id);
    	   	} elseif ($tumblog_items['quotes'] == $tumblog_id->term_id && !$sentinel) {
    	   		$content = woo_tumblog_quote_content($post_id);
    	   	} elseif ($tumblog_items['links'] == $tumblog_id->term_id && !$sentinel) {
    	   		$content = woo_tumblog_link_content($post_id);
    	   	} else {
    	   		$content = '';
    	  	}	    		
    	} 

	}
    	
	// Return or echo the content
	if ( $return == TRUE )
		return $content;
	else 
		echo $content; // Done

}

function woo_tumblog_article_content($post_id) {
	
	$content_tumblog = '';
    
	return $content_tumblog;
}

function woo_tumblog_image_content($post_id) {

   $w = 590;
	  if (the_post_size() == 'm')
	   $w = 460;
	  if (the_post_size() == 's')
	   $w = 220;
	  if (the_post_size() == 'l' || is_single())
	   $w = 700;

   //get_the_title();
	
	if (false) {
  		$content_tumblog = '<a href="'.get_post_meta($post_id, "image", true).'" class="prettyPhoto photoPost" title="'.htmlspecialchars(get_the_title()).'">'.woo_tumblog_image('key=image&width='.$w.''.$height.'&link=img&return=true&class=alignleft').'</a>'; 
  	} else { 
  	   $im = $iminit = get_post_meta($post_id, "image", true);
	   $im_class = ' prettyPhoto';

      if (!$im)
      {
      }
      else
      {
  	  // $scriptpath = get_template_directory_uri(); 
  	  // $im = str_replace( get_bloginfo("url"), "", $im );
  	  // $im = $scriptpath.'/thumb.php?src='.$im.'&amp;w=800&amp;h=&amp;zc=1&amp;nores=1';
      }

  	   //echo htmlspecialchars($im); exit;

      if (!$im) return;
     	
		$link_to = get_post_meta( $post_id, 'link_to_image', true );
	  	
		if( $link_to && 'post' == $link_to && !is_single() ) {
			$im = get_permalink( $post_id );
			$im_class = '';
		}
		
      $size = @getimagesize($iminit);
      if ($size[0] > 0)
      {
          $prev_w = $w;
          
          $buf = array($iminit);
          $buf = array_merge($buf, $size);
          $large = $large_image_url = $buf;
          $large[0] = str_replace( get_bloginfo("url"), "", $large[0] );
          $large_image_url = get_template_directory_uri().'/thumb.php?src='.$large[0].'&amp;w=800&amp;h=&amp;zc=1&amp;nores=1';
          
          $is_large = 0;
          $w = 0;
          $h = 0;
          
          if ($large[1] >= $prev_w)
          {
             $w = $prev_w;
             $h = $large[2] * ($w / $large[1]);
             $is_large = 1;
          }
          elseif ($large[1] < 700 && $large[1] >= $prev_w / 2)
          {
             $w = $prev_w / 2;
             $h = $large[2] * ($w / $large[1]);
          }
          else
          {
             $w = $large[1];
             $h = $large[2];
          }
          
          $h = intval($h); $w = intval($w);
          
          $large[0] = str_replace( get_bloginfo("url"), "", $large[0] );
          $thumb = get_template_directory_uri().'/thumb.php?src='.$large[0].'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1&amp;nores=1';       

         if ($is_large)
         {
            $content_tumblog = "";
            if (!is_single())
               $content_tumblog .= '<div class="hr_w top"><i></i></div> ';
          	$content_tumblog .= '
          	<a href="'.$im.'" class="photoPost'. $im_class. '" title="'.htmlspecialchars(get_the_title()).'">'.'<img src="'.$thumb.'" width="'.$w.'" height="'.$h.'" alt="" class="hd" />'.'</a>
            <div class="hr_w bot"><i></i></div> 
          	';
         }
         else
         {
          	$content_tumblog = '
          	<a href="'.$im.'" class="photoPost'. $im_class. '" title="'.htmlspecialchars(get_the_title()).'">'.'<img src="'.$thumb.'" width="'.$w.'" height="'.$h.'" alt="" class="alignleft" />'.'</a> 
          	';
         }
      }
      else
      {
       	$content_tumblog = '
       	<a href="'.$im.'" class="photoPost'. $im_class. '" title="'.htmlspecialchars(get_the_title()).'">'.woo_tumblog_image('key=image&width='.$w.'&height=250&link=img&return=true&class=hd').'</a>
         <div class="hr_w bot"><i></i></div> 
       	';
      }
	}
	
//return "";

	return $content_tumblog;
}

function woo_tumblog_audio_content($post_id) {
	
	//Post Args
	$args = array(
	    'post_type' => 'attachment',
	    'numberposts' => -1,
	    'post_status' => null,
	    'post_parent' => $post_id
	);
	//Get attachements 
	$attachments = get_posts($args);
	if ($attachments) {
	    foreach ($attachments as $attachment) {
	    	$link_url= $attachment->guid;
	    }
	}
	else {
	    $link_url = get_post_meta($post_id,'audio',true);
	}
	if(!empty($link_url)) {
		$pluginpath = dirname( __FILE__ );
		
		$content_tumblog = '
		
		
		<div class="media_audio hd"><div id="mediaspace'.$post_id.'"></div></div>
		
<div class="hr_w bot media"><i></i></div>
		
		'; 
		  
		  
		  $pluginurl = get_template_directory_uri()."/plugins/woo-tumblog/";
		  
		  $w = 600;
		  if (the_post_size() == 'm')
		   $w = 460;
		  if (the_post_size() == 's')
		   $w = 220;
		  if (the_post_size() == 'l' || is_single())
		   $w = 700;
		  
		$content_tumblog .= '<script type="text/javascript">
		      				var so = new SWFObject("'.$pluginurl.'functions/player.swf","mpl","'.$w.'","32","9");
		      				so.addParam("allowfullscreen","true");
		      				so.addParam("allowscriptaccess","always");
		      				so.addParam("wmode","opaque");
		      				so.addParam("wmode","opaque");
		      				so.addVariable("skin", "'.$pluginurl.'/functions/stylish_slim.swf");
		      				so.addVariable("file","'.$link_url.'");
		      				so.addVariable("backcolor","000000");
		      				so.addVariable("frontcolor","FFFFFF");
		      				so.write("mediaspace'.$post_id.'");
		    				</script>';
		    
	}
	
	return $content_tumblog;
}

function woo_tumblog_video_content($post_id) {
	
	  $w = 600;
	  if (the_post_size() == 'm')
	   $w = 460;
	  if (the_post_size() == 's')
	   $w = 220;
	  if (the_post_size() == 'l' || is_single())
	   $w = 700;
	
	if (woo_tumblog_embed('key=video-embed&width='.$w)) $content_tumblog = '
	<div class="video media_video hd">'.woo_tumblog_embed('key=video-embed&width='.$w).'</div>
   <div class="hr_w bot"><i></i></div>
	';
	
	return $content_tumblog;
	
}

function woo_tumblog_quote_content($post_id) {
	
	$content_tumblog = '<div class="quote"><blockquote'.(is_single() ? '' : ' class="hd"').'>'.get_post_meta($post_id,'quote-copy',true).' </blockquote>
	
	<p class="quote_author">
	   '.get_post_meta($post_id,'quote-author',true).'
	</p>
	
	</div>';
	
	return $content_tumblog;
}

function woo_tumblog_link_content($post_id) {

	$content_tumblog = '';
	
	return $content_tumblog;
}

function woo_tumblog_category_link($post_id = 0, $type = 'articles') {

	$category_link = '';
	
	if (get_option('woo_tumblog_content_method') == 'post_format') {
		
		$post_format = get_post_format();
		if ($post_format == '') { 
			$category = get_the_category(); 
			$category_name = $category[0]->cat_name;
			// Get the ID of a given category
   			$category_id = get_cat_ID( $category_name );
    		// Get the URL of this category
    		$category_link = get_category_link( $category_id );
		} else {
			$category_link = get_post_format_link( $post_format );
    	}
    	
	} else {
		$tumblog_list = get_the_term_list( $post_id, 'tumblog', '' , '|' , ''  );
		$tumblog_array = explode('|', $tumblog_list);
		?>
		<?php $tumblog_items = array(	'articles'	=> get_option('woo_articles_term_id'),
										'images' 	=> get_option('woo_images_term_id'),
										'audio' 	=> get_option('woo_audio_term_id'),
										'video' 	=> get_option('woo_video_term_id'),
										'quotes'	=> get_option('woo_quotes_term_id'),
										'links' 	=> get_option('woo_links_term_id')
									);
		?>
		<?php
    	// Get the ID of Tumblog Taxonomy
    	$category_id = $tumblog_items[$type];
    	$term = &get_term($category_id, 'tumblog');
    	// Get the URL of Articles Tumblog Taxonomy
    	$category_link = get_term_link( $term, 'tumblog' );
    }

	return $category_link;
}

function woo_tumblog_the_title($class = 'title', $icon = true, $before = '', $after = '', $return = false, $outer_element = 'h2') {
	
	global $post;
	$post_id = $post->ID;
    
    // Test for Post Formats
	if (get_option('woo_tumblog_content_method') == 'post_format') {
		
		if ( has_post_format( 'aside' , $post_id )) {
  		
  			if ($icon) {
    	  		$icon_content = '<span class="post-icon article"><a href="'.woo_tumblog_category_link($post_id, 'articles').'" title="'.esc_attr( get_post_format_string( get_post_format() ) ).'">'.get_post_format_string( get_post_format() ).'</a></span>';
    	  	} else {
    	  		$icon_content = '';
    	  	}
    	  	$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
		
  		} elseif (has_post_format( 'image' , $post_id )) {
			
			if ($icon) {
    	   		$icon_content = '<span class="post-icon image"><a href="'.woo_tumblog_category_link($post_id, 'images').'" title="'.esc_attr( get_post_format_string( get_post_format() ) ).'">'.get_post_format_string( get_post_format() ).'</a></span>';
    	  	} else {
    	  		$icon_content = '';
    	  	}
    	   	$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
			
		} elseif (has_post_format( 'audio' , $post_id )) {
			
			if ($icon) {
				$icon_content = '<span class="post-icon audio"><a href="'.woo_tumblog_category_link($post_id, 'audio').'" title="'.esc_attr( get_post_format_string( get_post_format() ) ).'">'.get_post_format_string( get_post_format() ).'</a></span>';
    	  	} else {
    	  		$icon_content = '';
    	  	}
    	   	$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
			
		} elseif (has_post_format( 'video' , $post_id )) {
			
			if ($icon) {
				$icon_content = '<span class="post-icon video"><a href="'.woo_tumblog_category_link($post_id, 'video').'" title="'.esc_attr( get_post_format_string( get_post_format() ) ).'">'.get_post_format_string( get_post_format() ).'</a></span>';
    	  	} else {
    	  		$icon_content = '';
    	  	}
			$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
			
		} elseif (has_post_format( 'quote' , $post_id )) {
			
			if ($icon) {
				$icon_content = '<span class="post-icon quote"><a href="'.woo_tumblog_category_link($post_id, 'quotes').'" title="'.esc_attr( get_post_format_string( get_post_format() ) ).'">'.get_post_format_string( get_post_format() ).'</a></span>';
    	  	} else {
    	  		$icon_content = '';
    	  	}
    	   	$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
			
		} elseif (has_post_format( 'link' , $post_id )) {
			
			if ($icon) {
    	   		$icon_content = '<span class="post-icon link"><a href="'.woo_tumblog_category_link($post_id, 'links').'" title="'.esc_attr( get_post_format_string( get_post_format() ) ).'">'.get_post_format_string( get_post_format() ).'</a></span>';	
    	  	} else {
    	  		$icon_content = '';
    	  	}
    	   	$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_post_meta($post_id,'link-url',true).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark" target="_blank">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
			
		} else {
			
			$content = $before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
			
		}
	
	} else {
		
		//check if it is a tumblog post and which tumblog
    	$tumblog_list = get_the_term_list( $post_id, 'tumblog', '' , '|' , ''  );
    	
    	$tumblog_array = explode('|', $tumblog_list);
    		
    	$tumblog_items = array(	'articles'	=> get_option('woo_articles_term_id'),
    							'images' 	=> get_option('woo_images_term_id'),
    							'audio' 	=> get_option('woo_audio_term_id'),
    							'video' 	=> get_option('woo_video_term_id'),
    							'quotes'	=> get_option('woo_quotes_term_id'),
    							'links' 	=> get_option('woo_links_term_id')
    							);
    	//switch between tumblog taxonomies
    	$tumblog_list = strip_tags($tumblog_list);
    	$tumblog_array = explode('|', $tumblog_list);
    	$tumblog_results = '';
    	$sentinel = false;
    	foreach ($tumblog_array as $tumblog_item) {
    	  	$tumblog_id = get_term_by( 'name', $tumblog_item, 'tumblog' );
    	  	if ( $tumblog_items['articles'] == $tumblog_id->term_id && !$sentinel ) {
    	  		if ($icon) {
    	  			$category_id = $tumblog_items['articles'];
    	  			if ($category_id > 0) {
    					$term = &get_term($category_id, 'tumblog');
    					// Get the URL of Articles Tumblog Taxonomy
    					$category_link = get_term_link( $term, 'tumblog' );
    				} else {
    					$category_link = '#';
    				}
    				$icon_content = '<span class="post-icon article"><a href="'.$category_link.'" title="'.__($tumblog_id->name,LANGUAGE_ZONE).'">'.__($tumblog_id->name,LANGUAGE_ZONE).'</a></span>';
    	  		} else {
    	  			$icon_content = '';
    	  		}
    	  		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
    	   	} elseif ($tumblog_items['images'] == $tumblog_id->term_id && !$sentinel ) {
    	   		if ($icon) {
    	   			$category_id = $tumblog_items['images'];
    	  			if ($category_id > 0) {
    					$term = &get_term($category_id, 'tumblog');
    					// Get the URL of Images Tumblog Taxonomy
    					$category_link = get_term_link( $term, 'tumblog' );
    				} else {
    					$category_link = '#';
    				}
    				$icon_content = '<span class="post-icon image"><a href="'.$category_link.'" title="'.__($tumblog_id->name,LANGUAGE_ZONE).'">'.__($tumblog_id->name,LANGUAGE_ZONE).'</a></span>';
    	  		} else {
    	  			$icon_content = '';
    	  		}
    	   		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
    	   	} elseif ($tumblog_items['audio'] == $tumblog_id->term_id && !$sentinel) {
    	   		if ($icon) {
    	   			$category_id = $tumblog_items['audio'];
    	  			if ($category_id > 0) {
    					$term = &get_term($category_id, 'tumblog');
    					// Get the URL of Audio Tumblog Taxonomy
    					$category_link = get_term_link( $term, 'tumblog' );
    				} else {
    					$category_link = '#';
    				}
    				$icon_content = '<span class="post-icon audio"><a href="'.$category_link.'" title="'.__($tumblog_id->name,LANGUAGE_ZONE).'">'.__($tumblog_id->name,LANGUAGE_ZONE).'</a></span>';
    	  		} else {
    	  			$icon_content = '';
    	  		}
    	   		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
    	   	} elseif ($tumblog_items['video'] == $tumblog_id->term_id && !$sentinel) {
    	   		if ($icon) {
    	   			$category_id = $tumblog_items['video'];
    	  			if ($category_id > 0) {
    					$term = &get_term($category_id, 'tumblog');
    					// Get the URL of Video Tumblog Taxonomy
    					$category_link = get_term_link( $term, 'tumblog' );
    				} else {
    					$category_link = '#';
    				}
    				$icon_content = '<span class="post-icon video"><a href="'.$category_link.'" title="'.__($tumblog_id->name,LANGUAGE_ZONE).'">'.__($tumblog_id->name,LANGUAGE_ZONE).'</a></span>';
    	  		} else {
    	  			$icon_content = '';
    	  		}
    	   		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
    	   	} elseif ($tumblog_items['quotes'] == $tumblog_id->term_id && !$sentinel) {
    	   		if ($icon) {
    	  			$category_id = $tumblog_items['quotes'];
    	  			if ($category_id > 0) {
    					$term = &get_term($category_id, 'tumblog');
    					// Get the URL of Quotes Tumblog Taxonomy
    					$category_link = get_term_link( $term, 'tumblog' );
    				} else {
    					$category_link = '#';
    				}
    				$icon_content = '<span class="post-icon quote"><a href="'.$category_link.'" title="'.__($tumblog_id->name,LANGUAGE_ZONE).'">'.__($tumblog_id->name,LANGUAGE_ZONE).'</a></span>';
    	  		} else {
    	  			$icon_content = '';
    	  		}
    	   		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
    	   	} elseif ($tumblog_items['links'] == $tumblog_id->term_id && !$sentinel) {
    	   		if ($icon) {
    	   			$category_id = $tumblog_items['links'];
    	  			if ($category_id > 0) {
    					$term = &get_term($category_id, 'tumblog');
    					// Get the URL of Links Tumblog Taxonomy
    					$category_link = get_term_link( $term, 'tumblog' );
    				} else {
    					$category_link = '#';
    				}
    				$icon_content = '<span class="post-icon link"><a href="'.$category_link.'" title="'.__($tumblog_id->name,LANGUAGE_ZONE).'">'.__($tumblog_id->name,LANGUAGE_ZONE).'</a></span>';
    	  		} else {
    	  			$icon_content = '';
    	  		}
    	   		$content = $icon_content.$before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_post_meta($post_id,'link-url',true).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark" target="_blank">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
    	   	} else {
    	   		$content = $before.'<'.$outer_element.' class="'.$class.'"><a href="'.get_permalink($post_id).'" title="'.sprintf( esc_attr__( "Permalink to %s", LANGUAGE_ZONE ), get_the_title($post_id)).'" rel="bookmark">'.get_the_title($post_id).'</a></'.$outer_element.'>'.$after;
    	  	}	    		
    	} 
		
	}
	
	// Return or echo the content
	if ( $return == TRUE )
		return $content;
	else 
		echo $content; // Done
	
}

function woo_tumblog_taxonomy_link($post_id, $return = true) {
	
	$tumblog_list = get_the_term_list( $post_id, 'tumblog', '' , '|' , ''  );
	$tumblog_array = explode('|', $tumblog_list);
	
	$tumblog_items = array(	'articles'	=> get_option('woo_articles_term_id'),
							'images' 	=> get_option('woo_images_term_id'),
							'audio' 	=> get_option('woo_audio_term_id'),
							'video' 	=> get_option('woo_video_term_id'),
							'quotes'	=> get_option('woo_quotes_term_id'),
							'links' 	=> get_option('woo_links_term_id')
						);
	//switch between tumblog taxonomies
	$tumblog_list = strip_tags($tumblog_list);
	$tumblog_array = explode('|', $tumblog_list);
	$tumblog_results = '';
	$sentinel = false;
	foreach ($tumblog_array as $tumblog_item) {
	  	$tumblog_id = get_term_by( 'name', $tumblog_item, 'tumblog' );
	  	if ( $tumblog_items['articles'] == $tumblog_id->term_id && !$sentinel ) {
	  		$tumblog_results = 'article';
	  		$category_id = $tumblog_items['articles'];
	  		$sentinel = true;
	   	} elseif ($tumblog_items['images'] == $tumblog_id->term_id && !$sentinel ) {
	   		$tumblog_results = 'image';
	   		$category_id = $tumblog_items['images'];
	   		$sentinel = true;
	   	} elseif ($tumblog_items['audio'] == $tumblog_id->term_id && !$sentinel) {
	   		$tumblog_results = 'audio';
	   		$category_id = $tumblog_items['audio'];
	   		$sentinel = true;
	   	} elseif ($tumblog_items['video'] == $tumblog_id->term_id && !$sentinel) {
	   		$tumblog_results = 'video';
	   		$category_id = $tumblog_items['video'];
	   		$sentinel = true;
	   	} elseif ($tumblog_items['quotes'] == $tumblog_id->term_id && !$sentinel) {
	   		$tumblog_results = 'quote';
	   		$category_id = $tumblog_items['quotes'];
	   		$sentinel = true;
	   	} elseif ($tumblog_items['links'] == $tumblog_id->term_id && !$sentinel) {
	   		$tumblog_results = 'link';
	   		$category_id = $tumblog_items['links'];
	   		$sentinel = true;
	   	} else {
	   		$tumblog_results = 'default';
	   		$category_id = 0;
	   		$sentinel = false;
	  	}	    		
	}  
	
    if ($category_id > 0) {
    	$term = &get_term($category_id, 'tumblog');
    	// Get the URL of Articles Tumblog Taxonomy
    	$category_link = get_term_link( $term, 'tumblog' );
    } else {
    	$category_link = '#';
    }
    
    if ( $return )
		echo '<a href="'.$category_link.'" title="'.__($term->name,LANGUAGE_ZONE).'">'.__($term->name,LANGUAGE_ZONE).'</a>';
	else
		return $category_link;
    
}

?>

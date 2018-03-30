<?php

/*************************************************************************************
 * Post gallery images
 *************************************************************************************/
 
if ( !function_exists( 'om_get_post_gallery_images' ) ) {
	function om_get_post_gallery_images($post_id, $params=array()) {

		$attachments=array();
					
		$custom_gallery=get_post_meta($post_id, OM_THEME_SHORT_PREFIX.'gallery', true);
		if(is_array($custom_gallery) && $custom_gallery['type'] == 'custom') {
			
			$ids=explode(',',$custom_gallery['images']);
			if(!empty($ids)) {
				
				if(@$params['only_first'])
					$ids=array_slice($ids,0,1);
					
				if(@$params['limit'])
					$ids=array_slice($ids,0,$params['limit']);

				$attachments = get_posts(array(
					'post_type' => 'attachment',
					'orderby' => 'post__in',
					'post__in' => $ids,
					'post_mime_type' => 'image',
					'post_status' => null,
					'numberposts' => -1
				));				
				
			}
			
		} else {
		
			$args=array(
				'orderby' => 'menu_order',
				'post_type' => 'attachment',
				'post_parent' => $post_id,
				'post_mime_type' => 'image',
				'post_status' => null,
				'numberposts' => -1,
			);
			if(@$params['only_first'])
				$args['numberposts']=1;
				
			if(@$params['limit'])
				$args['numberposts']=$params['limit'];

			if(get_option(OM_THEME_PREFIX.'exclude_featured_image') == 'true' && !@$params['include_featured']) {
				if( has_post_thumbnail($post_id) ) {
					$thumbid = get_post_thumbnail_id($post_id);
		
					$args['post__not_in']=array($thumbid);
				}
			}

			$attachments = get_posts($args);
			
		}

		return $attachments;
		
	}
}



/*************************************************************************************
 * Slides Gallery
 *************************************************************************************/

function om_slides_gallery($post_id, $image_size = 'page-full-2') { 
	
	echo om_get_slides_gallery($post_id, $image_size);
	
}

function om_get_slides_gallery($post_id, $image_size = 'page-full-2') { 

	$attachments = om_get_post_gallery_images($post_id);
		
	$out = '';
	
	if( !empty($attachments) ) {
		$out .= '<div class="custom-gallery"><div class="items">';
		foreach( $attachments as $attachment ) {
	    $src = wp_get_attachment_image_src( $attachment->ID, $image_size );
	    $src_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
	    $alt = ( empty($attachment->post_content) ) ? $attachment->post_title : $attachment->post_content;
	    $out .= '<div class="item" rel="slide-'.$attachment->ID.'"><a href="'.$src_full[0].'" rel="prettyPhoto[postgal_'.$post_id.']"><img height="'.$src[2].'" width="'.$src[1].'" src="'.$src[0].'" alt="'.htmlspecialchars($alt).'" /></a></div>';
		}
		$out .= '</div></div>';
	}
	
	return $out;
}


/*************************************************************************************
 * Slides Gallery Masonry
 *************************************************************************************/

function om_slides_gallery_m($post_id, $image_size = 'portfolio-q-thumb') {
	
	echo om_get_slides_gallery_m($post_id, $image_size);
	
}

function om_get_slides_gallery_m($post_id, $image_size = 'portfolio-q-thumb') { 

	$attachments = om_get_post_gallery_images($post_id);
		
	$out = '';
	
	if( !empty($attachments) ) {
		$out .= '<div class="thumbs-masonry isotope">';
		$sizes=array();
		$n=count($attachments);
		if($n <= 3) {
			for($i=0;$i<$n;$i++)
				$sizes[]=2;
		} elseif ($n >=4 && $n <= 6) {
			$sizes[]=2;
			$sizes[]=2;
			for($i=0;$i<$n-2;$i++)
				$sizes[]=1;
		} else {
			for($i=0;$i<$n;$i++)
				$sizes[]=(($i%3)==0?'2':'1');
		}
		$i=0;
		foreach( $attachments as $attachment ) {
	    $src = wp_get_attachment_image_src( $attachment->ID, $image_size );
	    $src_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
	    $alt = ( empty($attachment->post_content) ) ? $attachment->post_title : $attachment->post_content;
	    $out .= '<div class="isotope-item block-'.$sizes[$i].' block-h-'.$sizes[$i].'"><a href="'.$src_full[0].'" rel="prettyPhoto[postgal_'.$post_id.']" class="show-hover-link block-h-'.$sizes[$i].'""><img src="'.$src[0].'" alt="'.htmlspecialchars($alt).'"/><span class="before"></span><span class="after"></span></a></div>';
	    
	    $i++;
		}
		$out .= '</div>';
	}
	
	return $out;
}


/*************************************************************************************
 * Get Post Image
 *************************************************************************************/

if ( !function_exists( 'om_get_post_image' ) ) {
	function om_get_post_image($post_id, $image_size = 'thumbnail-post-single') { 
	
		$attachments = om_get_post_gallery_images($post_id, array(
			'only_first' => true,
			'include_featured' => true,
		));
		
		if( !empty($attachments) ) {
			foreach( $attachments as $attachment ) {
				//if( $attachment->ID == $thumbid )
				//	continue;
		    $src = wp_get_attachment_image_src( $attachment->ID, $image_size );
		    $alt = ( empty($attachment->post_content) ) ? $attachment->post_title : $attachment->post_content;
		    return '<img height="'.$src[2].'" width="'.$src[1].'" src="'.$src[0].'" alt="'.htmlspecialchars($alt).'" />';
			}
		}
		
		return false;
	}
}

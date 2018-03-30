<?php
if(!function_exists('theme_section_blog_featured_image')){
/**
 * The default template for displaying blog featured image in the pages
 */
function theme_section_blog_featured_image($type='full',$width = '',$height='',$frame = false,$effect= '',$single = false){
	if (!has_post_thumbnail()){
		return '';
	}
	$thumbnail_id = get_post_thumbnail_id();
	if($single == false){
		$list_image = get_post_meta(get_the_ID(), '_list_image', true);
		if(is_array($list_image) && isset($list_image['value'])){
			$thumbnail_id = $list_image['value'];
		}
	}
	$image_src_array = wp_get_attachment_image_src($thumbnail_id,'full', true);

	switch($type){
		case 'full':
		case 'below':
			$width = $width - 2;

			if($frame && isset($width)){
				if($frame === true){
					$width = $width - 32;
				}else{
					$width = $width - $frame;
				}
			}
			if(empty($height)){
				$adaptive_height = theme_get_option('blog', 'adaptive_height');
				if($adaptive_height && !empty($image_src_array[1])){
					$height = floor($width*($image_src_array[2]/$image_src_array[1]));
				}else{
					$height = theme_get_option('blog', 'single_fixed_height');
					if(!$single || empty($height)){
						$height = theme_get_option('blog', 'fixed_height');
					}
				}
			}
			break;
		case 'right':
		case 'left':
			if($width !== ''){
				$width = $width-2;
			} else {
				$width = theme_get_option('blog', 'left_width');
			}
			if($height == ''){
				$height = theme_get_option('blog', 'left_height');
			}
			break;
	}
	
	if(empty($effect)){
		$effect = theme_get_option('blog','effect');
	}
	$title = strip_tags(get_the_title());
	$image_src = theme_get_image_src(array('type'=>'attachment_id','value'=>$thumbnail_id), array($width, $height));

	$output = '';
	$output .= '<div class="image_styled entry_image" style="width:'.($width+2).'px">';
	$output .= '<div class="image_frame effect-'.$effect.'" ><div class="image_shadow_wrap">';
	if($single){
		if(theme_get_option('blog', 'featured_image_lightbox')){
			$fittoview = theme_get_option('blog', 'featured_image_lightbox_fitToView');
			
			if($fittoview !== ''){	
				$fittoview = ($fittoview == false)?' data-fittoview="false"':' data-fittoview="true"';
			} 
			if(theme_get_option('blog', 'featured_image_lightbox_gallery')){
				$post_id = get_queried_object_id();
				$output .= '<a class="image_icon_zoom lightbox" href="'.$image_src_array[0].'" data-fancybox-group="post-'.$post_id.'" title="'.$title.'"'.$fittoview.'>';
				$output .= '<img width="'.$width.'" height="'.$height.'" data-thumbnail="'.$thumbnail_id.'" src="'.$image_src.'" alt="'.$title.'" />';
				$output .= '</a>';

				$children = array(
					'post_parent' => $post_id,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order ID',
					'numberposts' => -1,
					'offset' => ''
				);

				/* Get image attachments. If none, return. */
				$attachments = get_children( $children );
				if(!empty($attachments)){
					$output .= '<div class="hidden">';
					$post_thumbnail_id = get_post_thumbnail_id();
					foreach ( $attachments as $id => $attachment ) {
						$img_src = wp_get_attachment_image_src($id, 'full');
						if($id != $post_thumbnail_id){
						//$title = wptexturize( esc_html($attachment->post_excerpt) );
							$output .= '<a class="lightbox" href="'.$img_src[0].'" title="'.strip_tags(get_the_title()).'" data-fancybox-group="post-'.$post_id.'"'.$fittoview.'>'.$id.'</a>';
						}
					}
					$output .= '</div>';
				}
			}else{
				$output .= '<a class="image_icon_zoom lightbox" href="'.$image_src_array[0].'" title="'.$title.'"'.$fittoview.'>';
				$output .= '<img width="'.$width.'" height="'.$height.'" data-thumbnail="'.$thumbnail_id.'" src="'.$image_src.'" alt="'.$title.'" />';
				$output .= '</a>';
			}
		} else {
			if($effect!='none'){
				$output .= '<a class="image_icon_zoom" href="#" title="'.$title.'"><img width="'.$width.'" height="'.$height.'" data-thumbnail="'.$thumbnail_id.'" src="'.$image_src.'" alt="'.$title.'" /></a>';
			}else{
				$output .= '<a class="image_no_link" href="#" title="'.$title.'"><img width="'.$width.'" height="'.$height.'" data-thumbnail="'.$thumbnail_id.'" src="'.$image_src.'" alt="'.$title.'" /></a>';
			}
		}
	} else {
		if(theme_get_option('blog', 'index_featured_image_lightbox')){
			$output .= '<a class="image_icon_zoom lightbox" href="'.$image_src_array[0].'" title="'.$title.'">';
			$output .= '<img width="'.$width.'" height="'.$height.'" data-thumbnail="'.$thumbnail_id.'" src="'.$image_src.'" alt="'.$title.'" />';
			$output .= '</a>';
		} else {
			$output .= '<a class="image_icon_doc" href="'.get_permalink().'" title="">';
			$output .= '<img width="'.$width.'" height="'.$height.'" data-thumbnail="'.$thumbnail_id.'" src="'.$image_src.'" alt="'.$title.'" />';
			$output .= '</a>';
		}
		
	}
	$output .= '</div></div>';
	$output .= '</div>';

	return $output;
}
}
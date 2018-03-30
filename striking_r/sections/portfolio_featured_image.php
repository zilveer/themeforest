<?php
if(!function_exists('theme_section_portfolio_featured_image')){
/**
 * The default template for displaying portfolio_featured_image in the pages
 */
function theme_section_portfolio_featured_image($layout='',$effect= '', $single = false){
	if (!has_post_thumbnail()){
		return;
	}
	if($layout == 'full'){
		$width = 958;
	}else{
		$width = 628;
	}
	$thumbnail_id = get_post_thumbnail_id();
	if($single == false){
		$list_image = get_post_meta(get_the_ID(), '_list_image', true);
		if(is_array($list_image) && isset($list_image['value'])){
			$thumbnail_id = $list_image['value'];
		}
	}
	$image_src_array = wp_get_attachment_image_src($thumbnail_id,'full', true);
	$adaptive_height = theme_get_option('portfolio', 'adaptive_height');

	if($adaptive_height){
		$height = floor($width*($image_src_array[2]/$image_src_array[1]));
	}else{
		$height = theme_get_option('portfolio', 'fixed_height');
	}
	$image_src = theme_get_image_src(array('type'=>'attachment_id','value'=>$thumbnail_id), array($width, $height));
	
	if(empty($effect)){
		$effect = theme_get_option('blog','effect');
	}
	$title = strip_tags(get_the_title());
	$output = '';
	$output .= '<div class="image_styled entry_image" style="width:'.($width+2).'px">';
	$output .= '<div class="image_frame effect-'.$effect.'" style="height:'.($height+2).'px"><div class="image_shadow_wrap">';
	if($single){
		if(theme_get_option('portfolio', 'featured_image_lightbox')){
			$fittoview = theme_get_option('portfolio', 'featured_image_lightbox_fitToView');
			
			if($fittoview !== ''){	
				$fittoview = ($fittoview == false)?' data-fittoview="false"':' data-fittoview="true"';
			} 
			if(theme_get_option('portfolio', 'featured_image_lightbox_gallery')){
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
				$output .= '<a class="image_icon_doc" href="#" title="'.$title.'"><img width="'.$width.'" height="'.$height.'" data-thumbnail="'.$thumbnail_id.'" src="'.$image_src.'" alt="'.$title.'" /></a>';
			}else{
				$output .= '<a class="image_no_link" href="#" title="'.$title.'"><img width="'.$width.'" height="'.$height.'" data-thumbnail="'.$thumbnail_id.'" src="'.$image_src.'" alt="'.$title.'" /></a>';
			}
		}
	} else {
		$output .= '<a class="image_icon_doc" href="'.get_permalink().'" title="">';
		$output .= '<img width="'.$width.'" height="'.$height.'" data-thumbnail="'.$thumbnail_id.'" src="'.$image_src.'" alt="'.$title.'" />';
		$output .= '</a>';
	}
	$output .= '</div></div>';
	$output .= '</div>';

	return $output;
}
}
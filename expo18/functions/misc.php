<?php

/*************************************************************************************
 *	Favicon
 *************************************************************************************/

if ( !function_exists( 'om_favicon' ) ) {
	function om_favicon() {
		if ($tmp = get_option(OM_THEME_PREFIX . 'favicon')) {
			echo '<link rel="shortcut icon" href="'. $tmp .'"/>';
		}
	}
	add_action('wp_head', 'om_favicon');
}

/*************************************************************************************
 * Slides Gallery
 *************************************************************************************/

if ( !function_exists( 'om_slides_gallery' ) ) {
	function om_slides_gallery($post_id, $image_size = 'thumbnail-post-single') { 
	
		$attachments = get_posts(array(
			'orderby' => 'menu_order',
			'post_type' => 'attachment',
			'post_parent' => $post_id,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => -1
		));
		
		/*
		$thumbid = false;
		if( has_post_thumbnail($post_id) ) {
			$thumbid = get_post_thumbnail_id($post_id);
		}
		*/
		
		if( !empty($attachments) ) {
			echo '<div class="slides">';
			foreach( $attachments as $attachment ) {
				//if( $attachment->ID == $thumbid )
				//	continue;
		    $src = wp_get_attachment_image_src( $attachment->ID, $image_size );
		    $src_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
		    $alt = ( empty($attachment->post_content) ) ? $attachment->post_title : $attachment->post_content;
		    echo '<a href="'.$src_full[0].'" rel="prettyPhoto[postgal_'.$post_id.']" class="zoom-plus"><img height="'.$src[2].'" width="'.$src[1].'" src="'.$src[0].'" alt="'.htmlspecialchars($alt).'" style="display:block" /></a>';
			}
			echo '</div>';
		}
	}
}

/*************************************************************************************
 * Get Post Image
 *************************************************************************************/

if ( !function_exists( 'om_get_post_image' ) ) {
	function om_get_post_image($post_id, $image_size = 'thumbnail-post-single') { 
	
		$attachments = get_posts(array(
			'orderby' => 'menu_order',
			'post_type' => 'attachment',
			'post_parent' => $post_id,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => 1
		));
		
		/*
		$thumbid = false;
		if( has_post_thumbnail($post_id) ) {
			$thumbid = get_post_thumbnail_id($post_id);
		}
		*/
		
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

/*************************************************************************************
 * Select menu
 *************************************************************************************/
 
function om_select_menu($id, $select_id='primary-menu-select') {
	$out='';
	$out.='<select id="'.$select_id.'" onchange="if(this.value!=\'\'){document.location.href=this.value}"><option value="">'.__('Menu:','om_theme').'</option>';
	
 	$out.=om_select_menu_options($id);
	
	$out.= '</select>';
	
	echo $out;
	
	return true;
}

function om_select_menu_options($id) {
	$out='';
	
 	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $id ] ) && $locations[ $id ] ) {

		$menu = wp_get_nav_menu_object( $locations[ $id ] );
	
		$sel_menu=wp_get_nav_menu_items($menu->term_id);

		if(is_array($sel_menu)) {
			
			$items=array();
		
			foreach($sel_menu as $item)
				$items[$item->ID]=array('parent'=>$item->menu_item_parent);
				
			foreach($items as $k=>$v) {
				$items[$k]['depth']=0;
				if($v['parent']) {
					$tmp=$v;
					while($tmp['parent']) {
						$items[$k]['depth']++;
						$tmp=$items[$tmp['parent']];
					}
				}
			}
			foreach($sel_menu as $item)
				$out.= '<option value="'.($item->url).'"'.((strcasecmp('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],$item->url)==0)?' selected="selected"':'').'>'.str_repeat('-',$items[$item->ID]['depth']).($item->title).'</option>';
		}
	} else {
		$pages=get_pages();
		foreach($pages as $item) {
			$url=get_permalink($item->ID);
			$out.= '<option value="'.($url).'"'.((strcasecmp('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],$url)==0)?' selected="selected"':'').'>'.($item->post_title).'</option>';
		}
	}
		
	return $out;
}

function om_menu_name($id) {

 	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $id ] ) ) {

		$menu = wp_get_nav_menu_object( $locations[ $id ] );
	
		return $menu->name;

	}
		
	return '';
}


/*************************************************************************************
 * Overall Background
 *************************************************************************************/
 
function om_overall_bg() {
	echo '<style>';
	$bg_set=get_option(OM_THEME_PREFIX . 'background_img_set');
	$bg_l1=get_option(OM_THEME_PREFIX . 'background_img_custom_l1');
	$bg_l2=get_option(OM_THEME_PREFIX . 'background_img_custom_l2');
	
	echo '.a-bg-l1{';
	if($bg_l1)
		echo 'background-image:url('.$bg_l1.');';
	else
		echo 'background-image:url('.TEMPLATE_DIR_URI.'/img/'.$bg_set.'/headline-bg.jpg);'; 	
	echo '} ';

	echo '.a-bg-l2{';
	if($bg_l2)
		echo 'background-image:url('.$bg_l2.');';
	else
		echo 'background-image:url('.TEMPLATE_DIR_URI.'/img/'.$bg_set.'/headline-lines.png);'; 	
	echo '}';

	echo '</style>';
}
add_action('wp_head','om_overall_bg');

/*************************************************************************************
 * HTTP to local address // check if given URL could be converted to local address
 *************************************************************************************/

function om_http2local ($url) {

	if($_SERVER['DOCUMENT_ROOT']) {
		if(stripos($url, 'http://'.$_SERVER['HTTP_HOST']) === 0) {
			$url_=$_SERVER['DOCUMENT_ROOT'].substr($url,strlen('http://'.$_SERVER['HTTP_HOST']));
			if(file_exists($url_))
				$url=$url_;
		} elseif(stripos($url, 'https://'.$_SERVER['HTTP_HOST']) === 0) {
			$url_=$_SERVER['DOCUMENT_ROOT'].substr($url,strlen('https://'.$_SERVER['HTTP_HOST']));
			if(file_exists($url_))
				$url=$url_;
		}
	}
	
	return $url;

}

/*************************************************************************************
 * Admin Browse Button
 *************************************************************************************/

if( !function_exists( 'om_enqueue_admin_browse_button' ) ) {  
	function om_enqueue_admin_browse_button() {

		wp_register_script('om-admin-browse-button', TEMPLATE_DIR_URI . '/admin/js/browse-button.js', array('jquery'));
		wp_enqueue_script('om-admin-browse-button');

		global $pagenow;
		$skip_media=(isset($pagenow) && ('post-new.php' == $pagenow || 'post.php' == $pagenow)); 
		
		if(function_exists( 'wp_enqueue_media' ) && !$skip_media)
			wp_enqueue_media();
			
	}
}

/*************************************************************************************
 * Social icons
 *************************************************************************************/
 
if( !function_exists( 'om_social_icons_list' ) ) {  
	function om_social_icons_list() {
		return array(
			'twitter',
			'facebook',
			'linkedin',
			'instagram',
			'behance',
			'rss',
			'blogger',
			'deviantart',
			'dribble',
			'flickr',
			'google',
			'myspace',
			'pinterest',
			'skype',
			'vimeo',
			'youtube',
		);
	}
}
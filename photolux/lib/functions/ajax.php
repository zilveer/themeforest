<?php
/**
 * This file contains AJAX request function handlers.
 */

add_action('wp_ajax_pexeto_get_portfolio_items', 'pexeto_get_portfolio_items');
add_action('wp_ajax_nopriv_pexeto_get_portfolio_items', 'pexeto_get_portfolio_items');

add_action('wp_ajax_pexeto_get_portfolio_content', 'pexeto_get_portfolio_content');
add_action('wp_ajax_nopriv_pexeto_get_portfolio_content', 'pexeto_get_portfolio_content');


/***********************************************************************************************************
 *   PORTFOLIO / GALLERY FUNCTIONS
 ***********************************************************************************************************/

/**
 * Returns the portfolio items in JSON format. The following options can be added in the GET request:
 * - number : the number of items to display
 * - cat : the category ID to display, if -1 returns the items from all the categories
 * - offset : the offset of the first element 
 * - imgwidth : the width of the image to be displayed
 * - orderby : the way the items will be ordered - available options "date" and "custom"
 */
function pexeto_get_portfolio_items(){
	if(isset($_GET['number']) && isset($_GET['cat']) && isset($_GET['offset']) && isset($_GET['imgwidth'])){
		$args=array('post_type'=>PEXETO_PORTFOLIO_POST_TYPE, 'numberposts'=>$_GET['number'], 'offset'=>$_GET['offset']);
		$cat=$_GET['cat'];
		if($cat!=-1){
			$args['portfolio_category']=get_term($cat, 'portfolio_category')->slug;
		}
		if(isset($_GET['orderby']) && $_GET['orderby']=='custom'){
			$args['orderby'] = 'menu_order';
			$args['order'] = 'asc';
		}
		$posts = get_posts($args);
		$new_posts=array();
		foreach($posts as $post){
			$post_id=$post->ID;
			$new_post = array();
			$new_post['id'] = $post->ID;
			$new_post['title'] = $post->post_title;
			//set the image
			$thumbnail = get_post_meta($post->ID, 'thumbnail_value', true);
			$preview = pexeto_get_portfolio_preview_img($post);
			
			if(!$thumbnail){
				$thumbnail = pexeto_get_resized_image($preview, $_GET['imgwidth'], '', 'c', 150);
			}
			$new_post['image'] = $thumbnail;
			
			$description = get_post_meta($post->ID, 'description_value', true);
			if($description){
				$new_post['desc']=esc_attr($description);
			}
			
			//set the category
			$terms=wp_get_post_terms($post->ID, 'portfolio_category');
			$term_names=array();
			foreach($terms as $term){
				$term_names[]=$term->name;
			}
			if(sizeof($terms)>0){
				$new_post['cat'] = implode(' / ',$term_names);
			}
			
			//set the link
			$action=get_post_meta($post->ID, 'action_value', true);
			switch($action){
				case 'permalink': $new_post['link']='permalink'; break;
				case 'permalink_new': $new_post['link']=get_permalink($post_id); break;
				case 'custom': $new_post['link']=get_post_meta($post_id, 'custom_value', true); break;
				case 'video': $new_post['link']=get_post_meta($post_id, 'custom_value', true); $new_post['lightbox']=true; $new_post['video']=true; break;
				case 'lightbox' : $new_post['link']=$preview; $new_post['lightbox']=true; break;
			}
			
			$new_posts[]=$new_post;
		}
		
		//check if there are more posts to load
		$args['offset']=($_GET['offset']+$_GET['number']);
		$more_posts = get_posts($args);
		$more = sizeof($more_posts)>0?true:false;
		
		$res_arr=array('items'=>$new_posts, 'more'=>$more);
		$res = json_encode($res_arr);

		echo($res);
		die();
	}
}


/**
 * Returns the content and images attached to a portfolio item to an AJAX request in JSON format. If the item has been set
 * to hide the description, it would return the images only. The images are returned in an array - the first image is the
 * preview image of the item (if it is set) and after that are added the image attachments.
 * The following options can be set to the GET request:
 * - itemid - the ID of the portfolio item whose data will be retrieved
 */
function pexeto_get_portfolio_content(){
	if(isset($_GET['itemid'])){
		$itemid = $_GET['itemid'];
		$post = get_post( $itemid);

		if(!$post || $post->post_type!=PEXETO_PORTFOLIO_POST_TYPE){
			$res = array("failed"=>true);
			echo json_encode($res);
			die();
		}

		$res_arr = array();
		
		if(get_post_meta($post->ID, 'show_content_value', true)!='hide'){
			$res_arr['show_content']=true;
			$content = get_opt('_hide_slider_desc')=='off' ? $post->post_content : pexeto_remove_gallery_from_content($post->post_content);
			$share_html = pexeto_get_share_btns_html($post->ID, 'slider', array('url'=> esc_url( add_query_arg('share', $post->ID, $_GET['pageurl']) ).'#'.$post->ID));
			$res_arr['content']=do_shortcode(apply_filters('the_content', $content)).$share_html;

			$terms=wp_get_post_terms($post->ID, 'portfolio_category');
			$term_names=array();
			foreach($terms as $term){
				$term_names[]=$term->name;
			}
			if(sizeof($terms)>0){
				$res_arr['cat'] = implode(' / ',$term_names);
			}

			$res_arr['title']=$post->post_title;
		}
		
		//get the post images
	   	$images = array();
	   	
	   	$preview = get_post_meta($post->ID, 'preview_value', true);
	   	if($preview){
	   		$images[]=array('img'=>$preview, 'desc'=>get_post_meta($post->ID, 'description_value', true));
	   	}
	   	//get the gallery images (attachments)
	   	$attachments = pexeto_get_post_images($post);
		foreach ( $attachments as $attachment ) {
			$img_src = wp_get_attachment_image_src($attachment->ID, 'full');
	        $images[]=array('img'=>$img_src[0], 'desc'=>$attachment->pexeto_desc);
	    }
	    
	   	$res_arr['images']=$images;
		$res = json_encode($res_arr);
		echo($res);
		die();
	}
}

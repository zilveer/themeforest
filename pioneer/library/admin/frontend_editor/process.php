<?php

/* Form processing here */

echo 'Form processed';

	global $current_user, $wp_roles, $wp_query, $post;
	get_currentuserinfo();
	
	
	$post_id = $_POST["postid"];
	$referrer = $_POST["referrer"];
			
	echo $referrer.' | '. $post_id;
	/* Check if user is logged in and is administrator */
	if ( current_user_can('manage_options') && is_user_logged_in()){ 

/* Page content module */
		
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_contentmodule']),'fee_save_nonce')){	

			
			if(isset($_POST['epic_page_title'])){
				$posttitle = $_POST['epic_page_title'];
			}
			if(isset($_POST['epic_page_excerpt'])){
				$postexcerpt = $_POST['epic_page_excerpt'];
			}
			
			if(isset($_POST['epic_page_content'])){
				$postcontent = $_POST['epic_page_content'];
			}
			
			
						
			$my_post = array();
  			$my_post['ID'] = $post_id;
  			
  			if($posttitle){
				$my_post['post_title'] = $posttitle; 
			}
			if($postexcerpt){
				$my_post['post_excerpt'] = $postexcerpt; 
			}
			
			if($postcontent){
				$my_post['post_content'] = $postcontent; 
			}
			
			

			// Update the post into the database
 			 wp_update_post( $my_post );	
 			 
 			// Update the post-format
 			 if(isset($_POST['epic_post_format'])){
				$format = $_POST['epic_post_format'];
			}
  			
  			set_post_format( $post_id , $format);
			
			
			$options = array(
				'epic_layout',
				'epic_sidebar',
				'epic_page_background',
				'epic_page_background_stretch',
				'epic_page_header_disable',
				'epic_pagemodule_margin',
				'epic_pagemodule_style',
				'epic_media_size'
				);
				
			foreach ($options as $option){
		
				if(isset($_POST[$option])){
					$opt = $_POST[$option];
					update_post_meta($post_id,$option, $opt);
				}else{ delete_post_meta($post_id,$option);}
			}
			
			
    		
    		}
    		
    }
    header("Location: ".$referrer);
?>
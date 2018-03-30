<?php




/* -------------------------------------------------------------------------*
 * 							SLIDER ORDER									*
 * -------------------------------------------------------------------------*/
 
function update_slider() {
	$updateRecordsArray = $_POST['recordsArray'];
	
	if ( !get_option(THEME_NAME."-slide-order-set" ) ) {
		add_option(THEME_NAME."-slide-order-set", "1" );
	}
	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		global $wpdb;

		$wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET menu_order = ".$listingCounter." WHERE ID = " . $recordIDValue  ) ); 

		$listingCounter = $listingCounter + 1;

	}

}

/* -------------------------------------------------------------------------*
 * 							HOMEPAGE ORDER									*
 * -------------------------------------------------------------------------*/
 
function update_homepage() {
	$updateRecordsArray = $_POST['recordsArray'];
	$array = explode(',', $_POST['count']);
	$type = explode(',', $_POST['type']);
	$string = explode(',', $_POST['inputType']);
	$postID = explode(',', $_POST['post_id']);

	$strings = array();
	$array_count = sizeof($array);
	$e = 0;
	for($c = 0; $c < $array_count; $c++) {
		$items = array();
		for($i = 0; $i < $array[$c]; $i++) {
			array_push($items, $string[$e]);
			$e++;
		}
		
		if($array[$c] == 0) {
			$e++;
		}
		array_push($strings, $items);
		
		$items = "";
	}
	
	$homepage_layout = array();
	
	$a=0;
	
	if(!empty($updateRecordsArray)) {
		foreach($updateRecordsArray as $recordIDValue)  {
			$homepage_layout[$a]['type'] = $type[$a];
			$homepage_layout[$a]['inputType'] = $strings[$a];
			$homepage_layout[$a]['id'] = $recordIDValue;
			
			$a++;
		}
	}


	
	update_option(THEME_NAME."_homepage_layout_order_".$postID[0], $homepage_layout );

	die();

}
/* -------------------------------------------------------------------------*
 * 					HOMEPAGE SAVE DRAG&DROP OPTIONS							*
 * -------------------------------------------------------------------------*/
 
function ot_save_options() {
	$fields = $_REQUEST;
	if (current_user_can('edit_pages', get_current_user_id())) {
		foreach($fields as $key => $field) {
			if($key!="action") {
				update_option($key,$field);
			}
		}
	}


	die();

}

/* -------------------------------------------------------------------------*
 * 							SIDEBAR GENERATOR								*
 * -------------------------------------------------------------------------*/
 
function update_sidebar() {
	$updateRecordsArray = $_POST['recordsArray'];
	$last = array_pop($updateRecordsArray);
	$updateRecordsArray = implode ("|*|", $updateRecordsArray)."|*|".$last."|*|";
	update_option( THEME_NAME."_sidebar_names", $updateRecordsArray);
	echo $updateRecordsArray;
}
function delete_sidebar() {
	$sidebar_name = $_POST['sidebar_name']."|*|";
	$sidebar_names = get_option( THEME_NAME."_sidebar_names" );
	$sidebar_names = explode( "|*|", $sidebar_names );
	$sidebar_name = explode( "|*|", $sidebar_name );
	$result = array_diff($sidebar_names, $sidebar_name);
	$last = array_pop($result);
	$update_sidebar = implode ("|*|", $result)."|*|".$last."|*|";
	update_option( THEME_NAME."_sidebar_names", $update_sidebar);
	echo $update_sidebar;
}
function edit_sidebar() {
	$new_sidebar_name = sanitize_title($_POST['sidebar_name']);
	$old_name = $_POST['old_name'];

	$sidebar_names = get_option( THEME_NAME."_sidebar_names" );
	$sidebar_names = explode( "|*|", $sidebar_names );
	$new_sidebar_names=array();
	foreach ($sidebar_names as $sidebar_name) {
		if($sidebar_name!="") {
			if ($sidebar_name==$old_name) {
				$new_sidebar_names[]=$new_sidebar_name;
			} else {
				$new_sidebar_names[]=$sidebar_name;
			}
		}
	}
	$last = array_pop($new_sidebar_names);
	$update_sidebar = implode ("|*|", $new_sidebar_names)."|*|".$last."|*|";
	
	update_option( THEME_NAME."_sidebar_names", $update_sidebar);
	echo $update_sidebar;
}


/* -------------------------------------------------------------------------*
 * 						LOAD NEXT IMAGE IN GALLERY							*
 * -------------------------------------------------------------------------*/
 
function load_next_image(){
	$g = $_POST['gallery_id'];
	$next_image = $_POST['next_image'];
	$post_type = get_post_type($g);	
	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $g, 'order'=> 'ASC', 'orderby'=> 'menu_order' ); 
	$attachments = get_posts($args);

	$c=0;
	$images = array();
	
	foreach($attachments as $attachment) {
		$file = wp_get_attachment_url($attachment->ID);
		if($post_type=="gallery") {
			$image = get_post_thumb(false, 1200, 0, false, $file);
			$images[] = $image['src'];
		} elseif($post_type=="portfolio" || $post_type=="page") {
			$image = get_post_thumb(false, 630, 763, false, $file);
			$images[] = $image['src'];
		}
		$c++;
	}
						
				
	echo $images[$next_image-1];
	die();
}

/* -------------------------------------------------------------------------*
 * 							LIGHTBOX GALLERY								*
 * -------------------------------------------------------------------------*/
 
function OT_lightbox_gallery(){
	
	$g = $_POST['gallery_id'];
	$next_image = $_POST['next_image'];
	$post_type = get_post_type($g);	
	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $g, 'order'=> 'ASC', 'orderby'=> 'menu_order' ); 
	$attachments = get_posts($args);


	$c=0;
	$images = array();
	$thumbs = array();
	
	foreach($attachments as $attachment) {
		$file = wp_get_attachment_url($attachment->ID);
			$image = get_post_thumb(false, 1200, 0, false, $file);
			
			$images[] = $image['src'];
			
			$thumb = get_post_thumb(false, 95, 70, false, $file);
			$thumbs[$c] = $thumb['src'];

		$c++;
	}
	$thispost = get_post( $g );
	$content = do_shortcode($thispost->post_content);
	
	$return = array();
	$return['next'] = $images[$next_image-1];
	$return['thumbs'] = $thumbs;
	$return['title'] = get_the_title($g);
	$return['content'] = $content;
	$return['total'] = $c;


	echo json_encode($return);
	die();
}


/* -------------------------------------------------------------------------*
 * 									AWeber									*
 * -------------------------------------------------------------------------*/
 
function aweber_form() {
		
	$keys = get_option(THEME_NAME."_aweber_keys"); 
	if(isset($_POST["email"])){
		$email = is_email($_POST["email"]);
	}
	if(isset($_POST["u_name"])){
		$u_name = esc_textarea($_POST["u_name"]);
	}
	if(isset($_POST["listID"])){
		$listID = remove_html_slashes($_POST["listID"]);
	}
			
	$ip = $_SERVER['REMOTE_ADDR'];

	extract($keys);

	if($email && $u_name && $listID) {
				 

		try {
			$aweber = new AWeberAPI($consumer_key, $consumer_secret);
			$account = $aweber->getAccount($access_key, $access_secret);
			$account_id = $account->id;
			$listURL = "/accounts/{$account_id}/lists/{$listID}";
			$list = $account->loadFromUrl($listURL);
				
			# create a subscriber
			$params = array(
				'email' => $email,
				'ip_address' => $ip,
				'name' => $u_name,

			);
			$subscribers = $list->subscribers;
			$new_subscriber = $subscribers->create($params);
			

		} catch(AWeberAPIException $exc) {
			print 'Error: '.$exc->message.'';
			exit(1);
		}	
				
	}
	 
	die();

}


/* -------------------------------------------------------------------------*
 * 							FOOTER CONTACT FORM								*
 * -------------------------------------------------------------------------*/
 
function footer_contact_form() {

	if(isset($_POST["post_id"])){
		$mail_to = get_post_meta ( $_POST["post_id"], THEME_NAME."_contact_mail", true ); 
	}

	if(isset($_POST["email"]) && is_email($_POST["email"])){
		$email = is_email($_POST["email"]);
	}
	if(isset($_POST["u_name"])){
		$u_name = esc_textarea($_POST["u_name"]);
	}
	if(isset($_POST["message"])){
		$message = stripslashes(esc_textarea($_POST["message"]));
	}
	if(isset($_POST["message"])){
		$message = esc_textarea($_POST["message"]);
	}
	if(isset($_POST["url"])){
		$url = esc_textarea($_POST["url"]);
	}
	
	$ip = $_SERVER['REMOTE_ADDR'];

	
	if(isset($_POST["form_type"])) {	
		
		$subject = ( __( 'From' , THEME_NAME ))." ".get_bloginfo('name')." ".( __( 'Contact Page' , THEME_NAME ));
				
		$eol="\n";
		$mime_boundary=md5(time());
		$headers = "From: ".$email." <".$email.">".$eol;
		//$headers .= "Reply-To: ".$email."<".$email.">".$eol;
		$headers .= "Message-ID: <".time()."-".$email.">".$eol;
		$headers .= "X-Mailer: PHP v".phpversion().$eol;
		$headers .= 'MIME-Version: 1.0'.$eol;
		$headers .= "Content-Type: text/html; charset=UTF-8; boundary=\"".$mime_boundary."\"".$eol.$eol;

		ob_start(); 
		?>
<?php printf ( __( 'Message:' , THEME_NAME ));?> <?php echo nl2br($message);?>
<div style="padding-top:100px;">
<?php printf ( __( 'Name:' , THEME_NAME ));?> <?php echo $u_name;?><br/>
<?php printf ( __( 'E-mail:' , THEME_NAME ));?> <?php echo $email;?><br/>
<?php printf ( __( 'IP Address:' , THEME_NAME ));?> <?php echo $ip;?><br/>
</div>
<?php
		$message = ob_get_clean();
		wp_mail($mail_to,$subject,$message,$headers);
			
	}
	 
	die();

}

add_action('wp_ajax_update_slider', 'update_slider');
add_action('wp_ajax_update_homepage', 'update_homepage');

add_action('wp_ajax_ot_save_options', 'ot_save_options');

add_action('wp_ajax_update_sidebar', 'update_sidebar');
add_action('wp_ajax_delete_sidebar', 'delete_sidebar');
add_action('wp_ajax_edit_sidebar', 'edit_sidebar');
add_action('wp_ajax_load_next_image', 'load_next_image');
add_action('wp_ajax_nopriv_load_next_image', 'load_next_image');
add_action('wp_ajax_OT_lightbox_gallery', 'OT_lightbox_gallery');
add_action('wp_ajax_nopriv_OT_lightbox_gallery', 'OT_lightbox_gallery');


add_action('wp_ajax_aweber_form', 'aweber_form');
add_action('wp_ajax_nopriv_aweber_form', 'aweber_form');
add_action('wp_ajax_nopriv_footer_contact_form', 'footer_contact_form');
add_action('wp_ajax_footer_contact_form', 'footer_contact_form');
?>
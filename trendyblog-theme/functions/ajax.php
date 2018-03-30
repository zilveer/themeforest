<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



/* -------------------------------------------------------------------------*
 * 							RATING SYSTEM									*
 * -------------------------------------------------------------------------*/
 
function df_rating_system() {
	//$value = $_POST['value'];
	$value = 1;
	$postID = $_POST['post_id'];

	$totalVotesOld = get_post_meta( $postID, "_".THEME_NAME."_total_votes", true );

	if(!isset($_COOKIE[THEME_NAME.'_rating_'.$postID])) {
		if(!$totalVotesOld) $totalVotesOld = 0;
		$votes = $totalVotesOld + 1;
		update_post_meta( $postID, "_".THEME_NAME."_total_votes", $votes, $totalVotesOld ); 
		echo intval($votes);
	} else {
		echo intval($totalVotesOld);
	}


	die();

}



/* -------------------------------------------------------------------------*
 * 							UPDATE POST LIKE COUNT							*
 * -------------------------------------------------------------------------*/

function DF_setPostLike() {
	$postID = $_POST['post_ID'];
	if( isset($postID)) {
		$count_key = "_".THEME_NAME.'_post_likes_count';
		$count = get_post_meta($postID, $count_key, true);
		if (!isset($_SESSION[THEME_NAME."_post_likes_count_".$postID])) {
			if ( $count=='' ) {
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '0');
			} else {
				$count++;
				update_post_meta($postID, $count_key, $count, $count-1);
			}
			$_SESSION[THEME_NAME."_post_likes_count_".$postID] = 1;
			echo "1";
		} else {
			$count--;
			update_post_meta($postID, $count_key, $count, $count+1);
			unset($_SESSION[THEME_NAME."_post_likes_count_".$postID]);
			echo "0";

		}

	}
	die();
}

/* -------------------------------------------------------------------------*
 * 							SLIDER ORDER									*
 * -------------------------------------------------------------------------*/
 
function df_update_slider() {
	$updateRecordsArray = $_POST['recordsArray'];
	
	if ( !df_get_option(THEME_NAME."-slide-order-set" ) ) {
		add_option(THEME_NAME."-slide-order-set", "1" );
	}
	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		global $wpdb;

		$wpdb->update(
		  $wpdb->posts,
		  array( 'menu_order' => $listingCounter),
		  array( 'id' => $recordIDValue )
		);


		$listingCounter = $listingCounter + 1;

	}

}

/* -------------------------------------------------------------------------*
 * 							HOMEPAGE ORDER									*
 * -------------------------------------------------------------------------*/
 
function df_update_homepage() {
	$post_id = $_POST['post_id'];
	$layout = $_POST['layout'];
	$values = $_POST['values'];
	$valueCounter = 0;

	$decodedLayout = json_decode(stripslashes(utf8_encode($layout)));
	$values = json_decode(htmlspecialchars_decode(stripslashes($values)));

//print_r($values);
	
	//grop values for multiple select 
	$gropedValues = array();
	foreach($values as $value) {
		if(isset($gropedValues[$value->name])) {
			if(!is_array($gropedValues[$value->name])) {
				$existingValue = $gropedValues[$value->name];
				$gropedValues[$value->name] = array();
				$gropedValues[$value->name][] = $existingValue;
				$gropedValues[$value->name][] = htmlentities($value->value, ENT_QUOTES | ENT_IGNORE, "UTF-8");
			} else {
				$gropedValues[$value->name][] = htmlentities($value->value, ENT_QUOTES | ENT_IGNORE, "UTF-8");
			}
		} else {
			$gropedValues[$value->name] = htmlentities($value->value, ENT_QUOTES | ENT_IGNORE, "UTF-8");	
		}
		
	}



	if($decodedLayout) {
		//foreach columns
		foreach ($decodedLayout->columnRows as $columRows) {
			//foreach column rows
			foreach ($columRows->columns as $row) {
				if(isset($row->layoutRows)) {
					//foreach layoutRows
					foreach ($row->layoutRows as $layoutRows) {								
						//foreach layoutColumns
						foreach ($layoutRows->layoutColumns as $layoutColumns) {					
							//foreach column row blocks
							foreach ($layoutColumns->contentBlocks as $rowBlock) {
								$blocksContent = array();
								//foreach blocks inputs
								foreach ($rowBlock->blocksContent as $inputs) {
									$blocksContent[$inputs] = $gropedValues[$inputs];
									$valueCounter++;
								}
								$rowBlock->blocksContent = $blocksContent;
							}
						}
					}
				} elseif (isset($row->contentBlocks)) {
					//foreach column row blocks
					foreach ($row->contentBlocks as $rowBlock) {
						$blocksContent = array();
						//foreach blocks inputs
						foreach ($rowBlock->blocksContent as $inputs) {
							$blocksContent[$inputs] = $gropedValues[$inputs];
							$valueCounter++;
						}
						$rowBlock->blocksContent = $blocksContent;
					}
				}
			}
		}
	}

	//print_r($decodedLayout);
	update_post_meta($post_id, "_".THEME_NAME."_pagebuilder_layout", $decodedLayout);

	die();

}
/* -------------------------------------------------------------------------*
 * 					MANAGEMENT PANEL OPTION SAVE							*
 * -------------------------------------------------------------------------*/
 
function df_management_save() {
	global $different_themes_managment;
	$options = $different_themes_managment->get_options();

	$nonsavable_types = array(
		'navigation', 
		'tab',
		'sub_navigation',
		'meta_sub_navigation',
		'sub_tab',
		'meta_sub_tab',
		'homepage_set_test',
		'save',
		'closesubtab',
		'closetab',
		'row',
		'close'
	);

	//insert the default values if the fields are empty
	foreach ($options as $value) {
		if( isset( $value['id'] ) && df_get_option($value['id'])=='' && isset($value['std']) && !in_array($value['type'], $nonsavable_types)){
			df_update_option( $value['id'], $value['std'], true);
		}
	}

	//save the field's values if the Save action is present

	if ( isset( $_REQUEST['action'] ) && 'df_management_save' == $_REQUEST['action'] ) {

		//verify the nonce
		if ( empty($_POST) || !wp_verify_nonce($_POST['different-theme-options'],'different-theme-update-options') )
		{
		   _esc_html_e('Sorry, your nonce did not verify.', THEME_NAME);
		   exit;
		}else{
			if(df_get_option('different_themes_first_save')==''){
				df_update_option('different_themes_first_save', 'saved');
			}

			foreach ($options as $value) {
				if(isset($value['id']) && isset($_REQUEST[$value['id']]) && !in_array($value['type'],$nonsavable_types)) {
					
					if($value['type']=="checkbox" && $_REQUEST[$value['id']]=="on"){
						df_update_option($value['id'],$_REQUEST[$value['id']]); 
					}
					if($value['type']=="aweber_input") {
						$arrayAweber = df_get_option(THEME_NAME."_aweber_keys");
						 
						if(empty($arrayAweber) || $_REQUEST[$value['id']] != df_get_option($value['id'])) {
							$oauth_id = $_REQUEST[$value['id']];
							
							if($oauth_id) {
								try {
									list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = AWeberAPI::getDataFromAweberID($oauth_id);
								} catch (AWeberAPIException $exc) {
									list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = null;
									# make error messages customer friendly.
									$descr = $exc->description;
									$descr = preg_replace('/http.*$/i', '', $descr);     # strip labs.aweber.com documentation url from error message
									$descr = preg_replace('/[\.\!:]+.*$/i', '', $descr); # strip anything following a . : or ! character
									$error_code = " ($descr)";
								} catch (AWeberOAuthDataMissing $exc) {
									list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = null;
								} catch (AWeberException $exc) {
									list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = null;
								}
							}
							
							$keys = array(
								'consumer_key' => $consumerKey,
								'consumer_secret' => $consumerSecret,
								'access_key' => $accessKey,
								'access_secret' => $accessSecret,
							);
							
							df_update_option(THEME_NAME."_aweber_keys", $keys);
							df_update_option($value['id'], $_REQUEST[$value['id']]);
						}

					}
					
					if($value['type']!="checkbox" && $value['type']!="aweber_input") {
						df_update_option($value['id'],$_REQUEST[$value['id']]); 
					}
				} elseif(!in_array($value['type'], $nonsavable_types) && isset($value['id'])){
					if($value['type']!="aweber_input") {
						df_delete_option( $value['id'], true ); 
					}
				}

				if($value['type']=='add_text') {
					$old_val = $_REQUEST[ $value['id'].'s' ];
					$old_val = explode( "|*|", $old_val );
					
					if (!in_array($_REQUEST[ $value['id'] ], $old_val)) {
						df_update_option( $value['id'].'s', $_REQUEST[ $value['id'].'s' ].sanitize_title($_REQUEST[ $value['id'] ])."|*|" ); 
					}
					
				}
			}
			
		}		
	} 

	global $DifferentThemesManagementSettings;
	//save all data
	update_option('DifferentThemesManagementSettings',$DifferentThemesManagementSettings);
	theme_configuration();

	die();
}


/* -------------------------------------------------------------------------*
 * 							SIDEBAR GENERATOR								*
 * -------------------------------------------------------------------------*/
 
function df_update_sidebar() {
	$updateRecordsArray = $_POST['recordsArray'];
	$last = array_pop($updateRecordsArray);
	$updateRecordsArray = implode ("|*|", $updateRecordsArray)."|*|".$last."|*|";
	df_update_option( THEME_NAME."_sidebar_names", $updateRecordsArray, true);
	print $updateRecordsArray;
}
function df_delete_sidebar() {
	$sidebar_name = $_POST['sidebar_name']."|*|";
	$sidebar_names = df_get_option( THEME_NAME."_sidebar_names" );
	$sidebar_names = explode( "|*|", $sidebar_names );
	$sidebar_name = explode( "|*|", $sidebar_name );
	$result = array_diff($sidebar_names, $sidebar_name);
	$last = array_pop($result);
	$update_sidebar = implode ("|*|", $result)."|*|".$last."|*|";
	df_update_option( THEME_NAME."_sidebar_names", $update_sidebar, true);
	print $update_sidebar;
}
function df_edit_sidebar() {
	$new_sidebar_name = sanitize_title($_POST['sidebar_name']);
	$old_name = $_POST['old_name'];

	$sidebar_names = df_get_option( THEME_NAME."_sidebar_names" );
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
	
	df_update_option( THEME_NAME."_sidebar_names", $update_sidebar, true);
	print $update_sidebar;
}



/* -------------------------------------------------------------------------*
 * 							DYNAMIC CSS LOAD								*
 * -------------------------------------------------------------------------*/
 
function df_dynamic_css() {
  	require_once(get_template_directory().'/css/dynamic-css.php');
  	require_once(get_template_directory().'/css/fonts.php');
  	die();
}
/* -------------------------------------------------------------------------*
 * 							DYNAMIC JS LOAD								*
 * -------------------------------------------------------------------------*/
 
function df_dynamic_js() {
  	require_once(get_template_directory().'/js/scripts.php');
  	die();
}

/* -------------------------------------------------------------------------*
 * 						LOAD NEXT IMAGE IN GALLERY							*
 * -------------------------------------------------------------------------*/
 
function df_load_next_image(){
	$g = $_POST['gallery_id'];
	$next_image = $_POST['next_image'];

	$galleryImages = get_post_meta ($g, THEME_NAME."_gallery_images", true );  
	$imageIDs = explode(",",$galleryImages);

	$image = get_post_thumb(false, 916, 0, false, wp_get_attachment_url($imageIDs[$next_image-1]));
	echo esc_url($image['src']);


	die();
}

/* -------------------------------------------------------------------------*
 * 							LIGHTBOX GALLERY								*
 * -------------------------------------------------------------------------*/
 
function DF_lightbox_gallery(){
	$g = $_POST['gallery_id'];
	$next_image = $_POST['next_image'];

	$galleryImages = get_post_meta ( $g, THEME_NAME."_gallery_images", true ); 
	$imageIDs = explode(",",$galleryImages);

	//get gallery category info
	$categories = get_the_terms($g, DF_POST_GALLERY.'-cat');
	$categoriesNew = array();
	$i=0;
	foreach ($categories as $category) {
		$categoriesNew[$i]['term_id'] = $category->term_id;
		$categoriesNew[$i]['name'] = $category->name;
		$i++;
	}
	$categories = $categoriesNew;
	$count = count($categories)-1;
	$randID = rand(0,$count);
	$c=0;
	$images = array();
	$thumbs = array();

	foreach($imageIDs as $id) {
		if($id) {
			$file = wp_get_attachment_url($id);
			$image = get_post_thumb(false, 916, 0, false, $file);
			$images[] = $image['src'];
			$thumb = get_post_thumb(false, 77, 77, false, $file);
			$thumbs[$c] = $thumb['src'];
			$c++;
		}
	}


	$thispost = get_post( $g );
	$content = do_shortcode($thispost->post_content);
	
	$return = array();
	$return['next'] = $images[$next_image-1];
	$return['thumbs'] = $thumbs;
	$return['title'] = get_the_title($g);
	$return['content'] = $content;
	$return['total'] = $c;
	$return['cat'] = $categories[$randID]['name'];
	$return['term_id'] = $categories[$randID]['term_id'];
	$return['color'] = df_title_color($categories[$randID]['term_id'], 'category', false);	
	$return['cat_url'] = get_term_link($categories[$randID]['term_id'], DF_POST_GALLERY.'-cat');


	echo json_encode($return);
	die();
}


/* -------------------------------------------------------------------------*
 * 									AWeber									*
 * -------------------------------------------------------------------------*/
 
function df_aweber_form() {
		
	$keys = df_get_option(THEME_NAME."_aweber_keys"); 
	if(isset($_POST["email"]) && is_email($_POST["email"])){
		$email = sanitize_email($_POST["email"]);
	}
	if(isset($_POST["u_name"])){
		$u_name = esc_textarea($_POST["u_name"]);
	}
	if(isset($_POST["listID"])){
		$listID = df_remove_html_slashes($_POST["listID"]);
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
 
function df_contact_form() {

	if(isset($_POST["post_id"])){
		$mail_to = sanitize_email(get_post_meta ($_POST["post_id"],  "_".THEME_NAME."_contact_mail", true )); 
	}

	if(isset($_POST["email"]) && is_email($_POST["email"])){
		$email = sanitize_email($_POST["email"]);
	}
	if(isset($_POST["u_name"])){
		$u_name = esc_textarea($_POST["u_name"]);
	}
	if(isset($_POST["message"])){
		$message = stripslashes(esc_textarea(htmlspecialchars_decode($_POST["message"])));
	}

	if(isset($_POST["url"])){
		$url = esc_textarea($_POST["url"]);
	}
	
	$ip = $_SERVER['REMOTE_ADDR'];

	
	if(isset($_POST["form_type"])) {	
		
		$subject = ( esc_html__( 'From' , THEME_NAME ))." ".get_bloginfo('name')." ".( esc_html__( 'Contact Page' , THEME_NAME ));
				
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
<?php  esc_html_e( 'Message:' , THEME_NAME );?> <?php echo nl2br($message);?>
<div style="padding-top:100px;">
<?php esc_html_e( 'Name:' , THEME_NAME );?> <?php echo esc_html__($u_name);?><br/>
<?php esc_html_e( 'Url:' , THEME_NAME );?> <?php echo esc_url($url);?><br/>
<?php esc_html_e( 'E-mail:' , THEME_NAME );?> <?php echo sanitize_email($email);?><br/>
<?php esc_html_e( 'IP Address:' , THEME_NAME );?> <?php echo esc_html__($ip);?><br/>
</div>
<?php
		$message = ob_get_clean();
		wp_mail($mail_to,$subject,$message,$headers);
			
	}
	 
	die();

}
add_action('wp_ajax_df_rating_system', 'df_rating_system');
add_action('wp_ajax_nopriv_df_rating_system', 'df_rating_system'); 

add_action('wp_ajax_df_dynamic_js', 'df_dynamic_js');
add_action('wp_ajax_nopriv_df_dynamic_js', 'df_dynamic_js'); 

add_action('wp_ajax_df_dynamic_css', 'df_dynamic_css');
add_action('wp_ajax_nopriv_df_dynamic_css', 'df_dynamic_css'); 

add_action('wp_ajax_df_update_slider', 'update_df_slider');
add_action('wp_ajax_df_update_homepage', 'df_update_homepage');


add_action('wp_ajax_DF_setPostLike', 'DF_setPostLike');
add_action('wp_ajax_nopriv_DF_setPostLike', 'DF_setPostLike');

add_action('wp_ajax_nopriv_df_management_save', 'df_management_save');
add_action('wp_ajax_df_management_save', 'df_management_save');


add_action('wp_ajax_df_update_sidebar', 'df_update_sidebar');
add_action('wp_ajax_df_delete_sidebar', 'df_delete_sidebar');
add_action('wp_ajax_df_edit_sidebar', 'df_edit_sidebar');
add_action('wp_ajax_df_load_next_image', 'df_load_next_image');
add_action('wp_ajax_nopriv_df_load_next_image', 'df_load_next_image');
add_action('wp_ajax_DF_lightbox_gallery', 'DF_lightbox_gallery');
add_action('wp_ajax_nopriv_DF_lightbox_gallery', 'DF_lightbox_gallery');


add_action('wp_ajax_df_aweber_form', 'df_aweber_form');
add_action('wp_ajax_nopriv_df_aweber_form', 'df_aweber_form');
add_action('wp_ajax_nopriv_df_contact_form', 'df_contact_form');
add_action('wp_ajax_df_contact_form', 'df_contact_form');
?>
<?php
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

if (!class_exists("Shiba_Media_Library_Helper")) :

class Shiba_Media_Library_Helper {
	
	function admin_init() {
		global $shiba_mlib;

		add_action('admin_head', array(&$this,'mlib_header'));
		// Add Insert into Post button
		add_filter('attachment_fields_to_edit', array(&$this, 'add_insert_into_post_button'), 10, 2);

		add_filter('current_screen', array(&$this, 'current_screen') );
		add_filter('wp_redirect', array(&$this,'gallery_redirect'), 10, 2);

	}

	function current_screen($screen) {
		global $shiba_mlib;
		
		switch ($screen->id) {
		case 'upload':
			require_once(SHIBA_MLIB_DIR.'/shiba-mlib-upload.php');
			if (class_exists("Shiba_Media_Library_Upload"))
				$shiba_mlib->upload = new Shiba_Media_Library_Upload();	
//		add_filter('post_updated_messages', array(&$this,'gallery_updated_messages'));
			break;
		case 'edit-gallery':
			require_once(SHIBA_MLIB_DIR . '/shiba-mlib-manage.php');
			if (class_exists("Shiba_Media_Library_Manage")) 
				$shiba_mlib->manage = new Shiba_Media_Library_Manage();	
			break;
		case 'post':
			if (isset($_GET['post'])) {
				$post_id = abs($_GET['post']);
				$post_type = get_post_type($post_id);
				if ($post_type != 'gallery') break;
			}
		case 'gallery':
			require_once(SHIBA_MLIB_DIR . '/shiba-mlib-add.php');
			if (class_exists("Shiba_Media_Library_Add")) 
				$shiba_mlib->add = new Shiba_Media_Library_Add();	
			break;
		}				
		return $screen;
	}

	// Captures delete permanently link from new gallery screen
	function gallery_redirect($location, $status) {
		if (isset($_GET['action']) && isset($_GET['post']) && ($_GET['action'] == 'delete') && 
			strpos($location, 'edit.php?post_type=attachment&deleted=1') !== FALSE) {
			// redirect to http referer
			$referer = wp_get_referer();
			$location = remove_query_arg( array('trashed', 'untrashed', 'deleted', 'ids', 'posted'), $referer );
			$location = add_query_arg('message', 12, $location);
		}
		return $location;
	}	 

		
	function add_pages() {
		global $shiba_mlib;
		
		$url = 'edit.php?post_type=gallery'; //menu_page_url('gallery');
		// Add a new submenu under Gallery:
		//$shiba_mlib->options_page = add_submenu_page( $url, 'Options', 'Options', 'install_plugins', 'shiba_media_options', array(&$this,'media_options_page') );

	}


	function media_options_page() {
		include('shiba-mlib-options.php');
	}

	function mlib_header() {
		global $post_type;
		// icons are 16x16
		?>
		<style>
		<?php if (isset($_GET['post_type']) && ($_GET['post_type'] == 'gallery') || ($post_type == 'gallery')) : ?>
		#icon-edit { background:transparent url('<?php home_url();?>/wp-admin/images/icons32.png') no-repeat -251px -5px; }
		.column-id { width: 50px; }
		.column-new_icon { width: 70px; text-align: center; }
		.column-images { width: 70px; text-align: center; }
		.column-title { width: 25%; }
		.fixed .column-date { width: 80px; }		
		.fixed .column-parent { width: 20%; }
		.column-gallery_categories, .column-gallery_tags { width: 15%; }
		<?php endif; ?>
		
		#adminmenu #menu-posts-gallery div.wp-menu-image{background:transparent url('<?php home_url();?>/wp-admin/images/menu.png') no-repeat scroll -121px -33px;}
		#adminmenu #menu-posts-gallery:hover div.wp-menu-image,#adminmenu #menu-posts-gallery.wp-has-current-submenu div.wp-menu-image{background:transparent url('<?php home_url();?>/wp-admin/images/menu.png') no-repeat scroll -121px -1px;}		
        </style>
        <?php
	}
	
	// Javascript for processing the added Media Library bulk-action form in the Media>> Library screen
	function upload_header() {
	?>
	<style>
	.column-new_icon { width: 70px; text-align: center; }
	.column-title, .column-new_title { width: 25%; }
	.fixed .column-date { width: 80px; }
	.upload-php .fixed .column-parent { width: 20%; }
	</style>
	
	<script type="text/javascript">
	<!--
	// get_selected_media(document.posts-filter.list)
	
	function addNewArg(name, value) {
		var newArg = document.createElement("input");
		newArg.type = "hidden";
		newArg.name = name;
		newArg.value = value;
//		newArg.id = name;
		return newArg;
	}
	
	function addMediaActions(mediaPlusForm) {
		// If action is remove then unset doaction so that it does not get caught in upload.php
		var action = document.getElementById('mlib_action').value;
		if ((action == 'remove') || (action == 'set_tags') || (action == 'add_tags')) {
			var ref = document.getElementsByName('_wp_http_referer');
			for (var i = 0; i < ref.length; i++) {			
				if (ref[i].form.id == mediaPlusForm.id) {
					mediaPlusForm.removeChild(ref[i]);	
				}
			}	
			document.getElementById('mlib_doaction').name="shiba_doaction";		
			// For 3.1 need to rename action and action2
			document.getElementById('mlib_action').name = "shiba_action";
		}
	}	
	
	function redirectPage(mediaPlusForm) {
		// Redirect to previous page by adding previous mime_type and detached state
		var hasType = location.href.indexOf('post_mime_type');
		if (hasType >= 0) {
			var sPos = location.href.indexOf('=', mimeType);
			var ePos = location.href.indexOf('&', sPos);
			
			if (ePos >= 0) {
				var mimeStr = location.href.substring(sPos+1, ePos);
			} else {
				var mimeStr = location.href.substring(sPos+1);
			}
	
			mediaPlusForm.appendChild(addNewArg('post_mime_type', mimeStr));
		}
		
		if (location.href.indexOf('detached') >= 0) {
				mediaPlusForm.appendChild(addNewArg('detached', '1'));
		}
	}

	function getSelectedMedia(mediaPlusForm, wordpressForm) {
		var formElements = document.getElementById(wordpressForm).elements;
		for (i = 0; i < formElements.length; i++) {
			if (formElements[i].name == "media[]" && formElements[i].checked) {
				mediaPlusForm.appendChild(addNewArg("media[]", formElements[i].value));
			}
		}		
	}

	function processMediaPlusForm(wordpressForm) {
		var mediaPlusForm=document.getElementById('shiba-mlib-form');
		getSelectedMedia(mediaPlusForm, wordpressForm);
		addMediaActions(mediaPlusForm);
		redirectPage(mediaPlusForm);
		}
	
	function processGalleryForm(galleryForm) {
		var mediaPlusForm=document.getElementById(galleryForm);
		addMediaActions(mediaPlusForm);
	}	

	function processEditGalleryForm(galleryForm) {
		var galleryEditForm=document.getElementById(galleryForm);
		var postName = document.getElementById('editable-post-name').innerHTML;
		galleryEditForm.appendChild(addNewArg("post_name", postName));
	}	

	//-->
	</script>
	<?php
	}
		
	function add_insert_into_post_button($form_fields, $post) {
		$attachment_id = $post->ID; $filename = basename( $post->guid );
		$calling_post_id = 0;
		if ( isset( $_GET['post_id'] ) )
			$calling_post_id = absint( $_GET['post_id'] );
		elseif ( isset( $_POST ) && count( $_POST ) ) // Like for async-upload where $_GET['post_id'] isn't set
			$calling_post_id = $post->post_parent;

		$post_type = get_post_type($calling_post_id);
		$insert_media_button_array = apply_filters('shiba_insert_media_button', array('post','page'));
		if ($calling_post_id && in_array($post_type, $insert_media_button_array))
			$send = "<input type='submit' class='button' name='send[$attachment_id]' value='" . esc_attr__( 'Insert into Post' ) . "' />";
		else return $form_fields; //$send = '';	
		if ( current_user_can( 'delete_post', $attachment_id ) ) {
			if ( !EMPTY_TRASH_DAYS ) {
				$delete = "<a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __( 'Delete Permanently', THEMEDOMAIN ) . '</a>';
			} elseif ( !MEDIA_TRASH ) {
				$delete = "<a href='#' class='del-link' onclick=\"document.getElementById('del_attachment_$attachment_id').style.display='block';return false;\">" . __( 'Delete', THEMEDOMAIN ) . "</a>
				 <div id='del_attachment_$attachment_id' class='del-attachment' style='display:none;'>" . sprintf( __( 'You are about to delete <strong>%s</strong>.', THEMEDOMAIN ), $filename ) . "
				 <a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='button'>" . __( 'Continue', THEMEDOMAIN ) . "</a>
				 <a href='#' class='button' onclick=\"this.parentNode.style.display='none';return false;\">" . __( 'Cancel', THEMEDOMAIN ) . "</a>
				 </div>";
			} else {
				$delete = "<a href='" . wp_nonce_url( "post.php?action=trash&amp;post=$attachment_id", 'trash-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __( 'Move to Trash', THEMEDOMAIN ) . "</a>
				<a href='" . wp_nonce_url( "post.php?action=untrash&amp;post=$attachment_id", 'untrash-attachment_' . $attachment_id ) . "' id='undo[$attachment_id]' class='undo hidden'>" . __( 'Undo', THEMEDOMAIN ) . "</a>";
			}
		} else {
			$delete = '';
		}

		$thumbnail = '';
		if ( (strpos($post->post_mime_type, 'image') !== FALSE) && $calling_post_id &&  current_theme_supports( 'post-thumbnails') &&  get_post_thumbnail_id( $calling_post_id ) != $attachment_id ) {
			$ajax_nonce = wp_create_nonce( "set_post_thumbnail-$calling_post_id" );
			$thumbnail = "<a class='wp-post-thumbnail' id='wp-post-thumbnail-" . $attachment_id . "' href='#' onclick='WPSetAsThumbnail(\"$attachment_id\", \"$ajax_nonce\");return false;'>" . esc_html__( "Use as featured image" ) . "</a>";
		}
		
		$form_fields['buttons'] = array('tr' => "\t\t<tr class='submit'><td></td><td class='savesend'>$send $thumbnail $delete</td></tr>\n");
		return $form_fields;		
	}


} // end Shiba_Media_Library_Helper class
endif;


?>
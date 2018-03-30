<?php

if (!function_exists('mix_get_gallery')) {
	function mix_get_gallery($id = NULL)
	{
		// by id
		if ($id != NULL) {
			$args = array(
				'post_type'   => 'attachment',
				'post_status' => 'any',
				'post_parent' => $id,
				'orderby'     => 'menu_order ID',
				'order'       => 'ASC DESC',
				'posts_per_page' => -1
			);
			$q = new WP_Query($args);
			$posts = $q->get_posts();
			wp_reset_postdata();
			unset($q);
			return $posts;
		}
		// other
		global $post;
		//if (empty($post)) {$post = get_theme_option("default_gallery_id");}
		$galleries = mix_get_galleries();
		if (isset($post) && $post->post_type == 'gallery'){
			$gallery = mix_get_gallery($post->ID);
			$gallery_id = $post->ID;
		}else{
			$def_gallery = get_theme_option("default_gallery_id");
			$gallery = ($def_gallery == 0)?NULL:mix_get_gallery($def_gallery);
			$gallery_id = -1;
		}
		
		if (!$gallery) {
			$gallery = count($galleries) > 0?mix_get_gallery($galleries[0]):NULL;
		}
		
		return array($galleries, $gallery, $gallery_id);
	}
}

if (!function_exists('mix_get_galleries')) {
	function mix_get_galleries()
	{
		return get_posts(array(
			'offset'          => 0,
			'orderby'         => 'post_date',
			'order'           => 'ASC',
			'post_type'       => 'gallery',
			'post_status'     => 'publish',
			'numberposts'     => -1
		));
	}
}

if (!function_exists('mix_get_galleries_options')) {
	function mix_get_galleries_options()
	{
		$galleries = mix_get_galleries();
		$data = array();
		foreach ($galleries as $gallery) {
			$data[$gallery->ID] = $gallery->post_title;
		}
		return $data;
	}
}


abstract class Meta_Box
{
	public function __construct($id, $title, $page, $priority = 'normal')
	{
		global $post;
		
		$allowed_statuses = array('draft', 'publish');
		if (in_array($post->post_status, $allowed_statuses)) {
			add_meta_box($id, $title, array(&$this, 'render_func'), $page, $priority);
		}
	}
	
	abstract public function render_func($args);
}

/**
* Gallery Meta Box
*/
class Gallery_Meta_Box extends Meta_Box
{
	
	public function render_func($post)
	{
		echo '<div id="gallery-manager-controls">
			<div class="control">
				<a title="Add Image" class="add_image_popup" href="#">
					<img alt="Add Image" src="'.get_template_directory_uri().'/core/admin/img/plus.png" class="add_image_icon"> Add Image
				</a>
			</div>
			<div class="control">
				<a title="Sort Images" class="sort_images_popup" href="#">
					<img alt="Sort Images" src="'.get_template_directory_uri().'/core/admin/img/sort.png" class="sort_images_icon"> Sort Images
				</a>
			</div>
		</div><div class="post_gallery_images">';
		$attachments = mix_get_gallery($post->ID);
		foreach ($attachments as $attach) {
		
			$photoTitle  = get_post_meta($post->ID, "att_attr_title_".$attach->ID, true);
			$photoCaption  = get_post_meta($post->ID, "att_attr_caption_".$attach->ID, true);
			
			if ($photoTitle !== "" || $photoCaption !== "") {
				$db = "display:block;";
			}
		
			$thumb_url = wp_get_attachment_image_src($attach->ID, 'gallery-thumb');
				echo '<div class="gallery_image"><div class="gi_delete" data-id="'.$attach->ID.'"><img src="'.get_template_directory_uri().'/core/admin/img/delete2.png" alt=""></div><div class="gi_addtitle" style="'.$db.'" attach_id="'.$attach->ID.'"><img src="'.get_template_directory_uri().'/core/admin/img/addtitle.png" alt=""></div><img attach_id="'.$attach->ID.'" class="set-title-and-caption" src="'.aq_resize($thumb_url[0], 120, 80, true, true, true).'" alt="" /></div>';
				
				unset($db);
		}
		echo "</div><script>
			var post_id = ".$post->ID.";
		</script>";
	}
}


add_action('wp_ajax_mix_ajax_gallery_action', 'mix_gallery_callback');
function mix_gallery_callback()
{
	$action = esc_attr($_POST['type']);
	switch ($action) {
		case 'image_delete':
			$id = (int)esc_attr($_POST['id']);
			wp_delete_attachment($id);
			die(json_encode(array(
				'result' => true
			)));
			break;
		case 'get_images':
			$attachments = mix_get_gallery((int)esc_attr($_POST['id']));
			foreach ($attachments as $attach) {
			
				$photoTitle  = get_post_meta(esc_attr($_POST['id']), "att_attr_title_".$attach->ID, true);
				$photoCaption  = get_post_meta(esc_attr($_POST['id']), "att_attr_caption_".$attach->ID, true);
			
				if ($photoTitle !== "" || $photoCaption !== "") {
					$db = "display:block;";
				}
			
				$thumb_url = wp_get_attachment_image_src($attach->ID, 'gallery-thumb');
				echo '<div class="gallery_image"><div class="gi_delete" data-id="'.$attach->ID.'"><img src="'.get_template_directory_uri().'/core/admin/img/delete.png" alt=""></div><div class="gi_addtitle" style="'.$db.'" attach_id="'.$attach->ID.'"><img src="'.get_template_directory_uri().'/core/admin/img/addtitle.png" alt=""></div><img attach_id="'.$attach->ID.'" class="set-title-and-caption" src="'.aq_resize($thumb_url[0], 120, 80, true, true, true).'" alt="" /></div>';
				
				unset($db);
				
			}
			exit;
			break;
	}
	
}

function nocarret($str) {
	$str = str_replace("\r","<br>",$str);
	$str = str_replace("\n","",$str);
	return $str;
}

#set new title & caption
if (isset($_POST['save_new_title'])) {
    if (is_admin()) {
        $attach_id = absint($_POST['attach_id']);
        $post_id = absint($_POST['post_id']);
        $galleryItemTitle = nocarret(esc_attr($_POST['galleryItemTitle']));
        $galleryItemCaption = nocarret(esc_attr($_POST['galleryItemCaption']));

        update_post_meta($post_id, "att_attr_title_" . $attach_id, $galleryItemTitle);
        update_post_meta($post_id, "att_attr_caption_" . $attach_id, $galleryItemCaption);
    }
}

/**
* end of file
*/
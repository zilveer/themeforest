<?php


if (!class_exists('PostGalleryPlusAdd')) {

	class PostGalleryPlusAdd {

      var $defaults = array(
         "post_size" => "m",
         "show" => "all"
      );

		function PostGalleryPlusAdd($args = array()) {
			$this->register($args);
		}

		function register($args = array()) {
			$defaults = array(
				'label' => 'Add/Edit Photos',
				'id' => 'postgalleryplusadd',
				'post_type' => 'dt_gallery_plus',
				'priority' => 'low',
			);

         if ( isset($_GET['post']) )
         $this->post_id=$_GET['post'];
         else $this->post_id = 0;
         //if (!$this->post_id) $this->post_id=the_ID();

         if (isset($args['post']))
         if ($args['post']) $this->post_id = $args['post'];

			$args = wp_parse_args($args, $defaults);

			// Create and set properties
			foreach($args as $k => $v) {
				$this->$k = $v;
			}

//			add_action('add_meta_boxes', array($this, 'add_metabox'));
//			add_action('save_post', array($this, 'save_page'));
			
		}
		
		function add_metabox() {   
			add_meta_box("{$this->post_type}-{$this->id}", __($this->label), array($this, 'thumbnail_meta_box'), $this->post_type, 'normal', $this->priority);
		}

		function thumbnail_meta_box() {
			global $post;
			$thumbnail_id = get_post_meta($post->ID, "{$this->post_type}_{$this->id}_thumbnail_id", true);
			echo $this->post_thumbnail_html($thumbnail_id);
		}

		function add_attachment_field($form_fields, $post) {
		}

		function has_post_thumbnail($post_type, $id, $post_id = null) {
			if (null === $post_id) {
				$post_id = get_the_ID();
			}

			if (!$post_id) {
				return false;
			}

			return get_post_meta($post_id, "{$post_type}_{$id}_thumbnail_id", true);
		}

		function the_post_thumbnail($post_type, $id, $post_id = null, $size = 'post-thumbnail', $attr = '') {
		}

		function get_post_thumbnail_id($post_type, $id, $post_id) {
			return get_post_meta($post_id, "{$post_type}_{$id}_thumbnail_id", true);
		}

		function post_thumbnail_html($thumbnail_id = NULL) {
			global $content_width, $_wp_additional_image_sizes, $post_ID;

         $nonce= wp_create_nonce  ('my-nonce');
         
         $myterms = get_terms('dt_portfolio_cat');
         
         $content='
    
<script src="'.get_template_directory_uri().'/js/upload/swfobject.js"></script>
<script src="'.get_template_directory_uri().'/js/upload/jquery.uploadify.v2.1.0.js"></script>
<script src="'.get_template_directory_uri().'/js/jquery.ui.js"></script>
<script src="'.get_template_directory_uri().'/js/admin_gallery_plus.js"></script>
<link rel="stylesheet" href="'.get_template_directory_uri().'/js/upload/uploadify.css" /> 
<link rel="stylesheet" href="'.get_template_directory_uri().'/css/admin_gallery.css" />
            
<input type="hidden" name="nonce_portf" value='.$nonce.' />

<input type="hidden" name="album" value='.$this->post_id.' />
            
<div style="float:right; font-weight: bold; font-size: 14px; display: none;" id="saving_str">Saving....</div>
            
<div id="fileQueue" style="margin-bottom: 5px;"></div>
<input type="file" class="upload_multiple" id="dt_photo_upload" />

<div id="gallery_photos">';

ob_start();
gallery_print_photos();
$content .= ob_get_clean();

$content .= '</div>

            ';

			return $content;
		}
		
		function get_post_option($name)
		{
		   global $post;
		   
         if (!$this->post_id)
            $this->post_id=$post->ID;
            
		   $v = get_post_meta($this->post_id, '_option3_'.$name, true);
		   if (strlen($v) == 0)
		   {
		      if (!isset($this->defaults[$name])) return "";
		      return $this->defaults[$name];
		   }
		   return $v;
		}
		
		function get_photos()
		{
		   $ret = $this->get_post_option("photos");
		   $ret = unserialize($ret);
		   if (!is_array($ret))
		      $ret = array();
		   $ret = (array)$ret;
		   
		   $i = 1;
		   
		   foreach ($ret as $k => &$im)
		   {
		      $im["id"] = $i++;
		      $im["image"] = get_template_directory_uri()."/cache/".$im["file"];
		      $im["fname"] = $fname = dirname(__FILE__)."/../cache/".$im["file"];
		      if (!file_exists($fname))
		         unset($ret[$k]);
		      $size = @getimagesize($fname);
		      if (!$size[0] || !$size[1])
		         unset($ret[$k]);
		      $im["size"] = $size;
		      $im["url"] = get_template_directory_uri().'/thumb.php?src=cache/'.$im["file"].'&amp;w=100&amp;h=80&amp;zc=1';
		      if (!$im["s"]) $im["s"] = "m";
		      //$im["desc"] = htmlspecialchars($im["desc"]);
		   }
		   
		   return $ret;
		}
		
		function save_photos($photos)
		{
		   foreach ($photos as &$im)
		   {
		      unset($im["url"]);
		      unset($im["image"]);
		      unset($im["size"]);
		      unset($im["fname"]);
		   }
		   $photos = serialize($photos);
		   $this->set_post_option("photos", $photos);
		}
		
		function delete_photo($pid)
		{
		   $photos = $this->get_photos();
		   foreach ($photos as $k => &$im)
		   {
		      if ($im["id"] == $pid)
		      {
		         @unlink($im["fname"]);
		         unset($photos[$k]);
		      }
		   }
		   $this->save_photos($photos);
		}
		
		function delete_photos($pids)
		{
		   $photos = $this->get_photos();
		   foreach ($photos as $k => &$im)
		   {
		      foreach ($pids as $pid)
		      {
		         if ($im["id"] == $pid)
		         {
		            @unlink($im["fname"]);
		            unset($photos[$k]);
		         }
		      }
		   }
		   $this->save_photos($photos);
		}
		
		function add_photo($photo)
		{
		   $photos = $this->get_photos();
		   $photos[] = $photo;
		   $this->save_photos($photos);
		}

		function set_post_option($name, $val)
		{
         if (!$this->post_id)
            $this->post_id=$post->ID;
            
         //echo "set for ".$this->post_id." ".$name."=".$val;
            
		   add_post_meta($this->post_id, '_option3_'.$name, $val, true);
		   update_post_meta($this->post_id, '_option3_'.$name, $val);
		}
		
		function save_page($post_id) {
		
		
		if ( !isset($_POST['nonce_portf']) ) return;
		
           if ( !wp_verify_nonce( $_POST['nonce_portf'], 'my-nonce' )) {
             return $post_id;
           }
           
           $this->post_id=$_POST['post_ID'];

           if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
             return $post_id;

           if ( 'page' == $_POST['post_type'] ) {
             if ( !current_user_can( 'edit_page', $post_id ) )
               return $post_id;
           } else {
               return $post_id;  
           }
           
           $this->set_post_option('show', $_POST['show_type_portf']);
           
           $_POST['show_portf'] = (array)$_POST['show_portf'];
           foreach (array('only', 'except') as $t)
           {
              $vals = array();
              
              $_POST['show_portf'][$t] = (array)$_POST['show_portf'][$t];
              
              foreach ($_POST['show_portf'][$t] as $o)
              {
                 if ($o > 0)
                 {
                    $vals[] = $o;
                 }
              }
              
              $vals = implode(',', $vals);
              $this->set_post_option('show_'.$t, $vals);
           }

           return 1;
		}

	}
}

global $postgalleryplusadd;
$postgalleryplusadd=new PostGalleryPlusAdd();

add_action('wp_ajax_gallery_plus_add_photo', 'gallery_plus_add_photo');
function gallery_plus_add_photo() {
   
   global $postgalleryplusadd;
   $postgalleryplusadd->post_id = $_REQUEST['album'];
   
   $postgalleryplusadd->add_photo(array(
      "file" => $_POST["photo"]
   ));
   
   echo "ok";
   
	die();
}

function gallery_print_photos()
{
   global $postgalleryplusadd;
   
   $i = 1;
   
   $photos = $postgalleryplusadd->get_photos();
   
   //echo 'Photos count: '.count($photos);
   
   echo '<div class="cont" id="g_cont">
   
   ';
   
   if (count($photos) > 0) 
   {
      echo '
         <table border="0" cellpadding="0" cellspacing="0">
            <td valign="middle" align="left" width="20" height="30">
               <input type="checkbox" value="1" class="sel_all" />
            </td>
            <td align="center" width="100"> 
               Photo
            </td>
            <td align="center" width="400"> 
               Description
            </td>
            <td>&nbsp;</td>
            <td align="center" width="40"> 
               Size
            </td>
            <td valign="middle" align="right" width="20"> 
               
            </td>
         </table>
      ';
   }
   
   foreach ($photos as $im)
   {
      echo '
      <div class="photo" photo="'.$im["id"].'" id="photo-'.$im["id"].'">
         <table border="0" cellpadding="0" cellspacing="0">
            <td valign="middle" align="left" width="20">
               <input type="checkbox" value="'.$im["id"].'" class="g_del_photo" />
            </td>
            <td valign="top" width="100"> 
               <img src="'.$im["url"].'" width="100" height="80" />
            </td>
            <td valign="top" width="400"> 
               <textarea>'.( isset($im["desc"]) ? $im["desc"] : "").'</textarea>
            </td>
            <td>&nbsp;</td>
            <td valign="middle" align="left" width="40"> 
               ';
               foreach (explode(" ", "s m l") as $s)
                  echo '
                     <label>
                     <input type="radio" name="size_'.$im["id"].'" forphoto="'.$im["id"].'" value="'.$s.'" class="set_size" '.($s == $im["s"] ? ' checked="checked"' : '').' />
                     '.strtoupper($s).'
                     </label><br />
                  ';
               echo '
            </td>
            <td valign="middle" align="right" width="20"> 
               <a href="#" class="del" title="Delete this photo"></a>
            </td>
         </table>
      </div>
      ';
   }
   
   if (count($photos) > 0)
   {
      echo '<input type="button" class="button-primary" id="gallery_plus_del_photos" value="Delete selected photos" />';
   }
   
   echo '
   </div>';
}

add_action('wp_ajax_gallery_plus_get_photos', 'gallery_plus_get_photos');
function gallery_plus_get_photos() {
   
   global $postgalleryplusadd;
   $postgalleryplusadd->post_id = $_REQUEST['album'];
   
   gallery_print_photos();
   
	die();
}

add_action('wp_ajax_gallery_plus_delete_photo', 'gallery_plus_delete_photo');
function gallery_plus_delete_photo() {
   
   global $postgalleryplusadd;
   $postgalleryplusadd->post_id = $_REQUEST['album'];
   
   $p = (array)$_REQUEST["photo"];
   $postgalleryplusadd->delete_photos($p);
   
   
	die();
}

add_action('wp_ajax_gallery_plus_save_photos', 'gallery_plus_save_photos');
function gallery_plus_save_photos() {
   
   global $postgalleryplusadd;
   $postgalleryplusadd->post_id = $_REQUEST['album'];
   
   $photos = $postgalleryplusadd->get_photos();
   
   $_REQUEST["photos"] = (array)$_REQUEST["photos"];
   
   foreach ($_REQUEST["photos"] as $pid => $attrs)
   {
      foreach ($photos as &$im)
      {
         if ( $im["id"] == $pid )
         {
            $im["desc"] = htmlspecialchars(stripslashes($attrs["desc"]));
         }
      }
   }
   
   $postgalleryplusadd->save_photos($photos);
   
   print_r($photos);
   
   echo "ok";
   
	die();
}

add_action('wp_ajax_gallery_plus_set_photos_order', 'gallery_plus_set_photos_order');
function gallery_plus_set_photos_order() {
   
   global $postgalleryplusadd;
   $postgalleryplusadd->post_id = $_REQUEST['album'];
   
   $init_photos = $postgalleryplusadd->get_photos();
   $photos = array();
   
   $order = (array)$_REQUEST["photo"];
   foreach ($order as $pid)
   {
      foreach ($init_photos as $im)
      {
         if ($im["id"] == $pid)
         {
            $photos[] = $im;
         }
      }
   }
   
   $postgalleryplusadd->save_photos($photos);
   
	die();
}

add_action('wp_ajax_gallery_plus_set_size', 'gallery_plus_set_size');
function gallery_plus_set_size() {
   
   global $postgalleryplusadd;
   $postgalleryplusadd->post_id = $_REQUEST['album'];
   
   $init_photos = $postgalleryplusadd->get_photos();
   
   $pid = $_REQUEST["photo"];
   foreach ($init_photos as &$im)
   {
      if ($im["id"] == $pid)
      {
         $im["s"] = $_POST["size"];
      }
   }
   
   print_r($init_photos);
   
   $postgalleryplusadd->save_photos($init_photos);
   
	die();
}

?>

<?php


if (!class_exists('PostGalleryPlus')) {

	class PostGalleryPlus {

      var $defaults = array(
         "post_size" => "m",
         "show" => "all",
		 "albums_3p"	=>''
      );

		function PostGalleryPlus($args = array()) {
			$this->register($args);
		}

		function register($args = array()) {
			$defaults = array(
				'label' => 'Gallery options',
				'id' => 'postgalleryplus',
				'post_type' => 'page',
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

			add_action('add_meta_boxes', array($this, 'add_metabox'));
			add_action('save_post', array($this, 'save_page'));
			
		}
		
		function add_metabox() {   
			add_meta_box("dt_page_box-gallery", __($this->label), array($this, 'thumbnail_meta_box'), $this->post_type, 'side', $this->priority);
			/*"{$this->post_type}-{$this->id}"*/
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
         
/*         $myterms = get_posts(array(
            "post_type" => "dt_gallery_plus",
            "numberposts" => -1,
         ));
*/		 
		$myterms = get_categories(
			array(
				'type'                     => 'dt_gallery_plus',
				'hide_empty'               => 1,
				'hierarchical'             => 0,
				'taxonomy'                 => 'dt_gallery-category',
				'pad_counts'               => false
			)
		);
         
         //print_r($myterms);
         
         $content='
            
<input type="hidden" name="nonce_portf" value='.$nonce.' />

<input type="hidden" name="nonce" value='.$nonce.' />
            
<p>
	<label for="albums_postsperpage">
		<input type="text" id="albums_postsperpage" name="albums_3p" value="'.$this->get_post_option('albums_3p'). '" size="4"/>
		Posts per page
	</label>
</p>

<p>
Show:<br />

<div class="showhide">
<label><input type="radio" name="show_type_galplus" value="all" '.($this->get_post_option('show') == 'all' ? ' checked="checked"' : '').' /> All</label><br />
</div>

<div class="showhide">
<label><input type="radio" name="show_type_galplus" value="only" '.($this->get_post_option('show') == 'only' ? ' checked="checked"' : '').' /> Only...</label><br />
<div style="margin-left: 20px; margin-bottom: 8px;" class="list">
   ';
   foreach ($myterms as $term)
   {
      $content .= '<label><input type="checkbox" name="show_galplus[only][]" value="'.$term->term_id.'" '.(in_array($term->term_id, explode(",", $this->get_post_option('show_only'))) ? ' checked="checked"' : '').' /> '.$term->name.'</label><br />';
   }
   $content .= '
</div>
</div>

<div class="showhide">
<label><input type="radio" name="show_type_galplus" value="except" '.($this->get_post_option('show') == 'except' ? ' checked="checked"' : '').' /> Except...</label><br />
<div style="margin-left: 20px; margin-bottom: 8px;" class="list">
   ';
   foreach ($myterms as $term)
   {
      $content .= '<label><input type="checkbox" name="show_galplus[except][]" value="'.$term->term_id.'" '.(in_array($term->term_id, explode(",", $this->get_post_option('show_except'))) ? ' checked="checked"' : '').' /> '.$term->name.'</label><br />';
   }
   $content .= '
</div>
</div>
</p>
            ';

			return $content;
		}
		
		function get_post_option($name)
		{
		   global $post;
		   
         if (!$this->post_id)
            $this->post_id=$post->ID;
            
		   $v = get_post_meta($this->post_id, '_option4_'.$name, true);
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
				// заменить на путь к изображениям в папке uploads
		      $im["url"] = get_template_directory_uri().'/thumb.php?src=cache/'.$im["file"].'&amp;w=100&amp;h=80&amp;zc=1';
		   }
		   
		   return $ret;
		}
		
		function save_photos($photos)
		{
		   foreach ($photos as &$im)
		   {
		      unset($im["url"]);
		      unset($im["image"]);
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
            
		   add_post_meta($this->post_id, '_option4_'.$name, $val, true);
		   update_post_meta($this->post_id, '_option4_'.$name, $val);
		}
		
		function save_page($post_id) {
		
		if ( !isset($_POST['nonce_portf']) ) return $post_id;
		
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
           
           $this->set_post_option('show', $_POST['show_type_galplus']);
		   $this->set_post_option('albums_3p', $_POST['albums_3p']);
           
           if(!isset($_POST['show_galplus'])) {
				return 0;
		   }
		   
		   $_POST['show_galplus'] = (array)$_POST['show_galplus'];
           foreach (array('only', 'except') as $t)
           {
              $vals = array();
              
              if( !isset($_POST['show_galplus'][$t]) ) {
				continue;
			  }
			  $_POST['show_galplus'][$t] = (array)$_POST['show_galplus'][$t];
              
              foreach ($_POST['show_galplus'][$t] as $o)
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

global $postgalleryplus;
$postgalleryplus=new PostGalleryPlus();

?>

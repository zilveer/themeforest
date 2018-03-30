<?php


if (!class_exists('PostOptions')) {

	class PostOptions {

      var $defaults = array(
         "post_size" => "m"
      );

		function PostOptions($args = array()) {
			$this->register($args);
		}

		function register($args = array()) {
			$defaults = array(
				'label' => 'Post options',
				'id' => 'posthide',
				'post_type' => 'post',
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
			add_meta_box("{$this->post_type}-{$this->id}", __($this->label), array($this, 'thumbnail_meta_box'), $this->post_type, 'side', $this->priority);
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
         
         $content='
            
<input type="hidden" name="nonce" value='.$nonce.' />
            
<p>
Post Size:<br />
<label><input type="radio" name="post_size" value="s" '.($this->get_post_option('post_size') == 's' ? ' checked="checked"' : '').' /> S</label><br />
<label><input type="radio" name="post_size" value="m" '.($this->get_post_option('post_size') == 'm' ? ' checked="checked"' : '').' /> M</label><br />
<label><input type="radio" name="post_size" value="l" '.($this->get_post_option('post_size') == 'l' ? ' checked="checked"' : '').' /> L</label><br />
</p>

            ';

			return $content;
		}
		
		function get_post_option($name)
		{
		   global $post;
		   if (!$this->post_id)
            $this->post_id=$post->ID;
		   $v = get_post_meta($this->post_id, '_option_'.$name, true);
		   if (strlen($v) == 0)
		   {
		      return $this->defaults[$name];
		   }
		   return $v;
		}

		function set_post_option($name, $val)
		{
		   add_post_meta($this->post_id, '_option_'.$name, $val, true);
		   update_post_meta($this->post_id, '_option_'.$name, $val);
		}
		
		function save_page($post_id) {
		
		
		if (!isset($_POST['nonce'])) return;
		
           if ( !wp_verify_nonce( $_POST['nonce'], 'my-nonce' )) {
             return $post_id;
           }
           
           $this->post_id=$_POST['post_ID'];

           if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
             return $post_id;

           /*
           if ( 'post' == $_POST['post_type'] ) {
             if ( !current_user_can( 'edit_post', $post_id ) )
               return $post_id;
           } else {
               return $post_id;  
           }
           */
			
			foreach (explode(" ", "post_size") as $opt) {
				if( !isset($_POST[$opt]) ) {
					continue;
				}
				$this->set_post_option($opt, $_POST[$opt]);
			}

           return 1;
		}

	}
}

global $postoptions, $postoptions_photos, $postoptions_portfolio, $postoptions_galleryplus;
$postoptions_photos=new PostOptions(array('post_type' => 'dt_gallery'));
$postoptions_portfolio=new PostOptions(array('post_type' => 'dt_portfolio'));
$postoptions_galleryplus=new PostOptions(array('post_type' => 'dt_gallery_plus'));
$postoptions=new PostOptions();

function the_post_size()
{
   global $postoptions, $post;
   $postoptions->post_id = $post->ID;
   $size = $postoptions->get_post_option('post_size');
   return $size;
}

?>

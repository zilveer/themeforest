<?php
/*
Plugin Name: Multiple Post Thumbnails
Plugin URI: http://vocecommunications.com/
Description: Adds the ability to add multiple post thumbnails to a post type.
Version: 0.2
Author: Chris Scott
Author URI: http://vocecommuncations.com/
*/

/*  Copyright 2010 Chris Scott (cscott@voceconnect.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General License for more details.

    You should have received a copy of the GNU General License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if (!class_exists('PostHide')) {

	class PostHide {

		function PostHide($args = array()) {
			$this->register($args);
		}

		/**
		 * Register a new post thumbnail.
		 *
		 * Required $args contents:
		 *
		 * label - The name of the post thumbnail to display in the admin metabox
		 *
		 * id - Used to build the CSS class for the admin meta box. Needs to be unique and valid in a CSS class selector.
		 *
		 * Optional $args contents:
		 *
		 * post_type - The post type to register this thumbnail for. Defaults to post.
		 *
		 * priority - The admin metabox priority. Defaults to low to show after normal post thumbnail meta box.
		 *
		 * @param array|string $args See above description.
		 * @return void
		 */
		function register($args = array()) {
			$defaults = array(
				'label' => 'Post options',
				'id' => 'posthide',
				'post_type' => 'post',
				'priority' => 'low',
			);
         
         if( isset($_GET['post']) ) {
            $this->post_id=$_GET['post'];
         }
         
         //if (!$this->post_id) $this->post_id=the_ID();

         if( isset($args['post']) && $args['post'] ) $this->post_id = $args['post'];

			$args = wp_parse_args($args, $defaults);

			// Create and set properties
			foreach($args as $k => $v) {
				$this->$k = $v;
			}

			add_action('add_meta_boxes', array($this, 'add_metabox'));
			add_action('save_post', array($this, 'save_page'));
			
		}

		/**
		 * Add admin metabox for thumbnail chooser
		 *
		 * @return void
		 */
		function add_metabox() {   
			add_meta_box("{$this->post_type}-{$this->id}", __($this->label), array($this, 'thumbnail_meta_box'), $this->post_type, 'side', $this->priority);
		}

		/**
		 * Output the thumbnail meta box
		 *
		 * @return string HTML output
		 */
		function thumbnail_meta_box() {
			global $post;
			$thumbnail_id = get_post_meta($post->ID, "{$this->post_type}_{$this->id}_thumbnail_id", true);
			echo $this->post_thumbnail_html($thumbnail_id);
		}

		/**
		 * Throw this in the media attachment fields
		 *
		 * @param string $form_fields
		 * @param string $post
		 * @return void
		 */
		function add_attachment_field($form_fields, $post) {
		}

		/**
		 * Check if post has an image attached.
		 *
		 * @param string $post_type The post type.
		 * @param string $id The id used to register the thumbnail.
		 * @param string $post_id Optional. Post ID.
		 * @return bool Whether post has an image attached.
		 */
		function has_post_thumbnail($post_type, $id, $post_id = null) {
			if (null === $post_id) {
				$post_id = get_the_ID();
			}

			if (!$post_id) {
				return false;
			}

			return get_post_meta($post_id, "{$post_type}_{$id}_thumbnail_id", true);
		}

		/**
		 * Display Post Thumbnail.
		 *
		 * @param string $post_type The post type.
		 * @param string $id The id used to register the thumbnail.
		 * @param string $post_id Optional. Post ID.
		 * @param int $size Optional. Image size.  Defaults to 'post-thumbnail', which theme sets using set_post_thumbnail_size( $width, $height, $crop_flag );.
		 * @param string|array $attr Optional. Query string or array of attributes.
		 */
		function the_post_thumbnail($post_type, $id, $post_id = null, $size = 'post-thumbnail', $attr = '') {
			//echo $this->get_the_post_thumbnail($post_type, $id, $post_id, $size, $attr);
		}

		/**
		 * Retrieve Post Thumbnail ID.
		 *
		 * @param string $post_type The post type.
		 * @param string $id The id used to register the thumbnail.
		 * @param int $post_id Optional. Post ID.
		 * @return int
		 */
		function get_post_thumbnail_id($post_type, $id, $post_id) {
			return get_post_meta($post_id, "{$post_type}_{$id}_thumbnail_id", true);
		}

		/**
		 * Output the post thumbnail HTML for the metabox and AJAX callbacks
		 *
		 * @param string $thumbnail_id The thumbnail's post ID.
		 * @return string HTML
		 */
		function post_thumbnail_html($thumbnail_id = NULL) {
			global $content_width, $_wp_additional_image_sizes, $post_ID;

         $nonce= wp_create_nonce  ('my-nonce');
         $content='<!-- <p>Category to use as portfolio:</p> -->
         <input type="hidden" name="nonce" value='.$nonce.' />

         <!--
         <p><select name="cat_portfolio">
            <option></option>
         ';

         $cur=$this->get_cat();

         $_tags = get_categories();
         foreach ($_tags as $_tag){
	         $content.='<option value="'.$_tag->cat_ID.'"'.($cur==$_tag->cat_ID ? ' selected="selected"' : '').'>'.$_tag->cat_name.'</option>';
         }
         
         $content.='</select></p>
         -->
            
<p><label>
<input type="checkbox" name="hide_f" value="1" '.($this->get_hide_f() ? ' checked="checked"' : '').' />
Hide featured image in post details
</label></p>

            ';

			return $content;
		}
		
		function set_hide_f($cat)
		{
		   $cat=intval($cat);
		   add_post_meta($this->post_id, '_cat_portfolio_sf', $cat, true);
		   update_post_meta($this->post_id, '_cat_portfolio_sf', $cat);
		}
		
		function get_hide_f()
		{
		   global $post;
         if (empty($this->post_id)) $this->post_id=$post->ID;
		   $d=get_post_meta($this->post_id, '_cat_portfolio_sf', true);
		   return $d;
		}

		function set_cat($cat)
		{
		   $cat=intval($cat);
		   add_post_meta($this->post_id, '_cat_portfolio', $cat, true);
		   update_post_meta($this->post_id, '_cat_portfolio', $cat);
		}
		
		function get_cat()
		{
		   global $post;
         if (!$this->post_id) $this->post_id=$post->ID;
		   $d=get_post_meta($this->post_id, '_cat_portfolio', true);
		   return $d;
		}

		/**
		 * Set/remove the post thumbnail. AJAX handler.
		 *
		 * @return string Updated post thumbnail HTML.
		 */
		function save_page($post_id) {
		
           if ( !wp_verify_nonce( $_POST['nonce'], 'my-nonce' )) {
             return $post_id;
           }

            //$this->post_id=$post_id;
            $this->post_id=$_POST['post_ID'];

           // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
           // to do anything
           if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
             return $post_id;

           
           // Check permissions
           if ( 'post' == $_POST['post_type'] ) {
             if ( !current_user_can( 'edit_post', $post_id ) )
               return $post_id;
           } else {
               return $post_id;  
           }

           // OK, we're authenticated: we need to find and save the data

           $mydata = intval($_POST['cat_portfolio']);
           //$this->set_cat($mydata);
           
//print_R($_REQUEST); exit;

           $mydata = intval($_POST['hide_f']);
           $this->set_hide_f((int)$mydata);
           
           //echo $post_id."!"; exit;
           
           //print_r($this->get_cat()); echo '?'; exit;

           return 1;
		}

	}
}

$posthide=new PostHide();

?>

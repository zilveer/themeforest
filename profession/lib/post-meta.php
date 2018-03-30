<?php

class PostMeta
{
	private $pType;
	
	function __construct($postType)
	{
		$this->pType = $postType;
		
		add_action('add_meta_boxes', array(&$this, 'AddMetabox'));
		add_action('admin_print_scripts-post-new.php', array( &$this, 'InitScripts' ));
		add_action('admin_print_scripts-post.php', array( &$this, 'InitScripts' ));
		
		/* Save post meta on the 'save_post' hook. */
		add_action( 'save_post', array( &$this, 'SaveData' ), 10, 2 );
	}
	
	function GetMetaKeys()
	{
		return array();
	}
	
	function SaveData($post_id = false, $post = false)
	{
		/* Verify the nonce before proceeding. */
		$nonce = THEME_NAME_SEO . '_post_nonce';
		
		if ( !isset( $_POST[$nonce] ) || !wp_verify_nonce( $_POST[$nonce], 'theme-post-meta-form' ) )
			return $post_id;
			
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		
		if($post->post_type != $this->pType)
			return $post_id;
		
		// check permissions
		if ($_POST['post_type'] == 'page') {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

        //Run pre save function
        $ret = $this->PreSave($post_id, $post);

        if($ret != null && $ret != true)
            return $post_id;

		//CRUD Operation
		foreach($this->GetMetaKeys() as $key => $value)
		{
			$metaKey = '';
			$inputType = 'simple';
			
			if(gettype($value) == 'string')
			{
				$metaKey = $value;
			}
			else//Array
			{
				$metaKey   = $key;
				$inputType = $value['type'];
			}
			
			$newMetaValue = isset( $_POST[$metaKey] ) ? $_POST[$metaKey] : '';
			$metaValue    = get_post_meta( $post_id, $metaKey, true );
			$prevIsEmpty  = gettype($metaValue) == 'string' ? $metaValue == '' : count($metaValue) < 1;
			$isEmpty      = gettype($newMetaValue) == 'string' ? $newMetaValue == '' : count($newMetaValue) < 1;
			$isDiff       = $metaValue != $newMetaValue;

			//Insert
			if ( !$isEmpty && $prevIsEmpty )
            {
				add_post_meta( $post_id, $metaKey, $newMetaValue, true );
            }
			//Update
			elseif ( !$isEmpty && $isDiff )
            {
				update_post_meta( $post_id, $metaKey, $newMetaValue );
            }
			//Delete
			elseif ( $isEmpty && !$prevIsEmpty )
			{
				delete_post_meta( $post_id, $metaKey, $metaValue );
				
				//Delete the attachment too
				if($inputType == 'upload')
				{
					$this->DeleteAttachment($metaValue);
				}
			}
			
		}

        //Run post save function
        $this->PostSave($post_id, $post);
	}
	
	function DeleteAttachment( $url ) {
		global $wpdb;
		
		// We need to get the image's meta ID.
		$query = "SELECT ID FROM wp_posts where guid = '" . esc_url($url) . "' AND post_type = 'attachment'";
		$results = $wpdb->get_results($query);

		// And delete it
		foreach ( $results as $row ) {
			wp_delete_attachment( $row->ID );
		}
	}

	
	function InitScripts()
	{
		global $post_type;
		
		if( $post_type == $this->pType)
			$this->px_register_scripts();
	}
	
	function px_register_scripts()
	{
	}
	
	// Add the Meta Box
	function AddMetabox() 
	{
	}

    function PreSave($post_id, $post)
    {
        return true;
    }

    function PostSave()
    {
        return true;
    }

	//Show meta form
	function ShowMetabox()
	{
		$rc      = new ReflectionClass(get_class($this));
		$path    = rtrim(dirname($rc->getFileName()), '/\\');//Special cases that file is inside root "C:\"
		$curFile = basename($rc->getFileName(), '.php');
		$formPath = $path . '/' . $curFile . '-form.php';

		if(!file_exists($formPath))
			return;
		
		$page = include($formPath);
	}
}
<?php

	///////////////////////////////////////////
	///////////////////////////////////////////
	//// THIS FILE HANDLES OUR METABOXES
	//// FUNCTIONS AND STYLES
	//// DVP. BY GUILHERME SALUM - DDSTUDIOS
	//// DO NOT DISTRIBUTE, MODIFY OR REUSE
	///////////////////////////////////////////
	///////////////////////////////////////////
	
	
	
	////////////////////////////////////
	// LOADS OUR JS SCRIPTS
	////////////////////////////////////
	
	//our include js function
	add_action('admin_print_styles', 'ddMetaIncludeJs');
	
	function ddMetaIncludeJs() {
		
		if(is_admin()) {
			
			//creates our metabox script
			
			//shortcodes.js
			wp_register_script('ddMetaScripts', get_template_directory_uri().'/includes/metaboxes/js/scripts.js');
			
			//jQuery UI Sortable
			wp_enqueue_script('ddMetaScripts');
			wp_enqueue_script('jquery-ui-sortable');
			
		}
		
	}
	
	function ddFromArrayToString($array) {
		
		//loops through our array
		$newString = ''; $i = 0;
		foreach($array as $string) {
			
			$i2 = 1;
			foreach($string as $item) {
				
				$newString .= $item;
			
				if(($i2) < (count($string))) { $newString .= '|'; }
				
				$i2++;
				
			}
			
			if(($i+1) < (count($array))) { $newString .= '||'; }
			
			$i++;
			
		}
		
		return $newString;
		
	}
	
	function ddFromStringToArray($string) {
		
		$newArray = array();
		
		$allItems = explode('||', $string);
		foreach($allItems as $item) {
			
			//explodes each items individually
			$eachItem = explode('|', $item);
			$newTempArray = array(
			
				'type' => $eachItem[0],
				'name' => $eachItem[1],
				'title' => $eachItem[2]
			
			);
			
			array_push($newArray, $newTempArray);
			
		}
		
		return $newArray;
			
	}
	
	function ddListGet($metaName, $postId) {
		
		//gets the meta
		$string = get_post_meta($postId, 'dd'.$metaName, true);
		
		$newArray = array();
		
		$allItems = explode('|||', $string);
		foreach($allItems as $item) {
			
			//explodes each items individually
			$eachItem = explode('||', $item);
			$newTempArray = array();
			foreach($eachItem as $item) {
				
				$item2 = explode('|', $item);
				$newTempArray[$item2[0]] = $item2[1];
					
			}
				
			array_push($newArray, $newTempArray);
			
		}
		
		//turns the string into an array
		return $newArray;
		
	}
	
	
	
	
	/////////////////////////////////////
	// CREATES THE METABOX
	/////////////////////////////////////
	
	function ddCreateNewListMetabox($id, $fieldArr, $type, $position, $title) {
		
		add_action('admin_menu' ,'dd'.$id);
		add_action('save_post', 'ddSave'.$id);
		
 		$funcName = 'dd'.$id;
    	eval("function $funcName() { add_meta_box( 'dd".$id."', '".$title."', 'create_".$funcName."', '".$type."', 'side', '".$position."' ); } ");
		
		//turns my fields array into a string
		$newFieldArr = ddFromArrayToString($fieldArr);
		
 		$funcNameCreate = 'create_dd'.$id;
		eval("function $funcNameCreate() { ddCreateNewListMetaboxMarkup('$id', '$newFieldArr'); } ");
		
 		$funcNameSave = 'ddSave'.$id;
		eval("function $funcNameSave(\$post_id) {
			
			global \$post;
		
			//verify if it's autosave
			if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) { return $post_id; }
			
			  // Check permissions
			  if ( 'page' == \$_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', \$post_id ) )
				  return \$post_id;
			  } else {
				if ( !current_user_can( 'edit_post', \$post_id ) )
				  return \$post_id;
			  }
			  
			  update_post_meta(\$post_id, 'dd".$id."', htmlspecialchars(\$_POST['dd".$id."_content']));
			
		} ");
		
	}
	
	function ddCreateNewListMetaboxMarkup($id, $arrStr) {
		
		$idList = 'dd'.$id;
		global $post;
		$fields = ddFromStringToArray($arrStr);
		include('markup.php');
		
	}



?>
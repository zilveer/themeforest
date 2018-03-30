<?php

/*
**	Rock Page Builder UI
**
**	Alias	:	Rock Builder UI		Located in "rock-builder/builder-functions.php"
**	Alias	:	Rock Builder		Located in "rock-builder/rock-builder.php"
**	Author	:	Rockthemes.net
**	License	:	Contact to rockthemes.net for further information
**	Version	:	1.0
**
**	Generates the layout and the modals of the Rock Page Builder
*/

//Return if not in WP Admin - Higher Performance optimization
if ( !(defined( 'WP_ADMIN' ) && WP_ADMIN ) &&  !( defined( 'DOING_AJAX' ) && DOING_AJAX )) return;

/*
**	Returns the data of the saved page builder templates.
**
**	@return	:	The data will be json_encoded
*/
function rockthemes_pb_get_export_data(){
	$references	=	get_option('rock_builder_references',false);
	if(!$references) return false;
		
	$datas				=	array();		
	
	foreach($references as $ref){
		$datas[] = get_option($ref['database_name'],array());
	}
	
	return json_encode(
				array(
					'references'	=>	($references),
					'datas'			=>	$datas,
					'site_url'		=>	home_url(),
				)
			);
}



function rockthemes_pb_import($data){
	
	//$data = preg_replace( "/\r|\n/", "", $data);
	if(!is_array($data)){
		$main_decoded = json_decode(($data),true);
		if(!is_array($main_decoded)){
			$main_decoded = json_decode(stripslashes($data),true);
		}

		$data = $main_decoded;
	}	
	//var_dump($data);
	
	$old_site_url = $data['site_url'];
	$current_site_url = home_url();
	
	$old_site_url_slashed = str_replace('/', '\\/', $old_site_url);
	$current_site_url_slashed = str_replace('/', '\\/', $current_site_url);
	
	//Import references
	$references_imported = update_option('rock_builder_references', ($data['references']));
			
	//Import form datas
	$count = 0;
	foreach($data['datas'] as $page_template){
		
		if(is_array($page_template)){
			$page_template = json_encode($page_template);	
		}
		
		$database_name = $data['references'][$count]['database_name'];
		
		$page_template = str_replace($old_site_url, $current_site_url, $page_template);
		$page_template = str_replace($old_site_url_slashed, $current_site_url_slashed, $page_template);
		
		var_dump($database_name, $page_template);
				
		update_option($database_name, ($page_template));
		
		$count++;
		
	}
	
	var_dump($data['references']);
	echo "success";
}




function get_saved_rock_builders_as_list($selected = null,$echo = null){
	
	if(!is_admin()) die();
		
	if(isset($_REQUEST['selected'])) $selected = $_REQUEST['selected'];
	
	$builderReferences = get_option("rock_builder_references",false);
	
	if(!$builderReferences) return;
	
	$return = '';
	
	$return = '<select class="rock-builder-template-list" autocomplete="off">';
	
	$return .= '<option value="no_template" '.(!$selected ? 'selected' : '').'>Choose a Template</option>';
	
	
	
	foreach ($builderReferences as $key => $value) {

		$ref_name[$key] = $value['name'];
			
	}
	
	array_multisort($ref_name, $builderReferences);
	
	
	
	foreach($builderReferences as $ref){
		if($selected == $ref['database_name']){
			$return .= '<option value="'.$ref['database_name'].'" selected>'.$ref['name'].'</option>';
		}else{
			$return .= '<option value="'.$ref['database_name'].'">'.$ref['name'].'</option>';
		}
	}
	
	$return .= '</select>';
	
	if($echo){
		echo $return;
	}else{
		return $return;
	}
	
	exit;
}
function get_saved_rock_builders_as_list_ajax(){
	get_saved_rock_builders_as_list('',true);	
	exit;
}
add_action('wp_ajax_get_rock_builder_references_list', 'get_saved_rock_builders_as_list_ajax');


function rock_builder_save_template(){
	if(!is_admin()) return;
	
	if(!isset($_REQUEST['_ajax_nonce']) ||
		empty($_REQUEST['_ajax_nonce']) || 
		!wp_verify_nonce($_REQUEST['_ajax_nonce'], 'rpb_save_nonce') ||
		!check_ajax_referer('rpb_save_nonce')) {
			
		//Die
		die();
	}
	
	$data = $_REQUEST['data'];
	$template = $_REQUEST['template'];
	
	$templateName = sanitize_text_field($template['name']);
	$templateDBName = 'rock_builder_template_'.intval($template['database_name']);
	
	update_option($templateDBName, $data);
	
	$builderReferences = get_option("rock_builder_references",array());
	
	$i = 0;
	foreach($builderReferences as $ref){
		if($ref['database_name'] == $templateDBName){
			$builderReferences[$i]['name'] = $templateName;
			update_option("rock_builder_references",$builderReferences);
			//echo "FOUND";
			break;
		}
		$i++;
	}
	
	exit;
}
add_action("wp_ajax_rockAjax_save_builder_template","rock_builder_save_template");


function rock_builder_delete_template(){
	if(!is_admin() || !isset($_REQUEST['database_name'])) die();
	
	if(!isset($_REQUEST['_ajax_nonce']) ||
		empty($_REQUEST['_ajax_nonce']) || 
		!wp_verify_nonce($_REQUEST['_ajax_nonce'], 'rpb_save_nonce') ||
		!check_ajax_referer('rpb_save_nonce')) {
			
		//Die
		die();
	}
	
	$templateDBName = 'rock_builder_template_'.intval($_REQUEST['database_name']);
		
	$builderReferences = get_option("rock_builder_references",array());
	
	$i = 0;
	foreach($builderReferences as $ref){
		if($ref['database_name'] == $templateDBName){
			array_splice($builderReferences, $i, 1);
			update_option("rock_builder_references",$builderReferences);
			//echo "FOUND".$i;
			break;
		}
		$i++;
	}
	
	delete_option($templateDBName);
	
	echo "SUCCESS";
	
	exit;
}
add_action("wp_ajax_rockAjax_delete_builder_template","rock_builder_delete_template");


function rock_builder_add_new_template(){
	if(!is_admin()) die();
	
	if(!isset($_REQUEST['_ajax_nonce']) ||
		empty($_REQUEST['_ajax_nonce']) || 
		!wp_verify_nonce($_REQUEST['_ajax_nonce'], 'rpb_save_nonce') ||
		!check_ajax_referer('rpb_save_nonce')) {
			
		//Die
		die();
	}	
	
	$data = $_REQUEST['data'];
	$name = sanitize_text_field($_REQUEST['name']);
	
	$databaseName = '';
	
	$builderReferences = get_option("rock_builder_references",array());
	
	if(count($builderReferences) <= 0){
		$builderReferences[] = array('database_name' => 'rock_builder_template_0', 'name'=>$name);	
		$databaseName = "rock_builder_template_0";
	}else{
		$last = end($builderReferences);
		$databaseName = "rock_builder_template_".(intval(str_replace("rock_builder_template_","",$last['database_name'])) + 1);
		$builderReferences[] = array('database_name' =>$databaseName, 'name' => $name);
	}
	
	update_option("rock_builder_references",$builderReferences);
			
	update_option($databaseName, ($data));
	
	echo "Success";
	
	exit;
}
add_action("wp_ajax_rockAjax_add_new_builder_template","rock_builder_add_new_template");



function rock_builder_load_template(){
	if(!is_admin()) die();
	
	if(!isset($_REQUEST['_ajax_nonce']) ||
		empty($_REQUEST['_ajax_nonce']) || 
		!wp_verify_nonce($_REQUEST['_ajax_nonce'], 'rpb_save_nonce') ||
		!check_ajax_referer('rpb_save_nonce')) {
			
		//Die
		die();
	}	
	
	$postID = intval($_REQUEST['postID']);
	$loadTemplateDatabaseName = intval($_REQUEST['loadTemplateDatabaseName']);
	$loadTemplateDatabaseName = 'rock_builder_template_'.$loadTemplateDatabaseName;
	$_builder_in_use = $_REQUEST['_builder_in_use'];
	$_featured_image_in_builder = sanitize_text_field($_REQUEST['_featured_image_in_builder']);
	
	$data = get_option($loadTemplateDatabaseName, false);
		
	if(!$data) return "ERROR : Data not exists";
	
   	update_post_meta($postID, '_this_r_content', addslashes($data) );  
	update_post_meta($postID, '_builder_in_use', 'true');
	update_post_meta($postID, '_featured_image_in_builder', $_featured_image_in_builder);
	
	echo "Success";
	
	exit;
}
add_action("wp_ajax_rockAjax_load_builder_template","rock_builder_load_template");



function rock_pages_ui(){
	global $post;
	
	
    $val = get_post_meta( $post->ID, '_this_r_content', true );
	
	//Remove any additional line breaks. Some PHP versions adds line breaks during json_encode / json_decode	
	$val = preg_replace( "/\r|\n/", "", $val);
	
	//Try to decode the value. Some servers automatically strips slashes
	$decode_val = (json_decode(($val), true));

	//If value is not turned into an array with json_decode then stripslashes and decode. This server do not automatically removes slashes
	if(!is_array($decode_val)){
		$decode_val = (json_decode(stripslashes($val), true));
	}

	//Set final array value to regular $val variable
	$val = $decode_val;
		
	
	//Check if val is empty after decode
	if(!empty($val)):

	foreach ($val as $key => $value) {

		$col[$key] = $value['col'];
		
		$row[$key] = $value['row'];
	
	}
	
	array_multisort($row, $col, $val);
	endif;
	$modals = array();
	$gridModals = array();
	
	//960 Grid or 1090 Grid
	$chosen_layout_width = 1060;
	$chosen_layout_padding = 15;
	
	//Start special grid block modals holder as an array
	$specialGridBlockModals = array();

	echo '
	<div class="rock-builder-actions" ref="'.$post->ID.'">
		<div class="row-fluid">
			<div class="span4">
				<h4>Choose A Custom Page</h4>
			</div>
			<div class="span3">
				<h4>Template Name</h4>
			</div>
			<div class="span5">
				<h4>Actions</h4>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span4 template-list-holder">
				'.get_saved_rock_builders_as_list().'
			</div>
			<div class="span3">
				<input autocomplete="off" type="text" autocomplete="off" name="template_name" class="template_name" val="" />
			</div>
			<div class="span5">
				<div class="btn btn-success btn-mini save_current_template_button" data-toggle="tooltip-main" title="Save the changes of current template">Save</div>
				<div class="btn btn-danger btn-mini delete_current_template_button" data-toggle="tooltip-main" title="Delete current template">Delete</div>
				<div class="btn btn-primary btn-mini load_current_template_button" data-toggle="tooltip-main" title="Load and bind the current template">Load</div>
				<div class="btn btn-mini add_new_template_button" data-toggle="tooltip-main" title="Add new template. (Make sure you have filled the template name)"><i class="fa fa-plus"></i> Add New</div>
			</div>
		</div>
	</div>
	<br/>
	
				
	<div class="main_page_builder" layout_width="'.$chosen_layout_width.'" layout_padding="'.$chosen_layout_padding.'" >
		<div class="gridster">
			<ul>';
				$elemID = 0;
				$gridID = 0;
				//$specialGridBlockID = 0;
				if(!empty($val)):
					foreach($val as $element){
						$hidden = '';
						$gridElems = '';
						//Escape any saving errors (Connection loss, data loss during save)
						if(!isset($element['grid_data'])) continue;
						if(isset($element['elems']) && !empty($element['elems'])):
							
						foreach($element['elems'] as $elem){
							if(!isset($elem['id'])){
								$elemID++;
							}else{
								$elemID = str_replace('modal-','',$elem['id']);
							}
								
							if(isset($elem)){
								if($elem['descType'] == 'textarea'){
									$hidden = $elem ? $elem : "";
									$attr = 'avoid_sidebar="false"';
									if(isset($elem['data']['data']['avoidSidebar'])){
										$attr = 'avoid_sidebar="'.$elem['data']['data']['avoidSidebar'].'"';;
									}
									$hidden = $elem['desc'];
								}else{
									$modals[] = array('id' => 'modal-'.$elemID, 'modal' => $elem);
								}
								$descType = rockthemes_pb_element_to_string($elem['descType']);

							}
							$gridElems .= '<div id="elem-'.$elemID.'" class="builder-element" elem-type="'.$elem['descType'].'"><div class="hide secret-desc">'.$hidden.'</div><div class="elem-content"><span class="elem-name"><i class="drag fa fa-move"></i> '.rockthemes_pb_element_to_string($elem['descType']).'</span><span class="alignright"><i class="fa fa-edit icon-black element-edit-btn"></i><i class="fa fa-copy element-copy-btn"></i><i class="fa fa-times icon-black element-remove-btn"></i></span><div class="clear"></div></div></div>';
						}//End of $element['elems'] loop
						endif;//Check if $element['elems'] exists and not empty
						
						if(isset($element['special_grid_block']) && $element['special_grid_block'] === 'yes'){
							$specialGridBlockID = str_replace('specialgridblock-open-', '', $element['id']);
							$specialGridBlockID = str_replace('specialgridblock-close-', '', $specialGridBlockID);
							
							if($element['special_grid_block_open'] === 'yes'){
								//Open Special Block
								echo '<li id="specialgridblock-open-'.$specialGridBlockID.'" class="gridsterli specialgridblock block-open" data-row="'.$element['row'].'" data-col="'.$element['col'].'" data-sizex="12" data-sizey="1"><div class="grid-header"><strong>Special Grid Open - <span class="columns-num">Block : '.$specialGridBlockID.'</span></strong><span class="alignright "><i class="fa fa-gear icon-black specialgridblock-edit-btn"></i> <i class="fa fa-times icon-black specialgridblock-remove-btn"></i></span></div></li>';
							
								//$specialGridBlock_data = array('id'=>$specialGridBlockID,'data'=>array('avoid_sidebar'=>true));
								
								$specialGridBlockModals[] = array('id'=> 'modal-specialgridblock-'.$specialGridBlockID, 'modal'=>$element['grid_data']);
							}else{
								//Open Special Block
								echo '<li id="specialgridblock-close-'.$specialGridBlockID.'" class="gridsterli specialgridblock block-close" data-row="'.$element['row'].'" data-col="'.$element['col'].'" data-sizex="12" data-sizey="1"><div class="grid-header"><strong>Special Grid Close - <span class="columns-num">Block : '.$specialGridBlockID.'</span></strong><span class="alignright "> <i class="fa fa-times icon-black specialgridblock-remove-btn"></i></span></div></li>';
							}
							
							//$specialGridBlockID++;
						}else{
							echo '<li id="grid-'.$gridID.'" class="gridsterli" data-row="'.$element['row'].'" data-col="'.$element['col'].'" data-sizex="'.$element['size_x'].'" data-sizey="3"><div class="grid-header"><span class="columns-num">'.rockthemes_pb_string_to_num($element['size_x']).'</span> <i class="fa fa-chevron-left columns-minus"></i> <i class="fa fa-chevron-right columns-plus"></i><span class="alignright "><i class="fa fa-gear icon-black grid-edit-btn"></i> <i class="fa fa-copy icon-black grid-copy-btn"></i> <i class="fa fa-times icon-black columns-remove-btn"></i></span></div><div class="grid-content">'.$gridElems.'<i class="fa fa-plus fa-2x add-element-in-grid-btn"></i></div></li>';
							$grid=array();
	
							$gridModals[] = array('id'=> 'modal-grid-'.$gridID, 'modal'=>$element['grid_data']);
									
							$gridID++;
						}
					}//End of $val loop
				else:
					if(xr_get_option('auto_add_featured_image_to_builder','YES')){
									
						$singleElem = '<div id="elem-'.$elemID.'" class="builder-element" elem-type="featuredimage"><div class="hide secret-desc"></div><div class="elem-content"><span class="elem-name"><i class="drag fa fa-move"></i> Featured Image</span><span class="alignright"><i class="fa fa-edit icon-black element-edit-btn"></i><i class="fa fa-copy element-copy-btn"></i><i class="fa fa-times icon-black element-remove-btn"></i></span><div class="clear"></div></div></div>';
						echo '<li id="grid-'.$gridID.'" class="gridsterli" data-row="1" data-col="1" data-sizex="8" data-sizey="3"><div class="grid-header"><span class="columns-num">'.rockthemes_pb_string_to_num(8).'</span> <i class="fa fa-chevron-left columns-minus"></i> <i class="fa fa-chevron-right columns-plus"></i><span class="alignright "><i class="fa fa-gear icon-black grid-edit-btn"></i> <i class="fa fa-copy icon-black grid-copy-btn"></i> <i class="fa fa-times icon-black columns-remove-btn"></i></span></div><div class="grid-content">'.$singleElem.'<i class="fa fa-plus fa-2x add-element-in-grid-btn"></i></div></li>';
								
						$modals[] = array('id' => 'modal-'.$elemID, 'modal' => array('id'=>'elem'.$elemID,'descType'=>'featuredimage','data' => array('data' =>'large')));
								
						$grid_data = array('id'=>$gridID,'data'=>array('avoid_sidebar'=>false));
						$gridModals[] = array('id'=> 'modal-grid-'.$gridID, 'modal'=>$grid_data);
						$gridID++;
						$elemID++;							
					}
				endif;
				
				/*
				$specialBlockGrid_id = 0;
				//Open Special Block
				echo '<li id="specialgridblock-open-'.$gridID.'" class="gridsterli specialgridblock block-open" data-row="10" data-col="1" data-sizex="12" data-sizey="1"><div class="grid-header"><strong>Special Grid Open - <span class="columns-num">Block : '.$specialBlockGrid_id.'</span></strong><span class="alignright "><i class="fa fa-gear icon-black specialgridblock-edit-btn"></i> <i class="fa fa-times icon-black specialgridblock-remove-btn"></i></span></div></li>';
				
				//Close Special Block
				echo '<li id="specialgridblock-close-'.$gridID.'" class="gridsterli specialgridblock block-close" data-row="10" data-col="1" data-sizex="12" data-sizey="1"><div class="grid-header"><strong>Special Grid Close - <span class="columns-num">Block : '.$specialBlockGrid_id.'</span></strong><span class="alignright "> <i class="fa fa-times icon-black specialgridblock-remove-btn"></i></span></div></li>';
				
				$specialGridBlock_data = array('id'=>$gridID,'data'=>array('avoid_sidebar'=>true));
				
				$specialGridBlockModals[] = array('id'=> 'modal-specialgridblock-'.$gridID, 'modal'=>$specialGridBlock_data);
				*/
				
	echo '
			</ul>
		</div>
	</div>';
			
			
	echo '
	<div class="builder-menu">
		'.rock_pages_builder_menu().'
	</div>
	<br/>
	';
	/*
	echo '
	<!-- Modal -->
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Modal header</h3>
		</div>
		<div class="modal-body">
			<p></p>
		</div>
		<div class="modal-footer">
			<button class="button" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="button-primary">Save changes</button>
		</div>
	</div>
	';		
*/

	echo '<div id="modal-holder">
	';
	//get all modals 
	echo rockthemes_pb_make_modals($modals);
	echo rockthemes_pb_make_grid_modals($gridModals);
	echo rockthemes_pb_make_specialgridblock_modals($specialGridBlockModals);
	echo rockthemes_pb_element_list_modal();
	
	if(isset($GLOBALS['xr_colorpickers']) && is_array($GLOBALS['xr_colorpickers']) && count($GLOBALS['xr_colorpickers'])){
		$colorpickerScript = '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					var ids = '.json_encode($GLOBALS['xr_colorpickers']).';

					for (var i=0; i<ids.length; i++){
						jQuery("#"+ids[i]).wpColorPicker();	
					}
				});
			</script>
		';	
		
		echo $colorpickerScript;
	}
	
	echo '</div>';//Close modal holder
	
	
	echo '<div id="text-area-modal-holder" class="row hide">';
	
	echo '
			<div id="text-area-modal" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-header">
					<div class="close builder-close"><i class="fa fa-times"></i></div>
					<h3>Text Area</h3>
				</div>
				<div class="modal-body" data-saved="false">
		';

	//New TinyMCE
	echo '											
					<div class="rock-tinymce-container wp-core-ui wp-editor-wrap tmce-active">
						<div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js">
							<div class="wp-editor-tabs">
								<a class="rock-tinymce-switch-text wp-switch-editor switch-tmce" >Visual</a>
								<a class="rock-tinymce-switch-html wp-switch-editor switch-html" >Text</a>
							</div>
							<div id="wp-content-media-buttons" class="wp-media-buttons"><a href="#" id="insert-media-button" class="button insert-media add_media" data-editor="main-textarea-modal" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a></div>
						</div>
						<div class="wp-content-editor-container wp-editor-container">
							<textarea autocomplete="off" rows="8" cols="40" name="main-textarea-modal" id="main-textarea-modal" class="rock-tinymce-textarea wp-editor-area"></textarea>
						</div>
					</div>
	';
	
	echo '
				</div>
				<div class="modal-footer">
					<div class="btn builder-close">Close</div>
					<div id="save-textarea-data" class="btn btn-primary" ref="text-area-modal">Save changes</div>
				</div>
	';				
		echo '</div>';
	echo '</div>';
	
	$_builder_in_use_data = get_post_meta($post->ID, '_builder_in_use', true);
	$_builder_in_use = checked("true", ($_builder_in_use_data), false);
		
	//Clear any unwanted floats
	echo '<div class="clearfix"></div>';
	
	//Save All Settings
	echo '
	<div class="rockthemes-pb-save-button-container hide">
		<input autocomplete="off" autocomplete="off" type="checkbox" value="1" name="_builder_in_use" id="_builder_in_use" '.$_builder_in_use.' />
		<strong>
			<label for="_builder_in_use" style="color:#ff0000;"> Use Rock Page Builder</label>
		</strong>
		<br/>
		<p>If you are using Rock Page Builder, make sure this option is checked. If this option is not checked, you will be using the regular content area </p>
		<br/>
		<div class="rockthemes-pb-save-important-notice">
			<strong>!Important</strong>
			<br/>
			You need to click "Save" button to save Rock Page Builder Content
		</div>
		<div class="rockthemes-pb-save-container">
			<strong class="alignleft" style="margin-top:4px;">Save Page Builder :</strong>
			<div way="'.F_WAY.'" onclick="jQuery.fn.sendAjax('.$GLOBALS['post']->ID.')" id="save-current-settings-btn" class="btn btn-success alignright">Save</div>
			<div class="clearfix"></div>
		</div>
	</div>';
	
}

function rockthemes_pb_make_modals($arr){
	$return = '';
	foreach($arr as $modal){
		
		if($modal['modal']['descType'] == 'textfield'){
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];
			$return .= '<div id="'.$id.'" modalType="'.$modal['modal']['descType'].'" class="rpb_modal hide fade" tabindex="-1" role="dialog" aria-labelledby="'.$id.'" aria-hidden="true">
				<div>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3>Text Field</h3>
					</div>
					<div class="modal-body">
						<textarea rows="10" cols="50" style="width:100%">'.$modal['modal']['desc'].'</textarea>
					</div>
					<div class="modal-footer">
						<button class="button" data-dismiss="modal" aria-hidden="true">Close</button>
						<div class="button-primary">Save changes</div>
					</div>
				</div>
			</div>';
		}elseif($modal['modal']['descType'] == 'ajaxfiltered'){
		/*
		**	Ajax Filtered Elem
		*/
			$totalItemsToShow = '<div class="total_show_holder"><h4>Select Total Item To Show</h4><select class="total_show" autocomplete="off">';
			for($i = 1; $i< 100; $i++){
				if($modal['modal']['data']['data']['total'] == $i){
					$totalItemsToShow .= '<option value="'.$i.'" selected>'.$i.'</option>';
				}else{
					$totalItemsToShow .= '<option value="'.$i.'">'.$i.'</option>';
				}
			}
			$totalItemsToShow .= '</select></div>';
			
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];
			
			$chosenCategory = isset($modal['modal']['data']['data']['category']) ? $modal['modal']['data']['data']['category'] : '';
			$activate_hover_box = checked("true", (isset($modal['modal']['data']['data']['activate_hover_box']) ? $modal['modal']['data']['data']['activate_hover_box'] : false ), false);
			$activate_hover = checked("true", (isset($modal['modal']['data']['data']['activate_hover']) ? $modal['modal']['data']['data']['activate_hover'] : false ), false);
			$small_thumb_hover = checked("true", (isset($modal['modal']['data']['data']['small_thumb_hover']) ? $modal['modal']['data']['data']['small_thumb_hover'] : false ), false);
			
			$boxed_layout = checked("true", (isset($modal['modal']['data']['data']['boxed_layout']) ? $modal['modal']['data']['data']['boxed_layout'] : false ), false);
			$use_shadow = checked("true", (isset($modal['modal']['data']['data']['use_shadow']) ? $modal['modal']['data']['data']['use_shadow'] : false ), false);
			$disable_hover_link = checked("true", (isset($modal['modal']['data']['data']['disable_hover_link']) ? $modal['modal']['data']['data']['disable_hover_link'] : false ), false);
			$activate_category_link = isset($modal['modal']['data']['data']['activate_category_link']) ? $modal['modal']['data']['data']['activate_category_link'] : "";
			$header_title = isset($modal['modal']['data']['data']['header_title']) ? $modal['modal']['data']['data']['header_title'] : "";
			$excerpt_length = isset($modal['modal']['data']['data']['excerpt_length']) ? $modal['modal']['data']['data']['excerpt_length'] : 18;
			
			$use_border_on_categories = isset($modal['modal']['data']['data']['use_border_on_categories']) ? $modal['modal']['data']['data']['use_border_on_categories'] : "";
			
			
			$excerpt_length_html = '<select class="excerpt_length" autocomplete="off">';
			for($e = 0; $e<150; $e++){
				if($e == $excerpt_length){
					$excerpt_length_html .= '<option value="'. $e .'" selected="selected">'.$e.'</option>';
				}else{
					$excerpt_length_html .= '<option value="'. $e .'">'.$e.'</option>';
				}
			}
			$excerpt_length_html .= '</select>';
			
			
			$return .= '
			<div id="'.$id.'" modalType="'.$modal['modal']['descType'].'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Grid" aria-hidden="true">
					<div class="modal-header">
						<div class="close builder-close"><i class="fa fa-times"></i></div>
						<h3>Filtered Ajax Gallery</h3>
					</div>
					<div class="modal-body">
						<div class="row-fluid">
							<div class="span6 image_sizes_column"  bind="'.$id.'" calc="true">
								'.rock_builder_get_image_sizes(isset($modal['modal']['data']['data']['imageSize']) ? $modal['modal']['data']['data']['imageSize'] : '', $id, '').'
							</div>
							<div class="span6">
								<strong>Choose image size</strong><br/>
								<p>You can choose any image sizes for Ajax Filtered Portfolio. But we recommend using cropped image sizes.</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid post_type_tax_holder">
							<div class="span6">
								'.rock_builder_get_customposttypes($modal['modal']['data']['data']['postType'], $id, '').'
								'.rock_builder_get_taxonomies($chosenCategory, $modal['modal']['data']['data']['postType'], '').'
							</div>
							<div class="span6">
								<strong>Choose A Post Type</strong></br>
								<p>Choose the post type</p><br/>
								<strong>Choose Taxonomies/Categories to Display</strong></br>
								<p>Choose categories/taxonomies. You can choose multiple categories/taxonomies or just single taxonomy/category. You can also choose all categories/taxonomies by choosing the "All".</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6">
								<input autocomplete="off" autocomplete="off" type="text" class="header_title" value="'.$header_title.'" />
							</div>
							<div class="span6">
								<strong>Header Title</strong>
								<p>You can choose to use a header title for filtered ajax portfolio. If you leave this area empty, header title will not be displayed.</p>
							</div>
						</div>
						<hr/>
						'.rock_builder_get_block_grid_list(
							(isset($modal['modal']['data']['data']['block_grid_large']) ? intval($modal['modal']['data']['data']['block_grid_large']) : ''),
							(isset($modal['modal']['data']['data']['block_grid_medium']) ? intval($modal['modal']['data']['data']['block_grid_medium']) : ''),
							(isset($modal['modal']['data']['data']['block_grid_small']) ? intval($modal['modal']['data']['data']['block_grid_small']) : '')
						).'
						<div class="row-fluid">
							<div class="span6">
								'.$totalItemsToShow.'
							</div>
							<div class="span6">
								<strong>Total Products to Show</strong></br>
								<p>This will set up the total products for each category. If you choose 18, you will be showing 18 products for each category.</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6">
								<select class="activate_category_link"  autocomplete="off">
									<option value="active" '.($activate_category_link == "active" ? "selected" : "").'>Activate</option>
									<option value="deactive" '.($activate_category_link == "deactive" ? "selected" : ""). '>Deactivate</option>
								</select>
							</div>
							<div class="span6">
								<strong>Activate Category Link</strong></br>
								<p>If you activate this option, there will be a link under the products for the chosen category.</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6">
								'.$excerpt_length_html.'
							</div>
							<div class="span6">
								<strong>Excerpt Length</strong>
								<p>You can adjust the excerpt length in words. Which means if you choose 10, your excerpt will show up to 10 words from your originial excerpt.</p>
							</div>
						</div>
						<hr/>

						<div class="row-fluid">
							<div class="span6">
								<select class="use_border_on_categories"  autocomplete="off">
									<option value="active" '.($use_border_on_categories == "active" ? "selected" : "").'>Use Border On Category Names</option>
									<option value="deactive" '.($use_border_on_categories == "deactive" ? "selected" : ""). '>Do Not Use Border On Category Names</option>
								</select>
							</div>
							<div class="span6">
								<strong>Use Border On Category Names</strong></br>
								<p>If you want to add a border around category names choose this option.</p>
							</div>
						</div>
						<hr/>

						<div class="row-fluid">
							<div class="span6">
								<div class="activate_hover_box_holder">
									<input autocomplete="off" autocomplete="off" class="activate_hover_box" type="checkbox" value="true" name="activate_hover_box" '.$activate_hover_box.' /><label for="activate_hover_box"> Activate Hover Box</label>
								</div>
							</div>
							<div class="span6">
								<strong>Activate Hover Box Effect</strong></br>
								<p>If you activate hover box effect, your thumbnails will show a bigger image with excerpt when hovered</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6">
								<div class="activate_hover_holder">
									<input autocomplete="off" autocomplete="off" class="activate_hover" type="checkbox" value="true" name="activate_hover" '.$activate_hover.' /><label for="activate_hover"> Activate Hover Effect</label>
								</div>
							</div>
							<div class="span6">
								<strong>Activate Regular Hover Effect</strong></br>
								<p>This option will show the regular hover effect with PrettyPhoto (lightbox). If you activate this option, you can not activate the hover box option. Two option can not be activated.</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6">
								<div class="disable_hover_link_holder">
									<input autocomplete="off" autocomplete="off" class="disable_hover_link" type="checkbox" value="true" name="disable_hover_link" '.$disable_hover_link.' /><label for="activate_hover"> Disable Hover Link</label>
								</div>
							</div>
							<div class="span6">
								<strong>Disable Hover Link</strong></br>
								<p>If you want to disable the link in the hover effect check this option.</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6">
								<div class="use_shadow_holder">
									<input autocomplete="off" autocomplete="off" class="use_shadow" type="checkbox" value="true" name="use_shadow" '.$use_shadow.' /><label for="use_shadow"> Use Shadow</label>
								</div>
							</div>
							<div class="span6">
								<strong>Activate Shadow Under Thumbnails</strong></br>
								<p>If you want a shadow under thumbnail images check this option. This shadow will be under the thumbnail images not hover box images.</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6">
								<div class="small_thumb_hover_holder">
									<input autocomplete="off" autocomplete="off" class="small_thumb_hover" type="checkbox" value="true" name="small_thumb_hover" '.$small_thumb_hover.' /><label for="small_thumb_hover"> Small Thumbnail Hover Effect</label>
								</div>
							</div>
							<div class="span6">
								<strong>Activate Small Thumbnail Hover Effect</strong></br>
								<p>If you are using "Regular Hover Effect" and your thumbnails are smaller than 100px, you should activate this option.</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6">
								<div class="boxed_layout_holder">
									<input autocomplete="off" autocomplete="off" class="boxed_layout" type="checkbox" value="true" name="boxed_layout" '.$boxed_layout.' /><label for="boxed_layout"> Use Boxed Layout</label>
								</div>
							</div>
							<div class="span6">
								<strong>Activate Boxed Layout</strong></br>
								<p>You can easily activate/deactivate boxed layout.</p>
							</div>
						</div>
						<hr/>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button><div class="btn btn-primary builder-close ajaxfiltered-save">Save changes</div>
					</div>
			</div>';
		}elseif($modal['modal']['descType'] == 'featuredimage'){
		/*
		**	Featured Image Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];
			
			$return .= '			
				<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" aria-hidden="true">
					<div class="modal-header">
						<div class="close builder-close"><i class="fa fa-times"></i></div>
						<h3>Featured Image</h3>
					</div>
					<div class="modal-body">
						<div class="row-fluid">
							<div class="span6 featured_element_holder">
								'.rock_builder_get_image_sizes(isset($modal['modal']['data']['data']['imageSize']) ? $modal['modal']['data']['data']['imageSize'] : '', $id, '').'
							</div>
							<div class="span6">
								<strong>Choose a Size</strong></br>
								<p>You need to upload your featured image to use this element. You can choose different image sizes for your featured image. You can also adjust image sizes in Theme Options</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="btn builder-close">Close</div>
						<div class="btn btn-primary featuredimage-save builder-close" ref="'.$id.'">Save changes</div>
					</div>
				</div>
			';
			
			
		}elseif($modal['modal']['descType'] == 'swiperslider'){
		/*
		**	Swiper Slider Elem
		*/

			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];
			
			$linkString = '';
			$max_width = $modal['modal']['data']['data']['maxWidth'];
			$avoid_sidebar = checked("true", (isset($modal['modal']['data']['data']['avoidSidebar']) ? $modal['modal']['data']['data']['avoidSidebar'] : false ), false);
			
			$images = '';
			
			if($modal['modal']['data']['data']['images']){
				$current_img_num = 0;
				foreach($modal['modal']['data']['data']['images'] as $image){
					$images .= '
						<div class="swiperslider-modal-image" ref="'.$id.'">
							<h4>Choose an Image</h4>
							<div class="hide image-data"></div>
							<label for="upload_image"> <input autocomplete="off" autocomplete="off" modalID="'.$id.'" id="'.$id.'_'.$current_img_num.'" class="upload_image_button" size="36" name="upload_image" type="text" value="'.$image.'" /> <input autocomplete="off" autocomplete="off" class="button image_uploader_class" value="Upload Image" type="button" /> </label>
							'.$linkString.'
							<div class="button delete-image-button" ref="'.$id.'">Delete Image</div>
							<br />
						</div>
					';	
				}
			}
						
			$return .= '
				<div id="'.$id.'" modalType="'.$modal['modal']['descType'].'" class="rpb_modal container hide fade" tabindex="-1" aria-hidden="true">
					<div class="modal-header">
						<div class="close builder-close"><i class="fa fa-times"></i></div>
						<h3>Swiper Slider</h3>
					</div>
					<div class="modal-body" data-saved="false">
						<div class="row-fluid">
							<div class="span6 image_sizes_holder">
								'.rock_builder_get_image_sizes(isset($modal['modal']['data']['data']['imageSize']) ? $modal['modal']['data']['data']['imageSize'] : '', $id, 'Choose an Image Size').'
							</div>
							<div class="span6">
								<strong>Choose a Size</strong></br>
								<p>You can choose different image sizes for your featured image. You can also adjust image sizes in Theme Options</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6 images_holder">
								'.$images.'
							</div>
							<div class="span6">
								<h4>Add New Image</h4>
								<p>You can add images to Swiper Slider by clicking to "Add New Image" button</p>
								<div class="button add-new-image">Add New Image</div>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6">
								<input autocomplete="off" autocomplete="off" name="max_width_holder" class="max_width_holder" type="text" value="'.$max_width.'" />
							</div>
							<div class="span6">
								<h4>Maximum Width</h4>
								<p>This is an advanced responsivity option. You can choose the max width breakpoint for this element. </p>
							</div>
						</div>
						<hr/>
					</div>
					<div class="modal-footer">
						<div class="btn builder-close">Close</div>
						<div class="btn btn-primary swiperslider-save builder-close" ref="'.$id.'">Save changes</div>
					</div>
				</div>';
		}elseif($modal['modal']['descType'] == 'pricingtable'){
		/*
		**	Pricing Table Elem
		*/
		
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];
			
			$linkString = '';
			$max_width = '';
			$featured_text = $modal['modal']['data']['data']['featuredText'];
			$show_details_in_tables = checked("true", (isset($modal['modal']['data']['data']['show_details_in_tables']) ? $modal['modal']['data']['data']['show_details_in_tables'] : false ), false);



			$i = 0;
			
			$optionNames = '';
			
			if($modal['modal']['data']['data']['optionNames']){
				$i = 0;
				foreach($modal['modal']['data']['data']['optionNames'] as $optionName){
					$optionNames .= '
						<div class="new-option new-option-'.$i.'">
							<div class="row-fluid escape_hover">
							<div class="btn btn-mini btn-danger span3 remove_option_button" ref="new-option-'.$i.'"><i class="fa fa-times"></i></div><input autocomplete="off" autocomplete="off" type="text" class="span9" value="'.$optionName.'" data-toggle="tooltip" data-placement="right" title="Enter your option name (i.e. Bandwidth, Traffic, OS)" />
							</div>
							<h4 style="margin:'.($i===0 ? '0.41em 0;' : '0.41em 0;').'">Option Icon : </h4>
						</div>';
					
					$i++;
				}
			}
			
			$tables = '';
			$total_tables = 0;
			
			if($modal['modal']['data']['data']['tables']){
				foreach($modal['modal']['data']['data']['tables'] as $table){
					
					$is_featured = checked("true", (isset($table['packageFeatured']) ? $table['packageFeatured'] : false ), false);
					
					$button_json_data = isset($table['button_json_data']) ? $table['button_json_data'] : '';
					$button_shortcode = isset($table['button_shortcode']) ? $table['button_shortcode'] : '';
					
					
					$columns = '';
					$t = 0;
					
					foreach($table['packageOptions'] as $detail){
						$icon_class = isset($detail['icon_class']) ? $detail['icon_class'] : '';
						$icon_url = isset($detail['icon_url']) ? $detail['icon_url'] : '';
						$icon_used = ($icon_class != "" || $icon_url != "") ? true : false;
						
						$columns .= '
						<div class="new-option new-option-'.$t.'">
							<input autocomplete="off" autocomplete="off" type="text" value="'.$detail['value'].'" data-toggle="tooltip" data-placement="right" title="Enter your option name (i.e. Bandwidth, Traffic, OS)" />
							<div class="elem-icon">
								<div class="icon-holder add-elem-icon-btn" style="font-size:4px !important;" icon-ref="'.$icon_class.'">'.(($icon_class != "") ? '<i class="'.$icon_class.' fa-4x"></i>' : '').'</div>
								<input autocomplete="off" autocomplete="off" type="text" size="36" class="add-elem-icon-text" '.($icon_url != "" ? "": 'style="display:none;"').' value="'.($icon_url != "" ? $icon_url : "").'"/>
								'.(!$icon_used ? '<div class="add-elem-icon-btn btn btn-small">Add Icon</div>' : '<div class="add-elem-icon-btn btn hide">Add Icon</div>').'
								'.($icon_used ? '<div class="remove-elem-icon-btn btn btn-small">Remove Icon</div>' : '<div class="remove-elem-icon-btn btn btn-small hide">Remove Icon</div>').'
							</div>
						</div>';	
						$t++;
					}
					

					
										
					$tables .= '
						<div class="span2 table-elem">
							<input autocomplete="off" autocomplete="off" type="text" name="package_name" class="pt-package-name" value="'.$table['packageName'].'" data-toggle="tooltip" data-placement="bottom" title="Enter your package name (i.e. Basic, Platinum, Gold)" />
							<input autocomplete="off" autocomplete="off" type="text" name="package_detail" class="pt-package-detail" value="'.(isset($table['packageDetail']) ? $table['packageDetail'] : '').'" data-toggle="tooltip" data-placement="bottom" title="Enter your package small detail (i.e. Classic Plan)" />
							<div class="set_featured_holder" style="padding:6px 0px 2px;" data-toggle="tooltip" data-placement="bottom" title="Set featured package (You can only set one featured package)">
								<label for="set_featured"><input autocomplete="off" autocomplete="off" type="checkbox" value="1" class="set_featured" name="set_featured" ref="'.$id.'" '.$is_featured.' /> Set Featured</label>
							</div>
							<input autocomplete="off" type="text" name="package_time" class="pt-package-time" value="'.$table['packageTime'].'" data-toggle="tooltip" data-placement="bottom" title="Package\'s time amount (i.e. Monthly, Yearly)" />
							<hr / >
							<input autocomplete="off" type="text" class="price" value="'.$table['packagePrice'].'" data-toggle="tooltip" data-placement="bottom" title="Enter the price (i.e. $29.9, £18.40)" />
							<hr />
							'.$columns.'
							<hr class="pt-footer" />
							
							<div class="pricing-table-button" id-ref="'.$total_tables.'">
								<input autocomplete="off" id="button_data_'.$total_tables.'" class="button_json_data" type="hidden" value="'.esc_attr($button_json_data).'" />
								<input autocomplete="off" id="button_shortcode_'.$total_tables.'" class="button_shortcode" type="hidden" value="'.esc_attr($button_shortcode).'" />
								<div class="btn btn-small btn-block advanced_details_make_button_modal" id_ref="button_shortcode_'.$total_tables.'" id_data_ref="button_data_'.$total_tables.'"><i class="fa fa-gear"></i> Edit Button</div>
							</div>
							
							<hr />
							<div class="button pt-remove-package-button" style="width:100%;" data-toggle="tooltip" title="Delete current package" ref="'.$id.'"><i class="icon-trash"></i> Delete Package</div>
						</div>';
						
					$total_tables++;
				}
			}
						
			$return .= '<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" aria-hidden="true">
							<div class="modal-header">
								<div class="close builder-close"><i class="fa fa-times"></i></div>
								<h3>Pricing Table</h3>
							</div>
								<div class="modal-body" data-saved="false">
									<br />
									<div class="pricing-table-modal">
										<div class="pt-demo row-fluid">
											<div class="span2 main-details header-details" style="background-color:#006dcc; color:#fff; border:1px solid #0044cc; border-radius:4px;">
												<h4 style="margin:0.60em 0;">Package Name : </h4>
												<h4 style="margin:0.60em 0;">Package Detail : </h4>
												<h4 style="margin:0.60em 0;">Featured : </h4>
												<h4 style="margin:0.70em 0;">Package Time : </h4>
												<hr />
												<h4 style="margin:0.9em 0;">Price :</h4>
												<hr style="margin-top:0.68em;" />
												<div class="option-name-holder">
												'.$optionNames.'
												</div>
												<hr />
												<h4 style="margin:0.8em 0;">Button :</h4>
												<h4 style="margin:0.8em 0;">Button Name :</h4>
												<h4 style="margin:0.8em 0;">Button Link :</h4>
												<hr />
												<h4>Add New Option</h4>
												<div class="button pt-add-new-option" ref="'.$id.'" data-toggle="tooltip" title="Add a new option field"><i class="fa fa-plus"></i> New Option</div>
											</div>
											'.$tables;
							if($total_tables < 5){
								$return .= '<div class="span2 main-details new-package-button-holder" style="background-color:#006dcc; color:#fff; border:1px solid #0044cc; border-radius:4px; text-align:center;">
												<h4>Add New Package</h4>
												<div class="button pt-add-new-package" ref="'.$id.'" data-toggle="tooltip" title="Add a new package"><i class="fa fa-plus"></i> New Package</div>
												<br />
												<br />
											</div>';
							}
								$return .= '</div>
										<br />
										<hr />
										<h2 style="margin-bottom:0px;">General Settings</h2>
										<div class="pt-general-settings row-fluid">
											<div class="span2">
												<h4>Featured Text</h4>
												<input autocomplete="off" name="featured_text" class="featured_text" type="text" value="'.$featured_text.'" data-toggle="tooltip" data-placement="top" title="Featured text (i.e. Hot!, Featured, Recommended)" />
											</div>
											<div class="span2">
												<h4>Show Details in Tables</h4>
												<label for="show_details_in_tables"><input autocomplete="off" type="checkbox" value="1" class="show_details_in_tables" name="show_details_in_tables" ref="'.$id.'" '.$show_details_in_tables.' /> Activate</label>
											</div>
										</div>
										<br />
									</div>
								</div>
								<div class="modal-footer row-fluid" style="padding:0px; text-align:left;">
									<div class="span9" style="padding:14px 15px 15px; text-align:left;">
										<div class="btn turnonoff-tooltips">
											<i class="fa fa-gear"></i>
											<span class="tooltipstext">Turn Off Tooltips</span>
										</div>
									</div>
									<div class="span3" style="padding:14px 15px 15px; text-align:right;">
										<div class="btn builder-close">Close</div>
										<div class="btn btn-primary pricingtable-save" ref="'.$id.'">Save changes</div>
									</div>
								</div>
							</div>';
			
			//Activate tooltips
			$script = '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("[data-toggle=tooltip]").tooltip({html:true});
				});
			</script>
			';
			
			$return .= $script;
		
		}elseif($modal['modal']['descType'] == 'curvyslider'){
		/*
		**	Curvy Slider Elem
		*/

			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];
			
			
			$auto_play = checked("true", (isset($modal['modal']['data']['data']['autoPlay']) ? $modal['modal']['data']['data']['autoPlay'] : false ), false);
			$slider_bottom_divider = isset($modal['modal']['data']['data']['slider_bottom_divider']) ? $modal['modal']['data']['data']['slider_bottom_divider'] : '';
						
			$return .= '
				<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-header">
						<div class="close builder-close"><i class="fa fa-times"></i></div>
						<h3>Curvy Slider</h3>
					</div>
					<div class="modal-body" data-saved="false">
						<div class="row-fluid">
							<div class="span6 curvyslider_list_holder">
								'.curvy_get_slider_list(isset($modal['modal']['data']['data']['slider_basic_shortcode']) ? $modal['modal']['data']['data']['slider_basic_shortcode'] : '', $id, false).'
							</div>
							<div class="span6">
								<strong>Choose Curvy Slider</strong><br/>
								<p>You can choose any of your saved Curvy Sliders.</p>
							</div>
						</div>
						<hr />
						<div class="row-fluid">
							<div class="span6">
								<div class="slider_width_holder">
									<select class="slider_bottom_divider" autocomplete="off">
										<option value="" '.($slider_bottom_divider === '' ? 'selected' : '').'>Empty</option>
										<option value="use_border" '.($slider_bottom_divider === 'use_border' ? 'selected' : '').'>Add Border Under Slider</option>
										<option value="use_shadow" '.($slider_bottom_divider === 'use_shadow' ? 'selected' : '').'>Add Shadow Under Slider</option>
									</select>
								</div>
							</div>
							<div class="span6">
								<strong>Border, Shadow Details</strong><br/>
								<p>You can choose to add border or shadow at the bottom of the slider. If you don\'t want both of them, you can choose "Empty"</p>
							</div>
						</div>
						<hr/>
						<div class="row-fluid">
							<div class="span6">
								<div class="activate_autoplay_holder">
									<input autocomplete="off" type="checkbox" value="1" class="activate_autoplay" name="activate_autoplay" '.$auto_play.' /><label for="activate_autoplay"> Activate Autoplay</label>
								</div>
							</div>
							<div class="span6">
								<strong>Auto Play</strong><br/>
								<p>If you check this option, slider will start to play automatically.</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="btn builder-close">Close</div>
						<div class="btn btn-primary curvyslider-save builder-close" ref="'.$id.'">Save changes</div>
					</div>
			</div>';
			
			
		}elseif($modal['modal']['descType'] == 'sidebar'){
		/*
		**	Sidebar Elem
		*/

			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];
						
			$return .= '
			<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1"  aria-hidden="true">
				<div class="modal-header">
					<div class="close builder-close"><i class="fa fa-times"></i></div>
					<h3>Sidebar</h3>
				</div>
				<div class="modal-body" data-saved="false">
					<div class="row-fluid">
						<div class="span6 sidebar_list_holder">
							'.rock_builder_get_sidebar_list($modal['modal']['data']['data']['id']).'
						</div>
						<div class="span6">
							<strong>Choose a Sidebar</strong><br/>
							<p>You can insert widgets into your sidebars and use these sidebars in your page layout</p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="btn builder-close">Close</div>
					<div class="btn btn-primary sidebar-save builder-close" ref="'.$id.'">Save changes</div>
				</div>
			</div>';
			
			
		}elseif($modal['modal']['descType'] == 'toggles'){
		/*
		**	Toggles Elem
		*/

			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];
			
			$avoid_sidebar = checked("true", (isset($modal['modal']['data']['data']['avoidSidebar']) ? $modal['modal']['data']['data']['avoidSidebar'] : false ), false);
			$toggleType = $modal['modal']['data']['data']['toggleType'];
			$boxed_layout = checked("true", (isset($modal['modal']['data']['data']['boxed_layout']) ? $modal['modal']['data']['data']['boxed_layout'] : false ), false);
			$use_shadow = checked("true", (isset($modal['modal']['data']['data']['use_shadow']) ? $modal['modal']['data']['data']['use_shadow'] : false ), false);
			$open_toggle_index = intval(isset($modal['modal']['data']['data']['openToggleIndex']) ? $modal['modal']['data']['data']['openToggleIndex'] : 0);
			
			$togglesString = '';

			if(isset($modal['modal']['data']['data']['toggles']) && is_array($modal['modal']['data']['data']['toggles'])){
				foreach($modal['modal']['data']['data']['toggles'] as $toggle){
					$togglesString .= '
						<li class="toggles-block">
							<div class="hide secret-desc" toggle-title="'.$toggle['title'].'" icon_class="'.$toggle['icon_class'].'" icon_url="'.$toggle['icon_url'].'">'.$toggle['text'].'</div>
							<i class="drag fa fa-move"></i>
							<span class="toggle-name" ref="'.$id.'">'.$toggle['title'].'</span>
							<i class="close fa fa-times"></i>
						</li>';
				}
			}
						
			$return .= 
			'<div id="'.$id.'" modalType="toggles" class="rpb_modal container hide fade" >
								<div class="modal-header">
									<div class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></div>
					  				<h3>Add Toggle</h3>
								</div>
								<div class="modal-body" data-saved="false">
									<div class="row-fluid">
										<div class="toggles-elements-holder span6">
											<ul class="toggles-list">
												'.$togglesString.'
											</ul>
											<div class="btn btn-small add-new-toggle-btn" ref="'.$id.'"><i class="fa fa-plus"></i> Add</div>
										</div>
										<div class="span6">
											<strong>Add/Remove Toggles</strong><br/>
											<p>You can easily add remove toggles by clicking to add new button</p>
										</div>
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<select class="toggle-type" autocomplete="off">
												<option value="single-mode" '.($toggleType == "single-mode" ? 'selected' : '').'>Toggle Single</option>
												<option value="multiple-mode" '.($toggleType == "multiple-mode" ? 'selected' : '').'>Toggle Multiple (Accordion)</option>
											</select>
										</div>
										<div class="span6">
											<strong>Choose Toggle Type</strong><br/>
											<p>You can choose multiple mode or single mode. If you choose multiple mode, when a toggle opens, it will close other toggles.</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<div class="open_toggle_index_holder">
												<input autocomplete="off" type="text" value="'.$open_toggle_index.'" class="open_toggle_index" name="open_toggle_index" />
											</div>
										</div>
										<div class="span6">
											<strong>Open Toggle Index</strong><br/>
											<p>Index of the toggle will be open. If you want your first toggle to be open enter 0. If you want all toggles to be closed enter -1</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<div class="boxed_layout_holder">
												<input autocomplete="off" class="boxed_layout" type="checkbox" value="true" name="boxed_layout" '.$boxed_layout.' /><label for="activate_hover"> Use Boxed Layout</label>
											</div>
										</div>
										<div class="span6">
											<strong>Boxed Layout</strong><br/>
											<p>If you want to wrap a boxed layout around this element, check this option.</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<div class="use_shadow_holder">
												<input autocomplete="off" class="use_shadow" type="checkbox" value="true" name="use_shadow" '.$use_shadow.' /><label for="activate_hover"> Use Shadow</label>
											</div>
										</div>
										<div class="span6">
											<strong>Use Header Shadow</strong><br/>
											<p>This option will activate/deactivate the shadows under the header text.</p>
										</div>										
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
									<div class="btn btn-primary toggles-save builder-close">Save changes</div>
								</div>
							</div>';
							
			$return .= '
				<script type="text/javascript">
					jQuery(document).ready(function(){
						jQuery("#'.$id.' .toggles-list" ).sortable({
							handle : "i.drag",
						});
					});
				</script>';
			
		}elseif($modal['modal']['descType'] == 'tabs'){
		/*
		**	Tabs Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_tabs_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'iconictext'){
		/*
		**	Iconic Text Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_iconictext_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'button'){
		/*
		**	Button Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_button_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'skill'){
		/*
		**	Skill Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_skill_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'horizontalrule'){
		/*
		**	Horizontal Rule Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_hr_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'portfolio'){
		/*
		**	Portfolio Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_portfolio_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'googlemap'){
		/*
		**	Google Map Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_googlemap_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'promotionbox'){
		/*
		**	Promotion Box Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_promotionbox_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'alertbox'){
		/*
		**	Alert Box Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_alertbox_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'referencesbuilder'){
		/*
		**	References Builder Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_referencesbuilder_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'testimonialsbuilder'){
		/*
		**	Testimonials Builder Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_testimonialsbuilder_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'socialicons'){
		/*
		**	Social Icons
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_socialicons_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'teammembers'){
		/*
		**	Team Members
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_teammembers_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'beforeafterslider'){
		/*
		**	Before After Slider
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_beforeafterslider_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'externalshortcode'){
		/*
		**	External Shortcode
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_externalshortcode_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'regularblog'){
		/*
		**	Regular Blog
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_regularblog_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'gallery'){
		/*
		**	Gallery
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_gallery_modal($modal,$id);
		}elseif($modal['modal']['descType'] == 'rockformbuilder'){
		/*
		**	Rock Form Builder Elem
		*/
			$id = explode('-',$modal['id']);
			$id = 'modal-'.$id[1];

			$return .= xr_make_rockformbuilder_modal($modal,$id);
		}
	}

	return $return;
}





/*
**	Gallery Modal
*/

function xr_make_gallery_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	
	$image_sizes = isset($modal['modal']['data']['data']['imageSize']) ? $modal['modal']['data']['data']['imageSize'] : '';
	
	$totalProducts = isset($modal['modal']['data']['data']['total']) ? $modal['modal']['data']['data']['total'] : 18;
	
	$chosenCategory = isset($modal['modal']['data']['data']['category']) ? $modal['modal']['data']['data']['category'] : '';
	$chosenPostType = isset($modal['modal']['data']['data']['postType']) ? $modal['modal']['data']['data']['postType'] : '';
	
	$header_title = isset($modal['modal']['data']['data']['header_title']) ? $modal['modal']['data']['data']['header_title'] : "";
	
	$activate_hover_box = checked("true", (isset($modal['modal']['data']['data']['activate_hover_box']) ? $modal['modal']['data']['data']['activate_hover_box'] : false ), false);
	$activate_hover = checked("true", (isset($modal['modal']['data']['data']['activate_hover']) ? $modal['modal']['data']['data']['activate_hover'] : false ), false);
	$disable_hover_link = checked("true", (isset($modal['modal']['data']['data']['disable_hover_link']) ? $modal['modal']['data']['data']['disable_hover_link'] : false ), false);
			
	$boxed_layout = checked("true", (isset($modal['modal']['data']['data']['boxed_layout']) ? $modal['modal']['data']['data']['boxed_layout'] : false ), false);

	$excerpt_title_option = isset($modal['modal']['data']['data']['excerpt_title_option']) ? $modal['modal']['data']['data']['excerpt_title_option'] : '';
	$excerpt_length = isset($modal['modal']['data']['data']['excerpt_length']) ? $modal['modal']['data']['data']['excerpt_length'] : 18;
	
	$pagination = checked("true", (isset($modal['modal']['data']['data']['pagination']) ? $modal['modal']['data']['data']['pagination'] : false ), false);
	$masonry = checked("true", (isset($modal['modal']['data']['data']['masonry']) ? $modal['modal']['data']['data']['masonry'] : false ), false);
	$load_more = checked("true", (isset($modal['modal']['data']['data']['load_more']) ? $modal['modal']['data']['data']['load_more'] : false ), false);
	$lightbox_gallery = checked("true", (isset($modal['modal']['data']['data']['lightbox_gallery']) ? $modal['modal']['data']['data']['lightbox_gallery'] : false ), false);
	
	$activate_category_link = isset($modal['modal']['data']['data']['activate_category_link']) ? $modal['modal']['data']['data']['activate_category_link'] : "";
	$activate_header_link = isset($modal['modal']['data']['data']['activate_header_link']) ? $modal['modal']['data']['data']['activate_header_link'] : "";
	
	$use_shadow = checked("true", (isset($modal['modal']['data']['data']['use_shadow']) ? $modal['modal']['data']['data']['use_shadow'] : false ), false);
	
	$excerpt_length_html = '<select class="excerpt_length" autocomplete="off">';
	for($e = 0; $e<150; $e++){
		if($e == $excerpt_length){
			$excerpt_length_html .= '<option value="'. $e .'" selected="selected">'.$e.'</option>';
		}else{
			$excerpt_length_html .= '<option value="'. $e .'">'.$e.'</option>';
		}
	}
	$excerpt_length_html .= '</select>';
	
	
	$totalItemsToShow = '<div class="total_show_holder"><h4>Select Total Item To Show</h4><select class="total_show" autocomplete="off">';
	for($i = 1; $i< 100; $i++){
		if($totalProducts == $i){
			$totalItemsToShow .= '<option value="'.$i.'" selected>'.$i.'</option>';
		}else{
			$totalItemsToShow .= '<option value="'.$i.'">'.$i.'</option>';
		}
	}
	$totalItemsToShow .= '</select></div>';
		
	
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Gallery" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Gallery</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6 image_sizes_column"  bind="'.$id.'" calc="true">
					'.rock_builder_get_image_sizes($image_sizes, $id, '').'
				</div>
				<div class="span6">
					<strong>Choose image size</strong><br/>
					<p>You can choose any image sizes for Gallery.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid post_type_tax_holder">
				<div class="span6">
					'.rock_builder_get_customposttypes($chosenPostType, $id, '').'
					'.rock_builder_get_taxonomies($chosenCategory, $chosenPostType, '').'
				</div>
				<div class="span6">
					<strong>Choose A Post Type</strong></br>
					<p>Choose the post type</p><br/>
					<strong>Choose Taxonomies/Categories to Display</strong></br>
					<p>Choose categories/taxonomies. You can choose multiple categories/taxonomies or just single taxonomy/category. You can also choose all categories/taxonomies by choosing the "All".</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					'.rockthemes_excerpt_title_option($excerpt_title_option).'
				</div>
				<div class="span6">
					<strong>Description</strong>
					<p>You can choose the description details.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					'.$excerpt_length_html.'
				</div>
				<div class="span6">
					<strong>Excerpt Length</strong>
					<p>You can adjust the excerpt length in words. Which means if you choose 10, your excerpt will show up to 10 words from your originial excerpt.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="header_title" value="'.$header_title.'" />
				</div>
				<div class="span6">
					<strong>Header Title</strong>
					<p>You can choose to use a header title for gallery. If you leave this area empty, header title will not be displayed.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="activate_header_link" autocomplete="off">
						<option value="true" '.($activate_header_link === 'true' ? 'selected' : '').'>Activate Header Link</option>
						<option value="false" '.($activate_header_link === 'false' ? 'selected' : '').'>Deactivate Header Link</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Header Link</strong>
					<p>If you activate header link, header will link to the gallery.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="activate_category_link" autocomplete="off">
						<option value="true" '.($activate_category_link === 'true' ? 'selected' : '').'>Activate Category Link</option>
						<option value="false" '.($activate_category_link === 'false' ? 'selected' : '').'>Deactivate Category Link</option>
					</select>
				</div>
				<div class="span6">
					<strong>Category Links</strong>
					<p>You can activate the category link under the title. This will show the links of the categories for the gallery.</p>
				</div>
			</div>
			<hr/>
			'.rock_builder_get_block_grid_list(
				(isset($modal['modal']['data']['data']['block_grid_large']) ? intval($modal['modal']['data']['data']['block_grid_large']) : ''),
				(isset($modal['modal']['data']['data']['block_grid_medium']) ? intval($modal['modal']['data']['data']['block_grid_medium']) : ''),
				(isset($modal['modal']['data']['data']['block_grid_small']) ? intval($modal['modal']['data']['data']['block_grid_small']) : '')
			).'
			<div class="row-fluid">
				<div class="span6">
					'.$totalItemsToShow.'
				</div>
				<div class="span6">
					<strong>Total Gallery Image to Show</strong></br>
					<p>This will set up the total gallery image per page. If you choose 18, you will be showing 18 products for each page. If you activate this option, load more option will be disabled</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="pagination_holder">
						<input autocomplete="off" class="pagination" type="checkbox" value="true" name="pagination" '.$pagination.' /><label for="activate_hover_box"> Activate Pagination</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Pagination</strong></br>
					<p>You can activate / deactivate the pagination. If you want to activate the pagination check this option.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="masonry_holder">
						<input autocomplete="off" class="masonry" type="checkbox" value="true" name="masonry" '.$masonry.' /><label for="activate_hover_box"> Activate Masonry</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Masonry</strong></br>
					<p>You can activate / deactivate the masonry. If you activated pagination, masonry will not work. You need uncheck pagination if you want to use masonry.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="load_more_holder">
						<input autocomplete="off" class="load_more" type="checkbox" value="true" name="load_more" '.$load_more.' /><label for="activate_hover_box"> Activate Load More</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Load More</strong></br>
					<p>You can activate / deactivate the load more. Load more option will only work if you have activated the masonry.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="lightbox_gallery_holder">
						<input autocomplete="off" class="lightbox_gallery" type="checkbox" value="true" name="lightbox_gallery" '.$lightbox_gallery.' /><label for="lightbox_gallery"> Lightbox Gallery</label>
					</div>
				</div>
				<div class="span6">
					<strong>Lightbox Gallery</strong></br>
					<p>This feature will add a navigation to the lightbox. With this navigation you can switch between your gallery elements</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="activate_hover_holder">
						<input autocomplete="off" class="activate_hover" type="checkbox" value="true" name="activate_hover" '.$activate_hover.' /><label for="activate_hover"> Activate Hover Effect</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Regular Hover Effect</strong></br>
					<p>This option will show the regular hover effect with PrettyPhoto (lightbox).</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="disable_hover_link_holder">
						<input autocomplete="off" autocomplete="off" class="disable_hover_link" type="checkbox" value="true" name="disable_hover_link" '.$disable_hover_link.' /><label for="activate_hover"> Disable Hover Link</label>
					</div>
				</div>
				<div class="span6">
					<strong>Disable Hover Link</strong></br>
					<p>If you want to disable the link in the hover effect check this option.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="boxed_layout_holder">
						<input autocomplete="off" class="boxed_layout" type="checkbox" value="true" name="boxed_layout" '.$boxed_layout.' /><label for="boxed_layout"> Use Boxed Layout</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Boxed Layout</strong></br>
					<p>You can easily activate/deactivate boxed layout.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="use_shadow_holder">
						<input autocomplete="off" class="use_shadow" type="checkbox" value="true" name="use_shadow" '.$use_shadow.' /><label for="use_shadow"> Use Shadow</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Shadow</strong></br>
					<p>If you activate shadow, there will be a shadow under images.</p>
				</div>
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary gallery-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';
		

	return $return;
}

function xr_make_gallery_modal_ajax(){
	echo xr_make_gallery_modal();
	exit;
}
add_action('wp_ajax_xr_make_gallery_modal','xr_make_gallery_modal_ajax');













/*
**	Regular Blog
**
*/
function xr_make_regularblog_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	
	//Default Values
	$regular_content = 'true';
	$image_size = 'thumbnail';
	$hover_active = 'false';
	$image_col = '3';
	$excerpt_length = 30;
	$header_link = 'true';
	$show_categories = 'true';
	$show_tags = 'true';
	$show_date = 'true';
	$space_height = '15px';
	$pagination = 'true';
	$total = 5;
	$sticky_first = 'false';
	
	if(!empty($modal['modal']['data']['data'])){
		extract($modal['modal']['data']['data']);	
	}
	
	
	$excerpt_length_html = '<select class="excerpt_length" autocomplete="off">';
	for($e = 0; $e<150; $e++){
		if($e == $excerpt_length){
			$excerpt_length_html .= '<option value="'. $e .'" selected="selected">'.$e.'</option>';
		}else{
			$excerpt_length_html .= '<option value="'. $e .'">'.$e.'</option>';
		}
	}
	$excerpt_length_html .= '</select>';
		
	
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Regular Blog</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid regularblog">
				<div class="span6">
					<select class="regular_content" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($regular_content == 'true' ? 'selected' : '').'>Use Regular Content (Supports Different Blog Post Types)</option>
						<option value="false" '.($regular_content == 'false' ? 'selected' : '').'>Do Not Use Regular Content (Displays Plain Content)</option>
					</select>
				</div>
				<div class="span6">
					<strong>Use Regular Blog Content</strong><br/>
					<p>You can choose to if you want to display regular blog content with blog post types such as "gallery", "video" and "image".</p>
				</div>
			</div>
			<hr/>
			<span class="regular-content-details toggle-span" '.($regular_content === 'true' ? 'style="display:none;"' : '').'>
			
			<div class="row-fluid">
				<div class="span6 image_sizes_holder">
					'.rock_builder_get_image_sizes($image_size, $id, '').'
				</div>
				<div class="span6">
					<strong>Choose a Size</strong></br>
					<p>You can choose different image sizes for your image. You can also adjust image sizes in Theme Options</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="hover_active" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($hover_active == 'true' ? 'selected' : '').'>Activate Image Hover Effect</option>
						<option value="false" '.($hover_active == 'false' ? 'selected' : '').'>Do Not Activate Image Hover Effect</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Hover Effect</strong><br/>
					<p>You can choose to activate or deactivate hover effect of the image.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					'.rock_builder_get_block_grid_large_list($image_col).'
				</div>
				<div class="span6">
					<strong>Image Column</strong><br/>
					<p>You can choose a column 1 to 12 for the image area. If you want to display a big image, you may want to use a higher image columns</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					'.$excerpt_length_html.'
				</div>
				<div class="span6">
					<strong>Excerpt Length</strong>
					<p>You can adjust the excerpt length in words. Which means if you choose 10, your excerpt will show up to 10 words from your originial excerpt.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="header_link" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($header_link == 'true' ? 'selected' : '').'>Activate Header Link</option>
						<option value="false" '.($header_link == 'false' ? 'selected' : '').'>Do Not Activate Header Link</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Header Link</strong><br/>
					<p>You can choose to activate or deactivate header link.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="show_categories" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($show_categories == 'true' ? 'selected' : '').'>Show Categories</option>
						<option value="false" '.($show_categories == 'false' ? 'selected' : '').'>Do Not Show Categories</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Categories</strong><br/>
					<p>You can choose to display or hide categories</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="show_tags" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($show_tags == 'true' ? 'selected' : '').'>Show Tags</option>
						<option value="false" '.($show_tags == 'false' ? 'selected' : '').'>Do Not Show Tags</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Tags</strong><br/>
					<p>You can choose to display or hide tags</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="show_date" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($show_date == 'true' ? 'selected' : '').'>Show Date</option>
						<option value="false" '.($show_date == 'false' ? 'selected' : '').'>Do Not Show Date</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Date</strong><br/>
					<p>You can choose to display or hide date</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="space_height" value="'.$space_height.'" />
				</div>
				<div class="span6">
					<strong>Space Height</strong><br/>
					<p>Height of the space between posts</p>
				</div>
			</div>
			<hr/>
			
			</span>
			
			<div class="row-fluid">
				<div class="span6">
					<select class="pagination" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($pagination == 'true' ? 'selected' : '').'>Activate Pagination</option>
						<option value="false" '.($pagination == 'false' ? 'selected' : '').'>Do Not Activate Pagination</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Pagination</strong><br/>
					<p>You can choose to activate / deactivate pagination</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="total" value="'.$total.'" />
				</div>
				<div class="span6">
					<strong>Total Posts</strong><br/>
					<p>How many posts will be displayed? If you use "pagination", this will show how many posts will be displayed per page.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="sticky_first" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($sticky_first == 'true' ? 'selected' : '').'>Show Sticky At First</option>
						<option value="false" '.($sticky_first == 'false' ? 'selected' : '').'>Do Not Show Sticky At First</option>
					</select>
				</div>
				<div class="span6">
					<strong>Show Sticky First</strong><br/>
					<p>You can choose to display sticky as first or not</p>
				</div>
			</div>
			<hr/>
			
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary regularblog-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';



	return $return;
}
function xr_make_regularblog_modal_ajax(){
	echo xr_make_regularblog_modal();
	exit;
}
add_action('wp_ajax_xr_make_regularblog_modal', 'xr_make_regularblog_modal_ajax');









/*
**	External Code Modal
**
**	Makes a text area without TinyMCE to insert any code / shortcode
*/
function xr_make_externalshortcode_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	
	//Default Values
	$shortcode				=	'';
	
	if(!empty($modal['modal']['data']['data'])){
		extract($modal['modal']['data']['data']);	
	}		
	
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>External Code</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6 shortcode_holder">
					<textarea rows="4" cols="50" class="shortcode">'.esc_textarea($shortcode).'</textarea>
				</div>
				<div class="span6">
					<strong>Enter Your Shortcode / Code</strong></br>
					<p>Some external plugins and sliders might embed external JS or CSS codes. You can use this element to enter your external shortcode or code</p>
				</div>
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary externalshortcode-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';



	return $return;
}
function xr_make_externalshortcode_modal_ajax(){
	echo xr_make_externalshortcode_modal();
	exit;
}
add_action('wp_ajax_xr_make_externalshortcode_modal', 'xr_make_externalshortcode_modal_ajax');










/*
**	Before After Slider Modal
**
**	Makes a special presentation with two images as before and after
*/
function xr_make_beforeafterslider_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	
	//Default Values
	$image_size				=	'large';
	$before_image_url		=	'';
	$after_image_url		=	'';
	$height					=	'400px';
	$min_width				=	'540px';
	$activate_navigation	=	'true';
	
	if(!empty($modal['modal']['data']['data'])){
		extract($modal['modal']['data']['data']);	
	}
		
	
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Before After Slider</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6 image_sizes_holder">
					'.rock_builder_get_image_sizes($image_size, $id, '').'
				</div>
				<div class="span6">
					<strong>Choose a Size</strong></br>
					<p>You can choose different image sizes for your image. You can also adjust image sizes in Theme Options</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="beforeafter-before-image" ref="beforeafter-image-uploader">
						<h4>Choose an Image</h4>
						<div class="hide image-data"></div>
						<label for="upload_image"> <input autocomplete="off" id="'.$id.'before_image_url" class="upload_image_button before_image_url" size="36" name="upload_image" type="text" value="'.$before_image_url.'" /> <input autocomplete="off" class="image_uploader_class btn" value="Upload Image" type="button" /> </label><br/>
					</div>
				</div>
				<div class="span6">
					<h3>Before Image</h3>
					<p>This image will be displayed as before image at the left side</p>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="beforeafter-after-image" ref="beforeafter-image-uploader">
						<h4>Choose an Image</h4>
						<div class="hide image-data"></div>
						<label for="upload_image"> <input autocomplete="off" id="'.$id.'after_image_url" class="upload_image_button after_image_url" size="36" name="upload_image" type="text" value="'.$after_image_url.'" /> <input autocomplete="off" class="image_uploader_class btn" value="Upload Image" type="button" /> </label><br/>
					</div>
				</div>
				<div class="span6">
					<h3>After Image</h3>
					<p>This image will be displayed as after image at the right side</p>
				</div>
			</div>
			<div class="row-fluid hide">
				<div class="span6">
					<input autocomplete="off" type="text" class="height" value="'.$height.'" />
				</div>
				<div class="span6">
					<strong>Height</strong><br/>
					<p>Height of the image field</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid hide">
				<div class="span6">
					<input autocomplete="off" type="text" class="min_width" value="'.$min_width.'" />
				</div>
				<div class="span6">
					<strong>Min Width</strong><br/>
					<p>Min width value for responsive screen size. Regular width will be setted according to the column width</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid hide">
				<div class="span6">
					<select class="activate_navigation" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($activate_navigation == 'true' ? 'selected' : '').'>Activate Navigation</option>
						<option value="false" '.($activate_navigation == 'false' ? 'selected' : '').'>Do Not Activate Navigation</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Navigation</strong><br/>
					<p>If you activate navigation, there will be two buttons to go to next and previous logo groups.</p>
				</div>
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary beforeafterslider-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';



	return $return;
}
function xr_make_beforeafterslider_modal_ajax(){
	echo xr_make_beforeafterslider_modal();
	exit;
}
add_action('wp_ajax_xr_make_beforeafterslider_modal','xr_make_beforeafterslider_modal_ajax');







/*
**	Team Members Modal
*/

function xr_make_teammembers_modal($modal=null,$id=null){
	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	$return = '';
	
	
	$teammembers_title = '';
	$social_icons_title = '';
	$script = '';
	$columns_html = '';
	$selected_columns = 4;
	
	$teammembersString = '												
		<li class="teammembers-block active">
			<div class="hide secret-desc" company="RockthemesNet" teammembers-title="teammembers Awesome" icon_class="" icon_url="" external_url="" member_image_url=""><p>teammembers Awesome Content</p></div>
			<div class="hide social_data"></div>
			<div class="hide social_shortcode"></div>
			<i class="drag fa fa-move"></i>
			<span class="teammembers-name" ref="'.$id.'" teammembers-index="0">teammembers Awesome</span>
			<i class="close fa fa-times"></i>
		</li>
		<li class="teammembers-block active">
			<div class="hide secret-desc" company="RockthemesNet" teammembers-title="teammembers Awesome" icon_class="" icon_url="" external_url="" member_image_url=""><p>teammembers Awesome Content</p></div>
			<div class="hide social_data"></div>
			<div class="hide social_shortcode"></div>
			<i class="drag fa fa-move"></i>
			<span class="teammembers-name" ref="'.$id.'" teammembers-index="1">teammembers Awesome</span>
			<i class="close fa fa-times"></i>
		</li>
		';
	
	if(!$is_ajax){
		extract($modal['modal']['data']['data']);
			
		$teammembersString = '';

		if(isset($modal['modal']['data']['data']['teammembers']) && is_array($modal['modal']['data']['data']['teammembers'])){
			foreach($modal['modal']['data']['data']['teammembers'] as $teammembers){
				$teammembersString .= '
					<li class="teammembers-block">
						<div class="hide secret-desc" company="'.$teammembers['company'].'" teammembers-title="'.$teammembers['title'].'"  external_url="'.$teammembers['external_url'].'" member_image_url="'.$teammembers['member_image_url'].'">'.($teammembers['text']).'</div>
						<div class="hide social_data">'.($teammembers['social_data']).'</div>
						<div class="hide social_shortcode">'.($teammembers['social_shortcode']).'</div>
						<i class="drag fa fa-move"></i>
						<span class="teammembers-name" ref="'.$id.'">'.$teammembers['title'].'</span>
						<i class="close fa fa-times"></i>
					</li>';						
			}
		}
			
		$script = '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#'.$id.' .teammembers-list" ).sortable({
						handle : "i.drag",
					});
				});
			</script>';
	}
	
	$columns_html = '
		<select class="selected_columns" autocomplete="off">
			<option value="12" '.((int) $selected_columns === 12 ? 'selected' : '').'>One Block</option>
			<option value="6" '.((int) $selected_columns === 6 ? 'selected' : '').'>Two Block</option>
			<option value="4" '.((int) $selected_columns === 4 ? 'selected' : '').'>Three Block</option>
			<option value="3" '.((int) $selected_columns === 3 ? 'selected' : '').'>Four Block</option>
			<option value="2" '.((int) $selected_columns === 2 ? 'selected' : '').'>Six Block</option>
		</select>
	';
	$selected_columns;
						
	$return .= '
		<div id="'.$id.'" modalType="teammembers" class="rpb_modal container hide fade" >
			<div class="modal-header">
				<div class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></div>
				<h3>Add Team Members</h3>
			</div>
			<div class="modal-body" data-saved="false">
				<div class="row-fluid">
					<div class="teammembers-elements-holder span6">
						<ul class="teammembers-list">
							'.$teammembersString.'
						</ul>
						<div class="btn btn-small add-new-teammembers-btn" ref="'.$id.'"><i class="fa fa-plus"></i> Add</div>
					</div>
					<div class="span6">
						<strong>Add/Remove teammembers</strong><br/>
						<p>You can easily add remove teammembers by clicking to add new button</p>
					</div>
				</div>
				<hr/>
				<div class="row-fluid">
					<div class="span6">
						<input autocomplete="off" type="text" class="teammembers_title" value="'.$teammembers_title.'" />
					</div>
					<div class="span6">
						<strong>Title</strong><br/>
						<p>Title of the teammembers. If you enter a title, it will be displayed as a block at the left.</p>
					</div>
				</div>
				<hr/>
				<div class="row-fluid">
					<div class="span6">
						<input autocomplete="off" type="text" class="social_icons_title" value="'.$social_icons_title.'" />
					</div>
					<div class="span6">
						<strong>Social Icons Title</strong><br/>
						<p>You can add an extra title for the description above the social icons.</p>
					</div>
				</div>
				<hr/>
				<div class="row-fluid">
					<div class="span6">
						'.$columns_html.'
					</div>
					<div class="span6">
						<strong>Choose Block</strong><br/>
						<p>How many blocks will be displayed per row?</p>
					</div>
				</div>
				<hr/>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<div class="btn btn-primary teammembers-save">Save changes</div>
			</div>
		</div>';
					
	return $return.$script;
	
	exit;
}

function xr_make_teammembers_modal_ajax(){
	echo xr_make_teammembers_modal();
	exit;
}
add_action('wp_ajax_xr_make_teammembers_modal', 'xr_make_teammembers_modal_ajax');





function rock_make_single_teammembers_modal($teammembersObj=null, $id=null){
	
	$social = (array('social_data' => '', 'social_shortcode' => ''));
	$member_image_url = '';
	
	if(isset($_REQUEST['teammembers_obj'])){
		$teammembersObj = $_REQUEST['teammembers_obj'];	
		$id = $teammembersObj['id'];
		
		$social = array(
			'social_data' => (stripslashes($teammembersObj['social_data'])), 
			'social_shortcode' => stripslashes($teammembersObj['social_shortcode']),
		);

		if(isset($teammembersObj['member_image_url'])){
			$member_image_url = $teammembersObj['member_image_url'];
		}
	}
		
	
	$return = '
		<div id="teammembers-single-modal" modalType="teammembers" class="rpb_modal container hide fade">
			<div class="modal-header">
				<div class="close close-teammembers-single"><i class="fa fa-times"></i></div>
					<h3>Add Team Member</h3>
				</div>
				<div class="modal-body" data-saved="false">
					<div class="row-fluid">
						<div class="span6">
							<input autocomplete="off" name="teammembers_header" class="teammembers_header" type="text" value="'.esc_attr(stripslashes($teammembersObj['title'])).'" />
						</div>
						<div class="span6">
							<strong>Name</strong><br/>
							<p>Name area</p>
						</div>
					</div>
					<hr/>
					<div class="row-fluid">
						<div class="span6">
							<input autocomplete="off" name="company" class="company" type="text" value="'.$teammembersObj['company'].'" />
						</div>
						<div class="span6">
							<strong>Company / Position</strong><br/>
							<p>Company name or the position of the user</p>
						</div>
					</div>
					<hr/>
					<div class="row-fluid">
						<div class="span6">
							<input autocomplete="off" name="external_url" class="external_url" type="text" value="'.$teammembersObj['external_url'].'" />
						</div>
						<div class="span6">
							<strong>External URL</strong><br/>
							<p>If you want to add an external URL, you can enter your URL here.</p>
						</div>
					</div>
					<hr/>
					<div class="row-fluid">
						<div class="span6">
							<div class="member-modal-image" ref="member-image-uploader">
								<h4>Choose an Image</h4>
								<div class="hide image-data"></div>
								<label for="upload_image"> <input autocomplete="off" id="member-image-uploader" class="upload_image_button member_image_url" size="36" name="upload_image" type="text" value="'.$member_image_url.'" /> <input autocomplete="off" class="image_uploader_class btn" value="Upload Image" type="button" /> </label><br/>
							</div>
						</div>
						<div class="span6">
							<h3>Member Image</h3>
							<p>You can easily upload your team member image.</p>
						</div>
					</div>
					<hr/>
					<div class="row-fluid">
						<div class="span6">
							<div class="social_icons_class" ref="0">
								<input autocomplete="off" class="social_data" id="social-'.$id.'" type="hidden" value="'.esc_attr(($social['social_data'])).'" />
								<input autocomplete="off" class="social_shortcode" id="social-'.$id.'-shortcode" type="text" value="'.esc_attr(($social['social_shortcode'])).'" />
								<div class="button call_social_icons_external" id_ref="social-'.$id.'-shortcode" id_data_ref="social-'.$id.'">Add Social Icons</div>
							</div>
						</div>
						<div class="span6">
							<strong>Social Icons</strong><br/>
							<p>You can add social icons to your team member with their social media links</p>
						</div>
					</div>
					<hr/>
					<div class="row-fluid">
						<div class="span6 teammembers-list">
							<div class="rock-tinymce-container wp-core-ui wp-editor-wrap tmce-active">
								<div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js">
									<div class="wp-editor-tabs">
										<a class="rock-tinymce-switch-text wp-switch-editor switch-tmce" >Visual</a>
										<a class="rock-tinymce-switch-html wp-switch-editor switch-html" >Text</a>
									</div>
									<div id="wp-content-media-buttons" class="wp-media-buttons"><a href="#" id="insert-media-button" class="button insert-media add_media" data-editor="teammembers-single-modal-editor" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a></div>
								</div>
								<div class="wp-content-editor-container wp-editor-container">
									<textarea rows="8" cols="40" class="rock-tinymce-textarea description" initialized="true" name="teammembers-single-modal-editor" id="teammembers-single-modal-editor" class="wp-editor-area"></textarea>
								</div>
							</div>
						</div>
						<div class="span6">
							<strong>teammembers Content</strong><br/>
							<p>Enter your content here. You can use the Rich Text Editor for your content.</p>
						</div>
					</div>
				<hr/>
			</div>
			<div class="modal-footer">
				<div class="btn close-teammembers-single">Close</div>
				<div class="btn btn-primary teammembers-single-save" ref="'.$teammembersObj['index'].'" modal-ref="'.$id.'">Save changes</div>
			</div>
		</div>';


	return $return;
}

function rock_make_single_teammembers_modal_ajax(){
	echo rock_make_single_teammembers_modal();	
	exit;
}

add_action('wp_ajax_rock_make_single_teammembers_modal', 'rock_make_single_teammembers_modal_ajax');






/*
**	Social Icons Modal
*/

function xr_make_socialicons_modal($modal=null,$id=null){
	$is_ajax = false;

	$remove_modal_after = false;
	$return_to = '';
	
	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
		$remove_modal_after = (isset($modal_obj['remove_modal_after']) && $modal_obj['remove_modal_after']) == 'true' ? true : false;
		$return_to = isset($modal_obj['return_to']) ? $modal_obj['return_to'] : '';
		$return_data_to = isset($modal_obj['return_data_to']) ? $modal_obj['return_data_to'] : '';
	}
	
	
	$socialiconsString = '												
		<li class="socialicons-block active">
			<div class="hide secret-desc" socialicons-title="http://www.facebook.com" icon_class="" icon_url=""></div>
			<i class="drag fa fa-move"></i>
			<span class="socialicons-name" ref="'.$id.'" socialicons-index="0">http://www.facebook.com</span>
			<i class="close fa fa-times"></i>
		</li>
		<li class="socialicons-block">
			<div class="hide secret-desc"  socialicons-title="http://www.twitter.com" icon_class="" icon_url=""></div>
			<i class="drag fa fa-move"></i>
			<span class="socialicons-name" ref="'.$id.'" socialicons-index="1">http://www.twitter.com</span>
			<i class="close fa fa-times"></i>
		</li>';
	
	
		if(isset($modal_obj['saved_data']) && !empty($modal_obj['saved_data'])){
					
			$saved_data = json_decode(stripslashes($modal_obj['saved_data']), true);
			
			if(isset($saved_data) && !empty($saved_data) && isset($saved_data['data']) && !empty($saved_data['data'])){
				extract($saved_data['data']);	
				
				$socialiconsString = '';
				
				foreach($socialicons as $icon){					
					$socialiconsString .= '
						<li class="socialicons-block">
							<div class="hide secret-desc" socialicons-title="'.$icon['title'].'" icon_class="'.$icon['icon_class'].'" icon_url="'.$icon['icon_url'].'"></div>
							<i class="drag fa fa-move"></i>
							<span class="socialicons-name" ref="'.$id.'">'.$icon['title'].'</span>
							<i class="close fa fa-times"></i>
						</li>';						
				}
			}
		}

	
	$return = '';
	
	$boxed_layout = 'false';
	$script = '';
	
	
		if(!$is_ajax){
			extract($modal['modal']['data']['data']);
								
			$socialiconsString = '';

			if(isset($modal['modal']['data']['data']['socialicons']) && is_array($modal['modal']['data']['data']['socialicons'])){
				foreach($modal['modal']['data']['data']['socialicons'] as $socialicons){
					$socialiconsString .= '
						<li class="socialicons-block">
							<div class="hide secret-desc" socialicons-title="'.$socialicons['title'].'" icon_class="'.$socialicons['icon_class'].'" icon_url="'.$socialicons['icon_url'].'"></div>
							<i class="drag fa fa-move"></i>
							<span class="socialicons-name" ref="'.$id.'">'.$socialicons['title'].'</span>
							<i class="close fa fa-times"></i>
						</li>';						
				}
			}
			
		}
		
		
		$script = '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".socialicons-list" ).sortable({
						handle : "i.drag"
					});
				});
			</script>
		';
		
						
		$return .= 
			'<div id="'.$id.'" modalType="socialicons" class="rpb_modal container hide fade '.(!$remove_modal_after ? '' : 'external-modal-call' ).'" >
				<div class="modal-header">
					<div class="close '.(!$remove_modal_after ? 'builder-close' : 'close-grid-modal' ).'"><i class="fa fa-times"></i></div>
					<h3>Add Social Icon</h3>
				</div>
				<div class="modal-body" data-saved="false">				
					<div class="row-fluid">
						<div class="socialicons-elements-holder span6">
							<ul class="socialicons-list">
								'.$socialiconsString.'
							</ul>
						<div class="btn btn-small add-new-socialicons-btn" ref="'.$id.'"><i class="fa fa-plus"></i> Add</div>
					</div>
					<div class="span6">
						<strong>Add/Remove Social Icons</strong><br/>
						<p>You can easily add remove social icons by clicking to add new button</p>
					</div>
				</div>
				<hr/>
			</div>
			<div class="modal-footer">
				<div class="btn '.(!$remove_modal_after ? 'builder-close' : 'close-grid-modal' ).'">Close</div>
				<div class="btn btn-primary '.(!$remove_modal_after ? 'socialicons-modal-save builder-close' : 'save-remove-socialicons-modal' ).'" '.($remove_modal_after ? 'return_to="'.$return_to.'" return_data_to="'.$return_data_to.'"' : '').' ref="'.$id.'">Save changes</div>
			</div>
		</div>';
					
		return $return.$script;
	
	exit;
}

function xr_make_socialicons_modal_ajax(){
	echo xr_make_socialicons_modal();
	exit;
}
add_action('wp_ajax_xr_make_socialicons_modal', 'xr_make_socialicons_modal_ajax');





function rock_make_single_socialicons_modal($socialiconsObj=null, $id=null){
			
	$icon_class = '';
	$icon_url = '';
		
	
	if(isset($_REQUEST['socialicons_obj'])){
		$socialiconsObj = $_REQUEST['socialicons_obj'];	
		$id = $socialiconsObj['id'];
		if(!empty($socialiconsObj)){
			extract($socialiconsObj);	
		}
	}
				
	$icon_used = ($icon_class != "" || $icon_url != "") ? true : false;
	
	
	
	$return = '
		<div id="socialicons-single-modal" modalType="socialicons" class="rpb_modal container hide fade">
			<div class="modal-header">
				<div class="close close-socialicons-single"><i class="fa fa-times"></i></div>
					<h3>Add Social Icon</h3>
				</div>
			<div class="modal-body" data-saved="false">
				<div class="row-fluid">
					<div class="span6 elem-icon">
						<div class="icon-holder add-elem-icon-btn" icon-ref="'.$icon_class.'">'.(($icon_class != "") ? '<i class="'.$icon_class.' fa-4x"></i>' : '').'</div><br/>
						<input autocomplete="off" type="text" size="36" class="add-elem-icon-text" '.($icon_url != "" ? "": 'style="display:none;"').' value="'.($icon_url != "" ? $icon_url : "").'"/>
						'.(!$icon_used ? '<div class="add-elem-icon-btn btn">Add Icon</div>' : '<div class="add-elem-icon-btn btn hide">Add Icon</div>').'
						'.($icon_used ? '<div class="remove-elem-icon-btn btn">Remove Icon</div>' : '<div class="remove-elem-icon-btn btn hide">Remove Icon</div>').'
					</div>
					<div class="span6">
						<strong>Button Icon</strong><br/>
						<p>Choose an icon (Optional)</p>
					</div>
				</div>
				<hr/>									
				<div class="row-fluid">
					<div class="span6">
						<input autocomplete="off" name="socialicons_header" class="socialicons_header" type="text" value="'.$socialiconsObj['title'].'" />
					</div>
					<div class="span6">
						<strong>URL</strong><br/>
						<p>Enter your link url</p>
					</div>
				</div>
				<hr/>
			</div>
			<div class="modal-footer">
				<div class="btn close-socialicons-single">Close</div>
				<div class="btn btn-primary socialicons-single-save" ref="'.$socialiconsObj['index'].'" modal-ref="'.$id.'">Save changes</div>
			</div>
		</div>';


	return $return;
}

function rock_make_single_socialicons_modal_ajax(){
	echo rock_make_single_socialicons_modal();	
	exit;
}

add_action('wp_ajax_rock_make_single_socialicons_modal', 'rock_make_single_socialicons_modal_ajax');




/*
**	Testimonials Builder Modal
*/

function xr_make_testimonialsbuilder_modal($modal=null,$id=null){
	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	$return = '';
	
	$boxed_layout = 'false';
	$use_shadow = 'false';
	$auto_slide = 'true';
	$duration_time = 5000;
	$testimonials_title = '';
	$activate_navigation = 'true';
	$script = '';
	
	$testimonialsString = '												
		<li class="testimonialsbuilder-block active">
			<div class="hide secret-desc" company="RockthemesNet" testimonialsbuilder-title="Testimonials Awesome" icon_class="" icon_url=""><p>Testimonials Awesome Content</p></div>
			<i class="drag fa fa-move"></i>
			<span class="testimonialsbuilder-name" ref="'.$id.'" testimonialsbuilder-index="0">Testimonials Awesome</span>
			<i class="close fa fa-times"></i>
		</li>
		<li class="testimonialsbuilder-block">
			<div class="hide secret-desc" company="RockthemesNet" testimonialsbuilder-title="Testimonials Awesome" icon_class="" icon_url=""><p>Testimonials Awesome Content</p></div>
			<i class="drag fa fa-move"></i>
			<span class="testimonialsbuilder-name" ref="'.$id.'" testimonialsbuilder-index="1">Testimonials Awesome</span>
			<i class="close fa fa-times"></i>
		</li>';
	
		if(!$is_ajax){
			extract($modal['modal']['data']['data']);
			
			$boxed_layout = checked("true", (isset($modal['modal']['data']['data']['boxed_layout']) ? $modal['modal']['data']['data']['boxed_layout'] : false ), false);
		
			$testimonialsString = '';

			if(isset($modal['modal']['data']['data']['testimonials']) && is_array($modal['modal']['data']['data']['testimonials'])){
				foreach($modal['modal']['data']['data']['testimonials'] as $testimonials){
					$testimonialsString .= '
						<li class="testimonialsbuilder-block">
							<div class="hide secret-desc" company="'.$testimonials['company'].'" testimonialsbuilder-title="'.$testimonials['title'].'">'.($testimonials['text']).'</div>
							<i class="drag fa fa-move"></i>
							<span class="testimonialsbuilder-name" ref="'.$id.'">'.$testimonials['title'].'</span>
							<i class="close fa fa-times"></i>
						</li>';						
				}
			}
			
			$script = '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#'.$id.' .testimonialsbuilder-list" ).sortable({
						handle : "i.drag",
					});
				});
			</script>';
		}
						
			$return .= 
			'<div id="'.$id.'" modalType="testimonialsbuilder" class="rpb_modal container hide fade" >
								<div class="modal-header">
									<div class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></div>
					  				<h3>Testimonials Builder</h3>
								</div>
								<div class="modal-body" data-saved="false">
								
									<div class="row-fluid">
										<div class="testimonialsbuilder-elements-holder span6">
											<ul class="testimonialsbuilder-list">
												'.$testimonialsString.'
											</ul>
											<div class="btn btn-small add-new-testimonialsbuilder-btn" ref="'.$id.'"><i class="fa fa-plus"></i> Add</div>
										</div>
										<div class="span6">
											<strong>Add/Remove Testimonials</strong><br/>
											<p>You can easily add remove testimonials by clicking to add new button</p>
										</div>
									</div>
									<hr/>
									
									
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="duration_time" value="'.$duration_time.'" />
				</div>
				<div class="span6">
					<strong>Duration</strong><br/>
					<p>Duration time between two slides. An integer in milliseconds</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="testimonials_title" value="'.$testimonials_title.'" />
				</div>
				<div class="span6">
					<strong>Title</strong><br/>
					<p>Title of the testimonials. If you enter a title, it will be displayed as a block at the left.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="activate_navigation" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($activate_navigation == 'true' ? 'selected' : '').'>Activate Navigation</option>
						<option value="false" '.($activate_navigation == 'false' ? 'selected' : '').'>Do Not Activate Navigation</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Navigation</strong><br/>
					<p>If you activate navigation, there will be two buttons to go to next and previous logo groups.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="auto_slide" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($auto_slide == 'true' ? 'selected' : '').'>Activate Auto Slide</option>
						<option value="false" '.($auto_slide == 'false' ? 'selected' : '').'>Do Not Activate Auto Slide</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Auto Slide</strong><br/>
					<p>If you activate auto slide, references will be sliding automatically.</p>
				</div>
			</div>
			<hr/>
									
									<div class="row-fluid">
										<div class="span6">
											<div class="boxed_layout_holder">
												<input autocomplete="off" class="boxed_layout" type="checkbox" value="true" name="boxed_layout" '.$boxed_layout.' /><label for="activate_hover"> Use Boxed Layout</label>
											</div>
										</div>
										<div class="span6">
											<strong>Boxed Layout</strong><br/>
											<p>If you want to wrap a boxed layout around this element, check this option.</p>
										</div>										
									</div>
									<hr/>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
									<div class="btn btn-primary testimonialsbuilder-save">Save changes</div>
								</div>
							</div>';
					
		return $return.$script;
	
	exit;
}

function xr_make_testimonialsbuilder_modal_ajax(){
	echo xr_make_testimonialsbuilder_modal();
	exit;
}
add_action('wp_ajax_xr_make_testimonialsbuilder_modal', 'xr_make_testimonialsbuilder_modal_ajax');





function rock_make_single_testimonialsbuilder_modal($testimonialsbuilderObj=null, $id=null){
		
	if(isset($_REQUEST['testimonials_obj'])){
		$testimonialsbuilderObj = $_REQUEST['testimonials_obj'];	
		$id = $testimonialsbuilderObj['id'];
	}
	
	
	$return = '<div id="testimonialsbuilder-single-modal" modalType="testimonialsbuilder" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Testimonials Builder" aria-hidden="true" data-focus-on="input:first">
								<div class="modal-header">
									<div class="close close-testimonialsbuilder-single"><i class="fa fa-times"></i></div>
					  				<h3>Add Testimonials</h3>
								</div>
								<div class="modal-body" data-saved="false">
									<div class="row-fluid">
										<div class="span6">
											<input autocomplete="off" name="testimonialsbuilder_header" class="testimonialsbuilder_header" type="text" value="'.esc_attr(stripslashes($testimonialsbuilderObj['title'])).'" />
										</div>
										<div class="span6">
											<strong>Name</strong><br/>
											<p>Name area</p>
										</div>
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<input autocomplete="off" name="company" class="company" type="text" value="'.$testimonialsbuilderObj['company'].'" />
										</div>
										<div class="span6">
											<strong>Company / Position</strong><br/>
											<p>Company name or the position of the user</p>
										</div>
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6 testimonialsbuilder-list">
											<div class="rock-tinymce-container wp-core-ui wp-editor-wrap tmce-active">
												<div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js">
													<div class="wp-editor-tabs">	
														<a class="rock-tinymce-switch-text wp-switch-editor switch-tmce" >Visual</a>
														<a class="rock-tinymce-switch-html wp-switch-editor switch-html" >Text</a>
													</div>
													<div id="wp-content-media-buttons" class="wp-media-buttons"><a href="#" id="insert-media-button" class="button insert-media add_media" data-editor="testimonialsbuilder-single-modal-editor" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a></div>
												</div>
												<div class="wp-content-editor-container wp-editor-container">
													<textarea rows="8" cols="40" class="rock-tinymce-textarea description" initialized="true" name="testimonialsbuilder-single-modal-editor" id="testimonialsbuilder-single-modal-editor" class="wp-editor-area"></textarea>
												</div>
											</div>
										</div>
										<div class="span6">
											<strong>Testimonials Content</strong><br/>
											<p>Enter your content here. You can use the Rich Text Editor for your content.</p>
										</div>
									</div>
									<hr/>
								</div>
								<div class="modal-footer"><div class="btn close-testimonialsbuilder-single">Close</div><div class="btn btn-primary testimonialsbuilder-single-save" ref="'.$testimonialsbuilderObj['index'].'" modal-ref="'.$id.'">Save changes</div></div></div>';


	return $return;
}

function rock_make_single_testimonialsbuilder_modal_ajax(){
	echo rock_make_single_testimonialsbuilder_modal();	
	exit;
}

add_action('wp_ajax_rock_make_single_testimonialsbuilder_modal', 'rock_make_single_testimonialsbuilder_modal_ajax');






/*
**	References Builder Modal
**
**	Named as "References Builder". Because there will be another references with Custom Post Types
*/
function xr_make_referencesbuilder_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	$saved_logos = '
		<div class="references-single-item" item-ref="0">
			<div class="row-fluid">
				<div class="span6">
					<div class="hr-modal-image" ref="icon-image-uploader">
						<div class="hide image-data"></div>
						<label for="upload_image"> <input autocomplete="off" id="icon-image-uploader-'.$id.'0" class="upload_image_button" size="36" name="upload_image" type="text" value="" /> <input autocomplete="off" class="image_uploader_class button" value="Upload Image" type="button" /> </label><br/>
					</div>
				</div>
				<div class="span6">
					<input autocomplete="off" type="text" class="link_url" value="" />
					<div class="button references-single-item-remove"><i class="fa fa-times"></i> Remove References</div>
				</div>
			</div>
			<hr class="no-margin"/>
			<br/>
		</div>
	';
	
	//Default Values
	$duration_time			=	5000;
	$references_title		=	'References';
	$activate_navigation	=	'true';
	$auto_slide				=	'true';
	$image_size				=	'medium';
	
	
	if(!empty($modal['modal']['data']['data'])){
		extract($modal['modal']['data']['data']);	
	}
	
	if(isset($saved_logo_data) && !empty($saved_logo_data)){
		$saved_logos = '';
		$logo_counter = 0;
		foreach($saved_logo_data as $logo){
			$saved_logos .= '
				<div class="references-single-item" item-ref="'.$logo_counter.'">
					<div class="row-fluid">
						<div class="span6">
							<div class="hr-modal-image" ref="icon-image-uploader">
								<div class="hide image-data"></div>
								<label for="upload_image"> <input autocomplete="off" id="icon-image-uploader-'.$id.$logo_counter.'" class="upload_image_button" size="36" name="upload_image" type="text" value="'.$logo['img_url'].'" /> <input autocomplete="off" class="image_uploader_class button" value="Upload Image" type="button" /> </label><br/>
							</div>
						</div>
						<div class="span6">
							<input autocomplete="off" type="text" class="link_url" value="'.$logo['link_url'].'" />
							<div class="button references-single-item-remove"><i class="fa fa-times"></i> Remove References</div>
						</div>
					</div>
					<hr class="no-margin"/>
					<br/>
				</div>
			';
			
			$logo_counter++;
		}
	}
	
	
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>References Builder</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6 image_sizes_holder">
					'.rock_builder_get_image_sizes($image_size, $id, '').'
				</div>
				<div class="span6">
					<strong>Choose a Size</strong></br>
					<p>You can choose different image sizes for your image. You can also adjust image sizes in Theme Options</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6 references-container">
					'.$saved_logos.'
				</div>
				<div class="span6">
					<strong>Add /  Remove References</strong><br/>
					<p>You can add / remove references as you want. You can also add link to your references.</p>
					<p><strong>Left Text Field : </strong> Image URL
					<br/>
					<strong>Right Text Field : </strong> Link URL</p>
					<div class="button references-single-item-add" ref="'.$id.'"><i class="fa fa-plus"></i> Add New Reference</div>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="duration_time" value="'.$duration_time.'" />
				</div>
				<div class="span6">
					<strong>Duration</strong><br/>
					<p>Duration time between two slides. An integer in milliseconds</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="references_title" value="'.$references_title.'" />
				</div>
				<div class="span6">
					<strong>Title</strong><br/>
					<p>Title of the references. If you enter a title, it will be displayed as a block at the left.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="activate_navigation" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($activate_navigation == 'true' ? 'selected' : '').'>Activate Navigation</option>
						<option value="false" '.($activate_navigation == 'false' ? 'selected' : '').'>Do Not Activate Navigation</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Navigation</strong><br/>
					<p>If you activate navigation, there will be two buttons to go to next and previous logo groups.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="auto_slide" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($auto_slide == 'true' ? 'selected' : '').'>Activate Auto Slide</option>
						<option value="false" '.($auto_slide == 'false' ? 'selected' : '').'>Do Not Activate Auto Slide</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Auto Slide</strong><br/>
					<p>If you activate auto slide, references will be sliding automatically.</p>
				</div>
			</div>
			<hr/>
			'.rock_builder_get_block_grid_list(
				(isset($modal['modal']['data']['data']['block_grid_large']) ? intval($modal['modal']['data']['data']['block_grid_large']) : ''),
				(isset($modal['modal']['data']['data']['block_grid_medium']) ? intval($modal['modal']['data']['data']['block_grid_medium']) : ''),
				(isset($modal['modal']['data']['data']['block_grid_small']) ? intval($modal['modal']['data']['data']['block_grid_small']) : '')
			).'
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary googlemap-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';



	return $return;
}
function xr_make_referencesbuilder_modal_ajax(){
	echo xr_make_referencesbuilder_modal();
	exit;
}
add_action('wp_ajax_xr_make_referencesbuilder_modal','xr_make_referencesbuilder_modal_ajax');





/*
**	Alert Box Modal
*/
function xr_make_alertbox_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	//Default Values
	$content			=	'';
	$background_color	=	'';
	$font_color			=	'';
	$border_color		=	'';
	$alertbox_style		=	'info';
	$iconClass			=	'';
	$iconURL			=	'';
	$use_close_button	=	'true';
	
	
	if(!empty($modal['modal']['data']['data'])){
		extract($modal['modal']['data']['data']);	
	}
	
			
	$icon_class = $iconClass;
	$icon_url = $iconURL;
	$icon_used = ($icon_class != "" || $icon_url != "") ? true : false;



	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Alert Box" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Alert Box</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6">
					<select class="alertbox_style" autocomplete="off" ref="'.$id.'">
						<option value="alert" '.($alertbox_style == 'alert' ? 'selected' : '').'>Alert (Red)</option>
						<option value="success" '.($alertbox_style == 'success' ? 'selected' : '').'>Success (Green)</option>
						<option value="info" '.($alertbox_style == 'info' ? 'selected' : '').'>Info (Blue)</option>
						<option value="caution" '.($alertbox_style == 'caution' ? 'selected' : '').'>Caution (Orange)</option>
						<option value="custom" '.($alertbox_style == 'custom' ? 'selected' : '').'>Custom Style</option>
					</select>
				</div>
				<div class="span6">
					<strong>Choose Alert Box Model</strong><br/>
					<p>There are different predeifned alert boxes you can easily select. If you want to change colors, you can always use Custom Style to adjust colors.</p>
				</div>
			</div>
			<hr/>
			<div class="custom_alertbox_style row-fluid '.($alertbox_style != 'custom' ? 'hide' : '').'">
				<div class="row-fluid">
					<div class="span6">
						<div class="background_color">
							'.rockbuilder_make_colorpicker($id.'-bg-colorpicker', $background_color).'
						</div>
					</div>
					<div class="span6">
						<strong>Background Color</strong><br/>
						<p>Choose alert box background color</p>
					</div>
				</div>
				<hr/>
				<div class="row-fluid">
					<div class="span6">
						<div class="font_color">
							'.rockbuilder_make_colorpicker($id.'-font-colorpicker', $font_color).'
						</div>
					</div>
					<div class="span6">
						<strong>Font Color</strong><br/>
						<p>Choose alert box font color</p>
					</div>
				</div>
				<hr/>
				<div class="row-fluid">
					<div class="span6">
						<div class="border_color">
							'.rockbuilder_make_colorpicker($id.'-border-colorpicker', $border_color).'
						</div>
					</div>
					<div class="span6">
						<strong>Border Color</strong><br/>
						<p>Choose alert box border color</p>
					</div>
				</div>
				<hr/>
			</div>
			<div class="row-fluid">
				<div class="span6 textarea-holder">
					<div class="rock-tinymce-container wp-core-ui wp-editor-wrap html-active">
						<div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js">
							<div class="wp-editor-tabs">
								<a class="rock-tinymce-switch-text wp-switch-editor switch-tmce" >Visual</a>
								<a class="rock-tinymce-switch-html wp-switch-editor switch-html" >Text</a>
							</div>
							<div id="wp-content-media-buttons" class="wp-media-buttons"><a href="#" id="insert-media-button" class="button insert-media add_media" data-editor="'.$id.'-editor" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a></div>
						</div>
						<div class="wp-content-editor-container wp-editor-container">
							<textarea rows="8" cols="40" class="rock-tinymce-textarea description" name="'.$id.'-editor" id="'.$id.'-editor" class="wp-editor-area">'.($content).'</textarea>
						</div>
						<div class="tinymce-hidden-data hide">'.$content.'</div>
					</div>
				</div>
				<div class="span6">
					<strong>Alert Box Text</strong><br/>
					<p>Enter your alert box text.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="use_close_button" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($use_close_button == 'true' ? 'selected' : '').'>Use Close Symbol</option>
						<option value="false" '.($use_close_button == 'false' ? 'selected' : '').'>Do not Use Close Symbol</option>
					</select>
				</div>
				<div class="span6">
					<strong>Use Close Symbol</strong><br/>
					<p>Close symbol will add a close icon at the right top. When clicked it will close the alert box.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6 elem-icon">
					<div class="icon-holder add-elem-icon-btn" icon-ref="'.$icon_class.'">'.(($icon_class != "") ? '<i class="'.$icon_class.' fa-4x"></i>' : '').'</div><br/>
					<input autocomplete="off" type="text" size="36" class="add-elem-icon-text" '.($icon_url != "" ? "": 'style="display:none;"').' value="'.($icon_url != "" ? $icon_url : "").'"/>
					'.(!$icon_used ? '<div class="add-elem-icon-btn btn">Add Icon</div>' : '<div class="add-elem-icon-btn btn hide">Add Icon</div>').'
					'.($icon_used ? '<div class="remove-elem-icon-btn btn">Remove Icon</div>' : '<div class="remove-elem-icon-btn btn hide">Remove Icon</div>').'
				</div>
				<div class="span6">
					<strong>Button Icon</strong><br/>
					<p>Choose an icon (Optional)</p>
				</div>
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary googlemap-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';



	return $return;
}
function xr_make_alertbox_modal_ajax(){
	echo xr_make_alertbox_modal();
	exit;
}
add_action('wp_ajax_xr_make_alertbox_modal','xr_make_alertbox_modal_ajax');






/*
**	Promotion Box Modal
*/
function xr_make_promotionbox_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	//Default Values
	$content			=	'';
	$button_json_data	=	'';
	$button_shortcode	=	json_encode('');
	$background_color	=	'#333333';
	$font_color			=	'#FFFFFF';
	
	
	if(!empty($modal['modal']['data']['data'])){
		extract($modal['modal']['data']['data']);	
	}
		
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Promotion Box" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Promotion Box</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6">
					<div class="background_color">
						'.rockbuilder_make_colorpicker($id.'-bg-colorpicker', $background_color).'
					</div>
				</div>
				<div class="span6">
					<strong>Background Color</strong><br/>
					<p>Choose promotion box background color</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="font_color">
						'.rockbuilder_make_colorpicker($id.'-font-colorpicker', $font_color).'
					</div>
				</div>
				<div class="span6">
					<strong>Font Color</strong><br/>
					<p>Choose promotion box font color</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6 promotion-box-button">
					<input autocomplete="off" id="'.$id.'_button_data" class="button_json_data" type="hidden" value="'.esc_attr($button_json_data).'" />
					<input autocomplete="off" id="'.$id.'_button_shortcode" class="button_shortcode" type="hidden" value="'.esc_attr($button_shortcode).'" />
					<div class="btn advanced_details_make_button_modal" id_ref="'.$id.'_button_shortcode" id_data_ref="'.$id.'_button_data"><i class="fa fa-gear"></i> Edit Button</div>
				</div>
				<div class="span6">
					<strong>Button</strong><br/>
					<p>Edit the button settings of the Promotion Box</p>
				</div>
			</div>
			<hr/>			
			<div class="row-fluid">
				<div class="span6 textarea-holder">
					<div class="rock-tinymce-container wp-core-ui wp-editor-wrap html-active">
						<div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js">
							<div class="wp-editor-tabs">
								<a class="rock-tinymce-switch-text wp-switch-editor switch-tmce" >Visual</a>
								<a class="rock-tinymce-switch-html wp-switch-editor switch-html" >Text</a>
							</div>
							<div id="wp-content-media-buttons" class="wp-media-buttons"><a href="#" id="insert-media-button" class="button insert-media add_media" data-editor="'.$id.'-editor" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a></div>
						</div>
						<div class="wp-content-editor-container wp-editor-container">
							<textarea rows="8" cols="40" class="rock-tinymce-textarea description" name="'.$id.'-editor" id="'.$id.'-editor" class="wp-editor-area">'.($content).'</textarea>
						</div>
						<div class="tinymce-hidden-data hide">'.$content.'</div>
					</div>
				</div>
				<div class="span6">
					<strong>Promotion Box Text</strong><br/>
					<p>Enter your promotion box text.</p>
				</div>
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary googlemap-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';
	
	return $return;
}
function xr_make_promotionbox_modal_ajax(){
	echo xr_make_promotionbox_modal();
	exit;
}
add_action('wp_ajax_xr_make_promotionbox_modal','xr_make_promotionbox_modal_ajax');





/*
**	Google Map Modal
*/

function xr_make_googlemap_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	$api_key		=	'';
	$lat			=	'';
	$lng			=	'';
	$zoom_level		=	8;
	$map_type		=	'ROADMAP';
	$marker_title	=	'';
	$sensor			=	'false';
	$height			=	400;
	$resize_height	=	'false';
	$content		=	'';
	
	if(!empty($modal['modal']['data']['data'])){
		extract($modal['modal']['data']['data']);	
	}


	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Google Map" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Google Map</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="api_key" value="'.$api_key.'" />
				</div>
				<div class="span6">
					<strong>Google Map Api Key</strong><br/>
					<p>You can get your Google Map Api Key from <a href="https://code.google.com/apis/console" target="_blank">here</a></p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="lat" value="'.$lat.'" />
				</div>
				<div class="span6">
					<strong>Latitude</strong><br/>
					<p>Enter your Latitude value</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="lng" value="'.$lng.'" />
				</div>
				<div class="span6">
					<strong>Longitude</strong><br/>
					<p>Enter your Longitude value</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="zoom_level" value="'.$zoom_level.'" />
				</div>
				<div class="span6">
					<strong>Zoom</strong><br/>
					<p>Enter your Zoom value</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="map_type" autocomplete="off">
						<option value="ROADMAP" '.($map_type == 'ROADMAP' ? 'selected' : '').'>ROADMAP</option>
						<option value="SATELLITE" '.($map_type == 'SATELLITE' ? 'selected' : '').'>SATELLITE</option>
						<option value="HYBRID" '.($map_type == 'HYBRID' ? 'selected' : '').'>HYBRID</option>
						<option value="TERRAIN" '.($map_type == 'TERRAIN' ? 'selected' : '').'>TERRAIN</option>
					</select>
				</div>
				<div class="span6">
					<strong>Map Type</strong><br/>
					<p>Choose your map type</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="sensor" autocomplete="off">
						<option value="false" '.($sensor == 'false' ? 'selected' : '').'>Do Not Use Sensor</option>
						<option value="true" '.($sensor == 'true' ? 'selected' : '').'>Use Sensor</option>
					</select>
				</div>
				<div class="span6">
					<strong>Use Sensor</strong><br/>
					<p>Sensor will activate your visitor\'s GPS</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="marker_title" value="'.$marker_title.'" />
				</div>
				<div class="span6">
					<strong>Marker Title</strong><br/>
					<p>This is the title when you hover your marker.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6 textarea-holder">
					<div class="rock-tinymce-container wp-core-ui wp-editor-wrap html-active">
						<div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js">
							<div class="wp-editor-tabs">
								<a class="rock-tinymce-switch-text wp-switch-editor switch-tmce" >Visual</a>
								<a class="rock-tinymce-switch-html wp-switch-editor switch-html" >Text</a>
							</div>
							<div id="wp-content-media-buttons" class="wp-media-buttons"><a href="#" id="insert-media-button" class="button insert-media add_media" data-editor="'.$id.'-editor" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a></div>
						</div>
						<div class="wp-content-editor-container wp-editor-container">
							<textarea rows="8" cols="40" class="rock-tinymce-textarea description" name="'.$id.'-editor" id="'.$id.'-editor" class="wp-editor-area">'.htmlentities($content).'</textarea>
						</div>
						<div class="tinymce-hidden-data hide">'.$content.'</div>
					</div>
				</div>
				<div class="span6">
					<strong>Info Box Description</strong><br/>
					<p>You can add info box description for your marker.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="height" value="'.$height.'" />
				</div>
				<div class="span6">
					<strong>Height</strong><br/>
					<p>Enter your map height value as number. (Without px or em)</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="resize_height" autocomplete="off">
						<option value="false" '.($resize_height == 'false' ? 'selected' : '').'>Do Not Resize Height</option>
						<option value="true" '.($resize_height == 'true' ? 'selected' : '').'>Resize Height</option>
					</select>
				</div>
				<div class="span6">
					<strong>Resize Height</strong><br/>
					<p>If you choose to resize the map height, map will resize itself with same aspect ratio.</p>
				</div>
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary googlemap-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';
	
	return $return;
}
function xr_make_googlemap_modal_ajax(){
	echo xr_make_googlemap_modal();
	exit;
}
add_action('wp_ajax_xr_make_googlemap_modal','xr_make_googlemap_modal_ajax');






/*
**	Rock Form Builder Modal
*/
function xr_make_rockformbuilder_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	$selected = isset($modal['modal']['data']['data']['shortcode']) ? $modal['modal']['data']['data']['shortcode'] : '';
	
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Rock Form Builder" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Rock Form Builder</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6">
					'.rockthemes_fb_get_references_list($selected, $id, false).'
				</div>
				<div class="span6">
					<strong>Choose a Rock Form Builder</strong><br/>
					<p>You can choose any of your saved Rock Form Builder.</p>
				</div>
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary rockformbuilder-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';
	
	return $return;
}
function xr_make_rockformbuilder_modal_ajax(){
	echo xr_make_rockformbuilder_modal();
	exit;
}
add_action('wp_ajax_xr_make_rockformbuilder_modal','xr_make_rockformbuilder_modal_ajax');





/*
**	Portfolio Modal
*/

function xr_make_portfolio_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	
	$image_sizes = isset($modal['modal']['data']['data']['imageSize']) ? $modal['modal']['data']['data']['imageSize'] : '';
	
	$totalProducts = isset($modal['modal']['data']['data']['total']) ? $modal['modal']['data']['data']['total'] : 18;
	
	$chosenCategory = isset($modal['modal']['data']['data']['category']) ? $modal['modal']['data']['data']['category'] : '';
	$chosenPostType = isset($modal['modal']['data']['data']['postType']) ? $modal['modal']['data']['data']['postType'] : '';
	
	$header_title = isset($modal['modal']['data']['data']['header_title']) ? $modal['modal']['data']['data']['header_title'] : "";
	
	$activate_hover_box = checked("true", (isset($modal['modal']['data']['data']['activate_hover_box']) ? $modal['modal']['data']['data']['activate_hover_box'] : false ), false);
	$activate_hover = checked("true", (isset($modal['modal']['data']['data']['activate_hover']) ? $modal['modal']['data']['data']['activate_hover'] : false ), false);
	$disable_hover_link = checked("true", (isset($modal['modal']['data']['data']['disable_hover_link']) ? $modal['modal']['data']['data']['disable_hover_link'] : false ), false);
			
	$boxed_layout = checked("true", (isset($modal['modal']['data']['data']['boxed_layout']) ? $modal['modal']['data']['data']['boxed_layout'] : false ), false);

	$excerpt_title_option = isset($modal['modal']['data']['data']['excerpt_title_option']) ? $modal['modal']['data']['data']['excerpt_title_option'] : '';
	$excerpt_length = isset($modal['modal']['data']['data']['excerpt_length']) ? $modal['modal']['data']['data']['excerpt_length'] : 18;
	
	$pagination = checked("true", (isset($modal['modal']['data']['data']['pagination']) ? $modal['modal']['data']['data']['pagination'] : false ), false);
	$portfolio_model = isset($modal['modal']['data']['data']['portfolio_model']) ? $modal['modal']['data']['data']['portfolio_model'] : "";
	$portfolio_model_switch = isset($modal['modal']['data']['data']['portfolio_model_switch']) ? $modal['modal']['data']['data']['portfolio_model_switch'] : "";
	
	$activate_category_link = isset($modal['modal']['data']['data']['activate_category_link']) ? $modal['modal']['data']['data']['activate_category_link'] : "";
	$activate_header_link = isset($modal['modal']['data']['data']['activate_header_link']) ? $modal['modal']['data']['data']['activate_header_link'] : "";
	
	$use_shadow = checked("true", (isset($modal['modal']['data']['data']['use_shadow']) ? $modal['modal']['data']['data']['use_shadow'] : false ), false);
	
	$excerpt_length_html = '<select class="excerpt_length" autocomplete="off">';
	for($e = 0; $e<150; $e++){
		if($e == $excerpt_length){
			$excerpt_length_html .= '<option value="'. $e .'" selected="selected">'.$e.'</option>';
		}else{
			$excerpt_length_html .= '<option value="'. $e .'">'.$e.'</option>';
		}
	}
	$excerpt_length_html .= '</select>';
	
	
	$totalItemsToShow = '<div class="total_show_holder"><h4>Select Total Item To Show</h4><select class="total_show" autocomplete="off">';
	for($i = 1; $i< 100; $i++){
		if($totalProducts == $i){
			$totalItemsToShow .= '<option value="'.$i.'" selected>'.$i.'</option>';
		}else{
			$totalItemsToShow .= '<option value="'.$i.'">'.$i.'</option>';
		}
	}
	$totalItemsToShow .= '</select></div>';
		
	
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Portfolio" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Portfolio</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6 image_sizes_column"  bind="'.$id.'" calc="true">
					'.rock_builder_get_image_sizes($image_sizes, $id, '').'
				</div>
				<div class="span6">
					<strong>Choose image size</strong><br/>
					<p>You can choose any image sizes for Portfolio. But we recommend using cropped image sizes.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid post_type_tax_holder">
				<div class="span6">
					'.rock_builder_get_customposttypes($chosenPostType, $id, '').'
					'.rock_builder_get_taxonomies($chosenCategory, $chosenPostType, '').'
				</div>
				<div class="span6">
					<strong>Choose A Post Type</strong></br>
					<p>Choose the post type</p><br/>
					<strong>Choose Taxonomies/Categories to Display</strong></br>
					<p>Choose categories/taxonomies. You can choose multiple categories/taxonomies or just single taxonomy/category. You can also choose all categories/taxonomies by choosing the "All".</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="portfolio_model" autocomplete="off">
						<option value="grid" '.($portfolio_model == 'grid' ? 'selected' : '').' >Portfolio Grid</option>
						<option value="list" '.($portfolio_model == 'list' ? 'selected' : '').' >Portfolio List</option>
					</select>
				</div>
				<div class="span6">
					<strong>Portfolio Model</strong>
					<p>You can choose grid or list model for the portfolio.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="portfolio_model_switch" autocomplete="off">
						<option value="true" '.($portfolio_model_switch == 'true' ? 'selected' : '').' >Switch Portfolio Models</option>
						<option value="false" '.($portfolio_model_switch == 'false' ? 'selected' : '').' >Do not Switch Portfolio Models</option>
					</select>
				</div>
				<div class="span6">
					<strong>Switch Between Portfolio Models</strong>
					<p>If you choose "Switch Portfolio Models" there will be buttons at the top of the portfoliio to switch between list and grid model.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					'.rockthemes_excerpt_title_option($excerpt_title_option).'
				</div>
				<div class="span6">
					<strong>Description</strong>
					<p>You can choose the description details. This will only effect to the grid model. List model will always display all details.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					'.$excerpt_length_html.'
				</div>
				<div class="span6">
					<strong>Excerpt Length</strong>
					<p>You can adjust the excerpt length in words. Which means if you choose 10, your excerpt will show up to 10 words from your originial excerpt.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="header_title" value="'.$header_title.'" />
				</div>
				<div class="span6">
					<strong>Header Title</strong>
					<p>You can choose to use a header title for portfolio. If you leave this area empty, header title will not be displayed.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="activate_header_link" autocomplete="off">
						<option value="true" '.($activate_header_link === 'true' ? 'selected' : '').'>Activate Header Link</option>
						<option value="false" '.($activate_header_link === 'false' ? 'selected' : '').'>Deactivate Header Link</option>
					</select>
				</div>
				<div class="span6">
					<strong>Activate Header Link</strong>
					<p>If you activate header link, header will link to the product.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="activate_category_link" autocomplete="off">
						<option value="true" '.($activate_category_link === 'true' ? 'selected' : '').'>Activate Category Link</option>
						<option value="false" '.($activate_category_link === 'false' ? 'selected' : '').'>Deactivate Category Link</option>
					</select>
				</div>
				<div class="span6">
					<strong>Category Links</strong>
					<p>You can activate the category link under the title. This will show the links of the categories for the product.</p>
				</div>
			</div>
			<hr/>
			'.rock_builder_get_block_grid_list(
				(isset($modal['modal']['data']['data']['block_grid_large']) ? intval($modal['modal']['data']['data']['block_grid_large']) : ''),
				(isset($modal['modal']['data']['data']['block_grid_medium']) ? intval($modal['modal']['data']['data']['block_grid_medium']) : ''),
				(isset($modal['modal']['data']['data']['block_grid_small']) ? intval($modal['modal']['data']['data']['block_grid_small']) : '')
			).'
			<div class="row-fluid">
				<div class="span6">
					'.$totalItemsToShow.'
				</div>
				<div class="span6">
					<strong>Total Products to Show</strong></br>
					<p>This will set up the total products per page. If you choose 18, you will be showing 18 products for each page.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="pagination_holder">
						<input autocomplete="off" class="pagination" type="checkbox" value="true" name="pagination" '.$pagination.' /><label for="activate_hover_box"> Activate Pagination</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Pagination</strong></br>
					<p>You can activate / deactivate the pagination. If you want to activate the pagination check this option.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="activate_hover_holder">
						<input autocomplete="off" class="activate_hover" type="checkbox" value="true" name="activate_hover" '.$activate_hover.' /><label for="activate_hover"> Activate Hover Effect</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Regular Hover Effect</strong></br>
					<p>This option will show the regular hover effect with PrettyPhoto (lightbox). If you activate this option, you can not activate the hover box option. Two option can not be activated.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="disable_hover_link_holder">
						<input autocomplete="off" autocomplete="off" class="disable_hover_link" type="checkbox" value="true" name="disable_hover_link" '.$disable_hover_link.' /><label for="activate_hover"> Disable Hover Link</label>
					</div>
				</div>
				<div class="span6">
					<strong>Disable Hover Link</strong></br>
					<p>If you want to disable the link in the hover effect check this option.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="boxed_layout_holder">
						<input autocomplete="off" class="boxed_layout" type="checkbox" value="true" name="boxed_layout" '.$boxed_layout.' /><label for="boxed_layout"> Use Boxed Layout</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Boxed Layout</strong></br>
					<p>You can easily activate/deactivate boxed layout. If you choose "No Description" for description boxed layout will not be active for "Grid Model"</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<div class="use_shadow_holder">
						<input autocomplete="off" class="use_shadow" type="checkbox" value="true" name="use_shadow" '.$use_shadow.' /><label for="use_shadow"> Use Shadow</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Shadow</strong></br>
					<p>If you activate shadow, there will be a shadow under images.</p>
				</div>
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary hr-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';
	
	/*
	TO DO : Hover Box effect for regular portfolio
	
			<div class="row-fluid">
				<div class="span6">
					<div class="activate_hover_box_holder">
						<input autocomplete="off" class="activate_hover_box" type="checkbox" value="true" name="activate_hover_box" '.$activate_hover_box.' /><label for="activate_hover_box"> Activate Hover Box</label>
					</div>
				</div>
				<div class="span6">
					<strong>Activate Hover Box Effect</strong></br>
					<p>If you activate hover box effect, your thumbnails will show a bigger image with excerpt when hovered</p>
				</div>
			</div>
			<hr/>
	
	*/
	

	return $return;
}

function xr_make_portfolio_modal_ajax(){
	echo xr_make_portfolio_modal();
	exit;
}
add_action('wp_ajax_xr_make_portfolio_modal','xr_make_portfolio_modal_ajax');





/*
**	Horizontal Rule Modal
*/


function xr_make_hr_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	$hr_is_image='use_html';
	$tile_image='no';
	$image_url = '';
	$hr_html_model = 'solid';
	$hr_height = '15px';
	
	$return = '';	
	
	
	if(!empty($modal) && !$is_ajax){
		$hr_is_image  = isset($modal['modal']['data']['data']['hr_is_image']) ? $modal['modal']['data']['data']['hr_is_image'] : 'use_html';
		$tile_image  = isset($modal['modal']['data']['data']['tile_image']) ? $modal['modal']['data']['data']['tile_image'] : 'no';
		$image_url  = isset($modal['modal']['data']['data']['image_url']) ? $modal['modal']['data']['data']['image_url'] : '';
		$hr_html_model  = isset($modal['modal']['data']['data']['hr_html_model']) ? $modal['modal']['data']['data']['hr_html_model'] : 'solid';
		$hr_height  = isset($modal['modal']['data']['data']['hr_height']) ? $modal['modal']['data']['data']['hr_height'] : $hr_height;
	}
	
	
	
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Skill" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>HR (Horizontal Rule)</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6">
					<select class="hr_is_image" autocomplete="off" ref="'.$id.'">
						<option value="use_html" '.($hr_is_image == 'use_html' ? 'selected' : '').'>Use Html Regular HR</option>
						<option value="use_image" '.($hr_is_image == 'use_image' ? 'selected' : '').'>Use Image</option>
					</select>
				</div>
				<div class="span6">
					<strong>Choose HR Model</strong><br/>
					<p>If you choose "Html Regular HR" system will render regular hr tag with the chosen style. If you choose "Use Image" system will use the image you have uploaded.</p>
				</div>
			</div>
			<hr/>
			<div class="use_image_mode row-fluid '.($hr_is_image != 'use_image' ? 'hide' : '').'">
				<div class="row-fluid">
					<div class="span6">
						<div class="hr-modal-image" ref="icon-image-uploader">
							<h4>Choose an Image</h4>
							<div class="hide image-data"></div>
							<label for="upload_image"> <input autocomplete="off" id="'.$id.'-image-uploader" class="upload_image_button" size="36" name="upload_image" type="text" value="'.$image_url.'" /> <input autocomplete="off" class="image_uploader_class btn" value="Upload Image" type="button" /> </label><br/>
						</div>
					</div>
					<div class="span6">
						<h3>HR With Image</h3>
						<p>If you don\'t want to use regular HTML HR you can use an image</p>
					</div>
				</div>
				<hr/>
				<div class="row-fluid">
					<div class="span6">
						<select class="tile_image" autocomplete="off">
							<option value="yes" '.($tile_image == 'yes' ? 'selected' : '').'>Yes</option>
							<option value="no" '.($tile_image == 'no' ? 'selected' : '').'>No</option>
						</select>
					</div>
					<div class="span6">
						<h3>Tile Image</h3>
						<p>If you choose "yes" your image will repeat along the column.</p>
					</div>
				</div>
				<hr/>
				<div class="row-fluid">
					<div class="span6">
						<input autocomplete="off" type="text" class="hr_height" value="'.$hr_height.'" />
					</div>
					<div class="span6">
						<h3>Height</h3>
						<p>Enter the height of the horizontal rule in px or em.</p>
					</div>
				</div>
				<hr/>
			</div>
			<div class="use_html_mode row-fluid '.($hr_is_image != 'use_html' ? 'hide' : '').'">
				<div class="row-fluid">
					<div class="span6">
						<select class="hr_html_model" autocomplete="off">
							<option value="solid" '.($hr_html_model == 'solid' ? 'selected' : '').'>Solid</option>
							<option value="dotted" '.($hr_html_model == 'dotted' ? 'selected' : '').'>Dotted</option>
							<option value="dashed" '.($hr_html_model == 'dashed' ? 'selected' : '').'>Dashed</option>
						</select>
					</div>
					<div class="span6">
						<h3>HR Model</h3>
						<p>Choose hr html tag model.</p>
					</div>
				</div>
				<hr/>
			</div>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary hr-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';
	

	return $return;
}

function xr_make_hr_modal_ajax(){
	echo xr_make_hr_modal();
	exit;
}
add_action('wp_ajax_xr_make_hr_modal','xr_make_hr_modal_ajax');


/*
**	End of Horizontal Rule Modal
*/




function rockbuilder_make_colorpicker($id,$defaultColor=null){
	if(!isset($GLOBALS['xr_colorpickers'])){
		$GLOBALS['xr_colorpickers'] = array();	
	}
	
	$GLOBALS['xr_colorpickers'][] = $id;
	$colorPicker = '<input autocomplete="off" type="text" id="'.$id.'" value="'.($defaultColor ? $defaultColor : "#FFFFFF").'" class="xr_color_field" data-default-color="'.($defaultColor ? $defaultColor : "#FFFFFF").'" />';
	return $colorPicker;
}


/*
**	Skill Modal
*/

function xr_make_skill_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	$skill_title='';
	$skill_min_value='';
	$skill_max_value='';
	$skill_current_value='';
	$skill_color='';

	
	$return = '';	
	
	
	if(!empty($modal) && !$is_ajax){
		$skill_title  = isset($modal['modal']['data']['data']['skill_title']) ? $modal['modal']['data']['data']['skill_title'] : '';
		$skill_min_value  = isset($modal['modal']['data']['data']['skill_min_value']) ? $modal['modal']['data']['data']['skill_min_value'] : '';
		$skill_max_value  = isset($modal['modal']['data']['data']['skill_max_value']) ? $modal['modal']['data']['data']['skill_max_value'] : '';
		$skill_current_value  = isset($modal['modal']['data']['data']['skill_current_value']) ? $modal['modal']['data']['data']['skill_current_value'] : '';
		$skill_color  = isset($modal['modal']['data']['data']['skill_color']) ? $modal['modal']['data']['data']['skill_color'] : '';

	}
	
	
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Skill" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Skill</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="skill_title" value="'.$skill_title.'" />
				</div>
				<div class="span6">
					<strong>Skill Title</strong><br/>
					<p>Enter the title</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					'.rockbuilder_make_colorpicker($id.'-colorpicker', $skill_color).'
				</div>
				<div class="span6">
					<strong>Skill Color</strong><br/>
					<p>Choose your skill color</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="skill_min_value" value="'.$skill_min_value.'" />
				</div>
				<div class="span6">
					<strong>Skill Min Value</strong><br/>
					<p>Enter the minimum value of the skill (Number Only)</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="skill_max_value" value="'.$skill_max_value.'" />
				</div>
				<div class="span6">
					<strong>Skill Max Value</strong><br/>
					<p>Enter the maximum value of the skill (Number Only)</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="skill_current_value" value="'.$skill_current_value.'" />
				</div>
				<div class="span6">
					<strong>Skill Current Value</strong><br/>
					<p>Enter the current value of the skill (Number Only)</p>
				</div>
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary skill-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';
	
	/*
	TODO : Skill sizes removed cause of IE8 issues
				<div class="row-fluid">
				<div class="span6">
					<select class="skill_size" autocomplete="off">
						<option value="" '.($skill_size == '' ? 'selected' : '').'>Default Size</option>
						<option value="small" '.($skill_size == 'small' ? 'selected' : '').'>Small</option>
						<option value="large" '.($skill_size == 'large' ? 'selected' : '').'>Large (Only for non-responsive design)</option>
					</select>
				</div>
				<div class="span6">
					<strong>Skill Size</strong><br/>
					<p>Choose your skill size</p>
				</div>
			</div>
			<hr/>
*/

	return $return;
}

function xr_make_skill_modal_ajax(){
	echo xr_make_skill_modal();
	exit;
}
add_action('wp_ajax_xr_make_skill_modal','xr_make_skill_modal_ajax');


/*
**	End of Skill Modal
*/





/*
**	Button Modal
*/

function xr_make_button_modal($modal=null,$id=null){

	$is_ajax = false;

	$remove_modal_after = false;
	$return_to = '';
	
	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
		$remove_modal_after = (isset($modal_obj['remove_modal_after']) && $modal_obj['remove_modal_after']) == 'true' ? true : false;
		$return_to = isset($modal_obj['return_to']) ? $modal_obj['return_to'] : '';
		$return_data_to = isset($modal_obj['return_data_to']) ? $modal_obj['return_data_to'] : '';
	}
	
	$button_size = '';
	$button_flat = '';
	$button_shape = '';
	$button_wrap = '';
	$button_color = '';
	$button_link_target = '';
	$icon_class = '';
	$icon_url = '';
	$icon_used = false;
	$iconAlign = '';

	$title='Awesome Button';
	$tax_name = '';
	$link_url = '';
	$post_id = '';
	$link_html = '';
	$is_tax = 'false';
	$is_page = 'no';
	$button_align = '';
	
	$return = '';	
	
	//If loading from ajax with saved data. (For editing button)
	if($is_ajax){
		
		if(isset($modal_obj['saved_data']) && !empty($modal_obj['saved_data'])){
		
			$saved_data = json_decode(stripslashes($modal_obj['saved_data']), true);
			
			if(isset($saved_data) && !empty($saved_data) && isset($saved_data['data']) && !empty($saved_data['data'])){
				extract($saved_data['data']);	
				
				$icon_class = $iconClass;
				$icon_url = $iconURL;
				$iconAlign = $iconAlign;
				
				if(isset($link_details)){
					$tax_name = isset($link_details['tax_name']) ? $link_details['tax_name'] : '';
					$link_url =  isset($link_details['url']) ? $link_details['url'] : '';
					$post_id =  isset($link_details['post_id']) ? $link_details['post_id'] : '';
					$is_tax =  isset($link_details['is_tax']) ? $link_details['is_tax'] : 'false';
				}
		
				if($is_tax === 'false' || !$is_tax) $is_page = 'yes';
		
				if($link_url && $link_url !== ''){
					$link_html = '<input autocomplete="off" class="link_custom_input" type="text" value="'.$link_url.'" />';
				}elseif($post_id && $post_id !== 'false'){
					$link_html = rock_builder_get_linkposts_cats_posts(array('is_page'=> $is_page, 'category'=>$tax_name, 'selected'=>$post_id));	
				}
			}
		}
	}
	
	$avoid_sidebar = checked("true", (isset($modal['modal']['data']['data']['avoidSidebar']) ? $modal['modal']['data']['data']['avoidSidebar'] : false ), false);
	
	if(!empty($modal) && !$is_ajax){
		$icon_class = isset($modal['modal']['data']['data']['iconClass']) ? $modal['modal']['data']['data']['iconClass'] : '';
		$icon_url = isset($modal['modal']['data']['data']['iconURL']) ? $modal['modal']['data']['data']['iconURL'] : '';
		$iconAlign = isset($modal['modal']['data']['data']['iconAlign']) ? $modal['modal']['data']['data']['iconAlign'] : '';

		$title = isset($modal['modal']['data']['data']['title']) ? $modal['modal']['data']['data']['title'] : '';
		$button_color = isset($modal['modal']['data']['data']['button_color']) ? $modal['modal']['data']['data']['button_color'] : '';
		$button_size = isset($modal['modal']['data']['data']['button_size']) ? $modal['modal']['data']['data']['button_size'] : '';
		$button_link_target = isset($modal['modal']['data']['data']['button_link_target']) ? $modal['modal']['data']['data']['button_link_target'] : '';
		$button_flat  = isset($modal['modal']['data']['data']['button_flat']) ? $modal['modal']['data']['data']['button_flat'] : '';
		$button_shape  = isset($modal['modal']['data']['data']['button_shape']) ? $modal['modal']['data']['data']['button_shape'] : '';
		$button_wrap  = isset($modal['modal']['data']['data']['button_wrap']) ? $modal['modal']['data']['data']['button_wrap'] : '';
		$button_align  = isset($modal['modal']['data']['data']['button_align']) ? $modal['modal']['data']['data']['button_align'] : '';

		$icon_box_model = isset($modal['modal']['data']['data']['icon_box_model']) ? $modal['modal']['data']['data']['icon_box_model'] : '';
		$icon_used = ($icon_class != "" || $icon_url != "") ? true : false;
	
		if(isset($modal['modal']['data']['data']['link_details'])){
			$tax_name = isset($modal['modal']['data']['data']['link_details']['tax_name']) ? $modal['modal']['data']['data']['link_details']['tax_name'] : '';
			$link_url =  isset($modal['modal']['data']['data']['link_details']['url']) ? $modal['modal']['data']['data']['link_details']['url'] : '';
			$post_id =  isset($modal['modal']['data']['data']['link_details']['post_id']) ? $modal['modal']['data']['data']['link_details']['post_id'] : '';
			$is_tax =  isset($modal['modal']['data']['data']['link_details']['is_tax']) ? $modal['modal']['data']['data']['link_details']['is_tax'] : 'false';
		}
		

		if($is_tax === 'false' || !$is_tax) $is_page = 'yes';

		if($link_url && $link_url !== ''){
			$link_html = '<input autocomplete="off" class="link_custom_input" type="text" value="'.$link_url.'" />';
		}elseif($post_id && $post_id !== 'false'){
			$link_html = rock_builder_get_linkposts_cats_posts(array('is_page'=> $is_page, 'category'=>$tax_name, 'selected'=>$post_id));	
		}
		
	}
	
	/*
	
	Button Circle removed temporarily
	<option value="button-circle" '.($button_shape == 'button-circle' ? 'selected' : '').'>Button Circle (Only works with default button size)</option>
	*/
	
	
	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade '.(!$remove_modal_after ? '' : 'external-modal-call' ).'" tabindex="-1" role="dialog" aria-labelledby="Button" aria-hidden="true">
		<div class="modal-header">
			<div class="close '.(!$remove_modal_after ? 'builder-close' : 'close-grid-modal' ).'"><i class="fa fa-times"></i></div>
			<h3>Button</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" class="iconic-title" value="'.$title.'" />
				</div>
				<div class="span6">
					<strong>Button Text</strong><br/>
					<p>Enter the button title</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="button_color" autocomplete="off">
						<option value="" '.($button_color == '' ? 'selected' : '').'>Default Color</option>
						<option value="custom" '.($button_color == 'custom' ? 'selected' : '').'>Custom</option>
						<option value="primary" '.($button_color == 'primary' ? 'selected' : '').'>Blue</option>
						<option value="darkblue" '.($button_color == 'darkblue' ? 'selected' : '').'>Dark Blue</option>
						<option value="yellow" '.($button_color == 'yellow' ? 'selected' : '').'>Yellow</option>
						<option value="action" '.($button_color == 'action' ? 'selected' : '').'>Green</option>
						<option value="highlight" '.($button_color == 'highlight' ? 'selected' : '').'>Orange</option>
						<option value="caution" '.($button_color == 'caution' ? 'selected' : '').'>Red</option>
						<option value="royal" '.($button_color == 'royal' ? 'selected' : '').'>Purple</option>
						<option value="maroon" '.($button_color == 'maroon' ? 'selected' : '').'>Maroon</option>
					</select>
				</div>
				<div class="span6">
					<strong>Button Color</strong><br/>
					<p>Choose your button color</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					'.rock_builder_get_linkposts_cats($tax_name,$id).'
					'.$link_html.'
				</div>
				<div class="span6">
					<strong>Link</strong><br/>
					<p>If you want to link to a page or to a custom link address you can set up your link here.</p>
				</div>										
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="button_link_target" autocomplete="off">
						<option value="" '.($button_link_target == '' ? 'selected' : '').'>Self</option>
						<option value="_blank" '.($button_link_target == '_blank' ? 'selected' : '').'>New Window</option>
					</select>
				</div>
				<div class="span6">
					<strong>Button Link Target</strong><br/>
					<p>You can choose link to same page or a new page.</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="button_align" autocomplete="off">
						<option value="" '.($button_align == '' ? 'selected' : '').'>None</option>
						<option value="left" '.($button_align == 'left' ? 'selected' : '').'>Left</option>
						<option value="right" '.($button_align == 'right' ? 'selected' : '').'>Right</option>
						<option value="center" '.($button_align == 'center' ? 'selected' : '').'>Center</option>
						<option value="block" '.($button_align == 'block' ? 'selected' : '').'>Block</option>
					</select>
				</div>
				<div class="span6">
					<strong>Button Align</strong><br/>
					<p>You can align the button to the left or right. Or if you want your button to fill the parent width choose "Block".</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="button_size" autocomplete="off">
						<option value="" '.($button_size == '' ? 'selected' : '').'>Default Size</option>
						<option value="button-large" '.($button_size == 'button-large' ? 'selected' : '').'>Large</option>
						<option value="button-small" '.($button_size == 'button-small' ? 'selected' : '').'>Small</option>
						<option value="button-tiny" '.($button_size == 'button-tiny' ? 'selected' : '').'>Tiny</option>
					</select>
				</div>
				<div class="span6">
					<strong>Button Size</strong><br/>
					<p>Choose a button size</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="button_flat" autocomplete="off">
						<option value="no" '.($button_flat == '' ? 'selected' : 'no').'>No</option>
						<option value="yes" '.($button_flat == 'yes' ? 'selected' : '').'>Yes</option>
					</select>
				</div>
				<div class="span6">
					<strong>Button Flat</strong><br/>
					<p>If you want a flat design button, choose "Yes".</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="button_shape" autocomplete="off">
						<option value="" '.($button_shape == '' ? 'selected' : '').'>Default Shape</option>
						<option value="button-rounded" '.($button_shape == 'button-rounded' ? 'selected' : '').'>Button Rounded</option>
						<option value="button-pill" '.($button_shape == 'button-pill' ? 'selected' : '').'>Button Pill</option>
					</select>
				</div>
				<div class="span6">
					<strong>Button Shape</strong><br/>
					<p>You can easily choose the button shape</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="button_wrap" autocomplete="off">
						<option value="no" '.($button_wrap == '' ? 'selected' : 'no').'>Do Not Wrap Button</option>
						<option value="yes" '.($button_wrap == 'yes' ? 'selected' : '').'>Wrap Button</option>
					</select>
				</div>
				<div class="span6">
					<strong>Button Wrap</strong><br/>
					<p>If you have chosen the Button Pill from Button Shape, you can use this option. Wrapped buttons will contain a wrapper div for visual effect. If you want wrapper choose "Yes"</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6 elem-icon">
					<div class="icon-holder add-elem-icon-btn" icon-ref="'.$icon_class.'">'.(($icon_class != "") ? '<i class="'.$icon_class.' fa-4x"></i>' : '').'</div><br/>
					<input autocomplete="off" type="text" size="36" class="add-elem-icon-text" '.($icon_url != "" ? "": 'style="display:none;"').' value="'.($icon_url != "" ? $icon_url : "").'"/>
					'.(!$icon_used ? '<div class="add-elem-icon-btn btn">Add Icon</div>' : '<div class="add-elem-icon-btn btn hide">Add Icon</div>').'
					'.($icon_used ? '<div class="remove-elem-icon-btn btn">Remove Icon</div>' : '<div class="remove-elem-icon-btn btn hide">Remove Icon</div>').'
				</div>
				<div class="span6">
					<strong>Button Icon</strong><br/>
					<p>Choose an icon (Optional)</p>
				</div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span6">
					<select class="icon_align" autocomplete="off">
						<option value="left" '.($iconAlign == "left" ? 'selected' : '').'>Icon Left</option>
						<option value="right" '.($iconAlign == "right" ? 'selected' : '').'>Icon Right</option>
					</select>
				</div>
				<div class="span6">
					<strong>Icon Alignment</strong><br/>
					<p>You can set up your icon position to left or to top.</p>
				</div>										
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn '.(!$remove_modal_after ? 'builder-close' : 'close-grid-modal' ).'">Close</div>
			<div class="btn btn-primary '.(!$remove_modal_after ? 'button-modal-save builder-close' : 'save-remove-button-modal' ).'" '.($remove_modal_after ? 'return_to="'.$return_to.'" return_data_to="'.$return_data_to.'"' : '').' ref="'.$id.'">Save changes</div>
		</div>
	</div>';

	return $return;
}

function xr_make_button_modal_ajax(){
	echo xr_make_button_modal();
	exit;
}
add_action('wp_ajax_xr_make_button_modal','xr_make_button_modal_ajax');


/*
**	End of Button Modal
*/






// add button
function rockthemes_tinymce_register_plugin_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'rockthemes_tinymce_add_plugin');  
     add_filter('mce_buttons', 'rockthemes_tinymce_register_button');  
   }  
}  
add_action( 'admin_init', 'rockthemes_tinymce_register_plugin_button' );

// add plugin
function rockthemes_tinymce_add_plugin($plugin_array) {  
    $plugin_array['RockthemesPlugins'] = F_WAY.'/rock-builder/js/rock-builder-tinymce.js';

   return $plugin_array;  
} 

// register button
function rockthemes_tinymce_register_button($buttons) {  
   array_push($buttons, "rockthemes_plugins_btn");   
   array_push($buttons, "RockthemesPlugins");   
   return $buttons;  
}  
//add_button();








/*
**	Special Grid Block Modal
**
*/

function rockthemes_pb_make_specialgridblock_modals($arr = array()){
	if(empty($arr)) return;
	
	$return = '';
	foreach($arr as $modal){
		$return .= rockthemes_pb_make_specialgridblock_modal($modal,$modal['id']);
	}
	
	return $return;
}


function rockthemes_pb_make_specialgridblock_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = 'modal-'.$modal_obj['id'];
	}
	
	$return = '';	
	
	$avoid_sidebar = isset($modal['modal']['data']['data']['avoidSidebar']) ? $modal['modal']['data']['data']['avoidSidebar'] : 'false';
	$grid_special_width_details = isset($modal['modal']['data']['data']['grid_special_width_details']) ? $modal['modal']['data']['data']['grid_special_width_details'] : 'regular';
	$background_color = isset($modal['modal']['data']['data']['background_color']) ? $modal['modal']['data']['data']['background_color'] : '#00aae8';
	$use_shadow = isset($modal['modal']['data']['data']['use_shadow']) ? $modal['modal']['data']['data']['use_shadow'] : 'false';
	$activate_padding = isset($modal['modal']['data']['data']['activate_padding']) ? $modal['modal']['data']['data']['activate_padding'] : 'true';
	$transparent_background = checked("true", (isset($modal['modal']['data']['data']['transparent_background']) ? $modal['modal']['data']['data']['transparent_background'] : false ), false);
	$special_grid_html_id = isset($modal['modal']['data']['data']['special_grid_html_id']) ? $modal['modal']['data']['data']['special_grid_html_id'] : '';
	
	/*
	$animation_type = isset($modal['modal']['data']['data']['animation_type']) ? $modal['modal']['data']['data']['animation_type'] : 'true';
	$animation_delay_time = isset($modal['modal']['data']['data']['animation_delay_time']) ? $modal['modal']['data']['data']['animation_delay_time'] : 0;
	*/
	
	//Parallax Details
	$parallax_model = isset($modal['modal']['data']['data']['parallax_model']) ? $modal['modal']['data']['data']['parallax_model'] : '';
	$parallax_mask_height = isset($modal['modal']['data']['data']['parallax_mask_height']) ? $modal['modal']['data']['data']['parallax_mask_height'] : 0;
	$parallax_bg_image = isset($modal['modal']['data']['data']['parallax_bg_image']) ? $modal['modal']['data']['data']['parallax_bg_image'] : '';


	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade grid-modal" tabindex="-1" role="dialog" aria-labelledby="Grid" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Special Grid Settings</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="avoid_sidebar_not_false row-fluid '.($avoid_sidebar === 'false' ? 'hide' : '').'">
				<div class="row-fluid">
					<div class="span6">
						<select class="grid_special_width_details" autocomplete="off" ref="'.$id.'">
							<option value="regular" '.($grid_special_width_details === "regular" ? 'selected' : '').'>No Details (Regular Grid)</option>
							<option value="use_parallax" '.($grid_special_width_details == "use_parallax" ? 'selected' : '').'>Use Parallax</option>
							<option value="use_background_img" '.($grid_special_width_details == "use_background_img" ? 'selected' : '').'>Use Background Image</option>
							<option value="full_width_slider" '.($grid_special_width_details == "full_width_slider" ? 'selected' : '').'>Full Width For Sliders (Full Width Grid)</option>
							<option value="full_width_colored" '.($grid_special_width_details == "full_width_colored" ? 'selected' : '').'>Full Colored Background (Content in row, background is full)</option>
						</select>				
					</div>
					<div class="span6">
						<strong>Special Width Details</strong><br/>
						<p>You can use some special grid types. If you choose Full Width For Sliders it will display a fullwidth slider (works best with Curvy Slider). If you choose Full Colored Background, your background will be full sized but your content will be inside the regular grid.</p>
					</div>
				</div>		
			</div>
			<hr />		
			<span class="use_parallax_mode row-fluid '.($grid_special_width_details !== 'use_parallax' ? 'hide' : '').'">
				<div class="row-fluid hide">
					<div class="span6">
						'.rock_builder_get_parallax_models($parallax_model).'
					</div>
					<div class="span6">
						<strong>Parallax model</strong><br/>
						<p>You can easily choose a parallax model for this block. If you choose "None" no parallax will be attend to this block.</p>
					</div>
				</div>		
				<hr class="hide"/>	
				<div class="row-fluid">
					<div class="span6">
						<input autocomplete="off" type="text" name="parallax_mask_height" class="parallax_mask_height" value="'.$parallax_mask_height.'" />
					</div>
					<div class="span6">
						<strong>Parallax / Background Height</strong><br/>
						<p>Enter a height height value without "px". (i.e. 480)</p>
					</div>
				</div>		
				<hr/>	
				<div class="row-fluid">
					<div class="span6">
						<div class="parallax-bg-image-holder" ref="parallax-bg-image-holder">
							<div class="hide image-data"></div>
							<label for="upload_image"> <input autocomplete="off" id="parallax-bg-image-'.$id.'" class="upload_image_button parallax-bg-image-'.$id.'" size="36" name="upload_image" type="text" value="'.$parallax_bg_image.'" /> <input autocomplete="off" class="image_uploader_class btn" value="Upload Image" type="button" /> </label><br/>
						</div>
					</div>
					<div class="span6">
						<strong>Parallax / Background Image</strong><br/>
						<p>Upload your background image for parallax effect</p>
					</div>
				</div>
				<hr/>
			</span>			
			<div class="full_width_colored_mode row-fluid '.($grid_special_width_details !== 'full_width_colored' ? 'hide' : '').'">
				<div class="row-fluid">
					<div class="span6">
						<div class="background_color">
							'.rockbuilder_make_colorpicker($id.'-colorpicker', $background_color).'
						</div>
					</div>
					<div class="span6">
						<strong style="color:#FF0000;">Important : </strong> You have chosen "Full Colored Background". This will effect all of the columns till the end of the row. Using this option only at the first column of the row is advised.<br/><br/>
						<strong>Skill Color</strong><br/>
						<p>Choose your skill color</p>
					</div>
				</div>
				<hr/>
				<div class="row-fluid">
					<div class="span6">
						<div class="transparent_background_holder">
							<input autocomplete="off" type="checkbox" value="1" class="transparent_background" name="transparent_background" '.$transparent_background.' /><label for="transparent_background"> Transparent Background</label>
						</div>
					</div>
					<div class="span6">
						<strong>Transparent Background</strong><br/>
						<p>If you check transparent background, the background will be transparent.</p>
					</div>										
				</div>
				<hr/>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<select class="avoid_sidebar" autocomplete="off" ref="'.$id.'">
						<option value="false" '.($avoid_sidebar == "false" ? 'selected' : '').'>Do not Avoid Sidebars</option>
						<option value="before" '.($avoid_sidebar == "before" ? 'selected' : '').'>Insert Content Before Sidebars</option>
						<option value="after" '.($avoid_sidebar == "after" ? 'selected' : '').'>Insert Content After Sidebars</option>
					</select>				
				</div>
				<div class="span6">
					<strong>Avoid Sidebar</strong><br/>
					<p>You can add this element before the sidebars. If you want to add this element before the sidebar, check this option.</p>
				</div>
			</div>		
			<hr/>	
			<div class="row-fluid">
				<div class="span6">
					<select class="use_shadow" autocomplete="off" ref="'.$id.'">
						<option value="false" '.($use_shadow == "false" ? 'selected' : '').'>Do Not Use Shadow</option>
						<option value="true" '.($use_shadow == "true" ? 'selected' : '').'>Use Shadow</option>
					</select>				
				</div>
				<div class="span6">
					<strong>Use Shadow</strong><br/>
					<p>If you want to display shadow under content, choose "Use Shadow" option.</p>
				</div>
			</div>		
			<hr/>	
			<div class="row-fluid">
				<div class="span6">
					<select class="activate_padding" autocomplete="off" ref="'.$id.'">
						<option value="true" '.($activate_padding == "true" ? 'selected' : '').'>Activate Padding</option>
						<option value="false" '.($activate_padding == "false" ? 'selected' : '').'>Do Not Activate Padding</option>
					</select>				
				</div>
				<div class="span6">
					<strong>Activate Vertical Padding</strong><br/>
					<p>If you want to activate vertical padding choose "Activate Padding" option. This option only applies if you choose "Full Colored Background"</p>
				</div>
			</div>		
			<hr/>	
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" name="special_grid_html_id" class="special_grid_html_id" value="'.$special_grid_html_id.'" />
				</div>
				<div class="span6">
					<strong>Special Grid ID</strong><br/>
					<p>Enter a unique id for this special grid. Do not use uppercase and special characters. You can use alphanumeric characters and - symbol. This field is optional, you can leave this empty.</p>
				</div>
			</div>
			<hr/>
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary grid-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';

	return $return;
}

function rockthemes_pb_make_specialgridblock_modal_ajax(){
	echo rockthemes_pb_make_specialgridblock_modal();
	exit;
}
add_action('wp_ajax_rockthemes_pb_make_specialgridblock_modal','rockthemes_pb_make_specialgridblock_modal_ajax');
/*
*/







/*
**	GRID MODAL (MAIN MODAL FOR ALL OF THE GRID DETAILS)
*/

function rockthemes_pb_make_grid_modals($arr){
	$return = '';
	foreach($arr as $modal){
		$return .= xr_make_grid_modal($modal,$modal['id']);
	}
	
	return $return;
}


function xr_make_grid_modal($modal=null,$id=null){

	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = 'modal-'.$modal_obj['id'];
	}
	
	$return = '';	
	
	/*
	$avoid_sidebar = isset($modal['modal']['data']['data']['avoidSidebar']) ? $modal['modal']['data']['data']['avoidSidebar'] : 'false';
	$grid_special_width_details = isset($modal['modal']['data']['data']['grid_special_width_details']) ? $modal['modal']['data']['data']['grid_special_width_details'] : 'regular';
	$background_color = isset($modal['modal']['data']['data']['background_color']) ? $modal['modal']['data']['data']['background_color'] : '#00aae8';
	$use_shadow = isset($modal['modal']['data']['data']['use_shadow']) ? $modal['modal']['data']['data']['use_shadow'] : 'false';
	$activate_padding = isset($modal['modal']['data']['data']['activate_padding']) ? $modal['modal']['data']['data']['activate_padding'] : 'true';
	$transparent_background = checked("true", (isset($modal['modal']['data']['data']['transparent_background']) ? $modal['modal']['data']['data']['transparent_background'] : false ), false);
	*/
	$animation_type = isset($modal['modal']['data']['data']['animation_type']) ? $modal['modal']['data']['data']['animation_type'] : 'true';
	$animation_delay_time = isset($modal['modal']['data']['data']['animation_delay_time']) ? $modal['modal']['data']['data']['animation_delay_time'] : 0;

	$return = '
	<div id="'.$id.'" class="rpb_modal container hide fade grid-modal" tabindex="-1" role="dialog" aria-labelledby="Grid" aria-hidden="true">
		<div class="modal-header">
			<div class="close builder-close"><i class="fa fa-times"></i></div>
			<h3>Grid Settings</h3>
		</div>
		<div class="modal-body" data-saved="false">
			<div class="row-fluid">
				<div class="span6">
					'.rock_builder_get_animation_classes($animation_type).'
				</div>
				<div class="span6">
					<strong>Grid Animation Type</strong><br/>
					<p>You can easily choose an animation type for this grid. If you choose "None" no animation will be attend to this grid. Any chosen animation will be activated when the grid is in the viewport.</p>
				</div>
			</div>		
			<hr/>	
			<div class="row-fluid">
				<div class="span6">
					<input autocomplete="off" type="text" name="animation_delay_time" class="animation_delay_time" value="'.$animation_delay_time.'" />
				</div>
				<div class="span6">
					<strong>Grid Animation Delay Time</strong><br/>
					<p>Enter a number in milliseconds to delay the grid animation.</p>
				</div>
			</div>		
			<hr/>	
		</div>
		<div class="modal-footer">
			<div class="btn builder-close">Close</div>
			<div class="btn btn-primary grid-modal-save builder-close" ref="'.$id.'">Save changes</div>
		</div>
	</div>';

	return $return;
}

function xr_make_grid_modal_ajax(){
	echo xr_make_grid_modal();
	exit;
}
add_action('wp_ajax_xr_make_grid_modal','xr_make_grid_modal_ajax');






/*
**	ICONIC TEXT MODAL
*/

function xr_make_iconictext_modal($modal=null,$id=null){
	$is_ajax = false;
	
	$icon_class = '';
	$icon_url = '';
	$icon_used = false;
	$title = '';
	$content = '';
	$use_shadow = 'false';
	$iconAlign = '';
	$boxed_layout = 'false';
	$iconSize = '';
	$icon_box_model = '';
	$tax_name = '';
	$link_url = '';
	$post_id = '';
	$link_html = '';
	$is_tax = 'false';
	$is_page = 'no';
	
	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];
		$id = $modal_obj['id'];
	}
	
	
	if(!empty($modal) && !$is_ajax){
		$icon_class = $modal['modal']['data']['data']['iconClass'];
		$icon_url = $modal['modal']['data']['data']['iconURL'];
		$content = $modal['modal']['data']['data']['content'];
		$title = $modal['modal']['data']['data']['title'];
		$iconSize = $modal['modal']['data']['data']['iconSize'];
		$icon_box_model = isset($modal['modal']['data']['data']['icon_box_model']) ? $modal['modal']['data']['data']['icon_box_model'] : '';
		$icon_used = ($icon_class != "" || $icon_url != "") ? true : false;
		
		if(isset($modal['modal']['data']['data']['link_details'])){
			$tax_name = isset($modal['modal']['data']['data']['link_details']['tax_name']) ? $modal['modal']['data']['data']['link_details']['tax_name'] : '';
			$link_url =  isset($modal['modal']['data']['data']['link_details']['url']) ? $modal['modal']['data']['data']['link_details']['url'] : '';
			$post_id =  isset($modal['modal']['data']['data']['link_details']['post_id']) ? $modal['modal']['data']['data']['link_details']['post_id'] : '';
			$is_tax =  isset($modal['modal']['data']['data']['link_details']['is_tax']) ? $modal['modal']['data']['data']['link_details']['is_tax'] : 'false';
		}

		if($is_tax === 'false' || !$is_tax) $is_page = 'yes';
		
		if($link_url && $link_url !== ''){
			$link_html = '<input autocomplete="off" class="link_custom_input" type="text" value="'.$link_url.'" />';
		}elseif($post_id && $post_id !== 'false'){
			$link_html = rock_builder_get_linkposts_cats_posts(array('is_page'=> $is_page, 'category'=>$tax_name, 'selected'=>$post_id));	
		}
		
	
		$iconAlign = $modal['modal']['data']['data']['iconAlign'];
		$boxed_layout = checked("true", (isset($modal['modal']['data']['data']['boxed_layout']) ? $modal['modal']['data']['data']['boxed_layout'] : false ), false);		
		$use_shadow = checked("true", (isset($modal['modal']['data']['data']['use_shadow']) ? $modal['modal']['data']['data']['use_shadow'] : false ), false);
	}
	
	
	$return = '';	
							
			$return .= 
			'<div id="'.$id.'" modalType="iconictext" class="rpb_modal container hide fade" tabindex="-1">
								<div class="modal-header">
									<div class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></div>
					  				<h3>Add Iconic Text</h3>
								</div>
								<div class="modal-body" data-saved="false">
									<div class="row-fluid">
										<div class="span6">
											<input autocomplete="off" type="text" class="iconic-title" value="'.$title.'" />
										</div>
										<div class="span6">
											<strong>Icon Title</strong><br/>
											<p>You can enter a title for your header text.</p>
										</div>
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6 textarea-holder">
											<div class="rock-tinymce-container wp-core-ui wp-editor-wrap html-active">
												<div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js">
													<div class="wp-editor-tabs">
														<a class="rock-tinymce-switch-text wp-switch-editor switch-tmce" >Visual</a>
														<a class="rock-tinymce-switch-html wp-switch-editor switch-html" >Text</a>
													</div>
													<div id="wp-content-media-buttons" class="wp-media-buttons"><a href="#" id="insert-media-button" class="button insert-media add_media" data-editor="'.$id.'-editor" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a></div>
												</div>
												<div class="wp-content-editor-container wp-editor-container">
													<textarea rows="8" cols="40" class="rock-tinymce-textarea description" name="'.$id.'-editor" id="'.$id.'-editor" class="wp-editor-area">'.stripslashes($content).'</textarea>
												</div>
												<div class="tinymce-hidden-data hide">'.$content.'</div>
											</div>
										</div>
										<div class="span6">
											<strong>Content</strong><br/>
											<p>Enter your content here. You can use the Rich Text Editor for your content.</p>
										</div>
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6 elem-icon">
											<div class="icon-holder add-elem-icon-btn" icon-ref="'.$icon_class.'">'.(($icon_class != "") ? '<i class="'.$icon_class.' fa-4x"></i>' : '').'</div><br/>
											<input autocomplete="off" type="text" size="36" class="add-elem-icon-text" '.($icon_url != "" ? "": 'style="display:none;"').' value="'.($icon_url != "" ? $icon_url : "").'"/>
											'.(!$icon_used ? '<div class="add-elem-icon-btn btn">Add Icon</div>' : '<div class="add-elem-icon-btn btn hide">Add Icon</div>').'
											'.($icon_used ? '<div class="remove-elem-icon-btn btn">Remove Icon</div>' : '<div class="remove-elem-icon-btn btn hide">Remove Icon</div>').'
										</div>
										<div class="span6">
											<strong>Icon</strong><br/>
											<p>Choose an icon</p>
										</div>
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<select class="icon_align" autocomplete="off">
												<option value="top" '.($iconAlign == "top" ? 'selected' : '').'>Icon Top</option>
												<option value="left" '.($iconAlign == "left" ? 'selected' : '').'>Icon Left</option>
											</select>
										</div>
										<div class="span6">
											<strong>Icon Alignment</strong><br/>
											<p>You can set up your icon position to left or to top.</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<select class="icon_size" autocomplete="off">
												<option value="" '.($iconSize === "" ? 'selected' : '').'>Default</option>
												<option value="icon-2" '.($iconSize === "icon-2" ? 'selected' : '').'>Icon 2</option>
												<option value="icon-3" '.($iconSize === "icon-3" ? 'selected' : '').'>Icon 3 (Best for boxed icons)</option>
												<option value="icon-4" '.($iconSize === "icon-4" ? 'selected' : '').'>Icon 4</option>
											</select>
										</div>
										<div class="span6">
											<strong>Choose an icon size</strong><br/>
											<p>There are 4 different icon size. You can choose any icon size you want. Ensure your icon size is not larger than your content area</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											'.rock_builder_get_linkposts_cats($tax_name,$id).'
											'.$link_html.'
										</div>
										<div class="span6">
											<strong>Link</strong><br/>
											<p>If you want to link to a page or to a custom link address you can set up your link here.</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<select class="icon_box_model" autocomplete="off">
												<option value="no-box" '.($icon_box_model === '' ? 'selected' : '').'>No Icon Box</option>
												<option value="quasar-box" '.($icon_box_model === 'quasar-box' ? 'selected' : '').'>Quasar Box</option>
												<option value="circle-box" '.($icon_box_model === 'circle-box' ? 'selected' : '').'>Circle Box</option>
												<option value="rounded-box" '.($icon_box_model === 'rounded-box' ? 'selected' : '').'>Rounded Box</option>
												<option value="cornered-box" '.($icon_box_model === 'cornered-box' ? 'selected' : '').'>Cornered Box</option>
											</select>
										</div>
										<div class="span6">
											<strong>Use Box for Icons</strong><br/>
											<p>You can choose a box model for your icons. If you specify a box model, your icons will be inside the box. Any uploaded icon via uploader will fit in the icon box. If you are using Fontawesome icons, set icon size to "Icon 3" for box layouts.</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<div class="boxed_layout_holder">
												<input autocomplete="off" class="boxed_layout" type="checkbox" value="true" name="boxed_layout" '.$boxed_layout.' /><label for="activate_hover"> Use Boxed Layout</label>
											</div>
										</div>
										<div class="span6">
											<strong>Boxed Layout</strong><br/>
											<p>If you want to wrap a boxed layout around this element, check this option.</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<div class="use_shadow_holder">
												<input autocomplete="off" class="use_shadow" type="checkbox" value="true" name="use_shadow" '.$use_shadow.' /><label for="activate_hover"> Use Shadow</label>
											</div>
										</div>
										<div class="span6">
											<strong>Use Header Shadow</strong><br/>
											<p>This option will activate/deactivate the shadows under the header text.</p>
										</div>										
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
									<div class="btn btn-primary iconictext-save">Save changes</div>
								</div>
							</div>';
					
		return $return;
}

function xr_make_iconictext_modal_ajax(){
	echo xr_make_iconictext_modal();
	exit;
}
add_action('wp_ajax_xr_make_iconictext_modal', 'xr_make_iconictext_modal_ajax');

/*
**	END OF ICONIC TEXT MODAL
*/








function xr_make_tabs_modal($modal=null,$id=null){
	$is_ajax = false;

	if(isset($_REQUEST['ajax_object'])){
		$is_ajax = true;
		$modal_obj = $_REQUEST['ajax_object'];

		$id = $modal_obj['id'];
	}
	
	$return = '';
	
	$tabType = '';
	$boxed_layout = 'false';
	$open_tab_index = 0;
	$use_shadow = 'false';
	$script = '';
	
	$tabsString = '												
		<li class="tabs-block active">
			<div class="hide secret-desc" tab-title="Tabs Awesome" icon_class="" icon_url=""><p>Tab Awesome Content</p></div>
			<i class="drag fa fa-move"></i>
			<span class="tab-name" ref="'.$id.'" tab-index="0">Tabs Awesome</span>
			<i class="close fa fa-times"></i>
		</li>
		<li class="tabs-block">
			<div class="hide secret-desc" tab-title="Tabs Awesome" icon_class="" icon_url=""><p>Tab Awesome Content</p></div>
			<i class="drag fa fa-move"></i>
			<span class="tab-name" ref="'.$id.'" tab-index="1">Tabs Awesome</span>
			<i class="close fa fa-times"></i>
		</li>';
	
		if(!$is_ajax){
			$tabType = $modal['modal']['data']['data']['tabType'];
			$boxed_layout = checked("true", (isset($modal['modal']['data']['data']['boxed_layout']) ? $modal['modal']['data']['data']['boxed_layout'] : false ), false);
			$use_shadow = checked("true", (isset($modal['modal']['data']['data']['use_shadow']) ? $modal['modal']['data']['data']['use_shadow'] : false ), false);
			$open_tab_index = intval(isset($modal['modal']['data']['data']['opentabIndex']) ? $modal['modal']['data']['data']['opentabIndex'] : 0);
		
			$tabsString = '';

			if(isset($modal['modal']['data']['data']['tabs']) && is_array($modal['modal']['data']['data']['tabs'])){
				$tab_index = 0;
				foreach($modal['modal']['data']['data']['tabs'] as $tab){
					$tabsString .= '
						<li class="tabs-block">
							<div class="hide secret-desc" tab-title="'.$tab['title'].'" icon_class="'.$tab['icon_class'].'" icon_url="'.$tab['icon_url'].'">'.($tab['text']).'</div>
							<i class="drag fa fa-move"></i>
							<span class="tab-name" ref="'.$id.'" tab-index="'.$tab_index.'">'.$tab['title'].'</span>
							<i class="close fa fa-times"></i>
						</li>';
						
					$tab_index++;
				}
			}
			
			$script = '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#'.$id.' .tabs-list" ).sortable({
						handle : "i.drag",
					});
				});
			</script>';
		}
						
			$return .= 
			'<div id="'.$id.'" modalType="tabs" class="rpb_modal container hide fade" >
								<div class="modal-header">
									<div class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></div>
					  				<h3>Add tab</h3>
								</div>
								<div class="modal-body" data-saved="false">
									<div class="row-fluid">
										<div class="tabs-elements-holder span12">
											<ul class="tabs-list">
												'.$tabsString.'
											</ul>
											<div class="tabs-block add-new-tab-btn" ref="'.$id.'">
												<i class="drag fa fa-plus"></i>
											</div>
											<div class="clear"></div>
											<div class="tab-textarea-holder" tab-index="0" ref="'.$id.'">
												<div rows="10" cols="50" class="alignleft" contenteditable="true" disabled="disabled"></div>
											</div>
										</div>
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<select class="tab-type" autocomplete="off">
												<option value="tab-top" '.($tabType == "tab-top" ? 'selected' : '').'>Tab Top</option>
												<option value="tab-left" '.($tabType == "tab-left" ? 'selected' : '').'>Tab Left</option>
												<option value="tab-right" '.($tabType == "tab-right" ? 'selected' : '').'>Tab Right </option>
											</select>
										</div>
										<div class="span6">
											<strong>Choose Tab Type</strong><br/>
											<p>You can set up your tabs with 3 different mode. Tab Top will display the tab headers at the top, tab left will display at the left and tab right will be display at the right.</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<div class="open_tab_index_holder">
												<input autocomplete="off" type="text" value="'.$open_tab_index.'" class="open_tab_index" name="open_tab_index" />
											</div>
										</div>
										<div class="span6">
											<strong>Open Tab Index</strong><br/>
											<p>Index of the tab will be open. If you want your first tab to be open enter 0. If you want all tabs to be closed enter -1</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<div class="boxed_layout_holder">
												<input autocomplete="off" class="boxed_layout" type="checkbox" value="true" name="boxed_layout" '.$boxed_layout.' /><label for="activate_hover"> Use Boxed Layout</label>
											</div>
										</div>
										<div class="span6">
											<strong>Boxed Layout</strong><br/>
											<p>If you want to wrap a boxed layout around this element, check this option.</p>
										</div>										
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<div class="use_shadow_holder">
												<input autocomplete="off" class="use_shadow" type="checkbox" value="true" name="use_shadow" '.$use_shadow.' /><label for="activate_hover"> Use Shadow</label>
											</div>
										</div>
										<div class="span6">
											<strong>Use Header Shadow</strong><br/>
											<p>This option will activate/deactivate the shadows under the header text.</p>
										</div>										
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
									<div class="btn btn-primary tabs-save">Save changes</div>
								</div>
							</div>';
					
		return $return.$script;
	
	exit;
}

function xr_make_tabs_modal_ajax(){
	echo xr_make_tabs_modal();
	exit;
}
add_action('wp_ajax_xr_make_tabs_modal', 'xr_make_tabs_modal_ajax');





function rock_make_single_tab_modal($tabObj=null, $id=null){
	
	$icon_class = '';
	$icon_url = '';
	$icon_used = false;
	
	if(isset($_REQUEST['tab_obj'])){
		$tabObj = $_REQUEST['tab_obj'];	
		$id = $tabObj['id'];
		$icon_class = isset($tabObj['icon_class']) ? $tabObj['icon_class'] : '';
		$icon_url = isset($tabObj['icon_url']) ? $tabObj['icon_url'] : '';
		$icon_used = ($icon_class != "" || $icon_url != "") ? true : false;
	}
	
		
	$return = '<div id="tabs-single-modal" modalType="tabs" class="rpb_modal container hide fade" tabindex="-1" role="dialog" style="width:1024px; margin-left:-512px;" aria-labelledby="Tabs" aria-hidden="true" data-focus-on="input:first">
								<div class="modal-header">
									<div class="close close-tab-single"><i class="fa fa-times"></i></div>
					  				<h3>Add Tab</h3>
								</div>
								<div class="modal-body" data-saved="false">
									<div class="row-fluid">
										<div class="span6">
											<input autocomplete="off" name="tab_header" class="tab_header" type="text" value="'.esc_attr(stripslashes($tabObj['title'])).'" />
										</div>
										<div class="span6">
											<strong>Tab Header</strong><br/>
											<p>Enter the header text of your tab</p>
										</div>
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6 tabs-list">
											<div class="rock-tinymce-container wp-core-ui wp-editor-wrap tmce-active">
												<div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js">
													<div class="wp-editor-tabs">
														<a class="rock-tinymce-switch-text wp-switch-editor switch-tmce" >Visual</a>
														<a class="rock-tinymce-switch-html wp-switch-editor switch-html" >Text</a>
													</div>
													<div id="wp-content-media-buttons" class="wp-media-buttons"><a href="#" id="insert-media-button" class="button insert-media add_media" data-editor="tabs-single-modal-editor" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a></div>
												</div>
												<div class="wp-content-editor-container wp-editor-container">
													<textarea rows="8" cols="40" class="rock-tinymce-textarea description" initialized="true" name="tabs-single-modal-editor" id="tabs-single-modal-editor" class="wp-editor-area"></textarea>
												</div>
											</div>
										</div>
										<div class="span6">
											<strong>Tab Content</strong><br/>
											<p>Enter your tab content here. You can use the Rich Text Editor for your tab content.</p>
										</div>
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6 elem-icon">
											<div class="icon-holder add-elem-icon-btn" icon-ref="'.$icon_class.'">'.(($icon_class != "") ? '<i class="'.$icon_class.' fa-4x"></i>' : '').'</div><br/>
											<input autocomplete="off" type="text" size="36" class="add-elem-icon-text" '.($icon_url != "" ? "": 'style="display:none;"').' value="'.($icon_url != "" ? $icon_url : "").'"/>
											'.(!$icon_used ? '<div class="add-elem-icon-btn btn">Add Icon</div>' : '<div class="add-elem-icon-btn btn hide">Add Icon</div>').'
											'.($icon_used ? '<div class="remove-elem-icon-btn btn">Remove Icon</div>' : '<div class="remove-elem-icon-btn btn hide">Remove Icon</div>').'
										</div>
										<div class="span6">
											<strong>Tab Icon</strong><br/>
											<p>Choose an icon for your tab header</p>
										</div>
									</div>
									<hr/>
								</div>
								<div class="modal-footer"><div class="btn close-tab-single">Close</div><div class="btn btn-primary tabs-single-save" ref="'.$tabObj['index'].'" modal-ref="'.$id.'">Save changes</div></div></div>';


	return $return;
}

function rock_make_single_tab_modal_ajax(){
	echo rock_make_single_tab_modal();	
	exit;
}

add_action('wp_ajax_rock_make_single_tab_modal', 'rock_make_single_tab_modal_ajax');










/*
**	Rock Font Awesome List and Icon Modal
**	This function is very extendable with new icons
**	This also supports 3rd party icons with their link
*/

function rock_icon_list_modal(){
	//We declare icon list in another function to make it all expandable without touching core codes.
	$icon_list = rock_get_icon_list();	
	
	$icon_html = '';
	
	foreach($icon_list as $icon){
		$icon_html .= '<i class="fa '.$icon.' fa-3x rock-choose-icon" ref="'.$icon.'"></i>';	
	}
	
	$return = '<div id="rock-icon-list-modal" modalType="iconlist" class="rpb_modal container hide fade" tabindex="-1" role="dialog" aria-labelledby="Tabs" aria-hidden="true">
								<div class="modal-header">
									<div class="close close-tab-single"><i class="fa fa-times"></i></div>
					  				<h3>Choose an Icon</h3>
								</div>
								<div class="modal-body" data-saved="false">
									<div class="row-fluid">
										<div class="span12">
											<h3>Font Awesome Icons</h3><br/>
											<input autocomplete="off" type="text" class="rock-search-fontawesome-icons" value="" placeholder="Search :" />
											<div class="rock-fontawesome-icons" >
												'.$icon_html.'
											</div>
										</div>
									</div>
									<hr/>
									<div class="row-fluid">
										<div class="span6">
											<div class="swiperslider-modal-image" ref="icon-image-uploader">
												<h4>Choose an Image</h4>
												<div class="hide image-data"></div>
												<label for="upload_image"> <input autocomplete="off" id="icon-image-uploader" class="upload_image_button" size="36" name="upload_image" type="text" value="" /> <input autocomplete="off" class="image_uploader_class btn" value="Upload Image" type="button" /> </label><br/>
											</div>
										</div>
										<div class="span6">
											<h3>External Icon</h3>
											<p>If you don\'t want to use fontawesome icons, you can either enter a link of an icon or upload your own icon file.But we strongly recommend using FontAwesome icons for Retina Support.</p>
										</div>
									</div>
									<hr/>
								</div>
								<div class="modal-footer">
									<div class="btn close-tab-single">Close</div>
									<div class="btn btn-primary iconlist-save" modal-ref="rock-icon-list-modal">Save changes</div>
								</div>
							</div>';
		
	return $return;
}

function rock_icon_list_modal_ajax(){
	echo rock_icon_list_modal();
	exit;
}
add_action('wp_ajax_rock_icon_list_modal','rock_icon_list_modal_ajax');

function rock_get_icon_list(){
	$icon_list = array(
		'fa-glass',
		'fa-music',
		'fa-search',
		'fa-envelope-o',
		'fa-heart',
		'fa-star',
		'fa-star-o',
		'fa-user',
		'fa-film',
		'fa-th-large',
		'fa-th',
		'fa-th-list',
		'fa-check',
		'fa-times',
		'fa-search-plus',
		'fa-search-minus',
		'fa-power-off',
		'fa-signal',
		'fa-gear',
		'fa-cog',
		'fa-trash-o',
		'fa-home',
		'fa-file-o',
		'fa-clock-o',
		'fa-road',
		'fa-download',
		'fa-arrow-circle-o-down',
		'fa-arrow-circle-o-up',
		'fa-inbox',
		'fa-play-circle-o',
		'fa-rotate-right',
		'fa-repeat',
		'fa-refresh',
		'fa-list-alt',
		'fa-lock',
		'fa-flag',
		'fa-headphones',
		'fa-volume-off',
		'fa-volume-down',
		'fa-volume-up',
		'fa-qrcode',
		'fa-barcode',
		'fa-tag',
		'fa-tags',
		'fa-book',
		'fa-bookmark',
		'fa-print',
		'fa-camera',
		'fa-font',
		'fa-bold',
		'fa-italic',
		'fa-text-height',
		'fa-text-width',
		'fa-align-left',
		'fa-align-center',
		'fa-align-right',
		'fa-align-justify',
		'fa-list',
		'fa-dedent',
		'fa-outdent',
		'fa-indent',
		'fa-video-camera',
		'fa-picture-o',
		'fa-pencil',
		'fa-map-marker',
		'fa-adjust',
		'fa-tint',
		'fa-edit',
		'fa-pencil-square-o',
		'fa-share-square-o',
		'fa-check-square-o',
		'fa-move',
		'fa-step-backward',
		'fa-fast-backward',
		'fa-backward',
		'fa-play',
		'fa-pause',
		'fa-stop',
		'fa-forward',
		'fa-fast-forward',
		'fa-step-forward',
		'fa-eject',
		'fa-chevron-left',
		'fa-chevron-right',
		'fa-plus-circle',
		'fa-minus-circle',
		'fa-times-circle',
		'fa-check-circle',
		'fa-question-circle',
		'fa-info-circle',
		'fa-crosshairs',
		'fa-times-circle-o',
		'fa-check-circle-o',
		'fa-ban',
		'fa-arrow-left',
		'fa-arrow-right',
		'fa-arrow-up',
		'fa-arrow-down',
		'fa-mail-forward',
		'fa-share',
		'fa-resize-full',
		'fa-resize-small',
		'fa-plus',
		'fa-minus',
		'fa-asterisk',
		'fa-exclamation-circle',
		'fa-gift',
		'fa-leaf',
		'fa-fire',
		'fa-eye',
		'fa-eye-slash',
		'fa-warning',
		'fa-exclamation-triangle',
		'fa-plane',
		'fa-calendar',
		'fa-random',
		'fa-comment',
		'fa-magnet',
		'fa-chevron-up',
		'fa-chevron-down',
		'fa-retweet',
		'fa-shopping-cart',
		'fa-folder',
		'fa-folder-open',
		'fa-resize-vertical',
		'fa-resize-horizontal',
		'fa-bar-chart-o',
		'fa-twitter-square',
		'fa-facebook-square',
		'fa-camera-retro',
		'fa-key',
		'fa-gears',
		'fa-cogs',
		'fa-comments',
		'fa-thumbs-o-up',
		'fa-thumbs-o-down',
		'fa-star-half',
		'fa-heart-o',
		'fa-sign-out',
		'fa-linkedin-square',
		'fa-thumb-tack',
		'fa-external-link',
		'fa-sign-in',
		'fa-trophy',
		'fa-github-square',
		'fa-upload',
		'fa-lemon-o',
		'fa-phone',
		'fa-square-o',
		'fa-bookmark-o',
		'fa-phone-square',
		'fa-twitter',
		'fa-facebook',
		'fa-github',
		'fa-unlock',
		'fa-credit-card',
		'fa-rss',
		'fa-hdd',
		'fa-bullhorn',
		'fa-bell',
		'fa-certificate',
		'fa-hand-o-right',
		'fa-hand-o-left',
		'fa-hand-o-up',
		'fa-hand-o-down',
		'fa-arrow-circle-left',
		'fa-arrow-circle-right',
		'fa-arrow-circle-up',
		'fa-arrow-circle-down',
		'fa-globe',
		'fa-wrench',
		'fa-tasks',
		'fa-filter',
		'fa-briefcase',
		'fa-fullscreen',
		'fa-group',
		'fa-chain',
		'fa-link',
		'fa-cloud',
		'fa-flask',
		'fa-cut',
		'fa-scissors',
		'fa-copy',
		'fa-files-o',
		'fa-paperclip',
		'fa-save',
		'fa-floppy-o',
		'fa-square',
		'fa-reorder',
		'fa-list-ul',
		'fa-list-ol',
		'fa-strikethrough',
		'fa-underline',
		'fa-table',
		'fa-magic',
		'fa-truck',
		'fa-pinterest',
		'fa-pinterest-square',
		'fa-google-plus-square',
		'fa-google-plus',
		'fa-money',
		'fa-caret-down',
		'fa-caret-up',
		'fa-caret-left',
		'fa-caret-right',
		'fa-columns',
		'fa-unsorted',
		'fa-sort',
		'fa-sort-down',
		'fa-sort-asc',
		'fa-sort-up',
		'fa-sort-desc',
		'fa-envelope',
		'fa-linkedin',
		'fa-rotate-left',
		'fa-undo',
		'fa-legal',
		'fa-gavel',
		'fa-dashboard',
		'fa-tachometer',
		'fa-comment-o',
		'fa-comments-o',
		'fa-flash',
		'fa-bolt',
		'fa-sitemap',
		'fa-umbrella',
		'fa-paste',
		'fa-clipboard',
		'fa-lightbulb-o',
		'fa-exchange',
		'fa-cloud-download',
		'fa-cloud-upload',
		'fa-user-md',
		'fa-stethoscope',
		'fa-suitcase',
		'fa-bell-o',
		'fa-coffee',
		'fa-cutlery',
		'fa-file-text-o',
		'fa-building',
		'fa-hospital',
		'fa-ambulance',
		'fa-medkit',
		'fa-fighter-jet',
		'fa-beer',
		'fa-h-square',
		'fa-plus-square',
		'fa-angle-double-left',
		'fa-angle-double-right',
		'fa-angle-double-up',
		'fa-angle-double-down',
		'fa-angle-left',
		'fa-angle-right',
		'fa-angle-up',
		'fa-angle-down',
		'fa-desktop',
		'fa-laptop',
		'fa-tablet',
		'fa-mobile-phone',
		'fa-mobile',
		'fa-circle-o',
		'fa-quote-left',
		'fa-quote-right',
		'fa-spinner',
		'fa-circle',
		'fa-mail-reply',
		'fa-reply',
		'fa-github-alt',
		'fa-folder-o',
		'fa-folder-open-o',
		'fa-expand-o',
		'fa-collapse-o',
		'fa-smile-o',
		'fa-frown-o',
		'fa-meh-o',
		'fa-gamepad',
		'fa-keyboard-o',
		'fa-flag-o',
		'fa-flag-checkered',
		'fa-terminal',
		'fa-code',
		'fa-reply-all',
		'fa-mail-reply-all',
		'fa-star-half-empty',
		'fa-star-half-full',
		'fa-star-half-o',
		'fa-location-arrow',
		'fa-crop',
		'fa-code-fork',
		'fa-unlink',
		'fa-chain-broken',
		'fa-question',
		'fa-info',
		'fa-exclamation',
		'fa-superscript',
		'fa-subscript',
		'fa-eraser',
		'fa-puzzle-piece',
		'fa-microphone',
		'fa-microphone-slash',
		'fa-shield',
		'fa-calendar-o',
		'fa-fire-extinguisher',
		'fa-rocket',
		'fa-maxcdn',
		'fa-chevron-circle-left',
		'fa-chevron-circle-right',
		'fa-chevron-circle-up',
		'fa-chevron-circle-down',
		'fa-html5',
		'fa-css3',
		'fa-anchor',
		'fa-unlock-o',
		'fa-bullseye',
		'fa-ellipsis-horizontal',
		'fa-ellipsis-vertical',
		'fa-rss-square',
		'fa-play-circle',
		'fa-ticket',
		'fa-minus-square',
		'fa-minus-square-o',
		'fa-level-up',
		'fa-level-down',
		'fa-check-square',
		'fa-pencil-square',
		'fa-external-link-square',
		'fa-share-square',
		'fa-compass',
		'fa-toggle-down',
		'fa-caret-square-o-down',
		'fa-toggle-up',
		'fa-caret-square-o-up',
		'fa-toggle-right',
		'fa-caret-square-o-right',
		'fa-euro',
		'fa-eur',
		'fa-gbp',
		'fa-dollar',
		'fa-usd',
		'fa-rupee',
		'fa-inr',
		'fa-cny',
		'fa-rmb',
		'fa-yen',
		'fa-jpy',
		'fa-ruble',
		'fa-rouble',
		'fa-rub',
		'fa-won',
		'fa-krw',
		'fa-bitcoin',
		'fa-btc',
		'fa-file',
		'fa-file-text',
		'fa-sort-alpha-asc',
		'fa-sort-alpha-desc',
		'fa-sort-amount-asc',
		'fa-sort-amount-desc',
		'fa-sort-numeric-asc',
		'fa-sort-numeric-desc',
		'fa-thumbs-up',
		'fa-thumbs-down',
		'fa-youtube-square',
		'fa-youtube',
		'fa-xing',
		'fa-xing-square',
		'fa-youtube-play',
		'fa-dropbox',
		'fa-stack-overflow',
		'fa-instagram',
		'fa-flickr',
		'fa-adn',
		'fa-bitbucket',
		'fa-bitbucket-square',
		'fa-tumblr',
		'fa-tumblr-square',
		'fa-long-arrow-down',
		'fa-long-arrow-up',
		'fa-long-arrow-left',
		'fa-long-arrow-right',
		'fa-apple',
		'fa-windows',
		'fa-android',
		'fa-linux',
		'fa-dribbble',
		'fa-skype',
		'fa-foursquare',
		'fa-trello',
		'fa-female',
		'fa-male',
		'fa-gittip',
		'fa-sun-o',
		'fa-moon-o',
		'fa-archive',
		'fa-bug',
		'fa-vk',
		'fa-weibo',
		'fa-renren',
		'fa-pagelines',
		'fa-stack-exchange',
		'fa-arrow-circle-o-right',
		'fa-arrow-circle-o-left',
		'fa-toggle-left',
		'fa-caret-square-o-left',
		'fa-dot-circle-o',
		'fa-wheelchair',
		'fa-vimeo-square',
		'fa-turkish-lira',
		'fa-try',
	);	
	
	return $icon_list;
}




if(!function_exists('rockthemes_pb_make_columns_list')){
/*
**	Rock Builder Uses 12 Columns Grid system
**	This function generates a list object for 12 column
**	@param $selected = selected column value
*/
	function rockthemes_pb_make_columns_list($selected = null){
		
		
		$return = '<div class="columns_select_holder">
						<h4>Select Columns</h4>
						<select class="columns_select">';
		
		if($selected === 1){
			$return .= '<option value="1" selected>One Column</option>';
		}else{
			$return .= '<option value="1">One Column</option>';
		}
		
		if($selected === 2){
			$return .= '<option value="2" selected>Two Column</option>';
		}else{
			$return .= '<option value="2">Two Column</option>';
		}
		
		if($selected === 3){
			$return .= '<option value="3" selected>Three Column</option>';
		}else{
			$return .= '<option value="3">Three Column</option>';
		}
		
		if($selected === 4){
			$return .= '<option value="4" selected>Four Column</option>';
		}else{
			$return .= '<option value="4">Four Column</option>';
		}
		
		if($selected === 5){
			$return .= '<option value="5" selected>Five Column</option>';
		}else{
			$return .= '<option value="5">Five Column</option>';
		}
		
		if($selected === 6){
			$return .= '<option value="6" selected>Six Column</option>';
		}else{
			$return .= '<option value="6">Six Column</option>';
		}
		
		if($selected === 7){
			$return .= '<option value="7" selected>Seven Column</option>';
		}else{
			$return .= '<option value="7">Seven Column</option>';
		}
	
		if($selected === 8){
			$return .= '<option value="8" selected>Eight Column</option>';
		}else{
			$return .= '<option value="8">Eight Column</option>';
		}
	
		if($selected === 9){
			$return .= '<option value="9" selected>Nine Column</option>';
		}else{
			$return .= '<option value="9">Nine Column</option>';
		}
	
		if($selected === 10){
			$return .= '<option value="10" selected>Ten Column</option>';
		}else{
			$return .= '<option value="10">Ten Column</option>';
		}
	
		if($selected === 11){
			$return .= '<option value="11" selected>Eleven Column</option>';
		}else{
			$return .= '<option value="11">Eleven Column</option>';
		}
	
		if($selected === 12){
			$return .= '<option value="12" selected>Twelve Column</option>';
		}else{
			$return .= '<option value="12">Twelve Column</option>';
		}
	
		$return .= '</select></div>';
		
		return $return;
	}
}

function rockthemes_pb_element_list_modal(){
	global $post;
	
	$elements = '
		<ul id="add-element-element" class="rockthems-pb-elements-list">';
		
	$options = '
		  <li element="specialgridblock" class="special-grid-elem-class"><i class="fa fa-inbox"></i><br/>Special Grid Blocks</li>
		  <li element="textarea"><i class="fa fa-text-width"></i><br/>Text Area</li>
		  <li element="ajaxfiltered"><i class="fa fa-th"></i><br/>Ajax Filtered Gallery</li>
		  <li element="featuredimage"><i class="fa fa-picture-o"></i><br/>Featured Image</li>
		  <li element="swiperslider"><i class="fa fa-hand-o-up"></i><br/>Swiper Slider</li>
		  <li element="pricingtable"><i class="fa fa-dollar"></i><br/>Pricing Table</li>
		  <li element="curvyslider"><div class="regular-font">C</div><br/>Curvy Slider</li>
		  <li element="sidebar"><i class="fa fa-columns"></i><br/>Sidebar</li>
		  <li element="toggles"><i class="fa fa-align-justify"></i><br/>Toggles</li>
		  <li element="tabs"><i class="fa fa-credit-card"></i><br/>Tabs</li>
		  <li element="iconictext"><i class="fa fa-indent"></i><br/>Iconic Text</li>
		  <li element="button"><i class="fa fa-link"></i><br/>Button</li>
		  <li element="skill"><i class="fa fa-tasks"></i><br/>Skill</li>
		  <li element="horizontalrule"><i class="fa fa-resize-horizontal"></i><br/>HR</li>
		  <li element="portfolio"><i class="fa fa-th-list"></i><br/>Portfolio</li>
		  <li element="googlemap"><i class="fa fa-map-marker"></i><br/>Google Map</li>
		  <li element="promotionbox"><i class="fa fa-bullhorn"></i><br/>Promotion Box</li>
		  <li element="alertbox"><i class="fa fa-warning"></i><br/>Alert Box</li>
		  <li element="referencesbuilder"><i class="fa fa-user"></i><br/>References Builder</li>
		  <li element="testimonialsbuilder"><i class="fa fa-comments-o"></i><br/>Testimonials Builder</li>
		  <li element="socialicons"><i class="fa fa-share"></i><br/>Social Icons</li>
		  <li element="teammembers"><i class="fa fa-group"></i><br/>Team Members</li>
		  <li element="beforeafterslider"><i class="fa fa-exchange"></i><br/>Before After Slider</li>
		  <li element="externalshortcode"><i class="fa fa-code"></i><br/>External Code</li>
		  <li element="regularblog"><i class="fa fa-archive"></i><br/>Regular Blog</li>
		  <li element="gallery"><i class="fa fa-camera-retro"></i><br/>Gallery</li>
	';
	
	$rock_form_builder = get_option('rockthemes_fb_references',array());
	
	//If Rock Form Builder active, include it to elements.
	if(!empty($rock_form_builder)){
		$options .= '<li element="rockformbuilder"><i class="fa fa-list-alt"></i><br/>Rock Form Builder</li>';
	}
	
	$options = apply_filters('rockthemes_pb_element_list',$options);
	
	$elements .= $options.'
		</ul>
		<div class="clear"></div>
	';	
	
	
	$columns = '<div class="add-elem-modal-columns">';
	$columns .= '<strong>Columns :</strong><br/>';
	
	$columns .= '<ul class="rockthemes-pb-columns-list">';
	$column = '';
	
	for($c = 1; $c < 13; $c++){
		$column .= '<li class="col">'.$c.' / 12</li>';
	}
	
	$columns .= $column;

	$columns .= '</ul>';
	
	$columns .= '<div class="clear"></div><hr/></div>';
	
	
	$modal = '
		<div id="rockthemes-pb-elements-modal" class="rpb_modal container hide">
			<div class="modal-header">
				<div class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></div>
					<h3>Add Page Builder Element</h3>
				</div>
			<div class="modal-body" data-saved="false">
				'.$columns.'
				'.$elements.'
			</div>
		</div>
	';

	
	
	return $modal;
}

function rock_pages_builder_menu(){
	global $post;
	
	$elements = '<h5>Choose Element</h5>
		<select id="add-element-element">';
		
	$options = '
		  <option element="textfield">Text Field</option>
		  <option element="textarea" selected>Text Area</option>
		  <option element="image">Image</option>
		  <option element="ajaxfiltered">Ajax Filtered Gallery</option>
		  <option element="featuredimage">Featured Image</option>
		  <option element="swiperslider">Swiper Slider</option>
		  <option element="pricingtable">Pricing Table</option>
		  <option element="curvyslider">Curvy Slider</option>
		  <option element="sidebar">Sidebar</option>
		  <option element="toggles">Toggles</option>
		  <option element="tabs">Tabs</option>
		  <option element="iconictext">Iconic Text</option>
		  <option element="button">Button</option>
		  <option element="skill">Skill</option>
		  <option element="horizontalrule">HR</option>
		  <option element="portfolio">Portfolio</option>
		  <option element="googlemap">Google Map</option>
		  <option element="promotionbox">Promotion Box</option>
		  <option element="alertbox">Alert Box</option>
		  <option element="referencesbuilder">References Builder</option>
		  <option element="testimonialsbuilder">Testimonials Builder</option>
		  <option element="socialicons">Social Icons</option>
		  <option element="teammembers">Team Members</option>
	';
	
	$rock_form_builder = get_option('rockthemes_fb_references',array());
	
	//If Rock Form Builder active, include it to elements.
	if(!empty($rock_form_builder)){
		$options .= '<option element="rockformbuilder">Rock Form Builder</option>';
	}
	
	$options = apply_filters('rockthemes_pb_element_list',$options);
	
	$elements .= $options.'
		</select>
	';	
	
	$layouts = '
		<h5>Choose Columns</h5>
		<select id="add-element-columns">
		  <option col="1">One Column</option>
		  <option col="2">Two Column</option>
		  <option col="3">Three Column</option>
		  <option col="4" selected>Four Column</option>
		  <option col="5">Five Column</option>
		  <option col="6">Six Column</option>
		  <option col="7">Seven Column</option>
		  <option col="8">Eight Column</option>
		  <option col="9">Nine Column</option>
		  <option col="10">Ten Column</option>
		  <option col="11">Eleven Column</option>
		  <option col="12">Twelve Column</option>
		</select>
	';
	
	$buttons = '
	<div id="add-element-btn" class="button-primary"><i class="fa fa-plus-circle icon-white"></i> Add Element</div><br/>
	<div id="send_content_to_tinymce" postID="'.$post->ID.'" class="button-primary">Send Content to Text Editor</div>
	<div class="rockthemes-pb-add-element-main-button btn btn-small"><i class="fa fa-plus"></i> Add Element</div>
	';
	
	$buttons = '
	<div id="send_content_to_tinymce" postID="'.$post->ID.'" class="btn btn-small alignright main-action-button"><i class="fa fa-signin"></i> Send Content to Text Editor</div>
	<div class="rockthemes-pb-add-element-main-button btn btn-small alignleft main-action-button"><i class="fa fa-plus-circle"></i> Add Element</div>
	<div class="clear"></div>
	';
	
	//return $elements.'<br/>'.$layouts.'<br/>'.$buttons.'</br>';
	return $buttons;
}



/*

	This function will be moved to another file

*/

function getDefinedButtonColors($returnList = null,$selected = null){
	if($returnList != null){
		$returnSelect = 	'<select class="button_type" style="width:100%;" autocomplete="off">';

		if($selected == "no-button"){
			$returnSelect .= '<option value="no-button" selected>No Button</option>';
		}else{
			$returnSelect .= '<option value="no-button">No Button</option>';
		}
		
		if($selected == "red"){
			$returnSelect .= '<option value="red" selected>Red Button</option>';
		}else{
			$returnSelect .= '<option value="red">Red Button</option>';
		}
		
		if($selected == "green"){
			$returnSelect .= '<option value="green" selected>Green Button</option>';
		}else{
			$returnSelect .= '<option value="green">Green Button</option>';
		}

		if($selected == "yellow"){
			$returnSelect .= '<option value="yellow" selected>Yellow Button</option>';
		}else{
			$returnSelect .= '<option value="yellow">Yellow Button</option>';
		}

		$returnSelect .= '</select>';	
							
		return $returnSelect;
	}
}


?>
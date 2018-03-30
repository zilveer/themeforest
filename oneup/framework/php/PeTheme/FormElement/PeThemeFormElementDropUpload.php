<?php

class PeThemeFormElementDropUpload extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.dropUpload.js",array("plupload-all"),"pe_theme_field_dropUpload");
		wp_enqueue_script("pe_theme_field_dropUpload");
	}

	protected function template() {
		global $post_ID;

		$dropFilesHere = __("Drop files here",'Pixelentity Theme/Plugin');
		$or = __("or",'Pixelentity Theme/Plugin');
		$button = __("Select Files",'Pixelentity Theme/Plugin');
		
		$plupload_init = 
			json_encode(
						array(
							  'runtimes'            => 'html5,silverlight,flash,html4',
							  'browse_button'       => 'plupload-browse-button',
							  'container'           => '[ID]',
							  'drop_element'        => 'drag-drop-area',
							  'file_data_name'      => 'async-upload',            
							  'multiple_queues'     => true,
							  'max_file_size'       => wp_max_upload_size().'b',
							  'url'                 => admin_url('admin-ajax.php'),
							  'flash_swf_url'       => includes_url('js/plupload/plupload.flash.swf'),
							  'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
							  'filters'             => array(array('title' => __('Allowed Files','Pixelentity Theme/Plugin'), 'extensions' => 'jpg,jpeg,gif,png')),
							  'multipart'           => true,
							  'urlstream_upload'    => true,
							  
							  // additional post data to send to our ajax hook
							  'multipart_params'    => 
							  array(
									'_ajax_nonce' => wp_create_nonce("pe_theme_multi_upload"),
									'action'      => 'pe_theme_multi_upload',
									'postID' => $post_ID
									),
							  )
						);

		$html = <<<EOT
<div id="[ID]" class="hide-if-no-js option-gallery">
	<h4>[LABEL]</h4>
     <div id="drag-drop-area" class="pe_drag_drop">
		 <div class="drag-drop-inside">
			 <p class="drag-drop-info">$dropFilesHere</p>
			 <p>$or</p>
			 <p class="drag-drop-buttons"><input id="plupload-browse-button" type="button" value="$button" class="button" /></p>
		 </div>
     </div>
</div>
<script type="text/javascript">
jQuery('#[ID]').peFieldDropUpload({plupload:$plupload_init});
</script>
EOT;
		return $html;
	}

}

?>

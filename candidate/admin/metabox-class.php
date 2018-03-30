<?php
/**
 * @package by MattMao * 
*/

class meta_boxes_generator 
{
	var $config;
	var $options;
	var $saved_options;

	#
	#Constructor
	#@param string $name
	#@param array $options
	function meta_boxes_generator($config, $options)
	{
		$this->config = $config;
		$this->options = $options;
		
		add_action('admin_menu', array(&$this, 'create_meta_box'));
		add_action('save_post', array(&$this, 'save_meta_box'));
	}

	#
	#create meta box
	#
	function create_meta_box() 
	{
		if (function_exists('add_meta_box')) {
			if (! empty($this->config['callback']) && function_exists($this->config['callback'])) {
				$callback = $this->config['callback'];
			} else {
				$callback = array(&$this, 'render');
			}
			foreach($this->config['pages'] as $page) {
				add_meta_box($this->config['id'], $this->config['title'], $callback, $page, $this->config['context'], $this->config['priority']);
			}
		}
	}

	#
	#save meta box
	#
	function save_meta_box($post_id) 
	{
		if (! isset($_POST[$this->config['id'] . '_noncename'])) {
			return $post_id;
		}
		
		if (! wp_verify_nonce($_POST[$this->config['id'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		
		if ('page' == $_POST['post_type']) {
			if (! current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} else {
			if (! current_user_can('edit_post', $post_id)) {
				return $post_id;
			}
		}
		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		add_post_meta($post_id, 'textfalse', false, true);
		
		foreach($this->options as $option) {
			if (isset($option['id']) && ! empty($option['id'])) {
				
				if (isset($_POST[$option['id']])) {
					if ($option['type'] == 'multidropdown') {
						$value = array_unique(explode(',', $_POST[$option['id']]));
					} else {
						$value = $_POST[$option['id']];
					}
				} else if ($option['type'] == 'toggle') {
					$value = - 1;
				} else {
					$value = false;
				}
				
				if (get_post_meta($post_id, $option['id']) == "") {
					add_post_meta($post_id, $option['id'], $value, true);
				} elseif ($value != get_post_meta($post_id, $option['id'], true)) {
					update_post_meta($post_id, $option['id'], $value);
				} elseif ($value == "") {
					delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));
				}

			}
		}

	}//End save

	#
	#Render
	#
	function render() 
	{
		global $post;	
		foreach($this->options as $option) {
			if (method_exists($this, $option['type'])) {
				if (isset($option['id'])) {
					$std = get_post_meta($post->ID, $option['id'], true);
					if ($std != "") {
						$option['std'] = $std;
					}
				}
				echo '<table class="theme-metabox-table">';
				

				$this->{$option['type']}($option);
				
				
				echo '</table>';
			}
		}
		
		echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
	}


	#
	#displays a text input
	#
	function text($value) 
	{
		$size = isset($value['size']) ? $value['size'] : '10';
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';

		echo '<tr valign="top"'.$class.'>';
		echo '<th class="theme-metabox-name">';
		echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="' . stripslashes($value['std']) . '" />';
		if(isset($value['unit'])){ echo '<span class="unit">' . $value['unit'] . '</span>'; }
		echo '</td>';
		echo '</tr>';
	}

	#
	#displays a textarea
	#
	function textarea($value) 
	{
		$rows = isset($value['rows']) ? $value['rows'] : '7';
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';
		echo '<th class="theme-metabox-name">';
		echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<textarea style = "width:400px;" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">' . stripslashes($value['std']) . '</textarea>';
		echo '</td>';
		echo '</tr>';
	
	}

	
	
	#
	#displays a textarea
	#
	function textarea_w($value) 
	{
		$rows = isset($value['rows']) ? $value['rows'] : '7';
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		// echo '<tr valign="top"'.$class.'>';
		// echo '<th class="theme-metabox-name">';
		// echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		// if(isset($value['desc']))
		// {
			// echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		// }
		// echo '</th>';

		// echo '<td>';
		// echo '<textarea style = "width:400px;" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">' . stripslashes($value['std']) . '</textarea>';
		// echo '</td>';
		// echo '</tr>';
		
		
		
		$options = array( 'wpautop' => 1
			,'media_buttons' => 1
			,'textarea_name' => $value['id']
			,'textarea_rows' => 20
			,'tabindex' => null
			,'editor_css' => ''
			,'editor_class' => ''
			,'teeny' => 0
			,'dfw' => 0
			,'tinymce' => 1
			,'quicktags' => 1
		);
		wp_editor( $value['std'], 'editpost', $options );
	}
	
	
	
	
	
	
	#
	#displays a select
	#
	function select($value) 
	{
		$value2 = isset($value['prompt']) ? $value['prompt'] : '';
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}

		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';

		echo '<th class="theme-metabox-name">';
		echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" class="chosen_select1">';
			if($value2 != '') {
			echo '<option value="">'. $value2 .'</option>';
			}
		foreach($value['options'] as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($key == $value['std']) {
				echo ' selected="selected"';
			}
			
			echo '>' . $option . '</option>';
		}
		
		echo '</select>';
		echo '</td>';
		echo '</tr>';
	}


	#
	#displays a select
	#
	function sidebar_select($value) 
	{
		$value2 = isset($value['prompt']) ? $value['prompt'] : '';
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}

		echo '<div class="theme-meta-box-sidebar-select">';
		echo '<p><strong>'.$value['name'].'</strong></p>';
		echo '<label class="screen-reader-text" for="' . $value['name'] . '">' . $value['name'] . '</label>';

		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" class="chosen_select1">';
		// echo '<option value="">'. $value2 .'</option>';
		
		foreach($value['options'] as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($key == $value['std']) {
				echo ' selected="selected"';
			}
			
			echo '>' . $option . '</option>';
		}
		
		echo '</select>';

		if(isset($value['desc']))
		{
			echo '<p>'.$value['desc'].'</p>';
		}

		echo '</div>';
	}

	function sidebar_select2($value) 
	{
		$value2 = isset($value['prompt']) ? $value['prompt'] : '';
		if (isset($value['target'])) {
			if (isset($value['options'])) {
				$value['options'] = $value['options'] + $this->get_select_target_options($value['target']);
			} else {
				$value['options'] = $this->get_select_target_options($value['target']);
			}
		}

		echo '<div class="theme-meta-box-sidebar-select">';
		echo '<p><strong>'.$value['name'].'</strong></p>';
		echo '<label class="screen-reader-text" for="' . $value['name'] . '">' . $value['name'] . '</label>';

		echo '<select name="' . $value['id'] . '" id="' . $value['id'] . '" class="chosen_select1">';
		
		//echo '<option value="no">'. $value2 .'</option>';
		echo '<option value="shop">Shop</option>';
		
		foreach($value['options'] as $key => $option) {
			echo '<option value="' . $key . '"';
			if ($key == $value['std']) {
				echo ' selected="selected"';
			}
			
			echo '>' . $option . '</option>';
		}
		
		echo '</select>';

		if(isset($value['desc']))
		{
			echo '<p>'.$value['desc'].'</p>';
		}

		echo '</div>';
	}


	#
	#displays a checkbox
	#
	function checkbox($value) 
	{
		$checked = '';
		if (isset($this->saved_options[$value['id']])) {
			if ($this->saved_options[$value['id']] == true) {
				$checked = 'checked="checked"';
			}
		} elseif ($value['std'] == true) {
			$checked = 'checked="checked"';
		}

		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';

		echo '<th class="theme-metabox-name"><label for="' . $value['name'] . '">' . $value['name'] . '</label></th>';

		echo '<td>';
		echo '<input type="checkbox" name="' . $value['id'] . '" id="' . $value['id'] . '" value="true" ' . $checked . ' />';

		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-checkbox-desc">'.$value['desc'].'</span>';
		}
		echo '</td>';
		echo '</tr>';
	}

	#
	#displays a upload
	#
	function upload($value) 
	{
		$size = isset($value['size']) ? $value['size'] : '10';
		$button = isset($value['button']) ? $value['button'] : 'Upload Image';
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';

		echo '<th class="theme-metabox-name">';
		echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<input name="' . $value['id'] . '" id="custom_media_'.$value['id'].'" type="text" size="' . $size . '" value="' . stripslashes($value['std']) . '" />';
		echo '<a href="#" id="custom_media_'.$value['id'].'_button" class="upload_image_button button" data-uploader-title="Upload Image" data-uploader-button-text="Insert the image">'.$button.'</a>';

		echo '</td>';
		echo '</tr>';

		echo '<script type="text/javascript">'."\n";
		echo '//<![CDATA['."\n";
		echo 'jQuery(document).ready(function() {'."\n";
		echo 'jQuery("#custom_media_'.$value['id'].'_button").on("click", function( event ){'."\n";

		echo '	// Uploading files'."\n";
		echo '	var wp_file_frame;'."\n";

		echo '	event.preventDefault();'."\n";

		echo '	// If the media frame already exists, reopen it.'."\n";
		echo '	if ( wp_file_frame ) {'."\n";
		echo '	  wp_file_frame.open();'."\n";
		echo '	  return;'."\n";
		echo '	}'."\n";

		echo '	// Create the media frame.'."\n";
		echo '	wp_file_frame = wp.media.frames.wp_file_frame = wp.media({'."\n";
		echo '	  title: jQuery( this ).data( "uploader-title" ),'."\n";
		echo '	  button: {'."\n";
		echo '		text: jQuery( this ).data( "uploader-button-text" ),'."\n";
		echo '	  },'."\n";
		echo '	  multiple: false  // Set to true to allow multiple files to be selected'."\n";
		echo '	});'."\n";

		echo '	// When an image is selected, run a callback.'."\n";
		echo '	wp_file_frame.on( "select", function() {'."\n";
		echo '	  // We set multiple to false so only get one image from the uploader'."\n";
		echo '	  attachment = wp_file_frame.state().get("selection").first().toJSON();'."\n";

		echo '	  // Do something with attachment.id and/or attachment.url here'."\n";
		echo '	  jQuery("#custom_media_'.$value['id'].'").val(attachment.url);'."\n";
		echo '	});'."\n";

		echo '	// Finally, open the modal'."\n";
		echo '	wp_file_frame.open();'."\n";
		echo '});'."\n";
		echo '});'."\n";
		echo '//]]>'."\n";
		echo '</script>'."\n";
	}


	#
	#displays a upload images
	#
	function upload_images($value) 
	{
		global $post;
		$button = isset($value['button']) ? $value['button'] : 'Upload Image';
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';
		echo '<td>';
		?>
		<?php
			if(isset($value['desc']))
			{
				echo '<div class="theme-metabox-upload-image-desc theme-metabox-block">'.$value['desc'].'</div>';
			}

			
			$slider_image_gallery = '';
			
			if ( metadata_exists( 'post', $post->ID, $value['id'] ) ) {
				if(isset($value['std'])) {
				$slider_image_gallery = $value['std'];
				}
			} else {
				// Backwards compat
				$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
				$slider_image_gallery = implode( ',', $attachment_ids );
			}
		?>
		<input type="hidden" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php echo esc_attr( $slider_image_gallery ); ?>" />

		<div id="slider_images_container">
		<ul class="slider_images">
			<?php
				$attachments = array_filter( explode( ',', $slider_image_gallery ) );

				if ( $attachments )
				{
					foreach ( $attachments as $attachment_id ) {
						echo '<li class="image" data-attachment_id="' . $attachment_id . '">
							' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
							<ul class="actions">
								<li><a href="#" class="delete" title="' . __( 'Delete image', 'candidate' ) . '">' . __( 'Delete', 'candidate' ) . '</a></li>
							</ul>
						</li>';
					}
				}
			?>
		</ul>
		</div>
		<p class="add_slider_images hide-if-no-js"><a href="#"><?php echo $button; ?></a></p>

		<script type="text/javascript">
			jQuery(document).ready(function($){

				// Uploading files
				var slider_gallery_frame;
				var $image_gallery_ids = $('#<?php echo $value['id']; ?>');
				var $slider_images = $('#slider_images_container ul.slider_images');

				jQuery('.add_slider_images').on( 'click', 'a', function( event ) {

					var $el = $(this);
					var attachment_ids = $image_gallery_ids.val();

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( slider_gallery_frame ) {
						slider_gallery_frame.open();
						return;
					}

					// Create the media frame.
					slider_gallery_frame = wp.media.frames.downloadable_file = wp.media({
						// Set the title of the modal.
						title: '<?php _e( 'Add Images to Gallery', 'candidate' ); ?>',
						button: {
							text: '<?php _e( 'Add to gallery', 'candidate' ); ?>',
						},
						multiple: true
					});

					// When an image is selected, run a callback.
					slider_gallery_frame.on( 'select', function() {

						var selection = slider_gallery_frame.state().get('selection');

						selection.map( function( attachment ) {

							attachment = attachment.toJSON();

							if ( attachment.id ) {
								attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

								$slider_images.append('\
									<li class="image" data-attachment_id="' + attachment.id + '">\
										<img src="' + attachment.url + '" />\
										<ul class="actions">\
											<li><a href="#" class="delete" title="<?php _e( 'Delete image', 'candidate' ); ?>"><?php _e( 'Delete', 'candidate' ); ?></a></li>\
										</ul>\
									</li>');
							}

						} );

						$image_gallery_ids.val( attachment_ids );
					});

					// Finally, open the modal.
					slider_gallery_frame.open();
				});

				// Image ordering
				$slider_images.sortable({
					items: 'li.image',
					cursor: 'move',
					scrollSensitivity:40,
					forcePlaceholderSize: true,
					forceHelperSize: false,
					helper: 'clone',
					opacity: 0.65,
					placeholder: 'wc-metabox-sortable-placeholder',
					start:function(event,ui){
						ui.item.css('background-color','#f6f6f6');
					},
					stop:function(event,ui){
						ui.item.removeAttr('style');
					},
					update: function(event, ui) {
						var attachment_ids = '';

						$('#slider_images_container ul li.image').css('cursor','default').each(function() {
							var attachment_id = jQuery(this).attr( 'data-attachment_id' );
							attachment_ids = attachment_ids + attachment_id + ',';
						});

						$image_gallery_ids.val( attachment_ids );
					}
				});

				// Remove images
				$('#slider_images_container').on( 'click', 'a.delete', function() {

					$(this).closest('li.image').remove();

					var attachment_ids = '';

					$('#slider_images_container ul li.image').css('cursor','default').each(function() {
						var attachment_id = jQuery(this).attr( 'data-attachment_id' );
						attachment_ids = attachment_ids + attachment_id + ',';
					});

					$image_gallery_ids.val( attachment_ids );

					return false;
				} );

			});
		</script>
		
		<?php
		echo '</td>';
		echo '</tr>';
	}


	#
	#displays a radio
	#
	function radio($value) 
	{		
		$class = isset($value['class']) ? ' class="'.$value['class'].'"' : ' class="border"';
		
		echo '<tr valign="top"'.$class.'>';

		echo '<th class="theme-metabox-name">';
		echo '<label for="' . $value['name'] . '">' . $value['name'] . '</label>';
		if(isset($value['desc']))
		{
			echo '<span class="theme-metabox-desc theme-metabox-block">'.$value['desc'].'</span>';
		}
		echo '</th>';

		echo '<td>';
		echo '<div id="'.$value['id'].'_radio" class="clearfix">';

		$i = 0;
		foreach($value['options'] as $key => $option) {
			$i++;
			$checked = '';
			if ($key == $value['std']) {
				$checked = ' checked="checked"';
			}
			
			echo '<div class="radio-in-line">';
			echo '<input type="radio" id="' . $value['id'] . '_' . $key . '" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . ' />';
			echo '<label for="' . $value['id'] . '_' . $i . '">' . $option . '</label>';
			echo '</div>';
		}

		echo '</div>';
		echo '</td>';
		echo '</tr>';	
	}


	#
	#displays a target options
	#
	function get_select_target_options($type)
	{
		$options = array();
		switch($type){
			case 'page':
				$entries = get_pages('title_li=&orderby=name');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
			break;
			case 'cat':
				$entries = get_categories('title_li=&orderby=name&hide_empty=0');
				foreach($entries as $key => $entry) {
					$options[$entry->term_id] = $entry->name;
				}
			break;
			case 'catportfolio':
				$entries = get_categories('title_li=&orderby=name&hide_empty=0&taxonomy=portfolio-category');
				foreach($entries as $key => $entry) {
					$options[$entry->term_id] = $entry->name;
				}
			break;
			case 'post':
				$entries = get_posts('orderby=title&numberposts=-1&order=ASC');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
			break;
			case 'sidebar':
				$entries = get_posts('post_type=sidebar&orderby=title&numberposts=-1&order=ASC');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
			break;
			
			case 'parallax-sections':
				$entries = get_posts('post_type=parallax-sections&orderby=title&numberposts=-1&order=ASC');
				foreach($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				}
			break;
			
			case 'cat_product':
				$entries = get_categories('type=product&title_li=&orderby=name&hide_empty=0&taxonomy=product_cat');
				foreach($entries as $key => $entry) {
					$options[$entry->term_id] = $entry->name;
				}
			break;
		}		
		return $options;
	}

}//End class


?>
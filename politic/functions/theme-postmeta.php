<?php 

/* Adding Image Upload Meta Boxes */

// Defining the Meta Box Fields

$prefix = "icy_";

add_action('add_meta_boxes', 'icy_metabox_posts');
function icy_metabox_posts(){
    
    $meta_box = array(
		'id' => 'icy-meta-box-link',
		'title' =>  __('Link Settings', 'framework'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( "name" => __('The URL','framework'),
					"desc" => __('Insert the URL you wish to link to.','framework'),
					"id" => "icy_link_url",
					"type" => "text",
					"std" => ''
				),
		),
	);
	icy_add_meta_box( $meta_box );

	$meta_box = array(
		'id' => 'heading_value',
		'title' =>  __('Subtitle', 'framework'),
		'page' => 'page',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( "name" => __('The Subtitle','framework'),					
					"id" => "heading_value",
					"type" => "text",
					"std" => ''
				),
		),
	);
	icy_add_meta_box( $meta_box );

	$meta_box = array(
		'id' => 'icy-metabox-post-gallery',
		'title' =>  __('Post Gallery', 'framework'),
		'description' => __('Insert your pictures here.', 'framework'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
    				'name' =>  __('Gallery', 'framework'),    				
    				'id' => 'icy_gallery_image',
    				'type' => 'images',
    				'std' => __('Upload to Gallery', 'framework')    				
    			),			    		
		)
	);
    icy_add_meta_box( $meta_box );

	$meta_box = array(
		'id' => 'icy-meta-box-audio',
		'title' =>  __('Audio Settings', 'framework'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( "name" => __('MP3 File URL','framework'),
					"desc" => __('The URL to the .mp3 audio file','framework'),
					"id" => "icy_audio_mp3",
					"type" => "text",
					"std" => ''
				),
			array( "name" => __('OGA File URL','framework'),
					"desc" => __('The URL to the .oga, .ogg audio file','framework'),
					"id" => "icy_audio_ogg",
					"type" => "text",
					"std" => ''
				),
			array( 
		        "name" => __('Audio Poster Image', 'framework'),
		        "desc" => __('If you would like a poster image for the audio', 'framework'),
		        "id" => "icy_audio_poster",
		        "type" => "text",
		        "std" => ''
		        ),
		    array( 
		        "name" => __('Poster Image Height', 'framework'),
		        "desc" => __('If you are including a poster image, please indicate the height of the image.', 'framework'),
		        "id" => "icy_poster_height",
		        "type" => "text",
		        "std" => ''
		        )
		),	
	);
	icy_add_meta_box( $meta_box );

	$meta_box = array(
		'id' => 'icy-meta-box-video',
		'title' =>  __('Video Settings', 'framework'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( "name" => __('Video Height','framework'),
					"desc" => __('The video height (e.g. 500).','framework'),
					"id" => "icy_video_height",
					"type" => "text",
					"std" => ''
				),
			array( "name" => __('M4V File URL','framework'),
					"desc" => __('The URL to the .m4v video file','framework'),
					"id" => "icy_video_m4v",
					"type" => "text",
					"std" => ''
				),
			array( "name" => __('OGV File URL','framework'),
					"desc" => __('The URL to the .ogv video file','framework'),
					"id" => "icy_video_ogv",
					"type" => "text",
					"std" => ''
				),
			array( "name" => __('Poster Image','framework'),
					"desc" => __('The preivew image.','framework'),
					"id" => "icy_video_poster",
					"type" => "text",
					"std" => ''
				),
			array( "name" => __('Embeded Code','framework'),
					"desc" => __('If you\'re not using self hosted video then you can include embeded code here. Best viewed at 700px wide.','framework'),
					"id" => "icy_video_embed",
					"type" => "textarea",
					"std" => ''
				),
		)	
	);
    icy_add_meta_box( $meta_box );
}

/**
 * Add a custom Meta Box
 *
 * @param array $meta_box Meta box input data
 */
function icy_add_meta_box( $meta_box )
{
    if( !is_array($meta_box) ) return false;
    
    // Create a callback function
    $callback = create_function( '$post,$meta_box', 'icy_create_meta_box( $post, $meta_box["args"] );' );

    add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
}

/**
 * Create content for a custom Meta Box
 *
 * @param array $meta_box Meta box input data
 */
function icy_create_meta_box( $post, $meta_box )
{
	// set up for fallback to old way of doing things
	$wp_version = get_bloginfo('version');
	
    if( !is_array($meta_box) ) return false;
    
    if( isset($meta_box['description']) && $meta_box['description'] != '' ){
    	echo '<p>'. $meta_box['description'] .'</p>';
    }
    
	wp_nonce_field( basename(__FILE__), 'icy_meta_box_nonce' );
	echo '<table class="form-table icy-metabox-table">';
 
	foreach( $meta_box['fields'] as $field ){
		// Get current post meta data
		$meta = get_post_meta( $post->ID, $field['id'], true );
		echo '<tr><th><label for="'. $field['id'] .'"><strong>'. $field['name'] .'</strong>
			  <span>'. $field['desc'] .'</span></label></th>';
		
		switch( $field['type'] ){	
			case 'text':
				echo '<td><input type="text" name="icy_meta['. $field['id'] .']" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .'" size="30" /></td>';
				break;	
				
			case 'textarea':
				echo '<td><textarea name="icy_meta['. $field['id'] .']" id="'. $field['id'] .'" rows="8" cols="5">'. ($meta ? $meta : $field['std']) .'</textarea></td>';
				break;
				
			case 'file':
				if( version_compare($wp_version, '3.4.2', '>') ) {
			?> 
				<script>
				jQuery(function($) {
					var frame;

					$('#<?php echo $field['id']; ?>_button').on('click', function(e) {
						e.preventDefault();

						// Set options for 1st frame render
						var options = {
							state: 'insert',
							frame: 'post'
						};

						frame = wp.media(options).open();
						
						// Tweak views
						frame.menu.get('view').unset('gallery');
						frame.menu.get('view').unset('featured-image');
												
						frame.toolbar.get('view').set({
							insert: {
								style: 'primary',
								text: '<?php _e("Insert", "icy"); ?>',

								click: function() {
									var models = frame.state().get('selection'),
										url = models.first().attributes.url;

									$('#<?php echo $field['id']; ?>').val( url ); 

									frame.close();
								}
							}
						});
						

					});
					
				});
				</script>
			<?php
				} // if version compare
				echo '<td><input type="text" name="icy_meta['. $field['id'] .']" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .'" size="30" class="file" /> <input type="button" class="button" name="'. $field['id'] .'_button" id="'. $field['id'] .'_button" value="Browse" /></td>';
				break;

			case 'images': 
				if( version_compare($wp_version, '3.4.2', '>') ) {
					// Using Wp3.5+
			?>
				<script>
				jQuery(function($) {
					var frame,
					    images = '<?php echo get_post_meta( $post->ID, '_icy_image_ids', true ); ?>',
					    selection = loadImages(images);

					$('#icy_images_upload').on('click', function(e) {
						e.preventDefault();

						// Set options for 1st frame render
						var options = {
							title: '<?php _e("Create Featured Gallery", "icy"); ?>',
							state: 'gallery-edit',
							frame: 'post',
							selection: selection
						};

						// Check if frame or gallery already exist
						if( frame || selection ) {
							options['title'] = '<?php _e("Edit Featured Gallery", "icy"); ?>';
						}

						frame = wp.media(options).open();
						
						// Tweak views
						frame.menu.get('view').unset('cancel');
						frame.menu.get('view').unset('separateCancel');
						frame.menu.get('view').get('gallery-edit').el.innerHTML = '<?php _e("Edit Featured Gallery", "icy"); ?>';
						frame.content.get('view').sidebar.unset('gallery'); // Hide Gallery Settings in sidebar

						// When we are editing a gallery
						overrideGalleryInsert();
						frame.on( 'toolbar:render:gallery-edit', function() {
    						overrideGalleryInsert();
						});
						
						frame.on( 'content:render:browse', function( browser ) {
						    if ( !browser ) return;
						    // Hide Gallery Settings in sidebar
						    browser.sidebar.on('ready', function(){
						        browser.sidebar.unset('gallery');
						    });
						    // Hide filter/search as they don't work
						    browser.toolbar.on('ready', function(){
    						    if(browser.toolbar.controller._state == 'gallery-library'){
    						        browser.toolbar.$el.hide();
    						    }
						    });
						});
						
						// All images removed
						frame.state().get('library').on( 'remove', function() {
						    var models = frame.state().get('library');
							if(models.length == 0){
							    selection = false;
    							$.post(ajaxurl, { ids: '', action: 'icy_save_images', post_id: icy_ajax.post_id, nonce: icy_ajax.nonce });
							}
						});
						
						// Override insert button
						function overrideGalleryInsert() {
    						frame.toolbar.get('view').set({
								insert: {
									style: 'primary',
									text: '<?php _e("Save Featured Gallery", "icy"); ?>',

									click: function() {
										var models = frame.state().get('library'),
										    ids = '';

										models.each( function( attachment ) {
										    ids += attachment.id + ','
										});

										this.el.innerHTML = '<?php _e("Saving...", "icy"); ?>';
										
										$.ajax({
											type: 'POST',
											url: ajaxurl,
											data: { 
												ids: ids, 
												action: 'icy_save_images', 
												post_id: icy_ajax.post_id, 
												nonce: icy_ajax.nonce 
											},
											success: function(){
    											selection = loadImages(ids);
    											$('#_icy_image_ids').val( ids );
    											frame.close();
											},
											dataType: 'html'
										}).done( function( data ) {
											$('.icy-gallery-thumbs').html( data );
										}); 
									}
								}
							});
						}
					});
					
					// Load images
					function loadImages(images) {
						if( images ){
						    var shortcode = new wp.shortcode({
            					tag:    'gallery',
            					attrs:   { ids: images },
            					type:   'single'
            				});
				
						    var attachments = wp.media.gallery.attachments( shortcode );

            				var selection = new wp.media.model.Selection( attachments.models, {
            					props:    attachments.props.toJSON(),
            					multiple: true
            				});
            
            				selection.gallery = attachments.gallery;
            
            				// Fetch the query's attachments, and then break ties from the
            				// query to allow for sorting.
            				selection.more().done( function() {
            					// Break ties with the query.
            					selection.props.set({ query: false });
            					selection.unmirror();
            					selection.props.unset('orderby');
            				});
            				
            				return selection;
						}
						
						return false;
					}
					
				});
				</script>
			<?php
				// SPECIAL CASE:
				// std controls button text; unique meta key for image uploads
				$meta = get_post_meta( $post->ID, '_icy_image_ids', true );
				$thumbs_output = '';
				$button_text = ($meta) ? __('Edit Gallery', 'icy') : $field['std'];
				if( $meta ) {
					$field['std'] = __('Edit Gallery', 'icy');
					$thumbs = explode(',', $meta);
					$thumbs_output = '';
					foreach( $thumbs as $thumb ) {
						$thumbs_output .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
					}
				}

			    echo 
			    	'<td>
			    		<input type="button" class="button" name="' . $field['id'] . '" id="icy_images_upload" value="' . $button_text .'" />
			    		
			    		<input type="hidden" name="icy_meta[_icy_image_ids]" id="_icy_image_ids" value="' . ($meta ? $meta : 'false') . '" />

			    		<ul class="icy-gallery-thumbs">' . $thumbs_output . '</ul>
			    	</td>';
			    } else {
			    	// Using pre-WP3.5
			    	echo '<td><input type="button" class="button" name="' . $field['id'] . '" id="icy_images_upload" value="' . $field['std'] .'" /></td>';
			    }
			    break;
				
			case 'select':
				echo'<td><select name="icy_meta['. $field['id'] .']" id="'. $field['id'] .'">';
				foreach( $field['options'] as $key => $option ){
					echo '<option value="' . $key . '"';
					if( $meta ){ 
						if( $meta == $key ) echo ' selected="selected"'; 
					} else {
						if( $field['std'] == $key ) echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				}
				echo'</select></td>';
				break;
				
			case 'radio':
				echo '<td>';
				foreach( $field['options'] as $key => $option ){
					echo '<label class="radio-label"><input type="radio" name="icy_meta['. $field['id'] .']" value="'. $key .'" class="radio"';
					if( $meta ){ 
						if( $meta == $key ) echo ' checked="checked"'; 
					} else {
						if( $field['std'] == $key ) echo ' checked="checked"';
					}
					echo ' /> '. $option .'</label> ';
				}
				echo '</td>';
				break;
			
			case 'color':
			    if( array_key_exists('val', $field) ) $val = ' value="' . $field['val'] . '"';
			    if( $meta ) $val = ' value="' . $meta . '"';
			    echo '<td>';
                echo '<div class="colorpicker-wrapper">';
                echo '<input type="text" id="'. $field['id'] .'_cp" name="icy_meta[' . $field['id'] .']"' . $val . ' />';
                echo '<div id="' . $field['id'] . '" class="colorpicker"></div>';
                echo '</div>';
                echo '</td>';
			    break;
				
			case 'checkbox':
			    echo '<td>';
			    $val = '';
                if( $meta ) {
                    if( $meta == 'on' ) $val = ' checked="checked"';
                } else {
                    if( $field['std'] == 'on' ) $val = ' checked="checked"';
                }

                echo '<input type="hidden" name="icy_meta['. $field['id'] .']" value="off" />
                <input type="checkbox" id="'. $field['id'] .'" name="icy_meta['. $field['id'] .']" value="on"'. $val .' /> ';
			    echo '</td>';
			    break;
		}
		
		echo '</tr>';
	}
 
	echo '</table>';
}

/**
 * Save custom Meta Box
 *
 * @param int $post_id The post ID
 */
function icy_save_meta_box( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['icy_meta']) || !isset($_POST['icy_meta_box_nonce']) || !wp_verify_nonce( $_POST['icy_meta_box_nonce'], basename( __FILE__ ) ) )
		return;
	
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
	}
 
	foreach( $_POST['icy_meta'] as $key=>$val ){
		update_post_meta( $post_id, $key, stripslashes(htmlspecialchars($val)) );
	}

}
add_action( 'save_post', 'icy_save_meta_box' );

/**
 * Save image ids
 */
function icy_save_images() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['ids']) || !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'icy-ajax' ) )
		return;
	
	if ( !current_user_can( 'edit_posts' ) ) return;
 
	$ids = strip_tags(rtrim($_POST['ids'], ','));
	update_post_meta($_POST['post_id'], '_icy_image_ids', $ids);

	// update thumbs
	$thumbs = explode(',', $ids);
	$thumbs_output = '';
	foreach( $thumbs as $thumb ) {
		$thumbs_output .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
	}

	echo $thumbs_output;

	die();
}
add_action('wp_ajax_icy_save_images', 'icy_save_images');


/*-----------------------------------------------------------------------------------*/
/*	Register related Scripts and Styles
/*-----------------------------------------------------------------------------------*/

function icy_metabox_portfolio_scripts() {
    global $post;
    $wp_version = get_bloginfo('version');
    
	wp_enqueue_script('media-upload');
	if( version_compare( $wp_version, '3.4.2', '<=') ) {
		// Using pre-WP3.5
		wp_enqueue_script('thickbox');
		wp_register_script('icy-upload', icy_URL .'/scripts/upload-button.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('icy-upload');

		wp_enqueue_style('thickbox');
	}
	
	if( isset($post) ) {
		wp_localize_script( 'jquery', 'icy_ajax', array(
		    'post_id' => $post->ID,
		    'nonce' => wp_create_nonce( 'icy-ajax' )
		) );
	}
}
add_action('admin_enqueue_scripts', 'icy_metabox_portfolio_scripts');

?>
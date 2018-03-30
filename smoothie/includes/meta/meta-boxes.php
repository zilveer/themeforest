<?php


//----------------// Adding Post Meta Boxes //----------------//
function cr_add_meta_box( $meta_box ) {
	if( !is_array($meta_box) ) return false;
    
    // Create a callback function
    $callback = create_function( '$post,$meta_box', 'cr_create_meta_box( $post, $meta_box["args"] );' );

    add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
} // end cr_custom_meta()
add_action( 'add_meta_boxes', 'cr_add_meta_box' );


//----------------// Enqueue Meta Boxes Scripts//----------------//
if ( !function_exists( 'cr_enqueue_admin_scripts' ) ) {
    function cr_enqueue_admin_scripts() {
        wp_register_script( 'cr-admin', get_template_directory_uri() . '/includes/meta/jquery.custom.admin.js', 'jquery' );
        wp_enqueue_script( 'cr-admin' );
    }
}
add_action( 'admin_enqueue_scripts', 'cr_enqueue_admin_scripts' );


//----------------// Enqueue Meta Boxes Styles//----------------//
function cr_admin_styles() {
	wp_enqueue_style('cr_admin_css', get_template_directory_uri() . '/includes/meta/metabox.css');
}
add_action('admin_print_styles', 'cr_admin_styles');


//----------------// Configuration Post Meta Boxes //----------------//
add_action('add_meta_boxes', 'cr_metabox_posts');
function cr_metabox_posts(){
    
    // Create an image metabox 
	$meta_box = array(
		'id' => 'cr-metabox-post-image',
		'title' =>  __('Gallery Settings', 'cr'),
		'description' => __('Upload images to this post using the below controls. Please note that the Featured Image will be used as the "cover" image and will be skipped in the gallery.', 'cr'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
    		array(
    				'name' =>  __('Upload Images', 'cr'),
    				'desc' => __('Click to upload images.', 'cr'),
    				'id' => '_cr_image_upload',
    				'type' => 'images',
    				'std' => __('Upload Images', 'cr')
    			)
		)
	);
    cr_add_meta_box( $meta_box );
    
    // Create a quote metabox
    $meta_box = array(
		'id' => 'cr-metabox-post-quote',
		'title' =>  __('Quote Settings', 'cr'),
		'description' => __('Input your quote.', 'cr'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' =>  __('The Quote', 'cr'),
					'desc' => __('Input your quote.', 'cr'),
					'id' => '_cr_quote_quote',
					'type' => 'textarea',
                    'std' => ''
				)
		)
	);
    cr_add_meta_box( $meta_box );
	
	// Create a link metabox
	$meta_box = array(
		'id' => 'cr-metabox-post-link',
		'title' =>  __('Link Settings', 'cr'),
		'description' => __('Input your link', 'cr'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' =>  __('The Link', 'cr'),
					'desc' => __('Input your link. Example: http://cr1000team.com', 'cr'),
					'id' => '_cr_link_url',
					'type' => 'text',
					'std' => ''
				)
		)
	);
    cr_add_meta_box( $meta_box );
    
    // Create a video metabox 
    $meta_box = array(
		'id' => 'cr-metabox-post-video',
		'title' => __('Video Settings', 'cr'),
		'description' => __('These settings enable you to embed videos into your posts.', 'cr'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' => __('Embedded Code', 'cr'),
					'desc' => __('Paste the embed code of YouTube or Vimeo video here. Dont change width and height for YouTube and Vimeo embed code. For other videos set width="794" and any height.', 'cr'),
					'id' => '_cr_video_embed_code',
					'type' => 'textarea',
					'std' => ''
				)
		)
	);
	cr_add_meta_box( $meta_box );
	
	// Create an audio metabox 
	$meta_box = array(
		'id' => 'cr-metabox-post-audio',
		'title' =>  __('Audio Settings', 'cr'),
		'description' => __('These settings enable you to embed audio into your posts.', 'cr'),
		'page' => 'post',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' => __('Embedded Code', 'cr'),
					'desc' => __('Paste the embed code of Soundcloud, 8tracks or other similar services. Width is best at 794px with any height.<br>Important note! For Soundcloud use <strong>embed code</strong> not WordPress code', 'cr'),
					'id' => '_cr_audio_embed_code',
					'type' => 'textarea',
					'std' => ''
				)
				
		)
	);
	cr_add_meta_box( $meta_box );
}

//----------------// Create the Post Meta Boxes //----------------//
function cr_create_meta_box( $post, $meta_box )
{
	// set up for fallback to old way of doing things
	$wp_version = get_bloginfo('version');
	
    if( !is_array($meta_box) ) return false;
    
    if( isset($meta_box['description']) && $meta_box['description'] != '' ){
    	echo '<p>'. $meta_box['description'] .'</p>';
    }
    
	wp_nonce_field( basename(__FILE__), 'cr_meta_box_nonce' );
	echo '<table class="form-table cr-metabox-table">';
 
	foreach( $meta_box['fields'] as $field ){
		// Get current post meta data
		$meta = get_post_meta( $post->ID, $field['id'], true );
		echo '<tr><th><label for="'. $field['id'] .'"><strong>'. $field['name'] .'</strong>
			  <span>'. $field['desc'] .'</span></label></th>';
		
		switch( $field['type'] ){	
			case 'text':
				echo '<td><input type="text" name="cr_meta['. $field['id'] .']" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .'" size="30" /></td>';
				break;	
				
			case 'textarea':
				echo '<td><textarea name="cr_meta['. $field['id'] .']" id="'. $field['id'] .'" rows="8" cols="5">'. ($meta ? $meta : $field['std']) .'</textarea></td>';
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
								text: '<?php _e("Insert", "cr"); ?>',

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
				echo '<td><input type="text" name="cr_meta['. $field['id'] .']" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .'" size="30" class="file" /> <input type="button" class="button" name="'. $field['id'] .'_button" id="'. $field['id'] .'_button" value="Browse" /></td>';
				break;

			case 'images': 
				if( version_compare($wp_version, '3.4.2', '>') ) {
					// Using Wp3.5+
			?>
				<script>
				jQuery(function($) {
					var frame,
					    images = '<?php echo get_post_meta( $post->ID, '_cr_image_ids', true ); ?>',
					    selection = loadImages(images);

					$('#cr_images_upload').on('click', function(e) {
						e.preventDefault();

						// Set options for 1st frame render
						var options = {
							title: '<?php _e("Create Featured Gallery", "cr"); ?>',
							state: 'gallery-edit',
							frame: 'post',
							selection: selection
						};

						// Check if frame or gallery already exist
						if( frame || selection ) {
							options['title'] = '<?php _e("Edit Featured Gallery", "cr"); ?>';
						}

						frame = wp.media(options).open();
						
						// Tweak views
						frame.menu.get('view').unset('cancel');
						frame.menu.get('view').unset('separateCancel');
						frame.menu.get('view').get('gallery-edit').el.innerHTML = '<?php _e("Edit Featured Gallery", "cr"); ?>';
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
    							$.post(ajaxurl, { ids: '', action: 'cr_save_images', post_id: cr_ajax.post_id, nonce: cr_ajax.nonce });
							}
						});
						
						// Override insert button
						function overrideGalleryInsert() {
    						frame.toolbar.get('view').set({
								insert: {
									style: 'primary',
									text: '<?php _e("Save Featured Gallery", "cr"); ?>',

									click: function() {
										var models = frame.state().get('library'),
										    ids = '';

										models.each( function( attachment ) {
										    ids += attachment.id + ','
										});

										this.el.innerHTML = '<?php _e("Saving...", "cr"); ?>';
										
										$.ajax({
											type: 'POST',
											url: ajaxurl,
											data: { 
												ids: ids, 
												action: 'cr_save_images', 
												post_id: cr_ajax.post_id, 
												nonce: cr_ajax.nonce 
											},
											success: function(){
    											selection = loadImages(ids);
    											$('#_cr_image_ids').val( ids );
    											frame.close();
											},
											dataType: 'html'
										}).done( function( data ) {
											$('.cr-gallery-thumbs').html( data );
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
				$meta = get_post_meta( $post->ID, '_cr_image_ids', true );
				$thumbs_output = '';
				$button_text = ($meta) ? __('Edit Gallery', 'cr') : $field['std'];
				if( $meta ) {
					$field['std'] = __('Edit Gallery', 'cr');
					$thumbs = explode(',', $meta);
					$thumbs_output = '';
					foreach( $thumbs as $thumb ) {
						$thumbs_output .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
					}
				}

			    echo 
			    	'<td>
			    		<input type="button" class="button" name="' . $field['id'] . '" id="cr_images_upload" value="' . $button_text .'" />
			    		
			    		<input type="hidden" name="cr_meta[_cr_image_ids]" id="_cr_image_ids" value="' . ($meta ? $meta : 'false') . '" />

			    		<ul class="cr-gallery-thumbs">' . $thumbs_output . '</ul>
			    	</td>';
			    } else {
			    	// Using pre-WP3.5
			    	echo '<td><input type="button" class="button" name="' . $field['id'] . '" id="cr_images_upload" value="' . $field['std'] .'" /></td>';
			    }
			    break;
				
			case 'select':
				echo'<td><select name="cr_meta['. $field['id'] .']" id="'. $field['id'] .'">';
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
					echo '<label class="radio-label"><input type="radio" name="cr_meta['. $field['id'] .']" value="'. $key .'" class="radio"';
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
                echo '<input type="text" id="'. $field['id'] .'_cp" name="cr_meta[' . $field['id'] .']"' . $val . ' />';
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

                echo '<input type="hidden" name="cr_meta['. $field['id'] .']" value="off" />
                <input type="checkbox" id="'. $field['id'] .'" name="cr_meta['. $field['id'] .']" value="on"'. $val .' /> ';
			    echo '</td>';
			    break;
		}
		
		echo '</tr>';
	}
 
	echo '</table>';
}

// Save custom Meta Box

function cr_save_meta_box( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['cr_meta']) || !isset($_POST['cr_meta_box_nonce']) || !wp_verify_nonce( $_POST['cr_meta_box_nonce'], basename( __FILE__ ) ) )
		return;
	
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
	}
 
	foreach( $_POST['cr_meta'] as $key=>$val ){
		update_post_meta( $post_id, $key, stripslashes(htmlspecialchars($val)) );
	}

}
add_action( 'save_post', 'cr_save_meta_box' );

// Save image ids

function cr_save_images() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['ids']) || !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'cr-ajax' ) )
		return;
	
	if ( !current_user_can( 'edit_posts' ) ) return;
 
	$ids = strip_tags(rtrim($_POST['ids'], ','));
	update_post_meta($_POST['post_id'], '_cr_image_ids', $ids);

	// update thumbs
	$thumbs = explode(',', $ids);
	$thumbs_output = '';
	foreach( $thumbs as $thumb ) {
		$thumbs_output .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
	}

	echo $thumbs_output;

	die();
}
add_action('wp_ajax_cr_save_images', 'cr_save_images');


//	Register related Scripts and Styles
function cr_metabox_portmasonry_scripts() {
    global $post;
    $wp_version = get_bloginfo('version');
    
	wp_enqueue_script('media-upload');
	if( version_compare( $wp_version, '3.4.2', '<=') ) {
		// Using pre-WP3.5
		wp_enqueue_script('thickbox');
		wp_register_script('cr-upload', cr_URL .'/scripts/upload-button.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('cr-upload');

		wp_enqueue_style('thickbox');
	}
	
	if( isset($post) ) {
		wp_localize_script( 'jquery', 'cr_ajax', array(
		    'post_id' => get_the_ID(),
		    'nonce' => wp_create_nonce( 'cr-ajax' )
		) );
	}
}
add_action('admin_enqueue_scripts', 'cr_metabox_portmasonry_scripts');


?>
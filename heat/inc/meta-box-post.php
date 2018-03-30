<?php
/**
 * Define the custom box for posts.
 */
 
$prefix = 'mega_';
 
$meta_box_post_gallery = array(
	'id' => 'mega-meta-box-post-gallery',
	'title' =>  __( 'Post Gallery', 'mega' ),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(  "name" => '',
				"desc" => '',
				"type" => "attachments",
				'std' => ''
			)		
	)
);

$meta_box_post_video = array(
	'id' => 'mega-meta-box-post-video',
	'title' =>  __( 'Video Settings', 'mega' ),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 	"desc" => __( 'Self Hosted Video:', 'mega' ),
				"type" => "info"
			),	
		array( 	"name" => __( 'M4V File URL', 'mega' ),
				"desc" => __( 'Enter the URL of the .m4v video file', 'mega' ),
				"id" => $prefix . "video_m4v",
				"type" => "text",
				'std' => ''
			),
		array( 	"name" => __( 'OGV File URL', 'mega' ),
				"desc" => __( 'Enter the URL of the .ogv video file', 'mega' ),
				"id" => $prefix . "video_ogv",
				"type" => "text",
				'std' => ''
			),
		array( 	"name" => __( 'Poster Image', 'mega' ),
				"desc" => __( 'Enter the preview image URL for the video', 'mega' ),
				"id" => $prefix . "video_poster",
				"type" => "text",
				'std' => ''
			),			
		array( 	"desc" => __( 'Video sharing website:', 'mega' ),
				"type" => "info"
		),
		array(
				'name' => __( 'YouTube or Vimeo URL', 'mega' ),
				'desc' => __( 'Enter the YouTube or Vimeo URL here. <br/> http://www.youtube.com/watch?v=VIDEO_ID <br/>or<br/> http://vimeo.com/VIDEO_ID', 'mega' ),
				'id' => $prefix.'youtube_vimeo_url',
				'type' => 'text',
				'std' => ''
		),
		array(
				'name' => __( 'Embed Code', 'mega' ),
				'desc' => __( 'If you are using other video sharing website, paste the embed code here', 'mega' ),
				'id' => $prefix . 'video_embed_code',
				'type' => 'textarea',
				'std' => ''
		),
		array(	"desc" => __( 'Aspect Ratio (default 16:9):', 'mega' ),
				"type" => "info"
		),
		array(
			'name' => __( 'Video Width', 'mega' ),
			'desc' => __("Enter the video's width", 'mega'),
			'id' => $prefix . 'video_ratio_width',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __( 'Video Height', 'mega' ),
			'desc' => __( "Enter the video's height", 'mega' ),
			'id' => $prefix . 'video_ratio_height',
			'type' => 'text',
			'std' => ''
		),
	)	
);

$meta_box_post_audio = array(
	'id' => 'mega-meta-box-post-audio',
	'title' =>  __( 'Audio Settings', 'mega' ),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 
		    "name" => __( 'MP3 File URL', 'mega' ),
				"desc" => __( 'Enter the URL of the .mp3 audio file', 'mega' ),
				"id" => $prefix."audio_mp3",
				"type" => "text",
				'std' => ''
		),
		array( 
		    "name" => __( 'OGA File URL', 'mega' ),
				"desc" => __( 'Enter the URL of the .oga or .ogg audio file', 'mega' ),
				"id" => $prefix."audio_ogg",
				"type" => "text",
				'std' => ''
		),
		array( "name" => __( 'Poster Image', 'mega' ),
				"desc" => __( 'Enter the poster image URL for the audio', 'mega' ),
				"id" => $prefix . "audio_poster",
				"type" => "text",
				'std' => ''
		),
		array(
				'name' => __( 'Embed Code', 'mega' ),
				'desc' => __( 'If you are using an audio sharing service like SoundCloud, paste the embed code here', 'mega' ),
				'id' => $prefix . 'audio_embed_code',
				'type' => 'textarea',
				'std' => ''
		)	
	)
);

$meta_box_post_quote = array(
	'id' => 'mega-meta-box-post-quote',
	'title' =>  __( 'Quote Settings', 'mega' ),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( 	"name" => __( 'The Quote', 'mega' ),
				"desc" => __( 'Insert your quote', 'mega' ),
				"id" => $prefix."quote",
				"type" => "textarea",
				"std" => ""
		),
		array( 	"name" => __( 'The Quote Source', 'mega' ),
				"desc" => __( 'Insert the source of your quote', 'mega' ),
				"id" => $prefix."quote_source",
				"type" => "text",
				"std" => ""
		)
	)
);

/**
 * Adds a box.
 */

add_action('add_meta_boxes', 'mega_add_box_post');

function mega_add_box_post() {
	global $meta_box_post_video, $meta_box_post_audio, $meta_box_post_quote, $meta_box_post_image, $meta_box_post_gallery;
	add_meta_box($meta_box_post_gallery['id'], $meta_box_post_gallery['title'], 'mega_show_box_post_gallery', $meta_box_post_gallery['page'], $meta_box_post_gallery['context'], $meta_box_post_gallery['priority']);
	add_meta_box($meta_box_post_video['id'], $meta_box_post_video['title'], 'mega_show_box_post_video', $meta_box_post_video['page'], $meta_box_post_video['context'], $meta_box_post_video['priority']);
	add_meta_box($meta_box_post_audio['id'], $meta_box_post_audio['title'], 'mega_show_box_post_audio', $meta_box_post_audio['page'], $meta_box_post_audio['context'], $meta_box_post_audio['priority']);
	add_meta_box($meta_box_post_quote['id'], $meta_box_post_quote['title'], 'mega_show_box_post_quote', $meta_box_post_quote['page'], $meta_box_post_quote['context'], $meta_box_post_quote['priority']);
}

/**
 * Prints the box content.
 */
function mega_show_box_post_gallery() {
	global $meta_box_post_gallery, $post;
	
	echo '<p style="padding:10px 0 0 0;">'.__( 'These settings enable you to manage the images displayed in the post. Images in the post gallery can be re-ordered easily via drag and drop. Simply re-order your images by moving them around. To remove an image from the post gallery, hover over the image and click on the red &ldquo;x&rdquo;.', 'mega' ).'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	?>
	<table class="form-table mega-custom-table">
		<tr style="border-top:1px solid #eeeeee;">
			<td>				
				<div id="gallery_images_container">
					<ul class="gallery_images">
						<?php
							if ( metadata_exists( 'post', $post->ID, '_post_image_gallery' ) ) {
								$post_image_gallery = get_post_meta( $post->ID, '_post_image_gallery', true );
							} else {
								// Backwards compat
								$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
								$post_image_gallery = implode( ',', $attachment_ids );
							}
							

							$attachments = array_filter( explode( ',', $post_image_gallery ) );
							$thumbs = array();
							if ( $attachments ) {
								foreach ( $attachments as $attachment_id ) {
									echo '<li class="image" data-attachment_id="' . $attachment_id . '">
										' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
										<ul class="actions">
											<li><a href="#" class="delete" title="' . __( 'Delete image', 'mega' ) . '">' . __( 'Delete', 'mega' ) . '</a></li>
										</ul>
									</li>';
									$thumbs[$attachment_id] = wp_get_attachment_image( $attachment_id, 'thumbnail' );
								}
							}								
						?>
					</ul>
					<input type="hidden" id="post_image_gallery" name="post_image_gallery" value="<?php echo esc_attr( $post_image_gallery ); ?>" />
				</div>
				<p class="add_gallery_images hide-if-no-js">
					<a href="#"><?php _e( 'Add post gallery images', 'mega' ); ?></a>
				</p>
				<script type="text/javascript">
					jQuery(document).ready(function($){
						// Uploading files
						var portfolio_gallery_frame;
						var $image_gallery_ids = $('#post_image_gallery');
						var $portfolio_images = $('#gallery_images_container ul.gallery_images');
						jQuery('.add_gallery_images').on( 'click', 'a', function( event ) {
							var $el = $(this);
							var attachment_ids = $image_gallery_ids.val();
							event.preventDefault();
							// If the media frame already exists, reopen it.
							if ( portfolio_gallery_frame ) {
								portfolio_gallery_frame.open();
								return;
							}
							// Create the media frame.
							portfolio_gallery_frame = wp.media.frames.downloadable_file = wp.media({
								// Set the title of the modal.
								title: '<?php _e( 'Add Images to Portfolio Gallery', 'mega' ); ?>',
								button: {
									text: '<?php _e( 'Add to gallery', 'mega' ); ?>',
								},
								multiple: true
							});							
							// When an image is selected, run a callback.
							portfolio_gallery_frame.on( 'select', function() {
								var selection = portfolio_gallery_frame.state().get('selection');
								selection.map( function( attachment ) {
									attachment = attachment.toJSON();
									if ( attachment.id ) {
										attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
										$portfolio_images.append('\
											<li class="image" data-attachment_id="' + attachment.id + '">\
												<img src="' + attachment.sizes.thumbnail.url + '" />\
												<ul class="actions">\
													<li><a href="#" class="delete" title="<?php _e( 'Delete image', 'mega' ); ?>"><?php _e( 'Delete', 'mega' ); ?></a></li>\
												</ul>\
											</li>');
									}
								} );
								$image_gallery_ids.val( attachment_ids );
							});
							// Finally, open the modal.
							portfolio_gallery_frame.open();
						});
						// Image ordering
						$portfolio_images.sortable({
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
								$('#gallery_images_container ul li.image').css('cursor','move').each(function() {
									var attachment_id = jQuery(this).attr( 'data-attachment_id' );
									attachment_ids = attachment_ids + attachment_id + ',';
								});
								$image_gallery_ids.val( attachment_ids );
							}
						});
						// Remove images
						$('#gallery_images_container').on( 'click', 'a.delete', function() {
							$(this).closest('li.image').remove();
							var attachment_ids = '';
							$('#gallery_images_container ul li.image').css('cursor','move').each(function() {
								var attachment_id = jQuery(this).attr( 'data-attachment_id' );
								attachment_ids = attachment_ids + attachment_id + ',';
							});
							$image_gallery_ids.val( attachment_ids );
							return false;
						} );
					});
				</script>
			</table>
<?php
}
function mega_show_box_post_video() {
	global $meta_box_post_video, $post;
	
	echo '<p style="padding:10px 0 0 0;">'.__('These settings enable you to add video to your post. You have the choice between Self Hosted Video, YouTube or Vimeo, or any other Video Sharing Websites.', 'mega').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table mega-custom-table">';
 
	foreach ($meta_box_post_video['fields'] as $field) {
	
		// get current post meta data
		if (isset ($field['id']))
			$meta = get_post_meta($post->ID, $field['id'], true);
			
		switch ($field['type']) {
			
			//If Info
			case 'info':
				echo '<tr style="border-top:1px solid #eeeeee;">',
					'<th style="width:25%;"><span style="display:inline-block;margin:5px 0;font-weight:bold;text-transform:uppercase;border-bottom:1px solid #666;">'. $field['desc'].'<strong></th>',
					'<td></td></tr>';
			break;
		 
			//If Text		
			case 'text':			
				echo '<tr style="border-top:1px solid #eeeeee;">',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height:18px; ">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:90%; margin-right: 20px; float:left;" />';
				echo '</td>',
				'</tr>';
			break;
			 
			//If Textarea		
			case 'textarea':
			
				echo '<tr style="border-top:1px solid #eeeeee;">',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" rows="8" cols="5" style="width:90%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
				echo '</td>',
				'</tr>';
			break;
			
		}

	}
 
	echo '</table>';
}

function mega_show_box_post_audio() {
	global $meta_box_post_audio, $post;
	
	echo '<p style="padding:10px 0 0 0;">'.__( 'These settings enable you to add audio to your post.', 'mega' ).'</p>';

	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table mega-custom-table">';
 
	foreach ($meta_box_post_audio['fields'] as $field) {
	
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			//If Text		
			case 'text':			
				echo '<tr style="border-top:1px solid #eeeeee;">',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height:18px; ">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:90%; margin-right: 20px; float:left;" />';
				echo '</td>',
				'</tr>';
			break;
			
			//If Textarea		
			case 'textarea':
			
				echo '<tr style="border-top:1px solid #eeeeee;">',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" rows="8" cols="5" style="width:90%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
				echo '</td>',
				'</tr>';
			break;
			

		}

	}
 
	echo '</table>';
}

function mega_show_box_post_quote() {
	global $meta_box_post_quote, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table mega-custom-table">';
 
	foreach ($meta_box_post_quote['fields'] as $field) {
	
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 			
			//If textarea		
			case 'textarea':
			
				echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" rows="8" cols="5" style="width:90%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
				echo '</td>',
				'</tr>';
			break;
			
			//If Text		
			case 'text':			
				echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height:18px; ">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:90%; margin-right: 20px; float:left;" />';
				echo '</td>',
				'</tr>';
			break;

		}

	}
 
	echo '</table>';
}

/**
 * Save data from meta box.
 */
add_action( 'save_post', 'mega_save_data_post' );
 
function mega_save_data_post($post_id) {
	global $meta_box_post_image, $meta_box_post_gallery, $meta_box_post_video, $meta_box_post_audio, $meta_box_post_quote;
 
	if ( isset($_POST['mega_meta_box_nonce'])) {
		// verify nonce
		if (!wp_verify_nonce($_POST['mega_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
	 
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
	 
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		
		// Saving images from metabox
		$attachment_ids = array_filter( explode( ',', mega_clean( $_POST['post_image_gallery'] ) ) );
		update_post_meta( $post_id, '_post_image_gallery', implode( ',', $attachment_ids ) );
		
		foreach ($meta_box_post_video['fields'] as $field) {
			if(isset($field['id'])){
				$old = get_post_meta($post_id, $field['id'], true);
				$new = $_POST[$field['id']];
		 
				if ($new && $new != $old) {
					update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
				} elseif ('' == $new && $old) {
					delete_post_meta($post_id, $field['id'], $old);
				}
			}
		}
		
		foreach ($meta_box_post_audio['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
	 
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
		
		foreach ($meta_box_post_quote['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
	 
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
		
			
	}
}

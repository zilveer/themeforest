<?php
/**
 * Define the custom box for pages.
 */
 
$prefix = 'mega_';

$meta_box_page_gallery = array(
	'id' => 'mega-meta-box-page-gallery',
	'title' =>  __( 'Page Gallery', 'mega' ),
	'page' => 'page',
	'context' => 'normal', 
	'priority' => 'default',
	'fields' => array(	
		array(  "name" => '',
				"desc" => '',
				"type" => 'attachments',
				'std' => ''
			)
	)
);

$meta_box_page_photos = array(
	'id' => 'mega-meta-box-page-photos',
	'title' =>  __( 'Gallery Settings', 'mega' ),
	'page' => 'page',
	'context' => 'normal', 
	'priority' => 'default',
	'fields' => array(
		array( "name" => __( 'Number of Images', 'mega' ),
				"desc" => __( 'Enter the number of images to display per loading', 'mega' ),
				"id" => $prefix."photos_number",
				'type' => 'text',
				'std' => 30
			),
		array( "name" => __( 'Photos Title', 'mega' ),
				"desc" => __( 'Choose whether to show a title when the lightbox opens', 'mega' ),
				"id" => $prefix .'photos_title',				
				"type" => "select",
				'std' => __( 'no', 'mega' ),
				'options' => array( __( 'yes', 'mega' ), __( 'no','mega' ) )
			)
	)
);

$meta_box_page_photos_full_width_slider = array(
	'id' => 'mega-meta-box-page-photos-full-width-slider',
	'title' =>  __( 'Full Width Slider Settings', 'mega' ),
	'page' => 'page',
	'context' => 'normal', 
	'priority' => 'default',
	'fields' => array(	
		array( "name" => __( 'Slide Align', 'mega' ),
				"desc" => __( "Aligns image to center of slide.", 'mega' ),
				"id" => $prefix."slider_align",				
				"type" => "select",
				'std' => __( 'yes', 'mega' ),
				'options' => array( __( 'yes', 'mega' ), __( 'no', 'mega' ) )
			),
		array( "name" => __( 'Image Scale Mode', 'mega' ),
				"desc" => __( "Fit enlarges image if it's smaller then viewport. Fill scales image to completely fill slider viewport.", 'mega' ),
				"id" => $prefix."image_scale_mode",				
				"type" => "select",
				'std' => __( 'fill', 'mega' ),
				'options' => array( __( 'fill', 'mega' ), __( 'fit', 'mega' ) )
			)
	)
);

$meta_box_page_videos = array(
	'id' => 'mega-meta-box-page-videos',
	'title' =>  __( 'Video Gallery Settings', 'mega' ),
	'page' => 'page',
	'context' => 'normal', 
	'priority' => 'default',
	'fields' => array(
		array( "name" => __( 'Videos Title', 'mega' ),
				"desc" => __( 'Choose whether to show a title when the lightbox opens', 'mega' ),
				"id" => $prefix .'videos_title',				
				"type" => "select",
				'std' => __( 'no', 'mega' ),
				'options' => array( __( 'yes', 'mega' ), __( 'no','mega' ) )
			)
	)
);


/**
 * Add metabox.
 */
add_action('admin_menu', 'mega_add_box_page');

function mega_add_box_page() {
	global $meta_box_page_gallery, $meta_box_page_photos, $meta_box_page_videos, $meta_box_page_photos_full_width_slider;
	add_meta_box($meta_box_page_gallery['id'], $meta_box_page_gallery['title'], 'mega_show_box_page_gallery', $meta_box_page_gallery['page'], $meta_box_page_gallery['context'], $meta_box_page_gallery['priority']);
	add_meta_box($meta_box_page_photos['id'], $meta_box_page_photos['title'], 'mega_show_box_page_photos', $meta_box_page_photos['page'], $meta_box_page_photos['context'], $meta_box_page_photos['priority']);
	add_meta_box($meta_box_page_photos_full_width_slider['id'], $meta_box_page_photos_full_width_slider['title'], 'mega_show_box_page_full_width_slider', $meta_box_page_photos_full_width_slider['page'], $meta_box_page_photos_full_width_slider['context'], $meta_box_page_photos_full_width_slider['priority']);
	add_meta_box($meta_box_page_videos['id'], $meta_box_page_videos['title'], 'mega_show_box_page_videos', $meta_box_page_videos['page'], $meta_box_page_videos['context'], $meta_box_page_videos['priority']);
}


/**
 * Callback function to show fields in meta box.
 */
function mega_show_box_page_gallery() {
	global $meta_box_page_gallery, $post;

	echo '<p style="padding:10px 0 0 0;">'.__( 'These settings enable you to manage the images displayed in the gallery. Images in the gallery can be re-ordered easily via drag and drop. Simply re-order your images by moving them around. To remove an image from the gallery, hover over the image and click on the red &ldquo;x&rdquo;.', 'mega' ).'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	?>
	<table class="form-table mega-custom-table">
		<tr style="border-top:1px solid #eeeeee;">
			<td>				
				<div id="gallery_images_container">
					<ul class="gallery_images">
						<?php
							if ( metadata_exists( 'post', $post->ID, '_page_image_gallery' ) ) {
								$page_image_gallery = get_post_meta( $post->ID, '_page_image_gallery', true );
							} else {
								// Backwards compat
								$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
								$page_image_gallery = implode( ',', $attachment_ids );
							}
							

							$attachments = array_filter( explode( ',', $page_image_gallery ) );
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
					<input type="hidden" id="page_image_gallery" name="page_image_gallery" value="<?php echo esc_attr( $page_image_gallery ); ?>" />
				</div>
				<p class="add_gallery_images hide-if-no-js">
					<a href="#"><?php _e( 'Add gallery images', 'mega' ); ?></a>
				</p>
				<script type="text/javascript">
					jQuery(document).ready(function($){					
						// Uploading files
						var page_gallery_frame;
						var $image_gallery_ids = $('#page_image_gallery');
						var $page_images = $('#gallery_images_container ul.gallery_images');
						jQuery('.add_gallery_images').on( 'click', 'a', function( event ) {
							var $el = $(this);
							var attachment_ids = $image_gallery_ids.val();
							event.preventDefault();
							// If the media frame already exists, reopen it.
							if ( page_gallery_frame ) {
								page_gallery_frame.open();
								return;
							}
							// Create the media frame.
							page_gallery_frame = wp.media.frames.downloadable_file = wp.media({
								// Set the title of the modal.
								title: '<?php _e( 'Add Images to Gallery', 'mega' ); ?>',
								button: {
									text: '<?php _e( 'Add to gallery', 'mega' ); ?>',
								},
								multiple: true
							});							
							// When an image is selected, run a callback.
							page_gallery_frame.on( 'select', function() {
								var selection = page_gallery_frame.state().get('selection');
								selection.map( function( attachment ) {
									attachment = attachment.toJSON();
									if ( attachment.id ) {
										attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
										$page_images.append('\
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
							page_gallery_frame.open();
						});
						// Image ordering
						$page_images.sortable({
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

function mega_show_box_page_photos() {
	global $meta_box_page_photos, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table mega-custom-table">';
	
	foreach ( $meta_box_page_photos['fields'] as $field ) {
	
		// get current post meta data
		if ( isset ( $field['id'] ) )
			$meta = get_post_meta($post->ID, $field['id'], true);
		
		switch ( $field['type'] ) {
			
			//If Text
			case 'text':
				echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height:18px; ">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:90%; margin-right: 20px; float:left;" />';
				echo '</td>',
				'</tr>';
			break;
			
			//If Select	
			case 'select':			
				echo '<tr style="border-top:1px solid #eeeeee;">',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<select id="' . $field['id'] . '" name="'.$field['id'].'">';			
				foreach ($field['options'] as $option) {	
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';	
				} 
				echo'</select>';
				echo '</td>',
				'</tr>';			
			break;
	
		}
	}
	echo '</table>';
}

function mega_show_box_page_full_width_slider() {
	global $meta_box_page_photos_full_width_slider, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_page_photos_full_width_slider['fields'] as $field) {
		
		// get current post meta data
		if (isset ($field['id']))
			$meta = get_post_meta($post->ID, $field['id'], true);
			
		switch ($field['type']) {
		
			//If Select	
			case 'select':			
				echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<select id="' . $field['id'] . '" name="'.$field['id'].'">';			
				foreach ($field['options'] as $option) {	
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';	
				} 
				echo'</select>';
				echo '</td>',
				'</tr>';			
			break;
	
		}
	} 
	echo '</table>';
}

function mega_show_box_page_videos() {
	global $meta_box_page_videos, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table mega-custom-table">';
	
	foreach ( $meta_box_page_videos['fields'] as $field ) {
	
		// get current post meta data
		if ( isset ( $field['id'] ) )
			$meta = get_post_meta($post->ID, $field['id'], true);
		
		switch ( $field['type'] ) {
			
			//If Text
			case 'text':
				echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height:18px; ">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:90%; margin-right: 20px; float:left;" />';
				echo '</td>',
				'</tr>';
			break;
			
			//If Select	
			case 'select':			
				echo '<tr style="border-top:1px solid #eeeeee;">',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<select id="' . $field['id'] . '" name="'.$field['id'].'">';			
				foreach ($field['options'] as $option) {	
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';	
				} 
				echo'</select>';
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
add_action( 'save_post', 'mega_save_data_page' );

function mega_save_data_page($post_id) {
	global $meta_box_page_gallery, $meta_box_page_photos, $meta_box_page_photos_full_width_slider, $meta_box_page_videos;
 
	if ( isset( $_POST['mega_meta_box_nonce'] ) ) {
		// verify nonce
		if (!wp_verify_nonce($_POST['mega_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
	 
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
	 
		// check permissions
		if ( 'page' == $_POST['post_type'] ) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		
		// Saving images from metabox
		$attachment_ids = array_filter( explode( ',', mega_clean( $_POST['page_image_gallery'] ) ) );
		update_post_meta( $post_id, '_page_image_gallery', implode( ',', $attachment_ids ) );
	 
		foreach ( $meta_box_page_photos['fields'] as $field ) {
			if ( isset( $field['id'] ) ) {
				$old = get_post_meta($post_id, $field['id'], true);
				$new = $_POST[$field['id']];
		 
				if ($new && $new != $old) {
					update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
				} elseif ('' == $new && $old) {
					delete_post_meta($post_id, $field['id'], $old);
				}
			}
		}
		
		foreach ($meta_box_page_photos_full_width_slider['fields'] as $field) {
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
		
		foreach ( $meta_box_page_videos['fields'] as $field ) {
			if ( isset( $field['id'] ) ) {
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
}

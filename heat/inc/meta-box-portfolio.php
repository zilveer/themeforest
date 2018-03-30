<?php
/**
 * Define the custom box for Portfolios.
 */

$prefix = 'mega_';

$meta_box_portfolio = array(
	'id' => 'mega-meta-box-portfolio',
	'title' =>  __( 'Portfolio Settings', 'mega' ),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
    	   'name' => __( 'Portfolio Client', 'mega' ),
    	   'desc' => __( "Enter the client's name", 'mega' ),
    	   'id' => $prefix.'portfolio_client',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __( 'Portfolio Date', 'mega' ),
    	   'desc' => __( 'Enter the date of the project achievement', 'mega' ),
    	   'id' => $prefix.'portfolio_date',
    	   'type' => 'text',
    	   'std' => ''
    	),    	
    	array(
    	   'name' => __( 'Portfolio URL', 'mega' ),
    	   'desc' => __( 'Enter the url of the project', 'mega' ),
    	   'id' => $prefix.'portfolio_url',
    	   'type' => 'text',
    	   'std' => ''
    	),
		array(
			'name' =>  __( 'Portfolio Type', 'mega' ),
			'desc' => __( "Select the portfolio's type", 'mega' ),
			'id' => $prefix.'portfolio_type',
			"type" => "select",
			'std' => __( 'Images', 'mega' ),
			'options' => array( 'Images', 'Video' )
		)
	)
);
 
$meta_box_portfolio_images = array(
	'id' => 'mega-meta-box-portfolio-images',
	'title' =>  __( 'Portfolio Gallery', 'mega' ),
	'page' => 'portfolio',
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


$meta_box_portfolio_video = array(
	'id' => 'mega-meta-box-portfolio-video',
	'title' => __( 'Video Settings', 'mega' ),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(	
		array(	"desc" => __( 'Video sharing website:', 'mega' ),
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
			'desc' => __( 'If you are using other video sharing website, paste the embed code here.', 'mega' ),
			'id' => $prefix . 'video_embed_code',
			'type' => 'textarea',
			'std' => ''
		),
		array(	"desc" => __( 'Aspect Ratio (default 16:9):', 'mega' ),
				"type" => "info"
		),
		array(
			'name' => __( 'Video Width', 'mega' ),
			'desc' => __( "Enter the video's width", 'mega' ),
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
		)
		
	)
);

$meta_box_portfolio_custom_url = array(
	'id' => 'mega-meta-box-portfolio-custom-url',
	'title' =>  __( 'Portfolio Custom URL', 'mega' ),
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
    	   'name' => __( 'Custom URL', 'mega' ),
    	   'desc' => __( 'If you want to link the portfolio item to a custom url, enter the url here', 'mega' ),
    	   'id' => $prefix.'portfolio_custom_url',
    	   'type' => 'text',
    	   'std' => ''
    	)
	)
);

/**
 * Add metabox .
 */
add_action( 'admin_menu', 'mega_add_boxes_portfolio' );
 
function mega_add_boxes_portfolio() {
	global $meta_box_portfolio, $meta_box_portfolio_images, $meta_box_portfolio_video, $meta_box_portfolio_custom_url;
	add_meta_box($meta_box_portfolio['id'], $meta_box_portfolio['title'], 'mega_show_box_portfolio', $meta_box_portfolio['page'], $meta_box_portfolio['context'], $meta_box_portfolio['priority']);
	add_meta_box($meta_box_portfolio_images['id'], $meta_box_portfolio_images['title'], 'mega_show_box_portfolio_images', $meta_box_portfolio_images['page'], $meta_box_portfolio_images['context'], $meta_box_portfolio_images['priority']);
	add_meta_box($meta_box_portfolio_video['id'], $meta_box_portfolio_video['title'], 'mega_show_box_portfolio_video', $meta_box_portfolio_video['page'], $meta_box_portfolio_video['context'], $meta_box_portfolio_video['priority']);
	add_meta_box($meta_box_portfolio_custom_url['id'], $meta_box_portfolio_custom_url['title'], 'mega_show_box_portfolio_custom_url', $meta_box_portfolio_custom_url['page'], $meta_box_portfolio_custom_url['context'], $meta_box_portfolio_custom_url['priority']);
}

/**
 * Callback function to show fields in meta box.
 */
function mega_show_box_portfolio() {
	global $meta_box_portfolio, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__( 'Fill in the project details and select the type of portfolio. Set a featured image (360 x 240) that will be used as the portfolio thumbnail. Each image must be the same height but can be any width.', 'mega' ).'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table mega-custom-table">';
 
	foreach ($meta_box_portfolio['fields'] as $field) {
	
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

function mega_show_box_portfolio_images() {
	global $meta_box_portfolio_images, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__( 'These settings enable you to manage the images displayed in the portfolio. Images in the portfolio gallery can be re-ordered easily via drag and drop. Simply re-order your images by moving them around. To remove an image from the portfolio gallery, hover over the image and click on the red &ldquo;x&rdquo;.', 'mega' ).'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	?>
	<table class="form-table mega-custom-table">
		<tr style="border-top:1px solid #eeeeee;">
			<td>				
				<div id="gallery_images_container">
					<ul class="gallery_images">
						<?php
							if ( metadata_exists( 'post', $post->ID, '_portfolio_image_gallery' ) ) {
								$portfolio_image_gallery = get_post_meta( $post->ID, '_portfolio_image_gallery', true );
							} else {
								// Backwards compat
								$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
								$portfolio_image_gallery = implode( ',', $attachment_ids );
							}
							

							$attachments = array_filter( explode( ',', $portfolio_image_gallery ) );
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
					<input type="hidden" id="portfolio_image_gallery" name="portfolio_image_gallery" value="<?php echo esc_attr( $portfolio_image_gallery ); ?>" />
				</div>
				<p class="add_gallery_images hide-if-no-js">
					<a href="#"><?php _e( 'Add portfolio gallery images', 'mega' ); ?></a>
				</p>
				<script type="text/javascript">
					jQuery(document).ready(function($){					
						// Uploading files
						var portfolio_gallery_frame;
						var $image_gallery_ids = $('#portfolio_image_gallery');
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
function mega_show_box_portfolio_video() {
	global $meta_box_portfolio_video, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__( 'These settings enable you to add video to your portfolio. You have the choice between Self Hosted Video, YouTube, Vimeo or any other Video Sharing Websites.', 'mega' ).'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table mega-custom-table">';
 
	foreach ($meta_box_portfolio_video['fields'] as $field) {
	
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
			
			//If textarea		
			case 'textarea':
			
				echo '<tr style="border-top:1px solid #eeeeee;">',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" rows="8" cols="5" style="width:90%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
				echo '</td>',
				'</tr>';
			break;
			
			//If Upload		
			case 'upload':			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="display:block; color:#666; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			echo '<input style="float: left;" type="button" class="button" name="'. $field['id']. '" id="'. $field['id']. '_button" value="' .  __( 'Browse', 'mega' )  .'" />';
			echo 	'</td>',
			'</tr>';			
			break;		
			
 
		}

	}
 
	echo '</table>';
}

function mega_show_box_portfolio_custom_url() {
	global $meta_box_portfolio_custom_url, $post;
 	
	// Use nonce for verification
	echo '<input type="hidden" name="mega_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table mega-custom-table">';
 
	foreach ($meta_box_portfolio_custom_url['fields'] as $field) {
	
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) { 
			
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
add_action( 'save_post', 'mega_save_data_portfolio' );
 
function mega_save_data_portfolio($post_id) {
	global $meta_box_portfolio, $meta_box_portfolio_video, $meta_box_portfolio_custom_url;
 
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
		$attachment_ids = array_filter( explode( ',', mega_clean( $_POST['portfolio_image_gallery'] ) ) );
		update_post_meta( $post_id, '_portfolio_image_gallery', implode( ',', $attachment_ids ) );
				
		foreach ($meta_box_portfolio['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
	 
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	 
		foreach ($meta_box_portfolio_video['fields'] as $field) {
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
		
		foreach ($meta_box_portfolio_custom_url['fields'] as $field) {
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
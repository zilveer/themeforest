<?php 

// add meta boxes
			add_action( 'admin_init', 'add_metaboxes' );
			// save meta boxes
			add_action( 'save_post', 'save_metaboxes' );
		/********************************************
		* Display meta boxes for post formats
		********************************************/
		
		// register fileds
		$metaboxes = array(
			'link_post_format' => array(
					'title' => 'Link post format',
					'applicableto' => 'post',
					'location' => 'normal',
					'display_condition' => 'post-format-link',
					'priority' => 'high',
					'fields' => array(
							'title_link' => array(
									'title' => 'Link',
									'type' => 'text',
									'description' => '',
									'size' => 100
							)
					)
			),
		'quote_post_format' => array(
					'title' => 'Quote post format',
					'applicableto' => 'post',
					'location' => 'normal',
					'display_condition' => 'post-format-quote',
					'priority' => 'high',
					'fields' => array(
							'quote_format' => array(
									'title' => 'Quote',
									'type' => 'text',
									'description' => '',
									'size' => 100
							)
					)
			),
		'video_post_format' => array(
					'title' => 'Video post format',
					'applicableto' => 'post',
					'location' => 'normal',
					'display_condition' => 'post-format-video',
					'priority' => 'high',
					'fields' => array(
							'video_format_choose' => array(
									'title' => 'Choose Video Type',
									'type' => 'selectbox',
									'description' => ''
							),
							'video_format_link' => array(
									'title' => 'Video ID',
									'type' => 'text',
									'description' => '',
									'size' => 100
							),
							'video_format_image' => array( 
								'title' => 'Video image', 
								'type' => 'image', 
								'description' => '', 
								'size' => 100 
							), 
							'video_format_webm' => array( 
								'title' => 'Video webm', 
								'type' => 'text', 
								'description' => '', 
								'size' => 100 
							), 
							'video_format_mp4' => array( 
								'title' => 'Video mp4', 
								'type' => 'text', 
								'description' => '', 
								'size' => 100 
							), 
							'video_format_ogv' => array( 
								'title' => 'Video ogv', 
								'type' => 'text', 
								'description' => '', 
								'size' => 100 
							)  
							
					)
			),
		'audio_post_format' => array(
				'title' => 'Audio post format',
				'applicableto' => 'post',
				'location' => 'normal',
				'display_condition' => 'post-format-audio',
				'priority' => 'high',
				'fields' => array(
						'audio_link' => array(
								'title' => 'Audio Link',
								'type' => 'text',
								'description' => '',
								'size' => 100
						)

						
				)
		),			
		);
		
		function add_metaboxes() {
				global $metaboxes;
		 
				if ( ! empty( $metaboxes ) ) {
						foreach ( $metaboxes as $id => $metabox ) {
								add_meta_box( $id, $metabox['title'], 'show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
						}
				}
		}
		
		// show meta boxes
		function show_metaboxes( $post, $args ) {
			global $metaboxes;

			$custom = get_post_custom( $post->ID );
			$fields = $metaboxes[$args['id']]['fields'];

			/** Nonce **/
			$output = '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';

			if ( sizeof( $fields ) ) {
				foreach ( $fields as $id => $field ) {
					
					if(isset($custom[$id][0]) && $custom[$id][0] != ""){
						$value = $custom[$id][0];
					}else{
						$value = "";
					}
				
					switch ( $field['type'] ) {
						default:
							case "text":
								$output .= '<div class="form-field"><label for="' . $id . '"><b>' . $field['title'] . '</b></label><br/><input id="' . $id . '" type="text" name="' . $id . '" value="' . $value . '" size="' . $field['size'] . '" /></div>';
							break;
							case "image": 
								$output .= '<div class="form-field"><label for="' . $id . '"><b>' . $field['title'] . '</b></label><br/><div class="image_holder"><input id="' . $id . '" class="' . $id . '" type="text" name="' . $id . '" value="' . $value . '" size="' . $field['size'] . '" /><input class="upload_button" type="button" value="Upload file"></div></div>'; 
							break;
							case "selectbox":
								$output .= '<div class="form-field"><label for="' . $id . '"><b>' . $field['title'] . '</b></label><br/><select id="' . $id . '" name="' . $id . '">';
								$output .= '<option ';
								if ($value == "youtube") { 
								$output .= 'selected="selected"';
								}
									$output .= ' value="youtube">Youtube</option>
								<option ';
								if ($value == "vimeo") { 
									$output .= 'selected="selected"';
								}
								$output .= ' value="vimeo">Vimeo</option>
								<option '; 
								if ($value == "self") {  
									$output .= 'selected="selected"'; 
								} 
								$output .= ' value="self">Self hosted</option>  
								</select></div>';
							break;
					}
				}
			}

			echo $output;
		}
		
 
		function save_metaboxes( $post_id ) {
			global $metaboxes;
			if(isset($_POST['post_format_meta_box_nonce'])){
				$nonce = $_POST['post_format_meta_box_nonce'];
			} else {
				$nonce = wp_create_nonce( 'post_format_meta_box_nonce' );
			}
			// verify nonce
			if ( !wp_verify_nonce( $nonce, basename( __FILE__ ) ) ){
				return $post_id;
			}

			// check autosave
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
				return $post_id;
			}

			// check permissions
			if ( 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ){
					return $post_id;
				}
			} elseif (!current_user_can( 'edit_post', $post_id ) ){
				return $post_id;
			}

			$post_type = get_post_type();

			// loop through fields and save the data
			foreach ( $metaboxes as $id => $metabox ) {
				// check if metabox is applicable for current post type
				if ( $metabox['applicableto'] == $post_type ) {
					$fields = $metaboxes[$id]['fields'];

					foreach ( $fields as $id => $field ) {
						$old = get_post_meta( $post_id, $id, true );
						$new = $_POST[$id];

						if ( $new && $new != $old ) {
							update_post_meta( $post_id, $id, $new );
						}
						elseif ( '' == $new && $old || ! isset( $_POST[$id] ) ) {
							delete_post_meta( $post_id, $id, $old );
						}
					}
				}
			}
		}
		
		add_action( 'admin_print_scripts', 'display_metaboxes', 1000 );
			
		function display_metaboxes() {
    global $metaboxes;
    if ( get_post_type() == "post" ) :
        ?>
        <script type="text/javascript">// <![CDATA[
            $ = jQuery;
 
            <?php
            $formats = $ids = array();
            foreach ( $metaboxes as $id => $metabox ) {
                array_push( $formats, "'" . $metabox['display_condition'] . "': '" . $id . "'" );
                array_push( $ids, "#" . $id );
            }
            ?>
 
            var formats = { <?php echo implode( ',', $formats );?> };
            var ids = "<?php echo implode( ',', $ids ); ?>";
						
						function displayMetaboxes() {
                // Hide all post format metaboxes
                $(ids).hide();
                // Get current post format
                var selectedElt = $("input[name='post_format']:checked").attr("id");
 
                // If exists, fade in current post format metabox
                if ( formats[selectedElt] )
                    $("#" + formats[selectedElt]).fadeIn();
            }
 
            $(function() {
                // Show/hide metaboxes on page load
                displayMetaboxes();
 
                // Show/hide metaboxes on change event
                $("input[name='post_format']").change(function() {
                    displayMetaboxes();
                });
            });
 
        // ]]></script>
        <?php
    endif;
}
?>
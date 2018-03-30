<?php
add_post_type_support( 'post', array('excerpt', 'post-formats') );

$sidebars = getSidebarsList();

$meta_box_post = array(
	'id' => 'post-meta-box',
	'title' => 'Post Options',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Post Format URL',
			'desc' => '<br/>Add in this field additional data for next post formats (selected on right sidebar in field "Format"):<br/>
					<ul style="font-size:11px;">
                    <li><b>Standard</b><br />
						Leave this field empty for this post format
					</li>
					<li><b>Gallery</b><br />
						Images list (one per line) to show as gallery. For example:<br />
                        http://www.sitename.com/image1.jpg<br/>
                        http://www.sitename.com/image2.jpg<br/>
                        http://www.sitename.com/image3.jpg<br/>
                        http://www.sitename.com/image4.jpg
					</li>
					<li><b>Video</b><br />
						Video url (only one) from popular video services (Vimeo, YouTube). For example:<br />
						a. YouTube format: http://youtu.be/1iIZeIy7TqM<br />
						b. Vimeo format: http://vimeo.com/42011464<br />
						<b><i>Attention!</i></b> If you need more video in your post - please add it with shortcode [video]
					</li>
                    <li><b>Audio</b><br />
						Main Audio url (only one) from popular audio services. For example:<br />
                        http://beautymind.webglogic.com/audio/AirReview-Landmarks-02-ChasingCorporate.mp3<br />
						<b><i>Attention!</i></b> If you need more audio in your post - please add it with shortcode [audio]
					</li>
                    <li><b>Link</b><br />
						Enter url to link this post.
					</li>
					</ul>
			',
			'id' => 'custom_post_format',
			'type' => 'textarea'
		),
		array(
			'name' => 'Upload or select media',
			'desc' => '<br/>Upload or select media file via Wordpress Media Manager',
			'id' => 'custom_post_format_uploader',
			'type' => 'mediamanager'
		),
		array(
			'name' => 'Select sidebar',
			'desc' => '<br/>Select sidebar, what should be showed with this post',
			'id' => 'sidebar_current',
			'type' => 'select',
			"options" => $sidebars
		),
		array(
			'name' => 'Show sidebar',
			'desc' => '<br/>Show or hide sidebar on single page with this post.',
			'id' => 'sidebar_position',
			'type' => 'select',
			"options" => array("As in Site options|default", "Show sidebar|right", "Hide sidebar (fullwidth page)|fullwidth")
		)
	)
);
add_action('admin_menu', 'add_meta_box_post');

// Add meta box
function add_meta_box_post() {
    global $meta_box_post;
    add_meta_box($meta_box_post['id'], $meta_box_post['title'], 'show_meta_box_post', $meta_box_post['page'], $meta_box_post['context'], $meta_box_post['priority']);
}

// Callback function to show fields in meta box
function show_meta_box_post() {
    global $meta_box_post, $post;

	$upload_url = admin_url('media-upload.php');

    // Use nonce for verification
    echo '<input type="hidden" name="meta_box_post_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';

    foreach ($meta_box_post['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong></label></th>',
                '<td>';
        switch ($field['type']) {
		    case 'info':
                echo '<u>'.$field['desc'].'</u>';
				break;
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="'. $meta. '" size="30" style="width:30%" /><br />', '
', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">'. $meta . '</textarea>', '
', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
					$opt = explode('|', $option);
					if (count($opt) == 1) $opt[1] = my_strtolower($opt[0]);
                    echo '<option', $meta == $opt[1] ? ' selected="selected"' : '', ' value="' . $opt[1] . '"' , '>', $opt[0], '</option>';
                }
                echo '</select>', '
', $field['desc'];
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
				echo '
', $field['desc'];
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />', '
', $field['desc'];
                break;
            case 'file':
                echo '<input type="file" name="', $field['id'], '" id="', $field['id'], '"', $meta ? '' : '', ' />', '
', $field['desc'];
                break;
            case 'mediamanager':
                echo '
					<input type="button" id="' . $field['id'] . '" value="Media Manager" />', '
', $field['desc'], '
					<script type="text/javascript">
						var mmButtonId = "";
						jQuery(document).ready(function() {
							jQuery("#' . $field['id'] . '").on("click", function(e) {
								mmButtonId = jQuery(this).attr("id");
								tb_show("Upload image or select from existent.", "' . $upload_url . '?TB_iframe=true&tab=library&post_mime_type=image");
								e.preventDefault();
								return false;
							});
						});
						jQuery(window).load(function() {
								window.send_to_editor = function(html) {
									if (mmButtonId=="") {
										if (html.indexOf("<img") > 0 || html.indexOf("href=\\""+window.location.origin) < 0) {
											var pos = html.indexOf("href=");
											if (pos > 0) html = html.substr(0, pos) + " rel=\\"prettyPhoto\\" " + html.substr(pos);
										}
										sendToEditor(html);
									} else {
										mmButtonId = "";
										html = html.replace(/\\\'/g, \'"\');
										var obj = jQuery("img", html);
										var url = obj.length > 0 ? obj.attr("src") : "";
										if ( url == "") {
											var pos = html.indexOf("href=");
											if (pos > 0) {
												var pos2 = html.indexOf("\\"", pos+6);
												url = html.substring(pos+6, pos2);
											}
										}
										if (url == "") url = html;
										var field = jQuery("#custom_post_format").eq(0);
										var val = field.val();
										field.val((val ? val+(val.substr(-1)!="\\n" ? "\\n" : "") : "") + url);
										try { tb_remove(); } catch(e) {};
									}
								};
						});
					</script>
				';
                break;
        }
        echo     '<td>',
            '</tr>';      
    }
    
    echo '</table>';
}

add_action('save_post', 'save_meta_box_post');


// Save data from meta box
function save_meta_box_post($post_id) {
    global $meta_box_post;
    
    // verify nonce
    if (!isset($_POST['meta_box_post_nonce']) || !wp_verify_nonce($_POST['meta_box_post_nonce'], basename(__FILE__))) {
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
    } else if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    foreach ($meta_box_post['fields'] as $field) {
        $new = isset($_POST[$field['id']]) ? $_POST[$field['id']] : '';
        update_post_meta($post_id, $field['id'], $new);
    }
}
?>
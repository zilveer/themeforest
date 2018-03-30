<?php

/*************************************************************************************
 *	MetaBox Generator
 *************************************************************************************/

function om_generate_meta_box($fields) {
	global $post;

	$output='';

	$output.= '<input type="hidden" name="om_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

	$output.= '<table class="form-table">';
 
	foreach ($fields as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
	
			case 'textarea':
				$output.= '
					<tr>
						<th style="width:25%">
							<label for="'.$field['id'].'">
								<strong>'.$field['name'].'</strong>
								<div class="howto">'. $field['desc'].'</div>
							</label>
						</th>
						<td>
							<textarea name="'.$field['id'].'" id="'.$field['id'].'" rows="8" style="width:100%;">'.($meta ? $meta : stripslashes(htmlspecialchars($field['std']))).'</textarea>
						</td>
					</tr>
				';
			break;
			
			case 'text':
				$output.= '
					<tr>
						<th style="width:25%">
							<label for="'.$field['id'].'"><strong>'.$field['name'].'</strong>
							<div class="howto">'. $field['desc'].'</div>
						</th>
						<td>
							<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.($meta ? $meta : stripslashes(htmlspecialchars($field['std']))). '" style="width:75%;" />
						</td>
					</tr>
				';
			break;
			
			case 'text_browse':
				$output.= '
					<tr>
						<th style="width:25%">
							<label for="'.$field['id'].'"><strong>'.$field['name'].'</strong>
							<div class="howto">'. $field['desc'].'</div>
						</th>
						<td>
							<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.esc_attr(($meta ? $meta : $field['std'])). '" style="width:75%;" />
							<a href="#" class="button input-browse-button" rel="'.$field['id'].'"'.(@$field['library']?' data-library="'.$field['library'].'"':'').' data-choose="'.__('Choose a file','om_theme').'" data-select="'.__('Select','om_theme').'">'.__('Browse','om_theme').'</a>
						</td>
					</tr>
				';
			break;

			case 'select':
				$output.= '
					<tr>
						<th style="width:25%">
							<label for="'.$field['id'].'"><strong>'.$field['name'].'</strong>
							<div class="howto">'. $field['desc'].'</div>
						</th>
						<td>
							<select id="' . $field['id'] . '" name="'.$field['id'].'">
				';
				foreach ($field['options'] as $k=>$option) {
					$output.= '<option'.($meta == $k ? ' selected="selected"':'').' value="'. $k .'">'. $option .'</option>';
				} 
				$output.='
							</select>
						</td>
					</tr>
				';
			break;

			case 'sidebar':
				$output.= '
					<tr>
						<th style="width:25%">
							<label for="'.$field['id'].'"><strong>'.$field['name'].'</strong>
							<div class="howto">'. $field['desc'].'</div>
						</th>
						<td>
							<select name="'.$field['id'].'" id="'.$field['id'].'"/><option value="">'.__('Main Sidebar','om_theme').'</option>
				';
				$sidebars_num=intval(get_option(OM_THEME_PREFIX."sidebars_num"));
				for($i=1;$i<=$sidebars_num;$i++)
				{
					$output.='<option value="'.$i.'" '.($meta==$i?' selected="selected"':'').'>'.__('Main Alternative Sidebar','om_theme').' '.$i.'</option>';
				}
				$output .='			
							</select>
						</td>
					</tr>
				';
			break;
			
			case 'portfolio_root_cats':
				$output.= '
					<tr>
						<th style="width:25%">
							<label for="'.$field['id'].'"><strong>'.$field['name'].'</strong>
							<div class="howto">'. $field['desc'].'</div>
						</th>
						<td>
				';

					$args = array(
						'show_option_all'    => __('All Categories', 'om_theme'),
						'show_option_none'   => '',
						'hide_empty'         => 0, 
						'echo'               => 0,
						'selected'           => $meta,
						'hierarchical'       => 1, 
						'name'               => $field['id'],
						'id'         		     => $field['id'],
						'class'              => '',
						'depth'              => 1,
						'tab_index'          => 0,
						'taxonomy'           => 'portfolio-type',
						'hide_if_empty'      => false 	
					);
			
					$output .= wp_dropdown_categories( $args );

				$output .='			
						</td>
					</tr>
				';
			break;
			
			case 'homepage_root_pages':
				$output.= '
					<tr>
						<th style="width:25%">
							<label for="'.$field['id'].'"><strong>'.$field['name'].'</strong>
							<div class="howto">'. $field['desc'].'</div>
						</th>
						<td>
							<select name="'.$field['id'].'" id="'.$field['id'].'"/><option value="0">'.__('All Blocks','om_theme').'</option>
				';
				
					$pages=get_posts( array(
						'numberposts' => -1,
						'post_parent' => 0,
						'post_type' => 'homepage',
					) );
					
					foreach($pages as $v) {
						$output.='<option value="'.$v->ID.'" '.($meta==$v->ID?' selected="selected"':'').'>'.__('Child blocks of:','om_theme').' '.$v->post_title.'</option>';
					}

				$output .='		
							</select>	
						</td>
					</tr>
				';
			break;
			
			case 'gallery':
						
				if(function_exists( 'wp_enqueue_media' ))
					wp_enqueue_media();
				    
				$button_title=__('Manage Images', 'om_theme');
				if(isset($field['button_title']) && $field['button_title'])
					$button_title=$field['button_title'];
					
				$ids=explode(',',@$meta['images']);
				$images=array();
				if(!empty($ids)) {
					foreach($ids as $id) {
						$src=wp_get_attachment_image_src( $id, 'thumbnail' );
						if($src) {
							$images[]='<div class="om-item" data-attachment-id="'.$id.'"><img src="'.$src[0].'" width="'.$src[1].'" height="'.$src[2].'" /><span class="om-remove"></span></div>';
						}
					}
				}
				
				$output.= '
					<tr>
						<th style="width:25%">
							<label for="'.$field['id'].'"><strong>'.__('Choose which images you want to show in gallery', 'om_theme').'</strong>
						</th>
						<td>
							';
				if(@$field['mode'] == 'custom_gallery') {
					$output.='
							<input type="hidden" name="'.$field['id'].'[type]" id="'.$field['id'].'-type" class="om-metabox-gallery-select" data-field-id="'.$field['id'].'" value="custom" />
					';
				} else {
					$output.='
							<select name="'.$field['id'].'[type]" id="'.$field['id'].'-type" class="om-metabox-gallery-select" data-field-id="'.$field['id'].'" style="max-width:300px">
								<option value="attached">'.__('Images uploaded and attached to current post via WordPress standard Media Manager','om_theme').'</option>
								<option value="custom"'.(@$meta['type']=='custom'?' selected="selected"':'').'>'.__('Custom images set from Media Library','om_theme').'</option>
							</select>
					';
				}
				$output.='
							<input type="hidden" name="'.$field['id'].'[images]" id="'.$field['id'].'-images" value="'.(@$meta['images']).'" />
							<div class="om-metabox-gallery-attached" id="'.$field['id'].'-gallery-attached">
				';
				if(floatval(get_bloginfo('version')) >= 3.5)
					$output.='<a href="#" class="button add_media" title="'.$button_title.'" onclick="wp.media.view.settings.post.id='.($post->ID).';wp.media.view.settings.post.nonce=\''.wp_create_nonce('update-post_' . $post->ID).'\';wp.media.editor.open(\'content\');return false">'.$button_title.'</a>';
				else
					$output.='<input type="button" class="button" value="'.$button_title.'" onclick="tb_show(\'\', \'media-upload.php?post_id='.($post->ID).'&amp;type=image&amp;TB_iframe=true\');">';
				$output.='
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="om-metabox-gallery-wrapper" id="'.$field['id'].'-gallery-wrapper" data-current-page="1" data-images-input-id="'.$field['id'].'-images">
								<div class="om-metabox-gallery-images-wrapper">
									<div class="om-metabox-gallery-images-title">'.__('Chosen Images', 'om_theme').'</div>
									<div class="om-metabox-gallery-images-no-images"'.(count($images)?' style="display:none"':'').'>'.__('No images yet, choose from the images below', 'om_theme').'</div>
									<div class="om-metabox-gallery-images" data-count="'.count($images).'">'.implode('',$images).'</div>
									<div class="clear"></div>
								</div>
								<div class="om-metabox-gallery-library">
									<div class="om-metabox-gallery-library-controls"></div>
									<div class="om-metabox-gallery-library-images"></div>
									<div class="om-metabox-gallery-library-add">
									';
									if(floatval(get_bloginfo('version')) >= 3.5)
										$output.='<a href="#" class="button add_media" title="'.__('Add media','om_theme').'" onclick="wp.media.view.settings.post.id='.($post->ID).';wp.media.view.settings.post.nonce=\''.wp_create_nonce('update-post_' . $post->ID).'\';wp.media.editor.open(\'content\');return false">'.__('Add media','om_theme').'</a>';
									else
										$output.='<input type="button" class="button" value="'.__('Add media','om_theme').'" onclick="tb_show(\'\', \'media-upload.php?post_id='.($post->ID).'&amp;type=image&amp;TB_iframe=true\');">';
									$output.='
										<a href="#" class="button om-metabox-gallery-library-refresh" data-field-id="'.$field['id'].'">'.__('Refresh','om_theme').'</a>
									</div>
								</div>
							</div>
						</td>
					</tr>
				';
			break;
			
		}

	}
	$output.= '</table>';
	
	return $output;
}

/*************************************************************************************
 *	Save MetaBox data
 *************************************************************************************/

function om_save_metabox($post_id, $om_meta_box) {

 	if (!isset($_POST['om_meta_box_nonce']) || !wp_verify_nonce($_POST['om_meta_box_nonce'], basename(__FILE__))) {
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
 
 	foreach ($om_meta_box as $metabox_key=>$metabox)
 	{
		foreach ($metabox['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = @$_POST[$field['id']];
			if (($new || $new=='0') && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}
}

/*************************************************************************************
 *	Load JS Scripts and Styles
 *************************************************************************************/
 
function om_common_meta_box_scripts() {

	wp_enqueue_style('om-admin-common-meta', TEMPLATE_DIR_URI . '/admin/css/common-meta.css');

	om_enqueue_admin_browse_button();

	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('om-admin-common-meta', TEMPLATE_DIR_URI . '/admin/js/common-meta.js', array('jquery'));
}
add_action('admin_enqueue_scripts', 'om_common_meta_box_scripts');


/*************************************************************************************
 *	Handling AJAX Queries by Metabox Custom Gallery
 *************************************************************************************/
 
function om_ajax_metabox_gallery() {

	$per_page=12;
	$current_page=intval($_POST['page']);
	if(!$current_page)
		$current_page=1;

	$ret=array();
	$ret['page']=$current_page;
	
	
	$query_images = new WP_Query( array(
		'post_type' => 'attachment',
		'post_mime_type' =>'image',
		'post_status' => 'inherit',
		'posts_per_page' => $per_page,
		'paged' => $current_page,
	));
	
	$ret['max_num_pages'] = $query_images->max_num_pages;
	$ret['images'] = array();
	
	foreach ( $query_images->posts as $image ) {
		$src=wp_get_attachment_image_src( $image->ID, 'thumbnail' );
		$ret['images'][]=array(
			'ID' => $image->ID,
			'src' => $src[0],
			'width' => $src[1],
			'height' => $src[2],
		);
	}
	
	header('Content-type: application/json');
	echo json_encode($ret);
	exit;
	
}
add_action('wp_ajax_om_metabox_gallery', 'om_ajax_metabox_gallery');
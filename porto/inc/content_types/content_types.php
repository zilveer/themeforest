<?php

require_once(porto_content_types . '/post.php');
require_once(porto_content_types . '/page.php');
require_once(porto_content_types . '/product.php');
require_once(porto_content_types . '/portfolio.php');
require_once(porto_content_types . '/member.php');
require_once(porto_content_types . '/faq.php');
require_once(porto_content_types . '/block.php');

// Get Meta Tabs
function porto_get_meta_tabs($meta_fields) {
    $meta_tabs = array();
    $general_tab = array('general', __('General', 'porto'));

    foreach ($meta_fields as $meta_field) {
        $meta_tab = isset($meta_field['tab']) ? $meta_field['tab'] : '';
        if (!$meta_tab && !in_array($general_tab, $meta_tabs)) {
            $meta_tabs[] = $general_tab;
        }
        if ($meta_tab && !in_array($meta_tab, $meta_tabs)) {
            $meta_tabs[] = $meta_tab;
        }
    }

    return $meta_tabs;
}

// Show Meta Boxes
function porto_show_meta_box($meta_fields) {
    if (!isset($meta_fields) || empty($meta_fields))
        return;

    $meta_tabs = porto_get_meta_tabs($meta_fields);

    echo '<div class="postoptions porto-meta-tab clearfix">';
    if (count($meta_tabs) <= 1) {
        foreach ($meta_fields as $meta_field) {
            porto_show_meta_field($meta_field);
        }
    } else {
        echo '<ul class="resp-tabs-list">';
        foreach ($meta_tabs as $meta_tab) {
            echo '<li>' . $meta_tab[1] . '</li>';
        }
        echo '</ul>';
        echo '<div class="resp-tabs-container">';
        foreach ($meta_tabs as $meta_tab) {
            echo '<div>';
            echo '<h3>' . $meta_tab[1] . '</h3>';
            foreach ($meta_fields as $meta_field) {
                if ((!isset($meta_field['tab']) && $meta_tab[0] == 'general') || (isset($meta_field['tab']) && $meta_field['tab'][0] == $meta_tab[0]))
                    porto_show_meta_field($meta_field);
            }
            echo '</div>';
        }
        echo '</div>';
    }
    echo'</div>';
}

// Show Meta Box
function porto_show_meta_field($meta_field) {
    if ( isset( $_GET['post'] ) ) {
        $post_id = (int)( $_GET['post'] );
        $post    = get_post( $post_id );
    }
    else {
        $post = $GLOBALS['post'];
    }

    $name = $title = $desc = $type = $tab = $default = $required = $options = '';
    extract(shortcode_atts(array(
        "name" => '',
        "title" => '',
        "desc" => '',
        "type" => '',
        "tab" => '',
        "default" => '',
        "required" => '',
        "options" => ''
    ), $meta_field));

    $meta_value = get_post_meta($post->ID, $name, true);

    if ($meta_value == "")
        $meta_value = $default;

    $required_atts = array();
    if ($required) {
        $required_atts['data-required'] = $required['name'];
        $required_atts['data-value'] = $required['value'];
    }

    $required = porto_stringify_attributes( $required_atts );

    if ($type == "text") : // text ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                    <input type="text" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo stripslashes($meta_value) ?>" size="50%" />
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if ($type == "select") : // select ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                    <select name="<?php echo $name ?>" id="<?php echo $name ?>">
                        <?php if (!is_array($options) || !in_array('', array_keys($options))) : ?>
                            <option value=""><?php echo __('Select', 'porto') ?></option>
                        <?php endif; ?>
                        <?php if (is_array($options)) :
                            foreach ($options as $key => $value) : ?>
                                <option value="<?php echo $key ?>"<?php echo ($meta_value == $key ? ' selected="selected"' : '') ?>>
                                    <?php echo $value ?>
                                </option>
                            <?php endforeach;
                        endif ?>
                    </select>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if ($type == "upload") : // upload image ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                        <input value="<?php echo stripslashes($meta_value) ?>" type="text" name="<?php echo $name ?>"  id="<?php echo $name ?>" size="50%" />
                        <br/>
                        <input class="button_upload_image button" id="<?php echo $name ?>" type="button" value="<?php _e('Upload Image', 'porto') ?>" />&nbsp;
                        <input class="button_remove_image button" id="<?php echo $name ?>" type="button" value="<?php _e('Remove Image', 'porto') ?>" />
                    <?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif;

    if ($type == "attach") : // attach image ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                    <div class="attach_image" id="<?php echo $name ?>_thumb"><?php if ($meta_value) { echo wp_get_attachment_image((int)$meta_value, 'full'); } ?></div>
                    <input value="<?php echo stripslashes($meta_value) ?>" type="hidden" name="<?php echo $name ?>"  id="<?php echo $name ?>" size="50%" />
                    <br/>
                    <input class="button_attach_image button" id="<?php echo $name ?>" type="button" value="<?php _e('Attach Image', 'porto') ?>" />&nbsp;
                    <input class="button_remove_image button" id="<?php echo $name ?>" type="button" value="<?php _e('Remove Image', 'porto') ?>" />
                    <label><?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?></label>
                </div>
            </div>
        </div>
    <?php endif;

    if ($type == "editor") : // editor ?>
        <div class="metabox" <?php echo $required ?>>
            <h3 style="float:none;"><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                    <?php wp_editor( $meta_value, $name ) ?>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if ($type == "textarea") : // textarea ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option">
                    <textarea id="<?php echo $name ?>" name="<?php echo $name ?>"><?php echo $meta_value ?></textarea>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if (($type == 'radio') && (!empty($options))) : // radio buttons ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option radio">
                    <?php foreach ($options as $key => $value) : ?>
                        <input type="radio" id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>" value="<?php echo $key ?>"
                            <?php echo (isset($meta_value) && ($meta_value == $key) ? ' checked="checked"' : '') ?>/>
                        <label for="<?php echo $name ?>_<?php echo $key ?>"><?php echo $value ?></label>&nbsp;&nbsp;&nbsp;
                    <?php endforeach; ?>
                    <br>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if ($type == "checkbox") : // checkbox
        if ( $meta_value == $name ) {
            $checked = "checked=\"checked\"";
        } else {
            $checked = "";
        } ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option checkbox">
                    <label><input type="checkbox" name="<?php echo $name ?>" value="<?php echo $name ?>" <?php echo $checked ?>/> <?php echo $desc ?></label>
                </div>
            </div>
        </div>
    <?php endif;

    if (($type == 'multi_checkbox') && (!empty($options))) : // radio buttons ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option radio">
                    <?php foreach ($options as $key => $value) : ?>
                    <input type="checkbox" id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>[]" value="<?php echo $key ?>" <?php echo (isset($meta_value) && in_array($key, explode(',', $meta_value))) ? ' checked="checked"' : ''?>/><label for="<?php echo $name ?>_<?php echo $key ?>"> <?php echo $value ?> </label>&nbsp;&nbsp;&nbsp;
                    <?php endforeach; ?>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;

    if ($type == "color") : // color ?>
        <div class="metabox" <?php echo $required ?>>
            <h3><?php echo $title ?></h3>
            <div class="metainner">
                <div class="box-option porto-meta-color">
                    <input type="text" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo stripslashes($meta_value) ?>" size="50%" class="porto-color-field" />
                    <label class="porto-transparency-check" for="<?php echo $name ?>-transparency"><input type="checkbox" value="1" id="<?php echo $name ?>-transparency" class="checkbox porto-color-transparency"<?php if ($meta_value == 'transparent') echo ' checked="checked"' ?>> <?php _e('Transparent', 'porto') ?></label>
                </div>
                <div class="box-info"><label for="<?php echo $name ?>"><?php echo $desc ?></label></div>
            </div>
        </div>
    <?php endif;
}

// Save Post Data
function porto_save_meta_value($post_id, $meta_fields) {
    if (!isset($meta_fields) || empty($meta_fields))
        return;

    foreach ($meta_fields as $meta_field) {

        $name = $title = $desc = $type = $default = $options = '';
        extract(shortcode_atts(array(
            "name" => '',
            "title" => '',
            "desc" => '',
            "type" => '',
            "default" => '',
            "options" => ''
        ), $meta_field));

        if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        } else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $meta_value = get_post_meta($post_id, $name, true);

        if (!isset($_POST[$name])) {
            delete_post_meta($post_id, $name);
            continue;
        }

        $data = $_POST[$name];

        if (is_array($data))
            $data = implode(',', $data);

        if ($data) {
            update_post_meta($post_id, $name, $data);
        } elseif (!$data && $meta_value) {
            delete_post_meta($post_id, $name);
        }
    }
}

// Add Meta Fields when edit taxonomy
function porto_edit_tax_meta_fields($tag, $taxonomy, $meta_fields) {
    if (!isset($meta_fields) || empty($meta_fields))
        return;

    $meta_tabs = porto_get_meta_tabs($meta_fields);

    if (count($meta_tabs) <= 1) {
        foreach ($meta_fields as $meta_field) {
            porto_edit_tax_meta_field($tag, $taxonomy, $meta_field);
        }
    } else {
        foreach ($meta_tabs as $meta_tab) {
            porto_edit_tax_meta_tab($meta_tab);
            foreach ($meta_fields as $meta_field) {
                if ((!isset($meta_field['tab']) && $meta_tab[0] == 'general') || (isset($meta_field['tab']) && $meta_field['tab'][0] == $meta_tab[0]))
                    porto_edit_tax_meta_field($tag, $taxonomy, $meta_field);
            }
        }
    }
}

// Add Meta Tab when edit taxonomy
function porto_edit_tax_meta_tab($meta_tab) {
    $tab_key = $meta_tab[0];
    $tab_value = $meta_tab[1];
    if ($tab_key == 'general') return;
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><?php echo $tab_value ?></label></th>
        <td>
            <a class="porto-tax-meta-tab" data-tab="<?php echo esc_attr($tab_key) ?>" href="#"><?php _e('Edit', 'porto') ?></a>
        </td>
    </tr>
    <?php
}

// Add Meta Field when edit taxonomy
function porto_edit_tax_meta_field($tag, $taxonomy, $meta_field) {
    $name = $title = $desc = $type = $tab = $default = $required = $options = '';
    extract(shortcode_atts(array(
        "name" => '',
        "title" => '',
        "desc" => '',
        "type" => '',
        "tab" => '',
        "default" => '',
        "required" => '',
        "options" => ''
    ), $meta_field));

	$meta_value = get_metadata($taxonomy, $tag->term_id, $name, true);
    if ($meta_value == "")
        $meta_value = $default;

    if (is_array($tab))
        $tab = $tab[0];

    $required_atts = array();
    if ($required) {
        $required_atts['data-required'] = $required['name'];
        $required_atts['data-value'] = $required['value'];
    }

    $required = porto_stringify_attributes( $required_atts );

    if ($type == "text") : // text ?>
        <tr class="form-field<?php if ($tab) : ?> porto-tab-row" data-tab="<?php echo esc_attr($tab) ?>"<?php else: ?>"<?php endif; ?> <?php echo $required ?>>
			<th scope="row" valign="top"<?php if ($tab) : ?> class="text-right"<?php endif; ?>><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
	        <td>
		        <input type="text" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo stripslashes($meta_value) ?>" size="50%" />
				<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
			</td>
		</tr>
    <?php endif;

    if ($type == "select") : // select ?>
        <tr class="form-field<?php if ($tab) : ?> porto-tab-row" data-tab="<?php echo esc_attr($tab) ?>"<?php else: ?>"<?php endif; ?> <?php echo $required ?>>
	        <th scope="row" valign="top"<?php if ($tab) : ?> class="text-right"<?php endif; ?>><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
	        <td>
				<select name="<?php echo $name ?>" id="<?php echo $name ?>">
                    <?php if (!is_array($options) || !in_array('', array_keys($options))) : ?>
                        <option value=""><?php echo __('Select', 'porto') ?></option>
                    <?php endif; ?>
			        <?php if (is_array($options)) :
			            foreach ($options as $key => $value) : ?>
			                <option value="<?php echo $key ?>"<?php echo $meta_value == $key ? ' selected="selected"' : '' ?>><?php echo $value ?></option>
						<?php endforeach;
					endif; ?>
                </select>
				<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
			</td>
		</tr>
    <?php endif; 

    if ($type == "upload") : // upload image ?>
        <tr class="form-field<?php if ($tab) : ?> porto-tab-row" data-tab="<?php echo esc_attr($tab) ?>"<?php else: ?>"<?php endif; ?> <?php echo $required ?>>
	        <th scope="row" valign="top"<?php if ($tab) : ?> class="text-right"<?php endif; ?>><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
	        <td>
					<input style="margin-bottom:5px;" value="<?php echo stripslashes($meta_value) ?>" type="text" name="<?php echo $name ?>"  id="<?php echo $name ?>" size="50%" />
			        <br/>
					<button class="button_upload_image button" id="<?php echo $name ?>"><?php _e('Upload Image', 'porto') ?></button>
					<button class="button_remove_image button" id="<?php echo $name ?>"><?php _e('Remove Image', 'porto') ?></button>
				<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
			</td>
		</tr>
    <?php endif;

    if ($type == "attach") : // attach image ?>
        <tr class="form-field<?php if ($tab) : ?> porto-tab-row" data-tab="<?php echo esc_attr($tab) ?>"<?php else: ?>"<?php endif; ?> <?php echo $required ?>>
        <th scope="row" valign="top"<?php if ($tab) : ?> class="text-right"<?php endif; ?>><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
        <td>
            <div class="attach_image" id="<?php echo $name ?>_thumb"><?php if ($meta_value) { echo wp_get_attachment_image((int)$meta_value, 'full'); } ?></div>
            <input style="margin-bottom:5px;" value="<?php echo stripslashes($meta_value) ?>" type="hidden" name="<?php echo $name ?>"  id="<?php echo $name ?>" size="50%" />
            <br/>
            <button class="button_attach_image button" id="<?php echo $name ?>"><?php _e('Attach Image', 'porto') ?></button>
            <button class="button_remove_image button" id="<?php echo $name ?>"><?php _e('Remove Image', 'porto') ?></button>
				<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
			</td>
		</tr>
    <?php endif; 

	if ($type == "editor") : // editor ?>
        <tr class="form-field<?php if ($tab) : ?> porto-tab-row" data-tab="<?php echo esc_attr($tab) ?>"<?php else: ?>"<?php endif; ?> <?php echo $required ?>>
			<th colspan="2" scope="row" valign="top"><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
		</tr><tr <?php echo $required ?>>
			<td colspan="2">
				<?php wp_editor( $meta_value, $name ) ?>
				<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
			</td>
		</tr>
    <?php endif;

    if ($type == "textarea") : // textarea ?>
        <tr class="form-field<?php if ($tab) : ?> porto-tab-row" data-tab="<?php echo esc_attr($tab) ?>"<?php else: ?>"<?php endif; ?> <?php echo $required ?>>
            <th scope="row" valign="top"<?php if ($tab) : ?> class="text-right"<?php endif; ?>><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
            <td>
                <textarea id="<?php echo $name ?>" name="<?php echo $name ?>"><?php echo $meta_value ?></textarea>
                <?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
            </td>
        </tr>
    <?php endif;

	if (($type == 'radio') && (!empty($options))) : // radio buttons ?>
        <tr class="form-field<?php if ($tab) : ?> porto-tab-row" data-tab="<?php echo esc_attr($tab) ?>"<?php else: ?>"<?php endif; ?> <?php echo $required ?>>
	        <th scope="row" valign="top"<?php if ($tab) : ?> class="text-right"<?php endif; ?>><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
	        <td>
		        <?php foreach ($options as $key => $value) : ?>
					<input style="display:inline-block; width:auto;" type="radio" id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>"  value="<?php echo $key ?>"
						<?php echo (isset($meta_value) && ($meta_value == $key) ? ' checked="checked"' : '') ?>/>
					<label for="<?php echo $name ?>_<?php echo $key ?>"><?php echo $value ?></label>&nbsp;&nbsp;&nbsp;
				<?php endforeach; ?>
        		<?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
			</td>
		</tr>
    <?php endif; 

    if ($type == "checkbox") :  // checkbox ?>
        <?php if ( $meta_value == $name ) {
            $checked = "checked=\"checked\"";
        } else {
            $checked = "";
        } ?>
        <tr class="form-field<?php if ($tab) : ?> porto-tab-row" data-tab="<?php echo esc_attr($tab) ?>"<?php else: ?>"<?php endif; ?> <?php echo $required ?>>
	        <th scope="row" valign="top"<?php if ($tab) : ?> class="text-right"<?php endif; ?>><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
			<td>
		        <label><input style="display:inline-block; width:auto;" type="checkbox" name="<?php echo $name ?>" value="<?php echo $name ?>" <?php echo $checked ?> /> <?php echo $desc ?></label>
			</td>
		</tr>
    <?php endif;

    if (($type == 'multi_checkbox') && (!empty($options))) : // radio buttons ?>
        <tr class="form-field<?php if ($tab) : ?> porto-tab-row" data-tab="<?php echo esc_attr($tab) ?>"<?php else: ?>"<?php endif; ?> <?php echo $required ?>>
	        <th scope="row" valign="top"<?php if ($tab) : ?> class="text-right"<?php endif; ?>><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
			<td>
				<?php foreach ($options as $key => $value) : ?>
					<input style="display:inline-block; width:auto;" type="checkbox" id="<?php echo $name ?>_<?php echo $key ?>" name="<?php echo $name ?>[]" value="<?php echo $key ?>" <?php echo ((isset($meta_value) && in_array($key, explode(',', $meta_value))) ? ' checked="checked"' : '') ?>/>
					<label for="<?php echo $name ?>_<?php echo $key ?>"> <?php echo $value ?></label>&nbsp;&nbsp;&nbsp;
				<?php endforeach; ?>
		        <?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
			</td>
		</tr>
    <?php endif;

    if ($type == "color") : // color ?>
        <tr class="form-field<?php if ($tab) : ?> porto-tab-row" data-tab="<?php echo esc_attr($tab) ?>"<?php else: ?>"<?php endif; ?> <?php echo $required ?>>
            <th scope="row" valign="top"<?php if ($tab) : ?> class="text-right"<?php endif; ?>><label for="<?php echo $name ?>"><?php echo $title ?></label></th>
            <td class="porto-meta-color">
                <input type="text" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo stripslashes($meta_value) ?>" size="50%" class="porto-color-field" />
                <label class="porto-transparency-check" for="<?php echo $name ?>-transparency"><input type="checkbox" value="1" id="<?php echo $name ?>-transparency" class="checkbox porto-color-transparency"<?php if ($meta_value == 'transparent') echo ' checked="checked"' ?>> <?php _e('Transparent', 'porto') ?></label>
                <?php if ($desc) : ?><p class="description"><?php echo $desc ?></p><?php endif; ?>
            </td>
        </tr>
    <?php endif;
}

// Save Taxonomy Meta Values
function porto_save_tax_meta_values( $term_id, $taxonomy, $meta_fields ) {
    if (!isset($meta_fields) || empty($meta_fields))
        return;

    foreach ($meta_fields as $meta_field) {

        $name = $title = $desc = $type = $tab = $default = $options = '';
        extract(shortcode_atts(array(
            "name" => '',
            "title" => '',
            "desc" => '',
            "type" => '',
            "tab" => '',
            "default" => '',
            "options" => ''
        ), $meta_field));

        $meta_value = get_metadata($taxonomy, $term_id, $name, true);

        if (!isset($_POST[$name])) {
            delete_metadata($taxonomy, $term_id, $name);
            continue;
        }

        $data = $_POST[$name];

        if (is_array($data))
            $data = implode(',', $data);

        if ($data) {
            update_metadata($taxonomy, $term_id, $name, $data);
        } elseif (!$data && $meta_value) {
            delete_metadata($taxonomy, $term_id, $name);
        }
    }
}

// Delete Taxonomy Meta Values
function porto_delete_tax_meta_values( $term_id, $taxonomy, $meta_fields ) {
    if (!isset($meta_fields) || empty($meta_fields))
        return;

    foreach ($meta_fields as $meta_field) {

        $name = $title = $desc = $type = $tab = $default = $options = '';
        extract(shortcode_atts(array(
            "name" => '',
            "title" => '',
            "desc" => '',
            "type" => '',
            "tab" => '',
            "default" => '',
            "options" => ''
        ), $meta_field));

        delete_metadata($taxonomy, $term_id, $name);
    }
}

// Create Taxonomy Meta Table
function porto_create_tax_meta_table($taxonomy) {
    global $wpdb;

    $table_name = $wpdb->prefix . $taxonomy . 'meta';

    if (get_option('porto_created_table_' . $taxonomy, false) == false) {
        if (!empty ($wpdb->charset))
            $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
        if (!empty ($wpdb->collate))
            $charset_collate .= " COLLATE {$wpdb->collate}";

        if (!$wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
            $sql = "CREATE TABLE {$table_name} (
            meta_id bigint(20) NOT NULL AUTO_INCREMENT,
            {$taxonomy}_id bigint(20) NOT NULL default 0,
            meta_key varchar(255) DEFAULT NULL,
            meta_value longtext DEFAULT NULL,
            UNIQUE KEY meta_id (meta_id)
        ) {$charset_collate};";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }

        update_option('porto_created_table_' . $taxonomy, true);
    }
}

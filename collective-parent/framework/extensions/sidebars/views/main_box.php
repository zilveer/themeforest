<?php
$saved_names = array();
?>
<div id="tfuse_fields" class="sidebar_main_box widgets-holder-wrap inactive-sidebar">
    <div class="sidebar-name">
        <div class="sidebar-name-arrow"><br></div>
        <h3>
            <?php _e('Sidebar Placeholders', 'tfuse'); ?>
        </h3>
    </div>
    <div class="widget-holder inactive">
        <div id="tf_sidebar_extra_settings">
            <div class="tf_meta_tabs">
                <ul>
                    <li>
                        <a href="#tfusetab-sidebar_new_settings"><?php _e('Add Sidebar', 'tfuse'); ?></a>
                    </li>
                    <li>
                        <a href="#tfusetab-sidebar_manage_settings">
                            <?php _e('Manage Sidebars', 'tfuse'); ?>
                        </a>
                    </li>
                </ul>
                <div id="tfusetab-sidebar_new_settings">
                    <!--start-->
                    <?php echo $this->optigen->_auto($_inc_['type_opts']); ?>
                    <?php echo $this->optigen->_auto($_inc_['subtype_opts']); ?>
                    <?php
                    echo $this->optigen->_auto($_inc_['multi_opts']);
                    for ($i = 1; $i <= $max_placeholders; $i++) {
                        $opt = array(
                            'name' => '',
                            'desc' => '',
                            'value' => -1,
                            'type' => 'images'
                        );
                        if (!isset($sidebars_positions[$i]))
                            continue;
                        $opt = array_merge($opt, $sidebars_positions[$i]);
                        $opt_cont = $_inc_['sidebars_positions'];
                        $opt_cont['id'] = 'sidebars_positions_' . $i;
                        $opt_cont['contents'] = $this->optigen->_auto($opt);
                        echo $this->optigen->_auto($opt_cont);
                    }
                    ?>
                    <?php
                    for ($i = 1; $i <= $max_placeholders; $i++) {
                        $opt = $_inc_['sidebars_placeholders'];
                        $opt['placeholders'] = $i;
                        $opt['id'] .= '_' . $i;
                        echo $this->optigen->_auto($opt);
                    }
                    ?>
                    <div id="sidebar_action_buttons">
                        <a id="sidebars_add_sidebar" href="#" class="button"><?php _e('Add Sidebar', 'tfuse'); ?></a>
                        <a id="sidebars_cancel_changes" href="#" class="button reset-button"><?php _e('Cancel Changes', 'tfuse'); ?></a>
                    </div>
                    <!--end-->                        
                </div>
                <div id="tfusetab-sidebar_manage_settings">
                    <?php
                    $settings = $this->ext->sidebars->model->tf_get_settings();
                    ?>
                    <table class="sdb_ph_table">
                        <thead>
                            <tr>
                                <th class="first_th">
                                    <?php _e('Sidebars for', 'tfuse'); ?>
                                </th>
                                <th>
                                    <?php _e('Default', 'tfuse'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <?php
                                $rel = 'is_default+default_is_default';
                                ?>
                                <a rel="<?php echo $rel; ?>" href="#" class="auto_select"><?php _e('Default for all', 'tfuse'); ?></a>
                            </td>
                            <td>
                                <?php
                                $bool = isset($settings['default_is_default']);
                                echo tf_show_icon($bool);
                                ?>
                                <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $rel = 'post+default_post';
                                ?>
                                <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('Posts', 'tfuse'); ?></a>
                            </td>
                            <td>
                                <?php
                                $bool = isset($settings['default_post']);
                                echo tf_show_icon($bool);
                                ?>
                                <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                            </td>
                        </tr>

                        <?php
                        $bool = isset($settings['by_category_post']);
                        if ($bool) {
                            foreach ($settings['by_category_post'] as $id => $val) {
                                ?>
                                <tr>
                                    <td class="padd-left" colspan="2">
                                        <div class="corner_sdb"></div>
                                        <?php
                                        $rel = 'post+by_category_post+' . $id;
                                        ?>
                                        <img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" />
                                        <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('By Category:', 'tfuse'); ?></a>
                                        <?php
                                        $ids = explode(',', $id);
                                        $out = '';
                                        foreach ($ids as $id) {
                                            $term = get_term_by('id', $id, 'category');
                                            $out.=$term->name . ', ';
                                            $saved_names[$rel][$id] = $term->name;
                                        }
                                        echo rtrim($out, ' ,');
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php
                        $bool = isset($settings['by_id_post']);
                        if ($bool) {
                            foreach ($settings['by_id_post'] as $id => $val) {
                                ?>
                                <tr>
                                    <td class="padd-left" colspan="2">
                                        <div class="corner_sdb"></div>
                                        <?php
                                        $rel = 'post+by_id_post+' . $id;
                                        ?>
                                        <img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" />
                                        <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('By Name', 'tfuse'); ?>:</a>
                                        <?php
                                        $ids = explode(',', $id);
                                        $out = '';
                                        foreach ($ids as $id) {
                                            $post_curr = get_post($id);
                                            $out.=$post_curr->post_title . ', ';
                                            $saved_names[$rel][$id] = $post_curr->post_title;
                                        }
                                        echo rtrim($out, ' ,');
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <tr>
                            <td>
                                <?php
                                $rel = 'page+default_page';
                                ?>
                                <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('Pages', 'tfuse'); ?></a>
                            </td>
                            <td>
                                <?php
                                $bool = isset($settings['default_page']);
                                echo tf_show_icon($bool);
                                ?>
                                <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                            </td>
                        </tr>

                        <?php
                        $bool = isset($settings['by_template_page']);
                        $page_templates_arr = tf_get_templates();
                        if ($bool) {
                            foreach ($settings['by_template_page'] as $id => $val) {
                                ?>
                                <tr>
                                    <td class="padd-left" colspan="2">
                                        <div class="corner_sdb"></div>
                                        <?php
                                        $rel = 'page+by_template_page+' . $id;
                                        ?>
                                        <img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" />
                                        <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('By Page Template', 'tfuse'); ?>:</a>
                                        <?php
                                        $ids = explode(',', $id);
                                        echo $page_templates_arr[$id];
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php
                        $bool = isset($settings['by_id_page']);
                        if ($bool) {
                            foreach ($settings['by_id_page'] as $id => $val) {
                                ?>
                                <tr>
                                    <td class="padd-left" colspan="2">
                                        <div class="corner_sdb"></div>
                                        <?php
                                        $rel = 'page+by_id_page+' . $id;
                                        ?>
                                        <img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" />
                                        <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('By Name', 'tfuse'); ?>:</a>
                                        <?php
                                        $ids = explode(',', $id);
                                        $out = '';
                                        foreach ($ids as $id) {
                                            if( null === ( $page = get_page($id) ) )
                                                $page = (object)array('post_title'=>'[noPostId='.$id.']');
                                            $out.=$page->post_title . ', ';
                                            $saved_names[$rel][$id] = $page->post_title;
                                        }
                                        echo rtrim($out, ' ,');
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>


                        <?php
                        $tf_post_types = apply_filters('tfuse_sidebar_posts', tf_get_post_types());
                        foreach ($tf_post_types as $key => $name) {
                            $taxonomy = tf_custom_post_category($key);
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $rel = $key . '+default_' . $key;
                                    ?>
                                    <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php echo ucfirst($name); ?></a>
                                </td>
                                <td>

                                    <?php
                                    $bool = isset($settings['default_' . $key]);
                                    echo tf_show_icon($bool);
                                    ?>
                                    <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                                </td>
                            </tr>

                            <?php
                            $bool = isset($settings['by_category_' . $key]);
                            if ($bool && $taxonomy) {
                                foreach ($settings['by_category_' . $key] as $id => $val) {
                                    ?>
                                    <tr>
                                        <td class="padd-left" colspan="2">
                                            <div class="corner_sdb"></div>
                                            <?php
                                            $rel = $key . '+by_category_' . $key . '+' . $id;
                                            ?>
                                            <img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" />
                                            <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('By', 'tfuse'); ?> <?php echo ucfirst($taxonomy); ?>:</a>
                                            <?php
                                            $ids = explode(',', $id);
                                            $out = '';
                                            foreach ($ids as $id) {
                                                $term = get_term_by('id', $id, $taxonomy);
                                                $out.=$term->name . ', ';
                                                $saved_names[$rel][$id] = $term->name;
                                            }
                                            echo rtrim($out, ' ,');
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            <?php
                            $bool = isset($settings['by_id_' . $key]);
                            if ($bool) {
                                foreach ($settings['by_id_' . $key] as $id => $val) {
                                    ?>
                                    <tr>
                                        <td class="padd-left" colspan="2">
                                            <div class="corner_sdb"></div>
                                            <?php
                                            $rel = $key . '+by_id_' . $key . '+' . $id;
                                            ?>
                                            <img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" />
                                            <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('By Name', 'tfuse'); ?>:</a>
                                            <?php
                                            $ids = explode(',', $id);
                                            $out = '';
                                            foreach ($ids as $id) {
                                                $post_curr = get_post($id);
                                                $out.=$post_curr->post_title . ', ';
                                                $saved_names[$rel][$id] = $post_curr->post_title;
                                            }
                                            echo rtrim($out, ' ,');
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>                                
                        <?php } ?>

                        <tr>
                            <td>
                                <?php
                                $rel = 'category+default_category';
                                ?>
                                <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('Categories', 'tfuse'); ?></a>
                            </td>
                            <td>
                                <?php
                                $bool = isset($settings['default_category']);
                                echo tf_show_icon($bool);
                                ?>
                                <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                            </td>
                        </tr>

                        <?php
                        $bool = isset($settings['by_id_category']);
                        if ($bool) {
                            foreach ($settings['by_id_category'] as $id => $val) {
                                ?>
                                <tr>
                                    <td class="padd-left" colspan="2">
                                        <div class="corner_sdb"></div>
                                        <?php
                                        $rel = 'category+by_id_category+' . $id;
                                        ?>
                                        <img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" />
                                        <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('By Name', 'tfuse'); ?>:</a>
                                        <?php
                                        $ids = explode(',', $id);
                                        $out = '';
                                        foreach ($ids as $id) {
                                            $term = get_term_by('id', $id, 'category');
                                            $out.=$term->name . ', ';
                                            $saved_names[$rel][$id] = $term->name;
                                        }
                                        echo rtrim($out, ' ,');
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php
                        $tf_taxonomies = apply_filters('tfuse_sidebar_taxonomies', tf_get_taxonomies());
                        foreach ($tf_taxonomies as $key => $name) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $rel = $key . '+default_' . $key;
                                    ?>
                                    <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php echo ucfirst($name); ?></a>
                                </td>
                                <td>
                                    <?php
                                    $bool = isset($settings['default_' . $key]);
                                    echo tf_show_icon($bool);
                                    ?>
                                    <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                                </td>
                            </tr>

                            <?php
                            $bool = isset($settings['by_id_' . $key]);
                            if ($bool) {
                                foreach ($settings['by_id_' . $key] as $id => $val) {
                                    ?>
                                    <tr>
                                        <td class="padd-left" colspan="2">
                                            <div class="corner_sdb"></div>
                                            <?php
                                            $rel = $key . '+by_id_' . $key . '+' . $id;
                                            ?>
                                            <img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" />
                                            <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('By Name', 'tfuse'); ?>:</a>
                                            <?php
                                            $ids = explode(',', $id);
                                            $out = '';
                                            foreach ($ids as $id) {
                                                $term = get_term_by('id', $id, $key);
                                                $out.=$term->name . ', ';
                                                $saved_names[$rel][$id] = $term->name;
                                            }
                                            echo rtrim($out, ' ,');
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            <?php
                        }
                        ?>

                        <tr>
                            <td>
                                <?php
                                $rel = 'is_archive+default_is_archive';
                                ?>
                                <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('Archive pages', 'tfuse'); ?></a>
                            </td>
                            <td>
                                <?php
                                $bool = isset($settings['default_is_archive']);
                                echo tf_show_icon($bool);
                                ?>
                                <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?php
                                $rel = 'is_front_page+default_is_front_page';
                                ?>
                                <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('Front page', 'tfuse'); ?></a>
                            </td>
                            <td>
                                <?php
                                $bool = isset($settings['default_is_front_page']);
                                echo tf_show_icon($bool);
                                ?>
                                <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?php
                                $rel = 'is_search+default_is_search';
                                ?>
                                <a href="#" rel="<?php echo $rel; ?>" class="auto_select"<?php _e('>Search page', 'tfuse'); ?></a>
                            </td>
                            <td>

                                <?php
                                $bool = isset($settings['default_is_search']);
                                echo tf_show_icon($bool);
                                ?>
                                <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?php
                                $rel = 'is_blogpage+default_is_blogpage';
                                ?>
                                <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('Blog Page', 'tfuse'); ?></a>
                            </td>
                            <td>

                                <?php
                                $bool = isset($settings['default_is_blogpage']);
                                echo tf_show_icon($bool);
                                ?>
                                <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?php
                                $rel = 'is_404+default_is_404';
                                ?>
                                <a href="#" rel="<?php echo $rel; ?>" class="auto_select"><?php _e('404 error page', 'tfuse'); ?></a>
                            </td>
                            <td>

                                <?php
                                $bool = isset($settings['default_is_404']);
                                echo tf_show_icon($bool);
                                ?>
                                <?php if ($bool) { ?><img class="sidebar_settings_delete" rel="<?php echo $rel; ?>" src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /><?php } ?>
                            </td>
                        </tr>
                    </table>
                    <div class="explain_icons">
                        <img src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'sidebar_set.png'); ?>" /> <?php _e('Was set', 'tfuse'); ?>&nbsp;
                        <img src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'delete.png'); ?>" /> <?php _e('Remove settings', 'tfuse'); ?>&nbsp;
                        <img src="<?php echo tf_extimage($this->ext->sidebars->_the_class_name, 'sidebar_not_set.png'); ?>" /> S<?php _e('idebar not set yet', 'tfuse'); ?>
                    </div>
                    <div style="clear:both"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->include->js_enq('sidebars_saved_names', $saved_names);
?>
<?php

/**
 * This class loads all the methods and helpers specific to build a meta box.
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
if (!class_exists('jwMetabox')) {

    class jwMetabox {
        /* variable to store the meta box array */

        private $meta_box;

        /**
         * PHP5 constructor method.
         *
         * This method adds other methods of the class to specific hooks within WordPress.
         * 
         * @uses      add_action()
         *
         * @return    void
         *
         * @access    public
         * @since     1.0
         */
        function __construct($meta_box) {
            if (!is_admin())
                return;

            $this->meta_box = $meta_box;
            add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
            add_action('save_post', array(&$this, 'save_meta_box'), 1, 2);
        }

        /**
         * id ,title,array(pages),
         */

        /**
         * Adds meta box to any post type
         *
         * @uses      add_meta_box()
         *
         * @return    void
         *
         * @access    public
         * @since     1.0
         */
        function add_meta_boxes() {
            foreach ((array) $this->meta_box['pages'] as $page) {
                //add_meta_box( $id,               $title,                  $callback,                       $post_type,$context,                $priority,              $callback_args );
                add_meta_box($this->meta_box['id'], $this->meta_box['title'], array(&$this, 'build_meta_box'), $page, $this->meta_box['context'], $this->meta_box['priority']);
            }
        }

        /**
         * Meta box view
         *
         * @return    string
         *
         * @access    public
         * @since     1.0
         */
        function build_meta_box($post, $metabox) {
            $outputs = $menu = $defaults = '';
            if (isset($this->meta_box['js']) && !empty($this->meta_box['js'])) {
                echo '<script type="text/javascript">';
                echo $this->meta_box['js'];
                echo '</script>';
            }
            echo '<div class="ot-metabox-wrapper" ';
            if (isset($this->meta_box['type']) && $this->meta_box['type'] == 'page_builder') {
                echo ' id="jaw_builder" ng-controller="builder"> ';
            } else {
                echo ' id="jaw_metabox" ng-controller="adminPage"> ';
            }
            /* Use nonce for verification */
            echo '<input type="hidden" name="' . $this->meta_box['id'] . '_nonce" value="' . wp_create_nonce($this->meta_box['id']) . '" />';

            /* meta box description */
            echo isset($this->meta_box['desc']) ? '<div class="description" style="padding-top:10px;">' . htmlspecialchars_decode($this->meta_box['desc']) . '</div>' : '';


            /* get the option HTML */
            /*
             * ID v metaboxes [fields] musí být s podtržítkem na začátku
             */
            $revo_live = '';
            foreach ($this->meta_box['fields'] as $filed) {
                $data = get_post_meta($post->ID, $filed['id'], true);
                if ($data == '')
                    $data = null;
                if (isset($filed['template']) && $filed['template'] == 'true') {
                    $layout = 'template';
                } else if (isset($filed['type']) && ($filed['type'] == 'builder' || $filed['type'] == 'builder_dropdown')) {
                    $layout = 'builder';
                } else {
                    $layout = 'metabox';
                }
                if (isset($filed['row']) && $filed['row'] == '0') {
                    $revo_live .= jwElements::elements_machine($filed, $data, $layout);
                } else {
                    $outputs.= jwElements::elements_machine($filed, $data, $layout);
                }
            }
            if (isset($this->meta_box['type']) && $this->meta_box['type'] == 'page_builder') {
                echo '<div class="revo-live" >';
                echo $revo_live;
                echo jwUtils::getHelp("3_1");
                echo '<input type="text" placeholder="Search ..." class="builder-search" ng-model="searchText" ng-change="changeSearch()"/>';
                echo '<div class="clear"></div>';
                echo '</div>';

                echo '<div class="revo-bookmarks" >';
                echo $outputs;
                echo '<div class="clear"></div>';
                echo '</div>';

                echo '<div class="section-ribbon-items"  ><ul class="elements_list" ng-include src="current.bookmark"></ul></div>';
                echo '<center>';
                echo '<div class="jaw-pb-backgroud" >';
                echo '<div class="jaw-pb" >';

                echo '<div id="section-jaw-pb-sidebar_left1" class="s_{{layout.left1.size}} jaw-pb-sidebar"  ng-show="layout.left1.visible">';
                echo '    <div class="sidebar">';
                echo '    <div class="tools">';
                echo '    <div class="controls">';
                echo '        <div class="minus" ng-click="resize_sidebar(\'left1\',false)"><i class="icon-arrow-left13"></i></div>';
                echo '        <div class="text" >size</div>';
                echo '        <div class="plus" ng-click="resize_sidebar(\'left1\',true)"><i class="icon-arrow-right14"></i></div>';
                echo '    </div>';
                echo '    <div class="edit controls">';
                echo '        <div class="live control_btn" title="Show live preview of this element" ng-click="control_live_sidebar(\'left1\')"><i class="icon-eye"></i></div>';
                echo '        <div class="edit control_btn" title="Show settings of this sidebar" ng-click="control_edit(layout[\'left1\'])"><i class="icon-wrench"></i></div>';
                echo '    </div>';
                echo '    </div>';
                echo '    <div class="zaves"></div>';
                echo '<div class="builder_sidebar_content"></div>';
                echo '    </div>';
                //nahradit timhle: echo '<div ng-include src="\'section-build_re_sidebar_left1\'"></div>';


                echo '</div>';
                echo '<div id="section-jaw-pb-sidebar_left2" class="s_{{layout.left2.size}} jaw-pb-sidebar" ng-show="layout.left2.visible">';
                echo '    <div class="sidebar">';
                echo '    <div class="tools">';
                echo '    <div class="controls">';
                echo '        <div class="minus" ng-click="resize_sidebar(\'left2\',false)"><i class="icon-arrow-left13"></i></div>';
                echo '        <div class="text" >size</div>';
                echo '        <div class="plus" ng-click="resize_sidebar(\'left2\',true)"><i class="icon-arrow-right14"></i></div>';
                echo '    </div>';
                echo '    <div class="edit controls">';
                echo '        <div class="live control_btn" title="Show live preview of this element" ng-click="control_live_sidebar(\'left2\')"><i class="icon-eye"></i></div>';
                echo '        <div class="edit control_btn" title="Show settings of this sidebar" ng-click="control_edit(layout[\'left2\'])"><i class="icon-wrench"></i></div>';
                echo '    </div>';
                echo '    </div>';
                echo '    <div class="zaves"></div>';
                echo '<div class="builder_sidebar_content"></div>';
                echo '    </div>';
                //echo '<div ng-include src="\'section-build_re_sidebar_left2\'"></div>';



                echo '</div>';
                echo '<div id="section-jaw-pb-sidebar_right1" class="s_{{layout.right1.size}} jaw-pb-sidebar" ng-show="layout.right1.visible">';
                echo '    <div class="sidebar">';
                echo '    <div class="tools">';
                echo '    <div class="controls">';
                echo '        <div class="minus" ng-click="resize_sidebar(\'right1\',true)"><i class="icon-arrow-left13"></i></div>';
                echo '        <div class="text" >size</div>';
                echo '        <div class="plus" ng-click="resize_sidebar(\'right1\',false)"><i class="icon-arrow-right14"></i></div>';
                echo '    </div>';
                echo '    <div class="edit controls">';
                echo '        <div class="live control_btn" title="Show live preview of this element" ng-click="control_live_sidebar(\'right1\')"><i class="icon-eye"></i></div>';
                echo '        <div class="edit control_btn" title="Show settings of this sidebar" ng-click="control_edit(layout[\'right1\'])"><i class="icon-wrench"></i></div>';
                echo '    </div>';
                echo '    </div>';
                echo '    <div class="zaves"></div>';
                echo '<div class="builder_sidebar_content"></div>';
                echo '    </div>';
                //echo '<div ng-include src="\'section-build_re_sidebar_right1\'"></div>';


                echo '</div>';
                echo '<div id="section-jaw-pb-sidebar_right2" class="s_{{layout.right2.size}} jaw-pb-sidebar" ng-show="layout.right2.visible">';
                echo '    <div class="sidebar">';
                echo '    <div class="tools">';
                echo '    <div class="controls">';
                echo '        <div class="minus" ng-click="resize_sidebar(\'right2\',true)"><i class="icon-arrow-left13"></i></div>';
                echo '        <div class="text" >size</div>';
                echo '        <div class="plus" ng-click="resize_sidebar(\'right2\',false)"><i class="icon-arrow-right14"></i></div>';
                echo '    </div>';
                echo '    <div class="edit controls">';
                echo '        <div class="live control_btn" title="Show live preview of this element" ng-click="control_live_sidebar(\'right2\')"><i class="icon-eye"></i></div>';
                echo '        <div class="edit control_btn" title="Show settings of this sidebar" ng-click="control_edit(layout[\'right2\'])"><i class="icon-wrench"></i></div>';
                echo '    </div>';
                echo '    </div>';
                echo '    <div class="zaves"></div>';
                echo '<div class="builder_sidebar_content"></div>';
                echo '    </div>';
                //echo '<div ng-include src="\'section-build_re_sidebar_right2\'"></div>';


                echo '</div>';
                echo '<div class="jaw-metabox-workspace" ui-sortable="sortableOptions" ng-model="workspace">';
                echo '<div id="item-{{entity.id}}" class="builder-element s_{{entity.size}} jb-{{entity.name}}" ng-repeat="(i,entity) in workspace track by i" ng-include src="\'temp-build_build_enitiy\'"></div>'; //\'+entity.name
                echo '<div class="clear"></div>';
                echo '</div>';
                echo '</div>';
                echo '<input type="hidden" name="jaw_pb" value="{{workspace}}"  ng-model="workspace" />';
                echo '<input type="hidden" name="jaw_pb_startup" class="jaw_pb_startup"  value="' . get_post_meta($post->ID, 'jaw_pb_startup', true) . '" />';
                echo '<input type="hidden" name="jaw_pb_layout" value="{{layout}}"  ng-model="layout"  >';
                $unserialized_presets = maybe_unserialize(jwOpt::get_options('builder'));
                if (!$unserialized_presets || !is_array($unserialized_presets)) {
                    $pressets = null;
                } else {
                    $pressets = $unserialized_presets;
                }
                $unserialized_elements_pressets = maybe_unserialize(jwOpt::get_options('builder_element'));
                if (!$unserialized_elements_pressets || !is_array($unserialized_elements_pressets)) {
                    $elements_pressets = null;
                } else {
                    $elements_pressets = $unserialized_elements_pressets;
                }

                echo '<span ng-init=\'init_presets();init_element_presets();\'></span>';

                echo '</div>';
                echo '</center>';

                $jaw_pb = maybe_unserialize(get_post_meta($post->ID, 'jaw_pb', true));
                $jaw_pb_layout = maybe_unserialize(get_post_meta($post->ID, 'jaw_pb_layout', true));
                if (!$jaw_pb || !is_array($jaw_pb)) {
                    $jaw_pb = null;
                }
                if (!$jaw_pb_layout) {
                    $jaw_pb_layout = null;
                }
                echo '<script>';
                echo 'var jaw_pb = ' . json_encode($jaw_pb) . ';';
                echo 'var jaw_pb_layout = ' . json_encode($jaw_pb_layout) . ';';
                echo 'var template_url = "' . THEME_FRAMEWORK_URI . '";';
                echo 'var jaw_presets = ' . json_encode($pressets) . ';';
                echo 'var jaw_presets_elements = ' . json_encode($elements_pressets) . ';';
                echo '</script>';

                echo '<script id="temp-build_build_enitiy" type="text/ng-template">';
                echo ' <div class="element" >';
                echo ' <li class="element_block" >';
                echo '    <div class="tools">';
                echo '    <div class="controls size">';

                echo '        <div class="minus" ng-click="change_size(entity,false)"><i class="icon-arrow-left13"></i></div>';
                echo '        <div class="text" >size</div>';
                echo '        <div class="plus" ng-click="change_size(entity,true)"><i class="icon-arrow-right14"></i></div>';

                echo '    </div>';
                echo '    <div class="edit controls">';
                echo '        <div class="delete control_btn" title="Delete this element"  ng-click="control_delete(entity)"><i class="icon-cancel-circle2 "></i></div>';
                echo '        <div class="add_element_preset control_btn" title="Save this element as preset" ng-click="add_element_preset(entity)"><i class="icon-disk"></i></div>';
                echo '        <div class="clone control_btn" title="Clone this element" ng-click="control_clone(entity)"><i class="icon-copy"></i></div>';
                echo '        <div class="live control_btn" title="Show live preview of this element" ng-click="control_live(entity)"><i class="icon-eye"></i></div>';
                echo '        <div class="edit control_btn" title="Edit settings of this element" ng-click="control_edit(entity)"><i class="icon-wrench "></i></div>';
                echo '    </div>';

                echo '    <div class="info controls">';
                echo '        <i class="{{entity.icon}}"></i>';
                echo '        <h5 class="pb_element_name">{{replace_special_char(entity.name)}}</h5>';
                echo '        <input class="pb_element_change"  type="text"  ng-model="entity.title">';
                echo '    </div>';
                echo '    </div>';
                echo '    <div class="zaves"></div>';
                echo '    <div class="symbol_block">';
                echo '        <div class="builder_element_content"></div>';
                echo '    </div>';

                echo '</li>';
                echo '    </div>';
                echo '</script>';



                echo '<div class="jaw-builder-description" >';
                echo '<div class="jaw-builder-name" ><strong>{{description.name}}</strong></div>';
                echo '<div class="jaw-builder-desc" >{{description.desc}}</div>';
                echo '<img ng-src="{{description.img}}" ng-show="description.img" />';
                echo '</div>';

                echo '<div class="jaw-builder-background loading">Loading... <br> <p>Warning: Live preview may slow down work with the page builder.</p><div class="loader">
   <div class="circle"></div>
   <div class="circle"></div>
   <div class="circle"></div>
   <div class="circle"></div>
   <div class="circle"></div>
</div></div>';
                echo '<div class="jaw-builder-background edit" style="display:none;"></div>';
                echo '<div class="builder_editor" ></div>';
            } else {
                echo '<div class="metaboxes" >';
                echo $outputs;
                echo '<div class="clear"></div>';
                echo '</div>';
            }
            echo '<div class="clear"></div>';
            echo '</div>';
        }

        /**
         * Saves the meta box values
         *
         * @return    void
         *
         * @access    public
         * @since     1.0
         */
        function save_meta_box($post_id, $post_object) {

            global $pagenow;

            /* don't save during quick edit */
            if ($pagenow == 'admin-ajax.php')
                return $post_id;

            /* don't save during autosave */
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $post_id;

            if (empty($_POST)) {
                return $post_id;
            }

            /* don't save if viewing a revision */
            if (isset($post_object->post_type) && $post_object->post_type == 'revision')
                return $post_id;

            /* verify nonce */
            if (isset($_POST[$this->meta_box['id'] . '_nonce']) && !wp_verify_nonce($_POST[$this->meta_box['id'] . '_nonce'], $this->meta_box['id']))
                return $post_id;

            /* check permissions */
            if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
                if (!current_user_can('edit_page', $post_id))
                    return $post_id;
            } else {
                if (!current_user_can('edit_post', $post_id))
                    return $post_id;
            }

            foreach ($this->meta_box['fields'] as $field) {

                $old = get_post_meta($post_id, $field['id'], true);
                $new = '';

                /* there is data to validate */
                if (isset($_POST[$field['id']])) {
                    /* set up new data with validated data */
                    $new = $_POST[$field['id']];
                }
                if ($new !== $old) {
                    update_post_meta($post_id, $field['id'], $new);
                }
            }
            //SAVE page builder===========
            if (isset($this->meta_box['type']) && $this->meta_box['type'] == 'page_builder') {
                if (isset($_POST['jaw_pb_startup'])) {
                    update_post_meta($post_id, 'jaw_pb_startup', $_POST['jaw_pb_startup']);
                }

                if (isset($_POST['jaw_pb_layout'])) {
                    $jaw_pb_layout = json_decode(stripslashes($_POST['jaw_pb_layout']));
                    update_post_meta($post_id, 'jaw_pb_layout', serialize($jaw_pb_layout));
                }

                $old = get_post_meta($post_id, 'jaw_pb', true);
                $jaw_pb = '';

                if (isset($_POST['jaw_pb'])) {
                    $jaw_pb = $_POST['jaw_pb'];


                    $jaw_pb_shortcode = json_decode(stripslashes($jaw_pb));
                    $jaw_pb = addslashes(serialize($jaw_pb_shortcode));


                    update_post_meta($post_id, 'jaw_pb', $jaw_pb);
                    $shortcode = serialize(jwBuilder::jw_pb_save($post_id, $jaw_pb_shortcode));  //shortcody zabalit do shortcodu section, kterej urci velikost
                    update_post_meta($post_id, 'jaw_pb_shortcode', addslashes($shortcode));
                }
            }
        }

    }

}

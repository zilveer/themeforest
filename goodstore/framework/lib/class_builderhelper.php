<?php
if (!class_exists('jwBuilderHelper')) {

    /**
     * class jwBuilderHelper
     * Trida starajici se o vedlejsi veci builder AJAX ...
     */
    class jwBuilderHelper {

        /**
         * Registrace AJAXu
         * 
         */
        public function __construct() {

            //LOAD editors
            $this->load_editors();

            add_action('wp_ajax_jaw_live_preview', array(&$this, 'jaw_ajax_live_preview'));
            add_action('wp_ajax_jaw_live_preview_content', array(&$this, 'jaw_live_preview_content'));
            add_action('wp_ajax_jaw_builder_editor', array(&$this, 'jaw_builder_editor'));
            add_action('wp_ajax_pb_save_presets', array(&$this, 'jaw_ajax_pb_save_presets'));
            add_action('wp_ajax_pb_save_element_presets', array(&$this, 'jaw_ajax_pb_save_element_presets'));
        } 

        private function load_editors() {
            global $metapagebuild, $jaw_builder_options;
            if (class_exists('jaw_shortcodes')) {
                locate_template('framework/lib/builder/metabox-builder.php', true);
                $jwMetabox = new jwMetabox($metapagebuild);
            }
            $others_editors = array('page_sidebar', 'add_preset');
            $this->problem_load = array();
            
            foreach ($others_editors as $editor) {
                $loaded = locate_template('framework/lib/builder/editor-dialogs/' . $editor . '.php', true, true);
                if (!$loaded) {
                    $this->problem_load[] = $editor;
                } 
            }
 
            if (isset($metapagebuild['fields'])) {
                foreach ($metapagebuild['fields'] as $submeta) {

                    if (isset($submeta['content']) && $submeta['id'] == 'build_all') {
                        foreach ($submeta['content'] as $key => $meta) {
                            if (isset($meta['id']) && isset($meta['type']) && $meta['type'] == 'builder') {
                                $name = str_replace('build_', "", $meta['id']);
                                $loaded = locate_template('framework/lib/builder/editor-dialogs/' . $name . '.php', true, true);
                                if (!$loaded) {
                                    $this->problem_load[] = $name;
                                }
                            }
                        }
                    }
                }
            }
            if (!empty($this->problem_load)) {
                add_action('admin_notices', array(&$this, 'jaw_builder_admin_nodice'));
            }
        }

        /**
         * jaw_builder_admin_nodice
         * nacte iframe do ktereho se dale nacita obsah daneho elementu
         */
        function jaw_builder_admin_nodice() {
            ?>
            <div class="error">
                <p>
                    <strong>RevoComposer</strong>
                    <br>
                        Dialog for <code><?php echo implode(', ', $this->problem_load); ?></code> couldn't be loaded. Please contact JaW Templates team at <a href="mailto:jaw@jawtemplates.com">jaw@jawtemplates.com</a>
                </p>
            </div>
            <?php
        }

        /**
         * jaw_ajax_live_preview
         * nacte iframe do ktereho se dale nacita obsah daneho elementu
         */
        public function jaw_ajax_live_preview() {
            if (isset($_POST['metabox'])) {
                $metabox = $_POST['metabox'];
            } else {
                $metabox = '';
            }
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
            } else {
                $name = '';
            }
            if (isset($_POST['title'])) {
                $title = $_POST['title'];
            } else {
                $title = '';
            }
            if (isset($_POST['size'])) {
                $size = $_POST['size'];
            } else {
                $size = '';
            }
            $id = rand(0, 999999);
            echo '<script>';
            echo 'jQuery("#livePreview-' . $id . '").ready(function(){jQuery("#livePreview-' . $id . '").submit(); })';
            echo '</script>';
            echo '<form id="livePreview-' . $id . '" target="livePreview-' . $id . '" method="post"  action="' . admin_url("admin-ajax.php") . '?action=jaw_live_preview_content">';
            echo '<input type="hidden" name="metabox" value="' . htmlspecialchars(json_encode(serialize($metabox))) . '" />';
            echo '<input type="hidden" name="name" value="' . $name . '" />';
            echo '<input type="hidden" name="title" value="' . $title . '" />';
            echo '<input type="hidden" name="size" value="' . $size . '" />';
            wp_nonce_field('live_preview_content');
            echo '</form>';
            echo '<iframe id="live-iframe"  name="livePreview-' . $id . '"   marginheight="0" marginwidth="0" frameborder="0"></iframe>';
            die();
        }

        /**
         * jaw_live_preview_content
         * nacte obsah daneho elementu
         */
        public function jaw_live_preview_content() {
            global $jaw_shortcodes;
            ?>
            <html  xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <?php
                    //GOOGLE fonts
                    $fonts = array("Lato", "Open Sans");
                    $g_font = jwOpt::get_option('title_font', 'Lato');
                    if (isset($g_font['face'])) {
                        $fonts[] = $g_font['face'];
                    }
                    $g_font = jwOpt::get_option('text_font', 'Open Sans');
                    if (isset($g_font['face'])) {
                        $fonts[] = $g_font['face'];
                    }

                    echo jwRender::link_google_fonts($fonts);
                    ?>
                    <style>
                        body{
                            -webkit-user-select: none; /* Chrome/Safari */        
                            -moz-user-select: none; /* Firefox */
                            -ms-user-select: none; /* IE10+ */
                            overflow: hidden;
                        }

                        .iframe_content{
                            content: "";
                            display: table;
                            float: left;
                            height: auto;
                        }

                    </style>
                    <?php
                    add_action('wp_enqueue_scripts', 'jaw_live_preview_restyle', 51);

                    function jaw_live_preview_restyle() {
                        if ((defined('JAW_DEBUG') && JAW_DEBUG == true)) {
                            wp_dequeue_style('template-wide');
                            wp_dequeue_style('template');
                        } else {
                            wp_dequeue_style('template-wide-min');
                            wp_dequeue_style('template-min');
                        }
                        wp_register_style('template-forPB', get_template_directory_uri() . '/css/template-forPB.css', false);
                        wp_enqueue_style('template-forPB');
                    }

                    wp_head();
                    ?>
                </head>
                <body class="normal-theme">
                    <div class="iframe_content row divider-center-text">
                        <?php
                        if (isset($_POST['metabox'])) {
                            $metabox = unserialize(json_decode(stripslashes($_POST['metabox'])));
                        } else {
                            $metabox = '';
                        }
                        if (isset($_POST['name'])) {
                            $name = $_POST['name'];
                        } else {
                            $name = '';
                        }
                        if (isset($_POST['title'])) {
                            $title = $_POST['title'];
                        } else {
                            $title = '';
                        }
                        if (isset($_POST['size'])) {
                            $size = $_POST['size'];
                        } else {
                            $size = '';
                        }
                        $item = new jwBuilder_item();
                        $item->name = $name;
                        $item->metabox = $metabox;
                        $item->title = $title;
                        $item->size = $size;
                        jwBuilder::jw_pb_element_print(jwBuilder::jw_pb_make($item));

                        wp_footer();
                        ?>
                    </div>
                </body>
            </html><?php
            die();
        }

        /**
         * jaw_builder_editor
         * editor builderu
         */
        public function jaw_builder_editor() {
            global $jaw_builder_options;

            ?>

            <div id="jaw-builder-popup"   >
                <?php
                if (isset($jaw_builder_options[$_GET['jaw_code']])) {
                    ?>

                    <div id="header_editor"  >
                        <span><?php echo ucfirst(str_replace('_', ' ', $_GET['jaw_code'])); ?></span>
                        <button ng-click="cancel_editor()" class="button-primary builder red jaw"  type="button"><i class="icon-white icon-close  "></i></button>
                        <button ng-click="save_editor()" class="button-primary builder blue jaw"  type="button"><i class="icon-white icon-save"></i>  Done</button>
                    </div>
                    <div class="editor_bookmarks"><ul><li ng-repeat="(i, marks) in bookmarks track by i" ng-click="switch_mark(i)">{{marks}}</li></ul></div>
                    <div id="editor_container" >

                        <div class="content" ng-controller="jaw_revo_editor" >
                            <?php
                            echo jwElements::elements_render($jaw_builder_options[$_GET['jaw_code']]);
                            //load_template('editor-dialogs/' . $_GET['jaw_code'] . '.php');
                            ?>
                        </div>
                    </div>




                <?php } else { ?>
                    <div id="header_editor"  >
                        <span><?php echo ucfirst(str_replace('_', ' ', $_GET['jaw_code'])); ?></span>
                        <button ng-click="cancel_editor()" class="button-primary builder red jaw"  type="button"><i class="icon-white icon-close  "></i></button>
                    </div>
                    Something wrong happened. Dialog (<?php echo $_GET['jaw_code']; ?>) couldn't be loaded.

                <?php } ?> 
            </div><?php
            die();
        }

       
        /**
         * jaw_ajax_pb_save_presets
         * ukladani presetu
         */
        public function jaw_ajax_pb_save_presets() {
            $jaw_pb_presets = '';
            if (isset($_POST['jaw_pb_presets'])) {
                $jaw_pb_presets = serialize(str_replace('\'', '`', $_POST['jaw_pb_presets']));
            }
            if ($jaw_pb_presets != '') {
                jwOpt::update_option($jaw_pb_presets, 'builder');
            }
            die();
        }

        /**
         * jaw_ajax_pb_save_element_presets
         * ukladani presetu elementu
         // jaw_builder_element_bck
         */
        public function jaw_ajax_pb_save_element_presets() {
            $jaw_pb_presets = '';
            $data = '';
            $presets = maybe_unserialize(jwOpt::get_options('builder_element'));
            $presets = array_values($presets);
            if(isset($_POST['data'])){
                $data = $_POST['data'];
            }
            $operation = filter_input(INPUT_POST, 'operation');
            switch($operation){
                case 'add': 
                    $presets[] = $data;
                    break;
                case 'delete':
                    if(isset($presets[$data])){
                        unset($presets[$data]);
                    }
                    break;
                case 'init':
                    $jaw_pb_presets = array();
                    break;
                default: print_r('Error: Ajax data are wrong (operation blank)');
                    break;
            }
            $jaw_pb_presets = serialize(str_replace('\'', '`', $presets));
            if ($jaw_pb_presets != '') {
                jwOpt::update_option($jaw_pb_presets, 'builder_element');
            }
            die();
        }

    }

}
<?php

class BFIAdminPagebuilderController {
    
    const PAGEBUILDERID = "bfi-pagebuilder-panels";
    const SECTION_PROPERTIES_MODEL = "BFIAdminPagebuilderSectionStyleModel";
    private $pagebuilderModels = array();
    
    function __construct() {
        if (!BFI_ENABLE_PAGEBUILDER) {
            return;
        }
        
        $this->loadPagebuilderModels();
        $this->registerHooks();
    }
       
    // load all meta boxes in application/models/admin/meta
    private function loadPagebuilderModels() {
        $definedClasses = get_declared_classes();
        $this->pagebuilderModels = array();
        foreach ($definedClasses as $i => $className) {
            if (preg_match('/^BFIAdminPagebuilder[a-zA-Z0-9]+Model$/', $className)) {
                if ($className == 'BFIAdminPagebuilderModel') continue;
                $this->pagebuilderModels[] = new $className();
            }
        }
        $this->sortPagebuilderModels();
    }
    
    private function sortPagebuilderModels() {
        usort($this->pagebuilderModels, array(__CLASS__, "adminPanelCompare"));
    }
    
    // used by usort in sortAdminPanels()
    static protected function adminPanelCompare($a, $b) {
        return $a->name == $b->name ? 0 : ($a->name > $b->name) ? 1 : -1;
        // return $a->priority == $b->priority ? 0 : ($a->priority > $b->priority) ? 1 : -1;
    }
    
    private function registerHooks() {
        add_action('admin_print_scripts-post-new.php', array($this, 'addEditorTab'));
        add_action('admin_print_scripts-post.php', array($this, 'addEditorTab'));

        add_action('add_meta_boxes', array($this, 'addMetaBox'));
        add_action('save_post', array($this, 'saveMetaBoxes'));
        
        add_filter('the_content', array($this, 'theContent'), 20, 2);
        // add_filter('get_the_excerpt', array($this, 'theExcerpt'), 20);
        // uncomment for adding 'insert in post' media to the dialog content editor
        // add_filter('media_send_to_editor', array($this, 'my_filter_mste'), 20, 3);
        add_filter('bfi_multilang_get_post_meta_is_empty', array($this, 'pagebuilderIsEmpty'), 20, 3);
        add_filter('posts_search', array($this, 'postsSearch'), 20, 2);
    }
    
    
    /**
     * Adds the pagebuilder data to search results
     * This doesn't parse the json data, so
     * search results may be quite lax.
     */
    public function postsSearch($search, &$that) {
        if (!is_search()) return $search;
        
        $search = preg_replace(
            '/OR/',
            "OR (wp_posts.ID in (SELECT post_id FROM wp_postmeta WHERE meta_key = '" 
            . BFI_SHORTNAME . "_pagebuilder' AND meta_value LIKE '%" 
            . $that->query_vars['s'] . "%')) OR",
            $search,
            1);

        return $search;
    }
    
    
    /**
     * This function gets the 'inserted in post' media, use this
     * to intercept the uploaded image then manually put it inside
     * the current dialog's content editor
     */
    public function my_filter_mste($html, $send_id, $attachment) {
        // TODO: get the image url via $attachment['url'] then use
        // jquery to insert it in the dialog's content editor
        // use tinymce to get the editor.
        ?>
        <script>
        alert('<?php $attachment["url"] ?>');
        </script>
        <?php
        exit();
    }
    
    public static function getPanelData($postID) {
        $jsonData = "";
        if (!isset($_SESSION) || !isset($_SESSION['l'])) {
            $jsonData = bfi_get_post_meta($postID, 'pagebuilder');
        }
        
        if (!$jsonData) {
            $newContents = bfi_get_post_meta($postID, 'pagebuilder_' . $_SESSION['l']);
            if ($newContents) $jsonData = $newContents;
        }
        
        if (!$jsonData) return "";
        
        $jsonData = json_decode($pagebuilderJSON);
    }
    
    public function pagebuilderIsEmpty($data) {
        return $data == '[{"properties":"","linked":false,"columns":[{"width":100,"panels":[]}]}]'
            || $data == "[]";
    }
    
    /**
     * this is used in normal content. We wrap everything in a 'fake'
     * text panel and remove all the paragraph tags since those 
     * destroy our formatting
     */
    private function _normalContent($content) {
        $content = preg_replace('#</?p[^>]*>#', '', $content);
        return '<div class="bfi_pb_sec1 cols1 bfi_pb_sec" style="background: ;"><div class="bfi_pb_sec_wrapper"><div class="bfi_pb_sec1_col1 bfi_pb_col" style="width: 100%"><div class="bfi_pb_sec1_col1_pan1 bfi_pb_pan panel_text">' . $content . '<div class="clearfix"></div></div><div class="clearfix"></div></div><div class="clearfix"></div></div></div>';
    }

    public function theContent($content, $post_id = null) {
        global $post, $bfi_multilang_content_done;

        // if no given post id, then we're in a single post
        if (is_null($post_id)) {
            if (!empty($post) && property_exists($post, 'ID')) {
                $post_id = $post->ID;
            }
            if (!$post_id) return $content;
        }
        
        $newContents = bfi_get_post_meta($post_id, 'pagebuilder');

        if (!$newContents 
            || $newContents == '[{"properties":"","linked":false,"columns":[{"width":100,"panels":[]}]}]'
            || $newContents == "[]") {
            return $this->_normalContent($content);
        }
        
        $newContents = self::renderOptions($newContents, is_search() || is_archive() || in_array('get_the_excerpt', $GLOBALS['wp_current_filter']));
        return $newContents ? $newContents : $this->_normalContent($content);
    }
    
    public static function renderPanelFromData($dataArray, $pagebuilderClassName) {
        global $options, $panelOutput;
        
        // remember the original options and reset the values
        $origOptions = $options;
        $origOutput = $panelOutput;
        $options = "";
        $panelOutput = "";
        
        // ready our pagebuilder model
        $panelObj = new $pagebuilderClassName();
        
        // insert default values to missing data
        foreach ($panelObj->options as $option) {
            $optionProperties = $option->getProperties();
            if (array_key_exists('id', $optionProperties)) {
                $id = str_replace(BFI_SHORTNAME . '_', '', $optionProperties['id']);
                if (!array_key_exists($id, $dataArray)) {
                    $dataArray[$id] = array_key_exists('std', $optionProperties)
                                                      ? $optionProperties['std']
                                                      : "";
                }
            }
        }
        
        // convert to an object since this is what the templates use
        $options = (object)$dataArray;
        
        // invoke the template to render the panel html
        BFILoader::includeViewTemplate($panelObj->viewFilename, 'pagebuilder');
        
        // bring back the original options
        $newOutput = $panelOutput;
        $options = $origOptions;
        $panelOutput = $origOutput;
        
        // return the pagebuilder output html
        return $newOutput;
        /*
        [
          {
            "properties": "",
            "linked": false,
            "columns": [
              {
                "width": 100,
                "panels": [
                  {
                    "preview": "http:\/\/wput:8888\/wp-content\/uploads\/2013\/07\/137440...",
                    "type": "BFIAdminPagebuilderImageModel",
                    "i": 0,
                    "data": {
                      "image": "http:\/\/wput:8888\/wp-content\/uploads\/2013\/07\/1374406281amplus-image.jpg",
                      "align": "left",
                      "caption": "",
                      "link": "http:\/\/wput:8888\/wp-content",
                      "opennewwindow": false
                    }
                  },
                  {
                    "preview": "Heading\ninfoexcerpt",
                    "type": "BFIAdminPagebuilderTextModel",
                    "i": 1,
                    "data": {
                      "text": "<h2>Heading<\/h2>info<br \/>excerpt"
                    }
                  }
                ]
              }
            ]
          }
        ]
        */
    }
    
    public static function renderOptions($pagebuilderJSON, $isExcerpt = false) {
        $content = "";
        if (!is_array($pagebuilderJSON)) {
            $sections = json_decode($pagebuilderJSON);
        } else {
            $sections = $pagebuilderJSON;
        }
        
        // don't continue if page builder was not used
        if (!$sections) return false;
        
        foreach ($sections as $sectionIndex => $section) {
            
            // the first section cannot be linked ever
            if ($sectionIndex == 0) $section->linked = false;
            
            // for excerpts, don't render the section styles since
            // those won't be displayed, and the added content
            // will be shown in the excerpt
            if (!$isExcerpt) {
            
                // include the section style
                global $options, $inlineStyle, $style, $attribs, $script, $class, $nextOptions;
                $options = $section->properties;
                $inlineStyle = "";
                $style = "";
                $attribs = "";
                $script = "";
                $class = "bfi_pb_sec" . ($sectionIndex + 1);
                $nextOptions = null;
                if ($sectionIndex < count($sections) - 1) {
                    $nextOptions = $sections[$sectionIndex + 1]->properties;
                }
            
                $className = self::SECTION_PROPERTIES_MODEL;
                $sectionStyleObj = new $className();
            
                // if the section styling hasn't been adjusted by the user,
                // use the default options
                if (!$options) {
                    $newOptions = array();
                    foreach ($sectionStyleObj->options as $sectionProperty) {
                        $optionProperties = $sectionProperty->getProperties();
                        if (array_key_exists('id', $optionProperties)) {
                            $newOptions[str_replace(BFI_SHORTNAME . '_', '', $optionProperties['id'])] 
                                = array_key_exists('std', $optionProperties)
                                ? $optionProperties['std']
                                : "";
                        }
                    }
                    $options = (object)$newOptions;
                }
            
                BFILoader::includeViewTemplate($sectionStyleObj->viewFilename, 'pagebuilder');
            
                if ($script) {
                    $script = "<script>jQuery(document).ready(function(\$){"
                            . $script
                            . "});</script>";
                }
            
                if ($style) {
                    $style = "<style>{$style}</style>";
                }
            
                if (!$section->linked) {
                    $content .= sprintf("%s<div class='%s bfi_pb_sec' style='%s'%s><div class='bfi_pb_sec_wrapper'>",
                        $style . $script,
                        $class . ' cols' . count($section->columns),
                        $inlineStyle,
                        $attribs ? " " . $attribs : "");
                }
                
                $inlineStyle = "";
                $style = "";
                $attribs = "";
                $script = "";
                $class = "";
            }
            
            foreach ($section->columns as $columnIndex => $column) {
                
                $content .= sprintf("<div class='bfi_pb_sec%s_col%s bfi_pb_col' style='width: %s'>",
                    $sectionIndex + 1,
                    $columnIndex + 1,
                    $column->width . '%');
                
                foreach ($column->panels as $panelIndex => $panel) {
                    
                    // include the panel view
                    $className = $panel->type;
                    $panelObj = new $className();
                    
                    global $options, $panelOutput, $panelStyle;
                    $options = $panel->data;
                    $panelOutput = "";
                    $panelStyle = "";
                    
                    // add the default values for the options
                    foreach ($panelObj->options as $option) {
                        $optionProperties = $option->getProperties();
                        if (array_key_exists('id', $optionProperties)) {
                            $id = str_replace(BFI_SHORTNAME . '_', '', $optionProperties['id']);
                            if (!property_exists($options, $id)) {
                                $options->$id = array_key_exists('std', $optionProperties)
                                              ? $optionProperties['std']
                                              : "";
                            }
                        }
                    }
                    foreach (get_object_vars($options) as $key => $value) {
                        $options->$key = str_replace("&apos;", "'", $value);
                    }
                    
                    BFILoader::includeViewTemplate($panelObj->viewFilename, 'pagebuilder');
                    $content .= sprintf("<div class='bfi_pb_sec%s_col%s_pan%s bfi_pb_pan %s'%s>%s<div class='clearfix'></div></div>",
                        $sectionIndex + 1,
                        $columnIndex + 1,
                        $panelIndex + 1,
                        'panel_' . str_replace(array(' ', '(', ')', '/'), '_', strtolower($panelObj->name)),
                        $panelStyle ? " style='$panelStyle'" : "",
                        $panelOutput);

                    // SOMEHOW THE LAST VALUE OF THIS GETS PRINTED OUT
                    // PROBABLY BY SOME OTHER CALL. CLEAR THIS
                    $panelOutput = "";
                    $panelStyle = "";
                }
                
                $content .= "<div class='clearfix'></div></div>";
            }
            
            $content .= "<div class='clearfix'></div>";
            
            // always print the end tags if this is the last section
            if (count($sections) - 1 == $sectionIndex) {
                $content .= "</div></div>";
            // check whether the next section is linked,
            // if it is, don't print the end tags
            } else if (!$sections[$sectionIndex + 1]->linked) {
                $content .= "</div></div>";
            }
        }
        
        if ($isExcerpt) {  
            // remove some elements that we don't need to display
            $content = preg_replace('#<form(.*?)>(.*?)</form>#is', '', $content);
            $content = preg_replace("#<div[^>]+display:\s?none;(.*?)>(.*?)</div>#is", '', $content);
            $content = preg_replace("#<span[^>]+display:\s?none;(.*?)>(.*?)</span>#is", '', $content);
            $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
            $content = preg_replace('#<textarea(.*?)>(.*?)</textarea>#is', '', $content);
            $content = preg_replace('#<button(.*?)>(.*?)</button>#is', '', $content);
            $content = preg_replace('#<a[^>]+class=[^>]+button[^>]+>(.*?)</a>#is', '', $content);
            $content = preg_replace('#<input(.*?)>(.*?)</input>#is', '', $content);
            $content = preg_replace("#<span class=[\"']caption(.*?)>(.*?)</span>#is", "", $content);
            $content = preg_replace("#<figcation(.*?)>(.*?)</figcaption>#is", "", $content);
            $content = preg_replace("#</?[^>]+>#is", "", $content);
            $content = trim(strip_tags($content));
            
                // var_dump($content);
        }
        
        return $content;
    }
    
    public function addEditorTab() {
        global $post;
        if (!in_array(get_post_type($post), array("page", "post", BFIPortfolioModel::POST_TYPE))) {
            return;
        }
        
        bfi_wp_enqueue_script('bfi-page-builder', 
            BFI_LIBRARYURL . "views/admin/scripts/pagebuilder/loader.min.js", 
            array('jquery'), 
            NULL
        );
        
        /**
         * Load scripts needed by the pagebuilder
         */
        // the jQuery UI included in WP 3.5.x (1.9.2) does not have 
        // the tooltip widget and selectable interaction
        bfi_wp_enqueue_script('jquery-ui-pagebuilder', 
           BFI_LIBRARYURL . "views/admin/scripts/pagebuilder/jquery-ui-1.9.2.custom.js", 
           array('jquery'), 
           NULL
        );
        
        bfi_wp_enqueue_script('bfi-page-builder-layouting', 
           BFI_LIBRARYURL . "views/admin/scripts/pagebuilder/layouting.min.js", 
           array('jquery'), 
           NULL
        );
        
        bfi_wp_enqueue_style('bfi-page-builder-theme', 
           BFI_LIBRARYURL . "views/admin/scripts/pagebuilder/css/jquery-ui-1.10.3.custom.css"
        );

       bfi_wp_enqueue_style('bfi-page-builder-theme2', 
          BFI_LIBRARYURL . "views/admin/scripts/pagebuilder/css/jquery-ui-theme2.css",
          array('bfi-page-builder-theme')
       );
    }
    
    public function addMetaBox() {
        
        $postTypes = array("page", "post", BFIPortfolioModel::POST_TYPE);
        foreach ($postTypes as $postType) {
            
            // remove the custom field display to lessen db queries
            remove_meta_box('postcustom' , $postType , 'normal');
                
            add_meta_box(
                self::PAGEBUILDERID, 
                'Page Builder', 
                array($this, 'pagebuilderPanelRender'), 
                $postType, 
                'advanced', 
                'high'
            );
        }
    }
    
    public function saveMetaBoxes($post_id) {
        // if (wp_is_post_revision($post_id)) return;
        if (!$this->checkPermissions($post_id)) return;
        $this->savePageBuilderData($post_id);

        do_action('bfi_meta_modified', $post_id);
    }
    
    public function savePageBuilderData($postID) {
        $idsToSave = array(BFI_SHORTNAME . '_pagebuilder');
        
        $languages = bfi_get_option(BFI_SHORTNAME . "_multilanguages");
        if ($languages != "") {
            $languages = unserialize($languages);
            $languageNames = bfi_list_languages();
            
            foreach ($languages as $language => $locale) {
                $idsToSave[] = BFI_SHORTNAME . '_pagebuilder_' . $language;
            }
        }
        
        foreach ($idsToSave as $id) {
            if (!array_key_exists($id, $_REQUEST)) {
                delete_post_meta($postID, $id);
            } else {
                update_post_meta($postID, $id, $_REQUEST[$id]);
            }
        }
    }
    
    public function pagebuilderPanelRender($post) {
        $this->printPermissionCheckers();
        $this->createModelDialogs();
        $this->createNewPanelDialog();
        
        include BFI_LIBRARYPATH . "includes/bfi-pagebuilder.php";
    }
    
    private function printPermissionCheckers() {
        // Use nonce for verification
        wp_nonce_field(plugin_basename(__FILE__), self::PAGEBUILDERID . '_nonce');
    }
    
    private function checkPermissions($post_id) {
        // verify if this is an auto save routine. 
        // If it is our form has not been submitted, so we dont want to do anything
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
            return false;
        
        // verify this came from the our screen and with proper authorization,
        // because save_post can be trigger_error at other times
        if (!array_key_exists(self::PAGEBUILDERID . '_nonce', $_POST))
            return false;
        if (!wp_verify_nonce($_POST[self::PAGEBUILDERID . '_nonce'],
                             plugin_basename(__FILE__)))
            return false;
    
        // Check permissions
        if ($_POST['post_type'] == 'page') {
            if (!current_user_can('edit_page', $post_id)) return false;
        } else {
            if (!current_user_can('edit_post', $post_id)) return false;
        }

        // OK, we're authenticated: we need to find and save the data
        return true;
    }
    
    private function createModelDialogs() {
        foreach ($this->pagebuilderModels as $model) {
            $model->renderAdminDialog();
        }
    }
    
    private function createNewPanelDialog() {
        echo "
        <div id='dialog-panel-new' title='Add New Panel'>
            <p>Select a panel to add. A panel is the type of content you place in your page. You can move panels around and modify its properties afterwards.</p>
            <div class='panel-type-container'>";
        
        foreach ($this->pagebuilderModels as $model) {
            // the SECTION_PROPERTIES_MODEL model 
            // is a special model that should not
            // be displayed and will be bound to the section styles
            if (get_class($model) == self::SECTION_PROPERTIES_MODEL) continue;
                
            printf("<button class='panel-type' data-model='%s' data-is-container='%s'>
                        <span class='name'>%s</span>
                        <span class='desc'>%s</span>
                    </button> ",
                    $model->className,
					$model->isContainer ? 'true' : '',
                    $model->name,
                    $model->desc);
        }
        
        echo "
            </div>
        </div>";
    }
}

?>

<?php

class BFIPagemediaController {
    
    const MEDIA_TYPE_COLUMN = 'pagemedia_type';
    private static $pagemediaModels = array();
    
    public static $loadedPagemediaNames = array();
    public static $loadedPagemediaSlugs = array();
    
    const GLOBAL_PAGEMEDIA_ID = 'global_pagemedia';
    
    function __construct() {
        if (!BFI_ENABLE_PAGEMEDIA) return;
        $this->loadPagemediaModels();
        if (is_admin()) {
            add_action('init', array($this, 'registerPagemedia'));
            add_filter('enter_title_here', array($this, 'changePagemediaTitleField'));
            add_filter('post_row_actions', array($this, 'removeViewOption'), 10, 2 );
            add_action('admin_footer', array($this, 'removeViewButton'));
            
            // add new columns to the list of page media
            add_filter('manage_edit-pagemedia_columns', array($this, 'addMediaTypeColumn'));
            add_action('manage_posts_custom_column',  array($this, 'populateMediaTypeColumn'));
        }
    }
    
    public static function getPageMedia($pagemediaID) {
        // there is no real need to query the post since we are just going to use the meta data
        $pagemediaType = bfi_get_post_meta($pagemediaID, 'pagemedia_type');
        foreach (self::$pagemediaModels as $pagemediaModel) {
            if ($pagemediaModel->slug == $pagemediaType) {
                $pagemediaModel->postID = $pagemediaID;
                return $pagemediaModel;
            }
        }
    }
    
    // instanciates all the admin panel class models.   
    private function loadPagemediaModels() {
        $definedClasses = get_declared_classes();
        self::$pagemediaModels = array();
        foreach ($definedClasses as $i => $className) {
            if (preg_match('/^BFIPagemedia[a-zA-Z0-9]+Model$/', $className)) {
                $o = new $className();
                self::$loadedPagemediaNames[] = $o->name;
                self::$loadedPagemediaSlugs[] = $o->slug;
                self::$pagemediaModels[] = $o;
            }
        }
    }
    
    public function registerPagemedia() {
        $labels = array(
            'name' => __('Page Media', BFI_I18NDOMAIN),
            'singular_name' => __('Page Media', BFI_I18NDOMAIN),
            'all_items' => __('View all Page Media', BFI_I18NDOMAIN),
            'add_new' => __('Add New', BFI_I18NDOMAIN),
            'add_new_item' => __('Add New Page Media', BFI_I18NDOMAIN),
            'edit_item' => __('Edit Page Media', BFI_I18NDOMAIN),
            'new_item' => __('New Page Media', BFI_I18NDOMAIN),
            'view_item' => '',
            'search_items' => __('Search Page Media', BFI_I18NDOMAIN),
            'not_found' =>  __('No page media found', BFI_I18NDOMAIN),
            'not_found_in_trash' => __('No page media found in Trash', BFI_I18NDOMAIN), 
            'parent_item_colon' => ''
            );
  
        register_post_type(
            BFIPagemediaModel::POST_TYPE,
            array('labels' => $labels,
                'public' => true,  
                'show_ui' => true,
                'hierarchical' => false,
                'query_var' => true,  
                'capability_type' => 'post',
                'exclude_from_search' => true,
                'supports' => array('title', 'custom-fields'),
                'menu_position' => 5,
                )
            );
        flush_rewrite_rules(false);
    }

    public function changePagemediaTitleField($title) {
         $screen = get_current_screen();
         if  (BFIPagemediaModel::POST_TYPE == $screen->post_type) {
              $title = __('Enter a descriptive name for your page media here', BFI_I18NDOMAIN);
         }
         return $title;
    }
    
    // removes the view link in the list of all page media
    public function removeViewOption($actions, $post) {
        $screen = get_current_screen();
        if (BFIPagemediaModel::POST_TYPE == $screen->post_type)
            unset($actions['view']);
        return $actions;
    }
    
    // hides the preview button while editing a page media
    // hides permalink editing and view button while editing a page media
    public function removeViewButton() {
        $screen = get_current_screen();
        if (BFIPagemediaModel::POST_TYPE == $screen->post_type)
            echo "
            <script type='text/javascript'>
                try {
                    jQuery('#preview-action').css('display', 'none');
                    jQuery('#edit-slug-box').css('display', 'none');
                } catch (err) { }
            </script>
            ";
    }
    
    // adds a media type column in the ALL PAGE MEDIA list
    public function addMediaTypeColumn($columns) {
        $columns[self::MEDIA_TYPE_COLUMN] = __('Media Type', BFI_I18NDOMAIN);
        return $columns;
    }
    
    // populate the media type column in the ALL PAGE MEDIA list
    public function populateMediaTypeColumn($name) {
        global $post;
        if ($name != self::MEDIA_TYPE_COLUMN) return;
        $cats = bfi_get_post_meta($post->ID, 'pagemedia_type', true);
        
        if (count(self::$loadedPagemediaNames))
            echo self::$loadedPagemediaNames[array_search($cats, self::$loadedPagemediaSlugs)];
    }
}

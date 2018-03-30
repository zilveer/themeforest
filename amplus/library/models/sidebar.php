<?php

class BFISidebarModel {
    
    const OPTION_ID = "custom_sidebar_ids";
    const ID = 'widget_id';
    
    public $id = '';
    public $name = 'Sidebar';
    public $desc = '';
    public $load = true;
    public $priority = 10;
     
    public static function getDynamicSidebars() {
        $sidebars = bfi_get_option(BFI_SHORTNAME.'_'.self::OPTION_ID);
        if ($sidebars === false || $sidebars == '') return array();
        $sidebars = unserialize($sidebars);
        
        // do some sorting
        $names = array();
        foreach ($sidebars as $key => $value) {
            $names[$key] = $value['name'];
        }
        array_multisort($names, SORT_STRING, $sidebars);
        
        return $sidebars;
    }
    
    private static function saveDynamicSidebars($sidebarArray) {
        bfi_update_option(BFI_SHORTNAME.'_'.self::OPTION_ID, serialize($sidebarArray));
    }
    
    public static function createDynamicSidebar($sidebarName) {
        // get existing sidebars
        $sidebars = self::getDynamicSidebars();
        
        // generate a unique ID for the sidebar
        $sidebarIDs = array();
        foreach ($sidebars as $sidebar) {
            $sidebarIDs[] = $sidebar['id'];
        }
        $newID = '';
        while ($newID == '' || in_array($newID, $sidebarIDs)) {
            $newID = 'sidebar'.(string)rand(10000, 99999);
        }
        
        // append in list of sidebars
        $sidebars[] = array(
            "id" => $newID,
            "name" => $sidebarName,
            );
        
        // save the serialized array
        self::saveDynamicSidebars($sidebars);
    }
    
    // called by the front end to display a dynamic sidebar
    public static function displayDynamicSidebar($sidebarID) {
        $sidebars = self::getDynamicSidebars();
        
        foreach ($sidebars as $sidebar) {
            if ($sidebar['id'] == $sidebarID) {
                dynamic_sidebar($sidebarID);
                return;
            }
        }
    }
    
    public static function deleteDynamicSidebar($sidebarID) {
        $sidebars = self::getDynamicSidebars();
        foreach ($sidebars as $key => $sidebar) {
            if ($sidebar['id'] == $sidebarID) {
                unset($sidebars[$key]);
                break;
            }
        }
        self::saveDynamicSidebars($sidebars);
    }
    
    public function registerStaticSidebar() {
        if (!$this->load) return;
        register_sidebar(array(
            'name' => $this->name,
            'id' => $this->id,
            'description' => $this->desc,
            'before_widget' => '<article id="%1$s" class="widget %2$s">',
            'after_widget' => '</article>',
            'before_title' => '<h4>',
            'after_title' => '</h4>',
        ));        
    }
    
    public static function registerDynamicSidebar($sidebarName, $sidebarID) {
        register_sidebar(array(
            'name'=> $sidebarName,
            'id' => $sidebarID,
            'description' => __("This is a sidebar you created.", BFI_I18NDOMAIN),
            'before_widget' => '<article id="%1$s" class="'.$sidebarID.' widget %2$s">',
            'after_widget' => '<div class="clearfix"></div></article>',
            'before_title' => '<h4 class="title">',
            'after_title' => '</h4>',
        ));
    }
}

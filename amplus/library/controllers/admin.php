<?php

// invokes the creation of admin panels and admin menus
class BFIAdminController {
    
    private $adminPanelModels = array();
    public static $themeMenuSlug = '';
    
    function __construct() {
        $this->loadAdminPanels();
        if (is_admin()) {
            add_action('admin_menu', array($this, 'createAdminMenu'));
            add_action('after_setup_theme', array($this, 'setDefaultAdminValues'));
            add_action('admin_footer', array($this, 'showAllOptionBoxes'));
        } else {
            add_action('wp_before_admin_bar_render', array($this, 'addInAdminBar'));
        }
    }
    
    // instanciates all the admin panel class models.   
    private function loadAdminPanels() {
        $definedClasses = get_declared_classes();
        $this->adminPanelModels = array();
        foreach ($definedClasses as $i => $className) {
            if (preg_match('/^BFIAdminPanel[a-zA-Z0-9]+Model$/', $className)) {
                $this->adminPanelModels[] = new $className();
            }
        }
        $this->sortAdminPanels();
        
        self::$themeMenuSlug = $this->adminPanelModels[0]->getSlug();
    }
    
    // saves all the default values in all admin panels.
    // this is only done once for every theme installation.
    public function setDefaultAdminValues() {
        if (bfi_get_option(BFI_SHORTNAME.BFI_THEMEVERSION."_setup") !== false) return;
        foreach ($this->adminPanelModels as $adminPanel) {
            $adminPanel->saveDefaultOptionValues();
        }
        bfi_add_option(BFI_SHORTNAME.BFI_THEMEVERSION."_setup", "yes");
    }
    
    // sort admin panel models by their priority property. lower 
    private function sortAdminPanels() {
        usort($this->adminPanelModels, array(__CLASS__, "adminPanelCompare"));
    }
    
    // used by usort in sortAdminPanels()
    static protected function adminPanelCompare($a, $b) {
        return $a->priority == $b->priority ? 0 : ($a->priority > $b->priority) ? 1 : -1;
    }
    
    // adds the theme admin to the admin bar
    public function addInAdminBar() {
        global $wp_admin_bar;
    	$wp_admin_bar->add_node( array(
    	    'id' => BFI_SHORTNAME,
    		'parent' => 'site-name',
    		'title' => BFI_THEMENAME . ' Theme',
    		'href' => admin_url('admin.php?page=' . $this->adminPanelModels[0]->getSlug())
    	));
    }
    
    // creates the admin menu
    public function createAdminMenu() {
        if (!count($this->adminPanelModels)) return;
        
        // create the parent menu, clicking this will be like clicking the first submenu
        add_menu_page(
            BFI_THEMENAME, 
            BFI_THEMENAME, 
            'manage_options', 
            $this->adminPanelModels[0]->getSlug(),
            array($this->adminPanelModels[0], 'createAdminPage')
            );
            
        // create the submenus
        foreach ($this->adminPanelModels as $adminPanel) {
            add_submenu_page(
                $this->adminPanelModels[0]->getSlug(),
                $adminPanel->menuName,
                $adminPanel->menuName,
                'manage_options', 
                $adminPanel->getSlug(),
                array($adminPanel, 'createAdminPage')
                );
        }
    }
    
    // makes sure that all the theme option boxes are always shown
    public function showAllOptionBoxes() {
        echo "
        <script type='text/javascript'>
            try {
                jQuery('div[id^=bfi_].postbox').css('display', 'block');
            } catch (err) { } 
        </script>";
    }
}

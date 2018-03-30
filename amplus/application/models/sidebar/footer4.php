<?php

class BFISidebarFooter4Model extends BFISidebarModel implements iBFISidebar {
    
    const ID = 'footer4';
    
    function __construct() {
        $this->id = self::ID;
        $this->name = __('Right-most Footer Area', BFI_I18NDOMAIN);
        $this->desc = __('Widgets in this area will be shown on the footer of your pages.', BFI_I18NDOMAIN);
        
        // $widgetLayout = bfi_get_option("footer_widget_layout");
        //         if ($widgetLayout != "4") {
        //             $this->load = false;
        //         }
    }
}

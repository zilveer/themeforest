<?php

class BFISidebarFooter3Model extends BFISidebarModel implements iBFISidebar {
    
    const ID = 'footer3';
    
    function __construct() {
        $this->id = self::ID;
        $this->name = __('3rd to the Left Footer Area', BFI_I18NDOMAIN);
        $this->desc = __('Widgets in this area will be shown on the footer of your pages.', BFI_I18NDOMAIN);
        
        // $widgetLayout = bfi_get_option("footer_widget_layout");
        //         if (in_array($widgetLayout, array("0", "1", "2", "323", "434", "233", "344"))) {
        //             $this->load = false;
        //         } else if (in_array($widgetLayout, array("244", "442", "424", "3"))) {
        //             $this->name = __("Right-most Footer Area", BFI_I18NDOMAIN);
        //         }
    }
}

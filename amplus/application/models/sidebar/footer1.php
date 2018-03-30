<?php

class BFISidebarFooter1Model extends BFISidebarModel implements iBFISidebar {
    
    const ID = 'footer1';
    
    function __construct() {
        $this->id = self::ID;
        $this->name = __('Left-Most Footer Area', BFI_I18NDOMAIN);
        $this->desc = __('Widgets in this area will be shown on the footer of your pages.', BFI_I18NDOMAIN);
        
        // $widgetLayout = bfi_get_option("footer_widget_layout");
        // if ($widgetLayout == '0') {
        //     $this->load = false;
        // } else if ($widgetLayout == '1') {
        //     $this->name = __('Footer Area', BFI_I18NDOMAIN);
        // }
    }
}

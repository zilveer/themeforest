<?php

class BFIWidgetController {
    
    protected $loadedWidgetModels = array();
    
    function __construct() {
        $this->loadWidgets();
        add_action('widgets_init', array($this, 'registerWidgets'));
    }
    
    // load all sidebars in application/models/shortcode
    private function loadWidgets() {
        $definedClasses = get_declared_classes();
        $this->loadedWidgetModels = array();
        foreach ($definedClasses as $i => $className) {
            if (preg_match('/^BFIWidget[a-zA-Z0-9]+Model$/', $className)) {
                $this->loadedWidgetModels[] = new $className();
            }
        }
    }
    
    public function registerWidgets() {
        foreach ($this->loadedWidgetModels as $widgetModel)
            register_widget(get_class($widgetModel));
    }
}

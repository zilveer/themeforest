<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/select.php');
class BFIAdminOptionSelectSidebar extends BFIAdminOptionSelect {
    
    public function display() {
        $sidebars = BFISidebarModel::getDynamicSidebars();
        if (count($sidebars)) {
            array_unshift($sidebars, array(
                "name" => __("No sidebar", BFI_I18NDOMAIN),
                "id" => ""
                ));
        } else {
            array_unshift($sidebars, array(
                "name" => sprintf(__('Please create a sidebar first in the admin in %s &gt; Sidebars', BFI_I18NDOMAIN), BFI_THEMENAME),
                "id" => ""
                ));
        }
        $sidebarLabels = array();
        $sidebarIDs = array();
        foreach ($sidebars as $key => $sidebar) {
            $sidebarLabels[] = $sidebar['name'];
            $sidebarIDs[] = $sidebar['id'];
        }
        unset($sidebars);
        
        $options = $sidebarLabels;
        $values = $sidebarIDs;
        
        $this->echoOptionHeader();
        ?><select name="<?php echo $this->getID(); ?>" id="<?php echo $this->getID(); ?>"><?php 
        foreach ($options as $key => $option) {
             
            // this is if we have option groupings
            if (is_array($option)) {
                ?><optgroup label="<?php echo $key?>"><?php
                foreach ($option as $key2 => $subOption) {
                    printf("<option value=\"%s\" %s>%s</option>",
                        $values[$key][$key2],
                        $this->getValue() == $values[$key][$key2] ? 'selected="selected"' : '',
                        $subOption
                        );
                }
                ?></optgroup><?php
                
            // this is for normal list of options
            } else {
                printf("<option value=\"%s\" %s>%s</option>",
                    $values[$key],
                    $this->getValue() == $values[$key] ? 'selected="selected"' : '',
                    $option
                    );
            }
        } 
        ?></select><?php
        $this->echoOptionFooter();
    }
}

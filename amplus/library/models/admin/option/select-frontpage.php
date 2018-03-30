<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/select.php');
class BFIAdminOptionSelectFrontPage extends BFIAdminOptionSelect {
    
    protected function setProperties($args) {
        // this option has a specific id
        $args['id'] = BFI_SHORTNAME . '_' . BFI_FRONTPAGEOPTION;
        parent::setProperties($args);
    }
    
    public function display() {
        // Create a list of all pages
        $pageListTemp = get_pages();
        $pageList = array();
        foreach($pageListTemp as $apage) {
            $pageList[$apage->ID] = $apage->post_title;
            
            // provide a name for blank titled pages
            if (!$apage->post_title) {
                $pageList[$apage->ID] = "[Page ID: $apage->ID]";
            }
        }
        
        // Add the extra labels to be user-friendly
        if (count($pageListTemp)) {
            $pageTitles = array_merge(array("Select a page to display in the home page"), array_values($pageList));
            $pageIDs = array_merge(array(""), array_keys($pageList));
        } else {
            $pageTitles = array("There are no pages available, please create a page first under Pages &gt; Add New");
            $pageIDs = array("");
        }
        unset($pageListTemp);
        
        // assign the new options and values
        $this->properties['options'] = $pageTitles;
        $this->properties['values'] = $pageIDs;
        
        parent::display();
    }
}

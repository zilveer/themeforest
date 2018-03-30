<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/multicheck.php');
class BFIAdminOptionMulticheckPostCategory extends BFIAdminOptionMulticheck {
    
    public function display() {
        // get all available categories
        $categories = get_categories(array('hide_empty' => 0));
        $categoryLabels = array();
        $categoryIDs = array();
        foreach ($categories as $category) {
            $categoryLabels[] = $category->name;
            $categoryIDs[] = $category->cat_ID;
        }

        $this->properties["options"] = $categoryLabels;
        $this->properties["values"] = $categoryIDs;
        
        // Set 'uncategorized' as checked IF nothing is checked
        // This is also the default value. Normally,
        // 'uncategorized' has the lowest ID. Just in case
        // it's not, just make the lowest ID the default.
        if (!$this->getValue()) {
            $tempCategoryIDs = $categoryIDs;
            if (count($tempCategoryIDs)) {
                sort($tempCategoryIDs);
                $this->properties['std'] = array($tempCategoryIDs[0]);
            }
        }

        parent::display();
    }
}

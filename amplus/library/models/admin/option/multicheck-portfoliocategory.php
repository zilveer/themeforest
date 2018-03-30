<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/multicheck.php');
class BFIAdminOptionMulticheckPortfolioCategory extends BFIAdminOptionMulticheck {
    
    public function display() {
        // get the list of existing portfolio categories
        $portfolioCategories = bfi_get_all_portfolio_categories();
        $options = array();
        $values = array();
        foreach ($portfolioCategories as $category) {
            $options[] = $category->name;
            $values[] = $category->cat_ID;
        }
        unset($portfolioCategories);
        
        // Set everything as checked IF nothing is checked
        // As default, everything is checked also
        if (!$this->getValue()) {
            $this->properties['std'] = $values;
        }

        $this->properties["options"] = $options;
        $this->properties["values"] = $values;
        
        parent::display();
    }
}

<?php

class BFIWidgetSearchModel extends BFIWidgetModel implements iBFIWidget {
    
    // DO NOT USE __construct SINCE IT WILL CAUSE ERRORS
    function BFIWidgetSearchModel() {
        $this->label = 'Searchbar';
        $this->description = 'Displays a search bar';
        $this->args = array(
            );
        parent::__construct();
    }
    
    public function render($args) {
        echo do_shortcode("[searchbar]");
    }
    
    public function displayForm($args) {
        ?>
        <?php
    }
}
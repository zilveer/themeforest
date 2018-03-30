<?php

class BFIShortcodeCol1Model extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'col1';
    const ALIAS = 'col_one'; 
    const ALIAS2 = 'col';
    
    public $class = '';
    public $colored = true;
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $colored = $this->colored ? '' : 'no-color';
        return "<div class='clearfix'></div></div></div><div class='amplus_panel $this->class $colored' $unusedAttributeString><div>$content<div class='clearfix'></div></div></div><div class='amplus_panel'><div>";
        // return "</div></div><div class='clearfix'></div><div class='container $class $colored' $unusedAttributeString><div class='sixteen columns'>$content</div></div><div class='clearfix'></div><div class='container body'><div class='sixteen columns'>";
    }
}

class BFIShortcodeCol2Model extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'col2';
    const ALIAS = 'col_two'; 
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $clearfix = '';
        $class = $this->class;
        bfi_column_grid_counter($class, $clearfix, 6);
        return "<div class='one-half column $class' $unusedAttributeString>$content</div>$clearfix";
    }
}

class BFIShortcodeCol3Model extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'col3';
    const ALIAS = 'col_three'; 
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $clearfix = '';
        $class = $this->class;
        bfi_column_grid_counter($class, $clearfix, 4);
        return "<div class='one-third column $class' $unusedAttributeString>$content</div>$clearfix";
    }
}

class BFIShortcodeCol4Model extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'col4';
    const ALIAS = 'col_four'; 
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $clearfix = '';
        $class = $this->class;
        bfi_column_grid_counter($class, $clearfix, 3);
        return "<div class='one-fourth column $class' $unusedAttributeString>$content</div>$clearfix";
    }
}

class BFIShortcodeCol23Model extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'col23';
    const ALIAS = 'col_two_thirds'; 
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $clearfix = '';
        $class = $this->class;
        bfi_column_grid_counter($class, $clearfix, 8);
        return "<div class='two-thirds column $class' $unusedAttributeString>$content</div>$clearfix";
    }
}

class BFIShortcodeCol34Model extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'col34';
    const ALIAS = 'col_three_fourths'; 
    
    public $class = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $clearfix = '';
        $class = $this->class;
        bfi_column_grid_counter($class, $clearfix, 9);
        return "<div class='three-fourths column $class' $unusedAttributeString>$content</div>$clearfix";
    }
}


// determines whether the column needs a class alpha or omega
// this is for the implementation of 960 grid
function bfi_column_grid_counter(&$class, &$clearfix, $gridNum) {
    global $BFIShortcodeGridCounter;
    $clearfix = '';
    if (!isset($BFIShortcodeGridCounter)) $BFIShortcodeGridCounter = 0;
    if ($BFIShortcodeGridCounter == 0) $class .= ' alpha';
    $BFIShortcodeGridCounter += $gridNum;
    if ($BFIShortcodeGridCounter >= 12) {
        $class .= ' omega';
        $BFIShortcodeGridCounter = 0;
        $clearfix = "<div class='clearfix'></div>";
    }
    $class = trim($class);
}
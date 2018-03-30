<?php

class BFIAdminOptionHeading extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        $scrollToTop = $this->getTop() ? "<a style='color: silver; text-decoration: none; margin-left: 20px;' href='#' onclick=\"javascript:jQuery('html, body').animate({scrollTop:0}, 'slow'); return false;\">&uarr;</a>" : '';
        $locationName = str_replace(' ', '', $this->getName());
        ?>
        <div class='c'></div>
        <div class='h <?php echo $this->getClass() ?>'>
            <a name='<?php echo $locationName ?>' style='position: relative;'></a><h3 class='heading'><?php echo $this->getName(); echo $scrollToTop; ?></h3>
        </div>
        <?php
    }
    
    public function saveAsMeta($postID) { }
    public function saveAsOption() { }
    public function resetAsOption() { }
}

<?php

class BFIAdminOptionSubheading extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        ?>
        <div class="m <?php echo $this->getClass() ?>">
            <div class="c"><h4><?php echo $this->getName(); ?></h4></div>
        </div>
        <?php
    }
    
    public function saveAsMeta($postID) { }
    public function saveAsOption() { }
    public function resetAsOption() { }
}

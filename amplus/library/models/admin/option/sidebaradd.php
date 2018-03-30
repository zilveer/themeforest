<?php

class BFIAdminOptionSidebaradd extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        $this->echoOptionHeader();
        ?>
        <form method="post">
        <input name="<?php echo $this->getID(); ?>" id="<?php echo $this->getID(); ?>" type="text" value="" placeholder="<?php _e('Enter a name for your new sidebar', BFI_I18NDOMAIN) ?>"/>
        <input name="sidebaradd" type="submit" class="button-primary" value="Add sidebar"/>
        <input type="hidden" name="action" value="save" />
        </form>
        <?php
        $this->echoOptionFooter();
    }
    
    // meta not supported
    public function saveAsMeta($postID) { }
    
    // reset not applicable
    public function resetAsOption() { }
    
    public function saveAsOption() {
        if (!array_key_exists($this->getID(), $_REQUEST) || !$_REQUEST[$this->getID()]) return;
        BFISidebarModel::createDynamicSidebar($_REQUEST[$this->getID()]);
    }
}

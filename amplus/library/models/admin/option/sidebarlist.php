<?php

class BFIAdminOptionSidebarlist extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        $sidebars = BFISidebarModel::getDynamicSidebars();
        
        $this->echoOptionHeader();
        echo "<div class='sidebarlist'>";
        if (!count($sidebars)) echo "<em>You have not yet added any sidebars</em>";
        foreach ($sidebars as $sidebar) {
            ?>
            <form method="post">
            <input type="hidden" name="<?php echo $this->getID() ?>" value="<?php echo $sidebar["id"] ?>"/>
            <input type="hidden" name="action" value="save" />
            <span><?php echo $sidebar["name"] ?></span>
            <input type="submit" class="button-secondary" value="Delete sidebar"/>
            <a href="<?php echo get_admin_url('', 'widgets.php') ?>">Start adding widgets</a>
            </form>
            <div class='c'></div>
            <?php
        }
        echo "</div>";
        $this->echoOptionFooter();
    }
    
    // meta not supported
    public function saveAsMeta($postID) { }
    
    // the only saving being done in sidebar lists are the deletion of user-created sidebars
    public function saveAsOption() {
        if (!array_key_exists($this->getID(), $_REQUEST) || !$_REQUEST[$this->getID()]) return;
        BFISidebarModel::deleteDynamicSidebar($_REQUEST[$this->getID()]);
    }
    
    public function resetAsOption() { }
}

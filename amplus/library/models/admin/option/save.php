<?php

class BFIAdminOptionSave extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        $onclick = preg_replace('/\"/', "\\\"", $this->getOnclick());
        ?>
        <div class='c'></div>
        <div class='s <?php echo $this->getClass() ?>'>
            <button type="submit" name="action" value="save" onclick="<?php echo $onclick ?>" class="button-primary"><?php echo $this->getSave(__('Save changes', BFI_I18NDOMAIN)) ?></button>
            <button name="action" class="button-secondary" onclick="javascript: jQuery('#reset-form').submit(); return false;"><?php echo $this->getReset(__('Reset', BFI_I18NDOMAIN)) ?></button><br>
        </div>
        <?php
    }
    
    public function saveAsMeta($postID) { }
    public function saveAsOption() { }
    public function resetAsOption() { }
}

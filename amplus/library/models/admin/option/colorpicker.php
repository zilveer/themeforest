<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/text.php');
class BFIAdminOptionColorpicker extends BFIAdminOptionText {
    
    public function display() {
        $this->echoOptionHeader(); 
        $uid = rand(10000,99999);
        ?>
        <input type="text" name="<?php echo $this->getID()?>" id="<?php echo $this->getID() . $uid?>" value="<?php echo $this->getValue() ?>"/>
        <div class="colorSelector" id="bgcolorpicker-<?php echo $this->getID() . $uid ?>"><div style="background-color: <?php echo $this->getValue() ?>"></div></div>
        <script type="text/javascript">jQuery(document).ready(function($){
        jQuery('#<?php echo $this->getID() . $uid?>').keyup(function() {
            jQuery('#bgcolorpicker-<?php echo $this->getID() . $uid?>').ColorPickerSetColor(jQuery('#<?php echo $this->getID() . $uid?>').val());
            jQuery('#bgcolorpicker-<?php echo $this->getID() . $uid?> div').css('backgroundColor', jQuery('#<?php echo $this->getID() . $uid?>').val());
        });
        jQuery('#bgcolorpicker-<?php echo $this->getID() . $uid?>').ColorPicker({
                color: '<?php echo $this->getValue() ?>',
                onShow: function (colpkr) {
                    jQuery(colpkr).fadeIn(500);
                    jQuery('#bgcolorpicker-<?php echo $this->getID() . $uid?>').ColorPickerSetColor(jQuery('#<?php echo $this->getID() . $uid?>').val());
                    return false;
                },
                onHide: function (colpkr) {
                    jQuery(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    jQuery('#bgcolorpicker-<?php echo $this->getID() . $uid?> div').css('backgroundColor', '#' + hex);
                    jQuery('#<?php echo $this->getID() . $uid?>').val('#' + hex);
                }
            });
        });</script>
        <?php
        $this->echoOptionFooter();
    }
}

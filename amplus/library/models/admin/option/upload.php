<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/text.php');
class BFIAdminOptionUpload extends BFIAdminOptionText {
    
    public function display() {
        $this->echoOptionHeader();
        printf("<input type=\"text\" name=\"%s\" placeholder=\"%s\" value=\"%s\" id=\"%s\" class=\"upload\"/>",
            $this->getID(),
            $this->getPlaceholder(),
            $this->getValue(),
            $this->getID()
            );
        ?>
        <div id="<?php echo $this->getID() ?>_button" class="button-upload">
            <a class="button button-upload"><span><?php _e("Upload", BFI_I18NDOMAIN) ?></span></a>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                <?php
                printf("bfi.upload(\"%s\", \"%s\", jQuery(\"div#%s_button\"), jQuery(\"div#%s_button a span\"), jQuery(\"input#%s\"));",
                    BFI_UPLOADHANDLERURL,
                    BFI_UPLOADURL,
                    $this->getID(),
                    $this->getID(),
                    $this->getID()
                    );
                ?>
            });
        </script>
        <?php
        $this->echoOptionFooter();
    }
}

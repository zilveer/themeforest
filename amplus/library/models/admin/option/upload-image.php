<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/upload.php');
class BFIAdminOptionUploadImage extends BFIAdminOptionUpload {
    
    public function display() {
        $randID = 'upload-' . rand(10000,99999);
        $this->echoOptionHeader();
        printf("<input type=\"text\" name=\"%s\" value=\"%s\" id=\"%s\" class=\"upload\"/>",
            $this->getID(),
            $this->getValue(),
            // $this->getID()
            $randID
            );
        ?>
        <div id="<?php echo $randID ?>" class="button-upload   ">
            <a class="button button-upload"><span>Upload</span></a>
        </div>
        <script>
        jQuery(document).ready(function($){
            jQuery('div[id="<?php echo $randID ?>"]').unbind('click').click(function(event){
                event.preventDefault();

                // uploader frame properties
                var frame = wp.media({
                    title: "Select Image",
                    multiple: false,
                    library: { type: 'image' },
                    button : { text : 'Use image' }
                });
            
                // get the url when done
                frame.on('select', function() {
                    var selection = frame.state().get('selection');
                    selection.each(function(attachment) {
                        $('#<?php echo $randID ?>').val(attachment.attributes.url);
                    });
                    frame.off('select');
                });
            
                // open the uploader
                frame.open();
            });
        });
        </script>
        <?php
        $this->echoOptionFooter();
    }
}

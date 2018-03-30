<?php

class BFIAdminOptionToc extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        ?>
        <div class='h'><h3><?php echo $this->getName() ?></h3></div>
        <div class="">
        <?php
        $this->properties['name'] = $this->properties['desc'];
        unset($this->properties['desc']);
        $this->echoOptionHeader();
        ?>
        <ol class='toc'></ol>
        <script>
            jQuery(document).ready(function($){
                $('.bfi_adminpanel h3.heading').each(function() {
                    var title = $(this).html().trim();
                    if (title.indexOf('<') != -1) {
                        title = title.substr(0, title.indexOf('<'));
                    }
                    name = title.replace(/ /g, "");
                    $('ol.toc').append('<li><a href="#" onclick="javascript:jQuery(\'html, body\').animate({scrollTop: jQuery(\'a[name=\\\''+name+'\\\']\').offset().top }, \'slow\'); return false;\">'+title+'</a></li>');
                })
            });
        </script>
        <div class='c'></div>
        </div>
        <?php
        $this->echoOptionFooter();
    }

    public function saveAsMeta($postID) { }
    public function saveAsOption() { }
    public function resetAsOption() { }
}

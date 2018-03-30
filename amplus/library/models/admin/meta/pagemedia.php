<?php

class BFIAdminMetaPagemediaModel extends BFIAdminMetaModel implements iBFIAdminMeta {
    function __construct() {
        $this->postType = BFIPagemediaModel::POST_TYPE;
        $this->title = 'Page Media Options';
        $this->priority = -100; // make sure this is the very first meta box
        parent::__construct();
    }
    
    public function createOptions() {
        // we will use this to generate the jquery for showing/hiding meta boxes
        $selector = '#'.BFI_SHORTNAME.'_'.implode(', #'.BFI_SHORTNAME.'_', BFIPagemediaController::$loadedPagemediaSlugs);
        
        $this->addOption(array(
            "name" => "What is page media?",
            "type" => "note",
            "desc" => "Page media is the large media (images, slider, etc) shown in your pages. You can assign a page media to display in your pages or in the theme's configuration.",
            ));
            
        $this->addOption(array(
            "type" => "note",
            "desc" => "Select first the type below before proceeding. Additional settings will be displayed for your selection.",
            ));
        
        $this->addOption(array(
            "name" => "Page Media Type",
            "type" => "select",
            "hasmore" => true,
            "options" => BFIPagemediaController::$loadedPagemediaNames,
            "values" => BFIPagemediaController::$loadedPagemediaSlugs,
            "id" => "pagemedia_type",
            "std" => BFIPagemediaController::$loadedPagemediaNames[0],
            "desc" => "Select the type of this page media. Settings will be displayed corresponding to the type you select.",
            "custom" => "
                <script>
                    jQuery(document).ready(function(\$){
                        \$('#".BFI_SHORTNAME."_pagemedia_type').change(function() {
                            var id = '".BFI_SHORTNAME."_'+\$(this).val();
                            \$('$selector').each(function() {
                                if (\$(this).attr('id') == id) {
                                    \$(this).fadeIn('slow');
                                } else {
                                    \$(this).hide(0);
                                }
                            });
                        });
                        
                        \$('#".BFI_SHORTNAME."_pagemedia_type').delay(500).trigger('change');
                    });
                </script>
                ",
            ));
    }
}

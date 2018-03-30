<?php

class BFIAdminMetaPostSEOModel extends BFIAdminMetaModel implements iBFIAdminMeta {
    function __construct() {
        $this->postType = 'post';
        $this->title = 'SEO Options';
        $this->priority = 100;
        parent::__construct();
    }
    
    public function createOptions() {
        $this->addOption(array(
            "name" => "Meta Keywords",
            "desc" => "A comma-separated list of keywords that describes this page. This will be used by search engines.<br><br><em>If left blank, then the default SEO values in the theme's settings will be used.</em>",
            "id" => BFI_OPTIONMETAKEYWORDS,
            "type" => "translatabletext",
            "std" => "",
            "placeholder" => "Comma, Separated, Keywords",
            ));
        
        $this->addOption(array(
            "name" => "Meta description",
            "id" => BFI_OPTIONMETADESCRIPTION,
            "type"=> "translatabletext",
            "std" => "",
            "desc" => "A short summary of the contents of this page. This will be used by search engines.<br><br><em>If left blank, then the default SEO values in the theme's settings will be used.</em>",
            "placeholder" => "Description of page contents here",
            ));
            
        $this->addOption(array(
            "name" => "",
            "type" => "custom",
            "custom" => "<em>Description currently has <input type='text' readonly id='".BFI_SHORTNAME."_description_chars' style='width: 40px; float: none;'/> characters</em>
            <script>
            jQuery(document).ready(function($) {
                $('#".BFI_SHORTNAME."_meta_description').keyup(function() {
                    $('#".BFI_SHORTNAME."_description_chars').val($(this).val().length);
                    if ($(this).val().length > 160) {
                        $('#".BFI_SHORTNAME."_description_chars').css('color', 'red');
                    } else {
                        $('#".BFI_SHORTNAME."_description_chars').css('color', 'inherit');
                    }
                });
                $('#".BFI_SHORTNAME."_meta_description').trigger('keyup');
            });
            </script>",
            ));
    }
}

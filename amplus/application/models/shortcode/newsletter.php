<?php

class BFIShortcodeNewsLetterModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'newsletter';
    const ALIAS = 'newsletterform'; 
    
    public $class = '';
    public $button = '';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        if (!$this->button) $this->button = __("Join", BFI_I18NDOMAIN);
        $id = rand(10000, 99999);
        
        $mailChimpHandlerScript = BFILoader::getOverridableLibraryFile('includes/mailchimp-handler.php', true);
    
        return "
        <div class='mailchimp $this->class' $unusedAttributeString>
            <form action='#' class='signup' method='get' id='mailchimp_$id' novalidate>
                ".do_shortcode('[infobox type="notice" class="response"] [/infobox]')."
                <input type='text' name='email' placeholder='".__("Your email", BFI_I18NDOMAIN)."'/>
                <a class='button' onclick='jQuery(\"#mailchimp_$id\").submit(); return false;'>$this->button</a>
            </form>
        </div>
        <script>
            jQuery(document).ready(function(\$){
                \$('#mailchimp_$id').find('.response').hide(0);
                \$('#mailchimp_$id').submit(function() {
                    var parent = \$(this).parents('.mailchimp');
                    parent.find('.response').html('".__("Please wait...", BFI_I18NDOMAIN)."');
                    parent.find('.response').slideDown('fast');
                    \$.ajax({
                        url: '$mailChimpHandlerScript',
                        data: 'ajax=true&email=' + escape(parent.find('input[name=\"email\"]').val()),
                        success: function(msg) {
                            parent.find('.response').html(msg);
                            if (parent.find('.response .success').length) {
                                parent.find('input').slideUp('fast');
                            }
                        }
                    });
                    return false;
                });
            });
        </script>
        ";
    }
}
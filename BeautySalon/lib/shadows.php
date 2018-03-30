<?php
header ('content-type: text/javascript; charset: UTF-8');
$template_path  = $_GET['template_dir'];
?>(function($){ 
//------------------------------------------------------------------------
// INSERT SHADOW UNDER IMAGES HAVING
//------------------------------------------------------------------------
	$.fn.imgShadow = function (options) {
    	var defaults = {
			shadow: 1
        };
        var option = $.extend({}, defaults, options);
        $(this).each(function() {
			var $this = $(this),
            	style = $this.attr('style');
			$this.attr('style','');
            $this.wrap('<div class="block-img-shadow auto-size" style="'+style+'" />');
            $('<div class="under-shadow"><img src="<?php echo $template_path; ?>/images/shadows/shadow'+ options.shadow +'.png" alt="" width="'+$(this).width()+'" height="auto" /></div>').insertAfter(this);
        });
    };
    
    $(window).load(function() {
        $('img.shadow1').imgShadow({shadow:1});
        $('img.shadow2').imgShadow({shadow:2});
        $('img.shadow3').imgShadow({shadow:3});
        $('img.shadow4').imgShadow({shadow:4});
        $('img.shadow5').imgShadow({shadow:5});
        $('img.shadow6').imgShadow({shadow:6});
        $('img.shadow7').imgShadow({shadow:7});
        $('img.shadow8').imgShadow({shadow:8});
        $('img.shadow9').imgShadow({shadow:9});
        $('img.shadow10').imgShadow({shadow:10});
    });	
})(jQuery);
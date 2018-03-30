/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

(function($){  

    $(document).ready(function() {  

        var config = $('body').data('config') || {};  

        // Accordion menu  
        $('.menu-sidebar').accordionMenu({ mode:'slide' });  

        // Dropdown menu  
        $('#menu').dropdownMenu({ mode: 'slide', dropdownSelector: 'div.dropdown'});  

        // Smoothscroller  
        $('a[href="#page"]').smoothScroller({ duration: 500 });  

        // Social buttons  
        $('article[data-permalink]').socialButtons(config);  
				
		// Google Code Prettify
		prettyPrint();
				
        // Match height and widths  
        var match = function() {  
            $.matchWidth('grid-block', '.grid-block', '.grid-h').match();  
            $.matchHeight('main', '#maininner, #sidebar-a, #sidebar-b').match();  
            $.matchHeight('top-a', '#top-a .grid-h', '.deepest').match();  
            $.matchHeight('top-b', '#top-b .grid-h', '.deepest').match();  
            $.matchHeight('bottom-a', '#bottom-a .grid-h', '.deepest').match();  
            $.matchHeight('bottom-b', '#bottom-b .grid-h', '.deepest').match();  
            $.matchHeight('innertop', '#innertop .grid-h', '.deepest').match();  
            $.matchHeight('innerbottom', '#innerbottom .grid-h', '.deepest').match();  
        };  

        match();  

        $(window).bind('load', match);  

    });  

})(jQuery);
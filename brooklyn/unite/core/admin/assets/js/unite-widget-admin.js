/* <![CDATA[ */
;(function($){
	
	"use strict";
	
    $(document).ready(function(){
        
        /* Helper function to create a unique ID
		================================================== */ 
        function unite_create_id() {
             return '-' + Math.random().toString(36).substr(2, 9);
        }
        
        /* Tabs
		================================================== */ 
        function unite_create_tabs() {
            
            $('.ut-tabs').each(function() {
            
                var $tabs = $(this);
                
                /* check if already initialized */
                if( !$tabs.data('ui-tabs') ) {                
                    
                    $tabs.find('ul').children('li').each(function( index ) {
                        
                        var id = 'tab' + unite_create_id();
                        
                        /* add href */
                        $(this).children('a').attr('href', '#' + id);
                        
                        /* add id */
                        $tabs.children('div').eq(index).attr('id',id);
                                        
                    });
                    
                    $tabs.tabs();
                
                } else {
                    
                    $tabs.tabs('refresh');
                    
                }
            
            });
                
        }
                
        unite_create_tabs();
        
        /* re initialize widgets after save */
        $(document).ajaxComplete(function() {
            
            $('.ut-color-picker').each(function() {
                
                $(this).wpColorPicker();
                    
            });
            
            unite_create_tabs();
                
        });        
        
    });
	
})(jQuery);
 /* ]]> */
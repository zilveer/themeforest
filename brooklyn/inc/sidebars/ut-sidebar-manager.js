/* <![CDATA[ */
;(function($){
	
	"use strict";
	
    $(document).ready(function(){
        
        /* add accordion to existing sidebars */
        $('.ut-repeat-group').not('.ut-to-copy').each(function() {
            
            $(this).accordion({ 
                collapsible: true,
                icons: false,
                active: false,
                animate: false,
                activate: function(event, ui) {
                    
                    if( $(this).hasClass('closed') ) {
                        
                        $(this).removeClass('closed');
                        
                    } else {
                        
                        $(this).addClass('closed');
                        
                    }
                    
                }
            });
            
        });
        
        /* add accordion to new sidebar */
        var ut_create_update_accordion = function( $group ) {
            
            if(  !$group.hasClass("ui-accordion") ) {
                
                $group.accordion({ 
                    collapsible: true,
                    active: false,
                    icons: false,
                    animate: false,
                    beforeActivate: function( event, ui ) {
                        
                        $(this).addClass('closed');
                        
                    },
                    activate: function(event, ui) {
                        
                        if( $(this).hasClass('closed') ) {
                            
                            $(this).removeClass('closed');                            
                            
                            
                        } else {
                            
                            $(this).addClass('closed');
                            
                        }
                        
                    }
                }).accordion({ active: 0 });
                
            }
        
        }
        
        /* copy */
        $(document).on("click", ".ut-docopy", function(event){
            
            var $loop = $(this).parent();
             
            /* the group to copy */
            var $group = $loop.find('.ut-to-copy').clone().insertBefore( $(this) ).removeClass('ut-to-copy');
            
            /* the new input */
            var $input = $group.find('input'),
                $textarea = $group.find('textarea'),
                input_name = $input.attr('data-rel'),
                count = $loop.children('.ut-repeat-group').not('.ut-to-copy').length;
                
                /* assign new input name including an ID */
                $input.attr('name', input_name + '[' + ( count - 1 ) + '][sidebarname]');
                $textarea.attr('name', input_name + '[' + ( count - 1 ) + '][sidebardesc]');
            
            /* check if accordion already exists , if not - initialize it */
            ut_create_update_accordion( $group );
            
            event.preventDefault();
            
        });
        
        /* delete sidebar */
        $(document).on("click", ".ut-dodelete", function(event){
            
            $(this).closest('.ut-repeat-group').remove();
            event.preventDefault();
            
        });
        
        /* change sidebar name */
        $(document).on("input propertychange", ".ut-sidebar-name", function(e){ 
            
            var input = $(this).val();           
            $(this).closest('.ui-accordion-content').prev("h3").find('span:first-child').html( input );
            
		}); 

        
            
    });
	
})(jQuery);
 /* ]]> */
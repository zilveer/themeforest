/* <![CDATA[ */
;(function($){
	
    "use strict";
    
    $(document).ready(function(){
                
        $(document).on('sortstop', '#menu-to-edit' , function( event, ui ) {
            
            setTimeout( function(){  
            
                for (var i = 0; i < ui.item.context.classList.length; i+=1) {

                    if (ui.item.context.classList[i].indexOf('menu-item-depth-') >= 0) {

                        var depth = ui.item.context.classList[i].split('menu-item-depth-');
                                                
                        if( depth[1] !== '0' && ui.item.data('megamenu') ) {
                            
                            modal({
                                type: 'info',
                                title: unite_js_translation.info,
                                text: unite_js_translation.megamenu_level_message,
                                autoclose: false,
                            });
                            
                        }
                        
                        if( depth[1] === '1' && ui.item.data('megamenu-column') ) {
                            
                            var id = ui.item.attr('id').split('menu-item-'),
                                parent_id = $('#menu-item-settings-'+id[1]).find('.menu-item-data-parent-id').val();
                                                            
                            if( !$('#menu-item-'+parent_id).data('megamenu') ) {
                                
                                modal({
                                    type: 'info',
                                    title: unite_js_translation.info,
                                    text: unite_js_translation.megamenu_column_parent_message,
                                    autoclose: false,
                                });                                
                                
                            }   
                        
                        }
                        
                        if( depth[1] !== '1' && ui.item.data('megamenu-column') ) {
                            
                            modal({
                                type: 'info',
                                title: unite_js_translation.info,
                                text: unite_js_translation.megamenu_column_level_message,
                                autoclose: false,
                            });                            
                        
                        }
                        
                        if( depth[1] !== '2' && ui.item.data('megamenu-widget') ) {
                            
                            modal({
                                type: 'info',
                                title: unite_js_translation.info,
                                text: unite_js_translation.megamenu_widget_level_message,
                                autoclose: false,
                            });                            
                        
                        }
                        
                        if( depth[1] === '2' && ui.item.data('megamenu-widget') ) {
                            
                            var id = ui.item.attr('id').split('menu-item-'),
                                widgets = '',
                                parent_id = $('#menu-item-settings-'+id[1]).find('.menu-item-data-parent-id').val();
                            
                            /* check if there is already a child of parent */
                            if( $('.menu-item-data-parent-id[value='+ parent_id +']').length >= 2 ) {
                                
                                $('.menu-item-data-parent-id[value='+ parent_id +']').each(function() {
                                    
                                    if( $('#menu-item-' + $(this).siblings('.menu-item-data-db-id').val() ).data('megamenu-widget') ) {
                                        
                                        widgets++;
                                        
                                    }                                    
                                                                        
                                });
                                
                                if( widgets >= 2 ) {
                                    
                                    modal({
                                        type: 'info',
                                        title: unite_js_translation.info,
                                        text: unite_js_translation.megamenu_widget_amount_message,
                                        autoclose: false,
                                    }); 
                                
                                }
                            
                            }
                        
                        }                        

                    }

                }
            
            }, 100 );
        
        });        
        
        function add_mm_to_menu( menu_ID ) {
            
            /* no menu - leave here */
            if ( !$('#menu-to-edit').length ) {
                return false;
            }
            
            var $mm_menu_parent_input = $('#mm-menu-parent-title'+menu_ID),
                menuItems = {},
                processMethod = wpNavMenu.addMenuItemToBottom;            
            
            menuItems[menu_ID] = $mm_menu_parent_input.closest('label').getItemData( 'add-menu-item', menu_ID );
                        
            wpNavMenu.addItemToMenu( menuItems, processMethod, function() {
                
            
            });
        
        }
        
        function add_mm_column_to_menu( menu_ID ) {
            
            /* no menu - leave here */
            if ( !$('#menu-to-edit').length ) {
                return false;
            }
            
            var $mm_menu_parent_input = $('#mm-menu-column-title'+menu_ID),
                menuItems = {},
                processMethod = wpNavMenu.addMenuItemToBottom;            
            
            menuItems[menu_ID] = $mm_menu_parent_input.closest('label').getItemData( 'add-menu-item', menu_ID );
                        
            wpNavMenu.addItemToMenu( menuItems, processMethod, function() {
                
                modal({
                    type: 'info',
                    title: unite_js_translation.info,
                    text: unite_js_translation.megamenu_column_added_message,
                    autoclose: false,
                }); 
            
            });
        
        }
        
        function add_widget_to_menu() {
            
            /* no menu - leave here */
            if ( !$('#menu-to-edit').length ) {
                return false;
            }
            
            var $ut_widget_for_menu = $('#ut-widget-for-menu'),
                menuItems           = {},
                widgets_to_add      = $ut_widget_for_menu.find('li input[type="checkbox"]:checked'),
                re                  = /menu-item\[([^\]]*)/;
            
            /* method */
            var processMethod = wpNavMenu.addMenuItemToBottom;           
            
            /* no items checked - leave here */
            if ( !widgets_to_add.length ) {
                return false;
            }
                        
            /* loop trough selected widgets */
            $(widgets_to_add).each( function(){
               
                var $this             = $(this),
                    listItemDBIDMatch = re.exec( $this.attr('name') ),
                    listItemDBID      = 'undefined' == typeof listItemDBIDMatch[1] ? 0 : parseInt(listItemDBIDMatch[1], 10);
                                
                if ( this.className && -1 != this.className.indexOf('add-to-top') ) {
                    
                    processMethod = wpNavMenu.addMenuItemToTop;                    
                    
                }
                
                menuItems[listItemDBID] = $this.closest('li').getItemData( 'add-menu-item', listItemDBID );
                
            });
            
            wpNavMenu.addItemToMenu(menuItems, processMethod, function(){
                
                widgets_to_add.removeAttr('checked');
               
            });
            
        }
        
        
        
        /* add mm to menu */
        $('#add-mm-to-menu').on( 'click', function( event ) {
            
            wpNavMenu.registerChange();
            add_mm_to_menu( $(this).data('menu-id') );
            
            event.stopImmediatePropagation();
            event.preventDefault();
            
        });
        
        /* add column to menu */
        $('#add-mm-column-to-menu').on( 'click', function( event ) {
            
            wpNavMenu.registerChange();
            add_mm_column_to_menu( $(this).data('menu-id') );
            
            event.stopImmediatePropagation();
            event.preventDefault();
            
        });
                
        /* add widget to menu */
        $('#add-widget-to-menu').on( 'click', function( event ) {
            
            wpNavMenu.registerChange();
            add_widget_to_menu();
            
            event.stopImmediatePropagation();
            event.preventDefault();
            
        });
        
        
        
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
        
        /* Accordion
		================================================== */ 
        function unite_create_accordion() {
            
            $('.ut-accordion').each(function() {
            
                var $accordion = $(this);
                
                /* check if already initialized */
                if( !$accordion.data('ui-accordion') ) {                
                    
                    $accordion.accordion({
                        heightStyle: "content",
                        collapsible: true
                    });
                
                } else {
                    
                    $accordion.accordion('refresh');
                    
                }
            
            });            
        
        }
        
        unite_create_accordion();
        
        
        $(document).ajaxComplete(function() {
            
            unite_create_accordion();
            unite_create_tabs();
                
        });
                
        
    });
	
})(jQuery);
/* ]]> */
/* <![CDATA[ */
;(function($){
	
	"use strict";
	
    $(document).ready(function(){
        
        /*
        |--------------------------------------------------------------------------
        | Create Google Stylesheet Link
        |--------------------------------------------------------------------------
        */
        
        function unite_create_google_font_link() {
        
            $('<link rel="stylesheet" id="ut-google-link" type="text/css">').insertAfter( $('#unite-grid-css') );
        
        }
        
        /* run when loaded */
        unite_create_google_font_link();
        
        /*
        |--------------------------------------------------------------------------
        | Change Google Stylesheet Link
        |--------------------------------------------------------------------------
        */
        
        function unite_update_google_font_link( font_id ) {
            
            if( !font_id ) {
				return;
			}
            
            var url = 'http://fonts.googleapis.com/css?family=';            
            
            if( unite_google_fonts.fonts[font_id] !== undefined ) {
                
                /* create font style string */
                var styles  = (  unite_google_fonts.fonts[font_id]['variants'] !== undefined ) ? ':' + unite_google_fonts.fonts[font_id]['variants'].join() : '';
                var subsets = (  unite_google_fonts.fonts[font_id]['subsets']  !== undefined ) ? '&subset' + unite_google_fonts.fonts[font_id]['subsets'].join() : '';
                
                if( unite_google_fonts.fonts[font_id]['family'] !== undefined ) {
                
                    $('#ut-google-link').attr('href', url + unite_google_fonts.fonts[font_id]['family'] + styles + subsets );
                
                }
                
            }
            
        }
        
        /*
        |--------------------------------------------------------------------------
        | Update Preview
        |--------------------------------------------------------------------------
        */
        
        function unite_update_google_font_preview( font_id ) {
            
            if( unite_google_fonts.fonts[font_id] === undefined ) {
				return;
			}
            
            /* build stylesheets url and load font */
            unite_update_google_font_link( font_id );
             
            /* create CSS */
            $('#ut-preview-google-font').css("font-family" , unite_google_fonts.fonts[font_id]['family'] );
            
            /* loop trough variants */
            for (var i = 0; i < unite_google_fonts.fonts[font_id]['variants'].length; i++) {
                
                /* @todo show variants */
                
                //console.log( unite_google_fonts.fonts[font_id]['variants'][i] );
                
            }
         
        }
        
        /*
        |--------------------------------------------------------------------------
        | Preview Animation
        |--------------------------------------------------------------------------
        */
        
        var preview_open = false;
        
        function unite_show_google_font_preview() {
            
            if( !preview_open ) {
                
                $('.ut-options-overlay').fadeIn(300, function(){
                    
                   preview_open = true; 
                                    
                });
            
            
            } else {
                
                $('.ut-options-overlay').fadeOut(300, function(){
                    
                   preview_open = false; 
                                    
                });
            
            }
        
        }
        
        
        $(document).on('click' , '.ut-preview-google-font-wrap .close' , function(event) { 
                    
            event.preventDefault();
            unite_show_google_font_preview();
                
        });
        
        /*
        |--------------------------------------------------------------------------
        | Sortable
        |--------------------------------------------------------------------------
        */
        
        var $unite_google_font_collection = $('#ut-google-font-collection'),
            $unite_google_font_trash      = $('#ut-google-font-trash');
            
        $(".ut-sortable-fonts").sortable({
            
            connectWith: '.ut-sortable-fonts',
            helper: 'clone', 
            placeholder: "ut-admin-panel",
            opacity: 0.5,
            scroll: true,
            receive: function (event, ui) {
                
                $(this).prepend( ui.item );                
                
            }
            
        }).disableSelection().accordion({
            
            header: "> .ut-admin-panel > header",
            heightStyle: "content",
            active: false,
            collapsible: true
        
        });
        
        /*
        |--------------------------------------------------------------------------
        | Add Font
        |--------------------------------------------------------------------------
        */
        function unite_add_google_font_to_collection( $font_object ) {
            
            if( !$font_object ) {
				return;
			}
            
            /* append font object to installed font list */            
            $font_object.find('.ut-add-google-font').addClass('ut-hide')
            $font_object.find('.ut-admin-panel-actions').removeClass('ut-hide');
            $font_object.find('.ut-delete-google-font').removeClass('ut-hide');
            
            $font_object.fadeOut( 400, function() {
                
                $(this).appendTo( $unite_google_font_collection ).removeClass('ut-single-google-font').fadeIn( 400, function(){
                    
                
                });
                
                $(".ut-sortable-fonts").accordion( "refresh" );
                
            });
            
        }
        
        /*
        |--------------------------------------------------------------------------
        | Delete Font
        |--------------------------------------------------------------------------
        */
        function unite_add_google_font_to_trash( $font_object ) {
            
            if( !$font_object ) {
				return;
			}
            
            /* disable accordion to prevent it from opening */
            $unite_google_font_trash.accordion( "disable" );
            $unite_google_font_collection.accordion( "disable" );
            
            /* append font object to installed font list */
            $font_object.fadeOut( 400, function() {
                
                var $this = $(this);
                
                /* enable accordion */
                $unite_google_font_trash.accordion( "enable" );
                $unite_google_font_collection.accordion( "enable" );
                
                /* move item */                
                $this.appendTo( $unite_google_font_trash ).fadeIn('400');
                
                /* show hide buttons */
                $this.find('.ut-delete-google-font').addClass('ut-hide');
                $this.find('.ut-restore-google-font').removeClass('ut-hide');
            
            });         
            
        }        
        
        /*
        |--------------------------------------------------------------------------
        | Restore Font from Trash
        |--------------------------------------------------------------------------
        */
        function unite_restore_google_font_from_trash( $font_object ) {
            
            if( !$font_object ) {
				return;
			}
                        
            /* disable accordion to prevent it from opening */
            $unite_google_font_trash.accordion( "disable" );
            $unite_google_font_collection.accordion( "disable" );
            
            /* append font object to installed font list */
            $font_object.fadeOut( 400, function() {
                
                var $this = $(this);
                
                /* enable accordion */
                $unite_google_font_trash.accordion( "enable" );
                $unite_google_font_collection.accordion( "enable" );
                
                
                /* move item */                
                $this.appendTo( $unite_google_font_collection ).fadeIn('400');
                
                /* show hide buttons */
                $this.find('.ut-delete-google-font').removeClass('ut-hide');
                $this.find('.ut-restore-google-font').addClass('ut-hide');
            
            });         
            
        }
        
        /*
        |--------------------------------------------------------------------------
        | Load Font Config Box via Ajax
        |--------------------------------------------------------------------------
        */
        function unite_get_font_settings_box( font_id ) {
                        
            $.ajax({
              
                type: 'POST',
                url: ajaxurl,
                data: {
                    "action": "get_font_settings_box", 
                    "familiy" : font_id 
                },
                success: function( response ) {
                                        
                    $(response).hide().insertAfter('#ut-font-search-panel').slideDown();
                                   
                },
                complete : function() {
                                

                        
                }
                    
            });            
        
        }        
        
        /*
        |--------------------------------------------------------------------------
        | Autocomplete for Google Fonts
        |--------------------------------------------------------------------------
        */
        
        if( unite_google_fonts.fonts !== undefined ) {
            
            $( "#ut_google_font_selector" ).autocomplete({
                
                source: unite_google_fonts.fonts,                
                focus: function( event, ui ) {
                    
                   
                    
                },
                select: function( event, ui ) {
                    
                    if( $( '#unite_font_id_'+ ui.item.value ).length ) {
                        
                        $( '#unite_font_id_'+ ui.item.value ).effect('highlight', { color: "#00b9eb" }, 800);
                        return;    
                        
                    }
                                        
                    /* unite_update_google_font_preview( ui.item ); */
                    unite_get_font_settings_box( ui.item.family );                    
                                        
                }
                
            });
        
        }
        
        /*
        |--------------------------------------------------------------------------
        | Button Actions 
        |--------------------------------------------------------------------------
        */
        
        $(document).on('click' , '.ut-preview-google-font' , function(event) {
            
            /* update preview */            
            unite_update_google_font_preview( $(this).data('fontid') );
            
            /* open preview */
            if( !preview_open ) {
                unite_show_google_font_preview();
            }
            
            event.preventDefault();
            
        });
        
        $(document).on('click' , '.ut-add-google-font' , function(event) {            
            
            /* add font */
            unite_add_google_font_to_collection( $('#unite_font_id_' + $(this).data('fontfamily') ) );
            event.preventDefault();
            
        });
        
        $(document).on('click' , '.ut-delete-google-font' , function(event) {
            
            /* delete font */
            unite_add_google_font_to_trash( $('#unite_font_id_' + $(this).data('fontfamily') ) );                        
            event.preventDefault();
            
        });
        
        $(document).on('click' , '.ut-restore-google-font' , function(event) {            
            
            /* restore font */
            unite_restore_google_font_from_trash( $('#unite_font_id_' + $(this).data('fontfamily') ) );
            event.preventDefault();
            
        });
       
         
    });
	
})(jQuery);
 /* ]]> */
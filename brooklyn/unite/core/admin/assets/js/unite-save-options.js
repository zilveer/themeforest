/* <![CDATA[ */
jQuery.noConflict();

;(function($){
	
	"use strict";
	
    $(document).ready(function(){
        
        function ajaxMessage( type , errormessage ) {
            
            $('.ut-options-overlay').fadeIn('fast', '', function(){
                
                if( !errormessage ) {
                
                    $('.ut-overlay-message.ut-'+type).slideDown('fast', '', function() {
                        
                        setTimeout(function(){ 
                            
                            $('.ut-overlay-message.ut-'+type).slideUp('fast', '', function(){
                                
                                $('.ut-options-overlay').fadeOut();
                                
                            });
                            
                        }, 2000 );
                        
                    });
                
                } else {
                    
                    $('.ut-overlay-message.ut-'+type).slideDown('fast', '', function() {
                        
                        $('.ut-error-message').html( errormessage );
                                                
                        /*setTimeout(function(){ 
                            
                            $('.ut-overlay-message.ut-'+type).slideUp('fast', '', function(){
                                
                                $('.ut-options-overlay').fadeOut();
                                
                            });
                            
                        }, 2000); */
                    
                    });
                
                }
                                    
            
            });
             
        }
        
        $(document).on( 'click', '.ut-view-message', function( event ) {
            
            $('.ut-popup-message').fadeIn();
            event.preventDefault();
            
        });
        
        $(document).on( 'click', '.ut-close-overlay-message', function( event ) {
            
            $('.ut-overlay-message').slideUp('fast', '', function(){
                
                $('.ut-popup-message').fadeOut();
                $('.ut-options-overlay').fadeOut();
                
            });
            
            event.preventDefault();
            
        });
        
        function disable_option_fields() {
            
            $('.ut-to-copy').each(function() {
                
               var $this = $(this);
               
               $this.find('.ut-option-element').prop('disabled', true);
                
            });
            
            if( $('#unite_options_export').length ) {
                $('#unite_options_export').prop('disabled', true);
            }
            
        }
        
        function enable_option_fields() {
            
            $('.ut-to-copy').each(function() {
                
               var $this = $(this);
               
               $this.find('.ut-option-element').prop('disabled', false);
                
            });
            
            if( $('#unite_options_export').length ) {
                $('#unite_options_export').prop('disabled', false);
            }
        
        }
        
        
        $('#unite-theme-options').submit( function(){
            
            /* disable copy fields */
            disable_option_fields();
            
            /* update tinymce */
            if( tinyMCE.editors.length ) {
                tinyMCE.triggerSave();
            }
            
            /* now serialize */
            var b = $(this).serialize();            
                        
            $.ajax({
              
                type: 'POST',
                url: ajaxurl,
                data: {
                    "action"      : "save_theme_options",
                    "save-nonce"  : unite.SaveOptionsNonce,
                    "options"     : b 
                },
                success: function(response) {                  
                                        
                    /* check if response is a json object */
                    if( response.status && typeof response != "undefined" && typeof response === 'object' ) {
                        
                        ajaxMessage( response.status );
                    
                    } else if( response.status && typeof response != "undefined" && typeof response != 'object' ) {
                        
                        ajaxMessage( 'error' , response );
                        
                    } else {
                        
                        ajaxMessage( 'error' , response );
                    
                    }
                    
                    /* re enable copy fields */
                    enable_option_fields();                    
                                   
                },
                error: function() {
                
                    ajaxMessage( 'error' );
                    
                    /* re enable copy fields */
                    enable_option_fields();
                
                }             
                    
            });
            
            return false;
            
        });
        
        $(document).on( 'click', '#ut-toolbar-save-theme-options', function( event ) {
            
            $('#unite-theme-options').submit();
            event.preventDefault();
            
        });        
        
        $(document).on( 'click', '.ut-add-theme-layout', function(event) {
            
            var layouts_name = $(this).siblings('input').val();                        
                        
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    "action"        : "save_theme_layouts",
                    "save-nonce"    : unite.SaveLayoutsNonce,
                    "layouts_name"  : layouts_name                    
                },
                success: function( response ) {
                                                            
                    $('.ut-options-overlay').fadeIn( 600, function() {
                    
                        location.reload();     
                    
                    });
                    
                },
                error: function() {
                
                
                }
            
            });            
            
            event.preventDefault();    
        
        });
        
        var editmode = false;
                
        function ut_rename_layout( $this, layout ) {
            
            if( layout === undefined || !layout.length ) {
                return;
            }
            
            $('.ut-layout-action').data('is-disabled', true );
            $this.toggleClass('ut-blue-button ut-gray-button');
            
            if( !editmode ) {
                                
                $('#ut-title-' + layout).prop("readonly", false).removeClass("hidden").focus().val();
                $this.data( 'is-disabled', false );
                
                editmode = true;
                
            } else {
                
                $('#ut-title-' + layout).prop("readonly", true).addClass("hidden");
                                
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        "action"         : 'rename_theme_layout',
                        "save-nonce"     : unite.SaveLayoutsNonce,
                        "ut_layout_id"   : layout,
                        "ut-layout-name" : $('#ut-title-' + layout).val()                      
                    },
                    success: function( response ) {
                        
                        if( response.status && typeof response !== "undefined" && typeof response === 'object' ) {
                            
                            $('#ut-title-' + layout).siblings("h4").text( $('#ut-title-' + layout).val() );                                    
                            
                        }
                         
                    },
                
                });
                
                $('.ut-layout-action').data('is-disabled', false );
                editmode = false;
                
            }
            
        
        }
        
        function ut_manage_layout( layout, action ) {
            
            if( layout === undefined || !layout.length || action === undefined || !action.length ) {
                return;
            }
                
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    "action"        : action,
                    "save-nonce"    : unite.SaveLayoutsNonce,
                    "ut_layout_id"  : layout
                    
                },
                success: function( response ) {
                    
                    if( response.status && typeof response !== "undefined" && typeof response === 'object' ) {
                        
                        $('.ut-options-overlay').fadeIn( 600, function() {
                            
                            ajaxMessage( response.status );
                            
                            location.reload(); 
                            
                        });                        
                        
                    }
                     
                },
                error: function() {
                
                
                }
            
            });
        
        }
        
        
        
        
        $(document).on( 'click', '.ut-layout-action', function() {
                                    
            var $this   = $(this),
                message = $this.data('message'),
                action  = $this.data('layout-action'),
                layout  = $this.data('layout-key');
                        
            if( action === 'rename_theme_layout' ) {
                
                if( $this.data('is-disabled') ) {                    
                    return false;                    
                }
                
                ut_rename_layout( $this, layout );
                
            } else {
                
                var cnfrm = confirm( message );
                            
                if( cnfrm !== true ) {
                
                    return false;
                
                } else {
                    
                    ut_manage_layout( layout, action );
                
                }
            }
            
        });        
        
    
    });
	
})(jQuery);
 /* ]]> */
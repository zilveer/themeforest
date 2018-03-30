(function($){
    var defaultOptions = {
        "nextClass" : "next",
        "skipClass" : "skip",
        "closeClass" : "close"
    };

    $.fn.tour = function( options ){
        var container = this;
        var index;
        var side;
        var opt = $.extend( {} , defaultOptions , options );
        return this.each(function(){            
            index = 0;
            jQuery( "." + opt.nextClass , this ).click(function(){
                index = parseInt( jQuery( this ).parent().parent().parent().attr('index') );
                side  = jQuery( this ).parent().parent().parent().data('rel');
                jQuery( container ).each(function( i ){
                    if( index + 1 == parseInt( jQuery( this ).attr('index') ) ){
                        jQuery( this ).fadeTo('slow', 1 );
                        jQuery.cookie(cookies_prefix + '_tour_stap_' + side , index + 1 , {expires: 365, path: '/' } );
                        jQuery( this ).gonext();
                        
                    }else{
                        jQuery( this ).fadeTo('slow', 0 , function(){
                            jQuery( this ).hide();
                        });
                    }
                });
            });

            jQuery( "." + opt.skipClass , this ).click(function(){
                index = parseInt( jQuery( this ).parent().parent().parent().attr('index') );
                side  = jQuery( this ).parent().parent().parent().data('rel');
                jQuery( this ).parent().parent().parent().fadeTo('slow', 0 , function(){
                    jQuery( this ).hide();
                });
                jQuery.cookie(cookies_prefix + '_tour_stap_' + side , index , {expires: 365, path: '/' } );
            });
            jQuery( "." + opt.closeClass , this ).click(function(){
                side  = jQuery( this ).parent().parent().parent().data('rel');
                jQuery( this ).parent().parent().parent().fadeTo('slow', 0 , function(){
                    jQuery( this ).hide();
                });
                
                jQuery.cookie(cookies_prefix + '_tour_closed_' + side , 'true' , {expires: 365, path: '/' } );
            });
        });
    }

    $.fn.gonext = function(){
        var h = parseInt((parseInt( jQuery( window ).height() ) - parseInt( jQuery( this ).height()) ) / 2 );
        if( jQuery( this ).offset().top > h ){
            jQuery.scrollTo( jQuery( this ).offset().top - h , 400 );
        }
    }
})(jQuery)
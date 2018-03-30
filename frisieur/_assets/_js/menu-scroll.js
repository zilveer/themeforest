/**
 *
 * jQuery plugin - scroll to page section after
 * click on menu item
 * 
 * @author: Martanian <hello@martanian.com>
 * @date: 2013-10-27
 * 
 */       

(function( $ ) {

    $.fn.martanianMenu = function() {

       /**
        *
        * plugin selector
        * 
        */                               

        pluginSelector = $( this ).selector;
        
       /**
        *
        * wait for action
        *         
        */ 
        
        $( pluginSelector +' a' ).click( function() {

            hash = $( this ).context.hash;
            if( hash != '' && hash != 'undefined' ) {

                sectionPos = getSectionPosition( hash );
                $( 'html, body' ).animate( { scrollTop : sectionPos }, 1500 );
            }
        
        });
        
       /**
        *
        * get the section position in document
        *
        */
        
        function getSectionPosition( sectionName ) {
            
            sectionName = sectionName.substr( 1 );
            sectionOffset = $( 'section[data-section-name="'+ sectionName +'"]' ).offset();

            if( typeof sectionOffset != 'undefined' && sectionOffset !== false ) return( sectionOffset.top - 70 );
            else return( 0 );
        }                                                             
                                    
       /**
        *
        * end of line.
        *
        */                                        
    }     

}( jQuery ));

/**
 *
 * jQuery plugin - scroll to page section
 * after page load 
 * 
 * @author: Martanian <hello@martanian.com>
 * @date: 2013-10-29
 * 
 */       

(function( $ ) {

    $.fn.martanianScrollOnLoad = function() {
        
        $( window ).load( function() {
        
            setTimeout( function() {
            
                hash = $( this )[0].window.location.hash;
                if( hash != '' && hash != 'undefined' ) {
    
                    sectionPos = getSectionPosition( hash );
                    $( 'html, body' ).scrollTop( sectionPos );
                }
            
            }, 500 );
            
        });
        
       /**
        *
        * get the section position in document
        *
        */

        function getSectionPosition( sectionName ) {

            sectionName = sectionName.substr( 1 );
            sectionOffset = $( 'section[data-section-name="'+ sectionName +'"]' ).offset();

            if( typeof sectionOffset != 'undefined' && sectionOffset !== false ) return( sectionOffset.top - 70 );
            else return( 0 );
        }                                                            
                                    
       /**
        *
        * end of line.
        *
        */                                        
    }     

}( jQuery ));
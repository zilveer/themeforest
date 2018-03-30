/**
 *
 * jQuery plugin - gallery for website template.
 * 
 * @author: Martanian <hello@martanian.com>
 * @date: 2013-10-23
 * 
 */       

(function( $ ) {

    $.fn.martanianGallery = function() {
    
       /**
        *
        * gallery items array
        *
        */
                                        
        galleryArray = new Array();                              
        
       /**
        *
        * gallery active flag
        * 
        */
        
        galleryActive = false;                               
       
       /**
        *
        * minimum space between image and window border 
        * 
        */  
        
        minimumSpace = 50;                             
       
       /**
        *
        * current image pos
        * 
        */
        
        currentImagePos = 0;                               
       
       /**
        *
        * insert gallery items to array
        *
        */                                
        
        for( i = 0; i < this.length; i++ ) {

            backgroundImage = getImageURL( $( this[i] ).context.style.backgroundImage );
            if( backgroundImage != false ) {
            
                galleryArray.push( backgroundImage );
            }
        }
        
       /**
        *
        * wait for click
        * 
        */                                

        this.bind( 'click.martanianGallery', function() {

            elementPos = getPosInGallery( $( this ) );
            galleryInit( elementPos );

        });
        
       /**
        *
        * close popup if click outside the image
        * 
        */
        
        $( 'html' ).on( 'click', '.gallery-popup-background', function() { galleryClose(); });
        
       /**
        *
        * change current image
        * 
        */
        
        $( 'html' ).on( 'click', '.gallery-popup-next-image', function() { nextGalleryItem(); });
        $( 'html' ).on( 'click', '.gallery-popup-prev-image', function() { prevGalleryItem(); });                                
        
       /**
        *
        * actions on keydown
        * 
        */
        
        $( document ).keydown( function( e ) {

            switch( e.keyCode ) {

                case 27: galleryClose(); break;
                case 37: prevGalleryItem(); break;
                case 39: nextGalleryItem(); break;
            }
        
        });
        
       /**
        *
        * initialize gallery
        * 
        */
        
        function galleryInit( elementPos ) {
        
            if( galleryActive == false ) {
            
                $( 'body' ).append( '<div id="gallery-popup"><div class="gallery-popup-background"></div><div class="gallery-popup-content"><div class="gallery-popup-prev-image"><i class="icon-chevron-left"></i></div><div class="gallery-popup-next-image"><i class="icon-chevron-right"></i></div></div></div>' );
                
                $( '#gallery-popup' ).show();
                $( '#gallery-popup .gallery-popup-background' ).animate( { 'opacity' : 0.7 }, 400 );
                
                setTimeout( function() {

                    openImage( elementPos, 'load' );
                    $( '#gallery-popup .gallery-popup-content' ).addClass( 'animated bounceInDown' );

                }, 200 );
                
                galleryActive = true;
            }        
        }  
        
       /**
        *
        * close gallery
        * 
        */
        
        function galleryClose() {
        
            $( '#gallery-popup .gallery-popup-content' ).removeClass( 'speed' ).addClass( 'animated bounceOutUp' );
            setTimeout( function() {

                $( '#gallery-popup .gallery-popup-background' ).animate( { 'opacity' : 0 }, 400 );
                setTimeout( function() {
                
                    $( '#gallery-popup' ).remove();
                    galleryActive = false;
                    
                }, 300 );
            
            }, 600 );    
        }
        
       /**
        *
        * next gallery item
        * 
        */
        
        function nextGalleryItem() {

            newElementPos = currentImagePos + 1;
            $( '#gallery-popup .gallery-popup-content' ).removeClass( 'bounceInDown' );

            if( typeof galleryArray[newElementPos] != 'undefined' ) openImage( newElementPos, 'load next' );
            else openImage( 0, 'load next' );   
        }
        
       /**
        *
        * prev gallery item
        * 
        */
        
        function prevGalleryItem() {

            newElementPos = currentImagePos - 1;
            $( '#gallery-popup .gallery-popup-content' ).removeClass( 'bounceInDown' );

            if( typeof galleryArray[newElementPos] != 'undefined' ) openImage( newElementPos, 'load prev' );
            else openImage( ( galleryArray.length - 1 ), 'load prev' );      
        }                                                                   
        
       /**
        *
        * open image function
        * 
        */
        
        function openImage( elementPos, actionType ) {

            currentImagePos = elementPos;
            
            imageURL = $( '<img />' ).attr( 'src', galleryArray[elementPos] +'?' + new Date().getTime() );
            $( imageURL ).load( function() {
            
                imageWidth = $( this ).context.naturalWidth;
                imageHeight = $( this ).context.naturalHeight;
                
                windowWidth = $( window ).width();
                windowHeight = $( window ).height();

                if( imageWidth > ( windowWidth - minimumSpace ) ) {
                
                    newImageWidth = windowWidth - minimumSpace;
                    factor = newImageWidth / imageWidth;
                    
                    imageWidth = newImageWidth;
                    imageHeight = imageHeight * factor;
                }
                
                if( imageHeight > ( windowHeight - minimumSpace ) ) {
                
                    newImageHeight = windowHeight - minimumSpace;
                    factor = newImageHeight / imageHeight;
                    
                    imageWidth = imageWidth * factor;
                    imageHeight = newImageHeight;
                }
                
                if( actionType == 'load' ) {
                
                    $( '#gallery-popup .gallery-popup-content' ).css({
                        'width' : imageWidth,
                        'height' : imageHeight,
                        'marginTop' : - ( imageHeight / 2 ) +'px',
                        'marginLeft' : - ( imageWidth / 2 ) +'px',
                        'backgroundImage' : 'url( "'+ galleryArray[elementPos] +'" )'
                    });
                }
                
                else if( actionType == 'load next' ) {
                
                    $( '#gallery-popup .gallery-popup-content' ).addClass( 'speed fadeOutLeft' );
                    setTimeout( function() {
                    
                        $( '#gallery-popup .gallery-popup-content' ).css({
                            'width' : imageWidth,
                            'height' : imageHeight,
                            'marginTop' : - ( imageHeight / 2 ) +'px',
                            'marginLeft' : - ( imageWidth / 2 ) +'px',
                            'backgroundImage' : 'url( "'+ galleryArray[elementPos] +'" )'
                        });

                        setTimeout( function() {
                            
                            $( '#gallery-popup .gallery-popup-content' ).removeClass( 'fadeOutRight fadeOutLeft fadeInRight fadeInLeft' );
                            $( '#gallery-popup .gallery-popup-content' ).addClass( 'fadeInRight' );
                        
                        }, 100 );
                        
                    }, 300 );
                }
                
                else if( actionType == 'load prev' ) {
                
                    $( '#gallery-popup .gallery-popup-content' ).addClass( 'speed fadeOutRight' );
                    setTimeout( function() {
                    
                        $( '#gallery-popup .gallery-popup-content' ).css({
                            'width' : imageWidth,
                            'height' : imageHeight,
                            'marginTop' : - ( imageHeight / 2 ) +'px',
                            'marginLeft' : - ( imageWidth / 2 ) +'px',
                            'backgroundImage' : 'url( "'+ galleryArray[elementPos] +'" )'
                        });

                        setTimeout( function() {
                            
                            $( '#gallery-popup .gallery-popup-content' ).removeClass( 'fadeOutRight fadeOutLeft fadeInRight fadeInLeft' );
                            $( '#gallery-popup .gallery-popup-content' ).addClass( 'fadeInLeft' );
                        
                        }, 100 );
                        
                    }, 300 );
                }
                
            });   

        }   
        
       /**
        *
        * responsive
        * 
        */
        
        $( window ).resize( function() {
        
            if( galleryActive == true ) {
            
                openImage( currentImagePos, 'load' );
            }
        
        });                                                                                        
        
       /**
        *
        * get image url
        * 
        */                                
        
        function getImageURL( image ) {
        
            backgroundURL = /^url\((['"]?)(.*)\1\)$/.exec(image);
            return( backgroundURL ? backgroundURL[2] : false );
        }
        
       /**
        *
        * get element position in gallery
        * 
        */                                
        
        function getPosInGallery( element ) {
        
            backgroundImage = getImageURL( element.context.style.backgroundImage );
            for( i = 0; i < galleryArray.length; i++ ) {
            
                if( backgroundImage == galleryArray[i] ) return( i );
            }
            
            return false;
        }
        
       /**
        *
        * end of line.
        *
        */                                        
    }     

}( jQuery ));
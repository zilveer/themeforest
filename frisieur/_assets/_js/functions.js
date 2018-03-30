jQuery( document ).ready( function() {

   /**
    *
    * contact form
    * 
    */

    jQuery( '#contact-form button[name=send]' ).click( function() {

        values = {
            'name' : '',
            'email' : '',
            'phone' : '',
            'subject' : '',
            'message' : ''
        };
        
        areErrors = false;
        jQuery.each( values, function( key, value ) {
        
            currentElement = jQuery( '*[name='+ key +']' );
            values[key] = currentElement.val();
            
            if( values[key] != false ) { currentElement.parent().removeClass( 'error' ); }
            else {
            
                currentElement.parent().addClass( 'error' );
                areErrors = true;
            }
        
        });
        
        if( areErrors == false ) {
        
            // your action here, for example sending an email...
            jQuery.ajax({
                url: path_to_template +'/_assets/submit.php',
                data: { 'submit': 'contact-form', 'data': values, 'email': contact_form_contact },
                type: 'post',
                success: function( output ) {

                    // animation after your action
                    jQuery.contactFormAnimation();
                }
            });
        }   

    });
    
    jQuery.contactFormAnimation = function() {
    
        formHeight = jQuery( '#contact-form-section-form' ).height();
        jQuery( '#contact-form-section-form' ).css({ 'minHeight' : formHeight });
        
        jQuery( '#contact-form-fields' ).fadeOut( 300 );
        setTimeout( function() {
        
            jQuery( '.contact-form-thanks' ).fadeIn( 300 );
        
        }, 400 );  
    }
    
   /**
    *
    * appointment form
    * 
    */
    
    jQuery( '#appointment-popup' ).on( 'click', 'input.submit-appointment', function() {
    
        values = {
            'name' : '',
            'phone' : '',
            'email' : '',
            'appointment-date' : '',
            'approximate-time' : '',
            'additional-notes' : ''
        };
        
        areErrors = false;
        jQuery.each( values, function( key, value ) {
        
            currentElement = jQuery( '#appointment-form-in-popup form *[name='+ key +']' );
            values[key] = currentElement.val();
            
            if( values[key] != false ) { currentElement.removeClass( 'error' ); }
            else {
            
                currentElement.addClass( 'error' );
                areErrors = true;
            }
        
        });
        
        if( areErrors == false ) {
        
            // your action here, for example sending an email...
            jQuery.ajax({
                url: path_to_template +'/_assets/submit.php',
                data: { 'submit': 'appointment-form', 'data': values, 'email': appointment_contact },
                type: 'post',
                success: function( output ) {

                    // animation after your action
                    jQuery.appointmentFormAnimation();
                }
            });
        }
    
    });
    
    jQuery.appointmentFormAnimation = function() {
    
        formHeight = jQuery( '.appointment-popup-content' ).height();
        jQuery( '.appointment-popup-content' ).css({ 'minHeight' : formHeight });
        
        jQuery( '#appointment-form-in-popup form' ).fadeOut( 300 );
        setTimeout( function() {

            jQuery( '#appointment-form-in-popup .thanks' ).fadeIn( 300 );
        
        }, 400 );      
    }                
    
   /**
    *
    * responsive menu
    * 
    */

    jQuery( '.responsive-menu, .scrollable-menu-responsive' ).click( function() {
    
        jQuery( '#responsive-menu-wrapper' ).css({ 'display' : 'block' });
        jQuery( '#responsive-menu-window' ).fadeIn( 300 ); 
        
        jQuery( 'html, body' ).animate( { scrollTop : 0 }, 500 );
                                
    });
    
    
    jQuery( '.close-responsive-menu, .responsive-menu-list a' ).click( function() {
        jQuery( '#responsive-menu-window' ).fadeOut( 300 );
    });
   
   /**
    *
    * go-top button
    * 
    */

    goTopVisible = false;
    jQuery( window ).scroll( function() {
    
        scrollPos = jQuery( this ).scrollTop();
        if( scrollPos > 250 ) {
        
            if( goTopVisible == false ) {
            
                jQuery( '#go-top' ).fadeIn( 500 );
                goTopVisible = true;
            }
        }
        
        else {
        
            if( goTopVisible == true ) {
            
                jQuery( '#go-top' ).fadeOut( 500 );
                goTopVisible = false;
            }
        }
        
    });

    jQuery( '#go-top' ).click( function() { jQuery( 'html, body' ).animate( { scrollTop : 0 }, 750 ); });
    
   /**
    *
    * go-top button remove to right
    * 
    */
    
    jQuery.goTopRemove = function() {
    
        containerWidth = jQuery( '#container' ).width();
        marginLeft = ( containerWidth / 2 );
        
        jQuery( '#go-top' ).css({ 'marginLeft' : marginLeft }); 
    }
    
    jQuery( window ).load( function() { jQuery.goTopRemove(); });
    jQuery( window ).resize( function() { jQuery.goTopRemove(); });
   
   /**
    *
    * scrollable menu
    * 
    */
    
    responsiveMenuHashes = false;
    responsiveMenuVisible = false;
    
    jQuery( window ).scroll( function() {
    
        scrollPos = jQuery( this ).scrollTop();
        startShowing = jQuery( '#main-content' ).offset().top;
        
        if( scrollPos > startShowing ) {
        
            if( responsiveMenuVisible == false ) {
            
                jQuery( '#scrollable-menu-wrapper' ).fadeIn( 100 );
                responsiveMenuVisible = true;
            }
        }
        
        else {
        
            if( responsiveMenuVisible == true ) {
            
                jQuery( '#scrollable-menu-wrapper' ).fadeOut( 100 );
                responsiveMenuVisible = false;
            }
        }
        
        if( responsiveMenuVisible == true ) {
        
            if( responsiveMenuHashes == false ) {
            
                responsiveMenuHashes = new Array();
                jQuery( '.scrollable-menu-list li' ).each( function() {
                
                    element = jQuery( this ).children( 'a' );
                    if( element[0].hash != '' && typeof element[0].hash != 'undefined' ) {
    
                        responsiveMenuHashes.push( element[0].hash.substr( 1 ) );
                    }
                
                });
            }
        }
        
    }); 
    
   /**
    *
    * sub-menu animated
    * 
    */
    
    jQuery( 'header .sub-menu, #scrollable-menu-wrapper .sub-menu' ).each( function() {
    
        jQuery( this ).addClass( 'animated speed fadeInUp' );
    
    });  
    
    jQuery( '.menu-left li, .menu-right li, .scrollable-menu-list li' ).hover( function() {
    
        element = jQuery( this ).children( '.sub-menu' );
        element.css({ 'display' : 'block' });
    
    }, function() {
        
        element = jQuery( this ).children( '.sub-menu' );
        element.css({ 'display' : 'none' });
    
    });                            
   
   /**
    *
    * cycle functions
    * 
    */
    
    jQuery( window ).load( function() {
    
        jQuery( '.make-slideshow' ).cycle({
            fx: 'fadeout',
            speed: 500,
            timeout: 0,
            slides: '> div',
            prev: '> .presentation-prev-button',
            next: '> .presentation-next-button',
            autoHeight: 'container'
        });

        jQuery( '.team-box-profiles' ).cycle({
            fx: 'fadeout',
            speed: 500,
            timeout: 0,
            slides: '> div',
            prev: '.persons-switch .prev',
            next: '.persons-switch .next'
        });
        
        jQuery( '#header-background-images' ).cycle({
            fx: 'fade',
            speed: 500,
            timeout: 5000,
            slides: '> div'
        });
    
    });
    
   /**
    *
    * scroll animations
    * 
    */
    
    jQuery( window ).load( function() {

        setTimeout( function() {
        
            jQuery( '.waitForLoad' ).removeClass( 'waitForLoad' ).addClass( 'animated' );
        
        }, 200 );
    
    }); 
    
    jQuery( window ).scroll( function() {
    
        scrollTop = jQuery( this ).scrollTop();
        jQuery( '.waitForScroll' ).each( function() {
        
            elementOffset = jQuery( this ).offset();
            if( elementOffset.top - scrollTop < 750 ) {
            
                jQuery( this ).removeClass( 'waitForScroll' ).addClass( 'animated' );
            }
        
        });
    
    }); 
    
   /**
    *
    * progress bar
    *
    */
    
    progressBarDone = new Array();
    jQuery.progressBarStart = function( parent ) {

        if( progressBarDone[parent] == undefined ) {
        
            jQuery( parent +' .progress-value' ).each( function() {
            
                element_width = jQuery( this ).attr( 'data-value' ) + '%';
                jQuery( this ).animate( { 'width' : element_width }, 900 );
            
            });
        } 
        
        progressBarDone[parent] = 'done'; 
    }

    jQuery( window ).scroll( function() {
    
        scrollTop = jQuery( this ).scrollTop();
        elementOffset = jQuery( '.single-profile[data-profile-id="1"]' ).offset();

        if( typeof elementOffset != 'undefined' && elementOffset !== false ) {
        
            if( elementOffset.top - scrollTop < 500 ) {
            
                setTimeout( function() {
        
                    jQuery.progressBarStart( '.single-profile[data-profile-id="1"]' );
                
                }, 300 );
            }
        }
        
    });      
    
    jQuery( '.team-box-profiles' ).on( 'cycle-after', function( event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag ) {
    
        profileID = jQuery( incomingSlideEl ).attr( 'data-profile-id' );
        jQuery.progressBarStart( '.single-profile[data-profile-id="'+ profileID +'"]' );

    }); 
    
   /**
    *
    * show appointment timepicker
    * 
    */

    jQuery( '.approximate-time' ).focus( function() {
        
        timeboxID = jQuery( this ).data( 'timebox-id' );
        
        jQuery( '.approximate-time-box[data-timebox-id="'+ timeboxID +'"]' ).show();
        jQuery( this ).addClass( 'approximate-time-box-active' );
        
    }); 
    
    jQuery( '#appointment-popup' ).on( 'focus', '.approximate-time', function() {
        
        jQuery( '#appointment-popup .approximate-time-box' ).show();
        jQuery( this ).addClass( 'approximate-time-box-active' );
        
    });
    
    jQuery( document ).click( function( e ) {
        
        if( jQuery( e.target ).closest( '.approximate-time-input' ).length === 0 ) {
            
            jQuery( '.approximate-time-box' ).hide();
            jQuery( '.approximate-time' ).removeClass( 'approximate-time-box-active' );
        }
        
    });

   /**
    *
    * functions for 12h timepicker
    * 
    */
    
    if( typeof timepickerType == 'undefined' || timepickerType === false ) timepickerType = '12h';
    if( timepickerType == '12h' ) {                
    
        jQuery.hour_up = function( hour ) {
        
            console.log( 'click' );
            
            hour = hour + 1;
    
            if( hour == 13 ) {
            
                hour = 1;
                result = String( '1' );
    
                jQuery.changeTimeType( jQuery( '.time-selector-type' ).attr( 'data-value' ) );
            }
            
            else {
                
                result = String( hour );
            }
            
            jQuery( '.time-selector-hours' ).attr( 'data-value', hour ).html( result );  
        }
        
        jQuery.hour_down = function( hour ) {
        
            hour = hour - 1;
    
            if( hour == 0 ) {
            
                hour = 12;
                result = String( '12' );
                
                jQuery.changeTimeType( jQuery( '.time-selector-type' ).attr( 'data-value' ) );
            }
            
            else {
            
                result = String( hour );
            }
            
            jQuery( '.time-selector-hours' ).attr( 'data-value', hour ).html( result );    
        }
        
        jQuery.mins_up = function( mins ) {
        
            mins = mins + 15;
    
            if( mins == 60 ) { 
                
                jQuery.hour_up( parseInt( jQuery( '.time-selector-hours' ).attr( 'data-value' ) ) );
                
                mins = 0;
                result = String( '00' );
            }
            
            else {
            
                result = String( mins );
            }
            
            jQuery( '.time-selector-mins' ).attr( 'data-value', mins ).html( result );
        }  
        
        jQuery.mins_down = function( mins ) {
        
            mins = mins - 15;
    
            if( mins == 0 ) {
            
                mins = 0;
                result = String( '00' );
            }
            
            else if( mins == -15 ) { 
            
                jQuery.hour_down( parseInt( jQuery( '.time-selector-hours' ).attr( 'data-value' ) ) );
                
                mins = 45;
                result = String( '45' );
            }
            
            else {
            
                result = String( mins );
            }
            
            jQuery( '.time-selector-mins' ).attr( 'data-value', mins ).html( result ); 
        }
        
        jQuery.changeTimeType = function( type ) {
    
            if( type == 'am' ) new_type = 'pm';
            else new_type = 'am';
            
            jQuery( '.time-selector-type' ).attr( 'data-value', new_type ).html( new_type );
        }
        
        jQuery.getTimeValue = function() {
        
            hour = jQuery( '.time-selector-hours' ).attr( 'data-value' );
            mins = jQuery( '.time-selector-mins' ).attr( 'data-value' );
            type = jQuery( '.time-selector-type' ).attr( 'data-value' );
            
            if( mins == '0' ) mins = '00';
            
            result = hour +':'+ mins +' '+ type;
            return( result );
        }
        
        jQuery.manageApproximateTime = function( currentElement ) {
        
            if( currentElement.hasClass( 'hours' ) ) {
    
                value = parseInt( jQuery( '.time-selector-hours' ).attr( 'data-value' ) );
                
                if( currentElement.hasClass( 'hours-up' ) ) { jQuery.hour_up( value ); }
                else if( currentElement.hasClass( 'hours-down' ) ) { jQuery.hour_down( value ); }
            }
            
            else if( currentElement.hasClass( 'mins' ) ) {
            
                value = parseInt( jQuery( '.time-selector-mins' ).attr( 'data-value' ) );
                
                if( currentElement.hasClass( 'mins-up' ) ) { jQuery.mins_up( value ); }
                else if( currentElement.hasClass( 'mins-down' ) ) { jQuery.mins_down( value ); }
            }
            
            else if( currentElement.hasClass( 'time-type' ) ) {
            
                value = jQuery( '.time-selector-type' ).attr( 'data-value' );
                jQuery.changeTimeType( value );
            }
            
            jQuery( '.approximate-time' ).val( jQuery.getTimeValue() );       
        }
    }
    
   /**
    *
    * functions for 24h timepicker
    * 
    */
    
    if( timepickerType == '24h' ) {
    
        jQuery.hour_up = function( hour ) {
        
            hour = hour + 1;
    
            if( hour == 24 ) {
            
                hour = 0;
                result = String( '0' );
            }
            
            else {
                
                result = String( hour );
            }
            
            jQuery( '.time-selector-hours' ).attr( 'data-value', hour ).html( result );
        }
        
        jQuery.hour_down = function( hour ) {
        
            hour = hour - 1;
    
            if( hour == -1 ) {
            
                hour = 23;
                result = String( '23' );
            }
            
            else {
            
                result = String( hour );
            }
            
            jQuery( '.time-selector-hours' ).attr( 'data-value', hour ).html( result ); 
        }
        
        jQuery.mins_up = function( mins ) {
        
            mins = mins + 15;
    
            if( mins == 60 ) { 
                
                jQuery.hour_up( parseInt( jQuery( '.time-selector-hours' ).attr( 'data-value' ) ) );
                
                mins = 0;
                result = String( '00' );
            }
            
            else {
            
                result = String( mins );
            }
            
            jQuery( '.time-selector-mins' ).attr( 'data-value', mins ).html( result );
        }  
        
        jQuery.mins_down = function( mins ) {
        
            mins = mins - 15;
    
            if( mins == 0 ) {
            
                mins = 0;
                result = String( '00' );
            }
            
            else if( mins == -15 ) { 
            
                jQuery.hour_down( parseInt( jQuery( '.time-selector-hours' ).attr( 'data-value' ) ) );
                
                mins = 45;
                result = String( '45' );
            }
            
            else {
            
                result = String( mins );
            }
            
            jQuery( '.time-selector-mins' ).attr( 'data-value', mins ).html( result ); 
        }
        
        jQuery.getTimeValue = function() {
        
            hour = jQuery( '.time-selector-hours' ).attr( 'data-value' );
            mins = jQuery( '.time-selector-mins' ).attr( 'data-value' );
            
            if( mins == '0' ) mins = '00';
            
            result = hour +':'+ mins;
            return( result );
        }
        
        jQuery.manageApproximateTime = function( currentElement ) {
        
            if( currentElement.hasClass( 'hours' ) ) {
    
                value = parseInt( jQuery( '.time-selector-hours' ).attr( 'data-value' ) );
                
                if( currentElement.hasClass( 'hours-up' ) ) { jQuery.hour_up( value ); }
                else if( currentElement.hasClass( 'hours-down' ) ) { jQuery.hour_down( value ); }
            }
            
            else if( currentElement.hasClass( 'mins' ) ) {
            
                value = parseInt( jQuery( '.time-selector-mins' ).attr( 'data-value' ) );
                
                if( currentElement.hasClass( 'mins-up' ) ) { jQuery.mins_up( value ); }
                else if( currentElement.hasClass( 'mins-down' ) ) { jQuery.mins_down( value ); }
            }
            
            jQuery( '.approximate-time' ).val( jQuery.getTimeValue() );    
        }
    }
    
   /**
    *
    * timepicker events
    * 
    */               

    jQuery( '.time-change-action-event' ).click( function() { jQuery.manageApproximateTime( jQuery( this ) ); });
    
   /**
    *
    * appointment date datepicker
    * 
    */

    jQuery( '.appointment-datepicker' ).datepicker({
    
        dateFormat: "yy-mm-dd",
        minDate: new Date(),
    });  
    
    jQuery( window ).resize( function() { jQuery( '#ui-datepicker-div' ).hide(); });                                             

   /**
    *
    * appointment popup functions
    * 
    */
    
    jQuery.loadAppointmentForm = function( appointmentDate, approximateTime ) {
                
        jQuery( '#appointment-popup' ).show();
        jQuery( '#appointment-popup .appointment-popup-background' ).animate( { 'opacity' : 0.7 }, 400 );

        setTimeout( function() {

            jQuery( '#appointment-popup .appointment-popup-content' ).addClass( 'animated bounceInDown' ).show();
            jQuery( '#appointment-popup .appointment-popup-content .appointment-datepicker' ).datepicker({
                dateFormat: "yy-mm-dd",
                minDate: new Date(),
                beforeShow: function( input, inst ) {
                    jQuery( '#ui-datepicker-div' ).addClass( 'in-appointment-popup' ); 
                }
            });
            
            jQuery( '#appointment-popup input[name=appointment-date]' ).val( appointmentDate );
            if( approximateTime != '' ) {
            
                jQuery( '#appointment-popup input[name=approximate-time]' ).val( approximateTime );
                
                timeSplit = approximateTime.split( ' ' );
                timeSplit[0] = timeSplit[0].split( ':' );

                jQuery( '.approximate-time-box .time-selector-hours' ).attr( 'data-value', timeSplit[0][0] ).html( timeSplit[0][0] );
                jQuery( '.approximate-time-box .time-selector-mins' ).attr( 'data-value', timeSplit[0][1] ).html( ( timeSplit[0][1] == 0 ? '00' : timeSplit[0][1] ) );
                jQuery( '.approximate-time-box .time-selector-type' ).attr( 'data-value', timeSplit[1] ).html( timeSplit[1] );
            } 
            
            windowWidth = jQuery( window ).width();
            if( windowWidth <= 599 ) {

                parentWidth = windowWidth - 80;
                
                jQuery( '#appointment-popup .appointment-popup-content .appointment-form input[type=text]' ).css({ 'width' : parentWidth - 61 +'px' });
                jQuery( '#appointment-popup .appointment-popup-content .appointment-form textarea' ).css({ 'width' : parentWidth - 26 +'px' });
            }
            
        }, 200 ); 

    }; 
    
    jQuery.closeAppointmentForm = function() {
    
        jQuery( '#appointment-popup .appointment-popup-content' ).addClass( 'animated bounceOutUp' );
        setTimeout( function() {

            jQuery( '#appointment-popup .appointment-popup-content' ).hide().removeClass( 'animated bounceOutUp' ).css({ 'minHeight' : '', 'height' : '' });
            jQuery( '#appointment-popup .appointment-popup-background' ).animate( { 'opacity' : 0 }, 400 );
            
            setTimeout( function() {
            
                jQuery( '#appointment-popup' ).hide();

            }, 300 );
        
        }, 600 );  
    }

    jQuery( '.open-appointment-box' ).click( function() { jQuery.loadAppointmentForm( '', '' ); }); 
    jQuery( '.open-appointment-box-with-data' ).click( function() { 

        appointmentDate = jQuery( '.appointment-datepicker' ).val();
        approximateTime = jQuery( '.approximate-time' ).val();
        
        jQuery.loadAppointmentForm( appointmentDate, approximateTime );
    
    }); 

    jQuery( '#appointment-popup' ).on( 'click', '#close-popup', function() { jQuery.closeAppointmentForm(); });  

    if( jQuery( window ).width() < 849 ) {
   
        jQuery( '.open-appointment-box, .open-appointment-box-with-data' ).click( function() {
        
            jQuery( 'html, body' ).animate( { scrollTop : 0 }, 500 );
        
        });
    }
    
   /**
    *
    * gallery images height same as width
    * 
    */
    
    jQuery.setGalleryImageHeight = function( element ) {

        elementWidth = element.width();
        elementMargin = parseInt( element.css( 'marginLeft' ) ) * 2;
        
        element.css({ 'height' : elementWidth, 'marginBottom' : elementMargin });     
    }               
    
    jQuery( window ).load( function() { jQuery.setGalleryImageHeight( jQuery( '.gallery-item' ) ); });
    jQuery( window ).resize( function() { jQuery.setGalleryImageHeight( jQuery( '.gallery-item' ) ); });
   
   /**
    *
    * gallery item background animate
    * 
    */

    jQuery( '.gallery-item' ).martanianGallery();
    jQuery( '.item-background' ).hover( function() {
    
        jQuery( this ).animate( { 'opacity' : 0.9 }, 300 );
    
    }, function() {
    
        jQuery( this ).animate( { 'opacity' : 0 }, 300 );
        
    }); 
    
   /**
    *
    * isotope
    * 
    */
    
    $isotopeSelector = '*';
    $isotopeContainer = jQuery( '.gallery-items' );
    
    jQuery( window ).load( function() {

        $isotopeContainer.isotope({
            filter: $isotopeSelector,
            resizable: false
        });
    
        jQuery( '.gallery-filters button' ).click( function() {
      
            if( jQuery( this ).hasClass( 'button-brown' ) ) return false;
            
            jQuery( '.gallery-filters .button-brown' ).removeClass( 'button-brown' ).addClass( 'button-gray' );
        		jQuery( this ).removeClass( 'button-gray' ).addClass( 'button-brown' );
    
            $isotopeSelector = jQuery( this ).attr( 'data-filter' );
            
            $isotopeContainer.isotope({ 
                filter: $isotopeSelector,
                resizable: false
            });
            
        });
    });  
    
    jQuery( window ).resize( function() {
    
        $isotopeContainer.isotope( 'destroy' );
        $isotopeContainer.isotope({ 
            filter: $isotopeSelector,
            resizable: false
        });
    
    }); 
    
   /**
    *
    * scrollable menu
    * 
    */

    jQuery( window ).martanianScrollOnLoad();

    jQuery( '.top-header-box .menu-left' ).martanianMenu();   
    jQuery( '.top-header-box .menu-right' ).martanianMenu();   
    jQuery( '.responsive-menu-list' ).martanianMenu();
    jQuery( '.scrollable-menu-list' ).martanianMenu(); 
    
   /**
    *
    * blog post images slider
    * 
    */
    
    jQuery( window ).load( function() {
    
        jQuery( '.blog-post-images' ).cycle({ 
            fx: 'fadeout',
            speed: 500,
            timeout: 0,
            prev: '> .image-change-right',
            next: '> .image-change-left',
            autoHeight: 'container'
        });
    });   
    
   /**
    *
    * alert boxes
    * 
    */
    
    jQuery( '.alert-box i' ).click( function() {
    
        element = jQuery( this ).parent();
        element.animate( { 'opacity' : 0 }, 300 );
        
        setTimeout( function() {
        
            element.animate( { 'height' : 0, 'marginTop' : 0, 'padding' : 0, 'marginBottom' : 0 }, 300 );
            setTimeout( function() {
            
                element.remove();
            
            }, 300 );
            
        }, 300 );
    
    }); 
    
   /**
    *
    * width calc functions
    * 
    */
    
    jQuery.calculateElementsWidth = function( windowWidth ) {
    
       /**
        *
        * #small-appointment .appointment-form .input input[type=text]
        * @width <= 599                
        *
        */
        
        if( windowWidth <= 599 ) {
        
            parentWidth = jQuery( '#small-appointment .appointment-form .input' ).width();
            jQuery( '#small-appointment .appointment-form .input input[type=text]' ).css({ 'width' : parentWidth - 62 +'px' });
        }
        
        else jQuery( '#small-appointment .appointment-form .input input[type=text]' ).css({ 'width' : '' });
        
       /**
        *
        * #responsive-menu-window ul
        * @width <= 849
        * 
        */   
        
        if( windowWidth <= 849 ) {

            jQuery( '#responsive-menu-window ul' ).css({ 'width' : windowWidth - 60 +'px' });
            jQuery( '#responsive-menu-window ul.sub-menu' ).css({ 'width' : windowWidth - 80 +'px' });
            jQuery( '#responsive-menu-window ul.sub-menu ul.sub-menu' ).css({ 'width' : windowWidth - 100 +'px' });
        }    
        
        else jQuery( '#responsive-menu-window ul' ).css({ 'width' : '' });
        
       /**
        *
        * #scrollable-menu-wrapper
        * @width <= 599
        * 
        */  
        
        if( windowWidth <= 599 ) {

            jQuery( '#scrollable-menu-wrapper' ).css({ 'width' : ( windowWidth * 0.9 ) - 2 +'px' });
        }   
        
        else jQuery( '#scrollable-menu-wrapper' ).css({ 'width' : '' });
        
       /**
        *
        * #slogan
        * @width <= 599        
        *
        */    
        
        if( windowWidth <= 599 ) {

            jQuery( '#slogan' ).css({ 'width' : windowWidth - 80 +'px' });
        }    
        
        else jQuery( '#slogan' ).css({ 'width' : '' });                                                      
        
       /**
        *
        * #appointment-popup .appointment-popup-content .appointment-form input[type=text],
        * #appointment-popup .appointment-popup-content .appointment-form textarea
        * @width <= 599        
        *
        */      
        
        if( windowWidth <= 599 ) {
        
            parentWidth = windowWidth - 80;
            
            jQuery( '#appointment-popup .appointment-popup-content .appointment-form input[type=text]' ).css({ 'width' : parentWidth - 61 +'px' });
            jQuery( '#appointment-popup .appointment-popup-content .appointment-form textarea' ).css({ 'width' : parentWidth - 26 +'px' });
        }        
        
        else {
        
            jQuery( '#appointment-popup .appointment-popup-content .appointment-form input[type=text]' ).css({ 'width' : '' });
            jQuery( '#appointment-popup .appointment-popup-content .appointment-form textarea' ).css({ 'width' : '' });
        }
        
       /**
        *
        * #blog #content article.blog-post .blog-post-comments-reply input[type=text],
        * #blog #content article.blog-post .blog-post-comments-reply textarea
        * @width all        
        *
        */          
        
        commentFormWidth = jQuery( '#blog #content article.blog-post .blog-post-comments-reply' ).width();
        
        jQuery( '#blog #content article.blog-post .blog-post-comments-reply input[type=text]' ).css({ 'width' : commentFormWidth - 62 +'px' });
        jQuery( '#blog #content article.blog-post .blog-post-comments-reply textarea' ).css({ 'width' : commentFormWidth - 26 +'px' }); 

       /**
        *
        * #contact-form #contact-form-section-form
        * @width <= 599        
        *
        */  

        if( windowWidth < 599 ) {
        
            parentWidth = jQuery( '#contact-form' ).width();
            jQuery( '#contact-form #contact-form-section-form' ).css({ 'width' : parentWidth - 100 +'px' });
        }     
        
        else {
        
            jQuery( '#contact-form #contact-form-section-form' ).css({ 'width' : '' });
            
            if( windowWidth <= 849 ) {
            
                parentWidth = jQuery( '#contact-form' ).width();
                jQuery( '#contact-form #contact-form-section-form' ).css({ 'right' : parentWidth * 0.15 - 40 +'px' });
            }

            else jQuery( '#contact-form #contact-form-section-form' ).css({ 'right' : '' });
        } 

       /**
        *
        * end
        * 
        */                                                               
    }
    
    jQuery( window ).load( function() { jQuery.calculateElementsWidth( jQuery( window ).width() ); });
    jQuery( window ).resize( function() { jQuery.calculateElementsWidth( jQuery( window ).width() ); }); 
    
   /**
    *
    * contact form focus
    * 
    */
    
    jQuery( '#contact-form input, #contact-form textarea' ).focusin( function() {
    
        jQuery( this ).parent().addClass( 'focus' );
    
    });
    
    jQuery( '#contact-form input, #contact-form textarea' ).focusout( function() {
    
        jQuery( this ).parent().removeClass( 'focus' );
    
    });                                                                                     
   
   /**
    *
    * end
    * 
    */
    
});
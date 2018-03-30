// =============================================================================
// JS/ADMIN/COMMON.JS
// -----------------------------------------------------------------------------
// Admin scripts.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Module Loader
//   02. AJAX
//   03. Confirm
//   02. Common Scripts
// =============================================================================

// Module Loader
// =============================================================================

window.tco = window.tco || {};

( function() {

  var modules = {};

  tco.addModule = function( handle, callback ) {
    addModuleData( handle, 'callback', callback );
  }

  tco.addDataSource = function( data ) {

    if ( !data.modules ) return;

    for ( var handle in data.modules ) {
      addModuleData( handle, 'data', data.modules[handle] );
    }

  }

  tco.debug = function() {
    return ( tcoCommon && tcoCommon.debug == '1' );
  }

  tco.l18n = function( handle ) {
    return ( tcoCommon && tcoCommon.strings && tcoCommon.strings[handle] ) ? tcoCommon.strings[handle] : '';
  }

  function addModuleData( handle, key, value ) {

	if ( ! modules[handle] ) {
      modules[handle] = {}
    }

    modules[handle][key] = value;

  }

  jQuery( function( $ ) {

    $( '[data-tco-module]' ).each( function() {

      var $this = $( this );
      var handle = $this.data( 'tco-module' );

      if ( modules[handle] && 'function' === typeof modules[handle]['callback'] ) {

        var targets = {};
        $.extend( $this, setupMessaging( $this ) );

        $this.find( '[data-tco-module-target]' ).each( function() {

          var $this = $( this );
          targets[ $this.data( 'tco-module-target' ) ] = $this;

        } );

        var data = modules[handle]['data'] || {};
        modules[handle]['callback'].call( this, $this, targets, data );

      }

    } );

  } );

  //
  // Module Messaging
  //

  function setupMessaging( $module ) {

    var $status = $module.find( '.tco-status-text' );
    if ( ! $status.length ) return {};


    var $processing = $module.find( '[data-tco-module-processor]' );
    $processing = ( $processing.length ) ? $processing : $module;

    var $backStatus = $status.clone();
    $status.after( $backStatus );

    var messageDuration, removalTimer, showTimer, readyTimer;

    var transitionTime = 650;
    var statusPhase = true;
    var $activeStatus = $status;
    var $inactiveStatus = $backStatus;


    function nothing() { }
    var ready = true;
    var next = nothing;

    function invertStatusPhase() {
      statusPhase = ! statusPhase;
      $activeStatus = ( statusPhase ) ? $status : $backStatus;
      $inactiveStatus = ( !statusPhase ) ? $status : $backStatus;
    }

    function removeMessage( delay, after ) {

      if ( ! ready ) {
        next = function() {
          removeMessage( delay, after );
        }
        return;
      }

      clearTimeout( messageDuration );

      if ( ! delay || ! Number.isInteger( delay ) )
        return removeNow( after );

      messageDuration = setTimeout( function() {
        removeNow( after );
      }, delay );
    }

    function removeNow( after ) {

      $activeStatus.removeClass( 'tco-active' );
      $inactiveStatus.html( '' );

      clearTimeout( removalTimer );
      removalTimer = setTimeout( function() {
        $processing.removeClass( 'tco-processing' );
        if ( 'function' === typeof after ) {
          after();
        }
      }, transitionTime );

    }

    function showMessage( text, duration, after, $extra ) {

      if ( ! ready ) {
        next = function() {
          showMessage( text, duration, after, $extra );
        }
        return;
      }

      clearTimeout( messageDuration );
      clearTimeout( removalTimer ); // Prevent removals

      if ( $processing.hasClass( 'tco-processing' ) ) {
        $inactiveStatus.html( text );
        if ( $extra && $extra.length ) $inactiveStatus.append( $extra );
        $activeStatus.removeClass( 'tco-active' );
        invertStatusPhase();
        delayShow( duration, after );
      } else {
        $activeStatus.html( text );
        if ( $extra && $extra.length ) $activeStatus.append( $extra );
        $processing.addClass( 'tco-processing' );
        delayShow( duration, after );
      }

    }

    function delayShow( duration, after ) {

      ready = false;
      clearTimeout( showTimer );

      showTimer = setTimeout( function() {

        $activeStatus.addClass( 'tco-active' );

        if ( duration && Number.isInteger( duration ) ) {
          removeMessage( duration, after );
        }

        clearTimeout( readyTimer );
        readyTimer = setTimeout( function() {

          ready = true;
          next();
          next = nothing;

        }, transitionTime );

      }, transitionTime );

    }

    return {
      tcoShowMessage: showMessage,
      tcoRemoveMessage: removeMessage,
      tcoShowErrorMessage: function( text, message, after ) {
        showMessage( text, false, after, tco.makeErrorDelegate({ message: message } ) );
      }
    }

  }

} )();


// AJAX
// =============================================================================

( function( $ ) {

  window.tco.ajax = function( options ) {

    var done = ( 'function' === typeof options.done ) ? options.done : ( function() { } );
    var fail = ( 'function' === typeof options.fail ) ? options.fail : ( function() { } );
    delete options.done;
    delete options.fail;

    wp.ajax.post( options ).done( done ).fail( function( response ) {

      if ( 'object' !== typeof response ) {

        var matches = response.match( /{"success":\w*?,"data.*/ );
        var recovery = {};

        try {
          recovery = JSON.parse( matches[0] );
        } catch ( e ) { }

        if ( recovery.data ) {

          if ( true === recovery.success ) {
            console.warn( 'TCO AJAX recovered from malformed success response: ', response );
            done( recovery.data );
            return;
          }

          if ( false === recovery.success ) {
            console.warn( 'TCO AJAX recovered from malformed error response: ', response );
            fail( recovery.data );
            return;
          }

        }

      }

      fail( response );

    });

  }

} )( jQuery );


// Confirm
// =============================================================================

( function( $ ) {

  var markup = '<div class="tco-modal-outer"><div class="tco-modal-inner"><div class="tco-confirm"><div class="tco-confirm-text"></div><div class="tco-confirm-actions"></div></div></div></div>';

  var defaults = {
    accept: null,
    decline: null,
    message: '',
    class: '',
    yep:  tco.l18n( 'yep' ),
    nope: tco.l18n( 'nope' ),
    yepClass: '',
    nopeClass: '',
    attach: true
  };

  window.tco.confirm = function( opts ) {

    var options = $.extend( {}, defaults, opts );

    //
    // Build Modal
    //

    var $modal  = $( markup );
    $modal.find( '.tco-confirm-text' ).html( options.message );

    if ( options.class ) {
      $modal.find( '.tco-confirm' ).addClass( options.class );
    }

    //
    // Add Yep Button
    //

    if ( options.yep && '' !== options.yep ) {

      var $yep = $( '<button class="tco-btn">' + options.yep + '</button>' );

      if ( options.yepClass ) {
        $yep.addClass( options.yepClass );
      }

      $modal.find( '.tco-confirm-actions' ).append( $yep );

      $yep.click( function() {
        if ( 'function' === typeof options.accept ) {
          options.accept();
        }
        $modal.remove();
      });
    }

    //
    // Add Nope Button
    //

    if ( options.nope && '' !== options.nope ) {

      var $nope   = $( '<button class="tco-btn">' + options.nope + '</button>' );

      if ( options.nopeClass ) {
        $nope.addClass( options.nopeClass );
      }

      $modal.find( '.tco-confirm-actions' ).append( $nope );

      $nope.click( function() {
        if ( 'function' === typeof options.decline ) {
          options.decline();
        }
        $modal.remove();
      });


    }

    //
    // Attach to body
    //

    if ( options.attach ) {
      $('body').append( $modal );
    }

    return $modal;

  }

} )( jQuery );


// Error Modal
// =============================================================================

( function( $ ) {

  var defaults = {
    details: tco.l18n( 'details' ),
    message: '',
    back: tco.l18n( 'back' ),
    backClass: ''
  };

  window.tco.makeErrorDelegate = function( opts ) {

    var options = $.extend( {}, defaults, opts );
    var $el = $( '<a> ' + options.details + '</a>' );

    $el.click( function(){
      tco.confirm( {
        message: options.message,
        yep: '',
        nope: options.back,
        nopeClass: options.backClass,
        class: 'tco-confirm-error'
      });
    } );

    return $el;
  }

} )( jQuery );

// Common Scripts
// =============================================================================

jQuery(document).ready(function($) {

  //
  // Hash links.
  //

  $('a[href="#"]').on('click', function(e) {

    e.preventDefault();

  });


  //
  // Toggles.
  //

  $('[data-tco-toggle]').on('click', function(e) {

    e.preventDefault();

    var $this  = $(this);
    var target = $this.data('tco-toggle');

    $(target).toggleClass('tco-active');

  });


  //
  // Accordions.
  //

  $('.tco-accordion-toggle').click(function() {

    if ( $(this).hasClass('tco-active') ) {
      $(this).removeClass('tco-active').next().slideUp();
      return;
    }

    $('.tco-accordion-panel').slideUp();
    $(this).siblings().removeClass('tco-active');
    $(this).addClass('tco-active').next().slideDown();

  });

});

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
//   04. Notice
//   05. Common Scripts
//   06. Vendor
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

  tco.logo = function() {
    return ( tcoCommon && tcoCommon.logo ) ? tcoCommon.logo : '';
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
    options._tco_nonce = tcoCommon._tco_nonce;

    wp.ajax.post( options ).done( done ).fail( function( response ) {

      if ( 'string' === typeof response ) {

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

    // Pass a function to execute a callback, or a string to navigate
    accept: null,
    decline: null,

    message: '',
    class: '',
    acceptBtn:  tco.l18n( 'yep' ),
    declineBtn: tco.l18n( 'nope' ),
    acceptClass: '',
    declineClass: '',
    attach: true,
    detach: false,

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
    // Add Accept Button
    //

    if ( options.acceptBtn && '' !== options.acceptBtn ) {

      var $accept = $( '<button class="tco-btn">' + options.acceptBtn + '</button>' );

      if ( options.acceptClass ) {
        $accept.addClass( options.acceptClass );
      }

      $modal.find( '.tco-confirm-actions' ).append( $accept );

      $accept.click( function() {
        click.call( this, 'accept' );
      } );

    }

    //
    // Add Decline Button
    //

    if ( options.declineBtn && '' !== options.declineBtn ) {

      var $decline   = $( '<button class="tco-btn">' + options.declineBtn + '</button>' );

      if ( options.declineClass ) {
        $decline.addClass( options.declineClass );
      }

      $modal.find( '.tco-confirm-actions' ).append( $decline );

      $decline.click( function() {
        click.call( this, 'decline' );
      } );

    }

    //
    // Handle button clicks
    //

    function click( button ) {

      var handler = options[button];

      if ( 'function' === typeof handler ) {
        handler();
      } else {

        var destination = handler;
        var newTab = false;

        if ( 'object' === typeof destination && destination !== null ) {
          newTab = ( true === destination.newTab )
          destination = destination.url || null;
        }

        if ( 'string' === typeof destination ) {
          if ( newTab ) {
            var tab = window.open( destination, '_blank');
            if( tab ) {
              tab.focus();
            }
          } else {
            window.location = destination;
          }
        }

      }

      remove();

    }

    //
    // Attach Handler
    //

    function attach() {
      $('body').append( $modal );

      setTimeout( function(){
        $modal.addClass( 'tco-active' );
      }, 0 );

    }

    //
    // Remove Handler
    //

    function remove() {

      $modal.removeClass( 'tco-active' );

      setTimeout( function(){
        $modal[( options.detach ) ? 'detach' : 'remove']();
      }, 650 );

    }

    //
    // Attach to body?
    //

    if ( options.attach ) attach();

    return $modal;

  }

} )( jQuery );


// Notices
// =============================================================================

( function( $ ) {

  var markup = '<div class="tco-notice notice"><a class="tco-notice-logo" href="https://theme.co/" target="_blank">' + tco.logo() + '</a><p></p></div>';

  var defaults = {
    message: '',
    dismissible: true
  };

  window.tco.showNotice = function( opts ) {

    // Locate the insertion point
    var $wpWrap = $( '.wrap h1, .wrap h2' ).first();

    // Abort if it doesn't exist
    if ( ! $wpWrap.length ) {
      console.warn( 'tco.showNotice requires the WordPress wrap div.' );
      return;
    }

    // Allow direct string passing
    if ( 'string' === typeof opts ) {
      opts = { message: opts };
    }

    // Parse options
    var options = $.extend( {}, defaults, opts );

    //  Build Notice
    var $notice = $( markup );
    $notice.find('p').first().html( options.message );

    // Conditionally allow dismissal
    if ( options.dismissible ) {

      $notice.addClass('is-dismissible');

      // Add Dismissal logic from WordPress
      var $button = $( '<button type="button" class="notice-dismiss"><span class="screen-reader-text"></span></button>' );
      $button.find( '.screen-reader-text' ).text( commonL10n.dismiss || '' );
      $button.on( 'click.wp-dismiss-notice', function( e ) {
        e.preventDefault();
        $notice.fadeTo( 100, 0, function() {
          $notice.slideUp( 100, function() {
            $notice.remove();
          });
        });
      });
      $notice.append( $button );

    }

    // Add notice to page
    $notice.insertAfter( $wpWrap );

    // Give caller access to the element
    return $notice;

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
        acceptBtn: '',
        declineBtn: options.back,
        declineClass: options.backClass,
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

// Vendor
// =============================================================================

//
// https://github.com/sindresorhus/query-string
//

(function(){

  var exports = {};

  var strictUriEncode = function (str) {
    return encodeURIComponent(str).replace(/[!'()*]/g, function (c) {
      return '%' + c.charCodeAt(0).toString(16).toUpperCase();
    });
  };

  exports.extract = function (str) {
    return str.split('?')[1] || '';
  };

  exports.parse = function (str) {
    if (typeof str !== 'string') {
      return {};
    }

    str = str.trim().replace(/^(\?|#|&)/, '');

    if (!str) {
      return {};
    }

    return str.split('&').reduce(function (ret, param) {
      var parts = param.replace(/\+/g, ' ').split('=');
      // Firefox (pre 40) decodes `%3D` to `=`
      // https://github.com/sindresorhus/query-string/pull/37
      var key = parts.shift();
      var val = parts.length > 0 ? parts.join('=') : undefined;

      key = decodeURIComponent(key);

      // missing `=` should be `null`:
      // http://w3.org/TR/2012/WD-url-20120524/#collect-url-parameters
      val = val === undefined ? null : decodeURIComponent(val);

      if (!ret.hasOwnProperty(key)) {
        ret[key] = val;
      } else if (Array.isArray(ret[key])) {
        ret[key].push(val);
      } else {
        ret[key] = [ret[key], val];
      }

      return ret;
    }, {});
  };

  exports.stringify = function (obj) {
    return obj ? Object.keys(obj).sort().map(function (key) {
      var val = obj[key];

      if (val === undefined) {
        return '';
      }

      if (val === null) {
        return key;
      }

      if (Array.isArray(val)) {
        return val.slice().sort().map(function (val2) {
          return strictUriEncode(key) + '=' + strictUriEncode(val2);
        }).join('&');
      }

      return strictUriEncode(key) + '=' + strictUriEncode(val);
    }).filter(function (x) {
      return x.length > 0;
    }).join('&') : '';
  };

  window.tco.queryString = exports;

})();

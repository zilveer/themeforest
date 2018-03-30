// =============================================================================
// X-ADDONS-HOME.JS
// -----------------------------------------------------------------------------
// Addons scripts.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Add Data Sources
//   02. Notices
//   03. Auto Configure Cornerstone
//   04. Validation
//   05. Automatic Updates
//   06. Customizer Manager
//   07. Demo Content
//   08. Extensions and Approved Plugins
// =============================================================================

// Add Data Sources
// =============================================================================

tco.addDataSource( xAddonsHome );



// Notices
// =============================================================================

( function(){

  if ( ! xAddonsHome.modules || ! xAddonsHome.notices ) return

  for ( var moduleName in xAddonsHome.modules ) {

    var module = xAddonsHome.modules[moduleName];

    if ( module.notices ) {

      for ( var noticeKey in module.notices ) {

        var notice = module.notices[noticeKey];

        if ( -1 !== xAddonsHome.notices.indexOf( noticeKey ) ) {
          tco.showNotice( module.notices[noticeKey] );
        }

      }

    }

  }

} )();



// Auto Configure Cornerstone
// =============================================================================

tco.addModule( 'x-auto-configure-cornerstone', function( $this, targets, data ) {

  var state = $this.data( 'tco-module-state' );

  if ( 'install' === state ) {
    install();
  }

  if ( 'activate' === state ) {
    activate();
  }

  function install() {

    tco.ajax({
      action: 'x_auto_install_cornerstone',
      done: function( installResponse ){
        activate( function() {
          complete( installResponse );
        } )
      },
      fail: fail,
    });

  }

  function activate( handler ) {
    tco.ajax({
      action: 'x_auto_activate_cornerstone',
      done: ( 'function' === typeof handler ) ? handler : complete,
      fail: fail,
    });
  }

  function fail( response ) {

    if ( ! response || ! response.message ) {

      var error = { message: data.errors[ state ] || data.errors.install };

      if ( response.status && response.statusText ) {
        error.errorDetails = response.status + ' ' + response.statusText;
      }

      response = error;

    }

    complete( response );

  }

  function complete( response ) {

    if ( ! response ) return;

    if ( response.message ) {
      var $notice = tco.showNotice( response.message );
    }

    if ( $notice && response.errorDetails ) {
      $notice.find('[data-tco-error-details]').click( function( e ) {
        e.preventDefault();
        tco.confirm( {
          message: response.errorDetails,
          acceptBtn: '',
          declineBtn: data.errorBack,
          class: 'tco-confirm-error'
        });
      } );
    }

  }

} );

// Validation
// =============================================================================

tco.addModule( 'x-validation', function( $this, targets, data ) {

  var $message = targets['message'] || false,
  $button      = targets['button'] || false,
  $overlay     = targets['overlay'] || false,
  $input       = targets['input'] || false,
  $form        = targets['form'] || false;
  $preloadKey  = targets['preload-key'] || false;

  if ( ! $message || ! $button || ! $overlay || ! $input || ! $form || ! $preloadKey ) return;

  $form.on( 'submit', function( e ) {

    e.preventDefault();

    $input.prop( 'disabled', true );
    $this.tcoShowMessage( data.verifying );

    tco.ajax({
      action: 'x_validation',
      code: $input.val(),
      done: done,
      fail: fail
    });

  } );

  var preloadKey = $preloadKey.val()
  if ( 'string' === typeof preloadKey && preloadKey.length > 1 ) {
    $input.val( preloadKey );
    $form.submit();
  }

  function done( response ) {

    if ( ! response.message ) {
      return fail( response );
    }

    if ( response.complete ) {
      $this.tcoShowMessage( response.message );
      setTimeout( complete, 2500 );
    } else {
      incomplete( response );
    }

  }

  function incomplete( response ) {

    $message.html( response.message );
    $button.html( response.button );

    var baseDelay = 650;
    setTimeout( function() {
      $this.tcoShowMessage( '' );
    }, baseDelay * 2 );

    setTimeout( function() {
      $overlay.addClass( 'tco-active' );
    }, baseDelay * 3 );

    if ( response.url ) {
      $button.attr('href', response.url );
      if ( response.newTab ) {
        $button.attr( 'target', '_blank' );
      }
    } else {
      $button.attr( 'href', '#' );
    }

    $button.off( 'click' );
    if ( response.dismiss ) {
      $button.click( function() {
        $overlay.removeClass( 'tco-active' );
        $this.tcoRemoveMessage();
        setTimeout( function() {
          $input.val( '' ).prop( 'disabled', false );
        }, baseDelay * 2 );

      } );
    }

  }

  function complete() {
    var args = tco.queryString.parse( window.location.search );
    delete args['tco-key'];
    args.notice = 'validation-complete';
    window.location.search = tco.queryString.stringify( args );
  }

  function fail( response ) {

    var message = ( response.message ) ? response.message : response;

    if ( message.responseText ) {
      message = message.responseText;
    }

    incomplete( {
      message: data.error,
      button:  data.errorButton,
      dismiss: true
    } );

    $message.find('[data-tco-error-details]').click( function( e ) {
      e.preventDefault();
      tco.confirm( {
        message: message,
        acceptBtn: '',
        declineBtn: data.errorButton,
        class: 'tco-confirm-error'
      });
    } );

    console.log( response );

  }

  jQuery( 'body' ).on( 'click', 'a[data-tco-focus="validation-input"]', function( e ) {
    e.preventDefault();
    $input.focus();
  });

} );

tco.addModule( 'x-validation-revoke', function( $this, targets, data ) {

  var $revoke = targets['revoke'] || false;

  if ( ! $revoke ) return;

  $revoke.click( function() {

    tco.confirm( {
      message: data.confirm,
      acceptClass: 'tco-btn-nope',
      acceptBtn: data.accept,
      declineBtn: data.decline,
      accept: function() {
        $revoke.removeAttr( 'href' );
        $revoke.html( data.revoking );
        tco.ajax({ action: 'x_validation_revoke', done: reload, fail: reload });
      },
    } );

  });

  function reload() {
    var args = tco.queryString.parse( tco.queryString.extract( window.location.href ) );
    delete args['tco-key'];
    args.notice = 'validation-revoked';
    window.location.search = tco.queryString.stringify( args );
  }

} );



// Automatic Updates
// =============================================================================

tco.addModule( 'x-automatic-updates', function( $this, targets, data ) {

  var $checkNow    = targets['check-now'] || false,
  $latestAvailable = targets['latest-available'] || false;

  if ( ! $checkNow || ! $latestAvailable) return;

  if ( data.latest ) {
    $latestAvailable.html( data.latest );
  }

  $checkNow.find( 'a' ).click( function( e ) {

    e.preventDefault();

    $checkNow.html( data.checking );

    tco.ajax({

      action: 'x_update_check',

      done: function( response ) {

        if ( response.latest && response.latest !== data.latest ) {
          $checkNow.html( data.completeNew );
          $latestAvailable.html( response.latest );
        } else {
          $checkNow.html( data.complete );
        }

      },

      fail: function( response ) {
        console.warn( 'X Update Check Error', response );
        $checkNow.html( data.error );
      }

    });

  });


} );



// Customizer Manager
// =============================================================================

tco.addModule( 'x-customizer-manager', function( $this, targets, data ) {

  $importForm = targets['import-form'] || false,
  $importFile = targets['import-file'] || false,
  $export     = targets['export'] || false,
  $reset      = targets['reset'] || false;

  if ( ! $importForm || ! $importFile || ! $export || ! $reset ) return;


  //
  // Export.
  //

  $export.on( 'click', function() {
    $this.tcoShowMessage( data.export, 1500 );
  } );


  //
  // Import.
  //

  if ( featureDetect() ) {

    $importForm.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
      e.preventDefault();
      e.stopPropagation();
    }).on('dragover dragenter', function() {
      $importForm.addClass( 'tco-dragover' );
    }).on('dragleave dragend drop', function() {
      $importForm.removeClass( 'tco-dragover' );
    }).on('drop', function(e) {
      confirmUpload( e.originalEvent.dataTransfer.files[0] );
    });

    $importFile[0].onchange = function () {
      confirmUpload( this.files[0] );
    };

  } else {
    $this.tcoShowMessage( data.useModernBrowser, 2500 );
  }

  function confirmUpload( file ) {

    tco.confirm( {
      message: data.importConfirm,
      acceptClass: 'tco-btn-nope',
      acceptBtn: data.yep,
      declineBtn: data.nope,
      accept: function() {
        readFile( file )
      },
      decline: function() {
        clearFileInput()
      }
    } );

  }

  function readFile( file ) {

    $this.tcoShowMessage( data.importBegin );

    var reader = new FileReader();

    reader.onload = function(e) {

      try {
        upload( JSON.parse( reader.result ) );
      } catch (e) {
        $this.tcoShowMessage( data.importError, 2500 );
        console.log( 'X Customizer Manager Import Error', e );
      }

    }

    try {
      reader.readAsText( file );
    } catch (e) {
      $this.tcoShowMessage( data.importError, 2500 );
      console.log( 'X Customizer Manager Import Error', e );
    }
  }

  function upload( fileData ) {

    tco.ajax( {
      action: 'x_customizer_manager_import',
      import: fileData,

      done: function( response ) {
        $this.tcoShowMessage( data.importSuccess, 2500 );
        clearFileInput();
      },

      fail: function( response ) {
        console.warn( 'X Customizer Import Error', response );
        $this.tcoShowMessage( data.importError, 2500 );
        clearFileInput();
      }

    } );

  }

  function clearFileInput() {
    $importFile[0].value = '';
    $importFile[0].type = '';
    $importFile[0].type = 'file';
  }


  //
  // Reset.
  //

  $reset.click( function( e ) {

    e.preventDefault();

    tco.confirm( {
      message: data.resetConfirm,
      acceptClass: 'tco-btn-nope',
      acceptBtn: data.yep,
      declineBtn: data.nope,
      accept: function() {

        $this.tcoShowMessage( data.resetBegin );

        tco.ajax( {
          action: 'x_customizer_manager_reset',
          done: function( response ) {
            $this.tcoShowMessage( data.resetSuccess, 2500 );
          },
          fail: function( response ) {
            console.warn( 'X Customizer Reset Error', response );
            $this.tcoShowMessage( data.resetError, 2500 );
          }
        } );

      }
    } );

  });

  function featureDetect() {
    var div = document.createElement('div');
    return ( ( 'draggable' in div ) || ( 'ondragstart' in div && 'ondrop' in div ) ) && 'FormData' in window && 'FileReader' in window;
  }

} );



// Demo Content
// =============================================================================

tco.addModule( 'x-demo-content', function( $this, targets, data ) {

  var $select     = targets['select'] || false,
  $selectExpanded = targets['select-group-expanded'] || false,
  $selectStandard = targets['select-group-standard'] || false,
  $demoLink       = targets['demo-link'] || false,
  $setupButton    = targets['setup-button'] || false;

  if ( ! $select || ! $selectExpanded || ! $selectStandard || ! $demoLink || ! $setupButton ) return;


  //
  // Setup markup.
  //

  jQuery.each( data.demos.expanded_demos, function( handle, data ) {
    $selectExpanded.append( makeOption( handle, data, 'expanded' ) );
  } );

  jQuery.each( data.demos.standard_demos, function( handle, data ) {
    $selectStandard.append( makeOption( handle, data, 'standard' ) );
  } );

  function makeOption( handle, data, type ) {
    return jQuery( '<option data-demo-type="' + type + '" value="' + handle + '">' + data.title + '</option>' );
  }

  updateDemoLink();
  $select.on( 'change', updateDemoLink )

  function getSelectedDemo() {

    var $option = $select.find( ':selected' )
    var expanded = 'expanded' === $option.data( 'demo-type');
    var type = ( expanded ) ? 'expanded_demos' : 'standard_demos';
    var name = $option.val();

    var demo = data.demos[type][ name ] || {};
    demo.name = name;
    demo.expanded = expanded;
    return demo;

  }

  function updateDemoLink() {
    var demo = getSelectedDemo();
    $demoLink.attr( 'href', demo.demo_url );
  }


  //
  // Submit.
  //

  $setupButton.click( function( e ) {
    e.preventDefault();
    tco.confirm( {
      message: data.strings.confirm,
      acceptClass: 'tco-btn-nope',
      acceptBtn: data.strings.yep,
      declineBtn: data.strings.nope,
      accept: runImport
    } );
  } );

  function runImport() {
    var demo = getSelectedDemo();
    importer.init( { 'demo': ( demo.expanded ) ? demo.name : demo.url }, demo.expanded );
  }

  function buttonReady( state ) {
    $setupButton.prop( 'disabled', !state );
  }


  //
  // Progress.
  //

  var $ = jQuery;

  var Progress = function() {
    this.$el = $( this.markup );
    this.$message = this.$el.find('.tco-progress-title');
    this.$bar = this.$el.find('.tco-progress-bar-inner');
  }

  $.extend( Progress.prototype, {

    markup: '<div class="tco-modal-outer">'
      + '<div class="tco-modal-inner">'
        + '<div class="tco-progress">'
          + '<div class="tco-progress-title"></div>'
          + '<div class="tco-progress-bar-outer">'
            + '<div class="tco-progress-bar-inner"></div>'
          + '</div>'
        + '</div>'
        + '<div class="tco-progress-complete">'
        +  '<div class="tco-progress-complete-icon dashicons dashicons-yes"></div>'
        +  '<div class="tco-progress-complete-title">' + data.strings.complete + '</div>'
        + '</div>'
      + '</div>'
    + '</div>',

    start: function() {

      this.message( data.strings.start );

      this.$el.addClass( 'tco-processing' );
      $( 'body' ).prepend( this.$el );

      setTimeout( function() {
        this.$el.addClass( 'tco-active' );
      }.bind( this ), 0 )

      this.setProgress(0);

    },

    message: function( message ) {
      this.$message.html( message )
    },

    setProgress: function( ratio ) {
      ratio = ratio * 0.9 + 0.1;
      this.$bar.css( 'width', Math.round( ratio * 100) + '%' );
    },

    simulateProgress: function() {
      this.message( data.strings.simulated );
      this.$bar.animate( { width: '80%' }, 250 );
    },

    complete: function() {

      this.message( '&nbsp;' );

      this.$bar.animate( { width: '100%' }, 250 );

      setTimeout(function(){
        this.$el.removeClass( 'tco-processing' );
        this.close();
      }.bind(this), 400 )

    },

    fail: function( message ) {
      this.message( message );
      this.close();
    },

    close: function() {

      setTimeout( function(){
        this.$el.removeClass( 'tco-active' );
      }.bind( this ), 1500 );

      setTimeout(function(){
        this.$el.detach();
        this.setProgress(0);
        this.message('');
      }.bind( this ), 2000 );

    }

  });


  //
  // Importer.
  //

  var Importer = function() { }

  $.extend( Importer.prototype, {

    init: function( demoData, expanded ) {

      this.demoData = demoData;
      this.demoData.action = ( expanded ) ? 'x_demo_importer' : 'x_demo_content_setup';
      this.demoData.attempts = 1;
      this.demoData._tco_nonce = tcoCommon._tco_nonce;

      if (!expanded)
        return this.runStandard();


      this.demoData.session = 's_' + Math.round( new Date().getTime() + ( Math.random() * 100 ) );
      progress.start();
      buttonReady( false );
      this.acknowledge( { data: {}, first: true } );

    },

    runStandard: function() {

      progress.start();
      progress.simulateProgress();
      buttonReady( false );

      //

      this.standardProcess( function( response ){

        if ( response.success === false )
          return this.failure( response.data.message, response );

        progress.complete();
        buttonReady(true);

      }.bind(this) );

    },

    standardProcess: function( success ) {

      jQuery.post( ajaxurl, this.demoData, success ).fail( function(data) {

        progress.message( this.timeOutMessage( this.demoData.attempts++ ) );
        if ( this.demoData.attempts >= 25 )
          return this.failure( data.strings.failure, data );

        this.standardProcess( success ); // repeat

      }.bind(this) );

    },

    acknowledge: function( response ) {

      if ( !response.data && !response.first ) {
        progress.message( this.timeOutMessage( this.demoData.attempts++ ) );
        if ( this.demoData.attempts > 25 )
          return this.failure( data.strings.failure, response );
      } else {

        this.demoData.attempts = 0;

        if ( response.success == false )
          return this.failure( response.data.message, response.data );

        if ( response.data.message )
          progress.message( response.data.message );

        if ( response.data.debug_message && data.strings.debug )
          console.log( 'X Demo Debug', response.data.debug_message, response.data.debug || null );

        if ( response.data.completion && response.data.completion === true ) {
          if ( response.data.debug && data.strings.debug )
            console.log( response.data.debug );

          return this.complete();
        }

        if ( response.data.completion ) {
          progress.setProgress( response.data.completion.ratio );
        }

      }

      setTimeout( function() {
        jQuery.post( ajaxurl, this.demoData ).always( this.acknowledge.bind(this) );
      }.bind(this), 40 * this.demoData.attempts ); // slow down if timeouts start

    },

    complete: function() {
      progress.complete();
      buttonReady(true);
    },

    failure: function( message, debug ) {
      progress.fail( message );
      buttonReady(true);
      console.error( 'X Demo Importer failure', debug || {});
    },

    timeOutMessage: function( attempts ) {
      if (attempts > 20)
        return data.strings.timeout3;
      if (attempts > 10)
        return data.strings.timeout2;
      return data.strings.timeout1;
    }

  } );

  var progress = new Progress();
  var importer = new Importer();

} );



// Extensions and Approved Plugins
// =============================================================================

tco.addModule( 'x-extension', function( $this, targets, data ) {

  var $install = targets['install'] || false,
  slug         = $this.attr('id'),
  extension    = ( 'undefined' !== typeof $this.data( 'x-extension' ) ) ? data.extensions[slug] : data.approvedPlugins[slug];

  if ( ! $install || ! extension ) return;

  if ( extension.activated ) {
    $install.html( data.activated )
      .addClass( 'tco-btn-yep tco-btn-disabled' );
    return;
  } else if ( extension.installed ) {
    updateInstallButton();
    return;
  }

  if ( ! window._xExtensionQueue ) {
    window._xExtensionQueue = {
      running: false,
      queue: []
    };
  }

  $install.on( 'click', clickInstall );

  function clickInstall() {

    $install.prop( 'disabled', true );

    if ( window._xExtensionQueue.running ) {
      $this.tcoShowMessage( 'Waiting to install&hellip;' );
      window._xExtensionQueue.queue.unshift( install );
    } else {
      install();
      window._xExtensionQueue.running = true;
    }

  }

  function next() {
    if ( 0 < window._xExtensionQueue.queue.length ) {
      var job = window._xExtensionQueue.queue.pop();
      job();
    } else {
      window._xExtensionQueue.running = false;
    }
  }

  function install() {

    $this.tcoShowMessage( 'Installing&hellip;' )

    tco.ajax( {
      action: 'x_extensions_installer',
      plugin: extension.plugin,
      package: extension.package,
      done: done,
      fail: fail,
    } );

  }

  function done ( response ) {

    console.log( 'Installed', response );
    updateInstallButton();
    $this.tcoRemoveMessage( false, function() {
      $this.removeClass( 'tco-extension-not-installed' ).addClass( 'tco-extension-installed' );
    } );

    next();

  }

  function fail( response ) {

    var message = ( response.message ) ? response.message : response;

    if ( message.responseText ) {
      message = message.responseText;
    }

    $this.tcoShowErrorMessage( data.error, message );

    console.log( response );

    next();

  }

  function updateInstallButton() {
    $install.off( 'click', clickInstall );
    $install.html( data.installed )
      .attr( 'href', data.pluginsURI )
  }

} );
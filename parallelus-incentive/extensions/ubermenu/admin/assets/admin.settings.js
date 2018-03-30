jQuery( document ).ready( function($){


	//Manual code switcher
	$( '.ubermenu-manual-code-menu-selection' ).on( 'change' , function(){
		var $wrap = $( this ).closest( '.ubermenu-integration-code-wrap' );
		$wrap.find( '.ubermenu-integration-code' ).hide();
		$wrap.find( '.ubermenu-integration-code-'+$( this ).val() ).show();
	});

	//Color Gradients
	$('.ubermenu-color-stop').each( function(){
		var $colorstop = $(this);
		$colorstop.wpColorPicker({
			clear: _.throttle( function(){
				$colorstop.data( 'cleared' , true );
				//var hexcolor = $( this ).wpColorPicker( 'color' );
				//console.log( 'color = ' + $colorstop.wpColorPicker( 'color' ) );
				//$colorstop.wpColorPicker( 'color' , ' ' );
				//console.log( 'color = ' + $colorstop.wpColorPicker( 'color' ) );
				var $control = $(this).closest( 'td' );
				update_gradient_list( $control );
				//$colorstop.data( 'cleared' , false );
				
			}, 300 ),

			change: _.throttle( function( event , ui ){
				$colorstop.data( 'cleared' , false );
				//console.log( 'change ' + $(this).attr('class') );

				//var hexcolor = $( this ).wpColorPicker( 'color' );
				var $control = $(this).closest( 'td' );
				update_gradient_list( $control );

			}, 300 )
		});
	});


	function update_gradient_list( $control ){
		var colors = '';
		var color = '';
		$control.find( '.ubermenu-color-stop' ).each( function(){
			if( $(this).data( 'cleared' ) ) color = '';
			else color = $( this ).wpColorPicker( 'color' );
			//console.log( color +',');
			if( color ){
				if( colors.length > 0 ) colors += ',';
				colors += color;
			}
		});
		//console.log( 'colors = ' + colors );
		$control.find( '.ubermenu-gradient-list' )
			.val( colors );
			//.trigger( 'change' );
	}



	$( '.uber-sub-section-tab' ).on( 'click' , function(){
		var $panel = $(this).closest( 'form' );
		$( this ).siblings().removeClass( 'uber-active' );
		$( this ).addClass( 'uber-active' );
		var group = $(this).data( 'section-group' );
		if( group == '_all' ){
			$panel.find( '.uber-field' ).show();
		}
		else{
			$panel.find( '.uber-field' ).hide();
			$panel.find( '.uber-field-group-' + group ).show();
		}

		uber_store( 'uber_menu_settings_tab' , $panel.parent().attr( 'id' ) , group );
	});

	//Show tab on page load
	$( '.postbox .group' ).each( function(){
		var group = uber_store( 'uber_menu_settings_tab' , $(this).attr('id') );
		if( group ){
			$(this).find( '[data-section-group='+group+']' ).click();
		}
		else{
			$(this).find( '.uber-sub-section-tab:first-child' ).click();
		}
	});


	$( '.ubermenu_instance_notice_close, .ubermenu_instance_close' ).on( 'click' , function(){
		$( '.ubermenu_instance_wrap' ).fadeOut();
	});
	$( '.ubermenu_instance_wrap' ).on( 'click' , function(e){
		if( $( e.target ).hasClass( 'ubermenu_instance_wrap' ) ){
			$(this).fadeOut();
		}
	});

	$( '.ubermenu_instance_toggle' ).on( 'click' , function(){
		$( '.ubermenu_instance_container_wrap' ).fadeIn();
		$( '.ubermenu_instance_container_wrap .ubermenu_instance_input' ).focus();
	});

	$form = $( 'form.ubermenu_instance_form' );
	$form.on( 'submit' , function(e){
		e.preventDefault();
		ubermenu_save_instance();
		return false;
	});

	$( '.ubermenu_instance_create_button' ).on( 'click' , function(e){
		e.preventDefault();
		ubermenu_save_instance();
		return false;
	});

	function ubermenu_save_instance(){
		var data = {
			action: 'ubermenu_add_instance',
			ubermenu_data: $form.serialize(),
			ubermenu_nonce: $form.find( '#_wpnonce' ).val()
		};
		// We can also pass the url value separately from ajaxurl for front end AJAX implementations
		jQuery.post( ajaxurl, data, function(response) {
			console.log( response );

			if( response == -1 ){
				$( '.ubermenu_instance_container_wrap' ).fadeOut();
				$( '.ubermenu_instance_notice_error' ).fadeIn();

				$( '.ubermenu-error-message' ).text( 'Please try again.' );

				return;
			}
			else if( response.error ){
				$( '.ubermenu_instance_container_wrap' ).fadeOut();
				$( '.ubermenu_instance_notice_error' ).fadeIn();

				$( '.ubermenu-error-message' ).text( response.error );

				return;
			}
			else{
				$( '.ubermenu_instance_container_wrap' ).fadeOut();
				$( '.ubermenu_instance_notice_success' ).fadeIn();
			}

		}, 'json' ).fail( function(){
			$( '.ubermenu_instance_container_wrap' ).fadeOut();
			$( '.ubermenu_instance_notice_error' ).fadeIn();
		});
	}


	$( '.ubermenu_instance_button_delete' ).on( 'click' , function( e ){
		e.preventDefault();
		if( confirm( 'Are you sure you want to delete this UberMenu Configuration?' ) ){
			ubermenu_delete_instance( $(this) );
		}
		return false;
	});

	function ubermenu_delete_instance( $a ){
		var data = {
			action: 'ubermenu_delete_instance',
			ubermenu_data: {
				'ubermenu_instance_id' : $a.data( 'ubermenu-instance-id' )
			},
			ubermenu_nonce: $a.data( 'ubermenu-nonce' )
		};

		//console.log( data );

		jQuery.post( ajaxurl, data, function(response) {
			//console.log( response );

			if( response == -1 ){
				$( '.ubermenu_instance_container_wrap' ).fadeOut();
				$( '.ubermenu_instance_delete_notice_error' ).fadeIn();

				$( '.ubermenu-delete-error-message' ).text( 'Please try again.' );

				return;
			}
			else if( response.error ){
				$( '.ubermenu_instance_container_wrap' ).fadeOut();
				$( '.ubermenu_instance_delete_notice_error' ).fadeIn();

				$( '.ubermenu-delete-error-message' ).text( response.error );

				return;
			}
			else{
				$( '.ubermenu_instance_container_wrap' ).fadeOut();
				$( '.ubermenu_instance_delete_notice_success' ).fadeIn();

				var id = response.id;
				$( '#ubermenu_'+id+', #ubermenu_'+id+'-tab' ).remove();	//delete tab and content
				$( '.nav-tab-wrapper > a' ).first().click();			//switch to first tab
			}

		}, 'json' ).fail( function(){
			$( '.ubermenu_instance_container_wrap' ).fadeOut();
			$( '.ubermenu_instance_delete_notice_error' ).fadeIn();
		});

		
	}

	function uber_store( item , key , val ){
		val = val || false;

		var store = localStorage.getItem( item );

		var jstore = {};
		if( store ){
			jstore = JSON.parse( store );
		}

		//retrieve
		if( val === false ){
			if( jstore ){
				return jstore[key];
			}
		}

		//store
		else{
			jstore[key] = val;
			var jstore_string = JSON.stringify( jstore );
			localStorage.setItem( item , jstore_string );
		}

	}

	function uber_selectText( element ) {
		var doc = document
			//, text = element //doc.getElementById(element)
			, range, selection
		;
		if (doc.body.createTextRange) { //ms
			range = doc.body.createTextRange();
			range.moveToElementText( element );
			range.select();
		} else if (window.getSelection) { //all others
			selection = window.getSelection();        
			range = doc.createRange();
			range.selectNodeContents( element );
			selection.removeAllRanges();
			selection.addRange(range);
		}
	}

	$( '.ubermenu-highlight-code' ).on( 'click' , function(e){
		uber_selectText( $(this)[0] );
	});

	//Open Hash Tab
	setTimeout( function(){
		if( window.location.hash ){
			//console.log( window.location.hash + '-tab ' + $( window.location.hash + '-tab' ).size() );

			$( window.location.hash + '-tab' ).click();
		}
	} , 500 );


	$( '.ubermenu-welcome-dismiss' ).on( 'click' , function(e){
		e.preventDefault();
		$( '.ubermenu-welcome' ).fadeOut();
		$( '.ubermenu-welcome-video' ).attr( 'src' , '' );

		var data = {
			action: 'ubermenu_dismiss_welcome',
			ubermenu_nonce: $(this).data( 'ubermenu-nonce' )
		};
		jQuery.post( ajaxurl, data, function(response) {
			//console.log( response );
		});
	});

	$( '.ubermenu-welcome-dismiss-alert' ).remove();

	$( '.button-quickstart' ).on( 'click' , function(e){
		e.preventDefault();
		$( '.ubermenu-welcome' ).fadeIn().removeClass( 'ubermenu-welcome-hide' );
		$( '.ubermenu-welcome-video' ).attr( 'src' , $( '.ubermenu-welcome-video' ).data( 'src' ) );
	});
});


  (function() {
    var cx = '012195239863806736760:csnsnevlo9y';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();

  // (function() {
		//     var cx = '012189916002899296903:hyk1016hrqa';
		//     var gcse = document.createElement('script');
		//     gcse.type = 'text/javascript';
		//     gcse.async = true;
		//     gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
		//         '//www.google.com/cse/cse.js?cx=' + cx;
		//     var s = document.getElementsByTagName('script')[0];
		//     s.parentNode.insertBefore(gcse, s);
		//   })();

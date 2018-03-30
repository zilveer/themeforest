jQuery( document ).ready( function($){

	//$( '.ubermenu-color-stop' )

	
	$( '.ubermenu-color-stop' ).each( function(){
//console.log( 'init ' + $(this).attr('class'));
		

		$(this).wpColorPicker({

			clear: _.throttle( function(){

				//in this function , $(this) is the BUTTON, not the input...
				$(this).prev( '.ubermenu-color-stop' ).data( 'um_cleared' , 'cleared' );
				var $control = $(this).closest( '.customize-control-content' );
				update_gradient_list( $control );
				
			}, 300 ),

			change: _.throttle( function( event , ui ){
				$(this).data( 'um_cleared' , false );
				var $control = $(this).closest( '.customize-control-content' );
				update_gradient_list( $control );
			}, 300 )
		});

		
		//if( init_color ) 
	});

	//Run each separately to avoid calling wpColorPicker functions before everything is initialized properly

	$( '.ubermenu-color-stop' ).each( function(){
		var init_color = $(this).data('uber-gradient-color');
		$(this).wpColorPicker( 'color' , init_color );
	});

	function update_gradient_list( $control ){
		var colors = '';
		$control.find( '.ubermenu-color-stop' ).each( function(){
			if( $(this).data( 'um_cleared' ) != 'cleared' ){
				var color = $( this ).wpColorPicker( 'color' );
				if( color ){
					if( colors.length > 0 ) colors += ',';
					colors += color;
				}
			}
		});
		//console.log( 'colors = ' + colors );
		$control.find( '.ubermenu-gradient-list' )
			.val( colors )
			.trigger( 'change' );
	}

});
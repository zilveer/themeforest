(function($) {

	$( document ).ready(function() {

		$( 'body' ).on( 'keyup', '.bt_bttext', function() {
			var val = $( this ).val();
			var hidden_el = $( this ).parent().find( 'input[type="hidden"]' );
			var select_el = $( this ).parent().find( 'select' );
			
			if ( select_el.val() != '' && val != ''  ) {
				hidden_el.attr( 'value', select_el.val() + ':' + val );
			} else {
				hidden_el.attr( 'value', '' );
			}
		});
		
		$( 'body' ).on( 'change', '.bt_bttext_select', function() {
			var hidden_el = $( this ).parent().find( 'input[type="hidden"]' );
			var input_el = $( this ).parent().find( 'input[type="text"]' );
			var val = input_el.val();
			
			if ( $( this ).val() != '' && val != ''  ) {
				hidden_el.attr( 'value', $( this ).val() + ':' + val );
			} else {
				hidden_el.attr( 'value', '' );
			}
		});	
		
		toggle_remove_buttons();
		
		function add_cloned_fields( $input ) {
			var $clone_last = $input.find( '.rwmb-clone:last' ),
				$clone = $clone_last.clone(),
				$input, name;
		
			$clone.insertAfter( $clone_last );
			$input = $clone.find( ':input[class|="rwmb"]' );
			$input1 = $clone.find( ':input' ).val( '' );

			name = $input.attr( 'name' ).replace( /\[(\d+)\]/, function( match, p1 ) {
				return '[' + ( parseInt( p1 ) + 1 ) + ']';
			});

			$input.attr( 'name', name );

			toggle_remove_buttons( $input );
			
			$input.trigger( 'clone' );
		}
		
		$( '.add-clone' ).on( 'click', function( e ) {
			e.preventDefault();
			e.stopPropagation();
			var $input = $( this ).parents( '.rwmb-input' ),
				$clone_group = $( this ).parents( '.rwmb-field' ).attr( "clone-group" );

			if ( $clone_group ) {
				var $metabox = $( this ).parents( '.inside' );
				var $clone_group_list = $metabox.find( 'div[clone-group="' + $clone_group + '"]' );

				$.each( $clone_group_list.find( '.rwmb-input' ),
					function( key, value ) {
						add_cloned_fields( $( value ) );
				});
			} else {
				add_cloned_fields( $input );
			}

			toggle_remove_buttons( $input );

			return false;		
		});	

		$( '.rwmb-input' ).on( 'click', '.remove-clone', function() {
			var $this = $( this ),
				$input = $this.parents( '.rwmb-input' ),
				$clone_group = $( this ).parents( '.rwmb-field' ).attr( 'clone-group' );

			if ( $input.find( '.rwmb-clone' ).length <= 1 ) {
				return false;
			}

			if ( $clone_group ) {
				var $metabox = $( this ).parents( '.inside' );
				var $clone_group_list = $metabox.find( 'div[clone-group="' + $clone_group + '"]' );
				var $index = $this.parent().index();

				$.each( $clone_group_list.find( '.rwmb-input' ),
					function( key, value ) {
						$( value ).children( '.rwmb-clone' ).eq( $index ).remove();
						toggle_remove_buttons( $( value ) );
					}
				);
			} else {
				$this.parent().remove();

				toggle_remove_buttons( $input );
			}

			return false;
		});	

		function toggle_remove_buttons( $el ) {
			var $button;
			if ( !$el )
				$el = $( '.rwmb-field' );
			$el.each(function() {
				$button = $( this ).find( '.remove-clone' );
				$button.length < 2 ? $button.hide() : $button.show();
			});
		}
	});
	
})(jQuery);
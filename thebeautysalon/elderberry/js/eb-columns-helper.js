var tinymce, tb_show, tinyMCE, tb_remove;

(function() {

	tinymce.create( 'tinymce.plugins.ebColumns', {
		init: function( ed, url ) {
			ed.addButton('ebColumns', {
				title: "Create Columns",
				onclick: function() {
					tb_show( 'Columns Helper', '#TB_inline?inlineId=eb-columns-helper' );
					reset_columns();
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname: "Elderberry Layout Builder",
				author: 'Elderberry'
			};
		}

	});

	tinymce.PluginManager.add( 'ebColumns', tinymce.plugins.ebColumns );

})();


jQuery( document ).ready( function(){
	jQuery( '.eb-columns-helper' ).submit( function( e ){
		e.preventDefault();

		if( jQuery( '.layout-creator .row *' ).length  == 1 && jQuery( '.layout-creator .row *:first' ).hasClass( 'default-message' ) ) {
			alert( 'Please add some columns before you continue' );
		}
		else {
			var content = jQuery( jQuery( '.layout-creator .row' ) ).clone();
			content.removeClass( 'ui-sortable' );
			content.find( '*' ).removeAttr( 'data-col' ).html( 'column content' );
			content = '<div class="row columns">' + content.html() + '</div> You can also write underneath, or create a new columned layout';

			tinyMCE.activeEditor.execCommand( 'mceReplaceContent', false, content );

			reset_columns();
            tb_remove();
		}

	});

	set_sortables();

});

function reset_columns() {
	jQuery( '.layout-creator .row *' ).not('.default-message').appendTo( '.eb-columns-helper .columns .row:first' );
	balance_col_types();
	balance_elements( jQuery( '.eb-columns-helper .columns' ) );
	update_column_statuses( 0 );
	jQuery( '.layout-creator .row' ).html( '<div class="default-message">Drag columns from above in here</div>' );
}

function set_sortables() {
	jQuery( '.eb-columns-helper .columns .row' ).sortable({
		connectWith : '.layout-creator .row',
		items: ':not(.disabled)',
		tolerance: 'pointer',
		receive: function() {
			var totalLength = get_total_length();
			balance_col_types();
			balance_elements( jQuery( '.eb-columns-helper .columns' ) );
			update_column_statuses( totalLength );
			if( totalLength === 0 ) {
				jQuery( '.layout-creator .row' ).html( '<div class="default-message">Drag columns from above in here</div>' );
			}
		}
	});

	jQuery( '.layout-creator .row' ).sortable({
		connectWith: '.eb-columns-helper .columns .row',
		placeholder: 'placeholder twocol',
		tolerance: 'pointer',
		over : function() {
			jQuery( '.layout-creator .default-message' ).remove();
		},
		receive: function() {
			var totalLength = get_total_length();
			balance_elements( jQuery( '.layout-creator' ) );
			update_column_statuses( totalLength );
		},
		update : function() {
			jQuery( '.layout-creator .row *' ).removeClass( 'last' );
			jQuery( '.layout-creator .row *:last' ).addClass( 'last' );
		}
	});
}

function balance_col_types() {
	var rowType = '';
	var elementType = '';
	jQuery.each( jQuery( '.eb-columns-helper .columns .row' ), function() {
		rowType = jQuery( this ).attr( 'data-col' );
		jQuery.each( jQuery( this ).find( '*' ), function() {
			elementType = jQuery( this ).attr( 'data-col' );
			if( elementType != rowType ) {
				jQuery(this).prependTo( '.eb-columns-helper .columns .row[data-col="' + elementType + '"]' );
			}
		});
	});
}


function update_column_statuses( totalLength ) {
	jQuery.each( jQuery( '.eb-columns-helper .columns .row *' ), function() {
		var elementLength = parseFloat( jQuery( this ).html() );
		var allowedLength = 12 - totalLength;
		if( elementLength > allowedLength ) {
			jQuery(this).addClass( 'disabled' );
		}
		else {
			jQuery(this).removeClass( 'disabled' );
		}
	});
}

function get_total_length() {
	var totalLength = 0;
	var elementLength = 0;
	jQuery.each( jQuery( '.layout-creator .row *' ), function() {
		elementLength = parseFloat( jQuery(this).html() );
		totalLength = elementLength + totalLength;
	});

	return totalLength;
}

function balance_elements( container ) {
	jQuery.each( container.find( '.row' ), function() {
		jQuery(this).find( '*' ).removeClass( 'last' );
		jQuery(this).find( '*:last' ).addClass( 'last' );
	});
}

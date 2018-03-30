(function( $ ) {
	'use strict';

	var byId = function( id ) {
		return document.getElementById( id );
	};

	// first create the facets list
	Sortable.create( byId( 'facets_list' ), {
		//sort: (i != 1),
		group: {
			name: 'fwp',
			pull: 'clone',
			put: false
		},
		animation: 150
	} );

	//// now create all the destination groups
	[{
		id: 'listings_archive_visible',
		name: 'fwp',
		pull: false,
		put: true
	},
	{
		id: 'listings_archive_hidden',
		name: 'fwp',
		pull: false,
		put: true
	},
	{
		id: 'navigation_bar',
		name: 'fwp',
		pull: false,
		put: true
	},
	{
		id: 'front_page_hero',
		name: 'fwp',
		pull: false,
		put: true
	}].forEach(function (groupOpts, i, e) {
		var self = e[i];

		Sortable.create( byId( self.id ), {
			sort: true,
			group: groupOpts,
			animation: 150,
			filter: '.facet-remove',
			onFilter: function (evt) {
				evt.item.parentNode.removeChild(evt.item);
				update_values( evt );
			},
			// Element is dropped into the list from another list
			onUpdate: update_values,
			onAdd: function( ev ) {
				update_values( ev );
			},
			onRemove: update_values
		});
	});

	/*
	 * A functon to update values when a change is made into the sorable object
	 */
	var update_values = function( ev ) {

		var $config = $('#setting-listable_facets_config' ),
				current_val_json = $config.val(),
				result = {};

		var type = $(ev.item).data('type');

		$('.facets-config .sortable_block .facets' ).each( function(el, key){

			var id = $(this ).attr( 'id' ),
					items = $(this).children('li');

			result[id] = {};

			if ( items.length > 0 ) {
				$.each(items, function( i, elm ) {
					result[id][i] = $(elm).data('facet');
				});
			}
		});

		$config.val( JSON.stringify( result ) );
	};
})( jQuery );
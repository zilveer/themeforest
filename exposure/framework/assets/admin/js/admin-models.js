/**
 * Media
 */
var THB_Media = Backbone.Model.extend({
	open: function( options ) {
		var self = this,
			defaults = {
				id:         'library',
				multiple:   false, // false, 'add', 'reset'
				describe:   false,
				toolbar:    'select',
				sidebar:    'settings', 
				content:    'upload',
				router:     'browse',
				menu:       'default',
				searchable: true,
				filterable: false,
				sortable:   true,
				ids: [],
				// title:      '',

				// Uses a user setting to override the content mode.
				contentUserSetting: false,

				// Sync the selection from the last state when 'multiple' matches.
				syncSelection: false
			};

		defaults = jQuery.extend(defaults, options);

		if( options.ids && options.ids.length > 0 ) {
			defaults.content = 'browse';
		}

		wp.media.controller.THBUploadController = wp.media.controller.Library.extend({
			'defaults': defaults
		});

		var media_popup = wp.media({
			states: [ new wp.media.controller.THBUploadController() ]
		});

		media_popup.states.models[0].on('select', function() {
			self.close( this );
		});

		media_popup.on('open', function() {
			var selection = media_popup.state().get('selection');

			if( options.ids ) {
				jQuery.each(options.ids, function(id) {
					attachment = wp.media.attachment(options.ids[id]);
					attachment.fetch();
					selection.add( attachment ? [attachment] : [] );
				});
			}
		});

		media_popup.open();
	},

	close: function( frame ) {
		var selection = frame.get('selection'),
			images = [];

		jQuery.each( selection.models, function() {
			images.push({
				url: this.attributes.url,
				id: this.attributes.id
			});
		} );

		if( images.length > 0 ) {
			this.valorize(images);
		}
	},

	valorize: function( images ) {
		console.log(images);
	}
});
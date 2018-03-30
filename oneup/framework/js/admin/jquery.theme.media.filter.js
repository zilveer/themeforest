/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global wp,jQuery */

jQuery(document).ready(function($) {
	
	if (!window.wp || !window.wp.media) {
		return;
	}
	
	var media = window.wp.media;
	// array of tag names
	var names = window.pe_theme_media_filters.names;
	// array of tag slugs
	var slugs = window.pe_theme_media_filters.slugs;
	
	var tagFilter = media.view.AttachmentFilters.extend({
			createFilters: function() {
				var filters = {};
				
				// default "all" filter, shows all tags
				filters.all = {
					text:  window.pe_theme_media_filters.all,
					props: {
						// unset tag
						tag: null,
						type:    null,
						uploadedTo: null,
						orderby: 'date',
						order:   'DESC'
					},
					priority: 10
				};
				
				// create a filter for each tag
				var i;
				for (i = 0;i<names.length;i++) {
					filters[slugs[i]] = {
						// tag name
						text:  names[i],
						props: {
							// tag slug
							tag: slugs[i],
							type:    null,
							uploadedTo: null,
							orderby: 'date',
							order:   'DESC'
						},
						priority: 20+i
					};

				}
				
				this.filters = filters;
			}
		});
	
	// backup the method
	var orig = wp.media.view.AttachmentsBrowser;
	
	wp.media.view.AttachmentsBrowser = wp.media.view.AttachmentsBrowser.extend({
		createToolbar: function() {
			// call the original method
			orig.prototype.createToolbar.apply(this,arguments);
			
			// add our custom filter
			this.toolbar.set('tags', new tagFilter({
				controller: this.controller,
				model:      this.collection.props,
				// controls the position, left align if < 0, right align otherwise
				priority:   -10
			}).render() );
		}
	});
	
	
});

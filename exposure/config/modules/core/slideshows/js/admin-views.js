jQuery(document).ready(function() {
	var slideshow = new THB_Slideshow();
});

/**
 * Slideshow.
 */
var THB_Slideshow = Backbone.View.extend({
	el: '#post',

	initialize: function() {
		var self = this;

		// Slideshow
		this.slideshow = this.$('[name="slideshow_type"]');
		this.slideshow_contents = this.$('[name="slideshow_contents"]');
		this.slides_container = this.$('#thb-fields-container-slides_container');
		this.slideshow_contents_details = this.$('#thb-fields-container-slideshow_contents_details_container');

		this.slideshow_types = [];
		this.slideshow.find('option').each(function() {
			var opt = self.$("#thb-fields-container-" + jQuery(this).attr("value") + "_options");

			if( opt.length > 0 ) {
				self.slideshow_types.push(opt);
			}
		});

		this.slideshowTypeChange();
		this.slideshowContentsChange();
	},

	events: {
		'change [name="slideshow_type"]': 'slideshowTypeChange',
		'change [name="slideshow_contents"]': 'slideshowContentsChange'
	},

	slideshowContentsChange: function() {
		var contents = this.slideshow_contents.val();

		if( contents === undefined ) {
			return;
		}

		if( contents !== '0' ) {
			this.slides_container.hide();
			this.slideshow_contents_details.show();
		}
		else {
			this.slides_container.show();
			this.slideshow_contents_details.hide();
		}
	},

	slideshowTypeChange: function() {
		var self = this,
			type = this.slideshow.val(),
			opt = self.$("#thb-fields-container-" + type + "_options");

		jQuery.each(this.slideshow_types, function() {
			jQuery(this).hide();

			if( opt.length > 0 ) {
				if( jQuery(this).is(opt) ) {
					opt.show();
				}
			}
		});
	}
});
/**
 * Duplicable container
 */
var THB_DuplicableContainer = Backbone.View.extend({
	el: ".thb-fields-container.duplicable",

	initialize: function() {
		this.fields_container = this.$('.thb-container');
		this.fields_counter = this.$('.thb-field').length;

		if( this.$el.hasClass('sortable') ) {
			this.fields_container.sortable({ distance: 10 });
		}
	},

	events: {
		'click .thb-controls > a': 'fire',
		'click .thb-field .thb-remove': 'removeField'
	},

	fire: function( event ) {
		var control = jQuery(event.target),
			tpl = control.data("tpl");

		if( control.data("action") ) {
			var fn = window[control.data("action")];
			if( typeof fn === 'function' ) {
				fn(this, tpl);
			}
		}
		else {
			this.addField(tpl);
		}

		return false;
	},

	addField: function( tpl ) {
		var template = _.template(
			this.$('script[data-tpl="' + tpl + '"]').html()
		);

		var html = jQuery(template());
		html.addClass("thb-new");

		if( this.$el.hasClass("prependable") ) {
			html = html.prependTo(this.fields_container);
		}
		else {
			html = html.appendTo(this.fields_container);
		}

		thb_boot_fields(html);

		jQuery.scrollTo( html.position().top + 28,{
			// duration: 250
		} );

		setTimeout(function() {
			html.removeClass("thb-new");
		}, 10);

		this.fields_counter++;
		this.containerClass();

		return html;
	},

	removeField: function( event ) {
		var self = this,
			field = jQuery(event.target).parents('.thb-field');

		jQuery.thb.transition(field, function() {
			field.animate({ width: 0, height: 0 }, 250, function() {
				field.remove();
				self.fields_counter--;
				self.containerClass();
			});

			// field.slideUp(350, function() {
			// 	field.remove();
			// 	self.fields_counter--;
			// 	self.containerClass();
			// });
		});

		field.addClass("thb-new");

		return false;
	},

	containerClass: function() {
		if( this.fields_counter === 0 ) {
			this.$el.addClass("no-fields");
		}
		else {
			this.$el.removeClass("no-fields");
		}
	}
});

/**
 * Form.
 */
var THB_Form = Backbone.View.extend({
	initialize: function() {
		this.action = this.$el.attr("action");
		this.button = this.$("input[type='submit']");
		this.button_val = this.button.val();
		this.form_data = '';
	},

	events: {
		'submit': 'submit'
	},

	submit: function() {
		var self = this;

		self.form_data = self.$el.serialize().replace(/%5B%5D/g, '[]');

		self.button
			.attr("disabled", "disabled")
			.val( jQuery.thb.translate("saving") );

		jQuery.post(self.action, self.form_data, function( response ) {
			jQuery.thb.message(response.message);

			self.button
				.removeAttr("disabled")
				.val(self.button_val);
		}, 'json');

		return false;
	}
});

/**
 * Options tab.
 */
var THB_Tab = Backbone.View.extend({
	initialize: function() {
		var self = this;
		this.id = this.$el.attr("id");
		this.forms = [];

		this.$("form.thb-ajax").each(function() {
			self.forms.push( new THB_Form({ el: this }) );
		});
	},

	show: function() {
		this.$el.show();
	},

	hide: function() {
		this.$el.hide();
	}
});

/**
 * Tabs navigation.
 */
var THB_Nav = Backbone.View.extend({
	events: {
		"click > ul li a": "select"
	},

	initialize: function() {
		jQuery('.thb-page-tabs-container').css('min-height', this.$el.outerHeight());
		this.items = this.$el.find('ul li');
	},

	select: function( event ) {
		var href = jQuery(event.target).attr('href').replace("#", ""),
			tab = page.tab(href);

		jQuery.each(page.tabs, function() {
			this.hide();
		});

		this.items.removeClass('active');
		jQuery(event.target).parent().addClass('active');

		tab.show();

		setTimeout(function() {
			jQuery("textarea.code").trigger("refresh");
		}, 5);

		return false;
	}
});

/**
 * Page.
 */
var THB_Page = Backbone.View.extend({
	el: '.thb-page',

	initialize: function() {
		var self = this;
		self.nav = new THB_Nav({ el: this.$(".thb-page-tabs-nav") });
		self.tabs = [];
		self.duplicable_containers = [];

		thb_boot_fields();

		this.$(".thb-fields-container.duplicable").each(function() {
			self.duplicable_containers.push( new THB_DuplicableContainer({ el: this }) );
		});

		this.$(".thb-page-tab").each(function() {
			self.tabs.push( new THB_Tab({ el: this }) );
		});

		jQuery('.widget').each(function() {
			if(jQuery(this).attr('id') && jQuery(this).attr('id').indexOf('_thb_') != -1) {
				jQuery(this).addClass('thb');
			}
		});
	},

	tab: function( eid ) {
		var self = this,
			tab = null;

		jQuery.each(self.tabs, function() {
			if( this.id == String(eid) ) {
				tab = this;
				return;
			}
		});

		return tab;
	}
});

/**
 * Post.
 */
var THB_Post = Backbone.View.extend({
	el: '#post',

	initialize: function() {
		var self = this;

		// Duplicable containers
		this.duplicable_containers = [];
		this.$(".thb-fields-container.duplicable").each(function() {
			self.duplicable_containers.push( new THB_DuplicableContainer({ el: this }) );
		});

		// Post formats
		this.metaboxes = this.$('#metabox_post_gallery, #metabox_post_quote, #metabox_post_video, #metabox_post_audio, #metabox_post_link');

		// if( jQuery('body').hasClass('branch-3-5') ) {
			this.group = this.$('#post-formats-select input');
			this.groupChange();
		// }
		// else {
		// 	var changed_labels = ["gallery", "link", "video", "audio", "image", "quote"];

		// 	jQuery.each(changed_labels, function() {
		// 		jQuery('a[data-wp-format="' + this + '"]').attr("data-description", jQuery.thb.translate(this + "-help-text"));
		// 		jQuery('#post-body-content.wp-format-' + this + ' .post-format-description').html(jQuery.thb.translate(this + "-help-text"));
		// 	});

		// 	jQuery(".post-format-options").on("click", "a", function(e) {
		// 		var icon = jQuery(e.currentTarget),
		// 			format = icon.data('wp-format');

		// 		self.metaboxes.hide();
		// 		jQuery('#metabox_post_' + format).show();

		// 		return true;
		// 	});

		// 	jQuery(".post-format-options a.active").trigger("click");
		// }
	},

	events: {
		'change #post-formats-select input': 'groupChange'
	},

	groupChange: function() {
		var self = this;

		this.group.each(function() {
			if( jQuery(this).is(':checked') ) {
				self.metaboxes.hide();
				var val = jQuery(this).val();
				jQuery('#metabox_post_' + val).show();
				return;
			}
		});
	}
});

/**
 * Modal
 */
var THB_Modal = Backbone.View.extend({
	defaults: {
		"title": "",
		onClose: function() {}
	},

	initialize: function() {
		var options = _.extend(this.defaults, this.options);

		this.title = options.title;
		this.onClose = options.onClose;
		this.$content = this.$el.find(".thb-modal-content-inner");
	},

	events: {
		'click .button-primary': 'close'
	},

	open: function( data ) {
		this.$content.find("header h1").html( this.title );
		this.$content.find("form").html( data );
		this.$el.show();
	},

	close: function( ) {
		this.$el.hide();
		this.onClose( jQuery.parseParams( this.$content.find("form").serialize().replace(/%5B%5D/g, '[]') ) );
	}
});
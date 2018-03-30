/**
 * Boot
 */
function thb_boot_fields( root ) {
	if( !root ) {
		root = jQuery('body');
	}

	root.find(".thb-colorpicker").each(function() {
		var el = jQuery(this);

		el.wpColorPicker();
	});

	root.find(".thb-view-upload").each(function() {
		var el = jQuery(this);

		if( !fields.containsKey(el) ) {
			fields.put( this, new THB_Upload({ el: el }) );
		}
	});

	root.find(".thb-view-gallery").each(function() {
		var el = jQuery(this);

		if( !fields.containsKey(el) ) {
			fields.put( this, new THB_Gallery({ el: el }) );
		}
	});

	root.find(".date").each(function() {
		var format = jQuery(this).data('date-format'),
			options = {
				dateFormat: format,
				dayNames: jQuery.thb.dayNames,
				dayNamesShort: jQuery.thb.dayNamesShort,
				monthNames: jQuery.thb.monthNames,
				monthNamesShort: jQuery.thb.monthNamesShort,
				prevText: '<',
				nextText: '>'
			};

		jQuery(this).datepicker(options);
	});

	root.find("textarea.code").each(function() {
		var node = jQuery(this).get(0),
			editor = CodeMirror.fromTextArea(node, {
				mode: "css",
				indentWithTabs: true,
				indentUnit: 4,
				lineNumbers: true
			});

		editor.on("change", function(instance, changeObj) {
			jQuery(node).text(editor.getValue());
		});

		jQuery(this).bind('refresh', function() {
			editor.refresh();
		});
	});

	var graphic_radio_groups = [];
	root.find(".thb-radio-options :radio").each(function() {
		if( ! graphic_radio_groups[this.name] ) {
			graphic_radio_groups.push(this.name);
		}
	});

	jQuery.each(graphic_radio_groups, function() {
		var radios = jQuery("[data='thb-radio-option-" + this + "'] img");

		radios.on("click", function() {
			var parent = jQuery(this).parents(".thb-radio-option");

			parent.find("input[type='radio']").trigger("click");

			radios.removeClass("thb-checked");

			if( parent.find("input[type='radio']").is(":checked") ) {
				jQuery(this).addClass("thb-checked");
			}
		});

		if( ! radios.filter(".thb-checked").length ) {
			radios.first().addClass("thb-checked");
		}
	});
}

/**
 * Slide
 */
function thb_add_multiple_slides(container, tpl) {
	var media = new THB_Media();

	media.valorize = function( images ) {
		if( images.length > 0 ) {
			jQuery.each(images, function() {
				var html = container.addField(tpl),
					el = html.find(".thb-view-upload").get(0);

				if( fields.containsKey(el) ) {
					upl = fields.get(el);
					upl.valorize(this);
				}
			});
		}
	};

	media.open({
		title: jQuery("[data-action='thb_add_multiple_slides']").data('title'),
		multiple: true
	});
}

/**
 * Gallery
 */
var THB_Gallery = Backbone.View.extend({
	events: {
		'click .thb-btn-upload': 'openMedia'
	},

	initialize: function() {
		this.field = this.$("input");
		this.ids = [];
	},

	openMedia: function( event ) {
		var media = new THB_Media(),
			self = this,
			title = this.$el.data('media-title');

		media.valorize = function( images ) {
			self.field.val('');
			self.ids = [];

			if( images.length > 0 ) {
				jQuery.each(images, function() {
					self.ids.push(this.id);
				});

				self.field.val('[gallery ids="' + self.ids.join() + '"]');
			}
		};

		this.ids = self.field.val().replace(/[A-Za-z= "\[\]]/g, "").split(",");

		if( this.ids.length == 1 && this.ids[0] === '' ) {
			this.ids = [];
		}

		media.open({
			title: title,
			multiple: 'add',
			ids: this.ids
		});

		return false;
	}
});

/**
 * Upload
 */
var THB_Upload = Backbone.View.extend({
	events: {
		'click .thb-btn-upload': 'openMedia',
		'click .thb-upload-remove a': 'removeImage'
	},

	initialize: function() {
		this.preview = this.$(".thb-preview");
		this.url = this.$(".thb-url");
		this.id = this.$(".thb-id");
		this.remove = this.$(".thb-upload-remove");
	},

	valorize: function( image ) {
		var prv = ajaxurl + "?action=thb_render_resource&page_id=0&name=frontend/getImageSize&id="+image.id+"&w=80&h=80";

		this.preview.attr('src', prv);
		// this.url.val(image.url);
		this.id.val(image.id);

		this.remove.show();
	},

	removeImage: function( event ) {
		this.preview.attr("src", 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
		this.url.val("");
		this.id.val("");

		this.remove.hide();

		return false;
	},

	openMedia: function( event ) {
		var media = new THB_Media(),
			self = this;

		media.valorize = function( images ) {
			self.removeImage();

			if( images.length == 1 ) {
				self.valorize(images[0]);
			}
		};

		media.open({
			title: self.$el.parents('.thb-field').find('> label').first().text(),
			ids: self.id.val() === '' ? [] : [ self.id.val() ]
		});

		return false;
	}
});
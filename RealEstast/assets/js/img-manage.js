jQuery(function($) {
	var galleryFrame;

	window.ImgManager = {
		Models: {},
		Views: {},
		Collections: {}
	};

	ImgManager.Models.Item = Backbone.Model.extend({
		defaults: {
			item_id: '',
			type: 'image',
			thumbnail: ''
		}
	});

	ImgManager.Views.Item = Backbone.View.extend({
		tagName: 'li',
		image_template: _.template("<a href='#'><img src='<%=thumbnail%>' class='thumbnail' /></a><a href='#' class='close'>&times;</a>"),
		render: function() {
			if (this.model.get('type') == 'image') {
				this.$el.html(this.image_template(this.model.toJSON()));
			} else {

			}
			return this;
		}
	});

	ImgManager.Collections.Items = Backbone.Collection.extend({
		model: ImgManager.Models.Item
	});

	ImgManager.Views.App = Backbone.View.extend({
		initialize: function(options) {
			_.extend(this, _.pick(options, "el", "add_image_btn"));
			this.collection = new ImgManager.Collections.Items();
			this.setElement(this.el);
			this.$list = this.$el.find('.img-list');
			this.bindActions();
			this.listenEvents();
		},

		bindActions: function() {
			this.events = {};
			this.events["click " + this.add_image_btn] = "showImageBox";
		},

		listenEvents: function() {
			this.collection.bind("add", this.onCollectionAdd, this);
		},

		/**
		 * Handling event methods
		 */
		onCollectionAdd: function() {
			var newModel = this.collection.at(this.collection.length - 1);
			var item = new ImgManager.Views.Item({
				model: newModel
			});
			this.$list.append(item.render().el);
		},

		/**
		 * Action methods
		 */
		showImageBox: function(event) {
			var that = this;
			var galleryFrame = wp.media.frames.downloadable_file = wp.media({
				title: 'Add Images to Gallery',
				button: {
					text: 'Add to gallery'
				},
				multiple: true
			});

			galleryFrame.on('select', function() {
				var selection = galleryFrame.state().get('selection');
				selection.map(function(attachment) {
					attachment = attachment.toJSON();
					if (attachment.id) {
						that.collection.add({
							item_id: attachment.id,
							type: 'image',
							thumbnail: attachment.url,
							caption: attachment.caption,
							description: attachment.description
						});
					}
				});
			});
			galleryFrame.open();
		}
	});

	var imgManager = new ImgManager.Views.App({
		el: $('#pgl_image_container'),
		add_image_btn: '.addBtn'
	});
});
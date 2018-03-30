function linkifyYouTubeURLs(url) {
	var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
	var match = url.match(regExp);
	if (match && match[2].length == 11) {
		return match[2];
	} else {
		return false;
	}
}

function linkifyVimeo(url) {
	var regExp = /https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/;
	var match = url.match(regExp);
	if (match) {
		return match[3];
	} else {
		return false;
	}
}

/**
 * ############################################
 * ############################################
 * Backbones...
 * ############################################
 * ############################################
 */
var galleryApp;
/**
 * Our Model
 */
jQuery(function ($) {
	var galleryFrame;

	window.PglGallery = {
		Models     : {},
		Views      : {},
		Collections: {}
	};

	Backbone.pubSub = _.extend({}, Backbone.Events);

	PglGallery.Models.Item = Backbone.Model.extend({
		defaults: {
			item_id  : '',
			type     : 'image',
			thumbnail: ''
		}
	});

	PglGallery.Collections.Items = Backbone.Collection.extend({
		model: PglGallery.Models.Item
	});

	PglGallery.Views.Item = Backbone.View.extend({
		tagName: 'li',
		template        : _.template("<img src='<%=thumbnail%>' /><a href='#' class='close'>&times;</a>"),
		youtube_template: _.template("<img src='<%=thumbnail%>' /><div class='hover-layer'>YOUTUBE VIDEO</div><a href='#' class='close'>&times;</a>"),
		vimeo_template  : _.template("<img src='<%=thumbnail%>' /><div class='hover-layer'>VIMEO VIDEO</div><a href='#' class='close'>&times;</a>"),

		render: function () {
			if (this.model.get('type') == 'image') {
				this.$el.html(this.template(this.model.toJSON()));
			} else {
				if (this.model.get('type') == 'youtube') {
					this.$el.html(this.youtube_template(this.model.toJSON()));
				} else {
					this.$el.html(this.vimeo_template(this.model.toJSON()));
				}
			}
			this.$el.data('cid', this.cid);
			return this;
		},

		events: {
			"click a.close": "popupRemove"
		},

		popupRemove: function (e) {
//			console.log(this.model);
			e.preventDefault();
			if (confirm("Remove this item from gallery ?")) {
				this.model.destroy(); //require localStorage
				Backbone.pubSub.trigger('reorder-gallery', this.cid);
				this.$el.remove();
			}
		}
	});

	PglGallery.Views.App = Backbone.View.extend({
		$el: jQuery('#gallery-container'),

		initialize: function (options) {
			_.extend(this, _.pick(options, "el", "add_image", "add_video"));
			this.$ids = this.$el.find("#ids");
			this.$list = this.$el.find('ul');
			this.$el.append(this.$list);
			this.collection = new PglGallery.Collections.Items();
			this.viewList = [];
			this.bindAction();
			this.listenEvents();

			var items_string = this.$el.find('#ids').val();
			if (items_string) {
				var items = JSON.parse(items_string);
				for (var i = 0; i < items.length; i++) {
					this.collection.add(items[i]);
				}
			}
			var that = this;

			this.$list.sortable({
				items               : "> li",
				cursor              : "move",
				scrollSensitivity   : 40,
				forcePlaceholderSize: true,
				forceHelperSize     : false,
				helper              : 'clone',
				opacity             : 0.65,
				placeholder         : 'estate_metabox_placeholder',
				cancel              : "input[type=text],textarea",
				update              : function(){that.onCollectionReorder();}
			});

			//render the list (for the first time)
//			this.render();
		},
		render    : function () {
			this.collection.each(function (itemModel) {
				var itemView = new PglGallery.Views.Item({model: itemModel});
				this.$list.append(itemView.render().el);
			}, this);
			return this;
		},

		listenEvents: function () {
			Backbone.pubSub.on('reorder-gallery', this.onCollectionItemRemove, this);
			this.collection.bind("add", this.onCollectionAdd, this);
			this.collection.bind("add remove", this.onCollectionUpdate, this);
		},

		bindAction     : function () {
			this.events = {};
			this.events["click " + this.add_image] = "showImageBox";
			this.events["click " + this.add_video] = "showVideoBox";

		},

		//event handling methods
		onCollectionAdd: function () {
			//get model object just been added
			var newModel = this.collection.at(this.collection.length - 1);
			var item = new PglGallery.Views.Item({model: newModel});
			this.$list.append(item.render().el);
			this.viewList.push(item);
		},

		onCollectionReorder: function(){
			var old_collection = this.collection;
			var i;
			var AppView = this;
			this.collection = new PglGallery.Collections.Items();
			this.$list.find('li').each(function(){
				var $this = jQuery(this);
				var this_id = $this.data('cid');
				for( i = 0; i < AppView.viewList.length; i++ ) {
					if ( AppView.viewList[i].cid == this_id ) {
						AppView.collection.add(AppView.viewList[i].model)
					}
				}
			});
			this.onCollectionUpdate();
		},

		onCollectionUpdate: function () {
			this.$ids.val(JSON.stringify(this.collection));
		},

		onCollectionItemRemove: function(cid) {
			for (var i in this.viewList) {
				if(this.viewList.hasOwnProperty(i) && this.viewList[i].cid == cid) {
					this.viewList.splice(i,1);
				}
			}
		},

		//action methods
		showImageBox      : function (event) {
			event.preventDefault();
			var that = this;

			//just open the frame if it exists
			if (galleryFrame) {
				galleryFrame.open();
				return;
			}

			galleryFrame = wp.media.frames.downloadable_file = wp.media({
				title   : 'Add Images to Gallery',
				button  : {
					text: 'Add to gallery'
				},
				multiple: true
			});

			galleryFrame.on('select', function () {
				var selection = galleryFrame.state().get('selection');
				selection.map(function (attachment) {
					attachment = attachment.toJSON();
					if (attachment.id) {
						that.collection.add({
							item_id  : attachment.id,
							type     : 'image',
							thumbnail: attachment.url,
							
						});
					}
				});
			});
			galleryFrame.open();
		},

		showVideoBox: function (e) {
			var video_id;
			e.preventDefault();
			var url = prompt("Video URL(youtube, vimeo)");
			if (url) {
				video_id = linkifyYouTubeURLs(url);
				if (video_id) {
					this.collection.add({item_id: video_id, type: 'youtube', thumbnail: 'http://img.youtube.com/vi/' + video_id + '/hqdefault.jpg'});
				} else {
					video_id = linkifyVimeo(url);
					if (video_id) {
						var that = this;
						jQuery.ajax({
							url     : 'http://vimeo.com/api/v2/video/' + video_id + '.json',
							dataType: 'jsonp',
							success : function (data) {
								var thumbnail_url = data[0].thumbnail_large;
								that.collection.add({item_id: video_id, type: 'vimeo', thumbnail: thumbnail_url});
							}
						});
					}
				}
			}
		}
	});
	galleryApp = new PglGallery.Views.App({
		el       : $('#gallery-container'),
		add_image: "#add_image",
		add_video: "#add_video"
	});
});



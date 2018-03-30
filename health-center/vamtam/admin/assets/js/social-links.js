(function($, undefined) {
	'use strict';

	if($('#wpv-tmpl-social-link').length === 0) return;

	$.WPV = $.WPV || {};
	$.WPV.Views = $.WPV.Views || {};
	$.WPV.Models = $.WPV.Models || {};
	$.WPV.Collections = $.WPV.Collections || {};

	$.WPV.Models.SocialLink = Backbone.Model.extend({
		defaults: {
			'icon-name': '',
			'icon-text': '',
			'icon-link': ''
		}
	});

	$.WPV.Collections.SocialLinks = Backbone.Collection.extend({
		model: $.WPV.Models.SocialLink
	});

	$.WPV.Views.SocialLinkView = Backbone.View.extend({
		tagName: 'tr',
		template: _.template( $('#wpv-tmpl-social-link').html() ),
		events: {
			'change select': 'save',
			'change input': 'save',
			'keydown input': 'save',
			'click .icon-change': 'changeIcon'
		},
		save: function() {
			var newatts = {};

			for(var i in this.model.attributes) {
				var inp = this.$el.find('[name="'+i+'"]');

				if(inp.length)
					newatts[i] = inp.val();
			}

			this.model.set(newatts);

			this.options.parent.$el.next('textarea.data').val(JSON.stringify(this.model.collection));

			this.render();
		},
		render: function() {
			this.$el.html(this.template( this.model.attributes ));
			for(var i in this.model.attributes) {
				var att = this.model.attributes[i];
				this.$el.find('[name="'+i+'"]').val(att);
			}

			this.$el.find('.icon-preview').html(window.VamtamIconsCache[this.model.attributes['icon-name']]);

			return this;
		},
		changeIcon: function(e) {
			e.preventDefault();

			var table = this.options.parent.$el.addClass('hidden');
			var icons = table.prev('.wpv-config-icons-selector').removeClass('hidden');

			var self = this;

			icons.find('[value="'+this.model.attributes['icon-name']+'"]').prop('checked', true).change();

			icons.parent().wpvIconsSelector('scroll');

			icons.find(':radio').bind('change.wpv-social-links', function() {
				table.removeClass('hidden');
				icons.addClass('hidden');

				self.$el.find('[name="icon-name"]').val(icons.find(':checked').val()).change();

				icons.find(':radio').unbind('change.wpv-social-links');
			});
		}
	});

	$.WPV.Views.SocialLinksView = Backbone.View.extend({
		template: _.template( $('#wpv-tmpl-social-links').html() ),
		events: {
			'click .add-new-icon': 'addNew'
		},
		initialize: function() {
			this.listenTo(this.collection, 'reset', this.render);
			this.listenTo(this.collection, 'add', this.render);
			this.render();
		},
		render: function() {
			this.$el.html(this.template());

			var current = this.$el.find('.current-icons');

			this.collection.each(function(link) {
				var view = new $.WPV.Views.SocialLinkView({
					model: link,
					parent: this
				});
				current.append(view.render().$el);
			}, this);

			return this;
		},
		addNew: function(e) {
			e.preventDefault();
			this.collection.add(new this.collection.model());
		}
	});

	$(document).one('vamtam-icons-loaded', function() {
		$('.wpv-config-row.social-links').each(function() {
			var data = $.parseJSON($('textarea.data', this).val());
			var self = $(this);

			new $.WPV.Views.SocialLinksView({
				el: $('.social-links-builder', self),
				collection: new $.WPV.Collections.SocialLinks(data)
			});
		});
	});

})(jQuery);
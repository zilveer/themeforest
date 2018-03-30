

ait.admin.shortcodes = ait.admin.shortcodes || {};

(function($){

	"use strict";

	$(function(){
		ait.admin.shortcodes.Tabs.init();
		ait.admin.shortcodes.Builder.init();
	});

	var storage = ait.admin.shortcodes.storage = new ait.admin.Storage('AitShortcodesGenerator', {activeTab: '', currentShortcode: ''});

	var $context = $(document);


	// ===============================================
	// Shortcodes Builder
	// -----------------------------------------------

	var builder = ait.admin.shortcodes.Builder = {

		onBuild: {},


		init: function()
		{
			$context.on('click', '#ait-insert-shortcode', builder.insert);
		},



		insert: function(e)
		{
			e.preventDefault();

			var currentShortcode = storage.load('currentShortcode');

			var $this = $(this); // "Insert Shortcode" button
			var $container = $context.find('#ait-shortcode-' + currentShortcode + '-panel');
			var shortcodeString;
			var rawFormData;

			// just hack to use serialize() to get form values
			$container.wrap('<form action=""></form>');
			rawFormData = $.deparam($container.parent().serialize());
			$container.unwrap('<form action=""></form>');

			shortcodeString = builder.build(
				currentShortcode,
				rawFormData,
				AitShortcodes.defaults[currentShortcode],
				AitShortcodes.types[currentShortcode]
			);

			builder.getParentWindow().send_to_editor(shortcodeString);
		},



		build: function(tag, rawFormData, defaultAttrs, type)
		{
			var sc = storage.load('currentShortcode');

			if(sc in builder.onBuild){
				return builder.onBuild[sc](tag, rawFormData, defaultAttrs, type);
			}

			var attrs = _.defaults(rawFormData, defaultAttrs);
			var content = '';

			// Remove default attributes from the shortcode.
			_.each(defaultAttrs, function(value, key){
				// for sample content
				if(key == 'content'){
					content = attrs[key];
					delete attrs[key];
				}

				if(value == attrs[key])
					delete attrs[key];
			});

			return wp.shortcode.string({
				tag: tag,
				attrs: attrs,
				type: type,
				content: content
			});
		},



		getParentWindow: function()
		{
			return window.dialogArguments || opener || parent || top;
		}

	};


	// ===============================================
	// Tabs
	// -----------------------------------------------

	var tabs = ait.admin.shortcodes.Tabs = {

		init: function()
		{
			$context.find('.ait-shortcode-tabs-panel').hide();

			var s = storage.load();

			if(s.activeTab !== '' && $(s.activeTab).length)
				$(s.activeTab).show();
			else
				$context.find('.ait-shortcode-tabs-panel:first').show();

			if(s.activeTab !== '' && $context.find(s.activeTab + '-tab').length){
				$context.find(s.activeTab + '-tab').addClass('active');
			}else{
				var data = {activeTab: '', currentShortcode: ''};

				var $firstTab = $context.find('.ait-shortcodes-tabs a:first');
				$firstTab.addClass('active');

				data.currentShortcode = $firstTab.data('shortcode');
				data.currentShortcode = data.currentShortcode || '';

				data.activeTab = $firstTab.attr('href');
				data.activeTab = data.activeTab || '';

				storage.save(data);
			}


			$context.on('click', '.ait-shortcodes-tabs a', function(e){
				e.preventDefault();
				var $this = $(this);

				tabs.switchTab($this, $this.data('shortcode'), $context.find('.media-frame-content'));
			});
		},



		// Click event on the settngs tab
		switchTab: function($tab, shortcode, $content, fromButtonMenu)
		{
			if(typeof fromButtonMenu === "undefined") { fromButtonMenu = false; }

			if($tab.hasClass('active'))
				return false;

			$tab.siblings().removeClass('active');
			$tab.addClass('active').blur();

			var panel = $tab.attr('href');

			if(!fromButtonMenu){
				storage.save({
					activeTab: $tab.attr('href'),
					currentShortcode: shortcode
				});
			}

			$content.find('.ait-shortcode-tabs-panel').hide();

			$content.find('#ait-insert-shortcode').attr('data-shortcode', shortcode);

			$content.find(panel).show();
		}

	};



	// ===============================================
	// Media Shortocodes Generator Frame
	// -----------------------------------------------

	var oldMediaFrame = wp.media.view.MediaFrame.Post;

	wp.media.view.MediaFrame.Post = oldMediaFrame.extend({
		initialize: function(){
			oldMediaFrame.prototype.initialize.apply(this, arguments);
			// removes Ait Shortcodes tab from main media frame
			this.on('menu:render:default', function(view){
				view.unset('iframe:ait-shortcodes');
			});
		}
	});


	ait.admin.shortcodes.Generator = {

		open: function(shortcode)
		{
			if(typeof shortcode === "undefined") { shortcode = ''; }

			var frame = this.frame();
			frame.open();

			$context.find('#ait-shortcodes-generator-frame').addClass('hide-menu'); // hack for hiding default frame menu, TODO: it could use frame events somehow

			var iframe = frame.$el.find('iframe');
			var $tab;

			if(iframe.length && shortcode !== ''){
				var $content = iframe.contents();

				$tab = $content.find('#ait-shortcode-' + shortcode + '-panel-tab');
				$context = $content.find('#ait-shortcodes-options');
				tabs.switchTab($tab, shortcode, $context, true);
			}
		},



		frame: function()
		{
			if(this._frame){
				return this._frame;
			}

			this._frame = wp.media({
				id:         'ait-shortcodes-generator-frame',
				frame:      'post',
				state:      'iframe:ait-shortcodes',
				title:      'AIT Shortcode',
				editing:    false,
				multiple:   false
			});

			return this._frame;
		}

	};

}(jQuery));

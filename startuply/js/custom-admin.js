(function ($) {
	if (window.InlineShortcodeView_vc_row) {
		window.InlineShortcodeView_vsc_content_slider = window.InlineShortcodeView_vc_row.extend({
			events: {
				'click > :first > .vc_empty-element': 'addElement',
				'click > :first > .wpb_wrapper > .ui-tabs-nav > li': 'setActiveTab'
			},
			already_build: false,
			active_model_id: false,
			$tabsNav: false,
			active: 0,
			render: function() {
				_.bindAll(this, 'stopSorting');
				this.$tabs = this.$el.find('> .wpb_tabs');
				window.InlineShortcodeView_vc_tabs.__super__.render.call(this);
				this.buildNav();
				return this;
			},
			buildNav: function() {
				var $nav = this.tabsControls();
				this.$tabs.find('> .wpb_wrapper > .vc_element[data-tag="vc_tab"]').each(function(key){
					$('li:eq('+key+')', $nav).attr('data-m-id', $(this).data('model-id'));
				});
			},
			changed: function() {
				if(this.$el.find('.vc_element[data-tag]').length == 0) {
					this.$el.addClass('vc_empty').find('> :first > div').addClass('vc_empty-element');
				} else {
					this.$el.removeClass('vc_empty').find('> :first > div').removeClass('vc_empty-element');
				}
				this.setSorting();
			},
			setActiveTab: function(e) {
				var $tab = $(e.currentTarget);
				this.active_model_id = $tab.data('m-id');
			},
			tabsControls: function() {
				return this.$tabsNav ? this.$tabsNav : this.$tabsNav = this.$el.find('.wpb_tabs_nav');
			},
			buildTabs: function(active_model) {
				if(active_model) {
					this.active_model_id = active_model.get('id');
					this.active = this.tabsControls().find('[data-m-id=' + this.active_model_id +']').index();
				}
				if(this.active_model_id === false) {
					var active_el = this.tabsControls().find('li:first');
					this.active = active_el.index();
					this.active_model_id = active_el.data('m-id');
				}
				if ( ! this.checkCount() ) vc.frame_window.vc_iframe.buildTabs(this.$tabs, this.active);
			},
			checkCount: function() {
				return this.$tabs.find('> .wpb_wrapper > .vc_element[data-tag="vc_tab"]').length != this.$tabs.find('> .wpb_wrapper > .vc_element.vc_vc_tab').length;
			},
			beforeUpdate: function() {
				this.$tabs.find('.wpb_tabs_heading').remove();
				vc.frame_window.vc_iframe.destroyTabs(this.$tabs);
			},
			updated: function() {
				window.InlineShortcodeView_vc_tabs.__super__.updated.call(this);
				this.$tabs.find('.wpb_tabs_nav:first').remove();
				this.buildNav();
				vc.frame_window.vc_iframe.buildTabs(this.$tabs);
				this.setSorting();
			},
			rowsColumnsConverted: function() {
				_.each(vc.shortcodes.where({parent_id: this.model.get('id')}), function(model){
					model.view.rowsColumnsConverted && model.view.rowsColumnsConverted();
				});
			},
			addTab: function(model) {
				if(this.updateIfExistTab(model)) return false;
				var $control = this.buildControlHtml(model), $cloned_tab;

				if(model.get('cloned') && ($cloned_tab = this.tabsControls().find('[data-m-id=' + model.get('cloned_from').id + ']')).length) {
					if( ! model.get('cloned_appended') ) {
						$control.appendTo(this.tabsControls());
						model.set('cloned_appended', true);
					}
				} else {
				$control.appendTo(this.tabsControls());
				}
				this.changed();
				return true;
			},
			cloneTabAfter: function(model) {
				this.$tabs.find('> .wpb_wrapper > .wpb_tabs_nav > div').remove();
				this.buildTabs(model);
			},
			updateIfExistTab: function(model) {
				var $tab = this.tabsControls().find('[data-m-id=' + model.get('id') + ']');
				if( $tab.length ) {
					$tab.attr('aria-controls', 'tab-' + model.getParam('tab_id'))
						.find('a')
						.attr('href', '#tab-' + model.getParam('tab_id'))
						.text(model.getParam('title'));
					return true;
				}
				return false;
			},
			buildControlHtml: function(model) {
				var params = model.get('params'), $tab =$('<li data-m-id="' + model.get('id') +'"><a href="#tab-' + model.getParam('tab_id') + '"></a></li>');
				$tab.data('model', model);
				$tab.find('> a').text(model.getParam('title'));
				return $tab;
			},
			addElement: function(e) {
				e && e.preventDefault();
				new vc.ShortcodesBuilder()
					.create({shortcode: 'vc_tab', params: {tab_id: vc_guid() + '-' + this.tabsControls().find('li').length, title: this.getDefaultTabTitle()}, parent_id: this.model.get('id')})
					.render();
			},
			getDefaultTabTitle: function() {
				return window.i18nLocale.tab;
			},
			setSorting: function() {
				vc.frame_window.vc_iframe.setTabsSorting(this);
			},
			stopSorting: function(event, ui) {
				this.tabsControls().find('> li').each(function(key, value){
					var model = $(this).data('model');
					model.save({order: key}, {silent: true});
				});
			},
			placeElement: function($view, activity) {
				var model = vc.shortcodes.get($view.data('modelId'));
				if(model && model.get('place_after_id')) {
					$view.insertAfter(vc.$page.find('[data-model-id=' + model.get('place_after_id') + ']'));
					model.unset('place_after_id');
				} else {
					$view.insertAfter(this.tabsControls());
				}
				this.changed();
			},
			removeTab: function(model) {
				if(vc.shortcodes.where({parent_id: this.model.get('id')}).length == 1) return this.model.destroy();
				var $tab = this.tabsControls().find('[data-m-id=' + model.get('id') + ']'), index = $tab.index();
				if( this.tabsControls().find('[data-m-id]:eq(' + (index+1) + ')').length) {
					vc.frame_window.vc_iframe.setActiveTab(this.$tabs, (index+1));
				} else if(this.tabsControls().find('[data-m-id]:eq(' + (index-1) + ')').length) {
					vc.frame_window.vc_iframe.setActiveTab(this.$tabs, (index-1));
				} else {
					vc.frame_window.vc_iframe.setActiveTab(this.$tabs, 0);
				}
				$tab.remove();
			},
			clone: function(e) {
				_.each(vc.shortcodes.where({parent_id: this.model.get('id')}), function(model){
					model.set('active_before_cloned', this.active_model_id === model.get('id'));
				}, this);
				window.InlineShortcodeView_vc_tabs.__super__.clone.call(this, e);
			}
		});
	}

	var sidebar_sm = $('.sidebars-column-2 [id^=sidebar_sub_menu]').closest('.widgets-holder-wrap');
	$('.sidebars-column-1').append( sidebar_sm );


	var widgets = $('.sidebars-column-1 [id^=sidebar_footer]').closest('.widgets-holder-wrap');
	$('.sidebars-column-2').prepend( widgets );

	$('body').on('change', '[name=downloads_startuply_edd_view]', function() {
		var $el = $(this),
			value = $el.val(),
			$container = $el.closest('.vc_edit_form_elements'),
			$columns = $container.find('[name="downloads_columns"]');

		if ( value == 'list' ) {
			$columns.find('option').hide();
			$columns.find('[value=1], [value=2]').show();

			if ( $columns.val() == '3' || $columns.val() == '4' ) $columns.val(1)
		}else {
			$columns.find('option').hide();
			$columns.find('[value=2], [value=3], [value=4]').show();

			if ( $columns.val() == '1' ) $columns.val(2)
		}
	});

	/* Force call save() method for save default values from vc_sorted_list control */
	/*
	$('.vc_panel-btn-save').click(function(event){
		var sortedList = $('.vc_sorted-list').data('vc_sorted_list');
		if (sortedList) {
			sortedList.save();
		}
		return true;
	});
	*/

	/*
	if ( $('.wpb-content-layouts li.wpb_vc_wp_widget_o').length ) {
		var className, classArray = $('.wpb-content-layouts li.wpb_vc_wp_widget_o').first().attr('class').split(' ');

		for (var i=0; i<classArray.length; i++) {
			if ( /category-/.test(classArray[i]) ) className = classArray[i]
		}

		$('.wpb-content-layouts-container .isotope-filter .active > a').attr('data-filter', ':not(.' + className + ')');
	}
	*/


})(window.jQuery);

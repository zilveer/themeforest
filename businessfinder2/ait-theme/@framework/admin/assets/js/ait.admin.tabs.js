

ait.admin.Tabs = ait.admin.Tabs || {};


(function($, $window, undefined){

	"use strict";

	/**
	 * Tabs Constructor
	 * @param {jQuery} tabsContainer       Tabs container element
	 * @param {jQuery} panelsContainer     Panels container element
	 * @param {string} storageKey          Key for storage
	 * @param {object} options             Object of additional options
	 */
	var Tabs = function($tabsContainer, $panelsContainer, storageKey, options)
	{
		this.$tabsContainer = $tabsContainer;
		this.$panelsContainer = $panelsContainer;

		if(!this.$panelsContainer.length || !this.$tabsContainer.length) return;

		this.$tabs = this.$tabsContainer.find('li');
		this.$panels = this.$panelsContainer.find('.ait-options-panel');

		this.options = options || {};
		this.storage = new ait.admin.Storage(storageKey)

		this.$title = ('groupTitle' in this.options && this.options.groupTitle.length) ? this.options.groupTitle : $('#ait-options-panel-title');

		this.init();
	}



	/**
	 * Init
	 * @return {void}
	 */
	Tabs.prototype.init = function()
	{
		this.$panels.hide();

		var activeTabFromHash = window.location.hash;
		var activeTab = this.storage.load();

		var cpanel = "";
		if(activeTabFromHash !== '' && $(activeTabFromHash).length){
			$(activeTabFromHash).fadeIn();
			cpanel = activeTabFromHash;
		}else if(activeTab !== '' && $(activeTab).length){
			$(activeTab).fadeIn();
			cpanel = activeTab;
		}else{
			this.$panels.eq(0).fadeIn('fast');
			cpanel = "#"+this.$panels.eq(0).id;
		}

		$(document).trigger('ait-tabs-inited', [cpanel]);

		if(activeTabFromHash !== '' && $(activeTabFromHash + '-tab').length){

			$(activeTabFromHash + '-tab').addClass('tab-active');
			this.storage.save(activeTabFromHash + '');
			this.$title.text($(activeTabFromHash + '-tab a').text());

		}else if(activeTab !== '' && $(activeTab + '-tab').length){

			$(activeTab + '-tab').addClass('tab-active');
			this.$title.text($(activeTab + '-tab a').text());

		}else{

			var $first = this.$tabs.eq(0).addClass('tab-active');
			var $a = $first.find('a');
			this.storage.save($a.attr('href'));
			this.$title.text($a.text());

		}


		/**
		 * Onclick handler for tabs
		 */
		this.$tabsContainer.on('click', 'li', $.proxy(function(e){
			e.preventDefault();
			this.switchTab($(e.currentTarget));
		}, this));


		/**
		 * Onhashchange handler
		 */
		$window.on('hashchange', $.proxy(function(e){
			var hash = window.location.hash;
			if(hash === '') return false;
			var $tab = this.$tabsContainer.find(hash + '-tab');
			this.switchTab($tab);
			window.location.hash = '';
		}, this));
	}



	/**
	 * Switches the tab
	 * @param  {jQuery} $tab
	 * @return {void}
	 */
	Tabs.prototype.switchTab = function($tab)
	{
		if($tab.hasClass('tab-active')) return false;

		var $a = $tab.find('a');

		$tab.siblings().removeClass('tab-active');
		$tab.addClass('tab-active').blur();

		var panel = $a.attr('href');

		this.storage.save($a.attr('href'));

		this.$panels.hide();

		this.$title.text($a.text());

		$(panel).fadeIn('fast');

		$(document).trigger('ait-tabs-switched', [panel]);
	}



	// export
	ait.admin.Tabs = Tabs;

})(jQuery, jQuery(window));

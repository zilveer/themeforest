/* ===========================================================
 * bootstrap-RPBModalManager.js v2.1
 * ===========================================================
 * Copyright 2012 Jordan Schroter.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */

!function ($) {

	"use strict"; // jshint ;_;

	/* MODAL MANAGER CLASS DEFINITION
	* ====================== */

	var RPBModalManager = function (element, options) {
		this.init(element, options);
	};

	RPBModalManager.prototype = {

		constructor: RPBModalManager,

		init: function (element, options) {
			this.$element = $(element);
			this.options = $.extend({}, $.fn.rpb_modalmanager.defaults, this.$element.data(), typeof options == 'object' && options);
			this.stack = [];
			this.backdropCount = 0;

			if (this.options.resize) {
				var resizeTimeout,
					that = this;

				$(window).on('resize.rpb_modal', function(){
					resizeTimeout && clearTimeout(resizeTimeout);
					resizeTimeout = setTimeout(function(){
						for (var i = 0; i < that.stack.length; i++){
							that.stack[i].isShown && that.stack[i].layout();
						}
					}, 10);
				});
			}
		},

		createModal: function (element, options) {
			$(element).rpb_modal($.extend({ manager: this }, options));
		},

		appendModal: function (rpb_modal) {
			this.stack.push(rpb_modal);

			var that = this;

			rpb_modal.$element.on('show.rpb_modalmanager', targetIsSelf(function (e) {

				var showModal = function(){
					rpb_modal.isShown = true;

					var transition = $.support.transition && rpb_modal.$element.hasClass('fade');

					that.$element
						.toggleClass('rpb_modal-open', that.hasOpenModal())
						.toggleClass('page-overflow', $(window).height() < that.$element.height());

					rpb_modal.$parent = rpb_modal.$element.parent();

					rpb_modal.$container = that.createContainer(rpb_modal);

					rpb_modal.$element.appendTo(rpb_modal.$container);

					that.backdrop(rpb_modal, function () {

						rpb_modal.$element.show();

						if (transition) {       
							//rpb_modal.$element[0].style.display = 'run-in';       
							rpb_modal.$element[0].offsetWidth;
							//rpb_modal.$element.one($.support.transition.end, function () { rpb_modal.$element[0].style.display = 'block' });  
						}
						
						rpb_modal.layout();

						rpb_modal.$element
							.addClass('in')
							.attr('aria-hidden', false);

						var complete = function () {
							that.setFocus();
							rpb_modal.$element.trigger('shown');
						};

						transition ?
							rpb_modal.$element.one($.support.transition.end, complete) :
							complete();
					});
				};

				rpb_modal.options.replace ?
					that.replace(showModal) :
					showModal();
			}));

			rpb_modal.$element.on('hidden.rpb_modalmanager', targetIsSelf(function (e) {

				that.backdrop(rpb_modal);

				if (rpb_modal.$backdrop){
					if($.support.transition && rpb_modal.$element.hasClass('fade')){
						rpb_modal.$backdrop.one($.support.transition.end, function () { 
							that.destroyModal(rpb_modal);
						rpb_modal.$element.trigger('rpb_modal:after_hidden');
						})
					}else{
						that.destroyModal(rpb_modal);
						rpb_modal.$element.trigger('rpb_modal:after_hidden');
					}
				} else {
					that.destroyModal(rpb_modal); 
					rpb_modal.$element.trigger('rpb_modal:after_hidden');
				}

			}));

			rpb_modal.$element.on('destroy.rpb_modalmanager', targetIsSelf(function (e) {
				that.removeModal(rpb_modal);
			}));

		},

		destroyModal: function (rpb_modal) {

			rpb_modal.destroy();

			var hasOpenModal = this.hasOpenModal();

			this.$element.toggleClass('rpb_modal-open', hasOpenModal);

			if (!hasOpenModal){
				this.$element.removeClass('page-overflow');
			}

			this.removeContainer(rpb_modal);

			this.setFocus();
		},

		hasOpenModal: function () {
			for (var i = 0; i < this.stack.length; i++){
				if (this.stack[i].isShown) return true;
			}

			return false;
		},

		setFocus: function () {
			var topModal;

			for (var i = 0; i < this.stack.length; i++){
				if (this.stack[i].isShown) topModal = this.stack[i];
			}

			if (!topModal) return;

			topModal.focus();

		},

		removeModal: function (rpb_modal) {
			rpb_modal.$element.off('.rpb_modalmanager');
			if (rpb_modal.$backdrop) this.removeBackdrop(rpb_modal);
			this.stack.splice(this.getIndexOfModal(rpb_modal), 1);
		},

		getModalAt: function (index) {
			return this.stack[index];
		},

		getIndexOfModal: function (rpb_modal) {
			for (var i = 0; i < this.stack.length; i++){
				if (rpb_modal === this.stack[i]) return i;
			}
		},

		replace: function (callback) {
			var topModal;

			for (var i = 0; i < this.stack.length; i++){
				if (this.stack[i].isShown) topModal = this.stack[i];
			}

			if (topModal) {
				this.$backdropHandle = topModal.$backdrop;
				topModal.$backdrop = null;

				callback && topModal.$element.one('hidden',
					targetIsSelf( $.proxy(callback, this) ));

				topModal.hide();
			} else if (callback) {
				callback();
			}
		},

		removeBackdrop: function (rpb_modal) {
			rpb_modal.$backdrop.remove();
			rpb_modal.$backdrop = null;
		},

		createBackdrop: function (animate) {
			var $backdrop;

			if (!this.$backdropHandle) {
				$backdrop = $('<div class="rpb_modal-backdrop ' + animate + '" />')
					.appendTo(this.$element);
			} else {
				$backdrop = this.$backdropHandle;
				$backdrop.off('.rpb_modalmanager');
				this.$backdropHandle = null;
				this.isLoading && this.removeSpinner();
			}

			return $backdrop;
		},

		removeContainer: function (rpb_modal) {
			rpb_modal.$container.remove();
			rpb_modal.$container = null;
		},

		createContainer: function (rpb_modal) {
			var $container;

			$container = $('<div class="rpb_modal-scrollable">')
				.css('z-index', getzIndex( 'rpb_modal',
					rpb_modal ? this.getIndexOfModal(rpb_modal) : this.stack.length ))
				.appendTo(this.$element);

			if (rpb_modal && rpb_modal.options.backdrop != 'static') {
				$container.on('click.rpb_modal', targetIsSelf(function (e) {
					rpb_modal.hide();
				}));
			} else if (rpb_modal) {
				$container.on('click.rpb_modal', targetIsSelf(function (e) {
					rpb_modal.attention();
				}));
			}

			return $container;

		},

		backdrop: function (rpb_modal, callback) {
			var animate = rpb_modal.$element.hasClass('fade') ? 'fade' : '',
				showBackdrop = rpb_modal.options.backdrop &&
					this.backdropCount < this.options.backdropLimit;

			if (rpb_modal.isShown && showBackdrop) {
				var doAnimate = $.support.transition && animate && !this.$backdropHandle;

				rpb_modal.$backdrop = this.createBackdrop(animate);

				rpb_modal.$backdrop.css('z-index', getzIndex( 'backdrop', this.getIndexOfModal(rpb_modal) ));

				if (doAnimate) rpb_modal.$backdrop[0].offsetWidth; // force reflow

				rpb_modal.$backdrop.addClass('in');

				this.backdropCount += 1;

				doAnimate ?
					rpb_modal.$backdrop.one($.support.transition.end, callback) :
					callback();

			} else if (!rpb_modal.isShown && rpb_modal.$backdrop) {
				rpb_modal.$backdrop.removeClass('in');

				this.backdropCount -= 1;

				var that = this;

				$.support.transition && rpb_modal.$element.hasClass('fade')?
					rpb_modal.$backdrop.one($.support.transition.end, function () { that.removeBackdrop(rpb_modal) }) :
					that.removeBackdrop(rpb_modal);

			} else if (callback) {
				callback();
			}
		},

		removeSpinner: function(){
			this.$spinner && this.$spinner.remove();
			this.$spinner = null;
			this.isLoading = false;
		},

		removeLoading: function () {
			this.$backdropHandle && this.$backdropHandle.remove();
			this.$backdropHandle = null;
			this.removeSpinner();
		},

		loading: function (callback) {
			callback = callback || function () { };

			this.$element
				.toggleClass('rpb_modal-open', !this.isLoading || this.hasOpenModal())
				.toggleClass('page-overflow', $(window).height() < this.$element.height());

			if (!this.isLoading) {

				this.$backdropHandle = this.createBackdrop('fade');

				this.$backdropHandle[0].offsetWidth; // force reflow

				this.$backdropHandle
					.css('z-index', getzIndex('backdrop', this.stack.length))
					.addClass('in');

				var $spinner = $(this.options.spinner)
					.css('z-index', getzIndex('rpb_modal', this.stack.length))
					.appendTo(this.$element)
					.addClass('in');

				this.$spinner = $(this.createContainer())
					.append($spinner)
					.on('click.rpb_modalmanager', $.proxy(this.loading, this));

				this.isLoading = true;

				$.support.transition ?
					this.$backdropHandle.one($.support.transition.end, callback) :
					callback();

			} else if (this.isLoading && this.$backdropHandle) {
				this.$backdropHandle.removeClass('in');

				var that = this;
				$.support.transition ?
					this.$backdropHandle.one($.support.transition.end, function () { that.removeLoading() }) :
					that.removeLoading();

			} else if (callback) {
				callback(this.isLoading);
			}
		}
	};

	/* PRIVATE METHODS
	* ======================= */

	// computes and caches the zindexes
	var getzIndex = (function () {
		var zIndexFactor,
			baseIndex = {};

		return function (type, pos) {

			if (typeof zIndexFactor === 'undefined'){
				var $baseModal = $('<div class="rpb_modal hide" />').appendTo('body'),
					$baseBackdrop = $('<div class="rpb_modal-backdrop hide" />').appendTo('body');

				baseIndex['rpb_modal'] = +$baseModal.css('z-index');
				baseIndex['backdrop'] = +$baseBackdrop.css('z-index');
				zIndexFactor = baseIndex['rpb_modal'] - baseIndex['backdrop'];

				$baseModal.remove();
				$baseBackdrop.remove();
				$baseBackdrop = $baseModal = null;
			}

			return baseIndex[type] + (zIndexFactor * pos);

		}
	}());

	// make sure the event target is the rpb_modal itself in order to prevent
	// other components such as tabsfrom triggering the rpb_modal manager.
	// if Boostsrap namespaced events, this would not be needed.
	function targetIsSelf(callback){
		return function (e) {
			if (this === e.target){
				return callback.apply(this, arguments);
			}
		}
	}


	/* MODAL MANAGER PLUGIN DEFINITION
	* ======================= */

	$.fn.rpb_modalmanager = function (option, args) {
		return this.each(function () {
			var $this = $(this),
				data = $this.data('rpb_modalmanager');

			if (!data) $this.data('rpb_modalmanager', (data = new RPBModalManager(this, option)));
			if (typeof option === 'string') data[option].apply(data, [].concat(args))
		})
	};

	$.fn.rpb_modalmanager.defaults = {
		backdropLimit: 999,
		resize: true,
		spinner: '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div>'
	};

	$.fn.rpb_modalmanager.Constructor = RPBModalManager

}(jQuery);

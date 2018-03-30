

/*
 jQuery pub/sub plugin by Peter Higgins (dante@dojotoolkit.org)
 Loosely based on Dojo publish/subscribe API, limited in scope. Rewritten blindly.
 Original is (c) Dojo Foundation 2004-2010. Released under either AFL or new BSD, see:
 http://dojofoundation.org/license for more information.
*/
;(function(d){var cache={};d.publish=function(topic,args){cache[topic]&&d.each(cache[topic],function(){this.apply(d,args||[])})};d.subscribe=function(topic,callback){if(!cache[topic]){cache[topic]=[]}cache[topic].push(callback);return[topic,callback]};d.unsubscribe=function(handle){var t=handle[0];cache[t]&&d.each(cache[t],function(idx){if(this==handle[1]){cache[t].splice(idx,1)}})}})(jQuery);


/**
 * Ait JS Lib
 */

var ait = ait || {};
ait.ajax = ait.ajax || {};

;(function($, undefined){

	"use strict";

	var _settings = typeof AitSettings === 'undefined' ? {} : AitSettings;


	// ================================
	// Ait JS Lib
	// --------------------------------

	ait = $.extend(ait, _settings, {


		/**
		 * Publish some data on a named topic.
		 * @param  {string} topic The channel to publish on
		 * @param  {Array?} args  The data to publish. Each array item is converted into an ordered arguments on the subscribed functions.
		 * @return {void}
		 */
		publish: function(topic, args) {
			$.publish(topic, args);
		},



		/**
		 * Register a callback on a named topic.
		 * @param  {string}   topic The channel to subscribe to
		 * @param  {Function} cb    The handler event. Anytime something is $.publish'ed on a subscribed channel, the callback will be called with the published array as ordered arguments.
		 * @return {Array}          A handle which can be used to unsubscribe this particular subscription.
		 */
		subscribe: function(topic, cb) {
			$.subscribe(topic, cb);
		}

	});



	// ================================
	// Ait JS Utils
	// --------------------------------

	ait.utils = $.extend(ait.utils || {}, {
		/**
		 * Helper getter for data-ait-* attributes
		 * @param  {jQuery} $el    jQuery object of the element which has data-ait-* attribute
		 * @param  {string} name   Rest of the name of data atribute
		 * @return {mixed}         Object or scalar
		 */
		getDataAttr: function($el, name){
			return $el.data('ait-' + name);
		},

		/**
		 * Helper setter for data-ait-* attributes
		 * @param {jQuery} $el    jQuery object of the element which has data-ait-* attribute
		 * @param {string} name   Rest of the name of data atribute
		 * @param {mixed}  data   Data to be set
		 * @return {void}
		 */
		setDataAttr: function($el, name, data){
			$el.attr('data-ait-' + name, JSON.stringify(data));
		}
	});



	// ================================
	// Ait Ajax Utils
	// --------------------------------

	ait.ajax = ait.ajax || {};

	/**
	 * Load data from the server using a HTTP POST or GET request.
	 * Same as $.post, $.get jQuery methods, but instead of URL in the first parameter
	 * it is used wp ajax action hook
	 */
	$.each(["get", "post"], function(i, method){
		ait.ajax[method] = function(action, data){
			var _action;
			var a = action.split(":");

			// ait.ajax.post("theme:getPosts", data)
			// ait.ajax.post("<controller>:<method>", data)
			if(a.length > 1 && (action in ait.ajax.actions)){
				_action = ait.ajax.actions[action];
			}else{
				_action = action;
			}

			if(typeof data === "object")
				data = $.param($.extend(data, {action: _action}));
			else if(typeof data === "string")
				data = $.param({action: _action}) + '&' + data;
			else
				data = $.param({action: _action});

			return $.ajax({
				url: ait.ajax.url,
				type: method,
				data: data
			});
		};
	});

})(jQuery);

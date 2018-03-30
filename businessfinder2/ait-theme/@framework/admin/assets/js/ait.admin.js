

/*
 jQuery pub/sub plugin by Peter Higgins (dante@dojotoolkit.org)
 Loosely based on Dojo publish/subscribe API, limited in scope. Rewritten blindly.
 Original is (c) Dojo Foundation 2004-2010. Released under either AFL or new BSD, see:
 http://dojofoundation.org/license for more information.
*/
;(function(d){var cache={};d.publish=function(topic,args){cache[topic]&&d.each(cache[topic],function(){this.apply(d,args||[])})};d.subscribe=function(topic,callback){if(!cache[topic]){cache[topic]=[]}cache[topic].push(callback);return[topic,callback]};d.unsubscribe=function(handle){var t=handle[0];cache[t]&&d.each(cache[t],function(idx){if(this==handle[1]){cache[t].splice(idx,1)}})}})(jQuery);



/*
 Douglas Crockford's Remedial JavaScript: a String.prototype.supplant function
 does variable substitution on the string
 http://javascript.crockford.com/remedial.html
*/
String.prototype.supplant = function(o){
	return this.replace(/{([^{}]*)}/g,
		function(a, b){
			var r = o[b];
			return (typeof r === 'string' || typeof r === 'number') ? r : a;
		}
	);
};



/*
 Avoid `console` errors in browsers that lack a console.
*/
(function(){
	var method;
	var noop = function () {};
	var methods = [
		'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
		'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
		'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
		'timeStamp', 'trace', 'warn'
	];
	var length = methods.length;
	var console = (window.console = window.console || {});

	while(length--){
		method = methods[length];

		// Only stub undefined methods.
		if(!console[method]){
			console[method] = noop;
		}
	}
}());



/**
 * Alias for console.log()
 */
window.dump = function(arguments){
	console.log(arguments);
}



/**
 * Ait Admin JS Lib
 */

var ait = ait || {};
ait.admin = ait.admin || {};
ait.admin.utils = ait.admin.utils || {};
ait.admin.ajax = ait.admin.ajax || {};

(function($, undefined){

	"use strict";

	var _settings = typeof AitAdminJsSettings === 'undefined' ? {} : AitAdminJsSettings;


	// ================================
	// Ait Admin JS Lib
	// --------------------------------

	ait.admin = $.extend(ait.admin, _settings, {

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
	// Ait Utils
	// --------------------------------

	ait.admin.utils = $.extend(ait.admin.utils, {
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

	ait.admin.ajax = ait.admin.ajax || {};

	/**
	 * Load data from the server using a HTTP POST or GET request.
	 * Same as $.post, $.get jQuery methods, but instead of URL in the first parameter
	 * it is used wp ajax action hook
	 */
	$.each(["get", "post"], function(i, method){
		ait.admin.ajax[method] = function(action, data, callback, type){

			var _action, _data = {};

			// ait.admin.ajax.post("getPosts")
			// ait.admin.ajax.post(<method>)
			if(action in ait.admin.ajax.actions){
				_action = ait.admin.ajax.actions[action];
			}else{
				_action = 'admin:' + action;
			}


			// shift arguments if data argument was omitted
			if($.isFunction(data)) {
				type = type || callback;
				callback = data;
				data = {action: _action};
			}else{
				if(Object.prototype.toString.call(data) === "[object FormData]"){
					// just take it from argument
				}else if(typeof data === "object"){
					_data = $.extend(data, {action: _action});
					if('nonce' in data)
						_data['_ajax_nonce'] = data.nonce;
					delete data.nonce;
					data = $.param(_data);
				}else{
					data = $.param({action: _action}) + '&' + data;
				}
			}

			return $.ajax({
				url: ait.admin.ajax.url,
				type: method,
				dataType: type,
				data: data,
				success: callback
			});
		};
	});



	// ================================
	// Storage
	// --------------------------------

	ait.admin.Storage = function(key, defaults)
	{
		if(typeof key === "undefined") key = '';
		if(typeof defaults === "undefined") defaults = '';

		this.key = key;
		this.defaults = defaults;
		this.data = {};

		try{
			this.hasSupport = ('localStorage' in window && window['localStorage'] !== null);
		}catch(e){
			this.hasSupport = false;
		}
	};

	ait.admin.Storage.prototype.setKey = function(key){
		this.key = key;
	};

	ait.admin.Storage.prototype.setDefaults = function(defaults){
		this.defaults = defaults;
	};

	ait.admin.Storage.prototype.load = function(what)
	{
		if(this.hasSupport){
			var s = localStorage.getItem(this.key);

			if(s !== null){
				try{
					this.data = JSON.parse(s);
					this.data = _.defaults(this.data, this.defaults);
				}catch(e){
					this.data = s;
				}

				if(typeof what !== "undefined" && (typeof this.data === "object"))
					return this.data[what];
				else
					return this.data;
			}else{
				return this.defaults;
			}
		}
		return null;
	};

	ait.admin.Storage.prototype.save = function(data)
	{
		if(this.hasSupport){
			if(typeof data === "string"){
				localStorage.setItem(this.key, data);
			}else if(typeof data === "object"){
				data = _.defaults(data, this.defaults);
				localStorage.setItem(this.key, JSON.stringify(data));
			}
			return data;
		}
		return null;
	};

})(jQuery);

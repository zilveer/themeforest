(function($) {
	'use strict';

	// Use for dependency management for admin panel.
	// Heavily based on attrchange plugin which helped not rolling back to legacy code 
	// for triggering change event whenever val() was updated
 
 	var Dependency = function(el) {
 		this.el = el;
 	};

 	Dependency.prototype = {
 		init: function init() {
 			this.cacheElements();
 			this.bindEvents();
 		},

 		cacheElements: function cacheElements() {
 			this.$child = $(this.el);
 			this.vals = this.$child.data('dependency-value');

 			var motherName = this.$child.data('dependency-mother');
 			this.$mother = $('#' + motherName);
 		},

 		bindEvents: function bindEvents() {
 			var self = this;
 			
 			// For handling user input
 			this.$mother.on('change', this.resolveDependency.bind(this));
 			
 			// For handling programmatic val() updates
 			this.$mother.attrchange({
 				callback: self.resolveDependency.bind(self)
 			});

 			// Wait a little after load and hide what is not needed
 			$(window).on('load', function() {
 				setTimeout( self.resolveDependency.bind(self), 100);
 			});
 		},

 		resolveDependency: function resolveDependency() {
 			var val = this.$mother.val();

 			if ( this.hasValue(val) ) this.show();
 			else this.hide();
 		},

 		hasValue: function hasValue(val) {
 			return this.vals.indexOf(val) !== -1;
 		},

 		show: function show() {
 			this.$child.show();
 		},

 		hide: function hide() {
 			this.$child.hide();
 		},
 	};


 	var $dependencyChildren = $('[data-dependency-mother]');

	$dependencyChildren.each( function() {
		var dep = new Dependency( this );
		dep.init();
	});

}( jQuery ));
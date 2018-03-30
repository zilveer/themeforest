(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	function addID(v) {
		return ".group_"+v;
	}
	
	function module() {}
	
	$.pixelentity.peFieldLayout.addModule("Container",module,{
		config: function() {
			this.container = true;
			this.allowed = this.conf.allowed ? [this.conf.allowed] : [];
			this.sortable = this.conf.allowed || "block";
		},
		template: function(target) {
			this.target = target;
			this.items = target.find("ul.pe_block_container:first");
			return target;
		},
		init: function(data,isNew) {
			if (isNew && this.conf.create) {
				this.first = this.master.addBlock(this.conf.create,this.items);
			}
		},
		add: function() {
			if (this.conf.force) {
				return this.master.addBlock(this.conf.force,this.items,"append",true);
			}
			return false;
		},
		title: function() {
			// no title for containers
		},
		filter: function() {
			return this.allowed.length > 0 ? this.allowed.map(addID).join(",") : false;
		}
	});
	
}(window.jqpe35 || jQuery));
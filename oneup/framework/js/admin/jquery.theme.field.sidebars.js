
(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,JSON */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldSidebars = {	
		conf: {
			api: false
		} 
	};
	
	var template = '<tr class="col-heading">\
        <td class="col-title" colspan="3">%0<input name="%1[]" type="hidden" value="%2"></td>\
        <td class="col-edit">\
        EXTRA_BUTTONS<a href="#" class="delete-inline">Delete</a>\
    </td>\
    </tr>';
	
	// Return a helper with preserved width of cells
	function fixHelper(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone().height(36).width(tr.outerWidth());
		
		$helper.children().each(function(index) {
			// Set helper cell sizes to match the original sizes
			$(this).width($originals.eq(index).width());
		});
		return $helper;
	}
	
	
	function PeFieldSidebars(target, conf) {
		
		var id = target.attr("data-id");
		var name = target.attr("data-name");
		var unique = target.attr("data-unique") === "yes";
		var title = target.find("input[type=text],select");
		var isSelect = title[0].tagName.toLowerCase() == "select";
		var button = target.find("input[type=button]");
		var tbody = target.find("tbody");
		var table = target.find("table");
		var sidebars = {};
		var total = 0;
		var customTemplate;
		var auto = false;
				
		// init function
		function start() {
			button.click(add);
			target.find("input[type=hidden]").each(get);
			
			customTemplate = template.replace(/EXTRA_BUTTONS/,tbody.hasClass("ui-editable") ? '<a href="#" class="edit-inline">Edit</a>' : "");
			
			if (target.hasClass("pe_auto_values")) {
				auto = target.attr("data-auto");
			}
			
			var data = tbody.attr("data-items");
			
			if (data) {
				setData(JSON.parse(data));
			} else {
				table.hide();
			}
			target.delegate("a.delete-inline","click",remove);
		}
		
		function setData(data) {
			var i = 0;
			tbody.empty();
			table.hide();
			total = 0;
			sidebars = {};
			if (typeof data === "object") {
				for (i = 0;i<data.length;i++) {
					addValue(data[i]);
				}
			}
		}

		
		function makeSortable() {
			if (tbody.hasClass("ui-sortable") && !tbody.data("madeSortable")) {
				tbody.sortable({
					//forcePlaceholderSize: true, 
					axis:"y",
					tolerance: "pointer",
					items: '> tr',
					cursor: 'move',
					handle: 'td.col-title',
					distance: 0,
					//opacity: 0.9,
					containment: 'parent',
					placeholder: "col-heading ui-state-highlight",
					helper: fixHelper,
					dropOnEmtpy:true
				});
				tbody.disableSelection();
				tbody.data("madeSortable",true);
			}
		}

		
		function count() {
			var c = 0;
			if (sidebars) {
				var name;
				for (name in sidebars) {
					if (typeof name === "string") {
						c++;
					}
				}
			}
			return c;
		}

		
		function add() {
			var value;
			if (auto) {
				value = auto+(count()+1);
			} else if (isSelect) {
				value = title.val();
			} else {
				value = title.val().replace(/["<>\\'\n\r\t&]/g,"");
				title.val("");
			}
			
			if (addValue(value)) {
				target.triggerHandler("add.pixelentity",{"value":value});
			}
			return false;
		}

		
		function addValue(value) {
			
			if (!value || value === "" || (unique && sidebars[value])) {
				return false;
			}
			
			var label;
			
			if (isSelect) {
				label = title.find("option[value='%0']".format(value)).text();
				if (!label) return false;
			} else {
				label = value;
			}
			
			tbody.append(customTemplate.format(label,name,value));
			sidebars[value] = true;
			total++;
			
			if (total === 1) {
				table.show();
				makeSortable();
			}
			
			return true;
		}
		
		function get(idx,el) {
			sidebars[(el.getAttribute("value"))] = true;
			total++;
		}
		
		function remove(e) {
			var tr = target.find(e.target).parents("tr");
			//var value = tr.find(".col-title").text();
			var value = tr.find("input:eq(0)").val();
			sidebars[value] = false;
			tr.remove();
			total--;
			if (total === 0) {
				table.hide();
			}
			target.triggerHandler("delete.pixelentity",{"value":value});
			return false;
		}
		
		$.extend(this, {
			// plublic API
			setData: setData,
			destroy: function() {
				target.data("peFieldSidebars", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peFieldSidebars = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldSidebars");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldSidebars.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldSidebars(el, conf);
			el.data("peFieldSidebars", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));
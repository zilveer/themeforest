
(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,JSON */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldItems = {	
		conf: {
			api: false
		} 
	};
	
	var replaceID = /\[\d+\]/;
	
	function PeFieldItems(target, conf) {
		
		var fid = target.attr("data-id");
		var name = target.attr("data-name");
		var unique = target.attr("data-unique") === "yes";
		var title = target.find("input[type=text],select");
		var isSelect = title[0].tagName.toLowerCase() == "select";
		var button = target.find("input[type=button]");
		var table = target.find("div.pe_field_items_data");
		var tbody = table.find("> div");
		var fields = JSON.parse(tbody.attr("data-fields"));
		var sidebars = {};
		var total = 0;
		var uniqID = 0;
		var customTemplate;
		var auto = false;
		var legend;
		
				
		// init function
		function start() {
			button.click(add);
			target.find("input[type=hidden]").each(get);
			
			customTemplate = '<div class="pe_fields_item_item" data-id="%0">%1<div class="pe_field_buttons">';
			
			if (tbody.hasClass("ui-editable")) {
				customTemplate += '<a href="#" class="edit-inline">Edit</a>';
			}
			
			customTemplate += '<a href="#" class="delete-inline">Delete</a></div></div>';
			
			if (target.attr("data-legend") == "yes") {
				var i,field,buffer = '<div class="pe_field_items_legend">';
				for (i = 0;i<fields.length;i++) {
					field = fields[i];
					if (field.type != "hidden") {
						buffer += '<div style="width:%1px">%0</div>'.format(field.label ? field.label : field.name,field.width);
					}
				}
				buffer += "</div>";
				legend = $(buffer);
				table.before(legend);
				//tbody.append(customTemplate.format(uniqID,buffer));
			}
			
			
			
			if (target.hasClass("pe_auto_values")) {
				auto = target.attr("data-auto");
			}
			
			var data = tbody.attr("data-items");
			
			if (data) {
				setData(JSON.parse(data));
			} else {
				table.hide();
				if (legend) {
					legend.hide();
				}
			}
			target.delegate("a.delete-inline","click",remove);
		}
		
		function setData(data) {
			if (Object.prototype.toString.call(data).toLowerCase() == "[object object]") {
				// fix data;
				var p,fixed = [];
				for (p in data) {
					fixed.push(data[p]);
				}
				data = fixed;
			}
			var i = 0;
			tbody.empty();
			table.hide();
			if (legend) {
				legend.hide();
			}
			uniqID = total = 0;
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
					items: '> div',
					cursor: 'move',
					distance: 0,
					scroll: true,
					//opacity: 0.9,
					containment: 'parent',
					cancel: "a,input,button,select,textarea,.pe-embedded-icon-control",
					placeholder: "pe_fields_item_item ui-state-highlight",
					forcePlaceholderSize: true,
					forceHelperSize: true,
					dropOnEmtpy:true,
					stop: fixIds
				}).css("overflow:auto");
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
				if (auto.indexOf("%") !== false) {
					value = auto.replace(/%/,(uniqID+1));
				} else {
					value = auto;
				}
			} else if (isSelect) {
				value = title.val();
			} else {
				value = title.val().replace(/["<>\\'\n\r\t?&]/g,"");
				title.val("");
			}
			
			var el;
			
			if ((el = addValue(value))) {
				target.triggerHandler("add.pixelentity",{"value":value,"el":el});
			}
			return false;
		}
		
		function fixId(idx) {
			var i,el,els = tbody.find(this).find("input, select, textarea");
			for (i=0;i<els.length;i++) {
				el = tbody.find(els[i]);
				el.attr("name",el.attr("name").replace(replaceID,"[%0]".format(idx)));
			}
			if (idx === (total - 1)) {
				target.triggerHandler("sorted.pixelentity");
			}
		
		}
		
		function fixIds() {
			tbody.find("> div").each(fixId);
		}
		
		function addValue(value) {
			
			if (typeof value === "undefined" || (unique && sidebars[value])) {
				return false;
			}
			
			var label;
			
			var i,id,field,fieldTemplate,fval,buffer = "";
			var firstfield = true;
			var upfields = [];
			var edfields = [];
			var iconfields = [];
			
			for (i = 0;i<fields.length;i++) {
				field = fields[i];
				id = "%0_%1_%2".format(fid,field.name,uniqID);
				if (firstfield && field.type != "empty" && typeof value != "object") {
					
					if (isSelect) {
						label = title.find("option[value='%0']".format(value)).text();
						if (!label) return false;
					} else {
						label = value;
					}
					
					fval = value;
					firstfield = false;
				} else {
					fval = (typeof value[field.name] === "undefined") ? field["default"] : value[field.name];
				}
				
				if (typeof fval != "undefined") {
					fval = fval.replace(/"/gi,'&quot;');
				}

				switch (field.type) {
				case "empty":
					fieldTemplate = '<div %0>&nbsp;</div>'.format(field.width ? 'style="width:%0px"'.format(field.width) : "");
					break;
				case "text":
					fieldTemplate = '<div><input id="pe_fields_item_field_%0" name="%1[%5][%2]" data-name="%2" type="text" value="%3" %4></div>'.format(
						id,
						name,
						field.name,
						fval,
						field.width ? 'style="width:%0px"'.format(field.width) : "",
						uniqID
					);
					break;
				case "select":
					
					var k,v,options = '';
					
					for (k in field.options) {
						v = field.options[k];
						options += '<option value="%1"%2>%0</option>'.format(k,v,v == fval ? " selected" : "");
					}
					fieldTemplate = '<div><select id="pe_fields_item_field_%0" name="%1[%5][%2]" data-name="%2" type="text" value="%3" %4>%6</select></div>'.format(
						id,
						name,
						field.name,
						fval,
						field.width ? 'style="width:%0px !important"'.format(field.width) : "",
						uniqID,
						options
					);
					break;
				case "textimg":
					fieldTemplate = '<div><input id="pe_fields_item_field_%0" name="%1[%5][%2]" data-name="%2" type="text" value="%3" %4><a class="add-inline" title="Add Image" href=""></a></div>'.format(
						id,
						name,
						field.name,
						fval,
						field.width ? 'style="float:left;width:%0px"'.format(field.width-20) : "",
						uniqID
					);
					upfields.push("pe_fields_item_field_%0".format(id));
					break;
				case "icon":
					fieldTemplate ='<div class="pe-embedded-icon-control"><i class="icon-bookmarks"></i><input id="pe_fields_item_field_%0" type="hidden" name="%1[%5][%2]" data-name="%2" value="%3" data-icons2="[ICONS]" /></div>'.format(
					
					//fieldTemplate = '<div><input id="pe_fields_item_field_%0" name="%1[%5][%2]" data-name="%2" type="text" value="%3" %4><a class="add-inline" title="Add Image" href=""></a></div>'.format(
						id,
						name,
						field.name,
						fval,
						field.width ? 'style="float:left;width:%0px"'.format(field.width-20) : "",
						uniqID
					);
					iconfields.push("pe_fields_item_field_%0".format(id));
					break;
				case "textarea":
					fieldTemplate = '<div class="element"><textarea id="pe_fields_item_field_%0" name="%1[%5][%2]" data-name="%2" type="text" %4>%3</textarea></div>'.format(
						id,
						name,
						field.name,
						fval,
						field.width ? 'style="float:left;width:%0px;height:%1px !important"'.format(field.width-20,field.height || 100) : "",
						uniqID
					);
					break;
				case "editor":
					fieldTemplate = '<div><textarea id="pe_fields_item_field_%0" name="%1[%5][%2]" data-name="%2" type="text" %4>%3</textarea><a class="edit-inline" title="Add Image" href=""></a></div>'.format(
						id,
						name,
						field.name,
						fval,
						field.width ? 'style="float:left;width:%0px"'.format(field.width-20) : "",
						uniqID
					);
					edfields.push("pe_fields_item_field_%0".format(id));
					break;
				default:
					fieldTemplate = '<input name="%1[%5][%2]" type="hidden" data-name="%2" value="%3">'.format(
						id,
						name,
						field.name,
						fval,field.width ? 'style="width:%0px"'.format(field.width) : "",
						uniqID
					);
				}
				buffer += fieldTemplate;
			}
			var newEl = $(customTemplate.format(uniqID,buffer));
			tbody.append(newEl);
			for (i=0;i<upfields.length;i++) {
				jQuery("#%0".format(upfields[i])).peFieldUpload({markup:true,text:'Set Layer Image'});
			}
			for (i=0;i<iconfields.length;i++) {
				jQuery("#%0".format(iconfields[i])).peFieldIcon({markup:true,text:'Set Layer Image'});
			}
			for (i=0;i<edfields.length;i++) {
				var tid = "#%0".format(edfields[i]);
				jQuery(tid).next("a")
				.click(
					function () {
						window.peThemeCustomEditor && window.peThemeCustomEditor.show(tid.replace("#",""));
						return false;
					}
				);
				
			}
				
			sidebars[value] = true;
			total++;
			uniqID++;
			
			if (total === 1) {
				table.show();
				if (legend) {
					legend.show();
				}
				makeSortable();
			}
			
			return newEl;
		}
		
		function get(idx,el) {
			sidebars[(el.getAttribute("value"))] = true;
			uniqID++;
			total++;
		}
		
		function remove(e) {
			var tr = target.find(e.target).parents("div.pe_fields_item_item");
			//var value = tr.find(".col-title").text();
			var value = tr.find("input:eq(0)").val();
			sidebars[value] = false;
			tr.remove();
			total--;
			if (total === 0) {
				uniqID = 0;
				table.hide();
				if (legend) {
					legend.hide();
				}
			}
			fixIds();
			target.triggerHandler("delete.pixelentity",{"value":value,el:tr});
			return false;
		}
		
		$.extend(this, {
			// plublic API
			setData: setData,
			destroy: function() {
				target.data("peFieldItems", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peFieldItems = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldItems");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldItems.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldItems(el, conf);
			el.data("peFieldItems", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));
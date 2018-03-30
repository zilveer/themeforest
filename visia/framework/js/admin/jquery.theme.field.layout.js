(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,JSON */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldLayout = {	
		conf: {
			api: false
		},
		modules: {},
		addModule: function(name,module,proto) {
			var m = $.pixelentity.peFieldLayout.modules; 
			if (name === "Standard") {
				m.Standard = module;
			} else {
				$.extend(
					module.prototype,
					m.Standard.prototype,
					proto
				);
				
				m[name] = module;
			}
		}
	};
	
	function s2o(s,v,computed) {
		
		function step(tokens,v,computed) {
			
			if (!tokens || tokens.length === 0) {
				return v;
			}
			
			var el = tokens.shift();
			var key = el.replace("]","");
			
			if (!el) {
				return step(tokens,v,computed);
			}
			
			var intv = parseInt(key,10);
			
			if (isNaN(intv)) {
				// object
				computed = computed || {};
				computed[key] = step(tokens,v,computed[key]);
			} else {
				computed = computed || [];
				computed[intv] = step(tokens,v,computed[intv]);
			}
			
			return computed;
		}
		
		return step(s.split('['),v,computed);		
	}
	
	var modules = $.pixelentity.peFieldLayout.modules;
	var headTemplate = '<div class="head"><i class="drag"></i><h3><span class="title">%0</span><span class="type">%1</span><i class="collapse"></i></h3><i class="delete"></i></div>';
	var bodyTemplate = '<div class="config"></div>';
	var itemTemplate = '<li class="pe_block"><input name="type" type="hidden" value="%0" /><input name="status" type="hidden" value="" /><input name="bid" type="hidden" value="%3" /><div>%1%2</div></li>';
	
	
	function PeFieldLayout(target, conf) {
		
		var sortablesID = 0;
		var buttons;
		var blockID = 0;
		var chooser;
		var layout;
		var current;
		var lastplus;
		var animating = false;
		var checked;
		
		function makeSortable(t,group) {
			sortablesID++;
			
			var list = t.find("ul.pe_block_container");
			list.attr("id","%0_sortable_%1".format(target.attr("id"),sortablesID));
			list.data("group",group);
			
			list.sortable({
				axis:"y",
				//handle: "i.drag",
				handle: "div.head",
				delay: 50,
				tolerance: "pointer",
				items: '> li.pe_block:not(.pe_disabled)',
				//items: '> li.pe_block:not(.has_items)',
				cursor: 'move',
				distance: 0,
				scroll: true,
				//helper: 'clone',
				helper: sortableClone,
				appendTo: "#"+target.attr("id")+' .pe_layout_builder .pe_block_container',
				containment: '#'+target.attr("id"),
				cancel: "a,input,button,select,textarea",
				placeholder: "pe_block ui-state-highlight",
				forcePlaceholderSize: true,
				forceHelperSize: false,
				toleranceElement: '> div',
				disableSelection: true,
				dropOnEmtpy:true,
				zIndex: 9999
				//connectWith:"#list1,#list2,#list3",
			}).css("overflow:auto");
			
			linkSortables();
		}
		
		function linkSortables() {
			
			var sortables = [],list = target.find("ul.pe_block_container");
			var i = 0,s,groups = {},g,id;
			
			// create groups (ids list)
			for (i=0;i<list.length;i++) {
				sortables.push(s = list.filter(list[i]));
				g = s.data("group");
				id = "#"+s.attr("id");
				groups[g] = (typeof groups[g] == 'undefined') ? id : (groups[g] + "," + id);
			}
			
			// link sortables
			for (i=0;i<sortables.length;i++) {
				s = sortables[i];
				s.sortable( "option", "connectWith",groups[s.data("group")]);
			}
		}
		
		function toggleCollapse(e) {
			var el = target.find(e.currentTarget).closest("li.pe_block"); 
			var state = el.hasClass("collapsed") ? "open" : "collapsed";
			el.find('input[name="status"]:first').val(state);
			
			if (state === "collapsed") {
				el.addClass("collapsed");
				el.data("controller").title();
			} else {
				el.removeClass("collapsed");
				el.data("controller").focus();
			}
			
		}
		
		function cloneBlockHandler(e) {
			var el = target.find(e.currentTarget).closest("li.pe_block");
			var cl = el.clone();
			cl.detach();
			
			// clone doesn't preserve textarea content
			var to = el.find("textarea");
			var tc = cl.find("textarea");
			var i;
			
			for(i=0;i<to.length;i++) {
				tc.eq(i).val(to.eq(i).val());
			}
				
			var inputs = save(cl).inputs;
			var data,input;
			
			while ((input = inputs.shift())) {
				data = s2o(input.name.replace('data[0][data]',''),input.value,data);
			}
			 
			addBlock({
				//status: "collapsed",
				type: el.find("> input[name=type]").val(),
				data: data
			},el,"after");
			el.find(".head h3").trigger("click");

			
			return false;
		}
		
		function deleteBlock(e) {			
			var el = target.find(e.currentTarget).closest("li.pe_block");
			
			el.find("> div > .config > ul.pe_block_container > li .head i.delete").trigger("click");
			el.data("controller").remove();
			el.data("controller","");
			el.remove();
			return false;
		}
		
		function clearCSSAnimation() {
			this.css("opacity",1).removeClass("pe_hilight");
			this.data("controller").focus();
			animating = false;
		}
		
		function addBlock(type,where,fun,animate) {
			var items = false,data = false,status,isNew = true;
			
			fun = fun ? fun : "append";
			
			var bid = false;
			
			if (typeof type !== "string") {
				items = type.items;
				data = type.data;
				status = type.status;
				bid = type.bid;
				type = type.type;
				isNew = false;
			}
			
			if (bid) {
				bid = parseInt(bid,10);
				blockID = Math.max(bid,blockID);
			} else {
				bid = ++blockID;
			}
			
			var conf = window['pe_theme_layout_module_%0'.format(type)];
			if (!conf) {
				// if no configuration present it means this layout module class is no longer included in theme
				return;
			}
			//var cls = (modules[type]) ? type : "Standard";
			var module = new modules[conf.jsclass](self,conf); 
			module.id = bid;
			
			if (module.setup) {
				module.setup(self,conf);
			}
			
			var template = $(itemTemplate.format(
					type,
					headTemplate.format(conf.messages.title,conf.messages.type),
					bodyTemplate,
					bid
				));
			
			template.data("controller",module);
			
			var body = template.find("div.config");
			var wrapper = $('<div class="pe_block_settings"></div>');
						
			var field,i;
			
			for (i=0;i<conf.fields.length;i++) {
				field = conf.templates[conf.fields[i]];
				//body.append(getItemField(field,module.id));
				wrapper.append(getItemField(field,module.id));
			}
			
			if (conf.fields.length > 0) {
				wrapper.append('<div class="pe_handle"></div>');
				if (!data) {
					wrapper.addClass("pe_active");
				}
				body.append(wrapper);
			}
			
			if (module.container) {
				template.addClass("has_items");
				body.append('<ul class="pe_block_container"></ul>');
				body.append('<div class="pe_block_plus"></div>');
			} else {
				body.append('<div class="pe_block_clone"></div>');
			}
			
			template = module.template ? module.template(template) : template; 
			where[fun](template);
			
			populate(module,data);
			
			if (module.container) {
				makeSortable(template,module.sortable);
			}
			
			if (module.init) {
				module.init(data,isNew);
			}
		
			$.pixelentity.tooltip(template);
			
			if (status == "collapsed") {
				template.addClass("collapsed");
			}
			
			template.find('input[name="status"]:first').val(status == "collapsed" ? "collapsed" : "open");
			
			if (!animating && (animate || fun != "append" || chooser.parent().length > 0)) {
				animating = true;
				template.css("opacity",0);
				setTimeout(function () {
					fadeIn(template);
				},20);
			}
			
			if (items) {
				for(i=0;i<items.length;i++) {
					addBlock(items[i],module.target.find("ul.pe_block_container:eq(0)"));
				}
			}
			
			return module;
		}
		
		function fadeIn(template) {
			template.peScrollVisible(true);
			template.addClass("pe_hilight");
			template.one('oanimationend animationend webkitAnimationEnd', $.proxy(clearCSSAnimation,template));
		}

		
		function toggleChooser() {
			var active = false;
			var main = current.is(buttons.prev());
			
			if (lastplus) {
				lastplus.removeClass("pe_close");
			}
			
			if (current.is(chooser.parent())) {
				chooser.detach();
			} else {
				active = true;
				current.append(chooser);
				var filter,module = current.closest(".pe_block").data("controller");
				var all = chooser.removeClass("pe_filter").find("> div > div").removeClass("pe_active");
				
				if (module && module.container && (filter = module.filter())) {
					chooser.addClass("pe_filter");
					all.filter(filter).addClass("pe_active");
				}
				current.next().peScrollVisible(true);
			}
			
			if (active && !main) {
				lastplus = current.next().addClass("pe_close");
			}
			
			var btn = buttons.find(".addblock");
			btn.val(main && active ? btn.attr("data-cancel") : btn.attr("data-add"));
			
			//chooser.toggleClass("pe_active");
		}

		
		function addBlockHandler(e) {
			
			var btn = target.find(e.currentTarget);
			current = btn.prev();
			current = current.is("ul") ? current : btn.parent().prev();
			
			var module = current.closest(".pe_block").data("controller");
			
			if (!module || !module.add || !module.add()) {
				toggleChooser();
			}
			
			/*
			if (module && module.add && module.add()) {
				module.add();
			} else {
			 toggleChooser();
			}
			*/
			
			return false;
		}
		
		function modulesHandler(e) {
			var m = addBlock(e.currentTarget.id.replace("pe_module_",""),current);
			toggleChooser();
			if (m) {
				m.focus();
			}
			//console.log(m.target);
		}
		
		function sortableClone(e,el) {
			var input,inputs = el.find('input[type=radio],input[type=checkbox]');
			var cl = el.clone();
			checked = [];
			inputs.each(function (i) {
				input = inputs.eq(i);
				if (input.is(":checked")) {
					checked.push("#%0".format(input.attr("id")));
					//console.log("here");
					//console.log(cl.find("#%0".format(input.attr("id"))).is(":checked"));
				}
			});
			return cl;
		}

		
		function sortStart(e,ui) {
			var i = ui.item.find('input[type=radio]');
			var h = ui.helper.addClass("collapsed").height("auto").width(target.width()-2).height();
			ui.placeholder.addClass("collapsed").height(h);
		}
		
		function sortOver(e,ui) {
			ui.placeholder.parent().addClass("sorting").find("> li:not(.has_items)").addClass("collapsed");
		}
		
		function sortStop(e,ui) {
			ui.item.find(checked.join(",")).prop("checked",true);
			target.find("ul.sorting").removeClass("sorting");
		}
		
		function editor() {
			var textarea  = target.find(this).next("textarea");
			window.peThemeCustomEditor.show(textarea.attr("id"));
			return false;
		}
		
		function getFields(t) {
			var f = "input,textarea,select";
			var fields = t.find("> div > .config").children().not("ul");
			fields = fields.filter(f).add(fields.find(f));
			// remove button fields
			fields = fields.not("[type='button']");
			// only fields with "name" set
			fields = fields.filter("[name]");
			//console.log(fields);
			return fields;
		}
		
		function save(t,prefix,index) {
			var inputs = false;
			var i,f,name,fidx;
			
			prefix = prefix || "data";
			index = index || 0;
			console.log(index);
			
			if (!t.is("ul")) {
				prefix = prefix+"[%0]".format(index);
				var fields = getFields(t);
				
				if (fields.length > 0) {
					//inputs = {};
					inputs = [];
					for (i=0;i<fields.length;i++) {
						f = fields.filter(fields[i]);
						name = f.attr("name").replace(/instance_\d+_/,"");
						//if ((fidx = name.match(/\[\d*\]/))) {
						if ((fidx = name.match(/\[.*\]/))) {
							fidx = fidx[0];
							name = name.replace(fidx,"");
						} else {
							fidx = "";
						}
						//inputs[name] = f.val();
						//f.attr("name",'%0[data][%1]%2'.format(prefix,name,fidx.replace(/\d+/,"")));
						f.attr("name",'%0[data][%1]%2'.format(prefix,name,fidx.replace(/\[\d+\]$/,"[]")));
						inputs.push({
							name: f.attr("name"),
							value: f.val()
						});
						//console.log(name,f.attr("name"));
					}
				}
				
				
			}
			
			var data = {
					inputs: inputs
				};
			
			if (t.is("li")) {
				var type = t.find("> input[name='type']");
				data.type = type.val();
				type.attr("name",'%0[type]'.format(prefix));
				var status = t.find("> input[name='status']");
				data.status = status.val();
				status.attr("name",'%0[status]'.format(prefix));
				var bid = t.find("> input[name='bid']");
				data.bid = bid.val();
				bid.attr("name",'%0[bid]'.format(prefix));
			}
			
			var isUL = t.is("ul");
			
			if (isUL || t.hasClass("has_items")) {
				
				var items = [],c,childs = isUL ? t.find("> li") : t.find("> div > .config > ul.pe_block_container > li");
				
				for(i = 0;i<childs.length;i++) {
					items.push(save(target.find(childs[i]),'%0[items]'.format(prefix),i));
				}
				
				if (items.length > 0) {
					data.items = items;
				}
			}
			
			 
			return data;
		}
		
		function load() {
			var data = target.attr("data-blocks");
			if (data) {
				data = JSON.parse(data);
				var items = data.items;
				if (items) {
					var i;
					for (i=0;i<items.length;i++) {
						addBlock(items[i],target.find(".pe_layout_builder > ul.pe_block_container"));
					}
					
				}
			}
		}
		
		function publish() {
			chooser.detach();
			try {
				save(target.find(".pe_layout_builder > ul"),target.attr("data-prefix"),0);
			} catch (x) {
				
			}
			//return false;
		}
		
		function showSettings(e) {
			target.find(e.currentTarget).parent().toggleClass("pe_active");
		}
		
		function hideSettings(e) {
			target.find(e.currentTarget).parent().find("> div.pe_block_settings").removeClass("pe_active");
		}
		
		// init function
		function start() {
			//searchSortable(target);
			makeSortable(target,"block");
			buttons = target.find("div.buttons");
			chooser = target.find(".pe_layout_modules").detach();
			layout = target.find(".pe_layout_builder > .pe_block_container");
			
			target.on("click",".buttons input.addblock, .pe_block.has_items div.pe_block_plus",addBlockHandler);
			target.on("click",".pe_block div.pe_block_clone",cloneBlockHandler);
			target.on("click",".pe_block .head h3",toggleCollapse);
			target.on("click",".pe_block .head i.delete",deleteBlock);
			target.on("click","a.editor",editor);
			target.on("sortstart","ul.pe_block_container",sortStart);
			target.on("sortover","ul.pe_block_container",sortOver);
			target.on("sortstop","ul.pe_block_container",sortStop);
			target.on("click",".config > div.pe_block_settings > div.pe_handle",showSettings);
			target.on("click",".pe_layout_builder .pe_layout_modules > div > div.pe_module",modulesHandler);
			$("#publish").click(publish);
			load();
			//publish();
			
			// testing
			/*
			buttons.find("select").val("tabs");
			buttons.find(".addblock").trigger("click");
			buttons.find("select").val("content");
			buttons.find(".addblock").trigger("click");
			*/
			//
		}
		
		function populate(block,data) {
			
			var i = 0,fidx,field,name,fields;
			
			if (data) {
				fields = getFields(block.target);
				for (;i<fields.length;i++) {
					field = fields.filter(fields[i]);
					name = field.attr("name").replace(/instance_\d+_/,"");
					if (typeof data[name] === "undefined") {
						continue;
					}
					if ((fidx = name.match(/\[\d*\]/))) {
						fidx = fidx[0];
						name = name.replace(fidx,"");
					} else {
						fidx = "";
					}
					
					if (field.is(":checkbox") || field.is(":radio")) {
						if (typeof data[name] === "object") {
							field.prop("checked",$.inArray(field.val(),data[name]) != -1);
						} else {
							field.prop("checked",field.val() == data[name]);
						}
						//console.log("here",field.val(),data[name],$.inArray(field.val(),data[name]));
					} else {
						field.val(data[name]);
					}
				}
			}
			
			var conf = block.conf,script,id,api;
			for (i=0;i<conf.fields.length;i++) {
				name = conf.fields[i];
				script = conf.script[name];
				if (script) {
					id = "#instance_%0_%1".format(block.id,name);
					api = eval(script.replace("#[ID]",id));
					if (data && data[name] && api && api.setData) { 
						api.setData(data[name]);
					}
				}
			}
		}
		
		function getNextID() {
			return ++blockID;
		}
		
		function getItemField(html,id) {
			return html.replace(/(id|for|name|data-id)="/g,'$1="instance_%0_'.format(id));
		}

		$.extend(this, {
			// public API
			getItemField: getItemField,
			makeSortable: makeSortable,
			populate: populate,
			addBlock: addBlock,
			getNextID: getNextID,
			fadeIn: fadeIn,
			buttons: function() {
				return buttons.clone();
			},
			target: function () {
				return target;
			},
			destroy: function() {
				target.data("peFieldItems", null);
				target = undefined;
			}
		});
		
		// initialize
		var self = this;
		start();
		
	}
	
	// jQuery plugin implementation
	$.fn.peFieldLayout = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldLayout");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldLayout.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldLayout(el, conf);
			el.data("peFieldLayout", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
	jQuery.fn.peScrollVisible = function(smooth) {
		var cTop = this.offset().top;
		var cHeight = this.outerHeight(true);
		var offset = this.is("li") ? 50 : (this.is("div.buttons") ? 0 : 30);
		cTop += offset;
		var windowTop = $(window).scrollTop();
		var visibleHeight = $(window).height();

		if (cTop < windowTop) {
			if (smooth) {
				$('html,body').animate({'scrollTop': cTop}, 300);
			} else {
				$(window).scrollTop(cTop);
			}
		} else if (cTop + cHeight > windowTop + visibleHeight) {
			if (smooth) {
				$('html,body').animate({'scrollTop': cTop - visibleHeight + cHeight}, 300);
			} else {
				$(window).scrollTop(cTop - visibleHeight + cHeight);
			}
		}
	};
	
}(window.jqpe35 || jQuery));


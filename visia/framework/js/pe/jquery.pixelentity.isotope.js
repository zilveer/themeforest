(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */ 
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,window */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peIsotope = {	
		conf: {
			api: false
		} 
	};
	
	var jwin = $(window);
	
	function triggerLazyloadingCheck () {
		jwin.triggerHandler("pe-lazyloading-refresh");
	}
	
	function ressort(a,b) {
		return b.w - a.w;
	}


	var sorter = {
			sort: {
				
				random  : function (a,b) { return Math.random() - 0.5; },
				grid    : function (a,b) { return a.fit.y - b.fit.y; },
				w       : function (a,b) { return b.w - a.w; },
				h       : function (a,b) { return b.h - a.h; },
				a       : function (a,b) { return b.w*b.h - a.w*a.h; },
				max     : function (a,b) { return Math.max(b.w, b.h) - Math.max(a.w, a.h); },
				min     : function (a,b) { return Math.min(b.w, b.h) - Math.min(a.w, a.h); },

				height  : function (a,b) { return sorter.sort.msort(a, b, ['h', 'w']);               },
				width   : function (a,b) { return sorter.sort.msort(a, b, ['w', 'h']);               },
				area    : function (a,b) { return sorter.sort.msort(a, b, ['a', 'h', 'w']);          },
				maxside : function (a,b) { return sorter.sort.msort(a, b, ['max', 'min', 'h', 'w']); },

				msort: function(a, b, criteria) { /* sort by multiple criteria */
					var diff, n;
					for (n = 0 ; n < criteria.length ; n++) {
						diff = sorter.sort[criteria[n]](a,b);
						if (diff !== 0) {
							return diff;
						}
					}
					return 0;
				}
			}
		
		};
	
	
	function Binpack(w) { 
		this.w = w; 
	}
	
	Binpack.prototype = {
		
		
		
		fit: function(blocks) {
			var n, node, block, len = blocks.length;
			var h = len > 0 ? blocks[0].h : 0;
			this.root = { x: 0, y: 0, w: this.w, h: h };
			
			for (n = 0; n < len ; n++) {
				block = blocks[n];
				if ((node = this.findNode(this.root, block.w, block.h))) {
					block.fit = this.splitNode(node, block.w, block.h);					
				} else {
					block.fit = this.growNode(block.w, block.h);					
				}
			}
		},

		findNode: function(node, w, h) {
			if (node.used) {				
				return (node.right && this.findNode(node.right, w, h)) || (node.down && this.findNode(node.down, w, h));
			} else if ((w <= node.w) && (h <= node.h)) {
				return node;				
			} else {
				return null;				
			}
		},

		splitNode: function(node, w, h) {
			node.used = true;
			if (node.w - w > 0) {
				node.right = { x: node.x + w, y: node.y,     w: node.w - w, h: h          };
			}
			if (node.h - h > 0) {
				node.down  = { x: node.x,     y: node.y + h, w: node.w,     h: node.h - h };
			}
			return node;
		},

		growNode: function(w, h) {
			if (w <= this.root.w) {
				return this.growDown(w, h);
			} else {
				return null;
			}
		},

		growDown: function(w, h) {
			var node;
			this.root = {
				used: true,
				x: 0,
				y: 0,
				w: this.root.w,
				h: this.root.h + h,
				down:  { x: 0, y: this.root.h, w: this.root.w, h: h },
				right: this.root
			};
			if ((node = this.findNode(this.root, w, h))) {
				return this.splitNode(node, w, h);
			} else {
				return null;
			}
		}

	};
	
	$.Isotope.prototype._binpackGetContainerSize =  function() {
		return { height: this.binpack.h };
    };

    $.Isotope.prototype._binpackResizeChanged = function() {
		//return false;
		return this._checkIfSegmentsChanged();
    };
	
	$.Isotope.prototype._binpackReset = function() {
		
		var w,h;
		var options = this.options.binpack;
		var masonry = options.masonry;
		
		if (options.fullscreen) {
			w = jwin.width();
			//this.element.width(jwin.width());
		} else {
			w = this.element.width();
		}
		
		var $elems = this.$allAtoms;
		var instance = this;
		
		var gx = options.gx;
		var gy = options.gy;
		var horiz = options.w === "auto";
		
		if (horiz) {
			this.binpack = {w:w,h:1000};
			return;
		}
		
		var dcw = options.w;
		
		var i,res = options.res,r;
		if (res) {
			for (i=0;i<res.length;i++) {
				r = res[i];
				if (w<=r.w) {
					dcw = r.cw;
					break;
				}
			}
		}
		
		var n = Math.ceil((w)/dcw);
		
		var cw = Math.floor((w)/n);
		var ch = Math.floor(options.h*cw/options.w);
		
		if (gx > 0) {
			cw = Math.floor((w-(gx*(n-1)))/n);
		}
		
		if (gy > 0) {
			ch = Math.floor(options.h*cw/options.w);
		}
		
		var count = 0,tw,th,img,iw,ih,scaler,dr,dc,layout;
		var maxH = -1;
		
		var cols;
		
		if (masonry) {
			i = n;
			cols = [];
			while (i--) {
				cols.push(0);
			}
		}
		
		var cell,el;
		
		for (i=0;i<$elems.length;i++) {
			
			cell = $elems.eq(i);
			el = cell.find(".scalable");
			
			if (el.length > 0) {
				
				layout = el.attr("data-layout-col"+n) ? el.attr("data-layout-col"+n) : el.attr("data-layout");
				layout = (layout || "1x1").split("x");
				
				dc = el.attr("data-cols");
				dc = dc ? dc : layout[0];
				
				if (dc === "ALL"){
					dc = n;
				}
			
				dc = parseInt(dc,10) || 1;
				
				dr = el.attr("data-rows");
				dr = parseInt(dr ? dr : layout[1],10) || 1;
				
				tw = cw*dc;
				th = ch*dr;
				
				if (gx > 0) {
					tw += gx*(dc-1);
				}
				
				if (gy > 0) {
					th += gy*(dr-1);
				}
				
				var auto = false;
				cell.data("w",tw);
				cell.data("h",false);
				cell.data("fullwidth",false);
												
				if (tw >= cw*n) {
					tw = w;
					el.width(tw);
					el.height("auto");
					cell.data("fullwidth",true);
					auto = true;
				} else {
					el.width(tw);

					if (th > 0) {
						el.height(th);
						cell.data("h",th);
					} else {
						el.height("auto");
						cell.data("h",el.height());
						maxH = Math.max(maxH,cell.data("h"));
						auto = true;
					}
				}				
				
				if (!auto) {
					img = el.find("> img:first, > a > img:first");
					
					if (img.lenght > 0) {
						iw = img.width();
						ih = img.height();
						
						if (ih < th) {
							el.height(ih);
							cell.data("h",ih);
						}
					}
				}
				
				if (maxH < 0) {
					el.find(".peNeedResize").triggerHandler("resize");
				}
				
			}
			
		}//);
		
		
		
		
		if (!masonry && maxH > 0) {
			
			for (i=0;i<$elems.length;i++) {
				cell = $elems.eq(i);
				if (cell.data("fullwidth")) {
					continue;
				}
				el = cell.find(".scalable");
				el.height(maxH);
				cell.data("h",maxH);
				el.find(".peNeedResize").triggerHandler("resize");
			}
			
		}
		
		this.binpack = {w:w,cols:cols,cw:cw,ch:ch,n:n,gx:gx,gy:gy};
	};
	
	
	$.Isotope.prototype._binpackLayout = function($elems) {
		var i,el,img;
		var blocks = [],bl;
		var options = this.options.binpack;
		var horiz = options.w === "auto";
		var gx = options.gx;
		var gy = options.gy;
		var w = this.binpack.w;
		var ch = options.h;
		var j,els;
		var ctop = this.element.offset().top;	
		
		if (horiz) {
			var x = 0,y = 0,ew;
			var rows = [];
			var row = 0;
			
			for (i=0;i<$elems.length;i++) {
				if (!rows[row]) {
					rows[row] = {
						els: [],
						w: 0
					};
				}
				el = $elems.eq(i);
				rows[row].els.push(el);
				
				if (el.data("w")) {
					ew = el.data("w");
				} else {
					ew = el.width();
					el.data("w",ew);
				}
				rows[row].w += ew;
				x += ew+gx;
				if (x > w) {
					x = 0;
					row++;
				}
			}
			
			var r = 0,chr;
			var single = this.element.hasClass("pe-single-row");

			
			for (i=0;i<rows.length;i++) {
				row = rows[i];
				els = row.els;
				r = Math.min(1,(w-gx*(row.els.length-1))/row.w);
				chr = Math.floor(ch*r);
				x = 0;
				for (j=0;j<els.length;j++) {
					el = els[j];
					ew = Math.ceil(el.data("w")*r);
					el.attr("data-row",i);
					el.width(ew);
					el.height(chr);
					el.css("overflow","hidden");
					if (single) {
						this._pushPosition(el, x+i*w,0);
					} else {
						this._pushPosition(el, x, y);
					}
					
					img = el.find("img.peLazyLoading");
					if (img.length > 0) {
						img.data("pe-lazyload-forced-top",ctop+y);
					}
					el.find(".peNeedResize").triggerHandler("resize");
					x += ew+gx;
				}
				if (single) {
					y = Math.max(y,chr+gy);
				} else {
					y += chr+gy;
				}
			}
			this.binpack.h = y-gy;
			
		} else {
			var cols = this.binpack.cols,cw = this.binpack.cw;
			var minY,bm,rm = this.binpack.cw*this.binpack.n;
			
			for (i=0;i<$elems.length;i++) {
				el = $elems.eq(i);
				el.removeClass("grid-first-row grid-first-col grid-last-row grid-last-col");
				
				/*
				 * DOUBLE CHECK THE FOLLOWING LINE
				 * 
				 * Added 07/09/2013
				 * 
				 * 
				 * 
				 * 
				 */
				
				el.width(cw);
				bl = {w:el.width(),h:el.height()+gy,el:el};
				
				if (cols) {
					j = $.inArray(Math.min.apply(Math,cols),cols);
					bl.fit = {x:j*cw,y:cols[j]};
					cols[j] += bl.h;
				}
				
				blocks[i] = bl;
				
			}
			
			var masonry = this.options.binpack.masonry;
			
			if (cols) {
				bm = this.binpack.h = Math.max.apply(Math,cols);
				
				// masonry here
			} else {
				var packer,sortM = this.options.binpack.sort;
				
				if (sortM && sortM != "order" && sortM != "none") {
					if (sortM === "auto") {
						var s,autos = ["maxside","area","height","width","max","min","w","h","a"];
						var minH = 100000000,minS;
						
						for (i=0;i<autos.length;i++) {
							s = autos[i];
							packer = new Binpack(w);
							blocks.sort(sorter.sort[s]);
							packer.fit(blocks);
							
							if (packer.root.h < minH) {
								minS = s;
								minH = packer.root.h;
							}
							
						}
						
						blocks.sort(sorter.sort[minS]);
						
					} else {
						if (sorter.sort[this.options.binpack.sort]) {
							blocks.sort(sorter.sort[this.options.binpack.sort]);
						}
					}
				}
				
				packer = new Binpack(w);
				packer.fit(blocks);		
				this.binpack.h = packer.root.h;
				
				bm = packer.root.h;
			}
			
			var blk,pos;
			
			var off = 0;
			var reset = 0;
			var maxH = 0;
			
			blocks.sort(sorter.sort.grid);
			for(i=0;i<blocks.length;i++) {
				blk = blocks[i];
				pos = blk.fit;
				el = blk.el;
				if (pos) {
					if (pos.x === 0) {
						el.addClass("grid-first-col");
					} else if (gx > 0) {
						off = (pos.x-cw)/(cw+gx);
						off = Math.round((Math.ceil(off)-off)*(cw+gx));
						pos.x += off+gx;
					}
					
					if (pos.x + blk.w === rm) {
						el.addClass("grid-last-col");
					}
					
					if (pos.y === 0) {
						el.addClass("grid-first-row");
					} 
					
					if (pos.y + blk.h === bm) {
						el.addClass("grid-last-row");
					}
					
					img = el.find("img.peLazyLoading");
					if (img.length > 0) {
						img.data("pe-lazyload-forced-top",ctop+pos.y);
					}
					
					if (gy > 0) {
						off = pos.y+blk.h;
						maxH = Math.max(off,maxH);
					}
					
					this._pushPosition(el, pos.x, pos.y);
				}
				blk.el = null;
				blk.fit = null;
			}
			
			if (maxH > 0) {
				this.binpack.h = maxH-gy;
			}
		}
		
		triggerLazyloadingCheck();
		// needed on mobile
		setTimeout(triggerLazyloadingCheck,1000);
	};
	
	$.Isotope.prototype._fitRowsLayout = function( $elems ) {
		var instance = this,containerWidth = this.element.width(),props = this.fitRows,margin = 0,additional = 0;
		
		$elems.each(function () {
			var $this = $(this);
			var mleft = parseInt($this.css("margin-left").replace(/px/,""),10);
			margin = Math.max(margin,mleft);
		});
		
		var ctop = this.element.offset().top;
		var img;
		
		$elems.each( function() {
			var $this = $(this),atomW = $this.outerWidth(true),atomH = $this.outerHeight(true);
			
			if (atomW*1.1 > containerWidth) {
				$this.width(containerWidth).data("resized",true).addClass("no-transition");
				atomW = $this.width();
				atomH = $this.height();
			} else if ($this.data("resized")) {
				$this.css("width","").data("resized",false).removeClass("no-transition");
				atomW = $this.width();
				atomH = $this.height();
			}
			
			if ( props.x !== 0 && atomW + props.x > containerWidth ) {
				// if this element cannot fit in the current row
				props.x = 0;
				props.y = props.height;
			}
			
			var mleft = parseInt($this.css("margin-left").replace(/px/,""),10);
			margin = Math.max(margin,mleft);

			if (props.x === 0 && mleft > 0) {
				props.x = -mleft;
			} 
			
			if (props.x > 0 && mleft === 0) {
				props.x += margin;
			}
			
			// position the atom
			instance._pushPosition( $this, props.x, props.y );

			props.height = Math.max( props.y + atomH, props.height );
			props.x += atomW;
			
			img = $this.find("img.peLazyLoading");
			if (img.length > 0) {
				img.data("pe-lazyload-forced-top",ctop+props.y);
			}
			
			
		});
		
		triggerLazyloadingCheck();
		// needed on mobile
		setTimeout(triggerLazyloadingCheck,1000);
		
    };
	
	function PeIsotope(target, conf) {
		
		var container;
		var filters;
		var isotope;
		var images;
		
		// init function
		function start() {
			container = target.find(".peIsotopeContainer");
			images = container.find("img[data-original]");
			var img,i = images.length;
			while (i--) {
				img = images.eq(i);
				img.attr("data-delayed-original",img.attr("data-original"));
				img.removeAttr("data-original");
			}
			$.pixelentity.preloader.load(container,loaded);
		}
		
		function filter(e) {
			var search = e.currentTarget.getAttribute("data-category");
			filters.removeClass("active").filter(e.currentTarget).addClass("active");
			search = search ? ".filter-"+search : "";
			container.isotope({filter: search});
			return false;
		}
		
		function onLayout() {
			target.trigger("pe-isotope-layout",[this]);
		}

		
		function loaded() {
			
			var i,conf;
			
			conf = {
				hiddenStyle: {opacity : 0 },
				visibleStyle: {opacity : 1 }, 
				itemSelector : '.peIsotopeItem',
				layoutMode: "fitRows",
				onLayout: onLayout,
				resizable: false
			};
			
			if (container.hasClass("peIsotopeGrid")) {
				
				conf.layoutMode = "binpack";
				
				var dcw = container.attr("data-cell-width").split(",");
				var dch = container.attr("data-cell-height");
				var masonry = false;
				
				if (dch === "auto") {
					dch = -1;
					masonry = true;
				}
				
				dch = dch === "same" ? -1 : dch;
				
				conf.binpack = {
					w: dcw[0] === "auto" ? "auto" : parseInt(dcw[0],10) || 188,
					h: parseInt(dch,10) || 120,
					sort: container.attr("data-sort") || "maxside",
					fullscreen: container.hasClass("peIsotopeFullscreen"),
					masonry: masonry,
					gx: parseInt(container.attr("data-cell-gx"),10) || 0,
					gy: parseInt(container.attr("data-cell-gy"),10) || 0,
					res: false
				};
				
				if (dcw.length > 1) {
					var res = [],rcw;
					for (i=1;i<dcw.length;i++) {
						rcw = dcw[i].split(":");
						res.push({w:parseInt(rcw[0],10),cw:parseInt(rcw[1],10) || conf.binpack.w});
					}
					res.sort(ressort);
					conf.binpack.res = res;
				}
				
				/*
				container.find(".peIsotopeItem").prepend('<span class="border left"></span>');
				container.find(".peIsotopeItem").prepend('<span class="border left overlay"></span>');
				container.find(".peIsotopeItem").prepend('<span class="border top"></span>');				
				container.find(".peIsotopeItem").prepend('<span class="border top overlay"></span>');
				*/
			}
			
			isotope = container.isotope(conf).data("isotope");
			filters = target.find(".peIsotopeFilter a").click(filter);
			setTimeout(resizable,500);
			
			var img;
			i = images.length;
			
			while (i--) {
				img = images.eq(i);
				img.attr("data-original",img.attr("data-delayed-original"));
				img.removeAttr("data-delayed-original","");
			}
			images.peLazyLoading();

			target.trigger("loaded");
		}
		
		function reLayout() {
			isotope.reLayout();
		}
		
		function resize() {
			isotope.resize();
			setTimeout(reLayout,1000);
		}
				
		function resizable() {
			$(window).bind('smartresize.isotope',resize);
			isotope.reLayout();
		}
		
		$.extend(this, {
			// plublic API
			isotope: function() {
				return isotope;
			},
			destroy: function() {
				target.data("peIsotope", null);
				target = undefined;
			}
		});
		
		// initialize
		start();
	}
	
	// jQuery plugin implementation
	$.fn.peIsotope = function(conf) {
		
		// return existing instance	
		var api = this.data("peIsotope");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peIsotope.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeIsotope(el, conf);
			el.data("peIsotope", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));
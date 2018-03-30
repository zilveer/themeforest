(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global wp,jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	$.pixelentity.peFieldThumbnails = {	
		conf: {
			api: false
		} 
	};
	
	
	function PeFieldThumbnails(target, conf) {
		var previews;
		var current;
		var crop;
		var area;
		var scale;
		var nonce;
		var id;
		var w,h,pw,ph;
		var orig;
		
		function zoom(div,iw,ih) {
			//var scaler = $.pixelentity.Geom.getScaler("fitmax","center","center",w,h,iw,ih);
			var scaler = $.pixelentity.Geom.getScaler("fit","center","center",w,h,iw,ih);
			div.transform(scaler.ratio,scaler.offset.w,scaler.offset.h,iw,ih,true);
		}

		function livepreview(restore) {
			var a = area.getSelection();
			var img = current.find("img");
			var div = img.parent();
			
			var x1 = parseInt(a.x1*scale,10);
			var x2 = parseInt(a.x2*scale,10);
			var y1 = parseInt(a.y1*scale,10);
			var y2 = parseInt(a.y2*scale,10);
			var dw,dh;
			
			if (restore === true) {
				img.attr("src",img.data("src")).css("margin",0);
				dw = div.data("w");
				dh = div.data("h");
			} else {
				img.attr("src",orig).css({
					"margin-left" : "-%0px".format(x1),
					"margin-top" : "-%0px".format(y1)
				});
				dw = x2-x1;
				dh = y2-y1;
			}
			
			div.css({
				"width" : "%0px".format(dw),
				"height" : "%0px".format(dh)
			});	
			
			
			zoom(div,dw,dh);
		}
		
		function save() {
			var a = area.getSelection();
			var saved = "%0,%1,%2,%3".format(
					Math.round(a.x1*scale),
					Math.round(a.y1*scale),
					Math.round(a.x2*scale),
					Math.round(a.y2*scale)
				);
			//saved += update === false ? "" : ":updated";
			current.parent().find("input").val(saved);
			return saved;
		}
		
		function restore() {
			var saved = current.parent().find("input").val();
			if (!saved) {
				return false;
			}
			var a = saved.split(":")[0].split(",");
			area.setSelection(a[0]/scale,a[1]/scale,a[2]/scale,a[3]/scale,true);
			return true;
		}

		
		function showcrop(e) {
			current = previews.eq(e.currentTarget.id);
			var parent = current.parent();

			//previews.parent().fadeTo(400,0.1);
			//parent.stop().fadeTo(0,1);
			previews.not(current).parent().hide();
			
			//parent.after(crop);
			parent.before(crop);

			
			crop.show();
			
			var pw = crop.find("img").width();
			
			if (pw < 400) {
				var controls = crop.find(".pe-controls");
				controls.width(pw);
				controls = controls.find("input");
				
				controls.each(function (idx) {
					var c = controls.eq(idx);
					if (c.width() > (pw-14)) {
						c.width(pw-14);
					}
				});
				
				console.log(crop[0]);
			}
			crop.css({
				"float": "left",
				"margin-right": "10px"
				//"margin-top": "-%0px".format(h),
				//"margin-left": "400px"
			});
			if (!area) {
				area = crop.find("img:eq(0)").imgAreaSelect({
					handles: false,
					persistent: true,
					instance: true,
					resizable: true,
					keys:true,
					//onSelectEnd:save
					onSelectChange:livepreview
				});
			}
			
			var div = current.find(" > div");
			var iw = div.width();
			var ih = div.height();
			
			var img = current.find("img");
			
			area.setOptions({show: true,aspectRatio:iw+":"+ih,minWidth:iw/scale,minHeight:ih/scale});
			
			if (!restore()) {
				var scaler = $.pixelentity.Geom.getScaler("fitmax","center","center",pw,ph,iw,ih);
				var x1 = scaler.offset.w;
				var y1 = scaler.offset.h;
				area.setSelection(x1,y1,x1+iw*scaler.ratio,y1+ih*scaler.ratio,true);
			}
			
			area.update();
			//save(false);
		}
		
		function hidecrop() {
			area.setOptions({hide:true});
			crop.hide();
			previews.parent().fadeTo(400,1);
		}
		
		function done(res) {
			if (!res.success) {
				return;
			}
			var data = res.data;
			var p = previews.eq(data.idx);
			var div = p.find("> div");
			p.find("img").attr("src",data.cburl).css("margin",0).data("src",data.cburl);
			div.data("w",data.width).width(data.width);
			div.data("h",data.height).height(data.height);
			zoom(div,data.width,data.height);
		}

		
		function docrop() {
			var saved = save();
			jQuery.post(
				ajaxurl,
				{
					action : "pe_theme_image_crop",
					nonce: nonce,
					idx: current.attr("id"),
					id: id,
					orig: orig,
					size: current.attr("data-size"),
					crop: saved
				},
				done
			);	
			hidecrop();
		}

		
		function evHandler(e) {
			switch (e.currentTarget.id) {
			case "pe-theme-done":
				docrop();
				break;
			default:
				restore();
				livepreview(true);
				hidecrop();
			}
		}

		
		// init function
		function start() {
			crop = target.find(".pe-theme-editor");
			scale = parseFloat(crop.attr("data-scale"));
			id = crop.attr("data-id");
			nonce = crop.attr("data-nonce");
			w = parseInt(crop.attr("data-w"),10);
			h = parseInt(crop.attr("data-h"),10);
			pw = parseInt(crop.attr("data-pw"),10);
			ph = parseInt(crop.attr("data-ph"),10);
			orig  = target.attr("data-orig");
			crop.hide();
			
			previews = target.find(".pe-theme-preview");
			
			var p,img,div;
			previews.each(function (idx) {
				p = previews.eq(idx).attr("id",idx);
				img = p.find("img");
				img.data("src",img.attr("src"));

				div = p.find("> div");
				div.data("w",div.width());
				div.data("h",div.height());
				zoom(div,div.data("w"),div.data("h"));
			});
			
			previews.on("click",showcrop);
			crop.on("click","input",evHandler);
		}
		
		$.extend(this, {
			// plublic API
			destroy: function() {
				target.data("peFieldThumbnails", null);
				target = undefined;
			}
		});
		
		$(start);
	}
	
	// jQuery plugin implementation
	$.fn.peFieldThumbnails = function(conf) {
		
		// return existing instance	
		var api = this.data("peFieldThumbnails");
		
		if (api) { 
			return api; 
		}
		
		conf = $.extend(true, {}, $.pixelentity.peFieldThumbnails.conf, conf);
		
		// install the plugin for each entry in jQuery object
		this.each(function() {
			var el = $(this);
			api = new PeFieldThumbnails(el, conf);
			el.data("peFieldThumbnails", api); 
		});
		
		return conf.api ? api: this;		 
	};
	
}(jQuery));
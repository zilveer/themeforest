if(navigator.platform == 'iPad' || navigator.platform == 'iPhone')
{
	$(document).ready(function(e) {
		 
		$('#theme-light').css('min-width', '1110px');
		$('#theme-light-two').css('min-width', '1110px');
		$('.theme-back').css('min-width', '1110px');
		$('.theme-back-two').css('min-width', '1110px');
		$('.tabmenu-back').css('min-width', '1110px');
		$('.tabmenu-back-two').css('min-width', '1110px');
		$('.dot-tab').css('min-width', '1110px');
		$('#footer-area').css('min-width', '1110px');
		$('#bottom-area').css('min-width', '1110px');
	});
}

/*
Top Menu
 */
 function mainmenu(){
        $(" #nav ul").css({display: "none"});
        $(" #nav ul ul").css({display: "none"});
        $(" #nav li").hover(function(){
            $(this).find('ul:first').css({visibility: "visible",display: "none"}).show("fade", { times:5 }, 500);
            },function(){
            $(this).find('ul:first').css({visibility: "hidden"});		
            });
        }
    
        $(document).ready(function(){					
            mainmenu();
        });

/*
Mioo LeTabs v1.3
2011 © www.mioo.sk
 */
(function ($) {
	"use strict";
	
	// Create the defaults once
	var pluginName = 'LeTabs',
	defaults = {
		tabContainer : "#le-tabs_tab_container", // Element containing tab elements
		tabSelector : false,//"a", // Tab selector (eg. with href attribute for selecting specific content elements through ID)
		contentContainer : "#le-tabs_content_container", // Element containing content elements for tabs
		contentInner : "#le-tabs_content_inner", // Element containing content elements for tabs
		contentSelector : false, // Content selector (eg. with ID attribute to work with specific tab selectors)
		initialTab : 0, // Tab opened initially when website loads (0 = 1st tab,..)
		autoOrder : true, // Set true when not defining HREF or ID selectors between tabs and contents - eg. first tab element will be auto assigned to the first content element and so on in order
		autoplayInterval : 0, // Autoplay tabs in order in miliseconds (0 = disabled)
		animSpeed : 400, // Animation speed when switching contents
		autoHeight : false, // If true, content container's height is dynamically resized according to the height of visible content
		animation : "swing", // Easing
		direction : "vertical",
		onEvent : "click" // Trigger change
	},
	compatibility = "Compatibility settings: ";
	
	// The actual plugin constructor
	function LeTabs(element, options) {
		this.element = element;
		this.$element = $(this.element);
		
		this.options = $.extend({}, defaults, options);
		
		this.$tab_container = this.$element.find(this.options.tabContainer);
		this.$tab_el = (this.options.tabSelector === false) ? this.$tab_container.children() : this.$tab_container.find(this.options.tabSelector);
		this.$tab_length = this.$tab_el.length - 1;
		this.$content_container = this.$element.find(this.options.contentContainer);
		this.$content_inner = this.$content_container.find(this.options.contentInner);
		this.$content_el = (this.options.contentSelector === false) ? this.$content_inner.children() : this.$content_inner.find(this.options.contentSelector);
		this.$external_tab_link = this.$content_el.find("a[href|='#tab']");
		
		this.width = this.$element.outerWidth();
		this.visible = null;
		this.interval = null;
		this.query = false;
		
		this._defaults = defaults;
		this._name = pluginName;
		
		//self					= this;
		
		this.init();
	}
	
	// Plugin private methods
	LeTabs.prototype = {
		
		// Plugin initialization
		init : function () {
			setHtmlDefaults.call(this);
			// Set initial contents location
			this.$content_el.css(this.getDirObj(this.width));
			
			// If autoplay is set
			if (this.options.autoplayInterval > 0) {
				this.setAutoplay();
				// Binds stopping autoplay on mouseover
				try {
					this.$element.on("mouseenter mouseleave", {
						self : this
					}, this.bindHover);
				} catch (err) {
					//console.log(compatibility + err);
					
					this.$element.bind("mouseenter mouseleave", {
						self : this
					}, this.bindHover);
				}
			}
			
			// Prevents default action when anchor is clicked
			try {
				this.$tab_container.find("a[href]").on("click", function (e) {
					e.preventDefault();
					return;
				});
			} catch (err) {
				//console.log(compatibility + err);
				
				this.$tab_container.find("a[href]").bind("click", function (e) {
					e.preventDefault();
					return;
				});
			}
			
			// Binds action when tab is triggered
			try {
				this.$tab_el.on(this.options.onEvent, {
					self : this
				}, this.bindTabs);
			} catch (err) {
				//console.log(compatibility + err);
			
				this.$tab_el.bind(this.options.onEvent, {
					self : this
				}, this.bindTabs);
			}
			
			// Links inside contents which can be used like tab links
			this.$external_tab_link.bind("click", {
				self : this
			}, function (e) {
				var val = e.data.self.getLinkVal($(this)),
				isNum;
				try {
					isNum = $.isNumeric(val);
				} catch (err) {
					//console.log(compatibility + err);
					isNum = !isNaN(val);
				}
				if (isNum) {
					e.data.self.autoLoad(parseInt(val, 10));
				} else {
					e.data.self.$tab_el.filter(val).trigger(e.data.self.options.onEvent);
				}
				e.preventDefault();
			});
			
			// Initial load of defined tab
			this.autoLoad(this.options.initialTab);
		},
		
		// Autoplay interval
		setAutoplay : function () {
			var self = this;
			clearInterval(this.interval);
			this.interval = setInterval(function () {
					self.autoLoad(self.visible + 1);
				}, this.options.autoplayInterval);
		},
		
		bindHover : function (e) {
			if (e.type === "mouseenter")
				clearInterval(e.data.self.interval);
			else
				e.data.self.setAutoplay();
		},
		
		bindTabs : function (e) {
			e.data.self.showw(this);
		},
		
		autoLoad : function (i) {
			this.showw((i > this.$tab_length) ? this.$tab_el[0] : ((i < 0) ? this.$tab_el[this.$tab_length] : this.$tab_el[i]));
		},
		
		showw : function (el) {
			//
			
			var i = parseInt(this.getIndex(el), 10),
			visible_el,
			new_el,
			href,
			direction = (this.visible > i) ? 1 : -1;
			if (this.visible === i)
				return;
			
			if (this.options.autoOrder) {
				visible_el = $(this.$content_el[this.visible]);
				new_el = $(this.$content_el[i]);
			} else {
				href = this.getHref($(el));
				visible_el = $(this.$content_el.filter(this.getHref(this.$tab_el[this.visible])));
				new_el = $(this.$content_el.filter(href));
			}
			
			if (visible_el.length && visible_el.queue("fx").length)
				return false;
			this.toggleActiveTab(i);
			
			new_el.css(this.getDirObj(-direction * this.width)).stop(true, true).animate(this.getDirObj(0), this.options.animSpeed, this.options.animation);
			visible_el.stop(true, true).animate(this.getDirObj(direction * this.width), this.options.animSpeed, this.options.animation);
			this.setHeight(new_el);
			this.visible = i;
		},
		
		toggleActiveTab : function (i) {
			this.$tab_el.filter(".active").removeClass("active");
			$(this.$tab_el[i]).addClass("active");
		},
		
		setHeight : function (el) {
			if (this.options.autoHeight)
				this.$content_container.stop(true, true).animate({
					height : this.getHeight(el)
				}, this.options.animSpeed * 2 / 3, this.options.animation);
		},
		
		getDirObj : function (val) {
			return (this.options.direction === "vertical") ? {
				top : val
			}
			 : {
				left : val
			};
		},
		
		getIndex : function (el) {
			return parseInt($(el).index(), 10);
		},
		
		getHeight : function (el) {
			return el.outerHeight();
		},
		
		getLinkVal : function (el) {
			var temp = this.getHref(el).split("-");
			return temp[temp.length - 1];
		},
		
		getHref : function (el) {
			return $(el).attr("href") || false;
		}
		
	};
	
	// jQuery external plugin definition
	$.fn[pluginName] = function (options) {
		return this.each(function () {
			if (!$.data(this, 'plugin_' + pluginName)) {
				$.data(this, 'plugin_' + pluginName, new LeTabs(this, options));
			}
		});
	};
	
	
	function setHtmlDefaults () {

		if(typeof this.$element.attr("class") == "undefined") return false;
		var arr_class = this.$element.attr("class").split(" ");
		var self = this;
		$.grep(arr_class, function(n, i){
			if(n.split("-").length == 2 && n.split("-")[0] in self._defaults){
				var val = n.split("-");
				
				if(parseInt(val[1], 10) == val[1] && typeof self.options[val[0]] == "number") self.options[val[0]] = parseInt(val[1], 10);
				if(typeof self.options[val[0]] == "string"){
				
						self.options[val[0]] = (val[1]);
					
				}else if(typeof self.options[val[0]] == "boolean"){
					try{
						self.options[val[0]] = eval(val[1]);
					}catch(er){
						console.log(er);
					}
					 
				}
				
				return true;
			}
			
			if(n in self._defaults){
				self.options[n] = true;
				return true;
			}
		});
		
	}

})(jQuery);

jQuery(document).bind("ready", function(){
	$("#le-tabs").LeTabs();
});










/*
 * FancyBox - jQuery Plugin
 * Simple and fancy lightbox alternative
 *
 * Examples and documentation at: http://fancybox.net
 * 
 * Copyright (c) 2008 - 2010 Janis Skarnelis
 * That said, it is hardly a one-person project. Many people have submitted bugs, code, and offered their advice freely. Their support is greatly appreciated.
 * 
 * Version: 1.3.4 (11/11/2010)
 * Requires: jQuery v1.3+
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

;(function(b){var m,t,u,f,D,j,E,n,z,A,q=0,e={},o=[],p=0,d={},l=[],G=null,v=new Image,J=/\.(jpg|gif|png|bmp|jpeg)(.*)?$/i,W=/[^\.]\.(swf)\s*$/i,K,L=1,y=0,s="",r,i,h=false,B=b.extend(b("<div/>")[0],{prop:0}),M=b.browser.msie&&b.browser.version<7&&!window.XMLHttpRequest,N=function(){t.hide();v.onerror=v.onload=null;G&&G.abort();m.empty()},O=function(){if(false===e.onError(o,q,e)){t.hide();h=false}else{e.titleShow=false;e.width="auto";e.height="auto";m.html('<p id="fancybox-error">The requested content cannot be loaded.<br />Please try again later.</p>');
F()}},I=function(){var a=o[q],c,g,k,C,P,w;N();e=b.extend({},b.fn.fancybox.defaults,typeof b(a).data("fancybox")=="undefined"?e:b(a).data("fancybox"));w=e.onStart(o,q,e);if(w===false)h=false;else{if(typeof w=="object")e=b.extend(e,w);k=e.title||(a.nodeName?b(a).attr("title"):a.title)||"";if(a.nodeName&&!e.orig)e.orig=b(a).children("img:first").length?b(a).children("img:first"):b(a);if(k===""&&e.orig&&e.titleFromAlt)k=e.orig.attr("alt");c=e.href||(a.nodeName?b(a).attr("href"):a.href)||null;if(/^(?:javascript)/i.test(c)||
c=="#")c=null;if(e.type){g=e.type;if(!c)c=e.content}else if(e.content)g="html";else if(c)g=c.match(J)?"image":c.match(W)?"swf":b(a).hasClass("iframe")?"iframe":c.indexOf("#")===0?"inline":"ajax";if(g){if(g=="inline"){a=c.substr(c.indexOf("#"));g=b(a).length>0?"inline":"ajax"}e.type=g;e.href=c;e.title=k;if(e.autoDimensions)if(e.type=="html"||e.type=="inline"||e.type=="ajax"){e.width="auto";e.height="auto"}else e.autoDimensions=false;if(e.modal){e.overlayShow=true;e.hideOnOverlayClick=false;e.hideOnContentClick=
false;e.enableEscapeButton=false;e.showCloseButton=false}e.padding=parseInt(e.padding,10);e.margin=parseInt(e.margin,10);m.css("padding",e.padding+e.margin);b(".fancybox-inline-tmp").unbind("fancybox-cancel").bind("fancybox-change",function(){b(this).replaceWith(j.children())});switch(g){case "html":m.html(e.content);F();break;case "inline":if(b(a).parent().is("#fancybox-content")===true){h=false;break}b('<div class="fancybox-inline-tmp" />').hide().insertBefore(b(a)).bind("fancybox-cleanup",function(){b(this).replaceWith(j.children())}).bind("fancybox-cancel",
function(){b(this).replaceWith(m.children())});b(a).appendTo(m);F();break;case "image":h=false;b.fancybox.showActivity();v=new Image;v.onerror=function(){O()};v.onload=function(){h=true;v.onerror=v.onload=null;e.width=v.width;e.height=v.height;b("<img />").attr({id:"fancybox-img",src:v.src,alt:e.title}).appendTo(m);Q()};v.src=c;break;case "swf":e.scrolling="no";C='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="'+e.width+'" height="'+e.height+'"><param name="movie" value="'+c+
'"></param>';P="";b.each(e.swf,function(x,H){C+='<param name="'+x+'" value="'+H+'"></param>';P+=" "+x+'="'+H+'"'});C+='<embed src="'+c+'" type="application/x-shockwave-flash" width="'+e.width+'" height="'+e.height+'"'+P+"></embed></object>";m.html(C);F();break;case "ajax":h=false;b.fancybox.showActivity();e.ajax.win=e.ajax.success;G=b.ajax(b.extend({},e.ajax,{url:c,data:e.ajax.data||{},error:function(x){x.status>0&&O()},success:function(x,H,R){if((typeof R=="object"?R:G).status==200){if(typeof e.ajax.win==
"function"){w=e.ajax.win(c,x,H,R);if(w===false){t.hide();return}else if(typeof w=="string"||typeof w=="object")x=w}m.html(x);F()}}}));break;case "iframe":Q()}}else O()}},F=function(){var a=e.width,c=e.height;a=a.toString().indexOf("%")>-1?parseInt((b(window).width()-e.margin*2)*parseFloat(a)/100,10)+"px":a=="auto"?"auto":a+"px";c=c.toString().indexOf("%")>-1?parseInt((b(window).height()-e.margin*2)*parseFloat(c)/100,10)+"px":c=="auto"?"auto":c+"px";m.wrapInner('<div style="width:'+a+";height:"+c+
";overflow: "+(e.scrolling=="auto"?"auto":e.scrolling=="yes"?"scroll":"hidden")+';position:relative;"></div>');e.width=m.width();e.height=m.height();Q()},Q=function(){var a,c;t.hide();if(f.is(":visible")&&false===d.onCleanup(l,p,d)){b.event.trigger("fancybox-cancel");h=false}else{h=true;b(j.add(u)).unbind();b(window).unbind("resize.fb scroll.fb");b(document).unbind("keydown.fb");f.is(":visible")&&d.titlePosition!=="outside"&&f.css("height",f.height());l=o;p=q;d=e;if(d.overlayShow){u.css({"background-color":d.overlayColor,
opacity:d.overlayOpacity,cursor:d.hideOnOverlayClick?"pointer":"auto",height:b(document).height()});if(!u.is(":visible")){M&&b("select:not(#fancybox-tmp select)").filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one("fancybox-cleanup",function(){this.style.visibility="inherit"});u.show()}}else u.hide();i=X();s=d.title||"";y=0;n.empty().removeAttr("style").removeClass();if(d.titleShow!==false){if(b.isFunction(d.titleFormat))a=d.titleFormat(s,l,p,d);else a=s&&s.length?
d.titlePosition=="float"?'<table id="fancybox-title-float-wrap" cellpadding="0" cellspacing="0"><tr><td id="fancybox-title-float-left"></td><td id="fancybox-title-float-main">'+s+'</td><td id="fancybox-title-float-right"></td></tr></table>':'<div id="fancybox-title-'+d.titlePosition+'">'+s+"</div>":false;s=a;if(!(!s||s==="")){n.addClass("fancybox-title-"+d.titlePosition).html(s).appendTo("body").show();switch(d.titlePosition){case "inside":n.css({width:i.width-d.padding*2,marginLeft:d.padding,marginRight:d.padding});
y=n.outerHeight(true);n.appendTo(D);i.height+=y;break;case "over":n.css({marginLeft:d.padding,width:i.width-d.padding*2,bottom:d.padding}).appendTo(D);break;case "float":n.css("left",parseInt((n.width()-i.width-40)/2,10)*-1).appendTo(f);break;default:n.css({width:i.width-d.padding*2,paddingLeft:d.padding,paddingRight:d.padding}).appendTo(f)}}}n.hide();if(f.is(":visible")){b(E.add(z).add(A)).hide();a=f.position();r={top:a.top,left:a.left,width:f.width(),height:f.height()};c=r.width==i.width&&r.height==
i.height;j.fadeTo(d.changeFade,0.3,function(){var g=function(){j.html(m.contents()).fadeTo(d.changeFade,1,S)};b.event.trigger("fancybox-change");j.empty().removeAttr("filter").css({"border-width":d.padding,width:i.width-d.padding*2,height:e.autoDimensions?"auto":i.height-y-d.padding*2});if(c)g();else{B.prop=0;b(B).animate({prop:1},{duration:d.changeSpeed,easing:d.easingChange,step:T,complete:g})}})}else{f.removeAttr("style");j.css("border-width",d.padding);if(d.transitionIn=="elastic"){r=V();j.html(m.contents());
f.show();if(d.opacity)i.opacity=0;B.prop=0;b(B).animate({prop:1},{duration:d.speedIn,easing:d.easingIn,step:T,complete:S})}else{d.titlePosition=="inside"&&y>0&&n.show();j.css({width:i.width-d.padding*2,height:e.autoDimensions?"auto":i.height-y-d.padding*2}).html(m.contents());f.css(i).fadeIn(d.transitionIn=="none"?0:d.speedIn,S)}}}},Y=function(){if(d.enableEscapeButton||d.enableKeyboardNav)b(document).bind("keydown.fb",function(a){if(a.keyCode==27&&d.enableEscapeButton){a.preventDefault();b.fancybox.close()}else if((a.keyCode==
37||a.keyCode==39)&&d.enableKeyboardNav&&a.target.tagName!=="INPUT"&&a.target.tagName!=="TEXTAREA"&&a.target.tagName!=="SELECT"){a.preventDefault();b.fancybox[a.keyCode==37?"prev":"next"]()}});if(d.showNavArrows){if(d.cyclic&&l.length>1||p!==0)z.show();if(d.cyclic&&l.length>1||p!=l.length-1)A.show()}else{z.hide();A.hide()}},S=function(){if(!b.support.opacity){j.get(0).style.removeAttribute("filter");f.get(0).style.removeAttribute("filter")}e.autoDimensions&&j.css("height","auto");f.css("height","auto");
s&&s.length&&n.show();d.showCloseButton&&E.show();Y();d.hideOnContentClick&&j.bind("click",b.fancybox.close);d.hideOnOverlayClick&&u.bind("click",b.fancybox.close);b(window).bind("resize.fb",b.fancybox.resize);d.centerOnScroll&&b(window).bind("scroll.fb",b.fancybox.center);if(d.type=="iframe")b('<iframe id="fancybox-frame" name="fancybox-frame'+(new Date).getTime()+'" frameborder="0" hspace="0" '+(b.browser.msie?'allowtransparency="true""':"")+' scrolling="'+e.scrolling+'" src="'+d.href+'"></iframe>').appendTo(j);
f.show();h=false;b.fancybox.center();d.onComplete(l,p,d);var a,c;if(l.length-1>p){a=l[p+1].href;if(typeof a!=="undefined"&&a.match(J)){c=new Image;c.src=a}}if(p>0){a=l[p-1].href;if(typeof a!=="undefined"&&a.match(J)){c=new Image;c.src=a}}},T=function(a){var c={width:parseInt(r.width+(i.width-r.width)*a,10),height:parseInt(r.height+(i.height-r.height)*a,10),top:parseInt(r.top+(i.top-r.top)*a,10),left:parseInt(r.left+(i.left-r.left)*a,10)};if(typeof i.opacity!=="undefined")c.opacity=a<0.5?0.5:a;f.css(c);
j.css({width:c.width-d.padding*2,height:c.height-y*a-d.padding*2})},U=function(){return[b(window).width()-d.margin*2,b(window).height()-d.margin*2,b(document).scrollLeft()+d.margin,b(document).scrollTop()+d.margin]},X=function(){var a=U(),c={},g=d.autoScale,k=d.padding*2;c.width=d.width.toString().indexOf("%")>-1?parseInt(a[0]*parseFloat(d.width)/100,10):d.width+k;c.height=d.height.toString().indexOf("%")>-1?parseInt(a[1]*parseFloat(d.height)/100,10):d.height+k;if(g&&(c.width>a[0]||c.height>a[1]))if(e.type==
"image"||e.type=="swf"){g=d.width/d.height;if(c.width>a[0]){c.width=a[0];c.height=parseInt((c.width-k)/g+k,10)}if(c.height>a[1]){c.height=a[1];c.width=parseInt((c.height-k)*g+k,10)}}else{c.width=Math.min(c.width,a[0]);c.height=Math.min(c.height,a[1])}c.top=parseInt(Math.max(a[3]-20,a[3]+(a[1]-c.height-40)*0.5),10);c.left=parseInt(Math.max(a[2]-20,a[2]+(a[0]-c.width-40)*0.5),10);return c},V=function(){var a=e.orig?b(e.orig):false,c={};if(a&&a.length){c=a.offset();c.top+=parseInt(a.css("paddingTop"),
10)||0;c.left+=parseInt(a.css("paddingLeft"),10)||0;c.top+=parseInt(a.css("border-top-width"),10)||0;c.left+=parseInt(a.css("border-left-width"),10)||0;c.width=a.width();c.height=a.height();c={width:c.width+d.padding*2,height:c.height+d.padding*2,top:c.top-d.padding-20,left:c.left-d.padding-20}}else{a=U();c={width:d.padding*2,height:d.padding*2,top:parseInt(a[3]+a[1]*0.5,10),left:parseInt(a[2]+a[0]*0.5,10)}}return c},Z=function(){if(t.is(":visible")){b("div",t).css("top",L*-40+"px");L=(L+1)%12}else clearInterval(K)};
b.fn.fancybox=function(a){if(!b(this).length)return this;b(this).data("fancybox",b.extend({},a,b.metadata?b(this).metadata():{})).unbind("click.fb").bind("click.fb",function(c){c.preventDefault();if(!h){h=true;b(this).blur();o=[];q=0;c=b(this).attr("rel")||"";if(!c||c==""||c==="nofollow")o.push(this);else{o=b("a[rel="+c+"], area[rel="+c+"]");q=o.index(this)}I()}});return this};b.fancybox=function(a,c){var g;if(!h){h=true;g=typeof c!=="undefined"?c:{};o=[];q=parseInt(g.index,10)||0;if(b.isArray(a)){for(var k=
0,C=a.length;k<C;k++)if(typeof a[k]=="object")b(a[k]).data("fancybox",b.extend({},g,a[k]));else a[k]=b({}).data("fancybox",b.extend({content:a[k]},g));o=jQuery.merge(o,a)}else{if(typeof a=="object")b(a).data("fancybox",b.extend({},g,a));else a=b({}).data("fancybox",b.extend({content:a},g));o.push(a)}if(q>o.length||q<0)q=0;I()}};b.fancybox.showActivity=function(){clearInterval(K);t.show();K=setInterval(Z,66)};b.fancybox.hideActivity=function(){t.hide()};b.fancybox.next=function(){return b.fancybox.pos(p+
1)};b.fancybox.prev=function(){return b.fancybox.pos(p-1)};b.fancybox.pos=function(a){if(!h){a=parseInt(a);o=l;if(a>-1&&a<l.length){q=a;I()}else if(d.cyclic&&l.length>1){q=a>=l.length?0:l.length-1;I()}}};b.fancybox.cancel=function(){if(!h){h=true;b.event.trigger("fancybox-cancel");N();e.onCancel(o,q,e);h=false}};b.fancybox.close=function(){function a(){u.fadeOut("fast");n.empty().hide();f.hide();b.event.trigger("fancybox-cleanup");j.empty();d.onClosed(l,p,d);l=e=[];p=q=0;d=e={};h=false}if(!(h||f.is(":hidden"))){h=
true;if(d&&false===d.onCleanup(l,p,d))h=false;else{N();b(E.add(z).add(A)).hide();b(j.add(u)).unbind();b(window).unbind("resize.fb scroll.fb");b(document).unbind("keydown.fb");j.find("iframe").attr("src",M&&/^https/i.test(window.location.href||"")?"javascript:void(false)":"about:blank");d.titlePosition!=="inside"&&n.empty();f.stop();if(d.transitionOut=="elastic"){r=V();var c=f.position();i={top:c.top,left:c.left,width:f.width(),height:f.height()};if(d.opacity)i.opacity=1;n.empty().hide();B.prop=1;
b(B).animate({prop:0},{duration:d.speedOut,easing:d.easingOut,step:T,complete:a})}else f.fadeOut(d.transitionOut=="none"?0:d.speedOut,a)}}};b.fancybox.resize=function(){u.is(":visible")&&u.css("height",b(document).height());b.fancybox.center(true)};b.fancybox.center=function(a){var c,g;if(!h){g=a===true?1:0;c=U();!g&&(f.width()>c[0]||f.height()>c[1])||f.stop().animate({top:parseInt(Math.max(c[3]-20,c[3]+(c[1]-j.height()-40)*0.5-d.padding)),left:parseInt(Math.max(c[2]-20,c[2]+(c[0]-j.width()-40)*0.5-
d.padding))},typeof a=="number"?a:200)}};b.fancybox.init=function(){if(!b("#fancybox-wrap").length){b("body").append(m=b('<div id="fancybox-tmp"></div>'),t=b('<div id="fancybox-loading"><div></div></div>'),u=b('<div id="fancybox-overlay"></div>'),f=b('<div id="fancybox-wrap"></div>'));D=b('<div id="fancybox-outer"></div>').append('<div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div>').appendTo(f);
D.append(j=b('<div id="fancybox-content"></div>'),E=b('<a id="fancybox-close"></a>'),n=b('<div id="fancybox-title"></div>'),z=b('<a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a>'),A=b('<a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a>'));E.click(b.fancybox.close);t.click(b.fancybox.cancel);z.click(function(a){a.preventDefault();b.fancybox.prev()});A.click(function(a){a.preventDefault();b.fancybox.next()});
b.fn.mousewheel&&f.bind("mousewheel.fb",function(a,c){if(h)a.preventDefault();else if(b(a.target).get(0).clientHeight==0||b(a.target).get(0).scrollHeight===b(a.target).get(0).clientHeight){a.preventDefault();b.fancybox[c>0?"prev":"next"]()}});b.support.opacity||f.addClass("fancybox-ie");if(M){t.addClass("fancybox-ie6");f.addClass("fancybox-ie6");b('<iframe id="fancybox-hide-sel-frame" src="'+(/^https/i.test(window.location.href||"")?"javascript:void(false)":"about:blank")+'" scrolling="no" border="0" frameborder="0" tabindex="-1"></iframe>').prependTo(D)}}};
b.fn.fancybox.defaults={padding:10,margin:40,opacity:false,modal:false,cyclic:false,scrolling:"auto",width:560,height:340,autoScale:true,autoDimensions:true,centerOnScroll:false,ajax:{},swf:{wmode:"transparent"},hideOnOverlayClick:true,hideOnContentClick:false,overlayShow:true,overlayOpacity:0.7,overlayColor:"#777",titleShow:true,titlePosition:"float",titleFormat:null,titleFromAlt:false,transitionIn:"fade",transitionOut:"fade",speedIn:300,speedOut:300,changeSpeed:300,changeFade:"fast",easingIn:"swing",
easingOut:"swing",showCloseButton:true,showNavArrows:true,enableEscapeButton:true,enableKeyboardNav:true,onStart:function(){},onCancel:function(){},onComplete:function(){},onCleanup:function(){},onClosed:function(){},onError:function(){}};b(document).ready(function(){b.fancybox.init()})})(jQuery);









/*! Copyright (c) 2010 Brandon Aaron (http://brandonaaron.net)
* Licensed under the MIT License (LICENSE.txt).
*
* Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
* Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
* Thanks to: Seamus Leahy for adding deltaX and deltaY
*
* Version: 3.0.4
*
* Requires: 1.2.2+
*/

(function(d){function g(a){var b=a||window.event,i=[].slice.call(arguments,1),c=0,h=0,e=0;a=d.event.fix(b);a.type="mousewheel";if(a.wheelDelta)c=a.wheelDelta/120;if(a.detail)c=-a.detail/3;e=c;if(b.axis!==undefined&&b.axis===b.HORIZONTAL_AXIS){e=0;h=-1*c}if(b.wheelDeltaY!==undefined)e=b.wheelDeltaY/120;if(b.wheelDeltaX!==undefined)h=-1*b.wheelDeltaX/120;i.unshift(a,c,h,e);return d.event.handle.apply(this,i)}var f=["DOMMouseScroll","mousewheel"];d.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=
f.length;a;)this.addEventListener(f[--a],g,false);else this.onmousewheel=g},teardown:function(){if(this.removeEventListener)for(var a=f.length;a;)this.removeEventListener(f[--a],g,false);else this.onmousewheel=null}};d.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery);









// Popup Options

$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$(".fancypicture").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9	
			});

			$("afancygalleria").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/
			
			$(".fancyvideo").fancybox({
				'width'				: '75%',
				'height'			: '50%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9,
				'type'				: 'iframe'
			});
			
			$(".fancylink").fancybox({
				'width'				: '100%',
				'height'			: '100%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9,
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
		});

//Sponsor Flip

$(document).ready(function(){
	/* The following code is executed once the DOM is loaded */
	
	$('.sponsorFlip').bind("click",function(){
		
		// $(this) point to the clicked .sponsorFlip element (caching it in elem for speed):
		
		var elem = $(this);
		
		// data('flipped') is a flag we set when we flip the element:
		
		if(elem.data('flipped'))
		{
			// If the element has already been flipped, use the revertFlip method
			// defined by the plug-in to revert to the default state automatically:
			
			elem.revertFlip();
			
			// Unsetting the flag:
			elem.data('flipped',false)
		}
		else
		{
			// Using the flip method defined by the plugin:
			
			elem.flip({
				direction:'lr',
				speed: 350,
				onBefore: function(){
					// Insert the contents of the .sponsorData div (hidden from view with display:none)
					// into the clicked .sponsorFlip div before the flipping animation starts:
					
					elem.html(elem.siblings('.sponsorData').html());
				}
			});
			
			// Setting the flag:
			elem.data('flipped',true);
		}
	});
	
});

eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(5($){5 H(a){a.1D.1f[a.1E]=1F(a.1G,10)+a.1H}6 j=5(a){1I({1J:"1g.Z.1K 1L 1M",1N:a})};6 k=5(){7(/*@1O!@*/11&&(1P 1Q.1h.1f.1R==="1S"))};6 l={1T:[0,4,4],1U:[1i,4,4],1V:[1j,1j,1W],1X:[0,0,0],1Y:[0,0,4],1Z:[1k,1l,1l],20:[0,4,4],21:[0,0,A],22:[0,A,A],23:[12,12,12],24:[0,13,0],26:[27,28,1m],29:[A,0,A],2a:[2b,1m,2c],2d:[4,1n,0],2e:[2f,2g,2h],2i:[A,0,0],2j:[2k,2l,2m],2n:[2o,0,R],2p:[4,0,4],2q:[4,2r,0],2s:[0,t,0],2t:[2u,0,2v],2w:[1i,1o,1n],2x:[2y,2z,1o],2A:[1p,4,4],2B:[1q,2C,1q],2D:[R,R,R],2E:[4,2F,2G],2H:[4,4,1p],2I:[0,4,0],2J:[4,0,4],2K:[t,0,0],2L:[0,0,t],2M:[t,t,0],2N:[4,1k,0],2O:[4,S,2P],2Q:[t,0,t],2R:[t,0,t],2S:[4,0,0],2T:[S,S,S],2U:[4,4,4],2V:[4,4,0],9:[4,4,4]};6 m=5(a){T(a&&a.1r("#")==-1&&a.1r("(")==-1){7"2W("+l[a].2X()+")"}2Y{7 a}};$.2Z($.30.31,{u:H,v:H,w:H,x:H});$.1s.32=5(){7 U.1t(5(){6 a=$(U);a.Z(a.B(\'1u\'))})};$.1s.Z=5(i){7 U.1t(5(){6 c=$(U),3,$8,C,14,15,16=k();T(c.B(\'V\')){7 11}6 e={I:(5(a){33(a){W"X":7"Y";W"Y":7"X";W"17":7"18";W"18":7"17";34:7"Y"}})(i.I),y:m(i.D)||"#E",D:m(i.y)||c.z("19-D"),1v:c.J(),F:i.F||1w,K:i.K||5(){},L:i.L||5(){},M:i.M||5(){}};c.B(\'1u\',e).B(\'V\',1).B(\'35\',e);3={s:c.s(),n:c.n(),y:m(i.y)||c.z("19-D"),1x:c.z("36-37")||"38",I:i.I||"X",G:m(i.D)||"#E",F:i.F||1w,o:c.1y().o,p:c.1y().p,1z:i.1v||39,9:"9",1a:i.1a||11,K:i.K||5(){},L:i.L||5(){},M:i.M||5(){}};16&&(3.9="#3a");$8=c.z("1b","3b").8(3c).B(\'V\',1).3d("1h").J("").z({1b:"1A",3e:"3f",p:3.p,o:3.o,3g:0,3h:3i});6 f=5(){7{1B:3.9,1x:0,3j:0,u:0,w:0,x:0,v:0,N:3.9,O:3.9,P:3.9,Q:3.9,19:"3k",3l:\'3m\',n:0,s:0}};6 g=5(){6 a=(3.n/13)*25;6 b=f();b.s=3.s;7{"q":b,"1c":{u:0,w:a,x:a,v:0,N:\'#E\',O:\'#E\',o:(3.o+(3.n/2)),p:(3.p-a)},"r":{v:0,u:0,w:0,x:0,N:3.9,O:3.9,o:3.o,p:3.p}}};6 h=5(){6 a=(3.n/13)*25;6 b=f();b.n=3.n;7{"q":b,"1c":{u:a,w:0,x:0,v:a,P:\'#E\',Q:\'#E\',o:3.o-a,p:3.p+(3.s/2)},"r":{u:0,w:0,x:0,v:0,P:3.9,Q:3.9,o:3.o,p:3.p}}};14={"X":5(){6 d=g();d.q.u=3.n;d.q.N=3.y;d.r.v=3.n;d.r.O=3.G;7 d},"Y":5(){6 d=g();d.q.v=3.n;d.q.O=3.y;d.r.u=3.n;d.r.N=3.G;7 d},"17":5(){6 d=h();d.q.w=3.s;d.q.P=3.y;d.r.x=3.s;d.r.Q=3.G;7 d},"18":5(){6 d=h();d.q.x=3.s;d.q.Q=3.y;d.r.w=3.s;d.r.P=3.G;7 d}};C=14[3.I]();16&&(C.q.3n="3o(D="+3.9+")");15=5(){6 a=3.1z;7 a&&a.1g?a.J():a};$8.1d(5(){3.K($8,c);$8.J(\'\').z(C.q);$8.1e()});$8.1C(C.1c,3.F);$8.1d(5(){3.M($8,c);$8.1e()});$8.1C(C.r,3.F);$8.1d(5(){T(!3.1a){c.z({1B:3.G})}c.z({1b:"1A"});6 a=15();T(a){c.J(a)}$8.3p();3.L($8,c);c.3q(\'V\');$8.1e()})})}})(3r);',62,214,'|||flipObj|255|function|var|return|clone|transparent||||||||||||||height|top|left|start|second|width|128|borderTopWidth|borderBottomWidth|borderLeftWidth|borderRightWidth|bgColor|css|139|data|dirOption|color|999|speed|toColor|int_prop|direction|html|onBefore|onEnd|onAnimation|borderTopColor|borderBottomColor|borderLeftColor|borderRightColor|211|192|if|this|flipLock|case|tb|bt|flip||false|169|100|dirOptions|newContent|ie6|lr|rl|background|dontChangeColor|visibility|first|queue|dequeue|style|jquery|body|240|245|165|42|107|140|230|224|144|indexOf|fn|each|flipRevertedSettings|content|500|fontSize|offset|target|visible|backgroundColor|animate|elem|prop|parseInt|now|unit|throw|name|js|plugin|error|message|cc_on|typeof|document|maxHeight|undefined|aqua|azure|beige|220|black|blue|brown|cyan|darkblue|darkcyan|darkgrey|darkgreen||darkkhaki|189|183|darkmagenta|darkolivegreen|85|47|darkorange|darkorchid|153|50|204|darkred|darksalmon|233|150|122|darkviolet|148|fuchsia|gold|215|green|indigo|75|130|khaki|lightblue|173|216|lightcyan|lightgreen|238|lightgrey|lightpink|182|193|lightyellow|lime|magenta|maroon|navy|olive|orange|pink|203|purple|violet|red|silver|white|yellow|rgb|toString|else|extend|fx|step|revertFlip|switch|default|flipSettings|font|size|12px|null|123456|hidden|true|appendTo|position|absolute|margin|zIndex|9999|lineHeight|none|borderStyle|solid|filter|chroma|remove|removeData|jQuery'.split('|'),0,{}))



/* Modernizr 2.0.6 (Custom Build) | MIT & BSD
 * Build: http://www.modernizr.com/download/#-cssanimations-iepp-cssclasses-testprop-testallprops-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function A(a,b){var c=a.charAt(0).toUpperCase()+a.substr(1),d=(a+" "+n.join(c+" ")+c).split(" ");return z(d,b)}function z(a,b){for(var d in a)if(k[a[d]]!==c)return b=="pfx"?a[d]:!0;return!1}function y(a,b){return!!~(""+a).indexOf(b)}function x(a,b){return typeof a===b}function w(a,b){return v(prefixes.join(a+";")+(b||""))}function v(a){k.cssText=a}var d="2.0.6",e={},f=!0,g=b.documentElement,h=b.head||b.getElementsByTagName("head")[0],i="modernizr",j=b.createElement(i),k=j.style,l,m=Object.prototype.toString,n="Webkit Moz O ms Khtml".split(" "),o={},p={},q={},r=[],s,t={}.hasOwnProperty,u;!x(t,c)&&!x(t.call,c)?u=function(a,b){return t.call(a,b)}:u=function(a,b){return b in a&&x(a.constructor.prototype[b],c)},o.cssanimations=function(){return A("animationName")};for(var B in o)u(o,B)&&(s=B.toLowerCase(),e[s]=o[B](),r.push((e[s]?"":"no-")+s));v(""),j=l=null,a.attachEvent&&function(){var a=b.createElement("div");a.innerHTML="<elem></elem>";return a.childNodes.length!==1}()&&function(a,b){function s(a){var b=-1;while(++b<g)a.createElement(f[b])}a.iepp=a.iepp||{};var d=a.iepp,e=d.html5elements||"abbr|article|aside|audio|canvas|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",f=e.split("|"),g=f.length,h=new RegExp("(^|\\s)("+e+")","gi"),i=new RegExp("<(/*)("+e+")","gi"),j=/^\s*[\{\}]\s*$/,k=new RegExp("(^|[^\\n]*?\\s)("+e+")([^\\n]*)({[\\n\\w\\W]*?})","gi"),l=b.createDocumentFragment(),m=b.documentElement,n=m.firstChild,o=b.createElement("body"),p=b.createElement("style"),q=/print|all/,r;d.getCSS=function(a,b){if(a+""===c)return"";var e=-1,f=a.length,g,h=[];while(++e<f){g=a[e];if(g.disabled)continue;b=g.media||b,q.test(b)&&h.push(d.getCSS(g.imports,b),g.cssText),b="all"}return h.join("")},d.parseCSS=function(a){var b=[],c;while((c=k.exec(a))!=null)b.push(((j.exec(c[1])?"\n":c[1])+c[2]+c[3]).replace(h,"$1.iepp_$2")+c[4]);return b.join("\n")},d.writeHTML=function(){var a=-1;r=r||b.body;while(++a<g){var c=b.getElementsByTagName(f[a]),d=c.length,e=-1;while(++e<d)c[e].className.indexOf("iepp_")<0&&(c[e].className+=" iepp_"+f[a])}l.appendChild(r),m.appendChild(o),o.className=r.className,o.id=r.id,o.innerHTML=r.innerHTML.replace(i,"<$1font")},d._beforePrint=function(){p.styleSheet.cssText=d.parseCSS(d.getCSS(b.styleSheets,"all")),d.writeHTML()},d.restoreHTML=function(){o.innerHTML="",m.removeChild(o),m.appendChild(r)},d._afterPrint=function(){d.restoreHTML(),p.styleSheet.cssText=""},s(b),s(l);d.disablePP||(n.insertBefore(p,n.firstChild),p.media="print",p.className="iepp-printshim",a.attachEvent("onbeforeprint",d._beforePrint),a.attachEvent("onafterprint",d._afterPrint))}(a,b),e._version=d,e._domPrefixes=n,e.testProp=function(a){return z([a])},e.testAllProps=A,g.className=g.className.replace(/\bno-js\b/,"")+(f?" js "+r.join(" "):"");return e}(this,this.document),function(a,b,c){function k(a){return!a||a=="loaded"||a=="complete"}function j(){var a=1,b=-1;while(p.length- ++b)if(p[b].s&&!(a=p[b].r))break;a&&g()}function i(a){var c=b.createElement("script"),d;c.src=a.s,c.onreadystatechange=c.onload=function(){!d&&k(c.readyState)&&(d=1,j(),c.onload=c.onreadystatechange=null)},m(function(){d||(d=1,j())},H.errorTimeout),a.e?c.onload():n.parentNode.insertBefore(c,n)}function h(a){var c=b.createElement("link"),d;c.href=a.s,c.rel="stylesheet",c.type="text/css";if(!a.e&&(w||r)){var e=function(a){m(function(){if(!d)try{a.sheet.cssRules.length?(d=1,j()):e(a)}catch(b){b.code==1e3||b.message=="security"||b.message=="denied"?(d=1,m(function(){j()},0)):e(a)}},0)};e(c)}else c.onload=function(){d||(d=1,m(function(){j()},0))},a.e&&c.onload();m(function(){d||(d=1,j())},H.errorTimeout),!a.e&&n.parentNode.insertBefore(c,n)}function g(){var a=p.shift();q=1,a?a.t?m(function(){a.t=="c"?h(a):i(a)},0):(a(),j()):q=0}function f(a,c,d,e,f,h){function i(){!o&&k(l.readyState)&&(r.r=o=1,!q&&j(),l.onload=l.onreadystatechange=null,m(function(){u.removeChild(l)},0))}var l=b.createElement(a),o=0,r={t:d,s:c,e:h};l.src=l.data=c,!s&&(l.style.display="none"),l.width=l.height="0",a!="object"&&(l.type=d),l.onload=l.onreadystatechange=i,a=="img"?l.onerror=i:a=="script"&&(l.onerror=function(){r.e=r.r=1,g()}),p.splice(e,0,r),u.insertBefore(l,s?null:n),m(function(){o||(u.removeChild(l),r.r=r.e=o=1,j())},H.errorTimeout)}function e(a,b,c){var d=b=="c"?z:y;q=0,b=b||"j",C(a)?f(d,a,b,this.i++,l,c):(p.splice(this.i++,0,a),p.length==1&&g());return this}function d(){var a=H;a.loader={load:e,i:0};return a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=r&&!s,u=s?l:n.parentNode,v=a.opera&&o.call(a.opera)=="[object Opera]",w="webkitAppearance"in l.style,x=w&&"async"in b.createElement("script"),y=r?"object":v||x?"img":"script",z=w?"img":y,A=Array.isArray||function(a){return o.call(a)=="[object Array]"},B=function(a){return Object(a)===a},C=function(a){return typeof a=="string"},D=function(a){return o.call(a)=="[object Function]"},E=[],F={},G,H;H=function(a){function f(a){var b=a.split("!"),c=E.length,d=b.pop(),e=b.length,f={url:d,origUrl:d,prefixes:b},g,h;for(h=0;h<e;h++)g=F[b[h]],g&&(f=g(f));for(h=0;h<c;h++)f=E[h](f);return f}function e(a,b,e,g,h){var i=f(a),j=i.autoCallback;if(!i.bypass){b&&(b=D(b)?b:b[a]||b[g]||b[a.split("/").pop().split("?")[0]]);if(i.instead)return i.instead(a,b,e,g,h);e.load(i.url,i.forceCSS||!i.forceJS&&/css$/.test(i.url)?"c":c,i.noexec),(D(b)||D(j))&&e.load(function(){d(),b&&b(i.origUrl,h,g),j&&j(i.origUrl,h,g)})}}function b(a,b){function c(a){if(C(a))e(a,h,b,0,d);else if(B(a))for(i in a)a.hasOwnProperty(i)&&e(a[i],h,b,i,d)}var d=!!a.test,f=d?a.yep:a.nope,g=a.load||a.both,h=a.callback,i;c(f),c(g),a.complete&&b.load(a.complete)}var g,h,i=this.yepnope.loader;if(C(a))e(a,0,i,0);else if(A(a))for(g=0;g<a.length;g++)h=a[g],C(h)?e(h,0,i,0):A(h)?H(h):B(h)&&b(h,i);else B(a)&&b(a,i)},H.addPrefix=function(a,b){F[a]=b},H.addFilter=function(a){E.push(a)},H.errorTimeout=1e4,b.readyState==null&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",G=function(){b.removeEventListener("DOMContentLoaded",G,0),b.readyState="complete"},0)),a.yepnope=d()}(this,this.document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
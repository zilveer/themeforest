
/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */
(function(e){e.fn.superfish=function(t){var n=e.fn.superfish,r=n.c,i=e(['<span class="',r.arrowClass,'"> &#187;</span>'].join("")),s=function(){var t=e(this),n=u(t);clearTimeout(n.sfTimer);t.showSuperfishUl().siblings().hideSuperfishUl()},o=function(){var t=e(this),r=u(t),i=n.op;clearTimeout(r.sfTimer);r.sfTimer=setTimeout(function(){i.retainPath=e.inArray(t[0],i.$path)>-1;t.hideSuperfishUl();if(i.$path.length&&t.parents(["li.",i.hoverClass].join("")).length<1){s.call(i.$path)}},i.delay)},u=function(e){var t=e.parents(["ul.",r.menuClass,":first"].join(""))[0];n.op=n.o[t.serial];return t},a=function(e){e.addClass(r.anchorClass).append(i.clone())};return this.each(function(){var i=this.serial=n.o.length;var u=e.extend({},n.defaults,t);u.$path=e("li."+u.pathClass,this).slice(0,u.pathLevels).each(function(){e(this).addClass([u.hoverClass,r.bcClass].join(" ")).filter("li:has(ul)").removeClass(u.pathClass)});n.o[i]=n.op=u;e("li:has(ul)",this)[e.fn.hoverIntent&&!u.disableHI?"hoverIntent":"hover"](s,o).each(function(){if(u.autoArrows)a(e(">a:first-child",this))}).not("."+r.bcClass).hideSuperfishUl();var f=e("a",this);f.each(function(e){var t=f.eq(e).parents("li");f.eq(e).focus(function(){s.call(t)}).blur(function(){o.call(t)})});u.onInit.call(this)}).each(function(){var t=[r.menuClass];if(n.op.dropShadows&&!(e.browser.msie&&e.browser.version<7))t.push(r.shadowClass);e(this).addClass(t.join(" "))})};var t=e.fn.superfish;t.o=[];t.op={};t.IE7fix=function(){var n=t.op;if(e.browser.msie&&e.browser.version>6&&n.dropShadows&&n.animation.opacity!=undefined)this.toggleClass(t.c.shadowClass+"-off")};t.c={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",arrowClass:"sf-sub-indicator",shadowClass:"sf-shadow"};t.defaults={hoverClass:"sfHover",pathClass:"overideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},speed:"normal",autoArrows:true,dropShadows:true,disableHI:false,onInit:function(){},onBeforeShow:function(){},onShow:function(){},onHide:function(){}};e.fn.extend({hideSuperfishUl:function(){var n=t.op,r=n.retainPath===true?n.$path:"";n.retainPath=false;var i=e(["li.",n.hoverClass].join(""),this).add(this).not(r).removeClass(n.hoverClass).find(">ul").hide();n.onHide.call(i);return this},showSuperfishUl:function(){var e=t.op,n=t.c.shadowClass+"-off",r=this.addClass(e.hoverClass).find(">ul:hidden");t.IE7fix.call(r);e.onBeforeShow.call(r);r.animate(e.animation,e.speed,function(){t.IE7fix.call(r);e.onShow.call(r)});return this}})})(jQuery);
/**
 * jQuery Mobile Menu 
 * Turn unordered list menu into dropdown select menu
 * version 1.0(31-OCT-2011)
 * 
 * Built on top of the jQuery library
 *   http://jquery.com
 * 
 * Documentation
 * 	 http://github.com/mambows/mobilemenu
 */
(function(e){e.fn.mobileMenu=function(t){var n={defaultText:"Navigate to...",className:"select-menu",subMenuClass:"sub-menu",subMenuDash:"&ndash;"},r=e.extend(n,t),i=e(this);this.each(function(){i.find("ul").addClass(r.subMenuClass);e("<select />",{"class":r.className}).insertAfter(i);e("<option />",{value:"#",text:r.defaultText}).appendTo("."+r.className);i.find("a").each(function(){if(e(this).attr("href")=="javascript:void(0);")return;var t=e(this),n="&nbsp;"+t.text(),i=t.parents("."+r.subMenuClass),s=i.length,o;if(t.parents("ul").hasClass(r.subMenuClass)){o=Array(s+1).join(r.subMenuDash);n=o+n}e("<option />",{value:this.href,html:n,selected:this.href==window.location.href}).appendTo("."+r.className)});e("."+r.className).change(function(){var t=e(this).val();if(t!=="#"){window.location.href=e(this).val()}})});return this}})(jQuery)
jQuery(document).ready(function($){
	
	$("#navigation ul.menu").superfish({
		delay:       500,
		animation:   {opacity:'show'},
		speed:       200,
        autoArrows:  false, 
        dropShadows: false,
        onInit: function() {$('#navigation ul.menu > li.megamenu > ul.sub-menu').css({'visibility':'visible'})}
	});
	
	$("#topnav.menu").superfish({
		delay:       250,
		animation:   {opacity:'hide'},
		speed:       100,
        autoArrows:  false, 
        dropShadows: false
	});

	$(".sidenav-static #side-nav.menu").superfish({
		delay:       900
	});

	$('#navigation ul.menu > li').mouseleave(function(){
		if(!$(this).hasClass('megamenu')){
			$(this).find('> ul').stop(true,true).fadeOut();
		}
	});

	$('#header:not(.fixed_header) #navigation ul.menu').mobileMenu({
		defaultText: 'Navigation',
		className: 'select-menu',
		subMenuDash: '&ndash;'
	});
});


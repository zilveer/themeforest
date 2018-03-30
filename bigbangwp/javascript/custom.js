var root_path_url = "http";
jQuery(document).ready(function($) { 
	root_path_url = $('link[rel="start"]').attr("href") + "/";
});

function is_touch_device() {
  return !!('ontouchstart' in window);
}




/*--------------------------------------------------
		  DROPDOWN MENU
---------------------------------------------------*/
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

(function($){$.fn.superfish=function(op){var sf=$.fn.superfish,c=sf.c,$arrow=$(['<span class="',c.arrowClass,'"> &#187;</span>'].join("")),over=function(){var $$=$(this),menu=getMenu($$);clearTimeout(menu.sfTimer);$$.showSuperfishUl().siblings().hideSuperfishUl();},out=function(){var $$=$(this),menu=getMenu($$),o=sf.op;clearTimeout(menu.sfTimer);menu.sfTimer=setTimeout(function(){o.retainPath=($.inArray($$[0],o.$path)>-1);$$.hideSuperfishUl();if(o.$path.length&&$$.parents(["li.",o.hoverClass].join("")).length<1){over.call(o.$path);}},o.delay);},getMenu=function($menu){var menu=$menu.parents(["ul.",c.menuClass,":first"].join(""))[0];sf.op=sf.o[menu.serial];return menu;},addArrow=function($a){$a.addClass(c.anchorClass).append($arrow.clone());};return this.each(function(){var s=this.serial=sf.o.length;var o=$.extend({},sf.defaults,op);o.$path=$("li."+o.pathClass,this).slice(0,o.pathLevels).each(function(){$(this).addClass([o.hoverClass,c.bcClass].join(" ")).filter("li:has(ul)").removeClass(o.pathClass);});sf.o[s]=sf.op=o;$("li:has(ul)",this)[($.fn.hoverIntent&&!o.disableHI)?"hoverIntent":"hover"](over,out).each(function(){if(o.autoArrows){addArrow($(">a:first-child",this));}}).not("."+c.bcClass).hideSuperfishUl();var $a=$("a",this);$a.each(function(i){var $li=$a.eq(i).parents("li");$a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});});o.onInit.call(this);}).each(function(){var menuClasses=[c.menuClass];if(sf.op.dropShadows&&!($.browser.msie&&$.browser.version<7)){menuClasses.push(c.shadowClass);}$(this).addClass(menuClasses.join(" "));});};var sf=$.fn.superfish;sf.o=[];sf.op={};sf.IE7fix=function(){var o=sf.op;if($.browser.msie&&$.browser.version>6&&o.dropShadows&&o.animation.opacity!=undefined){this.toggleClass(sf.c.shadowClass+"-off");}};sf.c={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",arrowClass:"sf-sub-indicator",shadowClass:"sf-shadow"};sf.defaults={hoverClass:"sfHover",pathClass:"overideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},speed:"normal",autoArrows:true,dropShadows:true,disableHI:false,onInit:function(){},onBeforeShow:function(){},onShow:function(){},onHide:function(){}};$.fn.extend({hideSuperfishUl:function(){var o=sf.op,not=(o.retainPath===true)?o.$path:"";o.retainPath=false;var $ul=$(["li.",o.hoverClass].join(""),this).add(this).not(not).removeClass(o.hoverClass).find(">ul").hide().css("visibility","hidden");o.onHide.call($ul);return this;},showSuperfishUl:function(){var o=sf.op,sh=sf.c.shadowClass+"-off",$ul=this.addClass(o.hoverClass).find(">ul:hidden").css("visibility","visible");sf.IE7fix.call($ul);o.onBeforeShow.call($ul);$ul.animate(o.animation,o.speed,function(){sf.IE7fix.call($ul);o.onShow.call($ul);});return this;}});})(jQuery);

/*--------------------------------------------------
	     ADDITIONAL CODE FOR DROPDOWN MENU
---------------------------------------------------*/
    jQuery(document).ready(function($) { 
        $('ul.menu').superfish({ 
            delay:       100,                            // one second delay on mouseout 
            animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
            speed:       'fast',                          // faster animation speed 
            autoArrows:  false                           // disable generation of arrow mark-up 
        });
		
	}); 





/***************************************************
	     TOGGLE STYLE
***************************************************/
jQuery(document).ready(function($) {
								
	$(".toggle-container").hide(); 
	$(".trigger").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});
	$(".trigger").click(function(){
		$(this).next(".toggle-container").slideToggle();
	});
});

/***************************************************
	     ACCORDION
***************************************************/
jQuery(document).ready(function($){	
	$('.trigger-button').click(function() {
		$(".trigger-button").removeClass("active")
	 	$('.accordion').slideUp('normal');
		if($(this).next().is(':hidden') == true) {
			$(this).next().slideDown('normal');
			$(this).addClass("active");
		 } 
	 });
	$('.accordion').hide();
});

/***************************************************
	  			SLIDING GRAPH
***************************************************/
(function($){
    $.fn.extend({
        //plugin name - animatemenu
        bra_sliding_graph: function(options) {
 
            var defaults = {
                speed: 1000
           };
            
			    function isScrolledIntoView(id){
					var elem = "#" + id;
					var docViewTop = $(window).scrollTop();
					var docViewBottom = docViewTop + $(window).height();
				
					if ($(elem).length > 0){
						var elemTop = $(elem).offset().top;
						var elemBottom = elemTop + $(elem).height();
					}
			
					return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom)
					  && (elemBottom <= docViewBottom) &&  (elemTop >= docViewTop) );
				}
			
				
				
				function sliding_horizontal_graph(id, speed){
					//alert(id);
					$("#" + id + " li span").each(function(i){
						var j = i + 1; 										  
						var cur_li = $("#" + id + " li:nth-child(" + j + ") span");
						var w = cur_li.attr("class");
						cur_li.animate({width: w + "%"}, speed);
					})
				}
				
				function graph_init(id, speed){
					$(window).scroll(function(){
						if (isScrolledIntoView(id)){
							sliding_horizontal_graph(id, speed);
						}
						else{
							//$("#" + id + " li span").css("width", "0");
						}
					})
					
					if (isScrolledIntoView(id)){
						sliding_horizontal_graph(id, speed);
					}
				}		

            var options = $.extend(defaults, options);
         
            return this.each(function() {
                  var o = options;
                  var obj = $(this); 
				  graph_init(obj.attr("id"), o.speed);

				  
            }); // return this.each
        }
    });
})(jQuery);

/*--------------------------------------------------
	     ADDITIONAL CODE GRID LIST
---------------------------------------------------*/
(function($){
    $.fn.extend({
        bra_last_last_row: function() {
            return this.each(function() {
			  		$(this).each(function(){
						var no_of_items = $(this).find("li").length;
						var no_of_cols = Math.round($(this).width() / $(this).find(":first").width() );
						var no_of_rows = Math.ceil(no_of_items / no_of_cols);
						var last_row_start = (no_of_rows - 1) * no_of_cols - 1;	
						if (last_row_start < (no_of_cols - 1)) {
							last_row_start = 0;
							$(this).find("li:eq(" + last_row_start + ")").addClass("last-row");
						}
						$(this).find("li:nth-child(" + no_of_cols + "n+ " + no_of_cols + ")").addClass("last");
						$(this).find("li:gt(" + last_row_start + ")").addClass("last-row");
						
						
						
					}) 
            }); // return this.each
        }
    });
})(jQuery);

jQuery(document).ready(function($) {
	$('.grid.clients').each(function(){
		$(this).find('li > *').each(function(){
			var this_href = $(this).attr('href');
			var this_target = $(this).attr('target');
			if (this_target == undefined) this_target = '';
			var this_class = $(this).attr('class');
			if (this_class == "no_lightbox"){
				$(this).parents(".grid.clients").append('<li><a href="' + this_href + '" target="' + this_target + '">' + $(this).html() + '</a></li>');
			} else {
				$(this).parents(".grid.clients").append('<li><a rel="prettyPhoto[]" href="' + this_href + '" target="' + this_target + '">' + $(this).html() + '</a></li>'); }
		})
		$(this).find('li:first').remove();
		//$(this).find('img').removeAttr("height");
		
		  // additional code if images aren't with same dimensions
/*		  var li_max = 0;	
		  $(this).find("li").each(function(){
			  var li_h = $(this).height();
			  if (li_h > li_max) li_max = li_h;							 
		  })
		  if (li_max == 0) {
			  $(this).find("li").css("height", "auto");
		  } else {
			  $(this).find("li").css("height", li_max + "px");
		  }
		  
		  $(this).find("li").each(function(){
			  var li_h = $(this).height();
			  var img_h = $(this).find("img").height();
			  if (img_h < li_h) {
				  var top_margin = parseInt((li_h - img_h) / 2)
				  $(this).find("img").css("margin-top", top_margin + "px")
			  }
		  })*/
		  // end of additional code
		 
	})
	
	$('.grid').bra_last_last_row();
})

/***************************************************
	  SELECT MENU ON SMALL DEVICES
***************************************************/
jQuery(document).ready(function($){
								
	var $menu_select = $("<select />");	
	$("<option />", {"selected": "selected", "value": "", "text": "Site Navigation"}).appendTo($menu_select);
	$menu_select.appendTo("#primary-menu");
	
	$("#primary-menu ul li a").each(function(){
		var menu_url = $(this).attr("href");
		var menu_text = $(this).text();
		if ($(this).parents("li").length == 2) { menu_text = '- ' + menu_text; }
		if ($(this).parents("li").length == 3) { menu_text = "-- " + menu_text; }
		if ($(this).parents("li").length > 3) { menu_text = "--- " + menu_text; }
		$("<option />", {"value": menu_url, "text": menu_text}).appendTo($menu_select)
	})
	
	field_id = "#primary-menu select";
	$(field_id).change(function()
	{
	   value = $(this).attr('value');
	   window.location = value;
		//go
		
	});
})



/***************************************************
	  WORDPRESS RELATED
***************************************************/
function javascript_excerpt(string, no_of_words){
	var excerpt = "";
	var string_array = new Array();
	string_array = string.split(" ");
	for (i = 0 ; i < no_of_words ; i++){
		excerpt += string_array[i] + " ";
	}
	return excerpt + "...";
}

jQuery(document).ready(function($){
	//adding class to A element of current LI
	$("li.current-menu-ancestor a:first, li.current-menu-item a:first").addClass("current");
	$("ul li.current-menu-item a.current").parent("li").addClass("current");
	
	// icon boxes fix for 3 icons
/*		$("ul.grid.row4.services").removeClass("row4").addClass("row3");
		$("ul.grid.row3.services li:last").remove();
		$("ul.grid.row3.services li:last").addClass("last");*/
		
	// icon boxes fix for 5 icons
/*		$("ul.grid.row4.services").removeClass("row4").addClass("row5");
		$("ul.grid.row5.services li:last").remove();
		$("ul.grid.row5.services li:last").addClass("last");*/


	$("ul#portfolio-nav span:last").remove();
	
	var cols_temp = 0;
	var i = 0;
	$(".team").each(function(){
		i++;
		$(this).find(".social-personal span:last").remove();
		
		if ($(this).hasClass("one-fourth")) cols = 4;
		if ($(this).hasClass("one-third")) cols = 3;
		if ($(this).hasClass("one-half")) cols = 2;
		if (cols_temp != cols) i = 1;
		//remainder = i % cols
		if (i % cols == 0) $(this).addClass("last");
		cols_temp = cols;
	})
})
jQuery(document).ready(function($){
	// next prev portfolio items links
	$("ul.item-nav li a").each(function(){
		var title = $(this).html();
		$(this).attr("title", title);
	})
})

jQuery(document).ready(function($) {
//removing image if there is empty SRC
$("img").each(function(){
if ($(this).attr("src") == "") {
	$(this).parents(".post-media").remove();
}
})

$(".blog5 .post").each(function(){
if ($(this).find(".post-media").length == 0) {
	$(this).find(".post-info").css("margin-top", "0px");
}
if ($(this).find(".post-media iframe").length > 0) {
	$(this).find(".post-media iframe").parent(".post-media").css("float", "none");
}

})

//remove .post-media if there is no featured image (or video)
if ($(".post-media img").size() == 0 && $(".post-media iframe").size() == 0) {
	$(".post-media").remove()
}

//remove height attribute from images on single posts
$(".single-post .content-wrapper img").removeAttr("height");
});

/***************************************************
	  Check path
***************************************************/

jQuery(document).ready(function($){
	
	$('.check_path').each(function(){
		var icon_path = $(this).attr("src");
		if (icon_path.substr(0, 10) == "wp-content") {
			$(this).attr("src", root_path_url + ""+ icon_path);
		}
	});
});





/*
 SelectNav.js (v. 0.1)
 Converts your <ul>/<ol> navigation into a dropdown list for small screens
 https://github.com/lukaszfiszer/selectnav.js
 */
window.selectnav = function(){return function(p, q){var a, h = function(b){var c; b || (b = window.event); b.target?c = b.target:b.srcElement && (c = b.srcElement); 3 === c.nodeType && (c = c.parentNode); c.value && (window.location.href = c.value)}, k = function(b){b = b.nodeName.toLowerCase(); return"ul" === b || "ol" === b}, l = function(b){for (var c = 1; document.getElementById("selectnav" + c); c++); return b?"selectnav" + c:"selectnav" + (c - 1)}, n = function(b){g++; var c = b.children.length, a = "", d = "", f = g - 1; if (c){if (f){for (; f--; )d += r; d += " "}for (f = 0; f <
        c; f++){var e = b.children[f].children[0]; if ("undefined" !== typeof e){var h = e.innerText || e.textContent, i = ""; j && (i = - 1 !== e.className.search(j) || - 1 !== e.parentElement.className.search(j)?m:""); s && !i && (i = e.href === document.URL?m:""); a += '<option value="' + e.href + '" ' + i + ">" + d + h + "</option>"; t && (e = b.children[f].children[1]) && k(e) && (a += n(e))}}1 === g && o && (a = '<option value="">' + o + "</option>" + a); 1 === g && (a = '<select class="selectnav" id="' + l(!0) + '">' + a + "</select>"); g--; return a}}; if ((a = document.getElementById(p)) && k(a)){document.documentElement.className +=
        " js"; var d = q || {}, j = d.activeclass || "active", s = "boolean" === typeof d.autoselect?d.autoselect:!0, t = "boolean" === typeof d.nested?d.nested:!0, r = d.indent || "\u2192", o = d.label || "- Navigation -", g = 0, m = " selected "; a.insertAdjacentHTML("afterend", n(a)); a = document.getElementById(l()); a.addEventListener && a.addEventListener("change", h); a.attachEvent && a.attachEvent("onchange", h)}}}();
        jQuery(document).ready(function(){

jQuery('p').each(function() {
var $this = $(this);
        if ($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.remove();
        });
        jQuery('audio,video').mediaelementplayer();
        jQuery("#stickyarea").hide();
        selectnav('menus', {
        label: 'Menu',
                nested: true,
                indent: '-'
        });
        if (jQuery("body").length != ''){
jQuery("body").fitVids();
        }
});
// JQuery Easing Plugin 1.3
        jQuery.easing.jswing = jQuery.easing.swing, jQuery.extend(jQuery.easing, {def:"easeOutQuad", swing:function(a, b, c, d, e){return jQuery.easing[jQuery.easing.def](a, b, c, d, e)}, easeInQuad:function(a, b, c, d, e){return d * (b /= e) * b + c}, easeOutQuad:function(a, b, c, d, e){return - d * (b /= e) * (b - 2) + c}, easeInOutQuad:function(a, b, c, d, e){return(b /= e / 2) < 1?d / 2 * b * b + c: - d / 2 * (--b * (b - 2) - 1) + c}, easeInCubic:function(a, b, c, d, e){return d * (b /= e) * b * b + c}, easeOutCubic:function(a, b, c, d, e){return d * ((b = b / e - 1) * b * b + 1) + c}, easeInOutCubic:function(a, b, c, d, e){return(b /= e / 2) < 1?d / 2 * b * b * b + c:d / 2 * ((b -= 2) * b * b + 2) + c}, easeInQuart:function(a, b, c, d, e){return d * (b /= e) * b * b * b + c}, easeOutQuart:function(a, b, c, d, e){return - d * ((b = b / e - 1) * b * b * b - 1) + c}, easeInOutQuart:function(a, b, c, d, e){return(b /= e / 2) < 1?d / 2 * b * b * b * b + c: - d / 2 * ((b -= 2) * b * b * b - 2) + c}, easeInQuint:function(a, b, c, d, e){return d * (b /= e) * b * b * b * b + c}, easeOutQuint:function(a, b, c, d, e){return d * ((b = b / e - 1) * b * b * b * b + 1) + c}, easeInOutQuint:function(a, b, c, d, e){return(b /= e / 2) < 1?d / 2 * b * b * b * b * b + c:d / 2 * ((b -= 2) * b * b * b * b + 2) + c}, easeInSine:function(a, b, c, d, e){return - d * Math.cos(b / e * (Math.PI / 2)) + d + c}, easeOutSine:function(a, b, c, d, e){return d * Math.sin(b / e * (Math.PI / 2)) + c}, easeInOutSine:function(a, b, c, d, e){return - d / 2 * (Math.cos(Math.PI * b / e) - 1) + c}, easeInExpo:function(a, b, c, d, e){return 0 == b?c:d * Math.pow(2, 10 * (b / e - 1)) + c}, easeOutExpo:function(a, b, c, d, e){return b == e?c + d:d * ( - Math.pow(2, - 10 * b / e) + 1) + c}, easeInOutExpo:function(a, b, c, d, e){return 0 == b?c:b == e?c + d:(b /= e / 2) < 1?d / 2 * Math.pow(2, 10 * (b - 1)) + c:d / 2 * ( - Math.pow(2, - 10 * --b) + 2) + c}, easeInCirc:function(a, b, c, d, e){return - d * (Math.sqrt(1 - (b /= e) * b) - 1) + c}, easeOutCirc:function(a, b, c, d, e){return d * Math.sqrt(1 - (b = b / e - 1) * b) + c}, easeInOutCirc:function(a, b, c, d, e){return(b /= e / 2) < 1? - d / 2 * (Math.sqrt(1 - b * b) - 1) + c:d / 2 * (Math.sqrt(1 - (b -= 2) * b) + 1) + c}, easeInElastic:function(a, b, c, d, e){var f = 1.70158, g = 0, h = d; if (0 == b)return c; if (1 == (b /= e))return c + d; if (g || (g = .3 * e), h < Math.abs(d)){h = d; var f = g / 4} else var f = g / (2 * Math.PI) * Math.asin(d / h); return - (h * Math.pow(2, 10 * (b -= 1)) * Math.sin((b * e - f) * 2 * Math.PI / g)) + c}, easeOutElastic:function(a, b, c, d, e){var f = 1.70158, g = 0, h = d; if (0 == b)return c; if (1 == (b /= e))return c + d; if (g || (g = .3 * e), h < Math.abs(d)){h = d; var f = g / 4} else var f = g / (2 * Math.PI) * Math.asin(d / h); return h * Math.pow(2, - 10 * b) * Math.sin((b * e - f) * 2 * Math.PI / g) + d + c}, easeInOutElastic:function(a, b, c, d, e){var f = 1.70158, g = 0, h = d; if (0 == b)return c; if (2 == (b /= e / 2))return c + d; if (g || (g = e * .3 * 1.5), h < Math.abs(d)){h = d; var f = g / 4} else var f = g / (2 * Math.PI) * Math.asin(d / h); return 1 > b? - .5 * h * Math.pow(2, 10 * (b -= 1)) * Math.sin((b * e - f) * 2 * Math.PI / g) + c:.5 * h * Math.pow(2, - 10 * (b -= 1)) * Math.sin((b * e - f) * 2 * Math.PI / g) + d + c}, easeInBack:function(a, b, c, d, e, f){return void 0 == f && (f = 1.70158), d * (b /= e) * b * ((f + 1) * b - f) + c}, easeOutBack:function(a, b, c, d, e, f){return void 0 == f && (f = 1.70158), d * ((b = b / e - 1) * b * ((f + 1) * b + f) + 1) + c}, easeInOutBack:function(a, b, c, d, e, f){return void 0 == f && (f = 1.70158), (b /= e / 2) < 1?d / 2 * b * b * (((f *= 1.525) + 1) * b - f) + c:d / 2 * ((b -= 2) * b * (((f *= 1.525) + 1) * b + f) + 2) + c}, easeInBounce:function(a, b, c, d, e){return d - jQuery.easing.easeOutBounce(a, e - b, 0, d, e) + c}, easeOutBounce:function(a, b, c, d, e){return(b /= e) < 1 / 2.75?d * 7.5625 * b * b + c:2 / 2.75 > b?d * (7.5625 * (b -= 1.5 / 2.75) * b + .75) + c:2.5 / 2.75 > b?d * (7.5625 * (b -= 2.25 / 2.75) * b + .9375) + c:d * (7.5625 * (b -= 2.625 / 2.75) * b + .984375) + c}, easeInOutBounce:function(a, b, c, d, e){return e / 2 > b?.5 * jQuery.easing.easeInBounce(a, 2 * b, 0, d, e) + c:.5 * jQuery.easing.easeOutBounce(a, 2 * b - e, 0, d, e) + .5 * d + c}});
        var $ = jQuery;
//Normal Call Back Functions
        jQuery(document).ready(function($) {
jQuery('.btn-toggle_cal').click(function(event) {
/* Act on the event */
jQuery(this).toggleClass('bgcolr');
        var a = jQuery(this).attr('href');
        jQuery(a).fadeToggle(300);
        return false;
        });
        jQuery(".btntoggle-thumb").click(function(event) {
/* Act on the event */
$(this).toggleClass('cs-active');
        $(this).parent().toggleClass('cs-active');
        return false;
        });
        jQuery('.post-option ul li a').addClass('bgcolrhvr event-label');
        jQuery('audio,video').mediaelementplayer();
        jQuery("#stickyarea").hide();
        jQuery(".accordion-toggle").addClass('collapsed');
        // Foucs Blur function for input field 
        $(' textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"]').focus(function() {
if (!$(this).data("DefaultText")) $(this).data("DefaultText", $(this).val());
        if ($(this).val() != "" && $(this).val() == $(this).data("DefaultText")) $(this).val("");
        }).blur(function() {
if ($(this).val() == "") $(this).val($(this).data("DefaultText"));
        });
// 
        jQuery(".our_causes article").hover(function() {
jQuery(this).find(".desc").stop(true, true).slideDown(500, "easeOutCubic")
}, function() {
jQuery(this).find(".desc").stop(true, true).slideUp(500, "easeOutCubic")
});
        jQuery(".navigation ul li a").each(function(index, el) {
var a = jQuery(this).text();
        jQuery(this).next("ul").prepend("<li><h2 class='colr'>" + a + "</h2></li>")

        });
        jQuery(".btnsearch").click(function(event) {
/* Act on the event */
$(this).next().fadeToggle(600, "easeOutQuart")
        return false;
        });
        jQuery("html").click(function(event) {
/* Act on the event */
jQuery("#searchbox").fadeOut(600, "easeOutQuart");
        jQuery(".btn-toggle_cal").removeClass("bgcolr")
        jQuery(".add_calendar").fadeOut(300)
        });
        jQuery(".searcharea,.add_calendar").click(function(event) {
/* Act on the event */
event.stopPropagation();
        });
});
// Article flex slider funtion
        function cs_flex_slider_article_function(){
        jQuery('article .flexslider').flexslider({
        animation: "fade",
                start: function(slider) {
                $('body').removeClass('loading');
                        jQuery(slider).find(".flex-direction-nav li:first-child").after("<li class='count-slide'><span class='slide-number'>" + (slider.currentSlide + 1) + "</span>/" + slider.count + "</li>")

                },
                after: function(slider) {
                jQuery(slider).find(".slide-number").text(slider.currentSlide + 1)
                }
        });
                jQuery(".flex-direction-nav a.flex-prev").append('<em class="fa fa-angle-left"></em>')
                jQuery(".flex-direction-nav a.flex-next").append('<em class="fa fa-angle-right"></em>')
        }
function cs_gallery_slider(){
jQuery('#slider-thumbs .flexslider').flexslider({
animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 60,
        itemMargin: 10,
        asNavFor: '#slidermain .flexslider'
        });
        jQuery('#slidermain .flexslider').flexslider({
animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#slider-thumbs .flexslider"
        });
        jQuery(".flex-direction-nav a.flex-prev").append('<em class="fa fa-angle-left"></em>')
        jQuery(".flex-direction-nav a.flex-next").append('<em class="fa fa-angle-right"></em>')

}

function event_map(add, lat, long, zoom, counter){
var map;
        var myLatLng = new google.maps.LatLng(lat, long)
        //Initialize MAP
        var myOptions = {
        zoom:zoom,
                center: myLatLng,
                disableDefaultUI: true,
                zoomControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas' + counter), myOptions);
        //End Initialize MAP

        //Set Marker
        var marker = new google.maps.Marker({
        position: map.getCenter(),
                map: map
        });
        marker.getPosition();
        //End marker

        //Set info window
        var infowindow = new google.maps.InfoWindow({
        content: "" + add,
                position: myLatLng
        });
        google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
        });
}
function cs_menu_sticky(){
//jQuery(".header-section").scrollToFixed();
}

function show_map(id) {
jQuery("div.post-" + id).toggleClass("show-map");
}
// Load more Event js
function show_mapp(id, add, lat, long, zoom, home_url, get_template_directory_uri) {

var a = jQuery("div.post-" + id).find("[id^=map]").length;
        if (a > 1) {
jQuery("div.post-" + id).toggleClass("open_map");
        } else {
jQuery("article.post-" + id).find("a.open i").hide();
        jQuery("article.post-" + id).find("a.open").append('<img src="' + get_template_directory_uri + '/images/ajax-loader.gif" />');
        var dataString = 'post_id=' + id + '&add=' + add + '&lat=' + lat + '&long=' + long + '&zoom=' + zoom;
        jQuery.ajax({
        type:"POST",
                url: get_template_directory_uri + "/include/map_load.php",
                data:dataString,
                success:function(response){
                jQuery("article.post-" + id).find("a.open img").hide();
                        jQuery("article.post-" + id).find("a.open i").show();
                        jQuery("div.post-" + id).toggleClass("open_map");
                        jQuery("div.post-" + id).show();
                        jQuery("#map_canvas" + id).html(response);
                        jQuery(".open" + id).hide();
                }
        });
        }
}
// like counter function
function cs_like_counter(theme_url, post_id){
jQuery("#like_this" + post_id).hide();
        jQuery("#loading_div" + post_id).show();
        var dataString = 'post_id=' + post_id;
        jQuery.ajax({
        type:"POST",
                url: theme_url + "/include/like_counter.php",
                data:dataString,
                success:function(response){
                jQuery("#loading_div" + post_id).hide();
                        jQuery("#like_counter" + post_id).show();
                        jQuery("#like_counter" + post_id).append(response);
                        //jQuery("#like_counter").html(response);
                }
        });
        //return false;
}
// Mailchimp widget 
function cs_mailchimp_add_scripts () {
//'use strict';
(function(a){a.fn.ns_mc_widget = function(b){var e, c, d; e = {url:"/", cookie_id:false, cookie_value:""}; d = jQuery.extend(e, b); c = a(this); c.submit(function(){var f; f = jQuery("<div></div>"); f.css({"background-image":"url(" + d.loader_graphic + ")", "background-position":"center center", "background-repeat":"no-repeat", height:"16px", left:"48%", position:"absolute", top:"40px", width:"16px", "z-index":"100"}); c.css({height:"100%", position:"relative", width:"100%"}); c.children().hide(); c.append(f); a.getJSON(d.url, c.serialize(), function(h, k){var j, g, i; if ("success" === k){if (true === h.success){i = jQuery("<p>" + h.success_message + "</p>"); i.hide(); c.fadeTo(400, 0, function(){c.html(i); i.show(); c.fadeTo(400, 1)}); if (false !== d.cookie_id){j = new Date(); j.setTime(j.getTime() + "3153600000"); document.cookie = d.cookie_id + "=" + d.cookie_value + "; expires=" + j.toGMTString() + ";"}} else{g = jQuery(".error", c); if (0 === g.length){f.remove(); c.children().show(); g = jQuery('<div class="error"></div>'); g.prependTo(c)} else{f.remove(); c.children().show()}g.html(h.error)}}return false}); return false})}}(jQuery));
}
// end mailchimp widget

// Resize Funciton
function cs_iframe_videos(){


// Find all YouTube videos
var $allVideos = $("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com']"),
        // The element that is fluid width
        $fluidEl = $("body");
        // Figure out and save aspect ratio for each video
        $allVideos.each(function() {

        $(this)
                .data('aspectRatio', this.height / this.width)

                // and remove the hard coded width/height
                .removeAttr('height')
                .removeAttr('width');
        });
        // When the window is resized
        $(window).resize(function() {

var newWidth = $fluidEl.width();
        // Resize all videos according to their own aspect ratio
        $allVideos.each(function() {

        var $el = $(this);
                $el
                .width(newWidth)
                .height(newWidth * $el.data('aspectRatio'));
        });
        // Kick off one resize to fix all videos on page load
        }).resize();
}

jQuery(document).ready(function(){
if (typeof prettyPhoto == 'function') {
jQuery("area[rel^='prettyPhoto']").prettyPhoto();
        jQuery(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal', hook: 'rel', theme:'pp_default', slideshow:3000, social_tools:'', autoplay_slideshow: false});
        jQuery(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast', slideshow:10000, hideflash: true});
        jQuery("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
        changepicturecallback: function(){ initialize(); }
});
        jQuery("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
        changepicturecallback: function(){ _bsap.exec(); }
});
        }
});
        jQuery(document).ready(function($) {
if (jQuery(".gallery-masonry").length != '') {
var container = jQuery(".gallery-masonry").imagesLoaded(function() {
container.isotope()
        });
        jQuery(window).resize(function() {
setTimeout(function() {
jQuery(".gallery-masonry").isotope()
        }, 600)
        });
        }
});

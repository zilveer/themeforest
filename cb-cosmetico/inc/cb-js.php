<script type="text/javascript"> <?php ob_start();?>
jQuery(document).ready(function(){ 
"use strict";
jQuery('#mobile-menu li:has(ul)').doubleTapToGo();
jQuery('.cart_top').doubleTapToGo();
jQuery('.nav-mobile').click(function(){
jQuery('#mobile-menu').slideToggle('fast')
});
<?php
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');
if($topw=='yes') { ?>
jQuery('.t_hide').click(function(){
jQuery('.top_header_left_widget li').fadeOut('fast');
jQuery('.top_header_left_widget').slideToggle('slow');
jQuery('.top_header_widget').slideToggle('slow');
});
<?php } else {?>
jQuery('.t_hide').hide();
<?php } ?>

jQuery('.tabs').hide();

jQuery('#close_item').hide();

jQuery('.aq-block .aq_mb').parent().addClass('mb0');
if(jQuery(window).width()>980){
jQuery.expr[':'].hasClassStartingWithInput  = function(obj){
  return (/\banimatefade/).test(obj.className);
};
var durdur=1500;
var tilescb = jQuery('div:hasClassStartingWithInput'); tilescb.fadeTo(0, 0);
    tilescb.each(function(i) { 
      var addcb = jQuery(this).position().top;
      var bddcb = jQuery(window).scrollTop() + jQuery(window).height(); 
        if (bddcb > (addcb+150)){
		if(jQuery(this).hasClass('animatefade-slideleft')) {
		jQuery(this).animate({left:'0px'}, { duration: durdur, queue: false }).animate({right:'0px'}, { duration: durdur, queue: false }).fadeTo(durdur,1);
		}
		if(jQuery(this).hasClass('animatefade-slideright')) {
		jQuery(this).animate({right:'0px'}, { duration: durdur, queue: false }).animate({left:'0px'}, { duration: durdur, queue: false }).fadeTo(durdur,1);
		}
		if(jQuery(this).hasClass('animatefade-slidetop')) {
		jQuery(this).animate({top:'0px'}, { duration: durdur, queue: false }).animate({bottom:'0px'}, { duration: durdur, queue: false }).fadeTo(durdur,1);
		}
		if(jQuery(this).hasClass('animatefade-slidedown')){
		jQuery(this).animate({bottom:'0px'}, { duration: durdur, queue: false }).animate({top:'0px'}, { duration: durdur, queue: false }).fadeTo(durdur,1);
		}
		if(jQuery(this).hasClass('animatefade-fadein')) {
		jQuery(this).fadeTo(durdur,1);
		}

	}
    });
jQuery(window).scroll(function(d,h) { 
    tilescb.each(function(i) { 
      var addcb = jQuery(this).position().top;
      var bddcb = jQuery(window).scrollTop() + jQuery(window).height(); 
        if (bddcb > (addcb+150)){
		if(jQuery(this).hasClass('animatefade-slideleft')) {
		jQuery(this).animate({left:'0px'}, { duration: durdur, queue: false }).animate({right:'0px'}, { duration: durdur, queue: false }).fadeTo(durdur,1);
		}
		if(jQuery(this).hasClass('animatefade-slideright')) {
		jQuery(this).animate({right:'0px'}, { duration: durdur, queue: false }).animate({left:'0px'}, { duration: durdur, queue: false }).fadeTo(durdur,1);
		}
		if(jQuery(this).hasClass('animatefade-slidetop')) {
		jQuery(this).animate({top:'0px'}, { duration: durdur, queue: false }).animate({bottom:'0px'}, { duration: durdur, queue: false }).fadeTo(durdur,1);
		}
		if(jQuery(this).hasClass('animatefade-slidedown')){
		jQuery(this).animate({bottom:'0px'}, { duration: durdur, queue: false }).animate({top:'0px'}, { duration: durdur, queue: false }).fadeTo(durdur,1);
		}
		if(jQuery(this).hasClass('animatefade-fadein')) {
		jQuery(this).fadeTo(durdur,1);
		}

	}
    });
});
<?php if($wayp=='yes'){?>
var tiles2 = jQuery('.widget').fadeTo(0, 0); var add2=''; var bdd2='';
tiles2.each(function(i) {
  add2 = (jQuery(this).offset().top)+50;
  bdd2 = jQuery(window).scrollTop() + jQuery(window).height();
    if (add2 < bdd2) jQuery(this).fadeTo(500,1);
});
jQuery(window).scroll(function(d,h) {
    tiles2.each(function(i) {
      add2 = (jQuery(this).offset().top)+50;
      bdd2 = jQuery(window).scrollTop() + jQuery(window).height();
        if (add2 < bdd2) jQuery(this).fadeTo(500,1);
    });
});
}
jQuery('.footer-lower .widget').show();
<?php } ?>


jQuery('i').hide().delay('100').fadeIn('slow');

<?php if($scroll=='yes') { ?>
jQuery(window).scroll(function(){
	if (jQuery(this).scrollTop() > 200) {
	jQuery('.scrollup').fadeIn();
	} else {
	jQuery('.scrollup').fadeOut();
}
}); 
	jQuery('.scrollup').click(function(){
	jQuery("html, body").animate({ scrollTop: 0 }, 1300);
	return false;
	});
<?php } ?>
<?php if($header_type=='bg_head'&&$header_bg_image!='') { ?>
jQuery(".slider_top").backstretch("<?php echo $header_bg_image; ?>");
<?php } ?>




<?php if( ($full_slider=='yes'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$full_slider_where=='yes' ) )||$slider_home=='full'){
$full_screen_images='';
	 $imgs=get_children('order=asc&orderby=menu_order&post_type=attachment&post_mime_type=image&post_parent='.$full_slider_page); 
	 foreach ($imgs as $att_id => $att) { 
	  $gall_img=wp_get_attachment_image_src($att_id,'full');
	  $full_screen_images.="{image : '".$gall_img[0]."'},"; 
	 } 	 

?>
jQuery.supersized({
slide_interval : <?php echo $full_slider_interval; ?>,
transition : <?php echo $full_slider_effect; ?>,
transition_speed : <?php echo $full_slider_t_speed; ?>,
slides : [<?php echo substr($full_screen_images,0,-1); ?>],
progress_bar : <?php echo $full_slider_bar; ?>,
mouse_scrub : 0,	
vertical_center : 1,
horizontal_center : 1,
fit_always : 0,
fit_portrait : 0,
fit_landscape : 0,
thumb_links : 1,
slide_links : 'blank',
thumbnail_navigation : <?php echo $full_slider_thumbs; ?>				
});
<?php } ?>

<?php if( ($slide_type=='any'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$slide_home=='yes' ) )||$slider_home=='any') { ?>
jQuery('#slider').anythingSlider({
resizeContents      : <?php echo $s_resize; ?>,
hashTags            : false,  
autoPlay            : <?php echo $s_auto; ?>,     
pauseOnHover        : true,    
resumeOnVideoEnd    : true,
delay               : <?php echo $s_delay; ?>,     
animationTime       : <?php echo $s_ani_time; ?>,    
easing              : '<?php echo $s_easing; ?>'
})
.anythingSliderFx({ 
'#slider .fade' : [ 'fade'],
});
jQuery('.slider_top').css('padding-bottom','20px');
<?php } ?>
<?php if($disable_pp=='no'){ ?>
jQuery("a[data-rel^='pp']").prettyPhoto({
hideflash: true,
wmode: 'opaque',
deeplinking: false
});
<?php } ?>

 jQuery('.wrapper_p :submit').addClass('submit');
 jQuery('.wrapper_p :submit').addClass('gr');
 jQuery('.bttn').addClass('gr');
 jQuery('.bttn_big').addClass('gr');
 jQuery('.w_50').addClass('round');
 jQuery('.b_50').addClass('round');

 jQuery("ul#cb-menu li").hover(function(){
  jQuery(this).addClass("hover");
  jQuery('ul:first',this).hide();
  jQuery('ul:first',this).stop().slideDown('fast').css('display', 'block');
 }, function(){
 jQuery(this).removeClass("hover");
 jQuery('ul:first',this).css('display', 'none');
 });
 jQuery("ul#cb-menu li ul li:has(ul)").find("a:first").append(" &raquo; ");



jQuery('body').on('mouseenter', '.fade_woo', function() {
    jQuery(this).find('.fade_cart').stop().fadeIn(500);
    jQuery(this).stop().addClass('hover');

}).on('mouseleave', '.fade_woo', function() {
    jQuery(this).find('.fade_cart').stop().fadeOut(500);
    jQuery(this).stop().removeClass('hover');
});







jQuery('.fade.team .fade_c').addClass('skin_bg');
jQuery('.fade.team .fade_c').addClass('opa9');



 
jQuery('.fade').hover(
function(){ jQuery('.fade_c',this).stop().fadeIn('fast'); 
},function(){ jQuery('.fade_c',this).stop().fadeOut('fast');}
);


<?php if($fade_style=='rift'){ ?>
jQuery('.fade_c .see_more_wrap').addClass('skin_bg_alt');
/**
 * Rift v1.0.0
 * An itsy bitsy image-splitting jQuery plugin
 * 
 * Licensed under the MIT license.
 * Copyright 2013 Kyle Foster
 */

  jQuery.fn.rift = function () {

    return this.each(function () {
      
      var element = jQuery(this),
          elemImg = element.parent().find('img.fade-si'),
          imgSrc  = elemImg.attr('src');
  
      element
        .prepend('<span class="top-span"></span>')
        .append('<span class="btm-span"></span>')
        .find('span.top-span')
        .css('background', 'url(' + imgSrc + ') no-repeat center top')
        .css('background-size', '100%')
        .parent()
        .find('span.btm-span')
        .css('background', 'url(' + imgSrc + ') no-repeat center bottom')
        .css('background-size', '100%');
    });
  };


jQuery('.fade .fade_c').rift();
<?php } else {?>
jQuery('.fade_c').addClass('fade_border');
<?php }?>















jQuery('.icons_text').hide();
jQuery('.icons_text').css('width','0px');
jQuery('.icons a').hover(
function(){
	var text=jQuery(this).attr('data-title');
	var html=jQuery('.icons_text').html(); html='<div>'+text+'</div>'; jQuery('.icons_text').html(html); jQuery('.icons_text div').hide();
	jQuery('.icons_text').stop().show().animate({width:'200px'}, 400);
	jQuery('.icons_text div').fadeIn('slow');
	
},function(){
	jQuery('.icons_text').stop().hide().animate({width:'0px'}, 400);
}

);


jQuery('.slider_top_button').click(function(){
	var cwid=jQuery('.slider_top_overlay').css('width');
	if(cwid=='0px')jQuery('.slider_top_overlay').stop().show().animate({width:'100%'}, 300);
	else jQuery('.slider_top_overlay').stop().animate({width:'0',duration:100}, function(){jQuery(this).hide();});
});




jQuery('.trans_cn').animate({rotate: '15deg'}, 300 );
jQuery('.trans_wrap').mouseover(function(){
	jQuery(this).find('.trans_cn').stop().animate({ marginTop: '-120px'}, { duration: 300, queue: false }).animate({rotate: '0deg'}, { duration: 200}).animate({ marginTop: '-100px'}, { duration: 500, queue: false });
});
jQuery('.trans_wrap').mouseout(function(){
	jQuery(this).find('.trans_cn').stop().animate({ marginTop: '-40px'}, { duration: 200}).animate({rotate: '15deg'}, { duration: 300, queue: false }).animate({ marginTop: '-60px'}, { duration: 500, queue: false });
});

var show_search_content='<div class="top_search"><form role="search" method="get" id="searchform"><div><input type="text" value="" name="s" id="s" /><input type="submit" id="searchsubmit" class="submit gr" value="GO" /></div></form></div>';
jQuery('.widget_top .show_search').append(show_search_content);

jQuery('#sidebar_r .menu li:first a').addClass('bortop');
jQuery('#sidebar_r .menu li:first a').addClass('bortl');
jQuery('#sidebar_r .menu li:last a').addClass('borbl');
jQuery('#sidebar_l .menu li:first a').addClass('bortop');
jQuery('#sidebar_l .menu li:first a').addClass('bortr');
jQuery('#sidebar_l .menu li:last a').addClass('borbr');
jQuery('.bline').append('<div class="bline-line"></div>');

<?php if($slidertoptint!='no'&&$slidertoptint!='') { ?>
jQuery('.slider_top').addClass('slider_top_tint');
<?php if($slidertoptint=='bdark') { ?>jQuery('.slider_top').prepend('<div class="tint_bdark"></div>');<?php } ?>
<?php if($slidertoptint=='skin_bg') { ?>jQuery('.slider_top').prepend('<div class="tint_skin"></div>');<?php } ?>
<?php if($slidertoptint=='blight') { ?>jQuery('.slider_top').prepend('<div class="tint_blight"></div>');<?php } ?>
<?php if($slidertoptint=='wdark') { ?>jQuery('.slider_top').prepend('<div class="tint_wdark"></div>');<?php } ?>
<?php if($slidertoptint=='wlight') { ?>jQuery('.slider_top').prepend('<div class="tint_wlight"></div>');<?php } ?>
<?php if($slidertoptint=='tblack') { ?>jQuery('.slider_top').prepend('<div class="tint_tblack"></div>');<?php } ?>
<?php if($slidertoptint=='twhite') { ?>jQuery('.slider_top').prepend('<div class="tint_twhite"></div>');<?php } ?>
<?php } ?>
<?php 
if(!isset($slidertoptintp)) $slidertoptintp='';
if($slidertoptintp!='no'&&$slidertoptintp!='') { ?>
jQuery('.slider_top').addClass('slider_top_tint');
<?php if($slidertoptintp=='bdark') { ?>jQuery('.slider_top').prepend('<div class="tint_bdark"></div>');<?php } ?>
<?php if($slidertoptintp=='skin_bg') { ?>jQuery('.slider_top').prepend('<div class="tint_skin"></div>');<?php } ?>
<?php if($slidertoptintp=='blight') { ?>jQuery('.slider_top').prepend('<div class="tint_blight"></div>');<?php } ?>
<?php if($slidertoptintp=='wdark') { ?>jQuery('.slider_top').prepend('<div class="tint_wdark"></div>');<?php } ?>
<?php if($slidertoptintp=='wlight') { ?>jQuery('.slider_top').prepend('<div class="tint_wlight"></div>');<?php } ?>
<?php if($slidertoptintp=='tblack') { ?>jQuery('.slider_top').prepend('<div class="tint_tblack"></div>');<?php } ?>
<?php if($slidertoptintp=='twhite') { ?>jQuery('.slider_top').prepend('<div class="tint_twhite"></div>');<?php } ?>
<?php } ?>
<?php 
if(!isset($sloganp)) $sloganp='';
if($sloganp!='') { ?>
jQuery('.slider_top').prepend('<div class="slider_top_slogan"><div class="wrapper_p"><?php echo html_entity_decode($sloganp);?></div></div>');
<?php } ?>


jQuery('.footer_hidden').click(function(){
jQuery('#footer_hidden').slideToggle('slow');
var llin=jQuery("#footer_hidden").offset().top;
jQuery('html,body').animate({scrollTop: llin-80},'slow');
});
jQuery('.onepage a').click(function(e){
var link=jQuery(this).attr('href');
var linn=jQuery(link).offset().top;
jQuery('html,body').animate({scrollTop: linn-80},'slow');
});


jQuery('.cb5_woosort label').click(function(){
jQuery('.cb5_woosort label').removeClass('active');
jQuery(this).addClass('active');
});

jQuery('.woo_step h1').click(function(){
jQuery('.woo_step_in').slideUp('slow');
jQuery(this).parent().find('.woo_step_in').slideDown('slow');
});
jQuery('.woo_step .step_continue').click(function(){
jQuery('.woo_step.address .woo_step_in').slideUp('slow');
jQuery('.woo_step.place_order .woo_step_in').slideDown('slow');
});

jQuery('.cart_top').hover(function(){
jQuery('.cart_hover').stop().fadeIn('slow');
},function(){
jQuery('.cart_hover').stop().fadeOut('slow');
});

var widd=jQuery(document).width();
if(widd>780) {
jQuery('#page .products').addClass('grid');
} else {
jQuery('#page .products').addClass('list');
jQuery('.list .product').last().addClass('lasty');
}


jQuery('.products_style .grid').click(function(){
jQuery('.products_style a').removeClass('active');
jQuery(this).addClass('active');
jQuery('#page .products').fadeOut('fast');
jQuery('#page .products').removeClass('list');
jQuery('#page .products').addClass('grid');
jQuery('#page .products').fadeIn('slow');
});
jQuery('.products_style .list').click(function(){
jQuery('.products_style a').removeClass('active');
jQuery(this).addClass('active');
jQuery('#page .products').fadeOut('fast');
jQuery('#page .products').removeClass('grid');
jQuery('#page .products').addClass('list');
jQuery('.list .product').last().addClass('lasty');
jQuery('#page .products').fadeIn('slow');
});


<?php $fixed_top=get_option('cb5_fixed_top'); if($fixed_top=='yes') { ?> 
var fixed=false;
jQuery(window).scroll(function(){
if(jQuery(this).scrollTop() > 70){
if(!fixed) {
fixed=true;
jQuery('.head_top_container').addClass('skinimp');
<?php if($mheadertype=='right') { ?>
jQuery('ul#cb-menu li a').animate({'height' : '70px'}, { duration: 800, queue: false });
jQuery('ul#cb-menu li a').animate({'line-height' : '70px'}, { duration: 800, queue: false });
jQuery('.top_l').animate({'height' : '70px'}, { duration: 800, queue: false });
jQuery('.top_r').animate({'height' : '70px'}, { duration: 800, queue: false });
jQuery('ul#cb-menu li a.cb-menu-search i').animate({'height' : '69px'}, { duration: 800, queue: false });
<?php } ?>
}}
else {
if(fixed) {
fixed=false;
jQuery('.head_top_container').removeClass('skinimp');
<?php if($mheadertype=='right') { ?>
jQuery('ul#cb-menu li a').animate({'height' : '150px'}, { duration: 800, queue: false });
jQuery('ul#cb-menu li a').animate({'line-height' : '150px'}, { duration: 800, queue: false });
jQuery('.top_l').animate({'height' : '150px'}, { duration: 800, queue: false });
jQuery('.top_r').animate({'height' : '150px'}, { duration: 800, queue: false });
jQuery('ul#cb-menu li a.cb-menu-search i').animate({'height' : '147px'}, { duration: 800, queue: false });
<?php } ?>
}}
});
<?php } ?>












/*blind,bounce,drop,explode,fade,fold,highlight,pulsate,scale,shake,slide,transfer*/
jQuery(".accordion").accordion({ header: "h3" });
jQuery('.tabs').slideDown('fast');
jQuery('.tabs').tabs({ hide: { effect: "slide", duration: 200 },show: { effect: "fade", duration: 400 } });


jQuery(".widget_top .show_search").click(function(){
jQuery(".widget_top .top_search").slideToggle('slow');
return false;
});
jQuery(".widget_top .show_search #s").click(function(){
return false;
});


<?php if( ($slide_type=='any'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$slide_home=='yes' ) )||$slider_home=='any') { ?>
<?php } else { if($usescroll=='yes') { ?>
jQuery('html').niceScroll({
    cursorcolor: "#333",
    cursoropacitymin: 0.2,
    background: "#fff",
    cursorborder: "0",
    autohidemode: true,
    cursorminheight: 30
});
<?php } 
}?>
if(jQuery(window).width()>980) {
var tiless = jQuery('.knob');
tiless.each(function(i) {
  var add = (jQuery(this).offset().top)+150;
  var bdd = jQuery(window).scrollTop() + jQuery(window).height();
    if (add < bdd) {
           var knob = jQuery(this);
           var myVal = knob.attr("rel");
		    if(knob.attr("showed")!="true"){
			knob.knob({
			});
           jQuery({
               value: 0
           }).animate({
               value: myVal
           }, {
               duration: 2000,
               easing: 'swing',
               step: function () {
                   knob.val(Math.ceil(this.value)).trigger('change');
               }
           });
		   knob.attr("showed","true");
		   }
		   
	}
});
jQuery(window).scroll(function(d,h) {
    tiless.each(function(i) {
      var add = (jQuery(this).offset().top)+100;
      var bdd = jQuery(window).scrollTop() + jQuery(window).height();
        if (add < bdd){
		   var knob = jQuery(this);
		   var myVal = knob.attr("rel");
           if(knob.attr("showed")!="true"){
			knob.knob({
			});
           jQuery({
               value: 0
           }).animate({
               value: myVal
           }, {
               duration: 2000,
               easing: 'swing',
               step: function () {
                   knob.val(Math.ceil(this.value)).trigger('change');
               }
           });
		   knob.attr("showed","true");
		   }
		}
    });
});
}
else{
var tiless = jQuery('.knob');
tiless.each(function(i) {
  var add = (jQuery(this).offset().top)+100;
  var bdd = jQuery(window).scrollTop() + jQuery(window).height();
    if (add < bdd) {
           var knob = jQuery(this);
           var myVal = knob.attr("rel");
		    if(knob.attr("showed")!="true"){
			knob.knob({
			});
           jQuery({
               value: 0
           }).animate({
               value: myVal
           }, {
               duration: 2000,
               easing: 'swing',
               step: function () {
                   knob.val(Math.ceil(this.value)).trigger('change');
               }
           });
		   knob.attr("showed","true");
		   }
		   
	}
});
};
jQuery('#search-icon').click(
function(){
if (jQuery('#search-input').is(":visible")){
jQuery('#search-input').hide("slide", { direction: "right" }, 250);
}else{
jQuery('#search-input').show("slide", { direction: "right" }, 250);
}	
});




jQuery('#load_more_products').live('click', function(){ 
   var $mainContent = jQuery('.products');
   var $pagenavi = jQuery('.page-numbers .current');
   var url = $pagenavi.closest('li').next().find('a').attr("href");
   $pagenavi.removeClass("current");
	$pagenavi.closest('li').next().find('a').addClass("current");
	$pagenavi = jQuery('.page-numbers .current');

	$mainContent.animate({opacity: "0.3"});
 jQuery("<div>").load(url+' .products li', function() {
      $mainContent.append(jQuery(this).html());
	  $mainContent.animate({opacity: "1"});
	   window.history.pushState(null, document.title, url);
});
	if ($pagenavi.closest('li').next().find('a').hasClass('next')) {
	jQuery(this).hide();
	jQuery('.woo_load_container').addClass('no_more');
	}
});








});

function progress(percent, $element) {
	"use strict";
	var progressBarWidth = percent * $element.width() / 100;
	$element.find('div').animate({ width: progressBarWidth }, 500).html(percent + "%&nbsp;");
}
function openItem( $item,$h ) {
	"use strict";
	$item.find( 'img' ).stop().fadeTo( 1500, 1 );
	$item.stop().animate({
	height: $h
	});
	$item.find('span').stop().slideDown('slw');
}


jQuery(window).bind("load",function(){ 
if(jQuery(".clients-slide").length){
        var totalImages = jQuery(".clients-slide > a").length, 
            imageWidth = jQuery(".clients-slide > a:first").outerWidth(true),
            totalWidth = jQuery('.clients-slide.widget').width(),
            visibleWidth = jQuery(".clients-slide-wrap").width(),
            stopPosition = (visibleWidth - totalWidth);
if(stopPosition>0) {
jQuery('.clients-slide-controls').hide();
jQuery('.clients-slide-wrap').css('margin-left','0');
jQuery('.clients-slide-wrap').css('margin-right','0');
}
        jQuery(".clients-slide").width(totalWidth);
        jQuery(".clients-slide-controls .prev").live('click', function(e) {
        var visi=jQuery(this).parent().parent().find(".clients-slide-wrap img:in-viewport").length;
        var img_last=jQuery(this).parent().parent().find('.clients-slide.widget a:in-viewport').outerWidth(true);
            if(jQuery(this).parent().parent().find(".clients-slide").position().left < 0 && !jQuery(this).parent().parent().find(".clients-slide").is(":animated")){
                jQuery(".clients-slide").animate({left : "+=" + img_last +  "px"});
            }
            e.preventDefault();
            return false;
        });
        jQuery(".clients-slide-controls .next").live('click', function(e) {
        var visi=jQuery(this).parent().parent().find(".clients-slide-wrap img:in-viewport").length;
        var img_last=jQuery(this).parent().parent().find('.clients-slide.widget a:nth-child('+visi+')').outerWidth(true);
            if(jQuery(this).parent().parent().find(".clients-slide").position().left > stopPosition && !jQuery(this).parent().parent().find(".clients-slide").is(":animated")){
                jQuery(this).parent().parent().find(".clients-slide").animate({left : "-=" + img_last + "px"});
            }
            e.preventDefault();
            return false;
        });
}

if(jQuery(".slidy_blog_container").length){ 
        var totalImages = jQuery('.slidy_blog_container .slidy-blog').length, 
            totalWidth = jQuery('.slidy_blog_container .slidy_blog_elements').width(),
            visibleWidth = jQuery(".slidy_blog_container").width(),
            stopPosition = (visibleWidth - totalWidth);
if(stopPosition>0) {
jQuery(this).find('.slidy_left').hide();
jQuery(this).find('.slidy_right').hide();
}

        jQuery(".slidy_left").live('click', function(e) {
            if(jQuery(this).parent().parent().find(".slidy_blog_elements").position().left < 0 && !jQuery(this).parent().parent().find(".slidy_blog_elements").is(":animated")){
                jQuery(".slidy_blog_elements").animate({left : "+=200px"});
            }
            e.preventDefault();
            return false;
        });
        jQuery(".slidy_right").live('click', function(e) { 
            if(jQuery(this).parent().parent().find(".slidy_blog_elements").position().left > stopPosition && !jQuery(this).parent().parent().find(".slidy_blog_elements").is(":animated")){
                jQuery(this).parent().parent().find(".slidy_blog_elements").animate({left : "-=200px"});
            }
            e.preventDefault();
            return false;
        });
}
});



<?php $buffer = ob_get_contents();
ob_end_clean();
echo str_replace("\n",null,$buffer);
//echo $buffer
?>
</script>

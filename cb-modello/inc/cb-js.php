<script type="text/javascript"> <?php ob_start();?>
'use strict';

jQuery(document).ready(function(){ 
"use strict";
jQuery('#mobile-menu li:has(ul)').doubleTapToGo();
jQuery('.nav-mobile').click(function(){
var atra=jQuery('#mobile-menu').css('display');
	if(atra=='block') jQuery('#mobile-menu').hide();
	else jQuery('#mobile-menu').show();
});

<?php
global $post;


$cb_get_js_generate=cb_get_js_generate_options($post->ID);
if($cb_get_js_generate['topw']=='yes') { ?>
jQuery('.t_hide').click(function(){
jQuery('.top_header_left_widget li').fadeOut('fast');
jQuery('.top_header_left_widget').slideToggle('slow');
jQuery('.top_header_widget').slideToggle('slow');
});
<?php } else {?>
jQuery('.t_hide').hide();
<?php } 

if($cb_get_js_generate['echo']=='yes') { ?>
Echo.init({
	offset: 3500,
	throttle: 150
	});

<?php }
if($cb_get_js_generate['listy']=='yes') { ?>
jQuery('.row.dont.prods').addClass('list_view');
jQuery('.grid-list-buttons li').toggleClass('active');
jQuery('.section-related-products .row.dont.prods').addClass('grid_view');
jQuery('.section-related-products .row.dont.prods').removeClass('list_view');
<?php } ?>

jQuery('.tabs').hide();

jQuery('#close_item').hide();

if(jQuery('#middle .aq-block').first().is(jQuery(".aq-block-ful:first"))){
	 jQuery('#middle').addClass('ptop0');
}


jQuery('#breadcrumbs').prepend('<i class="fa fa-home"></i> ');
jQuery('.woocommerce-breadcrumb').prepend('<i class="fa fa-home"></i> ');
var homeurl='<a href="<?php echo get_site_url(); ?>/">Home</a> » ';
var bread=jQuery('#breadcrumbs').html();
if(bread!=''&&bread!=undefined) {var bread_new=bread.replace(homeurl,'');
bread_new=bread_new.replace('»','/');
jQuery('#breadcrumbs').html(bread_new); }
var homeurl2='<a class="home" href="<?php echo get_site_url(); ?>">Home</a> » ';
var bread2=jQuery('.woocommerce-breadcrumb').html();
if(bread2!=''&&bread2!=undefined) { var bread2_new=bread2.replace(homeurl2,'');
bread2_new=bread2_new.replace('»','/');
jQuery('.woocommerce-breadcrumb').html(bread2_new); }
jQuery("#content select").select2(); 
jQuery("#sidebar_l select").select2(); 
jQuery("#sidebar_r select").select2();



jQuery('.builder-icon').each(function(){
	var ani1=jQuery(this).attr('data-ani1'); if(ani1!='') { jQuery(this).addClass('animate'); jQuery(this).addClass(ani1); }
	var ani2=jQuery(this).attr('data-ani2'); if(ani2!='') jQuery(this).addClass('ani_color_after_'+ani2);
	var ani3=jQuery(this).attr('data-ani3'); if(ani3!='') jQuery(this).addClass('fullbg-'+ani3);
	var ani4=jQuery(this).attr('data-ani4'); if(ani4!='') jQuery(this).addClass('fullbg-after_'+ani4);
	var wh=jQuery(this).attr('data-wh'); if(wh!='') jQuery(this).addClass(wh);
});

<?php
$g_grid='960';
if($cb_get_js_generate['grid']=='1170') $g_grid='1170';
?>




jQuery('.quick_preview_icon').click(function(){
var daid=jQuery(this).attr('data-id');
var pid=jQuery(this).attr('data-url');
jQuery('.quick_preview[data-id="'+daid+'"]').fadeIn('slow');
jQuery('.quick_preview[data-id="'+daid+'"]').load( pid+" #content > .product", function() {
});
});
jQuery( ".quick_preview" ).on( "mouseleave", function() {
  jQuery(this).fadeOut('slow');
  jQuery('.quick_preview').html('');
});
jQuery('.woo_step h1').click(function(){
	jQuery('.woo_step_in').stop().slideUp('slow');
	jQuery(this).parent().find('.woo_step_in').stop().slideDown('slow');
	jQuery('html,body').animate({
		   scrollTop: jQuery('.checkout_actions').offset().top
		});
	});
jQuery('.woo_step .step_continue').click(function(){
	jQuery('.woo_step.address .woo_step_in').stop().slideUp('slow');
	jQuery('.woo_step.place_order .woo_step_in').stop().slideDown('slow');
	jQuery('html,body').animate({
		   scrollTop: jQuery('.checkout_actions').offset().top
		});
	});













jQuery('.widget_top .icl_lang_sel_current').before('<i class="icon-globe"></i>');

jQuery('i').hide().delay('100').fadeIn('slow');

<?php if($cb_get_js_generate['scroll']=='yes') { ?>
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
<?php if($cb_get_js_generate['header_type']=='bg_head'&&$cb_get_js_generate['bg_image_url']!='') { ?>
jQuery(".slider_top").backstretch("<?php echo $cb_get_js_generate['bg_image_url']; ?>");
<?php } ?>


jQuery(".accordion").accordion({ header: "h3" });
jQuery('.tabs').slideDown('fast');

jQuery('.tabs').tabs({ hide: { effect: "slide", duration: 100 },show: { effect: "fade", duration: 200 } });


<?php if($cb_get_js_generate['disable_pp']=='no'){ ?>
jQuery("a[data-rel^='pp']").prettyPhoto({
hideflash: true,
wmode: 'opaque',
deeplinking: false
});
<?php } ?>

 jQuery('.wrapme :submit').addClass('submit');
 jQuery('.wrapme :submit').addClass('gr');
 jQuery('.bttn').addClass('gr');
 jQuery('.bttn_big').addClass('gr');
 jQuery('.w_50').addClass('round');
 jQuery('.b_50').addClass('round');

 jQuery(".top-menu ul li").hover(function(){
  jQuery(this).addClass("hover");
  jQuery('ul:first',this).hide();
  <?php if($cb_get_js_generate['mheadertype']!='left') { ?>jQuery('ul:first',this).stop().animate({top:'48px'}, {duration: 200, easing:'easeOutBack',queue: false}).fadeIn('200').css('display', 'block');
  <?php } else { ?>jQuery('ul:first',this).stop().animate({top:'63px'}, {duration: 200, easing:'easeOutBack',queue: false}).fadeIn('200').css('display', 'block');
  <?php } ?> }, function(){
 jQuery(this).removeClass("hover");
 jQuery('ul:first',this).animate({top:'48px'}, {duration: 100, easing:'easeOutBack',queue: false}).css('display', 'none');
 });



jQuery('.fade_c').addClass('skin_bg');










 
jQuery('.fade').hover(
<?php if($cb_get_js_generate['color_master']=='') { $cb_get_js_generate['color_master']=$cb_get_js_generate['color_style'];

$get_color='';

if($get_color=='white') $get_color='';
if($get_color!='') $cb_get_js_generate['color_style']=$get_color;

switch($cb_get_js_generate['color_style']) {
case 'grey': $cb_get_js_generate['color_master']='#767676'; break;
case 'bright_red': $cb_get_js_generate['color_master']='#d53838'; break;
case 'blue': $cb_get_js_generate['color_master']='#0f7ca9'; break;
case 'cocoa': $cb_get_js_generate['color_master']='#9e625c'; break;
case 'dark_brown': $cb_get_js_generate['color_master']='#5e392b'; break;
case 'white_coffee': $cb_get_js_generate['color_master']='#c9a789'; break;
case 'brown_coffee': $cb_get_js_generate['color_master']='#a1866d'; break;
case 'magenta': $cb_get_js_generate['color_master']='#881d98'; break;
case 'bordo': $cb_get_js_generate['color_master']='#b3293b'; break;
case 'orange': $cb_get_js_generate['color_master']='#e37f08'; break;
case 'green': $cb_get_js_generate['color_master']='#4AAD1F'; break;
case 'green_lemon': $cb_get_js_generate['color_master']='#94bc09'; break;
case 'paradise': $cb_get_js_generate['color_master']='#008f87'; break;
case 'violet': $cb_get_js_generate['color_master']='#ad5fa0'; break;
case 'purple_pink': $cb_get_js_generate['color_master']='#c72486'; break;
case 'raspberry_pink': $cb_get_js_generate['color_master']='#ed186d'; break;
case 'barbie_pink': $cb_get_js_generate['color_master']='#ed0992'; break;
}
}
?>
<?php if($cb_get_js_generate['color_master']!='') {  ?>
function(){
	var pt=jQuery(this).attr('class');var anih='';var anih2=''; var lw='';
	if(pt.indexOf("single_image") >= 0) anih='43%'; else anih='30%';
	if(pt.indexOf("portfolio-shape") >= 0) lw='100%'; else lw='80%';
	anih2=anih;
	if(pt.indexOf("portfolio-shape") >= 0) {anih='35%'; anih2='49%'}
	if(pt.indexOf("portfolio-shape") >= 0 && pt.indexOf("nocap") < 0) {anih='60%'; anih2='70%'}
	jQuery(this).find('img').stop().animate({left : '-'+lw}, 400);jQuery('.fade_c',this).stop().show().animate({width : lw}, 400);
	jQuery(this).find('.i2').hide().stop().show().animate({top:anih}, {duration: 200, easing:'easeInOutBack'}); 
	jQuery(this).find('.i1').hide().stop().show().animate({top:anih2}, {duration: 300, easing:'easeInOutBack'}); 
	},
	function(){ jQuery(this).find('img').stop().animate({left : '0'}, 400);jQuery('.fade_c',this).stop().animate({width : '0px'}, 400);
	jQuery(this).find('.icon').fadeOut('fast', function() {jQuery(this).css('top','0')});
}
<?php } else { ?>
function(){ 
var pt=jQuery(this).attr('class');var anih='';var anih2=''; var lw='';
if(pt.indexOf("single_image") >= 0) anih='43%'; else anih='30%';
if(pt.indexOf("portfolio-shape") >= 0) lw='100%'; else lw='80%';
anih2=anih;
if(pt.indexOf("portfolio-shape") >= 0) {anih='35%'; anih2='49%'}
if(pt.indexOf("portfolio-shape") >= 0 && pt.indexOf("nocap") < 0) {anih='60%'; anih2='70%'}
jQuery(this).find('img').stop().animate({left : '-'+lw}, 400);jQuery('.fade_c',this).stop().show().animate({width : lw}, 400);
jQuery(this).find('.i2').hide().stop().show().animate({top:anih}, {duration: 200, easing:'easeInOutBack'}); 
jQuery(this).find('.i1').hide().stop().show().animate({top:anih2}, {duration: 300, easing:'easeInOutBack'}); 
},
function(){ jQuery(this).find('img').stop().animate({left : '0'}, 400);jQuery('.fade_c',this).stop().animate({width : '0px'}, 400);
jQuery(this).find('.icon').fadeOut('fast', function() {jQuery(this).css('top','0')});
}
<?php } ?>
);


jQuery('.icons_text').css('width','0px');
jQuery('.icons a').hover(
function(){
	var text=jQuery(this).attr('data-title');
	var html=jQuery('.icons_text').html(); html='<div style="padding:0px 30px;">'+text+'</div>'; jQuery('.icons_text').html(html); jQuery('.icons_text div').hide();
	jQuery('.icons_text').stop().animate({width:'200px'}, 400);
	jQuery('.icons_text div').fadeIn('slow');
	
},function(){
	jQuery('.icons_text').stop().animate({width:'0px'}, 400);
	jQuery('.icons_text div').fadeOut('slow');
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

<?php 
if(!isset($cb_get_js_generate['sloganp'])) $cb_get_js_generate['sloganp']='';
if($cb_get_js_generate['sloganp']!='') { ?>
jQuery('.slider_top').prepend('<div class="slider_top_slogan"><div class="wrapme"><?php echo html_entity_decode($cb_get_js_generate['sloganp']);?></div></div>');
<?php } ?>

<?php if($cb_get_js_generate['slidertoptint']!='no'&&$cb_get_js_generate['slidertoptint']!='') { ?>
jQuery('.slider_top').addClass('slider_top_tint');
<?php if($cb_get_js_generate['slidertoptint']=='skin') { ?>jQuery('.slider_top').prepend('<div class="tint_skin"></div>');<?php } ?>
<?php if($cb_get_js_generate['slidertoptint']=='bdark') { ?>jQuery('.slider_top').prepend('<div class="tint_bdark"></div>');<?php } ?>
<?php if($cb_get_js_generate['slidertoptint']=='blight') { ?>jQuery('.slider_top').prepend('<div class="tint_blight"></div>');<?php } ?>
<?php if($cb_get_js_generate['slidertoptint']=='wdark') { ?>jQuery('.slider_top').prepend('<div class="tint_wdark"></div>');<?php } ?>
<?php if($cb_get_js_generate['slidertoptint']=='wlight') { ?>jQuery('.slider_top').prepend('<div class="tint_wlight"></div>');<?php } ?>
<?php if($cb_get_js_generate['slidertoptint']=='tblack') { ?>jQuery('.slider_top').prepend('<div class="tint_tblack"></div>');<?php } ?>
<?php if($cb_get_js_generate['slidertoptint']=='twhite') { ?>jQuery('.slider_top').prepend('<div class="tint_twhite"></div>');<?php } ?>
<?php } ?>
<?php 
if(!isset($cb_get_js_generate['header_tint'])) $cb_get_js_generate['header_tint']='';
if($cb_get_js_generate['header_tint']!='no'&&$cb_get_js_generate['header_tint']!='') { ?>
jQuery('.slider_top').addClass('slider_top_tint');
<?php if($cb_get_js_generate['header_tint']=='skin') { ?>jQuery('.slider_top').prepend('<div class="tint_skin"></div>');<?php } ?>
<?php if($cb_get_js_generate['header_tint']=='bdark') { ?>jQuery('.slider_top').prepend('<div class="tint_bdark"></div>');<?php } ?>
<?php if($cb_get_js_generate['header_tint']=='blight') { ?>jQuery('.slider_top').prepend('<div class="tint_blight"></div>');<?php } ?>
<?php if($cb_get_js_generate['header_tint']=='wdark') { ?>jQuery('.slider_top').prepend('<div class="tint_wdark"></div>');<?php } ?>
<?php if($cb_get_js_generate['header_tint']=='wlight') { ?>jQuery('.slider_top').prepend('<div class="tint_wlight"></div>');<?php } ?>
<?php if($cb_get_js_generate['header_tint']=='tblack') { ?>jQuery('.slider_top').prepend('<div class="tint_tblack"></div>');<?php } ?>
<?php if($cb_get_js_generate['header_tint']=='twhite') { ?>jQuery('.slider_top').prepend('<div class="tint_twhite"></div>');<?php } ?>
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



<?php if($cb_get_js_generate['fixed_top']=='yes') { ?> 
var fixed=false;
jQuery(window).scroll(function(){
if(jQuery(this).scrollTop() > 50){
if(!fixed) {
fixed=true;
jQuery('.head_top_container').addClass('is_anim');
jQuery('.head_top_container .skinimp').fadeIn('slow');
<?php if($cb_get_js_generate['mheadertype']!='left') { ?>
jQuery('.top_header').animate({'height' : '52px'}, { duration: 800, queue: false });
jQuery('.top_l').animate({'height' : '52px'}, { duration: 800, queue: false });
<?php if($cb_get_js_generate['mheadertype']!='center'&&$cb_get_js_generate['mheadertype']!='right') { ?>jQuery('.below_header').animate({'top' : '102px'}, { duration: 800, queue: false });<?php } ?><?php if($cb_get_js_generate['mheadertype']=='center') { ?>jQuery('.below_header').animate({'top' : '8px'}, { duration: 800, queue: false });<?php } ?>
<?php } if($cb_get_js_generate['mheadertype']=='left') { ?>
jQuery('.top_header').addClass('nope',800);
jQuery('.top_header').addClass('n_l',200);
jQuery('.top_header').addClass('nope_l',200);
jQuery('ul.cb-menu').addClass('nope',800);
jQuery('.below_header').animate({'top' : '3px'}, { duration: 300, queue: false });
<?php } if($cb_get_js_generate['mheadertype']=='center') { ?>
jQuery('.top_header').addClass('nope',800);
<?php } ?>
jQuery('.top_r').animate({'height' : '52px'}, { duration: 800, queue: false });
jQuery('ul.cb-menu li').animate({'padding-top' : '0px'}, { duration: 800, queue: false });
jQuery('ul.cb-menu li').animate({'padding-bottom' : '0px'}, { duration: 800, queue: false });
jQuery('.nav-mobile').animate({'margin-top' : '5px'}, { duration: 800, queue: false });

jQuery("ul.cb-menu li").hover(function(){
 jQuery(this).addClass("hover");
 jQuery('ul:first',this).hide();
 jQuery('ul:first',this).stop().animate({top:'66px'}, {duration: 200, easing:'easeOutBack',queue: false}).fadeIn('200').css('display', 'block');
}, function(){
jQuery(this).removeClass("hover");
jQuery('ul:first',this).animate({top:'50px'}, {duration: 100, easing:'easeOutBack',queue: false}).css('display', 'none');
});





}}
else {
if(fixed) {
fixed=false;

jQuery('.head_top_container').removeClass('is_anim');
jQuery('.head_top_container .skinimp').fadeOut('slow');
<?php if($cb_get_js_generate['mheadertype']!='left') { ?>
jQuery('.top_header').animate({'height' : '72px'}, { duration: 800, queue: false });
jQuery('.top_l').animate({'height' : '72px'}, { duration: 800, queue: false });
<?php if($cb_get_js_generate['mheadertype']!='center'&&$cb_get_js_generate['mheadertype']!='right') { ?>jQuery('.below_header').animate({'top' : '130px'}, { duration: 300, queue: false });<?php } ?><?php if($cb_get_js_generate['mheadertype']=='center') { ?>jQuery('.below_header').animate({'top' : '37px'}, { duration: 300, queue: false });<?php } ?>
<?php } if($cb_get_js_generate['mheadertype']=='left') { ?>
jQuery('.top_header').removeClass('nope',800);
jQuery('.top_header').removeClass('nope_l',200);
jQuery('ul.cb-menu').removeClass('nope',800);
jQuery('.below_header').animate({'top' : '10px'}, { duration: 800, queue: false });
<?php } if($cb_get_js_generate['mheadertype']=='center') { ?>
jQuery('.top_header').removeClass('nope',800);
<?php } ?>
jQuery('.top_r').animate({'height' : '72px'}, { duration: 800, queue: false });
jQuery('.nav-mobile').animate({'margin-top' : '15px'}, { duration: 800, queue: false });
jQuery('ul.cb-menu > li').animate({'padding-top' : '0px'}, { duration: 800, queue: false });
jQuery('ul.cb-menu > li').animate({'padding-bottom' : '0px'}, { duration: 800, queue: false });
jQuery("ul.cb-menu li").hover(function(){
	 jQuery(this).addClass("hover");
	 jQuery('ul:first',this).hide();
	 jQuery('ul:first',this).stop().animate({top:'66px'}, {duration: 200, easing:'easeOutBack',queue: false}).fadeIn('200').css('display', 'block');
	}, function(){
	jQuery(this).removeClass("hover");
	jQuery('ul:first',this).animate({top:'50px'}, {duration: 100, easing:'easeOutBack',queue: false}).css('display', 'none');
	});
}}
});
<?php } ?>






jQuery('.cart_top').hover(function(){
jQuery('.cart_hover').stop().fadeIn('slow');
},function(){
jQuery('.cart_hover').stop().fadeOut('slow');
});






<?php if($cb_get_js_generate['fixed_top']=='yes') { ?> 
var fixed=false;
if(jQuery(this).scrollTop() > 50){
if(!fixed) {
fixed=true;
jQuery('.head_top_container').addClass('is_anim');
jQuery('.head_top_container .skinimp').fadeIn('slow');
<?php if($cb_get_js_generate['mheadertype']!='left') { ?>
jQuery('.top_header').animate({'height' : '52px'}, { duration: 800, queue: false });
jQuery('.top_l').animate({'height' : '52px'}, { duration: 800, queue: false });
<?php if($cb_get_js_generate['mheadertype']!='center'&&$cb_get_js_generate['mheadertype']!='right') { ?>jQuery('.below_header').animate({'top' : '102px'}, { duration: 800, queue: false });<?php } ?><?php if($cb_get_js_generate['mheadertype']=='center') { ?>jQuery('.below_header').animate({'top' : '8px'}, { duration: 800, queue: false });<?php } ?>
<?php } if($cb_get_js_generate['mheadertype']=='left') { ?>
jQuery('.top_header').addClass('nope',800);
jQuery('ul.cb-menu').addClass('nope',800);
jQuery('.below_header').animate({'top' : '3px'}, { duration: 300, queue: false });
<?php } if($cb_get_js_generate['mheadertype']=='center') { ?>
jQuery('.top_header').addClass('nope',800);
<?php } ?>
jQuery('.top_r').animate({'height' : '52px'}, { duration: 800, queue: false });
jQuery('ul.cb-menu li').animate({'padding-top' : '0px'}, { duration: 800, queue: false });
jQuery('ul.cb-menu li').animate({'padding-bottom' : '0px'}, { duration: 800, queue: false });
jQuery('.nav-mobile').animate({'margin-top' : '5px'}, { duration: 800, queue: false });

jQuery("ul.cb-menu li").hover(function(){
 jQuery(this).addClass("hover");
 jQuery('ul:first',this).hide();
 jQuery('ul:first',this).stop().animate({top:'66px'}, {duration: 200, easing:'easeOutBack',queue: false}).fadeIn('200').css('display', 'block');
}, function(){
jQuery(this).removeClass("hover");
jQuery('ul:first',this).animate({top:'50px'}, {duration: 100, easing:'easeOutBack',queue: false}).css('display', 'none');
});





}}
else {
if(fixed) {
fixed=false;

jQuery('.head_top_container').removeClass('is_anim');
jQuery('.head_top_container .skinimp').fadeOut('slow');
<?php if($cb_get_js_generate['mheadertype']!='left') { ?>
jQuery('.top_header').animate({'height' : '72px'}, { duration: 800, queue: false });
jQuery('.top_l').animate({'height' : '72px'}, { duration: 800, queue: false });
<?php if($cb_get_js_generate['mheadertype']!='center'&&$cb_get_js_generate['mheadertype']!='right') { ?>jQuery('.below_header').animate({'top' : '130px'}, { duration: 300, queue: false });<?php } ?><?php if($cb_get_js_generate['mheadertype']=='center') { ?>jQuery('.below_header').animate({'top' : '37px'}, { duration: 300, queue: false });<?php } ?>
<?php } if($cb_get_js_generate['mheadertype']=='left') { ?>
jQuery('.top_header').removeClass('nope',800);
jQuery('ul.cb-menu').removeClass('nope',800);
jQuery('.below_header').animate({'top' : '10px'}, { duration: 800, queue: false });
<?php } if($cb_get_js_generate['mheadertype']=='center') { ?>
jQuery('.top_header').removeClass('nope',800);
<?php } ?>
jQuery('.top_r').animate({'height' : '72px'}, { duration: 800, queue: false });
jQuery('.nav-mobile').animate({'margin-top' : '15px'}, { duration: 800, queue: false });
jQuery('ul.cb-menu > li').animate({'padding-top' : '0px'}, { duration: 800, queue: false });
jQuery('ul.cb-menu > li').animate({'padding-bottom' : '0px'}, { duration: 800, queue: false });
jQuery("ul.cb-menu li").hover(function(){
	 jQuery(this).addClass("hover");
	 jQuery('ul:first',this).hide();
	 jQuery('ul:first',this).stop().animate({top:'66px'}, {duration: 200, easing:'easeOutBack',queue: false}).fadeIn('200').css('display', 'block');
	}, function(){
	jQuery(this).removeClass("hover");
	jQuery('ul:first',this).animate({top:'50px'}, {duration: 100, easing:'easeOutBack',queue: false}).css('display', 'none');
	});
}}
<?php } ?>










jQuery('.tabs').fadeIn('slow');


jQuery(".widget_top .show_search").click(function(){
jQuery(".widget_top .top_search").slideToggle('slow');
return false;
});
jQuery(".widget_top .show_search #s").click(function(){
return false;
});

jQuery('.footer .widget').hide();
jQuery('.footer .widget').slideDown(1500);

<?php if( ($cb_get_js_generate['slide_type']=='any'&&($cb_get_js_generate['home_slider']==''||$cb_get_js_generate['home_slider']=='none')&&( is_front_page()||is_home()||$cb_get_js_generate['slide_home']=='yes' ) )||$cb_get_js_generate['home_slider']=='any') { ?>
<?php } else { if($cb_get_js_generate['usescroll']=='nicescroll') { ?>
jQuery('html').niceScroll({
    cursorcolor: "#333",
    cursoropacitymin: 0.2,
    background: "#fff",
    cursorborder: "0",
    autohidemode: true,
    cursorminheight: 30
});
<?php } 
} ?>

if(jQuery(window).width()>940) {
	var tiless = jQuery('.knob');
	tiless.each(function(i) {
	  var add = (jQuery(this).offset().top);
	  var bdd = jQuery(window).scrollTop() + jQuery(window).height();
	    if (add < bdd) {
	           var knob = jQuery(this);
	           jQuery(this).parent().fadeIn('slow');
	           var myVal = knob.attr("data-rel");
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
	      var add = (jQuery(this).offset().top);
	      var bdd = jQuery(window).scrollTop() + jQuery(window).height();
	        if (add < bdd){
			   var knob = jQuery(this);
	           jQuery(this).parent().fadeIn('slow');
			   var myVal = knob.attr("data-rel");
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
	  var add = (jQuery(this).offset().top);
	  var bdd = jQuery(window).scrollTop() + jQuery(window).height();
	    if (add < bdd) {
	           var knob = jQuery(this);
	           var myVal = knob.attr("data-rel");
	           jQuery(this).parent().fadeIn('slow');
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
	}

jQuery('.product').first().addClass('first');


var timeouts = {};
jQuery('.product_featured_images').hover(function(){
	jQuery(this).find('.product_image').stop(true, true).fadeOut('slow');
    var el = jQuery(this);
    var el2 = jQuery(this).find('.product_image_extra1');
    var el3 = jQuery(this).find('.product_image_extra2');
	el2.stop(true, true).fadeIn('slow');
    if (timeouts[el2]) {clearTimeout(timeouts[el2]);}
    timeouts[el2] = setTimeout(function () { el2.fadeOut('slow'); }, 1500);
    if (timeouts[el3]) {clearTimeout(timeouts[el3]);}
    timeouts[el3] = setTimeout(function () { el3.fadeIn('slow'); }, 1700);
},function() {
    var el = jQuery(this);
    var el2 = jQuery(this).find('.product_image_extra1');
    var el3 = jQuery(this).find('.product_image_extra2');
    if (timeouts[el2]) {clearTimeout(timeouts[el2]);}
    if (timeouts[el3]) {clearTimeout(timeouts[el3]);}

	jQuery(this).find('.product_image').stop(true, true).fadeIn('slow');
	el2.stop(true, true).fadeOut('fast');
	el3.stop(true, true).fadeOut('fast');
});

var timer = {};
jQuery('.product_showcase').hover(function(){
	var show_pre=1;
	var di=jQuery(this);
	var pre_last=jQuery(this).find('.product_showcase_img').last().attr('data-id');
	var preold=1;
	for (var i = 1; i < pre_last*10; i++) {
		timer[i]=setTimeout(function(){
		di.find('.product_showcase_img'+preold).hide();
		if(preold==pre_last){preold=1;}
		preold=preold+1;
	    di.find('.product_showcase_img'+preold).show();
	    },i*200);
	}
},function(){
    for (var i = 1; i < 11*10; i++) {
			 clearTimeout(timer[i]);
	}
	var di=jQuery(this);
	di.find('.product_showcase_img').hide();
	di.find('.product_showcase_img1').show();
});

jQuery('#load_more_products').live('click', function(){
   var $mainContent = jQuery('.product-grid');
   var $pagenavi = jQuery('.page-numbers .current');
   var url = $pagenavi.closest('li').next().find('a').attr("href");
   $pagenavi.removeClass("current");
	$pagenavi.closest('li').next().find('a').addClass("current");
	$pagenavi = jQuery('.page-numbers .current');
	$mainContent.animate({opacity: "0.3"});
 jQuery("<div>").load(url+' .product-grid .product', function() {
      $mainContent.append(jQuery(this).html());
      checkMiniGalleries();
	  $mainContent.animate({opacity: "1"});
	   window.history.pushState(null, document.title, url);
});

	if ($pagenavi.closest('li').next().find('a').hasClass('next')) {
	jQuery(this).hide();
	jQuery('.woo_load_container').addClass('no_more');
	}
});

	<?php
    $g_grid='960';
    if($cb_get_js_generate['grid']=='1170') $g_grid='1170';
    ?>
    var windw=jQuery(window).width();
    var leftmi=windw-<?php echo $g_grid;?>; leftmi=leftmi/2; leftmi=-Math.abs(leftmi);
    leftmi=leftmi+12;
        jQuery('<style type="text/css"> .og-expander{ width:'+windw+'px!important;margin-left:'+leftmi+'px!important;} </style>').appendTo('head');
        
});







<?php $fade=$cb_get_js_generate['global_fade']; ?>

jQuery(document).on({
    mouseenter: function () {
	var clas=jQuery(this).attr('class');
	var clas2=jQuery(this).parent().attr('class');
if(clas.indexOf("none-ani") >= 0||clas2.indexOf("top_image_text")>=0||clas2.indexOf("left_image_text")>=0||clas2.indexOf("right_image_text")>=0||clas2.indexOf("bottom_image_text")>=0) {
		
} else {
	
	if(clas.indexOf("left_to_right") >= 0) {
		jQuery(this).find('.main_link img').stop().animate({left:'35%'}, {duration: 500, easing:'easeOutBack',queue: false});
		jQuery(this).find('.caption').stop().animate({width:'40%'}, {duration: 600, easing:'easeOutBack',queue: false}); 
	}
	if(clas.indexOf("only_icons") >= 0) {
		jQuery(this).find('.caption').stop().animate({width:'100%'}, {duration: 500, easing:'easeOutBack',queue: false}); 
	}
	if(clas.indexOf("only_icons_top") >= 0) {
		jQuery(this).find('.caption').stop().animate({height:'100%'}, {duration: 500, easing:'easeOutBack',queue: false}); 
	}
	if(clas.indexOf("e1_opacity") >= 0) {
		jQuery(this).find('.opa').stop(true).fadeTo('fast', 1);
	}
	jQuery(this).find('.caption h3').hide().stop().fadeIn('slow'); 
	jQuery(this).find('.caption .icon1').stop().animate({'bottom':'35%'}, {duration: 200, easing:'easeOutBack',queue: false}); 
	jQuery(this).find('.caption .icon2').stop().delay(200).animate({'bottom':'35%'}, {duration: 500, easing:'easeOutBack',queue: false}); 
	
} 

},mouseleave: function () {
	var clas=jQuery(this).attr('class');
	var clas2=jQuery(this).parent().attr('class');
	if(clas.indexOf("none-ani") >= 0||clas2.indexOf("top_image_text")>=0||clas2.indexOf("left_image_text")>=0||clas2.indexOf("right_image_text")>=0||clas2.indexOf("bottom_image_text")>=0) {
		
	}else {
		if(clas.indexOf("left_to_right") >= 0) {
			jQuery(this).find('.main_link img').stop().animate({left:'0'}, {duration: 200, easing:'swing',queue: false});
			jQuery(this).find('.caption').stop().animate({width:'0'}, {duration: 200, easing:'easeOutBack',queue: false}); 
		}
		if(clas.indexOf("only_icons") >= 0) {
			jQuery(this).find('.caption').stop().animate({width:'0'}, {duration: 200, easing:'easeOutBack',queue: false}); 
		}
		if(clas.indexOf("only_icons_top") >= 0) {
			jQuery(this).find('.caption').stop().animate({height:'0'}, {duration: 200, easing:'easeOutBack',queue: false}); 
		}
		 
		
		if(clas.indexOf("e1_opacity") >= 0) {
			jQuery(this).find('.opa').stop(true).fadeTo('slow', 0);
		}
		jQuery(this).find('.caption h3').stop().fadeOut('slow'); 
		jQuery(this).find('.caption .icon1').stop().animate({'bottom':'0'}, {duration: 100, easing:'easeOutBack',queue: false}); 
		jQuery(this).find('.caption .icon2').stop().delay(200).animate({'bottom':'0'}, {duration: 200, easing:'easeOutBack',queue: false}); 
		
	} 
}},'.featured_image');












jQuery(window).bind("load",function(){

	jQuery('.featured_image .contain img[src$=".png"]').addClass('ispng');

	if(jQuery(window).width()>850){

	<?php if($cb_get_js_generate['slide_header']=='yes') { ?>
	var revh= jQuery('.slider_top').height();
	jQuery(window).scroll(function () {
	        var rev= jQuery('.slider_top');
	        var revt=jQuery(window).scrollTop();
	        if(revt>0&&revt<revh) {
	        	rev.stop().animate({height: revh-(revt/3)}, {duration: 700, easing:'easeOutBack',queue: false});
	        } else if(revt<=revh){
	            rev.animate({height: revh}, {duration: 700, easing:'easeOutBack',queue: false});
	        }
	});
	<?php } ?>

	}/*if window width end*/

	if (window.location.hash=='#f1'||window.location.hash=='#f2'||window.location.hash=='#f3'||window.location.hash=='#f4'||window.location.hash=='#f5'||window.location.hash=='#f6'||window.location.hash=='#f7'||window.location.hash=='#f8'||window.location.hash=='#f9'||window.location.hash=='#f10'||window.location.hash=='#f11') {
		var haa=window.location.hash;
		    jQuery('html, body').animate({ scrollTop: jQuery('.'+haa.substr(1)).offset().top-100}, 500);
	}






	
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









<?php $buffer = ob_get_contents();
ob_end_clean();
echo str_replace("\n",null,$buffer);?>
</script>
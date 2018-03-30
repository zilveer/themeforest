<?php

if ( ! defined( 'ABSPATH' ) ) exit;


define( 'DONOTMINIFY', true );
define( 'DONOTCACHEPAGE', true );
define( 'DONOTCACHEDB', true );
define( 'DONOTCDN', true );
define( 'DONOTCACHCEOBJECT', true );

define( 'boutique_DO_DEMO', true );

// demo CSS background color changes:
if(strpos($_SERVER['HTTP_HOST'],'dtbaker.net') || strpos($_SERVER['HTTP_HOST'],'ocalhost')){
	add_action('wp_footer',function(){
		?>

		<!-- start theme demo code - copyright @dtbaker -->

		<style type="text/css">
			#dtbaker_demo_switcher{
				position: fixed;
				top:160px;
				z-index: 2999;
				right:-1px;
				background: #FFF;
				border:1px solid #e8e6d9;
				width:90px;
				min-height: 40px;
				opacity: 0.5;
				border-top-left-radius: 6px;
				border-bottom-left-radius: 6px;
				color:#999;
				padding-bottom: 6px;
			}
			#dtbaker_demo_switcher:hover{
				opacity: 1;
			}
			#dtbaker_demo_switcher_title{
				text-align: center;
				font-weight: bold;
				font-size: 12px;
				padding: 5px 0 2px;
				clear: both;
				border-bottom: 1px solid #e8e6d9;
			}
			#dtbaker_demo_switcher > div > div{
				text-align: center;
				font-weight: bold;
				font-size: 11px;
				padding: 5px 0 2px;
				clear: both;
			}
			#dtbaker_demo_switcher > div > a{
				display: inline-block;
				float:left;
				width:35px;
				height:35px;
				border:1px solid #EFEFEF;
				margin:0 0 5px 5px;
				background-size: 35px 35px;
				background-color: #f8e9cc;
			}
			#dtbaker_demo_switcher > div > a.current{
				border:1px solid #888;
			}
			#dtbaker_demo_switcher > div#demo_switcher_header > a,
			#dtbaker_demo_switcher > div#demo_switcher_sidebars > a{
				width: 22px;
				height:22px;
				font-size: 16px;
				background-color: #FFF;
				text-align: center;
				padding: 4px 0 0 0;
			}
			#dtbaker_demo_switcher_actions{
				text-align: center;
				margin:4px;
				clear:both;
			}
			#dtbaker_demo_switcher > div#dtbaker_demo_switcher_actions a{
				width:82px;
				height:auto;
				margin:8px auto 2px;
				background: #f3dbab;
				border-radius: 4px;
			}
			@media screen and (max-width: 700px) {
				#dtbaker_demo_switcher{
					display: none;
				}
			}
		</style>
		<script type="text/javascript" src="//tf.dtbaker.net/preview/jquery.cookie.js"></script>
		<script type="text/javascript">
			(function($){

				$('.wcml_currency_switcher_dtbaker_loading').html("Loading <br/> (note: this might not work in the demo)");

				function dtbaker_demo_sidebar_change(){
					var new_sidebar_val = $(this).data('sidebar');
					$(this).parent().find('.current').removeClass('current');
					$(this).addClass('current');
					$.cookie('dtbaker_demo_switcher_sidebar',new_sidebar_val);
					if(new_sidebar_val == 'none'){
						$('#column_wrapper').attr('id','column_wrapper_nosidebar');
						$('#column_wrapper_nosidebar > .content_main').removeClass().addClass('content_main no_sidebar');
						$('#column_wrapper_nosidebar .sidebar').hide();
					}else{
						$('#column_wrapper_nosidebar').attr('id','column_wrapper');
						$('#column_wrapper > .content_main').removeClass().addClass('content_main with-'+new_sidebar_val+'-sidebar');
						$('#column_wrapper .sidebar').removeClass().addClass('sidebar widget-area sidebar-'+new_sidebar_val+'');
						$('#column_wrapper .sidebar').show();
					}
					return false;
				}
				function dtbaker_demo_header_change(){
					var new_header_val = $(this).data('header');
					$(this).parent().find('.current').removeClass('current');
					$(this).addClass('current');
					$.cookie('dtbaker_demo_switcher_header',new_header_val);
					$('body').removeClass('boutique-header-1').removeClass('boutique-header-2').removeClass('boutique-header-3').addClass('boutique-header-'+new_header_val);
					if(new_header_val == 2){
						$('.boutique_page_header').addClass('page_header_fancy').css('background-color','#f8f4e9').find('.boutique_line_bird').remove();
					}else{
						$('.boutique_page_header').removeClass('page_header_fancy').css('background-color','transparent').find('.boutique_line_bird').remove();
						if(new_header_val == 1){
							$('.boutique_page_header').append('<div class="boutique_line_bird"></div>');
						}
					}
					return false;
				}
				function dtbaker_demo_style_change(){
					var change_what = $(this).data('change');
					var change_style = $(this).data('changestyle');
					var change_value = $(this).data('changevalue');
					var change_style_bits = change_style.split('|');
					var change_value_bits = change_value.split('|');
					for(var s in change_style_bits){
						$(change_what).css(change_style_bits[s],change_value_bits[s]);
					}
					$(this).parent().find('.current').removeClass('current');
					$(this).addClass('current');
					$.cookie('dtbaker_demo_switcher_'+change_style,change_value);
					return false;
				}
				var $demo_switcher = $('<div id="dtbaker_demo_switcher"><div id="dtbaker_demo_switcher_title">Theme Demo</div></div>');

				// start demo background color:
				var change_what = 'body,.demo_switcher_backgrounds', change_style = 'background-color';
				var current_value = $.cookie('dtbaker_demo_switcher_'+change_style);
				if(!current_value)current_value='#d3eef5';
				var $c = $('<div id="demo_switcher_colors"><div>BG Color:</div></div>'), $cc;
				var demo_colors=['#d3eef5','#ffeaf3','#c5dadd','#f8e9cc','#edecea','#ffffff','#f8f4e9','#c6efeb'];
				for(var i in demo_colors){
					$cc = $('<a href="#" class="demo_switcher_color" data-change="'+change_what+'" data-changestyle="'+change_style+'" data-changevalue="'+demo_colors[i]+'" style="'+change_style+':'+demo_colors[i]+'"><span></span></a>');
					if(demo_colors[i] == current_value)$cc.addClass('current');
					$cc.click(dtbaker_demo_style_change);
					$cc.appendTo($c);
				}
				$c.appendTo($demo_switcher);

				// start demo background image:
				change_what = 'body'; change_style = 'background-image|background-size';
				current_value = $.cookie('dtbaker_demo_switcher_'+change_style);
				if(!current_value)current_value="url('<?php echo get_template_directory_uri();?>/backgrounds/tile-heart-swirls.png')";
				var $b = $('<div id="demo_switcher_backgrounds"><div>BG Image:</div></div>');
				var demo_backgrounds=[
					"url('<?php echo get_template_directory_uri();?>/backgrounds/tile-heart-swirls.png')|598px 588px",
					"url('<?php echo get_template_directory_uri();?>/backgrounds/damask-pattern.png')|118px 166px",
					"url('<?php echo get_template_directory_uri();?>/backgrounds/Seamless-Floral.png')|298px 298px",
					"url('<?php echo get_template_directory_uri();?>/backgrounds/swirl-floral.png')|260px 260px",
					"url('<?php echo get_template_directory_uri();?>/backgrounds/diamond.jpg')|147px 147px"
				];
				var this_style_what = change_style.split('|');
				for(i in demo_backgrounds){
					var this_style_value = demo_backgrounds[i].split('|');
					var this_style = this_style_what[0] + ':' + this_style_value[0] + ';';
					/*for(var s in this_style_what){
					 this_style += this_style_what[s] + ':' + this_style_value[s] + ';';
					 }*/
					$cc = $('<a href="#" class="demo_switcher_background" data-change="'+change_what+'" data-changestyle="'+change_style+'" data-changevalue="'+demo_backgrounds[i]+'" style="'+this_style+'"><span></span></a>');
					if(demo_backgrounds[i] == current_value)$cc.addClass('current');
					$cc.click(dtbaker_demo_style_change);
					$cc.appendTo($b);
				}
				$b.appendTo($demo_switcher);

				// sidebar demo:
				if($('#column_wrapper .sidebar').length > 0) {
					current_value = $.cookie('dtbaker_demo_switcher_sidebar');
					var $s = $('<div id="demo_switcher_sidebars"><div>Sidebar:</div></div>');
					$('<a href="#" class="demo_switcher_sidebars" data-sidebar="left"><i class="fa fa-angle-double-left"></i></a>').click(dtbaker_demo_sidebar_change).addClass(current_value == 'left' ? 'current' : '').appendTo($s);
					$('<a href="#" class="demo_switcher_sidebars" data-sidebar="right"><i class="fa fa-angle-double-right"></i></a>').click(dtbaker_demo_sidebar_change).addClass(current_value == 'right' ? 'current' : '').appendTo($s);
					$('<a href="#" class="demo_switcher_sidebars" data-sidebar="none"><i class="fa fa-times"></i></a>').click(dtbaker_demo_sidebar_change).addClass(current_value == 'none' ? 'current' : '').appendTo($s);
					$s.appendTo($demo_switcher);
				}
				if($('.boutique_page_header').length > 0) {
					var $h = $('<div id="demo_switcher_header"><div>Header:</div></div>');
					current_value = $.cookie('dtbaker_demo_switcher_header');
					if(!current_value){
						current_value = $('body').hasClass('boutique-header-1') ? '1' : ($('body').hasClass('boutique-header-2') ? '2' : ($('body').hasClass('boutique-header-3') ? '3' : false));
					}
					$('<a href="#" class="demo_switcher_header" data-header="1">1</a>').click(dtbaker_demo_header_change).addClass(current_value == '1' ? 'current' : '').appendTo($h);
					$('<a href="#" class="demo_switcher_header" data-header="2">2</a>').click(dtbaker_demo_header_change).addClass(current_value == '2' ? 'current' : '').appendTo($h);
					$('<a href="#" class="demo_switcher_header" data-header="3">3</a>').click(dtbaker_demo_header_change).addClass(current_value == '3' ? 'current' : '').appendTo($h);
					$h.appendTo($demo_switcher);
				}
				// close/buy button
				var $a = $('<div id="dtbaker_demo_switcher_actions"></div>');
				$('<a href="#">Hide Sidebar</a>').click(function(){$('#dtbaker_demo_switcher').hide();}).appendTo($a);
				$('<a href="http://themeforest.net/user/dtbaker/portfolio?ref=dtbaker" target="_blank">Get Theme</a>').appendTo($a);
				$a.appendTo($demo_switcher);

				// add it to the page:
				$demo_switcher.appendTo('body');
				$demo_switcher.find('.current').click();

			})(jQuery);
		</script>

		<!-- end theme demo code - copyright @dtbaker -->
		<?php
	});
}
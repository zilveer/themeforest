<?php
	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	
	//Access WordPress
	require_once( $path_to_wp.'/wp-load.php' );
	
	global $unik_data;
	$state = explode($_SERVER['HTTP_HOST'],home_url());
	
	header("Content-type: text/javascript; charset: UTF-8");
	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		echo 'var woocommerce = true;';
	}else{
		echo 'var woocommerce = false;';
	}
	
	//wpml check
	if(class_exists('SitePress')){
		echo 'var wpml = true';  
	}
	else{
		echo 'var wpml = false';
	}
?>

	var ajaxScreenSize =  <?php echo $unik_data['ajax_screen_size']; ?>;

// selective nav
window.selectnav=function(){"use strict";var e=function(e,t){function c(e){var t;if(!e)e=window.event;if(e.target)t=e.target;else if(e.srcElement)t=e.srcElement;if(t.nodeType===3)t=t.parentNode;if(t.value)window.location.href=t.value}function h(e){var t=e.nodeName.toLowerCase();return t==="ul"||t==="ol"}function p(e){for(var t=1;document.getElementById("selectnav"+t);t++);return e?"selectnav"+t:"selectnav"+(t-1)}function d(e){a++;var t=e.children.length,n="",l="",c=a-1;if(!t){return}if(c){while(c--){l+=o}l+=" "}for(var v=0;v<t;v++){var m=e.children[v].children[0];if(typeof m!=="undefined"){var g=m.innerText||m.textContent;var y="";if(r){y=m.className.search(r)!==-1||m.parentNode.className.search(r)!==-1?f:""}if(i&&!y){y=m.href===document.URL?f:""}n+='<option value="'+m.href+'" '+y+">"+l+g+"</option>";if(s){var b=e.children[v].children[1];if(b&&h(b)){n+=d(b)}}}}if(a===1&&u){n='<option value="">'+u+"</option>"+n}if(a===1){n='<select class="selectnav" id="'+p(true)+'">'+n+"</select>"}a--;return n}e=document.getElementById(e);if(!e){return}if(!h(e)){return}if(!("insertAdjacentHTML"in window.document.documentElement)){return}document.documentElement.className+=" js";var n=t||{},r=n.activeclass||"active",i=typeof n.autoselect==="boolean"?n.autoselect:true,s=typeof n.nested==="boolean"?n.nested:true,o=n.indent||"→",u=n.label||"- Navigation -",a=0,f=" selected ";e.insertAdjacentHTML("afterend",d(e));var l=document.getElementById(p());if(l.addEventListener){l.addEventListener("change",c)}if(l.attachEvent){l.attachEvent("onchange",c)}return l};return function(t,n){e(t,n)}}()



/* AJAX LOAD
---------------------------------------------------------------------------------------------*/	
	var init = true, 
		state = window.history.pushState !== undefined,
		activeColor = '<?php echo $unik_data['active_bg_color']; ?>',
		niceScroll = <?php echo $unik_data['nice_scroll']; ?>;

	var base = "<?php echo home_url(); ?>",
		STATE = '<?php echo $state[1]; ?>',
		tempDir = '<?php echo get_template_directory_uri(); ?>';

	var ie = (function(){
		var undef,
			v = 3,
			div = document.createElement('div'),
			all = div.getElementsByTagName('i');

		while (
			div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
			all[0]
		);

		return v > 4 ? v : undef;

	}());

jQuery(document).ready(function ($) {

	"use strict";

	<?php if(isset($unik_data['ajax_load']) && $unik_data['ajax_load']== 1): ?>
	
	
    // set variables
    var
	$mainContent = $("#ajax-content"),
	$ajaxSpinner = $("#ajax-loader"),
	$searchInput = $("#s"),
	$allLinks = $("a"),
	Href,
	$el;
	
	if (typeof(firstLoad) === 'undefined') {
		var firstLoad = true;
	}

	if(ie === undefined){	
		var init = true, 
		state = window.history.pushState !== undefined;

		// query search results
		$('#searchform').submit(function (e) {
			window.firstLoad = false;
			var s = $searchInput.val().replace(/ /g, '+');
			if (s) {
				var query = '/?s=' + s;
				$.address.value(query);
			}		
			e.preventDefault();
		});
		
		
		
		$(document).on("click", "a:urlInternal", function(e) {
			window.firstLoad = false;
			$el = $(this); // Caching
			var Href = $el.attr('href');
						
			if ( $(window).width() >= ajaxScreenSize && (!$el.hasClass("comment-reply-link")) && ($el.attr("id") != 'cancel-comment-reply-link') && Href.indexOf('wp-admin') === -1 && Href.indexOf('wp-login') === -1 && Href.indexOf('.jpg') === -1 && Href.indexOf('.png') === -1 && Href.indexOf('.gif') === -1 && Href.indexOf('.zip') === -1 && Href.indexOf('.pdf') === -1&& Href.indexOf('.mp3') === -1 && Href.indexOf('#') === -1 && Href.indexOf('feed') === -1 && Href.indexOf('add-to-cart') === -1) {
				e.preventDefault();		
				
				var path = $(this).attr('href').replace(base, '');
				
				if(window.location.href.replace(/\/$/, '') !== Href){
					if(path==='' || path==='/'){
						$.address.state(STATE).value(' ');
					}else{

						$.address.state(STATE).value(path);
					}				
				}
				
				// delete zoom container
				$(document).find('.zoomContainer').remove();
					
			}
			
		});


		// ALL AJAX Stuff
		
		$.address.state(STATE).init(function() {
			$('.wrap a:urlInternal:eq(-"wp-admin"):eq(-"wp-login"):eq(-"#"):eq(-".jpg"):eq(-".gif"):eq(-".png"):eq(-".zip"):eq(-".pdf"):eq(-".mp4"):eq(-".mp3"):eq(-"feed")').address();
		}).change(function (event) {
			event.value = event.value.replace(' ','');				
			var Href = event.value;
			var Location = window.location;	
			
			if(window.firstLoad==false){
				
				if (event.value && Href.indexOf('wp-admin') === -1 && Href.indexOf('wp-login') === -1 && Href.indexOf('.jpg') === -1 && Href.indexOf('.png') === -1 && Href.indexOf('.gif') === -1 && Href.indexOf('.mp3') === -1 && Href.indexOf('.wma') === -1 && Href.indexOf('.mp4') === -1 && Href.indexOf('.zip') === -1 && Href.indexOf('.pdf') === -1 && Href.indexOf('#') === -1 && Href.indexOf('feed') === -1) {
				
					$ajaxSpinner.fadeIn('fast').addClass('active');	
					$mainContent.animate(function(){
						opacity: '0';
					},400);
					
					
					$.ajax({
						url: base + event.value,
						dataType: "html",
						method: "get",
						cache: false,
						success: function (data) {
							var result = $('<div>'+data+'</div>').find('#ajax-content');
							var Scripts , pageBg ,Allcontent;						
							Allcontent = $('<div>'+data+'</div>');
							
							if(Allcontent.find('#primary').length < 1){
								window.location = base + event.value;
								$ajaxSpinner.fadeOut('fast').removeClass('active');
								$mainContent.animate(function(){
									opacity: '1';
								},400);
								return false;
							}
							
							Scripts =  $('<div>'+data+'</div>').find('script[src]');
							pageBg  = Allcontent.find('.page_bg');					
							$('#menu').html(Allcontent.find('#menu').html());					
							$('.page_bg').attr('style',pageBg.attr('style'));
							
							if(wpml==true){
								$('#lang_sel').html(Allcontent.find('#lang_sel').html());
							}
							
							if (typeof(body) === 'undefined') {var body = '';}
							if (typeof(Newbody) === 'undefined') {var Newbody = '';}
	
							body = data.split('<body');
							body = body[1];
							body = body.split('>');
							body = body[0];
							
							
							
							body = $('<div id="body-class" '+body+'></div>');
							var bodyClass = body.attr('class');
							$('body').attr('class',bodyClass); // update body class
							
							$('#menu').html(Allcontent.find('#menu').html());
							$('.page_bg').attr('style',pageBg.attr('style'));
							var Head = data.split('<head>');
							Head = Head[1].split('</head>');
							var Head = $('<div>'+Head[0]+'</div>');
							
							$('title').html(Head.find('title').html()); // update new title
							
							// find new inline css
							Allcontent.find('style').each(function(){
								var Currbody =  $('html').html();
								if(Currbody.indexOf($(this).html()) === -1){
									$('head').append('<style>'+$(this).html()+'</style>');
								}
							});
							
							
							var fullContent = $('<div>'+data+'</div>')
							// find all css
							fullContent.find('link[rel="stylesheet"]').each(function(){
								var src = $(this).attr('href');
								src = src.split('/');
								
								if(src[src.length] < 0){
									src = src[src.length-1];
								}else{
									src =  $(this).attr('href');
								}
								
								if(src.indexOf('.css') > 0){
									src = src.split('.css');
									src = src[0];

									var exHead = $('html').html();
									
									// insert any new css file
									if(exHead.indexOf(src) < 0){
										$('head').append('<link href="'+src+'.css" rel="stylesheet" type="text/css">');
									}
								}
							});
							
							// find all js
							
							
							
							fullContent.find('script').each(function(){
								var src = $(this).attr('src');
								if(typeof src != 'undefined' && src !==''){
									src = src.split('/');
									
									if(src[src.length] < 0){
										src = src[src.length-1];
									}else{
										src =  $(this).attr('src');
										
									}
									if(src.indexOf('.js') > 0){
										src = src.split('.js');
										src = src[0];
										
										var exHead = $('html').html();
										
										// insert any new js file
										if(exHead.indexOf(src) < 0){
										//	$.getScript(src+'.js');
										}
									}
								}
							});
							
							
						$mainContent.html(result.html()).attr('class',result.attr('class'));
						$ajaxSpinner.fadeOut('fast').removeClass('active');
						$mainContent.animate(function(){
								opacity: '1';
							},400);
						$.get(window.location);
							
<?php 
	$ajax_scripts = $unik_data['ajax-scripts'];	
	if(is_array($ajax_scripts)):
	
	// ajax load scripts from theme option
	foreach ($ajax_scripts as $ajax_script):
	
	if($ajax_script['url']!==''):
?>

	$.getScript('<?php echo $ajax_script['url']; ?>');	

<?php endif; endforeach; endif; ?>
							
							$.getScript(tempDir+'/js/main.js');	
							
							// woocommerce need to refresh
							if(woocommerce === true){
								$.getScript('<?php echo plugins_url(); ?>/woocommerce/assets/js/frontend/woocommerce.min.js');
								$.getScript('<?php echo plugins_url(); ?>/woocommerce/assets/js/frontend/cart-fragments.min.js');
								$.getScript('<?php echo plugins_url(); ?>/woocommerce/assets/js/frontend/price-slider.js');
								$.getScript('<?php echo plugins_url(); ?>/woocommerce/assets/js/frontend/single-product.min.js');
								$.getScript('<?php echo plugins_url(); ?>/woocommerce/assets/js/frontend/add-to-cart-variation.min.js');
							}
							
							
							var found = false;
							
							Scripts.each(function(){
								var NewScript = $(this).attr('src');
								$('html script[src]').each(function(){
								
									if($(this).attr('src')===NewScript){
										found = true;
										return found;
									}								
								});
								if(found === false){
									$.getScript(NewScript);
								}
								found = false;	
							});
							$('.animate-init').removeClass('animate-init');
							
						},
						error: function (xhr, status, err) {
							window.location.href = base + event.value;
						}

					});
					
				}		
			}
			
		});
		
	}
	// menu toggle on click
	$(document).on('click','#menu a',function(){
		if( $(window).width() < 768 && $('.menu.navbar-collapse').hasClass('in') ){
			$('.menu.navbar-collapse').removeClass('in').addClass('collapse').css('height','1px');
		}
	});

	<?php endif; ?>
		
/* SMALL TOP MENU ON SCROLL
---------------------------------------------------------------------------------------------*/	
	var topMenu = $('.main-top'),
	pos = topMenu.offset();
	
	//check if page is already scrolled
	if($(this).scrollTop()>50){
		topMenu.removeClass('default').addClass('small');
	}
	
	//add margin to header if admin bar is active
	
	if($("#wpadminbar").length===1){
		topMenu.css("margin-top",$("#wpadminbar").height()+"px");
	}
	$(window).resize(function(){
		if($("#wpadminbar").length===1){
				topMenu.css("margin-top",$("#wpadminbar").height()+"px");
		}
	});
	
	
	$(window).scroll(function(){		
		if($(this).scrollTop() > pos.top+topMenu.height() && topMenu.hasClass('default')){
			topMenu.addClass('small');
		} else if($(this).scrollTop() <= pos.top && topMenu.hasClass('small')){
			topMenu.removeClass('small');
		}
	});

	
/* RESERVATION WIDGET TOGGLE
---------------------------------------------------------------------------------------------*/	
	$("#reservation-toggle").click(function(){
		$("#reservation-widget").slideToggle('slow');
	});
	
	
/* BACK TO TOP & GO TO BOTTOM
---------------------------------------------------------------------------------------------*/	
		var settings = {
				buttonTotop      : '#back-to-top',
				textTop        : 'Bact to top',
				min         : 200,
				fadeIn      : 400,
				fadeOut     : 400,
				scrollSpeed : 800,
				easingType  : 'easeInOutExpo'
			},
			oldiOS     = false,
			oldAndroid = false;

		// Detect if ios devices that does not support fixed position
		if( /(iPhone|iPod|iPad)\sOS\s[0-4][_\d]+/i.test(navigator.userAgent) )
			{oldiOS = true;}

		// Detect if ios devices that does not support fixed position
		if( /Android\s+([0-2][\.\d]+)/i.test(navigator.userAgent) )
			{oldAndroid = true;}
		
	

		$( settings.buttonTotop ).on('click', function( e ){
				$('html, body').animate({ scrollTop : 0 }, settings.scrollSpeed, settings.easingType );
				
				e.preventDefault();				
			});
		
			$( settings.buttonTobottom ).on('click', function( e ){
			$('html, body').animate({ scrollTop : $(document).height() }, settings.scrollSpeed, settings.easingType );
			
			e.preventDefault();				
		});		
			
		$(window).scroll(function() {
			var position = $(window).scrollTop();
			var docHeight = $(document).height();
			var windowHeight = $(window).height();
			 
			if( oldiOS || oldAndroid ) {
				$( settings.buttonTotop ).css({
					'position' : 'absolute',
					'top'      : position + $(window).height()
				});
				
			}

			if ( position > settings.min ){	$( settings.buttonTotop ).addClass('on').removeClass('off');}
			else {$( settings.buttonTotop ).removeClass('on').addClass('off');}
			

			
		});

		
/* BACKGROUND SLIDER
---------------------------------------------------------------------------------------------*/	
<?php if(!empty($unik_data['supersized_slider']) && $unik_data['body_bg_image'] == ''): /* Slider is off is not image found */ ?>		
 $(window).load(function() {
  

	$.supersized({
	
		// Functionality
		slideshow               :   <?php echo $unik_data['slideshow']; ?>,			// Slideshow on/off
		autoplay				:	1,			// Slideshow starts playing automatically
		start_slide             :   1,			// Start slide (0 is random)
		stop_loop				:	0,			// Pauses slideshow on last slide
		random					: 	0,			// Randomize slide order (Ignores start slide)
		slide_interval          :   <?php echo $unik_data['slide_interval']; ?>,		// Length between transitions
		transition              :   <?php print_r( $unik_data['transition']); ?>	,		// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
		transition_speed		:	<?php echo $unik_data['transition_speed']; ?>,		// Speed of transition
		new_window				:	0,			// Image links open in new window/tab
		pause_hover             :   0,			// Pause slideshow on hover
		keyboard_nav            :   0,			// Keyboard navigation on/off
		performance				:	0,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
		image_protect			:	1,			// Disables image dragging and right click with Javascript
												   
		// Size & Position						   
		min_width		        :   0,			// Min width allowed (in pixels)
		min_height		        :   0,			// Min height allowed (in pixels)
		vertical_center         :   1,			// Vertically center background
		horizontal_center       :   1,			// Horizontally center background
		fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
		fit_portrait         	:   1,			// Portrait images will not exceed browser height
		fit_landscape			:   0,			// Landscape images will not exceed browser width
												   
		// Components							
		slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
		thumb_links				:	1,			// Individual thumb links for each slide
		thumbnail_navigation    :   1,			// Thumbnail navigation
		slides 					:  	[			// Slideshow Images
									<?php 
										$slides = $unik_data['supersized_slider'];
										foreach ($slides as $slide){ ?>
											{image : '<?php echo $slide['url']; ?>', title : '<?php echo $slide['title']; ?>', thumb : '', url : '<?php echo $slide['link']; ?>'},
									<?php	} ?>
					
									],
									
		// Theme Options			   
		progress_bar			:	1,			// Timer for each slide							
		mouse_scrub				:	0
		
	});
});	

<?php endif; ?>

/* NAVIGATION MENU
---------------------------------------------------------------------------------------------*/	 
	
	var menu = $('#menu').superfish({
		delay: 200,
		speed: 200,
		autoArrows: true		
	});


/* RESPONSIVE navigation
---------------------------------------------------------------------------------------------*/	 

	<?php if($unik_data['responsive_nav_type']=='select'): ?>
		selectnav("menu");
	<?php else: ?>
		$('.logo').append('<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".menu.navbar-collapse">\
        <span class="icon-bar"></span>\
        <span class="icon-bar"></span>\
        <span class="icon-bar"></span>\
      </button>');
		
	<?php endif; ?>
	
/* FOOTER AUDIO PLAYER
---------------------------------------------------------------------------------------------*/	
<?php 
	$songs = $unik_data['song_list'];	
?>	

$(window).load(function(){
		
		<?php if($unik_data['audio-autoplay']==1){ ?>
			// Adapted from: http://remysharp.com/2010/12/23/audio-sprites/
			var click = document.ontouchstart === undefined ? 'click' : 'touchstart';
			var kickoff = function () {
				$("#footer_jplayer").jPlayer("play");
				document.documentElement.removeEventListener(click, kickoff, true);
			};
			document.documentElement.addEventListener(click, kickoff, true);		
		<?php } ?>

		
	var FooterPlaylist = new jPlayerPlaylist({
		jPlayer: "#footer_jplayer",
		cssSelectorAncestor: "#jp_footer_container"
	}, [
		
<?php 
	foreach ($songs as $song):

?>
		{
			title:"<?php echo $song['title']; ?>",
			free:false,
			mp3: "<?php echo $song['url']; ?>",
			artist:"<?php echo $song['artist']; ?>",
			poster: "<?php echo $song['poster_url']; ?>"
		},
<?php endforeach; ?>
  
	], {
		playlistOptions: {
<?php if($unik_data['audio-autoplay']==1){ ?>
			autoPlay: true,
<?php } ?>		
			enableRemoveControls: true,
			displayTime: 'slow',
		},
		swfPath: "<?php echo get_template_directory_uri(); ?>/js",
		supplied: "webmv, ogv, m4v, oga, mp3",
		errorAlerts: false,
		warningAlerts: false,
		toggleDuration: true
	});
	
	
	// footer mp3 player	


	$(document).on('click','.cp-play',function(e) {

		var $parent = $(this).parents('.cp-controls'),
		$title = $parent.attr('data-title'),
		$artist = $parent.attr('data-artist'),
		$poster = $parent.attr('data-poster'),
		$source = $parent.attr('data-source'),
		$button = $(this);
		nt_add_song($title, $artist, $source, $poster, $button);
		e.preventDefault();
	});

	$(document).on('click','.cp-pause',function(e) {
		FooterPlaylist.pause();
		$(this).hide();
		$(this).siblings('.cp-play').show();
		e.preventDefault();
	});


	//function to add song
	function nt_add_song($title, $artist, source, $poster, button){
		var data = {
		'action': 'unik_decript_song',
		'song': source  
		};


		jQuery.post('<?php echo admin_url( 'admin-ajax.php' ); ?>', data, function(response) {
			
			var found = checkPlayList($title);
			if(found=='no'){
				var index = addToFooterList($title, $artist, response, $poster, button);
				playByIndex(index,button);	
			}else{
				playByIndex(found,button);	
			}
		});

	}	

	//function to add song to footer list
	function addToFooterList($title, $artist, $source, $poster, button){
		FooterPlaylist.add({
				title: $title,
				mp3: $source,
				poster: $poster,
				artist: $artist,
			});

		var index = checkPlayList($title);
		return index;
	}

	//function to play song by index
	function playByIndex(index,button){
		FooterPlaylist.play(index);
	}

	//function to check list by title
	function checkPlayList($title){
		var found = 'no';
		$('#jp_footer_container .playlist li').each(function(){
			var $listTitle = $(this).find('.jp-playlist-item').html().split('<span');
			$listTitle = $listTitle[0];
			$listTitle = $listTitle.replace(/\s/g, "");
			$title = $title.replace(/\s/g, "");

			if( $listTitle == $title ){
				var index = $(this).parent().children('li').index($(this));
				found = index;
			}
		});
		return found;
	}

	// footer player event
	
	$('#footer_jplayer').bind($.jPlayer.event.play, function(event) { 

		if($('section.footer-player').hasClass('inactive')){
			$('section.footer-player').removeClass('inactive');
			$('.site-footer').addClass('has-footer');
		}
		
		$(document).find('.cp-controls.active').removeClass('active');

		//change icon of current track
		var $listTitle = $('#jp_footer_container .playlist').find('a.jp-playlist-current').html().split('<span');
		$listTitle = $listTitle[0];
		var CurTitle = $listTitle ;
		$listTitle = $listTitle.replace(/\s/g, "");
		

		$('.cp-controls').each(function(){
			var $title = $(this).attr('data-title');
			$title = $title.replace(/\s/g, ""); //removing white spaces
			if( $listTitle == $title ){
				$(this).addClass('active');
			}

		});

		

	    //track title update
	    $('.footerplayer-right .footerplayer-thumb').html($('#footer_jplayer img').clone().removeAttr('style'));
	    $('.footerplayer-right .footerplayer-desc .track-title').text(CurTitle);

	    $('.footerplayer-right .footerplayer-desc .track-artist').text($('#jp_footer_container .playlist').find('a.jp-playlist-current .jp-artist').text());

	});
	

	$('#footer_jplayer').bind($.jPlayer.event.pause, function(event) { 
	    var Title = $('#jp_footer_container .playlist').find('a.jp-playlist-current').text();
	   	$('.cp-controls[data-title="'+Title+'"]').find('.cp-play').show();
	    $('.cp-controls[data-title="'+Title+'"]').find('.cp-pause').hide();
	});

});


$('.sound_control').toggle(function(){
   $('.jp-playlist').addClass('animated fadeInLeft active');
   setTimeout(function(){
   		$('.jp-playlist').removeClass('animated fadeInLeft');
   },400);

},function(){  
	$('.jp-playlist').addClass('animated fadeOutLeft');

	setTimeout(function(){
   		$('.jp-playlist').removeClass('animated fadeOutLeft active');
   },400);
});
	
	
	

/* Other
---------------------------------------------------------------------------------------------*/	

	
//jquery end	
});
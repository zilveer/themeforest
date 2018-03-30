var $ = jQuery.noConflict();
// Settings and Variables
var bgRunning = false;
var bgTimer;
var menuTimer;
var subMenuTimer;
var pageLoading=false;
var myAudio, btnSound;
var animateMenuPosition = true;
var twtTimer;
var showBgCaption = true;
var audioSupport = true;
var mobileDevice = false;
var minWidth = 1000;
var ytplayer;
var hasTouch = 'ontouchstart' in window;
var ytPlayerReady = false;
var bgPatternV = 'block';
var bgStretch = true;
// Detect mobile device
if( navigator.userAgent.match(/Android/i) ||
 navigator.userAgent.match(/webOS/i) ||
 navigator.userAgent.match(/iPhone/i) ||
 navigator.userAgent.match(/iPad/i) ||
 navigator.userAgent.match(/iPod/i)
 ){
	mobileDevice = true;
}

// Init after Loaded
$(window).load(function(){
	// Set deeplink
	$.history.init(openPage);
	
	// Dedect browser
	if($.browser.msie && $.browser.version<9)
	{
		audioSupport = false;
		$('#audioControls').hide();
	}
	
	if(mobileDevice)
	{
		normalFade = true;
		audioSupport = false;
		bgPaused = true;
		$('#audioControls').hide();
	}
	
	if(mobileDevice){
		videoPaused = true;
		bgPatternV = 'none';
		$('#bgPattern').hide();
		
		$('#videoExpander').click(function(){
			if(activePlayer=='youtube' || activePlayer=='vimeo'){
				window.location = '#[playvideo]';
			}
		});
		
	}

	$(window).bind('resize', function() {
			doSize();
		});
	$(window).bind('scroll', function() {
			doSize();
		});
	$('#bgImages li:first-child').addClass('active');
	runBg();
	
	$(document).mousemove(function(e){
	
		if(!menuPositionFixed)
		{
			if($('#menu-container').position().left<=($('#menu-container').outerWidth())*-1 && animateMenuPosition)
			{
				var menuY = e.pageY;
				var maxY = $('#body-wrapper').height()-$('#menu-container').height()-75;
				if(e.pageY<$('#menu-container').height()+50)
					menuY = $('#menu-container').height()+50;
				if(e.pageY>maxY)
					menuY = maxY;
				$('#menu-container').stop().animate({top:(menuY-35)}, 1000, 'easeOutQuad');
			}
		}
		
		if(e.pageX > ($('#body-wrapper').width()-$('#bgImages').width()-20) && e.pageX<($('#body-wrapper').width()-20))
		{
			var posTop = parseInt(($('#bgImages').height()/($('#body-wrapper').height()-$('#footer').height()))*e.pageY)*-1;
			if(posTop>0)
				posTop=0;
			if(posTop<=($('#body-wrapper').height()-$('#footer').height())-$('#bgImages').height())
				posTop=($('#body-wrapper').height()-$('#footer').height())-$('#bgImages').height();
			if($('#body-wrapper').height()>$('#bgImages').height())
				posTop = 0;
			$('#bgImages').stop().animate({top:posTop}, 300);
			setCaptionPosition();
		}
	}); 
	
	$('#bgImages li').hover(function(){
			$(this).find('img.thumb').stop().animate({opacity:'1'}, 500);
	},function(){
		if(!$(this).hasClass('active'))
			$(this).find('img.thumb').stop().animate({opacity:'.4'}, 500);
	});
	$('#bgImages li').click(function(){
		if(!$(this).hasClass('active') && !bgRunning)
		{
			clearInterval(bgTimer);
			$('#bgImages li').removeClass('active');
			$(this).addClass('active');
			runBg();
		}
	});
	
	initMenu();
	doSize();
	
	// Social ToolTip
	$('#share .tip').hover(function(){
		if($(this).attr('tips-id')==undefined)
			$(this).attr('tips-id', 'tips-'+randomString(5));
		var tipsID = $(this).attr('tips-id');
		if($('#'+tipsID).length==0){
			var pos = $(this).position();
			$('#footer').append($('<div id="'+tipsID+'" class="tipbox">'+$(this).attr('tip-text')+'<span></span></div>'));
			$('#'+tipsID).css({top:(pos.top-$('#'+tipsID).height()-25)+'px', opacity:'0', left:(pos.left+($(this).width()-$('#'+tipsID).width()-20)/2)+'px'});
			$('#'+tipsID).find('span').css('left', parseInt(($('#'+tipsID).width()-9+20)/2)+'px');
		}
		$('#'+tipsID).stop().animate({opacity:'1'});
	}, function(){
		var tipsID = $(this).attr('tips-id');
		$('#'+tipsID).stop().animate({opacity:'0'}, function(){
			$(this).remove();
		});
	});
	
	if(audioSupport)
	{
		myAudio = new Audio(); 
		var audioTagSupport = !!(myAudio.canPlayType);
		{
			$('#audioControls .pause').click(function(){
				myAudio.pause();
				$('#audioControls .pause').css('display','none');
				$('#audioControls .play').css('display','block');
			});
			$('#audioControls .play').click(function(){
				myAudio.play();
				$('#audioControls .pause').css('display','block');
				$('#audioControls .play').css('display','none');
			});
			
			$('#audioControls .next').click(function(){			
				setNextAudio();
				path = $('#audioList li.active').html();
				playAudio(path);
			});
			
			$('#audioControls .prev').click(function(){		
				setPrevAudio();
				path = $('#audioList li.active').html();
				playAudio(path);
			});
			
			playAudio($('#audioList li:first-child').addClass('active').html());
			
			btnSound = new Audio();
			if(btnSoundURL!='')
			{
				var canPlayMp3 = !!btnSound.canPlayType && "" != btnSound.canPlayType('audio/mpeg');
				btnSound.src = btnSoundURL+((canPlayMp3)?'.mp3':'.ogg');
				
				$('a').mouseover(function(){
					btnSound.play();
				});
			}
		}
	}
	
	if(!mobileDevice)
	{
		$('.twButton').hover(function(){
			$(this).addClass('twActive');
			$('.twContent').stop(true).show().css('opacity','0').animate({opacity:'1'}, 0);
			clearTimeout(twtTimer);
			nextTweet();
			$('.twContent').hover(function(){
				$('.twContent').stop(true).animate({opacity:'1'}, 0);
			}, function(){
				$('.twContent').stop().delay(300).animate({opacity:'0'}, 0, function(){
					$('.twContent').unbind('mouseleave').unbind('mouseenter').hide();
					$('.twButton').removeClass('twActive');
				});
			});
		}, function(){
			$('.twContent').stop().delay(300).animate({opacity:'0'}, function(){
				$('.twContent').unbind('mouseleave').unbind('mouseenter').hide();
				$('.twButton').removeClass('twActive');
			});
		});
	}else{
		$('.twButton').click(function(){
			if($('.twContent').is(':hidden')){
				clearTimeout(twtTimer);
				nextTweet();
				$(this).addClass('twActive');
				$('.twContent').show().css('opacity','1');
			}else{
				$(this).removeClass('twActive');
				$('.twContent').hide();
			}
		});
	}
	
	$('#bodyLoading').animate({opacity:'0', top:-200}, 1000, 'easeOutBack', function(){
		$(this).remove();
	});
	$('#body-wrapper').delay(500).animate({opacity:'1'}, 1000);
	
	if(frontPage!='')
		openPage(frontPage);
		
	if(menuAlwaysOpen)
		showMenu();
		
	if(mobileDevice)
		$('#bgImages').bind('touchstart', bgThumbsTouchStart);
		
});

jQuery.fn.extend({
	contentPageReady: function (fn) {
		if (fn) {
			return jQuery.event.add(document, "contentPageReady", fn, null);
		} else {
			var ret = jQuery.event.trigger("contentPageReady", null, document, false, null);
			if (ret === undefined)
				ret = true;
			return ret;
		}
	}
});

function bgThumbsTouchStart(e){
	var firstY;
	var event = window.event;
	if(hasTouch && event.touches.length==1)
		firstY = event.touches[0].pageY;
	$('#bgImages').unbind('touchstart', bgThumbsTouchStart);
	$(document).bind('touchmove', {firstY:firstY}, bgThumbsTouchMove);
	$(document).bind('touchend', bgThumbsTouchEnd);
}
function bgThumbsTouchMove(e){
	var pY;
	var event = window.event;
	if(hasTouch && event.touches.length==1)
		pY = event.touches[0].pageY;
	var dY = parseInt($('#bgImages').position().top+pY-e.data.firstY);
	if(dY<$('#body-wrapper').height()-$('#bgImages').height())
		dY = $('#body-wrapper').height()-$('#bgImages').height();
	if(dY>0)
		dY=0;
	$('#bgImages').css({top:dY+'px'});
}
function bgThumbsTouchEnd(e){
	$(document).unbind('touchmove', bgThumbsTouchMove);
	$(document).unbind('touchend', bgThumbsTouchEnd);
	$('#bgImages').bind('touchstart', bgThumbsTouchStart);
}

function setNextAudio()
{
	if(!$('#audioList li.active').is(':last-child'))
		$('#audioList li.active').removeClass('active').next().addClass('active');
	else
		$('#audioList li.active').removeClass('active').parent().find('li:first-child').addClass('active');
}

function setPrevAudio()
{
	if(!$('#audioList li.active').is(':first-child'))
		$('#audioList li.active').removeClass('active').prev().addClass('active');
	else
		$('#audioList li.active').removeClass('active').parent().find('li:last-child').addClass('active');
}

function nextTweet(){
	if($('.twContent li.active').length>0)
	{
		if(!$('.twContent li.active').is(':last-child'))
			$('.twContent li.active').removeClass('active').next().addClass('active');
		else
			$('.twContent li.active').removeClass('active').parent().find('li:first-child').addClass('active');
	}else{
		$('.twContent li:first-child').addClass('active');
		$('.twContent li:not(.active)').hide();
	}
	$('.twContent ul').animate({height:$('.twContent li.active').height()+10}, 500);
	$('.twContent li:not(.active)').fadeOut('slow', function(){
		$('.twContent li.active').fadeIn('slow');
	});
	twtTimer = setTimeout(nextTweet, twtTime);
}

// init menu
function initMenu(){
	var logoData = {
		left: 20,
		top: ((75-$('#logo').height())/2),
		width: $('#logo img').width(),
		height:$('#logo img').height()
	};
	$('#logo').data('logoData', logoData);
	$('#logo').css({left:logoData.left+'px', top:logoData.top+'px', width:logoData.width+'px', height:logoData.height+'px'});
	$('#logo img').css({width:(logoData.width/4)+'px', height:(logoData.height/4)+'px', opacity:'0'});
	
	// Menu Closer
	if(mobileDevice){
		$('#menu-container').css('borderRadius','0');
		$('#menuCloser').click(function(){
			if(!menuAlwaysOpen)
				closeMenu();
		});
	}
	// menu Openner setting
	if(!mobileDevice){
		$('#menuOpener').mouseover(function(){
			if($('#menu-container').position().left<0)
				showMenu();
		});
	}else{
		$('#menuOpener').click(function(){
			if($('#menu-container').position().left<0)
				showMenu();
		});
	}
	
	// Set Menu Container Hover
	if(!mobileDevice && !menuAlwaysOpen)
	{
		$('#menu-container').mouseenter(function(event){
			clearTimeout(menuTimer);
		}).mouseleave(function(event){
			clearTimeout(menuTimer);
			menuTimer = setTimeout(closeMenu, menuTime);
		});
	}
	// Set Sub Menu Positions
	$('#mainmenu ul li ul').each(function(){
		var ulW = 0;
		$(this).find('li').each(function(){ ulW += $(this).width(); });
		$(this).css({width:(ulW)+'px'});
		var ulW = 0;
		$(this).find('li').each(function(){ ulW += $(this).width();	});
		$(this).css({width:(ulW+2)+'px'});
		var menuLeft = ((((ulW+20)-$(this).parent().width())/2));
		var topMenuLeft = parseInt($(this).parent().offset().left);
		if(topMenuLeft-menuLeft<0)
			menuLeft += topMenuLeft-menuLeft;
		$(this).css({left:'-'+menuLeft+'px'});
	});
	
	// Close Menu as First Position
	$('#menu-container').css({left:'-'+($('#menu-container').outerWidth())+'px'});
	
	if(bgPaused){
		$('#bgControl .play').show();
		$('#bgControl .pause').hide();
	}
}

// Resize All Elements
function doSize(){ 
	var winW = $(window).width();
	if(mobileDevice)
		winW = minWidth;
	var winH = $(window).height();
	var winRatio = winW/winH;
	$('#body-wrapper').css({width:winW+'px', height:winH+'px'});
	if($('#bgImages li.active iframe').length>0){
		var imgW = $('#bgImages li.active iframe').width();
		var imgH = $('#bgImages li.active iframe').height();
	}else{
		var imgW = $('#bgImages li.active img.source').width();
		var imgH = $('#bgImages li.active img.source').height();
	}
	var imgRatio = imgW/imgH;
	var imgLeft=0;
	var imgTop=0;
	
	// If menu position fixed allign to vertical center
	if(menuPositionFixed){
			var menuY = ($('#body-wrapper').height()-$('#menu-container').height())/2;
			$('#menu-container').css('top', menuY);
	}
	
	// Calculate Image Width, Height and Positions
	if(bgStretch){
		if(winRatio>imgRatio)
		{
			imgW = parseInt(winW);
			imgH = parseInt(imgW/imgRatio);
			
		}else{
			imgH = winH;
			imgW = parseInt(imgH*imgRatio);
		}
	}else{
		if(winRatio>imgRatio)
		{
			imgH = parseInt(winH);
			imgW = parseInt(imgH*imgRatio);
			
		}else{
			imgW = winW;
			imgH = parseInt(imgW/imgRatio);
		}
	}
	imgLeft = parseInt((winW-imgW)/2);
	imgTop = parseInt((winH-imgH)/2);
	
	if(mobileDevice && (activePlayer == 'youtube' || activePlayer == 'vimeo')){
		imgW = winW;
		imgH = winH;
		imgLeft = imgTop = 0;
	}
	
	// Set Bg Image W, H
	$('#bgImage .new').css({width:imgW+'px', height:imgH+'px'});
	if(activePlayer == 'youtube')
		ytplayer.setSize(imgW, imgH);
	else if(activePlayer == 'vimeo')
		$('#vimeoplayer').css({width:imgW+'px', height:imgH+'px'});
	// Set Bg Image Position
	$('#bgImage .new').css({left:imgLeft+'px', top:imgTop+'px'});
	
	// Set Pattern W, H
	$('#bgPattern').css({width:winW+'px', height:winH+'px'});
	$('#videoExpander').css({width:winW+'px', height:winH+'px'});
	$('#content').css({left:(winW-826)+'px', height:(winH-$('#footer').height())+'px'});
	setContentMargin();
}

// Background Image Auto Next
function autoBg(){
	if(bgPaused) return false;
	nextBg();
}

// Background Image Next Button
function nextBg() {
	if(bgRunning) return false;
	clearInterval(bgTimer);
	if(!$('#bgImages li.active').is(':last-child'))
		$('#bgImages li.active').removeClass('active').next().addClass('active');
	else
		$('#bgImages li.active').removeClass('active').parent().find('li:first-child').addClass('active');
	runBg();
}

// Background Image Prev Button
function prevBg(){
	if(bgRunning) return false;
	clearInterval(bgTimer);
	if(!$('#bgImages li.active').is(':first-child'))
		$('#bgImages li.active').removeClass('active').prev().addClass('active');
	else
		$('#bgImages li.active').removeClass('active').parent().find('li:last-child').addClass('active');
	runBg();
}

// Background Image Pause Button
function pauseBg(){
	if(activePlayer=='youtube')
		ytplayer.pauseVideo();
	else if(activePlayer=='vimeo')
		$f(vmplayer).api('pause');
	clearInterval(bgTimer);
	$('#bgControl .play').show();
	$('#bgControl .pause').hide();
	bgPaused = true;
	$('#bgImage img.new').stop();
}

// Background Image Play Button
function playBg(){
	clearInterval(bgTimer);
	$('#bgControl .play').hide();
	$('#bgControl .pause').show();
	bgPaused = false;
	if(activePlayer=='youtube')
		ytplayer.playVideo();
	else if(activePlayer=='vimeo')
		$f(vmplayer).api('play');
	else
		nextBg();
}






/*Youtube Api Begin*/ 
var tag = document.createElement('script');
tag.src = "http://www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function onYouTubePlayerAPIReady() {
ytPlayerReady = true;
}
function onPlayerReady(event) {
	if(!videoPaused)
		event.target.playVideo();
}
var done = false;
function onPlayerStateChange(event) {
if(event.data==YT.PlayerState.ENDED && bgPaused==false)
	nextBg();
}
function stopVideo() {
ytplayer.stopVideo();
}
/*Youtube Api End*/ 
  
/*Vimeo Api Begin*/
var vmPlayerReady=false;
var vmplayer;
function vimeoApiReady(player_id){
	vmplayer = player_id;
	vmPlayerReady = true;
	$f(vmplayer).addEvent('finish', vimeoVideoEnded);
	if(!videoPaused){
		$f(vmplayer).api('play');
	}
}
function vimeoVideoEnded(player_id){
	vmplayer = player_id;
	if(bgPaused==false){
		nextBg();
	}
}
/*Vimeo Api End*/  
  
  
  
  
  
// Background Image Animation
var activePlayer = 'none';
function runBg(){
	$('#bgImageWrapper .source').removeClass('new').addClass('old');
	if($('#bgImages li.active iframe').length>0){
				
		if($('#bgImages li.active iframe').attr('videotype')=='youtube')
		{
			if(ytPlayerReady)
			{
				activePlayer = 'youtube';
				$('#bgImageWrapper').prepend($('<div id="ytVideo"></div>').addClass('new').addClass('source').css('opacity','0'));
				ytplayer = new YT.Player('ytVideo', {
				  height: $('#bgImages li.active iframe').attr('height'),
				  width: $('#bgImages li.active iframe').attr('width'),
				  videoId: $('#bgImages li.active iframe').attr('videoid'),
				  playerVars: {
					controls: 0,
					rel:0,
					showinfo: 0 ,
					modestbranding: 1,
					wmode: 'opaque'
				},
				  events: {
					'onReady': onPlayerReady,
					'onStateChange': onPlayerStateChange
				  }
				});
			}
		}else if($('#bgImages li.active iframe').attr('videotype')=='vimeo'){
			activePlayer = 'vimeo';
			$('#bgImageWrapper').prepend($('<div id="vmVideo"></div>').addClass('new').addClass('source').css('opacity','1'));
			$('#vmVideo').append($('#bgImages li.active iframe').clone().attr('src', $('#bgImages li.active iframe').attr('src')+'&autoplay=0&loop=0&controls=0&player_id=vimeoplayer&autoplay=1&autopause=0').attr('id', 'vimeoplayer'));
			$('#vmVideo iframe').each(function(){
				$f(this).addEvent('ready', vimeoApiReady);
			});
		}
		if(mobileDevice)
			$('#videoExpander').show();
			
	}else{
		activePlayer = 'none';
		$('#bgImageWrapper').prepend($('#bgImages li.active .source').clone().addClass('new').css('opacity','0'));
		if(mobileDevice)
			$('#videoExpander').hide();
	}
	
	bgRunning = true;
	clearInterval(bgTimer);
	doSize();
	$('#bgText h3, #bgText .subText').stop().animate({opacity:'0'}, 300 , function(){
		$('#bgText h3').html($('#bgImages li.active h3').text());
		$('#bgText .subText').html($('#bgImages li.active p').text());
		$(this).animate({opacity:'1'}, 300);
	});
	setCaptionPosition();
	
	
	$('#bgImages li img').stop().animate({opacity:'.4'},500);
	$('#bgImages li.active img').stop().animate({opacity:'1'},500);
	if($('#bgImageWrapper .old').length>0)
	{
		$('#bgImageWrapper .old').stop(true).animate({opacity:0}, 500, function(){
			$(this).remove();
			bgRunning = false;
		});
	}else{bgRunning = false;}
	
	bW = parseInt($('#bgImageWrapper .new').width()*.1);
	bH = parseInt($('#bgImageWrapper .new').height()*.1);
	$('#bgImageWrapper .new').stop(true).animate({opacity:1}, 500);
	
	if(activePlayer == 'none' && !normalFade)
		$('#bgImageWrapper .new').animate({width:$('#bgImageWrapper .new').width()+bW, height:$('#bgImageWrapper .new').height()+bH},bgTime+2000);

	if(bgTime>0 && bgPaused==false && activePlayer == 'none')
		bgTimer = setInterval(autoBg, bgTime);
}

function setShareURL(shareurl){
	if(defaultURL != shareurl)
		shareurl=defaultURL+'/'+shareurl;
	$('#share a:not(.rss)').each(function(){
		if($(this).attr('rel'))
			$(this).attr('href', $(this).attr('rel').replace('%%url%%', shareurl));
	});
}

// Open Inner Page
function openPage(getURL){
	// Page Loading on Click
	if(mobileDevice){
		if(getURL=='#[playvideo]'){
			if(activePlayer=='youtube' || activePlayer=='vimeo' ){
				$('#bgText, #menu-container, #bgControl, #videoExpander, #audioControls, #twt, #footer').hide();
				if($('#bgImages').css('z-index')!=-100)
					$('#bgImages').hide();
				$('#content').css('z-index', '-888');
			}
			return false;
		}else if(activePlayer=='youtube' || activePlayer=='vimeo' ){
			if($('#menu-container').is(':hidden'))
			{
				$('#bgText, #menu-container, #bgControl, #videoExpander, #audioControls, #twt, #footer').show();
				if($('#bgImages').css('z-index')!=-100)
					$('#bgImages').show();
				if($('#contentBox').html()!='')
					$('#content').css('z-index', '888');
				if(activePlayer=='youtube')
					ytplayer.stopVideo();
				else if(activePlayer=='vimeo')
					$f(vmplayer).api('pause');
				var htmldata = $('#bgImageWrapper').html();
				$('#bgImageWrapper').html('');
				$('#bgImageWrapper').html(htmldata);
			}
		}
	}
	
	
	if($('#contentBox').html()!='' && getURL=='')
		getURL='/';
	if(pageLoading || getURL=='' || getURL.indexOf('gallery[')>-1 || getURL.substr(0,1)=='#') return false;
	var pageLoadingURL = getURL;
	pageLoading = true;
	$(document).unbind('contentPageReady');
	if(!menuAlwaysOpen)
		closeMenu();
	
	if(typeof _gaq != 'undefined'){
		var suburl = pageLoadingURL;
		if(suburl=='/' || suburl == '//') suburl = '';
		suburl = window.location.pathname+suburl;
		_gaq.push(['_trackPageview', suburl]);
	}
	
	$('#content').css('z-index', '888');
	if(pageLoadingURL.length>1 && pageLoadingURL.substr(0,1)=='/') pageLoadingURL = pageLoadingURL.substring(1);
	if($('#contentBox').html()=='')
	{
		if(pageLoadingURL!='/'){
			if(frontPage!='')
			{
				showLoading();
				pageLoadingURL = frontPage;
				$('#contentBox').load(pageLoadingURL+addionalCharacter(pageLoadingURL)+'info=page', pageLoadReady);
				$('title').load(pageLoadingURL+addionalCharacter(pageLoadingURL)+'info=title');
				setShareURL(pageLoadingURL);
			}else{
				showLoading();
				$('#contentBox').load(pageLoadingURL+addionalCharacter(pageLoadingURL)+'info=page', pageLoadReady);
				$('title').load(pageLoadingURL+addionalCharacter(pageLoadingURL)+'info=title');
				setShareURL(pageLoadingURL);
			}
		}else{
			$('title').html(defaultTitle);
			setShareURL(defaultURL);
			$('#content').css('z-index', '-888');
		}
	}else{
		$('#contentBox').animate({opacity:'0', marginTop:-200}, 600, 'easeOutExpo', function(){
			if(pageLoadingURL!='/'){
				showLoading();
				$('#contentBox').load(pageLoadingURL+addionalCharacter(pageLoadingURL)+'info=page', pageLoadReady);
				$('title').load(pageLoadingURL+addionalCharacter(pageLoadingURL)+'info=title');
				setShareURL(pageLoadingURL);
			}else{
				if(frontPage!=''){
					showLoading();
					pageLoadingURL = frontPage;
					$('#contentBox').load(pageLoadingURL+addionalCharacter(pageLoadingURL)+'info=page', pageLoadReady);
					$('title').load(pageLoadingURL+addionalCharacter(pageLoadingURL)+'info=title');
					setShareURL(pageLoadingURL);
				}else{
					$('#contentBox').html('');
					$('#content').css('z-index','-888');
					$('title').html(defaultTitle);
					setShareURL(defaultURL);
					pageLoading = false;
					showBgCaption = true;
					setCaptionPosition();
				}
			}
		});
	}
	return false;
}

function addionalCharacter(pageLoadingURL){
	if(pageLoadingURL.indexOf('/')>0){
		files = pageLoadingURL.split('/');
		pageName = files[files.length-1];
	}else{
		pageName = pageLoadingURL;
	}
	if(pageName.indexOf('?')>'-1')
		return '&';
	else
		return '?';
}

function showLoading(){
	$('#contentLoading').css({top:'300px', opacity:'0'}).show();
	$('#contentLoading').animate({opacity:'1', top:200}, 'easeInExpo');
}
function hideLoading(){
	$('#contentLoading').animate({opacity:'0', top:100}, 'easeOutExpo', function(){
		$(this).hide();
	});
}

function pageLoadReady(){
	var imageTotal = $('#contentBox img').length;
    var imageCount = 0;
	if(imageTotal>0)
	{
		$('#contentBox img').load(function(){
			if(++imageCount == imageTotal) 
			pageLoaded();
		}).error(function(){
			if(++imageCount == imageTotal) 
			pageLoaded();
		});
	}else{
		pageLoaded();
	}
}

// Inner Page Loaded Actions
function pageLoaded(){
	jQuery.event.trigger("contentPageReady", null, document, false, null);	
	showBgCaption = false;
	setCaptionPosition();
	pageLoading = false;
	hideLoading();
	$('#contentBox').scrollTop(0);
	setContentMargin();
	$('#contentBox').show().css({opacity:'0', marginTop:'200px'});
	$('#contentBox').stop().delay(500).animate({opacity:'1', marginTop:20}, 600, 'easeOutExpo');
	$('#contentBox a').mouseover(function(){
		if(audioSupport)
			btnSound.play();
	});

	
	// Ajax Comment Post
	acp_initialise();
	// Set click sound to all links
	$('#contentBox .blogTop a').click(function(){
		$('#content').stop().animate({scrollTop:0}, 1000, 'easeOutExpo');
	});
	
	
	// Set Meta Tips
	$('#contentBox .meta-links a').hover(function(){
		if($(this).attr('tips-id')==undefined)
			$(this).attr('tips-id', 'tips-'+randomString(5));
		var tipsID = $(this).attr('tips-id');
		if($('#'+tipsID).length==0){
			var pos = $(this).position();
			$('#contentBox').append($('<div id="'+tipsID+'" class="meta-tips">'+$(this).attr('rel')+'<span></span></div>'));
			$('#'+tipsID).css({top:(pos.top+ (($(this).height()-$('#'+tipsID).height())/2))+'px', opacity:'0', left:(pos.left-$('#'+tipsID).width()-30)+'px'});
		}
		$('#'+tipsID).stop().delay(300).animate({opacity:'1'});
	}, function(){
		var tipsID = $(this).attr('tips-id');
		$('#'+tipsID).stop().delay(300).animate({opacity:'0'}, function(){
			$(this).remove();
		});
	});
	
	// ToolTip
	$('#contentBox .tip').hover(function(){
		if($(this).attr('tips-id')==undefined)
			$(this).attr('tips-id', 'tips-'+randomString(5));
		var tipsID = $(this).attr('tips-id');
		if($('#'+tipsID).length==0){
			var pos = $(this).position();
			$('#contentBox').append($('<div id="'+tipsID+'" class="tipbox">'+$(this).attr('tip-text')+'<span></span></div>'));
			$('#'+tipsID).css({top:(pos.top-$('#'+tipsID).height()-30)+'px', opacity:'0', left:(pos.left+($(this).width()-$('#'+tipsID).width()-20)/2)+'px'});
			$('#'+tipsID).find('span').css('left', parseInt(($('#'+tipsID).width()-9+20)/2)+'px');
		}
		$('#'+tipsID).stop().animate({opacity:'1'});
	}, function(){
		var tipsID = $(this).attr('tips-id');
		$('#'+tipsID).stop().animate({opacity:'0'}, function(){
			$(this).remove();
		});
	});
	
	// Form Focus
	$('#contentBox .dform input[type=text], #contentBox .dform select, #contentBox .dform textarea').focus(function(){
		$(this).parent().addClass('dFormInputFocus');
	}).blur(function(){
		$(this).parent().removeClass('dFormInputFocus');
	});
	
	// Button Animation
	$('#contentBox .buttonSmall, #contentBox .buttonMedium').hover(function(){
		$(this).stop().animate({opacity:'.50'}, 400);
	}, function(){
		$(this).stop().animate({opacity:'1'}, 400);
	});
	
	// Toggle Button
	$('div.sh_toggle_text').click( function(){
		$(this).parent().find(".sh_toggle_content").slideToggle("slow");
			$(this).toggleClass("sh_toggle_text_opened");
			doSize();
		}
	); 
	
	//setImageAnimations();
	setImageModal();
	setImageAnimations();
	setClickable();
	
	$('.hoverable').each(function(){
		$(this).hover(function(){
			if($(this).data('mouseout'))
				$(this).removeClass($(this).data('mouseout'));
			if($(this).data('mouseover')){
				$(this).removeClass($(this).data('mouseover'));
				$(this).addClass($(this).data('mouseover'));
			}
		},function(){
			if($(this).data('mouseout'))
				$(this).addClass($(this).data('mouseout'));
		});
	});
	
	//Filter
	var $applications = $('#contentBox .portfolioitems');
	var $data = $applications.clone();

	$('#contentBox .portfolioFilter li a').click(function(e) {
		var dataValue = $(this).parent().attr('data-value');
		if (dataValue=='all'){
			var $filteredData = $data.find('li');
		} else {
			var $filteredData = $data.find('li[data-type~="cat' + dataValue + '"]');
		}

		// finally, call quicksand
		$applications.quicksand($filteredData, {
		  duration: 800,
		  easing: 'easeInOutQuad',
		  enhancement: function(){
				//$('.hoverWrapperBg, .hoverWrapper, .hoverWrapper a').css('opacity','0');
				setImageAnimations();
			 }
		}, function(){
			applyImageModal();
			setClickable();
			//$('.pp_overlay').remove();
			//$('#contentBox a[rel^="gallery"]').not('.nomodal').prettyPhoto();
		});
		//applyImageModal();
		e.preventDefault();
	});
}

function setClickable(){
	$('.clickable').click(function(event){
		event.preventDefault();
		event.stopImmediatePropagation();
		window.location = $(this).data('link');
		return false;
	});
}

function setImageModal(){
	var modalid = randomString(5);
	$('#contentBox .image_frame a img').not('.nomodal').parent().attr('rel','gallery[photo'+modalid+']');
	applyImageModal();
}

function applyImageModal(){
	$('#contentBox a[rel^="gallery"]').not('.nomodal').prettyPhoto({
		theme:prettyTheme, 
		autoplay: true, 
		opacity:0.5, 
		show_title: false, 
		deeplinking: false, 
		allow_resize: true, 
		allow_expand: false,
		default_width:$('#body-wrapper').width(), 
		default_height: $('#body-wrapper').height(),
		social_tools: false
	});
}

function setImageAnimations(){
	// Image Animation
	$('#contentBox .image_frame a').each(function(){
		if($(this).find('.hoverWrapper h3, .hoverWrapper .enter-text').length>0)
			$(this).find('.modal, .link, .modalVideo').css({bottom:20, top:'auto'});
			
		$(this).hover(function(){
			$(this).find('.hoverWrapperBg').stop().animate({opacity:0.85}, 500, 'easeOutExpo');
			$(this).find('.hoverWrapper .link').stop().animate({marginLeft:10, opacity:1}, 300, 'easeOutExpo');
			$(this).find('.hoverWrapper .modal, .hoverWrapper .modalVideo').stop().animate({marginLeft:-36, opacity:1}, 300, 'easeOutExpo');
			$(this).find('.hoverWrapper h3').stop().delay(100).animate({opacity:'1'}, 300);
			$(this).find('.hoverWrapper .enter-text').stop().delay(200).animate({opacity:'1'}, 300);
		}, function(){
			$(this).find('.hoverWrapperBg').stop().animate({opacity:0}, 500, 'easeOutExpo');
			$(this).find('.hoverWrapper .link').stop().animate({marginLeft:30, opacity:0}, 300, 'easeOutExpo');
			$(this).find('.hoverWrapper .modal, .hoverWrapper .modalVideo').stop().animate({marginLeft:-56, opacity:0}, 300, 'easeOutExpo');
			$(this).find('.hoverWrapper h3').stop().animate({opacity:'0'}, 300);
			$(this).find('.hoverWrapper .enter-text').stop().animate({opacity:'0'}, 300);
		});
	});
}


// Close Main Menu
function closeMenu(){
	if(mobileDevice)
		$('#menuCloser').hide();
		
	if(!$('#contentBox').html()==''){
		showBgCaption = false;
		setCaptionPosition();
	}
	closeSubMenu();
	$('#mainmenu a, #mainmenu li').unbind('mouseenter').unbind('mouseleave').unbind('mouseover').unbind('mouseout');
	$('#mainmenu ul li.active').removeClass('active');
	$('#content').stop().show().animate({opacity:1}, 800);
	$('#menu-container').stop().animate({left:'-'+($('#menu-container').outerWidth())+'px'}, 400, 'easeOutQuad', function(){
		$('#menuOpener').show().animate({opacity:'1'});
		animateMenuPosition = true;
	});
}

// Close Sub Menu
function closeSubMenu(menuID){
	if(menuID==undefined){
		$('#mainmenu ul li ul').stop(true, true).animate({opacity:'0'}, 400, 'easeOutExpo', function(){
			$(this).hide();
		});
	}else{
		$('#mainmenu ul li:not([id='+menuID+']) ul').stop(true, true).animate({opacity:'0'}, 400, 'easeOutExpo', function(){
			$(this).hide();
		});
	}
}

// Main Menu Item over Animation
function menuItemOver(obj){
	if (obj==undefined)
		obj = this;
	if(!mobileDevice)
		clearTimeout(menuTimer);
	$(obj).find('span').stop(true,true).animate({top:75}, 0).animate({top:0},600, 'easeOutBack');				
	if(audioSupport)
		btnSound.play();
}

// Main Menu Item out Animation
function menuItemOut(obj){
	if (obj==undefined)
		obj = this;
	$(obj).find('span').stop(true, true).animate({top:0}, 300);
}

// Main Menu Show Animation
function showMenu(){
	showBgCaption = true;
	setCaptionPosition();
	if(!menuAlwaysOpen){
		$('#content').stop().animate({opacity:0}, 800, function(){
			$(this).hide();
		});
	}
	if(mobileDevice)
		$('#menuCloser').show();
	
	// animate menu
	animateMenuPosition = false;
	$('#mainmenu ul li a').unbind('mouseenter').unbind('mouseleave').unbind('mouseover').unbind('mouseout');
	$('#menuOpener').stop(true).hide().css({opacity:'0'});
	var logoData = $('#logo').data('logoData');
	clearTimeout(subMenuTimer);
	$('#mainmenu ul.menu > li > a span').css('top','75px');
	$('#mainmenu ul.menu > li ul li a span').css('top','0px');
	$('#menu-container').stop(true).animate({left:0}, 600, 'easeOutExpo');

	$('#logo img').stop(true).animate({width:(logoData.width), height:(logoData.height), opacity:'1'}, 600, 'easeOutBack', function(){
		$('ul.menu > li').each(function(i,el){
			$(el).find('> a > span').stop(true).delay(100*i).animate({top:0}, 600,'easeOutBack');
			
			if(!mobileDevice)
			{
				$(el).find('> a').hover(function(event){
					$(this).parent().find('ul').stop().show().animate({opacity:'1'}, 600, 'easeOutExpo');				
					clearTimeout(subMenuTimer);
					closeSubMenu($(this).parent().attr('id')); 
					menuItemOver(this);
				}, function(){
					if(!mobileDevice)
						subMenuTimer = setTimeout(closeSubMenu, menuTime);
					menuItemOut(this);
				});
			}else{
				$(el).find('> a').click(function(event){
					$(this).parent().find('ul').stop().show().animate({opacity:'1'}, 600, 'easeOutExpo');
					closeSubMenu($(this).parent().attr('id')); 
					menuItemOver(this);
				});
			}
		});
	});
	
	$('#mainmenu ul li ul li a').each(function(i,el){
		
		if(!mobileDevice)
		{
			$(this).hover(function(event){
				clearTimeout(subMenuTimer);
				$(this).closest('.sub-menu').parent().addClass('active');
				menuItemOver(this);
				closeSubMenu($(this).closest('.sub-menu').parent().attr('id'));
			}, function(){
				$(this).closest('.sub-menu').parent().removeClass('active');
				$(this).parent().parent().parent().removeClass('active');
				menuItemOut(this);
				subMenuTimer = setTimeout(closeSubMenu, menuTime);
			});
		}else{
			$(this).click(function(event){
				$(this).closest('.sub-menu').parent().addClass('active');
				menuItemOver(this);
				closeSubMenu($(this).closest('.sub-menu').parent().attr('id'));
			});
		}
	});
	
}

function setCaptionPosition(){
	if($('#bgimages li').length>0){
		if(showBgCaption)
		{
			var posTop = $('#bgImages .active').position().top+$('#bgImages').position().top-10;
			var maxTop = $('#content').height()-$('#bgText').height()-20;
			posTop = (posTop>maxTop)?maxTop:posTop;
			posTop = (posTop<-20)?-20:posTop;
			$('#bgText').stop().animate({top:posTop, opacity:'1'}, 500, 'easeOutQuad');
		}else{
			$('#bgText').stop().animate({opacity:'0'}, 500, 'easeOutQuad');
		}
	}
}

// Set Content Margin according to Scroll
function setContentMargin(){
	//
}

// Play Background Audio
function playAudio(path){
	if(audioSupport){
		var isPlaying = !myAudio.paused;
		var canPlayMp3 = !!myAudio.canPlayType && "" != myAudio.canPlayType('audio/mpeg');
		var canPlayOgg = !!myAudio.canPlayType && "" != myAudio.canPlayType('audio/ogg; codecs="vorbis"');
		if(canPlayMp3)
			myAudio.src = path+'.mp3';
		else if(canPlayOgg)
			myAudio.src = path+'.ogg';
			

		myAudio.removeEventListener('ended', arguments.callee, false);
		myAudio.addEventListener('ended', audioAddEndedListener , false);
		
		if(autoPlay || isPlaying)
		{
			myAudio.play();
			$('#audioControls .pause').css('display','block');
			$('#audioControls .play').css('display','none');
		}else{
			$('#audioControls .play').css('display','block');
			$('#audioControls .pause').css('display','none');
		}
	}
}

function audioAddEndedListener() 
{
	if(loop){
	this.currentTime = 0;
	this.play();
	}else{
		this.removeEventListener('ended', arguments.callee, false);
		setNextAudio();
		path = $('#audioList li.active').html();
		playAudio(path);
		myAudio.addEventListener('ended', audioAddEndedListener, false);
	}
}

// Randoma string generator
function randomString(size) {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var randomstring = '';
	for (var i=0; i<size; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return randomstring;
}
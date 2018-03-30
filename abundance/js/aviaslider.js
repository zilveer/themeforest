/**
 * AviaSlider - A jQuery image slider
 * (c) Copyright Christian "Kriesi" Budschedl
 * http://www.kriesi.at
 * http://www.twitter.com/kriesi/
 * For sale on ThemeForest.net
 */

/* this prevents dom flickering, needs to be outside of dom.ready event: */
document.documentElement.className += ' js_active ';
/*end dom flickering =) */

(function($){$.fn.aviaSlider=function(h){var j={blockSize:{height:'full',width:'full'},autorotationSpeed:3,slides:'li',animationSpeed:900,autorotation:true,appendControlls:'',slideControlls:'items',betweenBlockDelay:60,display:'topleft',switchMovement:false,showText:true,captionReplacement:false,transition:'fade',backgroundOpacity:0.8,transitionOrder:['diagonaltop','diagonalbottom','topleft','bottomright','random'],hideArrows:true};return this.each(function(){var f=$.extend(j,h);var g=$(this),optionsWrapper=g.parents('.slideshow_container'),slides=g.find(f.slides),slideImages=slides.find('img'),slideCount=slides.length,slideWidth=slides.width(),slideHeight=slides.height(),blockNumber=0,currentSlideNumber=0,reverseSwitch=false,currentTransition=0,current_class='active_item',controlls='',skipSwitch=true,interval='',blockSelection='',blockSelectionJQ='',arrowControlls='',blockOrder=[];g.methods={options_overwrite:function(){if(optionsWrapper.length){var a=/block_width__(\d+|full)/,block_height=/block_height__(\d+|full)/,transition=/transition_type__(slide|fade|drop)/,autoInterval=/autoslidedelay__(\d+)/;direction=/direction__(\w+)/;var b=a.exec(optionsWrapper[0].className),matchHeight=block_height.exec(optionsWrapper[0].className),matchTrans=transition.exec(optionsWrapper[0].className),matchInterval=autoInterval.exec(optionsWrapper[0].className),matchDirection=direction.exec(optionsWrapper[0].className);if(b!=null){f.blockSize.width=b[1]}if(matchHeight!=null){f.blockSize.height=matchHeight[1]}if(matchTrans!=null){f.transition=matchTrans[1]}if(matchInterval!=null){f.autorotationSpeed=matchInterval[1]}if(matchDirection!=null){if(matchDirection[1]=='all')f.transitionOrder=['diagonaltop','diagonalbottom','topleft','bottomright','random'];if(matchDirection[1]=='diagonal')f.transitionOrder=['diagonaltop','diagonalbottom'];if(matchDirection[1]=='winding')f.transitionOrder=['topleft','bottomright'];if(matchDirection[1]=='random')f.transitionOrder=['random']}if(optionsWrapper.is('.autoslide_false'))f.autorotation=false;if(optionsWrapper.is('.autoslide_true'))f.autorotation=true}},init:function(){g.methods.options_overwrite();if(f.blockSize.height=='full'){f.blockSize.height=slideHeight}else{f.blockSize.height=parseInt(f.blockSize.height)}if(f.blockSize.width=='full'){f.blockSize.width=slideWidth}else{f.blockSize.width=parseInt(f.blockSize.width)}var a=0,posY=0,generateBlocks=true,bgOffset='';slides.filter(':first').css({'z-index':'3',display:'block'});while(generateBlocks){blockNumber++;bgOffset="-"+a+"px -"+posY+"px";$('<div class="kBlock"></div>').appendTo(g).css({zIndex:20,position:'absolute',display:'none',left:a,top:posY,height:f.blockSize.height,width:f.blockSize.width,backgroundPosition:bgOffset});a+=f.blockSize.width;if(a>=slideWidth){a=0;posY+=f.blockSize.height}if(posY>=slideHeight){generateBlocks=false}}blockSelection=g.find('.kBlock');blockOrder['topleft']=blockSelection;blockOrder['bottomright']=$(blockSelection.get().reverse());blockOrder['diagonaltop']=g.methods.kcubit(blockSelection);blockOrder['diagonalbottom']=g.methods.kcubit(blockOrder['bottomright']);blockOrder['random']=g.methods.fyrandomize(blockSelection);slides.each(function(){$.data(this,"data",{img:$(this).find('img').attr('src')})});if(slideCount<=1){g.aviaImagePreloader()}else{g.aviaImagePreloader({},g.methods.preloadingDone);g.methods.appendControlls();g.methods.appendControllArrows()}g.methods.addDescription();g.methods.videoBehaviour()},videoBehaviour:function(){var b,videoSlide,imageSlide;slides.each(function(){imageSlide=$('img',this);b=$('.slideshow_video',this);embedVideo=$('.avia_video, iframe, embed, object',this);videoSlide=$(this);if((imageSlide.length&&b.length)||(imageSlide.length&&embedVideo.length)){videoSlide.addClass('comboslide').append('<span class="slideshow_overlay"></span>')}if(b.length){videoSlide.addClass('videoSlideContainer')}else if(embedVideo.length){videoSlide.addClass('videoSlideContainerEmbed')}});$('.videoSlideContainer img, .videoSlideContainer .slideshow_overlay',g).bind('click',function(){var a=$(this).parents('li:eq(0)');a.find('img, .slideshow_overlay').fadeOut();a.find('.slideshow_video').stop().fadeIn()})},appendControlls:function(){if(f.slideControlls=='items'){var b=f.appendControlls||g[0];controlls=$('<div></div>').addClass('slidecontrolls').insertAfter(b);slides.each(function(i){var a=$('<a href="#" class="ie6fix '+current_class+'"></a>').appendTo(controlls);a.bind('click',{currentSlideNumber:i},g.methods.switchSlide);current_class=""});controlls.width(controlls.width()).css('float','none')}return this},appendControllArrows:function(){var b=f.appendControlls||g[0];arrowControlls=$('<div></div>').insertAfter(b).addClass('arrowslidecontrolls');arrowControlls.html('<a class="ctrl_fwd ctrl_arrow" href=""></a><a class="ctrl_back ctrl_arrow" href=""></a>');$('.ctrl_back',arrowControlls).bind('click',{currentSlideNumber:'prev'},g.methods.switchSlide);$('.ctrl_fwd',arrowControlls).bind('click',{currentSlideNumber:'next'},g.methods.switchSlide);if(f.hideArrows){var c=arrowControlls.find('a');c.css({opacity:0});g.hover(function(){c.stop().animate({'opacity':1})},function(a){if(!$(a.relatedTarget).is('.ctrl_arrow')){c.stop().animate({'opacity':0})}})}},addDescription:function(){if(f.showText){slides.each(function(){var a=$(this);if(f.captionReplacement){var b=a.find(f.captionReplacement).css({display:'block','opacity':f.backgroundOpacity})}else{var b=a.find('img').attr('alt'),splitdesc=b.split('::');if(splitdesc[0]!=""){if(splitdesc[1]!=undefined){b="<strong>"+splitdesc[0]+"</strong>"+splitdesc[1]}else{b=splitdesc[0]}}if(b!=""){$('<div></div>').addClass('slideshow_caption').html(b).css({display:'block','opacity':f.backgroundOpacity}).appendTo(a.find('a'))}}})}},preloadingDone:function(){skipSwitch=false;if($.browser.msie){slides.css({'backgroundColor':'#000000','backgroundImage':'none'})}else{slides.css({'backgroundImage':'none'})}if(f.autorotation&&f.autorotation!=2){g.methods.autorotate();slideImages.bind("click",function(){clearInterval(interval)})}},autorotate:function(){var a=parseInt(f.autorotationSpeed)*1000+parseInt(f.animationSpeed)+(parseInt(f.betweenBlockDelay)*blockNumber);interval=setInterval(function(){currentSlideNumber++;if(currentSlideNumber==slideCount)currentSlideNumber=0;g.methods.switchSlide()},a)},switchSlide:function(c){var d=false;if(c!=undefined&&!skipSwitch){if(currentSlideNumber!=c.data.currentSlideNumber){if(c.data.currentSlideNumber=='next'){currentSlideNumber=currentSlideNumber+1;if(currentSlideNumber>slideCount-1)currentSlideNumber=0}else if(c.data.currentSlideNumber=='prev'){currentSlideNumber=currentSlideNumber-1;if(currentSlideNumber<0)currentSlideNumber=slideCount-1}else{currentSlideNumber=c.data.currentSlideNumber}}else{d=true}}if(c!=undefined)clearInterval(interval);if(!skipSwitch&&d==false){skipSwitch=true;var e=slides.filter(':visible'),nextSlide=slides.filter(':eq('+currentSlideNumber+')'),nextURL=$.data(nextSlide[0],"data").img,nextImageBG='url('+nextURL+')';if(f.slideControlls){controlls.find('.active_item').removeClass('active_item');controlls.find('a:eq('+currentSlideNumber+')').addClass('active_item')}blockSelectionJQ=blockOrder[f.display];slides.find('>a>img').css({opacity:1,visibility:'visible'});if(f.switchMovement&&(f.display=="topleft"||f.display=="diagonaltop")){if(reverseSwitch==false){blockSelectionJQ=blockOrder[f.display];reverseSwitch=true}else{if(f.display=="topleft")blockSelectionJQ=blockOrder['bottomright'];if(f.display=="diagonaltop")blockSelectionJQ=blockOrder['diagonalbottom'];reverseSwitch=false}}if(f.display=='random'){blockSelectionJQ=g.methods.fyrandomize(blockSelection)}if(f.display=='all'){blockSelectionJQ=blockOrder[f.transitionOrder[currentTransition]];currentTransition++;if(currentTransition>=f.transitionOrder.length)currentTransition=0}blockSelectionJQ.css({backgroundImage:nextImageBG,backgroundColor:'#000000'}).each(function(i){var b=$(this);setTimeout(function(){var a=new Array();if(f.transition=='drop'){a['css']={height:1,width:f.blockSize.width,display:'block',opacity:0};a['anim']={height:f.blockSize.height,width:f.blockSize.width,opacity:1}}else if(f.transition=='fade'){a['css']={display:'block',opacity:0};a['anim']={opacity:1}}else{a['css']={height:1,width:1,display:'block',opacity:0};a['anim']={height:f.blockSize.height,width:f.blockSize.width,opacity:1}}b.css(a['css']).animate(a['anim'],f.animationSpeed,function(){if(i+1==blockNumber){g.methods.changeImage(e,nextSlide)}})},i*f.betweenBlockDelay)})}return false},changeImage:function(a,b){a.css({zIndex:0,display:'none'});if(a.is('.videoSlideContainer')){a.wrapInner('<div class="videowrap_temp" />');var c=$('.videowrap_temp',a),clone=c.clone(true);c.remove();a.append(clone)}b.css({zIndex:3,display:'block'});b.find('img').css({display:'block',opacity:1});blockSelectionJQ.fadeOut(800,function(){skipSwitch=false})},fyrandomize:function(a){var b=a.length,objectSorted=$(a);if(b==0)return false;while(--b){var c=Math.floor(Math.random()*(b+1)),temp1=objectSorted[b],temp2=objectSorted[c];objectSorted[b]=temp2;objectSorted[c]=temp1}return objectSorted},kcubit:function(a){var b=a.length,objectSorted=$(a),currentIndex=0,rows=Math.ceil(slideHeight/f.blockSize.height),columns=Math.ceil(slideWidth/f.blockSize.width),oneColumn=blockNumber/columns,oneRow=blockNumber/rows,modX=0,modY=0,i=0,rowend=0,endreached=false,onlyOne=false;if(b==0)return false;for(i=0;i<b;i++){objectSorted[i]=a[currentIndex];if((currentIndex%oneRow==0&&blockNumber-i>oneRow)||(modY+1)%oneColumn==0){currentIndex-=(((oneRow-1)*modY)-1);modY=0;modX++;onlyOne=false;if(rowend>0){modY=rowend;currentIndex+=(oneRow-1)*modY}}else{currentIndex+=oneRow-1;modY++}if((modX%(oneRow-1)==0&&modX!=0&&rowend==0)||(endreached==true&&onlyOne==false)){modX=0.1;rowend++;endreached=true;onlyOne=true}}return objectSorted}};g.methods.init()})}})(jQuery);







/*allow external controlls like thumbnails*/
(function($)
{
	$.fn.aviaSlider_externalControlls = function(options) 
	{
		return this.each(function()
		{
			var defaults = 
			{
				slideControllContainer: '.slidecontrolls',
				newControllContainer: '.thumbnails_container',
				newControllElement: '.slideThumb',
				scrolling:'vertical',
				easing: 'easeInOutCirc',
				itemOpacity: 0.7,
				transitionTime: 2000
			};
			
			var options = $.extend(defaults, options);
		
			//click events
			var container				= $(this).parent('div'),
				element_container 		= $(options.newControllContainer, container).css({left:0, top:0}),
				element_container_wrap 	= element_container.parent('div'),
				elements_new 			= element_container.find(options.newControllElement).css({cursor:'pointer', opacity: options.itemOpacity}),
				elements_old 			= $(options.slideControllContainer, container).find('a'),
				animated 				= false;
			
			elements_new.filter(':eq(0)').css({opacity: 1});
			
			elements_new.bind('click', function()
			{
				if(animated || $(this).is('.activeslideThumb')) return;
				animated = true;
				setTimeout(function(){animated = false}, options.transitionTime );
				
				var index = elements_new.index(this);
				elements_old.filter(':eq('+index+')').trigger('click');
				elements_new.removeClass('activeslideThumb').css({opacity: options.itemOpacity});
				$(this).addClass('activeslideThumb').css({opacity: 1});
				return false;
			});
			
		
			//add scroll event
			if(!options.scrolling) return false;
				
			if((options.scrolling == 'vertical' && element_container.height() > element_container_wrap.height()) || (options.scrolling == 'horizontal' && element_container.width() > element_container_wrap.width()))
			{
				var el_height = elements_new.outerHeight(true),
					el_width  = elements_new.outerWidth(true),
					button_prev = $('<a href="#" class="thumb_prev thumb_button">Previous</a>').css('opacity',0).appendTo(element_container_wrap),
					button_next = $('<a href="#" class="thumb_next thumb_button">Next</a>').css('opacity',0).appendTo(element_container_wrap),
					buttons 	= $('.thumb_button');
					
					button_prev.bind('click', {direction: -1}, slide);
					button_next.bind('click', {direction:  1}, slide);
					
					element_container_wrap.hover(
						function(){ buttons.stop().animate({opacity:1}); },
						function(){ buttons.stop().animate({opacity:0}); }
					);
			}

			
			function slide(obj)
			{
				var multiplier 	= obj.data.direction, 
					maxScroll	= "",
					animate 	= {};
				
				if(options.scrolling == 'vertical') 
				{
					maxScroll	= element_container_wrap.height() - element_container.height();
					animate 	= {top: '-='+ (el_height * multiplier)};
					
					if((maxScroll >  parseInt(element_container.css('top'),10) - (el_height * multiplier)) && multiplier === 1) 
					{
						animate = {top: 0};
					}
					else if(parseInt(element_container.css('top'),10) >= 0  && multiplier === -1) 
					{
						animate = {top: maxScroll};
					}
				}
				
				
				if(options.scrolling == 'horizontal') 
				{
					maxScroll = element_container_wrap.width() - element_container.width();
					animate = {left:'-='+ (el_width  * multiplier)};
					
					if((maxScroll >  parseInt(element_container.css('left'),10) - (el_width * multiplier)) && multiplier === 1) 
					{
						animate = {left: 0};
					}
					else if(parseInt(element_container.css('left'),10) >= 0  && multiplier === -1) 
					{
						animate = {left: maxScroll};
					}
				}
								
				element_container.animate(animate, options.easing); 
				return false;
			}

		});
	}
})(jQuery);




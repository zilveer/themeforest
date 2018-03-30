
	/* :: 	Accordion Gallery Based on Kwicks - http://www.jeremymartin.name/projects.php?project=kwicks
	--------------------------------------------- */

	(function ($) {
		$.fn.kwicks = function (options) {
			var defaults = {
				isVertical: false,
				sticky: false,
				defaultKwick: 0,
				autorotation: true,
				autorotationSpeed: 3,
				gallerywidth: 500,
				event: 'mouseover',
				spacing: 0,
				duration: 600
			}, o, WoH, LoT, container, kwicks, slide_count, current_slide, slide_width, slide_height, acc_interval, normWoH, container_width, accordion_id, preCalcLoTs;
	
			o = $.extend(defaults, options);
			WoH = (o.isVertical ? 'height' : 'width'); // WoH = Width or Height
			LoT = (o.isVertical ? 'top' : 'left'); // LoT = Left or Top
			
		
			return this.each(function () {		   
				container = $(this);
				kwicks = container.children('li');
				slide_count 	= kwicks.length;
				current_slide = 0;
				slide_width = container.width() / slide_count; 	// width of the slides
				slide_height = container.height();
				acc_interval = '';
				normWoH = slide_width;
				container_width=options.gallerywidth;
				accordion_id=options.id;
				
				
				
				kwicks.css({ width : slide_width, height: slide_height });
						
				o.max = container.width() - slide_width;
				
				kwicks.find('.excerpt,.title').css({width : o.max });
				kwicks.find('.title').slideDown();
				
				if (!o.max) {
					o.max = (normWoH * kwicks.size()) - (o.min * (kwicks.size() - 1));
				} else {
					o.min = ((normWoH * kwicks.size()) - o.max) / (kwicks.size() - 1);
				}
				// set width of container ul
				if (o.isVertical) {
					container.css({
						width : kwicks.eq(0).css('width'),
						height : (normWoH * kwicks.size()) + (o.spacing * (kwicks.size() - 1)) + 'px'
					});				
				} 
	
				// pre calculate left or top values for all kwicks but the first and last
				// i = index of currently hovered kwick, j = index of kwick we're calculating
				preCalcLoTs = []; // preCalcLoTs = pre-calculated Left or Top's
				for(i = 0; i < kwicks.size(); i++) {
					preCalcLoTs[i] = [];
					// don't need to calculate values for first or last kwick
					for(j = 1; j < kwicks.size() - 1; j++) {
						if (i == j) {
							preCalcLoTs[i][j] = o.isVertical ? j * o.min + (j * o.spacing) : j * o.min + (j * o.spacing);
						} else {
							preCalcLoTs[i][j] = (j <= i ? (j * o.min) : (j-1) * o.min + o.max) + (j * o.spacing);
						}
					}
				}
				
				// loop through all kwick elements
				kwicks.each(function (i) {
					var kwick = $(this);
					
					// set initial width or height and left or top values
					// set first kwick
					
					if (i === 0) {
						kwick.css(LoT, '0px');
					} else if (i == kwicks.size() - 1) {
						kwick.css(o.isVertical ? 'bottom' : 'right', '0px');
					} else {
						if (o.sticky) {
							kwick.css(LoT, preCalcLoTs[o.defaultKwick][i]);
						} else {
							kwick.css(LoT, (i * normWoH) + (i * o.spacing));
						}
					}
					// correct size in sticky mode
					if (o.sticky) {
						if (o.defaultKwick == i) {
							kwick.css(WoH, o.max + 'px');
							kwick.addClass('active');
						} else {
							kwick.css(WoH, o.min + 'px');
						}
					}
					kwick.css({
						margin: 0,
						position: 'absolute'
					});
					
					kwick.bind("mouseleave", function () {
					kwick.find('.excerpt').slideUp();	
	
					});
					
	
					
					kwick.bind(o.event, function () {
				
						// calculate previous width or heights and left or top values
						var prevWoHs = []; // prevWoHs = previous Widths or Heights
						var prevLoTs = []; // prevLoTs = previous Left or Tops
						kwicks.stop().removeClass('active');
						for(j = 0; j < kwicks.size(); j++) {
							prevWoHs[j] = kwicks.eq(j).css(WoH).replace(/px/, '');
							prevLoTs[j] = kwicks.eq(j).css(LoT).replace(/px/, '');
						}
						var aniObj = {};
						aniObj[WoH] = o.max;
						var maxDif = o.max - prevWoHs[i];
						var prevWoHsMaxDifRatio = prevWoHs[i]/maxDif;
						
						kwick.find('.shadow').animate({right: -30},300);
						
						kwick.addClass('active').animate(aniObj, {
							step: function (now) {
								
								// calculate animation completeness as percentage
								var percentage = maxDif != 0 ? now/maxDif - prevWoHsMaxDifRatio : 1;
								// adjsut other elements based on percentage
								kwicks.each(function (j) {
									if (j != i) {
										kwicks.eq(j).css(WoH, prevWoHs[j] - ((prevWoHs[j] - o.min) * percentage) + 'px');
									}
									if (j > 0 && j < kwicks.size() - 1) { // if not the first or last kwick
										kwicks.eq(j).css(LoT, prevLoTs[j] - ((prevLoTs[j] - preCalcLoTs[i][j]) * percentage) + 'px');
									}
								});						
							},
							duration: o.duration,
							easing: o.easing
							
						});
						kwick.find('.title').slideUp();
						kwick.find('.excerpt').slideDown();
	
						var autostartvid = jQuery(this).find('.jwplayer.accplay').attr("id");
						
						jQuery('#'+accordion_id).find('.jwplayer.accplay.playing').each(function (index) {	
								str='';
								str = jQuery(this).attr("id");
								if (str != autostartvid) {
									jwplayer(str).stop();
									jQuery('#'+str).removeClass('playing');
								}
						});
						
						if (autostartvid) {
							var autostart = jQuery('#'+autostartvid).hasClass('autostart');
							if (autostart) {
								
								jwplayer(autostartvid).onPlay(function () { jQuery('#'+autostartvid).addClass('playing'); });
								
								var isplaying = jQuery('#'+autostartvid).hasClass('playing');
								
								if (!isplaying) {
									jwplayer(autostartvid).stop().play();	
								}
								
							}
						}
						
					});
				
				});
				
				if (!o.sticky) {
					container.bind("mouseleave", function () {
						var prevWoHs = [];
						var prevLoTs = [];
						kwicks.find('.shadow').animate({right: '0'},100);
						kwicks.find('.title').slideDown();
						
							jQuery('#'+accordion_id).find('.jwplayer.accplay').each(function (index) {	
								str='';
								str = jQuery(this).attr("id");
								jwplayer(str).stop();
								jQuery(this).removeClass('playing');
							});
						
						kwicks.find('.excerpt').slideUp();
						kwicks.removeClass('active').stop();
						for(i = 0; i < kwicks.size(); i++) {
							prevWoHs[i] = kwicks.eq(i).css(WoH).replace(/px/, '');
							prevLoTs[i] = kwicks.eq(i).css(LoT).replace(/px/, '');
						}
						var aniObj = {};
						aniObj[WoH] = normWoH;
						var normDif = normWoH - prevWoHs[0];
						kwicks.eq(0).animate(aniObj, {
							step: function (now) {
								var percentage = normDif != 0 ? (now - prevWoHs[0])/normDif : 1;
								for(i = 1; i < kwicks.size(); i++) {
									kwicks.eq(i).css(WoH, prevWoHs[i] - ((prevWoHs[i] - normWoH) * percentage) + 'px');
									if (i < kwicks.size() - 1) {
										kwicks.eq(i).css(LoT, prevLoTs[i] - ((prevLoTs[i] - ((i * normWoH) + (i * o.spacing))) * percentage) + 'px');
									}
								}
							},
							duration: o.duration,
							easing: o.easing
						});
						
						if (options.autorotation) {
						acc_interval = setInterval(function () { autorotation(); }, (parseInt(options.autorotationSpeed) * 1000));
						}
	
					});
				}
	
				container.bind(options.event, function (event, continue_autorotate)
				{	
					//onevent stop auto rotation
					if (!continue_autorotate)
							{
								clearInterval(acc_interval);
											
								var activeslide = container.find('li').not('.active');
								activeslide.find('.shadow').animate({right: '0'},100);
								activeslide.find('.excerpt').slideUp();
								activeslide.find('.title').slideUp();
							}
			
				});
				
	
				if (options.autorotation) {
					acc_interval = setInterval(function () {
					autorotation();
													
					}, (parseInt(options.autorotationSpeed) * 1000));
		
					function autorotation()
					{	
					
						if (slide_count == current_slide)
						{						
							current_slide = 0;
						}
						else
						{
							kwicks.find('.shadow').animate({right: '0'},100);
							kwicks.find('.excerpt').slideUp();
							jQuery('#'+accordion_id).find('.jwplayer.accplay').each(function (index) {	
								str='';
								str = jQuery(this).attr("id");
								jwplayer(str).stop();
								jQuery(this).removeClass('playing');
							});
							
							kwicks.find('.title').slideUp();
							kwicks.filter(':eq('+current_slide+')').trigger(options.event,[true]);
							current_slide ++;					
						}
						
					}
				}
	
			});
		
		
		};
		
	})(jQuery);


	(function( $ ) {
		
		var accordion_gallery = function() {
			
			$(window).load(function() {

				$('.accordion-gallery-wrap').each(function(index, value) { 	
						
					var gallery = '#'+$(this).attr('id'),
						gallery_id = $(this).attr('id'),
						autorotate = $( gallery ).attr("data-accordion-autorotate"),
						timeout = $( gallery + ' .timeout').val();
						
						$( gallery + ' .accordion-gallery').kwicks({
						autorotation: autorotate,
						event: 'mouseover',
						autorotationSpeed: timeout,
						easing: 'easeInOutCubic',
						duration: 700,
						id: gallery_id
						});
	
				});
			});
			
		}
		
		accordion_gallery();
	
	})(jQuery);
	
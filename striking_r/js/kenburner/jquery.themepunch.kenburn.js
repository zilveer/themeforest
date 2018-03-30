/**************************************************************************
 * jquery.themepunch.kenburn.js - jQuery Plugin for kenburn Slider
 * @version: 1.5.4 (06.01.2014)
 * @requires jQuery v1.4.6 or later
 * @author ThemePunch
**************************************************************************/




(function($,undefined){



	////////////////////////////
	// THE PLUGIN STARTS HERE //
	////////////////////////////

	$.fn.extend({


		// OUR PLUGIN HERE :)
		kenburn: function(options) {



		////////////////////////////////
		// SET DEFAULT VALUES OF ITEM //
		////////////////////////////////
		var defaults = {

			responsive:"on",
			noresponsiveWidth:600,
			noresponsiveHeight:300,
			fixHeight:false,
			thumbWidth:50,
			thumbHeight:50,
			thumbAmount:6,
			thumbStyle:"bullet",		// bullet, image,none
			thumbXOffset:0,
			thumbYOffset:0,
			bulletXOffset:0,
			bulletYOffset:0,
			shadow:'true',
			timer:2000,
			touchenabled:"on",
			pauseOnRollOverThumbs:'off',
			pauseOnRollOverMain:'on',
			preloadedSlides:50,
			googleFonts:'PT+Sans+Narrow:400,700',
			googleFontJS:'http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js',
			debug:"no",
			rescaleBGColor:"#333"

		};

			options = $.extend({}, defaults, options);

				WebFontConfig = {
						google: { families: [ options.googleFonts ] },
						active: function() { jQuery('body').data('googlefonts','loaded');},
						inactive: function() { jQuery('body').data('googlefonts','loaded');}
					};


			return this.each(function() {


				var opt=options;
				if (opt.vCorrection==undefined) opt.vCorrection=10;
				if (opt.hCorrection==undefined) opt.hCorrection=10;


				if (opt.debug=="yes" || opt.debug=="on")
					$('body').append('<div class="testinfo" style="z-index:99999;position:fixed;background:#000;color:#fff;width:700px;height:200px;top:10px;left:10px;"></div>');

				// GOOGLE FONT HANDLING
				if (opt.googleFonts!=undefined && opt.googleFonts.length>0) {
					var wf = document.createElement('script');
					wf.src = opt.googleFontJS;
					wf.type = 'text/javascript';
					wf.async = 'true';
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(wf, s);
					jQuery('body').data('googlefonts','wait');
				} else {
					jQuery('body').data('googlefonts','loaded');
				}


				opt.savedTimer=opt.timer;
				var top_container=$(this);
				if (top_container.attr('id') == undefined) top_container.attr('id',Math.round(Math.random()*100000));

				var minW = top_container.css('minWidth');
				var maxW = top_container.css('maxWidth');
				opt.whproportion =  parseInt(top_container.css('height'),0) / parseInt(top_container.css('maxWidth'),0);


				opt.width=top_container.width()-opt.hCorrection;
				opt.height = top_container.height()-opt.vCorrection;



				if (!opt.fixHeight || !opt.fixHeight=="true") {
					opt.height=opt.width * opt.whproportion;
				}


				opt.originalwidth = parseInt(top_container.css('maxWidth'),0);
				opt.originalheight = parseInt(top_container.css('height'),0);

				if (!opt.fixHeight || !opt.fixHeight=="true") {
					opt._propw = opt.width / opt.originalwidth;
					opt._proph = opt.height / opt.originalheight;
				} else {
					opt._propw = 1;
					opt._proph = 1;
				}

				top_container.height(opt.height+opt.vCorrection);

				//opt.height=top_container.height()-10;
				opt.oldid="responsive"+top_container.attr('id');

				top_container.wrap('<div id="'+opt.oldid+'" class="responsiveholder"></div>');
				opt.fullHTML=$('body').find('#'+opt.oldid).html();


				var responsive = true;
				if (minW==maxW || maxW=="none") responsive=false;

				if (opt.responsive=="off") {
					responsive=false;
					opt.width = opt.noResponsiveWidth;
					opt.height = opt.noResponsiveHeight;
				}


				// if (opt.width<500 && responsive && !opt.fixHeight) {
				// 	opt._propw = opt._propw*1.7;
				// 	opt._proph = opt._proph*1.7;
				// }


				// HERE WE GO TO START PREPARE EVERYTHING
				startToPrepare(top_container,opt);
				opt.videoWasOn=-1;




				// Create Responsive Listener
				if (responsive)
				  $(window).resize(function() {



					if (top_container.find('.videoon').length>0 && opt.videoWasOn==-1) {
						opt.videoWasOn=1
					 } else {
						if (opt.videoWasOn==-1) opt.videoWasOn=0;
					}



					clearInterval(opt.aktKenInterval);
					clearInterval(opt.timerinterval);
					clearInterval(opt.waitForWF);
					clearTimeout(opt.resetAll);


					opt.width=top_container.width()-opt.hCorrection;

					if (!opt.fixHeight || !opt.fixHeight=="true")	{

						opt.height=opt.width * opt.whproportion;
						opt._propw = opt.width / opt.originalwidth;
						opt._proph = opt.height / opt.originalheight;
					}




					// if (opt.width<500 && responsive && !opt.fixHeight) {
					// 	opt._propw = opt._propw*1.7;
					// 	opt._proph = opt._proph*1.7;
					// }
					opt.preloadedSlides=200;

				    top_container.empty();
					top_container.remove();


					$('body').find('#'+opt.oldid).append(opt.fullHTML);
					top_container=$('body').find('#'+opt.oldid).find('div:first');
					top_container.height(opt.height+opt.vCorrection);
					opt.resetAll = setTimeout(function() {startToPrepare(top_container,opt);},200);

				});
			})
	}
})


		///////////////////////////////
		//  --  LOCALE FUNCTIONS -- //
		///////////////////////////////

					function startToPrepare(top_container,opt) {



								// DEBUGGING INFORMATIONS HERE
								if (opt.debug==="on")
									$('body').append('<div class="khinfo" style="background:#fff;color:#000;width:300px;height:250px;position:fixed;left:10px;top:10px;"></div>');

								//top_container.css({'width':opt.width+"px",'height':opt.height+"px"});

								top_container.append('<div class="kenburn-preloader"></div>');
								$('body').find('.khinfo').html('Start Slider');

								prepareSlidesContainer(top_container,opt);
								$('body').find('.khinfo').html('Prepared Container');

								prepareSlides(top_container,opt);
								$('body').find('.khinfo').html('Prepared Preloaded Slides');





								$('body').find('.khinfo').html('Waiting for Images...');
								opt.loadedImages=0;
								top_container.waitForImages(
									function() {
										$('body').find('.khinfo').html('Preloaded Images has been loaded');
										opt.waitForWF = setInterval(function() {




																$('body').find('.khinfo').html('Waiting for Google Fonts');

															// IF THE GOOGLE FONT IS LOADED WE CAN START TO ROTATE THE IMAGES
															if ($('body').data('googlefonts') != undefined && $('body').data('googlefonts')=="loaded") {

																opt.lastThumb=opt.currentThumb;
																// CREATE THE THUMBNAILS HERE
																if (opt.thumbStyle=="image" || opt.thumbStyle=="both" || opt.thumbStyle=="thumb")
																	createThumbnails(top_container,opt);

																if (opt.thumbStyle=="bullet" || opt.thumbStyle=="both")
																	createBullets(top_container,opt);


																$('body').find('.khinfo').html('Google Fonts are here');
																clearInterval(opt.waitForWF);


																startRotation(top_container,opt);

																$('body').find('.khinfo').html('Rotation Started');
																prepareRestSlides(top_container,opt);
																if (opt.thumbStyle=="both") top_container.find('.thumbbuttons').css({'visibility':'hidden'});
																top_container.css({'background-color':'transparent'});

																/*if (opt.lastThumb != undefined) {
																	var thumb = top_container.find('.kenburn_thumb_container #thumbmask .thumbsslide #thumb'+opt.lastThumb);
																	thumb.click();
																} */



															}
														},10);
									},
									function() {
										$('body').find('.khinfo').html(opt.loadedImages+'. Image has been Loaded');
										opt.loadedImages=opt.loadedImages+1;
									});


								startTimer(top_container,opt);

								// TOUCH ENABLED SCROLL
								if (opt.touchenabled=="on")

											top_container.swipe( {
															swipeLeft:function()
																	{
																		var newitem = top_container.data('currentSlide');
																		if (newitem.index()<opt.maxitem-1) {
																			var next=top_container.find('ul li:eq('+(newitem.index()+1)+')');
																		} else {
																			var next=top_container.find('ul li:first');
																		}
																		swapBanner(newitem,next,top_container,opt);
																	},
															swipeRight:function()
																	{
																		var newitem = top_container.data('currentSlide');
																		if (newitem.index()>0) {
																			var next=top_container.find('ul li:eq('+(newitem.index()-1)+')');
																		} else {
																			var next=top_container.find('ul li:eq('+(opt.maxitem-1)+')');
																		}
																		swapBanner(newitem,next,top_container,opt);
																	},
															excludedElements:".close, .kenburn-video-overlay, .kenburn-video-button, .hover-more-sign, .hover-blog-link-sign .thumbnails, .closebutton",
														allowPageScroll:"auto"} );

					}

					///////////////////////////////////////////
					//	--	Set the Containers of Slides --	 //
					///////////////////////////////////////////


					function prepareSlides(top,opt) {
						top.find('iframe').attr("frameborder",0);

						top.find('ul').wrap('<div class="slide_mainmask" style="z-index:10;position:absolute;top:'+(opt.padtop+opt.botop)+'px;left:'+(opt.padleft+opt.boleft)+'px;width:'+opt.width+'px;height:'+opt.height+'px;overflow:hidden"></div>');
						top.find('ul .slide_mainmask').css({'opacity':'0.0'});

						opt.maxitem=0;
						top.find('ul >li').each(function(i) {
							opt.maxitem=opt.maxitem+1;
							var $this=$(this);
							var img = $this.find('img:first');
							img.data('src',img.attr('src'));
							img.attr('src',"");
						});

						for (var i=0;i<opt.preloadedSlides;i++) {
								prepareSlide(top,opt,i);
						}
					}


					////////////////////////////////////
					// Prepare THe Rest of the Slides //
					///////////////////////////////////
					function prepareRestSlides(top,opt) {
						for (var i=opt.preloadedSlides;i<opt.maxitem;i++) {
								prepareSlide(top,opt,i);

						}
					}


					//////////////////////////////
					// PREPARE SLIDE ONE BY ONE //
					//////////////////////////////
					function prepareSlide(top,opt,nr) {

						top.find('ul >li').each(function(i) {
							if (i==nr) {
										var $this = $(this);
										$this.find('.creative_layer').wrap('<div class="layer_container" style="position:absolute;left:0px;top:0px;width:'+opt.width+'px;height:'+opt.height+'px"></div>');

										// SET THE SIZES OD THE CAPTIONS DEPENDING ON THE BROWSER SIZE
										top.removeClass('kb-minisize').removeClass('kb-halfsize').removeClass('kb-fullsize');

										if ($(window).width()<=570)
											top.addClass('kb-minisize');
										  else
											if ($(window).width()<=767)
												top.addClass('kb-smallsize');
											 else
												if($(window).width()<=959)
													top.addClass('kb-mediumsize');
												else
												  if($(window).width()>959)
													top.addClass('kb-fullsize');




										$this.wrapInner('<div class="slide_container" style="z-index:10;position:absolute;top:0px;left:0px;width:'+opt.width+'px;height:'+opt.height+'px;overflow:hidden"><div class="parallax_container" style="position:absolute;top:0px;left:0px"><div class="kb_container"></div></div></div>');


										var ie_old = !$.support.opacity;
										//opt.ie9 = (document.documentMode == 9);

										// PREPARE THE BLACK AND WHITE IMAGES HERE
										if ($this.find('img:first').data('bw') != undefined && $this.find('img:first').data('bw').length>0 && !ie_old )
											$this.find('.kb_container').append('<img class="bw-main-image" src="'+$this.find('img:first').data('bw')+'" style="position:absolute;top:0px;left:0px">');

										$this.find('img:first').attr('src',$this.find('img:first').data('src'));
										/*******************************
										################################
											THE STRUCTUE:

											->slide_container
												->parallax_container
													->kb_container
										################################
										********************************/
										$this.find('.slide_container').css({'opacity':'0.0'});

										$this.find('.slide_container .parallax_container .kb_container .video_kenburner').each(function() {
											var $this=$(this);
											$this.closest('.slide_container').append('<div class="kenburn-video-overlay"></div>');
											$this.closest('.slide_container').append('<div class="kenburn-video-button"></div>');

											$this.closest('.slide_container').data('video',1);

											var pbutton = $this.closest('.slide_container').parent().find('.kenburn-video-button');
											var over = $this.closest('.slide_container').parent().find('.kenburn-video-overlay');
											var _width  = parseInt(pbutton.css('width'),0);
											var _height = parseInt(pbutton.css('height'),0);
											var mwidth  = parseInt($this.closest('.slide_container').css('width'),0);
											var mheight = parseInt($this.closest('.slide_container').css('height'),0);

											pbutton.css({'left':(mwidth/2-_width/2)+'px','top':(mheight/2-_height/2)+'px'});
											pbutton.data('top',top);
											pbutton.data('url',$this.html());
											$this.remove();
											over.data('origopa',over.css('opacity'));


											// VIDEO IS DEFINED, SO HOVER ON VIDEO BUTTON SHOULD MAKE SOME EFFECT
											pbutton.hover(
													function() {

														var $this = $(this);
														var $over = $this.parent().find('.kenburn-video-overlay');


														var msie_old = !$.support.opacity && (document.documentMode == 8);
														var msie=!$.support.opacity || (document.documentMode == 9);

														if ( msie )
															$over.animate({'opacity':'0.5'},{duration:100});
														else
															$over.cssAnimate({'opacity':'0.5'},{duration:100});

														if (msie_old) {
															$over.css({'display':'block'});
														}
													},
													function() {
														var $this = $(this);
														var $over = $this.parent().find('.kenburn-video-overlay');

														var msie_old = !$.support.opacity && (document.documentMode == 8);
														var msie=!$.support.opacity || (document.documentMode == 9);

														if ( msie )
															$over.animate({'opacity':$over.data('origopa')},{duration:100});
														else
															$over.cssAnimate({'opacity':$over.data('origopa')},{duration:100});

														if (msie_old) {
															$over.css({'display':'none'});
														}
												});


											// VIDEO IS DEFINED, SO CLICK ON VIDEO BUTTON SHOULD START TO PLAY THE VIDEO HERE
											pbutton.click(
												function() {
													var $this=$(this);
													var top=$this.data('top');
													var slidemask = top.find('.slide_mainmask');
													slidemask.addClass("videoon");
													top.data('currentSlide').animate({'top':opt.height+"px"},{duration:500,queue:false});

													top.find('.slide_mainmask').append('<div class="video_kenburn" style="z-index:9999;width:'+opt.width+'px;height:'+opt.height+'px">'+$this.data('url')+'</div>');
													var video = top.find('.slide_mainmask .video_kenburn');
													video.css({'top':(0-opt.height)+"px"});
													if (opt.videoWasOn==1)
														video.animate({'top':'0px'},{duration:0,queue:false});
													else
														video.animate({'top':'0px'},{duration:500,queue:false});

													video.find('* .close').click(
														function() {

															var slidemask = top.find('.slide_mainmask');
															slidemask.removeClass("videoon");
															top.data('currentSlide').animate({'top':"0px"},{duration:600,queue:false});
															video.animate({'top':(0-opt.height)+'px'},{duration:600,queue:false});
															setTimeout(function() {video.remove()},600);
														});
												});

										});
								}
						});
					}


					////////////////////////////////////////////////
					//	--	BACKGROUND AND DEFAULT VALUES --	 //
					//////////////////////////////////////////////
					function prepareSlidesContainer(top,opt) {
						top.append('<div class="kenburn-bg" style="z-index:7;position:absolute;top:0px;left:0px;width:'+opt.width+'px;height:'+opt.height+'px;overflow:hidden"></div>');
						var bg=top.find('.kenburn-bg');

						opt.padtop=0;
						opt.padleft=0;
						opt.padright=0;
						opt.padbottom=0;

						opt.botop=0;
						opt.boleft=0;
						opt.boright=0;
						opt.bobottom=0;


						var msie_old = !$.support.opacity && (document.documentMode == 8);
						var msie=!$.support.opacity || (document.documentMode == 9);

						if (msie) {
							if (bg.css('paddingTop') !=undefined && bg.css('paddingTop') !=null)
								if (bg.css('paddingTop').length>0)
									opt.padtop=parseInt(bg.css('paddingTop'),0);

							if (bg.css('paddingLeft') !=undefined && bg.css('paddingLeft') !=null)
								if (bg.css('paddingLeft').length>0)
									opt.padleft=parseInt(bg.css('paddingLeft'),0);

							if (bg.css('paddingRight') !=undefined && bg.css('paddingRight') !=null)
								if (bg.css('paddingRight').length>0)
									opt.padright=parseInt(bg.css('paddingRight'),0);

							if (bg.css('paddingBottom') !=undefined && bg.css('paddingBottom') !=null)
								if (bg.css('paddingBottom').length>0)
									opt.padbottom=parseInt(bg.css('paddingBottom'),0);

							if (bg.css('borderTopWidth') !=undefined && bg.css('borderTopWidth') !=null)
								if (bg.css('borderTopWidth').length>0)
									opt.botop=parseInt(bg.css('borderTopWidth'),0);

							if (bg.css('borderLeftWidth') !=undefined && bg.css('borderLeftWidth') !=null)
								if (bg.css('borderLeftWidth').length>0)
									opt.boleft=parseInt(bg.css('borderLeftWidth'),0);

							if (bg.css('borderRightWidth') !=undefined && bg.css('borderRightWidth') !=null)
								if (bg.css('borderRightWidth').length>0)
									opt.boright=parseInt(bg.css('borderRightWidth'),0);

							if (bg.css('borderBottomWidth') !=undefined && bg.css('borderBottomWidth') !=null)
								if (bg.css('borderBottomWidth').length>0)
									opt.bobottom=parseInt(bg.css('borderBottomWidth'),0);
						} else {
								if (bg.css('paddingTop').length>0)
									opt.padtop=parseInt(bg.css('paddingTop'),0);


								if (bg.css('paddingLeft').length>0)
									opt.padleft=parseInt(bg.css('paddingLeft'),0);


								if (bg.css('paddingRight').length>0)
									opt.padright=parseInt(bg.css('paddingRight'),0);


								if (bg.css('paddingBottom').length>0)
									opt.padbottom=parseInt(bg.css('paddingBottom'),0);


								if (bg.css('borderTopWidth').length>0)
									opt.botop=parseInt(bg.css('borderTopWidth'),0);


								if (bg.css('borderLeftWidth').length>0)
									opt.boleft=parseInt(bg.css('borderLeftWidth'),0);


								if (bg.css('borderRightWidth').length>0)
									opt.boright=parseInt(bg.css('borderRightWidth'),0);


								if (bg.css('borderBottomWidth').length>0)
									opt.bobottom=parseInt(bg.css('borderBottomWidth'),0);
							}



						}










					///////////////////////////
					// CREATE THE THUMBNAILS //
					//////////////////////////
					function createThumbnails(top,opt) {

						var maxitem = top.find('ul >li').length;


						// CALCULATE THE MAX WIDTH OF THE THUMB HOLDER
						var maxwidth = opt.thumbAmount * opt.thumbWidth;
						opt.thumbmaxwidth=maxwidth;
						var maxheight = opt.thumbHeight;

						var bgwidth = maxwidth;
						var bgheight = maxheight;
						var full = opt.width + opt.padleft + opt.padright;
						var centerl = Math.round(full /2 - bgwidth/2);

						var max= (maxitem * opt.thumbWidth);


						// CREATE THE BACKGROUND 1 PIXEL ROUND BG
						top.append('<div class="kenburn_thumb_container" style="position:absolute;left:'+centerl+'px;top:'+(1+opt.height+opt.padtop+opt.padbottom)+'px;width:'+(bgwidth+2)+'px;height:'+(bgheight+2)+'px;"></div>');

						// CREATE THE WHITE HOLDER
						var thc=top.find('.kenburn_thumb_container');
						if (opt.hideThumbs=="on") thc.css({'opacity':0});

						if (opt.thumbAmount==0) thc.css({'visibility':'hidden'});
						thc.append('<div class="kenburn_thumb_container_bg" style="position:absolute;left:1px;top:0px;width:'+(bgwidth)+'px;height:'+(bgheight)+'px"></div>');


						// CREATE THE MASK INSIDE
						thc.append('<div id="thumbmask" style="overflow:hidden;position:absolute;top:0px;left:1px; width:'+maxwidth+'px;	height:'+opt.thumbHeight+'px;overflow:hidden;"></div>');
						var thma=thc.find('#thumbmask');

						// CREATE THE SLIDER CONTAINER
						thma.append('<div class="thumbsslide" style="width:'+max+'px"></div>');
						var thbg=thma.find('.thumbsslide');

						thc.hover(
							function() {
								$(this).addClass('overme');
								thc.animate({'opacity':1},{duration:300,queue:false});
							},
							function() {
								$(this).removeClass('overme');
								var sm = top.find('.slide_mainmask');

								setTimeout(function() {
									if (opt.hideThumbs=="on" && !sm.hasClass('overon') && !$('body').hasClass('tp_showthumbsalways')) {
										thc.animate({'opacity':0},{duration:300,queue:false});
									}
								},10);
							});

						/**********************************************
						##############################################
								STRUCTURE OF THUMBNAILS

							->.kenburn_thumb_container
									->#thumbmask
										->.thumbsslide
											->thumb (thumb"i")
							->.kenburn_thumb_container_bg

						##############################################
						*********************************************/

						// GO THROUGHT THE ITEMS, AND CREATE AN THUMBNAIL AS WE NEED
						top.find('ul >li').each(function(i) {

									var $this=$(this);

									// READ OUT THE DATA INFOS
									var img=$this.find('img:first');

									var src=img.data('thumb');
									var isvideo = $this.find('.slide_container').data('video')==1;

									// CREATE THE THUMBS
									var thumb=$('<div class="kenburn-thumbs" id="thumb'+i+'" style="cursor:pointer;position:absolute;top:0px;left:'+(i*opt.thumbWidth)+'px;width:'+opt.thumbWidth+'px;height:'+opt.thumbHeight+'px;background:url('+src+');"></div>');
									thumb.data('id',i);

									var overlay=$('<div class="overlay"></div>');
									thumb.append(overlay);

									if (i==maxitem)	thumb.css({'margin-right':'0px'});

									thbg.append(thumb);

									if (i==opt.lastThumb) {
										thumb.addClass("selected");
										thumb.find('.overlay').css({'opacity':0});

									} else {
										thumb.find('.overlay').css({'opacity':0.75});
										thumb.removeClass("selecte");
									}



									// CREATE VIDEO BUTTON ON THE THUMBNAIL
									if (isvideo && opt.thumbVideoIcon=="on") {
										var new_video=$('<div class="video"></div>');
										thumb.append(new_video);
										thumb.find('.video').css({'position':'absolute',
																  'top':opt.thumbHeight/2+'px',
																  'left':opt.thumbWidth/2+'px',
																  'z-index':'1000'});
										}





									///////////////////////////////////////
									// SHOW THE COLORED THUMBNAIL HERE  //
									//////////////////////////////////////
									var thumbnail = thbg.find('#thumb'+i);
									thumbnail.hover(
										function() {

											var thumb = $(this);
											thumb.stop();
											thumb.find('.overlay').animate({'opacity':0},{duration:300,queue:false});
										},
										function() {
											var thumb = $(this);
											thumb.stop();
											if (!thumb.hasClass('selected'))
												thumb.find('.overlay').animate({'opacity':0.75},{duration:300,queue:false});
										});

									thumbnail.click(function() {
										var $this=$(this);

										if (($this.position().left+opt.thumbWidth) == opt.thumbmaxwidth && $this.index() != maxitem-1) {
											$this.parent().find('.kenburn-thumbs').each(function() {
												var thumb=$(this);
												thumb.cssAnimate({'left':(thumb.position().left - opt.thumbWidth)+"px"},{duration:300,queue:false});
											});
										}


										if (($this.position().left) == 0 && $this.index() > 0) {
											$this.parent().find('.kenburn-thumbs').each(function() {
												var thumb=$(this);
												thumb.cssAnimate({'left':(thumb.position().left + opt.thumbWidth)+"px"},{duration:300,queue:false});
											});
										}


										if (!$this.hasClass("selected")) {
											var newslide = top.find('ul li:eq('+$this.data('id')+')');
											swapBanner(top.data('currentSlide'),newslide,top,opt);
										}
									});



							});

							opt.thumbVertical="bottom";
							// POSITION VERTICAL
							if (opt.thumbVertical=="bottom") {
								//thc.css({'z-index':1000,'top':opt.thumbYOffset + (opt.height-opt.thumbHeight)+"px"});
								thc.css({'z-index':1000,'top':opt.thumbYOffset + (opt.height)+"px"});
							} else {
									if (opt.thumbVertical=="center") {
										thc.css({'z-index':1000,'top':opt.thumbYOffset + (opt.height/2 - opt.thumbHeight/2)+"px"});
									} else {
										thc.css({'z-index':1000,'top':(opt.thumbYOffset)+"px"});
									}
							}

							// POSITION HORIZONTAL
							if (opt.thumbHorizontal=="left") {
								thc.css({'left':opt.thumbXOffset+"px"});
							}  else {
								if (opt.thumbHorizontal=="right") {
									thc.css({'left':opt.thumbXOffset + (opt.width - maxwidth)+"px"});
								} else {
									thc.css({'left':opt.thumbXOffset + thc.position().left + "px"});
								}
							}

							if (opt.hideThumbs=="on") {

								thc.removeClass('overme');
								var sm = top.find('.slide_mainmask');

								setTimeout(function() {
									if (opt.hideThumbs=="on" && !sm.hasClass('overon') && !$('body').hasClass('tp_showthumbsalways')) {
										thc.animate({'opacity':0},{duration:0,queue:false});
									}
								},10);
							}

					}


					///////////////////////////
					// CREATE THE BULLETS //
					//////////////////////////
					function createBullets(top,opt) {

						var maxitem = top.find('ul >li').length;


						// CALCULATE THE MAX WIDTH OF THE THUMB HOLDER
						var full = opt.width + opt.padleft + opt.padright;

						// Create BULLET CONTAINER
						top.append('<div class="thumbbuttons"><div class="grainme"><div class="leftarrow"></div><div class="thumbs"></div><div class="rightarrow"></div></div></div>');
						var leftb = top.find('.leftarrow');
						var rightb = top.find('.rightarrow');


						rightb.click(function()
												{
													var newitem = top.data('currentSlide');
													if (newitem.index()<opt.maxitem-1) {
														var next=top.find('ul li:eq('+(newitem.index()+1)+')');
													} else {
														var next=top.find('ul li:first');
													}
													swapBanner(newitem,next,top,opt);
												});
						leftb.click(function()
												{
													var newitem = top.data('currentSlide');
													if (newitem.index()>0) {
														var next=top.find('ul li:eq('+(newitem.index()-1)+')');
													} else {
														var next=top.find('ul li:eq('+(opt.maxitem-1)+')');
													}
													swapBanner(newitem,next,top,opt);
												});

						var minithumbs = top.find('.thumbs');




						// GO THROUGHT THE ITEMS, AND CREATE AN THUMBNAIL AS WE NEED
						top.find('ul >li').each(function(i) {

									var $this=$(this);


									var thumb_mini=$('<div class="minithumb" id="minithumb'+i+'"></div>');


									thumb_mini.data('id',i);
									minithumbs.append(thumb_mini);

									thumb_mini.click(function() {
										var $this=$(this);
										if (!$this.hasClass("selected")) {
											var newslide = top.find('ul li:eq('+$this.data('id')+')');
											swapBanner(top.data('currentSlide'),newslide,top,opt);
										}
									});

							});

							minithumbs.waitForImages(function() {
								var tp = parseInt(minithumbs.parent().parent().css('top'),0);
								minithumbs.parent().parent().css({'top':(tp+opt.bulletYOffset)+"px",'left':((full/2 - parseInt(minithumbs.parent().width(),0)/2)+opt.bulletXOffset)+"px"});

							});



					}

					/////////////////////////////////////////////
					// - START THE ROTATION OF THE BANNER HERE //
					/////////////////////////////////////////////
					function startRotation(item,opt) {
						var msie_old = !$.support.opacity && (document.documentMode == 8);
						var msie=!$.support.opacity || (document.documentMode == 9);

						if ( msie ) {
							item.find('.kenburn-preloader').animate({'opacity':'0.0'},{duration:300,queue:false});

						} else {
							item.find('.kenburn-preloader').cssAnimate({'opacity':'0.0'},{duration:300,queue:false});
						}
						setTimeout(function() {item.find('.kenburn-preloader').remove();},300);
						if (opt.lastThumb==undefined) opt.lastThumb=0;

						var first_slide = item.find('ul li:eq('+opt.lastThumb+')') ;
						swapBanner(first_slide,first_slide,item,opt);
						startParallax(item,opt);
						opt.loaded=1;


						if (opt.videoWasOn==1)
							item.parent().find('.kenburn-video-button').click();
						opt.videoWasOn=-1;

					}




					/////////////////////////////////
					// - START THE PARALLAX EFFECT //
					////////////////////////////////
					function startParallax(slidertop,opt) {

						// FIND THE RIGHT OBJECT
						var top = slidertop.find('.slide_mainmask');

						// SET WIDTH AND HEIGHT
						top.data('maxwidth',opt.width+opt.padleft+opt.padright);
						top.data('maxheight',opt.height+opt.padtop+opt.padbottom);
						top.data('pdistance',opt.parallaxX);
						top.data('pdistancey',opt.parallaxY);
						top.data('cdistance',opt.captionParallaxX);
						top.data('cdistancey',opt.captionParallaxY);
						top.data('opt',opt);


						// KEN BURN ANIMATION
						var slide = top.parent().data('currentSlide');
						var par = top.find('.parallax_container');
						var layers = slide.find('.layer_container');


						// THE FIRST MOUSE OVER ON THE TOP
						top.mouseenter(function(e) {
							var $this = $(this);
							// FIND THE RIGHT THUMBNAIL HOLDER OBJECT
							var thma = $this.parent().find('.kenburn_thumb_container #thumbmask');

							// IF MOUSE IS NOT OVER THE THUMBS AND START ANIMATION NOT RUNNING
								var slide = $this.parent().data('currentSlide');
								var par = slide.find('.parallax_container');
								var layers = slide.find('.layer_container');


								$this.addClass('overon');

							clearTimeout(opt.hideThumb);
							slidertop.find('.kenburn_thumb_container').animate({'opacity':1},{duration:300,queue:false});


						});

						// BACK TO CENTER AFTER LEAVE
						top.mouseleave(function(e) {
								var $this = $(this);
								var slide = $this.parent().data('currentSlide');
								var par = slide.find('.parallax_container');
								var layers = slide.find('.layer_container');
								$this.removeClass("overme");
								$this.removeClass('overon');

								// FIND THE RIGHT THUMBNAIL HOLDER OBJECT
								var thc = slidertop.find('.kenburn_thumb_container');

								setTimeout(function() {
										if (opt.hideThumbs=="on" && !thc.hasClass('overme') && !$('body').hasClass('tp_showthumbsalways')) {
											slidertop.find('.kenburn_thumb_container').animate({'opacity':0},{duration:300,queue:false});
										}
								},10);

						});

						// HERE COME THE DIRECT PARALLAX HANDLING FOR QUICK ANIMATIONS
						top.mousemove(function(e) {

							var $this = $(this);
							if (opt.pauseOnRollOverMain != "off")
								$this.addClass("overme");
							// FIND THE RIGHT THUMBNAIL HOLDER OBJECT
							var thma = $this.parent().find('.kenburn_thumb_container #thumbmask');
							slidertop.find('.kenburn_thumb_container').css({'display':'block'});
							// IF MOUSE IS NOT OVER THE THUMBS AND START ANIMATION NOT RUNNING
							if (!thma.hasClass('overme') && !$this.hasClass('overon')) {


									var slide = $this.parent().data('currentSlide');
									var par = slide.find('.parallax_container');
									var layers = slide.find('.layer_container');


							} else {

								setTimeout(function() {$this.removeClass('overon')},100);
							}
						});



					}


					/////////////////////////////
					// RANDOM ALIGN GENERATOR //
					////////////////////////////
					function randomAlign() {

						var align="";
						var a=Math.floor(Math.random()*3);
						var b=Math.floor(Math.random()*3);

						if (a==0) align="left";
							else
								if (a==1) align="center"
									else
										align="right";

						if (b==0) align=align+",top"
							else
								if (b==1) align=align+",center"
									else
										align=align+",bottom";
						return align;
					}

					////////////////////////////////////////////////////
					// - THE BANNER SWAPPER, ONE AGAINST THE OTHER :) //
					////////////////////////////////////////////////////
					function swapBanner(item,newitem,slider_container,opt) {

							clearInterval(opt.aktKenInterval);
							var trans=false;
							//console.log("SWAPBANNER Called");
							slider_container.find('ul >li').each(function(i) {
								var $this=$(this);
								clearInterval($this.data('interval'));

								if ($this.index() !=item.index() && $this.index() !=newitem.index()) {
									$this.css({'display':'none','position':'absolute','left':'0px','z-index':'994'});

								}
							});


							var video = slider_container.find('.slide_mainmask .video_kenburn');
							setTimeout(function() {video.remove()},600);

							var slidemask = slider_container.find('.slide_mainmask');
							slidemask.removeClass("videoon");

							item.css({'position':'absolute','top':'0px','left':'0px','z-index':'900'});
							newitem.css({'position':'absolute','top':'0px','left':'0px','z-index':'1000'});
							newitem.css({'display':'block'});

							//Lets find the Image
							var sour=newitem.find('img:first');
							var sourbw=newitem.find('.bw-main-image');


							var kenburn=true;
							if (newitem.data('kenburn')=="off" || (navigator.userAgent.match(/Android/i)) )
								{
									hasCanvas=false;
									kenburn=false;
									newitem.data('startalign','center,center');
									newitem.data('endalign','center,center');
									newitem.data('zoom','none');
									newitem.data('zoomfact',0);

								}


							// Lets Save the Size of the IMG first in the DATA
							if (newitem.data('ww') == undefined) {
								var oldW=newitem.find('img').width()			//Read out the Width
								var oldH=newitem.find('img').height()			//Read out the Height
								if (oldW!=0) {									// If the Width is not 0 (the image is loaded)

									// Let See if the KenBurn Img is smaller than the stage (width). If yes, we need to scale it first !
									if (sour.width()>0 && sour.width()<opt.width) {
										var factor=opt.width / oldW;
										oldW=oldW*factor;
										oldH=oldH*factor;

									}

									// Let See if the KenBurn IMG is smaller then the stage height). If yes, we need to scale it first !!
									if (sour.height()>0 && sour.height()<opt.height) {
										var factor=opt.height / oldH;
										oldW=oldW*factor;
										oldH=oldH*factor;
									}

									newitem.data('ww',oldW);
									newitem.data('hh',oldH);
								}
							} else {

								var oldW = newitem.data('ww');
								var oldH = newitem.data('hh');
							}



							oldW = oldW*(opt._propw);
							oldH = oldH*(opt._proph);




											// Create the Standard Values
											var newT=0;
											var newL=0;
											var endT=0;
											var endL=0;
									if (kenburn) {
											var startalign = newitem.data('startalign');
											var endalign = newitem.data('endalign');

											if (startalign=="random") startalign = randomAlign();
											if (endalign=="random") endalign = randomAlign();

											// Lets Compute the Start Position here depending on the Start Align
											if (startalign != undefined) {


												var salignh = startalign;
												var horiz = salignh.split(',')[0];
												var vert = salignh.split(',')[1];


												if (horiz == "left") newL=0;
												 else
													if (horiz == "center") newL=(opt.width/2 - oldW/2);
													   else
														 if (horiz == "right") newL= 0 - Math.abs(opt.width - oldW);

												if (vert == "top") newT=0;
												 else
													if (vert == "center") newT=(opt.height/2 - oldH/2);
													   else
														 if (vert == "bottom") newT= 0 - Math.abs(opt.height - oldH);
											}


											// Lets compute the End Positions depending on the End Align
											if (endalign != undefined) {

												var ealignh = endalign;
												var horiz = ealignh.split(',')[0];
												var vert = ealignh.split(',')[1];

												if (horiz == "left") endL=0;
												 else
													if (horiz == "center") endL=(opt.width/2 - oldW/2);
													   else
														 if (horiz == "right") endL= 0 - Math.abs(opt.width - oldW);

												if (vert == "top") endT=0;
												 else
													if (vert == "center") endT=(opt.height/2 - oldH/2);
													   else
														 if (vert == "bottom") endT= 0 - Math.abs(opt.height - oldH);
											}


								}

								// Remove the Interval of the old item. So it do not disturb the CPU any more
								clearInterval(item.data('interval'));




								sour.parent().find('.canvas-now').remove();
								sour.parent().find('.canvas-now-bw').remove();

								// CHECK THE CANVAS SUPPORT HERE
								if (kenburn) {
									var hasCanvas=isCanvasSupported();
									var msie_old = !$.support.opacity;
									var msie=!$.support.opacity || (document.documentMode == 9);

									var isIEunder9 = !$.support.opacity;
									if (isIEunder9) hasCanvas=false;



								}
								var hascaption = true;
								// CAPTION POSITION AND SIZING
								if (newitem.find('.creative_layer div').length>0) {

									var clw = newitem.find('.creative_layer div').outerWidth();
									var clh = newitem.find('.creative_layer div').outerHeight();
									var clt = newitem.find('.creative_layer div').position().top;
									var cll = newitem.find('.creative_layer div').position().left;
								} else {
									hascaption=false;
									var clw=0;
									var clh=0;
									var clt=0;
									var cll=0;
									sourbw.remove();
								}


								// IF THERE IS CANVAS AVAILABLE, WE CAN CREATE A CANVAS HERE....
								if (hasCanvas) {

									sour.parent().append('<div style="position:absolute;z-index:1" class="canvas-now"><canvas class="canvas-now-canvas" width="'+oldW+'" height="'+oldH+'"></canvas></div>');
									sour.css({'display':'none'});
									var canvas=sour.parent().find('.canvas-now-canvas')[0];
									var context = canvas.getContext('2d');

									if (sourbw.length>0) {
										sour.parent().append('<div style="position:absolute;z-index:20" class="canvas-now-bw"><canvas class="canvas-now-canvas-bw" width="'+oldW+'" height="'+oldH+'"></canvas></div>');
										sourbw.css({'display':'none'});
										var canvasbw=sour.parent().find('.canvas-now-canvas-bw')[0];


										sour.parent().find('.canvas-now-bw').wrap('<div class="blurwrap" style="width:'+clw+'px;height:'+clh+'px;position:absolute;top:'+clt+'px;left:'+cll+'px;overflow:hidden"></div>');
										var contextbw = canvasbw.getContext('2d');
									}
								} else {

									if (sourbw.parent().hasClass("blurwrap")) {

									} else {
										sourbw.wrap('<div class="blurwrap" style="width:'+clw+'px;height:'+clh+'px;position:absolute;top:'+clt+'px;left:'+cll+'px;overflow:hidden;"></div>');
									}

								}

								sour.css({'-webkit-transform':'translateZ(0)'});
								sourbw.css({'-webkit-transform':'translateZ(0)'});

								// LETS GET THE TIME
								var time=newitem.data('panduration');

								// DEFAULT VALUES FOR SCALING AND MOVING THE IMAGE
								var scalerX=0;
								var scalerY=0;
								var newW=oldW;
								var newH=oldH;

								// READ OUT THE ZOOMFACTOR
								var zoomfact=newitem.data('zoomfact')
								var zoom = newitem.data('zoom');

								if (zoom=="random") {
									if (Math.floor(Math.random()*2) == 0) zoom="out"
										else
											zoom="in";
								}

								if (newitem.data('zoomfact')=="random") {
									zoomfact=(Math.random()*1 + 1);
								}


								// IF WE ZOOM OUT, WE NEED TO RESET THE ZOOM FIRST TO "BIG"
								if (zoom == "out") {
									newW=newW*zoomfact;
									newH=newH*zoomfact;
									newL=newL*zoomfact;
									newT=newT*zoomfact;
								}

								// NOW LETS CALCULATE THE STEPS HERE
								var movX = (endL-newL) / (time*25);
								var movY = (endT-newT) / (time*25);



								var opaStep = 1/(time*25);
								// STANDARD ZOOM STEPS
								scalerX=(oldW*zoomfact) / (time*25)/10;
								scalerY=(oldH*zoomfact) / (time*25)/10;

								// IF ZOOM OUT, WE INVERT THE ZOOM STEPS
								if (zoom == "out") {
									scalerX=scalerX*-1;
									scalerY=scalerY*-1;
								}



								// Lets compute the End Zoom Offsets depending on the End Align
								if (newitem.data('endalign') != undefined) {
									var ealignh = newitem.data('endalign');
									var horiz = ealignh.split(',')[0];
									var vert = ealignh.split(',')[1];

									if (horiz == "left") movX = movX + scalerX/4;
									 else
										if (horiz == "center") movX = movX - scalerX/2;
										   else
											 if (horiz == "right") movX = movX - scalerX;

									if (vert == "top") movY = movY + scalerY/4;
									 else
										if (vert == "center") movY = movY - scalerY/2;
										   else
											 if (vert == "bottom") movY = movY - scalerY;
								}





								// IF THE TIMER IS SMALLER THAN THE BASIC TIMER, THAN THE MAIN TIMER NEED TO BE REDUCED TO
								if (opt.timer>parseInt(newitem.data('panduration'),0)*10) {
									opt.timer=parseInt(newitem.data('panduration'),0)*10
								} else {
									opt.timer=opt.savedTimer*10;

								}


								sour.parent().find('.canvas-now-bw').css({'opacity':0});

								if (hasCanvas) {

									//context.css({'-webkit-transform':'translateZ(0)'});
									//contextbw.css({'-webkit-transform':'translateZ(0)'});
									setTimeout(function() {
										context.drawImage(sour[0],newL,newT,newW,newH);										
									},100)

									if (sourbw.length>0 && hascaption) {

											contextbw.drawImage(sourbw[0],newL,newT,newW,newH);
											setTimeout(function() {
												sour.parent().find('.canvas-now-bw').cssAnimate({'opacity':'1.0'},{duration:1000,queue:false});
											},1200);

									}
								}

								sour.cssStop(true,true);
								sourbw.cssStop(true,true);



							if (kenburn) {	sour.css({	'position':'absolute',
														'left':newL+"px",
														'top':newT+"px",
														'width':newW+"px",
														'height':newH+"px",
														'opacity':1.0});

											sourbw.css({'position':'absolute',
														'left':newL+"px",
														'top':newT+"px",
														'width':newW+"px",
														'height':newH+"px",
														'opacity':1.0});

								var oldL = newL;
								var oldT = newT;
								var oldWW = newW;
								step=0;
							} else {

											var wFF = opt.width /newW;
											var hFF = opt.height / newH;

											if (wFF>hFF) {
												newW=opt.width;
												newH = newH * wFF;
											} else {
												newW = newW * hFF;
												newH = opt.height;
											}


											sour.css({	'position':'absolute',
														'left':newL+"px",
														'top':newT+"px",
														'width':newW+"px",
														'height':newH+"px",
														'opacity':1.0});

											sourbw.css({'position':'absolute',
														'left':(newL-cll)+"px",
														'top':(newT-clt)+"px",
														'width':newW+"px",
														'height':newH+"px",
														'opacity':0.0});

											setTimeout(function() {
												sourbw.animate({'opacity':'1.0'},{duration:1000,queue:false});
											},1200);
											//sourbw.remove();
							}



							//console.log('SWAPBANNER : READY FOR KEN BURN');
							// NOW WE CAN CREATE AN INTERVAL, WHICH WILL SHOW 25 FRAMES PER SEC (TO MINIMIZE THE CPU STEPS)
							if (kenburn) {
										var msie_old = !$.support.opacity;
								        var msie=!$.support.opacity || (document.documentMode == 9);
										opt.aktKenInterval = setInterval(function() {
											$('body').find('.testinfo').html(opt.aktKenInterval+"  "+Math.floor(Math.random()*10000));

											if (!slider_container.parent().parent().find('.kenburn_thumb_container #thumbmask').hasClass('overme') && !slider_container.find('.slide_mainmask').hasClass('overme') && !slider_container.find('.slide_mainmask').hasClass('videoon')) {

												newW=newW+scalerX;		//CHANGE THE SCALING PARAMETES
												newH=newH+scalerY;

												newL=newL+movX;			// MOVE THE POSITION OF THE IMAGES
												newT=newT+movY;

												if (newL>0) newL=0;
												if (newT>0) newT=0;
												if (newL<(opt.width - newW)) newL=opt.width-newW;
												if (newT<(opt.height - newH)) newT=opt.height-newH;

												if (hasCanvas) {
													context.drawImage(sour[0],newL,newT,newW,newH);
													if (sourbw.length>0) contextbw.drawImage(sourbw[0],(newL-cll),(newT-clt),newW,newH);
												} else {

															var s=newW/oldWW;
															var p1=newL - oldL;
															var p2=newT - oldT;
															var p3=newL - oldL - cll;
															var p4=newT - oldT - clt;


															 if( msie_old ) {


																   sour.css({'filter': 'progid:DXImageTransform.Microsoft.Matrix(FilterType="bilinear",M11=' + s + ',M12=0,M21=0,M22=' + s + ',Dx=' + p1 + ',Dy=' + p2 + ')'});
																   sour.css({'-ms-filter': 'progid:DXImageTransform.Microsoft.Matrix(FilterType="bilinear",M11=' + s + ',M12=0,M21=0,M22=' + s + ',Dx=' + p1 + ',Dy=' + p2 + ')'});

																  // sourbw.css({'filter': 'progid:DXImageTransform.Microsoft.Matrix(FilterType="bilinear",M11=' + s + ',M12=0,M21=0,M22=' + s + ',Dx=' + p3 + ',Dy=' + p4 + ')'});
																  // sourbw.css({'-ms-filter': 'progid:DXImageTransform.Microsoft.Matrix(FilterType="bilinear",M11=' + s + ',M12=0,M21=0,M22=' + s + ',Dx=' + p3 + ',Dy=' + p4 + ')'});


																  sourbw.remove();

															 } else {

																	sour.cssAnimate({	'left':newL+"px",
																						'top':newT+"px",
																						'width':newW+"px",
																						'height':newH+"px"},
																					{ duration:38, easing:'linear',queue:false});

																	if (sourbw.length>0) {
																		sourbw.cssAnimate({	'left':newL+"px",
																							'top':newT+"px",
																							'width':newW+"px",
																							'height':newH+"px"},
																						{ duration:38, easing:'linear',queue:false});

																	}
															}

												}
											}
										},40);
							}


							var is_chrome = /chrome/.test( navigator.userAgent.toLowerCase() );

							if(is_chrome && opt.repairChromeBug=="on") {
								newitem.data('transition','slide');
							}

							//console.log("SWAPBANNER : SLIDE/FADE OLD AND NEW SLIDES");

							if (item.index()!=newitem.index()) {
								setTimeout(function() {
									//item.find('.canvas-now').css({'visibility':'hidden'});
									item.find('.canvas-now-bw').css({'visibility':'hidden'});
								},0);
							}


							var transspeed = 600;
							if (newitem.data('transitionspeed')!=undefined && newitem.data('transitionspeed')>0) transspeed = newitem.data('transitionspeed');
							
							// TRANSITION OF THE SLIDES
							if (newitem.data('transition')=="slide") {
									if (trans==false) {
												var left=true;
												if (item.index()>newitem.index()) left = false;

												if (left) {

													video.animate({'left':(0-opt.width)+'px'},{duration:transspeed,queue:false});
													newitem.find('.slide_container').stop(true,true);
													newitem.find('.slide_container').css({'opacity':'1.0','left':opt.width+"px"});

															item.find('.slide_container').animate({'left':0-opt.width+'px'},{duration:transspeed,queue:false});
															newitem.find('.slide_container').animate({'left':'0px','top':'0px','opacity':'1.0'},{duration:transspeed,queue:false});




												} else {

													video.animate({'left':(opt.width)+'px'},{duration:transspeed,queue:false});
													newitem.find('.slide_container').stop(true,true);
													newitem.find('.slide_container').css({'opacity':'1.0','position':'absolute','top':'0px','left':0-opt.width+'px'});

													//if ( $.browser.msie )  {
														item.find('.slide_container').animate({'left':opt.width+'px'},{duration:transspeed,queue:false});
														newitem.find('.slide_container').animate({'left':'0px','top':'0px','opacity':'1.0'},{duration:transspeed,queue:false});
													//} else {
														//item.find('.slide_container').cssAnimate({'left':opt.width+'px'},{duration:600,queue:false});
														//newitem.find('.slide_container').cssAnimate({'left':'0px','top':'0px','opacity':'1.0'},{duration:600,queue:false});
													//}




												}
										}
							} else {
								//if ( $.browser.msie )
									item.find('.slide_container').stop(true,true);
									item.find('.slide_container').animate({'opacity':'0'},{duration:transspeed,queue:false});
								//else
									//item.find('.slide_container').cssAnimate({'opacity':'0'},{duration:600,queue:false});

								video.animate({'opacity':'0.0'},{duration:transspeed,queue:false});


								//if ( $.browser.msie )
									newitem.find('.slide_container').stop(true,true);
									newitem.find('.slide_container').css({'opacity':'0.0','left':'0px','top':'0px'});
									newitem.find('.slide_container').animate({'opacity':'1.0'},{duration:transspeed,queue:false});
								//else
									//newitem.find('.slide_container').cssAnimate({'opacity':'1.0'},{duration:600,queue:false});
							}




						// SET THE THUMBNAIL
						//console.log("SWAPBANNER : THUMBNAIL MANAGEMENT");

						if (slider_container.find('.kenburn_thumb_container').length>0) {
								var thumb = slider_container.find('.kenburn_thumb_container #thumbmask .thumbsslide #thumb'+newitem.index());

								slider_container.find('.kenburn_thumb_container #thumbmask .thumbsslide #thumb'+item.index()).each(function(i) {
										var $this=$(this);
										if ($this.attr('id')!="thumb"+newitem.index()) {

											$this.removeClass('selected');
											$this.stop();
											$this.find('.overlay').animate({'opacity':0.75},{duration:300,queue:false});
										}
								});

								thumb.addClass('selected');
								thumb.find('.overlay').animate({'opacity':0},{duration:300,queue:false});
								slider_container.data('currentThumb',thumb);
								opt.currentThumb=thumb.index();


								if ((thumb.position().left+opt.thumbWidth) == opt.thumbmaxwidth && thumb.index() != opt.maxitem-1) {

												thumb.parent().find('.kenburn-thumbs').each(function() {
													var thumbs=$(this);
													thumbs.cssAnimate({'left':(thumbs.position().left - opt.thumbWidth)+"px"},{duration:300,queue:false});
												});
											}


								if ((thumb.position().left) == 0 && thumb.index() > 0) {
									thumb.parent().find('.kenburn-thumbs').each(function() {
										var thumbs=$(this);
										thumbs.cssAnimate({'left':(thumbs.position().left + opt.thumbWidth)+"px"},{duration:300,queue:false});
									});
								}

								if (thumb.index()==0) {
									thumb.parent().find('.kenburn-thumbs').each(function() {
										var thumbs=$(this);
										thumbs.cssAnimate({'left':0 + (thumbs.index()*opt.thumbWidth)+"px"},{duration:300,queue:false});
									});
								}
						}

						//console.log("SWAPBANNER : THUMBNAIL MANAGEMENT ENDS");

						if (slider_container.find('.minithumb').length>0) {
							var thumb = slider_container.find('#minithumb'+newitem.index());
							//console.log('SWAPBANNER : CHANGE SELECTED THUMBS');
							slider_container.find('.minithumb').removeClass('selected');
							//console.log('SWAPBANNER : MINITHUMB CLASS SELECTED REMOVED');
							thumb.addClass('selected');
							//console.log('SWAPBANNER : thumb:'+thumb);
							if (opt.thumbStyle!="both") slider_container.data('currentThumb',thumb);
							//console.log('SWAPBANNER : THUMB CLASSIFIZING ENDS');

							opt.currentThumb=thumb.index();

						}


						//SAVE THE LAST SLIDE
						slider_container.data('currentSlide',newitem);

						//console.log('SWAPBANNER : currentSlide Seted');

						// START
						textanim(newitem,100,slider_container);
						opt.cd=0;

						//console.log("SWAPBANNER : SWAPBANNER ENDS");

					}



				//////////////////////////////////////////
				// CHECK IF CANCAS (HTML5) IS SUPPORTED //
				//////////////////////////////////////////
				function isCanvasSupported(){
				  var elem = document.createElement('canvas');
				  return !!(elem.getContext && elem.getContext('2d'));
				}



				////////////////////////////////////
				// AUTOMATIC COUNTDOWN FOR SLIDER //
				////////////////////////////////////
				function startTimer(top,opt) {
					opt.cd=0;

					var ie = !$.support.opacity;
					var ie9 = (document.documentMode == 9);

					if ( ie ||ie9 )
						top.find('.kenburn_thumb_container #thumbmask .thumbsslide').cssAnimate({'left':'0px'},{duration:300,queue:false});
					else
						top.find('.kenburn_thumb_container #thumbmask .thumbsslide').animate({'left':'0px'},{duration:300,queue:false});
					var tmask = top.find('.kenburn_thumb_container #thumbmask');
					var tslide = tmask.find('.thumbsslide');

					var slidemask = top.find('.slide_mainmask');



								var slidemask = top.find('.slide_mainmask');

								opt.timerinterval = setInterval(function() {
											if (opt.loaded==1) {
												var newitem = top.data('currentSlide');
												var thumb = top.data('currentThumb');

												if (!slidemask.hasClass('overme') && !slidemask.hasClass('videoon')) {

																opt.cd=opt.cd+1;
																if (opt.cd==opt.timer) {
																	//console.log("NEXT");
																	opt.cd=0;
																	if (newitem !=undefined) {
																			//console.log("NEWITEM EXIST");
																			if (newitem.index()<opt.maxitem-1) {
																				//console.log("NEWITEM INDEX:"+newitem.index());
																				var next=top.find('ul li:eq('+(newitem.index()+1)+')');
																				//console.log("NEXT ITEM INDEX:"+next.index());
																				swapBanner(newitem,next,top,opt);
																				//console.log("NEXT BANNER CALLED")
																				if (opt.thumbStyle!="none") {
																					var minus = 0-parseInt(thumb.parent().css('left'),0);
																					if (tslide!=null && tslide!=undefined) {
																						tslide.css({'position':'absolute'});
																						if (Math.abs(minus)<=top.data('thumbnailmaxdif')) {

																							if ( ie ||ie9 )
																								tslide.animate({'left':minus+'px'},{duration:300,queue:false});
																							else
																								tslide.cssAnimate({'left':minus+'px'},{duration:300,queue:false});
																						} else {
																							minus = 0-top.data('thumbnailmaxdif');
																							if ( ie||ie9 )
																								tslide.animate({'left':minus+'px'},{duration:300,queue:false});
																							else
																								tslide.cssAnimate({'left':minus+'px'},{duration:300,queue:false});
																						}
																					}
																					//console.log("NEXT-ENDE");
																				}

																			} else {
																				swapBanner(newitem,top.find('ul li:first'),top,opt);
																				if (tslide!=null && tslide!=undefined) {
																					if ( ie ||ie9 )
																						tslide.animate({'left':'0px'},{duration:300,queue:false});
																					else
																						tslide.cssAnimate({'left':'0px'},{duration:300,queue:false});
																				}

																			}
																	}
																}
													}
											}
									},100);



				}




				///////////////////
				// TEXTANIMATION //
				//////////////////
				function textanim (item,edelay,slider_container) {

								var counter=2;

									item.find('.creative_layer div').each(function(i) {

															var $this=$(this);

															// REMEMBER OLD VALUES
															if ($this.data('_top') == undefined) $this.data('_top',$this.position().top);
															if ($this.data('_left') == undefined) $this.data('_left',$this.position().left);
															if ($this.data('_op') == undefined) { $this.data('_op',$this.css('opacity'));}


															// CHANGE THE z-INDEX HERE
															$this.css({'z-index':1200});





																	//console.log('TEXTANIM : ANIMATION FADE UP CHECK');
																	//console.log('TEXTANIM : '+$this.data('_left'));
																	//// -  FADE UP   -   ////
																	if ($this.hasClass('fadeup')) {
																			$this.animate({'top':$this.data('_top')+20+"px",
																							 'opacity':0},
																							{duration:0,queue:false})
																				   .delay(edelay + (counter+1)*350)
																				   .animate({'top':$this.data('_top')+"px",
																							 'opacity':$this.data('_op')},
																							{duration:500,queue:true})
																		counter++;
																	}


																	//// -  FADE RIGHT   -   ////
																	if ($this.hasClass('faderight')) {
																		$this.animate({'left':$this.data('_left')-20+"px",
																					 'opacity':0},
																					{duration:0,queue:false})
																		   .delay(edelay + (counter+1)*350)
																		   .animate({'left':$this.data('_left')+"px",
																					'opacity':$this.data('_op')},
																					{duration:500,queue:true})
																		counter++;
																	}


																	//// -  FADE DOWN  -   ////
																	if ($this.hasClass('fadedown')) {
																			$this.animate({'top':$this.data('_top')-20+"px",
																							 'opacity':0},
																							{duration:0,queue:false})
																				   .delay(edelay + (counter+1)*350)
																				   .animate({'top':$this.data('_top')+"px",
																							 'opacity':$this.data('_op')},
																							{duration:500,queue:true})
																		counter++;
																	}


																	//// -  FADE LEFT   -   ////
																	if ($this.hasClass('fadeleft')) {
																		$this.animate({'left':$this.data('_left')+20+"px",
																					 'opacity':0},
																					{duration:0,queue:false})
																		   .delay(edelay + (counter+1)*350)
																		   .animate({'left':$this.data('_left')+"px",
																					'opacity':$this.data('_op')},
																					{duration:500,queue:true})
																		counter++;
																	}

																	//// -  FADE   -   ////
																	if ($this.hasClass('fade')) {
																		$this.animate({'opacity':0},
																					{duration:0,queue:false})
																		   .delay(edelay + (counter+1)*350)
																		   .animate({'opacity':$this.data('_op')},
																					{duration:500,queue:true})
																		counter++;
																	}




														});	// END OF TEXT ANIMS ON DIVS

				}
})(jQuery);





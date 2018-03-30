var $ = jQuery.noConflict();
$(window).load(function(){

//slider1
var OptionsSlider = {
		autoslides: 1,
		delay:9000,
		change_slide_on_click: 1,
		pause_on_hover: 0,
		pause_on_action: 1
	}
	
	
$(".slider").each(function(){
	var intervalSlider;						   
	var slider = $(this);
	var slides = slider.find("article");
	var slideCount = slides.length;
	var currentSlide = 0;
	slider.append('<ul class="next-prev"><li class="prev"><a href="#">previous</a></li><li class="next"><a href="#">next</a></li></ul>');
	var nextSlide = slider.find(".next a");
	var prevSlide = slider.find(".prev a");
	var sliderNav = slider.find(".next-prev");
	sliderNav.find("li").height(slider.height()).show()
	
	slides.not(slides.eq(currentSlide)).hide();

	var sliderDots = '';
	for(i = 0; i < slideCount; i++) sliderDots += '<li><a href="#">' + i + '</a></li>';
	slider.append('<ul class="slider-pager">' + sliderDots + '</ul>');
	var sliderDots = slider.find(".slider-pager a");
	sliderDots.eq(currentSlide).addClass("selected");
	slider.find('.loader').fadeOut(function(){$('.loader').remove()});

	function setSliderHeight(slider) {
		var h;
		h = slides.eq(currentSlide).height();
		if(slider.parent().hasClass("slider3")) {
			h = slides.eq(currentSlide).height() + 20;
		}
	
		if(slider.parent().hasClass("slider9")) {
			h = slides.eq(currentSlide).height() + 5;
		}
		
		if(slider.parent().hasClass("slider11")) {
			h = slides.eq(currentSlide).height() + 80;
		}
		slider.animate({height: h}, 500);
		sliderNav.find("li").height(h);
	}

	sliderDots.click(function(e){
		clearInterval(intervalSlider)							  
		e.preventDefault();
		var myNum = parseInt($(this).html(), 10);
		if(currentSlide != myNum) {
			slides.eq(currentSlide).stop(true, true).fadeOut();	
			currentSlide = myNum;
			slides.eq(currentSlide).fadeIn();
			sliderDots.removeClass("selected");
			$(this).addClass("selected");
			setSliderHeight(slider);
		}
		
		if(OptionsSlider.pause_on_action==0&&OptionsSlider.pause_on_hover==0){
			startSlider();
		}
	});

	nextSlide.click(function(e){
		clearInterval(intervalSlider);							 
		e.preventDefault();
		slides.eq(currentSlide).stop(true, true).fadeOut();
		if(currentSlide < slideCount - 1) currentSlide++;
		else currentSlide = 0;
		slides.eq(currentSlide).fadeIn();
		sliderDots.removeClass("selected");
		sliderDots.eq(currentSlide).addClass("selected");
		setSliderHeight(slider);
		specialActions();
		if(OptionsSlider.pause_on_action==0&&OptionsSlider.pause_on_hover==0){
			startSlider();
		}
	});
	prevSlide.click(function(e){
		clearInterval(intervalSlider);							 
		e.preventDefault();
		slides.eq(currentSlide).stop(true, true).fadeOut();
		if(currentSlide > 0) currentSlide--;
		else currentSlide = slideCount - 1;
		slides.eq(currentSlide).fadeIn();
		sliderDots.removeClass("selected");
		sliderDots.eq(currentSlide).addClass("selected");
		setSliderHeight(slider);
		specialActions();
		if(OptionsSlider.pause_on_action==0&&OptionsSlider.pause_on_hover==0){
			startSlider();
		}
	});

	//slider with link bar
	$(".slider-titles").each(function(){
									  
		var links = $(this).find("a");
		links.eq(currentSlide).parent().addClass("active");

		links.click(function(e){
			clearInterval(intervalSlider);							 
			e.preventDefault();
			$(".slider-titles").find(".active").removeClass("active");
			$(this).addClass("active");
			slides.eq(currentSlide).fadeOut();
			currentSlide = $(this).parent().prevAll("li").length;
			slides.eq(currentSlide).fadeIn();
			links.eq(currentSlide).parent().addClass("active");			
			setSliderHeight(slider);
			if(OptionsSlider.pause_on_action==0&&OptionsSlider.pause_on_hover==0){
				startSlider();
			}
		});
	});

	slider.swipe({
		swipeLeft: function (event, direction, distance, duration, fingerCount) {
			nextSlide.click();
		},
		swipeRight: function (event, direction, distance, duration, fingerCount) {
			prevSlide.click();
		}
	});

	function specialActions() {
		if (slider.parents('.slider7').length || slider.parents('.slider9').length ) {
			$('.slider-titles li').removeClass('active');
			$('.slider-titles li').eq(currentSlide).addClass('active');
		}
	}

	//responsive sliders
	$(window).bind("resize load", function(){
		var visibleIndex = sliderDots.parent().find(".selected").parent().prevAll("li").length;
		var sliderHeight = $(".slider img").eq(visibleIndex).height();
	
		if(slider.parent().hasClass("slider3") || slider.parent().hasClass("slider4") || slider.parent().hasClass("slider9") || slider.parent().hasClass("slider11") || slider.parent().hasClass("slider12")) {
			sliderHeight = $(".slider article").eq(visibleIndex).height();
		} 
		if(slider.parent().parent().parent().hasClass("slider7")) {
			sliderHeight = $(".slider article").eq(currentSlide).height();
		}
		if(slider.parent().hasClass("slider3")) {
			sliderHeight += 20;
		} else if(slider.parent().hasClass("slider11")){
			sliderHeight += 80;	
		}
		slider.height(sliderHeight);	
		sliderNav.find("li").height(sliderHeight);
		sliderNav.css('opacity', 1);
	});
	
	function int(){
		var visibleIndex = sliderDots.parent().find(".selected").parent().prevAll("li").length;
		var sliderHeight = $(".slider img").eq(visibleIndex).height();
	
		if(slider.parent().hasClass("slider3") || slider.parent().hasClass("slider4") || slider.parent().hasClass("slider9") || slider.parent().hasClass("slider11") || slider.parent().hasClass("slider12")) {
			sliderHeight = $(".slider article").eq(visibleIndex).height();
		} 
		if(slider.parent().parent().parent().hasClass("slider7")) {
			sliderHeight = $(".slider article").eq(currentSlide).height();
		}
		if(slider.parent().hasClass("slider3")) {
			sliderHeight += 20;
		} else if(slider.parent().hasClass("slider11")){
			sliderHeight += 80;	
		}
		slider.height(sliderHeight);	
		sliderNav.find("li").height(sliderHeight);
		sliderNav.css('opacity', 1);	
	}
	int();

	if(OptionsSlider.change_slide_on_click==0){
			slides.click(function(){
				if(OptionsSlider.pause_on_action==1){
					clearInterval(intervalSlider);
				}								  
				startOneSlider();
				
				return false;
			})
					
			slides.find("a").click(function(e){
				 e.stopPropagation();											
			})
	}
	if(OptionsSlider.pause_on_hover==1){
			slides.hover(function(){
				clearInterval(intervalSlider);
			})			
		}
	if(OptionsSlider.autoslides==1){
		startSlider();
	}
	 function startSlider()
	  {
			intervalSlider = setInterval(function(){					  
				slides.eq(currentSlide).stop(true, true).fadeOut();
				if(currentSlide < slideCount - 1) currentSlide++;
				else {
						clearInterval(intervalSlider);
						startSlider();
						currentSlide = 0
						
				}
				slides.eq(currentSlide).fadeIn();
				slider.parent().find(".slider-titles li").removeClass("active");
				slider.parent().find(".slider-titles li").eq(currentSlide).addClass("active");
				sliderDots.removeClass("selected");
				sliderDots.eq(currentSlide).addClass("selected");
				setSliderHeight(slider);
				
			},OptionsSlider.delay)
	  }
	   function startOneSlider()
	  {

				slides.eq(currentSlide).stop(true, true).fadeOut();
				if(currentSlide < slideCount - 1) currentSlide++;
				else {						
						currentSlide = 0
						
				}
				
				slides.eq(currentSlide).fadeIn();
				slider.parent().find(".slider-titles li").removeClass("active");
				slider.parent().find(".slider-titles li").eq(currentSlide).addClass("active");
				sliderDots.removeClass("selected");
				sliderDots.eq(currentSlide).addClass("selected");
				setSliderHeight(slider);
			
	  }

});
	
//slider 6

$(".slider6").each(function(){
	var slider = $(this);							
	var showcase = $(this);
	var list = showcase.find(".menu ul");
	var items = list.find("a");
	var slides = showcase.find("article");
	var slideBox = showcase.find(".slides");
	var slideCount = slides.length;
	
	var itemH = 102;
	var currentSlide = 0;
	list.find("li").each(function(index){
		$(this).attr("data-id",index)
	})
	list.carouFredSel({
		direction: 'up',
		height: '100%',
		width: 'variable',
		onWindowResize: 'debounce',
		items: {
			visible: 3
		},
		scroll: {
			items: 1     
		},
		auto: {
			play: false
		},
		prev: {
			button: '.slider6 .menu .prev'
		},
		next: {
			button: '.slider6 .menu .next'
		},
		swipe: {
			onTouch: true,
			onMouse: true
		}
	});
	list.trigger("updateSizes");
	slider.find('.loader').fadeOut(function() {$('.loader').remove();})

	items.click(function(e){
		clearInterval(intervalSlider);							 												 
		e.preventDefault();
		var index = $(this).parent().data("id");
		slides.eq(currentSlide).fadeOut();
		currentSlide = index;
		slides.eq(currentSlide).fadeIn(function(){
			var h;
			h = slides.eq(currentSlide).height();
			slideBox.animate({height: h}, 500);
		});
		slider.find(".menu li").removeClass("active");
		slider.find(".menu li").each(function(){
			if($(this).data("id")==currentSlide){$(this).addClass("active")}
		})
							
		if(OptionsSlider.pause_on_action==0&&OptionsSlider.pause_on_hover==0){
			startSlider();
		}		
	});

	$('.slider6').swipe({
		swipe: function (event, direction, distance, duration, fingerCount) {
			slides.eq(currentSlide).fadeOut();
			if (direction == 'left') {
				$('.slider6 .menu .next').click();
				if (currentSlide < slideCount - 1) currentSlide ++;
				else currentSlide = 0;
			} else if (direction == 'right') {
				$('.slider6 .menu .prev').click();
				if (currentSlide > 0) currentSlide --;
				else currentSlide = slideCount - 1;
			}
			slides.eq(currentSlide).fadeIn(function(){
				var h;
				h = slides.eq(currentSlide).height();
				slideBox.animate({height: h}, 500);
			});
			slider.find(".menu li").removeClass("active");
			slider.find(".menu li").each(function(){
				if($(this).data("id")==currentSlide){$(this).addClass("active")}
			})
		}
	})
	
	if(OptionsSlider.change_slide_on_click==0){
			slides.click(function(){
				if(OptionsSlider.pause_on_action==1){
					clearInterval(intervalSlider);
				}								  
				startOneSlider();
				
				return false;
			})
					
			slides.find("a").click(function(e){
				 e.stopPropagation();											
			})
	}
	if(OptionsSlider.pause_on_hover==1){
			slides.hover(function(){
				clearInterval(intervalSlider);
			})			
		}
	if(OptionsSlider.autoslides==1){
		startSlider();
	}
	 function startSlider()
	  {
			intervalSlider = setInterval(function(){					  
				slides.eq(currentSlide).stop(true, true).fadeOut();
				if(currentSlide < slideCount - 1) currentSlide++;
				else {						
						currentSlide = 0
						
				}
				list.trigger("slideTo",currentSlide)
				slides.eq(currentSlide).fadeIn();
				slider.find(".menu li").removeClass("active");
				slider.find(".menu li").each(function(){
					if($(this).data("id")==currentSlide){$(this).addClass("active")}
				})
				
			},OptionsSlider.delay)
	  }
	   function startOneSlider()
	  {

				slides.eq(currentSlide).stop(true, true).fadeOut();
				if(currentSlide < slideCount - 1) currentSlide++;
				else {						
						currentSlide = 0
						
				}
				list.trigger("slideTo",currentSlide)
				slides.eq(currentSlide).fadeIn();
				slider.find(".menu li").removeClass("active");
				slider.find(".menu li").each(function(){
					if($(this).data("id")==currentSlide){$(this).addClass("active")}
				})
	
	  }

	$(window).bind("load resize", function(){
		var diff = 190;
		if($("body").width() <= 600) {
			diff = 90;	
		}

		var width = showcase.children("div").width() - diff;
		slideBox.width(width);
		if(slideBox.find("img")){
			var height = slideBox.find("article").eq(currentSlide).find("img").height();	
		} else {
			var height = slideBox.find("article").eq(currentSlide).find(".video").height();
		}
		slideBox.height(height);
		var listHeight = height - 40;
		$(".slider6 .menu>div").height(listHeight);		
	});
	
	function int(){
			var diff = 190;
			if($("body").width() <= 600) {
				diff = 90;	
			}
	
			var width = showcase.children("div").width() - diff;
			slideBox.width(width);
			if(slideBox.find("img")){
				var height = slideBox.find("article").eq(currentSlide).find("img").height();	
			} else {
				var height = slideBox.find("article").eq(currentSlide).find(".video").height();
			}
			slideBox.height(height);
			var listHeight = height - 40;
			$(".slider6 .menu>div").height(listHeight);		
	}
	int()
	$(window).resize(function(){
		list.trigger("destroy",true);
		list.carouFredSel({
			direction: 'up',
			height: '100%',
			width: 'variable',
			onWindowResize: 'debounce',
			items: {
				visible: 3
			},
			scroll: {
				items: 1     
			},
			auto: {
				play: false
			},
			prev: {
				button: '.slider6 .menu .prev'
			},
			next: {
				button: '.slider6 .menu .next'
			},
			swipe: {
				onTouch: true
			}
		});
	})
});


// slider 10 - with custom scrollbar
	$(".slider10").each(function() {
		var slider = $(this);
		var itemList = slider.find("ul");
		var prevSlide = slider.find("a.prev");
		var nextSlide = slider.find("a.next");
		var pos = 0;
		var itemW = 320;
		var itemCount = itemList.find("li").length;
		slider.find('.loader').fadeOut(function(){$('.loader').remove()});
	
		itemList.mCustomScrollbar({
			horizontalScroll: true,
			mouseWheel: true,
			autoHideScrollbar: false,
			contentTouchScroll: true,
			scrollButtons: {
			  enable: false
			},
			advanced:{
				updateOnContentResize: true,
				updateOnBrowserResize: true
			}
		});

		nextSlide.click(function(e){
			clearInterval(intervalSlider);							 
			e.preventDefault();
			if(pos < itemCount) {
				var offset;
				pos++;
				offset = itemW * pos;
				itemList.mCustomScrollbar("scrollTo", offset);
				if(pos+2>=itemCount){
						pos=itemCount-3;						
					}
			}
			if(OptionsSlider.pause_on_action==0&&OptionsSlider.pause_on_hover==0){
				startSlider();
			}
		});

		prevSlide.click(function(e){
			clearInterval(intervalSlider);							 
			e.preventDefault();
			if(pos > 0) {
				var offset;
				pos--;
				offset = itemW * pos;
				itemList.mCustomScrollbar("scrollTo", offset);
				if(pos-2>=itemCount){
						pos=0;
						offset = itemW * pos;
						itemList.mCustomScrollbar("scrollTo", offset);
					}
			}			
			
			if(OptionsSlider.pause_on_action==0&&OptionsSlider.pause_on_hover==0){
				startSlider();
			}
		});

		slider.swipe({
			swipeLeft: function (event, direction, distance, duration, fingerCount) {
				nextSlide.click();
			},
			swipeRight: function (event, direction, distance, duration, fingerCount) {
				prevSlide.click();
			}
		});
		
		if(OptionsSlider.pause_on_action==1){
					slider.find(".mCSB_scrollTools").click(function(){
						clearInterval(intervalSlider);
				
					})	
					slider.find(".mCSB_dragger").hover(function(){
						interval= setInterval(function(){
							if($(this).hasClass("mCSB_dragger_onDrag")){
								clearInterval(intervalSlider);
								clearInterval(interval);
								pos=0;
							}
						},100)	
					})
				}	
			
		if(OptionsSlider.change_slide_on_click==0){
				slider.find(".mCSB_container").click(function(){
					if(OptionsSlider.pause_on_action==1){
						clearInterval(intervalSlider);
					}								  
					startOneSlider();
					
					return false;
				})
						
				slider.find("a").click(function(e){
					 e.stopPropagation();											
				})
		}
		if(OptionsSlider.pause_on_hover==1){
				slider.find(".mCSB_container").hover(function(){
					clearInterval(intervalSlider);
				})			
			}
		if(OptionsSlider.autoslides==1){
			startSlider();
		}
		 function startSlider()
		  {
				intervalSlider = setInterval(function(){					  
					if(pos < itemCount) {
						var offset;
						pos++;
						offset = itemW * pos;
						itemList.mCustomScrollbar("scrollTo", offset);
						if(pos+2>=itemCount){
							pos=0;
							offset = itemW * pos;
							itemList.mCustomScrollbar("scrollTo", offset);
						}
					}
					
				},OptionsSlider.delay)
		  }
		   function startOneSlider()
		  {
				if(pos < itemCount) {
						var offset;
						pos++;
						offset = itemW * pos;
						itemList.mCustomScrollbar("scrollTo", offset);
						if(pos+2>=itemCount){
							pos=0;
							offset = itemW * pos;
							itemList.mCustomScrollbar("scrollTo", offset);
						}
					}
		  }
		var w = Math.round((slider.find("ul").width() - 40) / 3);
			slider.find("img").width(w);			
			slider.height(w + 30);
			var W =0;
			slider.find("li").each(function(){
				W+=$(this).width()+18;
			});
			$(".mCSB_container").width(W);
		$(window).resize(function() {
			var w = Math.round((slider.find("ul").width() - 40) / 3);
			slider.find("img").width(w);
			slider.height(w + 30);
			var W = 0;
			slider.find("li").each(function(){
				W += $(this).width() + 18;
			});
			$(".mCSB_container").width(W);
		});
		
	});

});
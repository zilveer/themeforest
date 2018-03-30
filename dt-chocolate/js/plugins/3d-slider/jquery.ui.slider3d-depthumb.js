// JavaScript Document
(function($) {
	

	$.widget("ui.slider3d", {
		 options: { 
		 },
		
		_init: function() {  
			$this = this;
			size = slides3D.length;
			images = [];
			cam = {x:0, y:0, z:-1650, c:0, fov: 500};
			if (size > 12) {
				FillPerImg = 2;
			} else {  
				FillPerImg = 3;
			};
			
			if ($.browser.SafariMobile) {
				FillPerImg = 0;
			}
			newWidth = 0;
			newHeight = 0;
			timer1 = 0;
			enable_click = 1;
			
			if ($('#screen').length == 0) { 
				//create a slider container
				$('<div id="screen"><div id="command"><div id="bar"></div><img id="thumbnail" /></div><h2 class="inf"></h2><a id="UrlInfo" class="inf"></a><p id="caption" class="inf"></p></div><div id="pseudo" style="visibility:hidden"></div>').appendTo('#superslides');
				$('#command h1').text($this.element.attr("title"));
				
				//get images
				/*$("a", $this.element).each(function() {
					var pseudo_img = $('<img>').attr({"src":$(this).attr("data-image"),"URL":$(this).attr("href"),"title":$(this).text(),"alt":$(this).attr("data-desc"),"thumb":$(this).attr("data-thumb")});
					pseudo_img.appendTo("#pseudo"); 
					images.push(pseudo_img);
				});*/
				
				jQuery.each(slides3D, function(index, value) {
					//console.log(this)
					var pseudo_img = $('<img>').attr({
						"src"	: this.image,
						"thumb"	: this.thumb,
						/*"alt"	: this.title,
						"title"	: "",*/
						"URL"	: this.url
					}).data({"alt"	: this.title});
					pseudo_img.appendTo("#pseudo"); 
					images.push(pseudo_img);
					
					//console.log(this.thumb)
				});
			}
			
			jQuery.each(images, function(index, value) {
				//create buttons	
				 var button = $('<div class="button"></div>').css({
						  /*"left":Math.round(($('.button').width()*1.2)*(index % 3)),
						  "top":Math.round(($('.button').height()*1.2)*Math.floor(index / 4))*/
				}).appendTo($('#bar'));
				//create canvas if possible, create images if not
				if ($('<canvas></canvas>')[0].getContext) {
					var pics = $('<canvas class="photo picture"></canvas>');
				} else {
					var pics = $('<img class="photo picture">').attr("src",$(this).attr("src"));
				}
					
				//manipulate an image only if it is loaded					
				$this._imageLoaded($(this), function(){ 
					$this._resize(); 
					button.addClass("loaded");
					W=$(this)[0].width;
					H=$(this)[0].height;
					pics[0].width=W;
					pics[0].height=H;
		
					//add images (canvas or img)
					if (pics[0].tagName == 'CANVAS'){
						var context = pics[0].getContext("2d");
						context.drawImage($(this)[0],0,0,W,H);
					}
					pics.attr({/*"alt":$(this).attr("alt"),"title":$(this).attr("title"),*/"URL":$(this).attr("URL")}).data({"W":W,"H":H,"ZI":25000,"thumb":$(this).attr("thumb")}).data({"alt"	: $(this).data("alt")}).appendTo($('#screen')); //H,W and ZI will be required for further 3D animation
					//add fillers

					//console.log($(this).data("alt"));

					var fill_count = FillPerImg;
					while (fill_count>0) {
						var filler = $('<div class="filler picture"></div>').data({"H":300,"W":300,"ZI":15000});
						pics.after(filler);
						fill_count --;
					}
					
					//X,Y,Z calculation 
					$this._coordinates(pics,index,FillPerImg);
				});
			});
		}, 
		
		// Image Loaded - the jQuery plugin, that checks if the image is loaded
		_imageLoaded: function(el, callback ){ 
			var $_this = el[0];
			var timer  = setInterval(function(){ 
				if($_this.complete == true) {
					clearInterval(timer);
					callback.call($_this);
				}
			},200);
		return $_this;
		},
		
		//Focus on the target image
		_Focus: function (arg1, arg2, arg3) {
			// Prevent layers overlaping
			if (Math.abs(arg2 - arg1) > .1) {
				cam.c = 1;
				cam.par = 0;
				cam.diff = arg2 - arg1;
				if (arg3) {
					cam.diff *= 2;
					cam.par = 9;
				}
			}
		},
		
		_Focus2: function (v) {
			if (cam.c != 0) {
				cam.par += cam.c;
				cam[v] += cam.diff * cam.par * .01;
				if (cam.par == 10) cam.c = -1;
				else if (cam.par == 0) cam.c = 0;
			}
			return cam.c; 
		},
				
		_resize: function() {
			newWidth = 0.5*$(window).width();
			newHeight = 0.5*$('#screen').height();	
		},
		
		//initial image coordiantes (random) 
		_coordinates:  function(el, numb, fi) {
			var fj = 0; 
			// for the image 
			el.data({"X":700*((numb%4)*0.9*numb - 1.5)*(Math.random()-0.5)*2,
						"Y":Math.round(Math.random()*3500)-2000,
						"Z":numb*(5000/size)});
			
			//for fillers which refer to this image
			while (fj<fi)	 {
				$(".filler:eq("+(fj+numb*fi)+")")
					.data({"X": el.data("X")+$('.filler').width()*(0.5*fi-fj)*(Math.random()-0.5),
						"Y":Math.round(Math.random()*4000)-2000,
						"Z":numb*(5000/size)
				});	
				fj++;
			}
				
			//if all coordinates are calculated	
			if (numb==images.length-1 && fj==fi) {
				$this._Animation(); //Let it start!!!
				$(window).resize(function() {$this._Animation();});
				$('.photo').css("visibility","visible");
				$("#pseudo").remove();
				$('.photo').on("click", function() { 
					$this._goto($(this));
				});	
				$('.button').on("click", function() { 
					$this._goto($(this));
				});	
				$('.button').mouseenter(function() {
					$this._thumbON($(this),$(this).index('.button'));
				});
				$('.button').mouseleave(function() {
					$this._thumbOFF($(this),$(this).index('.button'));
				});
				
				$("#loading").css("display", "none");
			}		
		},
		
		_goto:  function(el) {
			if (enable_click==1) { 
					var which_one=el.index('.photo')+el.index('.button')+1;
					if (!$(".photo:eq("+which_one+")").hasClass("selected")) {
						$(".inf").css("display","none");
					};
					$('.selected').addClass("viewed").removeClass("selected");
					$(".button:eq("+which_one+")").removeClass("viewed").addClass("selected");
					$(".photo:eq("+which_one+")").removeClass("viewed").addClass("selected");
					
					enable_click=0;
				if (cam.c) return;	
					cam.tz = $(".photo:eq("+which_one+")").data("Z") - cam.fov;
					cam.tx = $(".photo:eq("+which_one+")").data("X");
					cam.ty = $(".photo:eq("+which_one+")").data("Y");	
					$this._Navigate();
			}
		},	
		
		_thumbON: function(el,ind) {
			if (!$.browser.SafariMobile) {
				var top = el.position()/*+4+$("#thumbnail").height()*/;
				//el.addClass("selected");
				var theThumb = $("#thumbnail").css({
					"top"	: top.top + 17,
					"left"	: top.left - 92,
					"display": "none"
				}).addClass("hovered").attr("src","").attr("src",$(".photo:eq("+ind+")").data("thumb")).stop(true, true);
				$this._imageLoaded(theThumb, function(){
					if  (theThumb.hasClass("hovered")) {
						theThumb.fadeIn(400);
					}
				});
			}
		},
		
		_thumbOFF: function(el, ind) {
			if (!$.browser.SafariMobile) {
				$("#thumbnail").removeClass("hovered").css("display","none");
				if (!$(".photo:eq("+ind+")").hasClass("selected")) {
					el.removeClass("selected").addClass("loaded");
				}
			}
		},
		
		_Navigate: function() { 
			//walk along X axis
			if (cam.tx) {
				if (!cam.c) $this._Focus(cam.x, cam.tx); 
				var m = $this._Focus2('x'); 
				if (!m) cam.tx = 0;
			
			//walk along Y axis
			} else if (cam.ty) {
			  if (!cam.c) $this._Focus(cam.y, cam.ty); 
			  var m = $this._Focus2('y'); 
			  if (!m) cam.ty = 0;
			
			//walk along Z axis
			} else if (cam.tz) { 
			  if (!cam.c) $this._Focus(cam.z, cam.tz); 
			  var m = $this._Focus2('z');
			  if (!m) {
			//stop walking
				cam.tz = 0; 
				clearTimeout(timer1);
				enable_click=1; //enable click
				
				//disaplay image info
				var act = $(".photo.selected");
				$(".inf").fadeIn(400);
				$this._info(act);
			  }
			} 
		
			//animate new position
			$this._Animation();	
			
			timer1 = setTimeout($this._Navigate, 42);
		},
		
		_info: function(el) {
			$("#screen h2").text(el.attr("title"));
			$("#UrlInfo").text(el.attr("URL")).attr("href",el.attr("URL"));
			$("#caption").html(el.data("alt"));
		},
		
		_infoAnim: function(el,h2h,h2w,urlh,urlw,capw) {
			var el_top = parseInt(el.css("top"));
			$("#screen h2").css({"top":el_top-h2h-5, "left": newWidth-0.5*h2w});
			$("#UrlInfo").css({"top":el_top+el.outerHeight()-urlh-5, "left": newWidth-0.5*urlw});
			$("#caption").css({"top":el_top+el.outerHeight()+5, "left": newWidth-0.5*capw});
		},
		
		_Animation: function() {
			$this._resize();
			var h_w=[];
			$(".inf").each(function() {
				h_w.push($(this).outerHeight());
				h_w.push($(this).outerWidth());
			});	
			$('.picture').each(function() {
				x = $(this).data("X")-cam.x;
				y = $(this).data("Y")-cam.y;
				z = $(this).data("Z")-cam.z; 
				if (z < 20) { 
					z += 5000;
				}
				var p = cam.fov/z;
				var w = $(this).data("W")*p; 
				var h = $(this).data("H")*p; 
				var zi = $(this).data("ZI")- Math.round(z);
		
				$(this).css({"top":Math.round(newHeight+y*p-0.5*h),
							"left":Math.round(newWidth+x*p-0.5*w),
							"width":Math.round(w),
							"height":Math.round(h),
							"z-index":zi
				});
				if ($(this).hasClass("selected")) {
					$this._infoAnim($(this),h_w[0],h_w[1],h_w[2],h_w[3],h_w[5]);
				}
			});
		},	
		
		/*_setOption: function(option, value) {  
    		$.Widget.prototype._setOption.apply( this, arguments );  
		},*/
		
		destroy: function() {	
			if (enable_click==1) {
				clearTimeout(timer1);
				$('.photo').off("click");
				$('.button').off("click");			
				$('body #screen').remove();
			}
		},
	});
})(jQuery);           
 
jQuery(function($){
	$("#superslides").slider3d();
		if(ResizeTurnOff){
			
		}else{
			function hideHeader() {
				if ($(window).width() < 740) {
					$("#superslides").addClass("no-controls");
					$("#header-mobile").stop().transition({
						"y" : -$("#header-mobile").outerHeight()
					}, 700);
				}
			}
			
			function showHeader() {
				if ($(window).width() < 740) {
					$("#superslides").removeClass("no-controls");
					$("#header-mobile").stop().transition({
						"y" : 0
					}, 700);
				}
			}
			
			$(document).on('touchmove', function(e) { if ($(window).width() < 1000) e.preventDefault(); });
			
			if ($.browser.SafariMobile){

				$(window).on("orientationchange",  function() {
				
					if(window.orientation == 90 || window.orientation == -90) {
						$("html, body, #superslides").css({
							"min-height" : "270px"
						});
					} else {
						$("html, body, #superslides").css({
							"min-height" : "420px"
						});
					}
					
					if ($("#superslides").hasClass("no-controls")){
						$("#header-mobile").stop().transition({
							"y" : -$("#header-mobile").outerHeight()
						}, 0);
					} 
				
					setTimeout(scrollTo, 0, 0, 1);
					$(window).trigger("resize");
				
				}).trigger("orientationchange");
	
				setInterval( function() {$(window).trigger("orientationchange");}, 3000);

			}

			$(document).wipetouch({
				preventDefault: false,
				wipeUp: function(result) {
					hideHeader();
				},
				wipeDown: function(result) { 
					showHeader();
				}
			});
			
			$("#superslides").on("click", function(){
				if ($.browser.SafariMobile){
					hideHeader();
				}
			});
		}
});
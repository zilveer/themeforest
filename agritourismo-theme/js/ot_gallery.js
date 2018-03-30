/* -------------------------------------------------------------------------*
 * 									GALLERY	
 * -------------------------------------------------------------------------*/
	

	jQuery(document).ready(function($){	
		var adminUrl = ot.adminUrl;
		var gallery_id = ot.gallery_id;

		OT_gallery.a_click(adminUrl, gallery_id);

		//image resize
		jQuery(".ot-gallery-image").css("max-height", jQuery(window).height()+"px");
	});

	//image resize by resizing window
	jQuery(window).resize(function() {
	  	jQuery(".ot-gallery-image").css("max-height", jQuery(window).height()+"px");
	});	

	//key navigation
	jQuery(document).keydown(function(e){
		var adminUrl = ot.adminUrl;
		if (e.keyCode == 39) { 
			OT_gallery.Loading(jQuery('.ot-slide-item .next'),adminUrl,false);
			OT_gallery.NextImage(jQuery('.ot-slide-item .next'));
			OT_gallery.Thumbs(jQuery('.ot-slide-item .next'));
		   return false;
		}
		if (e.keyCode == 37) { 
			OT_gallery.Loading(jQuery('.ot-slide-item .prev'),adminUrl,false);
			OT_gallery.PrevImage(jQuery('.ot-slide-item .prev'));
			OT_gallery.Thumbs(jQuery('.ot-slide-item .prev'));
		   return false;
		}
	});

	var OT_gallery = {

		//the main image location
		main_image :  function (element) {
			if(element) {
				return element.closest('.ot-slide-item').find(".ot-gallery-image"); 
			} else {
				return jQuery(".ot-gallery-image"); 
			}
		 
		 },

		//next button location
		next_button :  function (element) {
		 	return element.closest('.ot-slide-item').find(".next"); 
		 },

		//previous button location
		prev_button :  function (element) {
		 	return element.closest('.ot-slide-item').find(".prev"); 
		 },

		//next image number
		next_image :  function (element) {
		 	return element.closest('.ot-slide-item').find(".next-image"); 
		 },

		//the opened image number
		opened_image :  function (element) {
		 	return OT_gallery.main_image(element).attr("data-id"); 
		 },

		//the active thumbnail
		active_thumb :  function (element) {
		 	return jQuery(".the-thumbs a"); 
		 },

		//total image count
		total_img :  function (element) {
		 	return jQuery(".the-thumbs > a").size(); 
		 },

		//lightbox
		a_click : function (adminUrl, gallery_id) {
			OT_gallery.swipe(100);
			
			//if images loaded
			if(OT_gallery.main_image().attr("src")=="") {
				OT_gallery.main_image().load(function(){
					OT_gallery.main_image().fadeIn('slow');
					//gallery
					jQuery(".waiter").removeClass("loading").addClass("loaded");
				});
			} else {
				OT_gallery.main_image().fadeIn('slow');
				//gallery
				jQuery(".waiter").removeClass("loading").addClass("loaded");
			}

		
			//set active thumbnail by page load in lightbox
			jQuery.each(OT_gallery.active_thumb(), function() {
				jQuery(this).removeClass("active");
				if(jQuery(this).attr("data-nr") == OT_gallery.opened_image(jQuery(this))) {
					jQuery(this).addClass("active");
				}

			});
			
			//show the loading after click
			jQuery('.next, .prev, .gal-thumbs').click(function() {	
				OT_gallery.Loading(jQuery(this),adminUrl,false);
			});

			//load the next image
			jQuery('.next').click(function() {
				OT_gallery.NextImage(jQuery(this));
			});	
			
			//load the previous image
			jQuery('.prev').click(function() {
				OT_gallery.PrevImage(jQuery(this));
			});

			//load the clicked thumbnail
			jQuery('.gal-thumbs').click(function() {
				var next = jQuery(this).attr("rel");
				
				if(jQuery(this).attr("rel")!=OT_gallery.total_img()) { 
					OT_gallery.next_button(jQuery(this)).attr("rel", parseInt(next)+1); 
					OT_gallery.prev_button(jQuery(this)).attr("rel", parseInt(next)-1); 
					OT_gallery.next_image(jQuery(this)).attr("data-next", parseInt(next)+1); 
					OT_gallery.main_image(jQuery(this)).attr("data-id", parseInt(next)); 
				} else {
					OT_gallery.next_button(jQuery(this)).attr("rel",OT_gallery.total_img()); 
					OT_gallery.prev_button(jQuery(this)).attr("rel", parseInt(OT_gallery.total_img())-1); 
					OT_gallery.next_image(jQuery(this)).attr("data-next", OT_gallery.total_img()); 
					OT_gallery.main_image(jQuery(this)).attr("data-id", parseInt(next)); 

				}
				if(jQuery(this).attr("rel")==1) { 
					OT_gallery.prev_button(jQuery(this)).attr("rel", 0); 
					OT_gallery.main_image(jQuery(this)).attr("data-id", parseInt(next)); 
				}

			});
			
			//set active image after click for the next image
			jQuery('.next, .prev, .gal-thumbs').click(function() {	
				OT_gallery.Thumbs(jQuery(this));
			});
			

		},
				
		NextImage : function (clicked) {
			OT_lightbox_slider(clicked,"right");

			if(parseInt(OT_gallery.total_img()) > OT_gallery.opened_image(clicked)) {
				OT_gallery.main_image(clicked).attr("data-id", parseInt(OT_gallery.opened_image(clicked))+1);
				OT_gallery.prev_button(clicked).attr("rel", parseInt(OT_gallery.prev_button(clicked).attr("rel"))+1);
			}	
				
			if(parseInt(OT_gallery.total_img()) > parseInt(clicked.attr("rel"))) {
				clicked.attr("rel", parseInt(clicked.attr("rel"))+1);
				OT_gallery.next_image(clicked).attr("data-next", parseInt(clicked.attr("rel"))); 
			}
		},	
				
		PrevImage : function (clicked) {
			OT_lightbox_slider(clicked,"left");
			
			if(parseInt(OT_gallery.opened_image(clicked)) > 1 && parseInt(OT_gallery.opened_image(clicked)) != jQuery(".next").attr("rel")) {
				OT_gallery.next_button(clicked).attr("rel", parseInt(OT_gallery.next_button(clicked).attr("rel"))-1);
				OT_gallery.next_image(clicked).attr("data-next", parseInt(OT_gallery.next_button(clicked).attr("rel"))); 
			}
			if(parseInt(OT_gallery.opened_image(clicked)) > 1) {
				clicked.attr("rel", parseInt(clicked.attr("rel"))-1);
				OT_gallery.main_image(clicked).attr("data-id", parseInt(OT_gallery.opened_image(clicked))-1);
			}
		},	
				
		Loading : function (clicked,adminUrl,swipe) {
			var ID = clicked.closest('.ot-slide-item').attr("id");
			var clicked = clicked;
			var next = clicked.attr("rel");
			var waiter = clicked.closest('.ot-slide-item').find('.waiter');
			var image = OT_gallery.main_image(clicked);
				
			if( (parseInt(OT_gallery.opened_image(clicked)) < parseInt(OT_gallery.total_img()) || next!=parseInt(OT_gallery.total_img())) && next!=0 && next!=OT_gallery.opened_image(clicked)) {
				
				waiter.removeClass("loaded");
				waiter.addClass("loading");
					
				jQuery.ajax({
					url:adminUrl,
					type:"POST",
					data:"action=load_next_image&gallery_id="+ID+"&next_image="+next,
					success:function(results) {
						image.attr("src", results);
						//image resize
						image.css("max-height", jQuery(window).height()+"px");
						image.load(function(){
							setTimeout(function () {
							    waiter.removeClass("loading");
							   	waiter.addClass("loaded");
							}, 800);
							
						
						});
					}
				});
				
			}
		},			
				
		Thumbs : function (clicked) {

			jQuery.each(OT_gallery.active_thumb(), function() {
				jQuery(this).removeClass("active");
				if(jQuery(this).attr("data-nr") == OT_gallery.opened_image(clicked)) {
					jQuery(this).addClass("active");
				}

			});


		},
				

				
		// swipe navigation
		swipe : function (xx) {

					(function(jQuery, undefined) {
						
							var adminUrl = ot.adminUrl;
							var wrap = jQuery('.waiter'),
								slides = wrap.find('.image-big-gallery'),

								width = wrap.width();

							// Listen for swipe events on slides, and use a custom 'activate'
							// or next slide, and to keep the index up-to-date. The class
							slides

							.on('swipeleft', function(e) {
								OT_gallery.Loading(jQuery('.ot-slide-item .next'),adminUrl,true);
								OT_gallery.NextImage(jQuery('.ot-slide-item .next'));
								OT_gallery.Thumbs(jQuery('.ot-slide-item .next'));
							})

							.on('swiperight', function(e) {
								OT_gallery.Loading(jQuery('.ot-slide-item .prev'),adminUrl,true);
								OT_gallery.PrevImage(jQuery('.ot-slide-item .prev'));
								OT_gallery.Thumbs(jQuery('.ot-slide-item .prev'));
							})

			

							// The code below handles what happens before any swipe event is triggered.
							// It makes the slides demo on this page work nicely, but really doesn't
							// have much to do with demonstrating the swipe events themselves. For more
							// on move events see:
							//
							// http://stephband.info/jquery.event.move

							.on('movestart', function(e) {
								// If the movestart heads off in a upwards or downwards
								// direction, prevent it so that the browser scrolls normally.
								if ((e.distX > e.distY && e.distX < -e.distY) ||
									(e.distX < e.distY && e.distX > -e.distY)) {
									e.preventDefault();
									return;
								}

								// To allow the slide to keep step with the finger,
								// temporarily disable transitions.
								wrap.addClass('notransition');
							})

							.on('move', function(e) {
								var left = xx * e.distX / width;

								// Move slides with the finger
								if (e.distX < 0) {
									if (slides) {
										slides.css("left", left + '%');
										slides.css("left", (left+0)+'%');
									}
									else {
										slides.css("left", left/4 + '%');
									}
								}
								if (e.distX > 0) {
									if (slides) {
										slides.css("left", left + '%');
										slides.css("left", (left-0)+'%');
									}
									else {
										slides.css("left", left/5 + '%');
									}
								}
							})

							.on('moveend', function(e) {
								wrap.removeClass('notransition');
								
								slides.css("left", '');
								
								if (slides) {
									slides.css("left", '');
								}
								if (slides) {
									slides.css("left", '');
								}
							});

						
					})(jQuery);	
				
				}
	}
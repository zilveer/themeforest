/* #Images Styling & Hovers
================================================== */
// jQuery(document).ready(function($) {

	/* !Append tag </i> to rolovers*/
	$.fn.addRollover = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			$this.append("<i></i>");
			if($this.find(".rollover-thumbnails").length){
				$this.addClass("rollover-thumbnails-on");
			}
			if($this.parent().find(".links-container").length){
				$this.addClass("rollover-buttons-on");
			}

			$this.addClass("this-ready");
		});
	};
	$(".rollover, .rollover-video, .post-rollover, .rollover-project .show-content, .vc-item .vc-inner > a").addRollover();

	/* !- Grayscale */
	$(".filter-grayscale .slider-masonry").on("mouseenter tap", function(e) {
		if(e.type == "tap") {
			e.stopPropagation();
		};
		$(this).addClass("dt-hovered");
	});

	$(".filter-grayscale .slider-masonry").on("mouseleave", function(e) {
		$(this).removeClass("dt-hovered");
	});


	/* #Hover layouts
	================================================== */

	/*!-Scale in hover*/
	$.fn.scaleInHover = function() {
		return this.each(function() {

			var $this = $(this);
			if ($this.hasClass("scale-ready")) {
				return;
			}
			var $img = $this.find("img.preload-me"),
				imgWidth = parseInt($img.attr('width')),
				imgHeight = parseInt($img.attr('height')),
				imgRatio = imgWidth/imgHeight;
			if(imgRatio < 2 && imgRatio >= 1.5){
				$this.addClass("ratio_3-2");
			}else if(imgRatio < 1.5 && imgRatio >= 1){
				$this.addClass("ratio_4-3");
			}else if(imgRatio < 1 && imgRatio >= 0.75){
				$this.addClass("ratio_3-4");
			}else if(imgRatio < 0.75 && imgRatio >= 0.6){
				$this.addClass("ratio_2-3");
			}else{
				$this.removeClass("ratio_2-3").removeClass("ratio_3-2").removeClass("ratio-2").removeClass("ratio_4-3").removeClass("ratio_3-4");
			};
			if(imgRatio >= 2){
				$this.addClass("ratio-2");
			};
			if(imgRatio == 1){
				$this.removeClass("ratio_2-3").removeClass("ratio-2").removeClass("ratio_3-2").removeClass("ratio_4-3").removeClass("ratio_3-4");
			};

			$this.addClass("scale-ready");
		});
	};
	$(".hover-scale .rollover-project").scaleInHover();
	/*TOUCH DEVICE*/
	/*!Description on hover show content on click(albums projects touch device)*/

	$.fn.touchNewHover = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			if( $(".rollover-content", this).length > 0 || $(".woocom-rollover-content", this).length > 0){
				$body.on("touchend", function(e) {
					$(".mobile-true .rollover-content, .mobile-true .rollover-project, .mobile-true .woocom-rollover-content, .mobile-true .woocom-project").removeClass("is-clicked");
				});
				
				$this.on("touchstart", function(e) {
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
			
						if ($this.hasClass("is-clicked")) {
							if($this.find(".dt-gallery-container").length > 0){
								$this.find(".rollover-content").on("click.dtAlbums", function(e){
									$this.find(".rollover-content").off("click.dtAlbums");
									$(this).find("a.dt-gallery-mfp-popup, .dt-trigger-first-mfp, .dt-mfp-item").first().trigger('click');
								});
							}
							if($(this).find(".rollover-click-target.go-to").length > 0){
								window.location.href = $(this).find(".rollover-click-target.go-to").attr('href');
							}else if($(this).hasClass("woocom-project")){
								if ( $(e.target).is(".add_to_cart_button") ) {
									return true
								}else{
									window.location.href = $(this).find(" > a").attr('href');
								}
							}
						} else {

							$('.links-container > a', $this).on('touchend', function(e) {
								e.stopPropagation();
								$this.addClass("is-clicked");
							});
							e.preventDefault();
							$(".mobile-true .rollover-content, .mobile-true .rollover-project, .mobile-true .woocom-rollover-content, .mobile-true .woocom-project").removeClass("is-clicked");
							$this.addClass("is-clicked");
							$this.find(".rollover-content").addClass("is-clicked");
							$this.find(".woocom-rollover-content").addClass("is-clicked");
							return false;
						};
					};
				});
			};

			$this.addClass("this-ready");
		});
	};
	$(".mobile-true .rollover-project, .mobile-true .woocom-project").touchNewHover();

	/*Description on hover show content on click(albums projects touch device):end*/

	$(".hover-style-one article:not(.description-off) .rollover-project > a, .hover-style-two article:not(.description-off) .rollover-project > a, .mobile-true .cart-btn-on-img .buttons-on-img > a, .hover-style-three article:not(.description-off) .rollover-project > a").on("click", function(e){
		e.preventDefault();
	});
	$(".mobile-false .albums .rollover-content a:not(.portfolio-categories a), .mobile-false .media .rollover-content, .mobile-false .dt-gallery-container .rollover-content").on("click", function(e){
		if ( $(e.target).is("a") ) {return true};
		$(this).siblings("a.dt-single-mfp-popup, a.dt-gallery-mfp-popup, a.dt-mfp-item").first().click();
	});
		

	$.fn.touchWooHoverImage = function() {
		return this.each(function() {
			var $img = $(this);
			if ($img.hasClass("woo-ready")) {
				return;
			}

			$body.on("touchend", function(e) {
				$(".mobile-true .cart-btn-on-img .buttons-on-img").removeClass("is-clicked");
			});
			var $this = $(this);
			$this.on("touchstart", function(e) { 
				origY = e.originalEvent.touches[0].pageY;
				origX = e.originalEvent.touches[0].pageX;
			});
			$this.on("touchend", function(e) {
				var touchEX = e.originalEvent.changedTouches[0].pageX,
					touchEY = e.originalEvent.changedTouches[0].pageY;
				if( origY == touchEY || origX == touchEX ){
					if ($this.hasClass("is-clicked")) {
						if($(e.target).parent().hasClass("woo-buttons")){								
							$(e.target).trigger('click');
						}else{
							window.location.href = $this.find("a").first().attr("href");
						}
					} else {

						// console.log($(e.target))
						e.preventDefault();
						$(".mobile-true .cart-btn-on-img .buttons-on-img").removeClass("is-clicked");
						$this.addClass("is-clicked");
						return false;
					};
				};
			});

			$img.addClass("woo-ready");
		});
	};
	$(".mobile-true .cart-btn-on-img .buttons-on-img").touchWooHoverImage();

	
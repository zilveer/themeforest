jQuery(document).ready(function ($) {
	var i=0;
	var options;
	var jssor_slider;
	
	if(window.globalSponsorGallery){
	for(i=0; i<window.globalSponsorGallery.length;i++)
	{
		var slide_width= parseInt(window.globalSponsorSlideWidth[i]);
		var slide_height= parseInt(window.globalSponsorSlideHeight[i]);
		options = {
			$AutoPlay: true,$AutoPlaySteps: 1,$AutoPlayInterval: 0,$PauseOnHover: 4,$ArrowKeyNavigation: true,$SlideEasing: $JssorEasing$.$EaseLinear,$SlideDuration: 3000,$MinDragOffsetToSlide: 20,$SlideSpacing: 0,$DisplayPieces: 6,$ParkingPosition: 0,$UISearchMode: 1,$PlayOrientation: 1,$DragOrientation: 1,$SlideWidth:slide_width,$SlideHeight:slide_height
		};

		jssor_slider = new $JssorSlider$(window.globalSponsorGallery[i], options);

		function ScaleSlider() {
			var bodyWidth = document.body.clientWidth;
			if (bodyWidth)
				jssor_slider.$SetScaleWidth(Math.min(bodyWidth, 980));
			else
				window.setTimeout(ScaleSlider, 30);
		}

		ScaleSlider();

		if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
			$(window).bind('resize', ScaleSlider);
		}
	}
	}
});
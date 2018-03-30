/**
*	Site-specific configuration settings for Highslide JS
*/
hs.graphicsDir = 'js/plugins/highslide/graphics/';
hs.showCredits = false;
hs.outlineType = 'custom';
hs.dimmingOpacity = 0.85;
hs.fadeInOut = true;
hs.align = 'center';
hs.marginBottom = 70;
hs.marginLeft = 0;
hs.captionEval = 'this.a.title';
hs.captionOverlay.position = 'below';
hs.registerOverlay({
	html: '<div class="closebutton" onclick="return hs.close(this)" title="Close"></div>',
	position: 'top right',
	useOnHtml: true,
	fade: 2 // fading the semi-transparent overlay looks bad in IE
});



// Add the slideshow controller
hs.addSlideshow({
	slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: false,
	overlayOptions: {
		className: 'text-controls',
		opacity: 1,
		position: 'bottom center',
		offsetX: 0,
		offsetY: -10,
		relativeTo: 'viewport',
		hideOnMouseOut: false
	}
});

// gallery config object
var config1 = {
	slideshowGroup: 'group1',
	transitions: ['expand', 'crossfade']
};


var slideshow_options = {
	slideshowGroup: 'gal_group_0',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: false,
	overlayOptions: {
		className: 'text-controls',
		opacity: 1,
		position: 'bottom center',
		offsetX: 0,
		offsetY: -10,
		relativeTo: 'viewport',
		hideOnMouseOut: false
	}
};
hs.addSlideshow(slideshow_options);
function imageTooltip(el) {
var dw = jQuery(window).width(),
		dh = jQuery(window).height(),
	iw, ih, pt, pl;

	jQuery('.imageHolder').remove();
	jQuery('body').append('<div class="imageHolder"></div>');
	jQuery('.imageHolder').css('position', 'absolute').css('display', 'none').css('zindex',10001);

	el.each(function() {
		jQuery(this).hover(function (e) {
			var el = jQuery(this),
			src = el.attr('id'),
			img = new Image();
			dh = jQuery(window).height();
			dw = jQuery(window).width();
			dh = jQuery(window).height();
			el.css('cursor', 'progress');
			jQuery('.imageHolder img').remove();
			jQuery(img).load(function () {
				el.css('cursor', 'default');
				jQuery('.imageHolder').append(this);
				iw = jQuery('.imageHolder').width();
				ih = jQuery('.imageHolder').height();
				//check if image larger than dh
				if (ih > dh) {
					jQuery('.imageHolder img').height(dh-40);
					ih = dh-40;
				}
				//check if image larger than dw
				if (iw > dw) {
					jQuery('.imageHolder img').width(dw-40);
					iw = dw-40;
				}
			}).error(function () {
						alert('Error loading image.');
					}).attr('src', src);
		},function () {
			//jQuery('.imageHolder img').fadeOut(300, function() {jQuery(this).remove()});
			jQuery('.imageHolder img').hide().remove();
		}).mousemove(function (e) {
					ih = jQuery('.imageHolder').height();
					iw = jQuery('.imageHolder').width();
					//if image height not fits to bottom
					var out = e.pageY+ih-jQuery(document).scrollTop()-dh;
					//check if image not fits to window
					if (e.pageY+ih-jQuery(document).scrollTop()>dh) {
						jQuery('.imageHolder').css('top', e.pageY-out-20);
					} else {
						jQuery('.imageHolder').css('top', e.pageY-20);
					}
					//check if image on the right and not fits
					if (e.pageX+iw > dw-20) {
						jQuery('.imageHolder').css('left', e.pageX-iw-20);
					}
					else {
						jQuery('.imageHolder').css('left', e.pageX+20);
					}
					if (!jQuery('.imageHolder').is(':visible')) {
						jQuery('.imageHolder').fadeIn(200);
					}
				});
	})
}
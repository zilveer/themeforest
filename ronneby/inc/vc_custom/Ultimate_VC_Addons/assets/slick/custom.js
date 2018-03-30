jQuery(document).ready(function(){
	jQuery(".ult-carousel-wrapper").each(function(){
		var $this = jQuery(this);
		if($this.hasClass("ult_full_width")){
			var w = jQuery("html").outerWidth();
			var cw = $this.width();
			var left = (w - cw)/2;
			$this.css({"position":"relative","left":"-"+left+"px","width":w+"px"});
		}
	});
	jQuery('.ult-carousel-wrapper').each(function(i,carousel) {
		var gutter = jQuery(carousel).data('gutter');
		var id = jQuery(carousel).attr('id');
		if(gutter != '')
		{
			var css = '<style>#'+id+' .slick-slide { margin: '+gutter+'px; } </style>';
			jQuery('head').append(css);
		}
	});
});
jQuery(window).resize(function(){
	jQuery(".ult-carousel-wrapper").each(function(){
		var $this = jQuery(this);
		if($this.hasClass("ult_full_width")){
			$this.removeAttr("style");
			var w = jQuery("html").outerWidth();
			var cw = $this.width();
			var left = (w - cw)/2;
			$this.css({"position":"relative","left":"-"+left+"px","width":w+"px"});
		}
	});
});

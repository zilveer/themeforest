(function($){
	
	$(document).ready(function(){
		var parallaxBannerOffset = $('.parallax_banner_wrapper').offset().top;

		var parallaxImageHeight = parseInt($('.parallax_banner_wrapper img').css('height'));
		var parallaxBannerZeroPos = parallaxBannerOffset - parseInt($(window).height())/2 + parseInt($('.parallax_banner_wrapper').height())/2;
		var parWindWidth = parseInt($(window).width());
		var imgPosLeft = -((1920 - parWindWidth) / 2);
		var parallaxBannerRatio = parseInt($(window).height())/ parseInt($('.parallax_banner_wrapper').height());

		var textPosTop = (scroll - parallaxBannerZeroPos)/parallaxBannerRatio;
		var imgPosTop = ((parallaxBannerZeroPos - scroll)/parallaxBannerRatio - parallaxImageHeight/4)*0.9;
		
		var fSize = parWindWidth/18 < 110 ? parWindWidth/18 : 110;
		
		$('.parallax_banner_wrapper').find('img').css({'top' : imgPosTop , 'left' : imgPosLeft});
		$('.parallax_banner_wrapper').find('.banner_text_wrapper').css({'top' : textPosTop});
		$('.parallax_banner_wrapper .banner_text_inner').css({'font-size' : fSize+'px' , 'line-height' : fSize+4+'px'});
		
		
		
	$(window).resize(function(){
		var parallaxBannerOffset = $('.parallax_banner_wrapper').offset().top;

		var parallaxImageHeight = parseInt($('.parallax_banner_wrapper img').css('height'));
		var scroll = $(window).scrollTop();
		var parallaxBannerZeroPos = parallaxBannerOffset - parseInt($(window).height())/2 + parseInt($('.parallax_banner_wrapper').height())/2;
		var parallaxBannerRatio = parseInt($(window).height())/ parseInt($('.parallax_banner_wrapper').height());
		var parWindWidth = parseInt($(window).width());
		var imgPosLeft = -((1920 - parWindWidth) / 2);
		
		var textPosTop = (scroll - parallaxBannerZeroPos)/parallaxBannerRatio;
		var imgPosTop = ((parallaxBannerZeroPos - scroll)/parallaxBannerRatio - parallaxImageHeight/4)*0.9;
		
		var fSize = parWindWidth/18 < 110 ? parWindWidth/18 : 110;
		
		$('.parallax_banner_wrapper').find('img').css({'top' : imgPosTop , 'left' : imgPosLeft});
		$('.parallax_banner_wrapper').find('.banner_text_wrapper').css({'top' : textPosTop});		
		$('.parallax_banner_wrapper .banner_text_inner').css({'font-size' : fSize+'px' , 'line-height' : fSize+4+'px'});
		});
	
	$(window).scroll(function(){
		var parallaxBannerOffset = $('.parallax_banner_wrapper').offset().top;

		var parallaxImageHeight = parseInt($('.parallax_banner_wrapper img').css('height'));
		var scroll = $(window).scrollTop();
		var parallaxBannerZeroPos = parallaxBannerOffset - parseInt($(window).height())/2 + parseInt($('.parallax_banner_wrapper').height())/2;
		var parallaxBannerRatio = parseInt($(window).height())/ parseInt($('.parallax_banner_wrapper').height());
		
		var textFadeParameter = 1 - Math.abs((scroll - parallaxBannerZeroPos)*3.2/parseInt($(window).height())/2);
		
		
		var textPosTop = (scroll - parallaxBannerZeroPos)/parallaxBannerRatio;
		var imgPosTop = ((parallaxBannerZeroPos - scroll)/parallaxBannerRatio - parallaxImageHeight/2.5)*0.65;
		$('.parallax_banner_wrapper').find('img').css({'top' : imgPosTop});
		$('.parallax_banner_wrapper').find('.banner_text_wrapper').css({'top' : textPosTop, opacity : textFadeParameter});
		
	});
	
	});
	
})(jQuery);
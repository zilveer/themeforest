/*-----------------------------------------------------------------------------------
/* Styles Switcher
-----------------------------------------------------------------------------------*/



(function($){ 
	$(document).ready(function(){
	
		// Color Changer
		$(".green" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/green.css" );
			return false;
		});
		
		$(".blue" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/blue.css" );
			return false;
		});
		
		$(".orange" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/orange.css" );
			return false;
		});
		
		$(".navy" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/navy.css" );
			return false;
		});
		
		$(".yellow" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/yellow.css" );
			return false;
		});
		
		$(".peach" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/peach.css" );
			return false;
		});
		
		$(".beige" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/beige.css" );
			return false;
		});

		$(".purple" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/purple.css" );
			return false;
		});

		$(".red" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/red.css" );
			return false;
		});

		$(".pink" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/pink.css" );
			return false;
		});
		
		$(".celadon" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/celadon.css" );
			return false;
		});
		
		$(".brown" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/brown.css" );
			return false;
		});
		
		$(".cherry" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/cherry.css" );
			return false;
		});
		
		$(".gray" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/gray.css" );
			return false;
		});
		
		$(".dark" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/dark.css" );
			return false;
		});
		
		$(".cyan" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/cyan.css" );
			return false;
		});
		
		$(".olive" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/olive.css" );
			return false;
		});
		
		$(".dirty-green" ).click(function(){
			$("#colors" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/colors/dirty-green.css" );
			return false;
		});
		
		
		// Layout Switcher
		// $(".boxed" ).click(function(){
		// 	$("#layout" ).attr("href", "http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/boxed.css" );
		// 	return false;
		// });

		$("#layout-switcher").on('change', function() {
			$('#layout').attr('href', 'http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/'+ $(this).val() + '.css');

				if($(this).val() == 'darkboxed' || $(this).val() == 'darkwide') {
					$('#logo a img').attr('src','http://www.demo.purethemes.net/centum/wp-content/themes/centum/images/logo-bright.png');
				} else {
					$('#logo a img').attr('src','http://www.demo.purethemes.net/centum/wp-content/themes/centum/images/logo.png');
				}
				if($(this).val() == 'lightwide' || $(this).val() == 'darkwide') {
					$('#beegees').slideUp();
				} else {
					$('#beegees').slideDown();
				}
				if($(this).val() == 'darkboxed') {
					$('.bg li a.bg5 ').trigger('click');
				}
				if($(this).val() == 'lightboxed') {
					$('.bg li a.bg1 ').trigger('click');
				}
		});

		
		// Style Switcher	
		$('#style-switcher').animate({
			left: '-195px'
		});
		
		$('#style-switcher h2 a').click(function(e){
			e.preventDefault();
			var div = $('#style-switcher');
			if (div.css('left') === '-195px') {
				$('#style-switcher').animate({
					left: '0px'
				}); 
			} else {
				$('#style-switcher').animate({
					left: '-195px'
				});
			}
		})
		
		$('.colors li a').click(function(e){
			e.preventDefault();
			$(this).parent().parent().find('a').removeClass('active');
			$(this).addClass('active');
		})
		
		$('.bg li a').click(function(e){
			e.preventDefault();
			$(this).parent().parent().find('a').removeClass('active');
			$(this).addClass('active');
			var bg = $(this).css('backgroundImage');
			$('body').css('backgroundImage',bg)
		})
		
		$('.bgsolid li a').click(function(e){
			e.preventDefault();
			$(this).parent().parent().find('a').removeClass('active');
			$(this).addClass('active');
			var bg = $(this).css('backgroundColor');
			$('body').css('backgroundColor',bg).css('backgroundImage','none')
		})
		
		$('#reset a').click(function(e){
			var bg = $(this).css('backgroundImage');
			$('#layout').attr('href', 'http://www.demo.purethemes.net/centum/wp-content/themes/centum/css/lightboxed.css');
			$('.bg li a.bg1 ').trigger('click');
		})
			

});

})(this.jQuery);
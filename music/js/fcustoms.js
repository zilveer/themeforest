jQuery(document).ready(function($) {
	
	var init = window.setInterval(dogal, 6000);
	
	function dogal() {
		var thisser = $('.gallwidgouter .gallwidg:last');
		var thismove = $('.gallwidgouter .gallwidg:first');
		$(thismove).hide()
		$(thisser).after(thismove);
		$(thismove).fadeIn(2000);
	}
	
	
	
	$('a[href^="http://"]').attr({
			target: "_blank",
			title: "Opens in a new window"
	});
	
	$('a[href^="https://"]')
		.attr({
		target: "_blank",
		title: "Opens in a new window"
	});
	
	
	$('a[href^="https://"]').click(function() {
		var repval = $(this).attr('href');
		var repreplace = repval.replace(base_url , ssl_url);
		window.open(repreplace);
	}); 


	// *************************** widgets *********************************
	
	$('li.widget-container:first').css('display', 'block');
	
	var n =  $('li.widget-container').length,	
		p = 0,
		target = $('ul.morenews');
	
	while(p < n){
		
		var targ = 	$('li.widget-container:eq(' +  p +  ')');		
		var ttitle = targ.find('h3').html();		
		if (p == 0) {		
			target.append('<li><a class="vfont current" href="#">' + ttitle + '</a></li>')			
		} else {
			target.append('<li><a class="vfont" href="#">' + ttitle + '</a></li>')
		}			
		p++;	
	}
	
	
	$('ul.morenews a').click(function() {
		$('ul.morenews a.current').removeClass('current');
		$(this).addClass('current');
		
		var titler = $(this).html();
		
		$('li.widget-container').each(function() {
			var targetnote = $(this).find('h3').html();
			
			if (targetnote == titler) {
				$(this).fadeIn('fast');
			} else {
				$(this).fadeOut('fast');
			}
			
		});
		
		return false;
	});
		
});


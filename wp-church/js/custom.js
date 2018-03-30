jQuery(document).ready(function($) {
	
	if (timerhelp == 'yes') {
		var init = setInterval(animation, 100);
	}
	function animation(){	
		var dayname = $('.tnamesday').html();
		var hourname = $('.tnameshour').html();
		var minname = $('.tnamesmin').html();
		var secname = $('.tnamessec').html();	
		var deadline1 = $('.time').attr('rel');
		var deadline2 = $('.time').attr('contents');
		var now = new Date();
		now = Math.floor(now / 1000);
		now = now + Math.floor(deadline2 * 60 * 60);
		var counter1 = deadline1 - now;
		var seconds1=Math.floor(counter1 % 60);
		if (seconds1 < 10 && seconds1 > 0 ){
			seconds1 = '0'+seconds1;
		}
		counter1=counter1/60;
		var minutes1=Math.floor(counter1 % 60);
		if (minutes1 < 10 && minutes1 > 0){
			minutes1 = '0'+minutes1;
		}
		counter1=counter1/60;
		var hours1=Math.floor(counter1 % 24);
		if (hours1 < 10 && hours1 > 0){
			hours1 = '0'+hours1;
		}
		counter1=counter1/24;
		var days1=Math.floor(counter1);
		if (days1 < 10 && days1 > 0){
			days1 = '0'+days1;
		}
		$('.time').html('<table><tbody><tr><th class="day">'+days1+'</th><th class="day">'+hours1+'</th><th class="day">'+minutes1+'</th><th class="day">'+seconds1+'</th></tr><tr><th>'+dayname+'</th><th>'+hourname+'</th><th>'+minname+'</th><th>'+secname+'</th></tr></tbody></table>');	
	}
	
	$('.fpwidg:first').addClass('first');
	$('.fpwidg:last').find('.priminner').css('margin-right','20px');
	
	$('a.ttip').hover(
		function () {
		$('.active').fadeOut('slow').removeClass('active');
		var tref = $(this).attr('rel');
		$('.' +tref).fadeIn('slow').css('display','inline').addClass('active');
		$('.' +tref).find('span:first').css('font-size','18px').css('font-weight','bold').css('display','block').css('margin-bottom','10px');
		}, 
		function () {
	});
	
	$('a.close').click(function() {
		$('.active').fadeOut('slow').removeClass('active');
		return false;
	});
	
	$('.calsingleentryw:last').css('border-width' , '0px');
	
	var currentTallest = 0,
    currentRowStart = 0,
    rowDivs = new Array(),
    $el,
    topPosition = 0;
	
	$('.intleftinner').each(function() {

   $el = $(this);
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {

     // we just came to a new row.  Set all the heights on the completed row
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }

     // set the variables for the new row
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);

   } else {

     // another div on the current row.  Add it to the list and check if it's taller
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

  }
  
  for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }

  
  });
  
  $('.vmp').click(function(){
  	var data = { action: 'netlabs_get_ajaxdata', type: 'get_map'};
	$('.dirclose').show();
	$.post(ajax_url, data, function(response) {	
		$('.mapdiv').html(response).slideDown('fast', function(){
			$('.dirhelp').show();
		});
	});
	return false;
	
  });
  
  $('a.nxtlink').click(function(){
  	nxtsol();
	return false;
  });
  
  
  $('a.prevlink').click(function(){
  	prvsol();
	return false;
  });
  
  function nxtsol(){
  	var sender = $('a.nxtlink').attr('rel');
  	var data = { action: 'netlabs_get_ajaxdata', type: 'get_cal', senddata: sender};
	$.post(ajax_url, data, function(response) {	
		$('.calselect').html(response);
		$('a.nxtlink').unbind('click').bind('click', nxtsol);
		$('a.prevlink').unbind('click').bind('click', prvsol);
	});
	
  }
  
   function prvsol(){
  	var sender = $('.prevlink').attr('rel');
  	var data = { action: 'netlabs_get_ajaxdata', type: 'get_cal', senddata: sender};
	$.post(ajax_url, data, function(response) {	
		$('.calselect').html(response);
		$('a.prevlink').unbind('click').bind('click', prvsol);
		$('a.nxtlink').unbind('click').bind('click', nxtsol);
	});
  }
  
  
  $('.dirclose').click(function(){
  	$('.mapdiv').html('').slideUp('slow');
	$('.dirclose').hide();
	$('.dirhelp').hide();
  });
  
  $('img.mapmarker').hover(
  function () {
    $('.dirtooltip').fadeIn('slow');
  }, 
  function () {
    $('.dirtooltip').fadeOut('slow');
  }
	);

	$('#driveclick').click(function(){
		$('#dir-container').css('width', '410px')
	});
	
	$('.fmp').click(function(){
		$('img.loader').show();
		var value = $(this)
		$(value).closest('.fwrapper').find('.infoholder').html('loading');
		$('.infoholder').each(function() {
			$(this).html('');
		})
		var mpstring = $(this).attr('rel');
		var data = { action: 'netlabs_get_ajaxdata', type: 'get_mp3', mstring: mpstring};
		$.post(ajax_url, data, function(response) {	
			$(value).closest('.fwrapper').find('.infoholder').html(response);
		});
		$('img.loader').hide();
	});
	
	$('.micfront').click(function(){
		$('img.loader').show();
		$('.infoholder').html('loading');
		var mpstring = $(this).attr('rel');
		var data = { action: 'netlabs_get_ajaxdata', type: 'get_mp3', mstring: mpstring};
		$.post(ajax_url, data, function(response) {	
			$('.infoholder').html(response);
			
		});
		$('img.loader').hide();
	});		
	
	$('.imagelink img:last').css('margin','0');
	
	$('.gallery_reloaded_container a').fancybox();
	
	$("a.vid").click(function() {
    	$.fancybox({
       		'padding'             : 0,
			'overlayColor'		: '#000',
        	'transitionIn'        : 'none',
        	'transitionOut'       : 'none',
        	'title'               : this.title,
        	'width'               : 680,
        	'height'              : 495,
			'wmode'				: 'transparent',
        	'href'                : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
        	'type'                : 'swf'
        });
        return false;
	});	
	
	$("a.vim").click(function() {
    	$.fancybox({
       		'padding'             : 0,
			'overlayColor'		: '#000',
        	'transitionIn'        : 'none',
        	'transitionOut'       : 'none',
        	'title'               : this.title,
        	'width'               : 680,
        	'height'              : 495,
			'wmode'				  : 'transparent',
        	'href'                : this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
        	'type'                : 'swf'
        });
        return false;
	});								
		
});


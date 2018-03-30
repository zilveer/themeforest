$(document).ready(function () {

	// Apply fancybox on all images
	$("a[href$='gif']").fancybox();
	$("a[href$='jpg']").fancybox();
	$("a[href$='png']").fancybox();	
	
	$('#content #resume a').click(function() {  
		$.scrollTo($(this)[0].getAttribute('href'), 1000); 
		return false;   
	});

	$('#toolbar .top a').click(function() {  
		$.scrollTo('#logo', 1000); 
		return false;   
	});	
	$('#toolbar').css({height: 0}).animate({ height: '38' }, 'slow');	
});

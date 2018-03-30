jQuery(document).ready(function($){	
  "use strict";
	
	//function to hide rwmb field by label
	function hideField(targetLabel){
		$('.rwmb-field').each(function(){
			var thisLabel = $(this).find('.rwmb-label label').attr('for');
			var Split = thisLabel.split(targetLabel);
			if(Split[0].length==0){
				$(this).addClass('toogle-item').hide();
			}
			
		});	
	}
	
	//function to show checked post format
	function checkShow(inputID,targetLabel){
		var Checked = $('input#'+inputID).attr('checked');
		if(Checked=='checked'){
			$('.rwmb-field').each(function(){
				var thisLabel = $(this).find('.rwmb-label label').attr('for');
				var Split = thisLabel.split(targetLabel);
				if(Split[0].length==0 && $(this).hasClass('toogle-item')){
					$(this).show();
				}
			});
		}
	}
	
	// Show field on click post format function
	function showSectionOnClick(buttonID,targetID){
		$('#'+ buttonID).click(function(){
			$('.rwmb-field').each(function(){
				var thisLabel = $(this).find('.rwmb-label label').attr('for');
				var Split = thisLabel.split(targetID);
				if(Split[0].length==0){
					if($(this).hasClass('toogle-item')){
						$(this).show();
					}						
				}
				else if($(this).hasClass('toogle-item')){
					$(this).hide();
				}
			});
		});
	}

	// Hide all on standard post format & gallery
	$('#post-format-0, #post-format-gallery').click(function(){
		$('.rwmb-field.toogle-item').hide()
	});
	

	
	//hide fields
	hideField('unik_featured_audio');
	hideField('unik_featured_video');
	
	//check and show each toggle able fields
	checkShow('post-format-audio','unik_featured_audio');
	checkShow('post-format-video','unik_featured_video');
	
	//show section on click
	showSectionOnClick('post-format-audio','unik_featured_audio');
	showSectionOnClick('post-format-video','unik_featured_video');
	
	
	// sidebar generator
	
	
  
  
});
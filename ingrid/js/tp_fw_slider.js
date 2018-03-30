jQuery(document).ready(function($) {
	
	//FULL WIDTH SLIDER
	if(jQuery('#tp-fw-slider').length != 0){
		jQuery(function($){	
			var itemsnum = $('.tp-fws-layers').length - 1;
			var i = -1;			
			var t;
			var pause = 4000; if(tp_page_fwslider_pause != ''){pause = tp_page_fwslider_pause;}
			var fadespeed = 1000; if(tp_page_fwslider_speed != ''){fadespeed = tp_page_fwslider_speed;}
			var lastsrc = $('.tp-fws-layers').last().css('background-image');
			lastsrc = lastsrc.replace('url(','').replace(')','').replace('"','').replace('"','');
			
			if(itemsnum > 0){
				
				//create rotate function
				function startfws(i,pause,itemsnum){			
					j = i+1;
					
										
					if(j > itemsnum){
						//last item >> different fades!
						j = 0;
						
						//show first
						$('.tp-fws-layers').first().css('display','block');
						
						
						$('.tp-fws-layers').removeClass('tp-fws-curr');
						$('.tp-fws-layers').first().addClass('tp-fws-curr');	
						
						
							//hide prev caption
								$('.tp-fws-caption').fadeOut(500).html('');
								
									
									
						//fade out last
						$('.tp-fws-layers:eq('+i+')').fadeOut(fadespeed,function(){		
							//check caption
								var caption = $('.tp-fws-layers:eq('+j+')').attr('data-caption');
								if(caption != undefined){
									$('.tp-fws-caption').html(caption).fadeIn(500);
								}
						
							i = 0;						
							t=setTimeout(function(){ startfws(i,pause,itemsnum); },pause);
						});
					}else{				
						//show current
							
							//check caption
								//hide prev caption
								$('.tp-fws-caption').fadeOut(500).html('');
															
						$('.tp-fws-layers:eq('+j+')').fadeIn(fadespeed,function(){		
							//hide previous one
							$('.tp-fws-layers:eq('+i+')').css('display','none');
							
							$('.tp-fws-layers').removeClass('tp-fws-curr');
							$('.tp-fws-layers:eq('+j+')').addClass('tp-fws-curr');						
								
								//show caption if exist
								var caption = $('.tp-fws-layers:eq('+j+')').attr('data-caption');
								if(caption != undefined){
									$('.tp-fws-caption').html(caption).fadeIn(500);
								}
								
							if(j == 0){
								i = 0;
							}else{
								i++;
							}
									
							t=setTimeout(function(){ startfws(i,pause,itemsnum); },pause);
						});
					}	
					
				}
			
				//lets begin when all images are loaded
				if ($.browser.msie && $.browser.version.substr(0,1) < 9) {
						$('.tp-fws-layers').first().fadeIn(1000,function(){
							startfws(i,pause,itemsnum);	
						});
				}else{
					$('<img/>').attr('src', lastsrc).load(function() {	
						//fade in first slide
						$('.tp-fws-layers').first().fadeIn(1000,function(){
							startfws(i,pause,itemsnum);	
						});
						
					});
				}
				
			
			}else{
				//just 1 still image
				$('.tp-fws-layers').first().css('display','block');
				
				//disable arrows
				$('#tp-fw-slider #arrow-left, #tp-fw-slider #arrow-right').css('display','none');
				
			}
			
			
			//arrow funcs
				//prev
				$('#tp-fw-slider #arrow-left').click(function(){
					//stop current flow
					clearTimeout(t);
					
					//start again with prev
					var nexti = $('.tp-fws-curr').index()-1;					
					if(nexti < 0){
						//first item, go to last
						$('.tp-fws-caption').fadeOut(500).html('');
						nexti = itemsnum - 1; 					
						startfws(nexti,pause,itemsnum);	
					}else{
						//fade out current, restart loop with curr index
						var curri = $('.tp-fws-curr').index();
						$('.tp-fws-caption').fadeOut(500).html('');
						$('.tp-fws-layers:eq('+nexti+')').css('display','block');
						$('.tp-fws-layers:eq('+curri+')').fadeOut(fadespeed,function(){		
							nexti = nexti - 1;
							startfws(nexti,pause,itemsnum);	
						});
					}					
				
					return false;
				});	
				
				//next
				$('#tp-fw-slider #arrow-right').click(function(){
					//stop current flow
					clearTimeout(t);
					
					//start again with next
					var nexti = $('.tp-fws-curr').index();
					startfws(nexti,pause,itemsnum);	
				
					return false;
				});
			
		});
	}

});
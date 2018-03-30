/*----------------------------------------------------*/
/* PORTFOLIO AJAX FUNCTION
/*----------------------------------------------------*/ 
	  
		function rnrAjaxPortfolio() {
			
		   jQuery('body').on( 'click', '.portfolio-item a[data-ajax="true"]', function(event) {	
		   
		   	  		 
			 
				 var correction = 50;
				 var headerH = jQuery('nav').outerHeight()+correction;
				 url = jQuery(this).data('ajax-url'); 
				  
			   
				  portfolioGrid.find('div.portfolio-item.current').children().removeClass('active');
				  portfolioGrid.find('div.portfolio-item.current').removeClass('current' );		
		
		
				  	  
						  jQuery('html,body').stop().animate({scrollTop: (projectContainer.offset().top-20)+'px'},800,'easeOutExpo', function(){											
							  loadProject(url);	
							  
                                return false;																								  
						  });
						  

				
				  /* ADD ACTIVE CLASS TO CURRENTLY CLICKED PROJECT */
				   portfolioGrid.find('div.portfolio-item .portfolio a[href$="' + url + '"]' ).parent().parent().addClass( 'current' );
				   portfolioGrid.find('div.portfolio-item.current').find('.portfolio').addClass('active');
					
		 
			 event.preventDefault(); 
			 return false;
		});	  
		
	  	/* LOAD PROJECT */		
		function loadProject(url){
			loader.fadeIn().removeClass('projectError').html('');
			
			
						
	            ajaxLoading = true;
							
				 console.log(url);		
				projectContainer.load( url +' div#ajaxpage', function(xhr, statusText, request){
																   
						if(statusText == "success"){				
								
								ajaxLoading = false;
								
									page =  jQuery('#ajaxpage');		
			
									jQuery('.flexslider').flexslider({
												
												animation: "slide",
												slideDirection: "horizontal",
												slideshow: true,
												slideshowSpeed: 3500,
												animationDuration: 500,
												directionNav: true,
												controlNav: false
												
										});
									jQuery('.project-media .flexslider .flex-direction-nav li a.flex-next').html('<i class="fa fa-angle-right"></i>');
									jQuery('.project-media .flexslider .flex-direction-nav li a.flex-prev').html('<i class="fa fa-angle-left"></i>');	
			
									jQuery('#ajaxpage').waitForImages(function() {
										hideLoader();  
									});			  
											
									jQuery(".container").fitVids();	
									rnrShortcodes();
								
						}
						
						if(statusText == "error"){
						
								loader.addClass('projectError').append(loadingError);
								
								loader.find('p').slideDown();

						}
					 
					});
					
					return false;
				
			}
			
		
		

		
		function hideLoader(){													  
	        loader = jQuery('div#loader'); 
			loader.fadeOut('fast', function(){
					showProject();					
			});	
					 
		}	
		
		
		function showProject(){
			if(content==false){
					projectContainer.animate({opacity:1, height: "auto"}, 500,'easeOutExpo', function(){
				        jQuery(".container").fitVids();
						scrollPostition = jQuery('html,body').scrollTop();
						projectNav.fadeIn();
						exitProject.fadeIn();
						content = true;	
								
					});
					
			}else{
					projectContainer.animate({opacity:1, height: "auto"}, 500,'easeOutExpo', function(){																		  
					jQuery(".container").fitVids();
						scrollPostition = jQuery('html,body').scrollTop();
						projectNav.fadeIn();
						exitProject.fadeIn();
						
					});					
			}
					
			
			projectIndex = portfolioGrid.find('div.portfolio-item.current').index();
			projectLength = jQuery('div.portfolio-item .portfolio').length-1;
			
			
			if(projectIndex == projectLength){
				
				jQuery('ul li#nextProject a').addClass('disabled');
				jQuery('ul li#prevProject a').removeClass('disabled');
				
			}else if(projectIndex == 0){
				
				jQuery('ul li#prevProject a').addClass('disabled');
				jQuery('ul li#nextProject a').removeClass('disabled');
				
			}else{
				
				jQuery('ul li#nextProject a,ul li#prevProject a').removeClass('disabled');
				
			}
		return false;
	  }
	  
	  
	  
	  function deleteProject(closeURL){
				projectNav.fadeOut(100);
				exitProject.fadeOut(100);				
				projectContainer.animate({opacity:0, height: 0},300,'easeOutExpo');
				projectContainer.empty();
				
			if(typeof closeURL!='undefined' && closeURL!='') {
				location = '#_';
			}
			portfolioGrid.find('div.portfolio-item.current').children().removeClass('active');
			portfolioGrid.find('div.portfolio-item.current').removeClass('current' );			
	  }
	  
	  
     /* LINKING TO PREIOUS AND NEXT PROJECT VIA PROJECT NAVIGATION */
	  jQuery('#nextProject a').on('click',function () {											   							   
					 
		    current = portfolioGrid.find('.portfolio-item.current');
		    next = current.next('.portfolio-item');
		    target = jQuery(next).children('div').children('a').attr('href');
			
			
		
			if (next.length === 0) { 
				 return false;			  
			 } 
		   
		   current.removeClass('current'); 
		   current.children().removeClass('active');
		   next.addClass('current');
		   next.children().addClass('active');
		   loadProject(target);
		  return false;	
		   
		});



	    jQuery('#prevProject a').on('click',function (event) {			
			
		  current = portfolioGrid.find('.portfolio-item.current');
		  prev = current.prev('.portfolio-item');
		  target = jQuery(prev).children('div').children('a').attr('href');
		  
			
		   
		   if (prev.length === 0) {
			  return false;			
		   }
		   
		   current.removeClass('current');  
		   current.children().removeClass('active');
		   prev.addClass('current');
		   prev.children().addClass('active');
		   
		   loadProject(target);
		  return false;	
		   
		});
		
		
         /* CLOSE PROJECT */
		 jQuery('#closeProject a').on('click',function () {
			 
		    deleteProject(jQuery(this).attr('href')); 			
			portfolioGrid.find('div.portfolio-item.current').children().removeClass('active');			
			loader.fadeOut();
			return false;
			
		}); 

		 
		 pageRefresh = false;	  

};
		 
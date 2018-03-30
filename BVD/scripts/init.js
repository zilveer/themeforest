	$(document).ready(function()
	{
				function findPosition( oElement )
				{
  					if( typeof( oElement.offsetParent ) != 'undefined' )
  					{
    					for( var posX = 0, posY = 0; oElement; oElement = oElement.offsetParent )
    					{
      						posX += oElement.offsetLeft;
      						posY += oElement.offsetTop;
    					}
    					
    					return [ posX, posY ];
  					}
  					else
  					{
    					return [ oElement.x, oElement.y ];
  					}
				}
				
				//Set first li in left navigation to class arrow		
				$('#left_nav li:first').addClass('arrow');
				
				var height_ul  = $('#left_nav').height();//Height of div #left_nav
				height_ul      = parseInt(height_ul);//Width of ul without "px" sufix
				
				var div_top    = document.getElementById('center_left_top').offsetTop;//Top value of div
				var div_left   = document.getElementById('center_left_top').offsetLeft;//Left value of div
				var div_height = $('.center_left_top').height();//Height of div

				$('#left_nav').css('top',div_top + div_height);//Set up new top value for ul
				$('#left_nav').css('left',div_left+10);//Set up new left value for ul
				$('.center_left_top').css('height',height_ul+70);//Increase div height because we will over it ul navigation
				$('#left_nav li.arrow').css('margin-left','-30px');//Fix arrow class for li
				$('#left_nav li.arrow').css('padding-left','40px');//Fix arrow class for li
				
				//IF IE fix elements
				if ($.browser.msie)
				{
					var browserVer = parseInt($.browser.version);//Browser version
					
					//IE 7
					if(browserVer == 7)
					{
						var position = findPosition(center_left_top);
						div_left    = position[0];
						div_top = position[1];
						
	 					$('#left_nav').css('top',div_top + div_height);//Fix top for ul
						$('#left_nav').css('left',div_left+10+'px');//Fix left for ul
						$('#left_nav li.arrow').css('margin-left','-30px');//Fix arrow class for li
						$('#left_nav li.arrow').css('padding-left','40px');//Fix arrow class for li						
					}
										
					//IE 6
					if(browserVer == 6)
					{
						$('#left_nav').css('top',div_top + div_height+60);//Fix top for ul
						$('#left_nav').css('left',div_left+20);//Fix left for ul
						$('.center_left_top').css('height',height_ul+85);//Fix div height
					}
				}
				$(window).resize(function(){
					
					//Set first li in left navigation to class arrow		
					$('#left_nav li:first').addClass('arrow');
					
					var height_ul  = $('#left_nav').height();//Height of div #left_nav
					height_ul      = parseInt(height_ul);//Width of ul without "px" sufix
					
					var div_top    = document.getElementById('center_left_top').offsetTop;//Top value of div
					var div_left   = document.getElementById('center_left_top').offsetLeft;//Left value of div
					var div_height = $('.center_left_top').height();//Height of div
	
					$('#left_nav').css('top',div_top+60);//Set up new top value for ul
					$('#left_nav').css('left',div_left+10);//Set up new left value for ul
					$('.center_left_top').css('height',height_ul+60);//Increase div height because we will over it ul navigation
					$('#left_nav li.arrow').css('margin-left','-30px');//Fix arrow class for li
					$('#left_nav li.arrow').css('padding-left','40px');//Fix arrow class for li
					
				});

				
				
				//Hover and mouse out
				$('.center_left_top ul li').hover(function(){
					//Do not change li that have a.selected class
					if($(this).children('a').attr('class' ) != 'selected')
					{
						$(this).addClass("arrow");//Add new class . arrow
						
						//IF IE6 fix li element after removing class
						if ($.browser.msie)
						{
							var browserVer = parseInt($.browser.version);
						
							if(browserVer == 6)
							{
								$(this).css('background-image','url(css/i/arrow_right.png)');
							}
						}
					}
					
					$('#left_nav li.arrow').css('margin-left','-30px');//Fix arrow class for li
					$('#left_nav li.arrow').css('padding-left','40px');//Fix arrow class for li
										
				},function(){
					//Do not change li that have a.selected class
					if($(this).children('a').attr('class' ) != 'selected')
					{
						$(this).removeClass("arrow");//Remove class
						
						//IF IE6 fix li element after removing class
						if ($.browser.msie)
						{
							var browserVer = parseInt($.browser.version);
						
							if(browserVer == 6)
							{
								$(this).css('background-image','none');
							}
						}
					}
				});
		});
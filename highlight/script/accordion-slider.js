/**
 * Contains the functionality for the accordion slider.
 * 
 * @author Pexeto
 * http://pexeto.com
 */


(function($){
	$.fn.accordionSlider=function(options){
		var defaults={
			imageWidth:700,
			holderWidth:940
		};
		
		options=$.extend(defaults, options);
		var api, timer=-1, holders=[], current, root, inAnimation=false, descBox, descBottom=2, currentImage=-1, smallWidth=0, holderNumber=0,
		inHover=false;
		
		
		root=$(this);
		thumbContainer=$('#'+options.thumbContainerId);
		current=root.find('img:first').toggleClass('current').show();
		
		init();
		
		/**
		 * Inits the slider.
		 */
		function init(){
			getHolders();
			holderNumber=holders.length;
			smallWidth=(options.holderWidth-options.imageWidth)/(holderNumber-1);
			positionHolders();
			setEventHandlers();
		}
		
		/**
		 * Inserts the bigger holders into an array for further use.
		 */
		function getHolders(){
			root.find('.accordion-holder').each(function(i){
				var holder=$(this).append('<div class="accordion-shadow" />'),
				description=holder.find('.accordion-description:first').css({opacity:0.7});
				holders.push({obj:holder, description:description});
			});
		}
		
		/**
		 * Positions the holders in an accordion layout.
		 */
		function positionHolders(){
			var width=options.holderWidth/holderNumber,
				leftPosition=0,
				descriptionDiv,
				current;
		
			for(var i=0; i<holderNumber; i++){
				leftPosition=i*width;
				current=holders[i];
								
				current.obj.css({left:leftPosition, visibility:'visible', zIndex:i*10});
			}
		}
		
		/**
		 * Sets the mouse event handlers to the images.
		 */
		function setEventHandlers(){
			var holder;
			
			//set the hover handler for each of the images
			for(var i=0; i<holderNumber; i++) (function(i){
				holder=holders[i].obj;
				holder.mouseover(function(){
					inHover=true;
					$(this).css({cursor:'pointer'});
					window.setTimeout(function(){
						if(inHover){
							showSelected(i);
						}
					}, 100);
				});
			})(i);
			
			//set the mouseleave event handler to the root - when the mouse leaves the root, 
			//position the images to the default state
			root.mouseleave(function(){
				inHover=false;
				window.setTimeout(function(){
					if(!inHover){
						setInitialPosition();
					}
				}, 150);
			});
			
		}
		
		/**
		 * Shows the selected (hovered image).
		 */
		function showSelected(index){
			var selected=holders[index].obj,
				leftPosition=0;
			
			if(currentImage!=-1){
				holders[currentImage].obj.css({zIndex:currentImage*10});
			}
			
			
			//calculate the left position of the selected image
			selectedLeft=smallWidth*index;
			
			for(var i=0; i<holderNumber; i++){
				if(i===index){
					//the holder is the selected one
					leftPosition=smallWidth*i;
					holders[i].obj.stop().animate({left:leftPosition}, 500,function(i){
					$(this).find('.accordion-description:first').fadeIn();
				}
							);
				}else if(i<index){
					//the holder to move is a holder before the selected one
					leftPosition=smallWidth*i;
					holders[i].obj.stop().animate({left:leftPosition}, 500, function(i){
					$(this).find('.accordion-description:first').hide();
				});
				}else{
					//the holder to move is positioned after the selected one
					leftPosition=smallWidth*(i-1)+options.imageWidth;
					holders[i].obj.stop().animate({left:leftPosition}, 500, function(i){
					$(this).find('.accordion-description:first').hide();
				});
				}
			}
			
			selected.animate(selectedLeft);
			
			currentImage=index;
		}
		
		/**
		 * Animates the images to their initial position.
		 */
		function setInitialPosition(){
			var width=options.holderWidth/holderNumber,
			leftPosition=0;
			
	
			for(var i=0; i<holderNumber; i++){
				leftPosition=i*width;
				holders[i].obj.stop().animate({left:leftPosition}, function(i){
					$(this).find('.accordion-description:first').hide();
				});
			}
		}
	};
}(jQuery));
var txt_modCont             = "#portfolio-container > #portfolio-container-holder";  
touchDevice = 0 ;
    function showOtherThumbs( galleryHolder ){        
       galleryHolder.find(".thumb-holder").each( function(){ $(this).css("display", "inline").css("top", "0px"); } );
    }

    function getAvailableScrollbar(){
        var scrollbar_v1    = $("#module-container #module-scrollbar-holder");
        var scrollbar_v2    = $("#module-container #module-scrollbar-holder_v2");
        var availScrollbar  = (scrollbar_v1.length > 0) ? scrollbar_v1 : scrollbar_v2;
        return availScrollbar;
    }

    function afterGalleryStartupAnimation( visibleH ){
        var textPageInstanceHolder    = jQuery( txt_modCont);
        var textPageInstance          = jQuery( "#portfolio-galleries", textPageInstanceHolder);
        if( textPageInstance.length <= 0){return;}
        jQuery("#portfolio-galleries-holder", textPageInstance).find(".thumb-holder").each( function(){ jQuery(this).css("display", "inline"); } ); 
        jQuery("#portfolio-galleries-preview").wipetouch({
              tapToClick: false, /* if user taps the screen, triggers a click event*/
              preventDefault:false,/* if user taps the screen, triggers a click event*/
              wipeLeft: function(result) { wipeChange( 1 ); },
              wipeRight: function(result) { wipeChange( -1 ); }
        });     
    }
    function getDirectionCSS( jQueryelement, coordinates ){
		
        /** the width and height of the current div **/
    	var w = jQueryelement.width(), h = jQueryelement.height(),
    		/** calculate the x and y to get an angle to the center of the div from that x and y. **/ /** gets the x value relative to the center of the DIV and "normalize" it **/
    		x = ( coordinates.x - jQueryelement.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
    		y = ( coordinates.y - jQueryelement.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),
    		/** the angle and the direction from where the mouse came in/went out clockwise (TRBL=0123);**/
    		/** first calculate the angle of the point, add 180 deg to get rid of the negative values divide by 90 to get the quadrant
    		add 3 and do a modulo by 4  to shift the quadrants to a proper clockwise TRBL (top/right/bottom/left) **/
    		direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 )  % 4;
            var fromClass, toClass;
            switch( direction ) {
    			case 0:/* from top */ 
                    fromClass = {instance:'hover-slideFromTop', val1: "0px", val2:"-100%"};                    
    				toClass	  = {instance:'hover-slideTopLeft', val1: "0px", val2:"0px"};
    				break;
    			case 1:/* from right */
    			    fromClass = {instance:'hover-slideFromRight', val1: "100%", val2:"0px"};
    				toClass	  = {instance:'hover-slideTopLeft', val1: "0px", val2:"0px"};
    				break;
    			case 2:/* from bottom */
    				fromClass = {instance:'hover-slideFromBottom', val1: "0px", val2:"100%"};
    				toClass	  = {instance:'hover-slideTopLeft', val1: "0px", val2:"0px"};
    				break;
    			case 3:/* from left */
    				fromClass = {instance:'hover-slideFromLeft', val1: "-100%", val2:"0px"};
    				toClass	  = {instance:'hover-slideTopLeft', val1: "0px", val2:"0px"};
    				break;
    		};
    	return { from : fromClass, to: toClass };
    }

    function customHoverAnimation( type, event, parent, child ){
        var directionCSS = getDirectionCSS( parent, { x : event.pageX, y : event.pageY } );
        if( type == "over" ){
            child.removeClass(); 
			child.css("left", directionCSS.from.val1); 
			child.css("top", directionCSS.from.val2);
            TweenMax.to( child, .3, { css:{ left:directionCSS.to.val1, top: directionCSS.to.val2},  ease:Sine.easeInOut });
        }
        else if( type == "out" ){
			TweenMax.to( child, .3, { css:{ left:directionCSS.from.val1, top: directionCSS.from.val2},  ease:Sine.easeInOut }); 
		}
    }



    function rgb2hex(rgb){     
         var value = "";
         if( rgb != undefined )
        {
            if ( (jQuery.browser.msie && (jQuery.browser.version == "9.0" && isIE9Std() == true )) ||  !jQuery.browser.msie ){  
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);            
            value = "#" + ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) + ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) + ("0" + parseInt(rgb[3],10).toString(16)).slice(-2);
             }
             else{ value = rgb; }
        }
         
         return value;
    }

	function animateThumb( img ){ 
		jQuery(img).parent().width(jQuery(img).parent().parent().width());
		TweenMax.to( img, 0, {css:{opacity:"1"}, easing:Sine.easeOut});
	}
	
	
	function moduleGallery(){
		touchDevice = !!("ontouchstart" in window) ? 1 : 0; 
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent) ) {
			touchDevice = 1;
		}		
	    var textPageInstanceHolder = jQuery( txt_modCont );
        var textPageInstance          = jQuery( textPageInstanceHolder ).children('#portfolio-galleries');//jQuery( "#portfolio-galleries", textPageInstanceHolder);
        if( textPageInstance.length <= 0 ){return;}       
        
        	
		var moduleWidth               = textPageInstanceHolder.width();
		var moduleHeight              = textPageInstanceHolder.height();

        var galleryHolder       = jQuery("#portfolio-galleries-holder", textPageInstance);
        var thumbMarginRight    = parseInt(jQuery(".thumb-holder").css("margin-right"), 10);
        var thumbMarginBottom   = parseInt(jQuery(".thumb-holder").css("margin-bottom"), 10);
		//var thumbMarginRight    = 0;
        //var thumbMarginBottom	= 0;
        var thumbWidth          = jQuery(".thumb-holder").width();
        var thumbHeight         = jQuery(".thumb-holder").height();
        var containerWidth      = galleryHolder.width();
        var containerHeight     = galleryHolder.height();
        var visibleHeight       = textPageInstance.height();
        
		var gallery_width 		= jQuery("#portfolio-galleries-holder").width();
		var item_width			= jQuery("#portfolio-galleries-holder").children('.item:first').width();
		var numberColumns		= Math.round(gallery_width/item_width);
		//var numberColumns       = Math.round( containerWidth / ( thumbWidth + thumbMarginRight) );
        var numberLines         = Math.floor( visibleHeight / ( thumbHeight + thumbMarginBottom) + 1);
        var totalVisibleThumbs  = numberColumns * numberLines - 1;
        var windowH             = jQuery(window).height() + 50;
        var windowW             = jQuery(window).width();
        visibleGalleryH         = visibleHeight;
        galleryColumns          = numberColumns;
        galleryLines            = numberLines;
        galleryItemArr          = [];
        console.log('assad' + containerWidth+ 'sdf' + thumbWidth+ 'dsfdsf' + thumbMarginRight);
        galleryTopPos = 0;
        // setPreview();
		// storePreviewMedia();
        // addControlsListeners();

		
        if( windowW < 480 && galleryColumns > 2 ){ galleryColumns = 1;}
        
        if( touchDevice == 1 && windowW <= 320 && galleryColumns == 1){
            // var avScrollbar = getAvailableScrollbar();
            // textPageInstance.css("width", (thumbWidth + thumbMarginRight + avScrollbar.width()*0.5) );
            // var modCHold = jQuery(txt_modCont);
            // var value = Math.round(( windowW - jQuery(":first", modCHold).width() )  * 0.5 );
            // modCHold.css("left", value);            
        }
       
        //jQuery(".thumb-holder" + ":nth-child(" + galleryColumns + "n+" + galleryColumns + ")", galleryHolder).css("margin-right",  "0px");
       // moduleUpdate( textPageInstanceHolder, textPageInstance, jQuery("div:first", textPageInstance), sideType );
		textPageInstanceHolder.css("visibility", "visible");	
        var galleryItem         = jQuery("#portfolio-galleries-holder .thumb-holder", textPageInstance);
        var backgOverColor      = "#3f3f3f";
        var backgOutColor       = '#ffffff';//rgb2hex( galleryItem.css("background-color") );
        var text1BaseColor      = '#3f3f3f';//rgb2hex( jQuery(".thumb-tag p", galleryItem).css("color") );  
        if( touchDevice == 0 ){
		/*	galleryItem.hover(
				function(event){ 
						customHoverAnimation( "over", event, jQuery(this), jQuery("#thumb-image-hover", this) ); 
						var text = jQuery(".thumb-tag", this).find('h2');
						TweenMax.to( text, .6, { css:{ color: backgOutColor },  ease:Quad.easeOut });
						TweenMax.to( jQuery(this), .6, { css:{ backgroundColor: backgOverColor },  ease:Quad.easeOut });
					},
					function(event){ 
						customHoverAnimation( "out", event, jQuery(this), jQuery("#thumb-image-hover", this) ); 
						var text = jQuery(".thumb-tag", this).find('h2');
						TweenMax.to( text, .6, { css:{ color: text1BaseColor },  ease:Circ.easeOut });
						TweenMax.to( jQuery(this), .6, { css:{ backgroundColor: backgOutColor },  ease:Quad.easeOut });
			});
		*/
		}
		if(	touchDevice == 1 ){
			jQuery('<div id="hidden-fancy"></div>').hide().appendTo('body');
			galleryItem.each(function(index,value){
				jQuery(value).find('a.zoom-gallery').appendTo('#hidden-fancy');
			});
			galleryItem.find('.hover-default').hide();
			galleryItem.children('.thumbnail').each(function(_index,_value){
				jQuery(_value).live('click',
					function(event) {
						jQuery('#hidden-fancy > a.zoom-gallery').eq(_index).click();
						event.preventDefault();
						return false;

				});
			});
		}

        var childLength         = galleryHolder.children('.item').length - 1;
        totalVisibleThumbs      = ( childLength < totalVisibleThumbs ) ?  childLength : totalVisibleThumbs;
        galleryVisibleThumbs    = totalVisibleThumbs+1;
        var i = 0;
        var tempI = 0;
        var tempJ = 0;
        var onceD  = true;
        //galleryHolder.find(".thumb-holder").each(
		
		
		galleryHolder.find(".thumb-holder").each(
                function(){
					//alert(jQuery(this).html());
                    if( i > totalVisibleThumbs){
						jQuery(this).css("display", "none");
					}else{
						jQuery(this).css("top", windowH + "px");
						jQuery(this).parent().css("opacity", "1");
					}
                    galleryItemArr[ i ] = jQuery(this); 
                    i++;
                      
        });
        i         = 0
        var tempI = 0;
        var tempJ = 0;
        var onceD = true;
		
		console.log('totalVisibleThumbs' + totalVisibleThumbs);
		console.log('numberColumns' + numberColumns);

        galleryHolder.find(".thumb-holder").each(
                function(){
                    if( i <= totalVisibleThumbs ){
                        tempI = Math.floor( i / (numberColumns));
                        tempJ = (i - (tempI * (numberColumns))) * 0.15;
                        tempI = tempI * 0.1;
                        var delay = (0.1 )+ (tempJ) + (tempI);                        
                        if( i == totalVisibleThumbs ){TweenMax.to( jQuery(this), .6, { css:{ top:"0px" }, delay: delay,  ease:Circ.easeOut, onComplete: afterGalleryStartupAnimation, onCompleteParams:[ visibleHeight ] });}
                        else{TweenMax.to( jQuery(this), .6, { css:{ top:"0px" }, delay: delay,  ease:Circ.easeOut });}
                    } 
                    else{ return;}
                    i++;
        });
       return;      
	}
	
	
	
    function endModuleGallery( reverse ){
        var textPageInstanceHolder  = jQuery( txt_modCont);
        var textPageInstance        = jQuery( "#portfolio-galleries", textPageInstanceHolder);
        var galleryHolder           = jQuery("#portfolio-galleries-holder", textPageInstance);
        var thumbInstance           = jQuery(".thumb-holder", textPageInstance);
        var thumbHeight             = jQuery(".thumb-holder").height();
		
		
		var gallery_width 			= jQuery("#portfolio-galleries-holder").width();
		var item_width				= jQuery("#portfolio-galleries-holder").children('.item:first').width();
//		var thumbMarginRight    	= parseInt(jQuery(".thumb-holder").css("margin-right"), 10);
 //       var thumbWidth          	= jQuery(".thumb-holder").width();
//		var containerWidth      	= galleryHolder.width();
//		var galleryColumns			= Math.round( containerWidth / ( thumbWidth + thumbMarginRight) );
		var galleryColumns__		= Math.round(gallery_width/item_width);
		
		var containerPos            = parseInt(galleryHolder.css("top"), 10);
		containerPos = 0;
        var currLine                = Math.floor(Math.abs( containerPos / thumbHeight ));
		currLine = 0;
        var startNumber             = currLine * galleryColumns__;
        var endNumber               = startNumber + galleryVisibleThumbs;
        var windowH                 = jQuery(window).height() + 50; 
        var totalVisibleThumbs      = galleryColumns__ * galleryLines - 1;
        
        var childLength             = galleryHolder.children().length - 1;
        var currH                   = galleryHolder.height()
        var i = 0;
        var t                       = galleryItemArr.length;
//		console.log('width'+gallery_width);
//		console.log('width item_'+item_width);
//		console.log('soitem'+t);
		
        if( reverse == true ){
            totalVisibleThumbs      = ( childLength < totalVisibleThumbs ) ?  childLength : totalVisibleThumbs;
            
            while(t--){
                if( t >= totalVisibleThumbs){galleryItemArr[t].css("display", "none");}
                else{galleryItemArr[t].css("top", windowH + "px");}    
            }
        }
        else{             
           t = galleryItemArr.length;
           while(t--){
                if( t < startNumber || t >= endNumber ){ galleryItemArr[t].css("display", "none");}     
            }
        }
		
        if( currH > jQuery(window).height() ){ galleryHolder.css("top", "0px"); }
        i = 0;
        var j       = 0;
        var tempI   = 0;
        var tempJ   = 0;
        var onceD  = true;   
        if( reverse == true ){
            moduleEnd = true;
            galleryHolder.find(".thumb-holder").each(
                    function(){
                        if( i <= totalVisibleThumbs ){                            
                            tempI = Math.floor( i / (galleryColumns__));
                            tempJ = (i - (tempI * (galleryColumns__))) * 0.15;
                            tempI = tempI * 0.1;
                            var delay = (0.1 )+ (tempJ) + (tempI); 
                            TweenMax.killTweensOf( jQuery(this) );                       
                            if( i == totalVisibleThumbs ){TweenMax.to( jQuery(this), .6, { css:{ top:"0px" }, delay: delay,  ease:Circ.easeOut, onComplete: showOtherThumbs, onCompleteParams:[galleryHolder] });}
                            else{TweenMax.to( jQuery(this), .6, { css:{ top:"0px" }, delay: delay,  ease:Circ.easeOut });}
                        } 
                        else{ return;}
                        i++;
            });           
        }
        else {
            t = galleryItemArr.length;
            i = 0;
//			console.log('vao 2 ' + t);
//			console.log('start _ '+startNumber);
			startNumber = 0;
            while(t--){                  
                if(  t >= startNumber ){
					
                    tempI = Math.floor( i / (galleryColumns__));
                    tempJ = (i - (tempI * (galleryColumns__))) * 0.15;
                    tempI = tempI * 0.1;
                    var delay = (0.1 )+ (tempJ) + (tempI);          
                    if( t == startNumber && reverse == true){
						TweenMax.to( galleryItemArr[t], 0.8, { css:{ top: windowH + "px" }, delay: delay,  ease:Circ.easeInOut, onComplete: showOtherThumbs, onCompleteParams:[galleryHolder]});
					}else{
//						console.log(galleryItemArr[t]);
//						console.log(windowH);
//						console.log(tempJ + '____' + tempI);
//						console.log(delay);
						TweenMax.to( galleryItemArr[t], 0.8, { css:{ top: windowH + "px" }, delay: delay,  ease:Circ.easeInOut});
					}     
                    
                    if( onceD == true && jQuery("#dragger-holder").length > 0 ){
                        onceD = false;
                        TweenMax.to( jQuery("#dragger-holder"), 0.8, { css:{ top: windowH + "px" },  ease:Circ.easeInOut });
                    }
                    i++;
                }      
            } 
        }  
    }  	
	
	
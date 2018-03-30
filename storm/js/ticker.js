    tickerItems = new Array();
    count = new Array();
    tickerText = new Array();
    c = new Array();
    function type_ticker_create(id){    
    	var tickerLIs = jQuery(id+" .ticker li").children();          
    	tickerItems[id] = new Array();                              
    	tickerLIs.each(function(el) {                             
    		tickerItems[id].push( jQuery(this).html() );                
    	});                                                       
    	count[id] = 0  ;                                                 
    	rotateTicker(id);                                           
    }                                                           
    function rotateTicker(id){ 
    	if( count[id] == tickerItems[id].length ){                            
    	  count[id] = 0;                                                  
    	}                                                         
        tickerText[id] = tickerItems[id][count[id]];                           
    	c[id] = 0;
        if (!jQuery(id+" ul.ticker li:first").is(":hover")) {                                                    
        	typetext(id);
            count[id]++;                                              
        	setTimeout(function(){rotateTicker(id);}, 5000 );                    
        } else {
            setTimeout(function(){rotateTicker(id);}, 5000 );      
        }                                                    
    }                                                           
    var isInTag = false;                                        
    function typetext(id) {	   
    	var thisChar = tickerText[id].substr(c[id], 1);                   
    	if( thisChar == '<' ){ isInTag = true; }                  
    	if( thisChar == '>' ){ isInTag = false; }                 
    	jQuery(id+' .ticker li h2').html(tickerText[id].substr(0, c[id]++));   
    	if(c[id] < tickerText[id].length+1)                                     
    		if( isInTag ){                                                
    			typetext(id);                                                 
    		}else{ 
                if (!jQuery(id+" ul.ticker li:first").is(":hover"))	{setTimeout(function(){typetext(id);}, 35);} else {typetext(id);}                               
    		}                                                             
    	else {                                                          
    		c[id] = 1;                                                        
    		tickerText[id] = "";                                              
    	}	                                                              
    } 
    
    function scroll_ticker_create(id){
       	var scroll_ticker = function()
    	{
    		setTimeout(function(){
                if (!jQuery(id+" ul.ticker li:first").is(":hover")){
        			jQuery(id+" ul.ticker li:first").animate( {marginTop: '-50px'}, 800, function()
        			{
        				jQuery(this).detach().appendTo(id+" ul.ticker").removeAttr("style");	
        			});
                };
    			scroll_ticker();
    		}, 5000);
    	};
    	scroll_ticker();
    }
    jQuery.fn.liScroll = function(settings) {
    		settings = jQuery.extend({
    		travelocity: 0.07
    		}, settings);
    		return this.each(function(){
    			var $strip = jQuery(this);
    			$strip.addClass("newsticker")
    			var stripWidth = 1;
    			var $mask = $strip.wrap("<div class='mask'></div>");
    			var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");		
         						
    			var containerWidth = $strip.parent().parent().width();	//a.k.a. 'mask' width 	
    			
                $strip.find("li").each(function(i){
                    stripWidth += jQuery(this, i).outerWidth(true); // thanks to Michael Haszprunar and Fabien Volpi
                });
                
        		$strip.width(stripWidth);			
        		var totalTravel = stripWidth+containerWidth;
        		var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		
        		function scrollnews(spazio, tempo){
        		  $strip.animate({left: '-='+ spazio}, tempo, "linear", function(){$strip.css("left", containerWidth); scrollnews(totalTravel, defTiming);});
        		}
        		scrollnews(totalTravel, defTiming);				
        		$strip.hover(function(){
        		  jQuery(this).stop();
        		},
        		function(){
            		var offset = jQuery(this).offset();
            		var residualSpace = offset.left + stripWidth;
            		var residualTime = residualSpace/settings.travelocity;
            		scrollnews(residualSpace, residualTime);
       			});			
    		});	
    };
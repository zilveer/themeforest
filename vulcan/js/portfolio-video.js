(function($){
	function detectPortfolioVideo(){
		var flash_object = '<object style="z-index:0;" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="960" height="440"><param name="wmode" value="transparent" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="960" height="440" wmode="transparent"></embed></object>';
		var quicktime_object = '<object classid="clsid:02bf25d5-8c17-4b23-bc80-d3488abddc6b" codebase="http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0" height="440" width="960"><param name="src" value="{path}"><param name="autoplay" value="false"><param name="scale" value="tofit"><param name="type" value="video/quicktime"><embed src="{path}" scale="tofit" height="440" width="960" autoplay="false" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>';
		var toInject = "";
		
		var divWrapper = $('.portfolio_movie_container');
		var ObjectP = divWrapper.find('a');
		
		switch(ObjectP.attr('rel')){
		  
					case 'youtube':
						movie = 'http://www.youtube.com/v/'+igrab_param('v', ObjectP.attr('href'));
						toInject = flash_object.replace(/{path}/g,movie);
					break;
					
					case 'vimeo':
						movie_id = ObjectP.attr('href');
						movie = "http://vimeo.com/moogaloop.swf?clip_id="+ movie_id.replace('http://vimeo.com/','');
					  toInject = flash_object.replace(/{path}/g,movie);
					break;
					
          case 'flash':
						movie = ObjectP.attr('href');
						toInject = flash_object.replace(/{path}/g,movie);
					break;
					
					case 'quicktime':
						movie = ObjectP.attr('href');
						toInject = quicktime_object.replace(/{path}/g,movie);
					break;
		}
		
		divWrapper.html(toInject);
		
	function igrab_param(name,url){
	  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	  var regexS = "[\\?&]"+name+"=([^&#]*)";
	  var regex = new RegExp( regexS );
	  var results = regex.exec( url );
	  if( results == null )
	    return "";
	  else
	    return results[1];
	}	
	
  }
  $(document).ready(function(){detectPortfolioVideo();});
	
})(jQuery); 
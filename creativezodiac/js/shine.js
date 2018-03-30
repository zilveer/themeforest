var j = jQuery.noConflict();
var animating_thumbs = false;
j(document).ready(function(){
//////////////////////////////////////////////////////////////////////////////////
// BLOG SHINE
//////////////////////////////////////////////////////////////////////////////////
  // navigation shine
  j('.blog_menu_posts li').livequery(function(){  
    j(this) 
        .hover(function() { 
        if(freshsettings.prf_blognav != "true")
        {     
           j(this).find(".blog_menu_thumb_shine").stop();
           j(this).find(".blog_menu_thumb_shine").css("background-position","-99px 0"); 
           j(this).find(".blog_menu_thumb_shine").animate({backgroundPosition: '99px 0'},1000); 
         }
    }, function() { 
           
        }); 
    }, function() { 
      j(this) 
          .unbind('mouseover') 
          .unbind('mouseout'); 
  });
  
  //blogpost medium img 
  j('.blog_big_thumb').livequery(function(){  
    j(this) 
        .hover(function() {
        if(freshsettings.prf_blogmedium != "true")
        { 
              
         j(this).find(".blog_big_thumb_shine").stop();
         j(this).find(".blog_big_thumb_shine").css("background-position","-99px 0"); 
         j(this).find(".blog_big_thumb_shine").animate({backgroundPosition: '99px 0'},700);
         } 
    }, function() { 
           
        }); 
    }, function() { 
      j(this) 
          .unbind('mouseover') 
          .unbind('mouseout'); 
  });
  
});
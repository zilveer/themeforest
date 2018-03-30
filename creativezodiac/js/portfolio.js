var j = jQuery.noConflict();

freshwork.get_page("14-");

j(document).ready(function(){
var browser=navigator.appName;  
 if(browser == "Microsoft Internet Explorer") {browser = "ie";} 
  
  
  
   var is_video = false;
    //alert(browser);
    if(browser == "ie")
    {
      j(".big_image_hover_wrapper").css("display", "none");
    }
    else{
        j(".big_image_hover_wrapper").fadeTo(1,0);
    }
  j(".big_image_wrapper").hover(function(){
    if(browser == "ie")
    {
      j(".big_image_hover_wrapper").css("display", "block");
      j(".port_bigimg_play").css("display", "none");
    }
    else
    {
    
        
        j(".big_image_hover_wrapper").stop();
        j(".big_image_hover_wrapper").fadeTo(200,1);
      
     //  alert(j(".port_bigimg_play").css("display"));
         
        j(".port_bigimg_play").stop().fadeTo(200,0);
    }
  //      j(".big_image_border").fadeTo(300,0);
 //  j(".big_image_hover_wrapper").css("display","block");//alert("pica");
  // j(".big_image_border").css("background-image","url(gfx/port_border_hover.png)");
  },function(){
      if(browser == "ie")
        {
              if( j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name") == "video")
              {
                j(".port_bigimg_play").css("display", "block");
              }
               j(".big_image_hover_wrapper").css("display", "none");
        }
        else
        {
              j(".big_image_hover_wrapper").stop();
                 freshwork.actual_page=j.address.pathNames();
               //  j(".big_image_border").fadeTo(300,1);
              if( j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name") == "video")
              {
                j(".port_bigimg_play").stop().fadeTo(200,1);
              }
                      j(".big_image_hover_wrapper").fadeTo(200,0);
                       
               //       if()
               //  j(".big_image_hover_wrapper").css("display","none");
               //  j(".big_image_border").css("background-image","");
         }
  } );
 
}); 
var j = jQuery.noConflict();
var animating_thumbs = false;



j(document).ready(function(){
   if(freshsettings.landing_check == "true" && actual_location.indexOf("/#/") == -1) { window.location = freshsettings.landing_link; }

  var navigation_el = j("#navigation ul li").length - 1;
  for(var i = 0; i <= navigation_el; i++)
  {
    var to_preload = j("#navigation ul li:eq("+i+")").find("a").attr("href");
    var start_index = to_preload.indexOf("/#/") + 3;
    var end_index = to_preload.indexOf("/", start_index);
    freshwork.get_page(to_preload.substring(start_index, end_index) );
  }
  
  for(var i = 0; i <6; i++)
  {
    j("#gallery-template-0").find(".thumb_shine:eq("+ i +")").attr("rel", (i+1));
    j("#gallery-template-1").find(".thumb_shine:eq("+ i +")").attr("rel", (i+1));
  }


 if( navigator.userAgent.toLowerCase().indexOf('chrome') > -1)
    {
    
      j(this).find(".comments_number").stop().animate({top: 20}, 200);
    }
  if(navigator.userAgent.toLowerCase().indexOf('opera') > -1)
  {
       j(this).find(".comments_number").stop().animate({top: 22}, 200);
  }
var browser=navigator.appName;
if(browser == "Microsoft Internet Explorer") {browser = "ie"; freshwork.br = "ie"; j(".icon_desc").css("display", "none");}

//////////////////////////////////////////
// PRELOADING
//////////////////////////////////////////

/////////////////////////////////////////
j(".left_button_hover").disableTextSelect();
j(".center_button_zoom_image_hover").disableTextSelect();
j(".center_button_play_video_hover").disableTextSelect();
j(".right_button_hover").disableTextSelect();

 //jewbox (13:47:00 15/03/2010)
j(".center_button_play_video_hover").disableTextSelect();

 //jewbox (14:26:40 15/03/2010)
j(".blog_left_column").disableTextSelect();
j(".big_image_hover_buttons").disableTextSelect();
j(".portfolio_right").disableTextSelect();




var speed = 300;
var change_speed = 300;
var is_home = true;
var portfolio_name = "gallery-template";
var actual_page = "2-about";
var click_change = "";
var load_page = "";
var gallery_page="";
var gallery_items = 0;
var gallery_content = [];
var gallery_actual_page = 1;
var gallery_actual_page_name = "";
var link_param = "undefined";
var actual_page_name = "";
function change_to_content()
{

  if(is_home == true && freshsettings.landing_check != "true")
  {
    if(browser=="ie")
    {
         j(".introbox_about_shadow").css("display","none");
         j(".introbox_works_shadow").css("display","none");
         j(".introbox_contact_shadow").css("display","none");
           j("#content_bg").animate({ 
         top:-375
      
         }, speed   );
         j(".introbox_holder").animate({ 
         top:430
         //opacity:0
         }, speed, function() {j(".introbox_holder").css("display", "none"); j("#content_bg").css("top",0); });
             
         j("#content_bg").css("display","block");
         j("#content_bg").css("left",0);
         j("#content_bg").css("top",0);
       
         j("#content").animate({ 
         height:426,
         width:600,
         left:0
         }, speed   );
    }
    else
    {
           j(".introbox_about_shadow").css("display","none");
           j(".introbox_works_shadow").css("display","none");
           j(".introbox_contact_shadow").css("display","none");
           j(".introbox_holder").animate({ 
           top:430,
           opacity:0
           }, speed   );
               
           j("#content_bg").css("display","block");
           j("#content_bg").css("left",0);
           j("#content_bg").css("top",0);
           j("#content_bg").animate({ 
           top:-375
         //  opacity:1
           }, speed, function() {j(".introbox_holder").css("display", "none"); j("#content_bg").css("top",0);}   );
           j("#content").animate({ 
           height:426,
           width:600,
           left:0
           }, speed   );
    }
  //alert("pica");

   is_home = false; 

  // click_change ="2-about";
 //  change_to_page("2-about"); 	
  }
  else if(is_home == true && freshsettings.landing_check == "true")
  {
      j("#content_bg").css("top",0);
      j(".introbox_holder").css("display", "none");
      j("#content").css("width",600);
      j("#content").css("height",426);
      is_home = false;
  }
}
function change_to_home()
{
  if(is_home == false && freshsettings.landing_check != "true")
  {
    j(".introbox_holder").css("display", "block");
    j("#content_bg").css("top", -375);
    if(browser=="ie")
    {
      j(".introbox_about_shadow").css("display","block");
      j(".introbox_works_shadow").css("display","block");
      j(".introbox_contact_shadow").css("display","block");
      
       j("#content_bg").animate({ 
    		top:200
    	//	opacity:1
    	}, speed   );
      
      j("#content").animate({ 
    	  height:375,
    	  width:614
    	}, speed   );
       j(".introbox_holder").animate({ 
    		top:0
    //		opacity:1
    	}, speed   );  	  
      // alert("pica");
    }
    else
    {
      j(".introbox_about_shadow").css("display","block");
      j(".introbox_works_shadow").css("display","block");
      j(".introbox_contact_shadow").css("display","block");
      
       j("#content_bg").animate({ 
    		top:200,
    		opacity:1
    	}, speed   );
      
      j("#content").animate({ 
    	  height:375,
    	  width:614
    	}, speed   );
       j(".introbox_holder").animate({ 
    		top:0,
    		opacity:1
    	}, speed   );  	  
      // alert("pica");
    }
    is_home = true;
 }
 else if (is_home == false && freshsettings.landing_check == "true")
 {
 //alert(freshsettings.landing_link);
    document.location = freshsettings.landing_link; 
    is_home = true;
 }
}

j("#navigation ul li").hover(function(){
   j(this).addClass("active");
},function(){
   j("#navigation ul li[rel!=selected]").removeClass("active");
} );

j("#submit").livequery('click',function () {
//var link = j.address.parameter("link");
var comment_author = j(this).parent().parent().find(".author_input").attr("value");
var comment_website = j(this).parent().parent().find(".url_input").attr("value");
var comment_comment = j(this).parent().parent().find(".comment_input").attr("value");
var comment_email = j(this).parent().parent().find(".email_input").attr("value");
var comment_id = j(this).parent().parent().find(".id_input").attr("value"); 
var go = 1;
  //alert(comment_author);
if(comment_author == "")
{
   // alert("kokot");
     j(this).parent().parent().find(".author_input").stop()
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "0px" }, 100);
     go = 0;
}
 var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;

if(comment_email == "" || !filter.test(comment_email))
{
   // alert("kokot");
     j(this).parent().parent().find(".email_input").stop()
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "0px" }, 100);
     go = 0;
}

if(comment_comment == "")
{
   // alert("kokot");
     j(this).parent().parent().find(".comment_input").stop()
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "0px" }, 100);
     go = 0;
}
if(go == 1)
{
var comment_link = "&autor="+comment_author+
                    "&website="+comment_website+
                    "&comment="+comment_comment+
                    "&email="+comment_email;
//alert(freshwork.get_address +"?blogpost=comments-send"+comment_link+"&post_link="+  j.address.parameter("link")); 
//alert("pica");

//alert(j("#email").attr("value"));
 //alert("pica");
  j("#comments_page-"+freshwork.blog_id)[0].scrollTo(0);
   j("#comments_page-"+freshwork.blog_id).html("<div class=\"loader_wrapper\" style=\"display: block; left: 130px; top: 95px;\"><img class=\"loader\" src=\""+ freshsettings.template_url + "/gfx/loader.gif\"></div>")
   j("#comments_page-"+freshwork.blog_id).find(".loader_wrapper").css("left", 110);
   j("#comments_page-"+freshwork.blog_id).find(".loader_wrapper").css("top", 73);  
//   alert(comment_id);
    j.get(freshwork.get_address +"?blogpost=comments-send"+comment_link+"&post_link="+  comment_id, function(data, text){
      j("#comments_page-"+freshwork.blog_id).html(freshwork.parse_attribute("comment-source",data));
      j("#comments_page-"+freshwork.blog_id).jScrollPane({showArrows:true});
      
     // var newcmnt = parseInt(j("#blog-template-"+freshwork.blog_id).find(".comments_number").html());
    //  alert(newcmnt);
  //    newcmnt++;
  //alert(freshblog.actual_com_number);
  freshblog.actual_com_number++;
      j("#blog-template-"+freshwork.blog_id).find(".comments_number").html(freshblog.actual_com_number); 
      Cufon.replace('.comments_number');
      Cufon.replace('h3, .go_btn_wrapper', { fontFamily: 'Myriad Pro Bold' });
   });
}
});

////////////////////////////////////////////////
// change_page
// attr: new_page_name - name of the page to change
////////////////////////////////////////////////
var visible = "";
var blog_actual_id = 10;

j(".blog_menu_categories li").livequery('click',function () {

j(".arrow_left").css("display", "block");
j(".right_column_blur_left").css("cursor", "pointer");
visible = "#bloglist-"+j(this).find("a").attr("rel");


//j("#blog-template-"+freshwork.blog_id).css("display", "none");
//alert("#bloglist-"+j(this).find("a").attr("rel"));
//235
///alert( freshwork.blog_id);
//alert(j(".blog-list-"+j(this).find("a").attr("rel")).parent().attr("name"));
j("#bloglist-"+j(this).find("a").attr("rel")).css("display", "block");
var blog_height = j("#bloglist-"+j(this).find("a").attr("rel")).height();
//if(browser=="ie")
//{
  
//}
//alert(j("#bloglist-"+j(this).find("a").attr("rel")).height());
//var blog_height = j("#bloglist-"+j(this).find("a").attr("rel")).css("height");
//var px_index  = blog_height.indexOf("px");
//blog_height = blog_height.substring(0, px_index);
//alert( j("#bloglist-"+j(this).find("a").attr("rel")).css("height"));
//j("#bloglist-"+j(this).find("a").attr("rel")).css("display", "none");
if ( blog_height > 235)
{
 j(".right_column_blur_top").css("cursor", "pointer");
  j(".right_column_blur_bottom").css("cursor", "pointer");
 j(".arrow_bottom").css("display","block");
 j(".arrow_top").css("display","block");
}
else
{
 j(".right_column_blur_top").css("cursor", "default");
 j(".right_column_blur_bottom").css("cursor", "default");
 j(".arrow_bottom").css("display","none");
 j(".arrow_top").css("display","none");

}
j(".ul.blog_menu_posts").css("display","none");
//j("#bloglist-"+j(this).find("a").attr("rel")).css("display", "block");
j("#bloglist-"+j(this).find("a").attr("rel")).animate({left:0}, {duration:change_speed, easing:'jswing'});
j(".blog_menu_categories").animate({left:-218}, {duration:change_speed, easing:'jswing'});
});

j(".right_column_blur_left").click(function(){ 
  var blog_height = j(".blog_menu_categories").height();
//var px_index  = blog_height.indexOf("px");
//blog_height = blog_height.substring(0, px_index);
j(".arrow_left").css("display", "none");
j(".right_column_blur_left").css("cursor", "default");
if ( blog_height > 235)
{
 j(".right_column_blur_top").css("cursor", "pointer");
  j(".right_column_blur_bottom").css("cursor", "pointer");
 j(".arrow_bottom").css("display","block");
 j(".arrow_top").css("display","block");
}
else
{
 j(".right_column_blur_top").css("cursor", "default");
 j(".right_column_blur_bottom").css("cursor", "default");
 j(".arrow_bottom").css("display","none");
 j(".arrow_top").css("display","none");

}


//   alert(j(".blog_menu_categories").css("height"));
 j(visible).animate({left:218}, {duration:change_speed, easing:'jswing'});
 j(".blog_menu_categories").animate({left:0}, {duration:change_speed, easing:'jswing'});
 j(".arrow_left").css("display", "none");
});

j('.blog_menu_posts li').livequery('click', function () {
  var new_address_to_change = j(this).find(".blog_menu_post_title").attr("href");
  location.replace(new_address_to_change);
  // j(".jScrollPaneContainer").css("display","block");
});

 var scroll_per_100 = 500;
j(".right_column_blur_top").mousedown(function(){
  
 var actual_top = j(visible).css("top");

 var px_index  = actual_top.indexOf("px");
 actual_top = parseInt(actual_top.substring(0, px_index));
 
 var actual_height =  j(visible).height();
// px_index  = actual_height.indexOf("px");
// actual_height = parseInt(actual_height.substring(0, px_index));
 
 var animation_time = (((actual_height - 235 ) - actual_top) / 100) * scroll_per_100;
 j(visible).animate({top:35}, {duration:animation_time, easing:'jswing'});
});
j(".right_column_blur_top").mouseup(function(){
j(visible).stop(); 
});

j(".right_column_blur_bottom").mousedown(function(){
  
 var actual_top = j(visible).css("top");

 var px_index  = actual_top.indexOf("px");
 actual_top = parseInt(actual_top.substring(0, px_index));
 
 var actual_height =  j(visible).height();
 //px_index  = actual_height.indexOf("px");
 //actual_height = parseInt(actual_height.substring(0, px_index));
 
 var animation_time = (((actual_height - 235 ) + actual_top) / 100) * scroll_per_100;
 j(visible).animate({top:(actual_height*-1)+270}, {duration:animation_time, easing:'jswing'});
});
j(".right_column_blur_bottom").mouseup(function(){
j(visible).stop(); 
});

    /*
j(".right_column_blur_bottom").click(function(){
 // alert(visible);
 
 
 var actual_top = j(visible).css("top");

 var px_index  = actual_top.indexOf("px");
actual_top = actual_top.substring(0, px_index);
 actual_top = parseInt(actual_top) - 10;
// alert(actual_top);
  j(visible).css("top",actual_top);
 //j(".blog_menu").css("display", "none");
});      */


j('.blog_menu')
        .bind('mousewheel', function(event, delta) {
            var dir = delta > 0 ? 1 : -1;
         //   alert(Math.abs(event.wheelDelta));
                var pica = delta;
              //  alert(pica);
                 var actual_top = j(visible).css("top");
                 var px_index  = actual_top.indexOf("px");
                actual_top = parseInt(actual_top.substring(0, px_index));
                
                var actual_height = j(visible).height();
               //  var px_index  = actual_height.indexOf("px");
                //actual_height = parseInt(actual_height.substring(0, px_index));
      //          alert(actual_height + "ss"+ actual_top);
          //       alert (actual_top +" "+ (actual_height - 235)*-1);
          //alert((actual_top + 15) < 35);
        //  alert("kokot "+ actual_top);
                if(dir == 1 && actual_top < 35)
                {
                  if((actual_top + 15) < 35){j(visible).css("top", actual_top+15);}
                  else{ j(visible).css("top", 35);}
                //                                   j(visible).css("top", 35);
                  //                                 alert(actual_top);
              //    alert("top");                                
                }
                else if((actual_top > (actual_height - 270)*-1) && dir ==-1)
                {
                  if((actual_top-15) > (actual_height - 270)*-1){
                   j(visible).css("top", actual_top-15);}
                   else
                   { j(visible).css("top",  (actual_height - 270 + actual_top)*-1 + actual_top)}
                }
          //  alert(dir + ' at a velocity of ' + vel);
            return false;
        });

j(".right_column_blur_top").hover(function (){
 j(".arrow_top").addClass("arrow_top_hover");
},function(){
  j(".arrow_top").removeClass("arrow_top_hover");
});
j(".right_column_blur_bottom").hover(function (){
 j(".arrow_bottom").addClass("arrow_bottom_hover");
},function(){
  j(".arrow_bottom").removeClass("arrow_bottom_hover");
});

j(".blog_menu_post").livequery('click', function () {

});

j(".right_column_blur_left").hover(function (){
 j(".arrow_left").addClass("arrow_left_hover");
},function(){
  j(".arrow_left").removeClass("arrow_left_hover");
});

j(".blog_menu_post").livequery('click', function () {
 
});

j(".left_button_wrapper").hover(function (){
j(this).find(".left_button").addClass("left_button_hover");
}, function(){
 j(this).find(".left_button").removeClass("left_button_hover");
} );

j(".right_button_wrapper").hover(function (){
j(this).find(".right_button").addClass("right_button_hover");
}, function(){
 j(this).find(".right_button").removeClass("right_button_hover");
} );

j(".center_button_wrapper").hover(function (){
if(j(this).attr("name") == "video")
{j(this).find(".center_button_play_video").addClass("center_button_play_video_hover");}
else
{j(this).find(".center_button_zoom_image").addClass("center_button_zoom_image_hover");}

}, function(){
 j(this).find(".center_button_play_video").removeClass("center_button_play_video_hover");
  j(this).find(".center_button_zoom_image").removeClass("center_button_zoom_image_hover");
} );

//j('body').disableTextSelect();


function hideAllBlog()
{
  freshblog.iscomment = 0;
  j(".jScrollPaneContainer").css("display","none");
  j("#blog_post-0").css("display", "none");
 j("#blog_post-1").css("display", "none");
 j("#comments_page-0").css("display", "none");
 j("#comments_page-1").css("display", "none");
  j("#gallery_page-0").css("display", "none");
 j("#gallery_page-1").css("display", "none");
  j("#share_page-1").css("display", "none");
  j("#share-page-0").css("display", "none");
  
    j("#search_page-1").css("display", "none");
  j("#search_page-0").css("display", "none");
 
 j("#blog_post-0").css("z-index", "1");
 j("#blog_post-1").css("z-index", "1");
 j("#comments_page-0").css("z-index", "1");
 j("#comments_page-1").css("z-index", "1");
  j("#gallery_page-0").css("z-index", "1");
 j("#gallery_page-1").css("z-index", "1");
 j("#share_page-0").css("z-index", "1");
 j("#share_page-1").css("z-index", "1"); 
 
 j("#search_page-0").css("z-index", "1");
 j("#search_page-1").css("z-index", "1"); 
   
}
//search_result_img
//search_result_h1  
// blog_menu_posts li 
//.icon_comments [16;11]
//.icon_wrapper .icon_desc [48;38]
if(browser=="ie")
{
   j(".icon_desc").css("display","none");
}
else
{
 j(".icon_desc").fadeTo(0,0);
}

j('.icon_wrapper_search').hover(function(){
  if(browser == "ie")
  {
          
      j(this).find(".icon_search").stop().animate({top: 11}, 200);
 
    j(this).find(".icon_desc").stop().animate({top: 38}, 200);
    j(this).find(".icon_desc").css("display", "block");
  }
  else
  {
      j(this).find(".icon_search").stop().animate({top: 11}, 200);
 
    j(this).find(".icon_desc").stop().animate({top: 38, opacity:1}, 200);
  
  }
  //   .icon_article [19;14]
   //  .icon_wrapper .icon_desc [48;38]
}, function (){
    if(browser == "ie")
    {
      j(this).find(".icon_search").stop().animate({top: 16}, 200);
   
      j(this).find(".icon_desc").stop().animate({top: 48}, function() {j(this).css("display","none");});
      
    }
    else
    {
    j(this).find(".icon_search").stop().animate({top: 16}, 200);
 
    j(this).find(".icon_desc").stop().animate({top: 48, opacity:0}, 200);
    }
} );

j('.icon_wrapper_share').hover(function(){
      if(browser == "ie")
  {
            
        j(this).find(".icon_share").stop().animate({top: 11}, 200);
   
      j(this).find(".icon_desc").stop().animate({top: 39}, 200);
      j(this).find(".icon_desc").css("display", "block");
  }
  else
  {
    j(this).find(".icon_share").stop().animate({top: 11}, 200);
 
    j(this).find(".icon_desc").stop().animate({top: 39, opacity:1}, 200);
  }
  //   .icon_article [19;14]
   //  .icon_wrapper .icon_desc [48;38]
}, function (){
        if(browser == "ie")
  {
            
        j(this).find(".icon_share").stop().animate({top: 16}, 200);
   
        j(this).find(".icon_desc").stop().animate({top: 48}, function() {j(this).css("display","none");});
  }
  else
  {
    j(this).find(".icon_share").stop().animate({top: 16}, 200);
 
    j(this).find(".icon_desc").stop().animate({top: 48, opacity:0}, 200);
    }
} );


j('.icon_wrapper_gallery').hover(function(){
        if(browser == "ie")
  {
            
        j(this).find(".icon_gallery").stop().animate({top: 12}, 200);
   
      j(this).find(".icon_desc").stop().animate({top: 38}, 200);
      j(this).find(".icon_desc").css("display", "block");
  }
  else
  {
    j(this).find(".icon_gallery").stop().animate({top: 12}, 200);
 
    j(this).find(".icon_desc").stop().animate({top: 38, opacity:1}, 200);
    }
  //   .icon_article [19;14]
   //  .icon_wrapper .icon_desc [48;38]
}, function (){  
          if(browser == "ie")
  {
            
        j(this).find(".icon_gallery").stop().animate({top: 17}, 200);
   
        j(this).find(".icon_desc").stop().animate({top: 48}, function() {j(this).css("display","none");});
  }
  else
  {
    j(this).find(".icon_gallery").stop().animate({top: 17}, 200);
 
    j(this).find(".icon_desc").stop().animate({top: 48, opacity:0}, 200);
  }
} );

j('.icon_wrapper_comments').hover(function(){
          if(browser == "ie")
  {
            
     j(this).find(".icon_comments").stop().animate({top: 11}, 200);
    j(this).find(".comments_number").stop().animate({top: 16}, 200);
   
      j(this).find(".icon_desc").stop().animate({top: 38}, 200);
      j(this).find(".icon_desc").css("display", "block");
  }
  else
  {
    j(this).find(".icon_comments").stop().animate({top: 11}, 200);
    
    if( navigator.userAgent.toLowerCase().indexOf('chrome') > -1 )
    {
      j(this).find(".comments_number").stop().animate({top: 15}, 200);
    }
    else if(navigator.userAgent.toLowerCase().indexOf('opera') > -1)
    {
       j(this).find(".comments_number").stop().animate({top: 17}, 200);
    }
    else
    {
      j(this).find(".comments_number").stop().animate({top: 16}, 200);
    }
    j(this).find(".icon_desc").stop().animate({top: 38, opacity:1}, 200);
  }
  //   .icon_article [19;14]
   //  .icon_wrapper .icon_desc [48;38]
}, function (){
             if(browser == "ie")
  {
            
       j(this).find(".icon_comments").stop().animate({top: 16}, 200);
        j(this).find(".comments_number").stop().animate({top: 21}, 200);
         j(this).find(".icon_desc").stop().animate({top: 48}, function() {j(this).css("display","none");});
  }
  else
  {
    j(this).find(".icon_comments").stop().animate({top: 16}, 200);
    if( navigator.userAgent.toLowerCase().indexOf('chrome') > -1 )
    {
      j(this).find(".comments_number").stop().animate({top: 20}, 200);
    }
    else if(navigator.userAgent.toLowerCase().indexOf('opera') > -1)
    {
       j(this).find(".comments_number").stop().animate({top: 22}, 200);
    }
    else
    {
      j(this).find(".comments_number").stop().animate({top: 21}, 200);
    }
    j(this).find(".icon_desc").stop().animate({top: 48, opacity:0}, 200);
    }
} );

j('.icon_wrapper_article').hover(function(){
            if(browser == "ie")
  {
            
      j(this).find(".icon_article").stop().animate({top: 14}, 200);
      j(this).find(".icon_desc").stop().animate({top: 38}, 200);
      j(this).find(".icon_desc").css("display", "block");
  }
  else
  {
    j(this).find(".icon_article").stop().animate({top: 14}, 200);
    j(this).find(".icon_desc").stop().animate({top: 38, opacity:1}, 200);
    }
  //   .icon_article [19;14]
   //  .icon_wrapper .icon_desc [48;38]
}, function (){
               if(browser == "ie")
  {
            
      j(this).find(".icon_article").stop().animate({top: 19}, 200);
      j(this).find(".icon_desc").stop().animate({top: 48}, function() {j(this).css("display","none");});
  }
  else
  {
    j(this).find(".icon_article").stop().animate({top: 19}, 200);
    j(this).find(".icon_desc").stop().animate({top: 48, opacity:0}, 200);
    }
} );

j('.icon_wrapper').hover(function(){
  if( j(this).attr("rel") !="selected" )
  {
  if(browser == "ie")
  {
    j(this).find(".icon_wrapper_bg").css("display","block");
  }
  else
  {
    j(this).find(".icon_wrapper_bg").stop()
    j(this).find(".icon_wrapper_bg").fadeTo(0,0);
    j(this).find(".icon_wrapper_bg").css("display","block");
    j(this).find(".icon_wrapper_bg").fadeTo(200,1);
  }
  }
}, function (){
  if( j(this).attr("rel") !="selected" )
  {
          if(browser == "ie")
      {
        j(this).find(".icon_wrapper_bg").css("display","none");
      }
      else
      {
        j(this).find(".icon_wrapper_bg").stop()
        j(this).find(".icon_wrapper_bg").fadeTo(200,0);
      }
  }
} );

j('.icon_wrapper').click(function(){
j('.icon_wrapper').attr("rel","");
j(this).attr("rel","selected");
j(".icon_wrapper[rel!=selected]").find(".icon_wrapper_bg").stop()
if(browser=="ie")
{
  j(".icon_wrapper[rel!=selected]").find(".icon_wrapper_bg").css("display", "none");
}
else
{
j(".icon_wrapper[rel!=selected]").find(".icon_wrapper_bg").fadeTo(200,0);
}
//alert("pica");
});

j('.blog_search_big_thumb').livequery(function(){  
        j(this) 
            .hover(function() { 
         
              j(this).find(".blog_search_big_thumb_shine").stop();
                j(this).find(".blog_search_big_thumb_shine").css("background-position","-99px 0");
                 
         
                j(this).find(".blog_search_big_thumb_shine").animate({backgroundPosition: '99px 0'},700,function(){j(this).parent().attr("name", ""); }); 
                 }, function() { 
               
            }); 
    }, function() { 
        
        j(this) 
            .unbind('mouseover') 
            .unbind('mouseout'); 
});

    j('.search_result_h1').livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        j(this) 
            .hover(function() { 
             //.blog_gallery_big_thumb_shine
              j(this).parent().parent().find(".blog_search_big_thumb_shine").stop();
                j(this).parent().parent().find(".blog_search_big_thumb_shine").css("background-position","-99px 0");
                 
           // alert("pica");   
                j(this).parent().parent().find(".blog_search_big_thumb_shine").animate({backgroundPosition: '99px 0'},700,function(){j(this).parent().attr("name", ""); }); 
                 }, function() { 
                //$(this).removeClass('hover'); 
            }); 
    }, function() { 
        // unbind the mouseover and mouseout events 
        j(this) 
          //  .unbind('mouseover') 
          //  .unbind('mouseout'); 
    });
/*
   j('.blog_gallery_link') 
    .livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        j(this) 
            .hover(function() { 
             //.blog_gallery_big_thumb_shine
              j(this).find(".blog_gallery_big_thumb_shine").stop();
                j(this).find(".blog_gallery_big_thumb_shine").css("background-position","-99px 0");
                 
               
                j(this).find(".blog_gallery_big_thumb_shine").animate({backgroundPosition: '99px 0'},700,function(){j(this).parent().attr("name", ""); }); 
                 }, function() { 
                //$(this).removeClass('hover'); 
            }); 
    }, function() { 
        // unbind the mouseover and mouseout events 
        j(this) 
            .unbind('mouseover') 
            .unbind('mouseout'); 
    });
*/


j('#search-input-0').keypress(function(event) {
     if(event.keyCode == 13){
       j("#search_page-0")[0].scrollTo(0);
   j("#search_page-0").find(".blog_search_results_wrapper").html("<div class=\"loader_wrapper\" style=\"display: block; left: 130px; top: 95px;\"><img class=\"loader\" src=\""+ freshsettings.template_url + "/gfx/loader.gif\"></div>")
  j("#search_page-0").find(".blog_search_results_wrapper").find(".loader_wrapper").css("left", 110);
   j("#search_page-0").find(".blog_search_results_wrapper").find(".loader_wrapper").css("top", 73);
       
      var search_value = j(this).attr("value");
//alert(j.address.pathNames());
j.get(freshwork.get_address +"?blogpost=search&blog_link="+j.address.pathNames()+"&searchthing="+ search_value, function(data, text){

 
j("#search_page-0").find(".blog_search_results_wrapper").html(data); 
j("#search_page-0").jScrollPane({showArrows:true});
 Cufon.replace('.blog_search_result_meta_data, h1', { fontFamily: 'Myriad Pro Bold' });
});

     };
   });

j('#search-input-1').keypress(function(event) {
     if(event.keyCode == 13){  
           j("#search_page-1")[0].scrollTo(0);
   j("#search_page-1").find(".blog_search_results_wrapper").html("<div class=\"loader_wrapper\" style=\"display: block; left: 130px; top: 95px;\"><img class=\"loader\" src=\""+ freshsettings.template_url + "/gfx/loader.gif\"></div>")
  j("#search_page-1").find(".blog_search_results_wrapper").find(".loader_wrapper").css("left", 110);
   j("#search_page-1").find(".blog_search_results_wrapper").find(".loader_wrapper").css("top", 73);
    
      var search_value = j(this).attr("value");
//alert(j.address.pathNames());
j.get(freshwork.get_address +"?blogpost=search&blog_link="+j.address.pathNames()+"&searchthing="+ search_value, function(data, text){

 
j("#search_page-1").find(".blog_search_results_wrapper").html(data); 
j("#search_page-1").jScrollPane({showArrows:true});
 Cufon.replace('.blog_search_result_meta_data, h1', { fontFamily: 'Myriad Pro Bold' });
});

     };
   });

j("#blog-search-submit-0").click(function(){
      j("#search_page-0")[0].scrollTo(0);
   j("#search_page-0").find(".blog_search_results_wrapper").html("<div class=\"loader_wrapper\" style=\"display: block; left: 130px; top: 95px;\"><img class=\"loader\" src=\""+ freshsettings.template_url + "/gfx/loader.gif\"></div>")
  j("#search_page-0").find(".blog_search_results_wrapper").find(".loader_wrapper").css("left", 110);
   j("#search_page-0").find(".blog_search_results_wrapper").find(".loader_wrapper").css("top", 73);
    
 var search_value = j(this).parent().find(".search_input").attr("value");
//alert(j.address.pathNames());
j.get(freshwork.get_address +"?blogpost=search&blog_link="+j.address.pathNames()+"&searchthing="+ search_value, function(data, text){

 
j("#search_page-0").find(".blog_search_results_wrapper").html(data); 
j("#search_page-0").jScrollPane({showArrows:true});
 Cufon.replace('.blog_search_result_meta_data, h1', { fontFamily: 'Myriad Pro Bold' });
});


});

j("#blog-search-submit-1").click(function(){
//alert("pica");
           j("#search_page-1")[0].scrollTo(0);
   j("#search_page-1").find(".blog_search_results_wrapper").html("<div class=\"loader_wrapper\" style=\"display: block; left: 130px; top: 95px;\"><img class=\"loader\" src=\""+ freshsettings.template_url + "/gfx/loader.gif\"></div>")
  j("#search_page-1").find(".blog_search_results_wrapper").find(".loader_wrapper").css("left", 110);
   j("#search_page-1").find(".blog_search_results_wrapper").find(".loader_wrapper").css("top", 73);
    
 var search_value = j(this).parent().find(".search_input").attr("value");
j.get(freshwork.get_address +"?blogpost=search&blog_link="+j.address.pathNames()+"&searchthing="+ search_value, function(data, text){

 
j("#search_page-1").find(".blog_search_results_wrapper").html(data);
j("#search_page-1").jScrollPane({showArrows:true});
 Cufon.replace('.blog_search_result_meta_data, h1', { fontFamily: 'Myriad Pro Bold' });
});

});

   j('.blog_gallery_link') 
    .livequery(function(){ 
    // use the helper function hover to bind a mouseover and mouseout event 
        j(this) 
            .hover(function() {
            if(freshsettings.prf_blogmedium !="true")
            { 
             //.blog_gallery_big_thumb_shine
              j(this).find(".blog_gallery_big_thumb_shine").stop();
                j(this).find(".blog_gallery_big_thumb_shine").css("background-position","-99px 0");
                 
               
                j(this).find(".blog_gallery_big_thumb_shine").animate({backgroundPosition: '99px 0'},700,function(){j(this).parent().attr("name", ""); });
                } 
                 }, function() { 
                //$(this).removeClass('hover'); 
            }); 
    }, function() { 
        // unbind the mouseover and mouseout events 
        j(this) 
            .unbind('mouseover') 
            .unbind('mouseout'); 
    });
j("#search_switch-0").click(function(){
  hideAllBlog();
 // j(".jScrollPaneContainer").css("display","none").fadeTo(0,0);
  j("#search_page-0").css("display", "block");
  j("#search_page-0").parent().css("display","block");
 // j("#search_page-0").parent().fadeTo(200,1);
  j("#search_page-0").css("z-index", "999");
  j("#search_page-0").jScrollPane({showArrows:true});
  /* j("#comments_page-0").fadeTo(0,0).css("display", "block");
   j("#comments_page-0").parent().css("display", "block");
   j("#blog_post-0").fadeTo(200,0);
   j("#comments_page-0").fadeTo(200,1);*/
});

j("#search_switch-1").click(function(){
  hideAllBlog();
 // j(".jScrollPaneContainer").css("display","none").fadeTo(0,0);
  j("#search_page-1").css("display", "block");
  j("#search_page-1").parent().css("display","block");
  //j("#search_page-1").parent().fadeTo(200,1);
  j("#search_page-1").css("z-index", "999");
  j("#search_page-1").jScrollPane({showArrows:true});
  /* j("#comments_page-0").fadeTo(0,0).css("display", "block");
   j("#comments_page-0").parent().css("display", "block");
   j("#blog_post-0").fadeTo(200,0);
   j("#comments_page-0").fadeTo(200,1);*/
});    
    
j("#share_switch-0").click(function(){
  hideAllBlog();
 // j(".jScrollPaneContainer").css("display","none").fadeTo(0,0);
  j("#share_page-0").css("display", "block");
  j("#share_page-0").parent().css("display","block");
 //j("#share_page-0").parent().fadeTo(200,1);
  j("#share_page-0").css("z-index", "999");
  j("#share_page-0").jScrollPane({showArrows:true});
  /* j("#comments_page-0").fadeTo(0,0).css("display", "block");
   j("#comments_page-0").parent().css("display", "block");
   j("#blog_post-0").fadeTo(200,0);
   j("#comments_page-0").fadeTo(200,1);*/
});

j("#share_switch-1").click(function(){
  hideAllBlog();
 // j(".jScrollPaneContainer").css("display","none").fadeTo(0,0);
  j("#share_page-1").css("display", "block");
  j("#share_page-1").parent().css("display","block");
 // j("#share_page-1").parent().fadeTo(200,1);
  j("#share_page-1").css("z-index", "999");
  j("#share_page-1").jScrollPane({showArrows:true});
  /* j("#comments_page-0").fadeTo(0,0).css("display", "block");
   j("#comments_page-0").parent().css("display", "block");
   j("#blog_post-0").fadeTo(200,0);
   j("#comments_page-0").fadeTo(200,1);*/
});


j("#gallery_switch-0").click(function(){
  hideAllBlog();
 // j(".jScrollPaneContainer").css("display","none").fadeTo(0,0);
  j("#gallery_page-0").css("display", "block");
  j("#gallery_page-0").parent().css("display","block");
  //j("#gallery_page-0").parent().fadeTo(200,1);
  j("#gallery_page-0").css("z-index", "999");
  j("#gallery_page-0").jScrollPane({showArrows:true});
  /* j("#comments_page-0").fadeTo(0,0).css("display", "block");
   j("#comments_page-0").parent().css("display", "block");
   j("#blog_post-0").fadeTo(200,0);
   j("#comments_page-0").fadeTo(200,1);*/
});

j("#gallery_switch-1").click(function(){
  hideAllBlog();
 // j(".jScrollPaneContainer").css("display","none").fadeTo(0,0);
  j("#gallery_page-1").css("display", "block");
  j("#gallery_page-1").parent().css("display","block");
  //j("#gallery_page-1").parent().fadeTo(200,1);
  j("#gallery_page-1").css("z-index", "999");
  j("#gallery_page-1").jScrollPane({showArrows:true});
  /* j("#comments_page-0").fadeTo(0,0).css("display", "block");
   j("#comments_page-0").parent().css("display", "block");
   j("#blog_post-0").fadeTo(200,0);
   j("#comments_page-0").fadeTo(200,1);*/
});

j("#comments_switch-0").click(function(){
  hideAllBlog();
 // j(".jScrollPaneContainer").css("display","none").fadeTo(0,0);
 freshblog.iscomment = 1;
  j("#comments_page-0").css("display", "block");
  j("#comments_page-0").parent().css("display","block");
  //j("#comments_page-0").parent().fadeTo(200,1);
  j("#comments_page-0").css("z-index", "999");
  j("#comments_page-0").jScrollPane({showArrows:true});
  /* j("#comments_page-0").fadeTo(0,0).css("display", "block");
   j("#comments_page-0").parent().css("display", "block");
   j("#blog_post-0").fadeTo(200,0);
   j("#comments_page-0").fadeTo(200,1);*/
});

j("#article_switch-0").click(function(){
  
 j(".jScrollPaneContainer").css("display","none");
// j(".jScrollPaneContainer").fadeTo(0,0);
 // j(".jScrollPaneContainer").css("display","block");
  hideAllBlog();
  j("#blog_post-0").css("display", "block");
  j("#blog_post-0").parent().css("display","block");
 // j("#blog_post-0").parent().fadeTo(200,1);
  j("#blog_post-0").css("z-index", "999");
  j("#blog_post-0").jScrollPane({showArrows:true});
  //j("#blog_post-0").parent().css("z-index","99999");
  //j("#blog_post-0").jScrollPane({showArrows:true});
 
 //  j("#comments_page").fadeTo(0,0).css("display", "block");
//   j("#blog_post-0").fadeTo(200,1);
  // j("#comments_page-0").fadeTo(200,0).css("display", "none").parent().css("display", "none");
});


j("#comments_switch-1").click(function(){
  hideAllBlog();
  freshblog.iscomment = 1;
//   j(".jScrollPaneContainer").css("display","none").fadeTo(0,0);
  j("#comments_page-1").css("display", "block");
  j("#comments_page-1").parent().css("display","block");
  //j("#comments_page-1").parent().fadeTo(200,1);
  j("#comments_page-1").css("z-index", "999");
  j("#comments_page-1").jScrollPane({showArrows:true});
  /* j("#comments_page-1").fadeTo(0,0).css("display", "block");
   j("#comments_page-1").parent().css("display", "block");
   j("#blog_post-1").fadeTo(200,0);
   j("#comments_page-1").fadeTo(200,1);*/
});

j("#article_switch-1").click(function(){

 //j(".jScrollPaneContainer").css("display","none");
 //j(".jScrollPaneContainer").fadeTo(0,0);
 j(".jScrollPaneContainer").css("display","block");
  hideAllBlog();
  j("#blog_post-1").css("display", "block");
  j("#blog_post-1").parent().css("display","block");
  //j("#blog_post-1").parent().css("z-index","99999");
  //j("#blog_post-1").parent().fadeTo(200,1); 
  j("#blog_post-1").css("z-index", "999");
  j("#blog_post-1").jScrollPane({showArrows:true});
  // j("#blog_post-1").jScrollPane({showArrows:true});
 //  j("#comments_page").fadeTo(0,0).css("display", "block");
 //  j("#blog_post-1").fadeTo(200,1);
  // j("#comments_page-1").fadeTo(200,0).css("display", "none").parent().css("display", "none");
});
 var clicked=2;
 j("#blog_content_scrollbar-1").mousedown(function(e){
// alert(this.pageX);
clicked=1;
});

 j("#blog_content_scrollbar-0").mousedown(function(e){
 //alert(this.pageX);
clicked=0;
});
 j("#blog_content_scrollbar-0").mousemove(function(e){
if(clicked==0)  {
j("#blog_content_scrollbar-0").css("top", e.offsetTop );
j("#blog_post-0").html(e.pageY);
j("#blog_post-1").html(e.pageY);}});
    
 j("#blog_content_scrollbar-1").mousemove(function(e){
if(clicked==1)  {
j("#blog_content_scrollbar-1").css("top", e.offsetTop );
j("#blog_post-0").html(e.pageY);
j("#blog_post-1").html(e.pageY);}});          
                        
//var pos=j(".blog_content_scrollbar").position();
//j(".blog_content_scrollbar").attr("id","blog_content_scrollbar");
//j("#blog_content_scrollbar-0").css("background","red");
//j("#blog_content_scrollbar-1").css("background","red");
                  //     j(".blog_content_scrollbar").css("background","red");
 
 /*
j("body").mousemove(function(e){
if(clicked==true)  {
j(".blog_content_scrollbar").css("top", e.clientY -pos.top );
j("#blog_post-0").html(e.pageY);
j("#blog_post-1").html(e.pageY);}
                             });
                  */
function change_page(new_page_name)
{
    change_to_content();  // if we are not on the content page, just change it to
    var new_page_content = freshwork.show_page(new_page_name, actual_page);
    var new_page_template = freshwork.get_page_template(new_page_name);
  
    actual_page = new_page_name; 
    
  
}

j(".introbox_about").click(function ()
  {
   // change_to_content();
   // alert("pica");
    window.location=freshsettings.introbox1_link;
   // click_change = "2-about";
   // change_page("2-about"); 
     
  });
  
j(".introbox_works").click(function ()
  {
   // change_to_content();
   // alert("pica");
    window.location=freshsettings.introbox2_link;
   // click_change = "2-about";
   // change_page("2-about"); 
     
  });
  
j(".introbox_contact").click(function ()
  {
   // change_to_content();
   // alert("pica");
    window.location=freshsettings.introbox3_link;
   // click_change = "2-about";
   // change_page("2-about"); 
     
  });
  
j("#header .logo").find("a").livequery('click',function ()
  {
      change_to_home();
  });
 j("#navigation li").click(function () {
  if(freshwork.nav_index < j(this).index())
  {
    freshwork.move = 1;
   // alert("1");
  }
  else 
  {
  //  alert("-1");
    freshwork.move = -1;
  }
    j("#navigation ul li").removeClass("active");
    j("#navigation ul li").attr("rel","");
    j(this).attr("rel", "selected");
   // alert("pica");
   // j(this).addClas("active");
     j(this).addClass("active");
    var new_page = j(this).find("a").attr("href");
    var char_pos = new_page.search("#/");
    new_page = new_page.substring(char_pos + 2);
 //   new_page = new_page.replace("/","");
 //   alert(new_page);
    window.location="#/"+new_page;
    freshwork.nav_index = j(this).index();
 //   click_change = new_page;
 //   alert(actual_page);
    // alert(new_page);
//    if(actual_page != new_page){
 //      change_page(new_page);
     
 //     }
      });
function setup_gallery(data, link)
{       


}


      
function parse_param(parameter, source)
{
 var param_position = source.search(parameter);
  
 var divider = ";.;.;";
 if(param_position != -1)
 {
   var divider_position = source.indexOf(divider, param_position);
   var param_content = source.substring(param_position + parameter.length + 1, divider_position);
    //alert (param_content);
 }
 //
  return param_content;
}      
      
j.address.externalChange(function(event){
   //   if(j.address.pathNames() !=click_change)
      {
        click_change ="";
        //alert(j.address.pathNames() + actual_page);
        //if()
       // if(j.address.pathNames() !="" &&  j(".introbox_about_shadow").css("display") != "none")
      //  {change_to_content();}
        if(j.address.pathNames() !=""  )
        {
         change_page(j.address.pathNames());
       if(j.address.parameter("link")!=undefined)
       {freshblog.load_post(j.address.parameter("link"), j.address.pathNames());
       }
    //    alert(j.address.parameter("link")); 
  //      change_to_content();
        }
        else
        {change_to_home();}
      }
      });      



var actual_animated = 0;
var interval = 0;
var thumb_style = 0;

j(".thumb_wrapper").hover(function() {
  if(animating_thumbs==false )
  {
  if(freshsettings.prf_gallerybump != "true")
   { 
     j(this).find(".thumb").stop();
     j(this).find(".thumb").find(".thumb_shine").stop();
     j(this).find(".thumb").animate({
     top: 1,
     left: 1
     },200);
  }
   if(freshsettings.prf_galleryshine != "true")
   {
   j(this).find(".thumb").find(".thumb_shine").css("background-position","-99px 0");
   j(this).find(".thumb").attr("name", "animating");
   j(this).find(".thumb").find(".thumb_shine").animate({backgroundPosition: '99px 0'},700,function(){j(this).parent().attr("name", ""); });
    }
 }
 // j(this).find(".thumb_shine").animate({backgroundPosition: '50px 0'},800,function(){ j(this).parent().find(".thumb_shine").stop(); j(this).parent().find(".thumb_shine").css("background-position","-150px 0");  });
  },function() {
   if(animating_thumbs==false)
  {
        j(this).find(".thumb").stop();
        j(this).find(".thumb").find(".thumb_shine").css("background-position","-99px 0");
  j(this).find(".thumb").animate({
   top: 8,
   left: 8
   },200);
//  j(this).find(".thumb_shine").stop();
    }
  }  );
  

function MexicWave()
{     
    animating_thumbs = true;
    var wow = actual_animated;
    var actual_item_id = actual_animated + freshgall.gallery[freshwork.actual_page]["actual_page"]*6;
   //  alert(actual_item_id);
    if (actual_animated == 5){clearInterval(change_interval);}
    j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+actual_animated+')').find(".thumb_shine").stop();
    j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+actual_animated+')').find(".thumb_shine").css("background-position","-99px 0");
    j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+actual_animated+')').find(".thumb_shine").animate({backgroundPosition: '99px 0'},750,function(){ j("#"+freshwork.actual_page_template).find('.thumb:eq('+actual_animated+')').parent().attr("name", ""); }); 
     j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+actual_animated+')').attr("name","");
    gallery_items = freshgall.gallery[freshwork.actual_page]["item_count"];
     j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+actual_animated+')').animate({
   top: 1,
   left: 1},200,
   function (){ 
        if(wow==5){animating_thumbs = false;}
   
         if(actual_item_id <= gallery_items){
         if(freshgall.gallery[freshwork.actual_page][actual_item_id]["video"] == "true")
         {
            j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+wow+')').find(".port_thumb_play").css("display","block");
         }
         else
         {
            j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+wow+')').find(".port_thumb_play").css("display","none");
         }
           j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+wow+')').find(".thumb_image").attr("src",freshgall.gallery[freshwork.actual_page][actual_item_id]["small"]);
           j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+wow+')').css("display", "block");
            j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+wow+')').parent().css("cursor", "pointer");
            j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+wow+')').animate({
             top: 8,
            left: 8                     
            },200);
         
         }
         else
         {
           j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+wow+')').parent().css("cursor", "default");
           j("#gallery-template-"+freshwork.gallery_id).find('.thumb:eq('+wow+')').css("display", "none");
         }
        
   });
   

 /*
     //     alert("pica");
   
  //  allert(gallery_items); 
   /*var wow = actual_animated;
   j("#"+freshwork.actual_page_template).find('.thumb:eq('+actual_animated+')').animate({
   top: 1,
   left: 1},
   function (){
   
   });
   
    
   //alert(wow+((gallery_actual_page-1)*6));        
   j("#"+freshwork.actual_page_template).find('.thumb:eq('+actual_animated+')').animate({
   top: 1,
   left: 1
   },200, function(){  if(wow+((gallery_items = freshgall.gallery[freshwork.actual_page]["actual_page"])*6) <= gallery_items)
   {j("#"+freshwork.actual_page_template).find('.thumb:eq('+wow+')').find("img").attr("src",freshgall.gallery[freshwork.actual_page][wow+((gallery_actual_page-1)*6)]["small"]);
   j("#"+freshwork.actual_page_template).find('.thumb:eq('+wow+')').css("display", "block");} else {j("#"+freshwork.actual_page_template).find('.thumb:eq('+wow+')').find("img").attr("src",""); j("#"+freshwork.actual_page_template).find('.thumb:eq('+wow+')').css("display", "none");}
     j("#"+freshwork.actual_page_template).find('.thumb:eq('+wow+')').animate({
   top: 8,
   left: 8                     
   },200);
  
   });                      */
     actual_animated++;        
    
}
var change_interval;               
j(".port_next").livequery('click',function() {
if(animating_thumbs == false)
{
actual_img_id = 0;
freshwork.actual_page=j.address.pathNames();
 gallery_items = freshgall.gallery[freshwork.actual_page]["item_count"];
// alert(gallery_items);
    if(freshgall.gallery[freshwork.actual_page]["actual_page"] < (parseInt(gallery_items/6))  )
    {
   
    freshgall.gallery[freshwork.actual_page]["actual_page"]++;
        thumb_style = (thumb_style-1)*(-1);
     actual_animated = 0;  
     var delay = 90;
     change_interval= setInterval(MexicWave, 90);
     
   /*  var mw1 = setTimeout(MexicWave, 1);
     var mw2 = setTimeout(MexicWave, 1*delay);
     var mw3 = setTimeout(MexicWave, 2*delay);
      
      
     var mw4 = setTimeout(MexicWave, 3*delay);
     var mw5 = setTimeout(MexicWave, 4*delay);
     var mw6 = setTimeout(MexicWave, 5*delay);           */
     }
}
});  
j(".port_prev").livequery('click',function() {
if(animating_thumbs == false)
{
actual_img_id = 0;
freshwork.actual_page=j.address.pathNames();
 gallery_items = freshgall.gallery[freshwork.actual_page]["item_count"];
  if(freshgall.gallery[freshwork.actual_page]["actual_page"] > 0)
    {
   
    freshgall.gallery[freshwork.actual_page]["actual_page"]--;
        thumb_style = (thumb_style-1)*(-1);
     actual_animated = 0;  
     var delay = 90;
     change_interval= setInterval(MexicWave, 90);
   /*  var mw1 = setTimeout(MexicWave, 1);
     var mw2 = setTimeout(MexicWave, 1*delay);
     var mw3 = setTimeout(MexicWave, 2*delay);
      
      
     var mw4 = setTimeout(MexicWave, 3*delay);
     var mw5 = setTimeout(MexicWave, 4*delay);
     var mw6 = setTimeout(MexicWave, 5*delay);           */
     }
   /*)  if(gallery_actual_page >1)
     {
    gallery_actual_page--;
        thumb_style = (thumb_style-1)*(-1);
     actual_animated = 0;  
     var delay = 90;
    var mw1 = setTimeout(MexicWave, 1);
     var mw2 = setTimeout(MexicWave, 1*delay);
     var mw3 = setTimeout(MexicWave, 2*delay);
      
      
     var mw4 = setTimeout(Mexicf
     e, 3*delay);
     var mw5 = setTimeout(MexicWave, 4*delay);
     var mw6 = setTimeout(MexicWave, 5*delay);            
     }   */
     }
});

j(".left_button_wrapper").click(function () {
freshwork.actual_page=j.address.pathNames();
   if(actual_img_id == 0)
   {   
   
   gallery_items = freshgall.gallery[freshwork.actual_page]["item_count"];
           
         //    alert(freshgall.gallery[freshwork.actual_page]["actual_page"] < (parseInt(gallery_items/6)) );
             
        if(freshgall.gallery[freshwork.actual_page]["actual_page"] > 0 )
        {
         //alert("hovno2");
          actual_img_id = 6;
          freshgall.gallery[freshwork.actual_page]["actual_page"]--;
          thumb_style = (thumb_style-1)*(-1);
          actual_animated = 0;  
          var delay = 90;
          change_interval= setInterval(MexicWave, 90);
        }
        else
        {
          actual_img_id = 1;
        }
   }
    actual_img_id--;
      var clicked_id = actual_img_id;
      var gallery_id = freshwork.gallery_id;
   //    alert(actual_img_id);
     var clicked_id_field = clicked_id + (freshgall.gallery[freshwork.actual_page]["actual_page"])*6; 
      //actual_img_id = clicked_id_field;
      //alert("pica");
      j("#big_image_up-"+gallery_id).attr("src",  j("#big_image_down-"+gallery_id).attr("src"));
      j("#big_image_up-"+gallery_id).fadeTo(0, 1);
      j("#big_image_down-"+gallery_id).attr("src", freshgall.gallery[freshwork.actual_page][clicked_id_field]["medium"]);
      j("#big_image_up-"+gallery_id).fadeTo(200, 0);
    
      j("#"+freshwork.actual_page_template).find(".item_name").html(freshgall.gallery[freshwork.actual_page][clicked_id_field]["title"]);
      j("#"+freshwork.actual_page_template).find(".item_description").html(freshgall.gallery[freshwork.actual_page][clicked_id_field]["content"]);
      Cufon.replace('.item_name');
      j("#gallery-template-"+gallery_id).find(".thumb_wrapper:eq("+(actual_img_id)+")").find(".thumb").find(".thumb_shine").stop();
      j("#gallery-template-"+gallery_id).find(".thumb_wrapper:eq("+(actual_img_id)+")").find(".thumb").find(".thumb_shine").css("background-position","-99px 0");
       j("#gallery-template-"+gallery_id).find(".thumb_wrapper:eq("+(actual_img_id)+")").find(".thumb").find(".thumb_shine").animate({backgroundPosition: '99px 0'},700);
       if(freshgall.gallery[freshwork.actual_page][clicked_id_field]["video"] == "true")
  {
     j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name","video");
    j("#gallery-template-"+gallery_id).find(".port_bigimg_play").css("display","block");
    j("#center_button_portfolio-"+gallery_id).removeClass("center_button_zoom_image");
    j("#center_button_portfolio-"+gallery_id).addClass("center_button_play_video");
     j(".center_button_wrapper").colorbox({iframe:true, innerWidth:425, innerHeight:344, href:freshgall.gallery[freshwork.actual_page][clicked_id_field]["large"]});
  }
  else
  {
     j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name","image");
    j("#gallery-template-"+gallery_id).find(".port_bigimg_play").css("display","none");
    j("#center_button_portfolio-"+gallery_id).addClass("center_button_zoom_image");
    j("#center_button_portfolio-"+gallery_id).removeClass("center_button_play_video");
     j(".center_button_wrapper").colorbox({iframe:false,innerWidth:false, innerHeight:false,href:freshgall.gallery[freshwork.actual_page][clicked_id_field]["large"]});
 //  alert("shit");
  }
   
   
  
  
});

var actual_img_id = 0;
j(".right_button_wrapper").click(function () {
freshwork.actual_page=j.address.pathNames();
var clicked_id_second = actual_img_id + (freshgall.gallery[freshwork.actual_page]["actual_page"])*6;
gallery_items = freshgall.gallery[freshwork.actual_page]["item_count"];   
//alert(clicked_id_second + "  " + gallery_items);
if(clicked_id_second == gallery_items){actual_img_id--;}
   if(actual_img_id == 5)
   {
   
   
       

    if(freshgall.gallery[freshwork.actual_page]["actual_page"] < (parseInt(gallery_items/6))  )
    {
      actual_img_id = -1;
      freshgall.gallery[freshwork.actual_page]["actual_page"]++;
      thumb_style = (thumb_style-1)*(-1);
      actual_animated = 0;  
      var delay = 90;
      change_interval= setInterval(MexicWave, 90);
    }
    else
    {
    actual_img_id = 4;
    }
   
   }     
 //  alert(actual_img_id);       
    actual_img_id++;
      var clicked_id = actual_img_id;
      var gallery_id = freshwork.gallery_id;
      
     var clicked_id_field = clicked_id + (freshgall.gallery[freshwork.actual_page]["actual_page"])*6; 
      //actual_img_id = clicked_id_field;
      //alert("pica");
      j("#big_image_up-"+gallery_id).attr("src",  j("#big_image_down-"+gallery_id).attr("src"));
      j("#big_image_up-"+gallery_id).fadeTo(0, 1);
      j("#big_image_down-"+gallery_id).attr("src", freshgall.gallery[freshwork.actual_page][clicked_id_field]["medium"]);
      j("#big_image_up-"+gallery_id).fadeTo(200, 0);
    

      j("#"+freshwork.actual_page_template).find(".item_name").html(freshgall.gallery[freshwork.actual_page][clicked_id_field]["title"]);
      j("#"+freshwork.actual_page_template).find(".item_description").html(freshgall.gallery[freshwork.actual_page][clicked_id_field]["content"]);
      Cufon.replace('.item_name');
      
            j("#gallery-template-"+gallery_id).find(".thumb_wrapper:eq("+(actual_img_id)+")").find(".thumb").find(".thumb_shine").stop();
      j("#gallery-template-"+gallery_id).find(".thumb_wrapper:eq("+(actual_img_id)+")").find(".thumb").find(".thumb_shine").css("background-position","-99px 0");
       j("#gallery-template-"+gallery_id).find(".thumb_wrapper:eq("+(actual_img_id)+")").find(".thumb").find(".thumb_shine").animate({backgroundPosition: '99px 0'},700);
       if(freshgall.gallery[freshwork.actual_page][clicked_id_field]["video"] == "true")
      {
         j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name","video");
        j("#center_button_portfolio-"+gallery_id).removeClass("center_button_zoom_image");
        j("#center_button_portfolio-"+gallery_id).addClass("center_button_play_video");
        j("#gallery-template-"+gallery_id).find(".port_bigimg_play").css("display","block");
         j(".center_button_wrapper").colorbox({iframe:true, innerWidth:425, innerHeight:344, href:freshgall.gallery[freshwork.actual_page][clicked_id_field]["large"]});
      }
      else
      {
         j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name","image");
        j("#gallery-template-"+gallery_id).find(".port_bigimg_play").css("display","none");
        j("#center_button_portfolio-"+gallery_id).addClass("center_button_zoom_image");
        j("#center_button_portfolio-"+gallery_id).removeClass("center_button_play_video");
         j(".center_button_wrapper").colorbox({iframe:false,innerWidth:false, innerHeight:false, href:freshgall.gallery[freshwork.actual_page][clicked_id_field]["large"]});
     //  alert("shit");
      }
   
   
  
});
  
j(".thumb_wrapper").click(function () {
          freshwork.actual_page=j.address.pathNames();
  var clicked_id = parseInt(j(this).find(".thumb_shine").attr("rel") - 1);
  var gallery_id = freshwork.gallery_id;
  
 var clicked_id_field = clicked_id + (freshgall.gallery[freshwork.actual_page]["actual_page"])*6; 
 if(freshgall.gallery[freshwork.actual_page][clicked_id_field]["title"] != "")
 {
  actual_img_id = clicked_id;
  //alert("pica");
  j("#big_image_up-"+gallery_id).attr("src",  j("#big_image_down-"+gallery_id).attr("src"));
  j("#big_image_up-"+gallery_id).fadeTo(0, 1);
  j("#big_image_down-"+gallery_id).attr("src", freshgall.gallery[freshwork.actual_page][clicked_id_field]["medium"]);
  j("#big_image_up-"+gallery_id).fadeTo(200, 0);
  
  j("#"+freshwork.actual_page_template).find(".item_name").html(freshgall.gallery[freshwork.actual_page][clicked_id_field]["title"]);
 j("#"+freshwork.actual_page_template).find(".item_description").html(freshgall.gallery[freshwork.actual_page][clicked_id_field]["content"]);
  Cufon.replace('.item_name');
  //center_button_play_video
  
  if(freshgall.gallery[freshwork.actual_page][clicked_id_field]["video"] == "true")
  {   
 //   alert("pica"); 
    j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name","video");
    j("#gallery-template-"+gallery_id).find(".port_bigimg_play").css("display","block");
    //j("#gallery-template-"+gallery_id).find(".port_bigimg_play").fadeTo(0,1);
    j("#center_button_portfolio-"+gallery_id).removeClass("center_button_zoom_image");
    j("#center_button_portfolio-"+gallery_id).addClass("center_button_play_video");
     j(".center_button_wrapper").colorbox({iframe:true, innerWidth:425, innerHeight:344, href:freshgall.gallery[freshwork.actual_page][clicked_id_field]["large"]});
  }
  else
  {
    j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name","image");
    j("#gallery-template-"+gallery_id).find(".port_bigimg_play").css("display","none");
    j("#center_button_portfolio-"+gallery_id).addClass("center_button_zoom_image");
    j("#center_button_portfolio-"+gallery_id).removeClass("center_button_play_video");
     j(".center_button_wrapper").colorbox({iframe:false,innerWidth:false, innerHeight:false,href:freshgall.gallery[freshwork.actual_page][clicked_id_field]["large"]});
 //  alert("shit");
  }
//  j("#center_button_portfolio-"+gallery_id).
 // j(".center_button_play_video").attr("href", freshgall.gallery[freshwork.actual_page][clicked_id_field]["large"]);
   // alert(freshgall.gallery[freshwork.actual_page][clicked_id_field]["large"]);
   //j(".center_button_wrapper").colorbox({iframe:true, innerWidth:425, innerHeight:344, href:freshgall.gallery[freshwork.actual_page][clicked_id_field]["large"]});
  }
}); 


j("#dot_step_1-2").click(function() {step_2(); });
j("#dot_step_1-3").click(function() {step_3(); });
j("#dot_step_2-1").click(function() {step_1(); });
j("#dot_step_2-3").click(function() {step_3(); });
j("#dot_step_3-2").click(function() {step_2(); });
j("#dot_step_3-1").click(function() {step_1(); });
 
   j("#next_step_1").click(function() {step_2(); });
  j("#next_step_2").click(function() { step_3();});
  j("#next_step_3").click(function() { step_4();});
   j("#next_step_4").click(function() { step_1();});
var anim_speed = 400; 
var step_1_ok = false;
var step_2_ok = false; 
var step_3_ok = false; 
function step_1()
{
   //validace
    j(".contact_step_number_slider").animate({top:-930},anim_speed);
    j(".form_steps_slider").animate({left:-0},anim_speed);
    
}
function step_2()
{
      if(j(".form_step_1_wrapper").find(".form_type_text").attr("value") !=""  )
      {
        j(".contact_step_number_slider").animate({top:-620},anim_speed);
        j(".form_steps_slider").animate({left:-326},anim_speed);
        step_1_ok = true;
      }
      else
      {
 //     j(".form_step_1_wrapper").find(".form_type_text").addClass("form_type_text_error");
         //j(".form_step_1_wrapper").find(".form_type_text").removeClass("form_type_text_error") 
            //form_type_text_error
     //       j(".form_step_1_wrapper").find(".form_type_text").fadeTo(0,0);
       //     j(".form_step_1_wrapper").find(".form_type_text").css("display", "block");
        //    j(".form_step_1_wrapper").find(".form_type_text").fadeTo(0,0);          
           j(".form_step_1_wrapper").find(".form_type_text").stop()
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "0px" }, 100);
          step_1_ok = false;
      }
}
function step_3()
{
      var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
       if(j(".form_step_2_wrapper").find(".form_type_text").attr("value") == "" || !filter.test(j(".form_step_2_wrapper").find(".form_type_text").attr("value")) || step_1_ok == false)
        {
           j(".form_step_1_wrapper").find(".form_type_text").stop()
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "0px" }, 100);
           j(".form_step_2_wrapper").find(".form_type_text").stop()
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "0px" }, 100);
          step_2_ok = false;
        }
      else
      {
        step_2_ok = true;
        j(".contact_step_number_slider").animate({top:-310},anim_speed);
        j(".form_steps_slider").animate({left:-652},anim_speed);
      }
}
function step_4()
{
    var name =j(".form_step_1_wrapper").find(".form_type_text").attr("value");
    var email =j(".form_step_2_wrapper").find(".form_type_text").attr("value");
    var message =j(".form_step_3_wrapper").find(".form_type_textarea").attr("value");
    
     if(step_1_ok == true && step_2_ok == true && j(".form_step_3_wrapper").find(".form_type_textarea").attr("value") != "")
     {
      step_3_ok = true;
     j(".contact_step_number_slider").animate({top:0},anim_speed);
     j(".form_steps_slider").animate({left:-978},anim_speed);
     
     j(".form_step_1_wrapper").find(".form_type_text").attr("value","");
    j(".form_step_2_wrapper").find(".form_type_text").attr("value","");
    j(".form_step_3_wrapper").find(".form_type_textarea").attr("value","");
     freshwork.send_email(name, email, message);
     }
     else
     {
     j(".form_step_3_wrapper").find(".form_type_textarea").stop()
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                .animate({ left: "0px" }, 100);
     step_3_ok = false;
     }
}                                                  
});

////////////////////////////////////////////////////////
// Freshwork - first Wordpress -> JavaScript framework
// Author: _freshface
////////////////////////////////////////////////////////
//var browser = "";

var change_speed = 300;
freshwork = new Object();
freshwork.br = "";
freshwork.get_address = freshsettings.get_post;  // address of get-page.php
freshwork.loaded_pages = "";      // name of all loaded pages
freshwork.attr_divider = ";.;.;"; // divider of params
freshwork.page_array = new Array();// array of loaded pages
freshwork.preloaded_pages = 0;    // number of loaded pages
freshwork.main_content_id = 0;    // actual main content id
freshwork.gallery_id = 0;         // actual main content id
freshwork.blog_id = 0;
freshwork.actual_page_template = "";
freshwork.actual_page = "2-about";
freshwork.actual_page2 ="";
freshwork.actual_page3 = "";
freshwork.loading = false;
freshwork.nav_index = 0;
freshwork.linktochange = "";
freshwork.counter = 0;
freshwork.move = 1;             // from smaller to hsgher is ok

var helper_interval;

freshwork.send_email = function (name, email, message)
{
   var email_address = freshwork.get_address + "?email=1&sender_mail="+email+"&sender_name="+name+"&sender_message="+message; 
    j.get(email_address, function(data, text){});
}
////////////////////////////////////////////////////////
// function get_page
// attr: page_link - link generated from freshwork wp function
// desc: load page and store it into multi-dimensional field
////////////////////////////////////////////////////////
freshwork.show_page = function (page_link, act_page)
{
  var navigation_el = j("#navigation ul li").length - 1;
  for(var i = 0; i <= navigation_el; i++)
  {
    var inner_html = j("#navigation ul li:eq("+i+")").html();
    if(inner_html.indexOf(page_link) >-1) {
     j("#navigation ul li").removeClass("active");
      j("#navigation ul li").attr("rel", "");
    j("#navigation ul li:eq("+i+")").addClass("active");
 //    j("#navigation ul li[rel!=selected]").removeClass("active");
      j("#navigation ul li:eq("+i+")").attr("rel","selected");
       } 
  }
  //alert(j("#navigation ul li:eq(0)").html() );
 
 
 
  freshwork.actual_page2 =page_link;
  
  
  if(this.loaded_pages.search(page_link) == -1)   // page wasnt preloaded
  {

      freshwork.loading = true;
      j(".main_content_area").css("display", "none");
      j("#loader-template").css("left", 600);
      j("#loader-template").css("display", "block");
      if(freshwork.actual_page_template !=""){
      var new_page_link = page_link;
      j("#"+freshwork.actual_page_template).animate({left:-600}, change_speed, function(){ j("#"+freshwork.actual_page_template).css("display", "none");} );
      }
      
      j("#loader-template").animate({left:0},{duration:change_speed, easing:'jswing'});
      j.get(freshwork.get_address+"?post_link=" + page_link, function(data, text){
      
         document.title = freshwork.parse_attribute("page-title", data);
        var page_template = freshwork.parse_attribute("page-template", data);
        var actual_page2 = freshwork.parse_attribute("actual-post-link", data);
      //   alert(actual_page2);
        j("#loader-template").animate({left:-600}, change_speed, function(){ j("#loader-template").css("display", "none");} );
          if(page_template =="" )
          { 
             var test_id= (freshwork.main_content_id-1)*(-1);
            j("#main_content-"+test_id).find(".page").html(freshwork.parse_attribute("page-content", data));
            
            if(freshwork.actual_page2+"" == actual_page2+"")
            {    
                j("#main_content-"+test_id).stop();                                                  
               j("#main_content-"+test_id).css("left", 600);
               j("#main_content-"+test_id).css("display", "block");
               j("#main_content-"+test_id).animate({left:0},{duration:change_speed, easing:'jswing'});
                j("#main_content-"+test_id).find(".page").jScrollPane({showArrows:true});
                j("#main_content-"+test_id).find(".page")[0].scrollTo(0);                       
               freshwork.main_content_id= (freshwork.main_content_id-1)*(-1);
               freshwork.actual_page_template = "main_content-"+freshwork.main_content_id;
               j("#main_content-"+test_id).find(".page").css("display","block");
               j(".jScrollPaneContainer").css("display","block");
             }
          }
          if(page_template == "contact-page")
          {
               if(freshwork.actual_page2+"" == actual_page2+"")
             {
              j(".contact_left").html(freshwork.parse_attribute("page-content", data));   
              j("#contact-template").css("left", 600);
              j("#contact-template").css("display", "block");
              j("#contact-template").animate({left:0},{duration:change_speed, easing:'jswing'}); 
              
              freshwork.actual_page_template = "contact-template";
              }
          }
          if(page_template == "blog-page"  )
          {
           j(".blog_menu").html(" ");
              var test_id= (freshwork.blog_id-1)*(-1);
   
              freshblog.load_categories(page_link,data );
              
               if(freshwork.actual_page2+"" == actual_page2+"")
             {
            j("#blog-template-"+test_id).find(".blog_menu").html(freshblog.categories[page_link]+freshblog.bloglist[page_link]);
               Cufon.replace('.blog_menu_category_title, .blog_menu_post_title', { fontFamily: 'Myriad Pro Regular' });
              j("#blog-template-"+test_id).css("left", 600);
              j("#blog-template-"+test_id).css("display", "block");
              j("#blog-template-"+test_id).animate({left:0},{duration:change_speed, easing:'jswing'});
               
              freshwork.blog_id= (freshwork.blog_id-1)*(-1);
              freshwork.actual_page_template = "blog-template-"+freshwork.blog_id;
                  if(j.address.parameter("link") != undefined){
                  freshblog.load_post(j.address.parameter("link"), j.address.pathNames());}
              
                    else 
                    {
                       
                        window.location=freshwork.parse_attribute("start-page", data);

                    }
              } 
                  j(".blog_menu_posts").animate({left:218}, {duration:1, easing:'jswing'});
                j(".blog_menu_categories").animate({left:0}, {duration:1, easing:'jswing'});
                j(visible).animate({left:218}, {duration:change_speed, easing:'jswing'});
                  
          }   
          if(page_template =="gallery-page")
          {     
          actual_img_id = 0;        
              freshgall.load_gall(data, page_link);
              var test_id = (freshwork.gallery_id -1)*(-1);
               if(freshwork.actual_page2+"" == actual_page2+"")
             {
             j("#gallery-template-"+test_id).stop();
              j("#gallery-template-"+test_id).css("left", 600);
              j("#gallery-template-"+test_id).css("display", "block");
              j("#gallery-template-"+test_id).animate({left:0},{duration:change_speed, easing:'jswing'});
              freshwork.gallery_id= (freshwork.gallery_id-1)*(-1);
              freshwork.actual_page_template = "gallery-template-"+freshwork.gallery_id;
              freshwork.actual_page = page_link;
              var item_count = freshgall.gallery[page_link]["item_count"];
              var x = 0;
              for(x=0; x<=5;x++)
              {
                if(x<=item_count){
                 if(freshgall.gallery[page_link][x]["video"] == "true")
                  {
                      j("#gallery-template-"+test_id).find(".center_button_wrapper").attr("name","video"); 
                     j("#gallery-template-"+test_id).find('.thumb:eq('+x+')').find(".port_thumb_play").css("display","block");
                  }
                  else {
                   j("#gallery-template-"+test_id).find(".center_button_wrapper").attr("name","video");
                   j("#gallery-template-"+test_id).find('.thumb:eq('+x+')').find(".port_thumb_play").css("display","none");}
                   
     
    
                j("#gallery-template-"+test_id).find('.thumb:eq('+x+')').parent().css("cursor", "pointer ");
                j("#gallery-template-"+test_id).find('.thumb:eq('+x+')').css("display", "block");
                j("#gallery-template-"+test_id).find(".thumb:eq("+x+")").find(".thumb_image").attr("src", freshgall.gallery[page_link][x]["small"]);
                }
                else
                {
                     j('.thumb:eq('+x+')').parent().css("cursor", "default");
                   j('.thumb:eq('+x+')').css("display", "none");
                }
              }
              
                               if(freshgall.gallery[freshwork.actual_page][0]["video"] == "true")
      {
         j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name","video");
        j("#center_button_portfolio-"+test_id).removeClass("center_button_zoom_image");
        j("#center_button_portfolio-"+test_id).addClass("center_button_play_video");
        j("#gallery-template-"+test_id).find(".port_bigimg_play").css("display","block");
         j(".center_button_wrapper").colorbox({iframe:true, innerWidth:425, innerHeight:344, href:freshgall.gallery[freshwork.actual_page][0]["large"]});
      }
      else
      {
         j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name","image");
        j("#gallery-template-"+test_id).find(".port_bigimg_play").css("display","none");
        j("#center_button_portfolio-"+test_id).addClass("center_button_zoom_image");
        j("#center_button_portfolio-"+test_id).removeClass("center_button_play_video");
         j(".center_button_wrapper").colorbox({iframe:false,innerWidth:false, innerHeight:false, href:freshgall.gallery[freshwork.actual_page][0]["large"]});
     //  alert("shit");
      }
       j("#gallery-template-"+test_id).find(".big_image").attr("src",  freshgall.gallery[page_link][0]["medium"]);
              j("#gallery-template-"+test_id).find(".item_name").html( freshgall.gallery[page_link][0]["title"]);
              j("#gallery-template-"+test_id).find(".item_description").html( freshgall.gallery[page_link][0]["content"]);
              Cufon.replace('.item_name');
              /*
               if(freshgall.gallery[page_link][0]["video"] == "true")
                  {
                  j("#gallery-template-"+test_id).find(".port_bigimg_play").css("display","block");
                  }
              j("#gallery-template-"+test_id).find(".big_image").attr("src",  freshgall.gallery[page_link][0]["medium"]);
              j("#gallery-template-"+test_id).find(".item_name").html( freshgall.gallery[page_link][0]["title"]);
              j("#gallery-template-"+test_id).find(".item_description").html( freshgall.gallery[page_link][0]["content"]);
              Cufon.replace('.item_name');
                      //    return data;
                      
                      */ 
                      }
          }
  
         freshwork.page_array[page_link] = data;
         freshwork.preloaded_pages++;
         freshwork.loaded_pages = freshwork.loaded_pages + "," + page_link;
         freshwork.loading = false;
             Cufon.replace('h1, h2, h3, h4', { fontFamily: 'Myriad Pro Bold' });
      });
      
  }
  else if( j.address.parameter("link") == undefined )
  {
      document.title = freshwork.parse_attribute("page-title", freshwork.page_array[page_link]);
    
      j("#loader-template").animate({left:-600}, change_speed, function(){ j("#loader-template").css("display", "none");} );
       
      var page_template = freshwork.parse_attribute("page-template", freshwork.page_array[page_link]);
  //    alert(freshwork.actual_page_template +"    " +  page_template);
     // if(freshwork.actual_page_template == ("blog-template-"+freshwork.blog_id) &&page_template == ("blog-page") )
    if(freshwork.actual_page_template != 0)
    {
    // && freshwork.actual_page_template != ("blog-template-"+freshwork.blog_id) && page_template != ("blog-page")
   // alert(freshwork.actual_page3);
    //freshwork.actual_page_template == ("blog-template-"+freshwork.blog_id) && page_template == ("blog-page") && freshwork.actual_page3 == page_link
  //    var aaa ="kokote";
    //  var bbb="kokote";
    //.71-blog.   .71-blog.
//    var neco = page_link;
///    alert(neco == page_link);
///     alert(page_link == freshwork.actual_page3);
//      alert(page_link == '71-blog' );
 //     alert((""+freshwork.actual_page3) == (page_link+""));
//      alert("." + freshwork.actual_page3 + ".   ." + page_link + ".");
     
  //    var neco = page_link;
  //    var neco2 = freshwork.actual_page3;
  //    alert(neco == neco2);
  //    alert(page_link == "71-blog" );

      if(freshwork.actual_page_template == ("blog-template-"+freshwork.blog_id) && page_template == ("blog-page") && (""+freshwork.actual_page3) == (page_link+"")){page_template = "nothing";}
      else
      {
         j(".right_column_blur_bottom").css("display", "none");
         j(".right_column_blur_top").css("display", "none");
         j(".right_column_blur_left").css("display", "none");
     //    j(".icon_wrapper_bg").css("display", "none");
       //  j(".blog_left_column").css("display", "none");
         j(".blog_content_blur_bottom").css("display", "none");
         j(".blog_content_blur_top").css("display", "none");
         var tohide = freshwork.actual_page_template;
         j("#"+freshwork.actual_page_template).animate({left:(-600*freshwork.move)}, change_speed, function(){ j("#"+tohide).css("display", "none");} );
      }
     }     if(page_template == false)
          {
          
            freshwork.main_content_id= (freshwork.main_content_id-1)*(-1);
            
            j("#main_content-"+freshwork.main_content_id).stop();                                                     
            j("#main_content-"+freshwork.main_content_id).find(".page").html(freshwork.parse_attribute("page-content", freshwork.page_array[page_link])); 
            j("#main_content-"+freshwork.main_content_id).css("left", 600*freshwork.move);
            j("#main_content-"+freshwork.main_content_id).css("display", "block");
            j("#main_content-"+freshwork.main_content_id).animate({left:0},{duration:change_speed, easing:'jswing'}); 
              j(".jScrollPaneContainer").css("display","block");  
            j("#main_content-"+freshwork.main_content_id).find(".page").css("display","block"); 
            j("#main_content-"+freshwork.main_content_id).find(".page").jScrollPane({showArrows:true}); 
            j("#main_content-"+freshwork.main_content_id).find(".page")[0].scrollTo(0); 
          
            freshwork.actual_page_template = "main_content-"+freshwork.main_content_id;
          }
                               //freshwork.actual_page3 + 
//           alert (freshwork.actual_page3 == page_link);
           if(page_template == "blog-page")
          {
                j(".blog_menu").html(" ");
           //   setTimeout(window.location=freshwork.parse_attribute("start-page",  freshwork.page_array[page_link]), 2000);
        //    alert(freshwork.actual_page_template + "undefin);
          //  j(".blog_menu").html("s");
            var test_id= (freshwork.blog_id-1)*(-1);
            
        //      j("#blog-template-"+test_id).find(".blog_menu_categories").html(freshblog.categories[page_link]);
              j("#blog-template-"+test_id).find(".blog_menu").html(freshblog.categories[page_link]+freshblog.bloglist[page_link]);
          //    alert(freshblog.bloglist[page_link]);
              j("#blog-template-"+test_id).css("left", 600*freshwork.move);
               j("#blog-template-"+test_id).css("display", "block");
               j("#blog-template-"+test_id).animate({left:0},change_speed, function(){
               j(".right_column_blur_bottom").css("display", "block");
               j(".right_column_blur_top").css("display", "block");
               j(".right_column_blur_left").css("display", "block");
            //   j(".icon_wrapper_bg").css("display", "block");
            //   j(".blog_left_column").css("display", "block");
               j(".blog_content_blur_bottom").css("display", "block");
               j(".blog_content_blur_top").css("display", "block");
                     } );
                     Cufon.replace('.blog_menu_category_title, .blog_menu_post_title', { fontFamily: 'Myriad Pro Regular' });
               freshwork.blog_id= (freshwork.blog_id-1)*(-1);
               //alert("m");
                //window.location=freshwork.parse_attribute("start-page",  freshwork.page_array[page_link]); 
     
               freshwork.actual_page_template = "blog-template-"+freshwork.blog_id;
                j(".blog_menu_posts").animate({left:218}, {duration:1, easing:'jswing'});
                j(".blog_menu_categories").animate({left:0}, {duration:1, easing:'jswing'});

                
                
                  var blog_height = j(".blog_menu_categories").css("height");
                  var px_index  = blog_height.indexOf("px");
                  blog_height = blog_height.substring(0, px_index);
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
                  
          //                      j.address.value(freshwork.parse_attribute("start-page",  freshwork.page_array[page_link]));
                    freshwork.linktochange =freshwork.parse_attribute("start-page",  freshwork.page_array[page_link]);
                    freshwork.counter = 0;
                    helper_interval = setInterval(pica,  50);
                    //alert("pica");
                window.location=freshwork.parse_attribute("start-page",  freshwork.page_array[page_link]);
              // setTimeout(alert("pica"),  10000);
                
          }
           if(page_template == "contact-page")         
          {
              j(".contact_left").html(freshwork.parse_attribute("page-content", freshwork.page_array[page_link]));   
              j("#contact-template").css("left", 600*freshwork.move);
              j("#contact-template").css("display", "block");
              j("#contact-template").animate({left:0},{duration:change_speed, easing:'jswing'});
              
              freshwork.actual_page_template = "contact-template";
          }   
          if(page_template =="gallery-page")
          {    
              actual_img_id = 0;
              j(".thumb").css("left", 8);
              j(".thumb").css("top", 8);
            //   freshgall.load_gall(data, page_link);
              var test_id = (freshwork.gallery_id -1)*(-1);
              freshgall.gallery[page_link]["actual_page"] = 0;
              j("#gallery-template-"+test_id).stop();
              j("#gallery-template-"+test_id).css("left", 600*freshwork.move);
              j("#gallery-template-"+test_id).css("display", "block");
              j("#gallery-template-"+test_id).animate({left:0},{duration:change_speed, easing:'jswing'});
              freshwork.gallery_id= (freshwork.gallery_id-1)*(-1);
              freshwork.actual_page_template = "gallery-template-"+freshwork.gallery_id;
              freshwork.actual_page = page_link;
            //  alert(page_link);
              var item_count = freshgall.gallery[page_link]["item_count"];
              var x = 0;
              for(x=0; x<=5;x++)
              {
                if(x<=item_count){
                 if(freshgall.gallery[page_link][x]["video"] == "true")
                  {
                      j("#gallery-template-"+test_id).find(".center_button_wrapper").attr("name","video");
                     j("#gallery-template-"+test_id).find('.thumb:eq('+x+')').find(".port_thumb_play").css("display","block");
                  }
                  else { 
                  j("#gallery-template-"+test_id).find(".center_button_wrapper").attr("name","video");
                  j("#gallery-template-"+test_id).find('.thumb:eq('+x+')').find(".port_thumb_play").css("display","none");}
                   
     
    
               j("#gallery-template-"+test_id).find('.thumb:eq('+x+')').parent().css("cursor", "pointer ");
                
                j("#gallery-template-"+test_id).find('.thumb:eq('+x+')').css("display", "block");
                j("#gallery-template-"+test_id).find(".thumb:eq("+x+")").find(".thumb_image").attr("src", freshgall.gallery[page_link][x]["small"]);
                }
                else
                {
            //    alert("sit");
                     j('.thumb:eq('+x+')').parent().css("cursor", "default");
                   j('.thumb:eq('+x+')').css("display", "none");
                }
              }
              
              
                 if(freshgall.gallery[freshwork.actual_page][0]["video"] == "true")
      {
         j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name","video");
        j("#center_button_portfolio-"+test_id).removeClass("center_button_zoom_image");
        j("#center_button_portfolio-"+test_id).addClass("center_button_play_video");
        j("#gallery-template-"+test_id).find(".port_bigimg_play").css("display","block");
         j(".center_button_wrapper").colorbox({iframe:true, innerWidth:425, innerHeight:344, href:freshgall.gallery[freshwork.actual_page][0]["large"]});
      }
      else
      {
         j("#"+freshwork.actual_page_template).find(".center_button_wrapper").attr("name","image");
        j("#gallery-template-"+test_id).find(".port_bigimg_play").css("display","none");
        j("#center_button_portfolio-"+test_id).addClass("center_button_zoom_image");
        j("#center_button_portfolio-"+test_id).removeClass("center_button_play_video");
         j(".center_button_wrapper").colorbox({iframe:false,innerWidth:false, innerHeight:false, href:freshgall.gallery[freshwork.actual_page][0]["large"]});
     //  alert("shit");
      }
        j("#gallery-template-"+test_id).find(".big_image").attr("src",  freshgall.gallery[page_link][0]["medium"]);
              j("#gallery-template-"+test_id).find(".item_name").html( freshgall.gallery[page_link][0]["title"]);
              j("#gallery-template-"+test_id).find(".item_description").html( freshgall.gallery[page_link][0]["content"]);
              Cufon.replace('.item_name');
              
       /*        if(freshgall.gallery[page_link][0]["video"] == "true")
                  {
                  j("#gallery-template-"+test_id).find(".port_bigimg_play").css("display","block");
                  }
              j("#gallery-template-"+test_id).find(".big_image").attr("src",  freshgall.gallery[page_link][0]["medium"]);
              j("#gallery-template-"+test_id).find(".item_name").html( freshgall.gallery[page_link][0]["title"]);
              j("#gallery-template-"+test_id).find(".item_description").html( freshgall.gallery[page_link][0]["content"]);
              Cufon.replace('.item_name');
                      //    return data; 
           /*
              var test_id = (freshwork.gallery_id -1)*(-1);
              j("#gallery-template-"+test_id).css("left", 600);
              j("#gallery-template-"+test_id).css("display", "block");
              j("#gallery-template-"+test_id).animate({left:0},{duration:change_speed, easing:'jswing'});
              freshwork.gallery_id= (freshwork.gallery_id-1)*(-1);
              freshwork.actual_page_template = "gallery-template-"+freshwork.gallery_id;
              freshwork.actual_page = page_link;
              var item_count = freshgall.gallery[page_link]["item_count"];
              var x = 0;
             for(x=0; x<=5;x++)
              {
                alert(item_count);
                if(x<=item_count){
                j("#gallery-template-"+test_id).find('.thumb:eq('+x+')').css("display", "block");
                j("#gallery-template-"+test_id).find(".thumb:eq("+x+")").find(".thumb_image").attr("src", freshgall.gallery[page_link][x]["small"]);
                }
                else
                {
                   j('.thumb:eq('+x+')').css("display", "none");
                }
              }
              j("#gallery-template-"+test_id).find(".big_image").attr("src",  freshgall.gallery[page_link][0]["medium"]);
              j("#gallery-template-"+test_id).find(".item_name").html( freshgall.gallery[page_link][0]["title"]);
              j("#gallery-template-"+test_id).find(".item_description").html( freshgall.gallery[page_link][0]["content"]);
              Cufon.replace('.item_name');
                                 */
          }
 
    
  }  
    freshwork.actual_page = act_page;
    freshwork.actual_page3 =page_link;
    Cufon.replace('h1, h2, h3, h4', { fontFamily: 'Myriad Pro Bold' });
}

////////////////////////////////////////////////////////
// function get_page
// attr: page_link - link generated from freshwork wp function                      
// desc: load page and store it into multi-dimensional field
////////////////////////////////////////////////////////
freshwork.get_page = function (page_link)
{
 if(freshwork.loaded_pages.search(page_link) == -1)   // page wasnt preloaded
  {      
    j.get(freshwork.get_address+"?post_link=" + page_link, function(data, text){
   
     freshwork.page_array[page_link] = data;
     freshwork.preloaded_pages++;
     freshwork.loaded_pages = freshwork.loaded_pages + "," + page_link;
     var page_template = freshwork.parse_attribute("page-template", freshwork.page_array[page_link]);
     if(page_template=="gallery-page")
     {
        freshgall.load_gall(data, page_link);
     }
     else if(page_template=="blog-page")
     {
        freshblog.load_categories(page_link,data );
     }
      return data;
    });
  }
  else
  {
 } 
}

////////////////////////////////////////////////////////
// function get_page_template
// attr: page_link - link generated from freshwork wp function
// desc: search page template name
////////////////////////////////////////////////////////
freshwork.get_page_template = function (page_link)
{
  return this.parse_attribute("page-template", this.page_array[page_link]);
}

////////////////////////////////////////////////////////
// function parse_attribute
// attr: attr - attribute what u want to parse, example "page_title"
// source: source file from where to parse, usualy loaded page
// desc: parse params from page and return it
////////////////////////////////////////////////////////
freshwork.parse_attribute = function (attr, source)
{
  var param_position = source.search(attr);
  if(param_position != -1)
  {
    var divider_position = source.indexOf( this.attr_divider, param_position);
    return source.substring(param_position + attr.length + 1, divider_position);
  }
  return false;
}

////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
// GALLERY OBJECT
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////

freshgall = new Object();
freshgall.gallery_count = 0;    // number of galleries
freshgall.gallery = new Array();// gallery is stored here
                                                         
freshgall.load_gall = function (source, pagelink)
{

   this.gallery[pagelink] = new Array();
   this.gallery[pagelink]["actual_page"] = 0;
  this.gallery[pagelink]["item_count"] = freshwork.parse_attribute("item-count", source);
   var x = 0;
  for(x=0; x<=this.gallery[pagelink]["item_count"];x++)
  {

    this.gallery[pagelink][x] = new Array();
    this.gallery[pagelink][x]["title"] = freshwork.parse_attribute("item-"+x+"-title", source);
    this.gallery[pagelink][x]["content"] = freshwork.parse_attribute("item-"+x+"-content", source);
    this.gallery[pagelink][x]["small"] = freshwork.parse_attribute("item-"+x+"-smallimg", source);
    this.gallery[pagelink][x]["medium"] = freshwork.parse_attribute("item-"+x+"-mediumimg", source);
    this.gallery[pagelink][x]["large"] = freshwork.parse_attribute("item-"+x+"-largeimg", source);
    this.gallery[pagelink][x]["video"] = freshwork.parse_attribute("item-"+x+"-video", source);
    img = new Image();
    img.src = this.gallery[pagelink][x]["small"];
    img.src = this.gallery[pagelink][x]["medium"];

  //  j("img").preload(this.gallery[pagelink][x]["medium"]);
    //alert(this.gallery[pagelink][x]["small"]+x);
 }
  this.gallery_count++;
}

////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
// BLOGPOST OBJECT
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////

freshblog = new Object();
freshblog.categories = "";
freshblog.bloglist = new Array();
freshblog.categories = new Array();
freshblog.actual_com_number = 0;
freshblog.iscomment = 0;
freshblog.actual_article = new Array();
freshblog.load_categories = function (link, source)
{
   this.categories[link] = freshwork.parse_attribute("category-content", source);
   this.bloglist[link] = freshwork.parse_attribute("bloglist-content", source);
  
}
freshblog.load_post = function (link, page_link)
{
//alert("picifuk");
 var test_id=freshwork.blog_id;
// alert("k");
 freshblog.actual_article[page_link] = link;
 //alert("pica");
//   j.get(freshwork.get_address +"?blogpost=comments-send&post_link="+ link, function(data, text){
//   alert(data);
//   });
   j.get(freshwork.get_address +"?blogpost=1&post_link="+ link + "&blogpost_linkaa=" +j.address.pathNames() , function(data, text){
   j(".meta_data").css("display","block");
   if(freshwork.parse_attribute("meta-data",data) !="true"){j(".meta_data").css("display","none");} 
   j("#blog-template-"+test_id).find(".post_title").html(freshwork.parse_attribute("post-title",data));
  //alert(freshwork.parse_attribute("post-date",data));
   j("#blog-template-"+test_id).find(".blog_text_content").html(freshwork.parse_attribute("post-content",data));
   j("#blog-template-"+test_id).find(".comments_number").html(freshwork.parse_attribute("comment-count",data));
   j("#blog_post-"+test_id).find(".date").html(freshwork.parse_attribute("post-date",data)); 
   j("#blog_post-"+test_id).find(".categories").html(freshwork.parse_attribute("post-category",data)); 
   freshblog.actual_com_number = parseInt(freshwork.parse_attribute("comment-count",data));
   Cufon.replace('h1, .comments_number, .date, .categories');
  
  //   alert();
      // alert(freshwork.parse_attribute("gallery-content",data));
    j("#gallery_page-"+test_id).html(freshwork.parse_attribute("gallery-content",data));
    j("#gallery_page-"+test_id).jScrollPane({showArrows:true});
    j("#share_page-"+test_id).html(freshwork.parse_attribute("share-content",data))
    j("#gallery_page-"+test_id).jScrollPane({showArrows:true});
    j(".blog_gallery_link").colorbox();
    
      j("#blog-template-"+test_id).find(".jScrollPaneContainer").css("display","none");
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
  
    // icon_wrapper_article icon_wrapper_bg
    if(freshwork.br == "ie")
    {
         j(".icon_wrapper_bg").css("display", "none");
         j(".icon_wrapper_article").find(".icon_wrapper_bg").css("display", "block");
         j('.icon_wrapper').attr("rel","");
          j(".icon_wrapper_article").attr("rel","selected");
    }
    else
    {
    j(".icon_wrapper_bg").fadeTo(0,0);
      j(".icon_wrapper_article").find(".icon_wrapper_bg").fadeTo(0,1);
      j('.icon_wrapper').attr("rel","");
      j(".icon_wrapper_article").attr("rel","selected");
      
    }
     
   j("#blog-template-"+test_id).find(".loader_wrapper").css("display", "none");
   j("#blog_post-"+test_id).parent().css("display","block");
   j("#blog_post-"+test_id).css("display","block");
    j("#blog_post-"+test_id).css("z-index","999");
    if(freshwork.br == "ie")
    {
       j("#blog_post-"+test_id).css("display", "block");
       j("#blog_post-"+test_id).parent().css("display", "block"); 
   
    }
    else
    {
       j("#blog_post-"+test_id).fadeTo(200,1);
       j("#blog_post-"+test_id).parent().fadeTo(200,1); 
  
    }
     j("#blog_post-"+test_id).jScrollPane({showArrows:true});
   j("#blog_post-"+test_id)[0].scrollTo(0);
   j(".blog_thumb_colorbox").colorbox();
 //   j('.icon_wrapper').attr("rel","");
      

   
   j("#comments_page-"+test_id).html("<div class=\"loader_wrapper\" style=\"display: block; left: 130px; top: 95px;\"><img class=\"loader\" src=\""+ freshsettings.template_url + "/gfx/loader.gif\"></div>");
   j("#comments_page-"+test_id).find(".loader_wrapper").css("left", 110);
   j("#comments_page-"+test_id).find(".loader_wrapper").css("top", 73);
   Cufon.replace(' h1, h2, h3, h4', { fontFamily: 'Myriad Pro Bold' });
    j.get(freshwork.get_address +"?blogpost=comments&post_link="+ link, function(data, text){
      j("#comments_page-"+test_id).html(freshwork.parse_attribute("comment-source",data));
        //  alert(freshblog.iscomment);
      if(freshblog.iscomment == 1)
      {
          
           j("#comments_page-"+test_id).jScrollPane({showArrows:true});
      }
      Cufon.replace('h3, .go_btn_right, h1,h2,h4', { fontFamily: 'Myriad Pro Bold' });

   // j("#comments_page-"+test_id).jScrollPane({showArrows:true});
    //  j("#comments_page-"+test_id).parent().css("display","none");
    });
   });
  j("#blog-template-"+test_id).find(".blog_content[id!=blog_post]").css("display", "none");
  j("#blog_post").fadeTo(200,0);
  j("#blog-template-"+test_id).find(".loader_wrapper").css("display", "block");
  j("#blog-template-"+test_id).find(".loader_wrapper").css("left", 130);
  j("#blog-template-"+test_id).find(".loader_wrapper").css("top", 95);        
}

function pica()
{
      window.location =  freshwork.linktochange;
    //  alert("pica");
      freshwork.counter++;
      if(freshwork.counter >= 6){clearInterval(helper_interval);}
}
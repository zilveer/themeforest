jQuery.noConflict();
(function($) { 
    $(function() {
        $(window).load(function() {
            if ($('.checker').text() == "do") {
                $('#scrolltopblog, #scrollbotblog').css({'display' : 'none'});   
            }            
        });
        $(document).ready(function(){
            $('.homepostload').css({'position' : 'relative'});
        function radislike() {
                        $('.imghBXinner').each(function(){
                                var el = $(this);
                                el.css({"position":"absolute"}).wrap("<div class='img_wrapperi' style=''>").clone().addClass('img_grayscale').css({"position":"absolute","z-index":"20","opacity":"0"}).insertBefore(el).queue(function(){
                                        var el = jQuery(this);
                                        
                                        el.dequeue();
                                });
                                this.src = grayscale(this.src);
                        });
        };
            
            var inactivetop = true; var inactivebot = false;
            
            $('.scrolltopb').hover(
                function () {
                    if (inactivetop == false) {
                        $('.scrolltopb').fadeTo(400, 0.75);  
                    }
                }, 
                function () {
                    if (inactivetop == false) {
                        $('.scrolltopb').fadeTo(400, 0.5);  
                    }          
                }
              );
            
            $('.scrollbotb').hover(
                function () {
                    if (inactivebot == false) {
                        $('.scrollbotb').fadeTo(400, 0.75);  
                    }
                }, 
                function () {
                    if (inactivebot == false) {
                        $('.scrollbotb').fadeTo(400, 0.5);  
                    }          
                }
              );
        
            $('.scrolltopb, .scrollbotb').fadeTo(0, 0.5);
            $.ajaxSetup({cache:false});
            var gi;
            var colbno = $('.colbno').text();
            var colbho = $('.colbho').text();
    
            $('.loaderblog').css({top:($('#blogarrowrap').height()/2 -7) });
            $('.scrollbotb').click(function(){
                
                gi = 0;
                if ($('.checker').text() != "do") {
                    
                    $('.loaderblog').css({top:($('#blogarrowrap').height()/2 -7) });
                    $('.loaderblog').fadeTo(200, 1);
                    loadc++;
                    inactivetop = false; 
                    
                    $('.scrolltopb').fadeTo(0, 0.5);  
                    var pageid = $('.nextprev a').attr("href");
                   // alert(pageid);
                    var nesto = $('.postwrap').size() * 200;
     
                    $('.postwrap').animate({top: "-="+nesto+"px"}, 800, function() {});
                        pageid = $('.nextprev a').attr("href");
                        window.setTimeout(function() {
                   $('#blogarrowrap').load(pageid, {ishome: 1}, function() {
                        $('.readmore, .readmoreinner, #submitC, #contactsubmit').hover(function(){
        $(this).stop().animate({backgroundColor: '#'+colbho}, 300);
    }, function() {
        $(this).stop().animate({backgroundColor: '#'+colbno}, 300);
    })
                    if ($('.checker').text() == "do") {$('.scrollbotb').fadeTo(0, 0.25); inactivebot = true;  }
                        $('.movemento').css({'top' : nesto+50});
                        
                        $('.movemento').animate({top: "0px"}, 800, function() {if (gi == 0) {radislike();gi++;}});
    $(".postwrap, .galleryimage").hover(
      function () {
        
        $('.img_grayscale', this).stop().fadeTo('800', 1);
      }, 
      function () {
        $('.img_grayscale', this).stop().fadeTo('800', 0);

      }
    );
    $('.loaderblog').fadeTo(0, 0);
                    });
                        }, 800);
                    
                } else {
                    $('.scrollbotb').fadeTo(0, 0.25);     
                }
            });
            $('.scrolltopb').fadeTo(0, 0.25);
            var loadc = 0;
            $('.scrolltopb').click(function(){
               
                gi = 0;
                if (loadc != 0) {
                    $('.loaderblog').css({top:($('#blogarrowrap').height()/2 -7) });
                    $('.loaderblog').fadeTo(200, 1);
                    loadc--;
                    inactivebot = false;
                    $('.scrollbotb').fadeTo(0, 0.5); 
                    var pageid = $('.prevprev a').attr("href");
                    var nesto = $('.postwrap').size() * 200;
    
                    
                    $('.postwrap').animate({top: "+="+(nesto+50)+"px"}, 800, function() {});
                        pageid = $('.prevprev a').attr("href");
                        window.setTimeout(function() {
                        $('#blogarrowrap').load(pageid, {ishome: 1}, function() {
                                $('.readmore, .readmoreinner, #submitC, #contactsubmit').hover(function(){
        $(this).stop().animate({backgroundColor: '#'+colbho}, 300);
    }, function() {
        $(this).stop().animate({backgroundColor: '#'+colbno}, 300);
    })
                            if (loadc == 0)  {$('.scrolltopb').fadeTo(0, 0.25); inactivetop = true;   }
                            $('.movemento').css({'top' : "-"+nesto+"px"});
                            $('.movemento').animate({top: "0px"}, 800, function() {
                            if (gi == 0) {radislike();gi++;}                              
                            });
            
    $(".postwrap, .galleryimage").hover(
      function () {
        
        $('.img_grayscale', this).stop().fadeTo('800', 1);
      }, 
      function () {
        $('.img_grayscale', this).stop().fadeTo('800', 0);
      }
    );
    $('.loaderblog').fadeTo(0, 0);       
                        });
                 }, 800);      
                    
                } else {
                   $('.scrolltopb').fadeTo(0, 0.25); 
                }
            });
            
            
            $(".homeload").click(function(){
                    $(".loadpageajax").css({ "display": "block"});
                    var post_id = $(this).attr("href");
                    //$(".loadpageajax").html("loading...");
                    $(".loadpageajax").load(post_id, {ishome: 1}, function() {
                        $('.homepostload ').css({'position' : 'absolute'});
                        var hei = $('.pageposttitle').height() + $('.pagepostsub').height();
                        $('.pcontent').css({'height' : (380 - hei) + 'px'}, function() {}).jScrollPane();
                        if ( $('.arrowchecker').text() == '1' ) {$('.scrolls').fadeOut(300);};
            
                        $('.close, .closecontact').click(function() {
                            $('.homepostload ').css({'position' : 'absolute'});
                            $(".loadpageajax").animate({opacity:0, top: -100}, 400, function() {
                                    $("#homepostswrapper").css({ "display": "block"});
                                    $("#homepostswrapper").animate({opacity:1, top: 0},400, function() {$(".loadpageajax").css({ "display": "none"});});
                                    if ( $('.arrowchecker').text() == '1') {$('.scrolls').fadeIn(300);};
                                    
                            });    
                        });
                                
                    });
                    $(".loadpageajax").fadeTo(0, 0);
                    $("#homepostswrapper").animate({opacity:0, top: -100}, 400, function() {
                        $("#homepostswrapper").css({ "display": "none"});
                        $(".loadpageajax").animate({opacity:1, top: 0}, 400, function(){ $('.homepostload').css({'position' : 'relative'});});    
                    
                    });
             

    
                    return false;
            });

        });
    });
})(jQuery);
/*
    tabSlideOUt v1.3
    
    By William Paoli: http://wpaoli.building58.com

    To use you must have an image ready to go as your tab
    Make sure to pass in at minimum the path to the image and its dimensions:
    
    example:
    
        $('.slide-out-div').tabSlideOut({
                tabHandle: '.handle',                         //class of the element that will be your tab -doesnt have to be an anchor
                pathToTabImage: 'images/contact_tab.gif',     //relative path to the image for the tab
                imageHeight: '133px',                         //height of tab image
                imageWidth: '44px',                           //width of tab image   
        });

    or you can leave out these options
    and set the image properties using css
    
*/


(function(d){d.fn.tabSlideOut=function(c){var a=d.extend({tabHandle:".handle",speed:300,action:"click",tabLocation:"left",topPos:"200px",leftPos:"20px",fixedPosition:!1,positioning:"absolute",pathToTabImage:null,imageHeight:null,imageWidth:null,onLoadSlideOut:!1},c||{});a.tabHandle=d(a.tabHandle);var b=this;a.positioning=!0===a.fixedPosition?"fixed":"absolute";!document.all||window.opera||window.XMLHttpRequest||(a.positioning="absolute");null!=a.pathToTabImage&&a.tabHandle.css({background:"url("+
a.pathToTabImage+") no-repeat",width:a.imageWidth,height:a.imageHeight});a.tabHandle.css({display:"block",textIndent:"-99999px",outline:"none",position:"absolute"});b.css({"line-height":"1",position:a.positioning});var g=parseInt(b.outerWidth(),10)+"px",e=parseInt(b.outerHeight(),10)+"px";c=parseInt(a.tabHandle.outerWidth(),10)+"px";var k=parseInt(a.tabHandle.outerHeight(),10)+"px";if("top"===a.tabLocation||"bottom"===a.tabLocation)b.css({left:a.leftPos}),a.tabHandle.css({right:0});"top"===a.tabLocation&&
(b.css({top:"-"+e}),a.tabHandle.css({bottom:"-"+k}));"bottom"===a.tabLocation&&(b.css({bottom:"-"+e,position:"fixed"}),a.tabHandle.css({top:"-"+k}));if("left"===a.tabLocation||"right"===a.tabLocation)b.css({height:e,top:a.topPos}),a.tabHandle.css({top:0});"left"===a.tabLocation&&(b.css({left:"-"+g}),a.tabHandle.css({right:"-"+c}));"right"===a.tabLocation&&(b.css({right:"-"+g}),a.tabHandle.css({left:"-"+c}),d("html").css("overflow-x","hidden"));a.tabHandle.click(function(a){a.preventDefault()});var f=
function(){"top"===a.tabLocation?b.animate({top:"-"+e},a.speed).removeClass("open"):"left"===a.tabLocation?b.animate({left:"-"+g},a.speed).removeClass("open"):"right"===a.tabLocation?b.animate({right:"-"+g},a.speed).removeClass("open"):"bottom"===a.tabLocation&&b.animate({bottom:"-"+e},a.speed).removeClass("open")},h=function(){"top"==a.tabLocation?b.animate({top:"-3px"},a.speed).addClass("open"):"left"==a.tabLocation?b.animate({left:"-3px"},a.speed).addClass("open"):"right"==a.tabLocation?b.animate({right:"-3px"},
a.speed).addClass("open"):"bottom"==a.tabLocation&&b.animate({bottom:"-3px"},a.speed).addClass("open")},l=function(){b.click(function(a){a.stopPropagation()});d(document).click(function(){f()})};c=function(){b.hover(function(){h()},function(){f()});a.tabHandle.click(function(a){b.hasClass("open")&&f()});l()};"click"===a.action&&function(){a.tabHandle.click(function(a){b.hasClass("open")?f():h()});l()}();"hover"===a.action&&c();a.onLoadSlideOut&&(f(),setTimeout(h,500))}})(jQuery);
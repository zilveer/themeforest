/*
 * WPAjaxLoader ver. 1.2.2
 * jQuery Ajax Loader for Wordpress
 *
 * Copyright (c) 2014 Mariusz Rek
 * Rascals Themes 2014
 *
 */
(function(a){a.WPAjaxLoader=function(b){var d={home_url:"",theme_uri:"",dir:"",permalinks:"",ajax_async:true,ajax_cache:false,ajax_events:"",ajax_elements:"",content:"#ajax-content",excludes_links:"",reload_scripts:"/js/custom.js",loadStart:function(){},loadEnd:function(){}},c=this,b=b||{};
c.init=function(){var w=a.extend({},d,b);a.data(document,"WPAjaxLoader",w);var u=true,g=window.history.pushState!==undefined,t=a(w.content),e="",m,l=w.reload_scripts.split(","),h=0,i=new Array(),v=0,o=new Array();
if(w.ajax_async=="on"){w.ajax_async=true;}else{w.ajax_async=false;}if(w.ajax_cache=="on"){w.ajax_cache=true;}else{w.ajax_cache=false;}w.ajax_events=w.ajax_events.split(",");
w.ajax_elements=w.ajax_elements.split(",");w.excludes_links=w.excludes_links.split("|");a("body").append('<div id="loading-layer"><div id="ajax-loader"><div class="spinner" role="spinner"><div class="spinner-icon"></div></div></div></div>');
a("#loading-layer").css("visibility","hidden");function s(y){var x=false;a.each(w.ajax_elements,function(z,A){if(y.is(a(A))){x=true;return false;}});return x;
}function p(x){var y=false;a.each(w.excludes_links,function(z,A){if(A!==""&&x.indexOf(A)>-1){y=true;return false;}});return y;}function n(y){var x;if(typeof y==="string"){x=y;
}else{x=y.attr("href");if((y.hasClass("comment-reply-link"))||(y.attr("id")==="cancel-comment-reply-link")){return false;}else{if(s(y)){return false;}else{if(y.is('[target="_blank"]')){return false;
}}}}if(x.indexOf("wp-admin")>-1||x.indexOf("wp-login")>-1){return false;}else{if(p(x)){a("#loading-layer").css("visibility","visible").addClass("show-layer");
setTimeout(function(){window.location.href=x;},300);return false;}else{if(x.indexOf(".jpg")>-1||x.indexOf(".png")>-1||x.indexOf(".gif")>-1||x.indexOf(".zip")>-1||x.indexOf(".pdf")>-1||x.indexOf(".mp3")>-1||x.indexOf("feed")>-1){return false;
}else{return true;}}}}a("#searchform").submit(function(z){u=false;var y=a("#s").val().replace(/ /g,"+");if(y){var x="/?s="+y;a.address.value(x);}z.preventDefault();
});function j(B){var E=B.split("</head")[0];meta_text=E.split("<meta ").length-1,meta_pos=0,metasprocessed=0,all_meta="";while(metasprocessed<meta_text){var D=E.indexOf("<meta",meta_pos);
end=E.indexOf(">",D),meta=E.substring(D,end);metasprocessed++;meta_pos=end;meta=meta+">";all_meta=all_meta+meta;}a("head meta").remove();a("head").append(all_meta);
var A=B.replace("<body",'<body><div id="body"').replace("</body>","</div></body>");var x=a(A).filter("#body");a("body").removeClass();a("body").attr("class",x.attr("class"));
a("body").data("wp_title",x.data("wp_title"));a("body").data("page_id",x.data("page_id"));document.title=a("body").data("wp_title");if(a("#wp-admin-bar-edit").length){var y=a("body").data("page_id");
var z=a("#wp-admin-bar-edit a").attr("href");var C=z.replace(/(post=).*?(&)/,"$1"+y+"$2");a("#wp-admin-bar-edit a").attr("href",C);}}function r(x){if(x>=i.length){return;
}a.ajax({url:i[x],dataType:"script",async:true,cache:false}).done(function(){r(++v);}).error(function(A,y,z){r(++v);});}a("html").find('link[type="text/css"]').each(function(){o.push(this.href);
});function k(z){var A="",y=a("<div>"+z+"</div>").find("style"),x=a("<div>"+z+"</div>").find('link[type="text/css"]');x.each(function(){if(a.inArray(this.href,o)==-1){a("head").append(this);
o.push(this.href);}});y.each(function(){var C=a(this).attr("media");var B=a(this).html();if(C===undefined||C==="screen"){A+=B;}});a('style:not([media="print"])').remove();
a("head").append('<style type="text/css">'+A+"</style>");}function q(x){var y=a("<div>"+x+"</div>").find("#ajax-container");t.RemoveChildrenFromDom();a("#ajax-container").html(y.html());
t=a("#ajax-content");w.loadEnd.call(this);a("html, body").animate({scrollTop:0},0);if(e.length&&a(e).length){setTimeout(function(){a(window).scrollTop(a(e).offset().top+h);
},500);}a("#loading-layer").removeClass("show-layer");setTimeout(function(){a("#loading-layer").css("visibility","hidden");},600);a.get(window.location);
}var f=function(A){e="";m=a(this);var y=m.attr("href");if(n(m)){if(m.parents().hasClass("vc_tta-panels")){return;}if(m.attr("href")!=="#"){e=y.split("#")[1];
if(e){e=a(this).attr("href").replace(/^.*?#/,"");e="#"+e;y=y.replace(e,"");h=a(this).data("offset");if(h==undefined||h==""){h=parseInt(a("#header").css("height"),10);
h=-(h);}}else{e="";}if(y===""){y=w.home_url+"/";}if(y!==window.location.href){var z=y.replace(w.home_url,"");if(z===""||z==="/"){u=false;a.address.state(w.dir).value(" ");
}else{u=false;a.address.state(w.dir).value(z);}}else{if(e!==""&&e!=="#"){var x=a(e).offset().top+h;a("html, body").animate({scrollTop:x},900);}}}else{y=y.replace(e,"");
e="";}}else{return;}A.preventDefault();};a(document).on("click","a:urlInternal, a:urlFragment",f);a(".dl-menu a:urlInternal, .dl-menu a:urlFragment").on("click",f);
a.address.state(w.dir).init(function(){a('.site a:urlInternal:eq(-"wp-admin"):eq(-"wp-login"):eq(-"#"):eq(-".jpg"):eq(-".gif"):eq(-".png"):eq(-".zip"):eq(-".pdf"):eq(-".mp4"):eq(-".mp3"):eq(-"feed"):not([href="#"])').address();
}).change(function(A){A.value=A.value.replace(" ","");var z=A.value,x=window.location;if(!u){if(n(z)){w.loadStart.call(this);var y=function(){if(!B){return;
}setTimeout(function(){a.ajax({url:w.home_url+A.value,dataType:"html",cache:w.ajax_cache,async:w.ajax_async,success:function(G){var H=a("<div>"+G+"</div>").find("#ajax-container");
var D=G;var F=a(G);var C,E;E=a("<div>"+G+"</div>");C=a("<div>"+G+"</div>").find("script[src]");a("#nav").html(E.find("#nav").html());H.imagesLoaded({background:true},function(){j(G);
k(G);q(G);a.each(w.ajax_events,function(J,K){a(document).off(K);});a(window).off("resize");a(window).off("scroll");v=0;i=[];var I=false;C.each(function(){var J=a(this).attr("src");
a("html script[src]").each(function(){if(a(this).attr("src")===J){I=true;return I;}});a.each(l,function(){if(J.indexOf(this)>-1){I=true;return false;}});
if(I===false){i.push(J);}I=false;});a.each(l,function(){if(a('html script[src*="'+this+'"]').length){i.push(a('html script[src*="'+this+'"]').attr("src"));
}else{if(a('script[src*="'+this+'"]',E).length){i.push(a('script[src*="'+this+'"]',E).attr("src"));}}});r(0);a(G).filter('script:contains("theme_vars")').each(function(){a.globalEval(this.text||this.textContent||this.innerHTML||"");
});});},error:function(E,C,D){if(w.permalinks=="0"){window.location.href=w.home_url+"/?error=404";}else{window.location.href=w.home_url+"/404";}}});},300);
B=false;};var B=true;a("#loading-layer").css("visibility","visible").addClass("show-layer");y();}}});return false;};c.init();};a.WPAjaxLoader.init=function(b){b();
};a.fn.RemoveChildrenFromDom=function(b){if(!this){return;}this.find('input[type="submit"]').unbind();this.children().empty().each(function(f,d){try{d.innerHTML="";
}catch(g){}});this.empty();try{this.get().innerHTML="";}catch(c){}};})(jQuery);
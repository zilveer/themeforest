//Twitter: tweet text autoreplace
jQuery(function($){
    $("ul li[class^='tweet_']").each(function(i,v){
        $(v).html(twttr.txt.autoLink($(v).html()));
    });
});
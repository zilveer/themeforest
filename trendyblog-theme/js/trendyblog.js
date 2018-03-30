var breakingStart = true; // autostart breaking news
var breakingSpeed = 40; // breaking msg speed

var breakingScroll = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var breakingOffset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var elementsToClone = [true, true, true, true, true, true, true, true, true, true];
var elementsActive = [];
var theCount = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

jQuery(document).ready(function() {


	jQuery(".add_to_cart_button").on("click",function() {
		setTimeout(function() {
			var cartItems = jQuery(".df-cart-count", "#header_main");
			var ItemCount = jQuery(".df-cart ul li", "#header_main").size();

			if(ItemCount==1) {
				var val = 'one';
			} else {
				var val = 'more';
			}
			cartItems.html(ItemCount+' '+jQuery(".df-cart-count", "#header_main").data(val));
		}, 1500);
	});


    //Rating System
    jQuery('span.meta_likes').on("click","a",function() {
    	var clicked = jQuery(this);
    	//var voteVal = jQuery(this).attr("data-val");
    	var postID = clicked.attr("data-id");

    	if(!jQuery(this).hasClass('voted')) {
    		if(jQuery.cookie(df.THEME_NAME+'_rating_'+postID)!="set") {
				jQuery.ajax({
					url: df.adminUrl,
					type:"POST",
					data:"action=df_rating_system&post_id="+ postID,
					success:function(results) {
						var tip = clicked.attr('data-tip');
						var heart = clicked.attr('data-heart');
						if(results==1) {
							if (typeof tip !== typeof undefined && tip !== false) {
								clicked.attr('data-tip',results+" like");
							}
							if (typeof heart !== typeof undefined && heart !== false) {
								clicked.attr('data-heart',results+" like");
							}
						} else {
							if (typeof tip !== typeof undefined && tip !== false) {
								clicked.attr('data-tip',results+" likes");
							}
							if (typeof heart !== typeof undefined && heart !== false) {
								clicked.attr('data-heart',results+" likes");
							}
						}
						clicked.addClass('voted');
						if (typeof tip !== typeof undefined && tip !== false) {
							clicked.html('<i class="fa fa-heart"></i>');
						}
						if (typeof heart !== typeof undefined && heart !== false) {
							clicked.html(results);
						}
						jQuery.cookie(df.THEME_NAME+'_rating_'+postID, 'set', { expires: 10, path: '/'});
					}
				});
			} else {
				alert("You already have liked this post!");	
			}
		} else {
			alert("You already have liked this post!");
		}
    });

	// Breaking News Scroller
    jQuery(".breaking-news .container").mouseenter(function () {
        var thisindex = jQuery(this).attr("rel");
        clearTimeout(elementsActive[thisindex]);
    }).mouseleave(function () {
        var thisindex = jQuery(this).attr("rel");
        elementsActive[thisindex] = false;
    });

    start();


});

function start() {
    var z = 0;

    jQuery('.breaking-block ul').each(function () {
        var thisitem = jQuery(this), thisindex = z;
        z = z + 1;
        if (thisitem.find("li").size() > 0) {

            if (!breakingStart) { return false; }
            var theBreakingMargin = parseInt(thisitem.find("li").css("margin-right")),
            	theBreakingWidth = parseInt(thisitem.parent().css("width")),

				itemul = thisitem,
            	itemtemp = 0,
            	items = itemul.find("li").each(function(){
            		itemtemp = itemtemp+parseInt(jQuery(this).width()) + parseInt(jQuery(this).css("padding-right")) + parseInt(jQuery(this).css("margin-right"));
            	});

            theCount[thisindex] = (itemtemp / 2);

            if (elementsToClone[thisindex]) {
                jQuery(this).parent().parent().addClass("isscrolling");
                jQuery('.breaking-block').eq(thisindex).parent().attr("rel", thisindex);
                thisitem.find("li").clone().appendTo(this);

                elementsToClone[thisindex] = false;
            }
            var theNumber = theCount[thisindex] + breakingOffset[thisindex];

            if (Math.abs(theNumber) <= (Math.abs(breakingScroll[thisindex]))) {
                cloneBreakingLine(thisindex);
            }

            if (!elementsActive[thisindex]) {
                elementsActive[thisindex] = setInterval(function () {
                    beginScrolling(thisitem, thisindex);
                }, breakingSpeed);
            }
        }
    });

    setTimeout("start()", breakingSpeed);
}

function beginScrolling(thisitem, thisindex) {
    breakingScroll[thisindex] = breakingScroll[thisindex] - 1;
    thisitem.css("left", breakingScroll[thisindex] + 'px');
}

function cloneBreakingLine(thisindex) {
    breakingScroll[thisindex] = 0;
    jQuery('.breaking-block').eq(thisindex).find('ul').css("left", "0px");
}

/*
jQuery( window ).resize(function() {
	if(jQuery( window ).width() >= 993) {
		jQuery("nav.site_navigation ul.menu").css("display", "block");
		jQuery(".site_navigation_toggle").removeClass('active');
	} else {
		jQuery("nav.site_navigation ul.menu").attr("style", "");
	}
	if(jQuery( window ).width() >= 993) {
		jQuery("nav.top_navigation ul.menu").css("display", "block");
		jQuery(".site_navigation_toggle").removeClass('active');
	} else {
		jQuery("nav.top_navigation ul.menu").attr("style", "");
	}

});
*/
(function($,sr){
 
  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;
 
      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null; 
          };
 
          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);
 
          timeout = setTimeout(delayed, threshold || 100); 
      };
  }
	// smartresize 
	jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
 
})(jQuery,'smartresize');

/* -------------------------------------------------------------------------*
 * 						GET BASE URL		
 * -------------------------------------------------------------------------*/
			
function getBaseURL() {
    var url = location.href;  // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));


    if (baseURL.indexOf('http://localhost') != -1) {
        // Base Url for localhost
        var url = location.href;  // window.location.href;
        var pathname = location.pathname;  // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl + "/";
    }
    else {
        // Root Url for domain name
        return baseURL;
    }

}				
/* -------------------------------------------------------------------------*
 * 						CONTACT FORM EMAIL VALIDATION	
 * -------------------------------------------------------------------------*/
			
	function Validate() {

		var errors = "";
		var reason_name = "";
		var reason_mail = "";
		var reason_message = "";

		reason_name += validateName(document.getElementById('writecomment').u_name);
		reason_mail += validateEmail(document.getElementById('writecomment').email);
		reason_message += validateMessage(document.getElementById('writecomment').message);


		if (reason_name != "") {
			jQuery("#contact-name-error .ot-error-text").text(reason_name);
			jQuery(".comment-form-author input").addClass("error");
			jQuery("#contact-name-error").fadeIn(1000);
			errors = "Error";
		} else {
			jQuery(".comment-form-author input").removeClass("error");
			jQuery("#contact-name-error").css({ 'display': 'none'});
		}


		if (reason_mail != "") {
			jQuery("#contact-mail-error .ot-error-text").text(reason_mail);
			jQuery(".comment-form-email input").addClass("error");
			jQuery("#contact-mail-error").fadeIn(1000);
			errors = "Error";
		} else {
			jQuery(".comment-form-email input").removeClass("error");
			jQuery("#contact-mail-error").css({ 'display': 'none'});
		}
		
		if (reason_message != "") {
			jQuery("#contact-message-error .ot-error-text").text(reason_message);
			jQuery(".comment-form-text textarea").addClass("error");
			jQuery("#contact-message-error").fadeIn(1000);
			errors = "Error";
		} else {
			jQuery(".comment-form-text textarea").removeClass("error");
			jQuery("#contact-message-error").css({ 'display': 'none'});
		}
		
		if (errors != ""){
			return false;
		} else {
			return true;
		}
		
		//document.getElementById("writecomment").submit(); return false;
	}
	
/* -------------------------------------------------------------------------*
 * 								AWEBER WIDGET VALIDATION	
 * -------------------------------------------------------------------------*/
			
	function Validate_aweber() {
		var errors = "";
		var reason_name = "";
		var reason_mail = "";


		reason_name += validateName(document.getElementById('aweber-form').u_name);
		reason_mail += validateEmail(document.getElementById('aweber-form').email);


		if (reason_name != "") {
			jQuery("#aweber-fail").css({ 'display': 'block'});
			errors = "Error";
		} else {
			jQuery("#aweber-fail").css({ 'display': 'none'});
		}

		if (reason_mail != "") {
			jQuery("#aweber-fail").css({ 'display': 'block'});
			errors = "Error";
		} else {
			jQuery("#aweber-fail").css({ 'display': 'none'});
		}
		
		
		if (errors != ""){
			return false;
		} else {
			return true;
		}
		
		//document.getElementById("aweber-form").submit(); return false;
	}
	

	function implode( glue, pieces ) {  
		return ( ( pieces instanceof Array ) ? pieces.join ( glue ) : pieces );  
	} 	
	
/* -------------------------------------------------------------------------*
 * 						SEARCH IN NAVIGATION	
 * -------------------------------------------------------------------------*/
 
	jQuery(document).ready(function() {
		jQuery(".navigation-search").append("<ul id=\"navigation-search\" style=\"display: none;\"><li><form  method=\"get\" action=\"\" name=\"searchform\" ><input type=\"text\" class=\"search\" placeholder=\"Search here \"  name=\"s\" id=\"s\"/><input type=\"submit\" class=\"submit\" /></form></li></ul>");
		jQuery(".navigation-search > a > i").wrap("<span></span>");
		jQuery(".navigation-search").mouseover(function() {
			jQuery("#navigation-search").show();
		});
		jQuery(".navigation-search").mouseout(function() {
			jQuery("#navigation-search").hide();
		});
	});
	
/* -------------------------------------------------------------------------*
 * 						SUBMIT CONTACT FORM	
 * -------------------------------------------------------------------------*/
 	jQuery(document).ready(function(jQuery){
		var adminUrl = ot.adminUrl;
		jQuery('#contact-submit').click(function() {
			if (Validate()==true) {
			var str = jQuery("#writecomment").serialize();
				jQuery.ajax({
					url:adminUrl,
					type:"POST",
					data:"action=footer_contact_form&"+str,
					success:function(results) {	
						jQuery(".contact-success-block").css({ 'display': 'block'});
						jQuery("#writecomment").css({ 'display': 'none'});
					
					}
				});
			}
		});
	});	
/* -------------------------------------------------------------------------*
 * 						SUBMIT AWEBER WIDGET FORM	
 * -------------------------------------------------------------------------*/
 	jQuery(document).ready(function(jQuery){
		var adminUrl = ot.adminUrl;
		jQuery('#aweber-submit').click(function() {
			if (Validate_aweber()==true) {
			var str = jQuery("#aweber-form").serialize();
			jQuery("#aweber-loading").css({ 'display': 'block'});
				jQuery.ajax({
					url:adminUrl,
					type:"POST",
					data:"action=aweber_form&"+str,
					success:function(results) {	
						if(results){
							jQuery("#aweber-loading").css({ 'display': 'none'});
							jQuery("#aweber-fail").css({ 'display': 'block'});
							jQuery("#aweber-fail p").html(results);
						} else {
							jQuery("#aweber-form").css({ 'display': 'none'});
							jQuery("#aweber-success").css({ 'display': 'block'});
							jQuery("#aweber-loading").css({ 'display': 'none'});
						}
					}
				});
			}
		});
	});	


/* -------------------------------------------------------------------------*
 * 						ADD CLASS TO COMMENT BUTTON					
 * -------------------------------------------------------------------------*/
jQuery(document).ready(function(){
	jQuery('#writecomment .form-submit input').addClass('styled-button');
	jQuery('.comment-reply-link').addClass('button-link invert right');
	
});



/* -------------------------------------------------------------------------*
 * 								GALLERY	CATEGORY		
 * -------------------------------------------------------------------------*/
	jQuery(function() {

		// cache container
		var jQuerycontainer = jQuery('#gallery-full');
		var galleryCat = ot.galleryCat;
		
		jQuery(window).load(function(){
			jQuerycontainer.show();
			jQuerycontainer.isotope({
				itemSelector : '.gallery-image',
				layoutMode : 'fitRows',
				resizable: false,
				masonry: { columnWidth: jQuerycontainer.width() / 5 }
			});
		
			jQuery(window).smartresize(function(){
				jQuerycontainer.isotope({
					itemSelector : '.gallery-image',
					layoutMode : 'fitRows',
					resizable: false,
					masonry: { columnWidth: jQuerycontainer.width() / 5 }
				});
			});
		});

		if(galleryCat) {
			// initialize isotope
			jQuerycontainer.isotope({ 
				filter: "."+galleryCat 
			});

			var jQueryoptionSet = jQuery('#gallery-categories a');
				jQueryoptionSet.each(function(index) {
					jQuery(this).removeClass('active');
					if(jQuery(this).attr("data-option")=="."+galleryCat) {
						jQuery(this).addClass('active');
					}
				});				
		}


		
		// filter items when filter link is clicked
		jQuery('#gallery-categories a').click(function(){
			var jQuerythis = jQuery(this);
	
			var jQueryoptionSet = jQuerythis.parents('#gallery-categories');
				jQueryoptionSet.find('.active').removeClass('active');
				jQuerythis.addClass('active');
	  
		
		var selector = jQuerythis.attr('data-option');
		jQuerycontainer.isotope({ 
			filter: selector
		});
		  return false;
		});

		 

 /* 					infinitescroll					*/	

 
		jQuerycontainer.infinitescroll({
			navSelector  : '.gallery-navi',    // selector for the paged navigation 
			nextSelector : '.gallery-navi a.next',  // selector for the NEXT link (to page 2)
			itemSelector : '#gallery-full .gallery-image',     // selector for all items you'll retrieve
			animate      : true,
			loading: {
				finishedMsg: 'No more pages to load.',
				img: ot.imageUrl+'loading.gif'
			}
		},
			function(newElements) {
				jQuery(newElements).imagesLoaded(function(){
					
					//portfolio image load
					jQuery( ".gallery-image",newElements ).each(function() {
							jQuery(".gallery-image").fadeIn('slow');
					
					});
			

					jQuerycontainer.append( jQuery(newElements) ).isotope( 'insert', jQuery(newElements) );



					//after gallery loads
					jQuery(document).on("click", 'a[href="#gal-next"]', newElements, function() {
					  	var thisel = jQuery(this);
					  	var thislist = thisel.parent().children('ul');
					  	var currentel = thisel.parent().children('ul').children('li.active').index();

					  	thisel.parent().children('ul').children('li').removeClass("active").removeClass("next").removeClass("prev");
					  	thisel.parent().children('ul').children('li').eq(currentel).addClass("prev");

					  	currentel = (currentel > thislist.length+1) ? 0 : currentel + 1;
					  	var prevel = (currentel > thislist.length+1) ? 0 : currentel + 1;

					  	thisel.parent().children('ul').children('li').eq(currentel).addClass("active");
					  	thisel.parent().children('ul').children('li').eq(prevel).addClass("next");
					  	return false;
					 });

					jQuery(document).on("click", 'a[href="#gal-prev"]', newElements, function() {
					  	var thisel = jQuery(this);
					  	var thislist = thisel.parent().children('ul');
					  	var currentel = thisel.parent().children('ul').children('li.active').index();

					 	thisel.parent().children('ul').children('li').removeClass("active").removeClass("next").removeClass("prev");
					  	thisel.parent().children('ul').children('li').eq(currentel).addClass("prev");

					  	currentel = (currentel+1 == 0) ? thislist.length-1 : currentel - 1;
					  	var prevel = (currentel+1 == 0) ? thislist.length+1 : currentel - 1;

					  	thisel.parent().children('ul').children('li').eq(currentel).addClass("active");
					  	thisel.parent().children('ul').children('li').eq(prevel).addClass("next");
					  	return false;
					 });

				});  
				
				
			}
		);
		
	});
	
	
	
function removeHash () { 
    var scrollV, scrollH, loc = window.location;
    if ("pushState" in history)
        history.pushState("", document.title, loc.pathname + loc.search);
    else {
        // Prevent scrolling by storing the page's current scroll offset
        scrollV = document.body.scrollTop;
        scrollH = document.body.scrollLeft;

        loc.hash = "";

        // Restore the scroll offset, should be flicker free
        document.body.scrollTop = scrollV;
        document.body.scrollLeft = scrollH;
    }
}

/* -------------------------------------------------------------------------*
 * 								LIGHTBOX SLIDER
 * -------------------------------------------------------------------------*/
	function OT_lightbox_slider(el,side) {

		if(el.attr('rel')%8==0 && side == "right") {
			//carousel('right');
		}	
		
		if(el.attr('rel')%7==0 && side == "left") {
			//carousel('left');
		}
	
	}
 
/* -------------------------------------------------------------------------*
 * 								SOCIAL POPOUP WINDOW
 * -------------------------------------------------------------------------*/
	jQuery('.ot-share, .ot-tweet, .ot-pin, .ot-pluss, .ot-link').click(function(event) {
		var width  = 575,
			height = 400,
			left   = (jQuery(window).width()  - width)  / 2,
			top    = (jQuery(window).height() - height) / 2,
			url    = this.href,
			opts   = 'status=1' +
					 ',width='  + width  +
					 ',height=' + height +
					 ',top='    + top    +
					 ',left='   + left;

		window.open(url, 'twitter', opts);

		return false;
	});


/* -------------------------------------------------------------------------*
 * 								GALLERY	LIGHTBOX
 * -------------------------------------------------------------------------*/
 
jQuery(".light-show").live("click", function(){
	var newWindowWidth = jQuery(window).width();
	var galID = jQuery(this).attr('data-id');
	var next = parseInt(jQuery(this).find("img").attr('data-id'));
	if(newWindowWidth >= 767) { 
		if(!next) {
			next=1;
		}
		
		ot_lightbox_gallery(galID,next);
		return false;
	}
});
 
function ot_lightbox_gallery(galID,next) {
	
	jQuery("h2.light-title").html("Loading..");
	jQuery(".lightbox").css('display', 'block');
	jQuery(".lightcontent-loading").fadeIn('slow');
	jQuery(".lightcontent").css('display', 'none');

	jQuery('.lightcontent').load(ot.themeUrl+'/includes/_lightbox-gallery.php', function() {
		window.location.hash = galID;
		

		var prev = next-1;
		
		
		ID = galID.replace(/[^0-9]/g, '');
		jQuery(".ot-slide-item").attr('id',ID);
		jQuery.ajax({
			url:ot.adminUrl,
			type:"POST",
			data:"action=OT_lightbox_gallery&gallery_id="+ID+"&next_image="+next,
			dataType: 'json',
			success:function(results) {
			
				jQuery(".ot-gallery-image").attr("src", results['next']);
				jQuery(".ot-gallery-image").css("max-height", jQuery(window).height()+"px");

				jQuery(".ot-gallery-image").load(function(){
					jQuery(".lightcontent-loading").css('display', 'none');
					jQuery("body").css('overflow', 'hidden');
					jQuery(".lightbox .lightcontent").delay(200).fadeIn('slow');
					jQuery("h2.light-title").html("");
					jQuery("h2.ot-light-title").html(results['title']);
					jQuery("#ot-lightbox-content").html(results['content']);
					jQuery(".ot-gallery-image").attr('alt', results['title']);
				});
				
				jQuery.each(results.thumbs, function(k,v) {
					var li = '<a href="javascript:;" rel="'+(k+1)+'" class="gal-thumbs" data-nr="'+(k+1)+'"><img src="'+v+'" alt=""/>';	
					jQuery('#ot-lightbox-thumbs').append(li);
					
				});
				
				jQuery(".ot-last-image").attr('data-last', results['total']);
				jQuery(".numbers span.total").html(results['total']);
				jQuery(".numbers span.current").html(next);
				jQuery(".ot-gallery-image").attr('data-id', next);
				if(results['total']>=2) {
					jQuery(".next-image").attr('data-next', next+1);
					jQuery(".gallery-full-photo .next").attr('rel', next+1);
				} else {
					jQuery(".next-image").attr('data-next', next);
					jQuery(".gallery-full-photo .next").attr('rel', next);
				}
				jQuery(".gallery-full-photo .prev").attr('rel', prev);
				
				OT_gallery.a_click(ot.adminUrl, ID);


			}
		});
		
	});
	
}  


	var type = window.location.hash.replace(/[^a-z]/g, '');
	if(type=="gallery") {
		ot_lightbox_gallery(window.location.hash,1);
	}

	
/* -------------------------------------------------------------------------*
 * 								addLoadEvent
 * -------------------------------------------------------------------------*/
	function addLoadEvent(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
			window.onload = func;
		} else {
			window.onload = function() {
				if (oldonload) {
					oldonload();
				}
			func();
			}
		}
	}
	
	
/* -------------------------------------------------------------------------*
 * 								Woocommerce
 * -------------------------------------------------------------------------*/

jQuery(document).ready(function() {


	jQuery('#ot-shop-content').imagesLoaded( function() {
		jQuery('#ot-shop-content').masonry({
			itemSelector: '.column3, .product-category',
			isAnimated: true
		});
	});

	jQuery(".add_to_cart_button").on("click",function() {
		var cartItems = jQuery(".ot-cart-count").html();
		
		setTimeout(function() {
		    jQuery(".ot-cart-count").html(jQuery(".ot-cart ul li").size());
		    jQuery('#ot-shop-content').masonry({
			itemSelector: '.column3, .product-category',
			isAnimated: true
		});
		}, 1000);
	});

	jQuery( window ).resize(function() {
		jQuery('#ot-shop-content').masonry({
			itemSelector: '.column3, .product-category',
			isAnimated: true
		});	
	});

});
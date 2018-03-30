jQuery.noConflict();

function lightboxOnResize() {
    if (jQuery(window).width() <= 768) {
        jQuery('[data-lightbox]').each(function () {
            var currentData = jQuery(this).attr("data-lightbox");
            if (currentData) {
                jQuery('a[data-lightbox]').attr("data-lightbox-off", currentData).removeAttr("data-lightbox");
            }
        });
    } else {
        jQuery('[data-lightbox]').each(function () {
            var currentData = jQuery(this).attr("data-lightbox-off");
            if (currentData) {
                jQuery('a[data-lightbox]').attr("data-lightbox", currentData).removeAttr("data-lightbox-off");
            }
        });
    }
}

/* helper : scroll function */

function scrollToAnchor(aid) {
    jQuery('html,body').animate({scrollTop: aid.offset().top - mainNavHeight}, 600, 'swing');
}

function initProgressBars() {
    /* progress bars */
    /* uses jquery viewport plugin */
    jQuery(".progress:in-viewport").each(function () {
        var $barEl = jQuery(this).find(".bar");

        if ($barEl.width() == 5) {
            $barEl.delay(700).stop().animate({
                "width": jQuery(this).attr("data-percentage") + "%"
            }, 1000, "swing");
        }
    });
}


/* prevent default browser behaviour when there is # in url (this is replaced on line 46)*/
setTimeout(function () {
    if (location.hash) {
        window.scrollTo(0, 0);
    }
}, 1);

/* variable used for sticky menu calculations */
var mainNavHeight;


jQuery(window).on('resize', function ($) {
    lightboxOnResize();
});

jQuery(document).ready(function ($) {
    mainNavHeight = jQuery('#MainNav').height();

    if (jQuery(this).scrollTop() >= 199) {
        jQuery('#toTop').fadeIn();
    } else {
        jQuery('#toTop').fadeOut();
    }
});


jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() >= 199) {
        jQuery('#toTop').fadeIn();
    } else {
        jQuery('#toTop').fadeOut();
    }
    initProgressBars();
});
jQuery(window).load(function ($) {

    initProgressBars();
    lightboxOnResize();


    /* parallax */

    //.parallax(xPosition, speedFactor, outerHeight) options:
    //xPosition - Horizontal position of the element
    //inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
    //outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
    /*    jQuery('.parallax').each(function(){
     jQuery(this).parallax("20%", 0.2);
     });*/



    /* easy pie chart */
    jQuery('.graph-circle').each(function () {
        var $t = jQuery(this);
        var scaleColor = $t.attr('data-scalecolor');
        var trackColor = $t.attr('data-trackcolor');

        $t.easyPieChart({
            animate: $t.attr('data-animate'),
            barColor: $t.attr('data-barcolor'),
            trackColor: trackColor,
            scaleColor: scaleColor == 'false' ? false : scaleColor,
            lineCap: $t.attr('data-linecap'),
            lineWidth: $t.attr('data-linewidth'),
            size: $t.attr('data-size')
        });
    });

    /* remove empty containers */
    jQuery('.container').each(function(){
        if (jQuery(this).children().length < 1) {
            jQuery(this).remove();
        }
    });

    /* main navigation scrolling */
    var a = {selector: "#MainNav.sticky", "class": "stick", offset: 0};
    var b = jQuery(a.selector);
    if (b.offset()) {
        a.offset = b.offset().top;
        var c = jQuery(window).scrollTop();
        c >= a.offset ? (b.addClass(a["class"])) : b.removeClass(a["class"]);
    }
    jQuery(window).scroll(function () {
        var c = jQuery(window).scrollTop();
        c >= a.offset ? (b.addClass(a["class"])) : b.removeClass(a["class"]);
    });

	if(jQuery("body").hasClass("home")) {
	    jQuery('#MainNav .navbar-inner a[href^="/#"]').on('click', function (e) {
	        if (!jQuery('#MainNav button').hasClass("collapsed")) {
	            jQuery('#MainNav button').click();
	        }

	        e.preventDefault();
	        var target = this.hash, $target = jQuery(target);
            if (jQuery(document).width() <= 980) {
                var offset = $target.offset().top;
            } else {
                var offset = $target.offset().top - mainNavHeight;
            }

	        jQuery('html, body').stop().animate({
	            'scrollTop': offset
	        }, 600, 'swing', function () {
	            /*window.location.hash = target;*/
	        });
	    });
	}

	jQuery('#MainNav a.arrow').on('click', function (e) {

     e.preventDefault();
     var target = this.hash, $target = jQuery(target);
     if (target == "#MainNav") {
         var offset = $target.offset().top;
     }
     jQuery('html, body').stop().animate({
         'scrollTop': offset
     }, 600, 'swing', function () {
         /*window.location.hash = target;*/
     });
    });

    jQuery('#toTop').on('click', function (e) {
        e.preventDefault();
        time = jQuery(window).scrollTop()/4;
        jQuery('html, body').stop().animate({
            'scrollTop': 0
        }, time, 'swing');
    });

    /* 100ms after everything is loaded we scroll to # */
    setTimeout(function () {
        if (location.hash) {
		        if (location.hash.match("^#filter")) {
		           return false;
		        }

            if (jQuery('#MainNav.sticky').css('position') == 'static') {
                window.scrollTo(0, jQuery(location.hash).offset().top);
            } else if (jQuery('#MainNav.sticky').css('position') == 'fixed') {
                window.scrollTo(0, jQuery(location.hash).offset().top - mainNavHeight);
            } else if (jQuery('#MainNav.sticky').css('position') == 'relative') {
                window.scrollTo(0, jQuery(location.hash).offset().top);
            } else {
                window.scrollTo(0, jQuery(location.hash).offset().top);
            }
        }
    }, 150);

    jQuery('.post-meta .comment a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        var target = this.hash, $target = jQuery(target);
        if (jQuery(document).width() <= 980) {
            var offset = $target.offset().top;
        } else {
            var offset = $target.offset().top - mainNavHeight;
        }
        jQuery('html, body').stop().animate({
            'scrollTop': offset
        }, 600, 'swing', function () {
            /*window.location.hash = target;*/
        });
    });

    /* works ajax portfolio */

    /* numbers thumbnails in work list (#CTWork .slides) from 1 to x */
    var workThumbnails = jQuery("#CTWork .preview ul.slides li a");

    workThumbnails.each(function (index, thumbnail) {
        var i = index + 1;
        jQuery(thumbnail).data("index", i);
    });

    /* show/hide animation */
    function showFullView() {
        jQuery("#CTWork").removeClass("general").addClass("details");
        jQuery('html, body').animate({
            scrollTop: jQuery("#CTWork").offset().top
        }, 500);
    }

    function hideFullView() {
        jQuery("#CTWork").removeClass("details").addClass("general");
        jQuery('html, body').animate({
            scrollTop: jQuery("#CTWork").offset().top
        }, 500);
    }



    function findSiblings(index, list) {
        var pindex = index - 1;
        var ptarget = "";
        if (pindex <= 0) {
            pindex = list.length;
            ptarget = list.last().attr("href");
        } else {
            ptarget = list.filter(function () {
                return (jQuery(this).data("index") == pindex)
            });
            ptarget = ptarget.attr("href");
        }
        var nindex = index + 1;
        var ntarget = "";
        if (nindex > workThumbnails.length) {
            nindex = 1;
            ntarget = list.first().attr("href");
        } else {
            ntarget = list.filter(function () {
                return (jQuery(this).data("index") == nindex)
            });
            ntarget = ntarget.attr("href");
        }
        siblings = new Object();
        siblings.p = new Object();
        siblings.p.index = pindex;
        siblings.p.target = ptarget;
        siblings.n = new Object();
        siblings.n.index = nindex;
        siblings.n.target = ntarget;
        return siblings;
    }

    var container = jQuery("#CTWork > .container");
    var box = jQuery("section.full-view", container);
    /* Load content with Ajax when thumbnail is clicked */
    jQuery("#CTWork .preview .slides a").on('click', function (e) {
        e.preventDefault();
        var $work = jQuery("#CTWork");
        targets = new Object();
        targets.c = new Object();
        targets.c.target = jQuery(this).attr('href');
        targets.c.index = jQuery(this).data('index');
        targets.s = findSiblings(targets.c.index, workThumbnails);

        if (targets.c.target != "#" && targets.c.target != "") {
            jQuery("#CTWork .full-view").load(targets.c.target, function () {
                jQuery("#CTWork").data('target', targets.c.target);
                jQuery("#CTWork").data('index', targets.c.index);

                /*jQuery(this).parent().height(jQuery(this).outerHeight(true));*/
                showFullView();

                /* create sibling box elements. pre-load next/prev works there. needed in next/prev animation */
                jQuery(function () {
                    box.clone().removeClass().addClass("full-view row-fluid left clone").appendTo(container).load(targets.s.p.target);
                    box.clone().removeClass().addClass("full-view row-fluid right clone").appendTo(container).load(targets.s.n.target);
                    box.addClass("original");
                });
                lightboxOnResize();
            });
        }
       // scrollToAnchor($work.closest('section'));
    });

    /* ------------------------------------------ */
    /* ------------------------------------------ */
    /* ------------------------------------------ */

    function slide(dir) {
        $ = jQuery;
        var $work = jQuery("#CTWork");
        jQuery(".full-view", $work).removeClass("invisible");
        var rclone = jQuery(".clone.right", $work);
        var lclone = jQuery(".clone.left", $work);
        var original = jQuery(".original", $work);
        var targetH = original.height();
        if (dir == "l") {

            $work.data('target', siblings.n.target).data('index', findSiblings($work.data("index"), workThumbnails).n.index);
            siblings = new Object();
            siblings = findSiblings($work.data("index"), workThumbnails);
            siblings.c = new Object();
            siblings.c.target = $work.data("target");
            siblings.c.index = $work.data("index");

            var targetH = rclone.height();
            rclone.toggleClass("clone right original");
            original.toggleClass("clone original left");
            lclone.toggleClass("left right invisible");
            rclone = jQuery(".clone.right", $work);
            rclone.load(siblings.n.target, function () {
                lightboxOnResize();
            });
        } else if (dir == "r") {

            $work.data('target', siblings.p.target).data('index', findSiblings($work.data("index"), workThumbnails).p.index);
            siblings = new Object();
            siblings = findSiblings($work.data("index"), workThumbnails);
            siblings.c = new Object();
            siblings.c.target = $work.data("target");
            siblings.c.index = $work.data("index");

            var targetH = lclone.height();
            lclone.toggleClass("clone left original");
            original.toggleClass("clone original right");
            rclone.toggleClass("right left invisible");
            lclone = jQuery(".clone.left", $work);
            lclone.load(siblings.p.target, function () {
                lightboxOnResize();
            });
        }
    }

    jQuery(document).on('click', "#CTWork .full-view nav a.all", function () {
        hideFullView();
        jQuery("#CTWork .clone").remove();

        return false;
    });
    jQuery(document).on('click', "#CTWork .full-view nav a.prev", function () {
        slide("r");

        return false;
    });
    jQuery(document).on('click', "#CTWork .full-view nav a.next", function () {
        slide("l");

        return false;
    });


    /* mail validation */

    jQuery("input[type='email']").on({
        blur: function () {
            if (jQuery(this).val()) {
                jQuery(this).addClass("filled")
            } else {
                jQuery(this).removeClass("filled")
            }
        }
    });
});


/* scrool spy faq with smooth scroll */
function faqSmoothScroll() {
    jQuery('.faqMenu a').bind('click', function (e) {
        e.preventDefault();
        jQuery('html, body').animate({
            scrollTop: jQuery(this.hash).offset().top }, 300);
    });
}
jQuery(document).ready(function () {
    faqSmoothScroll();

	// clean contact form 7
	jQuery(".wpcf7 br").remove();

	jQuery(".wpcf7 input[type='radio'], .wpcf7 input[type='checkbox']").on("change", function () {
		var $this = jQuery(this);

		var $parent = $this.closest(".wpcf7-radio, .wpcf7-checkbox");
		$parent.find("input").each(function(){
			jQuery(this).closest(".wpcf7-list-item").removeClass("choosen");
		})

		if($this.is(':checked')) {
			$this.closest(".wpcf7-list-item").addClass("choosen");
		}

	});

	jQuery(".wpcf7-radio .wpcf7-list-item, .wpcf7-checkbox .wpcf7-list-item").each(function(){
		var $this = jQuery(this);
		$this.find("input:checked").closest(".wpcf7-list-item").addClass("choosen");
	});

	// custom checkbox and radio

	jQuery('.wpcf7 .customInputs input').iCheck({
		checkboxClass: 'icheckbox_square-orange',
    radioClass: 'iradio_square-orange',
    increaseArea: '20%' // optional
	});

	jQuery('.wpcf7 .customInputs input').on('ifToggled', function(event){
	  $this = jQuery(this);
		$this.closest(".wpcf7-list-item").toggleClass("choosen");
	});

	// custom select

	jQuery('.wpcf7 .customInputs select').selectize()

});


// fade big title
var fadeDiv = jQuery('.scrollFadeEffect');
var scrollDistance = jQuery('#boxedWrapper').height() * 0.6;
jQuery(window).on('scroll', function() {
   var st = jQuery(this).scrollTop();
   fadeDiv.css({ 'opacity' : (1 - st / scrollDistance) });
});

//#28031
jQuery(document).ready(function ($) {
    jQuery('#nav-main a.dropdown-toggle').each(function(){
        if(jQuery(this).data('target') === '#') {
            jQuery(this).removeAttr('data-toggle data-target');
        }
    });
});
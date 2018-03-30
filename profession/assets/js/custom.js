var $ = jQuery;
(function ($) {
    var Reg_Email = /^\w+([\-\.]\w+)*@([a-z0-9]+(\-+[a-z0-9]+)?\.)+[a-z]{2,5}$/i,
        $window = $(window),
        isTouchDevice = 'ontouchstart' in window;
		hash = window.location.hash;
		
/*-----------------------------------------------------------------------------------*/
/*  Alerts
/*-----------------------------------------------------------------------------------*/

	function Alert() {
		$(".alert").click(function(){
			$(this).hide("slow");
		});
	} 
	
/*-----------------------------------------------------------------------------------*/
/*  Blockquotes & Pullquotes
/*-----------------------------------------------------------------------------------*/

    function Quotes() {
        $('blockquote').each(function () {
            $(this).append('<span class="end"></span>');
        });
    }
	
/*-----------------------------------------------------------------------------------*/
/*	Toggle
/*-----------------------------------------------------------------------------------*/

    function Toggle() {

        $('.toggle').each(function () {
            var $accordion = $(this),
                $title = $accordion.find('.toggle_title'),
                $content = $accordion.find('.toggle_content');

            //Close the accordion
            if ($accordion.hasClass('toggle_closed')) {
                $accordion.find('.toggle_content').hide();
            }
            else
                $accordion.find('.toggle_content').css({ display: 'block' });

            $title.click(function (e) {
                e.preventDefault();
                $content.slideToggle();
                $accordion.toggleClass('toggle_closed');
            });
        });

    }
	
/*-----------------------------------------------------------------------------------*/
/*  Tabs
/*-----------------------------------------------------------------------------------*/

    function Tabs() {
        if ($.idTabs) {
            $('.tab .tab_head').idTabs(function (id, list, set) {
                $("a", set).removeClass("selected")
                .filter("[href='" + id + "']", set).addClass("selected");
                for (i in list)
                    $(list[i]).hide();
                $(id).fadeIn();
                return false;
            });
            $('.tab .tab_head li:last-child').addClass('tab_last');
        }
    }
		
/*-----------------------------------------------------------------------------------*/
/*	Forms 
/*-----------------------------------------------------------------------------------*/

	function Forms() {


        var $respond = $('#respond'), $respondWrap = $('#respond-wrap'), $cancelCommentReply = $respond.find('#cancel-comment-reply-link'),
            $commentParent = $respond.find('input[name="comment_parent"]');

        $('.comment-reply-link').each(function () {
            var $this   = $(this),
                $parent = $this.parent().parent();

            $this.click(function () {
                var commId = $this.parents('.comment').find('.comment_id').html();

                $commentParent.val(commId);
                $respond.insertAfter($parent);
                $cancelCommentReply.show();

                return false;
            });
        });

        $cancelCommentReply.click(function (e) {
            $cancelCommentReply.hide();

            $respond.appendTo($respondWrap);
            $commentParent.val(0);

            e.preventDefault();
        });

        ContactForm('#respond');

    }//End Forms()
	
/*-----------------------------------------------------------------------------------*/
/*	ContactForms 
/*-----------------------------------------------------------------------------------*/

    function ContactForm(formContainerId) {

        var $Contact = $(formContainerId);

        if ($Contact.length < 1)
            return;

        var $Form = $Contact.find('form'),
            IsContactForm = $Form.hasClass('contact'),
            Action = $Form.attr('action'),
			$SubmitBtn = $Form.find('input[id="submit"]');
            $submitWrap = $Form.find('.form-submit'),
            $Inputs = $Form.find('input[type="text"],textarea'),
            $Loader = $Form.find('.loader'),
            $AjaxError = $Form.find('.AjaxError'),
            $AjaxComplete = $Form.find('.AjaxSuccess'),
            ValidFields = [$Inputs.length];

        if ($submitWrap.length) {
            $btnWrap = $('<div class="send-button"><input name="submit" type="submit" id="new_submit" value="Post Comment"/></div>');
            $submitWrap.prepend($btnWrap);
            $SubmitBtn.val('');
            $btnWrap.prepend($SubmitBtn);
        }

		$SubmitBtn = $Form.find('input[id="new_submit"]');
		
        //Retry link
        $AjaxError.find('a').click(function (e) {
            $AjaxError.hide();
            $SubmitBtn.click();
            e.preventDefault();
        });

        //Handle form submission
        $SubmitBtn.click(function (e) {
            var IsValid = true;

            $Inputs.blur();

            //Check if all fields are valid
            $.each(ValidFields, function (i, v) {
                if (v == false) {
                    IsValid = false;
                    return false;
                }
            });

            if (!IsValid) {
                e.preventDefault();
                return;
            }

            //No need to continue the submission process
            if (!IsContactForm)
                return;

            var values = $Form.serialize();

            //Show progress bar
            $Loader.fadeIn('fast');
            //Prevent multi clicking
            $SubmitBtn.parent().fadeOut('fast');

            //Send post request
            $.ajax({
                type: "POST",
                url: Action,
                data: values,
                error: function (xhr, error) {
                    $Loader.hide();
                    $AjaxError.fadeIn('fast');
                },
                success: function (msg) {
                    $Loader.hide();
                    if (msg === 'OK')
                        $AjaxComplete.fadeIn('fast');
                    else
                        $AjaxError.fadeIn('fast');
                }
            });

            e.preventDefault();
        });

        //Handle Controls Lost Focus Event
        $Inputs.each(function (i) {
            var $me = $(this),
                type = $me.attr('name'),
                DefaultVal = $me.attr('placeholder'),
                $Error = $Contact.find('.' + type + 'Error');

            if (typeof DefaultVal == 'undefined')
                DefaultVal = '';

            //Control lost focus
            $me.blur(function () {
                var Value = $.trim($me.val()),
                    isValid = true;

                //Validate by type
                if (type == 'email') {
                    if (!Reg_Email.test(Value) || Value == DefaultVal) {
                        isValid = false;
                    }
                }
                else if (type == 'author' || type == 'surname') {
                    if (Value.length < 1 || Value.length > 50 || Value == DefaultVal) {
                        isValid = false;
                    }
                }
                else if (type == 'comment') {
                    if (Value.length < 1 || Value.length > 1000) {
                        isValid = false;
                    }
                }

                if (!isValid) {
                    $Error.fadeIn('fast');
                    ValidFields[i] = false;
                }
                else {
                    $Error.fadeOut('fast');
                    ValidFields[i] = true;
                }

            }); //$me.blur
        });

    }//End ContactForm

/*-----------------------------------------------------------------------------------*/
/*	fix portfolio height
/*-----------------------------------------------------------------------------------*/
	
	function fix_portfolio_height() {
		$("#gallery").find('.item-image').each(function () {
	
			var $item_image = $(this);
			$imgH = $item_image.find('img');
			
			var $imgHeight;
			var $container = $('#gallery');		
			$imgH.one('load', function() {
				$imgHeight = 'height:' + $imgH.height() + 'px';
				$container.isotope('reLayout');
				
			}).each(function() {
			  if(this.complete)$(this).load();
			});
		
			  $item_image.css('cssText',$imgHeight);
		});
	} 

/*-----------------------------------------------------------------------------------*/
/*	magnific-popup
/*-----------------------------------------------------------------------------------*/	 

	function magnificpopup() {
        var x = " Hello World!";
	    if($('.ajax-popup-link').length){
            $('.ajax-popup-link').magnificPopup({
                type: 'ajax',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in',

                callbacks: {
                    parseAjax: function(mfpResponse) {
								
                            var z = $(mfpResponse.data).find('.portfolio-content');
                            var y = $(mfpResponse.data).filter('.portfolio-content');
							var obj = (z.length)?z:y;
                            mfpResponse.data = obj;
							
                    },
                    ajaxContentAdded: function() {
                       
                        flexSlider();
                        init_shortcode_chart();
                        Tabs();
                        Toggle();
                        Alert();
                        Quotes();
                    },
                    afterClose: function() {


                    },updateStatus: function( data ) {
                        if( data.status === 'ready' ) {
                            if ( $(".ajs-redsky").length ) {
                                if ( ! $(".ajs-redsky .audiojs").length ) {
                                    audiojs.events.ready( function() {
                                        var audio = audiojs.create( $("audio"), { css: '' } );
                                    } );
                                }
                            }

                        }
                    }

                }
            });
        }

        if($('.popup-with-form').length){
            $('.popup-with-form').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-slide-bottom',

                // When elemened is focused, some mobile browsers in some cases zoom in
                // It looks not nice, so we disable it:
                callbacks: {
                    updateStatus: function( data ) {
                        if( data.status === 'ready' ) {
                            if ( $(".ajs-redsky").length ) {
                                if ( ! $(".ajs-redsky .audiojs").length ) {

                                    audiojs.events.ready( function() {
                                        var audio = audiojs.create( $("audio"), { css: '' } );
                                    } );
                                }
                            }

                        }
                    }
                }
            });
        }

        if($('.popup-video').length){
            $('.popup-video').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                mainClass: 'my-mfp-slide-bottom',

                fixedContentPos: false
            });
        }

        if($('.image-popup-margins').length){
            $('.image-popup-margins').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'my-mfp-slide-bottom',
                image: {
                    verticalFit: false
                },
                zoom: {
                    enabled: true,
                    duration: 300 // don't foget to change the duration also in CSS
                }
            });
        }
		

		
	} 

/*-----------------------------------------------------------------------------------*/
/*	 blogSingle
/*-----------------------------------------------------------------------------------*/

    function blogSingle() {
        var $container = $('.single .flexslider');
		
        if (!$container.length)
            return;
			
		$container.flexslider({
			animation: "fade",
			controlNav: true,
			//directionNav: false,
			smoothHeight: true
		});  	
    }	
	
/*-----------------------------------------------------------------------------------*/
/*	pageSetup
/*-----------------------------------------------------------------------------------*/	 
  
  function pageSetup(){
        // Vertical Align
        var windowHeight = $(window).height(),
            contentHeight = $('html').height();

		// Content Positon
        if (windowHeight > contentHeight) {
            var $Top = ((windowHeight - contentHeight) / 2);
			if ($(window).width()>1900){
				$Top=+140;
				$('html').css('padding-top',$Top+"px");
			}
			else{
				$('html').css('padding-top',$Top+"px");
			}
        }
		
        var header=($('header').width());
        var withoutheader=($('html').width())-($('header').width());
        var firstblock=withoutheader/2;
        $('.first-block').css('width',firstblock+'px');
        var linewidth=940-($('.social-icons').width()+$('.copyright').width());
        $('#line').css('width',linewidth+'px');
        var lineleft=($('.copyright').width()+20);
        $('#line').css('left',lineleft+'px');

    }
	
/*-----------------------------------------------------------------------------------*/
/*	Navigation
/*-----------------------------------------------------------------------------------*/	 

	function Nav(){
		
		//Assign SuperFish Plug In
		 $('.menu > ul').superfish({ animation: { opacity: 'show', height: 'show' }, delay: 500 , disableHI:   true });
	
        //Rolling Page
		$("div[class*='menu'] a[href*='#']").bind("click", jump);
		if (location.hash){
			
			var h=location.href ;
			$('.active-menu').removeClass('active-menu');            
				$("a[href*='"+h+"']").addClass('active-menu');
				
			//to not give the page offset if page not opened in tablet or other
			if($(window).width()> 768 ){
				var l=parseInt($('.first-block').css('width'), 10);
				$('.mainpart').scrollTo( location.hash , parseInt(pixflow_js_opt.scrolling_speed),{offset:{left:-l}} );
			}
			else {
				$('.mainpart').scrollTo( location.hash , parseInt(pixflow_js_opt.scrolling_speed));
			}

		} else {
			$('.active-menu').removeClass('active-menu');
            if ( ( $('.mainpart').length) || ( $('.vertical-page').length)	)
                $('.menu ul li:first-child a').addClass('active-menu');
            else
                $('.menu a[href="index.html"]').addClass('active-menu');

			if ($('.blog').length)
				$('.menu a[href="blog.html"]').addClass('active-menu');
		}
		
	    // Close/Open Menu On Click

		$('.menu-button-minus').click(function () {
		    var $links = $('.menu');

		    $(this).toggleClass('menu-button-plus');

		    if (($('body.rtl').length)) {
		        //RTL
		        $links.animate({ marginLeft: parseInt($links.css('marginLeft'), 10) == 0 ? (-($links.outerWidth() + 12)) : 0 });

		    } else {
		        $links.animate({ marginLeft: parseInt($links.css('marginLeft'), 10) == 0 ? $links.outerWidth() + 12 : 0 });
		    }


		    $('.header-titles').fadeToggle('slow');

		});

		//go to top button
		$('.go-to-top').click(function(e){

			$(window).scrollTo( 0 , 800);
			$('.active-menu').removeClass('active-menu');
			$('.menu ul li:first-child a').addClass('active-menu');

		});
		
		// Menu Hover 
		$('.menu>ul>li').hover(function(){
			$(this).parents('.menu-area').css('overflow','visible');
			$(this).children('ul').stop().fadeIn();
		},function(){
			$(this).parents('.menu-area').css('overflow','hidden');
			$(this).children('ul').stop().fadeOut().hide();
		});
					
					
		//Mobile Menu
        $(document).click(
            function (e) {
                var $mobileNavBtn = $('.mobile-menu  > a'),
                    ta= e.target,
                    m=$mobileNavBtn.get(0),
                    c=$mobileNavBtn.hasClass('active');

                if ((ta != m) && c)
                    $mobileNavBtn.click();
            }
        );

		
		$('.mobile-menu > a').click(function (e) {
			var $this = $(this),
				$menu = $this.parent().find('> ul');

			if ($this.hasClass('active')) {
				$menu.slideUp('fast');
				$this.removeClass('active');
				$this.removeClass('mobile-button-minus');
			}
			else {
				$menu.slideDown('fast');
				$this.addClass('active');
				$this.addClass('mobile-button-minus');
			}

			e.preventDefault();
		});

    }

/*-----------------------------------------------------------------------------------*/
/*	 Scroll
/*-----------------------------------------------------------------------------------*/	 
   
   function Scroll(){
	
       if (($(window).width() >= 768)) {

		    //nice scroll parts
		    if (pixflow_Scroll_opt.scroll_display === '1' ) {
		        $(".mainpart").niceScroll({ autohidemode: true, hidecursordelay: 10, cursorminheight: 10, scrollspeed: 50, cursorcolor: "#c0c7d5", mousescrollstep: 60, cursorwidth: 0, cursorborder: "2px solid #555" });
		    }

		    $(".mainpart").niceScroll({ autohidemode: true, hidecursordelay: 10, cursorminheight: 10, scrollspeed: 50, cursorcolor: "#c0c7d5", mousescrollstep: 60, cursorwidth: 0, cursorborder: "0 solid #fff" });
			$('.vertical-page,.single ,.blog ,.archive , .search-results , .page-template-template-page-php , .page-template-default').niceScroll({autohidemode:false,cursorwidth:"8px"});

		}
	}   
	
/*-----------------------------------------------------------------------------------*/
/*	 Portfolio
/*-----------------------------------------------------------------------------------*/	 
   
   function Portfolio(){

        //Portfolio Hover image
        var $itemPicture=$('.item');
        if($itemPicture.length )
        {
            var $itemImage=$itemPicture.find('.item-image');

            $itemImage.hover(function () {
                    fadeIn($(this).find('.frame-overlay'),0.9,300);
					fadeIn($(this).find('.portfolio-meta'),0.9,300);
                },function() {
                    fadeOut($(this).find('.frame-overlay'),0,300);
					fadeOut($(this).find('.portfolio-meta'),0,300);
                }
            )
        }

        // isotop
        var $container = $('.isotope');

        if ($container.length < 1)
            return;

        $container.isotope({
            // options
            itemSelector: '.item',
            layoutMode: 'masonry',
            animationEngine: 'best-available'
        });

        // filter items when filter link is clicked
        $('.subnavigation a').click(function (e) {
            e.preventDefault();

            var $this = $(this);

            if ($this.hasClass('.current'))
                return;

            var $optionSet = $this.parents('.subnavigation');

            $optionSet.find('.current').removeClass('current');
            $this.addClass('current');
            var selector = $(this).attr('data-filter');
            $container.isotope({ filter: selector });
        });
    }
 
 /*-----------------------------------------------------------------------------------*/
/*  Blog Load More Function 
/*-----------------------------------------------------------------------------------*/

    function Ajax_Load_Page() {
        var $pageNav = $('.page-navigation'), 
            $blog    = $('#blog_loop');
			$readmore_container = $('#readmore_container');
			
        if (typeof paged_data == 'undefined' || $pageNav.length < 1) 
            return;
        
        var startPage = parseInt(paged_data.startPage),
            nextPage  = startPage + 1,
            max       = parseInt(paged_data.maxPages),
            isLoading = false;

        if (max < 2) return;

        //Replace links with load more button
		 $pageNav.html('<div class="loadmore"><span>+</span><p class="text">' + paged_data.loadMoreText + '</p></div>');
		 
        var $btn = $pageNav.find('.loadmore'),
            $btnText = $btn.find('.text');

        if (nextPage > max) 
            $btnText.text(paged_data.noMorePostsText);
        
        var resTimer = 0;
        $window.resize(function () {
            clearTimeout(resTimer);
            resTimer = setTimeout(function () {
                if ($window.width() < 768) {
                    $pageNav.appendTo($readmore_container);
                }
                else {
                    $pageNav.appendTo($readmore_container);
                }
            }, 100);
        }).resize();

        $btn.click(function () {
            if (nextPage > max || isLoading)
                return;

            isLoading = true;

            //Set loading text
            $btnText.text(paged_data.loadingText);

            var $pageContainer = $('<div class="posts-page-'+nextPage+'"></div>');

            $pageContainer.load(paged_data.nextLink + ' .post', function () {

                //Insert the posts container before the load more button
                $pageContainer.appendTo($blog);

                // Update page number and nextLink.
                nextPage++;

                if (/\/page\/[0-9]+/.test(paged_data.nextLink))
                    paged_data.nextLink = paged_data.nextLink.replace(/\/page\/[0-9]+/, '/page/' + nextPage);
                else
                    paged_data.nextLink = paged_data.nextLink.replace(/paged=[0-9]+/, 'paged=' + nextPage);
				
                if (nextPage <= max)
                    $btnText.text(paged_data.loadMoreText);
                else if (nextPage > max)
                    $btnText.text(paged_data.noMorePostsText);

                isLoading = false;
				
				num = nextPage;
				num--;

				blogtoggle_loadmore();
			
            });
        });
	}

 /*-----------------------------------------------------------------------------------*/
/*	Portfolio Page Load More Function 
/*-----------------------------------------------------------------------------------*/
	 
    function Ajax_Load_PPage() {
		
        var $ppageNav = $('.ppage-navigation'), 
            $pblog    = $('#portfolio_loop'),
			$portfolio_gallery = $('#portfolio_gallery');
			
        if (typeof portfolio_data == 'undefined' || $ppageNav.length < 1) 
            return;
        
        var startPage = parseInt(portfolio_data.startPage),
            nextPage  = startPage + 1,
            max       = parseInt(portfolio_data.maxPages),
            isLoading = false;

        if (max < 2) {
			 $ppageNav.html('<div class="span12 loadmore"><p class="text">' + portfolio_data.noMorePostsText + '</p></div>');
		return
		};

        //Replace links with load more button
		$ppageNav.html('<div class="span12 loadmore"><span>+</span><p class="text">' + portfolio_data.loadMoreText + '</p></div>');
						
						
        var $btn = $ppageNav.find('.loadmore'),
            $btnText = $btn.find('.text');

        if (nextPage > max) 
            $btnText.text(portfolio_data.noMorePostsText);
        
        var resTimer = 0;
        $window.resize(function () {
            clearTimeout(resTimer);
            resTimer = setTimeout(function () {
                if ($window.width() < 768) {
                    $ppageNav.insertAfter($portfolio_gallery);
                }
                else {
                    $ppageNav.insertAfter($portfolio_gallery);
                }
            }, 100);
        }).resize();

        $btn.click(function () {
            if (nextPage > max || isLoading)
                return;

            isLoading = true;

            //Set loading text
            $btnText.text(portfolio_data.loadingText);

            var $pageContainer = $('<div class="posts-page-'+nextPage+'"></div>');

			portfolio_data.nextLink = portfolio_data.nextLink.replace(/\/page\/[0-9]+/, '/?paged1=' + nextPage);
			
			portfolio_data.nextLink = portfolio_data.nextLink.replace(/paged=[0-9]+/, 'paged1=' + nextPage);
			
            $pageContainer.load(portfolio_data.nextLink + ' .portfolio-post', function () {

                //Insert the posts container before the load more button
                $pageContainer.appendTo($pblog);

                // Update page number and nextLink.
                nextPage++;

                if (/\/page\/[0-9]+/.test(portfolio_data.nextLink))
                    portfolio_data.nextLink = portfolio_data.nextLink.replace(/\/page\/[0-9]+/, '/page/' + nextPage);
                else
                    portfolio_data.nextLink = portfolio_data.nextLink.replace(/paged1=[0-9]+/, 'paged1=' + nextPage);
				
                if (nextPage <= max)
                    $btnText.text(portfolio_data.loadMoreText);
                else if (nextPage > max)
                    $btnText.text(portfolio_data.noMorePostsText);

                isLoading = false;
				
				num = nextPage;
				num--;
	
				$items= $('.portfolio-post');
				var $container = $('#gallery');
				$container.append( $items ).isotope( 'insert', $items );
				
				fix_portfolio_height();
				Tabs();
				Toggle();
				init_shortcode_chart();
				Alert();
				Quotes();
				magnificpopup();
				Portfolio();

                //Portfolio pop up flexslider
				flexSlider();

			
            });
        });
	}
	
/*-----------------------------------------------------------------------------------*/
/*	 Resume
/*-----------------------------------------------------------------------------------*/	 
  
    function Resume(){
		 if(($(window).width()>768) && !($('.vertical-page').length)){
            $(".experiences").after('<ul id="fooX" />').next().html($(".experiences").html());
            $(".experiences li:odd").remove();
            $("#fooX li:even").remove();

            $(".experiences").carouFredSel({
                auto:false,
				align:"left",
                synchronise : "#fooX",
                circular:true,
                infinite:false,
                width:'100%',
                prev: '#resume-exp-prev',
                next: '#resume-exp-next',
                swipe: {
                    onMouse: true,
                    onTouch: true
                }

            });
            $("#fooX").carouFredSel({
                auto: false,
                circular:true,
				align:"left",
                width:'100%',
                infinite:false
            });
        }
		
        //For Responsive View
        $(window).resize(function(){
            var Width=$(window).width();
			if((Width<=768)&&(Width>480) && !($('.vertical-page').length)){
                if($('.hideme').css('opacity')==1)
                    $('.car').trigger('destroy',true);
                $(".experiences").trigger('destroy',true);
                $("#fooX").trigger('destroy',true);
				$(".portfolio").mCustomScrollbar("destroy");
            }
			else if( (Width<=480) && !($('.vertical-page').length)){

                if($('.hideme').css('opacity')==1)
                    $('.car').trigger('destroy',true);
                $(".experiences").trigger('destroy',true);
                $("#fooX").trigger('destroy',true);
				$(".portfolio").mCustomScrollbar("destroy");

            }
			else if ( (Width>768) && !($('.vertical-page').length) ){
                if($('.hideme').css('opacity')==1)
                    chart_carousel();

                $(".experiences").carouFredSel({
                    auto:false,
                    synchronise : "#fooX",
					align:"left",
                    circular:true,
                    infinite:false,
                    width:'100%',
                    prev: '#resume-exp-prev',
                    next: '#resume-exp-next',
                    swipe: {
                        onMouse: true,
                        onTouch: true
                    }

                });
                $("#fooX").carouFredSel({
                    auto: false,
					align:"left",
                    width:'100%',
                    circular:true,
                    infinite:false
                });

            }
        });
		
		var mainpartFlag= 0,$element,topFlag=0;

		//if page not load from top show UP button
		if ( ( $('.vertical-page').length ) && ( $(window).scrollTop()>= 100 ) )
		{
			topFlag=1;
			$('.go-to-top').css('opacity',1);

		}

		//Scrolling mainpart to Appear element
		if ( $('.vertical-page').length || ($(window).width()<768) )
		{
			$element=$(window);
		}
		else
		{
			$element=$('.mainpart');
		}

		$element.scroll(function(){
			var i=$(window).scrollTop();


		/* show up button on scrolling */
		if (  i > $('.vertical-mainpart article:first-child').height())
		{
			$('.go-to-top').css('opacity',1);

		}
		/* Hide UP button when we are at top of the page */
		if (  i < $('.vertical-mainpart article:first-child').height()  )
		{
			$('.go-to-top').css('opacity',0);
		}
			

            /* Check the location of each desired element */
            $('#resume').each( function(i){

                var left_of_object = $(this).position().left + $(this).outerWidth()+600;
                var left_of_container= $('.mainpart').scrollLeft() + $('.mainpart').width();

                var top_of_object = $(this).position().top +300;
                var top_of_container= $(window).scrollTop() + $(window).height();

				if ( ($(window).width()<768) && (mainpartFlag === 0) ) {
					  mainpartFlag=1;
					  $('.hideme').animate({'opacity':'1'},'fast',function(){
                        init_chart();
						viewP();
                    });
				} else {
				     /* If the object is completely visible in the window, fade it it */
					if( ((left_of_container > left_of_object ) || (top_of_container > top_of_object)) && (mainpartFlag === 0) ){
						mainpartFlag=1;
						$('.hideme').animate({'opacity':'1'},'fast',function(){
							init_chart();
							viewP();
							if( ($(window).width()>768) && !($('.vertical-page').length) )
								chart_carousel();
						});
					}
				}
            });
        });
    }

/*-----------------------------------------------------------------------------------*/
/*	Easy Pie Chart Function
/*-----------------------------------------------------------------------------------*/	 

    var init_chart=(function() {
        $('.chart').easyPieChart({
            scaleColor:false,
            barColor: pixflow_js_opt.pie_chart_color,
            lineWidth:21,
            trackColor:'#2e2e2e',
            lineCap:'butt',
            animate:1000,
            size:130
        });
    });
	
	
	var init_shortcode_chart=(function() {
		$('.shortcode_chart_skin').easyPieChart({
            scaleColor:false,
			barColor: pixflow_js_opt.pie_chart_color,
            lineWidth:5,
            trackColor:'#e9e6e6',
            lineCap:'butt',
			animate:1200,
            size:130
        });
		
		$('.shortcode_chart').easyPieChart({
            scaleColor:false,
			barColor:'#555',
            lineWidth:5,
            trackColor:'#e9e6e6',
            lineCap:'butt',
			animate:1200,
            size:130
        });
    });
	
/*-----------------------------------------------------------------------------------*/
/*	chart carousel
/*-----------------------------------------------------------------------------------*/	 

	var chart_carousel=(function(){
        $('.car').carouFredSel({
            auto: false,
            circular:false,
            infinite:false,
            prev: '#prev2',
            next: '#next2',
            mousewheel:false,
            swipe: {
                onMouse: true,
                onTouch: true
            }
        });
    });
	
/*-----------------------------------------------------------------------------------*/
/*	viewP
/*-----------------------------------------------------------------------------------*/	 

	var viewP=(function(){
		$('.chart span').css('visibility','visible');
		$('.chartbox p').css('visibility','visible');
	});	

/*-----------------------------------------------------------------------------------*/
/*	jump
/*-----------------------------------------------------------------------------------*/	 

	var jump=function(e)
    {
        var $scrollelemnt;
        if (e){
            e.preventDefault();
            var link = $(this).attr("href");
            if ( link.indexOf('#')>=0 ){
                var page=link.split('#');
                page='#'+page[1];
                if($(page).length){
                    t=page;
                }
                else{
                    window.location.assign($(this).attr("href"));
                }

            }else{
                window.location.assign($(this).attr("href"));
            }
        }else{
            var t = location.hash;
        }

        if($('.vertical-page').length)
        {
            $scrollelemnt=$('.vertical-page');
			
        } else if ($(window).width()<768) 
        {
            $scrollelemnt=$('body');
			
        } else 
		{
			$scrollelemnt=$('.mainpart');
		}
		

		if( ($(window).width()>768) && !($('.vertical-page').length)){
            var l=parseInt($('.first-block').css('width'), 10);
            if ( isNaN(l) )
            {
                l=0;
            }

            $scrollelemnt.scrollTo( $(t), parseInt(pixflow_js_opt.scrolling_speed) ,{offset:{left:-l,top:-60}} );
        }else{
            $scrollelemnt.scrollTo( $(t), parseInt(pixflow_js_opt.scrolling_speed));
        }

        $('.active-menu').removeClass('active-menu');
        $(this).addClass('active-menu');
    }
	
/*-----------------------------------------------------------------------------------*/
/*	map
/*-----------------------------------------------------------------------------------*/	

    function map(){
		
		if($(window).width()<768 )
			$draggable = false;
		else 
			$draggable = true;
	
        $("#map").gmap3({
            map:{
                options:{
					zoom:ZoomLevel,
					disableDefaultUI: true, /*  disabling zoom in touch devices  */
					disableDoubleClickZoom: true, /*  disabling zoom by double click on map   */
					center: new google.maps.LatLng(CITY_MAP_CENTER_LAT, CITY_MAP_CENTER_LNG),
					draggable:$draggable, /*  disable map dragging  */
                    mapTypeControl:true,
                    navigationControl: false,
                    scrollwheel: false,
                    streetViewControl: false,
                    panControl:false,
                    zoomControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControlOptions: {
                        mapTypeIds: [google.maps.MapTypeId.ROADMAP, "Gray"]
                    }
                }
            },
            styledmaptype:{
                id: "Gray",
                options:{
                    name: "Gray"
                },
                styles:[
                        {
                            featureType: "water",
                            elementType: "geometry",
                            stylers: [
                                { color : "#1d1d1d" }
                            ]
                        },{
                        featureType: "landscape",
                        stylers: [
                            {color: "#3e3e3e" },
                            {lightness: 7 }
                        ]
                    },{
                        featureType: "administrative.country",
                        elementType: "geometry.stroke",
                        stylers: [
                            { color: "#5f5f5f" },
                            { weight : 1 }
                        ]
                    },{
                        featureType: "landscape.natural.terrain",
                        stylers: [
                            { color : "#4f4f4f" }
                        ]
                    },{
                        featureType: "road",
                        stylers: [
                            { color: "#393939" }
                        ]
                    },{
                        featureType: "administrative.country",
                        elementType: "labels",
                        stylers: [
                            { visibility: "on" },
                            { weight: 0.4 },
                            { color: "#686868" }
                        ]
                    },{
                        eatureType: "administrative.locality",
                        elementType: "labels.text.fill",
                        stylers: [
                            { weigh: 2.4 },
                            { color: "#9b9b9b" }
                        ]
                    },{
                        featureType: "administrative.locality",
                        elementType: "labels.text",
                        stylers: [
                            { visibility: "on" },
                            { lightness: -80 }
                        ]
                    },{
                        featureType: "poi",
                        stylers: [
                            { visibility: "off" },
                            { color: "#d78080" }
                        ]
                    },{
                        featureType: "administrative.province",
                        elementType: "geometry",
                        stylers: [
                            { visibility: "on" },
                            { lightness: -80 }
                        ]
                    },{
                        featureType: "water",
                        elementType: "labels",
                        stylers: [
                            { color: "#adadad" },
                            { weight: 0.1 }
                        ]
                    },{
                        featureType: "administrative.province",
                        elementType: "labels.text.fill",
                        stylers: [
                            { color: "#3a3a3a" },
                            { weight: 4.8 },
                            { lightness: -69 }
                        ]
                    }

                ]
            },
            marker:{
            values:[{
                'latLng': [CITY_MAP_CENTER_LAT,CITY_MAP_CENTER_LNG]
            }],
                options:{
                'icon':new google.maps.MarkerImage(ICON_MAP)
            }
        }
        });

		if (CUSTOM_MAP == 1) {
			$('#map').gmap3('get').setMapTypeId("Gray");//Display Gray Map On Load  if we don't have this line map loads in default
		}
    }

/*-----------------------------------------------------------------------------------*/
/*	Image Hover
/*-----------------------------------------------------------------------------------*/	
	
    function fadeIn($element, opacity, time){
        $element.css({opacity:0, display: 'block'}).stop().animate({opacity:opacity}, time);
    }
    function fadeOut($element, opacity, time){
        $element.stop().animate({opacity:opacity}, time);
    };

/*-----------------------------------------------------------------------------------*/
/*	Return True if clicked a url is not external link
/*-----------------------------------------------------------------------------------*/

    function ifPageExist( pageName){
        var flag=false;
        $('.cvpage').each(function(){
            var h= $(this).attr('id');
            if(pageName == $(this).attr('id')){
                flag=true;
            }
        });
        return flag;
    }
	
/*-----------------------------------------------------------------------------------*/
/*	IE Fix
/*-----------------------------------------------------------------------------------*/

	function IE_Fix() {

        if (!$.browser.msie) return;

        /***** Add input defaults Fix for IE ******/

        $('[placeholder]').focus(function () {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function () {
                var input = $(this);
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.addClass('placeholder');
                    input.val(input.attr('placeholder'));
                }
            }).blur();
    }

/*-----------------------------------------------------------------------------------*/
/*	Responsive video iframe handler	
/*-----------------------------------------------------------------------------------*/

	$videoFrame = $('iframe[src^="http://www.youtube.com"],iframe[src^="http://player.vimeo.com"]');

    $videoFrame.each(function(){
        $(this).data('aspectRatio', this.height / this.width)
            .removeAttr('height')
            .removeAttr('width');
    });

    function Update_videoFrame()
    {
        $videoFrame.each(function(){
            var $vid = $(this),
                $parent = $vid.parent(),
                width = $parent.width();

            $vid.css({width: width, height: width * $vid.data('aspectRatio')});
        });
    }
	
/*-----------------------------------------------------------------------------------*/
/*	Background Fullwidth Slider
/*-----------------------------------------------------------------------------------*/

	function BackgroundSlider()
	{

	    if ($(window).width() > 768) {

	        // Full Screen Slider
	        $('#slides').flexslider({
	            animation: 'fade',
	            selector: ".slides-container .header-slide",
	            controlNav: false,
	            directionNav: false,
	        });

	    }
	
	}
	
/*-----------------------------------------------------------------------------------*/
/*	Background Fullwidth Slider
/*-----------------------------------------------------------------------------------*/

	// portfolio pop up flex Slider
	function flexSlider()
	{
		$('.flexslider').flexslider({
			animation: "fade",
			controlNav: false,
			keyboard: false,
		});  
	}
	
$(document).ready(function () {
	
	Quotes();
	Tabs();
	Toggle();
	blogSingle();
	Alert();
	Forms();
	IE_Fix();
	pageSetup();
	Nav();
	Scroll();
	init_shortcode_chart();
	Ajax_Load_Page(); // blog Load More post
	Ajax_Load_PPage();// Portfolio Load More post
	Portfolio();
	flexSlider();
	fix_portfolio_height();
	Update_videoFrame();
	BackgroundSlider();
	if($('#resume').length)
		Resume();
    magnificpopup();
	if($('#map').length)
		map();
				
});
//End $(document).ready

// window load
jQuery(window).load(function() { 
	
	if(($(window).width() >768) && !($('.vertical-page').length) ){
		$('.portfoliopart').jScrollPane({mouseWheelSpeed:50,showArrows: true,autoReinitialise: true});
		$('.custom_part .custom-part-scroll').jScrollPane({mouseWheelSpeed:50,showArrows: true,autoReinitialise: true});
	}
	
	
	$('.about-paragraph').mCustomScrollbar({theme:"dark-thick"});
	
	if(($(window).width() >768) && !($('.vertical-page').length) ){
		$('.contact-add').mCustomScrollbar({theme:"dark-thick"});		
	}

	jQuery('.start_loader').fadeOut(850); //Hide Website Loader

	if ( jQuery(".ajs-redsky").length ) {
		audiojs.events.ready( function() {
			var audio = audiojs.create( jQuery("audio"), { css: '' } );
		} );
	}
})


})(jQuery);



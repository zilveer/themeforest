jQuery(document).ready(function($){

    /* Set cookie for retina displays; refresh if not set -------------------------------------------------------------*/

    if( typeof stagCookies === 'object' && !stagCookies.hasItem('retina') && 'devicePixelRatio' in window && window.devicePixelRatio === 2 ){
        stagCookies.setItem('retina', window.devicePixelRatio);
        window.location.reload();
    }


    /* Mobile Navigation Setup -------------------------------------------------------------*/

    var mobileNav = $('#primary-menu').clone().attr('id', 'mobile-primary-menu');

    $('#primary-menu').supersubs({
        minWidth: 10,
        maxWidth: 14,
        extraWidth: 1
    }).superfish({
        delay: 100,
        animation: {opacity:'show'},
        animationOut:  {opacity:'hide'},
        speed: 'fast',
        autoArrows: false,
        dropShadows: false
    });

    function stag_mobilemenu(){
        "use strict";
        var windowWidth = $(window).width();
        if( windowWidth <= 992 ) {
            if( !$('#mobile-nav').length ) {
                $('<a id="mobile-nav" href="#mobile-primary-menu">'+ stag.menuIcon +'</a>').prependTo('#navigation');
                mobileNav.insertAfter('#mobile-nav').wrap('<div id="mobile-primary-menu-wrap" />');
                mobile_responder();
            }
        }else{
            mobileNav.css('display', 'none');
        }
    }
    stag_mobilemenu();

    function mobile_responder(){
        $('#mobile-nav').click(function(e) {
            if( $('body').hasClass('ie8') ) {
                var mobileMenu = $('#mobile-primary-menu');
                if( mobileMenu.css('display') === 'block' ) {
                    mobileMenu.css({
                        'display' : 'none'
                    });
                } else {
                    mobileMenu.css({
                        'display' : 'block',
                        'height' : 'auto',
                        'z-index' : 999,
                        'position' : 'absolute'
                    });
                }
            } else {
                $('#mobile-primary-menu').stop().slideToggle(500);
            }
            e.preventDefault();
        });
    }

    $(window).resize(function() {
        stag_mobilemenu();
    });

    /* Portfolio Magic -------------------------------------------------------------------------*/

    $.fn.Gateway = function() {
        var gateway = $('<div class="gateway-show"></div>');
        var loading = $('<ul class="spinner"><li></li><li></li><li></li></ul><div class="portfolio-loading">Loading...</div>');

        gateway.append(loading);

        return this.each(function(){

            $('.portfolio .portfolio-trigger').on( 'click', function(e){
                e.preventDefault();
                var postid  = $(this).data('id');
                var parent = $(this).parent().parent().parent();
                var that = $(this);

                $('#gateway-portfolio .portfolio, #filterable-portfolio .portfolio').each(function(){
                    $(this).removeClass('open');
                });

                if(parent.next().hasClass('gateway-show')){
                    gateway.toggle();
                }else{
                    gateway.insertAfter(parent).css('display', 'block');
                }

                if(gateway.css('display') === 'block'){
                    gateway.prev().addClass('open');
                }

                $('html, body').animate({
                    scrollTop:gateway.offset().top - $(".grids .open").height()-40
                }, 'medium');

                gateway.html(loading);

                gateway.load(stag.gateway, {
                    id: postid
                });

            });

            $('#gateway-portfolio, #filterable-portfolio').on('click', '.gateway-close a', function(e){
                e.preventDefault();
                gateway.prev().removeClass('open');
                gateway.slideUp();
            });
        });
    };

    $('#gateway-portfolio').Gateway();

    var filterablePortfolio = $('#filterable-portfolio');
    if(filterablePortfolio.data('filter-type') !== "expandable") filterablePortfolio.Gateway();

    /* Portfolio Filter ---------------------------------------------------------------------*/
    if(filterablePortfolio.data('filter-type') === "filterable")
        $('#portfolio-filter a').on('click', function(e){

            var parent = $(this).parent().parent();
            parent.find('.current').removeClass('current');
            $(this).addClass('current');

            e.preventDefault();
            var selector = $(this).data('filter');
            $('#filterable-portfolio').isotope({
                filter: selector,
                layoutMode: 'fitRows',
                hiddenStyle : {
                    opacity: 0,
                    scale : .75
                }
            });
            $(window).resize();
        });

    /* Portfolio Load More ---------------------------------------------------------------------*/
    var load = $('#load-more'),
        page = 1;

    load.on('click', function(e){
        e.preventDefault();
        page++;
        $.post(stag.ajaxurl, { action: 'stag_portfolio_load_more', nonce: stag.nonce, page: page }, function( data ) {
            var content = $(data.content);
            $('#filterable-portfolio').append(content).isotope().isotope('addItems', content);
            if(page >= data.pages) load.fadeOut();

            PortfolioSkillsFilter( $.parseJSON(data.new_skills) );

        }, 'json').done(function(){
            $('#filterable-portfolio').isotope({
                filter: '*',
                layoutMode: 'fitRows',
                hiddenStyle : {
                    opacity: 0,
                    scale : .75
                }
            });
            $(window).resize();
            if(filterablePortfolio.data('filter-type') !== "expandable") filterablePortfolio.Gateway();
        });
    });

    function PortfolioSkillsFilter( new_skills ) {
    	if( new_skills &&  new_skills.length >= 1 ) {
    		var old_skills = $('#all-skills').data('all-skills');
    		$.merge( old_skills, new_skills );
    		$('#all-skills').data('all-skills', old_skills );
    	}

    	var all_filters = $('#all-skills').data('all-filters'),
    		all_skills  = $('#all-skills').data('all-skills');

    	$('#portfolio-filter').find('li').removeClass('invalid');

    	if( all_skills && all_skills.length >= 1 ) {
    		all_filters.filter(function(i,v){
    			if( all_skills.indexOf(i) === -1 ) {
    				$('#portfolio-filter').find("[data-filter='"+ all_filters[v] +"']").addClass('invalid');
    			}
    		});
    	}
    }

    PortfolioSkillsFilter();

    /* FitVids ------------------------------------------------------------------------------*/
    if ($.fn.fitVids) {
        $("#primary, .entry-content, .posts-wrapper").fitVids();
    }

});

jQuery(window).load(function() {
    jQuery('.flexslider').flexslider({
        directionNav: false,
        smoothHeight: true
    });
});

jQuery(document).ready(function ($) { 
	$('.ch_button.red').click(function () { 
		if ($('#change_wrap_div').hasClass('dark-skin')) {
			$('#change_wrap_div').removeClass('dark-skin').addClass('white-skin');
		}
        if ($('section#header').hasClass('horizontal')) {
            $('section#header').removeClass('horizontal');
        }
		if ($('.boxed_layout').hasClass('active')) {
			$('.boxed_layout').removeClass('active');
			$('#change_wrap_div').removeClass('boxed_lay');
			$('.boxed_bg').css('visibility','hidden');
		}
		$('#change_wrap_div').css('background','#ffffff');
        $('section#footer,#sub-footer').css('background','#51585b');
		$("#font_color_1").text('.first_color .round_color, #top-menu>ul>li:hover>.under, #top-menu>ul>li.current-menu-item>.menu-item-wrap, #top-menu > ul > li ul li:hover .menu-item-wrap a, #top-menu > ul > li ul li.current-menu-item .menu-item-wrap a, .info-item.clickable:hover, .folio-item .description, .hover-bg:hover, .twitter-row .icon, .twitter-row .nav a:hover, .shop-category-widget li a:hover, .category-widget li a:hover, .button, #open-top-panel, #top-panel, div.progress .meter, .pricing-table .title, .tags-widget  a:hover, .breaking-news-block .blocks-label, .page-nav .older a, .page-nav .newer a:hover, .comment-reply-link:hover, .quantity .plus, #content .quantity .plus:hover, .quantity .minus, #content .quantity .minus, .dark-skin .twitter-row .nav a:hover, .dark-skin ul.accordion > li.active .title, .dark-skin .to-action-block, .tags-widget a:hover {background-color:#50B4E6;} h3 span, a, .extra-links a:hover, .post header > h2 a:hover, article .dopinfo a.comments, article .dopinfo a:hover,#footer h3, .project-title a:hover, .summary .price, .dark-skin ul.accordion > li.active > div.title h5,.dark-skin .post header > h2 a:hover,.dark-skin .project-title a:hover {color:#50B4E6;} #top-menu>ul>li>ul:before {border-bottom-color:#50B4E6;} #top-menu>ul>li>ul>li:first-child,  .tabs dd.active, .tabs li.active, .filter li.active { border-top-color:#50B4E6;} .to-action-block,.tabs.vertical dd.active, .tabs.vertical li.active, .tabs.vertical dd:first-child.active, .tabs.vertical li:first-child.active,.shop-category-widget li a:hover:before,.category-widget li a:hover:before, ul.accordion > li.active .title,.dark-skin .tabs.vertical dd.active, .dark-skin .tabs.vertical li.active{ border-left-color:#50B4E6};');
		$("#font_color_2").text('div a.more-link span, .hover-plus,.instagram-widget a span,.button:hover,#layout .tags-widget a, #footer .tags-widget a:hover, .page-nav .older a:hover,.page-nav .newer a, .comment-reply-link,.onsale,.quantity .plus, #content .quantity .plus,.quantity .minus, #content .quantity .minus:hover,.dark-skin .tags-widget .widget-inner a:hover {background-color:#E56F6F;} a:hover,.footer-menu a:hover,.widget_shopping_cart .amount, ul.products li.product .price, ul.products li.product .amount {color:#E56F6F;}');

        return false;

	} );
	
	$('.text_drop .drop_list a').click(function () { 
		var text = $(this).text(), 
			filter_el = $(this).parent().parent().parent().find('.drop_link_in');
		
		$(this).parent().parent().find('>li.current').removeClass('current');
		$(this).parent().addClass('current');
		
		filter_el.attr( { 
			title : text
		} ).text(text);
		
	} );


    $('.menu_variant li a.ver').click(function () {
        $('section#header').removeClass('horizontal');
        return false;
    } );

    $('.menu_variant li a.hor').click(function () {
        $('section#header').addClass('horizontal');
        return false;
    } );




	$('.changer_button').bind('click', function () { 
		if ($(this).hasClass('active')) {
			$('.changer_content').slideUp('slow');
			
			$(this).removeClass('active');
		} else {
			$('.changer_content').slideDown('slow');
			
			$(this).addClass('active');
		}
		
		return false;
	} );
/*
	$('.version_check_wrap label').bind('click', function () {
		if ($('body > div:first-child').hasClass('white-skin')) {
			$(this).addClass('active');
			$('body > div:first-child').removeClass('white-skin').addClass('dark-skin');
		} else {
			$('body > div:first-child').removeClass('dark-skin').addClass('white-skin');
			$(this).removeClass('active');
		}
		
		return false;
	} );
	
	/*Setting clorpicker*/
    colorpicker = $.farbtastic("#custom-style-colorpicker");
    $("#custom-style-colorpicker").append("<a class='close'>X</a>");

	jQuery("#tempate-switcher").show();
	
    $("#custom-style-wrapper").on({
        mouseenter:function(){
            $(this).stop();
            $(this).animate({left:0},'fast');
        },
        mouseleave:function(){
            $(this).stop();
            $(this).animate({left:"-290px"},'fast');
            $("#custom-style-colorpicker").hide();
            $(".pattern-select").hide();
            $(".pattern-example.image img").attr("src", customStyleImgUrl + 'title-icon.png');
        }
    });

    $(".template-option").each(function(){
        if( $(this).attr('href') == location.href ){
            $(this).find('img').attr("src", customStyleImgUrl + 'checkbox_1.png' )
        }
    });

    $("#custom-style-colorpicker a.close").on("click",function(){
        $("#custom-style-colorpicker").hide();
    });

	$('.boxed_layout').bind('click', function () { 
		if ($('.boxed_layout').hasClass('active')) {
			$(this).removeClass('active');
			$('#change_wrap_div').removeClass('boxed_lay');
			$('.boxed_bg').css('visibility','hidden');
		} else {
			$(this).addClass('active');
			$('#change_wrap_div').addClass('boxed_lay');
			$('.boxed_bg').css('visibility','visible');
		}
		
		return false;
	} );
	

    $(".texture_bg .ch_picker.color").on("click", function(){
        $("#custom-style-colorpicker").show();
        $this = $(this);
        colorpicker.linkTo(function(){
            $('#footer,#sub-footer').css("background-color",colorpicker.color);
        });
        try{
            colorpicker.setColor( rgb2hex( $('#footer,#sub-footer').css("background-color") ) );
        } catch (e){
            console.log($('#footer,#sub-footer').css("background-color"));
        }

        $(".texture_bg .ch_picker.color").removeClass("active");
        $(this).addClass("active");
        $('#footer,#sub-footer').css("background-image","none");

        return false;
    });

	
	$(".boxed_bg .ch_picker").on("click", function(){
		$("#custom-style-colorpicker").show();
		$this = $(this);
		colorpicker.linkTo(function(){
			$('body').css("background-color",colorpicker.color);
		});
		try{
			colorpicker.setColor( rgb2hex( $('body').css("background-color") ) );
		} catch (e){
			console.log($('body').css("background-color"));
		}

		$(".boxed_bg .ch_picker").removeClass("active");
		$(this).addClass("active");
		$('body').css("background-image","none");

        return false;
	});
	
	$(".first_color .round_color").on("click", function(){
		$("#custom-style-colorpicker").show();
		$this = $(this);
		colorpicker.linkTo(function(){
			$("#font_color_1").text('.first_color .round_color, #top-menu>ul>li:hover>.under, #top-menu>ul>li.current-menu-item>.menu-item-wrap, #top-menu > ul > li ul li:hover .menu-item-wrap a, #top-menu > ul > li ul li.current-menu-item .menu-item-wrap a, .info-item.clickable:hover, .folio-item .description, .hover-bg:hover, .twitter-row .icon, .twitter-row .nav a:hover, .shop-category-widget li a:hover, .category-widget li a:hover, .button, #open-top-panel, #top-panel, div.progress .meter, .pricing-table .title, .tags-widget  a:hover, .breaking-news-block .blocks-label, .page-nav .older a, .page-nav .newer a:hover, .comment-reply-link:hover, .quantity .plus, #content .quantity .plus:hover, .quantity .minus, #content .quantity .minus, .dark-skin .twitter-row .nav a:hover, .dark-skin ul.accordion > li.active .title, .dark-skin .to-action-block, .tags-widget a:hover {background-color:' + colorpicker.color + ';} h3 span, a, .extra-links a:hover, .post header > h2 a:hover, article .dopinfo a.comments, article .dopinfo a:hover,#footer h3, .project-title a:hover, .summary .price, .dark-skin ul.accordion > li.active > div.title h5,.dark-skin .post header > h2 a:hover,.dark-skin .project-title a:hover {color:' + colorpicker.color + ';} #top-menu>ul>li>ul:before {border-bottom-color:' + colorpicker.color + ';} #top-menu>ul>li>ul>li:first-child,  .tabs dd.active, .tabs li.active, .filter li.active { border-top-color:' + colorpicker.color + ';} .to-action-block,.tabs.vertical dd.active, .tabs.vertical li.active, .tabs.vertical dd:first-child.active, .tabs.vertical li:first-child.active,.shop-category-widget li a:hover:before,.category-widget li a:hover:before, ul.accordion > li.active .title,.dark-skin .tabs.vertical dd.active, .dark-skin .tabs.vertical li.active{ border-left-color:' + colorpicker.color + ';}');
		});
		try{
			colorpicker.setColor( rgb2hex( $('.first_color .round_color').css("background-color") ) );
		} catch (e){
			console.log($('.first_color .round_color').css("background-color"));
		}

		$(".first_color .round_color").removeClass("active");
		$(this).addClass("active");
	});
	
	$(".second_color .round_color").on("click", function(){
		$("#custom-style-colorpicker").show();
		$this = $(this);
		colorpicker.linkTo(function(){
			$("#font_color_2").text('div a.more-link span, .hover-plus,.instagram-widget a span,.button:hover,#layout .tags-widget a, #footer .tags-widget a:hover, .page-nav .older a:hover,.page-nav .newer a, .comment-reply-link,.onsale,.quantity .plus, #content .quantity .plus,.quantity .minus, #content .quantity .minus:hover,.dark-skin .tags-widget .widget-inner a:hover {background-color:' + colorpicker.color + ';} a:hover,.footer-menu a:hover,.widget_shopping_cart .amount, ul.products li.product .price, ul.products li.product .amount {color:' + colorpicker.color + ';}');
		});
		try{
			colorpicker.setColor( rgb2hex( $('.second_color .round_color').css("background-color") ) );
		} catch (e){
			console.log($('.second_color .round_color').css("background-color"));
		}

		$(".second_color .round_color").removeClass("active");
		$(this).addClass("active");
	});
	
    /*Background image switching*/
    $(".boxed_bg .pattern-example.pic").on("click", function(){
        $(this).closest(".pattern-select").find(".pattern-example.pic").removeClass("current");
        $(this).addClass("current");
        var pic = $(this).find("img").attr("src");
        $('body').css("background-image", "url(" + pic.split("thumb/").join("") + ")").css("background-repeat","repeat");

    });

    /*Background image switching*/
    $(".texture_bg .pattern-example.pic").on("click", function(){
        $(this).closest(".pattern-select").find(".pattern-example.pic").removeClass("current");
        $(this).addClass("current");
        var pic = $(this).find("img").attr("src");
        $('#footer, #sub-footer').css("background-image", "url(" + pic.split("thumb/").join("") + ")").css("background-repeat","repeat");

        return false;
    });
	
	var imagesForPreload = new Array();
	$(".pattern-select:eq(0) .pattern-example.pic img").each(function(){
		imagesForPreload.push( $(this).attr("src") );
	});

	preload( imagesForPreload );

} );

/*RGB to HEX */
var hexDigits = new Array
    ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");


function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}

function preload(arrayOfImages) {
    $(arrayOfImages).each(function(){
        $('<img/>')[0].src = this;
        // Alternatively you could use:
        // (new Image()).src = this;
    });
}
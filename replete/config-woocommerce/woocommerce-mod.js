jQuery(document).ready(function($) {

	cart_improvement_functions();
	cart_dropdown_improvement();
	product_hover();



	// pointer arrow
	if(jQuery.fn.avia_submenu_helper)
	{
		jQuery('.product-sorting').avia_submenu_helper({modify_sublist_width:true, animate:'slide'});
		jQuery('#header .sub_menu').avia_submenu_helper({arrow:true});
	}

	if(jQuery.fn.avia_sc_slider)
	{
		jQuery(".shop_slider_yes ul").avia_sc_slider({appendControlls:false, group:true, slide:'.product', arrowControll: true, autorotationInterval:'parent'});
	}


	product_add_to_cart_click();

	jQuery(".quantity input[type=number]").each(function()
	{
		var number 	= $(this),
			newNum 	= jQuery(jQuery('<div />').append(number.clone(true)).html().replace('number','text')).insertAfter(number);
			number.remove();
		
		setTimeout(function(){
			if(newNum.next('.plus').length == 0)
			{
				var minus	= jQuery('<input type="button" value="-" class="minus">').insertBefore(newNum),
					plus	= jQuery('<input type="button" value="+" class="plus">').insertAfter(newNum);
					
					minus.on('click', function(){
						var the_val = parseInt(newNum.val(), 10) - 1;
							the_val = the_val < 0 ? 0 : the_val;
							newNum.val(the_val);
					});
					plus.on('click', function(){
						newNum.val(parseInt(newNum.val(), 10) + 1);
					});
			}	
		},10);	
		
	});


	setTimeout(first_load_amount, 10);
	$('body').bind('added_to_cart', update_cart_dropdown);

});


//updates the shopping cart in the sidebar, hooks into the added_to_cart event whcih is triggered by woocommerce
function update_cart_dropdown()
{
	var menu_cart 		= jQuery('.cart_dropdown'),
		dropdown_cart 	= menu_cart.find('.dropdown_widget_cart:eq(0)'),
		subtotal 		= menu_cart.find('.cart_subtotal'),
		subtotal_new 	= dropdown_cart.find('.total .amount'),
		tax 			= dropdown_cart.find('.total small'),
		taxtext			= tax.html();
		if(typeof taxtext == 'undefined' || taxtext == 'undefined')
		{
			taxtext = '';
		}
		else
		{
			taxtext = ' ' + taxtext;
		}

        setTimeout(function(){ subtotal.html(subtotal_new.html() + taxtext); }, 500);
}


//function that pre fills the amount value of the cart
function first_load_amount()
{
	var counter = 0,
		limit = 15,
		ms = 300,
		check = function()
		{
			var new_total = jQuery('.cart_dropdown .dropdown_widget_cart:eq(0) .total .amount');

			if(new_total.length)
			{
				update_cart_dropdown();
			}
			else
			{
				counter++;
				if(counter < limit)
				{
					setTimeout(check, ms);
				}

				if(counter == 10)
				{
					var cur_total  = jQuery('.cart_dropdown:eq(0) .cart_subtotal:eq(0) .amount'),
						symbol_pos = isNaN(cur_total.text().charAt(0)) ? "before" : "after",
						symbol	   = cur_total.text().replace(/\d|\.|,|-|_/g,'');

					symbol_pos == "after" ? cur_total.html("0" + symbol)	: cur_total.html(symbol + "0");
				}

			}
		};

		check();
}


// -------------------------------------------------------------------------------------------
// pointer for the main menu
// -------------------------------------------------------------------------------------------

(function($)
{

	"use strict";
	$.avia_utilities = $.avia_utilities || {};
	$.fn.avia_submenu_helper = function(variables)
	{
		var defaults =
		{
			arrow:false,
			modify_sublist_width: false,
			animate: 'fade'
		};

		var options = $.extend(defaults, variables);

		return this.each(function()
		{
			var menu = $(this),
				menuItems = menu.find("ul>li"),
				dropdownItems = menuItems.find(">ul").parent();


			//apply fade out/in
			dropdownItems.find('li').andSelf().each(function()
			{
				var currentItem = $(this),
					sublist = currentItem.find('ul:first'),
					showList = false;

				if(sublist.length)
				{
					if(options.animate == 'fade')
					{
						sublist.css({display:'block', opacity:0, visibility:'hidden'});
					}
					else
					{
						sublist.css({display:'none', opacity:1, visibility:'visible'});
					}

					if(options.modify_sublist_width)
					{
						sublist.css({"min-width":currentItem.width() - 32});
					}

					var currentLink = currentItem.find('>a, >span');

					currentLink.bind('mouseenter', function()
					{
						if(options.animate == 'fade')
						{
							sublist.stop().css({visibility:'visible'}).animate({opacity:1});
						}
						else
						{
							if(sublist.css('display') == 'none' ) sublist.css({display:'none'}).slideDown(200);
						}
					});

					currentItem.bind('mouseleave', function()
					{
						if(options.animate == 'fade')
						{
							sublist.stop().animate({opacity:0}, function()
							{
								sublist.css({visibility:'hidden'});
							});
						}
						else
						{
							sublist.css({display:'block'}).slideUp(200);
						}
					});

				}
			});


			//check if the browser supports element rotation
			var transition = $.avia_utilities.supports('transition', ['Khtml', 'Ms','Moz','Webkit']);

			if(!transition) { return false; }
			if(options.arrow)
			{
				menu.secondlevel	= menu.find('>ul>li>ul>li:nth-child(1)');
				menu.secondlevel.append('<span class="pointer_arrow_wrap"><span class="pointer_arrow"></span></span>');
			}
		});
	};
})(jQuery);



function product_hover()
{
	var products = jQuery('.products .product'), isMobile 	= 'ontouchstart' in document.documentElement, csstransitions = jQuery('html').is('.csstransitions');


	products.each(function(i)
	{
		var product = jQuery(this), to;

		if(isMobile)
		{
			var first_link = product.find('.inner_product>a');

			first_link.on('click', function()
			{
				if(first_link.is('.openP') == false)
				{
					first_link.parents('.shop_slider_yes:eq(0)').find('>div').addClass('not_animating_slides');
					jQuery('.openP').removeClass('openP');
					first_link.addClass('openP');
					return false;
				}
			});

		}

		product.hover(
		function()
		{
			product.height(product.height() -1);
			if(!csstransitions) setTimeout(function(){ product.addClass('js_hover'); },10);
			clearTimeout(to);
		},
		function()
		{
			to = setTimeout(function()
			{
				if(!csstransitions) product.removeClass('js_hover');
				product.height('auto');
			},500);
		});
	});

}


function product_add_to_cart_click()
{
	var jbody = jQuery('body');

	jbody.on('click', '.add_to_cart_button', function()
	{
		var product = jQuery(this).parents('.product:eq(0)').addClass('adding-to-cart-loading').removeClass('added-to-cart-check');
	})

	jbody.bind('added_to_cart', function()
	{
		jQuery('.adding-to-cart-loading').removeClass('adding-to-cart-loading').addClass('added-to-cart-check');
	});

}



// little fixes and modifications to the dom
function cart_improvement_functions()
{
	//single products are added via ajax //doesnt work currently
	//jQuery('.summary .cart .button[type=submit]').addClass('add_to_cart_button product_type_simple');

	//downloadable products are now added via ajax as well
	jQuery('.product_type_downloadable, .product_type_virtual').addClass('product_type_simple');

	//clicking tabs dont activate smoothscrooling
	jQuery('.woocommerce-tabs .tabs a').addClass('no-scroll');

	//connect thumbnails on single product page via lightbox
	jQuery('.single-product-main-image>.images a').attr('rel','product_images[grouped]');



}






//small function that improves shoping cart hover behaviour in the menu
function cart_dropdown_improvement()
{
	var dropdown = jQuery('.cart_dropdown'), subelement = dropdown.find('.dropdown_widget').css({display:'none', opacity:0});

	dropdown.hover(
	function(){ subelement.css({display:'block'}).stop().animate({opacity:1}); },
	function(){ subelement.stop().animate({opacity:0}, function(){ subelement.css({display:'none'}); }); }
	);
}




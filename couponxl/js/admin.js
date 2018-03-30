jQuery(document).ready(function($){
	/* VOUCHERS */
	$('.couponxl_pay_seller').click(function(e){
		e.preventDefault();
		var $this = $(this);
		var voucher_id = $(this).data('voucher-id');

		$this.append('<i class="fa fa-spinner fa-spin"></i>');

		$.ajax({
			url: ajaxurl,
			data: {
				action: 'pay_all_sellers',
				voucher_id: voucher_id
			},
			dataType: "JSON",
			method: "POST",
			success: function(response){
				if( response.success ){
					$this.prev().remove();
					$this.fadeOut(200,function(){
						$this.after( response.success );
						$this.remove();
					});
				}
				if( response.error ){
					var error_list = '';
					for( var i=0; i<response.error.length; i++ ){
						error_list += response.error[i]+"\n";
					}
					if( error_list !== '' ){
						alert( error_list );
					}
				}
			},
			complete: function(){
				$this.find('i').remove();
			}
		});
	});

	$(document).on('click', '.couponxl_pay_all_sellers', function(e){
		e.preventDefault();
		var $this = $(this);

		$this.append('<i class="fa fa-spinner fa-spin"></i>');

		$.ajax({
			url: ajaxurl,
			data: {
				action: 'pay_all_sellers',
			},
			dataType: "JSON",
			method: "POST",
			success: function(response){
				$('.wrap > .notice').remove();
				$('.wrap > .updated').remove();
				$('.wrap > .error').remove();
				if( response.error.length > 0 ){
					for( var i=0; i<response.error.length; i++ ){
						$('.wrap > h2').after('<div class="error"><p>'+response.error[i]+'</p></div>');
					}
				}
				if( response.success ){
					for( var i=0; i<response.success.length; i++ ){
						$('.wrap > h2').after('<div class="updated"><p>'+response.success[i]+'</p></div>');
					}
				}
				if( response.finish ){
					$('.wrap > h2').after('<div class="updated"><p>'+response.finish+'</p></div>');
				}				
			},
			complete: function(){
				$this.find('i').remove();
			}
		});
	});

	/* OFFERS */
	if( $('select[id^="offer_type-sm-field"]').length > 0 ){

		var common = $('select[id^="offer_type-sm-field"]').parents('.postbox');
		var coupon = $('select[id^="coupon_type-sm-field"]').parents('.postbox');
		var deal = $('input[id^="deal_items-sm-field"]').parents('.postbox');
		var ratings = $('textarea[name="ratings"]').parents('.postbox');
		var discussion = $('select[id="offer_discussion_clear"]').parents('.postbox');
		var requests = $('textarea[id^="offer_new_category-sm"]').parents('.postbox');

		function hide_options(){
			common.hide().addClass('closed');			
			coupon.hide().addClass('closed');
			deal.hide().addClass('closed');
			ratings.hide().addClass('closed');
			discussion.hide().addClass('closed');
			requests.hide().addClass('closed');
		}
		hide_options();
		common.show().removeClass('closed');

		var extra_class = '';
		requests.find('textarea').each(function(){
			if( $(this).val() !== '' ){
				extra_class = 'has_new';
			}
		});
  
		common.before(
			'<a href="javascript:;" class="button button-primary button-large offer_toggle_options" data-target="#'+common.attr('id')+'">'+common.find('.ui-sortable-handle span').text()+'</a>'+
			'<a href="javascript:;" class="button button-large offer_toggle_options hide-btn coupon" data-target="#'+coupon.attr('id')+'">'+coupon.find('.ui-sortable-handle span').text()+'</a>'+
			'<a href="javascript:;" class="button button-large offer_toggle_options hide-btn deal" data-target="#'+deal.attr('id')+'">'+deal.find('.ui-sortable-handle span').text()+'</a>'+
			'<a href="javascript:;" class="button button-large offer_toggle_options" data-target="#'+ratings.attr('id')+'">'+ratings.find('.ui-sortable-handle span').text()+'</a>'+
			'<a href="javascript:;" class="button button-large offer_toggle_options" data-target="#'+discussion.attr('id')+'">'+discussion.find('.ui-sortable-handle span').text()+'</a>'+
			'<a href="javascript:;" class="button button-large offer_toggle_options '+extra_class+'" data-target="#'+requests.attr('id')+'">'+requests.find('.ui-sortable-handle span').text()+'</a>'
		);

		$('select[id^="offer_type"]').change(function(){
			$('.offer_toggle_options.hide-btn').hide();
			$('.offer_toggle_options.hide-btn.'+$(this).val()).css('display', 'inline-block');
		});
		if( $('select[id^="offer_type"]').val() !== '' ){
			$('.offer_toggle_options.hide-btn.'+$('select[id^="offer_type"]').val()).css('display', 'inline-block');
		}

		$(document).on( 'click', '.offer_toggle_options', function(e){
			e.preventDefault();
			hide_options();
			var target = $(this).data('target');
			$('.offer_toggle_options').removeClass('button-primary');
			$(this).addClass('button-primary');
			$(target).removeClass('closed');
			$(target).fadeIn(100);
		});
		/* coupon main select conditional show */
		var code = $('input[id^="coupon_code"]').parents('tr');
		var sale = $('input[id^="coupon_sale"]').parents('tr');
		var image = $('input[name^="coupon_image"]').parents('tr');
		function show_coupon_type_options( val ){
			code.hide();
			sale.hide();
			image.hide();			
			switch( val ){
				case 'code' : code.show(); break;
				case 'sale' : sale.show(); break;
				case 'printable' : image.show(); break;
			}
		}
		$('select[id^="coupon_type"]').change(function(){
			show_coupon_type_options( $(this).val() );
		});

		show_coupon_type_options( $('select[id^="coupon_type"]').val() );
	}

	/* DEAL PRICE SALE DISCOUNT */
	$('input[id^="deal_sale_price"]').keyup(function(){
		var sale = parseFloat( $(this).val() );
		var price = parseFloat( $('input[id^="deal_price"]').val() );
		if( sale > 0 && price > 0 ){
			var discount = 100 - ( sale / price ) * 100;
			$('input[id^="deal_discount"]').val( discount.toFixed(0)+'%' );
		}
	});

	$('input[id^="deal_discount"]').keyup(function(){
		var discount = parseFloat( $(this).val().replace('%','') );
		var price = parseFloat( $('input[id^="deal_price"]').val() );
		if( discount > 0  && price > 0 ){
			var sale = price - ( price * discount ) / 100;
			$('input[id^="deal_sale_price"]').val( sale.toFixed(2) );
		}
	});	
});
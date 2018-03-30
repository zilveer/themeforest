jQuery(document).ready(function($){
	// Pricing Tables Deleting
	$('.uds-pricing-admin-table .pricing-delete').click(function(){
		if(!confirm("Really delete table?")) {
			return false;
		}
	});
	
	// products
	$('#uds-pricing-products form').submit(function(){
		$('#uds-pricing-products .product').each(function(i, el){
			$("input[type=checkbox]", this).each(function() {
				$(this).attr('name', $(this).attr('name').replace('[]', '[' + i + ']'));
			});
			$("input[type=radio]", this).each(function() {
				$(this).val(i);
			});
		});
	});
	
	// products moving
	$('#uds-pricing-products').sortable({
		containment: '#uds-pricing-products',
		cursor: 'crosshair',
		forcePlaceholderSize: true,
		forceHelpserSize: true,
		handle: '.move',
		items: '.product',
		placeholder: 'placeholder',
		opacity: 0.6,
		tolerance: 'pointer',
		axis: 'y'
	});
	
	// products deleting
	$('#uds-pricing-products .delete').click(function(){
		if(confirm("Really delete product?")) {
			$(this).parents('.product').slideUp(300, function(){
				$(this).remove();
			});
		}
	});
	
	// products collapsing
	$('#uds-pricing-products h3.collapsible').click(function(){
		$('.options', $(this).parent()).slideToggle(300);
		$(this).add($(this).parent()).toggleClass('collapsed');
	}).trigger('click');
	
	var collapsed = true;
	$('.collapse-all').click(function(){
		if(collapsed) {
			$('.options').slideDown(300);
			$('.product').add('h3.collapsible').removeClass('collapsed');
			collapsed = false;
			$(this).html('Collapse all');
		} else {
			$('.options').slideUp(300);
			$('.product').add('h3.collapsible').addClass('collapsed');
			collapsed = true;
			$(this).html('Open all');
		}
		return false;
	});
	
	// table changer
	$('.uds-change-table').click(function(){
		window.location = window.location + "&uds_pricing_edit=" + $('.uds-load-pricing-table').val();
	});
	
	//structure
	$('#uds-pricing-properties table').sortable({
		containment: '#uds-pricing-properties',
		cursor: 'crosshair',
		forcePlaceHolderSize: true,
		handle: '.move',
		items: 'tr',
		axis: 'y'
	});
	
	// properties deleting
	$('#uds-pricing-properties .delete').live('click', function(){
		if(confirm("Really delete?")) {
			$(this).parents("tr").remove();
			$('#uds-pricing-properties table').sortable('refresh');
		}
	});
	
	// properties adding
	var empty = $('#uds-pricing-properties tr:last').clone();
	$('#uds-pricing-properties .add').live('click', function(){
		$('#uds-pricing-properties table').append($(empty).clone());
		$('#uds-pricing-properties table').sortable('refresh');
	});
	
	// Tooltips
	$('.tooltip').hover(function(){
		$tt = $(this).parent().find('.tooltip-content');
		$tt.stop().css({
			display: 'block',
			top: $(this).position().top,
			left: $(this).position().left + 40 + 'px',
			opacity: 0
		}).animate({
			opacity: 1
		}, 300);
	}, function(){
		$tt = $(this).parent().find('.tooltip-content');
		$tt.stop().css({
			opacity: 1
		}).animate({
			opacity: 0
		}, {
			duration: 300,
			complete: function(){
				$(this).css('display', 'none');
			}
		});
	});
});
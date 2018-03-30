(function($) { "use strict";

$('.cart-complete').parent().addClass('checkout-mess');

// MENU  UPDATED V 1.5=============== //
if ( $(window).width() > 767) {     
   jQuery('ul.sf-menu').superfish({
			animation: {opacity:'show'},
		animationOut: {opacity:'hide'}
		});
}
else {		
		jQuery('ul.sf-menu').superfish({
		animation: {opacity:'visible'},
		animationOut: {opacity:'visible'}
		});
}

// HOVER IMAGE MAGNIFY V.1.5========= //
    //Set opacity on each span to 0%
    $(".photo_icon").css({'opacity':'0'});

	$('.picture a').hover(
		function() {
			$(this).find('.photo_icon').stop().fadeTo(800, 1);
		},
		function() {
			$(this).find('.photo_icon').stop().fadeTo(800, 0);
		}
	)

// STICKY NAV V.1.5========= //    
$(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
        $('nav.top-menu').addClass("sticky");
    }
    else{
        $('nav.top-menu').removeClass("sticky");
    }
});
	
// MENU MOBILE ==========//
// Collpsable menu mobile and tablets
$('#mobnav-btn').click(
function () {
    $('.sf-menu').stop().slideToggle(400);
});

$('.sf-with-ul').click(
function () {
    $(this).next().toggleClass("xpopdrop");
});



// SCROLL TO TOP ===============================================================================
$(function() {
	$(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('#toTop').fadeIn();	
		} else {
			$('#toTop').fadeOut();
		}
	});
 
	$('#toTop').click(function() {
		$('body,html').animate({scrollTop:0},500);
	});	
	
});

if( window.innerWidth < 770 ) {
	$("button.forward, button.backword").click(function() {
  $("html, body").animate({ scrollTop: 115 }, "slow");
  return false;
});
}

if( window.innerWidth < 500 ) {
	$("button.forward, button.backword").click(function() {
  $("html, body").animate({ scrollTop: 245 }, "slow");
  return false;
});
}
if( window.innerWidth < 340 ) {
	$("button.forward, button.backword").click(function() {
  $("html, body").animate({ scrollTop: 280 }, "slow");
  return false;
});
}

<!-- Toggle -->			
	$('.togglehandle').click(function()
	{
		$(this).toggleClass('active')
		$(this).next('.toggledata').slideToggle()
	});

// alert close 
	$('.clostalert').click(function()
	{
	$(this).parent('.alert').fadeOut ()
	});	

<!-- testimonial carousel -->	
$(document).ready(function() {
  //Set the carousel options
  $('.quote-carousel').carousel({
    pause: true,
    interval: 6000,
  });
});

<!-- Tooltip -->	
$('.tooltip-1').tooltip({html:true});

<!-- Accrodian -->	
	var $acdata = $('.accrodian-data'),
		$acclick = $('.accrodian-trigger');

	$acdata.hide();
	$acclick.first().addClass('active').next().show();	
	
	$acclick.on('click', function(e) {
		if( $(this).next().is(':hidden') ) {
			$acclick.removeClass('active').next().slideUp(300);
			$(this).toggleClass('active').next().slideDown(300);
		}
		e.preventDefault();
	});
	
 $('.po-markup > .po-link').popover({
    trigger: 'hover',
    html: true,  // must have if HTML is contained in popover

    // get the title and conent
    title: function() {
      return $(this).parent().find('.po-title').html();
    },
    content: function() {
      return $(this).parent().find('.po-body').html();
    },

    container: 'body',
    placement: 'top'

  });
  //accordion	
function toggleChevron(e) {
    $(e.target)
        .prev('.panel-heading')
        .find("i.indicator")
        .toggleClass('icon-plus icon-minus');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);
$('#accordion').on('hidden.bs.collapse', function () {
})


//Pace holder
$('input, textarea').placeholder();

$('.sb-search').on('click','.sb-icon-search', function(){
    if($(this).parents('.sb-search').hasClass('sb-search-open')){
        $(this).parents('.sb-search').removeClass('sb-search-open');
    }else{
        $(this).parents('.sb-search').addClass('sb-search-open');
    }
});

$(".owl-post").owlCarousel({
	navigation : false,
	slideSpeed : 300,
	autoPlay: 5000,
	paginationSpeed : 400,
	singleItem:true
});

$("body").fitVids();

$( '.ot-tabs .vc_tta-tab' ).on( 'click', 'a', function( e ) {

    $( '.ot-tabs .vc_tta-tabs-list' ).find( '.vc_tta-tab' ).removeClass( 'vc_active' );
    $( this ).parent().addClass( 'vc_active' );
    var id = $( this ).attr( 'href' ).replace( '#', '' );
    $( '.ot-tabs .vc_tta-panels' ).find( '.vc_tta-panel' ).removeClass( 'vc_active').hide();
    $( '.ot-tabs .vc_tta-panels' ).find( '#' + id ).addClass( 'vc_active' ).show();

    return false;
} );

// Rate course
$('body').on('click', '#respond span.stars a', function () {
var $star = $(this),
 $rating = $(this).closest('#respond').find('#rating');

$rating.val($star.text());
$star.siblings('a').removeClass('active');
$star.addClass('active');

return false;
});

$('.filterable .btn-filter').click(function(){
    var $panel = $(this).parents('.filterable'),
    $filters = $panel.find('.filters input'),
    $tbody = $panel.find('.table tbody');
    if ($filters.prop('disabled') == true) {
        $filters.prop('disabled', false);
        $filters.first().focus();
    } else {
        $filters.val('').prop('disabled', true);
        $tbody.find('.no-result').remove();
        $tbody.find('tr').show();
    }
});

$('.filterable .filters input').keyup(function(e){
    /* Ignore tab key */
    var code = e.keyCode || e.which;
    if (code == '9') return;
    /* Useful DOM data and selectors */
    var $input = $(this),
    inputContent = $input.val().toLowerCase(),
    $panel = $input.parents('.filterable'),
    column = $panel.find('.filters th').index($input.parents('th')),
    $table = $panel.find('.table'),
    $rows = $table.find('tbody tr');
    /* Dirtiest filter function ever ;) */
    var $filteredRows = $rows.filter(function(){
        var value = $(this).find('td').eq(column).text().toLowerCase();
        return value.indexOf(inputContent) === -1;
    });
    /* Clean previous no-result if exist */
    $table.find('tbody .no-result').remove();
    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
    $rows.show();
    $filteredRows.hide();
    /* Prepend no-result row if all rows are filtered */
    if ($filteredRows.length === $rows.length) {
        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
    }
});

})(jQuery);
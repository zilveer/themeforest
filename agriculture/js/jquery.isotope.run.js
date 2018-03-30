/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Portfolio Sorting Run Script for jQuery Isotope Plugin
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function () { 
	(function ($) { 
		var container = $('section.portfolio');
		
		container.isotope( { 
			itemSelector : 'article.project', 
			layoutMode : 'fitRows', 
			resizable : false, 
			getSortData : { 
				pj_name : function (el) { 
					return el.find('.entry-title').text();
				}, 
				pj_date : function (el) { 
					return parseInt(el.find('.meta-date').text());
				} 
			} 
		} );
		
		$('.pj_options_block .pj_filter a').bind('click', function () { 
			var selector = $(this).attr('data-filter'), 
				text = $(this).text(), 
				filter_el = $(this).parent().parent().parent().find('.pj_cat_filter');
			
			$(this).parent().parent().find('>li.current').removeClass('current');
			$(this).parent().addClass('current');
			
			filter_el.attr( { 
				title : text, 
				'data-filter' : selector 
			} ).find('span').text(text);
			
			container.isotope( { 
				filter : selector 
			} );
			
			return false;
		} );
		
		$('.pj_options_block .pj_sort > a').bind('click', function () { 
			var type = $(this).attr('name'), 
				asc = (type === 'pj_name') ? true : false, 
				current = ($(this).hasClass('current')) ? true : false, 
				reversed = ($(this).hasClass('reversed')) ? true : false;
			
			if (current) { 
				if (reversed) { 
					$(this).removeClass('reversed');
					
					asc = true;
				} else { 
					$(this).addClass('reversed');
					
					asc = false;
				}
			} else { 
				$(this).parent().find('.current').removeClass('current');
				$(this).parent().find('.reversed').removeClass('reversed');
				
				if (type === 'pj_name') { 
					$(this).addClass('current');
				} else { 
					$(this).addClass('current reversed');
				}
			}
			
			container.isotope( { 
				sortBy : type, 
				sortAscending : asc 
			} );
			
			return false;
		} );
		
		$(window).smartresize(function () { 
			var postWidth = container.width();
			
			if (container.hasClass('four_columns')) { 
				postWidth = container.width() / 4;
			} else if (container.hasClass('three_columns')) { 
				postWidth = container.width() / 3;
			} else if (container.hasClass('two_columns')) { 
				postWidth = container.width() / 2;
			}
			
			container.isotope( { 
				fitRows : { 
					columnWidth : postWidth 
				} 
			} );
		} );
	} )(jQuery);
} );


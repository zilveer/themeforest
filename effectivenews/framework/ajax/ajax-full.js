jQuery(document).ready(function() {

	jQuery(".mom-search-form input.sf").on('keyup', function(e){
		sf = jQuery(this);
		term = sf.val();
		if (term.length > 2) {
		setTimeout(function() {
			jQuery.ajax({
			type: "post",
			url: momAjaxL.url,
                        dataType: 'html',
                        data: "action=mom_ajaxsearch&nonce="+momAjaxL.nonce+"&term="+term,
			beforeSend: function() {
				sf.parent().parent().find('.sf-loading').fadeIn();
			},
			success: function(data){
                            if (sf.val() !== '') {
                            sf.parent().parent().next('.ajax_search_results').html(data);
				if (data !== '') {
					sf.parent().parent().next('.ajax_search_results').append('<footer class="show_all_results"><a href="'+momAjaxL.homeUrl+'/?s='+term+'">'+momAjaxL.viewAll+'<i class="fa-icon-long-arrow-right"></i></a></footer>');
				} else {
					sf.parent().parent().next('.ajax_search_results').find('show_all_results').remove();
					sf.parent().parent().next('.ajax_search_results').html('<span class="sw-not_found">'+momAjaxL.noResults+'</span>');
				}
                            } else {
                            sf.parent().parent().next('.ajax_search_results').html('');
                            }
				sf.parent().parent().find('.sf-loading').fadeOut();
				

			}
		});	
		}, 300);
		} else {
				setTimeout(function() {
			jQuery.ajax({
			type: "post",
			url: momAjaxL.url,
                        dataType: 'html',
                        data: "action=mom_ajaxsearch&nonce="+momAjaxL.nonce+"&term="+term,
			success: function(data){
                            if (sf.val() === '') {
                            sf.parent().parent().next('.ajax_search_results').html('');
                            }
			
			}
		});	
		}, 300);	
		}
		return false;
	})
})
jQuery(document).ready(function($) {

        offset = '';
	jQuery("a.show-more-posts").click( function(e) {
            e.preventDefault();
		var t = $(this);
			style = t.data('style');
			share = t.data('share');
			count = t.data('count');
			offset = t.data('offset');
                        display = t.data('display');
                        category = t.data('category');
                        tag = t.data('tag');
                        sort = t.data('sort');
                        orderby = t.data('orderby');
                        format = t.data('format');
                        excerpt_length = t.data('excerpt_length');
                        load_more_count = t.data('load_more_count');
			
		jQuery.ajax({
			type: "post",
			url: momAjaxL.url,
                        dataType: 'html',
                        data: "action=mom_loadMore&nonce="+momAjaxL.nonce+"&display="+display+"&category="+category+"&tag="+tag+"&number_of_posts="+count+"&sort="+sort+"&orderby="+orderby+"&offset="+offset+"&format="+format+"&excerpt_length="+excerpt_length+"&style="+style+"&share="+share+"&load_more_count="+load_more_count,
			beforeSend: function(data) {
                            t.find('i').addClass('fa-spin');
			},
			success: function(data){
                            t.before(data);
                            t.find('i').removeClass('fa-spin');

				if (data === '') {
					t.text(momAjaxL.nomore); 
				}
			}
		});	
                           	t.data('offset', offset+load_more_count);
                                console.log(offset);
	});
});
jQuery(document).ready(function($) {

	jQuery(".mom_mailchimp_subscribe").submit( function(e){
		sf = jQuery(this);
		email = sf.find('.mms-email').val();
		list = sf.data('list_id');
		$('.message-box').fadeOut();

		if (email === '')
		{
		    
			sf.before('<span class="message-box error">'+momAjaxL.error2+'<i class="brankic-icon-error"></i></span>');
		}
		else
		{
		    if (!mom_isValidEmailAddress(email)) {
			sf.before('<span class="message-box error">'+momAjaxL.error2+'<i class="brankic-icon-error"></i></span>');
		     } else {
			jQuery.ajax({
			type: "post",
			url: momAjaxL.url,
                        dataType: 'html',
                        data: "action=mom_mailchimp&nonce="+momAjaxL.nonce+"&email="+email+"&list_id="+list,
			beforeSend: function() {
				sf.find('.sf-loading').fadeIn();
			},
			success: function(data){
				if(data ==="success") {
				sf.find('.email').val("");
					sf.before('<span class="message-box success">'+momAjaxL.success+'<i class="brankic-icon-error"></i></span>').hide().fadeIn();
				}
				else
				{
					sf.before('<span class="message-box error">'+momAjaxL.error+'<i class="brankic-icon-error"></i></span>').hide().fadeIn();
				}
				sf.find('.sf-loading').fadeOut();
			//message box
				$('.message-box i').on('click', function(e) {
				    $(this).parent().fadeOut();    
				});
			}
		});
		     }
		}
		return false;
	});
});
jQuery(document).ready(function($) {
                offset = '';
			offset_rest = '';
		jQuery(".nb-footer a.show-more-ajax").click(function(e){
			e.preventDefault();
			bt = jQuery(this);
			where = bt.parent().prev();
			nbs = bt.data('nbs');
			nop = bt.data('number_of_posts');
			offset = bt.data('offset');
                        offset_rest = offset+1;
			post_type = bt.data('post_type');
                        
                        //gn
                        display = bt.data('display');
                        category = bt.data('category');
                        tag = bt.data('tag');
                        sort = bt.data('sort');
                        orderby = bt.data('orderby');
                        
                        //news list
                        format = '';
                        image_size = '';
                        excerpt_length = '';
                                if (nbs === 'news_list') {
                                        format = bt.data('format');
                                        image_size = bt.data('image_size');
                                        excerpt_length = bt.data('excerpt_length');
                                }
		
			jQuery.ajax({
				type: "post",
				url: momAjaxL.url,
				dataType: 'html',
				data: "action=nbsm&nonce="+momAjaxL.nonce+"&display="+display+"&category="+category+"&tag="+tag+"&nbs="+nbs+"&number_of_posts="+nop+"&sort="+sort+"&orderby="+orderby+"&offset="+offset+"&offset_all="+offset_rest+"&format="+format+"&image_size="+image_size+"&excerpt_length="+excerpt_length+"&post_type="+post_type,
				beforeSend : function () {
					where.append('<i class="nb-load"></i>');
				},
				success: function(data){
					if (data == '') {
						bt.parent().append('<a class="nomoreposts">'+momAjaxL.nomore+'</a>').hide().fadeIn();
					}
					if (data !== '') {
						where.html(data);
					} 
					where.find('.nb-load').remove();
				},
				complete: function (data) {
				}
			});
			bt.data('offset', offset+(nop+1));
			//console.log(offset);
			//console.log(offset_rest);
		});
		
});
jQuery(document).ready(function($) {

	jQuery(".weather-form").submit( function(e){
		form = jQuery(this);
		city = form.find('input').val();
		lang = form.find('input').data('lang');
		units = form.find('input').data('units');
			jQuery.ajax({
			type: "post",
			url: momAjaxL.url,
                        dataType: 'html',
                        data: "action=mom_ajaxweather&nonce="+momAjaxL.nonce+"&city="+city+"&lang="+lang+"&units="+units,
			beforeSend: function() {
				form.find('.sf-loading').fadeIn();
			},
			success: function(data){
                            if (city !== '') {
				if (data !== '') {
					form.nextAll('.weather-widget').html(data).hide().fadeIn();
					form.next('.message-box').fadeOut();
				} else {
					form.next('.message-box').remove();
					form.after('<span class="message-box error">'+momAjaxL.werror+'<i class="brankic-icon-error"></i></span>');
				}
                            } 
				form.find('.sf-loading').fadeOut();
			//message box
				$('.message-box i').on('click', function(e) {
				    $(this).parent().fadeOut();    
				});	
		
			}
			
		});	
		return false;
	})
});
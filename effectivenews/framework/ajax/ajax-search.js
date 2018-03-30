jQuery(document).ready(function() {

	jQuery(".mom-search-form input.sf").on('keyup', function(e){
		sf = jQuery(this);
		term = sf.val();
		if (term.length > 2) {
		setTimeout(function() {
			jQuery.ajax({
			type: "post",
			url: MyAcSearch.url,
                        dataType: 'html',
                        data: "action=mom_ajaxsearch&nonce="+MyAcSearch.nonce+"&term="+term,
			beforeSend: function() {
				sf.parent().parent().find('.sf-loading').fadeIn();
			},
			success: function(data){
                            if (sf.val() !== '') {
                            sf.parent().parent().next('.ajax_search_results').html(data);
				if (data !== '') {
					sf.parent().parent().next('.ajax_search_results').append('<footer class="show_all_results"><a href="'+MyAcSearch.homeUrl+'/?s='+term+'">'+MyAcSearch.viewAll+'<i class="fa-icon-long-arrow-right"></i></a></footer>');
				} else {
					sf.parent().parent().next('.ajax_search_results').find('show_all_results').remove();
					sf.parent().parent().next('.ajax_search_results').html('<span class="sw-not_found">'+MyAcSearch.noResults+'</span>');
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
			url: MyAcSearch.url,
                        dataType: 'html',
                        data: "action=mom_ajaxsearch&nonce="+MyAcSearch.nonce+"&term="+term,
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
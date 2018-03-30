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
			url: MomLMore.url,
                        dataType: 'html',
                        data: "action=mom_loadMore&nonce="+MomLMore.nonce+"&display="+display+"&category="+category+"&tag="+tag+"&number_of_posts="+count+"&sort="+sort+"&orderby="+orderby+"&offset="+offset+"&format="+format+"&excerpt_length="+excerpt_length+"&style="+style+"&share="+share+"&load_more_count="+load_more_count,
			beforeSend: function(data) {
                            t.find('i').addClass('fa-spin');
			},
			success: function(data){
                            t.before(data);
                            t.find('i').removeClass('fa-spin');

				if (data === '') {
					t.text(MomLMore.nomore); 
				}
			}
		});	
                           	t.data('offset', offset+load_more_count);
                                console.log(offset);
	});
});
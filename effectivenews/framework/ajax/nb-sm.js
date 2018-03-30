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
				url: nbsm.url,
				dataType: 'html',
				data: "action=nbsm&nonce="+nbsm.nonce+"&display="+display+"&category="+category+"&tag="+tag+"&nbs="+nbs+"&number_of_posts="+nop+"&sort="+sort+"&orderby="+orderby+"&offset="+offset+"&offset_all="+offset_rest+"&format="+format+"&image_size="+image_size+"&excerpt_length="+excerpt_length,
				beforeSend : function () {
					where.append('<i class="nb-load"></i>');
				},
				success: function(data){
					if (data == '') {
						bt.parent().append('<a class="nomoreposts">'+nbsm.nomore+'</a>').hide().fadeIn();
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
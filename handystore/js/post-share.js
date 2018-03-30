jQuery(document).ready(function($) {
	"use strict";
	$('body').on('click','.pt-post-share a',function(e){
		var service = $(this).parent().data("service");
		var post_id = $(this).parent().data("postid");
		var wrapper = $(this).parent();
		$.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=pt_post_share_count&nonce="+ajax_var.nonce+"&pt_post_share_count=&post_id="+post_id+"&service="+service,
			success: function(count){
				wrapper.find('.sharecount').empty().html("("+count+")");
			}
		});
	});
});

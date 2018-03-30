jQuery(document).ready(function($) {
	$('body').on('click','.pt-post-like',function(e){
		"use strict";
		e.preventDefault();
		var heart = $(this);
		var post_id = heart.data("post_id");
		heart.html("<i id='icon-like' class='post-icon-like fa fa-heart'></i><span class='loading'></span>");
		$.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=pt-post-like&nonce="+ajax_var.nonce+"&pt_post_like=&post_id="+post_id,
			success: function(count){
				if( count.indexOf( "already" ) !== -1 )
				{
					var lecount = count.replace("already","");
					if (lecount === "0")
					{
						lecount = "Like";
					}
					heart.prop('title', 'Like');
					heart.removeClass("liked");
					heart.html("<i id='icon-unlike' class='post-icon-unlike fa fa-heart-o'></i>"+lecount);
				}
				else
				{
					heart.prop('title', 'Unlike');
					heart.addClass("liked");
					heart.html("<i id='icon-like' class='post-icon-like fa fa-heart'></i>("+count+")");
				}
			}
		});
	});
});

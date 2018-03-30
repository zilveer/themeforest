jQuery(document).ready(function() {
	jQuery('body').on('click','#getlike',function(event){
		event.preventDefault();
		heart = jQuery(this);
		post_id = heart.data("post_id");
		jQuery.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=jm-post-like&nonce="+ajax_var.nonce+"&wize_post_like=&post_id="+post_id,
			success: function(count){
				if( count.indexOf( "already" ) !== -1 )
				{
					var lecount = count.replace("already","");
					if (lecount === "0")
					{
						lecount = "Like";
					}
					heart.prop('title', 'Like');
					heart.removeClass("like");
					heart.addClass("unlike");
					heart.html(""+lecount+"");
				}
				else
				{
					heart.prop('title', 'Unlike');
					heart.addClass("like");
					heart.removeClass("unlike");
					heart.html(""+count+"");
				}
			}
		});
	});
});

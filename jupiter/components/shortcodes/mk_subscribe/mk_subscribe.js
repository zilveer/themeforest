(function($) {
	'use strict';

	$(".mk-subscribe").each(function() {
		var $this = $(this);
		
		$this.find('.mk-subscribe--form').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: MK.core.path.ajaxUrl,
				type: "POST",
				data: {
					action: "mk_ajax_subscribe",
					email: $this.find(".mk-subscribe--email").val(),
					list_id: $this.find(".mk-subscribe--list-id").val(),
					optin: $this.find(".mk-subscribe--optin").val()
				},
				success: function (res) {
					$this.find(".mk-subscribe--message").html($.parseJSON(res).message);
					console.log($.parseJSON(res).message);
				}
			});
		});
	});

}(jQuery));
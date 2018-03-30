jQuery(document).ready(function($){

	$("#name").blur(validateName);
	$("#email").blur(validateEmail);
	$("#website").blur(validateWebsite);
	$("#message").blur(validateMessage);

	$("#ef-reply").submit(function(){
		var n = validateName(null, "#name");
		var e = validateEmail(null, "#email");
		var w = validateWebsite(null, "#website");
		var m = validateMessage(null, "#message");
		if(n && e && w && m){
			return true;
		}else{
			return false;
		}
	});

	$("#ef-contact").submit(function(){
		var n = validateName(null, "#name");
		var e = validateEmail(null, "#email");
		var w = validateWebsite(null, "#website");
		var m = validateMessage(null, "#message");
		if(n && e && w && m){
			$.ajax({
				type: 'POST',
				url: sg_template_url + '/includes/contact-send.php',
				data: $(this).serialize() + '&ajax=1',
				success: function(ajaxCevap) {
					$(".ef-list").prepend(ajaxCevap).fadeIn(500);
					setTimeout(function(){
						$(".ef-list").fadeOut(500, function () {
							$(this).html("<span></span>")
						});
					}, 5000);
					$("#name").attr("value", "");
					$("#email").attr("value", "");
					$("#website").attr("value", "");
					$("#message").attr("value", "");
				}
			});
			return false;
		}else{
			return false;
		}
	});

	function validateName(c, d){
		var e = (c == null) ? d : this;
		var a = $(e).val();
		var	b = $(e).attr("aria-required");
		if(b && !a){
			$(e).parent().removeClass("valid").addClass("not-valid");
			return false;
		} else {
			$(e).parent().removeClass("not-valid").addClass("valid");
			return true;
		}
	}

	function validateEmail(c, d){
		var e = (c == null) ? d : this;
		var a = $(e).val();
		var	b = $(e).attr("aria-required");
		var filter = /^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/;
		if(b && !filter.test(a)){
			$(e).parent().removeClass("valid").addClass("not-valid");
			return false;
		} else {
			$(e).parent().removeClass("not-valid").addClass("valid");
			return true;
		}
	}

	function validateWebsite(c, d){
		var e = (c == null) ? d : this;
		var a = $(e).val();
		var	b = $(e).attr("aria-required");
		var filter = /^((https?|ftp)\:\/\/)?([a-z0-9]{1,})([a-z0-9-.]*)\.([a-z]{2,4})$/;
		if((!a && b) || (a && !filter.test(a))){
			$(e).parent().removeClass("valid").addClass("not-valid");
			return false;
		} else {
			$(e).parent().removeClass("not-valid").addClass("valid");
			return true;
		}
	}

	function validateMessage(c, d){
		var e = (c == null) ? d : this;
		var a = $(e).val();
		if(!a){
			$(e).parent().removeClass("valid").addClass("not-valid");
			return false;
		} else {
			$(e).parent().removeClass("not-valid").addClass("valid");
			return true;
		}
	}

});
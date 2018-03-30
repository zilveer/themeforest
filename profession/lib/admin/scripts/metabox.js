/*
 *  RedSky Framework
 *  
 */

jQuery(document).ready(function($){

    if ( $("#post_type").val() != "portfolio" ) {
		//$("#formatdiv").hide();
	};

	$(".portfolio_form [placeholder]").placeholder();
		
	if ( $("#post_type").val() == "portfolio" ) {
	
		if ( $("#post-formats-select #post-format-0").is(":checked") ) {
			$("#44,.portfolio_post_standard").show();
			$("#postdivrich ,.portfolio_post_audio ,#type_section").hide();
		}
		
		if ( $("#post-formats-select #post-format-quote").is(":checked") ) {
			$("#portfolio_meta_box , #type_section").hide();
			$("#postdivrich").show();
		}
		
		if ( $("#post-formats-select #post-format-gallery").is(":checked") ) {
			$("#portfolio_meta_box ,.portfolio_post_audio , #intro_section ,.portfolio_post_video").hide();
			$("#postdivrich , #type_section   , #portfolio_meta_box , .portfolio_post_image ").show();
		}
		
		if ( $("#post-formats-select #post-format-video").is(":checked") ) {
			$("#intro_section , .portfolio_post_audio ,.portfolio_post_image  , #postdivrich").hide();
			$("#type_section ,#portfolio_meta_box , .portfolio_post_video ").show(); 	
		}
		
		if ( $("#post-formats-select #post-format-audio").is(":checked") ) {
			$(".portfolio_post_standard , #type_section").hide();
			$("#portfolio_meta_box ,.portfolio_post_audio ,#postdivrich").show();
		}
		
		$("#post-formats-select input").click( function() {
		
			if ( $( this ).val() == "0" ) {
				$("#portfolio_meta_box ,.portfolio_post_standard , #intro_section").show();
				$("#postdivrich ,.portfolio_post_audio, #type_section ").hide();
			}
			else if ( $( this ).val() == "audio" ) {
				$("#portfolio_meta_box,.portfolio_post_audio , #postdivrich ,#intro_section").show();
				$(".portfolio_post_standard , #type_section").hide();
			}
			else if ( $( this ).val() == "gallery" ) {
				$("#type_section , #postdivrich , #portfolio_meta_box , .portfolio_post_image ").show();
				$("#intro_section ,.portfolio_post_audio ,.portfolio_post_video").hide();
			}
			else if ( $( this ).val() == "video" ) {
				$("#type_section , #portfolio_meta_box ,.portfolio_post_video").show();
				$("#intro_section  ,.portfolio_post_audio , .portfolio_post_image  , #postdivrich").hide();
			}
			else {
				$("#portfolio_meta_box ,#intro_section , #type_section").hide();
				$("#postdivrich").show();
			}
			
		} );
	
	}
	else {
		
		//$("#formatdiv").hide();
		
	}
	
});

/*
* Placeholder plugin for jQuery
* ---
* Copyright 2010, Daniel Stocks (http://webcloud.se)
* Released under the MIT, BSD, and GPL Licenses.
*/
(function(b){function d(a){this.input=a;a.attr("type")=="password"&&this.handlePassword();b(a[0].form).submit(function(){if(a.hasClass("placeholder")&&a[0].value==a.attr("placeholder"))a[0].value=""})}d.prototype={show:function(a){if(this.input[0].value===""||a&&this.valueIsPlaceholder()){if(this.isPassword)try{this.input[0].setAttribute("type","text")}catch(b){this.input.before(this.fakePassword.show()).hide()}this.input.addClass("placeholder");this.input[0].value=this.input.attr("placeholder")}},
hide:function(){if(this.valueIsPlaceholder()&&this.input.hasClass("placeholder")&&(this.input.removeClass("placeholder"),this.input[0].value="",this.isPassword)){try{this.input[0].setAttribute("type","password")}catch(a){}this.input.show();this.input[0].focus()}},valueIsPlaceholder:function(){return this.input[0].value==this.input.attr("placeholder")},handlePassword:function(){var a=this.input;a.attr("realType","password");this.isPassword=!0;if(b.browser.msie&&a[0].outerHTML){var c=b(a[0].outerHTML.replace(/type=(['"])?password\1/gi,
"type=$1text$1"));this.fakePassword=c.val(a.attr("placeholder")).addClass("placeholder").focus(function(){a.trigger("focus");b(this).hide()});b(a[0].form).submit(function(){c.remove();a.show()})}}};var e=!!("placeholder"in document.createElement("input"));b.fn.placeholder=function(){return e?this:this.each(function(){var a=b(this),c=new d(a);c.show(!0);a.focus(function(){c.hide()});a.blur(function(){c.show(!1)});b.browser.msie&&(b(window).load(function(){a.val()&&a.removeClass("placeholder");c.show(!0)}),
a.focus(function(){if(this.value==""){var a=this.createTextRange();a.collapse(!0);a.moveStart("character",0);a.select()}}))})}})(jQuery);
function getCookie(c_name)
{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name)
		{
			return unescape(y);
		}
	}
}
function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value + ";domain=;path=/";
}
jQuery(document).ready(function($){
	$(".layout_picker_content select").focusin(function(){
		$(".layout_picker").addClass("layout_picker_active");
	});
	$(".layout_picker_content select").focusout(function(){
		$(".layout_picker").removeClass("layout_picker_active");
	});
	$(".layout_picker_content .layout_picker_layout_list [name='layout_picker_layout']").change(function(){
		$(".site_container").removeClass("layout_picker_no_transition");
		if($(this).val()=="layout_picker_bx")
		{
			$(".site_container").removeClass("fullwidth").addClass("boxed");
			setCookie("mc_layout", "boxed");
		}
		else if($(this).val()=="layout_picker_fw")
		{
			$(".site_container").removeClass("boxed").addClass("fullwidth");
			setCookie("mc_layout", "fullwidth");
		}
		else
		{
			$(".site_container").removeClass("boxed").removeClass("fullwidth");
			setCookie("mc_layout", "");
		}
		
		var steps = 11;
		var idSliderInt = setInterval(function(){
			steps--;
			$(window).trigger('resize');
			if(steps==0)
				clearInterval(idSliderInt);
		}, 100);
	});
	$(".layout_picker_content .layout_picker_layout_list [name='layout_picker_layout'] [selected='selected']").attr("selected", "selected");
	$(".layout_picker_content .layout_picker_layout_list [name='layout_picker_header_type'], .layout_picker_content .layout_picker_layout_list [name='layout_picker_header_sidebar'], .layout_picker_content .layout_picker_layout_list [name='layout_picker_header_sidebar_right']").change(function(){
		if($(this).attr("name")=="layout_picker_header_type")
		{
			setCookie("mc_header_type", parseInt($(this).val()));
			if(parseInt($(this).val())==2)
				setCookie("mc_header_sidebar_right", 1);
		}
		else if($(this).attr("name")=="layout_picker_header_sidebar")
			setCookie("mc_header_sidebar", parseInt($(this).val()));
		else
			setCookie("mc_header_sidebar_right", parseInt($(this).val()));
		location.reload();
	});
	$(".layout_picker_content .layout_picker_layout_list [name='layout_picker_header_sidebar'] [value='" + getCookie("mc_header_sidebar") + "']").attr("selected", "selected");
	$(".layout_picker_content .layout_picker_layout_list [name='layout_picker_header_sidebar_right'] [value='" + getCookie("mc_header_sidebar_right") + "']").attr("selected", "selected");
	$("[name='layout_picker_sticky_menu']").change(function(){
		if($(this).val()==1)
		{
			if($(".header").hasClass("layout_1") || $(".header").hasClass("layout_4"))
			{
				$(".header_container").addClass("sticky");
				if(menu_position==null)
					menu_position = $(".header_container").offset().top;
			}
			else if($(".header").hasClass("layout_2"))
			{
				$(".header_container:eq(1)").addClass("sticky");
				if(menu_position==null)
					menu_position = $(".header_container:eq(1)").offset().top;
			}			
			$(document).scroll();
		}
		else
		{
			$(".header_container").removeClass("sticky");
		}
		setCookie("mc_sticky_menu", $(this).val());
	});
	$("[name='layout_picker_direction']").change(function(){
		setCookie("mc_direction", $(this).val());
		location.reload();
	});
	$("[name='layout_picker_animations']").change(function(){
		setCookie("mc_animations", $(this).val());
		location.reload();
	});
});
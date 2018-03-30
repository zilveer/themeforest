jQuery(document).ready(function(){
	jQuery(window).bind("resize", orange_responsive);
	orange_responsive();
});

var iPhoneVertical = Array(null,320, ot.cssUrl+"responsive/phonevertical.css?"+Date());
var iPhoneHorizontal = Array(321,750,ot.cssUrl+"responsive/phonehorizontal.css?"+Date());
var iPadv = Array(751,1023,ot.cssUrl+"responsive/ipadv.css?"+Date());
var iPad = Array(1024,1200,ot.cssUrl+"responsive/ipad.css?"+Date());
var dekstop = Array(1201,null,ot.cssUrl+"responsive/desktop.css?"+Date());

var is_orange_mobile = false;

function orange_responsive(){
	var newWindowWidth = jQuery(window).width();
	if(newWindowWidth >= dekstop[0]){
		if(jQuery("#style-responsive-css").attr("href") == dekstop[2])return;
		jQuery("#style-responsive-css").attr({href : dekstop[2]});
		is_orange_mobile = false;
	}else if(newWindowWidth >= iPad[0] && newWindowWidth <= iPad[1]){
		if(jQuery("#style-responsive-css").attr("href") == iPad[2])return;
		jQuery("#style-responsive-css").attr({href : iPad[2]});
		is_orange_mobile = false;
	}else if(newWindowWidth >= iPadv[0] && newWindowWidth <= iPadv[1]){
		if(jQuery("#style-responsive-css").attr("href") == iPadv[2])return;
		jQuery("#style-responsive-css").attr({href : iPadv[2]});
		is_orange_mobile = false;
	}else if(newWindowWidth >= iPhoneHorizontal[0] && newWindowWidth <= iPhoneHorizontal[1]){
		if(jQuery("#style-responsive-css").attr("href") == iPhoneHorizontal[2])return;
		jQuery("#style-responsive-css").attr({href : iPhoneHorizontal[2]});
		is_orange_mobile = true;
	}else if(newWindowWidth <= iPhoneVertical[1]){
		if(jQuery("#style-responsive-css").attr("href") == iPhoneVertical[2])return;
		jQuery("#style-responsive-css").attr({href : iPhoneVertical[2]});
		is_orange_mobile = true;
	}
}

orange_responsive();
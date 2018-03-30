var root_path = jQuery("#default_stylesheet-css").attr("href");
root_path = root_path.substr(0, root_path.lastIndexOf("style.css"));

jQuery(document).ready(function() {
if (jQuery("#style-stretched-css").size() == 0) {
	jQuery("body").css("background-image", 'url("' + root_path + 'images/pattern/bg-4.png")')
}

jQuery('select#background').change(function () { 
	var bg = jQuery(this).children(":selected").val();
	if (bg != "bg1.jpg") {
		jQuery("#backstretch").remove();
		jQuery("body").css("background-image", 'url("' + root_path + 'images/pattern/' + bg + '")')
	} else {
		jQuery.backstretch(root_path + 'images/pattern/' + bg);
	}

});	



jQuery('select#layout').change(function () { 
	var b = jQuery(this).children(":selected").val();
	var newURL = jQuery(location).attr('href');
	newURL = newURL.substr(0, newURL.lastIndexOf("?layout"));
	if (b == 'streched') {
		window.location.href = newURL + "?layout=stretched";
	}	
	else if (b == 'boxed') {
		window.location.href = newURL + "?layout=boxed";
	}
});	


 jQuery("select#colors").change(function(){
  var color = jQuery(this).children(":selected").val();
  if (jQuery("#css_color_style-css").length > 0){
	  jQuery("#css_color_style-css").remove();
  } 
  jQuery("head").append("<link>");
  css = jQuery("head").children(":last");
  css.attr({
    rel:  "stylesheet",
    type: "text/css",
    id: "css_color_style-css",
    href: root_path + "css/colors/" + color
  });
 })

 jQuery("#panel a.open").click(function(){
  var margin_left = jQuery("#panel").css("margin-left");
  if (margin_left == "-210px"){
  jQuery("#panel").animate({marginLeft: "0px"});
 }
 else{
  jQuery("#panel").animate({marginLeft: "-210px"});
 }
 return false;

 })

}); 
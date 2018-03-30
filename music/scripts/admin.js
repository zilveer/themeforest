$nets = jQuery.noConflict();

var current_gallery_item = "";
var current_tab = "";

$nets(document).ready(function () {
			
	$nets('.ntl_asaver').live('click', function() {
	 var postid= $nets(this).attr('href');
	 tb_show('', postid);
	 return false;
	});
	
});
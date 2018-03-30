jQuery(document).ready(function () {

 	var r_iDs = jQuery("#post-formats-select input:checked").attr('id');
	
	if( typeof r_iDs !== "undefined"){

		var r_repIDs    = r_iDs.replace(/post-format-/gi,"");
		var $blocksID = ( r_repIDs == "0" ) ? "standard" : r_repIDs;

		jQuery(".van-post-options #van-" + $blocksID).show();
	}else{

		jQuery(".van-post-options #van-standard").show();

	}
	jQuery("#post-formats-select input").bind("change", function(){

		var  id = jQuery(this).attr("id");
		var repIDs    = id.replace(/post-format-/gi,"");
		var blocksID = ( repIDs == "0" ) ? "standard" : repIDs;

		jQuery(".van-post-options #van-standard,.van-post-options #van-image,.van-post-options #van-gallery,.van-post-options #van-link,.van-post-options #van-video,.van-post-options #van-audio,.van-post-options #van-quote,.van-post-options #van-status,.van-post-options #van-aside").slideUp(0);
		jQuery(".van-post-options #van-" + blocksID).slideDown(300);

	});

 });
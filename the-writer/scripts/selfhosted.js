jQuery(document).ready(function(){
	jQuery(".jp-jplayer").each(function(){
		width = jQuery(this).attr("data-width");
		height = jQuery(this).attr("data-height");
		useid = "#jp_container_"+jQuery(this).attr("data-id");
		jQuery(this).jPlayer({
			cssSelectorAncestor: useid,
			solution: 'html',
			wmode: "transparent",
			ready: function () {
				jQuery(this).jPlayer("setMedia", {

					m4v: jQuery(this).attr("data-m4v"),
					ogv: jQuery(this).attr("data-ogv"),
					webmv: jQuery(this).attr("data-webmv"),
					poster: jQuery(this).attr("data-image")
					
				});
			},
			swfPath: "../scripts",
			supplied: "webmv, ogv, m4v",
			size: {
				width: width+"px",
				height: height+"px",
				cssClass: "jp-video-360p"
			}
		});
	})
});
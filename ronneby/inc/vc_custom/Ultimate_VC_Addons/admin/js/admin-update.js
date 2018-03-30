jQuery(document).ready(function(e) {
	var update = jQuery(".update-plugins");
	var count = update.find(".update-count").text();
	count = parseInt(count)+1;
	update.removeClass("count-0").addClass("count-"+count);
	update.find(".update-count").html(count);
	jQuery("#wp-admin-bar-updates").find(".ab-label").html(count);
	jQuery(".plugin-count").html(count);
	
	jQuery("#ultimate-addons-for-visual-composer").addClass("update");
	var html = '<tr class="plugin-update-tr">\
				<td colspan="3" class="plugin-update colspanchange">\
					<div class="update-message">There is a new version of Ultimate Addons for Visual Composer available. \
					<a href="update-core.php#brainstormforce-plugins">Check update details.</a>\
					</div>\
				</td>\
			</tr>';
	jQuery(html).insertAfter("#ultimate-addons-for-visual-composer");
	
});

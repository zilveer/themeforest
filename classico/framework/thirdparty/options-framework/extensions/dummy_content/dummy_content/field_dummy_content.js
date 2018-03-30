/* global confirm, redux, redux_change */

jQuery(document).ready(function() {

	/****************************************************/
	/* Import XML data */
	/****************************************************/

	jQuery('#install_dummy').change(function(e) {
		e.stopPropagation();
	});

	var importBtn = jQuery('.install_dummy');

	importBtn.bind("click", (function(e){
		e.preventDefault();

		var active = jQuery(this);
		var name = active.data('name');

		if(!confirm('Are you sure you want to install "' + name + '" demo data? (It will change all your theme configuration.)')) {
			
			return false;
			
		}
		
		active.text('Installing demo data... Please wait...').removeClass('blue').addClass('disabled').attr('disabled', 'disabled').unbind('click');

		var	version = active.data('version');
		var	pageid = active.data('pageid');

		jQuery.ajax({
			method: "POST",
			url: ajaxurl,
			data: {
				'action'  :'etheme_import_ajax',
				'version' : version,
				'pageid'  : pageid
			},
			success: function(data){
				jQuery('#redux-sticky').before('<div id="setting-error-settings_updated" class="updated settings-error">' + data + '</div>');
			},
			complete: function(){
				active.addClass('green');
				active.text('Successfully installed!');
				location.reload();
			}
		});
	
	}));
	

});

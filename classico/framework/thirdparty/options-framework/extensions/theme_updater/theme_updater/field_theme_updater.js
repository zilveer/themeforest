/* global confirm, redux, redux_change */

jQuery(document).ready(function($) {

	/****************************************************/
    /* Theme Updater */
    /****************************************************/
    
    var updaterBtn = jQuery('.update_theme');


	updaterBtn.bind("click", (function(e){
		e.preventDefault();

		if(updaterBtn.hasClass('disabled')) return;
        
		if(!confirm('Are you sure you want to update theme files? (It will replace all your files)')) {
			
			return false;
			
		}
		updaterBtn.parent().find('.error, .updated').remove();
		updaterBtn.after('<div id="floatingCirclesG" class="loading"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>');
        updaterBtn.text('Uploading... Please wait...').addClass('disabled').prop('disabled', true);
	

		var data = new FormData();
		
		jQuery.each(jQuery('#theme_zip')[0].files, function(i, file) {
		    data.append('file-'+i, file);
		});


		jQuery.ajax({
			method: "POST",
			url: ajaxurl + '?action=et_upload_zip',
			data: data,
			cache: false,
			processData: false, // Don't process the files
			contentType: false,
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data.form != '') {
					updaterBtn.parent().prepend(data.form);
					updaterBtn.remove();
					return;
				}
				if(data.errors.length > 0) {
					var errorsHtml = '<div class="error"><p>';
					for (var i = 0; i < data.errors.length; i++) {
						errorsHtml += data.errors[i] + '<br>';
					};
					errorsHtml += '</p></div>';
					updaterBtn.parent().prepend(errorsHtml);
					updaterBtn.removeClass('disabled').prop('disabled', false).text('Update theme');
				}
				if(data.successes.length > 0) {
					var successHtml = '<div class="updated"><p>';
					for (var i = 0; i < data.successes.length; i++) {
						successHtml += data.successes[i] + '<br>';
					};
					successHtml += '</p></div>';
					updaterBtn.parent().prepend(successHtml);
					updaterBtn.text('Done.');
				}
			},
			complete: function(){
                jQuery('#floatingCirclesG').remove();
                //jQuery('.installing-info').remove();
               
			},
			error: function() {
				alert('ajax error');
				updaterBtn.removeClass('disabled').prop('disabled', false).text('Update theme');
			}
		});
	
	}));
	

});

jQuery(document).ready(function ($) {
    "use strict";

    $('button#demo-importer').live('click', function () {
	var parent = $(this).parents('div.extention-bottom2');
	var id = $(this).data('id');
	var $this = (this);
	var name = $(this).data('name');
	var isCheck = $(parent).find('input');
	var media = '';
	if ($(isCheck).is(':checked')) {
	    media = 'true';
	}
	var data = 'media=' + media + '&fileid=' + id + '&name=' + name + '&action=crazyblog_installDemo';
	jQuery.ajax({
	    type: "post",
	    url: ajax_url,
	    data: data,
	    beforeSend: function () {
		$(this).prop('disabled', true);
		$($this).find('i').fadeIn('slow');
		$('div.page-wraper').fadeIn('slow');
	    },
	    success: function (response) {
		$(isCheck).prop('checked', false);
		$('div.page-wraper').fadeOut('slow');
		$($this).prop('disabled', false);
		$($this).find('i').fadeOut('slow');
		$('div.popup-wrapper p#response-data').empty();
		$('div.popup-wrapper').fadeIn('slow');
		$('div.popup-wrapper p#response-data').html(response);
	    }
	});
	return false;
    });

});
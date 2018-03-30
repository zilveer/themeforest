(function( exports, $ ){
	var api = wp.customize;
	api.HeaderTool = {};

	var message =
		'<div class="container">' +
		'	<div class="row"> ' +
		'		<div class="col-xs-12 wp-customizer-msg"> ' +
		'			<h1 class="alert text-center">Temporary unavailable</h1> ' +
		'			<p>Currently revisiting this section to make a better customizer, sorry for the inconvenience</p> ' +
		'		</div' +
		'	</div> ' +
		'</div> ';

	var title = $(document).prop('title').split(':');
	$(document).prop('title', title[0]);

	$('#save').attr('disabled','disabled');
	$('#customize-preview').removeClass('wp-full-overlay-main').html(message);

})( wp, jQuery );

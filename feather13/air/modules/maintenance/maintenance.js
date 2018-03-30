jQuery(document).ready(function($) {

	$('#air-default-insert').click(function(e) {
		e.preventDefault();

		// Default HTML
		$('#air_maintenance-html').val(
			'<div class="wrap">' + '\n' +
			'<h1>Site Maintenance</h1>' + '\n' +
			'<p class="note">Site is currently under maintenance. Please check back later.</p>' +'\n' +
			'</div>'
		);

		// Default CSS
		$('#air_maintenance-css').val(
			'body { font-family: Arial,sans-serif; font-size: 15px; color: #444; line-height: 1.5em; margin: 80px; }' + '\n' +
			'h1 { font-size: 32px; letter-spacing: -1px; margin-bottom: 30px; }' + '\n' +
			'.wrap { margin: 0 auto; text-align: center; width: 500px; }' + '\n' +
			'.note { background: #fffad6; color: #846000; padding: 10px; }'
		);
	})

});
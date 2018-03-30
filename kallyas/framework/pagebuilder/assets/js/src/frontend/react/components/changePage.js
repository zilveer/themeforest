import $ from 'jQuery';

// Disable the nagging confirm modals if the theme is set in debug mode
if ( ZnAjax.debug === true ) {
	window.showed_message = true;
}
else {
	window.showed_message = false;
	document.onkeydown = check_message;
}

// Disable the prompt on refresh so we can replace it with our own message
window.onbeforeunload = function(e) {

	if( window.showed_message === true ){
		window.showed_message = false;
	}
	else{
		return 'Any unsaved changes will be lost !';
	}
};

function check_message(e){
	if (
		( e.which || e.keyCode ) == 116 || // F5
		( e.ctrlKey && e.keyCode == 82 ) || // CTRL + R
		( e.ctrlKey && e.keyCode == 16 && e.keyCode == 82 ) // CTRL + SHIFT + R
	){

		e.preventDefault();
		new $.ZnModalConfirm(
			'You are about to refresh the page. Any unsaved changes will be lost. <br>Are you sure you want to reload the page ?',
			'Stay on page',
			'Refresh page',
			function(){
				window.showed_message = true;
				location.reload();
			},
			function(){
				window.showed_message = false;
			}
		);

	}
}

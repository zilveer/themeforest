jQuery(document).ready(function($){
	$form = $('.form-import form');
	$file_input = $('.form-import input:file');
	
	$form.on('submit', function() {
		if ($file_input.val() === '') {
			alert("Please select file.");
			return false;
		};
	});
	
	$('.export-theme-option').prependTo('#option-tree-sub-header').fadeIn('normal');
});
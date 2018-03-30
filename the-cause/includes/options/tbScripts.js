// Theme Options Scripts
jQuery(document).ready(function($) {
	$("#wpbody-content .tbOptionSection:odd").addClass('odd');
	
	$("#tb_color_scheme").change(function() {
		choice = $("#tb_color_scheme option:selected").attr('value');
		if (choice == 'idealist') {
			$('#tb_navigation_bckg option:selected').attr('selected', false);
			$('#tb_button_style option:selected').attr('selected', false);
			$('#tb_button_extra_style option:selected').attr('selected', false);
			$('#tb_sidebar_style option:selected').attr('selected', false);
			$('#tb_navigation_bckg option[value=green]').attr('selected', 'selected');
			$('#tb_button_style option[value=default]').attr('selected', 'selected');
			$('#tb_button_extra_style option[value=green]').attr('selected', 'selected');
			$('#tb_sidebar_style option[value=green]').attr('selected', 'selected');	
		} else if (choice == 'spiritual') {
			$('#tb_navigation_bckg option:selected').attr('selected', false);
			$('#tb_button_style option:selected').attr('selected', false);
			$('#tb_button_extra_style option:selected').attr('selected', false);
			$('#tb_sidebar_style option:selected').attr('selected', false);
			$('#tb_navigation_bckg option[value=brown]').attr('selected', 'selected');
			$('#tb_button_style option[value=default]').attr('selected', 'selected');
			$('#tb_button_extra_style option[value=brown]').attr('selected', 'selected');
			$('#tb_sidebar_style option[value=brown]').attr('selected', 'selected');	
		} else if (choice == 'politica') {
			$('#tb_navigation_bckg option:selected').attr('selected', false);
			$('#tb_button_style option:selected').attr('selected', false);
			$('#tb_button_extra_style option:selected').attr('selected', false);
			$('#tb_sidebar_style option:selected').attr('selected', false);
			$('#tb_navigation_bckg option[value=default]').attr('selected', 'selected');
			$('#tb_button_style option[value=default]').attr('selected', 'selected');
			$('#tb_button_extra_style option[value=default]').attr('selected', 'selected');
			$('#tb_sidebar_style option[value=default]').attr('selected', 'selected');	
		} else {
			// ...
		}
	});
});
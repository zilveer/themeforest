/* <![CDATA[ */
	var clearpath = optionsSettings.clearpath;
	jQuery(document).ready(function(){
		jQuery('#options-content,#options-content > div').tabs({ fx: { opacity: 'toggle', duration:'fast' }, selected: 0 });
		// ":not([safari])"
		jQuery('input:checkbox:not([safari])').checkbox();
		jQuery('input[safari]:checkbox').checkbox({cls:'jquery-safari-checkbox'});
		jQuery('input:radio').checkbox();
		
	});
	
/* ]]> */
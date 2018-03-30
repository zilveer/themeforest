/*

Global vars

*/

var selected;

/*

Main jQuery base function

*/

jQuery(function () {

	// select shortcode event
	jQuery("select[name=shortcode_dropdown]").change(function () 
	{
	
		selected = {
		
			name: jQuery(this).find("option:selected").val(),
			atts: jQuery(this).find("option:selected").attr("data-div"),
			custom_output: jQuery(this).find("option:selected").attr("data-custom"),
			content_required: jQuery(this).find("option:selected").attr("data-content")
		
		}
				
		jQuery("#shortcode_atts_panels > div").css("display", "none");
		jQuery("#shortcode_atts_panels").find(('#' + selected.atts)).css("display", "block");
	
	}).change();
	
	// generate shortcode button event
	jQuery("#submit").click(function () {
	
		generateShortcode(composeShortcode());
		
	});
	
});

/*

This function generates the output of our shortcode

*/

function composeShortcode ()
{

	var output;
	
	if (selected.custom_output == "false")
	{
	
		output = '[' + selected.name;
	
		if (selected.atts != "false")
		{
				
			jQuery('#' + selected.atts).find("div.shortcode_att").each(function () {
			
				output += " ";

				output += (jQuery(this).find("input, select").attr("id")).replace("sc_att_", "") + '="';
			
				output += jQuery(this).find("input, select").val();
				
				output += '"';
			
			});
			
			output += '] ';
			
			if (selected.content_required == "true")
			{
			
				output += 'Content Here [/' + selected.name + '] ';		
			
			}
			
		
		} else {
		
			output += '] ';
		
		}
		
		return output;			
	
	} else {

		return selected.custom_output;	
	
	}

}

/*

This function places the shortcode in the editor

*/

function generateShortcode (output)
{

	if(window.tinyMCE) 
	{

		tinyMCE.execCommand('mceInsertContent',false,output);
		// prevent graphic glitch
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
		return false;

	}	

}
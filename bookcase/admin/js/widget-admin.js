jQuery("document").ready(function(){
	var sidebars = new Array(); // Create array to hold our list of widget areas
	var selectorHTML, name; // Declaring variables isn't necessary in JavaScript, but it's good practice
 
	jQuery('.widget-liquid-right .sidebar-name h3').each(function(index) {
		name = jQuery(this).html(); // Get the name of each widget area
		name = name.replace(/\s*<span>.*<\/span>/,''); // Remove extra <span> block from name
		sidebars.push(name); // Add the name to our array
	});
 
	jQuery('.widget-liquid-right .widgets-holder-wrap').hide(); // Hide all the widget areas in list
	jQuery('.widget-liquid-right .widgets-holder-wrap:first').show(); // Show the first
 
	// Start <select> block. Position to the right of the "Widgets" heading.
	selectorHTML = "<p style='position:absolute; left:350px; top:63px; font-size:10px;'>Select a Widget Section:</p><select id=\"sidebarSelector\" style=\"position: absolute; left: 500px; top: 68px;\">\n";
 
	var count = 0;
	for ( var i in sidebars ) // Add option for each widgetized area
		selectorHTML = selectorHTML + "<option value=\"" + count++ + "\">" + sidebars[i] + "</option>\n"; // Store the index of the widget area in the 'value' attribute
 
	selectorHTML = selectorHTML + "</select>"; // Close the <select> block
 
	jQuery('div.wrap').append(selectorHTML); // Insert it into the DOM
 
	jQuery('#sidebarSelector').change(function(){ // When the user selects something from the select box...
		index = jQuery(this).val(); // Figure out which one they chose
		jQuery('.widget-liquid-right .widgets-holder-wrap').hide(); // Hide all the widget areas
		jQuery('.widget-liquid-right .widgets-holder-wrap:eq(' + index + ')').show(); // And show only the corresponding one
	});
});

// Insert video function

function insertVideo() {
	
	var shortcodeText;
	
		
	/* Video shortcode */
	
	var videoType = document.getElementById('video_type').value;
	var videoId = document.getElementById('video_id').value;
	var videoWidth = document.getElementById('video_width').value;
	var videoHeight = document.getElementById('video_height').value;
	
	// File formats 
	var videoPoster = document.getElementById('video_poster').value;
	var videoM4v = document.getElementById('video_m4v').value;
	var videoOgv = document.getElementById('video_ogv').value;
	var videoWebmv = document.getElementById('video_webmv').value;
	
	
	
	shortcodeText = '[video type="' + videoType + '" id="' + videoId + '" width="' + videoWidth + '" height="' + videoHeight + '" poster="' + videoPoster + '" m4v="' + videoM4v + '" ogv="' + videoOgv+ '" webmv="' + videoWebmv + '"]';
	
	
	
	if(window.tinyMCE) {
	
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
	
}


function insertButtons() {
	
	var shortcodeText;
	
	var link;
	
	var buttonLink = document.getElementById('button_link').value;
	var buttonPageLink = document.getElementById('button_page_link').value;
	var buttonText = document.getElementById('button_text').value;
	var buttonSize = document.getElementById('button_size').value;
	var buttonTarget = document.getElementById('button_target');
	var buttonAlign = document.getElementById('button_align').value;
	var buttonColor = document.getElementById('button_text_color').value;
	var buttonBackground = document.getElementById('button_background_color').value;
	var buttonBorder = document.getElementById('button_border_color').value;
	
	

	if(buttonTarget.checked){
		target = 'external';
	}
	else {
		target = '';
		}
		
	if(buttonLink){
	
		link = buttonLink;
	}
	
	else{
	
		link = buttonPageLink;
	}
	
	shortcodeText = '[button size="' + buttonSize + '"   url="' + link + '" align="' + buttonAlign + '" rel="' + target + '" color="' + buttonColor + '" bordercolor="' + buttonBorder + '" backgroundcolor="' + buttonBackground + '" ]' + buttonText + '[/button]';
	
		
	if(window.tinyMCE) {
	
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		window.tinyMCE.execInstanceCommand('epic_page_content', 'mceInsertContent', false, shortcodeText);
		
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
	
}

function insertForm() {
	
	var shortcodeText;
	var formType = document.getElementById('form_shortcode').value;
	
	shortcodeText = '[epic_form type="' + formType + '"]';
	
		
	if(window.tinyMCE) {
	
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		window.tinyMCE.execInstanceCommand('epic_page_content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
	
}

function insertDropcaps() {
	
	var shortcodeText;
	var dropcapText = document.getElementById('dropcap_text').value;
	var dropcapStyle = document.getElementById('dropcap_style').value;

	
	shortcodeText = '[epic_dropcap style="' + dropcapStyle + '"]' + dropcapText +'[/epic_dropcap]';
	
		
	if(window.tinyMCE) {
	
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		window.tinyMCE.execInstanceCommand('epic_page_content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
	
}




function insertTabs() {
	
	var shortcodeText;
	var type = document.getElementById('tab_type').value;
	var tabs = document.getElementById('tab_text').value;
	
	var tabArray = tabs.split(',');
	var toggle;
	var tab;
	var i;
	var a;
	
	if( type == 'tab'){
		
		shortcodeText = '[tabpanel';
			
		i=0;
		for(tab in tabArray){
		i++;
   		 shortcodeText += ' tab'+ i +'="' + tabArray[tab] + '"';
		}
		shortcodeText += ']<br />';
	
		a=0;
		for(tab in tabArray){
		a++;
    	shortcodeText += '<br />[tab id="' + a + '"]<br /><h2>'+ tabArray[tab] +'</h2><p>Tab '+ i +' content </p><br />[/tab]<br />';
		}
	}
	
	else if(type == 'accordion'){
		
		shortcodeText = '';
		for(toggle in tabArray){
		shortcodeText += '<br/>[accordion title="' + tabArray[toggle] + '"]<br/>Enter content here<br>[/accordion]<br />';
    	}
	
	}
	
	else if(type == 'toggle'){
		
		shortcodeText = '';
		for(toggle in tabArray){
		shortcodeText += '<br/>[toggle title="' + tabArray[toggle] + '"]<br/>Enter content here<br>[/toggle]<br />';
    	}
	
	}
	
		
		
	if(window.tinyMCE) {
	
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		window.tinyMCE.execInstanceCommand('epic_page_content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
	
}


/*
function insertToggles() {
	
	var shortcodeText;
		
	var toggleButtons = document.getElementById('toggles').value;
	
	var toggleArray = toggleButtons.split(',');
	
	
	shortcodeText = '';
	i=0;
	for(var toggle in toggleArray){
	i++;
	shortcodeText += '<br/>[accordion title="' + toggleArray[toggle] + '"]<br/>Enter content here<br>[/accordion]<br />';
    }
	
		
	if(window.tinyMCE) {
	
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
	
}

*/
function insertQuote() {
	
	var shortcodeText;
	
	
	var quoteStyle = document.getElementById('quote_style').value;
	var quoteText = document.getElementById('quote_text').value;
		
		
	shortcodeText = '<br />[epic_quote style="' + quoteStyle + '"]<br />' + quoteText + '<br />[/epic_quote]<br/>';
	
		
	if(window.tinyMCE) {
	
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		window.tinyMCE.execInstanceCommand('epic_page_content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
	
}


function insertBox() {
	
	var shortcodeText;
	
	var boxHeader = document.getElementById('box_header').value;
	var boxText = document.getElementById('box_text').value;
	var boxAlign = document.getElementById('box_align').value;
	var boxSize = document.getElementById('box_size').value;
	var boxMargin = document.getElementById('box_margin').value;
	
	if(boxMargin == 'on'){
	
		boxMargin = 'none';
	}
		
	shortcodeText = '<br />[epic_box header="' + boxHeader + '" align="'+ boxAlign + '" size="'+ boxSize + '" margin="'+ boxMargin + '" ]<br /><p>' + boxText + '</p><br />[/epic_box]<br />';
		
	if(window.tinyMCE) {
	
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		window.tinyMCE.execInstanceCommand('epic_page_content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
	
}




// Insert modules function

function insertModules() {	


	var shortcodeText;
	
	var shortcodeId = document.getElementById('module_shortcode').value;
	
	
	
	/* Modules shortcode */
	
	if (shortcodeId != 0 && shortcodeId == 'contactform' ){
		shortcodeText = '<br />[contactform]<br />';	
		}
	
	if (shortcodeId != 0 && shortcodeId == 'newslist' ){
		shortcodeText = '<br />[newslist per_page="8"]<br />';	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'newsarchive' ){
		shortcodeText = '<br />[newsarchive per_page="20"]<br />';	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'testimonials' ){
		shortcodeText = '<br />[testimonials per_page="4"]<br />';	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'events' ){
		shortcodeText = '<br />[events]<br />';	
		}
	
	if (shortcodeId != 0 && shortcodeId == 'faq' ){
		shortcodeText = '<br />[faq]<br />';	
		}
	
	if (shortcodeId != 0 && shortcodeId == 'author' ){
		shortcodeText = '[authorbox]';	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'relatedposts' ){
		shortcodeText = '[relatedposts max_posts="2"]';	
		}
	
	if (shortcodeId != 0 && shortcodeId == 'button' ){
		shortcodeText = '[button url="#"]Read more[/button]';	
		}
				
	// Medium buttons
		
	if (shortcodeId != 0 && shortcodeId == 'button_medium' ){
		shortcodeText = '[button size="medium" url="#"]Read more[/button]';	
		}
	

	if (shortcodeId != 0 && shortcodeId == 'button_large' ){
		shortcodeText = '[button size="large" url="#"]Read more[/button]';	
		}
	

	if (shortcodeId != 0 && shortcodeId == 'toggle_single' ){
		shortcodeText = '<br/>[toggle title="Button text" style="single"]<br/>Toggle content<br>[/toggle]<br/>';	
		}
	
	
	if (shortcodeId != 0 && shortcodeId == 'accordion' ){
		shortcodeText = '<br/>[accordion title="Button text" style="single"]<br/>Toggle content<br>[/accordion]<br/>[accordion title="Button text2" style="single"]<br/>Toggle content2<br>[/accordion]<br/>[accordion title="Button text3" style="single"]<br/>Toggle content3<br>[/accordion]<br/>';	
		}
	
	if (shortcodeId != 0 && shortcodeId == 'toggle_list' ){
		shortcodeText = '<br/>[toggle title="Button text"]<br/>Toggle content<br>[/toggle]<br/>';
		shortcodeText = '<br/>[toggle title="Button text" style="single"]<br/>Toggle content<br>[/toggle]<br/>[toggle title="Button text2" style="single"]<br/>Toggle content2<br>[/toggle]<br/>[toggle title="Button text3" style="single"]<br/>Toggle content3<br>[/v]<br/>';		
		}
		
		
	if (shortcodeId != 0 && shortcodeId == 'tabs_default' ){
		shortcodeText = '[tabpanel tab1="First tab" tab2="Second tab" tab3="Third tab"]<br/><br/>[tab id="1"]<h2>Tab 1 title</h2><p>Tab 1 content </p>[/tab]<br/>[tab id="2"]<h2>Tab 2 title</h2><p>Tab 2 content </p>[/tab]<br/>[tab id="3"]<h2>Tab 3 title</h2><p>Tab 3 content </p>[/tab]';	
		}
		

		
	if (shortcodeId != 0 && shortcodeId == 'lightbox' ){
		shortcodeText = '<br/>[lightbox href="" title=""]<br/><br/> Add text or image here <br/><br/>[/lightbox]<br/>';	
		}
		
		
		
		
		if ( shortcodeId == 0 ){
			tinyMCEPopup.close();
		}
	
	
	
	if(window.tinyMCE) {
	
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		window.tinyMCE.execInstanceCommand('epic_page_content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
		
}


function insertColumns() {	


	var shortcodeText;
	
	var shortcodeId = document.getElementById('column_shortcode').value;
		
	// Grids
	
	if (shortcodeId != 0 && shortcodeId == 'one_half' ){
		shortcodeText = "<br />[" + shortcodeId +"]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'one_half_last' ){
		shortcodeText = "<br />[" + shortcodeId +"]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'one_third' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'one_third_last' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
	
	if (shortcodeId != 0 && shortcodeId == 'two_third' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'two_third_last' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'one_fourth' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'one_fourth_last' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'three_fourth' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'three_fourth_last' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	
	if (shortcodeId != 0 && shortcodeId == 'one_fifth' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'one_fifth_last' ){
		shortcodeText = "<br />[" + shortcodeId +"]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'two_fifth' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'two_fifth_last' ){
		shortcodeText = "<br />[" + shortcodeId +"]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'three_fifth' ){
		shortcodeText = "<br />[" + shortcodeId + "]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'three_fifth_last' ){
		shortcodeText = "<br />[" + shortcodeId +"]<br />Content...<br />[/" + shortcodeId +"]<br />";	
		}
	
		
	if (shortcodeId != 0 && shortcodeId == 'two_column_grid' ){
		shortcodeText = "[one_half]<br />Content...<br />[/one_half]<br /><br />[one_half_last]<br />Content...<br />[/one_half_last]";	
		}
	
	if (shortcodeId != 0 && shortcodeId == 'three_column_grid' ){
		shortcodeText = "[one_third]<br />Content...<br />[/one_third]<br /><br />[one_third]<br />Content...<br />[/one_third]<br /><br />[one_third_last]<br />Content...<br />[/one_third_last]";	
		}
		
	if (shortcodeId != 0 && shortcodeId == 'four_column_grid' ){
		shortcodeText = "[one_fourth]<br />Content...<br />[/one_fourth]<br /><br />[one_fourth]<br />Content...<br />[/one_fourth]<br /><br />[one_fourth]<br />Content...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />Content...<br />[/one_fourth_last]";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'five_column_grid' ){
		shortcodeText = "[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth_last]<br />Content...<br />[/one_fifth_last]";	
		}
		

		
		// Mixed grid layouts
		
		// 3 column grid
		
		if (shortcodeId != 0 && shortcodeId == 'onethird_twothird' ){
		shortcodeText = "<br />[one_third]<br />Content...<br />[/one_third]<br /><br />[two_third_last]<br />Content...<br />[/two_third_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'twothird_onethird' ){
		shortcodeText = "<br />[two_third]<br />Content...<br />[/two_third]<br /><br />[one_third_last]<br />Content...<br />[/one_third_last]<br />";	
		}
		
		// 4 column grid
		if (shortcodeId != 0 && shortcodeId == 'onefourth_onefourth_half' ){
		shortcodeText = "<br />[one_fourth]<br />Content...<br />[/one_fourth]<br /><br />[one_fourth]<br />Content...<br />[/one_fourth]<br /><br />[one_half_last]<br />Content...<br />[/half_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'onefourth_half_onefourth' ){
		shortcodeText = "<br />[one_fourth]<br />Content...<br />[/one_fourth]<br /><br />[one_half]<br />Content...<br />[/one_half]<br /><br />[one_fourth_last]<br />Content...<br />[/one_fourth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'half_onefourth_onefourth' ){
			shortcodeText = "<br />[one_half]<br />Content...<br />[/half]<br /><br />[one_fourth]<br />Content...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />Content...<br />[/one_fourth_last]<br />";	
		}
		
		
		if (shortcodeId != 0 && shortcodeId == 'threefourth_onefourth' ){
			shortcodeText = "<br />[three_fourth]<br />Content...<br />[/three_fourth]<br /><br />[one_fourth_last]<br />Content...<br />[/one_fourth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'onefourth_threefourth' ){
			shortcodeText = "<br />[one_fourth]<br />Content...<br />[/one_fourth]<br /><br />[three_fourth_last]<br />Content...<br />[/three_fourth_last]<br />";	
		}
		
		// 5 columns grids
		
		if (shortcodeId != 0 && shortcodeId == 'twofifth_threefifth' ){
			shortcodeText = "<br />[two_fifth]<br />Content...<br />[/two_fifth]<br /><br />[three_fifth_last]<br />Content...<br />[/three_fifth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'threefifth_twofifth' ){
			shortcodeText = "<br />[three_fifth]<br />Content...<br />[/three_fifth]<br /><br />[two_fifth_last]<br />Content...<br />[/two_fifth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'onefifth_onefifth_onefifth_twofifth' ){
			shortcodeText = "<br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[two_fifth_last]<br />Content...<br />[/two_fifth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'onefifth_onefifth_twofifth_onefifth' ){
			shortcodeText = "<br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[two_fifth]<br />Content...<br />[/two_fifth]<br /><br />[one_fifth_last]<br />Content...<br />[/one_fifth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'onefifth_twofifth_onefifth_onefifth' ){
			shortcodeText = "<br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[two_fifth]<br />Content...<br />[/two_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth_last]<br />Content...<br />[/one_fifth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'twofifth_onefifth_onefifth_onefifth' ){
			shortcodeText = "<br />[two_fifth]<br />Content...<br />[/two_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth_last]<br />Content...<br />[/one_fifth_last]<br />";	
		}
		
		
		if (shortcodeId != 0 && shortcodeId == 'onefifth_twofifth_twofifth' ){
			shortcodeText = "<br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[two_fifth]<br />Content...<br />[/two_fifth]<br /><br />[two_fifth_last]<br />Content...<br />[/two_fifth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'twofifth_onefifth_twofifth' ){
			shortcodeText = "<br />[two_fifth]<br />Content...<br />[/two_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[two_fifth_last]<br />Content...<br />[/two_fifth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'twofifth_twofifth_onefifth' ){
			shortcodeText = "<br />[two_fifth]<br />Content...<br />[/two_fifth]<br /><br />[two_fifth]<br />Content...<br />[/two_fifth]<br /><br />[one_fifth_last]<br />Content...<br />[/one_fifth_last]<br />";	
		}
		
		
		if (shortcodeId != 0 && shortcodeId == 'onefifth_onefifth_threefifth' ){
			shortcodeText = "<br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[three_fifth_last]<br />Content...<br />[/three_fifth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'onefifth_threefifth_onefifth' ){
			shortcodeText = "<br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[three_fifth]<br />Content...<br />[/three_fifth]<br /><br />[one_fifth_last]<br />Content...<br />[/one_fifth_last]<br />";	
		}
		
		if (shortcodeId != 0 && shortcodeId == 'threefifth_onefifth_onefifth' ){
			shortcodeText = "<br />[three_fifth]<br />Content...<br />[/three_fifth]<br /><br />[one_fifth]<br />Content...<br />[/one_fifth]<br /><br />[one_fifth_last]<br />Content...<br />[/one_fifth_last]<br />";	
		}
	
	
			if ( shortcodeId == 0 ){
			tinyMCEPopup.close();
		}
	
	
	
	if(window.tinyMCE) {
	
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		window.tinyMCE.execInstanceCommand('epic_page_content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	
	return;
	
	

}
	
		
	


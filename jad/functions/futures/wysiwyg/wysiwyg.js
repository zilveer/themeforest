function embedshortcode() {

	var shortcodetext;
	var style = document.getElementById('shortcode_panel');

	if (style.className.indexOf('current') != -1) {
		var selected_shortcode = document.getElementById('style_shortcode').value;

		/* ----- CUFONS ----- */
		if (selected_shortcode == 'h1-cufon'){
			shortcodetext = "[h1-cufon class='bg-none']Title text goes here[/h1-cufon]";
		}

		if (selected_shortcode == 'h2-cufon'){
			shortcodetext = "[h2-cufon class='bg-none']Title text goes here[/h2-cufon]";
		}

		if (selected_shortcode == 'h3-cufon'){
			shortcodetext = "[h3-cufon class='bg-none']Title text goes here[/h3-cufon]";
		}

		if (selected_shortcode == 'h4-cufon'){
			shortcodetext = "[h4-cufon class='bg-none']Title text goes here[/h4-cufon]";
		}

		if (selected_shortcode == 'h5-cufon'){
			shortcodetext = "[h5-cufon class='bg-none']Title text goes here[/h5-cufon]";
		}

		if (selected_shortcode == 'h6-cufon'){
			shortcodetext = "[h6-cufon class='bg-none']Title text goes here[/h6-cufon]";
		}

		if (selected_shortcode == 'h1-cufon2'){
			shortcodetext = "[h1-cufon]Title text goes here[/h1-cufon]";
		}

		if (selected_shortcode == 'h2-cufon2'){
			shortcodetext = "[h2-cufon]Title text goes here[/h2-cufon]";
		}

		if (selected_shortcode == 'h3-cufon2'){
			shortcodetext = "[h3-cufon]Title text goes here[/h3-cufon]";
		}

		if (selected_shortcode == 'h4-cufon2'){
			shortcodetext = "[h4-cufon]Title text goes here[/h4-cufon]";
		}

		if (selected_shortcode == 'h5-cufon2'){
			shortcodetext = "[h5-cufon]Title text goes here[/h5-cufon]";
		}

		if (selected_shortcode == 'h6-cufon2'){
			shortcodetext = "[h6-cufon]Title text goes here[/h6-cufon]";
		}


		/* ----- Block Quotes ----- */
		if (selected_shortcode == 'block-quote-left'){
			shortcodetext = "[quote-left]<br />Block Quote text goes here<br />[/quote-left]";
		}

		if (selected_shortcode == 'block-quote-right'){
			shortcodetext = "[quote-right]<br />Block Quote text goes here<br />[/quote-right]";
		}

		if (selected_shortcode == 'testimonials'){
			shortcodetext = "[testimonials name='Name']<br />Testimonials text goes here<br />[/testimonials]";
		}


		/* ----- HIGHLIGHTS ----- */
		if (selected_shortcode == 'hl-theme'){
			shortcodetext = "[hl-theme]highlighted text goes here[/hl-theme]";
		}

		if (selected_shortcode == 'hl-red'){
			shortcodetext = "[hl-red]highlighted text goes here[/hl-red]";
		}

		if (selected_shortcode == 'hl-blue'){
			shortcodetext = "[hl-blue]highlighted text goes here[/hl-blue]";
		}

		if (selected_shortcode == 'hl-green'){
			shortcodetext = "[hl-green]highlighted text goes here[/hl-green]";
		}

		if (selected_shortcode == 'hl-grey'){
			shortcodetext = "[hl-grey]highlighted text goes here[/hl-grey]";
		}

		if (selected_shortcode == 'hl-black'){
			shortcodetext = "[hl-black]highlighted text goes here[/hl-black]";
		}

		if (selected_shortcode == 'hl-orange'){
			shortcodetext = "[hl-orange]highlighted text goes here[/hl-orange]";
		}

		if (selected_shortcode == 'clear'){
			shortcodetext = "[clear]";
		}

		if (selected_shortcode == 'tabs'){
			shortcodetext = "[tabs tab1='Tab 1 title' tab2='Tab 2 title' tab3='Tab 3 title']<br/>[tab]Insert tab 1 content here[/tab]<br/>[tab]Insert tab 2 content here[/tab]<br/>[tab]Insert tab 3 content here[/tab]<br/>[/tabs]";
		}

		if (selected_shortcode == 'accordion'){
			shortcodetext = "[accordion]<br/><br/>[section title='Section 1 title']<br/>Insert section 1 content here<br/>[/section]<br/><br/>[section title='Section 2 title']<br/>Insert section 2 content here<br/>[/section]<br/><br/>[section title='Section 3 title']<br/>Insert section 3 content here<br/>[/section]<br/><br/>[/accordion]";
		}


		/* ----- COLUMNS ----- */
		if (selected_shortcode == 'two_columns'){
			shortcodetext = "[one_half]<br />Content goes here...<br />[/one_half]<br /><br />[one_half_last]<br />Content goes here...<br />[/one_half_last]";
		}

		if (selected_shortcode == 'three_columns'){
			shortcodetext = "[one_third]<br />Content goes here...<br />[/one_third]<br /><br />[one_third]<br />Content goes here...<br />[/one_third]<br /><br />[one_third_last]<br />Content goes here...<br />[/one_third_last]";
		}

		if (selected_shortcode == 'four_columns'){
			shortcodetext = "[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[one_fourth_last]<br />Content goes here...<br />[/one_fourth_last]";
		}

		if (selected_shortcode == 'five_columns'){
			shortcodetext = "[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth]<br />Content goes here...<br />[/one_fifth]<br /><br />[one_fifth_last]<br />Content goes here...<br />[/one_fifth_last]";
		}

		if (selected_shortcode == 'six_columns'){
			shortcodetext = "[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth]<br />Content goes here...<br />[/one_sixth]<br /><br />[one_sixth_last]<br />Content goes here...<br />[/one_sixth_last]";
		}

		if (selected_shortcode == '1/4+3/4'){
			shortcodetext = "[one_fourth]<br />Content goes here...<br />[/one_fourth]<br /><br />[three_fourth_last]<br />Content goes here...<br />[/three_fourth_last]";
		}

		if (selected_shortcode == '3/4+1/4'){
			shortcodetext = "[three_fourth]<br />Content goes here...<br />[/three_fourth]<br /><br />[one_fourth_last]<br />Content goes here...<br />[/one_fourth_last]";
		}

		if (selected_shortcode == '2/3+1/3'){
			shortcodetext = "[two_thirds]<br />Content goes here...<br />[/two_thirds]<br /><br />[one_third_last]<br />Content goes here...<br />[/one_third_last]";
		}

		if (selected_shortcode == '1/3+2/3'){
			shortcodetext = "[one_third]<br />Content goes here...<br />[/one_third]<br /><br />[two_thirds_last]<br />Content goes here...<br />[/two_thirds_last]";
		}


		/* ----- LISTS ----- */
		if (selected_shortcode == 'checkboxes-list'){
			shortcodetext = "[checkboxes-list]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[/checkboxes-list]";
		}

		if (selected_shortcode == 'cat-list'){
			shortcodetext = "[cat-list]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[/cat-list]";
		}

		if (selected_shortcode == 'comments-list'){
			shortcodetext = "[comments-list]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[/comments-list]";
		}

		if (selected_shortcode == 'stars-list'){
			shortcodetext = "[stars-list]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[/stars-list]";
		}

		if (selected_shortcode == 'arrows-list'){
			shortcodetext = "[arrows-list]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[/arrows-list]";
		}

		if (selected_shortcode == 'links-list'){
			shortcodetext = "[links-list]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[/links-list]";
		}

		if (selected_shortcode == 'stick-list'){
			shortcodetext = "[stick-list]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[/stick-list]";
		}

		if (selected_shortcode == 'recent-posts-list'){
			shortcodetext = "[recent-posts-list]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[li]List item goes here[/li]<br />[/recent-posts-list]";
		}


		/* ----- ALERT BOXES ----- */
		if (selected_shortcode == 'alert-info'){
			shortcodetext = "[alert-info]<br />Type here your message<br />[/alert-info]";
		}

		if (selected_shortcode == 'alert-success'){
			shortcodetext = "[alert-success]<br />Type here your message<br />[/alert-success]";
		}

		if (selected_shortcode == 'alert-alert'){
			shortcodetext = "[alert-alert]<br />Type here your message<br />[/alert-alert]";
		}

		if (selected_shortcode == 'alert-error'){
			shortcodetext = "[alert-error]<br />Type here your message<br />[/alert-error]";
		}

		if (selected_shortcode == 'alert-download'){
			shortcodetext = "[alert-download]<br />Type here your message<br />[/alert-download]";
		}


		/* ----- BUTTONS ----- */
		if (selected_shortcode == 'link-button'){
			shortcodetext = "[button text='Read more' url='#']";
		}

		if (selected_shortcode == 'link2-button'){
			shortcodetext = "[button text='More' url='#']";
		}

		if (selected_shortcode == 'custom-button'){
			shortcodetext = "[button text='Button text' url='#']";
		}


		/* ----- IMAGES ----- */
		if (selected_shortcode == 'ifull'){
			shortcodetext = "[img type='full' <br />src='type here url to image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'imed'){
			shortcodetext = "[img type='med' <br />src='type here url to image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'isquare'){
			shortcodetext = "[img type='square' <br />src='type here url to image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'ismall'){
			shortcodetext = "[img type='small' <br />src='type here url to image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'ithumb'){
			shortcodetext = "[img type='thumb' <br />src='type here url to image' <br />title='Custom title' <br />alt='Custom alt']";
		}


		/* ----- LIGHTBOX IMAGES ----- */
		if (selected_shortcode == 'full'){
			shortcodetext = "[image type='full' <br />url='type here url to full image' <br />src='type here url to full image or custom thumb image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'med'){
			shortcodetext = "[image type='med' <br />url='type here url to full image' <br />src='type here url to full image or custom thumb image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'square'){
			shortcodetext = "[image type='square' <br />url='type here url to full image' <br />src='type here url to full image or custom thumb image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'small'){
			shortcodetext = "[image type='small' <br />url='type here url to full image' <br />src='type here url to full image or custom thumb image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'thumb'){
			shortcodetext = "[image type='thumb' <br />url='type here url to full image' <br />src='type here url to full image or custom thumb image' <br />title='Custom title' <br />alt='Custom alt']";
		}


		/* ----- LIGHTBOX VIDEO ----- */
		if (selected_shortcode == 'fullv'){
			shortcodetext = "[image type='full' <br />url='type here url to embed video (ex. http://player.vimeo.com/video/13526349 or http://www.youtube.com/v/lhEN6E2CCA8?version=3' <br />src='type here url to full image or custom thumb image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'medv'){
			shortcodetext = "[image type='med' <br />url='type here url to embed video (ex. http://player.vimeo.com/video/13526349 or http://www.youtube.com/v/lhEN6E2CCA8?version=3' <br />src='type here url to full image or custom thumb image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'squarev'){
			shortcodetext = "[image type='square' <br />url='type here url to embed video (ex. http://player.vimeo.com/video/13526349 or http://www.youtube.com/v/lhEN6E2CCA8?version=3' <br />src='type here url to full image or custom thumb image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'smallv'){
			shortcodetext = "[image type='small' <br />url='type here url to embed video (ex. http://player.vimeo.com/video/13526349 or http://www.youtube.com/v/lhEN6E2CCA8?version=3' <br />src='type here url to full image or custom thumb image' <br />title='Custom title' <br />alt='Custom alt']";
		}

		if (selected_shortcode == 'thumbv'){
			shortcodetext = "[image type='thumb' <br />url='type here url to embed video (ex. http://player.vimeo.com/video/13526349 or http://www.youtube.com/v/lhEN6E2CCA8?version=3' <br />src='type here url to full image or custom thumb image' <br />title='Custom title' <br />alt='Custom alt']";
		}


		/* ----- MEDIA ----- */
		if (selected_shortcode == 'youtube'){
			shortcodetext = "[youtube id=\"paste here youtube video ID\"  width=\"100%\"  height=\"auto\"]";
		}

		if (selected_shortcode == 'vimeo'){
			shortcodetext = "[vimeo id=\"paste here vimeo video ID\"  width=\"100%\"  height=\"auto\"]";
		}


		/* ----- DIVIDERS ----- */
		if (selected_shortcode == 'hr'){
			shortcodetext = "[hr]<p><br /></p>";
		}

		if (selected_shortcode == 'hr2'){
			shortcodetext = "[hr class='divider-blank']<p><br /></p>";
		}

		/* ----- CONTACT FORM ----- */
		if (selected_shortcode == 'feedback-form'){
			shortcodetext = "[feedback-form]";
		}

		/* ----- LATEST FROM THE BLOG ----- */
		if (selected_shortcode == 'latest'){
			shortcodetext = "[latest_from_blog count='3' category='all']";
		}

		/* ----- White Box ----- */
		if (selected_shortcode == 'wb'){
			shortcodetext = "[white_box]<br />text goes here<br />[/white_box]";
		}


		if ( selected_shortcode == 0 ){
			tinyMCEPopup.close();
		}
	}

	if(window.tinyMCE) {
		var tmce_ver = window.tinyMCE.majorVersion;
		if (tmce_ver >= '4') {
			window.tinyMCE.execCommand('mceInsertContent', false, shortcodetext);
		} else {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodetext);
		}
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}

	return;
}
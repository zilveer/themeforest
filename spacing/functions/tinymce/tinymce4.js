function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function pshortcodessubmit(number) {
	
	var tagtext;	
	var pshortcodes = document.getElementById('pshortcodes' + number);	
	
	// who is active ?
	if (pshortcodes.className.indexOf('current_content') != -1) {
		var pshortcodes_id = document.getElementById("pshortcodes_tag" + number).value;
		if(number == 6) {
			iconbox_icon = pshortcodes_id;
			pshortcodes_id = "icon_box";
		}
		switch(pshortcodes_id)
{
	
case 0:
 	tinyMCEPopup.close();
  break;

case "button_light": case "button_light_grey": case "button_light_blue": case "button_blue": case "button_purple": case "button_yellow": case "button_orange": case "button_green": case "button_light_green": case "button_red": case "button_brown": case "big_button_light": case "big_button_light_grey": case "big_button_light_blue": case "big_button_blue": case "big_button_purple": case "big_button_yellow": case "big_button_orange": case "big_button_green": case "big_button_light_green": case "big_button_red": case "big_button_brown":
	tagtext = "["+ pshortcodes_id + " url=\"#\"]Button content[/" + pshortcodes_id + "]";
break;

case "toggle":
	tagtext = "["+ pshortcodes_id + " title=\"Toggle Title\"]Toggle content goes here.[/" + pshortcodes_id + "]";
break;

case "list_check": case "list_square": case "list_circle": case "list_ordered": case "list_checkgrey":
	tagtext = "["+ pshortcodes_id + "] [li]List Item 1[/li] [li]List Item 2[/li] [li]List Item 3[/li] [/" + pshortcodes_id + "]";
break;

case "content_box":
	tagtext = "["+ pshortcodes_id + " color=\"#000000\"] Content goes here. [/" + pshortcodes_id + "]";
break;

case "tabs":
	tagtext = "["+ pshortcodes_id + "] [tab title=\"Tab 1 Title\"] Tab 1 Content [/tab] [tab title=\"Tab 2 Title\"] Tab 2 Content [/tab] [tab title=\"Tab 3 Title\"] Tab 3 Content [/tab] [/" + pshortcodes_id + "]";
break;

case "icon_box":
	tagtext = "["+ pshortcodes_id + " icon=\"" + iconbox_icon + "\" title=\"Icon Box Title\"] Content goes here. [/" + pshortcodes_id + "]";
break;

case "highlight":
	tagtext = "["+ pshortcodes_id + " color=\"#fff\" bgcolor=\"#444\"] Highlighted content goes here. [/" + pshortcodes_id + "]";
break;

case "dropcap":
	tagtext = "["+ pshortcodes_id + " color=\"#444\"] A [/" + pshortcodes_id + "]";
break;

case "dropcap_circle":
	tagtext = "["+ pshortcodes_id + " color=\"#fff\" bgcolor=\"#444\"] A [/" + pshortcodes_id + "]";
break;

case "blockquote_with_author":
	tagtext = "["+ pshortcodes_id + " author=\"Quote Author\"] Quote goes here. [/" + pshortcodes_id + "]";
break;

case "image_left":case "image_right":case "image_centered":
	tagtext = "["+ pshortcodes_id + " src=\"img_src_here\"]";
break;

case "image_left_link":case "image_right_link":
	tagtext = "["+ pshortcodes_id + " href=\"url_here\" src=\"img_src_here\"]";
break;

case "image_left_caption":case "image_right_caption":
	tagtext = "["+ pshortcodes_id + " caption=\"Caption here\" href=\"url_here\" src=\"img_src_here\"]";
break;

case "youtube":
	tagtext = "["+ pshortcodes_id + " id=\"YW8p8JO2hQw\"]";
break;

case "vimeo":
	tagtext = "["+ pshortcodes_id + " id=\"6686768\"]";
break;

case "divider":case "divider_line":case "divider_top":
	tagtext = "["+ pshortcodes_id + "]";
break;

case "divider_title":
	tagtext = "[divider_title title=\"My section\"]";
break;


case "pb_three_cols":
	tagtext = "[one_third][pricing_box title=\"Box Title\" price=\"$99.99\" border_color=\"#f1f1f1\" color=\"#ccc\"][list_check][li]Feature 1[/li][li]Feature 2[/li][li]Feature 3[/li][/list_check][button_light url=\"#\"]Buy now[/button_light][/pricing_box][/one_third][one_third][pricing_box title=\"Box Title\" price=\"$99.99\" border_color=\"#f1f1f1\" color=\"#ccc\"][list_check][li]Feature 1[/li][li]Feature 2[/li][li]Feature 3[/li][/list_check][button_light url=\"#\"]Buy now[/button_light][/pricing_box][/one_third][one_third_last][pricing_box title=\"Box Title\" price=\"$99.99\" border_color=\"#f1f1f1\" color=\"#ccc\"][list_check][li]Feature 1[/li][li]Feature 2[/li][li]Feature 3[/li][/list_check][button_light url=\"#\"]Buy now[/button_light][/pricing_box][/one_third_last][divider]";
break;

case "pb_four_cols":
	tagtext = "[one_fourth][pricing_box title=\"Box Title\" price=\"$99.99\" border_color=\"#f1f1f1\" color=\"#ccc\"][list_check][li]Feature 1[/li][li]Feature 2[/li][li]Feature 3[/li][/list_check][button_light url=\"#\"]Buy now[/button_light][/pricing_box][/one_fourth][one_fourth][pricing_box title=\"Box Title\" price=\"$99.99\" border_color=\"#f1f1f1\" color=\"#ccc\"][list_check][li]Feature 1[/li][li]Feature 2[/li][li]Feature 3[/li][/list_check][button_light url=\"#\"]Buy now[/button_light][/pricing_box][/one_fourth][one_fourth][pricing_box title=\"Box Title\" price=\"$99.99\" border_color=\"#f1f1f1\" color=\"#ccc\"][list_check][li]Feature 1[/li][li]Feature 2[/li][li]Feature 3[/li][/list_check][button_light url=\"#\"]Buy now[/button_light][/pricing_box][/one_fourth][one_fourth_last][pricing_box title=\"Box Title\" price=\"$99.99\" border_color=\"#f1f1f1\" color=\"#ccc\"][list_check][li]Feature 1[/li][li]Feature 2[/li][li]Feature 3[/li][/list_check][button_light url=\"#\"]Buy now[/button_light][/pricing_box][/one_fourth_last][divider]";
break;

case "lightbox_gallery":
	tagtext = "["+ pshortcodes_id + "][lightbox_img_first src=\"img_url\" title=\"title\" rel=\"lightbox1\"][lightbox_img src=\"img_url\" title=\"title\" rel=\"lightbox1\"][lightbox_img src=\"img_url\" title=\"title\" rel=\"lightbox1\"][/" + pshortcodes_id + "]";
break;

case "testimonials_random":
	tagtext = "[testimonials nr=\"2\" order=\"random\"]";
break;

case "testimonials_custom":
	tagtext = "[testimonials nr=\"2\" order=\"custom\"]";
break;

default:
tagtext="["+pshortcodes_id + "]Your content here.[/" + pshortcodes_id + "]";
}
}

if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		//window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		
		tinyMCE.activeEditor.selection.setContent(tagtext);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
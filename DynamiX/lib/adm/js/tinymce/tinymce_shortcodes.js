
/* :: themeva tinymce shortcodes							      
---------------------------------------------*/

(function() {
"use strict";   
 
	tinymce.PluginManager.add( 'themeva_shortcodes', function( editor, url ) {
     
		editor.addButton( 'themeva_shortcodes', { 
			type : 'menubutton',
			icon: 'themeva_shortcodes',
			onclick : function(e) {},
			menu: [
				{text: 'Button', icon: 'themeva_button', onclick: function() {editor.insertContent('[button title="my button" type="linkbutton, droppanelbutton" color="grey-lite, green, green-lite, blue, blue-lite" align="aligncenter, alignleft or alignright" url="#" target="_self" el_class="medium-text, big-text or leave blank"]');}},
				{text: 'Font Icon', icon: 'themeva_fonticon', onclick: function() {editor.insertContent('[icon name="fa-compass" iconsize="small medium large x-large" iconcolor="" background="true" backgroundcolor="" ]');}},
				{text: 'Image Effect', icon: 'themeva_image_effect', onclick: function() {editor.insertContent('[imageeffect url="e.g. /wp-content/uploads/your-image.png" type="frame, blackwhite, reflection, shadowreflection, frameblackwhite or shadowblackwhite" width="300" height="300" align="alignleft, alignright or aligncenter" target="_self or _blank" lightbox="yes or leave blank" overlay_state="hover" alt="this is an image" videourl="#" ]');}},
				{text: 'Social Icons', icon: 'themeva_social_icons', onclick: function() {editor.insertContent('[socialwrap align="left"] \
								[socialicon name="fb" url="" ][/socialicon]\
								[socialicon name="linkedin" url="" ][/socialicon]\
								[socialicon name="twitter" url="" ][/socialicon]\
								[socialicon name="google" url="" ][/socialicon]\
								[socialicon name="rss" url="" ][/socialicon]\
								[socialicon name="youtube" url="" ][/socialicon]\
								[socialicon name="vimeo" url="" ][/socialicon]\
								[socialicon name="pinterest" url="" ][/socialicon]\
								[socialicon name="soundcloud" url="" ][/socialicon]\
								[socialicon name="instagram" url="" ][/socialicon]\
								[socialicon name="flickr" url="" ][/socialicon]\
								[socialicon name="email" url="" ][/socialicon]\
								[/socialwrap]');}},
				{text: 'Facebook Like', icon: 'themeva_facebook', onclick: function() {editor.insertContent('[vc_facebook type="standard,button_count,box_count"]');}},		
				{text: 'Tweet Me', icon: 'themeva_tweetme', onclick: function() {editor.insertContent('[vc_tweetmeme type="horizontal,vertical,none"]');}},	
				{text: 'Google +', icon: 'themeva_googleplus', onclick: function() {editor.insertContent('[vc_googleplus type="standard,small,medium,tall" annotation="inline,bubble,none"]');}},
				{text: 'Pinterest', icon: 'themeva_pinterest', onclick: function() {editor.insertContent('[vc_pinterest]');}},	
				{text: 'Dividers', icon: 'themeva_dividers', onclick: function() {editor.insertContent('[divider_line type="divider_line,divider_linetop,divider_blank,clear" line_type="dashed,dotted,solid,double"]');}},	
				{text: 'Quotes', icon: 'themeva_quotes', onclick: function() {editor.insertContent('[blockquote type="blockquote_quotes,blockquote_line" align="left,right"] Quote this text [/blockquote]');}},
				{text: 'List', icon: 'themeva_list', onclick: function() {editor.insertContent('[list style="arrow,bullet,check,cross" color="blue-lite"] \
								<ul>\
								<li>List Item</li>\
								<li>List Item</li>\
								<li>List Item</li>\
								</ul>\
								[/list]');}},	
				{text: 'Toggle ( Reveal )', icon: 'themeva_toggle', onclick: function() {editor.insertContent('[reveal title="Toggle title" open="false,true" color="grey-lite"] Toggle content goes here, click edit button. [/reveal]');}},
				{text: 'Tooltip', icon: 'themeva_tooltip', onclick: function() {editor.insertContent('[tooltip icon="yes" color="dark,light" tip="this is the tip! "] Hover over this for Toolip! [/tooltip]');}},	
				{text: 'Vimeo', icon: 'themeva_video', onclick: function() {editor.insertContent('[videoembed type="vimeo" ratio="sixteen_by_nine" url="http://vimeo.com/21294655" width="560" height="315" autoplay="yes" align="aligncenter" loop="yes"]');}},	
				{text: 'YouTube', icon: 'themeva_youtube', onclick: function() {editor.insertContent('[videoembed type="youtube" ratio="sixteen_by_nine" url="http://www.youtube.com/watch?v=njDi2PMh688" width="560" height="315" autoplay="yes" loop="yes"]');}}													
			]
		});
         
	});
        
})(jQuery);
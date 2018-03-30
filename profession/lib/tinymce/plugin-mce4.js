(function ()
{
	function createStyleElement(text)
	{
		var style       = document.createElement('style');
		style.type      = 'text/css';
		style.innerHTML = text;
		document.getElementsByTagName('head')[0].appendChild(style);
	}
	
	function addPopupMenuButton (url, title, id ) 
	{
		return {text: title, onclick: function(){
			tb_show(title, url + "/popup.php?type=" + id + "&width=" + 855);
		}};
	}
	
	function addImmediateMenuButton (ed, title, text ) 
	{
		return {text: title, onclick: function(){
            ed.insertContent(text);
		}};
	}

	tinymce.PluginManager.add( 'pxShortcodes', function( editor, url ) {
		//Create icon class
		createStyleElement('.mce-i-px-btn{ background-image: url('+url+'/images/icon.png) !important; }');
	
		var menus = [ 
		{text:"Shortcodes", menu:[
			addPopupMenuButton(url, "Row", "rows"),
			addPopupMenuButton(url, "Columns & Offsets", "columns"),

			addPopupMenuButton(url, "Toggle", "toggle"),
			

			addPopupMenuButton(url, "Tab Group", "tabgroup"),
			addPopupMenuButton(url, "Tab", "tab"),

			addPopupMenuButton(url, "Pie Chart", "piechart"),

			addPopupMenuButton(url, "Buttons", "button"),
			addPopupMenuButton(url, "Highlights", "highlight"),

			addPopupMenuButton(url, "Social Links Group", "socialgroup"),
			addPopupMenuButton(url, "Social Links", "sociallinks"),

			addPopupMenuButton(url, "Video - Youtube","youtube"),
			addPopupMenuButton(url, "Video - Vimeo","vimeo"),
			addPopupMenuButton(url, "Alert", "alert"),

			addPopupMenuButton(url, "Quotes", "pullquote"),
			addPopupMenuButton(url, "Testimonial", "testimonial")
		]}
		];//menus
	
		editor.addButton('px_button', {
			type: 'menubutton',
			icon: 'px-btn',
			menu: menus
		});//addButton
	});//plugin

})();
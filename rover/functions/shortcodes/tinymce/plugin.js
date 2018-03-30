(function($) {
"use strict";   

  //Shortcodes
  tinymce.PluginManager.add( 'zillaShortcodes', function( editor, url ) {


		editor.addCommand("zillaPopup", function ( a, params )
		{
			var popup = params.identifier;
			tb_show("Insert Zilla Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
		});

		editor.addButton( 'zilla_button', {
			type: 'splitbutton',
			icon: false,
			title:  'Zilla Shortcodes',
			onclick : function(e) {},
			menu: [
			{text: 'Accordions',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Accordions',identifier: 'accordions'})
			}},
			{text: 'Boxes',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Boxes',identifier: 'box'})
			}},
			{text: 'Buttons',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Buttons',identifier: 'button'})
			}},
			
			/** Blogs **/
			{text: 'Blog Slide',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Blog Slide',identifier: 'blog_slide'})
			}},

			{text: 'Br',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Br',identifier: 'br'})
			}},
			{text: 'Columns',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Columns',identifier: 'column'})
			}},
			{text: 'Gallery',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Gallery',identifier: 'gallery'})
			}},
			{text: 'Hr',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Hr',identifier: 'hr'})
			}},
			{text: 'Icon Box',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Icon Box',identifier: 'icon_box'})
			}},
			{text: 'Google map',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Google map',identifier: 'map'})
			}},

			/** Portfolios **/
			{
				text: 'Portfolios',
				menu: [
					{text: 'Portfolio',onclick:function(){
						editor.execCommand("zillaPopup", false, {title: 'Portfolio',identifier: 'portfolio'})
					}},
					{text: 'Portfolio Slide',onclick:function(){
						editor.execCommand("zillaPopup", false, {title: 'Portfolio Slide',identifier: 'portfolio_slide'})
					}}
				]
			}, // End Blogs Section

			{text: 'Product Slide',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Product Slide',identifier: 'product_slide'})
			}},

			{text: 'Price Tables',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Price Tables',identifier: 'price_tables'})
			}},
			{text: 'Slogan',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Slogan',identifier: 'slogan'})
			}},
			{text: 'Tabs',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Tabs',identifier: 'tabs'})
			}},
			{text: 'Toggles',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Toggles',identifier: 'toggles'})
			}},
			{text: 'Video',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Video',identifier: 'video'})
			}},
			{text: 'Youtube',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Youtube',identifier: 'youtube'})
			}},
			{text: 'Vimeo',onclick:function(){
				editor.execCommand("zillaPopup", false, {title: 'Vimeo',identifier: 'vimeo'})
			}}
			]		
	  });
 
  });
         
})(jQuery);
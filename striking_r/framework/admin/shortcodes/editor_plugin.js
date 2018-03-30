(function() {
	tinymce.create('tinymce.plugins.shortcodeGenerator', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			var g = this;
			g.url = url;
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('Shortcode_Generator', function() {
				ed.windowManager.open({
					id : 'wp-link',
					width : 480,
					height : "auto",
					wpDialog : true,
					title : ed.getLang('shortcode_generator.desc')
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});			

			ed.addShortcut('alt+shift+s', ed.getLang('shortcode_generator.desc'), 'Shortcode_Generator');

			if(tinymce.majorVersion >= 4){
				var menu = this.getMenu();
				ed.addButton( 'shortcodeGenerator', {
					type: 'menubutton',
					title: ed.getLang('shortcode_generator.desc'),
					icon: 'shortcodeGenerator',
					menu: menu
				});
			}
		},
		
		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl: function(n, cm) {
			var ed = cm.editor;
			if (n == "shortcodeGenerator") {
				var b = cm.createMenuButton('shortcodeGeneratorButton', {
					title : ed.getLang('shortcode_generator.desc'),
					cmd : 'Shortcode_Generator'
				});
				var a = this;
				var url = ajaxurl + '?action=theme-shortcode-menu';
				jQuery.getJSON(url, function (menu_data) {
					a._renderMenu(b,menu_data);
				});

				// Return the new menubutton instance
				return b;
			}

			return null;
		},
		
		getMenu: function(){
			var menu = [];
			var self = this;
			if (typeof shortcode_menu_data !== "undefined" && jQuery.isArray(shortcode_menu_data)) {
				jQuery.each(shortcode_menu_data, function(){
					menu.push(self.getMenuItem(this));
				});
			}
			return menu;

		},
		getMenuItem: function(item){
			var self = this;
			if(typeof(item.sub) !== 'undefined'){
				var sub = [];
				jQuery.each(item.sub, function() { 
					sub.push(self.getMenuItem(this));
				});
				return {text: item.text, menu: sub};
			} else {
				if(typeof(item.type) !== 'undefined' && item.type == 'separator'){
					//m.addSeparator();
				}else{
					return {text: item.text, "class": "mceShortcodeGeneratorMenuItem", onclick: function(event) {
						if ( typeof shortcodeMenu != 'undefined'){
							shortcodeMenu.menu.onclick(item,event);
						}
					}};
				}
			}
		},

		_renderMenu : function(b, lists){
			var a = this;
			b.onRenderMenu.add(function(c, m) {
				jQuery.each(lists, function() { 
					a._addMenuItem(m,this);
				});
			});
		},
		
		_addMenuItem : function(m,item){
			var a = this;
			if(typeof(item.sub) !== 'undefined'){
				var sub;
				sub = m.addMenu({title: item.text});
				
				jQuery.each(item.sub, function() { 
					a._addMenuItem(sub,this);
				});
			}else{
				if(typeof(item.type) !== 'undefined' && item.type == 'separator'){
					m.addSeparator();
				}else{
					m.add({title: item.text, "class": "mceShortcodeGeneratorMenuItem", onclick: function(event) {
						if ( typeof shortcodeMenu != 'undefined'){
							shortcodeMenu.menu.onclick(item,event);
						}
						//tinyMCE.activeEditor.execCommand('mceInsertContent', false, item.text);
					}});
				}
			}
		},
		
		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'Shortcode Generator',
				author : 'KaptinLin',
				authorurl : 'http://KaptinLin.com',
				infourl : '',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('shortcodeGenerator', tinymce.plugins.shortcodeGenerator);
})();
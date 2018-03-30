/**
 * @KingSize 2011
 * For the configuration load into the Tinymce@ShortCodes V 1.0
 **/
// concept takne from the : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins
// Thanks TinyMce developer forum

(function() {
	// Load plugin language pack
	tinymce.PluginManager.requireLangPack('kingsize_shortcode');
	
	tinymce.create('tinymce.plugins.kingsize_shortcode', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Registering the command by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('mcekingsize_shortcode', function() {
				ed.windowManager.open({
					file : url + '/tinymce_fnc_options.php',
					width : 510 + ed.getLang('kingsize_shortcode.delta_width', 0),
					height : 240 + ed.getLang('kingsize_shortcode.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Registering the  button
			ed.addButton('kingsize_shortcode', {
				title : 'Add Custom Shortcode',
				cmd : 'mcekingsize_shortcode',
				image : url + '/icon.gif'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('kingsize_shortcode', n.nodeName == 'IMG');
			});
		},

		/**
		 * Creates control instances based in the incoming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
					longname  : 'kingsize_shortcode',
					author 	  : 'kumar@webmedia',
					authorurl : 'http://www.kingsizetheme.com/',
					infourl   : 'http://www.kingsizetheme.com/',
					version   : "1.0"
			};
		}
	});

	// Registering the  plugin
	tinymce.PluginManager.add('kingsize_shortcode', tinymce.plugins.kingsize_shortcode);
})();
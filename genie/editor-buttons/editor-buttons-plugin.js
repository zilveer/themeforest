(function( $ ) {
	tinymce.create( 'tinymce.plugins.BoldThemes', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init: function( ed, url ) {

			ed.addButton( 'highlight', {
				title: ed.getLang( 'bt_theme.highlight'),
				cmd: 'highlight',
				image: url + '/images/highlight.png'
			});
			ed.addCommand( 'highlight', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				return_text = '[highlight]' + selected_text + '[/highlight]';
				ed.execCommand( 'mceInsertContent', false, return_text );
			});

			ed.addButton( 'drop_cap', {
				title: ed.getLang( 'bt_theme.drop_cap' ),
				cmd: 'drop_cap',
				image: url + '/images/drop_cap.png'
			});
			ed.addCommand( 'drop_cap', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				return_text = '[drop_cap type="1/2/3"]' + selected_text + '[/drop_cap]';
				ed.execCommand( 'mceInsertContent', false, return_text );
			});
		},
		addImmediate: function( ed, title, sc ) {
			ed.add({
				title: title,
				onclick: function() {
					tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, sc );
				}
			});
		},
		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo: function() {
			return {
				longname: 'BoldThemes Buttons',
				author: '',
				authorurl: '',
				infourl: '',
				version: '0.1'
			};
		}
	});
	// Register plugin
	tinymce.PluginManager.add( 'boldthemes', tinymce.plugins.BoldThemes );
})( jQuery );
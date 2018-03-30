(function () {
	// create button plugin
	tinymce.create("tinymce.plugins.mpcWizard", {
		init: function ( ed, url ) {
			ed.addCommand("shortcodesWindow", function(at, params) { // shortcodesWindow = mpcPopup
				// speficy type and width of the window
				var win_type = params.identifier;
				//alert(params.identifie);
				var win_width = 850;

				// open window for a specific type of shortcode
				tb_show("Insert Shortcode", url + "/window-content.php?type=" + win_type + "&width=" + win_width);
			});

			if (tinymce.majorVersion >= 4) {
				ed.addButton( 'shortcodesButton', {
					type: 'menubutton',
					title: 'Insert Shortcode',
					icon: 'mpc_add',
					menu: [
						{ text: 'Button', onclick: function() {
							tinyMCE.activeEditor.execCommand('shortcodesWindow', false, {
								title: 'Button',
								identifier: 'button'
							});
						} },
						{ text: 'Columns', onclick: function() {
							tinyMCE.activeEditor.execCommand('shortcodesWindow', false, {
								title: 'Columns',
								identifier: 'columns'
							});
						} },
						{ text: 'Contact Form', onclick: function() {
							tinyMCE.activeEditor.execCommand('shortcodesWindow', false, {
								title: 'Contact Form',
								identifier: 'contact_form'
							});
						} },
						{ text: 'Flex Slider', onclick: function() {
							tinyMCE.activeEditor.execCommand('shortcodesWindow', false, {
								title: 'Flex Slider',
								identifier: 'flexslider'
							});
						} },
						{ text: 'Google Maps', onclick: function() {
							tinyMCE.activeEditor.execCommand('shortcodesWindow', false, {
								title: 'Google Maps',
								identifier: 'google_maps'
							});
						} },
						{ text: 'Lists', onclick: function() {
							tinyMCE.activeEditor.execCommand('shortcodesWindow', false, {
								title: 'Lists',
								identifier: 'lists'
							});
						} },
						{ text: 'Toggle', onclick: function() {
							tinyMCE.activeEditor.execCommand('shortcodesWindow', false, {
								title: 'Toggle',
								identifier: 'toggle'
							});
						} },
						{ text: 'Tabbed Content', onclick: function() {
							tinyMCE.activeEditor.execCommand('shortcodesWindow', false, {
								title: 'Tabbed Content',
								identifier: 'tabs'
							});
						} },
						{ text: 'YouTube Video', onclick: function() {
							tinyMCE.activeEditor.execCommand('shortcodesWindow', false, {
								title: 'YouTube Video',
								identifier: 'youtube'
							});
						} },
						{ text: 'Vimeo Video', onclick: function() {
							tinyMCE.activeEditor.execCommand('shortcodesWindow', false, {
								title: 'Vimeo Video',
								identifier: 'vimeo'
							});
						} },
					]
				});
			}
		},
		createControl: function(button, e) {
			if(button == "shortcodesButton") {
				var th = this;

				// create and add the button
				button = e.createMenuButton("shortcodesButton", {
					title: "Insert Shortcode",
					image: "../wp-content/themes/agera/tinymce/images/add.png",
					icons: false
				});

				// setup menu drop down, for shortcode button
				button.onRenderMenu.add(function (fst, sec) {
					th.addWithPopup( sec, "Button", "button" );
					th.addWithPopup( sec, "Columns", "columns" );
					th.addWithPopup( sec, "Contact Form", "contact_form");
					th.addWithPopup( sec, "Flex Slider", "flexslider");
					th.addWithPopup( sec, "Google Maps", "google_maps");
					th.addWithPopup( sec, "Lists", "lists" );
					th.addWithPopup( sec, "Toggle", "toggle" );
					th.addWithPopup( sec, "Tabbed Content", "tabs" );
					th.addWithPopup( sec, "YouTube Video", "youtube" );
					th.addWithPopup( sec, "Vimeo Video", "vimeo" );
				});
				return button;
			}
			return null;
		},
		addWithPopup: function(obj, title, id) {
			obj.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("shortcodesWindow", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function(obj, title, src) {
			obj.add({
				title: title,
				onclick: function() {
					tinyMCE.activeEditor.execCommand("mceInsertContent", false, src)
				}
			})
		},
		getInfo: function() {
			return {
				longname: 'MPC Shortcode Wizard',
				author: 'MassivePixelCreation',
				authorurl: 'http://themeforest.net/user/mpc/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0"
			}
		}
	});

	// finally add mpcWizard plugin :)
	tinymce.PluginManager.add("mpcWizard", tinymce.plugins.mpcWizard);
})();
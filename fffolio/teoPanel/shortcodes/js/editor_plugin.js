(function(){
	tinymce.create('tinymce.plugins.etquicktags', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			ed.addButton('teo_addthis', {
				title : 'Addthis sharing code',
				image : url + '/../images/addthis.png',
				onclick : function() {
					CustomButtonClick('addthis');
				}
			});
			ed.addButton('teo_skills', {
				title : 'Add a list of skills',
				image : url + '/../images/skills.png',
				onclick : function() {
					CustomButtonClick('skills');
				}
			});
			ed.addButton('teo_slider', {
				title : 'Add a slider of images',
				image : url + '/../images/slider.png',
				onclick : function() {
					CustomButtonClick('slider');
				}
			});
			ed.addButton('teo_carousel', {
				title : 'Add a carousel of images',
				image : url + '/../images/carousel.png',
				onclick : function() {
					CustomButtonClick('carousel');
				}
			});
			ed.addButton('teo_service', {
				title : 'Add a service',
				image : url + '/../images/services.png',
				onclick : function() {
					CustomButtonClick('service');
				}
			});
			ed.addButton('teo_button', {
				title : 'Add a button',
				image : url + '/../images/button.png',
				onclick : function() {
					CustomButtonClick('button');
				}
			});
			ed.addButton('teo_box', {
				title : 'Add a box of content',
				image : url + '/../images/contentbox.png',
				onclick : function() {
					CustomButtonClick('box');
				}
			});
			ed.addButton('teo_social', {
				title : 'Add a list with social accounts',
				image : url + '/../images/social.png',
				onclick : function() {
					CustomButtonClick('social');
				}
			});
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
				longname : "TeoThemes Shortcodes",
				author : 'TeoThemes',
				authorurl : 'http://www.teothemes.com/',
				infourl : 'http://www.teothemes.com/',
				version : "1.0"
			};
		}
	});
	
	tinymce.PluginManager.add('teo_quicktags', tinymce.plugins.etquicktags);
})()
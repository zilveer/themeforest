

(function (){

	"use strict";

	tinymce.create("tinymce.plugins.aitShortcodesButton", {

		createControl: function(button, controlManager){

			if(button == "aitShortcodesButton"){
				var thisPlugin = this;

				var shortcodeButton = controlManager.createSplitButton('aitShortcodesButton', {
					title: "Insert Shortcode",
					image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAALGOfPtRkwAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAdTAAAOpgAAA6lwAAF2+XqZnUAAAB00lEQVR4nGI8d+5cPQMDQwMDeaABIIAYgAb8//37939SAUjP9u3b/wMEEAvIGBYWFgblbkYGdnYGBk4OIOaEYC4uBgZuNihmZWDgAGGgDjZmBoYq3f8MP3/+ZAAIIBaYW3i4UTVysSM0crFBNLIDMStQMzMTwg8AAQQ3gI8PohHkAritUI1gW4GYBaiRiZGB4f9/hAEAAQQ3gJ8fYisPUBMXKwSDnMwO1QiyFaiX4S9Q85+/CAMAAghugCDUv1xofmVGsvX3PwaGX0DNP5EMAAgguAECnBDNnaYQ93VdZWQo08Zkl59mZPj2G2EAQAAhwgDod3ZmhARyQP34g2B//MHA8PUXgg8QQHADQKHNAjSg9zojA8iuv0Dntl5mZPgJ1PwDaGPOUYjNX4Cav/1EGAAQQHADQP5lBPr1HyiQQH79A7EZhEE2wvB3oAu+fUMYABBAYAO+f//OUKKFFDdEgLdv34ITEkAAsbx7965hzZo1DX/+QDwqISHBoKyszKCmpoai4cSJEwz37t0DawIBkHomJqYGgABi/P8f0+bly5f///HjB4oYiJ+ZmcmIrhYggOAGMDIyAuOBgROK8YHvIAzUB7YBIIBAJgoiYVLAexAGCDAA8GvFJdApkYsAAAAASUVORK5CYII=',
					icons: false,
					onclick: function() {
						shortcodeButton.showMenu();
					}
				});

				var shortcodes = {};
				if(typeof AitShortcodesList !== 'undefined'){
					shortcodes = AitShortcodesList;
				}else{
					shortcodes['button'] = 'Button';
					shortcodes['lists'] = 'Lists';
					shortcodes['notification'] = 'Notification';
					shortcodes['raw'] = 'Raw';
					shortcodes['rule'] = 'Horizontal rule';
					shortcodes['modal-link'] = 'Modal Window Link';
					shortcodes['modal-content'] = 'Modal Window Content';
				}

				shortcodeButton.onRenderMenu.add(function (control, menu){

					tinymce.each(shortcodes, function(value, key){
						var shortcode = {};

						shortcode.title = value;

						if(key !== 'none'){
							shortcode.onclick = function(){
								ait.admin.shortcodes.storage.save({
									activeTab: "#ait-shortcode-" + key + "-panel",
									currentShortcode: key
								});

								if(typeof ait !== 'undefined' && ait.admin && ait.admin.shortcodes && ait.admin.shortcodes.Generator)
									ait.admin.shortcodes.Generator.open(key);


								return false;
							};
						}

						menu.add(shortcode);
					});
				});

                return shortcodeButton;
			}

			return null;
		},



		getInfo: function(){
			return {
				longname: 'AIT Shortcodes',
				author: 'AffinityThemes.com',
				authorurl: 'http://themeforest.net/user/ait/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0"
			};
		}
	});

	// add aitShortcodes plugin
	tinymce.PluginManager.add("aitShortcodesButton", tinymce.plugins.aitShortcodesButton);
})();

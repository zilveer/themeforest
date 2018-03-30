/* Adapted from http://brettterpstra.com/adding-a-tinymce-button/ */



(function() {

	tinymce.create('tinymce.plugins.cp_themeshortcode', {

		init : function(ed, url) {



			ed.addButton('layout_shortcode', {

				title : 'Add Columns',

				image : url+'/images/layout-shortcodes.png', 

				onclick : function() {

					ed.windowManager.open({

						file : url + '/shortcodes_popup.php?section=layouts',

						width : 520,

						height : 330,

                              title: 'Layouts',

						inline : 1	

					});

				}

			});



           ed.addButton('button-shortcodes', {

				title : 'Add Buttons ',

				image : url+'/images/button-shortcodes.png', 				

				onclick : function() {

					ed.windowManager.open({

						file : url + '/shortcodes_popup.php?section=buttons',

						width : 400,

						height : 390,

                              title: 'Buttons',

						inline : 1

					});

				}

			});

			

			ed.addButton('msgbox-shortcodes', {

				title : 'Add Message Box',

				image : url+'/images/msgbox.png', 

				onclick : function() {

					ed.windowManager.open({

						file : url + '/shortcodes_popup.php?section=msgbox',

						width : 469,

						height : 130,

                              title: 'Message Box',

						inline : 1

					});

				}

			});	

		    

			ed.addButton('testmo-shortcodes', {

				title : 'Add Testimonial',

				image : url+'/images/testimonial.png',

				onclick : function() {

					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[testimonial title="TESTIMONIAL TITLE WILL GO HERE"]');

					window.tinyMCE.activeEditor.execCommand('mceRepaint');

				    }

			});

		

		    ed.addButton('video-shortcodes', {

				title : 'Add Insert Video',

				image : url+'/images/video.png', 

				onclick : function() {

					ed.windowManager.open({

						file : url + '/shortcodes_popup.php?section=video-shortcodes',

						width : 320,

						height : 50,

                              title: 'Insert Videos',

						inline : 1

					});

				}

			});	

		

		  	ed.addButton('quote-shortcode', {

				title : 'Add Quotes',

				image : url+'/images/icon-blockQuote.png', 

				onclick : function() {

					ed.windowManager.open({

						file : url + '/shortcodes_popup.php?section=blockQuote',

						width : 435,

						height : 50,

                              title: 'Quotes Styling',

						inline : 1

					});

				}

			});	

			

			ed.addButton('list-shortcodes', {

				title : 'Add Lists',

				image : url+'/images/icon-ul.png', 

				onclick : function() {

					ed.windowManager.open({

						file : url + '/shortcodes_popup.php?section=lists',

						width : 430,

						height : 135,

                              title: 'Lists Styling',

						inline : 1

					});

				}

			});	

			

			ed.addButton('dropcap-shortcodes', {

				title : 'Add Dropcaps',

				image : url+'/images/dropcap.png', 

				onclick : function() {

					ed.windowManager.open({

						file : url + '/shortcodes_popup.php?section=dropcap',

						width : 300,

						height : 50,

                              title: 'Dropcap',

						inline : 1

					});

				}

			});	



			ed.addButton('divider-shortcodes', {

				title : 'Add Divider',

				image : url+'/images/icon-hr.png',

				onclick : function() {

					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[divider scroll_text="SCROLL TEXT"]');

					window.tinyMCE.activeEditor.execCommand('mceRepaint');

				    }

			});
			
			ed.addButton('price-shortcodes', {

				title : 'Add Price Table',

				image : url+'/images/price-item.png',

				onclick : function() {

					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[price-item item_number="6" category="PRICE TABLE CATEGORY"]');

					window.tinyMCE.activeEditor.execCommand('mceRepaint');

				    }

			});

			ed.addButton('space-shortcodes', {

				title : 'Add Space',

				image : url+'/images/space.png',

				onclick : function() {

					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[space height="HEIGHT"]');

					window.tinyMCE.activeEditor.execCommand('mceRepaint');

				    }

			});

			ed.addButton('audio-shortcodes', {

				title : 'Add Mp3 Player',

				image : url+'/images/audio.png',

				onclick : function() {

					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[audio:INSERT YOUR MP3 AUDIO FILE LINK HERE]');

					window.tinyMCE.activeEditor.execCommand('mceRepaint');

				    }

			   });

			

			ed.addButton('lightbox-shortcodes', {

				title : 'Add Lightbox Image',

				image : url+'/images/lightbox.png',

				onclick : function() {

					window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[frame src="INSERT YOUR PHOTO URL HERE" width="290" height="200" 		lightbox="on" ]');

					window.tinyMCE.activeEditor.execCommand('mceRepaint');

				    }

				});

						

			ed.addButton('tab-shortcodes', {

					title : 'Add Tabs',

					image : url+'/images/tab-shortcodes.png',

					onclick : function() {

						window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[tab]<br>[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item]<br>[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item]<br>[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item]<br>[/tab]<br /> <br /> ');

						window.tinyMCE.activeEditor.execCommand('mceRepaint');

	 			 		}

				   });





			ed.addButton('accordion-shortcodes', {

					title : 'Add Accordions',

					image : url+'/images/accordion-shortcodes.png',

					onclick : function() {

						window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, '[accordion]<br>[acc_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/acc_item]<br>[acc_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/acc_item]<br>[acc_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/acc_item]<br>[/accordion]<br /><br /> ');

						window.tinyMCE.activeEditor.execCommand('mceRepaint');

	 					 }

			      });

		},

		

		createControl : function(n, cm) {

			return null;

		},

		getInfo : function() {

			return {

				longname : "Shortcodes",

				author : 'The Church Theme',

				version : "1.0"

			};

		}

	});

	tinymce.PluginManager.add('cp_themeshortcode', tinymce.plugins.cp_themeshortcode);

})();
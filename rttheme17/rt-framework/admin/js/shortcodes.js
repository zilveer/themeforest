/* Adapted from http://brettterpstra.com/adding-a-tinymce-button/ */

(function() {
	tinymce.create('tinymce.plugins.rt_theme_shortcodes', {
		init : function(ed, url) {

			ed.addButton('rt_themeshortcode', {
				title : 'RT-Theme Layouts',
				image : url+'/../images/layout-shortcodes.png', 
				onclick : function() {
					ed.windowManager.open({
						file : url + '/../pages/rt_shortcodes_popup.php?section=layouts',
						width : 540,
						height : 330,
                              title: 'RT-Theme Layouts',
						inline : 1	
					});
				}
			});

			ed.addButton('rt_themeshortcode_2', {
				title : 'RT-Theme Quick Styling',
				image : url+'/../images/styling-shortcodes.png', 
				onclick : function() {
					ed.windowManager.open({
						file : url + '/../pages/rt_shortcodes_popup.php?section=styling',
						width : 640,
						height : 320,
                              title: 'RT-Theme Quick Styling',
						inline : 1
					});
				}
			});			


			ed.addButton('rt_themeshortcode_4', {
				title : 'RT-Theme Buttons ',
				image : url+'/../images/button-shortcodes.png', 				
				onclick : function() {
					ed.windowManager.open({
						file : url + '/../pages/rt_shortcodes_popup.php?section=buttons',
						width : 570,
						height : 500,
                              title: 'RT-Theme Buttons',
						inline : 1
					});
				}
			});

			ed.addButton('rt_themeshortcode_5', {
				title : 'RT-Theme Contact Form Shortcode ',
				image : url+'/../images/mail-open.png',
				onclick : function() {

					wp.media.editor.insert('[contact_form title=\"Form Title\" email=\"youremail@yoursite.com\" text=\"Form description\"] '); 
 
					window.tinyMCE.activeEditor.execCommand('mceRepaint');
					
						jQuery(".rt-message-contact-form").remove();
						jQuery("#poststuff").prepend('<div class="rt-message-contact-form"></div>');

						jQuery(".rt-message-contact-form").hide(function() {
							jQuery(".rt-message-contact-form").html('<div class="updated"><div class="rt-message">X</div>'
											+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> '
											+ '	<hr class="rt-message-hr" /> Please Note: You can also use this shortcode with a text widget in sidebars.'
											+ '	<h4>Parameters of this shortcode</h4> '
											+ '	<ul>	'
											+ '	<li> <b>title:</b> Form title</li>	'
											+ '	<li> <b>email:</b> Write an email which you want to send the form</li>	'
											+ '	<li> <b>text:</b> The text before the form</li>	'											
											+ '	</ul></div>');						
						});
						jQuery(".rt-message-contact-form").fadeIn('slow');
				
				}
				
			});

			ed.addButton('rt_themeshortcode_6', {
				title : 'RT-Theme Slider Shortcode',
				image : url+'/../images/slider-shortcodes.png',
				onclick : function() {
					wp.media.editor.insert('[slider]<br />[slide image_width=\"650\" image_height=\"300\" link=\"your_link\" title="Heading" alt_text="check it out" auto_resize="true"]full url of your image[/slide] <br />[slide image_width=\"650\" image_height=\"300\" link="your_link\" title="Heading" alt_text="check it out" auto_resize="true"]full url of your image[/slide] <br />[/slider] <br /> <br /> ');
					window.tinyMCE.activeEditor.execCommand('mceRepaint');


						jQuery(".rt-message-contact-form").remove();
						jQuery("#poststuff").prepend('<div class="rt-message-contact-form"></div>');

						jQuery(".rt-message-contact-form").hide(function() {
							jQuery(".rt-message-contact-form").html('<div class="updated"><div class="rt-message">X</div>'
									+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> '
									+ '	<hr class="rt-message-hr" /> You can enter unlimited [slide ]..[/slide] line to add new items to your gallery. Do not leave space between the brackets for correct image url\'s'
									+ '	<h4>Parameters of this shortcode</h4> '
									+ '	<ul>	'
									+ '	<li> <b>image_width:</b> Image width</li>	'
									+ '	<li> <b>image_height:</b> Image height</li>	'
									+ '	<li> <b>auto_resize:</b> If it\'s "true" a new image will be created automatically. Default is "true", set "false" if you want to use your orginal image.</li>	'
									+ '	<li> <b>link:</b> Write the link for the slide or leave blank.</li>	'
									+ '	<li> <b>alt_text:</b> Adds descriptions.</li>	'
									+ '	<li> <b>title:</b> Adds headings.</li>	'
									+ '	</ul></div>');						
						});
						jQuery(".rt-message-contact-form").fadeIn('slow'); 
				}
			});

			ed.addButton('rt_themeshortcode_7', {
				title : 'RT-Theme Photo Gallery Shortcode',
				image : url+'/../images/photo-gallery-shortcodes.png',
				onclick : function() {
					wp.media.editor.insert('			[photo_gallery] <br />[image thumb_width="135" thumb_height="135" lightbox="true" custom_link="" title="sample image" caption=""] full url of your image [/image] <br />[image thumb_width="135" thumb_height="135" lightbox="true" custom_link="" title="sample image" caption=""] full url of your image [/image] <br />[image thumb_width="135" thumb_height="135" lightbox="true" custom_link="" title="sample image" caption=""] full url of your image [/image] <br />[/photo_gallery] <br /> <br /> ');
					window.tinyMCE.activeEditor.execCommand('mceRepaint');

						jQuery(".rt-message-contact-form").remove();
						jQuery("#poststuff").prepend('<div class="rt-message-contact-form"></div>');

						jQuery(".rt-message-contact-form").hide(function() {
							jQuery(".rt-message-contact-form").html('<div class="updated"><div class="rt-message">X</div>'
									+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> '
									+ '	<hr class="rt-message-hr" /> You can enter unlimited [image ]..[/image] line to add new items to your gallery.'
									+ '	<h4>Parameters of this shortcode</h4> '
									+ '	<ul>	'
									+ '	<li> <b>thumb_width:</b> thumbnail width</li>	'
									+ '	<li> <b>thumb_height:</b> thumbnail height</li>	'
									+ '	<li> <b>lightbox:</b> opens the big image in a lightbox</li>	'
									+ '	<li> <b>custom_link:</b> you can define another link different then the big version of the thumbnail.</li>	'
									+ '	<li> <b>caption:</b> caption text for the item.</li>	'
									+ '	<li> <b>title:</b> title text.</li>	'
									+ '	<li> <b>open_in_new_tab:</b> (true/false) set true to open the link in a new tab.</li>	'									
									+ '	</ul></div>');						
						});
						jQuery(".rt-message-contact-form").fadeIn('slow'); 
				}
			});

			ed.addButton('rt_themeshortcode_8', {
				title : 'RT-Theme Auto Thumbnail and Lightbox Shortcode',
				image : url+'/../images/thumbnail-shortcodes.png',
				onclick : function() {
					wp.media.editor.insert('			[auto_thumb width="150" height="150" link="" lightbox="true" align="left" title="" alt="" iframe="false" frame="true" crop="true"] full url of your image [/auto_thumb] <br /> <br /> ');
					window.tinyMCE.activeEditor.execCommand('mceRepaint');

						jQuery(".rt-message-contact-form").remove();
						jQuery("#poststuff").prepend('<div class="rt-message-contact-form"></div>');

						jQuery(".rt-message-contact-form").hide(function() {
							jQuery(".rt-message-contact-form").html('<div class="updated"><div class="rt-message">X</div>'
									+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> '
									+ '	<hr class="rt-message-hr" /> '
									+ '	<h4>Parameters of this shortcode</h4> '
									+ '	<ul>	'
									+ '	<li> <b>link:</b> you can enter custom url. If you leave blank it will be linked to the bigger version of the image. </li>	'
									+ '	<li> <b>width:</b> thumbnail width</li>	'
									+ '	<li> <b>height:</b> thumbnail height</li>	'
									+ '	<li> <b>lightbox:</b> (true/false) default is true, enter no to disable lightbox feature</li>	'
									+ '	<li> <b>title:</b> link title text.</li>	'
									+ '	<li> <b>align:</b> (left/right/center) default is left, image alignment</li>	'
									+ '	<li> <b>alt:</b> alt tag for image</li>	'
									+ '	<li> <b>iframe:</b> (true/false) default is false. Use this paramater if you want to open a page or an external url in a lightbox.</li>	'
									+ '	<li> <b>frame:</b> (true/false) default is true.  Use this paramater if you want to add a frame to the thubmnail.</li>	'
									+ '	<li> <b>crop:</b> (true/false) default is true. Crops images with the width and height values that you defined.</li>	'
									+ '	</ul></div>');						
						});
						jQuery(".rt-message-contact-form").fadeIn('slow');
						 
				}
			});
 
 
			ed.addButton('rt_themeshortcode_9', {
					title : 'RT-Theme Scroll Slider Shortcode',
					image : url+'/../images/scroll_slider.png',
					onclick : function() {
						wp.media.editor.insert('			[scroll_slider]<br />[scroll_image] full url of your image [/scroll_image] <br />[scroll_image] full url of your image [/scroll_image] <br />[scroll_image] full url of your image [/scroll_image] <br />[/scroll_slider] <br /> <br /> ');
						window.tinyMCE.activeEditor.execCommand('mceRepaint');
	
							jQuery(".rt-message-contact-form").remove();
							jQuery("#poststuff").prepend('<div class="rt-message-contact-form"></div>');
	
							jQuery(".rt-message-contact-form").hide(function() {
								jQuery(".rt-message-contact-form").html('<div class="updated"><div class="rt-message">X</div>'
										+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> ' 
										+ '	<hr class="rt-message-hr" /> '
										+ '	<p>Paste image urls in the [scroll_image][/scroll_image] breckets which has been uploaded by the media uploader before. i.e., your images must be local for the site. '
										+ '	</p></div>');											
							});
							jQuery(".rt-message-contact-form").fadeIn('slow');
							 
					}
				});
 
			ed.addButton('rt_themeshortcode_10', {
					title : 'RT-Theme Tabs Shortcode',
					image : url+'/../images/tab-shortcodes.png',
					onclick : function() {
						wp.media.editor.insert('			[tabs tab1="Tab 1" tab2="Tab 2" tab3="Tab 3"]<br />[tab]Tab 1 Content [/tab]<br />[tab]Tab 2 Content[/tab]<br />[tab]Tab 3 Content [/tab]<br />[/tabs]<br /> <br /> ');
						window.tinyMCE.activeEditor.execCommand('mceRepaint');
	
							jQuery(".rt-message-contact-form").remove();
							jQuery("#poststuff").prepend('<div class="rt-message-contact-form"></div>');
	
							jQuery(".rt-message-contact-form").hide(function() {
								jQuery(".rt-message-contact-form").html('<div class="updated"><div class="rt-message">X</div>'
										+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> ' 
										+ '	<hr class="rt-message-hr" /> '
										+ '	<p>Put tab contents into the [tab][/tab] breckets. For the tab titles use the first bracket parameters like  [tabs tab1="Tab 1" tab2="Tab 2" tab3="Tab 3"] . There is no tab limit, you can add tabs till the fit your page.'
										+ '	</p></div>');											
							});
							jQuery(".rt-message-contact-form").fadeIn('slow');
							 
					}
				});




			ed.addButton('rt_themeshortcode_11', {
					title : 'RT-Theme Accordion Shortcode',
					image : url+'/../images/accordion-shortcodes.png',
					onclick : function() {
						wp.media.editor.insert('[accordion align="" numbers="false" first_one_open="false"]<br />[pane title="Accordion Pane 1"] content [/pane] <br />[pane title="Accordion Pane 2"] content [/pane] <br />[pane title="Accordion Pane 3"] content [/pane] <br />[/accordion]<br /><br /> ');
						window.tinyMCE.activeEditor.execCommand('mceRepaint');
	
							jQuery(".rt-message-contact-form").remove();
							jQuery("#poststuff").prepend('<div class="rt-message-contact-form"></div>');
	
							jQuery(".rt-message-contact-form").hide(function() {
								jQuery(".rt-message-contact-form").html('<div class="updated"><div class="rt-message">X</div>'
										+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> ' 
										+ '	<hr class="rt-message-hr" /> '
										+ '	<p>Put contents into the [pane title="Pane Title"][/pane] breckets.'
										+ '	</p>' 
										+ '	<h4>Parameters of this shortcode</h4> ' 
										+ '	<ul>	'
										+ '	<li> <b>numbers:</b> (true/false) If you would like to have numbered accordion content you can set the numbers value as true. '
										+ '	<li> <b>first_one_open:</b>(true/false) Set this value "true" to have first accordion item open while page loaded.</li>	'
										+ '	<li> <b>align:</b>  In order to have left or right aligned accordions you can use "align" parameter. Example: [accordion align="left"]...[/accordion] or [accordion align="right"][/accordion]</li>	'
										+ '	</ul></div>');
														
							});
							jQuery(".rt-message-contact-form").fadeIn('slow');
							 
					}
				});

			ed.addButton('rt_themeshortcode_12', {
					title : 'RT-Theme Tool Tip Shortcode',
					image : url+'/../images/tool_tip.png',
					onclick : function() {
						wp.media.editor.insert('[tooltip text="Tooltip Text" link="" target="" color="black"]content[/tooltip]<br /><br /> ');
						window.tinyMCE.activeEditor.execCommand('mceRepaint');
	
							jQuery(".rt-message-contact-form").remove();
							jQuery("#poststuff").prepend('<div class="rt-message-contact-form"></div>');
	
							jQuery(".rt-message-contact-form").hide(function() {
								jQuery(".rt-message-contact-form").html('<div class="updated"><div class="rt-message">X</div>'
										+ '	<h2 class="rt-message-h2">Shortcode Tips</h2> ' 
										+ '	<hr class="rt-message-hr" /> '

										+ '	<h4>Parameters of this shortcode</h4> '
										+ '	<p>Put contents into the [tooltip][/tooltip] breckets.'
										+ '	</p>'
										
										+ '	<ul>	'
										+ '	<li> <b>text:</b> the text you want to show in the tooltip. </li>	'
										+ '	<li> <b>color:</b> (white/black) '
										+ '	<li> <b>link:</b> If you want to link the content, use this parameter.</li>	'
										+ '	<li> <b>target:</b> target of the link .	ex: _blank, _parent, _self, _top </li>	'										
										+ '	</ul></div>');								
							});
							jQuery(".rt-message-contact-form").fadeIn('slow');
							 
					}
				});

			ed.addButton('rt_themeshortcode_13', {
					title : 'RT-Theme Product Shortcode',
					image : url+'/../images/product-shortcode.png',
					onclick : function() {
						wp.media.editor.insert('[product_showcase categories="" ids="" columns="4" limit="12" desc="true" orderby="date" order="DESC"]<br /><br /> ');
						window.tinyMCE.activeEditor.execCommand('mceRepaint');
	
							jQuery(".rt-message-contact-form").remove();
							jQuery("#poststuff").prepend('<div class="rt-message-contact-form"></div>');
	
							jQuery(".rt-message-contact-form").hide(function() {
								jQuery(".rt-message-contact-form").html('<div class="updated"><div class="rt-message">X</div>'
									 
										+ '	<h2 class="rt-message-h2">Shortcode Tips: Product Shortcode</h2> ' 
										+ '	<hr class="rt-message-hr" /> '
										+ '	<h4>Parameters of this shortcode</h4> '									 								
										+ '	<ul>	'
										+ '	<li> <b>categories:</b> <br /> - Display products by category slugs. <br /> - Multiple values must be seperated by commas like categories="catgory-slug-1, catgory-slug-2"  <br />- You can find product category slugs on <a href="edit-tags.php?taxonomy=product_categories&post_type=products">product categories page</a> </li>	'
										+ '	<li> <b>ids:</b> <br />- Display products by product id\'s. <br />- Multiple values must be seperated by commas like ids="75,77,123"  <br />- You can find id values of products in "Product ID" column on <a href="edit.php?post_type=products">products</a> page. <br />- If ids value provided the categories value will be ignored.</li>	'
										+ '	<li> <b>columns:</b> <br />- Default value = 4<br />- Available column layouts 2, 3, 4, 5 </li>'																
										+ '	</ul>'
										+ '	<ul>	'
										+ '	<li> <b>limit:</b> Maxiumum products number to display</li>	'
										+ '	<li> <b>desc:</b> (true/false) displays the short description of the products </li>	'										

										+ '	<li> <b>orderby:</b> Sort the products by this parameter  <br /> Default value: Date  <br/> Possible values: author, date, title, modified, ID, rand<br /></li>	'
										+ '	<li> <b>order:</b> Designates the ascending or descending order of the ORDERBY parameter<br/> Possible values: ASC, DESC<br /> </li>	'		

										+ '	</ul></div>');		

 	



							});
							jQuery(".rt-message-contact-form").fadeIn('slow');
							 
					}
				});	
			
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Shortcodes",
				author : 'RT-Theme',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('rt_themeshortcode', tinymce.plugins.rt_theme_shortcodes);
})();
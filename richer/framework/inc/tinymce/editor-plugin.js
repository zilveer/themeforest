(function(){
	// Get the URL to this script file (as JavaScript is loaded in order)
	// (http://stackoverflow.com/questions/2255689/how-to-get-the-file-path-of-the-currenctly-executing-javascript-code)

	var scripts = document.getElementById( "tinymce-shortcodes-css"),
	src = scripts.getAttribute('href');

	var framework_url = src.split( '/framework/' ),
		icon_url = framework_url[0] + '/framework/inc/tinymce/images/icon_shortcodes.png';	

	tinymce.create(
		"tinymce.plugins.RicherTinyMCEShortcodes",
		{
			init: function(d,e) {
					var nonce = '';
					if ( nonce == '' ) {
						jQuery.post( ajaxurl, { 'action' : 'richer_shortcodes_nonce' }, function ( response ) {
							nonce = response;
						});
					}

					d.addCommand( "myThemeOpenDialog",function(a,c){

						// Grab the selected text from the content editor.
						selectedText = '';

						if ( d.selection.getContent().length > 0 ) {

							selectedText = d.selection.getContent();

						} // End IF Statement

						richerSelectedShortcodeType = c.identifier;
						richerSelectedShortcodeTitle = c.title;

						// jQuery.get(e+"/dialog.php",function(b){

							jQuery('#shortcode-options').addClass( 'shortcode-' + richerSelectedShortcodeType );
							jQuery( '#selected-shortcode' ).val( richerSelectedShortcodeType );

							// Skip the popup on certain shortcodes.

							switch ( richerSelectedShortcodeType ) {

				// tags
								
								case 'tags':
								
								var a = '[tags]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
				// socials
								
								case 'socials':
								
								var a = '[socials facebook="#" twitter="#" google_plus="#" dribbble="#"]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;

				// gap
								
								case 'gap':
								
								var a = '[gap height="30"]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;			
								
				// Vertical Rule
								
								case 'vr':
								
								var a = '[vr]'+selectedText+'[/vr]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// Clear
								
								case 'clear':
								
								var a = '[clear]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// row
								
								case 'row':
								
								var a = '[row]'+selectedText+'[/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;	
								
				// span1
								
								case 'span1':
								
								var a = '[span1]'+selectedText+'[/span1]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// span2
								
								case 'span2':
								
								var a = '[span2]'+selectedText+'[/span2]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
				// span3
								
								case 'span3':
								
								var a = '[span3]'+selectedText+'[/span3]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // span4
								
								case 'span4':
								
								var a = '[span4]'+selectedText+'[/span4]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // span5
								
								case 'span5':
								
								var a = '[span5]'+selectedText+'[/span5]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // span6
								
								case 'span6':
								
								var a = '[span6]'+selectedText+'[/span6]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // span7
								
								case 'span7':
								
								var a = '[span7]'+selectedText+'[/span7]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // span8
								
								case 'span8':
								
								var a = '[span8]'+selectedText+'[/span8]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // span9
								
								case 'span9':
								
								var a = '[span9]'+selectedText+'[/span9]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // span10
								
								case 'span10':
								
								var a = '[span10]'+selectedText+'[/span10]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // span11
								
								case 'span11':
								
								var a = '[span11]'+selectedText+'[/span11]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // span12
								
								case 'span12':
								
								var a = '[span12]'+selectedText+'[/span12]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// row_fluid
								
								case 'row_fluid':
								
								var a = '[row_fluid]'+selectedText+'[/row_fluid]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;

				// one_half
								
								case 'one_half':
								
								var a = '[one_half]'+selectedText+'[/one_half]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;

				// one_third
								
								case 'one_third':
								
								var a = '[one_third]'+selectedText+'[/one_third]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;

				// two_third
								
								case 'two_third':
								
								var a = '[two_third]'+selectedText+'[/two_third]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;

				// one_fourth
								
								case 'one_fourth':
								
								var a = '[one_fourth]'+selectedText+'[/one_fourth]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;


				// three_fourth
								
								case 'three_fourth':
								
								var a = '[three_fourth]'+selectedText+'[/three_fourth]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;


				// one_sixth
								
								case 'one_sixth':
								
								var a = '[one_sixth]'+selectedText+'[/one_sixth]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;


				// five_sixth
								
								case 'five_sixth':
								
								var a = '[five_sixth]'+selectedText+'[/five_sixth]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
				
								
				// dspan - 50x50
								
								case 'dspan_50x50':
								
								var a = '[row][span6]'+selectedText+'[/span6][span6][/span6][/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// dspan - 75x25
								
								case 'dspan_75x25':
								
								var a = '[row][span8]'+selectedText+'[/span8][span4][/span4][/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// dspan - 25x75
								
								case 'dspan_25x75':
								
								var a = '[row][span4]'+selectedText+'[/span4][span8][/span8][/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
				// dspan - 20x80
								
								case 'dspan_20x80':
								
								var a = '[row][one_fifth]'+selectedText+'[/one_fifth][four_fifth_last][/one_fifth_last][/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;				
				// tspan - 33x33x33
								
								case 'tspan_33x33x33':
								
								var a = '[row][span4]'+selectedText+'[/span4][span4][/span4][span4][/span4][/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// tspan - 50x25x25
								
								case 'tspan_50x25x25':
								
								var a = '[row][span6]'+selectedText+'[/span6][span3][/span3][span3][/span3][/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// tspan - 25x50x25
								
								case 'tspan_25x50x25':
								
								var a = '[row][span3]'+selectedText+'[/span3][span6][/span6][span3][/span3][/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// tspan - 25x25x50
								
								case 'tspan_25x25x50':
								
								var a = '[row][span3]'+selectedText+'[/span3][span3][/span3][span6][/span6][/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// qspan - 25x25x25x25
								
								case 'qspan_25x25x25x25':
								
								var a = '[row][span3]'+selectedText+'[/span3][span3][/span3][span3][/span3][span3][/span3][/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
                
                 // blockquote
								
								case 'blockquote':
								
								var a = '[blockquote]'+selectedText+'[/blockquote]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								

				// address
								
								case 'address':
								
								var a = '[address]'+selectedText+'[/address]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// table
								
								case 'table':
								
								var a = '[table style="1, 2 or 3"]'
+'<table width="100%">'
+'<thead>'
+'<tr>'
+'<th>Column 1</th>'
+'<th>Column 2</th>'
+'<th>Column 3</th>'
+'<th>Column 4</th>'
+'</tr>'
+'</thead>'
+'<tbody>'
+'<tr>'
+'<td>Item #1</td>'
+'<td>Description</td>'
+'<td>Subtotal:</td>'
+'<td>$1.00</td>'
+'</tr>'
+'<tr>'
+'<td>Item #2</td>'
+'<td>Description</td>'
+'<td>Discount:</td>'
+'<td>$2.00</td>'
+'</tr>'
+'<tr>'
+'<td>Item #3</td>'
+'<td>Description</td>'
+'<td>Shipping:</td>'
+'<td>$3.00</td>'
+'</tr>'
+'<tr>'
+'<td>Item #4</td>'
+'<td>Description</td>'
+'<td>Tax:</td>'
+'<td>$4.00</td>'
+'</tr>'
+'<tr>'
+'<td><strong>All Items</strong></td>'
+'<td><strong>Description</strong></td>'
+'<td><strong>Your Total:</strong></td>'
+'<td><strong>$10.00</strong></td>'
+'</tr>'
+'</tbody>'
+'</table>'
+'[/table]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
                
								break;
								
				
				// tabs
								
								case 'tabs':
								
								var a = '[tabgroup]<br />[tab title="Tab 1"]Tab 1 content goes here.[/tab]<br />[tab title="Tab 2" icon="fa-calendar"]Tab 2 content goes here.[/tab]<br />[tab icon="fa-cogs"]Tab 3 content goes here.[/tab]<br />[/tabgroup]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
                
								break;
				// vertical tabs
								
								case 'vertical_tabs':
								
								var a = '[tabgroup_vertical]<br />[tab title="Tab 1"]Tab 1 content goes here.[/tab]<br />[tab title="Tab 2" icon="fa-calendar"]Tab 2 content goes here.[/tab]<br />[tab icon="fa-cogs"]Tab 3 content goes here.[/tab]<br />[/tabgroup_vertical]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
                
								break;
                
                	// Accordion
								
								case 'accordions':
								
								var a = '[accordion open="2"]<br />[accordion_item title="First Tab Title"]Your Text[/accordion_item]<br />[accordion_item title="Second Tab Title"]Your Text[/accordion_item]<br />[accordion_item title="Third Tab Title"]Your Text[/accordion_item]<br />[/accordion]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
								
					// Close icon
								
								case 'close':
								
								var a = '[close dismiss="alert"]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;

					// Clients
								
								case 'clients':
								
								var a = '[clients][client link="" logo_url=""][client link="" logo_url=""][client link="" logo_url=""][client link="" logo_url=""][client link="" logo_url=""][/clients]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
					// Images
								
								case 'images':
								
								var a = '[images][image_item lightbox="yes" image_url=""][image_item lightbox="yes" image_url=""][image_item lightbox="yes" image_url=""][image_item lightbox="yes" image_url=""][image_item lightbox="yes" image_url=""][/images]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;

					// Template URL
								
								case 'template_url':
								
								var a = '[template_url]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
					// small
								
								case 'small':
								
								var a = '[small]'+selectedText+'[/small]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;

					// pricing table

								case 'pricing_table':
								
								var a ='[pricing-table][row]'
										+'[span3][plan name="Basic" link="#" linkname="Select" price="$109" per="/mo" color="#71be3c"]'
										+'<ul>'
											+'<li><strong>1</strong> User</li>'
											+'<li><strong>10</strong> Projects</li>'
											+'<li><strong>5</strong> GB Space</li>'
											+'<li><strong>Free</strong> Chat Support</li>'
											+'<li><strong>14</strong> Days Free Trial</li>'
										+'</ul>'
										+'[/plan][/span3]'
										+'[span3][plan name="Standard" link="#" linkname="Select" price="$139" per="/mo" color="#71be3c"]'
										+'<ul>'
											+'<li><strong>2</strong> User</li>'
											+'<li><strong>15</strong> Projects</li>'
											+'<li><strong>10</strong> GB Space</li>'
											+'<li><strong>Free</strong> Chat Support</li>'
											+'<li><strong>14</strong> Days Free Trial</li>'
										+'</ul>'
										+'[/plan][/span3]'
										+'[span3][plan name="Professional" link="#" linkname="Select" price="$149" per="/mo" color="#3498db"]'
										+'<ul>'
											+'<li><strong>6</strong> User</li>'
											+'<li><strong>20</strong> Projects</li>'
											+'<li><strong>15</strong> GB Space</li>'
											+'<li><strong>Free</strong> Chat Support</li>'
											+'<li><strong>14</strong> Days Free Trial</li>'
										+'</ul>'
										+'[/plan][/span3]'
										+'[span3][plan name="ENTERPRICE" link="#" linkname="Select" price="$249" per="/mo" color="#71be3c"]'
										+'<ul>'
											+'<li><strong>6</strong> User</li>'
											+'<li><strong>20</strong> Projects</li>'
											+'<li><strong>15</strong> GB Space</li>'
											+'<li><strong>Free</strong> Chat Support</li>'
											+'<li><strong>14</strong> Days Free Trial</li>'
										+'</ul>'
										+'[/plan][/span3][/row][/pricing-table]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								break;
					// pricing plan

								case 'pricing_plan':
								
								var a ='[pricing-table col="4" style="style3"]'
										+'[plan]'
										+'<ul>'
											+'<li>Number of Users</li>'
											+'<li>Number of Projects</li>'
											+'<li>Disc Space</li>'
											+'<li>Support Type</li>'
											+'<li>Free Trial</li>'
										+'</ul>'
										+'[/plan]'
										+'[plan name="Basic" link="#" linkname="Select" price="$109" per="/mo" color="#71be3c"]'
										+'<ul>'
											+'<li><strong>1</strong> User</li>'
											+'<li><strong>10</strong> Projects</li>'
											+'<li><strong>5</strong> GB Space</li>'
											+'<li><strong>Free</strong> Chat Support</li>'
											+'<li><strong>14</strong> Days Free Trial</li>'
										+'</ul>'
										+'[/plan]'
										+'[plan name="Professional" link="#" linkname="Select" price="$149" per="/mo" color="#3498db" extra_height="yes"]'
										+'<ul>'
											+'<li><strong>6</strong> User</li>'
											+'<li><strong>20</strong> Projects</li>'
											+'<li><strong>15</strong> GB Space</li>'
											+'<li><strong>Free</strong> Chat Support</li>'
											+'<li><strong>14</strong> Days Free Trial</li>'
										+'</ul>'
										+'[/plan]'
										+'[plan name="Standard" link="#" linkname="Select" price="$139" per="/mo" color="#71be3c"]'
										+'<ul>'
											+'<li><strong>2</strong> User</li>'
											+'<li><strong>15</strong> Projects</li>'
											+'<li><strong>10</strong> GB Space</li>'
											+'<li><strong>Free</strong> Chat Support</li>'
											+'<li><strong>14</strong> Days Free Trial</li>'
										+'</ul>'
										+'[/plan][/pricing-table]';

								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								break;									
								default:

								// jQuery("#dialog").remove();
								// jQuery("body").append(b);
								jQuery("#dialog").hide();
								var f=jQuery(window).width();
								b=jQuery(window).height();
								f=720<f?720:f;
								f-=80;
								b-=84;

								tb_dialog_helper.loadShortcodeDetails();
								tb_dialog_helper.setupShortcodeType( richerSelectedShortcodeType );

								tb_show("Insert "+ richerSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=dialog");jQuery("#shortcode-options h3:first").text(""+c.title+" Shortcode Settings");

								break;

							} // End SWITCH Statement

						// }

						// )
						}
					);
				},

				createControl:function(d,e){

						if(d=="richer_shortcodes_button"){

							d=e.createMenuButton("richer_shortcodes_button",{
								title:"Insert Shortcode",
								image:icon_url,
								icons:false
								});

								var a=this;d.onRenderMenu.add(function(c,b){
								c=b.addMenu({title:"Content",icon:"content"});
										a.addWithDialog(c,"Accordion","accordion");
										a.addWithDialog(c,"Clients","clients");
										a.addWithDialog(c,"Images","images");								
										a.addWithDialog(c,"Portfolio","portfolio");
										a.addWithDialog(c,"Recent Posts","recentposts");
										a.addWithDialog(c,"Recent comments","recentcomments");
										a.addWithDialog(c,"Soundcloud","soundcloud");
										a.addWithDialog(c,"Tabs","tabs");
										a.addWithDialog(c,"Testimonial","testimonial");
										a.addWithDialog(c,"TestiCarousel","testimonial_carousel");
										a.addWithDialog(c,"Toggle","toggle");
										a.addWithDialog(c,"Team member","member");
										a.addWithDialog(c,"Vertical Tabs","vertical_tabs");
										a.addWithDialog(c,"Video Embedd","video_embed");											
								c=b.addMenu({title:"Elements"});
										a.addWithDialog(c,"Animation","animation");
										a.addWithDialog(c,"Alert","alert");
										a.addWithDialog(c,"Banner","bannerbox");
										a.addWithDialog(c,"Button","button");
										a.addWithDialog(c,"Call to action","calltoaction");
										a.addWithDialog(c,"Circle counter","circle_counter");
										a.addWithDialog(c,"Coming soon","coming_soon");
										a.addWithDialog(c,"Counter info","counter_box");
										a.addWithDialog(c,"Fullwidth Section","section");
										a.addWithDialog(c,"Icon","icon");
										a.addWithDialog(c,"Iconbox","iconbox");
										a.addWithDialog(c,"Pricing plan","pricing_plan");
										a.addWithDialog(c,"Pricing table","pricing_table");
										a.addWithDialog(c,"Progressbar","progressbar");
										a.addWithDialog(c,"Data Table","table");
										a.addWithDialog(c,"Video Section","videosection");										
								c=b.addMenu({title:"Typography"});
										a.addWithDialog(c,"Blockquote","blockquote");
										a.addWithDialog(c,"Drop Cap","dropcap");
										a.addWithDialog(c,"Gap amid blocks","gap");
										a.addWithDialog(c,"Horizontal Rule","hr");
										a.addWithDialog(c,"Markered list","list");
										a.addWithDialog(c,"Pullquote","pullquote");
										a.addWithDialog(c,"Separator title","separator");
										a.addWithDialog(c,"Text Highlight","highlight");
										a.addWithDialog(c,"Tooltip","tooltip");
								c=b.addMenu({title:"Socials"});b.addSeparator();
										a.addWithDialog(c,"Google Map","map");
										a.addWithDialog(c,"Flickr","flickr");
										a.addWithDialog(c,"Twitter","twitter");
										a.addWithDialog(c,"Instagram","instagram");
										a.addWithDialog(c,"Social icons","socials");
								c=b.addMenu({title:"Columns"});
										a.addWithDialog(c,"row","row");
										a.addWithDialog(c,"span1","span1");
										a.addWithDialog(c,"span2","span2");
										a.addWithDialog(c,"span3","span3");
										a.addWithDialog(c,"span4","span4");
										a.addWithDialog(c,"span5","span5");
										a.addWithDialog(c,"span6","span6");
										a.addWithDialog(c,"span7","span7");
										a.addWithDialog(c,"span8","span8");
										a.addWithDialog(c,"span9","span9");
										a.addWithDialog(c,"span10","span10");
										a.addWithDialog(c,"span11","span11");
										a.addWithDialog(c,"span12","span12");
								c=b.addMenu({title:"Layouts preset"});
										a.addWithDialog(c,"50% | 50%","dspan_50x50");
										a.addWithDialog(c,"75% | 25%","dspan_75x25");
										a.addWithDialog(c,"25% | 75%","dspan_25x75");
										a.addWithDialog(c,"33% | 33% | 33%","tspan_33x33x33");
										a.addWithDialog(c,"50% | 25% | 25%","tspan_50x25x25");
										a.addWithDialog(c,"25% | 50% | 25%","tspan_25x50x25");
										a.addWithDialog(c,"25% | 25% | 50%","tspan_25x25x50");
										a.addWithDialog(c,"25% | 25% | 25% | 25%","qspan_25x25x25x25");

							});

							return d

						} // End IF Statement

						return null
					},

				addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand("mceInsertContent",false,a)}})},

				addWithDialog:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand("myThemeOpenDialog",false,{title:e,identifier:a})}})},

				getInfo:function(){ return{longname:"Shortcode Generator",author:"VisualShortcodes.com",authorurl:"http://visualshortcodes.com",infourl:"http://visualshortcodes.com/shortcode-ninja",version:"1.0"} }
			}
		);

		tinymce.PluginManager.add("RicherTinyMCEShortcodes",tinymce.plugins.RicherTinyMCEShortcodes)
	}
)();
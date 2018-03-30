/**
 * This file contains all the main JavaScript functionality needed for the editor formatting buttons.
 * 
 * @author orangethemes
 * http://orangethemes.com
 */

/**
 * Define all the formatting buttons with the HTML code they set.
 */
var orangethemesButtons=[
		{
			id:'orangethemesbutton',
			image:'btn-button.png',
			title:'Button',
			allowSelection:false,
			fields:[{id:'text', name:'Text'},{id:'icon', name:'Icon', values:ot_icons()},{id:'href', name:'Link URL'},{id:'color', name:'Color', value:'3c1805', colorpalette:true},{id:'textcolor', name:'Text Color', colorpalette:true},{id:'target', name:'Target', values:['Self', 'Blank']},{id:'type', name:'Button Type', values:['Default', 'Link']}],
			generateHtml:function(obj){
				var code = ot_switch(obj.icon.toLowerCase());
				var buttonTarget=obj.target==='Self'?'':'blank';
				return '[button link="'+obj.href+'" icon="'+code+'" target="'+buttonTarget+'" color="'+obj.color.toLowerCase()+'" type="'+obj.type.toLowerCase()+'" textcolor="'+obj.textcolor.toLowerCase()+'"]'+obj.text+'[/button]';

			}
		},
		{
			id:'orangethemesaccordion',
			image:'btn-accordion.png',
			title:'Accordion Boxes',
			allowSelection:false,
			fields:[{id:'title-1', name:'Title: '},{id:'text', name:'Text: ', toggles:true}],
			generateHtml:function(obj){
				var x = jQuery('#ot-toggles').val();  
				var output = '[accordion]';
				for(e = 1; e <= x; e++) {
					output+= '[acc ';
					output+= 'title="'+jQuery('#orangethemes-shortcode-title-'+e).val()+'"]';
					output+= jQuery('#orangethemes-shortcode-text-'+e).val();
					output+= '[/acc]';
				}
				output+="[/accordion]";

				return output;
			}
		},
		{
			id:'orangethemestoggles',
			image:'btn-toggles.png',
			title:'Toggles',
			allowSelection:false,
			fields:[{id:'title', name:'Title: '},{id:'text', name:'Text: ', textarea:true}],
			generateHtml:function(obj){ 
				return '[toggles title="'+obj.title+'"]'+obj.text+'[/toggles]';
			}
		},
		{
			id:'orangethemesteam',
			image:'btn-team-single.png',
			title:'Team Single',
			allowSelection:false,
			fields:[{id:'title', name:'Title: '},{id:'subtitle', name:'Subtitle: '},{id:'text', name:'Text: ', textarea:true},{id:'url', name:'Author Url: '}, {id:'image', name:'Image Url: ', upload:true} ],
			generateHtml:function(obj){ 
				return '[team title="'+obj.title+'" subtitle="'+obj.subtitle+'" url="'+obj.url+'" image="'+obj.image+'"]'+obj.text+'[/team]';
			}
		},
		{
			id:'orangethemesteam2',
			image:'btn-team-double.png',
			title:'Team Double',
			allowSelection:false,
			fields:[{id:'title', name:'Title 1: '},{id:'subtitle', name:'Subtitle 1: '},{id:'text', name:'Text 1: ', textarea:true},{id:'url', name:'Author Url 1: '}, {id:'image', name:'Image Url 1: ', upload:true}, {id:'title2', name:'Title 2: '},{id:'subtitle2', name:'Subtitle 2: '},{id:'text2', name:'Text 2: ', textarea:true},{id:'url2', name:'Author Url 2: '}, {id:'image2', name:'Image Url 2: ', upload:true} ],
			generateHtml:function(obj){ 
				return '[team-2 title="'+obj.title+'" subtitle="'+obj.subtitle+'" url="'+obj.url+'" image="'+obj.image+'" text="'+obj.text+'" title2="'+obj.title2+'" subtitle2="'+obj.subtitle2+'" url2="'+obj.url2+'" image2="'+obj.image2+'" text2="'+obj.text2+'"]';
			}
		},
		{
			id:'orangethemesmarker',
			image:'cpanel-btn-marker.png',
			title:'Text Marker',
			allowSelection:true,
			fields:[{id:'markercolor', name:'Color', color:"c24000", colorpalette:true, selesction:true}],
			generateHtml:function(obj){
				return '[textmarker color="'+obj.markercolor+'"]'+obj.selection+'[/textmarker]';
			}

		},
		{
			id:'orangethemestables',
			image:'btn-table-shortcode.png',
			title:'Create Table',
			allowSelection:false,
			fields:[{id:'table_row', name:'Rows Count'},{id:'table_columns', name:'Columns Count'}],
			generateHtml:function(obj){
				var $rows = obj.table_row;
				var $colomns = obj.table_columns;
				var $table = "<table class=\"table-bordered\">";
				$table += "<thead><tr>";
				for($i=1; $i<=$colomns; $i++) {

					$table += "<th>Main Header "+$i+"</th>";

				}
				$table += "</tr></thead>";
				$table += "<tbody>";

				for($i=1; $i<=$rows; $i++) {
					$table += "<tr>";
					for($ii=1; $ii<=$colomns; $ii++) {

						$table += "<td>Text "+$ii+"</td>";

					}
					$table += "</tr>";
				}

				$table += "</tbody>";
				$table += "</table>";

				return $table;

			}

		},		
		{
			id:'orangethemesspacer',
			image:'btn-spacer.png',
			title:'Spacer',
			allowSelection:false,
			fields:[{id:'style', name:'Style', values:['Spacer 1', 'Spacer 2', 'Spacer 3', 'Spacer 4']}],
			generateHtml:function(obj){

				switch(obj.style)
				{
					case 'Spacer 1':
					 	var spacerStyle='1';
					  	break;
					case 'Spacer 2':
					 	var spacerStyle='2';
						break;
					case 'Spacer 3':
					 	var spacerStyle='3';
						break;
					case 'Spacer 4':
					 	var spacerStyle='4';
						break;
					default:
					 	var spacerStyle='1';
					    break;
				}

				return '[spacer style="'+spacerStyle+'"]';

			}
		},
		{
			id:'orangethemesvideo',
			image:'cpanel-btn-video.png',
			title:'Insert Video',
			allowSelection:false,
			fields:[{id:'type', name:'Type', values:['Youtube', 'Vimeo']},{id:'links', name:'Video Link' }],
			generateHtml:function(obj){
				return '[ot-video type="'+obj.type.toLowerCase()+'" url="'+obj.links+'"]';
			}
		},
		{
			id:'orangethemesquote',
			image:'btn-quotes.png',
			title:'Quote',
			allowSelection:false,
			fields:[{id:'style', name:'Style', values:['Style-1', 'Style-2']},{id:'quotetext', name:'Quote text', textarea:true}],
			generateHtml:function(obj){

				switch(obj.style.toLowerCase()) {
					case 'style-1':
						var style='1'
						break;
					case 'style-2':
						var style='2'
						break;
					default:
						var style='1'
						break;

				}
				if(obj.style.toLowerCase()=="default"){
					return '[blockquote]'+obj.quotetext+'[/blockquote]';
				} else {
					return '[blockquote style="'+style+'"]'+obj.quotetext+'[/blockquote]';
				}
				

			}
		},
		{
			id:'orangethemespricing',
			image:'btn-pricing.png',
			title:'Pricing Table',
			allowSelection:false,
			fields:[{id:'table', name:'First Table In The Post:', values:['Yes', 'No']},{id:'active', name:'Active?', values:['No', 'Yes']},{id:'color', name:'Color', colorpalette:true},{id:'title', name:'Title'},{id:'price', name:'Price'},{id:'currency', name:'Currency'},{id:'period', name:'Period'},{id:'list', name:'Features, separate them with - ;', textarea:true},{id:'btntext', name:'Button Text'},{id:'href', name:'Button Link'},{id:'target', name:'Button Target', values:['Self', 'Blank']}],
			generateHtml:function(obj){
				var output = '';

				if(obj.table=="Yes") {
					output+="[wraper]";
				}

					output+='[pricing title="'+obj.title+'" color="'+obj.color+'" price="'+obj.price+'" currency="'+obj.currency+'" period="'+obj.period+'" list="'+obj.list+'" btntext="'+obj.btntext+'" url="'+obj.href+'" target="'+obj.target+'"]';
				if(obj.table=="Yes") {
					output+="[/wraper]";
				}
				return output;

			}
		},
		{
			id:'orangethemesalert',
			image:'btn-alert-box.png',
			title:'Alert Box',
			allowSelection:false,
			fields:[{id:'color', name:'Color', color:"c24000", colorpalette:true},{id:'text', name:'Text', textarea:true}],
			generateHtml:function(obj){
				
				return '[alert color="'+obj.color+'"]'+obj.text+'[/alert]';
				
				

			}
		},
		{
			id:'orangethemesmap',
			image:'map-icon.png',
			title:'Google Map',
			allowSelection:false,
			fields:[{id:'link', name:'Google Map URL'}],
			generateHtml:function(obj){
				return '[googlemap]'+obj.link+'[/googlemap]';
			}
		},

		{
			id:'orangethemeslists',
			image:'btn-lists.png',
			title:'Lists',
			allowSelection:false,
			fields:[{id:'type-1', name:'Type', values:ot_icons()},{id:'lists', name:'Text', lists:true}],
			generateHtml:function(obj){
				var x = jQuery('#ot-lists').val();  
				var output = '[list]';
				for(e = 1; e <= x; e++) {
					var code = ot_switch(jQuery('#orangethemes-shortcode-type-'+e).val().toLowerCase());
					output+= '[item icon="'+code+'" ]';
					output+= jQuery('#orangethemes-shortcode-lists-'+e).val();
					output+= '[/item]';
				}
				output+="[/list]";
				
				return output;
			}
		},
		{
			id:'orangethemesgallery',
			image:'btn-gallery.png',
			title:'Insert Gallery Preview',
			allowSelection:false,
			fields:[{id:'links', name:'Gallery Link' }],
			generateHtml:function(obj){
				return '[ot-gallery url="'+obj.links+'"]';
			}
		},
		{
			id:'orangethemescaption',
			image:'btn-image.png',
			title:'Image Caption',
			allowSelection:false,
			fields:[{id:'caption_title', name:'Title'},{id:'link', name:'Image URL', upload:true}],
			generateHtml:function(obj){
				return '[ot-caption title="'+obj.caption_title+'" url="'+obj.link+'"]';
			}
		},
		{
			id:'orangethemesbreak',
			image:'cpanel-btn-break.png',
			title:'Insert Breake',
			allowSelection:false,
			generateHtml:function(){
				return '<br class="clear" />';
			}
		},
	
		{
			id:'orangethemessocial',
			image:'cpanel-btn-social.png',
			title:'Social Icon',
			allowSelection:false,
			fields:[{id:'icon', name:'Type', values:['Flickr', 'Vimeo', 'Twitter', 'Facebook', 'Google+', 'Pinterest', 'Tumbrl', 'Linkedin', 'Dribbble', 'StumbleUpon', 'LastFM', 'Rdio', 'Spotify', 'Instagram', 'Soundcloud', 'Bēhance']},{id:'link', name:'Link To Account'}],
			generateHtml:function(obj){
				
					switch(obj.icon.toLowerCase()) {
						case 'twitter':
							var code='62217'
							break;
						case 'facebook':
							var code='62220'
							break;
						case 'google+':
							var code='62223'
							break;
						case 'pinterest':
							var code='62226'
							break;
						case 'tumbrl':
							var code='62229'
							break;
						case 'flickr':
							var code='62211'
							break;
						case 'vimeo':
							var code='62214'
							break;
						case 'linkedin':
							var code='62232'
							break;
						case 'dribbble':
							var code='62235'
							break;
						case 'stumbleupon':
							var code='62238'
							break;
						case 'lastfm':
							var code='62241'
							break;
						case 'rdio':
							var code='62244'
							break;
						case 'spotify':
							var code='62247'
							break;
						case 'instagram':
							var code='62253'
							break;
						case 'soundcloud':
							var code='62280'
							break;
						case 'bēhance':
							var code='62286'
							break;
						
					}


				return '[social link="'+obj.link+'" icon="'+code+'"]';

			}
		},
		{
			id:'orangethemestabs',
			image:'btn-tabs.png',
			title:'Insert Tabs',
			allowSelection:false,
			fields:[{id:'title-1', name:'Title: '},{id:'text', name:'Text: ', tabs:true}],
			generateHtml:function(obj){
				var x = jQuery('#ot-tabs').val();  
				var output = '[tabs]';
				for(e = 1; e <= x; e++) {
					output+= '[tab ';
					output+= 'title ="'+jQuery('#orangethemes-shortcode-title-'+e).val()+'"]';
					output+= jQuery('#orangethemes-shortcode-text-'+e).val();
					output+= '[/tab]';
				}
				output+="[/tabs]";
				
				return output;
			}
		},
		{
			id:'orangethemesparagraph',
			image:'btn-paragraph-2.png',
			title:'Insert Paragraph',
			allowSelection:false,
			generateHtml:function(obj){
				return '[row][double_paragraph]Left Side Content [/double_paragraph][double_paragraph] Right Side Content [/double_paragraph] [/row]';
			}
		},
		{
			id:'orangethemesparagraph2',
			image:'btn-paragraph-3.png',
			title:'Insert Paragraph',
			allowSelection:false,
			generateHtml:function(obj){
				return '[row][third_paragraph] Left Side Content [/third_paragraph][third_paragraph] Middle Content [/third_paragraph][third_paragraph] Right Side Content [/third_paragraph][/row]';
			}
		},
		{
			id:'orangethemesparagraph5',
			image:'btn-columns-4.png',
			title:'Insert Paragraph',
			allowSelection:false,
			generateHtml:function(obj){
				return '[row][forth_paragraph] CONTENT [/forth_paragraph][forth_paragraph] CONTENT [/forth_paragraph][forth_paragraph] CONTENT [/forth_paragraph][forth_paragraph] CONTENT [/forth_paragraph][/row]';
			}
		},
		{
			id:'orangethemesparagraph3',
			image:'btn-paragraph-right.png',
			title:'Insert Paragraph',
			allowSelection:false,
			generateHtml:function(obj){
				return '[row][paragraph_left] Left Side Content [/paragraph_left][third_paragraph] Right Side Content [/third_paragraph][/row]';
			}
		},
		{
			id:'orangethemesparagraph4',
			image:'btn-paragraph-left.png',
			title:'Insert Paragraph',
			allowSelection:false,
			generateHtml:function(obj){
				return '[row][third_paragraph] Left Side Content [/third_paragraph][paragraph_right] Right Side Content [/paragraph_right][/row]';
			}
		}
		
];

/**
 * Contains the main formatting buttons functionality.
 */
orangethemesButtonManager={
	dialog:null,
	idprefix:'orangethemes-shortcode-',
	ie:false,
	opera:false,
		
	/**
	 * Init the formatting button functionality.
	 */
	init:function(){
			
		var length=orangethemesButtons.length;
		for(var i=0; i<length; i++){
		
			var btn = orangethemesButtons[i];
			orangethemesButtonManager.loadButton(btn);
			
		}
		
		if ( jQuery.browser.msie ) {
			orangethemesButtonManager.ie=true;
		}
		
		if (jQuery.browser.opera){
			orangethemesButtonManager.opera=true;
		}
		
	},
	
	/**
	 * Loads a button and sets the functionality that is executed when the button has been clicked.
	 */
	loadButton:function(btn){
		
		tinymce.create('tinymce.plugins.'+btn.id, {
	        init : function(ed, url) {
			        ed.addButton(btn.id, {
	                title : btn.title,
	                image : url+'/buttons/'+btn.image,
	                onclick : function() {
			        	
			           var selection = ed.selection.getContent();
	                   if(btn.allowSelection && selection && btn.fields){
							
	                	   //there are inputs to fill in, show a dialog to fill the required data
	                	   orangethemesButtonManager.showDialog(btn, ed);
	                   }else if(btn.allowSelection && selection){
							
	                	   //modification via selection is allowed for this button and some text has been selected
							selection = btn.generateHtml(selection);
							ed.selection.setContent(selection);
	                   }else if(btn.fields){
	                	   //there are inputs to fill in, show a dialog to fill the required data
	                	   orangethemesButtonManager.showDialog(btn, ed);
	                   }else if(btn.list){
	                	   ed.dom.remove('orangethemescaret');
		           		    ed.execCommand('mceInsertContent', false, '&nbsp;');	
	           			
	                	    //this is a list
	                	    var list, dom = ed.dom, sel = ed.selection;
	                	    
		               		// Check for existing list element
		               		list = dom.getParent(sel.getNode(), 'ul');
		               		
		               		// Switch/add list type if needed
		               		ed.execCommand('InsertUnorderedList');
		               		
		               		// Append styles to new list element
		               		list = dom.getParent(sel.getNode(), 'ul');
		               		
		               		if (list) {
		               			dom.addClass(list, btn.list);
		               		}
	                   }else{
	                	   //no data is required for this button, insert the generated HTML
	                	   ed.execCommand('mceInsertContent', true, btn.generateHtml());
	                   }
					   

						addLoadEvent(jscolor.init);
						

			
	                }
	            });
	        }
	    });
		
	    tinymce.PluginManager.add(btn.id, tinymce.plugins[btn.id]);
	},
	
	/**
	 * Displays a dialog that contains fields for inserting the data needed for the button.
	 */
	showDialog:function(btn, ed){

		
		if(orangethemesButtonManager.ie){
			ed.dom.remove('orangethemescaret');
		    var caret = '<div id="orangethemescaret">&nbsp;</div>';
		    ed.execCommand('mceInsertContent', false, caret);	
			var selection = ed.selection;
		}
	    
		var html='<div>';
		var selection = ed.selection;
		var selectedvalue = ed.selection.getContent();

		for(var i=0, length=btn.fields.length; i<length; i++){
			var field=btn.fields[i], inputHtml='';
			if(btn.fields[i].selesction){
				//this field should be a text area
				if(selectedvalue){ 
					// unlimited input
					html+='<div class="orangethemes-shortcode-field"><label>Selected Text</label><input type="text" value="'+selectedvalue+'" id="'+orangethemesButtonManager.idprefix+"selection"+'"></div><div>';
				} 
				
			}

			if(btn.fields[i].colorpalette){
					//this field should be a text area
					inputHtml='<input type="text" class="color" value="'+btn.fields[i].color+'" id="'+orangethemesButtonManager.idprefix+btn.fields[i].id+'">';
			} else if(btn.fields[i].values && !btn.fields[i].disabled){
				//this is a select list
				inputHtml='<select id="'+orangethemesButtonManager.idprefix+btn.fields[i].id+'">';
				jQuery.each(btn.fields[i].values, function(index, value){
					inputHtml+='<option value="'+value+'">'+value+'</option>';
				});
				inputHtml+='</select>';
			}else{
				if(btn.fields[i].textarea && !orangethemesButtonManager.opera){
					//this field should be a text area
					inputHtml='<textarea id="'+orangethemesButtonManager.idprefix+btn.fields[i].id+'" ></textarea>';
				} else if(btn.fields[i].upload && !orangethemesButtonManager.opera){ 
					// upload input
					inputHtml='<input type="text" id="'+orangethemesButtonManager.idprefix+btn.fields[i].id+'" class="ot-upload-field"/><a href="#" class="ot-upload-button">Button</a>';
				} else if(btn.fields[i].unlimitedinput && !orangethemesButtonManager.opera){ 
					// unlimited input
					inputHtml='<input type="text" class="otlist" id="'+orangethemesButtonManager.idprefix+btn.fields[i].id+'-1" /><input type="text" id="ot-list" value="1" hidden /><br /><br /><strong>To add new field press Enter</strong>';
				}  else if(btn.fields[i].disabled && !orangethemesButtonManager.opera){ 
					//this is a select list
					inputHtml='<select id="'+orangethemesButtonManager.idprefix+btn.fields[i].id+'" disabled>';
					jQuery.each(btn.fields[i].values, function(index, value){
						inputHtml+='<option value="'+value+'">'+value+'</option>';
					});
					inputHtml+='</select>';
				} else if(btn.fields[i].lists && !orangethemesButtonManager.opera){ 
					// unlimited input
					inputHtml='<input type="text" class="lists" id="'+orangethemesButtonManager.idprefix+btn.fields[i].id+'-1" /><input type="text" id="ot-lists" value="1" hidden /><br /><br /><strong>To add new field press Enter</strong>';
				} else if(btn.fields[i].tabs && !orangethemesButtonManager.opera){ 
					// unlimited input
					inputHtml='<textarea id="'+orangethemesButtonManager.idprefix+btn.fields[i].id+'-1"  class="tabs" ></textarea><input type="text" id="ot-tabs" value="1" hidden /><br /><br /><strong>To add new field press Enter</strong>';
				} else if(btn.fields[i].toggles && !orangethemesButtonManager.opera){ 
					// unlimited input
					inputHtml='<textarea id="'+orangethemesButtonManager.idprefix+btn.fields[i].id+'-1"  class="accordion" ></textarea><input type="text" id="ot-toggles" value="1" hidden /><br /><br /><strong>To add new field press Enter</strong>';
				}else{
					//this field should be a normal input
					inputHtml='<input type="text" id="'+orangethemesButtonManager.idprefix+btn.fields[i].id+'" />';
				}
			}
			html+='<div class="orangethemes-shortcode-field"><label>'+btn.fields[i].name+'</label>'+inputHtml+'</div>';
		}
		html+='<a href="" id="insertbtn" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Insert</span></a></div>';
				
		var dialog = jQuery(html).dialog({
							dialogClass: "orange-themes",
							 title:btn.title, 
							 modal:true,
							 close:function(event, ui){
								jQuery(this).html('').remove();
							 }
							 });
		
		orangethemesButtonManager.dialog=dialog;
		
		//set a click handler to the insert button
		dialog.find('#insertbtn').click(function(event){
			event.preventDefault();
			orangethemesButtonManager.executeCommand(ed,btn,selection);
		});

			dialog.keyup(function(){
			  if(event.keyCode == 13 && jQuery(".otlist").is(":focus")) {
				var i = jQuery('#ot-list').val();
				var n = Number(i)+Number(1);
				jQuery('<input type="text" class="otlist" id="orangethemes-shortcode-list-'+n+'" />').insertAfter("#orangethemes-shortcode-list-"+i);    
				jQuery('#ot-list').val(n);
			  }
			});
			
			dialog.keyup(function(){
			  if(event.keyCode == 13 && jQuery(".tabs").is(":focus") && jQuery('#ot-tabs').val() <5) {
				var i = jQuery('#ot-tabs').val();
				var n = Number(i)+Number(1);
				jQuery('<div class="orangethemes-shortcode-field"><label>Title: </label><input type="text" id="orangethemes-shortcode-title-'+n+'"></div><div class="orangethemes-shortcode-field"><label>Text: </label><textarea id="orangethemes-shortcode-text-'+n+'" class="tabs"></textarea></div>').insertBefore("#insertbtn");    
				jQuery('#ot-tabs').val(n);
			  }
			});
			
			dialog.keyup(function(){
			  if(event.keyCode == 13 && jQuery(".lists").is(":focus")) {
				var i = jQuery('#ot-lists').val();
				var n = Number(i)+Number(1);
				jQuery('<div class="orangethemes-shortcode-field"><label>Type</label><select id="orangethemes-shortcode-type-'+n+'"><option value="phone">phone</option><option value="mobile">mobile</option><option value="mouse">mouse</option><option value="address">address</option><option value="mail">mail</option><option value="paper-plane">paper-plane</option><option value="pencil">pencil</option><option value="feather">feather</option><option value="attach">attach</option><option value="inbox">inbox</option><option value="reply">reply</option><option value="reply-all">reply-all</option><option value="forward">forward</option><option value="user">user</option><option value="users">users</option><option value="add-user">add-user</option><option value="vcard">vcard</option><option value="export">export</option><option value="location">location</option><option value="map">map</option><option value="compass">compass</option><option value="direction">direction</option><option value="hair-cross">hair-cross</option><option value="share">share</option><option value="shareable">shareable</option><option value="heart">heart</option><option value="heart-empty">heart-empty</option><option value="star">star</option><option value="star-empty">star-empty</option><option value="thumbs-up">thumbs-up</option><option value="thumbs-down">thumbs-down</option><option value="chat">chat</option><option value="comment">comment</option><option value="quote">quote</option><option value="home">home</option><option value="popup">popup</option><option value="search">search</option><option value="flashlight">flashlight</option><option value="print">print</option><option value="bell">bell</option><option value="link">link</option><option value="flag">flag</option><option value="cog">cog</option><option value="tools">tools</option><option value="trophy">trophy</option><option value="tag">tag</option><option value="camera">camera</option><option value="megaphone">megaphone</option><option value="moon">moon</option><option value="palette">palette</option><option value="leaf">leaf</option><option value="note">note</option><option value="beamed-note">beamed-note</option><option value="new">new</option><option value="graduation-cap">graduation-cap</option><option value="book">book</option><option value="newspaper">newspaper</option><option value="bag">bag</option><option value="airplane">airplane</option><option value="lifebuoy">lifebuoy</option><option value="eye">eye</option><option value="clock">clock</option><option value="mic">mic</option><option value="calendar">calendar</option><option value="flash">flash</option><option value="thunder-cloud">thunder-cloud</option><option value="droplet">droplet</option><option value="cd">cd</option><option value="briefcase">briefcase</option><option value="air">air</option><option value="hourglass">hourglass</option><option value="gauge">gauge</option><option value="language">language</option><option value="network">network</option><option value="key">key</option><option value="battery">battery</option><option value="bucket">bucket</option><option value="magnet">magnet</option><option value="drive">drive</option><option value="cup">cup</option><option value="rocket">rocket</option><option value="brush">brush</option><option value="suitcase">suitcase</option><option value="traffic-cone">traffic-cone</option><option value="globe">globe</option><option value="keyboard">keyboard</option><option value="browser">browser</option><option value="publish">publish</option><option value="progress-3">progress-3</option><option value="progress-2">progress-2</option><option value="progress-1">progress-1</option><option value="progress-0">progress-0</option><option value="light-down">light-down</option><option value="light-up">light-up</option><option value="adjust">adjust</option><option value="code">code</option><option value="monitor">monitor</option><option value="infinity">infinity</option><option value="light-bulb">light-bulb</option><option value="credit-card">credit-card</option><option value="database">database</option><option value="voicemail">voicemail</option><option value="clipboard">clipboard</option><option value="cart">cart</option><option value="box">box</option><option value="ticket">ticket</option><option value="rss">rss</option><option value="signal">signal</option><option value="thermometer">thermometer</option><option value="water">water</option><option value="sweden">sweden</option><option value="line-graph">line-graph</option><option value="pie-chart">pie-chart</option><option value="bar-graph">bar-graph</option><option value="area-graph">area-graph</option><option value="lock">lock</option><option value="lock-open">lock-open</option><option value="logout">logout</option><option value="login">login</option><option value="check">check</option><option value="cross">cross</option><option value="squared-minus">squared-minus</option><option value="squared-plus">squared-plus</option><option value="squared-cross">squared-cross</option><option value="circled-minus">circled-minus</option><option value="circled-plus">circled-plus</option><option value="circled-cross">circled-cross</option><option value="minus">minus</option><option value="plus">plus</option><option value="erase">erase</option><option value="block">block</option><option value="info">info</option><option value="circled-info">circled-info</option><option value="help">help</option><option value="circled-help">circled-help</option><option value="warning">warning</option><option value="cycle">cycle</option><option value="cw">cw</option><option value="ccw">ccw</option><option value="shuffle">shuffle</option><option value="back">back</option><option value="level-down">level-down</option><option value="retweet">retweet</option><option value="loop">loop</option><option value="back-in-time">back-in-time</option><option value="level-up">level-up</option><option value="switch">switch</option><option value="numbered-list">numbered-list</option><option value="add-to-list">add-to-list</option><option value="layout">layout</option><option value="list">list</option><option value="text-doc">text-doc</option><option value="text-doc-inverted">text-doc-inverted</option><option value="doc">doc</option><option value="docs">docs</option><option value="landscape-doc">landscape-doc</option><option value="picture">picture</option><option value="video">video</option><option value="music">music</option><option value="folder">folder</option><option value="archive">archive</option><option value="trash">trash</option><option value="upload">upload</option><option value="download">download</option><option value="save">save</option><option value="install">install</option><option value="cloud">cloud</option><option value="upload-cloud">upload-cloud</option><option value="bookmark">bookmark</option><option value="bookmarks">bookmarks</option><option value="open-book">open-book</option><option value="play">play</option><option value="paus">paus</option><option value="record">record</option><option value="stop">stop</option><option value="ff">ff</option><option value="fb">fb</option><option value="to-start">to-start</option><option value="to-end">to-end</option><option value="resize-full">resize-full</option><option value="resize-small">resize-small</option><option value="volume">volume</option><option value="sound">sound</option><option value="mute">mute</option><option value="flow-cascade">flow-cascade</option><option value="flow-branch">flow-branch</option><option value="flow-tree">flow-tree</option><option value="flow-line">flow-line</option><option value="flow-parallel">flow-parallel</option><option value="left-bold">left-bold</option><option value="down-bold">down-bold</option><option value="up-bold">up-bold</option><option value="right-bold">right-bold</option><option value="left">left</option><option value="down">down</option><option value="up">up</option><option value="right">right</option><option value="circled-left">circled-left</option><option value="circled-down">circled-down</option><option value="circled-up">circled-up</option><option value="circled-right">circled-right</option><option value="triangle-left">triangle-left</option><option value="triangle-down">triangle-down</option><option value="triangle-up">triangle-up</option><option value="triangle-right">triangle-right</option><option value="chevron-left">chevron-left</option><option value="chevron-down">chevron-down</option><option value="chevron-up">chevron-up</option><option value="chevron-right">chevron-right</option><option value="chevron-small-left">chevron-small-left</option><option value="chevron-small-down">chevron-small-down</option><option value="chevron-small-up">chevron-small-up</option><option value="chevron-small-right">chevron-small-right</option><option value="chevron-thin-left">chevron-thin-left</option><option value="chevron-thin-down">chevron-thin-down</option><option value="chevron-thin-up">chevron-thin-up</option><option value="chevron-thin-right">chevron-thin-right</option><option value="left-thin">left-thin</option><option value="down-thin">down-thin</option><option value="up-thin">up-thin</option><option value="right-thin">right-thin</option><option value="arrow-combo">arrow-combo</option><option value="three-dots">three-dots</option><option value="two-dots">two-dots</option><option value="dot">dot</option><option value="cc">cc</option><option value="cc-by">cc-by</option><option value="cc-nc">cc-nc</option><option value="cc-nc-eu">cc-nc-eu</option><option value="cc-nc-jp">cc-nc-jp</option><option value="cc-sa">cc-sa</option><option value="cc-nd">cc-nd</option><option value="cc-pd">cc-pd</option><option value="cc-zero">cc-zero</option><option value="cc-share">cc-share</option><option value="cc-remix">cc-remix</option><option value="db-logo">db-logo</option><option value="db-shape">db-shape</option><option value="github">github</option><option value="c-github">c-github</option><option value="flickr">flickr</option><option value="c-flickr">c-flickr</option><option value="vimeo">vimeo</option><option value="c-vimeo">c-vimeo</option><option value="twitter">twitter</option><option value="c-twitter">c-twitter</option><option value="facebook">facebook</option><option value="c-facebook">c-facebook</option><option value="s-facebook">s-facebook</option><option value="google+">google+</option><option value="c-google+">c-google+</option><option value="pinterest">pinterest</option><option value="c-pinterest">c-pinterest</option><option value="tumblr">tumblr</option><option value="c-tumblr">c-tumblr</option><option value="linkedin">linkedin</option><option value="c-linkedin">c-linkedin</option><option value="dribbble">dribbble</option><option value="c-dribbble">c-dribbble</option><option value="stumbleupon">stumbleupon</option><option value="c-stumbleupon">c-stumbleupon</option><option value="lastfm">lastfm</option><option value="c-lastfm">c-lastfm</option><option value="rdio">rdio</option><option value="c-rdio">c-rdio</option><option value="spotify">spotify</option><option value="c-spotify">c-spotify</option><option value="qq">qq</option><option value="instagram">instagram</option><option value="dropbox">dropbox</option><option value="evernote">evernote</option><option value="flattr">flattr</option><option value="skype">skype</option><option value="c-skype">c-skype</option><option value="renren">renren</option><option value="sina-weibo">sina-weibo</option><option value="paypal">paypal</option><option value="picasa">picasa</option><option value="soundcloud">soundcloud</option><option value="mixi">mixi</option><option value="behance">behance</option><option value="google-circles">google-circles</option><option value="vk">vk</option><option value="smashing">smashing</option></select></div><div class="orangethemes-shortcode-field"><label>Text</label><input type="text" class="lists" id="orangethemes-shortcode-lists-'+n+'"></div>').insertBefore("#insertbtn");    
				jQuery('#ot-lists').val(n);
			  }
			});
			dialog.keyup(function(){
				if(event.keyCode == 13 && jQuery(".accordion").is(":focus") && jQuery('#ot-toggles').val() <5 ) {
					var i = jQuery('#ot-toggles').val();
					var n = Number(i)+Number(1);
					jQuery('<div class="orangethemes-shortcode-field"><label>Title: </label><input type="text" id="orangethemes-shortcode-title-'+n+'"></div><div class="orangethemes-shortcode-field"><label>Text: </label><textarea id="orangethemes-shortcode-text-'+n+'" class="accordion"></textarea></div>').insertBefore("#insertbtn");    
					jQuery('#ot-toggles').val(n);
				}
			});
	},
	/**
	 * Executes a command when the insert button has been clicked.
	 */
	executeCommand:function(ed, btn, selection){

    		var values={}, html='';
    		var selection = ed.selection.getContent();
    		if(!btn.allowSelection){
    			//the button doesn't allow selection, generate the values as an object literal
	    		for(var i=0, length=btn.fields.length; i<length; i++){
	        		var id=btn.fields[i].id,
	        			value=jQuery('#'+orangethemesButtonManager.idprefix+id).val();
	        		
	    			values[id]=value;
	    		}
	    		html = btn.generateHtml(values);
    		}else{
				var values={};
    			//the button allows selection - only one value is needed for the formatting, so
    			//return this value only (not an object literal)
    			values[btn.fields[0].id]=jQuery('#'+orangethemesButtonManager.idprefix+btn.fields[0].id).attr("value");
				if(btn.fields.length>=2) {
					values[btn.fields[1].id]=jQuery('#'+orangethemesButtonManager.idprefix+btn.fields[1].id).attr("value");
				}
				values["selection"]= jQuery('#'+orangethemesButtonManager.idprefix+"selection").attr("value");

    			html = btn.generateHtml(values);
    		}
    		
    	orangethemesButtonManager.dialog.remove();

    	if(orangethemesButtonManager.ie){
	    	selection.select(ed.dom.select('div#orangethemescaret')[0], false);
	    	ed.dom.remove('orangethemescaret');
    	}

  		ed.execCommand('mceInsertContent', false, html);
    	
	}
};

/**
 * Init the formatting functionality.
 */
(function() {
	
	orangethemesButtonManager.init();
    
})();

function ot_icons() {
	return ['Select a Icon','phone','mobile','mouse','address','mail','paper-plane','pencil','feather','attach','inbox','reply','reply-all','forward','user','users','add-user','vcard','export','location','map','compass','direction','hair-cross','share','shareable','heart','heart-empty','star','star-empty','thumbs-up','thumbs-down','chat','comment','quote','home','popup','search','flashlight','print','bell','link','flag','cog','tools','trophy','tag','camera','megaphone','moon','palette','leaf','note','beamed-note','new','graduation-cap','book','newspaper','bag','airplane','lifebuoy','eye','clock','mic','calendar','flash','thunder-cloud','droplet','cd','briefcase','air','hourglass','gauge','language','network','key','battery','bucket','magnet','drive','cup','rocket','brush','suitcase','traffic-cone','globe','keyboard','browser','publish','progress-3','progress-2','progress-1','progress-0','light-down','light-up','adjust','code','monitor','infinity','light-bulb','credit-card','database','voicemail','clipboard','cart','box','ticket','rss','signal','thermometer','water','sweden','line-graph','pie-chart','bar-graph','area-graph','lock','lock-open','logout','login','check','cross','squared-minus','squared-plus','squared-cross','circled-minus','circled-plus','circled-cross','minus','plus','erase','block','info','circled-info','help','circled-help','warning','cycle','cw','ccw','shuffle','back','level-down','retweet','loop','back-in-time','level-up','switch','numbered-list','add-to-list','layout','list','text-doc','text-doc-inverted','doc','docs','landscape-doc','picture','video','music','folder','archive','trash','upload','download','save','install','cloud','upload-cloud','bookmark','bookmarks','open-book','play','paus','record','stop','ff','fb','to-start','to-end','resize-full','resize-small','volume','sound','mute','flow-cascade','flow-branch','flow-tree','flow-line','flow-parallel','left-bold','down-bold','up-bold','right-bold','left','down','up','right','circled-left','circled-down','circled-up','circled-right','triangle-left','triangle-down','triangle-up','triangle-right','chevron-left','chevron-down','chevron-up','chevron-right','chevron-small-left','chevron-small-down','chevron-small-up','chevron-small-right','chevron-thin-left','chevron-thin-down','chevron-thin-up','chevron-thin-right','left-thin','down-thin','up-thin','right-thin','arrow-combo','three-dots','two-dots','dot','cc','cc-by','cc-nc','cc-nc-eu','cc-nc-jp','cc-sa','cc-nd','cc-pd','cc-zero','cc-share','cc-remix','db-logo','db-shape','github','c-github','flickr','c-flickr','vimeo','c-vimeo','twitter','c-twitter','facebook','c-facebook','s-facebook','google+','c-google+','pinterest','c-pinterest','tumblr','c-tumblr','linkedin','c-linkedin','dribbble','c-dribbble','stumbleupon','c-stumbleupon','lastfm','c-lastfm','rdio','c-rdio','spotify','c-spotify','qq','instagram','dropbox','evernote','flattr','skype','c-skype','renren','sina-weibo','paypal','picasa','soundcloud','mixi','behance','google-circles','vk','smashing'];
}

function ot_switch(value) {
	switch(value) {
		case 'phone':
		var code='&#128222;'
		break;
		case 'mobile':
		var code='&#128241;'
		break;
		case 'mouse':
		var code='&#59273;'
		break;
		case 'address':
		var code='&#59171;'
		break;
		case 'mail':
		var code='&#9993;'
		break;
		case 'paper-plane':
		var code='&#128319;'
		break;
		case 'pencil':
		var code='&#9998;'
		break;
		case 'feather':
		var code='&#10002;'
		break;
		case 'attach':
		var code='&#128206;'
		break;
		case 'inbox':
		var code='&#59255;'
		break;
		case 'reply':
		var code='&#59154;'
		break;
		case 'reply-all':
		var code='&#59155;'
		break;
		case 'forward':
		var code='&#10150;'
		break;
		case 'user':
		var code='&#128100;'
		break;
		case 'users':
		var code='&#128101;'
		break;
		case 'add-user':
		var code='&#59136;'
		break;
		case 'vcard':
		var code='&#59170;'
		break;
		case 'export':
		var code='&#59157;'
		break;
		case 'location':
		var code='&#59172;'
		break;
		case 'map':
		var code='&#59175;'
		break;
		case 'compass':
		var code='&#59176;'
		break;
		case 'direction':
		var code='&#10146;'
		break;
		case 'hair-cross':
		var code='&#127919;'
		break;
		case 'share':
		var code='&#59196;'
		break;
		case 'shareable':
		var code='&#59198;'
		break;
		case 'heart':
		var code='&hearts;'
		break;
		case 'heart-empty':
		var code='&#9825;'
		break;
		case 'star':
		var code='&#9733;'
		break;
		case 'star-empty':
		var code='&#9734;'
		break;
		case 'thumbs-up':
		var code='&#128077;'
		break;
		case 'thumbs-down':
		var code='&#128078;'
		break;
		case 'chat':
		var code='&#59168;'
		break;
		case 'comment':
		var code='&#59160;'
		break;
		case 'quote':
		var code='&#10078;'
		break;
		case 'home':
		var code='&#8962;'
		break;
		case 'popup':
		var code='&#59212;'
		break;
		case 'search':
		var code='&#128269;'
		break;
		case 'flashlight':
		var code='&#128294;'
		break;
		case 'print':
		var code='&#59158;'
		break;
		case 'bell':
		var code='&#128276;'
		break;
		case 'link':
		var code='&#128279;'
		break;
		case 'flag':
		var code='&#9873;'
		break;
		case 'cog':
		var code='&#9881;'
		break;
		case 'tools':
		var code='&#9874;'
		break;
		case 'trophy':
		var code='&#127942;'
		break;
		case 'tag':
		var code='&#59148;'
		break;
		case 'camera':
		var code='&#128247;'
		break;
		case 'megaphone':
		var code='&#128227;'
		break;
		case 'moon':
		var code='&#9789;'
		break;
		case 'palette':
		var code='&#127912;'
		break;
		case 'leaf':
		var code='&#127810;'
		break;
		case 'note':
		var code='&#9834;'
		break;
		case 'beamed-note':
		var code='&#9835;'
		break;
		case 'new':
		var code='&#128165;'
		break;
		case 'graduation-cap':
		var code='&#127891;'
		break;
		case 'book':
		var code='&#128213;'
		break;
		case 'newspaper':
		var code='&#128240;'
		break;
		case 'bag':
		var code='&#128092;'
		break;
		case 'airplane':
		var code='&#9992;'
		break;
		case 'lifebuoy':
		var code='&#59272;'
		break;
		case 'eye':
		var code='&#59146;'
		break;
		case 'clock':
		var code='&#128340;'
		break;
		case 'mic':
		var code='&#127908;'
		break;
		case 'calendar':
		var code='&#128197;'
		break;
		case 'flash':
		var code='&#9889;'
		break;
		case 'thunder-cloud':
		var code='&#9928;'
		break;
		case 'droplet':
		var code='&#128167;'
		break;
		case 'cd':
		var code='&#128191;'
		break;
		case 'briefcase':
		var code='&#128188;'
		break;
		case 'air':
		var code='&#128168;'
		break;
		case 'hourglass':
		var code='&#9203;'
		break;
		case 'gauge':
		var code='&#128711;'
		break;
		case 'language':
		var code='&#127892;'
		break;
		case 'network':
		var code='&#59254;'
		break;
		case 'key':
		var code='&#128273;'
		break;
		case 'battery':
		var code='&#128267;'
		break;
		case 'bucket':
		var code='&#128254;'
		break;
		case 'magnet':
		var code='&#59297;'
		break;
		case 'drive':
		var code='&#128253;'
		break;
		case 'cup':
		var code='&#9749;'
		break;
		case 'rocket':
		var code='&#128640;'
		break;
		case 'brush':
		var code='&#59290;'
		break;
		case 'suitcase':
		var code='&#128710;'
		break;
		case 'traffic-cone':
		var code='&#128712;'
		break;
		case 'globe':
		var code='&#127758;'
		break;
		case 'keyboard':
		var code='&#9000;'
		break;
		case 'browser':
		var code='&#59214;'
		break;
		case 'publish':
		var code='&#59213;'
		break;
		case 'progress-3':
		var code='&#59243;'
		break;
		case 'progress-2':
		var code='&#59242;'
		break;
		case 'progress-1':
		var code='&#59241;'
		break;
		case 'progress-0':
		var code='&#59240;'
		break;
		case 'light-down':
		var code='&#128261;'
		break;
		case 'light-up':
		var code='&#128262;'
		break;
		case 'adjust':
		var code='&#9681;'
		break;
		case 'code':
		var code='&#59156;'
		break;
		case 'monitor':
		var code='&#128187;'
		break;
		case 'infinity':
		var code='&infin;'
		break;
		case 'light-bulb':
		var code='&#128161;'
		break;
		case 'credit-card':
		var code='&#128179;'
		break;
		case 'database':
		var code='&#128248;'
		break;
		case 'voicemail':
		var code='&#9991;'
		break;
		case 'clipboard':
		var code='&#128203;'
		break;
		case 'cart':
		var code='&#59197;'
		break;
		case 'box':
		var code='&#128230;'
		break;
		case 'ticket':
		var code='&#127915;'
		break;
		case 'rss':
		var code='&#59194;'
		break;
		case 'signal':
		var code='&#128246;'
		break;
		case 'thermometer':
		var code='&#128255;'
		break;
		case 'water':
		var code='&#128166;'
		break;
		case 'sweden':
		var code='&#62977;'
		break;
		case 'line-graph':
		var code='&#128200;'
		break;
		case 'pie-chart':
		var code='&#9716;'
		break;
		case 'bar-graph':
		var code='&#128202;'
		break;
		case 'area-graph':
		var code='&#128318;'
		break;
		case 'lock':
		var code='&#128274;'
		break;
		case 'lock-open':
		var code='&#128275;'
		break;
		case 'logout':
		var code='&#59201;'
		break;
		case 'login':
		var code='&#59200;'
		break;
		case 'check':
		var code='&#10003;'
		break;
		case 'cross':
		var code='&#10060;'
		break;
		case 'squared-minus':
		var code='&#8863;'
		break;
		case 'squared-plus':
		var code='&#8862;'
		break;
		case 'squared-cross':
		var code='&#10062;'
		break;
		case 'circled-minus':
		var code='&#8854;'
		break;
		case 'circled-plus':
		var code='&oplus;'
		break;
		case 'circled-cross':
		var code='&#10006;'
		break;
		case 'minus':
		var code='&#10134;'
		break;
		case 'plus':
		var code='&#10133;'
		break;
		case 'erase':
		var code='&#9003;'
		break;
		case 'block':
		var code='&#128683;'
		break;
		case 'info':
		var code='&#8505;'
		break;
		case 'circled-info':
		var code='&#59141;'
		break;
		case 'help':
		var code='&#10067;'
		break;
		case 'circled-help':
		var code='&#59140;'
		break;
		case 'warning':
		var code='&#9888;'
		break;
		case 'cycle':
		var code='&#128260;'
		break;
		case 'cw':
		var code='&#10227;'
		break;
		case 'ccw':
		var code='&#10226;'
		break;
		case 'shuffle':
		var code='&#128256;'
		break;
		case 'back':
		var code='&#128281;'
		break;
		case 'level-down':
		var code='&#8627;'
		break;
		case 'retweet':
		var code='&#59159;'
		break;
		case 'loop':
		var code='&#128257;'
		break;
		case 'back-in-time':
		var code='&#59249;'
		break;
		case 'level-up':
		var code='&#8624;'
		break;
		case 'switch':
		var code='&#8646;'
		break;
		case 'numbered-list':
		var code='&#57349;'
		break;
		case 'add-to-list':
		var code='&#57347;'
		break;
		case 'layout':
		var code='&#9871;'
		break;
		case 'list':
		var code='&#9776;'
		break;
		case 'text-doc':
		var code='&#128196;'
		break;
		case 'text-doc-inverted':
		var code='&#59185;'
		break;
		case 'doc':
		var code='&#59184;'
		break;
		case 'docs':
		var code='&#59190;'
		break;
		case 'landscape-doc':
		var code='&#59191;'
		break;
		case 'picture':
		var code='&#127748;'
		break;
		case 'video':
		var code='&#127916;'
		break;
		case 'music':
		var code='&#127925;'
		break;
		case 'folder':
		var code='&#128193;'
		break;
		case 'archive':
		var code='&#59392;'
		break;
		case 'trash':
		var code='&#59177;'
		break;
		case 'upload':
		var code='&#128228;'
		break;
		case 'download':
		var code='&#128229;'
		break;
		case 'save':
		var code='&#128190;'
		break;
		case 'install':
		var code='&#59256;'
		break;
		case 'cloud':
		var code='&#9729;'
		break;
		case 'upload-cloud':
		var code='&#59153;'
		break;
		case 'bookmark':
		var code='&#128278;'
		break;
		case 'bookmarks':
		var code='&#128209;'
		break;
		case 'open-book':
		var code='&#128214;'
		break;
		case 'play':
		var code='&#9654;'
		break;
		case 'paus':
		var code='&#8214;'
		break;
		case 'record':
		var code='&#9679;'
		break;
		case 'stop':
		var code='&#9632;'
		break;
		case 'ff':
		var code='&#9193;'
		break;
		case 'fb':
		var code='&#9194;'
		break;
		case 'to-start':
		var code='&#9198;'
		break;
		case 'to-end':
		var code='&#9197;'
		break;
		case 'resize-full':
		var code='&#59204;'
		break;
		case 'resize-small':
		var code='&#59206;'
		break;
		case 'volume':
		var code='&#9207;'
		break;
		case 'sound':
		var code='&#128266;'
		break;
		case 'mute':
		var code='&#128263;'
		break;
		case 'flow-cascade':
		var code='&#128360;'
		break;
		case 'flow-branch':
		var code='&#128361;'
		break;
		case 'flow-tree':
		var code='&#128362;'
		break;
		case 'flow-line':
		var code='&#128363;'
		break;
		case 'flow-parallel':
		var code='&#128364;'
		break;
		case 'left-bold':
		var code='&#58541;'
		break;
		case 'down-bold':
		var code='&#58544;'
		break;
		case 'up-bold':
		var code='&#58543;'
		break;
		case 'right-bold':
		var code='&#58542;'
		break;
		case 'left':
		var code='&#11013;'
		break;
		case 'down':
		var code='&#11015;'
		break;
		case 'up':
		var code='&#11014;'
		break;
		case 'right':
		var code='&#10145;'
		break;
		case 'circled-left':
		var code='&#59225;'
		break;
		case 'circled-down':
		var code='&#59224;'
		break;
		case 'circled-up':
		var code='&#59227;'
		break;
		case 'circled-right':
		var code='&#59226;'
		break;
		case 'triangle-left':
		var code='&#9666;'
		break;
		case 'triangle-down':
		var code='&#9662;'
		break;
		case 'triangle-up':
		var code='&#9652;'
		break;
		case 'triangle-right':
		var code='&#9656;'
		break;
		case 'chevron-left':
		var code='&#59229;'
		break;
		case 'chevron-down':
		var code='&#59228;'
		break;
		case 'chevron-up':
		var code='&#59231;'
		break;
		case 'chevron-right':
		var code='&#59230;'
		break;
		case 'chevron-small-left':
		var code='&#59233;'
		break;
		case 'chevron-small-down':
		var code='&#59232;'
		break;
		case 'chevron-small-up':
		var code='&#59235;'
		break;
		case 'chevron-small-right':
		var code='&#59234;'
		break;
		case 'chevron-thin-left':
		var code='&#59237;'
		break;
		case 'chevron-thin-down':
		var code='&#59236;'
		break;
		case 'chevron-thin-up':
		var code='&#59239;'
		break;
		case 'chevron-thin-right':
		var code='&#59238;'
		break;
		case 'left-thin':
		var code='&larr;'
		break;
		case 'down-thin':
		var code='&darr;'
		break;
		case 'up-thin':
		var code='&uarr;'
		break;
		case 'right-thin':
		var code='&rarr;'
		break;
		case 'arrow-combo':
		var code='&#59215;'
		break;
		case 'three-dots':
		var code='&#9206;'
		break;
		case 'two-dots':
		var code='&#9205;'
		break;
		case 'dot':
		var code='&#9204;'
		break;
		case 'cc':
		var code='&#128325;'
		break;
		case 'cc-by':
		var code='&#128326;'
		break;
		case 'cc-nc':
		var code='&#128327;'
		break;
		case 'cc-nc-eu':
		var code='&#128328;'
		break;
		case 'cc-nc-jp':
		var code='&#128329;'
		break;
		case 'cc-sa':
		var code='&#128330;'
		break;
		case 'cc-nd':
		var code='&#128331;'
		break;
		case 'cc-pd':
		var code='&#128332;'
		break;
		case 'cc-zero':
		var code='&#128333;'
		break;
		case 'cc-share':
		var code='&#128334;'
		break;
		case 'cc-remix':
		var code='&#128335;'
		break;
		case 'db-logo':
		var code='&#128505;'
		break;
		case 'db-shape':
		var code='&#128506;'
		break;
		case 'github':
		var code='&#62208;'
		break;
		case 'c-github':
		var code='&#62209;'
		break;
		case 'flickr':
		var code='&#62211;'
		break;
		case 'c-flickr':
		var code='&#62212;'
		break;
		case 'vimeo':
		var code='&#62214;'
		break;
		case 'c-vimeo':
		var code='&#62215;'
		break;
		case 'twitter':
		var code='&#62217;'
		break;
		case 'c-twitter':
		var code='&#62218;'
		break;
		case 'facebook':
		var code='&#62220;'
		break;
		case 'c-facebook':
		var code='&#62221;'
		break;
		case 's-facebook':
		var code='&#62222;'
		break;
		case 'google+':
		var code='&#62223;'
		break;
		case 'c-google+':
		var code='&#62224;'
		break;
		case 'pinterest':
		var code='&#62226;'
		break;
		case 'c-pinterest':
		var code='&#62227;'
		break;
		case 'tumblr':
		var code='&#62229;'
		break;
		case 'c-tumblr':
		var code='&#62230;'
		break;
		case 'linkedin':
		var code='&#62232;'
		break;
		case 'c-linkedin':
		var code='&#62233;'
		break;
		case 'dribbble':
		var code='&#62235;'
		break;
		case 'c-dribbble':
		var code='&#62236;'
		break;
		case 'stumbleupon':
		var code='&#62238;'
		break;
		case 'c-stumbleupon':
		var code='&#62239;'
		break;
		case 'lastfm':
		var code='&#62241;'
		break;
		case 'c-lastfm':
		var code='&#62242;'
		break;
		case 'rdio':
		var code='&#62244;'
		break;
		case 'c-rdio':
		var code='&#62245;'
		break;
		case 'spotify':
		var code='&#62247;'
		break;
		case 'c-spotify':
		var code='&#62248;'
		break;
		case 'qq':
		var code='&#62250;'
		break;
		case 'instagram':
		var code='&#62253;'
		break;
		case 'dropbox':
		var code='&#62256;'
		break;
		case 'evernote':
		var code='&#62259;'
		break;
		case 'flattr':
		var code='&#62262;'
		break;
		case 'skype':
		var code='&#62265;'
		break;
		case 'c-skype':
		var code='&#62266;'
		break;
		case 'renren':
		var code='&#62268;'
		break;
		case 'sina-weibo':
		var code='&#62271;'
		break;
		case 'paypal':
		var code='&#62274;'
		break;
		case 'picasa':
		var code='&#62277;'
		break;
		case 'soundcloud':
		var code='&#62280;'
		break;
		case 'mixi':
		var code='&#62283;'
		break;
		case 'behance':
		var code='&#62286;'
		break;
		case 'google-circles':
		var code='&#62289;'
		break;
		case 'vk':
		var code='&#62292;'
		break;
		case 'smashing':
		var code='&#62295;'
		break;
		default:
		var code="none";
		break;
	}
	return ot_convert(code);
}

function ot_convert(str) {
  str = str.replace(/&/g, "&amp;");
  str = str.replace(/>/g, "&gt;");
  str = str.replace(/</g, "&lt;");
  str = str.replace(/"/g, "&quot;");
  str = str.replace(/'/g, "&#039;");
  return str;
}
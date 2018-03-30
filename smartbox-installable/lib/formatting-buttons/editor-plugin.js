/**
 * This file contains all the main JavaScript functionality needed for the editor formatting buttons.
 * 
 */

/**
 * Define all the formatting buttons with the HTML code they set.
 */
var desiganreButtons=[
		{
			id:'designaretitle',
			image:'heading.png',
			title:'Page Underlined Heading',
			allowSelection:true,
			fields:[{id:'text', name:'Title'}],
			generateHtml:function(text){
				return '<h1 class="page-heading">'+text+'</h1><hr/>&nbsp;';
			}
		},
		{
			id:'designaretitlesmall',
			image:'heading_small.png',
			title:'Small Underlined Heading',
			allowSelection:true,
			fields:[{id:'text', name:'Title'}],
			generateHtml:function(text){
			return '<h3 class="small-title">'+text+'</h3><hr/>&nbsp;';
			}
		},
        {
			id:'designarehighlight1',
			image:'hl.png',
			title:'Highlight',
			allowSelection:true,
			fields:[{id:'text', name:'Text'}],
			generateHtml:function(text){
				return '<span class="hihglight1">'+text+'</span>&nbsp;';
			}
		},
		{
			id:'designarehighlight2',
			image:'hl_d.png',
			title:'Highlight Dark',
			allowSelection:true,
			fields:[{id:'text', name:'Text'}],
			generateHtml:function(text){
				return '<span class="hihglight2">'+text+'</span>&nbsp;';
			}
		},
		{
			id:'designaredropcaps',
			image:'drop.png',
			title:'Drop Caps',
			allowSelection:true,
			fields:[{id:'letter', name:'Letter'}],
			generateHtml:function(letter){
				return '<span class="drop-caps">'+letter+'</span>';
			}
		},
		{
			id:'designarelistcheck',
			image:'check.png',
			title:'List Check',
			allowSelection:false,
			list:"bullet_check"
		},
		{
			id:'designarelistarrow',
			image:'arrow.png',
			title:'List Arrow',
			allowSelection:false,
			list:"bullet_arrow"
		},
		{
			id:'designarelistarrow2',
			image:'arrow2.png',
			title:'List Arrow 2',
			allowSelection:false,
			list:"bullet_arrow2"
		},
		{
			id:'designarelistarrow4',
			image:'arrow3.png',
			title:'List Arrow 4',
			allowSelection:false,
			list:"bullet_arrow4"
		},
		{
			id:'designareliststar',
			image:'star.png',
			title:'List Star',
			allowSelection:false,
			list:"bullet_star"
		},
		{
			id:'designarelistplus',
			image:'plus.png',
			title:'List Plus',
			allowSelection:false,
			list:"bullet_plus"
		},
		{
			id:'designarelinebreak',
			image:'br.png',
			title:'Line break',
			allowSelection:false,
			generateHtml:function(){
				return '<br class="clear" />';
			}
		},
		{
			id:'designareframe',
			image:'fr.png',
			title:'Image frame',
			allowSelection:false,
			fields:[{id:'src', name:'Image URL'},{id:'align', name:'Align', values:['none', 'left', 'right']}],
			generateHtml:function(obj){
				var imgclass=obj.align==='none'?'':'align'+obj.align;
				return '<img class="img-frame '+imgclass+'" src="'+obj.src+'" />';
			}
		},
		{
			id:'designarelightbox',
			image:'lb.png',
			title:'Lightbox image',
			allowSelection:false,
			fields:[{id:'src', name:'Thumbnail URL'}, {id:'href', name:'Preview Image URL'}, {id:'description', name:'Description'}, {id:'align', name:'Align', values:['none', 'left', 'right']}],
			generateHtml:function(obj){
			var imgclass=obj.align==='none'?'':'align'+obj.align;
				return '<div><a rel="lightbox" href="'+obj.href+'" title="'+obj.description+'"><img class="img-frame '+imgclass+'" src="'+obj.src+'" /></a></div>';
			}
		},
		{
			id:'designarebutton',
			image:'but.png',
			title:'Button',
			allowSelection:false,
			fields:[{id:'text', name:'Text'},{id:'href', name:'Link URL'},{id:'color', name:'Color', type:'colorpicker'}],
			generateHtml:function(obj){
				var style=obj.color?'style="background-color:'+obj.color+';"':'';
				return '<a class="button" '+style+' href="'+obj.href+'"><span>'+obj.text+'</span></a>';
			}
		},
		{
			id:'designareinfoboxes',
			image:'info.png',
			title:'Info Box',
			allowSelection:false,
			fields:[{id:'text', name:'Text'},{id:'type', name:'Type', values:['info', 'error', 'note', 'tip']}],
			generateHtml:function(obj){
				return '<br class="clear" /> <div class="'+obj.type+'-box">'+obj.text+'</div><br class="clear" />';
			}
		},
		{
			id:'designaretwocolumns',
			image:'col_2.png',
			title:'Two Columns',
			allowSelection:false,
			fields:[{id:'columnone', name:'Column One Content', textarea:true}, {id:'columntwo', name:'Column Two Content', textarea:true}],
			generateHtml:function(obj){
				return '<br class="clear" /><div class="columns-wrapper"><div class="two-columns">'+obj.columnone+'</div><div class="two-columns nomargin">'+obj.columntwo+'</div></div><br class="clear" />';
			}
		},
		{
			id:'designarethreecolumns',
			image:'col_3.png',
			title:'Three Columns',
			allowSelection:false,
			fields:[{id:'columnone', name:'Column One Content', textarea:true}, {id:'columntwo', name:'Column Two Content', textarea:true}, {id:'columnthree', name:'Column Three Content', textarea:true}],
			generateHtml:function(obj){
				return '<br class="clear" /><div class="columns-wrapper"><div class="three-columns">'+obj.columnone+'</div><div class="three-columns">'+obj.columntwo+'</div><div class="three-columns nomargin">'+obj.columnthree+'</div></div><br class="clear" />';
			}
		},
		{
			id:'designarefourcolumns',
			image:'col_4.png',
			title:'Four Columns',
			allowSelection:false,
			fields:[{id:'columnone', name:'Column One Content', textarea:true}, {id:'columntwo', name:'Column Two Content', textarea:true}, {id:'columnthree', name:'Column Three Content', textarea:true}, {id:'columnfour', name:'Column Four Content', textarea:true}],
			generateHtml:function(obj){
				return '<br class="clear" /><div class="columns-wrapper"><div class="four-columns">'+obj.columnone+'</div><div class="four-columns">'+obj.columntwo+'</div><div class="four-columns">'+obj.columnthree+'</div><div class="four-columns nomargin">'+obj.columnfour+'</div></div><br class="clear" />';
			}
		},
		{
			id:'designarepricingtable',
			image:'price.png',
			title:'Insert Pricing Table',
			allowSelection:false,
			fields:[{id:'rownumber', name:'Nuber of rows'},{id:'colnumber', name:'Number of columns'}, {id:'pricingrow', name:'Pricing row index <br>(the number of the <br /> row which will <br /> contain the prices, <br /> starting from 1)'}],
			generateHtml:function(obj){
				var html='<table class="pricing-table"><tbody>',
					rownumber=parseFloat(obj.rownumber),
					colnumber=parseFloat(obj.colnumber),
					pricingrow=parseFloat(obj.pricingrow);
				
				for(var i=0; i<rownumber; i++){
					var trclass='table-description';
					if(i==0){
						trclass='table-title';
					}
					if(i==pricingrow-1){
						trclass='table-price';
					}
					html+='<tr class="'+trclass+'">'
					for(var j=0; j<colnumber; j++){
						html+='<td> Text </td>';
					}
					html+='</tr>';
				}
				
				html+='</tbody></table>';
				return html;
			}
		},
		{
			id:'designareyoutube',
			image:'yt.png',
			title:'Insert YouTube Video',
			allowSelection:false,
			fields:[{id:'src', name:'Video URL'},{id:'width', name:'Width'},{id:'height', name:'Height'}],
			generateHtml:function(obj){
			   var vars = [], hash,
			   hashes = obj.src.slice(obj.src.indexOf('?') + 1).split('&');
			   for(var i = 0; i < hashes.length; i++)
			   {
			       hash = hashes[i].split('=');
			       vars.push(hash[0]);
			       vars[hash[0]] = hash[1];
			   }
			   var width=obj.width||500,
			   		height=obj.height||500;
			   
			   return '<iframe width="'+width+'" height="'+height+'" src="http://www.youtube.com/embed/'+vars['v']+'" frameborder="0" allowfullscreen></iframe>';
			}
		},
		{
			id:'designarevimeo',
			image:'vm.png',
			title:'Insert Vimeo Video',
			allowSelection:false,
			fields:[{id:'src', name:'Video URL'},{id:'width', name:'Width'},{id:'height', name:'Height'}],
			generateHtml:function(obj){
			var url=obj.src;

			url = url.split('//').pop();
			var videoId=url.split('/')[1];
			
			   var width=obj.width||500,
			   		height=obj.height||500;
			   
			   return '<iframe src="http://player.vimeo.com/video/'+videoId+'?title=0&amp;byline=0&amp;portrait=0" width="'+width+'" height="'+height+'" frameborder="0"></iframe>';
			}
		},
		{
			id:'designareflash',
			image:'fl.png',
			title:'Insert Flash',
			allowSelection:false,
			fields:[{id:'src', name:'Video URL'},{id:'width', name:'Width'},{id:'height', name:'Height'}],
			generateHtml:function(obj){
			 var width=obj.width||500,
		   		height=obj.height||500;
			return '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="'+width+'" HEIGHT="'+height+'" id="designare-flash" ALIGN=""><PARAM NAME=movie VALUE="'+obj.src+'"> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#333399> <EMBED src="'+obj.src+'" quality=high bgcolor=#333399 WIDTH="'+width+'" HEIGHT="'+height+'" NAME="designare-flash" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED> </OBJECT> ';
			}
		},
		{
			id: 'designareservicesballs',
			title: 'Services Balls',
			allowSelection: false,
			fields:[{id: 1}],
			generateHtml: function(obj){
				return '<div style="position: absolute; top:0px; left: 0px; width: 300px; height: 300px; background: red;">gretas</div>';
			}
		}
];

/**
 * Contains the main formatting buttons functionality.
 */
designareButtonManager={
	dialog:null,
	idprefix:'designare-shortcode-',
	ie:false,
	opera:false,
		
	/**
	 * Init the formatting button functionality.
	 */
	init:function(){
			
		var length=designareButtons.length;
		for(var i=0; i<length; i++){
		
			var btn = designareButtons[i];
			designareButtonManager.loadButton(btn);
		}
		
		if ( jQuery.browser.msie ) {
			designareButtonManager.ie=true;
		}
		
		if (jQuery.browser.opera){
			designareButtonManager.opera=true;
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
	                image : url+'/btnicons/'+btn.image,
	                onclick : function() {
			        	
			           var selection = ed.selection.getContent();
	                   if(btn.allowSelection && selection){
	                	   //modification via selection is allowed for this button and some text has been selected
	                	   selection = btn.generateHtml(selection);
	                	   ed.selection.setContent(selection);
	                   }else if(btn.fields){
	                	   //there are inputs to fill in, show a dialog to fill the required data
	                	   designareButtonManager.showDialog(btn, ed);
	                   }else if(btn.list){
	  	           			
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
		               			dom.addClass(list, 'imglist');
		               		}
	                   }else{
	                	   //no data is required for this button, insert the generated HTML
	                	   ed.execCommand('mceInsertContent', true, btn.generateHtml());
	                   }
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

		
		if(designareButtonManager.ie){
			ed.dom.remove('designarecaret');
		    var caret = '<div id="designarecaret">&nbsp;</div>';
		    ed.execCommand('mceInsertContent', false, caret);	
			var selection = ed.selection;
		}
	    
		var html='<div>';
		for(var i=0, length=btn.fields.length; i<length; i++){
			var field=btn.fields[i], inputHtml='';
			if(btn.fields[i].values){
				//this is a select list
				inputHtml='<select id="'+designareButtonManager.idprefix+btn.fields[i].id+'">';
				jQuery.each(btn.fields[i].values, function(index, value){
					inputHtml+='<option value="'+value+'">'+value+'</option>';
				});
				inputHtml+='</select>';
			}else{
				if(btn.fields[i].textarea && !designareButtonManager.opera){
					//this field should be a text area
					inputHtml='<textarea id="'+designareButtonManager.idprefix+btn.fields[i].id+'" ></textarea>';
				}else{
					var inputClass=btn.fields[i].type==='colorpicker'?' class="color"':'';
					inputHtml='<input type="text" id="'+designareButtonManager.idprefix+btn.fields[i].id+'" '+inputClass+'/>';
				}
			}
			html+='<div class="designare-shortcode-field"><label>'+btn.fields[i].name+'</label>'+inputHtml+'</div>';
		}
		html+='<a href="" id="insertbtn" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Insert</span></a></div>';
				
		var dialog = jQuery(html).dialog({
							 title:btn.title, 
							 modal:true,
							 close:function(event, ui){
								jQuery(this).html('').remove();
							 },
							 create:function(){
								 designarePageOptions.setColorPickerFunc();
							 }
							 });
		
		designareButtonManager.dialog=dialog;
		
		//set a click handler to the insert button
		dialog.find('#insertbtn').click(function(event){
			event.preventDefault();
			designareButtonManager.executeCommand(ed,btn,selection);
		});
	},
	
	/**
	 * Executes a command when the insert button has been clicked.
	 */
	executeCommand:function(ed, btn, selection){

    		var values={}, html='';
    		
    		if(!btn.allowSelection){
    			//the button doesn't allow selection, generate the values as an object literal
	    		for(var i=0, length=btn.fields.length; i<length; i++){
	        		var id=btn.fields[i].id,
	        			value=jQuery('#'+designareButtonManager.idprefix+id).val();
	        		
	    			values[id]=value;
	    		}
	    		html = btn.generateHtml(values);
    		}else{
    			//the button allows selection - only one value is needed for the formatting, so
    			//return this value only (not an object literal)
    			value = jQuery('#'+designareButtonManager.idprefix+btn.fields[0].id).attr("value")
    			html = btn.generateHtml(value);
    		}
    		
    	designareButtonManager.dialog.remove();

    	if(designareButtonManager.ie){
	    	selection.select(ed.dom.select('div#designarecaret')[0], false);
	    	ed.dom.remove('designarecaret');
    	}

  		ed.execCommand('mceInsertContent', false, html);
    	
	}
};

/**
 * Init the formatting functionality.
 */
(function() {
	
	designareButtonManager.init();
    
})();


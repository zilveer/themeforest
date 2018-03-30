/**
 * This file contains all the main JavaScript functionality needed for the editor formatting buttons.
 * 
 * @author Pexeto
 * http://pexeto.com
 */

/**
 * Define all the formatting buttons with the HTML code they set.
 */
var pexetoButtons=[	
		{
			id:'pexetohighlight1',
			image:'hl.png',
			title:'Highlight',
			allowSelection:true,
			fields:[{id:'text', name:'Text'}],
			generateHtml:function(text){
				return '<span class="hihglight1">'+text+'</span>&nbsp;';
			}
		},
		{
			id:'pexetohighlight2',
			image:'hl_d.png',
			title:'Highlight Dark',
			allowSelection:true,
			fields:[{id:'text', name:'Text'}],
			generateHtml:function(text){
				return '<span class="hihglight2">'+text+'</span>&nbsp;';
			}
		},
		{
			id:'pexetodropcaps',
			image:'drop.png',
			title:'Drop Caps',
			allowSelection:true,
			fields:[{id:'letter', name:'Letter'}],
			generateHtml:function(letter){
				return '<span class="drop-caps">'+letter+'</span>';
			}
		},
		{
			id:'pexetolistcheck',
			image:'check.png',
			title:'List Check',
			allowSelection:false,
			list:"bullet_check"
		},
		{
			id:'pexetolistarrow',
			image:'arrow.png',
			title:'List Arrow',
			allowSelection:false,
			list:"bullet_arrow"
		},
		{
			id:'pexetolistarrow2',
			image:'arrow2.png',
			title:'List Arrow 2',
			allowSelection:false,
			list:"bullet_arrow2"
		},
		{
			id:'pexetolistarrow3',
			image:'arrow3.png',
			title:'List Arrow 3',
			allowSelection:false,
			list:"bullet_arrow3"
		},
		{
			id:'pexetolistarrow4',
			image:'arrow4.png',
			title:'List Arrow 4',
			allowSelection:false,
			list:"bullet_arrow4"
		},
		{
			id:'pexetoliststar',
			image:'star.png',
			title:'List Star',
			allowSelection:false,
			list:"bullet_star"
		},
		{
			id:'pexetolinebreak',
			image:'br.png',
			title:'Line break',
			allowSelection:false,
			generateHtml:function(){
				return '<br class="clear" />';
			}
		},
		{
			id:'pexetoframe',
			image:'fr.png',
			title:'Image frame',
			allowSelection:false,
			fields:[{id:'src', name:'Image URL'},{id:'align', name:'Align', values:['none', 'left', 'right']}],
			generateHtml:function(obj){
				var imgclass=obj.align==='none'?'':'align'+obj.align;
				return '<img class="shadow-frame '+imgclass+'" src="'+obj.src+'" />';
			}
		},
		{
			id:'pexetolightbox',
			image:'lb.png',
			title:'Lightbox image',
			allowSelection:false,
			fields:[{id:'src', name:'Thumbnail URL'}, {id:'href', name:'Preview Image URL'}, {id:'description', name:'Description'}, {id:'align', name:'Align', values:['none', 'left', 'right']}],
			generateHtml:function(obj){
			var imgclass=obj.align==='none'?'':'align'+obj.align;
				return '<div><a rel="lightbox" href="'+obj.href+'" title="'+obj.description+'"><img class="shadow-frame '+imgclass+'" src="'+obj.src+'" /></a></div>';
			}
		},
		{
			id:'pexetobutton',
			image:'but.png',
			title:'Button',
			allowSelection:false,
			fields:[{id:'text', name:'Text'},{id:'href', name:'Link URL'},{id:'style', name:'Style', values:['standard', 'small']}],
			generateHtml:function(obj){
				var buttonClass=obj.style==='standard'?'button':'button-small';
				return '<a class="'+buttonClass+'" href="'+obj.href+'"><span>'+obj.text+'</span></a>';
			}
		},
		{
			id:'pexetoinfoboxes',
			image:'info.png',
			title:'Info Box',
			allowSelection:false,
			fields:[{id:'text', name:'Text'},{id:'type', name:'Type', values:['info', 'error', 'note', 'tip']}],
			generateHtml:function(obj){
				return '<br class="clear" /> <div class="'+obj.type+'_box">'+obj.text+'</div><br class="clear" />';
			}
		},
		{
			id:'pexetotwocolumns',
			image:'col_2.png',
			title:'Two Columns',
			allowSelection:false,
			fields:[{id:'columnone', name:'Column One Content', textarea:true}, {id:'columntwo', name:'Column Two Content', textarea:true}],
			generateHtml:function(obj){
				return '<br class="clear" /><div class="columns-wrapper"><div class="two-columns">'+obj.columnone+'</div><div class="two-columns nomargin">'+obj.columntwo+'</div></div><br class="clear" />';
			}
		},
		{
			id:'pexetothreecolumns',
			image:'col_3.png',
			title:'Three Columns',
			allowSelection:false,
			fields:[{id:'columnone', name:'Column One Content', textarea:true}, {id:'columntwo', name:'Column Two Content', textarea:true}, {id:'columnthree', name:'Column Three Content', textarea:true}],
			generateHtml:function(obj){
				return '<br class="clear" /><div class="columns-wrapper"><div class="three-columns">'+obj.columnone+'</div><div class="three-columns">'+obj.columntwo+'</div><div class="three-columns nomargin">'+obj.columnthree+'</div></div><br class="clear" />';
			}
		},
		{
			id:'pexetofourcolumns',
			image:'col_4.png',
			title:'Four Columns',
			allowSelection:false,
			fields:[{id:'columnone', name:'Column One Content', textarea:true}, {id:'columntwo', name:'Column Two Content', textarea:true}, {id:'columnthree', name:'Column Three Content', textarea:true}, {id:'columnfour', name:'Column Four Content', textarea:true}],
			generateHtml:function(obj){
				return '<br class="clear" /><div class="columns-wrapper"><div class="four-columns">'+obj.columnone+'</div><div class="four-columns">'+obj.columntwo+'</div><div class="four-columns">'+obj.columnthree+'</div><div class="four-columns nomargin">'+obj.columnfour+'</div></div><br class="clear" />';
			}
		}
];

/**
 * Contains the main formatting buttons functionality.
 */
pexetoButtonManager={
	dialog:null,
	idprefix:'pexeto-shortcode-',
	ie:false,
	opera:false,
		
	/**
	 * Init the formatting button functionality.
	 */
	init:function(){
			
		var length=pexetoButtons.length;
		for(var i=0; i<length; i++){
		
			var btn = pexetoButtons[i];
			pexetoButtonManager.loadButton(btn);
		}
		
		if ( jQuery.browser.msie ) {
			pexetoButtonManager.ie=true;
		}
		
		if (jQuery.browser.opera){
			pexetoButtonManager.opera=true;
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
	                	   pexetoButtonManager.showDialog(btn, ed);
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

		
		if(pexetoButtonManager.ie){
			ed.dom.remove('pexetocaret');
		    var caret = '<div id="pexetocaret">&nbsp;</div>';
		    ed.execCommand('mceInsertContent', false, caret);	
			var selection = ed.selection;
		}
	    
		var html='<div>';
		for(var i=0, length=btn.fields.length; i<length; i++){
			var field=btn.fields[i], inputHtml='';
			if(btn.fields[i].values){
				//this is a select list
				inputHtml='<select id="'+pexetoButtonManager.idprefix+btn.fields[i].id+'">';
				jQuery.each(btn.fields[i].values, function(index, value){
					inputHtml+='<option value="'+value+'">'+value+'</option>';
				});
				inputHtml+='</select>';
			}else{
				if(btn.fields[i].textarea && !pexetoButtonManager.opera){
					//this field should be a text area
					inputHtml='<textarea id="'+pexetoButtonManager.idprefix+btn.fields[i].id+'" ></textarea>';
				}else{
					//this field should be a normal input
					inputHtml='<input type="text" id="'+pexetoButtonManager.idprefix+btn.fields[i].id+'" />';
				}
			}
			html+='<div class="pexeto-shortcode-field"><label>'+btn.fields[i].name+'</label>'+inputHtml+'</div>';
		}
		html+='<a href="" id="insertbtn" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button"><span class="ui-button-text">Insert</span></a></div>';
				
		var dialog = jQuery(html).dialog({
							 title:btn.title, 
							 dialogClass : 'page-dialog pexeto-dialog',
							 modal:true,
							 close:function(event, ui){
								jQuery(this).html('').remove();
							 }
							 });
		
		pexetoButtonManager.dialog=dialog;
		
		//set a click handler to the insert button
		dialog.find('#insertbtn').click(function(event){
			event.preventDefault();
			pexetoButtonManager.executeCommand(ed,btn,selection);
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
	        			value=jQuery('#'+pexetoButtonManager.idprefix+id).val();
	        		
	    			values[id]=value;
	    		}
	    		html = btn.generateHtml(values);
    		}else{
    			//the button allows selection - only one value is needed for the formatting, so
    			//return this value only (not an object literal)
    			value = jQuery('#'+pexetoButtonManager.idprefix+btn.fields[0].id).attr("value")
    			html = btn.generateHtml(value);
    		}
    		
    	pexetoButtonManager.dialog.remove();

    	if(pexetoButtonManager.ie){
	    	selection.select(ed.dom.select('div#pexetocaret')[0], false);
	    	ed.dom.remove('pexetocaret');
    	}

  		ed.execCommand('mceInsertContent', false, html);
    	
	}
};

/**
 * Init the formatting functionality.
 */
(function() {
	
	pexetoButtonManager.init();
    
})();


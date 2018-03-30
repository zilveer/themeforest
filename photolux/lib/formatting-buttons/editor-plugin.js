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
			id:'pexetotitle',
			image:'heading.png',
			title:'Page Underlined Heading',
			allowSelection:true,
			fields:[{id:'text', name:'Heading Text'}],
			generateHtml:function(text){
				return '<h1 class="page-heading">'+text+'</h1><span class="double-line">&nbsp;</span>&nbsp;';
			}
		},
        {
			id:'pexetohighlight1',
			image:'hl.png',
			title:'Highlight',
			allowSelection:true,
			fields:[{id:'text', name:'Text'}],
			generateHtml:function(text){
				return '<span class="highlight1">'+text+'</span>&nbsp;';
			}
		},
		{
			id:'pexetohighlight2',
			image:'hl_d.png',
			title:'Highlight Dark',
			allowSelection:true,
			fields:[{id:'text', name:'Text'}],
			generateHtml:function(text){
				return '<span class="highlight2">'+text+'</span>&nbsp;';
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
			id:'pexetolistarrow4',
			image:'arrow3.png',
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
			id:'pexetolistplus',
			image:'plus.png',
			title:'List Plus',
			allowSelection:false,
			list:"bullet_plus"
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
			title:'Image with shadow',
			allowSelection:false,
			fields:[{id:'src', name:'Image URL', type:'upload'},{id:'align', name:'Align', values:['none', 'left', 'right']}],
			generateHtml:function(obj){
				var imgclass=obj.align==='none'?'':'align'+obj.align;
				return '<img class="img-frame '+imgclass+'" src="'+obj.src+'" />';
			}
		},
		{
			id:'pexetolightbox',
			image:'lb.png',
			title:'Lightbox image',
			allowSelection:false,
			fields:[{id:'src', name:'Thumbnail URL', type:'upload'}, {id:'href', name:'Preview Image URL', type:'upload'}, {id:'description', name:'Description'}, {id:'align', name:'Align', values:['none', 'left', 'right']}],
			generateHtml:function(obj){
			var imgclass=obj.align==='none'?'':'align'+obj.align;
				return '<div><a rel="lightbox" class="lightbox-image" href="'+obj.href+'" title="'+obj.description+'"><img class="img-frame '+imgclass+'" src="'+obj.src+'" /></a></div>';
			}
		},
		{
			id:'pexetobutton',
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
			id:'pexetoinfoboxes',
			image:'info.png',
			title:'Info Box',
			allowSelection:false,
			fields:[{id:'text', name:'Text'},{id:'type', name:'Type', values:['info', 'error', 'note', 'tip']}],
			generateHtml:function(obj){
				return '<br class="clear" /> <div class="'+obj.type+'-box">'+obj.text+'</div><br class="clear" />';
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
		},
		{
			id:'pexetoyoutube',
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
			   
			   return '<div class="post-video"><iframe width="'+width+'" height="'+height+'" src="http://www.youtube.com/embed/'+vars['v']+'" frameborder="0" allowfullscreen></iframe></div><br class="clear" />';
			}
		},
		{
			id:'pexetovimeo',
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
			   
			   return '<div class="post-video"><iframe src="http://player.vimeo.com/video/'+videoId+'?title=0&amp;byline=0&amp;portrait=0" width="'+width+'" height="'+height+'" frameborder="0"></iframe></div><br class="clear" />';
			}
		},
		{
			id:'pexetoflash',
			image:'fl.png',
			title:'Insert Flash',
			allowSelection:false,
			fields:[{id:'src', name:'Video URL'},{id:'width', name:'Width'},{id:'height', name:'Height'}],
			generateHtml:function(obj){
			 var width=obj.width||500,
		   		height=obj.height||500;
			return '<div class="post-video"><OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="'+width+'" HEIGHT="'+height+'" id="pexeto-flash" ALIGN=""><PARAM NAME=movie VALUE="'+obj.src+'"> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#333399> <EMBED src="'+obj.src+'" quality=high bgcolor=#333399 WIDTH="'+width+'" HEIGHT="'+height+'" NAME="pexeto-flash" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED> </OBJECT></div>';
			}
		},
		{
			id:'pexetotestimonials',
			image:'testimonials.png',
			title:'Insert Testimonial',
			allowSelection:false,
			fields:[{id:'name', name:'Person Name'},{id:'img', name:'Person Image URL', type:'upload'},{id:'occup', name:'Occupation'},{id:'org', name:'Organization'},{id:'link', name:'Organization Link'}, {id:'testim', name:'Testimonial', textarea:true}],
			generateHtml:function(obj){
			var shortcode='[pextestim name="'+obj.name+'"';
			if(obj.img){
				shortcode+=' img="'+obj.img+'"';
			}
			if(obj.occup){
				shortcode+=' occup="'+obj.occup+'"';
			}
			if(obj.org){
				shortcode+=' org="'+obj.org+'"';
			}
			if(obj.link){
				shortcode+=' link="'+obj.link+'"';
			}
			shortcode+=']'+obj.testim+'[/pextestim]'
			
			return shortcode;
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
		
		if (navigator.userAgent.toLowerCase().indexOf('msie') > -1){
			pexetoButtonManager.ie=true;
		}

		if (navigator.userAgent.toLowerCase().indexOf('opera') > -1){
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
					var inputClass="";
					if(btn.fields[i].type==='colorpicker'){
						inputClass="color";
					}else if(btn.fields[i].type==='upload'){
						inputClass="pexeto-upload";
					}
					inputHtml='<input type="text" id="'+pexetoButtonManager.idprefix+btn.fields[i].id+'" class="'+inputClass+'" />';
					if(btn.fields[i].type==='upload'){
						inputHtml+='<input type="button" class="pexeto-upload-btn button-secondary" value="Select Image" />';
					}
				}
			}
			html+='<div class="pexeto-shortcode-field"><label>'+btn.fields[i].name+'</label>'+inputHtml+'</div>';
		}
		html+='<input type="button" id="insertbtn" class="button-primary alignright" value="Insert" /></div>';
				
		var dialog = jQuery(html).dialog({
							 title:btn.title, 
							 modal:false,
							 dialogClass:'pexeto-dialog',
							 width:500,
							 close:function(event, ui){
								jQuery(this).html('').remove();
							 },
							 create:function(){
								 //load the color picker functionality
								 pexetoPageOptions.setColorPickerFunc();
								 //load the Upload button functionality
								 var uploadBtns = jQuery(this).find('.pexeto-upload-btn');
								 if(uploadBtns.length){
									 uploadBtns.each(function(){
										pexetoPageOptions.loadUploader(jQuery(this));
									});
								 }
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


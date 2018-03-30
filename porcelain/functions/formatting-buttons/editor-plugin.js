/**
 * This file contains all the main JavaScript functionality needed for the editor formatting buttons.
 * 
 * @author Pexeto
 * http://pexetothemes.com
 */

if(!PEXETO){
	var PEXETO = {};
}

(function($){

PEXETO.tinymce = {};

PEXETO.tinymce.btnImageUri = PEXETO.theme_uri+'/functions/formatting-buttons/btnicons/';


/**
 * Define all the formatting buttons with the HTML code they set.
 */
PEXETO.tinymce.buttons=[
		{
			id:'pexetotitle',
			image:'heading.png',
			title:'Page Underlined Heading',
			allowSelection:true,
			fields:[{id:'text', name:'Heading Text'}],
			generateHtml:function(text){
				return '<h2 class="page-heading">'+text+'</h2>';
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
			title:'List Circle',
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
			title:'Insert Image',
			allowSelection:false,
			fields:[{id:'src', name:'Image URL', type:'upload'},
					{id:'align', name:'Align', values:['none', 'left', 'right', 'center']},
					{id:'width', name:'Display width in pixels (optional)'}],
			generateHtml:function(obj){
				var imgclass=obj.align==='none'?'':'align'+obj.align,
					width = obj.width ? ' width="'+obj.width+'"':'';
					
				return '<img class="img-frame '+imgclass+'" src="'+obj.src+'"'+width+' />';
			}
		},
		{
			id:'pexetolightbox',
			image:'lb.png',
			title:'Lightbox image',
			allowSelection:false,
			fields:[{id:'src', name:'Thumbnail URL', type:'upload'}, 
				{id:'href', name:'Preview Image URL', type:'upload'}, 
				{id:'description', name:'Description'}, 
				{id:'align', name:'Align', values:['none', 'left', 'right']},
				{id:'width', name:'Display width in pixels (optional)'}],
			generateHtml:function(obj){
			var imgclass=obj.align==='none'?'':'align'+obj.align,
				width = obj.width ? ' width="'+obj.width+'"':'';
				return '<div><a rel="lightbox" class="lightbox-image" href="'+obj.href+'" title="'+obj.description+'"><img class="img-frame '+imgclass+'"'+width+' src="'+obj.src+'" /></a></div>';
			}
		},
		{
			id:'pexetobutton',
			image:'but.png',
			title:'Button',
			allowSelection:false,
			fields:[{id:'text', name:'Text'},
				{id:'href', name:'Link URL'},
				{id:'color', name:'Color', type:'colorpicker'}],
			generateHtml:function(obj){
				var style=obj.color?'style="background-color:#'+obj.color+';"':'';
				return '<a class="button" '+style+' href="'+obj.href+'"><span>'+obj.text+'</span></a>';
			}
		},
		{
			id:'pexetoinfoboxes',
			image:'info.png',
			title:'Info Box',
			allowSelection:false,
			fields:[{id:'text', name:'Text'},
				{id:'type', name:'Type', values:['info', 'error', 'note', 'tip']}],
			generateHtml:function(obj){
				return '<br class="clear" /> <div class="'+obj.type+'-box"><span class="box-icon">&nbsp;</span>'+obj.text+'</div>&nbsp;<br class="clear" />';
			}
		},
		{
			id:'pexetotwocolumns',
			image:'col_2.png',
			title:'Two Columns',
			allowSelection:false,
			generateHtml:function(obj){
				return '<br class="clear" /><div class="cols-wrapper cols-2"><div class="col"><p>'+
				'&nbsp;text</p></div><div class="col nomargin"><p>'+
				'&nbsp;text</p></div></div>&nbsp;<br class="clear" />';
			}
		},
		{
			id:'pexetothreecolumns',
			image:'col_3.png',
			title:'Three Columns',
			allowSelection:false,
			generateHtml:function(obj){
				return '<br class="clear" /><div class="cols-wrapper cols-3"><div class="col"><p>'+
				'&nbsp;text</p></div><div class="col"><p>'+
				'&nbsp;text</p></div><div class="col nomargin"><p>'+
				'&nbsp;text</p></div></div>&nbsp;<br class="clear" />';
			}
		},
		{
			id:'pexetofourcolumns',
			image:'col_4.png',
			title:'Four Columns',
			allowSelection:false,
			generateHtml:function(obj){
				return '<br class="clear" /><div class="cols-wrapper cols-4"><div class="col"><p>'+
				'&nbsp;text</p></div><div class="col"><p>'+
				'&nbsp;text</p></div><div class="col"><p>'+
				'&nbsp;text</p></div><div class="col nomargin"><p>'+
				'&nbsp;text</p></div></div>&nbsp;<br class="clear" />';
			}
		},
		{
			id:'pexetoyoutube',
			image:'yt.png',
			title:'YouTube Video',
			allowSelection:false,
			fields:[{id:'src', name:'Video URL'}],
			visual:{'shortcode':'pexyoutube', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){

			   obj.width=500;
			   
			  return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		},
		{
			id:'pexetovimeo',
			image:'vm.png',
			title:'Vimeo Video',
			allowSelection:false,
			fields:[{id:'src', name:'Video URL'}],
			visual:{'shortcode':'pexvimeo', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){
				obj.width=500;
				   
				return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		},
		{
			id:'pexetoflash',
			image:'fl.png',
			title:'Flash Video',
			allowSelection:false,
			fields:[{id:'src', name:'Video URL'},
				{id:'width', name:'Width'}],
			visual:{'shortcode':'pexflash', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){
				obj.width=obj.width||500;
				   
				return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		},
		{
			id:'pexetotestimonials',
			image:'testimonials.png',
			title:'Testimonial Slider',
			allowSelection:false,
			fields:[{id:'set', name:'Select testimonials set', values:PEXETO.testimonials, desc:'You can create testimonials in '+PEXETO.themeName+' &raquo; Testimonials section.'},
				{id:'autoplay', name:'Autoplay', values: [{name:'Disabled', id:'false'},{name:'Enabled', id:'true'}]}],
			visual:{'shortcode':'pextestim', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){
				return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		},
		{
			id:'pexetoservices',
			image:'testimonials.png',
			title:'Services Boxes',
			allowSelection:false,
			fields:[{id:'set', name:'Select services set', values:PEXETO.servicesBoxes, desc:'You can create services sets in '+PEXETO.themeName+' &raquo; Services Boxes section.'},
					{id:'layout', name:'Services Layout', imgradio:true, values:[
						{id:'default', name:'Default Style', img:PEXETO.tinymce.btnImageUri+'services-default.png'},
						{id:'boxed-photo', name:'Boxed Photo Style', img:PEXETO.tinymce.btnImageUri+'services-photo.png'},
						{id:'boxed-icon', name:'Boxed Icon Style', img:PEXETO.tinymce.btnImageUri+'services-icon.png'},
						{id:'circle', name: 'Circle Style', hide:['columns'], img:PEXETO.tinymce.btnImageUri+'services-circle.png'}
					]},
					{id:'columns', name:'Number of columns', values:['2','3','4']},
					{id:'parallax', name:'Parallax animation on display', values:['disabled', 'enabled'], twocolumn:'first'},
					{id:'crop', name:'Automatic image cropping', values:['enabled', 'disabled'], twocolumn:'last'},
					{type:'subtitle', name:'Optional'},
					{id:'title', name:'Services Title'},
					{id:'desc', name:'Services Description', textarea:true},
					{id:'btntext', name:'Description Link Text', twocolumn:'first'},
					{id:'btnlink', name:'Description Link URL', twocolumn:'last'}],
			visual:{'shortcode':'pexservices', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){
				return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		},
		{
			id:'pexetocarousel',
			image:'testimonials.png',
			title:'Portfolio Carousel',
			allowSelection:false,
			fields:[{id:'cat', name:'Show items from portfolio category', values:PEXETO.portfolioCategories},
					{id:'title', name:'Title (optional)'},
					{id:'link', name:'More Projects Link (optional)', twocolumn:'first'},
					{id:'link_title', name:'More Projects Title (optional)', twocolumn:'last'},
					{id:'maxnum', name:'Maximum number of items'},
					{id:'orderby', name:'Order items by', values:[
						{name:'Date', id:'date'}, 
						{name:'Custom Order', id:'menu_order'}], twocolumn:'first'},
					{id:'order', name:'Order', values:[{name:'Descending', id:'DESC'}, {name:'Ascending', id:'ASC'}], twocolumn:'last'}
					],
			visual:{'shortcode':'pexcarousel', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){
				return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		},
		{
			id:'pexetonivoslider',
			image:'testimonials.png',
			title:'Nivo Slider',
			allowSelection:false,
			fields:[{id:'sliderid', name:'Name of slider', values:PEXETO.nivoSliders, desc:'You can create a Nivo slider in '+PEXETO.themeName+' &raquo; Nivo Slider section.'}],
			visual:{'shortcode':'pexnivoslider', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){
				return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		},
		{
			id:'pexetoposts',
			image:'testimonials.png',
			title:'Recent Blog Posts',
			allowSelection:false,
			fields:[{id:'title', name: 'Section title', twocolumn:'first'},
				{id:'cat', name:'Show posts from category', values:PEXETO.categories, twocolumn:'last'},
				{id:'layout', name: 'Layout', twocolumn:'first', values:[
					{id: 'columns', name:'Columns Layout'},
					{id: 'list', name:'List Layout', hide:['columns']}
				]},
				{id:'number', name: 'Number of posts to display', twocolumn:'last'},
				{id:'columns', name: 'Number of columns', values:['2', '3', '4']}
			],
			visual:{'shortcode':'pexblogposts', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){
				return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		},
		{
			id:'pexcirclecta',
			image:'testimonials.png',
			title:'Circle Call To Action Section',
			allowSelection:false,
			fields:[{id:'small_title', name:'Small Title'},
				{id:'title', name:'Main title'},
				{id:'button_text', name:'Button Text', twocolumn:'first'},
				{id:'button_link', name:'Button Link', twocolumn:'last'}],
			visual:{'shortcode':'pexcirclecta', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){
				return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		},
		{
			id:'pexetopricing',
			image:'testimonials.png',
			title:'Pricing Table',
			allowSelection:false,
			fields:[{id:'set', name:'Select a pricing table', values:PEXETO.pricing, desc:'You can create pricing tables in '+PEXETO.themeName+' &raquo; Pricing Tables section.',  twocolumn:'first'},
			{id:'columns', name:'Number of columns', values:['3', '2', '4'], twocolumn:'last'},
			{id:'color', name:'Custom table color', type:'colorpicker', twocolumn:'first'},
			{id:'highlight_color', name:'Custom highlight color', type:'colorpicker', twocolumn:'last'}],
			visual:{'shortcode':'pexpricetable', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){
				return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		},
		{
			id:'pexetobgsection',
			image:'col_2.png',
			title:'Background Section',
			allowSelection:false,
			fields:[
				{id:'title', name:'Title', twocolumn:'first'},
				{id:'subtitle', name:'Subtitle', twocolumn:'last'},
				{id:'content', name:'Text', type:'wysiwyg'},
				{type:'subtitle', name:'Style Settings'},
				{id:'style', name:'Select a base style', imgradio:true, hideTitle:true, values:[
						{name:'Light Background', id:'section-light', img:PEXETO.tinymce.btnImageUri+'bg-style-light.png', defaults:{bgcolor:'9FD1B3', textcolor:'102119', titlecolor:'102119'}}, 
						{name:'Light Background 2', id:'section-light2', img:PEXETO.tinymce.btnImageUri+'bg-style-light2.png', defaults:{bgcolor:'c8e5e9', textcolor:'777777', titlecolor:'f76335'}},
						{name:'Light Background + Background Image', id:'section-light-bg', img:PEXETO.tinymce.btnImageUri+'bg-style-light-bg.png', defaults:{bgcolor:'b0deed', textcolor:'373737', titlecolor:'373737', imageopacity:'0.5'}},
						{name:'Dark Background', id:'section-dark', img:PEXETO.tinymce.btnImageUri+'bg-style-dark.png', defaults:{bgcolor:'2f2f2f', textcolor:'ffffff', titlecolor:'ffffff'}}, 
						{name:'Dark Background + Background Image', id:'section-dark-bg', img:PEXETO.tinymce.btnImageUri+'bg-style-dark-bg.png', defaults:{bgcolor:'3ca4cf', textcolor:'ffffff', titlecolor:'ffffff', imageopacity:'0.5'}},
						{name:'Custom', id:'section-custom', img:PEXETO.tinymce.btnImageUri+'bg-style-custom.png', defaults:{bgcolor:'', textcolor:'', titlecolor:''}}
					]},
				{id:'bgcolor', name:'Background Color', type:'colorpicker', twocolumn:'first'},
				{id:'image', name:'Background Image', type:'upload', twocolumn:'last'},
				{id:'imageopacity', name:'Background Image Opacity', values:['0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1'], twocolumn:'first'},
				{id:'bgimagestyle', name:'Background Image Style', values:[
					{'id':'static', 'name': 'Static'},
					{'id':'parallax-fixed', 'name':'Parallax Fixed'},
					{'id':'parallax-scroll', 'name':'Parallax Scroll'}
					], twocolumn:'last'},
				{id:'titlecolor', name:'Title Color', type:'colorpicker', twocolumn:'first'},
				{id:'textcolor', name:'Text Color', type:'colorpicker', twocolumn:'last'}],
			visual:{shortcode:'bgsection', img:PEXETO.tinymce.btnImageUri+'bg.png'},
			generateHtml:function(obj){
				return PEXETO.tinymce.buildShortcode(obj, this.fields, this.visual.shortcode);
			}
		}
			
],

PEXETO.tinymce.excludeDialogButtons = /(wp_more|fullscreen|undo|redo|wp_help|pexetobgsection|pexetonivoslider|charmap|pastetext|pasteword),?/g;

PEXETO.tinymce.opera = false;
PEXETO.tinymce.ie = false;
PEXETO.tinymce.attrPrefix = 'pex_attr_';


/**
 * Builds a shortcode from the given data and fields.
 * @param  {object} data          the shortcode data
 * @param  {object} fields        object containing all of the fields that the
 * shortcode supports
 * @param  {string} shortcodeName the name of the shortcode
 * @return {string}               the shortcode string
 */
PEXETO.tinymce.buildShortcode = function(data, fields, shortcodeName){
	var shortcode = '['+shortcodeName,
		prefix = PEXETO.tinymce.attrPrefix;

	//add the shortcode attributes
	_.each(fields, function(field){
		if(data[field.id] && field.id!=='content'){
			shortcode+=' '+prefix+field.id+'="'+data[field.id]+'"';
		}
	});

	//add an inner attribute which means that this is a shortcode within
	//another shortcode
	if(data.inner){
		shortcode+=' '+prefix+'inner="true"';
	}

	shortcode+=']';

	//add the shortcode content
	if(data.content){
		shortcode+=data.content;
	}

	shortcode+='[/'+shortcodeName+']';

	return shortcode;
};


/**
 * Button manager - main constructior. Contains the main functionality for 
 * adding new TinyMCE buttons and initializing the functionality for adding and 
 * editing content 
 * with these buttons
 * @param  {array} buttons array containing all of the buttons data, such as
 * fields, htmlGeneration function, etc.
 */
PEXETO.tinymce.btnManager=function(buttons){
	this.dialogs=[];
	this.idPrefix = 'pexeto-shortcode-';
	this.visualBtns = [];
	this.buttons = buttons;
	this.attrPrefix = PEXETO.tinymce.attrPrefix;
};

		
/**
 * Init the formatting button functionality.
 */
PEXETO.tinymce.btnManager.prototype.init=function(){
		
	var last = false,
		self = this,
		length=self.buttons.length,
		visualShortcodesArr = [];

	if (navigator.userAgent.toLowerCase().indexOf('msie') > -1){
		PEXETO.tinymce.ie=true;
	}

	if (navigator.userAgent.toLowerCase().indexOf('opera') > -1){
		PEXETO.tinymce.opera=true;
	}

	for(var i=0; i<length; i++){
		btn = self.buttons[i];

		if(btn.visual){
			//this is a shortcode button that is added as an image in the visual
			//content, add the buttons to the visual shortcode buttons array
			self.visualBtns.push(btn);
			visualShortcodesArr.push(btn.visual.shortcode);
			if(last){
				self.setEventHandlers();
			}
		}

		if(i===length-1){
			last = true;
		}
		
		this.loadButton(btn, last);
	}

	if(visualShortcodesArr.length){
		self.visualShortcodes = visualShortcodesArr.join('|');
	}


};

/**
 * Loads a button and sets the functionality that is executed when the button 
 * is clicked.
 * @param  {object} btn  the button object containing the button details, such
 * as fields, html generator function, etc.
 * @param  {boolean} last sets whether this is the last button from the button
 * set
 */
PEXETO.tinymce.btnManager.prototype.loadButton = function(btn, last){
	var self = this;

	tinymce.create('tinymce.plugins.'+btn.id, {

        init : function(ed, url) {

			self.ed = ed;

			if(last){
				self.setEventHandlers();
			}

	        ed.addButton(btn.id, {
                title : btn.title,
                
				onclick : function() {

					var selection = ed.selection.getContent();
						if(btn.allowSelection && selection){
						//modification via selection is allowed for this button and some text has been selected
						selection = btn.generateHtml(selection);
						ed.selection.setContent(selection);
					}else if(btn.fields){
						//there are inputs to fill in, show a dialog to fill the required data
						self.showDialog(btn, ed);
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
};


/**
 * Registers event handlers mainly for the visual shortcode functionality.
 */
PEXETO.tinymce.btnManager.prototype.setEventHandlers = function(){
	var self = this,
		ed = self.ed;


		if(self.visualBtns.length){

			//replace the shortcode with image
			ed.onBeforeSetContent.add(function(ed, o) {
				o.content = self.replaceShortcodeWithImg(o.content, ed);
			});

			//replace the shortcode with image
			ed.onExecCommand.add(function(ed, cmd) {
			    if (cmd ==='mceInsertContent'){
					tinyMCE.activeEditor.setContent( self.replaceShortcodeWithImg(tinyMCE.activeEditor.getContent(), ed) );
				}
			});

			//replace the image back to shortcode on save
			ed.onPostProcess.add(function(ed, o) {
				//remove the tooltips if any has been added to the content and not removed
				o.content = o.content.replace(/<div class="pex-tooltip".+?<\/div>/g, '');

				if (o.get){
					o.content = self.replaceImgWithShortcode(o.content);
				}


			});

			self.initEditFunctionality(ed);

			ed.onInit.add(self.setButtonVisibility);

		}
	
};

/**
 * Replaces a shortcode with an image. The shortcode needs to be registered
 * as a visual shortcode (a "visual" property containing the shortcode has to be 
 * set to the button object)
 * @param  {string} co the editor content
 * @param  {ed} ed the current editor object
 * @return {string}    the editor content with the shortcode replaced with an
 * image. Shortcodes within shortcodes (with the inner attribute set) are not
 * replaced in the main content editor.
 */
PEXETO.tinymce.btnManager.prototype.replaceShortcodeWithImg=function(co, ed){
	var self = this,
		matches, rg;

	//build the regular expression, if it is a content editor and the shortcode
	//has the inner attribute set, do not replace this shortcode as its parent
	//shortcode will be replaced
	rg = ed.id==='content'?
		new RegExp('\\[('+self.visualShortcodes+')(?![^\\]]*'+self.attrPrefix+'inner)([^\\]]*)\\]((.|[\\r\\n])*?)\\[\/\\1]', 'g') :
		new RegExp('\\[('+self.visualShortcodes+')([^\\]]*)\\]((.|[\\r\\n])*?)\\[\/\\1]', 'g');


	return co.replace(rg, function(match, shortcode, attr, content){
		content = $.trim(content);
		var len = content.length,
			btn = _.find(self.visualBtns, function(currentBtn){
				return currentBtn.visual.shortcode===shortcode;
			});


		var dataContent = content ? ' data-pexcontent="'+tinymce.DOM.encode(content)+'"' : '',
			dataShortcode = ' data-shortcode="'+btn.visual.shortcode+'"';
		return '<p><img src="'+btn.visual.img+'"'+dataContent+dataShortcode+' class="pexeto-edit-image mceItem image-'+btn.visual.shortcode+'" data-atts="'+tinymce.DOM.encode(attr)+'" data-mce-placeholder="1" data-mce-resize="false" /></p>';
	});
	
};

/**
 * Escapes the inner quotes within inner shortcode attributes. For example, the
 * following content:
 * test [bgsection pex_attr_text="this is "some" text here"][/bgsection] text
 * will be converted to:
 * test [bgsection pex_attr_text="this is &quot;some&quot; text here"][/bgsection] text
 * @param  {string} co the content that will be searched for inner shortcodes
 * @return {string}    the content with escaped quotes within its attributes
 */
PEXETO.tinymce.btnManager.prototype.escapeInnerShortcodeQuotes = function(co){
	var self = this,
		match,
		rg = new RegExp('\\[('+self.visualShortcodes+')([^\\]]*)\\][^]*?\\[\/\\1]', 'g');

		return co.replace(rg, function(match, shortcode, attr){
			var escapedAttr = ' '+self.escapeAttrStrInnerQuotes(attr);
			return match.replace(attr, escapedAttr);
		});
	
};

/**
 * Replaces an image with a shortcode. The images that represent the shortcodes
 * in the visual editor are replaced back to shortcodes when the Text tab is 
 * opened or on content save.
 * @param  {string} co the content that will be searched for image shortcodes
 * and that will be replaced
 * @return {string}    the replaced content
 */
PEXETO.tinymce.btnManager.prototype.replaceImgWithShortcode=function(co){
	var self = this,
		getAttr = function(s, n) {
		var attsString, res;
		n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
		return n ? tinymce.DOM.decode(n[1]) : '';
	};

	return co.replace(/(?:<p[^>]*>)*(<img[^>]+>)(?:<\/p>)*/g, function(a,im) {
		var cls = getAttr(im, 'class'),
			content = tinymce.trim(getAttr(im, 'data-pexcontent')),
			len = content.length;

		if(content.indexOf('<p>')===0 && content.indexOf('</p>')===len-4){
		//remove surrounding p tags
		   content = content.slice(3,len-4);
		}

		content = self.escapeInnerShortcodeQuotes(content);

		if ( cls.indexOf('pexeto-edit-image') != -1 ){
			return '<p>['+tinymce.trim(getAttr(im, 'data-shortcode'))+' '+self.escapeAttrStrInnerQuotes(tinymce.trim(getAttr(im, 'data-atts')))+']'+content+'[/'+getAttr(im, 'data-shortcode')+']</p>';
		}


		return a;
	});
};

/**
 * Inits a dialog that contains fields for inserting the data needed for the 
 * button.
 * @param  {object} btn the button object
 * @param  {ed} ed  the editor object
 */
PEXETO.tinymce.btnManager.prototype.showDialog=function(btn, ed){
	var formBuilder, $el, dialog, caret, selection,
		self = this;
	if(PEXETO.tinymce.ie){
		ed.dom.remove('pexetocaret');
	    caret = '<div id="pexetocaret">&nbsp;</div>';
	    ed.execCommand('mceInsertContent', false, caret);	
		selection = ed.selection;
	}

	//build the dialog form containing the fields
	formBuilder = new PEXETO.tinymce.formBuilder(btn, self.idPrefix, null);
	$el = formBuilder.getFormElement();
			
	dialog = new PEXETO.tinymce.dialog(btn, ed, function(){
			self.executeCommand(ed, btn);
		}, $el, function(){
		return formBuilder.initElements();
	}, false, function(){
		self.removeDialog();
	});
	dialog.init();

	self.dialogs.push(dialog);

};

PEXETO.tinymce.btnManager.prototype.removeDialog = function(){
	var self = this;
	self.dialogs.pop().remove();
};

/**
 * Retrieves the dialog input values.
 * @param  {object} btn   the button object
 * @param  {boolean} inner sets if it is an inner dialog
 * @return {object}       object containing all of the input values of the
 * registered button fields.
 */
PEXETO.tinymce.btnManager.prototype.getInputsValue = function(btn, inner){
	var values={}, value, html='',
	self = this;

	if(!btn.allowSelection){
		//the button doesn't allow selection, generate the values as an object literal
		for(var i=0, length=btn.fields.length; i<length; i++){
			var id=btn.fields[i].id;
			
			if(btn.fields[i].imgradio){
				value = $("input:radio[name='"+self.idPrefix+btn.fields[i].id+"']:checked").val();
			}else{
				value=$('.pexeto-dialog-'+btn.id + ' #'+self.idPrefix+id).val();
			}

			if(btn.fields[i].type=='wysiwyg'){
				var cont,
					$visualBtn = $('#pexeto-shortcode-content-tmce');

				if($visualBtn.length && $visualBtn.parents('.html-active').length){
					//trigger the visual button click, so that the content gets 
					//refreshed in the visual editor
					$visualBtn.trigger('click');
				}
					

				cont = tinyMCE.activeEditor.getContent();
				cont = self.removeTrailingPTags(cont);
				values[id] = cont;
				
			}else{
				values[id]=value;
			}

		}

		if(inner){
			//this is an inner editor
			values['inner']=true;
		}
	}else{
		//the button allows selection - only one value is needed for the formatting, so
		//return this value only (not an object literal)
		value = $('#'+self.idPrefix+btn.fields[0].id).attr("value");
	}

	return values;

};


PEXETO.tinymce.btnManager.prototype.removeTrailingPTags = function(str){
	var searchStr = '<p>'+String.fromCharCode(160)+'</p>', //they use the ASCII 160 for an epmty space
	index = str.lastIndexOf(searchStr),
	newStr = '';

	if(index!==-1){
		newStr = str.substr(0, index) + str.substr(index+searchStr.length, str.length);
		return newStr;
	}else{
		return str;
	}

};



/**
 * Inserts a content to the editor when the Insert button of the dialog
 * is clicked.
 * @param  {object} ed  the editor object
 * @param  {object} btn the button object
 */
PEXETO.tinymce.btnManager.prototype.executeCommand=function(ed, btn){

	var html='',
		values,
		value,
		self = this,
		inner = ed.id === 'content' ? false : true;

	if(!btn.allowSelection){
		//the button doesn't allow selection and has multiple fields
		values = self.getInputsValue(btn, inner);
		values = self.escapeObjectQuotes(values);
		html = btn.generateHtml(values);
	}else{
		//the button allows selection - only one value is needed for the formatting, so
		//return this value only (not an object literal)
		value = jQuery('#'+self.idPrefix+btn.fields[0].id).attr("value");
		html = btn.generateHtml(value);
	}

	self.dialogs.pop().remove();

	if(PEXETO.tinymce.ie){
		ed.selection.select(ed.dom.select('div#pexetocaret')[0], false);
		ed.dom.remove('pexetocaret');
	}

	ed.execCommand('mceInsertContent', false, html);

};

/**
 * Preloads the visual shortcode edit images, so that when an image is clicked
 * once and the edit image should be displayed, it can be displayed without a
 * delay.
 */
PEXETO.tinymce.btnManager.prototype.preloadEditImages = function(){
	var self = this;

	_.each(self.visualBtns, function(btn){
		var editSrc = self.getEditImgSrc(btn.visual.img),
			img = new Image();
		img.src = editSrc;
	});
};

/**
 * Generates the edit image URL that corresponds to a visual shortcode image.
 * For example, the edit URL of http://site.com/image.jpg would be
 * http://site.com/image-edit.jpg
 * Works with JPG and PNG images only
 * @param  {string} src the original image source
 * @return {string}     the edit image source
 */
PEXETO.tinymce.btnManager.prototype.getEditImgSrc = function(src){
	return src.replace(/\.(png|jpg)/, '-edit$&');
};

/**
 * Generates the default image URL that corresponds to a visual shortcode edit 
 * image. For example, the default URL of http://site.com/image-edit.jpg would be
 * http://site.com/image.jpg
 * Works with JPG and PNG images only
 * @param  {string} src the edit image source
 * @return {string}     the original image source
 */
PEXETO.tinymce.btnManager.prototype.getDefImgSrcFromEditImg = function(editSrc){
	return editSrc.replace(/-edit\.(png|jpg)/, '.$1');
};

PEXETO.tinymce.btnManager.prototype.setImageHover = function(ed){
	var self = this,
		$body = $(ed.dom.doc.body),
		$tooltip = $('<div />', {'class':'pex-tooltip'});

	$body.on('mouseenter', 'img.pexeto-edit-image', function(){
		var $img = $(this),
			atts = self.convertAttrStringToObj($img.attr('data-atts'));

		if(atts.title){
			$tooltip.html(atts.title)
				.css({top: ($img.offset().top + 7)})
				.appendTo($body);
		}
	}).on('mouseleave focusout', 'img.pexeto-edit-image', function(){
		$tooltip.detach();
	});

	ed.onChange.add(function(){
		$tooltip.detach();
	});
};

/**
 * Inits the visual shortcode edit functionality. When the image that represents
 * the shortcode is clicked, an edit dialog will be opened to edit the shortcode
 * data.
 * @param  {object} ed the editor object
 */
PEXETO.tinymce.btnManager.prototype.initEditFunctionality = function(ed){
	var self = this;

	ed.onInit.add(function(ed){

		var $lastTarget = null,
			removeEdit;

		removeEdit = function($img){
			//remove the edit class of the image
			var src = $img.attr('src');
				newSrc = self.getDefImgSrcFromEditImg(src);

			$img.removeClass('pexeto-edit-img').data('editnow', false);
		};

		self.setImageHover(ed);

		ed.onMouseUp.add(function(editor, e){

			var src, newSrc, $target, atts, content,
				target = e.target || e.srcElement || e.originalTarget;

			if(target){
				$target = $(target);

				if($target.hasClass('pexeto-edit-image')){
					//it's a visual shortcode image
					if($lastTarget && $lastTarget[0]!==$target[0]){
						//if another image has been selected before, remove its
						//edit state
						removeEdit($lastTarget);
						$lastTarget = null;
					}

					if(!$target.data('editnow')){
						//the image hasn't been clicked before, change the stadndard
						//image with an edit image (add an edit class)
						src = $target.attr('src');
						newSrc = self.getEditImgSrc(src);
						$target.addClass('pexeto-edit-img')
							.data('editnow', true);

						$lastTarget = $target;
					
					}else{
						//the image has been already clicked once, second click
						//now triggers the edit dialog
						
						attsString = tinymce.DOM.decode($target.attr('data-atts'));
						content = $target.attr('data-pexcontent') ? tinymce.DOM.decode($target.attr('data-pexcontent')) : null;
						
						var data = self.convertAttrStringToObj(attsString);
						data = self.escapeObjectQuotes(data);

						if(content){
							data.content=content;
						}
	
						var shortcode = $target.data('shortcode'),
							btns = _.filter(self.visualBtns, function(curBtn){
								return curBtn.visual.shortcode === shortcode;
							}),
							btn = btns[0];

						//create the edit form and dialog
						var formBuilder = new PEXETO.tinymce.formBuilder(btn, self.idPrefix, data),
							$el = formBuilder.getFormElement(),
							dialog = new PEXETO.tinymce.dialog(btn, ed, function(){
									self.doOnEdit(ed, $target, btn);
								}, $el, function(){
								return formBuilder.initElements();
							}, true, function(){
							self.removeDialog();
						});

						dialog.init();
						self.dialogs.push(dialog);
					}
				}else{
					if($lastTarget){
						removeEdit($lastTarget);
						$lastTarget = null;
					}
				}
			}
		});

	});

	self.preloadEditImages();

};


/**
 * Converts a shortcode attribute string to a JavaScript object with key/value
 * pairs.
 * @param  {string} attsString the string to convert
 * @return {object}            object containing the attributes as key/value
 * pairs
 */
PEXETO.tinymce.btnManager.prototype.convertAttrStringToObj = function(attsString){
	var self = this,
		atts = attsString.split(self.attrPrefix),
		data = {};
	_.each(atts, function(att){
		var att_arr = att.split(/=(.+)?/),
			val = '';
		if(att_arr.length>=2){
			val = $.trim(att_arr[1]);
			if(val[0]==='"' && val[val.length-1]==='"'){
				//remove the surrounding quotes
				val = val.slice(1, val.length-1);
			}
			data[att_arr[0]]=val;
		}
	});

	return data;
};


/**
 * Escapes the inner quotes of an attribute string. For example, this string:
 * pex_attr_title="title "here" with a quote" pex_attr_text="content here" 
 * will be converted to:
 * pex_attr_title="title &quot;here&quot; with a quote" pex_attr_text="content here"
 * @param  {string} attsString the attribute string to escape
 * @return {string}            the attribute string with escaped quotes
 */
PEXETO.tinymce.btnManager.prototype.escapeAttrStrInnerQuotes = function(attsString){
	var res='',
		self = this,
		atts = self.convertAttrStringToObj(attsString);

	_.each(atts, function(value, key){
		res+=' '+self.attrPrefix+key+'="'+value.replace(/"/g, '&quot;')+'"';
	});

	res = $.trim(res);

	return res;
};


/**
 * Escapes the quotes within an object's values.
 * @param  {object} obj the object whose values will be escaped
 * @return {object}     the object with escaped quotes in the values
 */
PEXETO.tinymce.btnManager.prototype.escapeObjectQuotes = function(obj){

	_.each(obj, function(value, key){
		if(key!=='content' && typeof value === 'string'){
			obj[key] = value.replace(/"/g, '&quot;');
		}
	});

	return obj;
};


/**
 * Updates the visual editor element when the "Update" button is clicked in an
 * edit dialog.
 * @param  {object} ed      the current editor object
 * @param  {object} $target jQuery image object which is the image that represents
 * the edited shortcode
 * @param  {object} btn     the button object associated with the shortcode
 */
PEXETO.tinymce.btnManager.prototype.doOnEdit = function(ed, $target, btn){
	var values,
		html='',
		attrStr='',
		self = this,
		inner = ed.id === 'content' ? false : true;

	values = self.getInputsValue(btn, inner);

	//create an attribute string from the values
	_.each(values, function(val, key){
		if(key!=='content'){
			attrStr+=self.attrPrefix+key+'="'+tinymce.DOM.encode(val)+'" ';
		}
	});
	if(attrStr){
		$target.attr('data-atts', attrStr);
	}

	if(values.content){
		$target.attr('data-pexcontent', values.content);
	}

	tinyMCE.execCommand("mceRepaint");

	self.dialogs.pop().remove();

};

PEXETO.tinymce.btnManager.prototype.setButtonVisibility = function(){
	var $select = $('select[name="page_template"]'),
		$btn = $('#content_pexetobgsection, .mce-i-pexetobgsection'),
		setVisibility = function(){
			if($select.val()=='template-full-custom.php'){
				$btn.show();
			}else{
				$btn.hide();
			}
		};

	if($select.length && $btn.length){
		setVisibility();
		$select.on('change', setVisibility);
	}
};



/*******************************************************************************
 * BUTTONS DIALOG
 ******************************************************************************/

/**
 * Dialog - inits a dialog to insert or edit data associated with a TinyMCE
 * button.
 * @param  {object} btn            the button object
 * @param  {object} ed             the current editor object
 * @param  {function} insertCallback a callback function that will be executed
 * when the dialog's Insert/Update button is clicked
 * @param  {object} $el            jQuery element object that contains the content
 * of the dialog, such as forms and fields
 * @param  {function} loadCallback   a callback function that will be executed
 * when the dialog is loaded
 * @param  {boolean} edit           sets whether it is edit dialog (when set to
 * true) or an insert dialog (when set to false)
 */
PEXETO.tinymce.dialog = function(btn, ed, insertCallback, $el, loadCallback, edit, closeCallback){
	this.btn = btn;
	this.$el = $el;
	this.ed = ed;
	this.insertCallback = insertCallback;
	this.loadCallback = loadCallback;
	this.edit = edit;
	this.closeCallback = closeCallback;
};


/**
 * Inits the dialog functionality.
 */
PEXETO.tinymce.dialog.prototype.init = function(){
	var self = this,
		dialogWidth = Math.min($(window).width()-100, 900),
		btnText = self.edit ? 'Update' : 'Insert',
		dialog;

		self.bodyClassName = 'pexeto-dialog-opened';
		self.customBodyClassName = 'pexeto-dialog-opened-'+self.btn.id;



		var dialogOptions = {
		title:self.btn.title, 
		modal:true,
		width:dialogWidth,
		dialogClass:'pexeto-dialog pexeto-dialog-'+self.btn.id,
		close:function(event, ui){
			$(this).html('').remove();
			self.closeCallback.call();
			self.doOnClose();
		},
		create:function(){
			self.$el.parent().addClass('pexeto-loading');

			self.loadCallback.call(null).done(function(){
				self.$el.parent().removeClass('pexeto-loading');
				self.$el.find('.pexeto-upload-btn').trigger('refresh');
			});
		},
		open:function(){
			self.$el.find('.pexeto-upload-btn').trigger('refresh');
			$('body').addClass(self.bodyClassName+' '+self.customBodyClassName);

			//remove the preventing of the focus in event in jQuery UI
			//fixes the issue with the WordPress Link dialog fields not being editable
			setTimeout(function(){
				$(document).off('focusin.dialog');

				//remove the events with a namespace that has a number appended (e.g. focusin.dialog25)
				if(typeof $._data !== "undefined"){
					var events = $._data( document, "events" );
					if(events && typeof events.focusin !== "undefined" && events.focusin.length){
						for(var i=0, len = events.focusin.length; i<len; i++){
							var e = events.focusin[i];
							if(e.namespace && e.namespace.toString().indexOf('dialog')!==-1){
								$(document).off('focusin.'+e.namespace);
							}
						}
					}
				}
			}, 500);
			
		},
		buttons:[
			{
				"html": '<i aria-hidden="true" class="icon-plus"></i>'+btnText,
				"class":"pex-button",
				"click": function(){
					self.insertCallback.call();
				}
			}
		]
	};

	if($('.pexeto-dialog').length){
		dialogOptions.appendTo = '.pexeto-dialog';
	}

	dialog = self.$el.dialog(dialogOptions);

	this.dialogEl = dialog;

};

/**
 * Removes the dialog.
 */
PEXETO.tinymce.dialog.prototype.remove = function(){
	this.dialogEl.remove();
	this.doOnClose();
};

PEXETO.tinymce.dialog.prototype.doOnClose = function(){
	$('body').removeClass(this.customBodyClassName);

	var bClasses = document.body.className.match(/pexeto\-dialog\-opened\-/gi);
	if(!bClasses){
		//there are no other dialogs opened, remove the body dialog class
		$('body').removeClass(this.bodyClassName);
	}
};



/*******************************************************************************
 * FORM BUILDER
 ******************************************************************************/

/**
 * Builds a form that contains all of the inputs associated with a TinyMCE
 * button to add/edit data.
 * @param  {object} btn      the button object
 * @param  {string} idPrefix the prefix of the elements/inputs IDs
 * @param  {object} defData  default data can be set to the inputs, set as 
 * null when there is no default data
 */
PEXETO.tinymce.formBuilder = function(btn, idPrefix, defData){
	this.btn = btn;
	this.idPrefix = idPrefix;
	this.$el = null;
	this.defData = defData;
};


PEXETO.tinymce.count = 0;

/**
 * Builds the form element and returns it.
 * @return {object} a jQuery object element containing all of the form fields
 * and data.
 */
PEXETO.tinymce.formBuilder.prototype.getFormElement = function(){
	var self = this,
		btn = self.btn,
		defData = self.defData,
		html='<div>';

	for(var i=0, length=btn.fields.length; i<length; i++){
		var field=btn.fields[i], inputHtml='',
			defValue = (defData && defData[field.id]) ? defData[field.id] : null;

		if(field.type=='subtitle'){
			//subtitle (start of new section) field
			if(field.small){
				html+='<span class="dialog-subtitle-small">'+field.name+'</span>';
			}else{
				html+='<h3 class="dialog-subtitle">'+field.name+'</h3>';
			}
			continue;
		}

		if(field.values){
			if(field.imgradio){
				//this is an image radio element
				$.each(field.values, function(index, value){
					var selected;

					selected = (defValue && defValue===value.id) || (index===0 && defValue===null) ? ' checked' : '';
					inputHtml+='<div class="dialog-img-radio"><input type="radio" name="'+self.idPrefix+field.id+'" value="'+
						value.id+'"'+selected+'><img src="'+value.img+'">';
					if(!field.hideTitle){
						inputHtml+='<span class="img-radio-title">'+value.name+'</span>';
					}
					inputHtml+='</div>';
				});

			}else{
				//this is a select list
				inputHtml='<select id="'+self.idPrefix+field.id+'">';
				$.each(field.values, function(index, value){
					var name, id, selected;
					if(typeof value === 'string'){
						name = value;
						id = value;
					}else{
						name = value.name;
						id = value.id;
					}
					selected = (defValue && defValue==id) ? ' selected="selected"' : '';
					inputHtml+='<option value="'+id+'"'+selected+'>'+name+'</option>';
				});
				inputHtml+='</select>';
			}

		}else{

			if(field.textarea && !PEXETO.tinymce.opera){
				//this is a textarea
				var val = defValue || '';
				inputHtml='<textarea id="'+self.idPrefix+field.id+'" >'+val+'</textarea>';
			}else if(field.type==='wysiwyg'){
				//this is a wysiwyg/tinymce editor
				inputHtml='<textarea id="'+self.idPrefix+field.id+(++PEXETO.tinymce.count)+'" class="pexeto_tinymce"></textarea>';
			}else{
				//input field
				var inputClass="",
					val = defValue ? ' value="'+defValue+'"' : '';

				if(field.type==='colorpicker'){
					//colorpicker field
					inputClass="color";
				}else if(field.type==='upload'){
					//upload field
					inputClass="pexeto-upload";
				}

				if(field.type==='upload'){
					inputHtml+='<div class="pex-upload-wrapper">';
				}

				inputHtml+='<input type="text" id="'+self.idPrefix+field.id+'" class="'+inputClass+'" '+val+'/>';
				if(field.type==='upload'){
					inputHtml+='<a class="pexeto-upload-btn pex-button"><span>'+
					'Select Image</span></a></div>';
				}
				if(field.type==='colorpicker'){
					inputHtml+='<div class="color-preview"></div>';
				}
			}
		}
		var addClass = '';
		if(field.twocolumn){
			addClass = ' small-field';
			if(field.twocolumn=='first'){
				html+='<div class="pexeto-shortcode-two-column">';
			}
		}
		if(field.imgradio){
			addClass+=' img-radio-field';
		}

		var desc = field.desc ? '<span class="dialog-desc">'+field.desc+'</span>' : '';
		
		html+='<div class="pexeto-shortcode-field'+addClass+'"><label><span class="dialog-title">'+field.name+'</span>'+desc+'</label>'+inputHtml+'</div>';

		if(field.twocolumn=='last'){
			html+='</div>';
		}
	}
	html+='</div>';

	self.$el = $(html);

	return self.$el;
};


/**
 * Inits the elements within the form, such as Upload functionality, Color
 * Picker, additional TinyMCE editors, etc.
 * @return {Deferred} returns a jQuery Deferred object which gets resolved when 
 * all of the functionality and elements are loaded.
 */
PEXETO.tinymce.formBuilder.prototype.initElements = function(){
	var self = this,
		$el = self.$el,
		pending = false,
		deferred = new $.Deferred();

	self.initDependentFields();

	//load the upload functionality
	$el.find('.pexeto-upload-btn').each(function(){

		$(this).pexetoUpload();
	});

	//load the color picker functionality
	$el.find('.color').each(function(){
		$(this).pexetoColorpicker();
	});

	//load the radio images
	$el.find('.dialog-img-radio img').on('click', function(){
		$(this).siblings('input:radio').trigger('click');
	});
	
	var $tinymce_editor = $el.find('.pexeto_tinymce');
	if($tinymce_editor.length){
		//load the TinyMCE editor
		pending = true;

		var editorId = $tinymce_editor.attr('id') || 'pexeto_editor',
			data = {'action':'pexeto_print_wp_editor', 'id':editorId};

		$.ajax({
			url:ajaxurl,
			data_type:'GET',
			data:data
		}).done(function(res){

			$tinymce_editor.replaceWith(res);

			//create a new editor settings object and copy all of the editor 
			//settings from the main WordPress content editor to the new one
			tinyMCEPreInit.mceInit[editorId] = $.extend(
				{id:editorId, theme:'advanced'}, 
				tinyMCEPreInit.mceInit['content']);
			tinyMCEPreInit.mceInit[editorId].elements = editorId;
			tinyMCEPreInit.mceInit[editorId].body_class = editorId;
			tinyMCEPreInit.mceInit[editorId].selector = '#'+editorId;

			//make it compatible with both TinyMCE 3.0 & 4.0
			var buttonsKey = tinyMCEPreInit.mceInit[editorId]['theme_advanced_buttons1'] ?
				'theme_advanced_buttons' : 'toolbar';

			if(PEXETO.tinymce.excludeDialogButtons){
				//exclude some of the default TinyMCE buttons
				for(var i=1; i<=4; i++){
					var buttons = tinyMCEPreInit.mceInit[editorId][buttonsKey+i],
						len;
					buttons = buttons.replace(PEXETO.tinymce.excludeDialogButtons, '');
					len = buttons.length;

					if(buttons[len-1]===','){
						buttons = buttons.substring(0, len - 1);
					}
					
					tinyMCEPreInit.mceInit[editorId][buttonsKey+i]=buttons;
				}
			}
			
			tinyMCE.init(tinyMCEPreInit.mceInit[editorId]);
			var qtInit = $.extend({}, tinyMCEPreInit.qtInit['content']);
			qtInit.id=editorId;
			tinyMCEPreInit.qtInit[editorId] = qtInit;

			quicktags( tinyMCEPreInit.qtInit[editorId] );

			tinyMCE.activeEditor = tinyMCE.get(editorId);

			if(self.defData && self.defData.content){
				//insert the default content to the editor
				tinyMCE.get(editorId).execCommand('mceInsertContent', false, self.defData.content);
			}

			deferred.resolve();
		});

	}

	if(!pending){
		deferred.resolve();
	}

	return deferred;
};

PEXETO.tinymce.formBuilder.prototype.getSingleElement = function(id){
	var self = this;
	return self.$el.find('#'+self.idPrefix+id+',input:radio[name="'+self.idPrefix+id+'"]');
};


PEXETO.tinymce.formBuilder.prototype.initDependentFields = function(){
	var self = this,
		getFieldVal = function($el, type){
			if(type=='select'){
				return $el.val();
			}else{
				return $el.filter(':checked').val();
			}
		},
		updateDependentFields = function(field, $el, init){
			var fieldType = field.imgradio ? 'imgradio' : 'select',
				selectedVal = getFieldVal($el, fieldType),
				defaults = _.filter(field.values, function(val){
					return val.id === selectedVal;
				});

			if(defaults[0]){
				_.each(defaults[0].defaults, function(defVal, key){
					var $input = self.getSingleElement(key),
						changed = $input.val() ? true : false;

					if($input.prop("tagName").toLowerCase()==='select' && 
						$input.find('option:selected').index()===0){
						changed = false;
					}

					if(!changed || !init){
						$input.val(defVal);
						if($input.hasClass('color') && !init){
							$input.trigger('colorChange');
						}
					}
				});
			}
		},
		hiddenInputs = [],
		setFieldsVisibility = function(field, $select){
			var i,
				selectedVal = $select.val(),
				selectedValField = _.filter(field.values, function(val){
					return val.id===selectedVal;
			});

			//show all fields
			i=hiddenInputs.length;
			while(i--){
				hiddenInputs[i].show();
			}
			hiddenInputs = [];

			if(selectedValField.length){
				if(selectedValField[0].hide){
					for(i = 0; i<selectedValField[0].hide.length; i++){
						var $fieldToHide = self.getSingleElement(selectedValField[0].hide[i]).parent();
						$fieldToHide.hide();
						hiddenInputs.push($fieldToHide);
					}
				}
			}

		};

	_.each(self.btn.fields, function(field){
		if(field.values){
			var $el = self.getSingleElement(field.id);

			if(field.values[0].defaults){
				//this field has some default values that should be applied
				//to the dependent fields
				
				updateDependentFields(field, $el, true);

				$el.on('change', function(){
					updateDependentFields(field, $el, false);
				});
			}

			var fieldsToHide = _.filter(field.values, function(val){
				return val.hide;
			});

			if(fieldsToHide.length){
				setFieldsVisibility(field, $el);
				$el.on('change', function(){
					setFieldsVisibility(field, $el);				
				});
			}
		}
	});
};

$(document).ready(function() {
	//init the custom formatting buttons functionality
	var btnManager = new PEXETO.tinymce.btnManager(PEXETO.tinymce.buttons);
	btnManager.init();
});


})(jQuery);

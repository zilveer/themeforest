(function() {

        tinymce.create('tinymce.plugins.addshortcodes', {

                init : function(ed, url) {

                            var popup = url + "/popup.php?popup=";
                            var image  = url + '/images/';

			/**
			* Buttons
			*/
			ed.addCommand('mceButtons', function() {
				ed.windowManager.open({
					file : popup + 'button',
					width : 580 ,
					height : 355,
					inline : 1
				}, {
					plugin_url : url
				});
			});
			ed.addButton('van_button', {
				title : 'Add a Button',
				cmd : 'mceButtons',
				image : image + 'buttons.png'
			});

			/**
			* Messages Boxes
			*/
			ed.addButton('van_box', {
			        title : 'Add a Box',
			        cmd : 'mceBoxes',
			        image : image + 'boxes.png'
			});
			ed.addCommand('mceBoxes', function() {
			        ed.windowManager.open({
			                file : popup + 'boxes',
			                width : 580,
			                height : 317,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});

			/**
			* ToolTip
			*/ 

			ed.addButton('van_tooltip', {
			        title : 'Add a Tooltip',
			        cmd : 'mceTooltip',
			        image : image + 'tooltip.png'
			});
			ed.addCommand('mceTooltip', function() {
			        ed.windowManager.open({
			                file : popup + 'tooltip',
			                width : 580,
			                height : 317,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});  
			/**
			* Columns
			*/
			ed.addButton('van_columns', {
			        title : 'Add a columns',
			        cmd : "mceColumns",
			        image : image + 'columns.png'
			});
			ed.addCommand('mceColumns', function() {
			        ed.windowManager.open({
			                file : popup + 'columns',
			                width : 580,
			                height : 101,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});
			/**
			* Toggle
			*/
			ed.addButton('van_toggle', {
			        title : 'Toggle box',
			        cmd : 'mceToggle',
			        image : image + 'toggle.png'
			});
			ed.addCommand('mceToggle', function() {
			        ed.windowManager.open({
			                file : popup + 'toggle',
			                width : 580,
			                height : 315,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});
			/**
			* tabs
			*/
			ed.addButton('van_tabs', {
			        title : 'Tabbed content',
			        cmd : 'mceTabs',
			        image : image + 'tabs.png'
			});
			ed.addCommand('mceTabs', function() {
			        ed.windowManager.open({
			                file : popup + 'tabs',
			                width : 580,
			                height : 600,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});
			/**
			* tabs
			*/
			ed.addButton('van_accordions', {
			        title : 'Accordion content',
			        cmd : 'mceAccordions',
			        image : image + 'accordions.png'
			});
			ed.addCommand('mceAccordions', function() {
			        ed.windowManager.open({
			                file : popup + 'accordions',
			                width : 580,
			                height : 600,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});
			/**
			* Author biography
			*/
			ed.addButton('van_author', {
			        title : 'Add Author biography',
			        cmd : 'mceAuthor',
			        image : image + 'author.png'
			});
			ed.addCommand('mceAuthor', function() {
			        ed.windowManager.open({
			                file : popup + 'author',
			                width : 580,
			                height : 356,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});
			/**
			* Videos
			*/           
			ed.addButton('van_video', {
			        title : 'Add a video',
			        cmd : 'mceVideos',
			        image : image + 'video.png'
			});
			ed.addCommand('mceVideos', function() {
			        ed.windowManager.open({
			                file : popup + 'video',
			                width : 580,
			                height : 253,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			}); 
			/**   
			* flickr
			*/  
			ed.addButton('van_flickr', {
			        title : 'Add Photos From FLickr',
			        cmd : 'mceFlickr',
			        image : image + 'flickr.png'
			});
			ed.addCommand('mceFlickr', function() {
			        ed.windowManager.open({
			                file : popup + 'flickr',
			                width : 580,
			                height : 185,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});
			/**  
			*  Twitter
			*/  
			ed.addButton('van_twitter', {
			        title : 'Add Your Latest Tweets',
			        cmd : 'mceTwitter',
			        image : image + 'twitter.png'
			});
			ed.addCommand('mceTwitter', function() {
			        ed.windowManager.open({
			                file : popup + 'twitter',
			                width : 580,
			                height : 144,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});
			/**
			* Google Map
			*/  
			ed.addButton('van_googlemap', {
			        title : 'Add Google Map',
			        cmd : 'mceGooglemap',
			        image : image + 'googlemap.png'
			});
			ed.addCommand('mceGooglemap', function() {
			        ed.windowManager.open({
			                file : popup + 'g_map',
			                width : 580,
			                height : 350,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});
			/**
			* Much Login To view Content
			*/  
			ed.addButton('van_private', {  
			        title : 'Add a private content',  
			        image : image + 'private.png',  
			        onclick : function() {                              
			                ed.selection.setContent('[private]' + ed.selection.getContent() + '[/private]');  
			        }  
			}); 
			/**
			* Check list
			*/  
			ed.addButton('van_checklist', {  
			        title : 'Add a Check list',  
			        image : image + 'check.png',  
			        onclick : function() {                              
			                ed.selection.setContent('[checklist]<ul><li>' +  checkEmptyContent( ed.selection.getContent() )  + '</li></ul>[/checklist]');  
			        }  
			});
			/**
			* Error list
			*/  
			ed.addButton('van_errorlist', {  
			        title : 'Add a Error list',  
			        image : image +'error.png',  
			        onclick : function() {                              
			                ed.selection.setContent('[errorlist]<ul><li>' +  checkEmptyContent( ed.selection.getContent() )  + '</li></ul>[/errorlist]');  
			        }  
			}); 			
			/**
			* Bullet List
			*/  
			ed.addButton('van_bulletlist', {  
			        title : 'Add a simple Bullet list',  
			        image : image +'bullet.png',  
			        onclick : function() {                              
			                ed.selection.setContent('[bulletlist]<ul><li>' +  checkEmptyContent( ed.selection.getContent() )  + '</li></ul>[/bulletlist]');  
			        }  
			}); 
			/**
			*  Dropcap
			*/ 
			ed.addButton('van_dropcap', {
			        title : 'Add a Dropcap',
			        cmd : 'mceDropcap',
			        image : image + 'drop.png'
			});
			ed.addCommand('mceDropcap', function() {
			        ed.windowManager.open({
			                file : popup + 'dropcap',
			                width : 580,
			                height : 157,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});
			/**
			* Highlight Text
			*/ 
			ed.addButton('van_highlight', {
			        title : 'Add a Highlight text',
			        cmd : 'mceHighlight',
			        image : image + 'highlight.png'
			});
			ed.addCommand('mceHighlight', function() {
			        ed.windowManager.open({
			                file : popup + 'highlight',
			                width : 580,
			                height : 346,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});      
			/**
			*  ads
			*/    
			ed.addButton('van_ads', {  
			        title : 'Add ads',  
			        image : image + 'ads.png',  
			        onclick : function() {                              
			                ed.selection.setContent('[ads]');  
			        }
			});
			/**
			*  Divider
			*/    
			ed.addButton('van_divider', {  
			        title : 'Add divider',  
			        image : image + 'divider.png',  
			        onclick : function() {                              
			                ed.selection.setContent('[divider]');  
			        }
			});
			/**
			*  Clear
			*/    
			ed.addButton('van_clear', {  
			        title : 'Add clear',  
			        image : image + 'clear.png',  
			        onclick : function() {                              
			                ed.selection.setContent('[clear]');  
			        }
			});			
			/**
			*  Social Share
			*/    
			ed.addButton('van_social', {
			        title : 'Add social shares',
			        cmd : 'mceSocial',
			        image : image + 'social.png'
			});
			ed.addCommand('mceSocial', function() {
			        ed.windowManager.open({
			                file : popup + 'social',
			                width : 580,
			                height : 583,
			                inline : 1
			        }, {
			                plugin_url : url
			        });
			});    

                 },
                 createControl : function(n, cm) {
                           return null;
                 }

        });

    tinymce.PluginManager.add('van_shortcodes', tinymce.plugins.addshortcodes);

})();
function checkEmptyContent(content){
	if ( content == "" ) {
		return "Content Here ...";
	}else{
		return content;
	}
}
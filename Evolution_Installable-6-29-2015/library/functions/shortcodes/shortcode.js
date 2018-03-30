(function() {

	tinymce.create('tinymce.plugins.Addshortcodes', {
		init : function(ed, url) {
		
			//Add Panel
			ed.addButton('AddPanel', {
				title : 'Add Panel',
				cmd : 'alc_panel',
				image : url + '/images/panel.png'
			});
			ed.addCommand('alc_panel', function() {
				ed.windowManager.open({file : url + '/ui.php?page=panel',width : 600 ,	height : 450 ,	inline : 1});
			});	
                        //Add box
                        ed.addButton('AddBox', {
				title : 'Add Box',
				cmd : 'alc_box',
				image : url + '/images/box.png'
			});
			ed.addCommand('alc_box', function() {
				ed.windowManager.open({file : url + '/ui.php?page=box',width : 600 ,	height : 450 ,	inline : 1});
			});	
                        
                        //Add Progress bar
			ed.addButton('Progress', {
				title : 'Add Progress bar',
				cmd : 'alc_progress',
				image : url + '/images/progress.png'
			});
			ed.addCommand('alc_progress', function() {
				ed.windowManager.open({file : url + '/ui.php?page=progress',width : 600 ,	height : 375 ,	inline : 1});
			});
                        
                        //Add Dropdown Buttons
			ed.addButton('Dropdown', {
				title : 'Add Dropdown Button',
				cmd : 'alc_dropdown',
				image : url + '/images/dropdown.png'
			});
			ed.addCommand('alc_dropdown', function() {
				ed.windowManager.open({file : url + '/ui.php?page=dropdown',width : 600 ,	height : 375 ,	inline : 1});
			});
			
			//AddButtons
			ed.addButton('AddButton', {
				title : 'Add Button',
				cmd : 'alc_button',
				image : url + '/images/button.png'
			});
			ed.addCommand('alc_button', function() {
				ed.windowManager.open({file : url + '/ui.php?page=button',width : 600 ,	height : 450 ,	inline : 1});
			});
			
			
                        //Add Tabs
                        ed.addButton('Tabs', {
                            title:' Add Tabs',
                            image:url+'/images/tabs.png',
                            cmd:'alc_tabs'
                        });
                        ed.addCommand('alc_tabs', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=tabs', width:600, height:350, inline:1});
                        });
                        
                        //Add Horizontal Navigation
                        ed.addButton('Horizontal navigation', {
				title : 'Add Horizontal navigation',
				cmd : 'alc_hornav',
				image : url + '/images/hornav.png'
			});
			ed.addCommand('alc_hornav', function() {
				ed.windowManager.open({file : url + '/ui.php?page=hornav',width : 600 ,	height : 375 ,	inline : 1});
			});
                        
                        //Add Vertical Navigation
                        ed.addButton('Vertical navigation', {
				title : 'Add Vertical navigation',
				cmd : 'alc_vernav',
				image : url + '/images/vernav.png'
			});
			ed.addCommand('alc_vernav', function() {
				ed.windowManager.open({file : url + '/ui.php?page=vernav',width : 600 ,	height : 375 ,	inline : 1});
			});
			
			//Add Toggle
			ed.addButton('Toggle', {
				title : 'Add Toggle Block',
				cmd : 'alc_toggle',
				image : url + '/images/toggle.png'
			});
			ed.addCommand('alc_toggle', function() {
				ed.windowManager.open({file : url + '/ui.php?page=toggle',width : 600 ,	height : 375 ,	inline : 1});
			});
			
			//Add Accordion
			ed.addButton('Accordion', {
				title : 'Add Accordion Block',
				cmd : 'alc_accordion',
				image : url + '/images/accordion.png'
			});
			ed.addCommand('alc_accordion', function() {
				ed.windowManager.open({file : url + '/ui.php?page=accordion',width : 600 ,	height : 375 ,	inline : 1});
			});
                        
                       

                        
                        
                        //Add Testimonial
			ed.addButton('Testimonial', {
				title : 'Add Testimonial',
				cmd : 'alc_testimonial',
				image : url + '/images/testimonial.png'
			});
			ed.addCommand('alc_testimonial', function() {
				ed.windowManager.open({file : url + '/ui.php?page=testimonial',width : 600 ,	height : 420 ,	inline : 1});
			});
                        
                        //Add alert box
			ed.addButton('Alert', {
				title : 'Add alert box',
				cmd : 'alc_alert',
				image : url + '/images/alert.png'
			});
			ed.addCommand('alc_alert', function() {
				ed.windowManager.open({file : url + '/ui.php?page=alert',width : 600 ,	height : 400 ,	inline : 1});
			});
			

			//Add Video
			ed.addButton('Video', {
				title : 'Add video',
				cmd : 'alc_video',
				image : url + '/images/video.png'
			});
			ed.addCommand('alc_video', function() {
				ed.windowManager.open({file : url + '/ui.php?page=video',width : 600 ,	height : 260 ,	inline : 1});
			});

			//Add Audio
			ed.addButton('Audio', {
				title : 'Add self-hosted audio',
				cmd : 'alc_audio',
				image : url + '/images/audio.png'
			});
			ed.addCommand('alc_audio', function() {
				ed.windowManager.open({file : url + '/ui.php?page=audio',width : 600 ,	height : 260 ,	inline : 1});
			});
                        
                        //Add Self Hosted Video
			ed.addButton('Shvideo', {
				title : 'Add self-hosted video',
				cmd : 'alc_shvideo',
				image : url + '/images/shvideo.png'
			});
			ed.addCommand('alc_shvideo', function() {
				ed.windowManager.open({file : url + '/ui.php?page=shvideo',width : 600 ,	height : 260 ,	inline : 1});
			});
                        
			//Add Slider
			ed.addButton('Slider', {
				title : 'Add Slider',
				cmd : 'alc_slider',
				image : url + '/images/slider.png'
			});
			ed.addCommand('alc_slider', function() {
				ed.windowManager.open({file : url + '/ui.php?page=slider',width : 600 ,	height : 375 ,	inline : 1});
			});

                        //Add Orbit slider
			ed.addButton('Oslider', {
				title : 'Add Orbit Slider',
				cmd : 'alc_oslider',
				image : url + '/images/oslider.png'
			});
			ed.addCommand('alc_oslider', function() {
				ed.windowManager.open({file : url + '/ui.php?page=oslider',width : 600 ,	height : 375 ,	inline : 1});
			});
                        
			//Carousel
			ed.addButton('Carousel', {
				title : 'Add carousel content slider',
				cmd : 'alc_carousel',
				image : url + '/images/carousel.png'
			});
			ed.addCommand('alc_carousel', function() {
				ed.windowManager.open({file : url + '/ui.php?page=carousel',width : 600 ,	height : 350 ,	inline : 1});
			});
                        
                        //Add Contact info
			ed.addButton('Contact', {
				title : 'Add Contact details',
				cmd : 'alc_contact',
				image : url + '/images/contact.png'
			});
			ed.addCommand('alc_contact', function() {
				ed.windowManager.open({file : url + '/ui.php?page=contact',width : 600 ,	height : 320 ,	inline : 1});
			});
                        
                        // Service block
                        ed.addButton('Sblock',{
                                title:'Add Service block',
                                image: url+'/images/fblock.png',
                                cmd: 'alc_sblock'
                        });
                        ed.addCommand('alc_sblock',function(){
                            ed.windowManager.open({file:url+'/ui.php?page=sblock', width:600, height:350, inline:1});
                        });
                        
                       /* //add Title block
                        ed.addButton('Tblock', {
                            title: 'Title block',
                            image:url+'/images/tblock.png',
                            cmd: 'alc_tblock'
                        });
                        ed.addCommand('alc_tblock', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=tblock', width:600, height:400, inline:1});
                        });*/
                        
                        //Add Reveal box
                        ed.addButton('Reveal', {
                            title: 'Add Reveal',
                            image: url+'/images/reveal.png',
                            cmd:'alc_reveal'
                        });
                        ed.addCommand('alc_reveal', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=reveal', width:600, height:400, inline:1});
                        });
                        
                        //Add Tooltip
                        ed.addButton('Tooltip', {
                            title:' Add Tooltip',
                            image:url+'/images/tooltip.png',
                            cmd:'alc_tooltip'
                        });
                        ed.addCommand('alc_tooltip', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=tooltip', width:600, height:400, inline:1});
                        });
                        
                        //Portfolio Listing
                         ed.addButton('Portlisting', {
                            title:' Add Portfolio Listing',
                            image:url+'/images/portlist.png',
                            cmd:'alc_portlisting'
                        });
                        ed.addCommand('alc_portlisting', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=portlisting', width:600, height:400, inline:1});
                        });
                        
                        //Blog Listing
			ed.addButton('Bloglisting', {
				title : 'Add blog posts listing',
				cmd : 'alc_blog',
				image : url + '/images/blog.png'
			});
			ed.addCommand('alc_blog', function() {
				ed.windowManager.open({file : url + '/ui.php?page=bloglisting',width : 600 ,	height : 350 ,	inline : 1});
			});
			
                        
                         //Social Buttons
                         ed.addButton('SocialButton', {
                            title:' Add Social Button',
                            image:url+'/images/social.png',
                            cmd:'alc_social'
                        });
                        ed.addCommand('alc_social', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=social', width:600, height:350, inline:1});
                        });
                        
                        //Add Side Navigation
                        ed.addButton('Sidenav', {
                            title:'Add Side Navigation',
                            image:url+'/images/sidenav.png',
                            cmd:'alc_sidenav'
                        });
                        ed.addCommand('alc_sidenav', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=sidenav', width:600, height:350, inline:1});
                        });
                        
                        //Add Joyride
                        ed.addButton('Joyride', {
                            title:'Add Joyride',
                            image:url+'/images/joyride.png',
                            cmd:'alc_joyride'
                        });
                        ed.addCommand('alc_joyride', function(){
                            ed.windowManager.open({file:url+'/ui.php?page=joyride', width:600, height:350, inline:1});
                        });
                         
                        	
		},
		getInfo : function() {
			return {
				longname : "Weblusive Shortcodes",
				author : 'Weblusive',
				authorurl : 'http://www.weblusive.com/',
				infourl : 'http://www.weblusive.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('EvolutionShortcodes', tinymce.plugins.Addshortcodes);	
	
})();


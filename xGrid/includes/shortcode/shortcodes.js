(function(){
    tinymce.create( 'tinymce.plugins.bd_buttons',{
        init : function(ed, url){

            /**
             *
             * Highlight
             *
             */
            ed.addButton( 'highlight', {
				title : 'Highlight',
                onclick : function() {
				    ed.focus();
					ed.selection.setContent(' [highlight] ' + ed.selection.getContent() + ' [/highlight] ');
                },
				image:  url +  "/shortcodes/assets/images/icons/highlight.png"
            });

            /**
             *
             * Dropcap
             *
             */
            ed.addButton( 'dropcap', {
                title : 'Dropcap',
                onclick : function() {
                    ed.focus();
                    ed.selection.setContent(' [dropcap] ' + ed.selection.getContent() + ' [/dropcap] ');
                },
                image:  url +  "/shortcodes/assets/images/icons/dropcap.png"
            });

            /**
             *
             * Buttons
             *
             */
			ed.addCommand( 'buttons', function() {
				ed.windowManager.open({
					file : url +  '/shortcodes/buttons.php',
					width : 350,
					height : 720,
					inline : 1
				});
			});
			ed.addButton( 'buttons', {
				title : 'Insert Button',
				cmd : 'buttons',
				image:  url +  "/shortcodes/assets/images/icons/buttons.png"
			});

            /**
             *
             * Table
             *
             */
			ed.addButton( 'bd_table', {
                title : 'Table',
                onclick : function() {
                    ed.focus();
					ed.selection.setContent(' [bd_table] <table> <thead><tr><th>Header 1</th><th>Header 2</th></tr></thead> <tbody><tr><td>Division 1</td><td>Division 2</td></tr></tbody> </table> [/bd_table] ');
                },
                image:  url +  "/shortcodes/assets/images/icons/table.png"
            });

            /**
             *
             * List Line
             *
             */
			ed.addButton( 'line_list', {
                title : 'Insert List Line',
                onclick : function() {
                    ed.focus();
					ed.selection.setContent(' [line_list] <ul>	<li>List item 1</li>	<li>List item 2</li>	<li>List item 3</li></ul>[/line_list] ');
                },
                image:  url +  "/shortcodes/assets/images/icons/line.png"
            });

            /**
             *
             * List Check
             *
             */
			ed.addButton( 'list', {
                title : 'Insert List Star',
                onclick : function() {
                    ed.focus();
					ed.selection.setContent(' [star_list] <ul>	<li>List item 1</li>	<li>List item 2</li>	<li>List item 3</li></ul>[/star_list] ');
                },
                image:  url +  "/shortcodes/assets/images/icons/star.png"
            });

            /**
             *
             * List Yes
             *
             */
			ed.addButton( 'yes_list', {
                title : 'Insert List Yes',
                onclick : function() {
                    ed.focus();
					ed.selection.setContent(' [yes_list] <ul>	<li>List item 1</li>	<li>List item 2</li>	<li>List item 3</li></ul>[/yes_list] ');
                },
                image:  url +  "/shortcodes/assets/images/icons/yes.png"
            });

            /**
             *
             * List Error
             *
             */
			ed.addButton( 'no_list', {
                title : 'Insert List No',
                onclick : function() {
                    ed.focus();
					ed.selection.setContent(' [no_list] <ul>	<li>List item 1</li>	<li>List item 2</li>	<li>List item 3</li></ul>[/no_list] ');
                },
                image:  url +  "/shortcodes/assets/images/icons/no.png"
            });

            /**
             *
             * Notifications
             *
             */
			ed.addCommand( 'notifications', function() {
				ed.windowManager.open({
					file : url +  '/shortcodes/notifications.php',
					width : 350,
					height : 175,
					inline : 1
				});
			});
			ed.addButton( 'notifications', {
                title : 'Insert Notification',
                cmd : 'notifications',
                image:  url +  "/shortcodes/assets/images/icons/notifications.png"
            });

            /**
             *
             * Divider
             *
             */
            ed.addButton( 'divider', {
				title : 'Insert Separator line',
                onclick : function() {
				    ed.focus();
					ed.selection.setContent(' [divider] ' + ed.selection.getContent() + ' [/divider] ');
                },
				image:  url +  "/shortcodes/assets/images/icons/divider.png"
            });
            /**
             *
             * Toggle
             *
             */
			ed.addButton( 'toggle', {
                title : 'Insert Toggle',
                onclick : function() {
                    ed.focus();
					ed.selection.setContent('[toggle title="Toggle title"]'+ ed.selection.getContent() +'[/toggle] ');
                },
                image:  url +  "/shortcodes/assets/images/icons/toggle.png"
            });

            /**
             *
             * Tabs
             *
             */
			ed.addButton( 'tabs', {
                title : 'Insert Tabs',
                onclick : function() {
                    ed.focus();
					ed.selection.setContent('[tabgroup] <br>[tab title="Tab 1"]Tab 1 content goes here.[/tab] <br>[tab title="Tab 2"]Tab 2 content goes here.[/tab] <br>[tab title="Tab 3"]Tab 3 content goes here.[/tab] <br>[/tabgroup]');
                },
                image:  url +  "/shortcodes/assets/images/icons/tabs.png"
            });

            /**
             *
             * Social Link
             *
             */
			ed.addCommand( 'social_link', function() {
				ed.windowManager.open({
					file : url +  '/shortcodes/social_link.php',
					width : 350,
					height : 375,
					inline : 1
				});
			});
			ed.addButton('social_link', {
                title : 'Insert Social Link',
                cmd : 'social_link',
                image:  url +  "/shortcodes/assets/images/icons/social.png"
            });

            /**
             *
             * Social Buttons
             *
             */
			ed.addCommand('social_button', function() {
				ed.windowManager.open({				
					file : url +  '/shortcodes/social_button.php',
					width : 350,
					height : 495,
					inline : 1
				});
			});
			ed.addButton('social_button', {
                title : 'Insert Share Button',
                cmd : 'social_button',
                image:  url +  "/shortcodes/assets/images/icons/social_button.png"
            });

            /**
             *
             * Youtube
             *
             */
            ed.addCommand( 'youtube', function() {
                ed.windowManager.open({
                    file : url +  '/shortcodes/youtube.php',
                    width : 350,
                    height : 175,
                    inline : 1
                });
            });
            ed.addButton( 'youtube', {
                title : 'Insert Youtube',
                cmd : 'youtube',
                image:  url +  "/shortcodes/assets/images/icons/youtube.png"
            });

            /**
             *
             * Vimeo
             *
             */
            ed.addCommand( 'vimeo', function() {
                ed.windowManager.open({
                    file : url +  '/shortcodes/vimeo.php',
                    width : 350,
                    height : 175,
                    inline : 1
                });
            });
            ed.addButton( 'vimeo', {
                title : 'Insert vimeo',
                cmd : 'vimeo',
                image:  url +  "/shortcodes/assets/images/icons/vimeo.png"
            });

            /**
             *
             * Soundcloud
             *
             */
            ed.addCommand( 'soundcloud', function() {
                ed.windowManager.open({
                    file : url +  '/shortcodes/soundcloud.php',
                    width : 350,
                    height : 175,
                    inline : 1
                });
            });
            ed.addButton( 'soundcloud', {
                title : 'Insert soundcloud',
                cmd : 'soundcloud',
                image:  url +  "/shortcodes/assets/images/icons/soundcloud.png"
            });

            /**
             *
             *  Google map
             *
             */
            ed.addCommand( 'googlemaps', function() {
                ed.windowManager.open({
                    file : url +  '/shortcodes/googlemaps.php',
                    width : 350,
                    height : 302,
                    inline : 1
                });
            });
            ed.addButton( 'googlemaps', {
                title : 'Insert Google Maps',
                cmd : 'googlemaps',
                image:  url +  "/shortcodes/assets/images/icons/googlemaps.png"
            });

        },

        /**
         *
         * Columns
         *
         */
		createControl:function(d,e,url){
            if(d=="columns"){
                d=e.createMenuButton( "columns",{
                    title:"Insert Columns Shortcode",
                    icons:false
                });
                    var a=this;d.onRenderMenu.add(function(c,b){
                        a.addImmediate(b,"Column 1/2", ' [one_half]  [/one_half] ');
                        a.addImmediate(b,"Column 1/2 last", ' [one_half last=last]  [/one_half] ');
                        a.addImmediate(b,"Column 1/3", ' [one_third]  [/one_third] ');
                        a.addImmediate(b,"Column 1/3 last", ' [one_third last=last]  [/one_third] ');
                        a.addImmediate(b,"Column 1/4", ' [one_fourth]  [/one_fourth] ');
                        a.addImmediate(b,"Column 1/4 last", ' [one_fourth last=last]  [/one_fourth] ');
                        a.addImmediate(b,"Column 2/3", ' [two_third]  [/two_third] ');
                        a.addImmediate(b,"Column 2/3 last", ' [two_third last=last]  [/two_third] ');
                        a.addImmediate(b,"Column 3/4", ' [three_fourth]  [/three_fourth] ');
                        a.addImmediate(b,"Column 3/4 last", ' [three_fourth last=last]  [/three_fourth] ');
                        a.addImmediate(b,"Clear", '[clear]');
                    }); return d
            } return null
        },
        addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand( "mceInsertContent",false,a)}})}
    });
    tinymce.PluginManager.add('bd_buttons', tinymce.plugins.bd_buttons);

})();
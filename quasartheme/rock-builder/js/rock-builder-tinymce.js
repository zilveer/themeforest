(
	function(){
		tinymce.PluginManager.add( "RockthemesPlugins", function(editor, url){
			
			function addSubmenu(e,a){
				return {text:e,onclick:function(){tinyMCE.activeEditor.execCommand( "mceInsertContent",false,a)}}
			};
			
			var sub_menu_buttons = [addSubmenu('Advanced Text', '[rockthemes_advanced_text font_family="" font_size="" font_weight="" font_color="" extra_style=""]Enter Your Text Here...[/rockthemes_advanced_text]' ),
								addSubmenu('Lists (Bullets)', '[rockthemes_list font_awesome_icon_class="" icon_color=""]Enter Your List HTML Here...[/rockthemes_list]' ),
								addSubmenu('Divider Center', '[rockthemes_divider type="center"]' ),
								addSubmenu('Divider Left', '[rockthemes_divider type="left"]' ),
								addSubmenu('Youtube Video', '[rockthemes_youtube_video]Enter your video link here[/rockthemes_youtube_video]' )];
			
			editor.addButton( "rockthemes_plugins_btn", {
							type:'menubutton',
							text:'Shortcodes',
							title: 'Insert Shortcodes',
							image : url.replace("js","images/")+'rockthemes-shortcodes-icon.png',
							icon: false,
							menu:sub_menu_buttons
			});
			
			
		});

	}
)();
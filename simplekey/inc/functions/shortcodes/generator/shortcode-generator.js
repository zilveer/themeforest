// -----------------------------------------------------------------------------------------------------------------------------------------------

	function vanshortcodes_plugin( url, params )
	{
		var popup = params;
		
		tb_show( "Insert Shortcode", url + '/shortcode-generator-form.php?popup=' + popup + "&width=" + 640 + "&height="+790 );
	}
	
	(function()
	{
		tinymce.create( 'tinymce.plugins.vanshortcodes',
							{
								init: function( ed, url )
								{
									ed.addButton( 'vanshortcodes',
													{
														title: 'Insert Shortcode',
														onclick: function()
														{
															ed.execCommand( 'mceInsertContent',
																				false,
																				vanshortcodes_plugin( url )
																			);
														},
														image: url + "/shortcode-generator.png"
													}
												);
								}
							}
						);
	 
		tinymce.PluginManager.add( 'vanshortcodes', tinymce.plugins.vanshortcodes );
	 
	})();

// -----------------------------------------------------------------------------------------------------------------------------------------------
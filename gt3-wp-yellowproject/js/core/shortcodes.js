var initshortcode = 1;

(function($) {
	tinymce.create('tinymce.plugins.shortcodes', {
		init : function(ed, url) {
			ed.addButton('shortcodes', {
				title : 'Get custom shortcodes',
				image : url+'/shortcode.png',
				onclick : function() {
					jQuery(function ($)    
					{
						$('.shortcodesContainer').dialog({
							modal: false,
							/*close: function(ev, ui) {
								$(this).remove();
							},*/
							open: function ()
							{
								$(this).load(ajaxurl, {"action": "getshortcodesUI"});
							},         
							minwidth: 300,
							minheight: 200,
							title: 'Shortcodes'
						});
					});

					if (initshortcode==1) {
						jQuery('.insertshortcode').live("click", function(){
							var thisShortCodeName = jQuery(this).parents(".shortcodeitem").attr("shortcodename");
							
							/* exec shortcode compiller */
							
							handlerName = thisShortCodeName + "_handler";
							var thisHandler = window[handlerName];
							thisHandler();
							
							//alert(handler_result);
							
							var whatInsert = jQuery(this).delay(300).parents(".shortcodeitem").find(".whatInsert").html();
							ed.execCommand('mceInsertContent', false, whatInsert);
						});
						
						jQuery(".select_shortcode").live("change", function(){
							var nowSelect = jQuery(this).val();
							jQuery(".shortcodeitem").hide();
							jQuery("."+nowSelect).show();
						});
						initshortcode++;
					}
						
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
        getInfo : function() {
            return {
                longname : "Shortcodes",
                author : 'GT3',
                authorurl : 'http://gt3themes.com/',
                infourl : 'http://gt3themes.com/',
                version : "1.0"
            };
        }
	});
	tinymce.PluginManager.add('shortcodes', tinymce.plugins.shortcodes);
})();
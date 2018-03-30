(function() {
	tinymce.create('tinymce.plugins.thbtiny', {
		init : function(ed, url) {
		 ed.addCommand('shortcodeGenerator', function() {
		 		tb_show("Shortcodes", url + '/shortcode_generator/shortcode-generator.php?&width=630&height=600');
		 });
			//Add button
			ed.addButton('scgenerator', {	title : 'Shortcode Generator', cmd : 'shortcodeGenerator', image : url + '/shortcode_generator/icons/shortcode-generator.png' });
        },
        createControl : function(n, cm) {
			  return null;
        },
		  getInfo : function() {
			return {
				longname : 'Shortcode Generator',
				author : 'fuelthemes',
				authorurl : 'http://fuelthemes.net',
				infourl : 'http://fuelthemes.net',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
    });
    tinymce.PluginManager.add('thb_buttons', tinymce.plugins.thbtiny);
})();
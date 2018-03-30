(function() {
    tinymce.create('tinymce.plugins.contentHolders', {
        init : function(ed, url) {
            ed.addButton('contentHolders', {
                title : 'Add content holders and separators',
                image : url+'/content-holders-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/content-holders-window.php',
						width : 510,
						height : 210,
						inline : 1
					});					 

                }
            });
		
        },		
		
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('contentHolders', tinymce.plugins.contentHolders);
})();
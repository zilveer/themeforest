(function() {
    tinymce.create('tinymce.plugins.qa', {
        init : function(ed, url) {
            ed.addButton('qa', {
                title : 'Add Q/A',
                image : url+'/qa-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/qa-window.php',
						width : 510,
						height : 190,
						inline : 1
					});					 

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('qa', tinymce.plugins.qa);
})();
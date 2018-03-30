(function() {
    tinymce.create('tinymce.plugins.tabs', {
        init : function(ed, url) {
            ed.addButton('tabs', {
                title : 'Add tabs',
                image : url+'/tabs-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/tabs-window.php',
						width : 510,
						height : 260,
						inline : 1
					});					 

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);
})();
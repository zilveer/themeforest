(function() {
    tinymce.create('tinymce.plugins.columns', {
        init : function(ed, url) {
            ed.addButton('columns', {
                title : 'Add full width columns',
                image : url+'/columns-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/columns-window.php',
						width : 580,
						height : 188,
						inline : 1
					});					 

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('columns', tinymce.plugins.columns);
})();
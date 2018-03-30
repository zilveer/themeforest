(function() {
    tinymce.create('tinymce.plugins.lists', {
        init : function(ed, url) {
            ed.addButton('lists', {
                title : 'Add lists',
                image : url+'/list-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/lists-window.php',
						width : 510,
						height : 280,
						inline : 1
					});					 

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('lists', tinymce.plugins.lists);
})();
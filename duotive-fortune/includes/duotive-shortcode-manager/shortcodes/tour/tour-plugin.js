(function() {
    tinymce.create('tinymce.plugins.tour', {
        init : function(ed, url) {
            ed.addButton('tour', {
                title : 'Add tour',
                image : url+'/tour-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/tour-window.php',
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
    tinymce.PluginManager.add('tour', tinymce.plugins.tour);
})();
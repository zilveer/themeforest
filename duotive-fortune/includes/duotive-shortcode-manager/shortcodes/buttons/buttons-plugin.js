(function() {
    tinymce.create('tinymce.plugins.buttons', {
        init : function(ed, url) {
            ed.addButton('buttons', {
                title : 'Add buttons',
                image : url+'/buttons-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/buttons-window.php',
						width : 640,
						height : 380,
						inline : 1
					});					 

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('buttons', tinymce.plugins.buttons);
})();
(function() {
    tinymce.create('tinymce.plugins.accordion', {
        init : function(ed, url) {
            ed.addButton('accordion', {
                title : 'Add an accordion',
                image : url+'/accordion-icon.png',
                onclick : function() {
					ed.windowManager.open({
						file : url + '/accordion-window.php',
						width : 640,
						height : 200,
						inline : 1
					});					 

                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);
})();
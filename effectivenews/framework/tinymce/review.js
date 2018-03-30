(function() {
    tinymce.create('tinymce.plugins.review', {
        init : function(ed, url) {
            ed.addButton('review', {
                title : 'Insert Review',
                image : url+'/images/graph.png',
                onclick : function() {
		    ed.insertContent('[review]');
		}
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('review', tinymce.plugins.review);
    
    // executes this when the DOM is ready
})();

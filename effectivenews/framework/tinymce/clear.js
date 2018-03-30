(function() {
    tinymce.create('tinymce.plugins.clear', {
        init : function(ed, url) {
            ed.addButton('clear', {
                title : 'Add a clear',
                image : url+'/images/clear.png',
              onclick : function() {

                     ed.selection.setContent('[clear]');  

              }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('clear', tinymce.plugins.clear);
     
})();

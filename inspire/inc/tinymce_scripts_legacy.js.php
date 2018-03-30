<?php header('Content-type: text/javascript'); ?>

<?php include 'tinymce_sc_array.php' ?>

(function() {  
    tinymce.create('tinymce.plugins.canon_tinymce_shortcodes_plugin', {  
        init : function(ed, url) {  
        },  
        createControl : function(n, cm) {  
            switch (n) {
                case 'canon_tinymce_shortcodes_select':
                    var mlb = cm.createListBox('canon_tinymce_shortcodes_select', {
                        title : 'Shortcodes',
                        onselect : function(v) {

                            var split_value = v.split('\x00');

                            if(tinyMCE.activeEditor.selection.getContent() != ''){
                                tinyMCE.activeEditor.selection.setContent(split_value[0] + tinyMCE.activeEditor.selection.getContent() + split_value[2]);
                            }
                            else{
                                tinyMCE.activeEditor.selection.setContent(v);
                            }
                        }
                    });

                    <?php 
                        foreach($sc_array as $key => $value) {
                        echo "mlb.add('". $key ."', '". $value ."');";                                
                        }
                    ?>

                    return mlb;
            }
            return null;
        },
    });  
    tinymce.PluginManager.add('canon_tinymce_shortcodes_plugin', tinymce.plugins.canon_tinymce_shortcodes_plugin);  

})();


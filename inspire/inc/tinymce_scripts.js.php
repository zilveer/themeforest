<?php header('Content-type: text/javascript'); ?>

<?php include 'tinymce_sc_array.php' ?>

(function() {
    
    "use strict";   
 
    tinymce.PluginManager.add( 'canon_tinymce_shortcodes_plugin', function( editor, url ) {

        editor.addButton( 'canon_tinymce_shortcodes_select', {
            type: 'listbox',
            text: 'Shortcodes',
			classes: 'inspire-shortcode',
			style: 'width: 95px; margin-left:6px; margin-top:2px; padding:2px 4px; display:inline-block; -webkit-border-radius: 0; border-radius: 0; direction: ltr; background: #fff; border: 1px solid #ddd; -webkit-box-shadow: inset 0 1px 1px -1px rgba(0,0,0,.2); box-shadow: inset 0 1px 1px -1px rgba(0,0,0,.2);',
            icon: false,
            onselect: function(e) {
            }, 
            values: [
             
            <?php 
                foreach($sc_array as $key => $value) {
                ?>

                    {
                        text: '<?php echo $key; ?>', 
                        onclick : function() {

                            var value = '<?php echo $value ?>';
                            var split_value = value.split('\x00');
                            value = (tinyMCE.activeEditor.selection.getContent() != '') ? split_value[0] + tinyMCE.activeEditor.selection.getContent() + split_value[2] : value;
                            tinyMCE.activeEditor.selection.setContent(value)

                        }
                    },

                <?php
                }
            ?>

            ]
 
        });
 
  });
 
})();
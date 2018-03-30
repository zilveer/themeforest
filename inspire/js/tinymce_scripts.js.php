<?php header('Content-type: text/javascript'); ?>

<?php 

$sc_array = array(
    'button' => '[button url="URL" color="COLOR"]\x00BUTTON NAME\x00[/button]',
    'bigbutton' => '[bigbutton url="URL" color="COLOR"]\x00BUTTON NAME\x00[/bigbutton]',
    'tabs' => '[tabs tab1=\"TITLE\" tab2=\"TITLE\" tab3=\"TITLE\"]<br /><br />[tab id=1]CONTENT[/tab]<br />[tab id=2]CONTENT[/tab]<br />[tab id=3]CONTENT[/tab]<br /><br />[/tabs]',
    'toggle' => '[toggle title="TITLE"]\x00CONTENT\x00[/toggle]',
    'alert' => '[alert color="COLOR"]\x00CONTENT\x00[/alert]',
    'highlight' => '[highlight]\x00CONTENT\x00[/highlight]',
    'highlightdark' => '[highlightdark]\x00CONTENT\x00[/highlightdark]',
    'dropcap' => '[dropcap style="STYLE"]\x00CONTENT\x00[/dropcap]',
    'blockquote' => '[blockquote]\x00CONTENT\x00[/blockquote]',
    'column' => '[column size="SIZE" last="YES/NO"]\x00CONTENT\x00[/column]',
    'embed' => '[embed width="650"]\x00URL\x00[/embed]',
    'lorem' => '[lorem paragraphs="NUMBER"]'
);

//sort array alphabetically
array_multisort($sc_array);

?>

(function() {  
    tinymce.create('tinymce.plugins.shortcodeselect', {  
        init : function(ed, url) {  
        },  
        createControl : function(n, cm) {  
            switch (n) {
                case 'shortcodeselect':
                    var mlb = cm.createListBox('shortcodeselect', {
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
    tinymce.PluginManager.add('shortcodeselect', tinymce.plugins.shortcodeselect);  

})();
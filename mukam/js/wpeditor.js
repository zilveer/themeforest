(function() {
    tinymce.create('tinymce.plugins.mukam', {
        init : function(ed, url) {

            ed.addButton('mukam_price_row', {
                title : 'Table Price Row',
                cmd : 'mukam_price_row',
                image : url + '/img/tinyprice.png'
            });

            ed.addButton('mukam_row', {
                title : 'Table Row',
                cmd : 'mukam_row',
                image : url + '/img/tinyrow.png'
            }); 
 
            ed.addButton('mbuttons', {
                title : 'Mestro Buttons',
                cmd : 'mbuttons',
                image : url + '/img/tinybutton.png'
            });

            ed.addCommand('mukam_price_row', function() {
               var color = prompt ("Row Color", "Write greypricing or back-inherit");
               var currency = prompt ("Currency", "Write your currency, e.g. $");
               var price = prompt ("Price", "Write your price");
               var title = prompt ("Title", "Write your title");
               var subtitle = prompt ("Subtitle", "Write your subtitle");
         
               ed.execCommand('mceInsertContent', false, '[mukam_price_row subtitle="'+subtitle+'" price="'+price+'" currency="'+currency+'" color="'+color+'" title="'+title+'"][/mukam_price_row]');

            });

            ed.addCommand('mukam_row', function() {
               var color = prompt ("Row Color", "Leave blank or If you want to bgcolor your row, write darkgrey.");
               var title = prompt ("Title", "Write your title");
         
               ed.execCommand('mceInsertContent', false, '[mukam_row color="'+color+'" title="'+title+'"][/mukam_row]');

            });
 
            ed.addCommand('mbuttons', function() {
               var color = prompt ("Color", "asset, blue, pink, green, orange, purple, darkgrey, black, dusty, red");
               var animation = prompt ("Animation", "Write buton-1 or ...buton-6");
               var url = prompt ("URL", "Paste your url");
               var content = prompt ("Text", "text");
               var b_size = prompt ("Button Size", "Write your button size: mini, small, medium, large")
               
               ed.execCommand('mceInsertContent', false, '[mbuttons b_size="buton-'+b_size+'" color="b_'+color+'" transition="'+animation+'" url="'+url+'"]'+content+'[/mbuttons]');

            });

        },
        // ... Hidden code
    });
    // Register plugin
    tinymce.PluginManager.add( 'mukam_tiny', tinymce.plugins.mukam );
})();
(function() {  
    tinymce.create('tinymce.plugins.package_content', {  
        init : function(ed, url) {  
            ed.addButton('package_content', {  
                title : 'Package Sample Content',  
                image : url + '/images/package_content.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent(
'[quote align="center"]Donec ullamcorper nulla non metus auctor fringilla. Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.[/quote]\
\
[tb_google_map address="6921 Brayton Drive, Anchorage, Alaska" zoom="11" height="280px"]\
[space height="40"]\
\
<table>\
<tbody>\
<tr>\
<th>FLIGHT FROM</th>\
<th>DESTINATION</th>\
<th>DATE</th>\
<th>DEPARTS</th>\
<th>ARRIVES</th>\
</tr>\
<tr>\
<td>Seattle</td>\
<td>Paris</td>\
<td>20 Dec 2012</td>\
<td>10:00</td>\
<td>20:40</td>\
</tr>\
<tr>\
<td>Paris</td>\
<td>Seattle</td>\
<td>28 Dec 2012</td>\
<td>22:10</td>\
<td>08:50</td>\
</tr>\
</tbody>\
</table>\
\
[space height=10]\
\
<strong>Morbi leo risus, porta ac consectetur</strong> ac, vestibulum at eros. Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non magna. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.Vestibulum id ligula porta felis euismod semper. Donec ullamcorper nulla non metus auctor fringilla. Donec sed odio dui.\
\
[space height=10]\
\
[column col="1/2"]\
[youtube height="200" width="290" align="left"]http://www.youtube.com/watch?v=5Yn1-xEXTk0[/youtube][/column]\
[column col="1/2" last="true"]\
<h3>Mollis Ipsum Mattis Commodo</h3>\
[list type="icon-upload"]\
[li]Aenean lacinia bibendum nulla sed.[/li]\
[li]Cum sociis natoque penatibus et magnis dis.[/li]\
[li]Vestibulum Adipiscing Ornare Magna[/li]\
[li]Nullam quis risus eget urna veleru leo.[/li]\
[li]Cras mattis consect met fermentum.[/li]\
[/list]\
[/column]\
\
[space height=10]\
\
<h3>Day1</h3>\
<strong>Aenean eu leo quam pellentesque ornare.</strong> Sem lacinia quam venenatis vestibulum. Donec ullamcorper nulla non metus auctor fringilla. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam quis risus eget urna mollis ornare vel eu leo.\
\
<h3>Day2</h3>\
<strong>Integer posuere erat a ante venenatis dapibus</strong> posuere velit aliquet. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Nullam quis risus eget urna mollis ornare vel eu leo. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.\
\
<h3>Day3</h3>\
<strong>Sed posuere consectetur est at lobortis.</strong> Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\
\
<h3>Day4</h3>\
<strong>Donec ullamcorper nulla non metus auctor fringilla.</strong> Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec ullamcorper nulla non metus auctor fringilla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras mattis consectetur purus sit amet fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.'
					);  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('package_content', tinymce.plugins.package_content);  
})(); 
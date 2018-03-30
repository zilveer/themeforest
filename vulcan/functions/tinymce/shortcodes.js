// Creates a new plugin
(function() {
    tinymce.create('tinymce.plugins.IndonezShortcodes', {

        init : function(ed, url) {
			// Add a button that opens a window
			ed.addButton('columns', {
				type: 'menubutton',
				text: 'Shortcodes',
				icon: false,
				onclick : function(e) {},
				menu: [
				{
                    text: 'Columns',
					
						//sub menu columns
						menu: [
							{
								text: 'One Half',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[col_12]content here[/col_12]');
								}
							},
              {
								text: 'One Half Last',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[col_12_last]content here[/col_12_last]');
								}
							},
							{
								text: 'One Third',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[col_13]content here[/col_13]');
								}
							},
              {
								text: 'One Third Last',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[col_13_last]content here[/col_13_last]');
								}
							},
							{
								text: 'One Fourth',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[col_14]content here[/col_14]');
								}
							},
              {
								text: 'One Fourth Last',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[col_14_last]content here[/col_14_last]');
								}
							},
							{
								text: 'Two Third',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[col_23]content here[/col_23]');
								}
							},
	 
							{
								text: 'Three Foruth',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[col_34]content here[/col_34]');
								}
							},
              {
								text: 'Two Third Last',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[col_23_last]content here[/col_23_last]');
								}
							},
	 
							{
								text: 'Three Foruth Last',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[col_34_last]content here[/col_34_last]');
								}
							},
	 
						]
						//end sub menu columns
                }, 
				//end columns
				
                {
                    text: 'Elements',
					
						//sub menu elements
						menu: [
              {
								text: 'Dropcap1',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[dropcap][/dropcap]');
								}
							},
							{
								text: 'Pullquote Left',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[pullquote_left]text here[/pullquote_left]');
								}
							},
							{
								text: 'Pullquote Right',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[pullquote_right]text here[/pullquote_right]');
								}
							},
							{
								text: 'Image',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[image source="" align=""]');
								}
							},
							{
								text: 'Button',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[button link="" size="" color=""]Your text here[/button]');
								}
							},
              {
								text: 'Info Box',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[info]text here[/info]');
								}
							},
              {
								text: 'Success Box',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[success]text here[/success]');
								}
							},
              {
								text: 'Warning Box',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[warning]text here[/warning]');
								}
							},
              {
								text: 'Error Box',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[error]text here[/error]');
								}
							},
						]
						//end sub menu elements
                },
				//end elements
				
                {
                    text: 'List Style',
					
						//sub menu list style
						menu: [
							{
								text: 'Bullet',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[bulletlist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/bulletlist]');
								}
							},
							{
								text: 'Star',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[starlist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/starlist]');
								}
							},
							{
								text: 'Check',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[checklist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/checklist]');
								}
							},
							{
								text: 'Arrow',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[arrowlist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/arrowlist]');
								}
							},
							{
								text: 'Square',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[squarelist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/squarelist]');
								}
							},
              {
								text: 'Gear',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[gearlist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/gearlist]');
								}
							},
              {
								text: 'Green Arrow',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[green_arrowlist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/green_arrowlist]');
								}
							},
							{
								text: 'Delete',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[deletelist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/deletelist]');
								}
							}
						]
						//end sub menu list style
                },
				//end list style
				
                {
                    text: 'Content',
					
						//sub menu content
						menu: [
              {
								text: 'Staff List',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[stafflist num=4 orderby="date" title=""]');
								}
							},
              {
								text: 'Pricing Table 3 Col',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[pricing column=3]'+"<br/>"+'[item title="Standard" subtitle="Best for starter" price="$10" per="month" button_url="#" button_text="Order" color=""]\r<ul>\r<li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[item title="Standard" price="$10" per="month" button_url="#" subtitle="Best for starter" button_text="Order" color="orange" featured="yes"]\r<ul>\r<li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[item title="Standard" price="$10" per="month" button_url="#" subtitle="Best for starter" button_text="Order" color=""]\r<ul>\r<li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[/pricing]');
								}
							},
							{
								text: 'Pricing Table 4 Col',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[pricing column=4]'+"<br/>"+'[item title="Standard" subtitle="Best for starter" price="$10" per="month" button_url="#" button_text="Order" color=""]\r<ul>\r<li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[item title="Standard" subtitle="Best for starter" price="$10" per="month" button_url="#" button_text="Order" color=""]\r<ul>\r<li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[item title="Standard" subtitle="Best for starter" price="$10" per="month" button_url="#" button_text="Order" color="green"  featured="yes"]\r<ul>\r<li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[item title="Standard" price="$10" per="month" button_url="#" subtitle="Best for starter" button_text="Order" color=""]\r<ul\r><li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[/pricing]');
								}
							},
							{
								text: 'Pricing Table 5 Col',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[pricing column=5]'+"<br/>"+'[item title="Standard" subtitle="Best for starter" price="$10" per="month" button_url="#" button_text="Order" color=""]\r<ul>\r<li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[item title="Standard" subtitle="Best for starter" price="$10" per="month" button_url="#" button_text="Order" color=""]\r<ul><li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[item title="Standard" subtitle="Best for starter" price="$10" per="month" button_url="#" button_text="Order" color="blue" featured="yes"]\r<ul>\r<li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[item title="Standard" subtitle="Best for starter" price="$10" per="month" button_url="#" button_text="Order" color=""]\r<ul>\r<li>unordered list content</li>\r<li>unordered list content</li></ul>\r[/item]'+"<br/>"+'[item title="Standard" price="$10" per="month" button_url="#" subtitle="Best for starter" button_text="Order" color=""]\r<ul>\r<li>unordered list content</li>\r<li>unordered list content</li>\r</ul>\r[/item]'+"<br/>"+'[/pricing]');
								}
							},
							{
								text: 'Tabs',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[tabs]'+"\r\n"+'[tab title="your title here"]your content here[/tab]'+"\r\n"+'[/tabs]');
								}
							},
							{
								text: 'Toggle',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[toggle title="your title here"]your content here[/toggle]');
								}
							},
              {
								text: 'Accordion',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[accordions][accordion title="title"]your content here[/accordion]');
								}
							},
              {
								text: 'Google Map',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[gmap width="" height="" latitude="" longitude="" zoom="" html="" popup=""]');
								}
							},
              {
								text: 'Youtube',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[youtube_video id= width="" height=""]');
								}
							},
              {
								text: 'Vimeo',
								onclick: function(){
									tinyMCE.activeEditor.selection.setContent('[vimeo_video id= width="" height=""]');
								}
							},
              
						]
						//end sub menu content
                }
				//end content
            ]
			//end menu
				
			});
			
			
        }

    });

    tinymce.PluginManager.add('IndonezShortcodes', tinymce.plugins.IndonezShortcodes);

})();
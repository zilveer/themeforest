( function() {
	tinymce.PluginManager.add( 'oboxbutton', function( editor, url ) {

		// Add a button that opens a window
		editor.addButton( 'oboxbutton', {
			type: 'menubutton',
			icon: 'obox-button',
			icon_url: template_directory+'/ocmx/images/oboxbutton.png',
			menu: [
					// Styled Boxes (Submenu)
					{ text: 'Styled boxes',
						menu: [
							{text : 'Info', onclick: function() {editor.insertContent('<div class="obox-alert obox-info">Your Text Here</div> ');}},							{text : 'Success', onclick: function() {editor.insertContent('<div class="obox-alert obox-success">Your Text Here</div> ');}},
							{text : 'Failure', onclick: function() {editor.insertContent('<div class="obox-alert obox-failure">Your Text Here</div>');}},
						]
					},
					{ text: 'Small CSS Buttons',
						menu: [
							{text : 'Black', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-black obox-small">Small Button</a>');}},
							{text : 'Blue', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-blue obox-small">Small Button</a>');}},
							{text : 'Green', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-green obox-small">Small Button</a>');}},
							{text : 'Grey', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-grey obox-small">Small Button</a>');}},
							{text : 'Navy', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-navy obox-small">Small Button</a>');}},
							{text : 'Orange', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-orange obox-small">Small Button</a>');}},
							{text : 'Purple', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-purple obox-small">Small Button</a>');}},
							{text : 'Red', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-red obox-small">Small Button</a>');}},
							{text : 'Teal', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-teal obox-small">Small Button</a>');}},
							{text : 'White', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-white obox-small">Small Button</a>');}},
						]
					},
					// CSS Large Buttons (Submenu)
					{ text: 'Large CSS Buttons',
						menu: [
							{text : 'Black', onclick: function() {editor.insertContent('<a hhref="#" class="obox-button obox-black obox-large">Large Button</a>');}},
							{text : 'Blue', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-blue obox-large">Large Button</a>');}},
							{text : 'Green', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-green obox-large">Large Button</a>');}},
							{text : 'Grey', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-grey obox-large">Large Button</a>');}},
							{text : 'Navy', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-navy obox-large">Large Button</a>');}},
							{text : 'Orange', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-orange obox-large">Large Button</a>');}},
							{text : 'Purple', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-purple obox-large">Large Button</a>');}},
							{text : 'Red', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-red obox-large">Large Button</a>');}},
							{text : 'Teal', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-teal obox-large">Large Button</a>');}},
							{text : 'White', onclick: function() {editor.insertContent('<a href="#" class="obox-button obox-white obox-large">Large Button</a>');}},
						]
					},
					// Columns (Submenu)
					{ text: 'Columns',
						menu: [
							{text : '2 Columns', onclick: function() {editor.insertContent('<ul class="obox-grid obox-two-column"><li class="obox-column"><h4>Column 1</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 2</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li></ul>');}},
							{text : '3 Columns', onclick: function() {editor.insertContent('<ul class="obox-grid obox-three-column"><li class="obox-column"><h4>Column 1</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 2</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 3</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li></ul>');}},
							{text : '4 Columns', onclick: function() {editor.insertContent('<ul class="obox-grid obox-four-column"><li class="obox-column"><h4>Column 1</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 2</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 3</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 4</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li></ul>');}},
							{text : '5 Columns', onclick: function() {editor.insertContent('<ul class="obox-grid obox-five-column"><li class="obox-column"><h4>Column 1</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 2</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 3</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 4</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 5</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li></ul>');}},
							{text : '6 Columns', onclick: function() {editor.insertContent('<ul class="obox-grid obox-six-column"><li class="obox-column"><h4>Column 1</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 2</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 3</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 4</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 5</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li><li class="obox-column"><h4>Column 6</h4> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa.</p></li></ul>');}},
						]
					},
					// Dropcaps
					{text : 'Dropcaps', onclick: function() {editor.insertContent('<p class="obox-dropcaps">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vitae massa velit, eu laoreet massa. Sed ac orci libero, eu dignissim enim. Aenean urna sem, cursus ut elementum sed, pellentesque ac massa. Mauris sit amet semper massa. Aliquam vitae nunc vestibulum mauris tempor suscipit id sed lacus. Vestibulum arcu risus, porta eget auctor id, rhoncus et massa. Aliquam erat volutpat.</p>');}},
					{text : 'Divider', onclick: function() {editor.insertContent('<hr class="obox-divider" />');}},
					{text : 'Highlighted Text', onclick: function() {editor.insertContent('<p class="obox-highlighted">Your Text Here</p>');}}
			]

		} );

	} );

} )();
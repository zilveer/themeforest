(function() {
	// TinyMCE plugin start.
	tinymce.PluginManager.add( 'RicherTinyMCEShortcodes', function( editor, url ) {
		// Register a command to open the dialog.
		editor.addCommand( 'richer_open_dialog', function( ui, v ) {
			richerSelectedShortcodeType = v;
			selectedText = editor.selection.getContent({format: 'text'});
			tb_dialog_helper.loadShortcodeDetails();
			tb_dialog_helper.setupShortcodeType( v );

			jQuery( '#shortcode-options' ).addClass( 'shortcode-' + v );
			jQuery( '#selected-shortcode' ).val( v );

			var f=jQuery(window).width();
			b=jQuery(window).height();
			f=720<f?720:f;
			f-=80;
			b-=120;

			tb_show( "Insert ["+ v +"] shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=dialog" );
		});

		// Register a command to insert the self-closing shortcode immediately.
		editor.addCommand( 'richer_insert_self_immediate', function( ui, v ) {
			editor.insertContent( '[' + v + ']' );
		});

		// Register a command to insert the enclosing shortcode immediately.
		editor.addCommand( 'richer_insert_immediate', function( ui, v ) {
			var selected = editor.selection.getContent({format: 'text'});
			var sh = v.split(' ');
			editor.insertContent( '[' + v + ']' + selected + '[/' + sh[0] + ']' );
		});

		// Register a command to insert the N-enclosing shortcode immediately.
		editor.addCommand( 'richer_insert_immediate_n', function( ui, v ) {
			var arr = v.split('|'),
				selected = editor.selection.getContent({format: 'text'}),
				sortcode;

			for (var i = 0, len = arr.length; i < len; i++) {
				if (0 === i) {
					sortcode = '[' + arr[i] + ']' + selected + '[/' + arr[i] + ']';
				} else {
					sortcode += '[' + arr[i] + '][/' + arr[i] + ']';
				};
			};
			editor.insertContent( '[row]'+sortcode+'[/row]' );
		});

		// Register a command to insert `Tabs` shortcode.
		editor.addCommand( 'richer_insert_tabs', function( ui, v ) {
			editor.insertContent( '[tabgroup]<br />[tab title="Tab 1"]Tab 1 content goes here.[/tab]<br />[tab title="Tab 2" icon="fa-calendar"]Tab 2 content goes here.[/tab]<br />[tab icon="fa-cogs"]Tab 3 content goes here.[/tab]<br />[/tabgroup]' ); // direction - top, right, below, left
		});

		// Register a command to insert `Vertical Tabs` shortcode.
		editor.addCommand( 'richer_insert_vertical_tabs', function( ui, v ) {
			editor.insertContent( '[tabgroup_vertical]<br />[tab title="Tab 1"]Tab 1 content goes here.[/tab]<br />[tab title="Tab 2" icon="fa-calendar"]Tab 2 content goes here.[/tab]<br />[tab icon="fa-cogs"]Tab 3 content goes here.[/tab]<br />[/tabgroup_vertical]' ); // direction - top, right, below, left
		});

		// Register a command to insert `Accordion` shortcode.
		editor.addCommand( 'richer_insert_accordions', function( ui, v ) {
			editor.insertContent( '[accordion open="2"]<br />[accordion_item title="First Tab Title"]Your Text[/accordion_item]<br />[accordion_item title="Second Tab Title"]Your Text[/accordion_item]<br />[accordion_item title="Third Tab Title"]Your Text[/accordion_item]<br />[/accordion]' );
		});

		// Register a command to insert `Clients` shortcode.
		editor.addCommand( 'richer_insert_clients', function( ui, v ) {
			editor.insertContent( '[clients][client link="" logo_url=""][client link="" logo_url=""][client link="" logo_url=""][client link="" logo_url=""][client link="" logo_url=""][/clients]' );
		});
		// Register a command to insert `Images` shortcode.
		editor.addCommand( 'richer_insert_images', function( ui, v ) {
			editor.insertContent( '[images][image_item lightbox="yes" image_url=""][image_item lightbox="yes" image_url=""][image_item lightbox="yes" image_url=""][image_item lightbox="yes" image_url=""][image_item lightbox="yes" image_url=""][/images]' );
		});
		// Register a command to insert `Gap` shortcode.
		editor.addCommand( 'richer_insert_gap', function( ui, v ) {
			editor.insertContent( '[gap height="30"]' );
		});
		// Register a command to insert `Table` shortcode.
		editor.addCommand( 'richer_insert_table', function( ui, v ) {
			editor.insertContent(
				'[table style="1, 2 or 3"]'
				+'<table width="100%">'
				+'<thead>'
				+'<tr>'
				+'<th>Column 1</th>'
				+'<th>Column 2</th>'
				+'<th>Column 3</th>'
				+'<th>Column 4</th>'
				+'</tr>'
				+'</thead>'
				+'<tbody>'
				+'<tr>'
				+'<td>Item #1</td>'
				+'<td>Description</td>'
				+'<td>Subtotal:</td>'
				+'<td>$1.00</td>'
				+'</tr>'
				+'<tr>'
				+'<td>Item #2</td>'
				+'<td>Description</td>'
				+'<td>Discount:</td>'
				+'<td>$2.00</td>'
				+'</tr>'
				+'<tr>'
				+'<td>Item #3</td>'
				+'<td>Description</td>'
				+'<td>Shipping:</td>'
				+'<td>$3.00</td>'
				+'</tr>'
				+'<tr>'
				+'<td>Item #4</td>'
				+'<td>Description</td>'
				+'<td>Tax:</td>'
				+'<td>$4.00</td>'
				+'</tr>'
				+'<tr>'
				+'<td><strong>All Items</strong></td>'
				+'<td><strong>Description</strong></td>'
				+'<td><strong>Your Total:</strong></td>'
				+'<td><strong>$10.00</strong></td>'
				+'</tr>'
				+'</tbody>'
				+'</table>'
				+'[/table]'
			);
		});
		// Register a command to insert `Table` shortcode.
		editor.addCommand( 'richer_insert_pricing_plan', function( ui, v ) {
			editor.insertContent(
				'[pricing-table col="4" style="style3"]'
				+'[plan]'
				+'<ul>'
					+'<li>Number of Users</li>'
					+'<li>Number of Projects</li>'
					+'<li>Disc Space</li>'
					+'<li>Support Type</li>'
					+'<li>Free Trial</li>'
				+'</ul>'
				+'[/plan]'
				+'[plan name="Basic" link="#" linkname="Select" price="$109" per="/mo" color="#71be3c"]'
				+'<ul>'
					+'<li><strong>1</strong> User</li>'
					+'<li><strong>10</strong> Projects</li>'
					+'<li><strong>5</strong> GB Space</li>'
					+'<li><strong>Free</strong> Chat Support</li>'
					+'<li><strong>14</strong> Days Free Trial</li>'
				+'</ul>'
				+'[/plan]'
				+'[plan name="Professional" link="#" linkname="Select" price="$149" per="/mo" color="#3498db" extra_height="yes"]'
				+'<ul>'
					+'<li><strong>6</strong> User</li>'
					+'<li><strong>20</strong> Projects</li>'
					+'<li><strong>15</strong> GB Space</li>'
					+'<li><strong>Free</strong> Chat Support</li>'
					+'<li><strong>14</strong> Days Free Trial</li>'
				+'</ul>'
				+'[/plan]'
				+'[plan name="Standard" link="#" linkname="Select" price="$139" per="/mo" color="#71be3c"]'
				+'<ul>'
					+'<li><strong>2</strong> User</li>'
					+'<li><strong>15</strong> Projects</li>'
					+'<li><strong>10</strong> GB Space</li>'
					+'<li><strong>Free</strong> Chat Support</li>'
					+'<li><strong>14</strong> Days Free Trial</li>'
				+'</ul>'
				+'[/plan][/pricing-table]'
			);
		});
// Register a command to insert `Table` shortcode.
		editor.addCommand( 'richer_insert_pricing_table', function( ui, v ) {
			editor.insertContent(
				'[pricing-table][row]'
				+'[span3][plan name="Basic" link="#" linkname="Select" price="$109" per="/mo" color="#71be3c"]'
				+'<ul>'
					+'<li><strong>1</strong> User</li>'
					+'<li><strong>10</strong> Projects</li>'
					+'<li><strong>5</strong> GB Space</li>'
					+'<li><strong>Free</strong> Chat Support</li>'
					+'<li><strong>14</strong> Days Free Trial</li>'
				+'</ul>'
				+'[/plan][/span3]'
				+'[span3][plan name="Standard" link="#" linkname="Select" price="$139" per="/mo" color="#71be3c"]'
				+'<ul>'
					+'<li><strong>2</strong> User</li>'
					+'<li><strong>15</strong> Projects</li>'
					+'<li><strong>10</strong> GB Space</li>'
					+'<li><strong>Free</strong> Chat Support</li>'
					+'<li><strong>14</strong> Days Free Trial</li>'
				+'</ul>'
				+'[/plan][/span3]'
				+'[span3][plan name="Professional" link="#" linkname="Select" price="$149" per="/mo" color="#3498db"]'
				+'<ul>'
					+'<li><strong>6</strong> User</li>'
					+'<li><strong>20</strong> Projects</li>'
					+'<li><strong>15</strong> GB Space</li>'
					+'<li><strong>Free</strong> Chat Support</li>'
					+'<li><strong>14</strong> Days Free Trial</li>'
				+'</ul>'
				+'[/plan][/span3]'
				+'[span3][plan name="ENTERPRICE" link="#" linkname="Select" price="$249" per="/mo" color="#71be3c"]'
				+'<ul>'
					+'<li><strong>6</strong> User</li>'
					+'<li><strong>20</strong> Projects</li>'
					+'<li><strong>15</strong> GB Space</li>'
					+'<li><strong>Free</strong> Chat Support</li>'
					+'<li><strong>14</strong> Days Free Trial</li>'
				+'</ul>'
				+'[/plan][/span3][/row][/pricing-table]'
			);
		});
		// Add a button that opens a window
		editor.addButton( 'richer_shortcodes_button', {
			type: 'menubutton',
			icon: 'icon dashicons dashicons-text',
			tooltip: 'Insert Richer Shortcode',
			menu: [
				// Content menu.
				{text: 'Content', menu: [
					{text: 'Accordion', onclick: function() { editor.execCommand( 'richer_insert_accordions', false, 'accordion', { title: 'Accordion' } ); } },
					{text: 'Clients', onclick: function() { editor.execCommand( 'richer_insert_clients', false, 'clients', { title: 'Clients' } ); } },
					{text: 'Images', onclick: function() { editor.execCommand( 'richer_insert_images', false, 'images', { title: 'Images' } ); } },
					{text: 'Portfolio', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'portfolio', { title: 'Portfolio' } ); } },
					{text: 'Recent Posts', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'recentposts', { title: 'Recent Posts' } ); } },
					{text: 'Recent comments', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'recentcomments', { title: 'Recent comments' } ); } },
					{text: 'Soundcloud', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'soundcloud', { title: 'Soundcloud' } ); } },
					{text: 'Tabs', onclick: function() { editor.execCommand( 'richer_insert_tabs', false, 'tabgroup', { title: 'Tabs' } ); } },
					{text: 'Testimonial', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'testimonial', { title: 'Testimonial' } ); } },
					{text: 'TestiCarousel', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'testimonial_carousel', { title: 'TestiCarousel' } ); } },
					{text: 'Toggle', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'toggle', { title: 'Toggle' } ); } },
					{text: 'Team member', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'member', { title: 'Team member' } ); } },
					{text: 'Vertical Tabs', onclick: function() { editor.execCommand( 'richer_insert_vertical_tabs', false, 'tabgroup_vertical', { title: 'Vertical Tabs' } ); } },
					{text: 'Video Embed', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'video_embed', { title: 'Video Embed' } ); } }
				]},
				// Elements menu.
				{text: 'Elements', menu: [
					{text: 'Animation', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'animation', { title: 'Animation' } ); } },
					{text: 'Alert', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'alert', { title: 'Alert' } ); } },
					{text: 'Banner', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'bannerbox', { title: 'Banner' } ); } },
					{text: 'Button', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'button', { title: 'Button' } ); } },
					{text: 'Call to action', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'calltoaction', { title: 'Call to action' } ); } },
					{text: 'Circle counter', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'circle_counter', { title: 'Circle counter' } ); } },
					{text: 'Coming soon', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'coming_soon', { title: 'Coming soon' } ); } },
					{text: 'Counter info', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'counter_box', { title: 'Counter info' } ); } },
					{text: 'Fullwidth Section', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'section', { title: 'Fullwidth Section' } ); } },
					{text: 'Icon', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'icon', { title: 'Icon' } ); } },
					{text: 'Iconbox', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'iconbox', { title: 'Iconbox' } ); } },
					{text: 'Pricing plan', onclick: function() { editor.execCommand( 'richer_insert_pricing_plan', false, 'pricing_plan', { title: 'Pricing plan' } ); } },
					{text: 'Pricing table', onclick: function() { editor.execCommand( 'richer_insert_pricing_table', false, 'pricing_table', { title: 'Pricing table' } ); } },
					{text: 'Data table', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'table style="1, 2 or 3"', { title: 'Data Table' } ); } },
					{text: 'Progressbar', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'progressbar', { title: 'Progressbar' } ); } },
					{text: 'Table', onclick: function() { editor.execCommand( 'richer_insert_table', false, 'table', { title: 'Table' } ); } },
					{text: 'Video Section', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'videosection', { title: 'Video Section' } ); } }
				]},
				// Typography menu.
				{text: 'Typography', menu: [
					{text: 'Blockquote', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'blockquote', { title: 'Blockquote' } ); } },
					{text: 'Drop Cap', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'dropcap', { title: 'Drop Cap' } ); } },
					{text: 'Gap amid blocks', onclick: function() { editor.execCommand( 'richer_insert_gap', false, 'gap', { title: 'Gap amid blocks' } ); } },
					{text: 'Horizontal Rule', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'hr', { title: 'Horizontal Rule' } ); } },
					{text: 'Markered list', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'list', { title: 'Markered list' } ); } },
					{text: 'Pullquote', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'pullquote', { title: 'Pullquote' } ); } },
					{text: 'Separator title', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'separator', { title: 'Separator title' } ); } },
					{text: 'Text Highlight', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'highlight', { title: 'Text Highlight' } ); } },
					{text: 'Tooltip', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'tooltip', { title: 'Tooltip' } ); } }					
				]},
				// Socials menu.
				{text: 'Socials', menu: [
					{text: 'Google map', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'map', { title: 'Google map' } ); } },
					{text: 'Flickr', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'flickr', { title: 'Flickr' } ); } },
					{text: 'Twitter', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'twitter', { title: 'Twitter' } ); } },
					{text: 'Instagram', onclick: function() { editor.execCommand( 'richer_open_dialog', false, 'instagram', { title: 'Instagram' } ); } },
					{text: 'Social icons', onclick: function() { editor.execCommand( 'richer_insert_self_immediate', false, 'socials facebook="#" twitter="#" pinterest="#"', { title: 'Social icons' } ); } }
				]},
				// Columns menu.
				{text: 'Columns', menu: [
					{text: 'row', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'row', { title: 'row' } ); } },
					{text: 'span1', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span1', { title: 'span1' } ); } },
					{text: 'span2', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span2', { title: 'span2' } ); } },
					{text: 'span3', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span3', { title: 'span3' } ); } },
					{text: 'span4', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span4', { title: 'span4' } ); } },
					{text: 'span5', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span5', { title: 'span5' } ); } },
					{text: 'span6', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span6', { title: 'span6' } ); } },
					{text: 'span7', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span7', { title: 'span7' } ); } },
					{text: 'span8', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span8', { title: 'span8' } ); } },
					{text: 'span9', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span9', { title: 'span9' } ); } },
					{text: 'span10', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span10', { title: 'span10' } ); } },
					{text: 'span11', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span11', { title: 'span11' } ); } },
					{text: 'span12', onclick: function() { editor.execCommand( 'richer_insert_immediate', false, 'span12', { title: 'span12' } ); } }
				]},
				// Layouts preset menu.
				{text: 'Layouts preset', menu: [
					{text: '50% | 50%', onclick: function() { editor.execCommand( 'richer_insert_immediate_n', false, 'span6|span6', { title: '50% | 50%' } ); } },
					{text: '75% | 25%', onclick: function() { editor.execCommand( 'richer_insert_immediate_n', false, 'span9|span3', { title: '75% | 25%' } ); } },
					{text: '25% | 75%', onclick: function() { editor.execCommand( 'richer_insert_immediate_n', false, 'span3|span9', { title: '25% | 75%' } ); } },
					{text: '33% | 33% | 33%', onclick: function() { editor.execCommand( 'richer_insert_immediate_n', false, 'span4|span4|span4', { title: '33% | 33% | 33%' } ); } },
					{text: '50% | 25% | 25%', onclick: function() { editor.execCommand( 'richer_insert_immediate_n', false, 'span6|span3|span3', { title: '50% | 25% | 25%' } ); } },
					{text: '25% | 50% | 25%', onclick: function() { editor.execCommand( 'richer_insert_immediate_n', false, 'span3|span6|span3', { title: '25% | 50% | 25%' } ); } },
					{text: '25% | 25% | 50%', onclick: function() { editor.execCommand( 'richer_insert_immediate_n', false, 'span3|span3|span6', { title: '25% | 25% | 50%' } ); } },
					{text: '25% | 25% | 25% | 25%', onclick: function() { editor.execCommand( 'richer_insert_immediate_n', false, 'span3|span3|span3|span3', { title: '25% | 25% | 25% | 25%' } ); } }

				]}
			]
		});
	}); // TinyMCE plugin end.
})();
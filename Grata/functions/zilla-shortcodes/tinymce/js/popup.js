
// start the popup specefic scripts
// safe to use $
jQuery(document).ready(function($) {
	var us_zillas = {
		loadVals: function()
		{
			var shortcode = $('#_us_zilla_shortcode').html(),
				uShortcode = shortcode;

			// fill in the gaps eg {{param}}
			$('.us_zilla-input').each(function() {
				var input = $(this),
					id = input.attr('id'),
					id = id.replace('us_zilla_', ''),		// gets rid of the us_zilla_ prefix
					val = input.val(),
					re = new RegExp("{{"+id+"}}","g");

				if (input.attr('type') == 'checkbox') {
					if (input.is(' :checked')) {
						val = '1';
					} else {
						val = '0';
					}
				}

				uShortcode = uShortcode.replace(re, val.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br>$2'));
			});

			// adds the filled-in shortcode as hidden input
			$('#_us_zilla_ushortcode').remove();
			$('#us_zilla-sc-form-table').prepend('<div id="_us_zilla_ushortcode" class="hidden">' + uShortcode + '</div>');
		},
		cLoadVals: function()
		{
			var shortcode = $('#_us_zilla_cshortcode').html(),
				pShortcode = '';
				shortcodes = '';

			// fill in the gaps eg {{param}}
			$('.child-clone-row').each(function() {
				var row = $(this),
					rShortcode = shortcode;

				$('.us_zilla-cinput', this).each(function() {
					var input = $(this),
						id = input.attr('id'),
						id = id.replace('us_zilla_', ''),		// gets rid of the us_zilla_ prefix
						val = input.val();
						re = new RegExp("{{"+id+"}}","g");

					if (input.attr('type') == 'checkbox') {
						if (input.is(' :checked')) {
							val = '1';
						} else {
							val = '0';
						}
					}

					rShortcode = rShortcode.replace(re, val.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br>$2'));
				});

				shortcodes = shortcodes + rShortcode + "\n";
			});

			// adds the filled-in shortcode as hidden input
			$('#_us_zilla_cshortcodes').remove();
			$('.child-clone-rows').prepend('<div id="_us_zilla_cshortcodes" class="hidden">' + shortcodes + '</div>');

			// add to parent shortcode
			this.loadVals();
			pShortcode = $('#_us_zilla_ushortcode').text().replace('{{child_shortcode}}', shortcodes+'<br>');

			// add updated parent shortcode
			$('#_us_zilla_ushortcode').remove();
			$('#us_zilla-sc-form-table').prepend('<div id="_us_zilla_ushortcode" class="hidden">' + pShortcode + '</div>');
		},
		children: function()
		{
			// assign the cloning plugin
			$('.child-clone-rows').appendo({
				subSelect: '> div.child-clone-row:last-child',
				allowDelete: false,
				focusFirst: false,
				onAdd: function() {
					us_zillas.loadVals();
					us_zillas.cLoadVals();
					us_zillas.resizeTB();
				}
			});

			// remove button
			$('.child-clone-row-remove').live('click', function() {
				var	btn = $(this),
					row = btn.parent();

				if( $('.child-clone-row').size() > 1 )
				{
					row.remove();
					us_zillas.loadVals();
					us_zillas.cLoadVals();
				}
				else
				{
					alert('You need a minimum of one row');
				}

				return false;
			});

			// assign jUI sortable
			$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row'

			});
		},
		resizeTB: function()
		{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				us_zillaPopup = $('#us_zilla-popup'),
				tbTitle = $('#TB_title'),
				tbLoad = $('#TB_load');

			tbWindow.css({
				height: us_zillaPopup.outerHeight(),
				width: us_zillaPopup.outerWidth(),
				marginLeft: -(us_zillaPopup.outerWidth()/2),
				marginTop: -(us_zillaPopup.outerHeight()/2),
				top: '50%',
				border: 'none'
			});

			tbTitle.css({
				display: 'none'
			});

			ajaxCont.css({
				padding: 0,
				height: us_zillaPopup.outerHeight(),
				overflow: 'hidden', // IMPORTANT
				width: us_zillaPopup.outerWidth()
			});

			$('#us_zilla-popup').addClass('no_preview');
		},
		load: function()
		{
			var	us_zillas = this,
				popup = $('#us_zilla-popup'),
				form = $('#us_zilla-sc-form', popup),
				shortcode = $('#_us_zilla_shortcode', form).text(),
				popupType = $('#_us_zilla_popup', form).text(),
				uShortcode = '';

			// resize TB
			us_zillas.resizeTB();
			$(window).resize(function() { us_zillas.resizeTB() });

			// initialise
			us_zillas.loadVals();
			us_zillas.children();
			us_zillas.cLoadVals();

			// update on children value change
			$('.us_zilla-cinput', form).live('change', function() {
				us_zillas.cLoadVals();
			});

			// update on value change
			$('.us_zilla-input', form).change(function() {
				us_zillas.loadVals();
			});

			// when insert is clicked
			$('#us_zilla-sc-form').submit(function() {
				$('.us_zilla-insert', form).click();
				return false;
			});
			$('.us_zilla-insert', form).click(function() {
				if(window.tinyMCE)
				{
					try {
						window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#_us_zilla_ushortcode', form).html());
					} catch(err) {
						parent.tinyMCE.execCommand('mceInsertContent', false, $('#_us_zilla_ushortcode', form).html());
					}

					tb_remove();
				}
			});
		}
	}

	// run
	$('#us_zilla-popup').livequery( function() { us_zillas.load(); } );


});

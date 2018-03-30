
// start the popup specefic scripts
// safe to use $
jQuery(document).ready(function($) {
    var icys = {
    	loadVals: function()
    	{
    		var shortcode = $('#_icy_shortcode').text(),
    			uShortcode = shortcode;
    		
    		// fill in the gaps eg {{param}}
    		$('.icy-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('icy_', ''),		// gets rid of the icy_ prefix
    				re = new RegExp("{{"+id+"}}","g");
    				
    			uShortcode = uShortcode.replace(re, input.val());
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_icy_ushortcode').remove();
    		$('#icy-sc-form-table').prepend('<div id="_icy_ushortcode" class="hidden">' + uShortcode + '</div>');
    		
    		// updates preview
    		icys.updatePreview();
    	},
    	cLoadVals: function()
    	{
    		var shortcode = $('#_icy_cshortcode').text(),
    			pShortcode = '';
    			shortcodes = '';
    		
    		// fill in the gaps eg {{param}}
    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
    			$('.icy-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('icy_', '')		// gets rid of the icy_ prefix
    					re = new RegExp("{{"+id+"}}","g");
    					
    				rShortcode = rShortcode.replace(re, input.val());
    			});
    	
    			shortcodes = shortcodes + rShortcode + "\n";
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_icy_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="_icy_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		// add to parent shortcode
    		this.loadVals();
    		pShortcode = $('#_icy_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
    		
    		// add updated parent shortcode
    		$('#_icy_ushortcode').remove();
    		$('#icy-sc-form-table').prepend('<div id="_icy_ushortcode" class="hidden">' + pShortcode + '</div>');
    		
    		// updates preview
    		icys.updatePreview();
    	},
    	children: function()
    	{
    		// assign the cloning plugin
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false
    		});
    		
    		// remove button
    		$('.child-clone-row-remove').live('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			
    			if( $('.child-clone-row').size() > 1 )
    			{
    				row.remove();
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
    	updatePreview: function()
    	{
    		if( $('#icy-sc-preview').size() > 0 )
    		{
	    		var	shortcode = $('#_icy_ushortcode').html(),
	    			iframe = $('#icy-sc-preview'),
	    			iframeSrc = iframe.attr('src'),
	    			iframeSrc = iframeSrc.split('preview.php'),
	    			iframeSrc = iframeSrc[0] + 'preview.php';
    			
	    		// updates the src value
	    		iframe.attr( 'src', iframeSrc + '?sc=' + base64_encode( shortcode ) );
	    		
	    		// update the height
	    		$('#icy-sc-preview').height( $('#icy-popup').outerHeight()-42 );
    		}
    	},
    	resizeTB: function()
    	{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				icyPopup = $('#icy-popup'),
				no_preview = ($('#_icy_preview').text() == 'false') ? true : false;
			
			if( no_preview )
			{
				ajaxCont.css({
					paddingTop: 0,
					paddingLeft: 0,
					height: (tbWindow.outerHeight()-47),
					overflow: 'scroll', // IMPORTANT
					width: 560
				});
				
				tbWindow.css({
					width: ajaxCont.outerWidth(),
					marginLeft: -(ajaxCont.outerWidth()/2)
				});
				
				$('#icy-popup').addClass('no_preview');
			}
			else
			{
				ajaxCont.css({
					padding: 0,
					// height: (tbWindow.outerHeight()-47),
					height: icyPopup.outerHeight()-15,
					overflow: 'hidden' // IMPORTANT
				});
				
				tbWindow.css({
					width: ajaxCont.outerWidth(),
					height: (ajaxCont.outerHeight() + 30),
					marginLeft: -(ajaxCont.outerWidth()/2),
					marginTop: -((ajaxCont.outerHeight() + 47)/2),
					top: '50%'
				});
			}
    	},
    	load: function()
    	{
    		var	icys = this,
    			popup = $('#icy-popup'),
    			form = $('#icy-sc-form', popup),
    			shortcode = $('#_icy_shortcode', form).text(),
    			popupType = $('#_icy_popup', form).text(),
    			uShortcode = '';
    		
    		// resize TB
    		icys.resizeTB();
    		$(window).resize(function() { icys.resizeTB() });
    		
    		// initialise
    		icys.loadVals();
    		icys.children();
    		icys.cLoadVals();
    		
    		// update on children value change
    		$('.icy-cinput', form).live('change', function() {
    			icys.cLoadVals();
    		});
    		
    		// update on value change
    		$('.icy-input', form).change(function() {
    			icys.loadVals();
    		});
    		
    		// when insert is clicked
    		$('.icy-insert', form).click(function() {    		 			
    			if(window.tinyMCE)
				{
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#_icy_ushortcode', form).html());
					tb_remove();
				}
    		});
    	}
	}
    
    // run
    $('#icy-popup').livequery( function() { icys.load(); } );
});
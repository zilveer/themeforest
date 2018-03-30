jQuery(document).ready(function() {
	
	//hide all options
	jQuery('#radykal-sc-options').children('div').hide();
	
	//show options(if it has one) when dropdown changes
	jQuery("#radykal-shortcodes").change(function() {
		var sc = jQuery("#radykal-shortcodes").val();
		jQuery('#radykal-sc-options').children('div').hide();
		jQuery('#radykal-sc-options').children('div').hide().parent().children('#'+sc+'').show();
	}).change();
	
	//adds the shortcode with player and maybe a playlist
	jQuery('#radykal-add-shortcode').click(function() {

		if(!editorIsAvailable()) {
			return false;
		}
		
        var sc = jQuery("#radykal-shortcodes").val(),
		    options = jQuery('#radykal-sc-options').children('#'+sc+'').children('input'),
		    optionOutput = '';
		
		//loop through all options and create output string
		options.each(function(index, item) {
			$item = jQuery(item);
			if($item.is(':checkbox')) {
				optionOutput += ' '+item.name+'="'+$item.is(':checked')+'"';
				console.log();
			}
			else {
			    optionOutput += ' '+item.name+'="'+$item.val()+'"';	
			}
				    
	    });
		
		//check if shortcode can hold content
		if(jQuery("#radykal-shortcodes option:selected").data('content')) {
			tinymce.EditorManager.activeEditor.selection.setContent('['+sc+'' +optionOutput+']'+tinyMCE.activeEditor.selection.getContent()+'[/'+sc+']');
		}
		else {
			tinymce.EditorManager.activeEditor.selection.setContent('['+sc+'' +optionOutput+']');
		}
		return false;
	});
	
	//colorpicker for the background color
	jQuery('.radykal-colorpicker').ColorPicker({
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onSubmit: function (hsb, hex, rgb, el) {
			jQuery(el).val('#' + hex);
			jQuery(el).ColorPickerHide();
		}
	});
	
	jQuery(".radykal-datepicker").datepicker({minDate: 0, dateFormat: 'yy-mm-dd'});
	
	//image upload
	jQuery('.radykal-image-upload').focusin(function() {
		var el = this;
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');	
		 window.send_to_editor = function(html) {
			imagePath = jQuery(html).attr('href');
			tb_remove();
			jQuery(el).val(imagePath);			
		};
	});
	
	//mp3 upload
	jQuery('.radykal-mp3-upload').focusin(function() {
		var el = this;
		tb_show('', 'media-upload.php?type=audio&amp;TB_iframe=true');	
		 window.send_to_editor = function(html) {
			mp3Path = jQuery(html).attr('href');
			tb_remove();
			jQuery(el).val(mp3Path);			
		};
	});
	
	//check if TinyMCE Editor is ready
	function editorIsAvailable() {
		if(!tinymce.EditorManager.activeEditor) {
			alert("TinyMCE editor is not ready yet or you are in the HTML mode, please switch to the Visual mode!");
			return false;
		}
		else {
			return true;
		}
	}
	
});
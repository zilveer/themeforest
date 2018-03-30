// Standard send_to_editor replacer
function sendToEditor(h) {

	var ed, mce = typeof(tinymce) != 'undefined', qt = typeof(QTags) != 'undefined';

	if ( !wpActiveEditor ) {
		if ( mce && tinymce.activeEditor ) {
			ed = tinymce.activeEditor;
			wpActiveEditor = ed.id;
		} else if ( !qt ) {
			return false;
		}
	} else if ( mce ) {
		if ( tinymce.activeEditor && (tinymce.activeEditor.id == 'mce_fullscreen' || tinymce.activeEditor.id == 'wp_mce_fullscreen') )
			ed = tinymce.activeEditor;
		else
			ed = tinymce.get(wpActiveEditor);
	}

	if ( ed && !ed.isHidden() ) {
		// restore caret position on IE
		if ( tinymce.isIE && ed.windowManager.insertimagebookmark )
			ed.selection.moveToBookmark(ed.windowManager.insertimagebookmark);

		if ( h.indexOf('[caption') !== -1 ) {
			if ( ed.wpSetImgCaption )
				h = ed.wpSetImgCaption(h);
		} else if ( h.indexOf('[gallery') !== -1 ) {
			if ( ed.plugins.wpgallery )
				h = ed.plugins.wpgallery._do_gallery(h);
		} else if ( h.indexOf('[embed') === 0 ) {
			if ( ed.plugins.wordpress )
				h = ed.plugins.wordpress._setEmbed(h);
		}

		ed.execCommand('mceInsertContent', false, h);
	} else if ( qt ) {
		QTags.insertContent(h);
	} else {
		document.getElementById(wpActiveEditor).value += h;
	}

	try{tb_remove();}catch(e){};
}

jQuery(document).ready(function(){
	jQuery('.sortable_section').sortable({
		stop: function(){
			var items = '';
			var i = 0;
			var count = jQuery(this).find('.option').length;
			while(i < count) {
				items += jQuery(this).find('.option').eq(i).data('section');
				if(i < count-1) {
					items += ',';
				}
				i++;
			}
			jQuery(this).next().val(items);
		}
	});
});
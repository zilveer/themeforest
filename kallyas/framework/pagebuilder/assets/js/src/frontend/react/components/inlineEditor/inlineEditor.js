require( './toolbar/inlineEditorToolbar' );
require( './buttons/inlineEditorAlignButton' );
require( './buttons/inlineEditorFontsButton' );
import $ from 'jQuery';
var AlloyEditor = require('alloyeditor');

(function(){
	var fw = this,
		_activeArea = false,
		_prev_id = false;

	$( document ).on( 'ready', function(){
		$( document ).on( 'click', '.znhg-editable-area', function(e){
			e.preventDefault();

			var $el = $(this),
				id = $el.attr('id');

			// Don't do anything if we're clicking the same element
			if( _prev_id === id ){
				return;
			}

			// We should only have one active editor
			if( typeof _activeArea.destroy === 'function' ){
				_activeArea.destroy();
			}

			// Only initialize once per id
			_prev_id = id;
			var Selections = [{
				name: 'text',
				buttons: [ 'klfonts', 'bold', 'italic', 'underline', 'link', 'quote', 'klalignment'],
				test: AlloyEditor.SelectionTest.text
			},
			{
				name: 'image',
				buttons: [ 'imageLeft', 'imageCenter', 'imageRight'],
				test: AlloyEditor.SelectionTest.image
			}];

			_activeArea = AlloyEditor.editable(id, {
					toolbars : {
						ktoolbar: {
							selections: Selections,
							tabIndex: 1
						}
					}
				}
			);

		}).on( 'focusout', '.znhg-editable-area', function(e){

			var $el = $(this),
				id = $el.attr('id'),
				optionId = $el.data('optionid');

				if( typeof _activeArea.get !== 'function' ){
					return false;
				}

				var content = _activeArea.get('nativeEditor').getData(),
					element_options = $.page_builder.set_element_option( optionId, content, $el );

		});
	})

})();
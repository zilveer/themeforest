(function($){
	var initLayout = function() {
		
		$('#colorpickerHolder').ColorPicker({flat: true});
		$('.colorpopup').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		})
	};

	EYE.register(initLayout, 'init');
})(jQuery)
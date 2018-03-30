(function ($) {

	$.mad_composer_mod = $.mad_composer_mod || {};

	$.mad_composer_mod.paramProduct = function () {
		({
			init: function() {
				this.listeners();
			},
			remove: function ($this, $input_text_val) {

				var vals = $input_text_val.val().split(","), newVals = '';

				for (var i = 0; i < vals.length; i++) {
					if ( vals[i] == $this.attr('data-val') ) {
						if (newVals != '') {
							newVals += '';
						}
						newVals += '';
					}  else {
						if (newVals != '') {
							newVals += ',';
						}
						newVals += vals[i];
					}
				}

				$input_text_val.val(newVals);
				$this.removeClass('selected');
			},
			Change: function ($this, $input_text_val) {
				var $custom = $this.parents('.mad-custom'),
					vals = $input_text_val.val().split(",");

				$custom.find('a').removeClass('selected');

				for (var i = 0; i < vals.length; i++) {
					$custom.find('a[data-val="' + vals[i] + '"]').addClass('selected');
				}
			},
			listeners: function () {
				var base = this;

				$('.mad-custom').on('click', 'a', function (e) {
					e.preventDefault();

					var $this = $(this),
						$input_text_val = $this.parents('.edit_form_line').children('.mad-custom-val');

					if ( $this.hasClass('selected') ) {
						base.remove.call($this, $this, $input_text_val);
						return true;
					}

					var prevVal = $input_text_val.val();
					if (prevVal != '') {
						prevVal += ',';
					}

					var dataVal = $this.attr('data-val');
					$input_text_val.val( prevVal + dataVal );

					base.Change.call($this, $this, $input_text_val);
				});

			}

		}.init());

	}

	$(function () {
		$.mad_composer_mod.paramProduct();
	});

})(jQuery);
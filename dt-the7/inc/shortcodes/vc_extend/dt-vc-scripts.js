!function($) {

	// dt_posttype param
	$('.wpb_el_type_dt_posttype .dt_posttype').click(function(e){

		var $this = $(this),
			$input = $this.parents('.wpb_el_type_dt_posttype').find('.dt_posttype_field'),
			arr = $input.val().split(',');

		if ( $this.is(':checked') ) {

			arr.push($this.val());

			var emptyKey = arr.indexOf("");
			if ( emptyKey > -1 ) {
				arr.splice(emptyKey, 1);
			}
		} else {

			var foundKey = arr.indexOf($this.val());

			if ( foundKey > -1 ) {
				arr.splice(foundKey, 1);
			}
		}

		$input.val(arr.join(','));
	});

	// dt_taxonomy param
	$('.wpb_el_type_dt_taxonomy .dt_taxonomy').click(function(e){

		var $this = $(this),
			$input = $this.parents('.wpb_el_type_dt_taxonomy').find('.dt_taxonomy_field'),
			arr = $input.val().split(',');

		if ( $this.is(':checked') ) {

			arr.push($this.val());

			var emptyKey = arr.indexOf("");
			if ( emptyKey > -1 ) {
				arr.splice(emptyKey, 1);
			}
		} else {

			var foundKey = arr.indexOf($this.val());

			if ( foundKey > -1 ) {
				arr.splice(foundKey, 1);
			}
		}

		$input.val(arr.join(','));
	});

	// only for dt_map shortcode
	$('.wpb_vc_param_value.wpb-textinput.content.textfield').on('change', function(e){
		e.preventDefault();
		var $input = $(this),
			$valCont = $('<div></div>').html($input.val()),
			$val = $valCont.children();

		if ( $val.length > 0 && $val.is('iframe') ) {
			$input.val($val.attr('src'));
		}

	});

	// Spacing param.
	var DTSpacingParam = function( valueField, spacingFields ) {
		this.valueField = valueField;
		this.spacing = [];

		this.addHandlers( spacingFields );
	};

	DTSpacingParam.prototype.addSpace = function( index, val, units ) {
		this.spacing[ index ] = {
			units: units,
			val: val,
			getVal: function() {
				this.val = this.val || 0;
				return parseInt(this.val)+this.units;
			}
		};
	};

	DTSpacingParam.prototype.addHandlers = function( spacingFields ) {
		var self = this;
		spacingFields.each(function(index) {
			var $this = $(this);
			var $valueField = $this.find('.dt_spacing-value');
			var $unitsField = $this.find('.dt_spacing-units');

			self.addSpace( index, $valueField.val(), $unitsField.attr('data-units') );

			$valueField.on('blur', function() {
				self.spacing[ index ].val = $(this).val();
				self.updateParamValue();
			});

			$unitsField.on('change', function() {
				self.spacing[ index ].units = $(this).val();
				self.updateParamValue();
			});
		});
	};

	DTSpacingParam.prototype.updateParamValue = function() {
		var val = [];
		this.spacing.forEach(function(_val) {
			val.push(_val.getVal());
		});
		this.valueField.val(val.join(' '));
	};

	$('.wpb_el_type_dt_spacing').each(function(){
		var $this = $(this);
		var $valueField = $this.find('.wpb_vc_param_value');
		var $spacingFields = $this.find('.dt_spacing-space');

		new DTSpacingParam( $valueField, $spacingFields );
	});

	// Number param.
	var DTNumberParam = function(valueField, numberField, unitsField) {
		this.valueField = valueField;
		this.numberField = numberField;
		this.unitsField = unitsField;
		this.number = this.numberField.val();
		this.units = this.valueField.attr('data-units');

		this.addHandlers();
	};

	DTNumberParam.prototype.addHandlers = function() {
		var self = this;

		this.numberField.on('blur', function() {
			self.number = $(this).val();
			self.updateParamValue();
		});

		this.unitsField.on('change', function() {
			self.units = $(this).val();
			self.valueField.attr('data-units', self.units);
			self.updateParamValue();
		});
	};

	DTNumberParam.prototype.updateParamValue = function() {
		if ( '' === this.number ) {
            this.valueField.val('');
            return;
		}
		this.valueField.val(parseInt(this.number) + this.units);
	};

	$('.wpb_el_type_dt_number').each(function() {
		var $this = $(this);
		var $unitsField = $this.find('.dt_number-units');
		var $numberField = $this.find('.dt_number-value');
		var $valueField = $this.find('.wpb_vc_param_value');

		new DTNumberParam( $valueField, $numberField, $unitsField );
	});

	// Dimensions param.
	var DTDimensionsParam = function(valueField, widthField, heightField) {
		this.valueField = valueField;
		this.widthField = widthField;
		this.heightField = heightField;
		this.width = this.widthField.val();
		this.height = this.heightField.val();

		this.addHandlers();
	};

	DTDimensionsParam.prototype.addHandlers = function() {
		var self = this;

		this.widthField.on('blur', function() {
			self.width = $(this).val();
			self.updateParamValue();
		});

		this.heightField.on('blur', function() {
			self.height = $(this).val();
			self.updateParamValue();
		});
	};

	DTDimensionsParam.prototype.updateParamValue = function() {
		var val = '';
		if ( this.width || this.height ) {
			val = parseInt(this.width)+'x'+parseInt(this.height);
		}
		this.valueField.val(val);
	};

	$('.wpb_el_type_dt_dimensions').each(function() {
		var $this = $(this);
		var $valueField = $this.find('.wpb_vc_param_value');
		var $widthField = $this.find('.dt_dimensions-width');
		var $heightField = $this.find('.dt_dimensions-height');

		new DTDimensionsParam( $valueField, $widthField, $heightField );
	});

	// Font style param.
	var DTFontStyleParam = function(valueField, italicField, boldField, uppercaseField) {
		this.valueField = valueField;
		this.italicField = italicField;
		this.boldField = boldField;
		this.uppercaseField = uppercaseField;

		this.italic = this.getCheckboxValue(italicField, 'normal');
		this.bold = this.getCheckboxValue(boldField, 'normal');
		this.uppercase = this.getCheckboxValue(uppercaseField, 'none');

		this.addHandlers();
	};

	DTFontStyleParam.prototype.addHandlers = function() {
		var self = this;

		this.italicField.on('change', function() {
			self.italic = self.getCheckboxValue($(this), 'normal');
			self.updateParamValue();
		});

		this.boldField.on('change', function() {
			self.bold = self.getCheckboxValue($(this), 'normal');
			self.updateParamValue();
		});

		this.uppercaseField.on('change', function() {
			self.uppercase = self.getCheckboxValue($(this), 'none');
			self.updateParamValue();
		});
	};

	DTFontStyleParam.prototype.updateParamValue = function() {
		this.valueField.val([this.italic, this.bold, this.uppercase].join(':'));
	};

    DTFontStyleParam.prototype.getCheckboxValue = function(checkbox, def) {
        return checkbox.is(':checked') ? checkbox.val() : def;
    };

	$('.wpb_el_type_dt_font_style').each(function() {
		var $this = $(this);
		var $valueField = $this.find('.wpb_vc_param_value');
        var $italicField = $this.find('.dt_font_style-italic');
        var $boldField = $this.find('.dt_font_style-bold');
        var $uppercaseField = $this.find('.dt_font_style-uppercase');

        new DTFontStyleParam($valueField, $italicField, $boldField, $uppercaseField);
	});

	// Switch param.
	$('.wpb_el_type_dt_switch .wpb_vc_param_value').on('change', function () {
		var $this = $(this);
		var values = json_decode($this.attr('data-values'));
		var value = values[1];
		if ( $this.is(':checked') ) {
			value = values[0];
		}

		$this.val(value);
	});

}(window.jQuery);
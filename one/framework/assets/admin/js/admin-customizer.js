var font_families = jQuery.parseJSON(fonts);

function getFont( val ) {
	for( var i in font_families ) {
		for( var j in font_families[i] ) {
			if( j === val ) {
				return font_families[i][j];
			}
		}
	}

	return {};
}

function getTextVariants( val ) {
	var text_variants = [],
		font = getFont(val);

	if( font['variants'] ) {
		var variants = font['variants'].split(',');
		for( var v in variants ) {
			text_variants.push( variants[v].replace(' ', '') );
		}
	}

	return text_variants;
}

Function.prototype.debounce = function (threshold, execAsap) {
    var func = this, timeout;
    return function debounced () {
        var obj = this, args = arguments;
        function delayed() {
            if (!execAsap)
                func.apply(obj, args);
            timeout = null;
		}

		if (timeout)
            clearTimeout(timeout);
        else if (execAsap)
            func.apply(obj, args);

        timeout = setTimeout(delayed, threshold || 100);
    };
};

(function($) {
	$(document).ready(function() {
		var families = $(".font-family");

		families.each(function() {
			var self = $(this);
			$(this).change(function() {
				var val = $(this).val(),
					text_variant = $(this).parents('li').nextUntil('.customize-control-font-case', '.customize-control-variant').find('select');

				var variants = getTextVariants(val);
				text_variant.html('');

				for( var v in variants ) {
					text_variant.append("<option value='" + variants[v] + "'>" + variants[v] + "</option>");
				}

				if( text_variant.attr('data-preselect') ) {
					text_variant.find("option[value='" + text_variant.attr('data-preselect') + "']").attr('selected', 'selected');
				}
				else {
					text_variant.find("option:first-child").attr('selected', 'selected');
				}

				text_variant.removeAttr('data-preselect');
				text_variant.trigger('change');
			});

			setTimeout(function() {
				self.trigger('change');
			}, 50);

		});
	});
})(jQuery);

function thb_get_css_selector( selector, rules ) {
	var sel = '';

	if( rules.length > 0 ) {
		sel = selector + ' { ';
		for( var rule in rules ) {
			sel += rules[rule] + ' ';
		}
		sel += ' } ';
	}

	return sel;
}

function thb_mixin( mixin, val, selector ) {
	var result = '';
	jQuery.ajax({
		url: thb_system.ajax_url,
		async: false,
		type: 'POST',
		data: {
			action: 'thb_mixin',
			mixin: mixin,
			value: val,
			selector: selector
		},
		success: function(response) {
			result = response;
		}
	});

	return result;
}

function thb_get_css_rule( rule, value, prefix, suffix ) {
	if( prefix === undefined ) {
		prefix = '';
	}

	if( suffix === undefined ) {
		suffix = '';
	}

	if( value !== '' ) {
		if( rule == 'font-family' ) {
			value = value.replace(/\+/g, ' ');
			return rule + ': ' + prefix + value + suffix + ';';
		}
		else if( rule == 'text-variant' ) {
			font_style = value.indexOf('italic') != -1 ? 'italic' : 'normal';
			font_weight = value.replace('italic', '');
			if( font_weight.indexOf('regular') != -1 || font_weight === '' ) {
				font_weight = 'normal';
			}

			return thb_get_css_rule('font-weight', font_weight) + ' ' + thb_get_css_rule('font-style', font_style);
		}

		return rule + ': ' + prefix + value + suffix + ';';
	}

	return '';
}

function thb_css_prefix_suffix( rule ) {
	var prefix = '',
		suffix = '';

	switch( rule ) {
		case 'font-family':
			prefix = suffix = '"';
			break;
		case 'font-size':
			suffix = 'px';
			break;
		case 'letter-spacing':
			suffix = 'px';
			break;
		case 'background-image':
			prefix = 'url(';
			suffix = ')';
			break;
	}

	return [prefix, suffix];
}
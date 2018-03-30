/**
 * Created by lnr on 27.01.14.
 */


var cf_builder = function(opts){
	var $ = jQuery,
		$list,
		$val,
		instance = {},  // js object with all fields
		defaults = {
			'types': ['text', 'name', 'email', 'message', 'number'],
			'el_template': '<li class=\"contact_item\" data-name=\"{{name}}\">'+
								'<input class=\"data\" value=\"{{label}}\" data-param=\"label\">'+
								'<input type=\"checkbox\" class=\"is_required\" {{checked}} data-param=\"req\" > Required'+
								'<a class=\"delete_item remove-field\">delete</a>'+
								'<select class=\"check_type\" data-param=\"type\">'+
									'{{options}}'+
//									'<option value=\"text\" {{selected-text}}>Text</option>'+
								'</select>'+
							'</li>',
			'container': ''
		};


	this.init = function(data) {
		for (option in defaults) {
			opts[option] = opts.hasOwnProperty(option) ? opts[option] : defaults[option];
		}
		$list = $(opts.container);
		$val = $list.find('.val');

		//render
		for(el in data) {
			addField(data[el]);
		}

		addListeners();
	};

	var addListeners = function() {
		$list.find('.add_cf_row').on('click', function(){
			if(addField({
				'label': $(this).parent().find('.label').val(),
				'name': $(this).parent().find('.name').val(),
				'req': false,
				'type': 'text'
			})){
				$(this).parent().find('.label').val('');
				$(this).parent().find('.name').val('');
			}
		});
		$list.on('click', '.contact_fields .remove-field', function(){
			removeField($(this).parent());
		});
		$list.find('.contact_fields').on('change', 'input, select', function(){
			updateField($(this));
		})
		$list.find('.contact_fields').sortable({
			'stop': resort
		});
	};

	var resort = function(event, ui) {
		var temp = {};
		$list.find('.contact_fields li[data-name]').each(function(){
			temp[$(this).data('name')] = instance[$(this).data('name')];
		});
		instance = temp;
		save();
	};

	var addField = function(el) {
		if( el.label === '' || el.name === '') {
			alert('field should not be empty');
			return false;
		}
		if(instance[el.name]){
			alert('element with name ' + el.name + ' allready exists');
			return false;
		}
		instance[el.name] = el;

		$('.contact_fields').append(getHTML(el));
		save();
		return true;
	};

	var getHTML = function(el) {
		var html = opts.el_template,
			options = '';
		for(i in opts.types) {
			options += '<option value="' + opts.types[i] + '" ' + (opts.types[i] === el.type ? 'selected="selected"' : '') + '>' +
						opts.types[i] + '</option>';
		}
		html = html.replace('{{options}}', options);
		html = html.replace('{{name}}', el.name);
		html = html.replace('{{label}}', el.label);
		html = html.replace('{{checked}}', el.req ? 'checked' : '');

		return html;
	};

	var removeField = function($obj) {
		delete instance[$obj.data('name')];
		$obj.remove();
		save();
	};

	var updateField = function($obj) {
		var val = ($obj.is(':checkbox')) ? $obj.is(':checked') : $obj.val();
		instance[$obj.parent().data('name')][$obj.data('param')] = val;
		save();
	}

	var save = function() {
	  	$val.val(
		    JSON.stringify(instance)
	    );
	};
};

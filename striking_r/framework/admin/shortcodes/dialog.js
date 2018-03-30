var dialog;
(function ($) {
	var api, s, previewed = false,
		focusItem = null;

	// Initialize the shortcode/api object
	dialog = api = {};
	api.settings = {
		type: 'enclosing',
		select: true,
		contentOption: 'content'
	};
	api.init = function (options) {

		s = api.settings = $.extend({}, api.settings, options);
		var win = window.dialogArguments || opener || parent || top;
		if(win.tab_showIframe !== undefined){
			win.tb_showIframe();
		}
		

		api.resize();
		$(window).resize(api.resize);

		$('.theme-dialog-tabs').each(function(){
			var container = this;
			$(this).find("li").each(function(i){
				$(this).on('click',function(e){
					$(this).siblings().removeClass('is-active');
					$(this).addClass('is-active');
					$('.theme-dialog-panes > li').removeClass('is-active').eq(i).addClass('is-active');
				});
			});
		});


		if (s.type != 'self-closing' && s.select == true && $('[name="' + s.contentOption + '"]').length > 0) {
			$('[name="' + s.contentOption + '"]').val(win.shortcodeMenu.editor.getSelection());
		}
		$(".shortcode-item").on('click','a.switch',function(event){
			$(event.delegateTarget).find('.description').toggle();
			event.preventDefault();
		});
		theme.init();
		if(typeof s.insert != 'undefined'){
			api.button.insert = s.insert;
		}
		api.button.init();
		if(typeof s.init != 'undefined'){
			s.init.call(this);
		}
	};
	api.resize = function () {
		var footer_height = $('#theme-dialog-footer').height();
		$('#theme-dialog-wrap').css({
			marginBottom: footer_height + 'px',
			height: ($('body').height() - footer_height) + 'px'
		});
		$('#theme-dialog-preview-iframe').css({
			height: ($('body').height() - footer_height) + 'px'
		});
	};
	api.isPreview = function () {
		return previewed;
	};
	// theme options init functions
	api.button = {};
	api.button.init = function () {
		api.button.cancel();
		api.button.insert();
		api.button.preview();
	};
	api.button.cancel = function () {
		$("#theme-button-cancel").click(function () {
			var win = window.dialogArguments || opener || parent || top;
			win.tb_remove();
		});
	};
	api.button.insert = function () {
		$("#theme-button-insert").click(function () {
			var win = window.dialogArguments || opener || parent || top;
			win.tb_remove();

			win.shortcodeMenu.editor.insertContent(api.generateShortcode());
		});
	};
	api.button.preview = function () {
		$("#theme-button-preview").click(function () {
			if (api.isPreview()) {
				previewed = false;
				$("#theme-dialog-options-wrap").show();
				$("#theme-dialog-preview-wrap").hide();
				$(this).val("Preview");
				$("#theme-dialog-preview-iframe").attr( "src", '');
			} else {
				previewed = true;
				$("#theme-dialog-options-wrap").hide();
				$("#theme-dialog-preview-wrap").show();
				$(this).val("Exit Preview");
				$("#theme-dialog-preview-shortcode").val(api.generateShortcode());
				$("#theme-dialog-preview-form").submit();
			}
		});
	};

	api.generateShortcode = function () {
		var options = [];
		$(".shortcode-item").each(function () {
			var type = $(this).attr("data-type");

			if (type in api.option) {
				var object = api.option[type](this);
				options[object.name] = object;
			}
		});
		switch (s.type) {
			case 'self-closing':
				return '[' + s.shortcode + api.builtAttributesChain(options) + '] ';
				break;
			case 'enclosing':
				return '[' + s.shortcode + api.builtAttributesChain(options) + ']' + api.getContent() + '[/' + s.shortcode + '] ';
				break;
			case 'both':
				if (api.getContent() == '') {
					return '[' + s.shortcode + api.builtAttributesChain(options) + '] ';
				} else {
					return '[' + s.shortcode + api.builtAttributesChain(options) + ']' + api.getContent() + '[/' + s.shortcode + '] ';
				}
			case 'custom':
				return s.custom.call(this, options);
				break;
		}

		//return attrs.join(' ');
	};

	api.getAttributesArray = function (options){
		var attributes = [];
		if(s.attributes != undefined){
			attributes.push(s.attributes);
		}
		for (x in options) {
			if (options[x].name != s.contentOption) {
				if(options[x].type == 'upload'){
					var upload_objects = jQuery.parseJSON(options[x].value);

					if(typeof options['upload_source_url'] !== 'undefined' && options['upload_source_url'].value != ''){
						upload_objects = {
							type: 'url',
							value: options['upload_source_url'].value
						};
					}

					if(typeof options[x]['onlyid'] !== 'undefined' && options[x].onlyid === true && upload_objects && typeof upload_objects['value'] !== 'undefined'){
						attributes.push(options[x].name + '="' + upload_objects['value'] + '"');
					} else {
						for (y in upload_objects) {
							attributes.push(options[x].name + '_' + y + '="' + upload_objects[y] + '"');
						}
					}

				}else if(options[x].name == 'upload_source_url') {
					
				}else if (options[x].attributeText != undefined) {
					attributes.push(options[x].attributeText);
				}
			}
		}
		return attributes;
	};
	api.builtAttributesChain = function (options) {
		attributes = api.getAttributesArray(options);
		
		if (attributes.length > 0) {
			return ' ' + attributes.join(' ');
		} else {
			return '';
		}
	};

	api.getContent = function () {
		var content = $('[name="' + s.contentOption + '"]').val();
		
		if(typeof content == 'undefined'){
			return '';
		}else{
			return content;
		}
	};

	api.option = {};
	api.option.text = function (item) {
		return api.option.getObject(item, 'input','text');
	};
	api.option.hidden = function(item) {
		var object = api.option.getObject(item, 'input','hidden');
		object.attributeText = object.name + '="' + object.value + '"';

		return object;
	};
	api.option.textarea = function (item) {
		return api.option.getObject(item, 'textarea','textarea');
	};

	api.option.select = function (item) {
		var object = {};
		var target = $(item).find('select');

		var manual = target.data('manual');
		var value = target.val();
		if(manual && value === manual){
			value = $(item).find('.theme-select-manual').val();
		}

		object.type = 'select';
		object.name = target.attr('name');
		object.def = api.option.getDefault(item);
		object.value = value;

		if (object.def != object.value) {
			object.attributeText = object.name + '="' + object.value + '"';
		}

		return object;
	};

	api.option.multiselect = function (item) {
		var object = {};
		var target = $(item).find('select');
		object.type = 'multiselect';
		object.name = target.attr('name').replace('[]', '');
		object.def = api.option.getDefault(item).split(',').sort().join(',');
		object.value = target.val();
		if (object.value == null) {
			object.value = '';
		}
		object.value = object.value.toString().split(',').sort().join(',');
		if (object.def != object.value) {
			object.attributeText = object.name + '="' + object.value + '"';
		}

		return object;
	};

	api.option.multidropdown = function (item) {
		var object = {};
		var target = $(item).find('input[type="hidden"]');
		object.type = 'multidropdown';
		object.name = target.attr('name');
		object.def = api.option.getDefault(item).split(',').sort().join(',');
		object.value = target.val();

		if (object.def != object.value.split(',').sort().join(',')) {
			object.attributeText = object.name + '="' + object.value + '"';
		}

		return object;
	};

	api.option.superlink = function (item) {
		return api.option.getObject(item, 'input[type="hidden"]','superlink');
	};

	api.option.checkboxes = function (item) {
		var object = {};
		var target = $(item).find('input:checkbox');
		object.type = 'checkboxes';
		object.name = target.attr('name').replace('[]', '');
		object.def = api.option.getDefault(item).split(',').sort().join(',');
		var checked = target.filter(":checked");
		switch (checked.length) {
		case 0:
			object.value = '';
			break;
		case 1:
			object.value = checked.val();
			break;
		default:
			object.value = [];
			checked.each(function () {
				object.value.push($(this).val());
			});
			object.value = object.value.sort().join(',');
		}

		if (object.def != object.value) {
			object.attributeText = object.name + '="' + object.value + '"';
		}

		return object;
	};

	api.option.radios = function (item) {
		var object = {};
		var target = $(item).find('input:radio');
		object.type = 'radios';
		object.name = target.attr('name');
		object.def = api.option.getDefault(item);
		var checked = target.filter(":checked");
		if (checked.length == 0) {
			object.value = '';
		} else {
			object.value = checked.val();
		}

		if (object.def != object.value) {
			object.attributeText = object.name + '="' + object.value + '"';
		}

		return object;
	};

	api.option.upload = function (item) {
		var target = $(item).find('input');
		var onlyid = target.data('onlyid');

		var object = api.option.getObject(item, 'input','upload');
		object['onlyid'] = onlyid;
		
		return object;
	};

	api.option.range = function (item) {
		return api.option.getObject(item, 'input','range');
	};
	api.option.measurement = function (item) {
		return api.option.getObject(item, 'input[type="hidden"]','measurement');
	};
	

	api.option.validator = function (item) {
		return api.option.getObject(item, 'input','validator');
	};

	api.option.color = function (item) {
		return api.option.getObject(item, 'input','color');
	};

	api.option.toggle = function (item) {
		var object = {};
		var target = $(item).find('.toggle-button');
		
		object.type = 'toggle';
		object.name = target.attr('name');
		object.def = api.option.getDefault(item);

		if (target.is(':checked')) {
			object.value = 'true';
		} else {
			object.value = 'false';
		}
		if (object.def != object.value) {
			if (object.value == 'true') {
				object.attributeText = object.name + '="true"';
			} else {
				object.attributeText = object.name + '="false"';
			}
		}
		return object;
	};

	api.option.tritoggle = function (item) {
		var object = {};
		var target = $(item).find('.tri-toggle-button');
		
		object.type = 'tritoggle';
		object.name = target.attr('name');
		object.def = api.option.getDefault(item);
		object.value = target.val();
		
		if (object.def != object.value) {
			switch (object.value) {
			case "true":
				object.attributeText = object.name + '="true"';
				break;
			case "false":
				object.attributeText = object.name + '="false"';
				break;
			case "default":
				object.attributeText = object.name + '="default"';
				break;
			}
		}
		return object;
	};
	
	api.option.custom = function (item) {
		return api.option.getObject(item, 'input:hidden');
	};
	
	api.option.getObject = function (item, selector, type) {
		var object = {};
		var target = $(item).find(selector);
		if(type!= null){
			object.type = type;
		}
		object.name = target.attr('name');
		object.def = api.option.getDefault(item);
		object.value = target.val();

		if (object.def != object.value) {
			object.attributeText = object.name + '="' + object.value + '"';
		}

		return object;
	};

	api.option.getDefault = function (item) {
		return $(item).attr('data-default');
	};
})(jQuery);

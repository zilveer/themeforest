/**
 * This is the JS file for the admin options page.
 */

(function($) {
	"use strict";
	
	var count = 0;

	/**
	 * Pexeto Options Widget - this contains the main JavaScript functionality
	 * for the Pexeto Options panel.
	 *
	 * @author Pexeto
	 * http://pexetothemes.com
	 */
	$.widget('pexeto.pexetoOptions', {
		options: {
			changeEvent    : 'option-change',
			
			//IDs, classess and selectors
			saveBtnSel     : '#op-save-button',
			nonceId        : 'pexeto-theme-options',
			textInputSel   : '.option-input',
			textAreaSel    : '.option-textarea',
			selectSel      : '.option-select',
			onOffSel       : '.on-off',
			checkboxSel    : '.option-check',
			uploadSel      : '.pexeto-upload',
			eventNs        : 'pexetooptions',
			btnOptionSel   : '.button-option',
			colorOptionSel : 'input.option-color',
			helpSel        : '.help-button',
			helpDialogSel  : '.help-dialog',
			loadingClass   : 'content-loading'
		},

		_create: function() {
			this.optionsData = {};

			_.bindAll(this, 'init','loadOptionsData','_bindEventHandlers','_getInputValue',
				'_doOnElementChange','destroy','getOptionsData','doOnSave');
			this.init();
		},

		/**
		 * Inits all the main functionality - inits all the widgets within the
		 * options panel.
		 */
		init: function() {

			var o = this.options;
			this.loadOptionsData();

			// init the tabs
			this.element.pexetoTabs({});

			this.element.find('.' + o.loadingClass).removeClass(o.loadingClass);

			//init the on/off elements
			this.element.find(o.onOffSel).each($.proxy(function(i, el) {
				var $el = $(el),
					val = null;
				$el.pexetoOnOff({
					changeEvent: o.changeEvent,
					parent: this.element
				});
				val = $el.pexetoOnOff('getValue');
				this.optionsData[val.id] = val.val;
			}, this));

			//init the checkbox
			this.element.find(o.checkboxSel).each($.proxy(function(i, el) {
				var $el = $(el),
					val = null;
				$el.pexetoCheckbox({
					changeEvent: o.changeEvent,
					parent: this.element
				});
				val = $el.pexetoCheckbox('getValue');
				this.optionsData[val.id] = val.val;
			}, this));


			//init the button option
			this.element.find(o.btnOptionSel).each($.proxy(function(i, el) {
				var $el = $(el),
					val = null;
				$el.pexetoBtnOption({
					changeEvent: o.changeEvent,
					parent: this.element
				});
				val = $el.pexetoBtnOption('getValue');
				this.optionsData[val.id] = val.val;
			}, this));

			//init the upload
			this.element.find(o.uploadSel).each($.proxy(function(i, el) {
				$(el).pexetoUpload();
			}, this));


			this.element.find(o.colorOptionSel).each($.proxy(function(i, el) {
				$(el).pexetoColorpicker();
			}, this));

			this.element.find(o.helpSel).pexetoDialogBtn();

			this._bindEventHandlers();

		},

		/**
		 * Loads the values from all the static elements, such as standard
		 * text inputs and text areas.
		 */
		loadOptionsData: function() {
			var o = this.options;

			this.element.find(o.textInputSel + ',' + o.selectSel + 
				',' + o.textAreaSel + ',' + o.colorOptionSel)
			.each($.proxy(function(i, el) {
				this.optionsData[$(el).attr('id')] = this._getInputValue($(el));
			}, this));
		},

		/**
		 * Binds the event handlers.
		 */
		_bindEventHandlers: function() {
			var o = this.options;
			//save button click handler
			$(o.saveBtnSel).on('click.' + o.eventNs, $.proxy(function(e) {
				e.preventDefault();
				this.doOnSave();
			}, this));

			//update element event handler
			this.element.on(o.changeEvent + '.' + o.eventNs, this._doOnElementChange);
		},

		/**
		 * Retrieves the input value of a standard element.
		 * @param  {object} $el the element whose value to retrieve
		 * @return {string}     the value of the element
		 */
		_getInputValue: function($el) {
			var tagname = $el.prop('tagName').toLowerCase();
			if((tagname === 'input' && ($el.attr('type') === 'text') || $el.attr('type') === 'hidden') || tagname === 'select' || tagname === 'textarea') {
				return $el.val();
			}
		},

		/**
		 * On element value change event handler - updates the data for this
		 * element.
		 * @param  {object} e   the event object
		 * @param  {unknown} val the value of the element/widget
		 */
		_doOnElementChange: function(e, val) {
			if(val !== undefined && val.id !== undefined && val.val !== undefined) {
				this.optionsData[val.id] = val.val;
			}
		},

		/**
		 * Destroys the widget element.
		 */
		destroy: function() {
			Widget.prototype.destroy.call(this);
		},

		/**
		 * Gets the options data for all the elements.
		 * @return {object} the options data
		 */
		getOptionsData: function() {
			return this.optionsData;
		},

		/**
		 * Saves the data - loads the data from all the widgets and makes an
		 * AJAX request to the server to save it.
		 */
		doOnSave: function() {
			if(!this.inLoading) {
				var $loader = $('#op-loader'),
					$success = $('#op-success'),
					$error = $('#op-error').hide(),
					postData = [];
				this.loadOptionsData();
				postData = _.clone(this.optionsData);
				postData['action'] = 'pexeto_save_options_data';
				postData[this.options.nonceId] = this.element.find('#' + this.options.nonceId).val();

				$loader.show();
				this.inLoading = true;

				//make the AJAX request
				$.ajax({
					url: ajaxurl,
					dataType: 'json',
					data: postData,
					type: 'POST'
				}).done(function($res) {
					if($res.success) {
						$success.fadeIn().delay(2000).fadeOut();
					} else {
						if($res.message) {
							$error.html($res.message);
						}
						$error.fadeIn();
					}
				}).always($.proxy(function() {
					$loader.hide();
					this.inLoading = false;
				}, this));
			}
		}

	});

	/**
	 * Custom data widget. Allows to specify a widget with different
	 * inner elements (inputs, textareas, etc.) and add elements from this type.
	 *
	 * @author Pexeto
	 * http://pexetothemes.com
	 */
	$.widget('pexeto.pexetoCustom', {
		options: {
			changeEvent : 'option-change',
			eventNs     : 'pexetocustom',
			parent      : null,
			addText     : 'Add',
			uploadText  : 'Upload',
			values      : [],
			editable    : true,
			fields      : {},
			classes     : {
				option      : 'custom-option',
				label       : 'custom-heading',
				liValue     : 'custom-value',
				ul          : 'custom-option-list',
				deleteBtn   : 'delete-button',
				editBtn     : 'edit-button',
				doneBtn     : 'done-button',
				fieldValue  : 'field-val',
				uploadInput : 'pexeto-upload-field',
				uploadBtn   : 'pexeto-upload-btn',
				invalid     : 'invalid',
				btnOption   : 'button-option button-option-img',
				selected    : 'selected'
			}
		},

		/**
		 * Creates the widget. Initializes some variables.
		 */
		_create: function() {
			_.bindAll(this, 'init','_buildMarkup','_bindEventHandlers',
				'_setInitValues','_doOnAddClick','_resetForm','_doOnSort',
				'_triggerChange','_updateBoundElements','_getInputValue',
				'_setEmptyFieldValue','_addListElement','_doOnDelete',
				'_doOnEdit','_doOnEditComplete','_validateInput',
				'_doOnElementMouseenter','_doOnInputFocusIn','_escapeHTML',
				'_getFieldById','getValues','destroy');

			this.values = [];
			this.id = this.element.attr('id');
			this.lastIndex = 0;

			this.init();
		},

		/**
		 * Inits the main functionality.
		 */
		init: function() {
			this._buildMarkup();
			this._bindEventHandlers();
			if(this.options.values.length) {
				this._setInitValues();
			}
		},

		/**
		 * Builds the markup for the widget.
		 */
		_buildMarkup: function() {
			var o = this.options;

			$.each(o.fields, $.proxy(function(i, field) {
				var $el = $('<div />', {
					'class': o.classes.option
				}).append($('<span />', {
					'class': o.classes.label,
					'text': field.name
				})),
					$dataEl, j, len, selected;

				//generate the markup according to the element type
				switch(field.type) {
				case 'text':
					$dataEl = $('<input />', {
						type: 'text',
						id: field.id
					});
					break;
				case 'upload':
					$dataEl = $('<div><input type="text" class="' + o.classes.uploadInput +
					 '" id="' + field.id + '"/><a class="' + o.classes.uploadBtn + '">' +
					  o.uploadText + '</a></div>');
					$dataEl.find('a').pexetoUpload();
					break;
				case 'textarea':
					$dataEl = $('<textarea />', {
						id: field.id
					});
					break;
				case 'imageselect':
					$dataEl = $('<div />', {
						'class': o.classes.btnOption
					});
					for(j = 0, len = field.options.length; j < len; j++) {
						selected = j ? '' : ' class="' + o.classes.selected + '"';
						$dataEl.append('<li' + selected + '><a title="' + field.options[j] + 
							'"><img src="' + field.options[j] + '"/></a></li>');
					}
					$dataEl.pexetoBtnOption({
						parent: this.element
					});

					if(field.include_upload){
						$dataEl.append('<div class="clear"></div><div class="button-option-title">OR Select Custom Image</div>');
						var data = 'data-fieldid="'+field.id+'-upload"';
						$('<div class="pexeto-upload" '+data+'></div>').appendTo($dataEl).pexetoUpload();
					}
					break;

				}

				$el.append($dataEl).appendTo(this.element);
				field.$el = $dataEl;
			}, this));

			//add an "Add" button
			this.$addBtn = $('<a />', {
				'class': 'pex-button',
				html: '<span><i aria-hidden="true" class="icon-plus"></i>' + o.addText + '</span>'
			}).appendTo(this.element);
			this.$list = $('<ul />', {
				'class': o.classes.ul
			}).appendTo(this.element).sortable();
		},

		/**
		 * Binds event handlers.
		 */
		_bindEventHandlers: function() {
			var o = this.options;
			this.$addBtn.on('click.' + o.eventNs, this._doOnAddClick);
			this.$list.on('sortupdate.' + o.eventNs, this._doOnSort);

			//delete event handlers
			this.$list.on('click.' + o.eventNs, '.' + o.classes.deleteBtn, this._doOnDelete);
			this.$list.on('mouseenter.' + o.eventNs, '.' + o.classes.deleteBtn, this._doOnElementMouseenter);

			//edit event handlers
			this.$list.on('click.' + o.eventNs, '.' + o.classes.editBtn, this._doOnEdit);
			this.$list.on('mouseenter.' + o.eventNs, '.' + o.classes.editBtn, this._doOnElementMouseenter);

			//done edit event handlers
			this.$list.on('click.' + o.eventNs, '.' + o.classes.doneBtn, this._doOnEditComplete);
			this.$list.on('mouseenter.' + o.eventNs, '.' + o.classes.doneBtn, this._doOnElementMouseenter);

			this.element.on('focusin.' + o.eventNs, 'input, textarea', this._doOnInputFocusIn);
			this.$list.on('focusin.' + o.eventNs, 'li input, li textarea', this._doOnInputFocusIn);
		},

		/**
		 * Adds the default (saved) values on init.
		 */
		_setInitValues: function() {
			var o = this.options;
			this.values = _.clone(this.options.values);
			$.each(this.values, $.proxy(function(i, value) {
				this._addListElement(value);
			}, this));
			this._triggerChange();
		},

		/**
		 * Add button click handler. Adds the data to the added data list.
		 */
		_doOnAddClick: function() {
			var o = this.options,
				dataObj = {},
				isValid = true;

			$.each(o.fields, $.proxy(function(i, field) {
				//validate the data
				dataObj[field.id] = this._getInputValue(field);

				isValid = this._validateInput(field.id, field.type, field.$el);
				if(!isValid) {
					return false;
				}

			}, this));

			if(isValid) {
				this.values.push(dataObj);
				this._addListElement(dataObj);
				this._triggerChange();
				this._resetForm();
				this._updateBoundElements('add', dataObj);
			}
		},

		/**
		 * Resets the form - empties the field data.
		 */
		_resetForm: function() {
			var o = this.options;

			$.each(o.fields, $.proxy(function(i, field) {
				this._setEmptyFieldValue(field);
			}, this));
		},

		/**
		 * On sort event handler. Triggers a change event in the data of the 
		 * widget.
		 * @param  {object} e  the event object
		 */
		_doOnSort: function(e) {
			var newOrder = [],
				index = 0,
				oldValues = _.clone(this.values),
				i, len;

			this.$list.find('li').each($.proxy(function(i, li) {
				newOrder.push($(li).data('index'));
				$(li).data('index', index++);
			}, this));

			for(i = 0, len = this.values.length; i < len; i++) {
				this.values[i] = oldValues[newOrder[i]];
			}
			this._triggerChange();

		},

		/**
		 * Triggers a change event of the widget, sets the new data to the
		 * event object.
		 */
		_triggerChange: function() {
			this.options.parent.trigger(this.options.changeEvent, [this.getValues()]);
		},

		/**
		 * Updates all the elements whose dataset depends on this widgets data.
		 * For example, if this is a widget that creates new sidebars and there
		 * is a another element that displays all the sidebar names in its values,
		 * this function will update the element data when the data of the widget
		 * has been changed - on add, edit or delete.
		 * @param  {string} action  the type of action (add/edit/delete)
		 * @param  {object} dataObj an object that contains the data of the
		 * changed element.
		 */
		_updateBoundElements: function(action, dataObj) {
			var links;
			if(this.options.bindTo) {
				links = this.options.bindTo.links;

				$.each(this.options.bindTo.ids, $.proxy(function(index, val) {
					var $select = $('#' + val),
						valLength = 0;

					if($select.length) {
						switch(action) {
						case 'add':
							$select.append('<option value="' + dataObj[links.id] + '">' + dataObj[links.name] + '</option>');
							break;
						case 'delete':
							$select.find('option[value="' + dataObj[links.id] + '"]').remove();
							break;
						case 'edit':
							$select.find('option[value="' + dataObj.oldValue[links.id] + '"]').attr('value', dataObj.newValue[links.id]).html(dataObj.newValue[links.name]);
							break;
						}
					}
				}, this));
			}
		},

		/**
		 * Retrieves the value of an element depending on its type.
		 * @param  {object} field the element object whose value will be 
		 * retrieved
		 * @return {unknown}       the value of the element
		 */
		_getInputValue: function(field) {
			if(field.type === 'text' || field.type === 'textarea') {
				return field.$el.val();
			} else if(field.type === 'upload') {
				return field.$el.find('input.' + this.options.classes.uploadInput).val();
			} else if(field.type === 'imageselect') {
				var val;
				if(field.include_upload){
					val = field.$el.find('input.' + this.options.classes.uploadInput).val();
				}

				if(!val){
					val = field.$el.pexetoBtnOption('getValue').val;
				}

				return val;
			}
		},

		/**
		 * Empties a field.
		 * @param {object} a jQuery object field to be emptied
		 */
		_setEmptyFieldValue: function(field) {
			if(field.type === 'text' || field.type === 'textarea') {
				field.$el.val('');
			} else if(field.type === 'upload') {
				field.$el.find('input.' + this.options.classes.uploadInput).val('');
			} else if(field.type === 'imageselect' && field.include_upload){
				field.$el.find('.pexeto-upload').pexetoUpload('clear');
			}
		},

		/**
		 * Adds a visual list element to the added data elements.
		 * @param {object} data the data of the element
		 */
		_addListElement: function(data) {
			var o = this.options,
				$li = $('<li />').data('index', this.lastIndex++),
				preview = '',
				field, inputVal, isValid = true;

			$.each(data, $.proxy(function(key, value) {
				if(data.hasOwnProperty(key)) {
					field = this._getFieldById(key);

					if(o.preview && o.preview === key) {
						preview = value;
					}
					inputVal = value || '-';
					if(field) {
						$li.append('<div class="' + o.classes.liValue + '"><strong>' + field.name + '</strong>: <span class="' + o.classes.fieldValue + '">' + this._escapeHTML(inputVal) + '</span></div>');
					}
				}
			}, this));

			if(preview) {
				//add a preview image
				$li.prepend('<img src="' + preview + '" />');
			}

			//add the delete button
			$('<div />', {
				'class': o.classes.deleteBtn,
				title: 'Delete'
			}).appendTo($li);

			//add the edit button
			if(o.editable) {
				$('<div />', {
					'class': o.classes.editBtn,
					title: 'Edit'
				}).appendTo($li);
			}
			$li.appendTo(this.$list);
		},

		/**
		 * On delete event handler. Removes an item from the list and the data
		 * values.
		 * @param  {object} e the event object
		 */
		_doOnDelete: function(e) {
			var $li = $(e.target).parent('li'),
				index = $li.data('index'),
				dataObj = this.values[index];

			this.values.splice(index, 1);
			this._triggerChange();

			$li.remove();
			this.lastIndex = 0;
			this.$list.find('li').each($.proxy(function(i, li) {
				$(li).data('index', this.lastIndex++);
			}, this));

			this._updateBoundElements('delete', dataObj);
		},

		/**
		 * On edit event handler. Replaces the value of the visual list item
		 * with text inputs to edit their values.
		 * @param  {object} e the event object
		 */
		_doOnEdit: function(e) {
			var $btn = $(e.target),
				$li = $btn.parent('li'),
				index = $li.data('index'),
				o = this.options,
				val = '',
				fieldId = '',
				i, len;


			for(i = 0, len = o.fields.length; i < len; i++) {
				//replace the labels with an input
				fieldId = o.fields[i].id;
				val = this.values[index][fieldId];
				$li.find('.' + o.classes.liValue).eq(i).find('.' + o.classes.fieldValue).html($('<input />', {
					type: 'text',
					value: val,
					id: 'edit-' + fieldId
				}));
			}

			$btn.replaceWith($('<div />', {
				'class': o.classes.doneBtn,
				title: 'Done Editing'
			}));
		},

		/**
		 * On edit complete event handler. Updates the edited data and replaces
		 * back the inputs with labels.
		 * @param  {object} e the event object
		 */
		_doOnEditComplete: function(e) {
			var $btn = $(e.target),
				$li = $btn.parent('li'),
				index = $li.data('index'),
				o = this.options,
				val = '',
				fieldId = '',
				fieldObj = {},
				$input, preview = '',
				inputVal = '',
				isValid = true,
				oldValue = _.clone(this.values[index]),
				i, len,
				$img;

			//validate the input
			for(i = 0, len = o.fields.length; i < len; i++) {
				fieldId = o.fields[i].id;
				$input = $li.find('#edit-' + fieldId);
				val = $input.val();

				isValid = this._validateInput(fieldId, 'text', $input);
				if(!isValid) {
					break;
				}
			}

			if(isValid) {
				//the data is valid
				for(i = 0, len = o.fields.length; i < len; i++) {
					fieldId = o.fields[i].id;
					$input = $li.find('#edit-' + fieldId);
					val = $input.val();

					this.values[index][fieldId] = val;
					inputVal = val || '-';
					$input.replaceWith(this._escapeHTML(inputVal));

					//set the preview image for the item
					if(o.preview && o.preview === fieldId) {
						$img = $li.find('img');
						if($img.length) {
							$img.attr('src', val);
						} else {
							$li.prepend('<img src="' + val + '" />');
						}
					}
				}

				$btn.replaceWith($('<div />', {
					'class': o.classes.editBtn,
					title: 'Edit'
				}));
				this._triggerChange();
				this._updateBoundElements('edit', {
					oldValue: oldValue,
					newValue: this.values[index]
				});
			}
		},

		/**
		 * Validates an input. Checks if it is required and if it is, checks
		 * whether it has a value set.
		 * @param  {int} fieldId the ID of the field
		 * @param  {string} type    the type of the field
		 * @param  {object} $el     the element that represents the field
		 * @return {boolean}         true if it is valid and false if it is not
		 * valid.
		 */
		_validateInput: function(fieldId, type, $el) {
			var isValid = true,
				field = this._getFieldById(fieldId),
				fieldObj = {
					$el: $el
				};

			fieldObj.type = type;
			if(field.required && !this._getInputValue(fieldObj)) {
				isValid = false;
				$el.addClass(this.options.classes.invalid);
			}

			return isValid;
		},

		/**
		 * On element mouse enter event handler.
		 * @param  {object} e the event object
		 */
		_doOnElementMouseenter: function(e) {
			var el = e.currentTarget;
			$(el).css({
				cursor: 'pointer'
			});
		},

		/**
		 * On input focus in event handler - removes an invalid class if it has
		 * one applied.
		 * @param  {object} e the event object
		 */
		_doOnInputFocusIn: function(e) {
			var el = e.currentTarget;
			$(el).removeClass(this.options.classes.invalid);
		},

		/**
		 * Escapes HTML code. Replaces some of the HTML characters with their
		 * HTML code.
		 * @param  {string} html the string to escape
		 * @return {string}      the escaped string
		 */
		_escapeHTML: function(html) {
			return html.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
		},

		/**
		 * Retrieves a field element by its ID.
		 * @param  {int} fieldId the ID of the field
		 * @return {object}         the field object
		 */
		_getFieldById: function(fieldId) {
			var field = _.find(this.options.fields, function(field) {
				return field.id === fieldId;
			});
			return field;
		},

		/**
		 * Retrieves the data for the widget.
		 * @return {object} an object that contains the data with the following
		 * keys:
		 * val : the data of the widget
		 * id : the ID of the widget
		 */
		getValues: function() {
			return {
				val: this.values,
				id: this.id
			};
		},

		/**
		 * Destroys the widget. Removes all of its registered event handlers.
		 */
		destroy: function() {
			this.element.off(this.options.eventNs);
			Widget.prototype.destroy.call(this);
		}

	});


	/**
	 * Pexeto Tabs Widget - used for the Pexeto Options panel for a 
	 * multi-level tab navigation.
	 *
	 * @author Pexeto
	 * http://pexetothemes.com
	 */
	$.widget('pexeto.pexetoTabs', {
		options: {
			selectedClass: 'op-selected',
			navSel: '#op-navigation',
			mainSel: '.op-tab',
			prefix: 'tab',
			subNavSel: '.op-tab-navigation',
			subSel: '.op-sub-tab',
			storageId: 'pexeto_options_tab',
			eventNs: 'pexetotabs'
		},

		/**
		 * Creates the widget, initializes some variables.
		 */
		_create: function() {
			_.bindAll(this, 'init','_bindEventHandlers','showMainTab','showSubTab',
				'saveTabState','getTabState','_getSelectedElements','destroy');

			this.supportsStorage = typeof(Storage)!=="undefined";

			//init the main properties of the object
			this.mainTabs = null;
			this.navItems = null;
			this.subTabs = null;
			this.subNavItems = null;
			this.lastSubTab = null;


			this.init();
		},

		/**
		 * Inits the main functionality for the widget, caches all the main
		 * elements that will be used.
		 */
		init: function() {
			var o = this.options,
				selectedTabs = null;
			this.mainTabs = this.element.find(o.mainSel).hide();
			this.navItems = this.element.find(o.navSel);
			this.subTabs = this.element.find(o.subSel).hide();
			this.subNavItems = this.element.find(o.subNavSel + ' li');
			this._bindEventHandlers();

			selectedTabs = this._getSelectedElements();
			this.showMainTab(selectedTabs.main);
			this.showSubTab(selectedTabs.sub);
		},

		/**
		 * Binds event handlers.
		 */
		_bindEventHandlers: function() {
			//main navigation click event handlers
			this.navItems.find('a').on('click.' + this.options.eventNs, $.proxy(function(e) {
				e.preventDefault();
				this.showMainTab($(e.currentTarget));
			}, this));
			//subnavigation click event handlers
			this.subNavItems.find('a').on('click.' + this.options.eventNs, $.proxy(function(e) {
				e.preventDefault();
				this.showSubTab($(e.currentTarget));
			}, this));
		},

		/**
		 * Displays a main navigation element panel.
		 * @param  {object} $elem the corresponding tab that was clicked.
		 */
		showMainTab: function($elem) {
			var o = this.options,
				href = $elem.attr('href'),
				tab = null,
				subTab = null;

			if(this.cur === href) {
				return;
			}

			$elem.parents('li:first')
				.addClass(o.selectedClass)
				.siblings('.' + o.selectedClass)
				.removeClass(o.selectedClass);
			this.mainTabs.hide();
			tab = this.element.find(href).show();
			subTab = tab.data('lasttab') ? 
				this.subNavItems.find('a[href="' + tab.data("lasttab") + '"]') : 
				tab.find(o.subNavSel + ' li:first a');
			this.showSubTab(subTab);

			this.saveTabState(subTab.attr('href'));
		},

		/**
		 * Displays a sub navigation element panel.
		 * @param  {object} $elem the corresponding tab that was clicked.
		 */
		showSubTab: function($elem) {
			var o = this.options,
				href = $elem.attr('href');
			$elem.parents('li:first')
				.addClass(o.selectedClass)
				.siblings('.' + o.selectedClass)
				.removeClass(o.selectedClass);
			this.subTabs.hide();
			this.element.find(href).show().parents(o.mainSel + ':first').data('lasttab', href);
			var $uploads = this.element.find('.pexeto-upload-btn');
			if($uploads.length){
				$uploads.trigger('refresh');
			}
			this.saveTabState(href);
		},

		/**
		 * Saves a the state of the selected tab in the local storage.
		 * @param {string} href the href attribute of the selected tab
		 */
		saveTabState: function(href) {
			if(this.supportsStorage) {
				localStorage.setItem(this.options.storageId, href);
			}
		},

		/**
		 * Retrieves the saved state of the selected tab from the local storage.
		 * @return {unknown} if the cookie is set, will return the href
		 * string of the selected tab element. If it is not set, it will return
		 * null.
		 */
		getTabState: function() {
			if(this.supportsStorage) {
				return localStorage.getItem(this.options.storageId);
			}
			return null;
		},

		/**
		 * Retrieves the currently selected main navigation and subnavigation
		 * tabs,
		 * @return {object} containing the selected elements with the following
		 * keys:
		 * - main : the tab element for the selected main navigation tab
		 * - sub : the tab element for the selected sub navigation tab
		 */
		_getSelectedElements: function() {
			var currentNav = this.getTabState(),
				parts = currentNav ? currentNav.split('-') : [],
				res = {},
				mainHref = '',
				selectedIndex = 0;
			if(parts.length === 3) {
				//there is a tab and subtab selected
				res.sub = this.subNavItems.find('a[href="' + currentNav + '"]');
				parts.pop();
				mainHref = parts.join('-');
				res.main = this.navItems.find('a[href="' + mainHref + '"]');
			} else if(parts.length === 2) {
				//only the main tab is selected
				res.main = this.navItems.find('a[href="' + currentNav + '"]');
				selectedIndex = parseInt(parts[1], 10) - 1;
				res.sub = this.mainTabs.eq(selectedIndex).find(this.options.subNavSel + ' li:first a');
			} else {
				res.main = this.navItems.find('a:first');
				res.sub = this.subNavItems.find('a:first');
			}

			return res;
		},

		/**
		 * Destroys the widget, removes all the registered event listeners.
		 */
		destroy: function() {
			this.navItems.find('a').off(this.options.eventNs);
			this.subNavItems.find('a').off(this.options.eventNs);
			Widget.prototype.destroy.call(this);
		}

	});

})(jQuery);



jQuery(document).ready(function($) {
	//init the Pexeto options functionality
	$('#pexeto-content-container').pexetoOptions({});
});
	/**
	 * This file contains all the main widgets, such as color pickers, upload fields, checkboxes, etc.
	 */


	(function($) {
		"use strict";

		var pexeto = pexeto || {};

		//HELPER FUNCTIONS
		/**
		 * Adds a parameter to an URL
		 * @param {string} url   The URL string
		 * @param {string} param The parameter key
		 * @param {string} value The parameter value
		 */
		pexeto.addUrlParam = function(url, param, value) {
			var symbol = url.indexOf("?") === -1 ? "?" : "&";
			return url + symbol + param + "=" + value;
		};


		/**
		 * Dialog Button Widget.
		 * Requires the main element to contain an inner element which will contain the text.
		 * Example structure:
		 * <div class="button"><div class="dialog-content">Dialog content goes here</div></div>
		 *
		 * Dependencies:
		 * - jQuery
		 * - jQuery-ui-core
		 * - jQuery-ui-widget
		 * - jQuery-ui-dialog
		 * - Underscore.js
		 */
		$.widget("pexeto.pexetoDialogBtn", {
			options: {
				classes: {
					dialogContent: "dialog-content"
				}
			},

			/**
			 * Dfault create function executed when the widget is initialized.
			 */
			_create: function() {
				_.bindAll(this, 'init', '_doOnClick');
				this.init();
			},

			/**
			 * Inits the main functionality.
			 */
			init: function() {
				this.element.on("click", this._doOnClick);
			},

			/**
			 * On element click event handler - loads the dialog.
			 * @param  {object} e the event object
			 */
			_doOnClick: function(e) {
				this.$dialog = this.$dialog || this.element.find("." + this.options.classes.dialogContent + ":first");
				this.dialogTitle = this.dialogTitle || this.element.attr("title");

				e.preventDefault();
				this.$dialog.dialog({
					modal: true,
					autoOpen: true,
					dialogClass : 'pexeto-dialog',
					title: this.dialogTitle,
					closeText: ''
				});
			}

		});



		/**
		 * Button Option Widget.
		 * Can be used to select an image or color from a set of options.
		 *
		 * Dependencies:
		 * - jQuery
		 * - jQuery-ui-core
		 * - jQuery-ui-widget
		 * - Underscore.js
		 */
		$.widget("pexeto.pexetoBtnOption", {
			options: {
				changeEvent: "option-change",
				parent: null,
				eventNs: "pexetoBtnOption",
				classes: {
					selected: "selected"
				}
			},

			/**
			 * Dfault create function executed when the widget is initialized.
			 */
			_create: function() {
				_.bindAll(this, 'init', '_doOnClick', 'getValue', 'destroy');
				this.val = null;
				this.init();
			},

			/**
			 * Inits the main functionality.
			 */
			init: function() {
				this.id = this.element.attr("id");

				//load the default value
				var $selected = this.element.find("." + this.options.classes.selected).eq(0);
				if(!$selected.length) {
					this.element.find("li:first").trigger("click");
					this.val = this.element.find("a:first").attr("title");
				} else {
					this.val = $selected.find("a:first").attr("title");
				}

				this.element.on("click", "li", this._doOnClick);
			},

			/**
			 * On element click event handler - changes the saved value and sets the selected class to the selected item.
			 * @param  {object} e the event object
			 */
			_doOnClick: function(e) {
				e.preventDefault();
				var $el = $(e.currentTarget),
					selected = this.options.classes.selected;

				//load the selected value and trigger the change
				this.val = $el.find("a").attr("title");
				this.options.parent.trigger(this.options.changeEvent, [this.getValue()]);

				//add the selected class
				this.element.find("." + selected).removeClass(selected);
				$el.addClass(selected);
			},


			/**
			 * Returns the current saved value.
			 * @return {object} the value in an object literal containing the value as a "val" property
			 */
			getValue: function() {
				return {
					val: this.val,
					id: this.id
				};
			},

			/**
			 * Default destroy function - called when the widget is destroyed. Unbinds the event handlers.
			 */
			destroy: function() {
				this.element.off(this.options.eventNs);
				Widget.prototype.destroy.call(this);
			}

		});



		/**
		 * Color Picker Field Widget.
		 * A standard input with type text can be made as a color picker field with preview color field.
		 *
		 * Dependencies:
		 * - jQuery
		 * - jQuery-ui-core
		 * - jQuery-ui-widget
		 * - ColorPicker by Stefan Petre www.eyecon.ro
		 * - Undersore.js
		 */
		$.widget("pexeto.pexetoColorpicker", {
			options: {
				eventNs: "pexetoColorpicker",
				classes: {
					preview: "color-preview"
				},
				defaultValue: "b5b6b7"
			},

			/**
			 * Default create function executed when the widget is initialized.
			 */
			_create: function() {
				_.bindAll(this, 'init', '_doOnSubmit', '_doOnBeforeShow', 'destroy', 'updatePreviewColor');
				this.init();
			},

			/**
			 * Inits the main color picker functionality.
			 */
			init: function() {
				var o = this.options;

				this.id = this.element.attr("id");
				this.value = this.element.val();
				this.previewBtn = this.element.siblings("." + o.classes.preview);

				if(this.value) {
					this.previewBtn.css({
						backgroundColor: '#' + this.value
					});
				}

				//init color picker for the main input element
				this.element.ColorPicker({
					onSubmit: this._doOnSubmit,
					onBeforeShow: $.proxy(function() {
						this._doOnBeforeShow(this.element);
					}, this)
				});

				//init color picker for the preview box
				this.previewBtn.ColorPicker({
					onSubmit: this._doOnSubmit,
					onBeforeShow: $.proxy(function() {
						this._doOnBeforeShow(this.previewBtn);
					}, this)
				});

				this.element.on("keyup colorChange", this.updatePreviewColor);
			},

			/**
			 * On submit color event handler. Sets the selected color value in hexadecimal format to the main input element.
			 * @param  {string} hsb [description]
			 * @param  {string} hex hexadecimal value of the color
			 * @param  {string} rgb RGB value of the color
			 * @return {string}
			 */
			_doOnSubmit: function(hsb, hex, rgb) {
				this.element.val(hex).ColorPickerHide();
				this.previewBtn.css({
					backgroundColor: '#' + hex
				});
				this.value = hex;
			},

			/**
			 * Sets the default value to the color picker before getting displayed.
			 * @param  {object} $el the element which launches the color picker
			 */
			_doOnBeforeShow: function($el) {
				var val = this.value || this.options.defaultValue;
				$el.ColorPickerSetColor(val);
			},

			/**
			 * Destroy function executed when the widget is destroyed. Unbinds the event handlers.
			 */
			destroy: function() {
				this.element.off(this.options.eventNs);
				this.previewBtn.off(this.options.eventNs);
				Widget.prototype.destroy.call(this);
			},

			updatePreviewColor: function(){
				var value = this.element.val(),
					bgColor = value ? '#' + value : 'transparent';
				this.element.ColorPickerSetColor(value);
				this.previewBtn.css({
					backgroundColor: bgColor
				});
			}

		});


		/**
		 * Upload widget. Inits the AJAXUpload library to upload an image.
		 */
		$.widget("pexeto.pexetoUpload", {
			options: {
				errorText: "An error occurred, please make sure that the WordPress <strong>wp-content/uploads</strong> folder and all of its subfolders have writing permissions enabled on the server.",
				classes: {
					loading: "btn-loading",
					error: "option-error"
				}
			},

			/**
			 * Default create function executed when the widget is initialized.
			 */
			_create: function() {
				_.bindAll(this, 'init', '_doOnButtonClick');

				this.init();
			},

			/**
			 * Inits the AJAXUpload functionality.
			 */
			init: function() {
				var $btn = this.element;
		
				this.$input = $btn.siblings('input[type="text"]:first');

				$btn.on('click', this._doOnButtonClick);
			},


			_doOnButtonClick : function(){
				var self = this;
				// this.$fileInput.click();
				
				var mediaControl = {
						// Initializes a new media manager or returns an existing frame.
						// @see wp.media.featuredImage.frame()
					frame: function() {
					if ( this._frame )
						return this._frame;
					 
					this._frame = wp.media({
						title: 'Select Image',
						library: {
							type: 'image'
						},
						button: {
							text: 'Select Image'
						},
						multiple: false
					});
					this._frame.on( 'open', this.updateFrame ).state('library').on( 'select', this.select );
					return this._frame;
					},
					select: function(a) {
						var selection = this.frame.state().get('selection');


						if( selection )
						{
							var i = 0;
							
							selection.each(function(attachment){

								self.$input.val(attachment.attributes.url);

							});

						}
						
						},
						updateFrame: function() {
						// Do something when the media frame is opened.
						}
					};

					mediaControl.frame().open();
				}

		});


		/**
		 * ON/OFF widget.
		 * @author Pexeto
		 */
		$.widget("pexeto.pexetoOnOff", {
			options: {
				changeEvent: "option-change",
				parent: null,
				offMargin: 2,
				onMargin: 31,
				addHidden: false,
				//if set to true, it will add a hidden input which will be 
				//populated with the data
				eventNs: "pexetoonoff"
			},

			/**
			 * Default create function, which is executed when the widget is
			 * initialized.
			 */
			_create: function() {
				_.bindAll(this, 'init', 'doOnClick', '_setHandlePosition', 'getValue', 'destroy');
				this.val = false;
				this.init();
			},

			/**
			 * Inits the main functionality.
			 */
			init: function() {
				this.id = this.element.attr("id");
				if(this.element.hasClass("on")) {
					this.val = true;
				}
				this.handle = this.element.find("span.handle");

				//add a hidden input that will be populated with the selected
				//value
				if(this.options.addHidden) {
					this.input = $('<input />', {
						type: "hidden",
						name: this.id,
						value: this.val.toString()
					}).appendTo(this.element);
				}

				this._setHandlePosition(false);

				this.element.on("click." + this.options.eventNs, this.doOnClick);
			},

			/**
			 * On click event handler. Populates the value with the new selected
			 * value (ON/OFF -> true/false) and calls a function to animate
			 * the widget and show the new selected value.
			 */
			doOnClick: function() {
				var o = this.options;

				if(!this.inAnimation) {
					this.val = !this.val;

					if(this.options.addHidden) {
						//populates the hidden input if there is one
						this.input.val(this.val.toString());
					}
					o.parent.trigger(o.changeEvent, [this.getValue()]);

					this.inAnimation = true;
					this._setHandlePosition(true);
				}
			},

			/**
			 * Changes the handle position to the selected value - ON/OFF.
			 * @param {boolean} animate sets whether to animate the change or
			 * just apply it with CSS.
			 */
			_setHandlePosition: function(animate) {
				var margin, addClass, removeClass;
				if(this.val) {
					margin = this.options.onMargin;
					addClass = "on";
					removeClass = "off";
				} else {
					margin = this.options.offMargin;
					addClass = "off";
					removeClass = "on";
				}

				if(animate) {
					this.handle.animate({
						marginLeft: margin
					}, $.proxy(function() {
						this.inAnimation = false;
					}, this));
				} else {
					this.handle.css({
						marginLeft: margin
					});
				}

				this.element.removeClass(removeClass).addClass(addClass);


			},

			/**
			 * Retrieves the current selected value for the widget.
			 * @return {object} containing the following properties:
			 * id: the ID of the widget
			 * val: the currently selected value of the widget
			 */
			getValue: function() {
				return {
					val: this.val,
					id: this.id
				};
			},

			/**
			 * Destroys the widget. Removes all the registered events for the
			 * widget.
			 */
			destroy: function() {
				this.element.off(this.options.eventNs);
				Widget.prototype.destroy.call(this);
			}

		});


		/**
		 * Checkbox widget - provides the functionality to select (check)
		 * multiple values from a given select list.
		 *
		 * @author Pexeto
		 * http://pexetothemes.com
		 */
		$.widget("pexeto.pexetoCheckbox", {
			options: {
				changeEvent: "option-change",
				parent: null,
				holderSel: ".check-holder",
				selectedClass: "selected",
				eventNs: "pexetocheck",
				addHidden: false //if set to true, an input type=hidden will be added to the element and will be populated with the data
			},

			/**
			 * Default create function, which is executed when the widget is
			 * initialized.
			 */
			_create: function() {
				_.bindAll(this, 'init', 'doOnClick', '_loadValue', 'getValue', 'destroy');

				this.val = [];
				this.init();
			},

			/**
			 * Inits the main functionality for the widget.
			 */
			init: function() {
				this.id = this.element.attr("id");
				this._loadValue();

				this.element.on("click." + this.options.eventNs, this.options.holderSel, this.doOnClick);

				if(this.options.addHidden) {
					//add a hidden input that will be populated with the selected
					//value
					this.input = $('<input />', {
						type: "hidden",
						name: this.id,
						value: this.val.join(",")
					}).appendTo(this.element);
				}
			},

			/**
			 * On click event handler. Selects or deselects the clicked option
			 * depending on the previous state of the option. Populates the
			 * value of the widget.
			 * @param  {object} e the event object
			 */
			doOnClick: function(e) {
				e.preventDefault();
				var o = this.options,
					$el = $(e.currentTarget),
					val = $el.data("val"),
					changed = false;

				if($el.hasClass(o.selectedClass) && _.include(this.val, val)) {
					//ecxclude the selected element
					this.val = _.without(this.val, val);
					changed = true;
					$el.removeClass(o.selectedClass);
				} else if(!$el.hasClass(o.selectedClass) && !_.include(this.val, val)) {
					//include the selected element
					this.val.push(val);
					changed = true;
					$el.addClass(o.selectedClass);
				}

				if(changed) {
					//trigger change
					o.parent.trigger(o.changeEvent, [{
						id: this.id,
						val: this.val
					}]);
					if(this.options.addHidden) {
						//update the hidden input's value
						this.input.val(this.val.join(","));
					}
				}

			},

			/**
			 * Loads the value for the widget depending on the selected elements
			 */
			_loadValue: function() {
				var o = this.options;

				this.element.find(o.holderSel).each($.proxy(function(i, el) {
					var $el = $(el);
					if($el.hasClass(o.selectedClass)) {
						this.val.push($el.data("val"));
					}
				}, this));
			},

			/**
			 * Retrieves the current selected value for the widget.
			 * @return {object} containing the following properties:
			 * id: the ID of the widget
			 * val: the currently selected value of the widget
			 */
			getValue: function() {
				return {
					val: this.val,
					id: this.id
				};
			},

			/**
			 * Destroys the widget. Removes all the registered events for the
			 * widget.
			 */
			destroy: function() {
				this.element.off(this.options.eventNs);
				Widget.prototype.destroy.call(this);
			}

		});

	})(jQuery);
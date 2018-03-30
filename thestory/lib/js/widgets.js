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
					closeText: '',
					width:400
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
				_.bindAll(this, 'init', '_doOnButtonClick', '_buildMarkup', '_removeImage', 'destroy');

				this.$inputEl = this.element.siblings('input[type="text"]:first');

				this.init();
			},

			/**
			 * Inits the AJAXUpload functionality.
			 */
			init: function() {
				var self = this,
					$el = this.element;

				this.fieldid = $el.data('fieldid');
				this.fieldname = $el.data('fieldname') || this.fieldid;
				this.previewType = $el.data('type') || 'image';
				this.mediaType = $el.data('video') ? 'video' : 'image';
				this.url = $el.data('url') || '';
				this.thumbnail = $el.data('thumbnail') || '';

				if(this.mediaType=='video'){
					this.previewType = 'text';
				}

				this._buildMarkup();
			},

			_buildMarkup : function(){
				var $el = this.element,
					displayButton = (this.previewType=='image' && this.url) ? 'none' : 'block',
					inputType = this.previewType=='image'?'hidden':'text';

				this.$input = $('<input />', 
						{type:inputType, id:this.fieldid, name:this.fieldname, value:this.url, 'class':'option-input pexeto-upload-field'})
						.appendTo($el);



				if(this.previewType=='image'){

					//there is a saved image

					this.$imgWrap = $('<div class="upload-img-wrapper"></div>').appendTo($el).hide();

					this.$imgPreview = $('<img />', {'class':'upload-preview'})
						.appendTo(this.$imgWrap);
					this.$delButton = $('<div class="upload-remove-btn"></div>')
						.appendTo(this.$imgWrap)
						.on('click', this._removeImage);

					
				}

				this.$selectButton = $('<input />', 
						{type:'button', value:'Select '+this.mediaType, 'class':'button'})
					.css('display', displayButton)
					.appendTo($el)
					.on('click', this._doOnButtonClick);

				$el.append('<div class="clear"></div>');

				if(this.previewType=='image'){
					this._setImage();
				}
				
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
						title: 'Select '+self.mediaType,
						library: {
						type: self.mediaType
						},
						button: {
						text: 'Select '+self.mediaType
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
								var thumb = attachment.attributes.sizes && attachment.attributes.sizes.thumbnail  ?  
									attachment.attributes.sizes.thumbnail.url
										: attachment.attributes.url;

								self._updateValue({
									url : attachment.attributes.url,
									thumbnail : thumb
								});

								if(self.previewType=='image'){
									self._setImage();
								}
							});

						}
						
						},
						updateFrame: function() {
						// Do something when the media frame is opened.
						}
					};

					mediaControl.frame().open();
			},

			_removeImage : function(){
				if(this.$imgPreview){
					this.$imgPreview.attr('src', '');
				}
				if(this.$imgWrap){
					this.$imgWrap.hide();
				}
				this.$selectButton.show();
				this._updateValue({
					url : '',
					thumbnail : ''
				});
			},

			_setImage : function(){
				var previewImg = this.thumbnail || this.url;

				if(previewImg){
					this.$imgPreview.attr('src', previewImg);
					this.$imgWrap.show();
					this.$selectButton.hide();
					this.$input.data('thumbnail', previewImg);
				}
			},

			_updateValue : function(data){
				this.url = data.url;
				this.thumbnail = data.thumbnail||'';
				this.$input.val(data.url);
			},

			clear : function(){
				this._removeImage();
			},

			getData : function(){
				return {
					url : this.url,
					thumbnail : this.thumbnail,
					fieldid : this.fieldid,
					fieldname: this.fieldname || this.fieldid
				};
			},

			isImageSet : function(){
				return this.url ? true:false;
			},

			/**
			 * Destroys the widget functionality.
			 */
			destroy: function() {
				Widget.prototype.destroy.call(this);
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



		$.widget("pexeto.pexetoMultiUpload", {
			options: {
				eventNs: "pexetomulti",
				selectText : "Add Images"
			},

			_create: function() {
				_.bindAll(this, '_doOnButtonClick', '_removeImage', '_doOnEdit', '_doOnOrderChanged');
				this.init();
			},

		
			init: function() {
				var $el = this.element;

				this.fieldid = $el.data('fieldid');
				this.fieldname = $el.data('fieldname') || this.fieldid;
				this.images = [];
				this.lastUniqueId = 0;

				this._buildMarkup();
			},

			_buildMarkup : function(){
				var $el = this.element,
					self = this,
					images = $el.data('images');


				this.$input = $('<input />', 
						{type:'hidden', id:this.fieldid, name:this.fieldname, 'class':'option-input pexeto-multiupload-field'})
						.appendTo($el);


				this.$imgWrap = $('<div class="multiupload-img-wrapper"></div>').appendTo($el)
					.sortable( { update: self._doOnOrderChanged});

					
				this.$selectButton = $('<input />', 
						{type:'button', value:this.options.selectText, 'class':'button'})
					.appendTo($el)
					.on('click', this._doOnButtonClick);

				this.$imgWrap.on('click', '.upload-remove-btn', this._removeImage)
					.on('click', '.upload-edit-btn', this._doOnEdit);


				if(images && images.length){
					this._addImages(images);
				}

			},


			_doOnButtonClick : function(){
				var self = this,
					mediaControl = {
						frame: function() {
							if ( this._frame )
								return this._frame;
							 
							this._frame = wp.media({
								title: self.options.selectText,
								library: {
									type: 'image'
								},
								button: {
									text: self.options.selectText
								},
								multiple: true
							});
							this._frame.on( 'open', this.updateFrame ).state('library').on( 'select', this.select );
							return this._frame;
						},
						select: function(a) {
							var selection = this.frame.state().get('selection');

							if( selection ){
								var images = [];
							
								selection.each(function(attachment){
									var thumb = attachment.attributes.sizes.thumbnail ?  attachment.attributes.sizes.thumbnail.url
										: attachment.attributes.url;
									images.push({
										id : attachment.id,
										thumbnail : thumb
									});
								});

								if(images.length){
									self._addImages(images);
								}

							}
						
						}
					};

					mediaControl.frame().open();
			},


			_addImages:function(images){
				var i = 0, len = images.length;

				images = this._applyUniqueIds(images);

				for(;i<len;i++){
					$('<div />', {'class':'multi-preview-wrap', 'id':images[i]['uniqueId']})
					.append('<img src="'+images[i]['thumbnail']+'" />')
					.append($('<div />', {'class':'upload-remove-btn', data:{'img_unique_id':images[i]['uniqueId']}}))
					.append($('<div />', {'class':'upload-edit-btn', data:{'imgid':images[i]['id']}}))
					.appendTo(this.$imgWrap);
				}

				this._updateValues(images, true);
			},

			_removeImage : function(e){
				var $btn = $(e.currentTarget),
					imgId = parseInt($btn.data('img_unique_id'), 10),
					imageIds;

				this.images = _.reject(this.images, function(img){
					return img['uniqueId'] == imgId;
				});

				imageIds = _.pluck(this.images, 'id');

				this.$input.val(imageIds);

				$btn.parents('.multi-preview-wrap:first').remove();
			},

			_doOnEdit : function(e){
				var $btn = $(e.currentTarget),
					imageId = parseInt($btn.data('imgid'), 10);

				if(!imageId){
					return;
				}

				var self = this,
					mediaControl = {
						frame: function() {
							if ( this._frame )
								return this._frame;
							 
							this._frame = wp.media({
								title: 'Edit image',
								button: {
									text: 'Update image'
								},
								multiple: false
							});
							this._frame.on( 'open', this.updateFrame );
							return this._frame;
						},
						updateFrame : function(){
							var frame = mediaControl._frame;

							var selection	=	frame.state().get('selection'),
								attachment	=	wp.media.attachment( imageId );
							
							attachment.fetch();
							selection.add( attachment );
						}
					};

					mediaControl.frame().open();
			},

			getData : function(){
				return {
					images : this.images,
					fieldid : this.fieldid,
					fieldname: this.fieldname || this.fieldid
				};
			},

			getImgHtml : function(){
				var html='', i=0, len = this.images.length;

				for(;i<len;i++){
					html+='<img src="'+this.images[i]['thumbnail']+'" />';
				}

				return html;
			},

			_applyUniqueIds : function(images){
				var i = 0, len = images.length;

				for(;i<len;i++){
					images[i].uniqueId = ++this.lastUniqueId;
				}
				return images;
			},

			_updateValues : function(images, append){
				var imageIds;

				if(append){
					this.images = this.images.concat(images);
				}else{
					this.images = images;
				}

				imageIds = _.pluck(this.images, 'id');
			
				this.$input.val(imageIds.join(","));
			},

			_doOnOrderChanged : function(){
				var newOrder = this.$imgWrap.sortable('toArray'),
					newImages = [],
					i = 0, len = newOrder.length,
					uniqueId;

				for(;i<len;i++){
					uniqueId = parseInt(newOrder[i], 10);
					newImages.push(_.find(this.images, function(img){
						return img.uniqueId===uniqueId;
					}));
				}


				this._updateValues(newImages, false);


			},

			imagesSet : function(){
				return this.images.length ? true : false;
			},

			clear : function(){
				this.$input.val('');
				this.images = [];
				this.$imgWrap.html('');
			}


		});

	})(jQuery);
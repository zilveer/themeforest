/**
 * This file contains the main functionality that will be loaded for the theme
 * on many pages in the admin section. Author: Pexeto http://pexeto.com/
 */


(function($) {

	var PEXETO_W = PEXETO_W || {};

	/**
	 * Getter and setter function for text values - checks the type of the element and if the element contains
	 * embedded text (such as a DIV element), gets/sets its inner text. If the element sets contains its value
	 * as a "value" attribute (such as an INPUT element), gets/sets its value.
	 */
	$.fn.pexval = function() {
		var elem = $(this),
		tagname=elem.get(0).tagName.toLowerCase(),
		value=arguments.length?arguments[0]:false;
		
		/**
		 * Gets the value.
		 */
		function pexGetValue(){
			if(tagname==='input'||tagname==='select'){
				return elem.val();
			}else{
				return elem.text();
			}
		}
		
		/**
		 * Sets the value.
		 */
		function pexSetValue(value){
			if(tagname==='input'||tagname==='select'){
				return elem.val(value)
			}else{
				return elem.text(value);
			}
		}
		
		if(value===false){
			//no arguments have been passed, call the getter function
			return pexGetValue();
		}else{
			//there is at least one argument passed, call the setter function
			return pexSetValue(value);
		}
	};

	pexetoPageOptions = {

		/**
		 * Inits all the functions needed.
		 */
		init : function() {
			this.setColorPickerFunc();
			this.loadUploadFunctionality();
		},

		/**
		 * Loads the color picker functionality to all the inputs with class
		 * "color".
		 */
		setColorPickerFunc : function() {
			// set the colorpciker to be opened when the input has been clicked
			var colorInputs = $('input.color');
			if (colorInputs.length) {
				colorInputs.ColorPicker( {
					onSubmit : function(hsb, hex, rgb, el) {
						$(el).val('#' + hex);
						$(el).ColorPickerHide();
					},
					onBeforeShow : function() {
						$(this).ColorPickerSetColor(this.value);
					}
				});
			}

		},

		/**
		 * Calls the Upload functionality. Requirements: - button with class
		 * "pexeto-upload-btn" - input field sibling to the button with class
		 * "pexeto-upload"
		 */
		loadUploadFunctionality : function() {
			$('.pexeto-upload-btn').each(function() {
				pexetoPageOptions.loadUploader($(this));
			});
		},

		/**
		 * Loads the upload functionality to an element. Requirements: - input
		 * field sibling to the element with class "pexeto-upload"
		 * 
		 * @param element
		 *            the button element whose clicking event will trigger this
		 *            functionality
		 */
		loadUploader : function(element) {
			var upload = new PEXETO_W.Upload(element);
			upload.init();
		}
	};



	PEXETO_W.Upload = function(element, options){
		var defaults = {
			errorText: "An error occurred, please make sure that the WordPress <strong>wp-content/uploads</strong> folder and all of its subfolders have writing permissions enabled on the server.",
			classes: {
				loading: "btn-loading",
				error: "option-error"
			}
		};
		this.$btn = element;
		this.options = $.extend(defaults, options);
	};

	var upload_proto = PEXETO_W.Upload.prototype;

	upload_proto.init = function(){
		var $btn = this.$btn;
		
		this.$input = this.$btn.siblings('input[type="text"]:first');
		$btn.on('click', $.proxy(this._doOnButtonClick, this));
	};


	upload_proto._doOnButtonClick = function(){
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
	};
})(jQuery);

jQuery(function() {
	pexetoPageOptions.init();
});

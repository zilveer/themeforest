/**
 * This file contains the main functionality that will be loaded for the theme
 * on many pages in the admin section. 
 * 
 * @author: Pexeto 
 * http://pexetothemes.com/
 */
(function($){
	"use strict";
	
	var count=0;
	$.widget("pexeto.pexetoPageOptions", {
		options:{
			//IDs, classess and selectors
			saveBtnSel     : "#op-save-button",
			nonceId        : "pexeto-theme-options",
			textInputSel   : ".option-input",
			textAreaSel    : ".option-textarea",
			selectSel      : ".option-select",
			onOffSel       : ".on-off",
			checkboxSel    : ".option-check",
			uploadSel      : ".pexeto-upload-btn",
			eventNs        : "pexetooptions",
			btnOptionSel   : ".button-option",
			colorOptionSel : ".option-color",
			helpSel        : ".help-button",
			helpDialogSel  : ".help-dialog",
			loadingClass   : "content-loading",
			templateSel    : "select#page_template",
			optionSel      : ".option",
			headingSel     : ".option-heading"
		},

		_create : function(){
			_.bindAll(this, 'init', 'setFieldsVisibility', 'setRadioFunctionality');  
			this.init();
		},

		/**
		 * Inits all the main functionality, such as settings widgets
		 */
		init : function(){
			var o = this.options;

			this.element.find(o.uploadSel).each($.proxy(function(i, el){
				$(el).pexetoUpload();
			}, this));

			this.element.find(o.colorOptionSel).each($.proxy(function(i, el){
				$(el).pexetoColorpicker();
			}, this));


			//init the on/off elements
			this.element.find(o.onOffSel).each($.proxy(function(i, el){
				var $el = $(el);
				$el.pexetoOnOff({changeEvent:o.changeEvent, parent:this.element, addHidden:true});
			}, this));

			//init the dialog
			this.element.find(o.helpSel).pexetoDialogBtn();

			//init the multi-checkbox
			this.element.find(o.checkboxSel).each($.proxy(function(i, el){
				var $el = $(el);
				$el.pexetoCheckbox({changeEvent:o.changeEvent, parent:this.element, addHidden:true});
			}, this));
			
			this.$templateSelect = $(o.templateSel).on("change", this.setFieldsVisibility);
			this.setFieldsVisibility();

			this.setRadioFunctionality();
		},


		/**
		 * Sets the setting field visibility according to the currently selected
		 * page template. Displays only the fields that apply for the selected
		 * page template.
		 */
		setFieldsVisibility : function(){
			var o = this.options,
				selectedTemplate = "";

			if(this.$templateSelect.length){
				selectedTemplate = this.$templateSelect.val();

				if(selectedTemplate){
					this.element.find(o.optionSel+","+o.headingSel).each($.proxy(function(i, el){
						var $el = $(el),
							templates = $el.data("template") ? $el.data("template").split(",") : [],
							contains = _.find(templates, function(template){
								return template===selectedTemplate;
							}),
							display = (contains || !templates.length) ? "block" : "none";

						$el.css({display:display});

					}, this));
				}
			}

		},

		setRadioFunctionality : function(){
			$('.option-imageradio').on('click', 'img', function(){
				$(this).siblings('input[type="radio"]').trigger('click');
			});
		}

	});


})(jQuery);


jQuery(document).ready(function($) {
	$(".pexeto-meta-boxes").pexetoPageOptions();
});




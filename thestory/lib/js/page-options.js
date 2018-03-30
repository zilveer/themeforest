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
			uploadSel      : ".pexeto-upload",
			eventNs        : "pexetooptions",
			btnOptionSel   : ".button-option",
			colorOptionSel : ".option-color",
			helpSel        : ".help-button",
			helpDialogSel  : ".help-dialog",
			loadingClass   : "content-loading",
			templateSel    : "select#page_template",
			optionSel      : ".option",
			headingSel     : ".option-heading",
			templatesToHideEditor : []
		},

		_create : function(){
			_.bindAll(this, 'init', 'setFieldsVisibility', 'setRadioFunctionality', 'setElementsVisibility');  
			this.init();
		},

		/**
		 * Inits all the main functionality, such as settings widgets
		 */
		init : function(){
			var o = this.options;

			this.$parent = this.element.parents('.postbox-container:first');

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
			
			this.$metaOptions = this.element.find(o.optionSel+","+o.headingSel);



			this.$templateSelect = $(o.templateSel).on("change", this.setElementsVisibility);
			this.editor = $('#postdivrich');
			this.enableHideEditor = this.options.templatesToHideEditor && this.editor.length;
			
			this.setElementsVisibility();
			this.setRadioFunctionality();

			
			
		},


		setElementsVisibility : function(){
			if(this.$templateSelect.length){
				var selectedTemplate = this.$templateSelect.val();

				if(selectedTemplate){
					this.setFieldsVisibility(selectedTemplate);
					if(this.enableHideEditor){
						this.setEditorVisibility(selectedTemplate);
					}
				}
			}

			this.setDependantFieldsVisibility();
		},

		/**
		 * Sets the setting field visibility according to the currently selected
		 * page template. Displays only the fields that apply for the selected
		 * page template.
		 */
		setFieldsVisibility : function(selectedTemplate){
			var o = this.options;

			this.$metaOptions.each($.proxy(function(i, el){
				var $el = $(el),
					templates = $el.data("template") ? $el.data("template").split(",") : [],
					contains = _.contains(templates, selectedTemplate),
					display = (contains || !templates.length) ? "block" : "none";

				$el.css({display:display});

			}, this));

		},

		setDependantFieldsVisibility : function(){
			var $depFields = this.$metaOptions.filter('[data-show_when]'),
				setDepFieldVisibility = function($depField, $field, showVal){
					if($field.val()===showVal && $field.is(':visible')){
						$depField.show();
					}else{
						$depField.hide();
					}
				};

			if($depFields.length){
				$depFields.each(function(){
					var $depField = $(this),
						data = $depField.data('show_when'),
						parts = data.split(':'),
						$field,
						showVal = '',
						$radioBtns;

					if(parts.length===2){
						showVal = parts[1];
						$field = $('#'+parts[0]);

						if($field.length){
							setDepFieldVisibility($depField, $field, showVal);

							$field.on('change', function(){
								setDepFieldVisibility($depField, $field, showVal);
							});
						}else{
							$radioBtns = $('input[type=radio][name='+parts[0]+']');
							if($radioBtns.length){
								setDepFieldVisibility($depField, $radioBtns.filter(':checked'), showVal);

								$radioBtns.on('change', function(){
									setDepFieldVisibility($depField, $radioBtns.filter(':checked'), showVal);
								});
							}
						}
					}
				});
			}
		},

		setEditorVisibility : function(selectedTemplate){
			var editorVisible = this.editor.is(':visible'),
				hideEditor = _.contains(this.options.templatesToHideEditor, selectedTemplate);

			if(hideEditor && editorVisible){
				this.editor.hide();
			}else if(!hideEditor && !editorVisible){
				this.editor.show();
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
	var options = {};
	if(PEXETO.templatesToHideEditor){
		options.templatesToHideEditor = PEXETO.templatesToHideEditor;
	}
	$(".pexeto-meta-boxes").pexetoPageOptions(options);
});




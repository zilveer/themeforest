/**
 * This is the JS file for the admin options page.
 * 
 * Author: Pexeto http://pexeto.com/
 */


var pexetoOptions={
		
		separator:'|*|',
		dialogOpened:false,
	
		/**
		 * Inits all the functionality needed for the options panel.
		 */
		init:function(options) {
	
			pexetoOptions.setCheckboxClickHandlers();
			pexetoOptions.setHelpFunc();
			pexetoOptions.setOnOffFunc();
			pexetoOptions.setColorpickFunc();
			pexetoOptions.setStyleSelectFunc();
			
			jQuery(".sortable").sortable();
			
			var mainNavOptions={};
			
			if(options.cookie){
				mainNavOptions={cookie: {
					name: 'tabs',
					expires: 1
				}};
			}

			pexetoOptions.setTabs(options.cookie);
			
			jQuery('#options-submit').bind('click', function(event){
				event.preventDefault();
				jQuery('#pexeto-options').submit();
			});
			
			//change the cursor to pointer to all the items from the class hover when hovered
			jQuery('#pexeto-content-container').delegate('.hover', 'mouseover', function(){
				jQuery(this).css({cursor:'pointer'});
			});
			
			//set the focus styling for inputs that are edited
			jQuery('.sortable').delegate('input', 'focusin', function(){
				jQuery(this).addClass('selected');
			})
			.delegate('input', 'focusout', function(){
				jQuery(this).removeClass('selected');
			});
			
			pexetoOptions.loadSelectedSliderNames();
			
			jQuery('#pexeto-content-container').append('<input type="hidden" value="Pexeto Options Panel" />');
		},
		
		/**
		 * Sets the tabs functionality for the options panel
		 * @param enableCookies whether to use cookies for saving the latest edited location
		 */
		setTabs:function(enableCookies){
			
			jQuery('.main-navigation-container').hide();
			
			var selectedClass='ui-tabs-selected',
				mainNavCookie='pexeto-main-navigation',
				subNavCookie='pexeto-sub-navigation',
				mainNotSel=(enableCookies && jQuery.cookie(mainNavCookie))?jQuery.cookie(mainNavCookie):':first',
				mainSel=mainNotSel===':first'?'a:first':'a[href="'+mainNotSel+'"]';
				
			if(mainNotSel===':first'){
				//no cookie has been set, show the first tab content
				jQuery('.main-navigation-container:first').show();
			}else{
				//a cookie has been set, show the saved tab content
				jQuery(mainNotSel).show();
			}
			
			jQuery('#content').css({backgroundImage:'none'});
			//style the selected navigation item
			jQuery('#navigation '+mainSel).parents('li:first').addClass(selectedClass);
			
			//set the subnavigation
			jQuery('.main-navigation-container').each(function(){
				var thisId='#'+jQuery(this).attr('id'),
					notSel=(enableCookies && jQuery.cookie(thisId))?jQuery.cookie(thisId):':first',
					sel=notSel===':first'?'a.tab:first':'a.tab[href="'+notSel+'"]';
					
				jQuery(this).find('.sub-navigation-container').not(notSel).hide();
				jQuery(this).find(sel).parents('li:first').addClass(selectedClass);
			});
			
			
			//set click handlers to the main navigation menu
			jQuery('#navigation a').click(function(event){
				event.preventDefault();
				var href=jQuery(this).attr('href');
				jQuery('.main-navigation-container').hide();
				jQuery(href).show();
				jQuery('#navigation li').removeClass(selectedClass);
				jQuery(this).parents('li:first').addClass(selectedClass);
				if(enableCookies){
					jQuery.cookie(mainNavCookie,href);
				}
			});
			
			//set click handlers to the subnavigation menu
			jQuery('a.tab').click(function(event){
				event.preventDefault();
				var href=jQuery(this).attr('href');
				jQuery(href).show().siblings('.sub-navigation-container').hide();
				jQuery(this).parents('li:first').addClass(selectedClass).siblings('li').removeClass(selectedClass);
				if(enableCookies){
					var parentId='#'+jQuery(this).parents('div.main-navigation-container:first').attr('id');
					jQuery.cookie(parentId,href);
				}
			});
		},
		
		/**
		 * Loads the names of the sliders that correspond to the selected slider only.
		 */
		loadSelectedSliderNames:function(){
			//load the slider names with the initial page load
			var savedClass=jQuery('#dandelion_home_slider').find('option[value="'+jQuery('#dandelion_home_slider').val()+'"]').attr('class');
			jQuery('#dandelion_home_slider_name option').not('.'+savedClass).hide();
			if(!jQuery('#dandelion_home_slider_name option.'+savedClass).length){
				//disable the drop down if no slider names correspond to the selected option
				jQuery('#dandelion_home_slider_name').attr('disabled', 'disabled');
			}
			
			//load the slider names when the slider type has been changed
			jQuery('#dandelion_home_slider').change(function(){
				var selectedval = jQuery(this).val(),
				selectedClass=jQuery(this).find('option[value="'+selectedval+'"]').attr('class'),
				selectedOptions=jQuery('#dandelion_home_slider_name option.'+selectedClass);
				
				if(selectedOptions.length){
					//enable the drop down if disabled
					jQuery('#dandelion_home_slider_name').removeAttr('disabled');
					selectedOptions.show();
					jQuery('#dandelion_home_slider_name option').not('.'+selectedClass).removeAttr('selected').hide();
				}else{
					//disable the drop down if no slider names correspond to the selected option
					jQuery('#dandelion_home_slider_name').attr('disabled', 'disabled');
				}
				
			});
		},
		
		removeSavedMessage:function(){
			jQuery('#saved_box').slideUp('slow');
		},
		
		/**
		 * Sets the functionality for selecting a button style-
		 * this may be mainly used with selecting a color or a pattern for a theme.
		 */
		setStyleSelectFunc:function(){
			jQuery('.styles-holder').each(function(){
				jQuery(this).delegate('a.style-box', 'click', function(event){
					event.preventDefault();
					var $that=jQuery(this),
						$parent=jQuery(this).parent();
					$parent.addClass('selected-style').siblings('.selected-style').removeClass('selected-style');
					$parent.parent().siblings('input').attr("value", $that.attr('title'));
				});
			});
		},
		
		/**
		 * Sets the help button functionality.
		 */
		setHelpFunc:function(){
			jQuery('#pexeto-content-container').delegate('a.help-button', 'click', function(event){
				event.preventDefault();
				if(!pexetoOptions.dialogOpened){
					jQuery(this).find('.help-dialog:first').clone().dialog({
						autoOpen: true,
						title: jQuery(this).attr('title'),
						closeText: '',
						dialogClass : 'pexeto-dialog',
						open:function(){
							pexetoOptions.dialogOpened=true;
						},
						close:function(){
							pexetoOptions.dialogOpened=false;
						}
					});
				}
			});	
		},
		
		/**
		 * Loads the color picker for changing theme style.
		 */
		setColorpickFunc:function(){
			//set the colorpciker to be opened when the input has been clicked
			jQuery('input.option-color').ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					jQuery(el).val(hex);
					jQuery(el).ColorPickerHide();
					jQuery(el).siblings('.color-preview').css({backgroundColor:'#'+hex});
				},
				onBeforeShow: function () {
					jQuery(this).ColorPickerSetColor(this.value);
				}
			})
			.bind('keyup', function(){
				var value=this.value;
				jQuery(this).ColorPickerSetColor(value);
				var bgColor=value===''?'transparent':'#'+value;
				jQuery(this).siblings('.color-preview').css({backgroundColor:bgColor});
			});
			
			//set the colorpicker to be opened when the preview button has been clicked
			jQuery('.color-preview').ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					jQuery(el).css({backgroundColor:'#'+hex}).ColorPickerHide();
					jQuery(el).siblings('input.option-color').attr("value", hex);
				},
				onBeforeShow: function () {
					jQuery(this).ColorPickerSetColor(jQuery(this).siblings('input.option-color').attr('value'));
				}
			})
			.bind({'keyup': function(){
				jQuery(this).ColorPickerSetColor(this.value);
			},'mouseover':function(){
				jQuery(this).css({cursor:'pointer'});
			}
			});
		},
		
		/**
		 * Sets the functionlaity for the ON/OFF widget.
		 */
		setOnOffFunc:function(){
			jQuery('div.on-off').each(function(){
				if(jQuery(this).siblings('input[type=hidden]:first').attr('value')==='on'){
					jQuery(this).find('span').css({marginLeft:31});
				}
			});
			
			jQuery('div.on-off').bind('click', function(){
				var hiddenInput=jQuery(this).siblings('input[type=hidden]:first'),
					el = jQuery(this);
				if(hiddenInput.attr('value')=='on'){
					jQuery(this).find('span').animate({marginLeft:2});
					hiddenInput.attr('value', 'off');
					el.removeClass('on').addClass('off');
				}else{
					jQuery(this).find('span').animate({marginLeft:31});
					hiddenInput.attr('value', 'on');
					el.removeClass('off').addClass('on');
				}
			});
		},
				
		/**
		 * Sets a checkbox click handler. If a checkbox is checked, then the element is
		 * added. If the checkbox is unchecked, then the element is removed.
		 * 
		 * @return
		 */
		setCheckboxClickHandlers:function() {
			jQuery(".check").click(function(event) {
				event.preventDefault();
				var that=jQuery(this),
					value = that.attr('title'),
				    checked = false,
				    selectedClass='selected-check',
				    hiddenInput= jQuery(that.parents().get(1)).siblings(".hidden-value:first"),
				    hiddenIds=hiddenInput.val(),
				    idsArray=hiddenIds===''?[]:hiddenIds.split(',');
				
				that.toggleClass(selectedClass);
				checked = that.hasClass(selectedClass);
				
				if (checked) {
					// it is checked, add the element to the list
					idsArray.push(value);
				} else {
					// it is unchecked, remove the element from thr list
					idsArray = jQuery.grep(idsArray, function(val) {
						return val != value;
					});
				}
				hiddenIds=idsArray.join(',');
				
				//set the value to the hidden input
				hiddenInput.val(hiddenIds);

			});
		},
		
		/**
		 * Shows the already saved data
		 */
		showSavedImgData : function(optionsData) {
			var count = optionsData.inputIds.length;
			var data = [];
			for ( var i = 0; i < count; i++) {
				data[i] = jQuery(optionsData.hiddenIds[i]).val().split(pexetoOptions.separator);
			}

			var entryCount = data[0].length;
			// goes through all the saved entries and outputs the saved data
			for ( var j = 0; j < entryCount - 1; j++) {
				var html = '<li>';
				for ( var i = 0; i < count; i++) {
					if(optionsData.preview && optionsData.inputIds[i]==='#'+optionsData.preview){
						html+=pexetoOptions.generatePreview(data[i][j]);
					}
					var none=data[i][j]===''?'<i>---</i>':''; 
					html += '<div class="' + optionsData.spanClasses[i] + '_wrapper"><b>' + optionsData.labels[i] + ': </b><span class="' + optionsData.spanClasses[i]+ '">' + data[i][j] + '</span>'+none+'<br/></div>';
				}
				html += '<div class="editButton hover"></div><div class="deleteButton hover"></div></li>';
				jQuery(optionsData.ulId).append(html);
			}

		},
		
		generatePreview:function(imgUrl){
			return '<img src="'+imgUrl+'" />';
		},
		
		/**
		 * Initializes the functionality for setting more complex custom fields with a possibility
		 * for adding more types of data per item.
		 * @param mainId - the ID of the functionality
		 * @param fieldIds - an array that contains the IDs of all the inputs
		 * @param labels - an array that contains the label texts for each of the fields
		 * @param preview - if not an empty string, then it contains the ID of an image field whose value
		 * will be used for image thumbnail of the item.
		 */
		setCustomFieldsFunc:function(mainId, fieldIds, labels, istextarea, preview){
			inputIds=[];
			hiddenIds=[];
			spanClasses=[];
			for(var i=0, length=fieldIds.length; i<length; i++){
				inputIds[i]='#'+fieldIds[i];
				hiddenIds[i]='#'+fieldIds[i]+'s';
				spanClasses[i]=fieldIds[i]+'_span';
			}
			
			var ulId = '#'+mainId+'_list';
			var addButton = '#'+mainId+'_button';
			
			optionsData={
				inputIds:inputIds,
				hiddenIds:hiddenIds,
				spanClasses:spanClasses,
				istextarea:istextarea,
				ulId:ulId,
				labels:labels,
				addButton:addButton,
				preview:preview
			};

			pexetoOptions.setCommonAddFunc(optionsData);
		},
		
		/**
		 * Calls the main functions that execute the functionality.
		 */
		setCommonAddFunc:function(optionsData) {

			
			pexetoOptions.showSavedImgData(optionsData);
			jQuery(optionsData.addButton).click(function(event) {
				event.preventDefault();
				pexetoOptions.addItem(optionsData);
			});

			jQuery(optionsData.ulId).bind('sortstop', function(event, ui) {
				pexetoOptions.setSliderImgChanges(optionsData);
			});

			pexetoOptions.setActionButtonHandlers(optionsData);
		},
		
		/**
		 * Adds a new item to the list.
		 */
		addItem:function(optionsData) {

			var length = optionsData.inputIds.length;

			var html = '<li>';
			for ( var i = 0; i < length; i++) {
				if(optionsData.preview && optionsData.inputIds[i]==='#'+optionsData.preview){
					html+=pexetoOptions.generatePreview(jQuery(optionsData.inputIds[i]).val());
				}
				html += '<div class="' + optionsData.spanClasses[i] + '_wrapper"><b>' + optionsData.labels[i] + ': </b><span class="' + optionsData.spanClasses[i] + '">' + jQuery(optionsData.inputIds[i]).val() + '</span><br/></div>';
			}
			html += '<div class="editButton hover"></div><div class="deleteButton hover"></li>';

			jQuery(optionsData.ulId).append(html);
			pexetoOptions.setSliderImgChanges(optionsData);

		},
		
		/**
		 * Refreshes the output data after an item has been added/removed.
		 */
		setSliderImgChanges:function(optionsData) {
			var count = optionsData.inputIds.length;
			var values = [];

			for (i = 0; i < count; i++) {
				values[i] = '';
			}

			jQuery(optionsData.ulId + ' li').each(
					function() {
						for (i = 0; i < count; i++) {
							values[i] += jQuery(this).find('span.' + optionsData.spanClasses[i]).html() + pexetoOptions.separator;
						}
					});

			for (i = 0; i < count; i++) {
				//jQuery(optionsData.hiddenIds[i]).attr("value", values[i]);
				jQuery(optionsData.hiddenIds[i]).val(values[i]);
			}
		},
		
	
		/**
		 * Sets the delete and edit buttons click event handlers.
		 */
		setActionButtonHandlers:function(optionsData) {

			//set the delete button click handler
			jQuery(optionsData.ulId).delegate('.deleteButton', 'click', function(){
				jQuery(this).parent("li").remove();
				pexetoOptions.setSliderImgChanges(optionsData);
			});
			
			//set the edit button click handler
			jQuery(optionsData.ulId).delegate('.editButton', 'click', function(){
				var currentLi=jQuery(this).parent('li');
				currentLi.find('i').remove();
				currentLi.find('span').each(function(i){
					var that = jQuery(this),
					spanclass=that.attr('class'),
					spanvalue=that.html();

					//replace the span containing the value with an input so that it can be editable
					if(optionsData.istextarea[i]){
						that.replaceWith(jQuery('<textarea type="text" class="inputarea '+spanclass+'" >'+spanvalue+'</textarea>'));
					}else{
						that.replaceWith(jQuery('<input type="text" value="'+spanvalue+'" class="'+spanclass+'" />'));
					}
				});
				
				//set the done button click handler (when done editing)
				jQuery(this).replaceWith(jQuery('<div class="doneButton hover"></div>').click(function(e){
					e.preventDefault();
					currentLi.find('input,textarea').each(function(){
						var that = jQuery(this),
						spanclass=that.attr('class'),
						spanvalue=that.val();

						var none=spanvalue===''?'<i>---</i>':''; 
						//replace back the value from the input with a span
						that.replaceWith(jQuery('<span class="'+spanclass+'">'+spanvalue+'</span>'+none));
					});
					//save the changes to the hidden inputs
					pexetoOptions.setSliderImgChanges(optionsData);
					jQuery(this).replaceWith('<div class="editButton hover"></div>');
				}));
				
			});
			
		}
};

jQuery(window).load(function(){
	//remove the "Options Saved" message after 3 seconds
	if(jQuery('#saved_box').length){
	setTimeout('pexetoOptions.removeSavedMessage()', 3000);
	}
});



/**
 * This is the JS file for the admin options page.
 * 
 * Author: Pexeto http://pexeto.com/
 */

var separator = '|*|';


var pexetoOptions={
		init:function() {
			pexetoOptions.setCheckboxClickHandlers();
			
			jQuery(".sortable").sortable();
			jQuery(".sortable").disableSelection();
			jQuery('#tabs').tabs();
			
			//load the color picker for changing theme style
			jQuery('input.color').ColorPicker({
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
				jQuery(this).ColorPickerSetColor(this.value);
			});

		},
		
		loadUploader: function(element, pathToPhp, uploadsUrl){
			
			var button = element, interval;
			
			new AjaxUpload(button, {
				action: pathToPhp, 
				name: 'pexetofile',
				onSubmit : function(file, ext){
					// change button text, when user selects file			
					button.text('Uploading');
									
					// If you want to allow uploading only 1 file at time,
					// you can disable upload button
					this.disable();
					
					// Uploding -> Uploading. -> Uploading...
					interval = window.setInterval(function(){
						var text = button.text();
						if (text.length < 13){
							button.text(text + '.');					
						} else {
							button.text('Uploading');				
						}
					}, 200);
				},
				onComplete: function(file, response){
					imgUrl=uploadsUrl+'/'+response;
					
					button.siblings('input.image-input').attr('value', imgUrl);
					
					button.text('Upload Image');
								
					window.clearInterval(interval);
								
					// enable upload button
					this.enable();
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
			jQuery(".check").click(function() {
				var value = this.value;
				var checked = false;
				if (jQuery(this).is(':checked')) {
					checked = true;
				}

				var idsString = jQuery(this).siblings(".hiddenText").val();

				if (checked == true) {
					// it is checked, add the element to the list
					if (idsString != "") {
						idsString += "," + value;
					} else {
						idsString += value;
					}
				} else {
					// it is unchecked, remove the element from thr list
					var idsArray = idsString.split(",");
					idsString = "";
					for ( var i = 0; i < idsArray.length; i++) {
						if (idsArray[i] != value) {
							if (i != idsArray.length) {
								idsString += idsArray[i] + ",";
							} else {
								idsString += idsArray[i];
							}
						}
					}

					var strLen = idsString.length;
					var lastChar = idsString.charAt(strLen - 1);
					if (lastChar == ',') {
						idsString = idsString.slice(0, strLen - 1);
					}

				}

				jQuery(this).siblings(".hiddenText").val(idsString);

			});
		},
		
		/**
		 * Shows the already saved data
		 * 
		 * @param ulId
		 *            the ID of the ul element that contains the data
		 * @param inputIds
		 *            the IDs of the inputs to insert the data sepearated by commas
		 * @param spanClasses
		 *            the classes of the spans that show the data separated by commas
		 * @param hiddenIds
		 *            the IDs of the hidden inputs that contain all the data separated
		 *            by commas
		 * @param labels
		 *            the IDs of the labels to output the data
		 * @return
		 */
		showSavedImgData : function(ulId, inputIds, spanClasses, hiddenIds, labels) {

			var count = inputIds.length;
			var data = new Array();
			for ( var i = 0; i < count; i++) {
				data[i] = jQuery(hiddenIds[i]).attr('value').split(separator);
			}

			var entryCount = data[0].length;
			// goes through all the saved entries and outputs the saved data
			for ( var j = 0; j < entryCount - 1; j++) {
				var html = '<li>';
				for ( var i = 0; i < count; i++) {
					var none=data[i][j]==''?'<i>---</i>':''; 
					html += '<b>' + labels[i] + ': </b><span class="' + spanClasses[i]
							+ '">' + data[i][j] + '</span>'+none+'<br/>';
				}
				html += '<div class="deleteButton"></li>';
				jQuery(ulId).append(html);
			}

		},
		

		/**
		 * Initializes the functionality for adding/removing fader images
		 * 
		 * @return
		 */
		setThumbFunc:function() {
			var ulId = '#sortableThum';
			var inputIds = [ '#urlThumImg', '#linkThumImg', '#descThumImg' ];
			var spanClasses = [ 'thumUrl', 'thumLink', 'thumDesc' ];
			var hiddenIds = [ '#_thum_image_names', '#_thum_image_links', '#_thum_image_desc' ];
			var labels = [ 'Image URL', 'Image Link', 'Image Description' ];
			var addButton = '#addThumImageButton';

			pexetoOptions.setCommonAddFunc(ulId, inputIds, spanClasses, hiddenIds, labels, addButton);
		},
		
		/**
		 * Sets the functionality for adding/removing sidebars
		 * @return
		 */
		setSidebarFunc:function(){
			
			var ulId = '#sortableSidebar';
			var inputIds = [ '#sidebarName'];
			var spanClasses = [ 'sideName'];
			var hiddenIds = [ '#_sidebar_names' ];
			var labels = [ 'Sidebar Name'];
			var addButton = '#addSidebarButton';

			pexetoOptions.setCommonAddFunc(ulId, inputIds, spanClasses, hiddenIds, labels, addButton);
		},
		
		/**
		 * Initializes the functionality for adding/removing fader images
		 * 
		 * @return
		 */
		setThumbFuncBig:function() {
			var ulId = '#sortableThumBig';
			var inputIds = [ '#urlThumImgBig', '#linkThumImgBig', '#descThumImgBig' ];
			var spanClasses = [ 'thumUrlBig', 'thumLinkBig', 'thumDescBig' ];
			var hiddenIds = [ '#_thum_image_names_big', '#_thum_image_links_big', '#_thum_image_desc_big' ];
			var labels = [ 'Image URL', 'Image Link', 'Image Description' ];
			var addButton = '#addThumImageButtonBig';

			pexetoOptions.setCommonAddFunc(ulId, inputIds, spanClasses, hiddenIds, labels, addButton);
		},
		
		/**
		 * Initializes the functionality for adding/removing fader images
		 * 
		 * @return
		 */
		setNivoFunc:function() {
			var ulId = '#sortableNivo';
			var inputIds = [ '#urlNivoImg', '#linkNivoImg', '#descNivoImg' ];
			var spanClasses = [ 'nivoUrl', 'nivoLink', 'nivoDesc' ];
			var hiddenIds = [ '#_nivo_image_names', '#_nivo_image_links', '#_nivo_image_desc' ];
			var labels = [ 'Image URL', 'Image Link', 'Image Description' ];
			var addButton = '#addNivoImageButton';

			pexetoOptions.setCommonAddFunc(ulId, inputIds, spanClasses, hiddenIds, labels, addButton);
		},
		
		/**
		 * Initializes the functionality for adding/removing fader images
		 * 
		 * @return
		 */
		setSocialFunc:function() {
			var ulId = '#sortableSocial';
			var inputIds = [ '#urlSocialImg', '#linkSocialImg' ];
			var spanClasses = [ 'socialUrl', 'socialLink' ];
			var hiddenIds = [ '#_social_icon_names', '#_social_icon_links' ];
			var labels = [ 'Icon URL', 'Icon Link' ];
			var addButton = '#addSocialImageButton';

			pexetoOptions.setCommonAddFunc(ulId, inputIds, spanClasses, hiddenIds, labels, addButton);
		},
		
		setReflectionFunc:function(){
			var ulId = '#sortableReflection';
			var inputIds = [ '#urlReflectionImg'];
			var spanClasses = [ 'reflectionUrl'];
			var hiddenIds = [ '#_reflection_image_names'];
			var labels = [ 'Image URL'];
			var addButton = '#addReflectionImageButton';

			pexetoOptions.setCommonAddFunc(ulId, inputIds, spanClasses, hiddenIds, labels, addButton);
		},
		
		/**
		 * Calls the main functions that execute the functionality.
		 * 
		 * @param ulId
		 *            the ID of the ul element that contains the data
		 * @param inputIds
		 *            the IDs of the inputs to insert the data sepearated by commas
		 * @param spanClasses
		 *            the classes of the spans that show the data separated by commas
		 * @param hiddenIds
		 *            the IDs of the hidden inputs that contain all the data separated
		 *            by commas
		 * @param labels
		 *            the IDs of the labels to output the data
		 * @param addButton
		 *            the button whose click event will be handled
		 * 
		 * @return
		 */
		setCommonAddFunc:function(ulId, inputIds, spanClasses, hiddenIds, labels,
				addButton) {

			
			pexetoOptions.showSavedImgData(ulId, inputIds, spanClasses, hiddenIds, labels);
			jQuery(addButton).click(function(event) {
				event.preventDefault();
				pexetoOptions.addItem(ulId, inputIds, spanClasses, hiddenIds, labels);
			});

			jQuery(ulId).bind('sortstop', function(event, ui) {
				pexetoOptions.setSliderImgChanges(ulId, inputIds, spanClasses, hiddenIds, labels);
			});

			pexetoOptions.setSortableHandlers(ulId);
			pexetoOptions.setDeleteButtonHandlers(ulId, inputIds, spanClasses, hiddenIds, labels);
		},
		
		/**
		 * 
		 * Adds a new item to the list.
		 * 
		 * @param ulId
		 *            the ID of the ul element that contains the data
		 * @param inputIds
		 *            the IDs of the inputs to insert the data sepearated by commas
		 * @param spanClasses
		 *            the classes of the spans that show the data separated by commas
		 * @param hiddenIds
		 *            the IDs of the hidden inputs that contain all the data separated
		 *            by commas
		 * @param labels
		 *            the IDs of the labels to output the data
		 * @return
		 */
		addItem:function(ulId, inputIds, spanClasses, hiddenIds, labels) {

			var length = inputIds.length;

			var html = '<li>';
			for ( var i = 0; i < length; i++) {
				html += '<b>' + labels[i] + ': </b><span class="' + spanClasses[i]
						+ '">' + jQuery(inputIds[i]).attr("value") + '</span><br/>';
			}
			html += '<div class="deleteButton"></li>';

			jQuery(ulId).append(html);
			pexetoOptions.setSliderImgChanges(ulId, inputIds, spanClasses, hiddenIds, labels);

		},
		
		/**
		 * Refreshes the output data after an item has been added/removed.
		 * 
		 * @param ulId
		 *            the ID of the ul element that contains the data
		 * @param inputIds
		 *            the IDs of the inputs to insert the data sepearated by commas
		 * @param spanClasses
		 *            the classes of the spans that show the data separated by commas
		 * @param hiddenIds
		 *            the IDs of the hidden inputs that contain all the data separated
		 *            by commas
		 * @param labels
		 *            the IDs of the labels to output the data
		 * @return
		 */
		setSliderImgChanges:function(ulId, inputIds, spanClasses, hiddenIds, labels) {

			var count = inputIds.length;
			var values = new Array();

			for (i = 0; i < count; i++) {
				values[i] = '';
			}

			jQuery(ulId + ' li').each(
					function() {
						for (i = 0; i < count; i++) {
							values[i] += jQuery(this).find('span.' + spanClasses[i]).text()
									+ separator;
						}
					});

			for (i = 0; i < count; i++) {
				jQuery(hiddenIds[i]).attr("value", values[i]);
			}

			pexetoOptions.setSortableHandlers(ulId);
			pexetoOptions.setDeleteButtonHandlers(ulId, inputIds, spanClasses, hiddenIds, labels);
		},
		
		/**
		 * Sets the sortable handler for the lists.
		 * 
		 * @param ulId
		 *            the ID of the ul whose li children will be sorted
		 * @return
		 */
		setSortableHandlers:function(ulId) {
			jQuery(ulId + ' li').hover(function() {
				jQuery(this).css( {
					cursor : "move",
					backgroundColor : "#fff"
				});
			}, function() {
				jQuery(this).css( {
					backgroundColor : "#f2f2f2"
				});
			});

		},
		
		/**
		 * 
		 * Sets the delete buttons click event handlers.
		 * 
		 * @param ulId
		 *            the ID of the ul element that contains the data
		 * @param inputIds
		 *            the IDs of the inputs to insert the data sepearated by commas
		 * @param spanClasses
		 *            the classes of the spans that show the data separated by commas
		 * @param hiddenIds
		 *            the IDs of the hidden inputs that contain all the data separated
		 *            by commas
		 * @param labels
		 *            the IDs of the labels to output the data
		 * @return
		 */
		setDeleteButtonHandlers:function(ulId, inputIds, spanClasses, hiddenIds, labels) {
			jQuery('.deleteButton').mouseover(function() {
				jQuery(this).css( {
					cursor : "pointer"
				});
			});

			jQuery('.deleteButton').click(function() {
				jQuery(this).parent("li").remove();
				pexetoOptions.setSliderImgChanges(ulId, inputIds, spanClasses, hiddenIds, labels);
			});
		}
}





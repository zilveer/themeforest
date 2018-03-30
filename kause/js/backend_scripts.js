"use strict";

/*************************************************************
BACKEND SCRIPTS INDEX

INIT SCRIPTS
COLOR WIDGETS
RESET SETTINGS
HELP TOGGLE
UPLOAD SCRIPT
UPLOAD MEDIA BUTTON
COLORPICKER
SOCIAL LINKS CONTROL
FONT AWESOME SELECT PREVIEW ICON
SKIN PICKER
BACKGROUND PATTERN PICKER
EXPORT/IMPORT SETTINGS
GOOGLE WEBFONTS
OPTIONS TABS
HOMEPAGE OPTIONS SWITCHER
CUSTOM WIDGET AREAS (CWA)
DYNAMIC OPTION

*************************************************************/


/*************************************************************
INIT SCRIPTS
*************************************************************/

	jQuery(document).ready(function($) {

		// FitVid.js
		if ($('.tutorial_videos_container').size() > 0) {
			$("body").fitVids();
		}

	});



/*************************************************************
COLOR WIDGETS
*************************************************************/

	jQuery(document).ready(function($) {
		if ($('.widget').size() > 0) {

			//color theme widgets
			$('.widget').each(function(index, e) {
				var $this = $(this);
				if ($this.attr('id')) {
					if ($this.attr('id').indexOf('kause_') != -1) $this.find('.widget-title').css({
						'backgroundColor': '#4ec6e9',
						'color': 'black',
						'text-shadow': 'none'
					});
				}

			});

			//color sidebar widget areas
			$('#canon_blog_sidebar_widget_area, #canon_contact_sidebar_widget_area, #canon_page_sidebar_widget_area, #canon_404_sidebar_widget_area, #canon_search_sidebar_widget_area').closest('.widgets-holder-wrap').children('.sidebar-name').children('h3').css({
				'backgroundColor': '#4ec6e9',
				'color': 'black',
				'text-shadow': 'none'
			});

			//color footer widget areas
			$('#canon_footer_widget_area_1, #canon_footer_widget_area_2, #canon_footer_widget_area_3, #canon_footer_widget_area_4, #canon_footer_widget_area_5').closest('.widgets-holder-wrap').children('.sidebar-name').children('h3').css({
				'backgroundColor': '#e1f5fb',
				'color': 'black',
				'text-shadow': 'none'
			});

			//color custom widget areas
			var $allWidgetAreas = $('#widgets-right').find('.widgets-sortables');
			$allWidgetAreas.each(function (index, element) {
				var $this = $(this);
				var thisID = $this.attr('id');
				if (thisID.indexOf('canon_cwa_') != -1) {
					$this.closest('.widgets-holder-wrap').children('.sidebar-name').children('h3').css({
						'backgroundColor': '#ff6666',
						'color': 'black',
						'text-shadow': 'none'
					});


				}
			});

			//color woocommerce widget area
			$('#canon_woocommerce_widget_area').closest('.widgets-holder-wrap').children('.sidebar-name').children('h3').css({
				'backgroundColor': '#ad74a2',
				'color': 'black',
				'text-shadow': 'none'
			});

			//color woocommerce widgets
			$('.widget').each(function(index, e) {
				var $this = $(this);
				var widgetName = $this.find('.widget-title h4').text();
				if ($this.attr('id')) {
					if (widgetName.indexOf('WooCommerce') != -1) $this.find('.widget-title').css({
						'backgroundColor': '#ad74a2',
						'color': 'black',
						'text-shadow': 'none'
					});
				}

			});

		}
	});



/*************************************************************
RESET SETTINGS
*************************************************************/

	jQuery(document).ready(function($) {
		if ($('#reset_all_button').size() > 0) {

			$('#reset_all_button').on('click', function() {
				var conf = confirm("WARNING: You are about to reset all theme settings!\n\nNB: This will reset all theme settings including advanced settings.");
				if (conf === true) {
					$('#reset_all').val('RESET');
				}
			});

			$('#reset_basic_button').on('click', function() {
				var conf = confirm("WARNING: You are about to reset basic theme settings!\n\nThese include :\n\n- General Settings \n- Posts & Pages Settings \n- Appearance Settings\n\nAdvanced settings will not be reset.");
				if (conf === true) {
					$('#reset_basic').val('RESET');
				}
			});

		}
	});


/*****************************************
HELP TOGGLE
*****************************************/

	jQuery(document).ready(function($) {
		if ($('h3 img').size() > 0) {

			//main help toggle
			$('h3 img').on('click', function(index, e) {
				var $this = $(this);
				var $helpDiv = $this.closest('h3').next('div');
				$helpDiv.slideToggle('fast');
			});

		}
	});


/*****************************************
UPLOAD SCRIPT
*****************************************/

	//if you make an input type='button' with the class='upload_button' then this script will activate it and put the image URL in the previous input box
	jQuery(document).ready(function($) {
		if ($('.upload_button').size() > 0) {

			$(document).on('click', '.upload_button', function () {
				var $this = $(this);
				var $urlField = $this.prev('input');
				var buttonVal = $this.val().toUpperCase();
				var buttonId = $this.attr('id');
				var referer = "";

				//set referer for each button
				//also set in functions.php in the media upload customize section
				switch (buttonId) {
					case "upload_logo_button":
						referer = "boost_logo";
						break;
					case "upload_footer_logo_button":
						referer = "boost_logo";
						break;
					case "upload_favicon_button":
						referer = "boost_favicon";
						break;
					case "upload_bg_button":
						referer = "boost_bg";
						break;
					default:
						referer = "boost_default";
						break;
				}

		        tb_show(buttonVal, 'media-upload.php?referer=' + referer + '&type=image&TB_iframe=true&post_id=0', false);
		        
				window.send_to_editor = function(html) {
					if (typeof $urlField != "undefined") {
					    var image_url = $('img',html).attr('src');  
					   	$urlField.val(image_url); 
					    tb_remove();  
					}
				};
			});

		}
	});

/*****************************************
UPLOAD MEDIA BUTTON
*****************************************/

	//if you make an input type='button' with the class='upload_media_button' then this script will activate it and put the image URL in the previous input box
	jQuery(document).ready(function($) {
		if ($('.upload_media_button').size() > 0) {

			$(document).on('click', '.upload_media_button', function () {
				var $this = $(this);
				var $urlField = $this.prev('input');
				var buttonVal = $this.val().toUpperCase();
				var buttonId = $this.attr('id');
				var referer = "";

				//set referer for each button
				//also set in functions.php in the media upload customize section
				switch (buttonId) {
					case "upload_logo_button":
						referer = "boost_logo";
						break;
					case "upload_footer_logo_button":
						referer = "boost_logo";
						break;
					case "upload_favicon_button":
						referer = "boost_favicon";
						break;
					case "upload_bg_button":
						referer = "boost_bg";
						break;
					case "upload_media_button":
						referer = "boost_media";
						break;
					default:
						referer = "boost_default";
						break;
				}

		        tb_show(buttonVal, 'media-upload.php?referer=' + referer + '&type=image&TB_iframe=true&post_id=0', false);
		        
				window.send_to_editor = function(html) {
					if (typeof $urlField != "undefined") {
					    var file_url = $(html)[0].href;
					   	$urlField.val(file_url); 
					    tb_remove();  
					}
				};
			});

		}
	});


/*****************************************
COLORPICKER
*****************************************/

	jQuery(document).ready(function($) {

		if ($('.colorSelectorBox').size() > 0) {

			$('.colorSelectorBox').each(function (index, e) {
				var $this = $(this);
				var $relatedInput = $this.closest('td').prev('td').children('input');
				var controllerID = $this.attr('id');
				var relatedInputID = $relatedInput.attr('id');
				$this.ColorPicker({
					color: $relatedInput.val(),
					onShow: function (colpkr) {
						$(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						$(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						$('#' + controllerID + ' div').css('backgroundColor', '#' + hex);
						$('#' + relatedInputID).val("#" + hex);
						// console.log(rgb.b);
					}
				});
					
			});

		}	
	});

/*****************************************
SOCIAL LINKS CONTROL
*****************************************/

	jQuery(document).ready(function($) {
		if ($('.social_links').size() > 0) {

			$('.button_add_social_link').on('click', function(event) {
				var $this = $(this);
				var $socialLinksRows = $this.closest('.social_links_control').prev('.social_links').find('.social_links_row');
				var numLinks = $socialLinksRows.size();

				$socialLinksRows.last().clone().appendTo($this.closest('.social_links_control').prev('.social_links'));

				var $newRow = $this.closest('.social_links_control').prev('.social_links').find('.social_links_row').last();
				var newTitle = "Social link "+(numLinks+1);
				var newNameIcon = "canon_options[social_links]["+numLinks+"][0]";
				var newNameLink = "canon_options[social_links]["+numLinks+"][1]";

				//update indexes
				$newRow.find('th').html(newTitle);
				$newRow.find('.social_links_icon').attr('name', newNameIcon);
				$newRow.find('.social_links_link').attr('name', newNameLink);
				$newRow.find('.social_links_link').attr('value', '');

			});

			$('.button_remove_social_link').on('click', function(event) {
				var $this = $(this);
				var $socialLinksRows =  $this.closest('.social_links_control').prev('.social_links').find('.social_links_row');
				var numLinks = $socialLinksRows.size();

				if (numLinks > 1) {
					$socialLinksRows.last().remove();	
				}
			});

		}


	});



/*****************************************
FONT AWESOME SELECT PREVIEW ICON
*****************************************/

	jQuery(document).ready(function($) {
		if ($('.fa_select').size() > 0) {

			$('body').on('change', '.fa_select', function(event) {
				var $this = $(this);
				var thisValue = $this.val();
				var $iconPreview = $this.next('i');

				$iconPreview.attr('class', "fa " + thisValue);
			});

		}

	});




/*************************************************************
SKIN PICKER
*************************************************************/

	jQuery(document).ready(function($) {
		if ($('#skins img').size() > 0) {

			$('#skins img').on('click', function (event) {
				var $this = $(this);

				var $dataObject = $this.data();

				$.each($dataObject, function (key, value) {
					$('#'+key).val(value);
					$('#colorSelector_'+key).find('div').css('background-color',value);
				});
			});

		}

	});

/*************************************************************
BACKGROUND PATTERN PICKER
*************************************************************/

	jQuery(document).ready(function($) {
		if ($('.bg_pattern_picker').size() > 0) {

			$('.bg_pattern_picker img').on('click', function (event) {
				var $this = $(this);

				var imgName = $this.attr('data-img_file');
				var imgPath = extData.templateURI + "/img/patterns/";
				var $urlInput = $this.closest('.form-table').find('#bg_img_url');

				$urlInput.val(imgPath + imgName);

				//set repeat and attachment for pattern background
				var $selectRepeat = $this.closest('.form-table').find('#bg_repeat');
				var $selectAttachment = $this.closest('.form-table').find('#bg_attachment');
				$selectRepeat.val('repeat');
				$selectAttachment.val('fixed');
			});
		}

	});


/*************************************************************
EXPORT/IMPORT SETTINGS
*************************************************************/


	jQuery(document).ready(function($) {

		if ($('#canon_options_data').size() > 0) {

			//AUTOGENERATE DATA BUTTON
			$('#button_generate_data').on('click',function(e) {
				var $this = $(this);
				var optionsData = $this.attr('data-options_data');
				$this.closest('.form-table').find('#canon_options_data').html("").html(optionsData);
			});

			//SELECT ALL ON FOCUS
			$('#canon_options_data').on('focus', function (e) {
				var $this = $(this);
				$this.select();

				// Work around Chrome's little problem
				$this.mouseup(function() {
					// Prevent further mouseup intervention
					$this.unbind("mouseup");
					return false;
				});

			});


			//IMPORT DATA BUTTON
			$('#button_import_data').on('click', function(e) {
				var $this = $(this);

				var conf = confirm("WARNING: You are about to import new settings. \nOld settings may be overwritten!");
				if (conf === true) {
					$('#import_data').val('IMPORT');
				}
			});

		}

	});


/*****************************************
GOOGLE WEBFONTS
*****************************************/

	jQuery(document).ready(function($) {

		if (typeof extDataFonts != 'undefined') {

			// console.log(extDataFonts.fonts.items[0].family);

			$('.canon_webfonts_controller').each(function(index, e) {
				//GET VARS        
				var $thisController = $(this);
				var $selectFamily = $thisController.find('.canon_font_family');
				var $selectVariant = $thisController.find('.canon_font_variant');
				var $selectSubset = $thisController.find('.canon_font_subset');
				var selectedFamily = $selectFamily.attr('data-selected');
				var selectedVariant = $selectVariant.attr('data-selected');
				var selectedSubset = $selectSubset.attr('data-selected');
				var selectedKey = 0;

				/*****************************************
				BUILD SELECTS
				*****************************************/
				//BUILD FAMILY SELECT
				for (var i = 0; i < extDataFonts.fonts.items.length; i++) {
					if (extDataFonts.fonts.items[i].family == selectedFamily) {
					var optionFamilyHTML = "<option value='"+ extDataFonts.fonts.items[i].family +"' selected='selected'>"+ extDataFonts.fonts.items[i].family +"</option>";
					selectedKey = i;
					} else {
					var optionFamilyHTML = "<option value='"+ extDataFonts.fonts.items[i].family +"'>"+ extDataFonts.fonts.items[i].family +"</option>";
					}
					$selectFamily.append(optionFamilyHTML);
				}

				//clear out select
				$selectVariant.empty();
				$selectSubset.empty();

				//build variants select
				for (var i = 0; i < extDataFonts.fonts.items[selectedKey].variants.length; i++) {
					if (extDataFonts.fonts.items[selectedKey].variants[i] == selectedVariant) {
					var optionVariantHTML = "<option value='"+ extDataFonts.fonts.items[selectedKey].variants[i] +"' selected='selected'>"+ extDataFonts.fonts.items[selectedKey].variants[i] +"</option>";
					} else {
					var optionVariantHTML = "<option value='"+ extDataFonts.fonts.items[selectedKey].variants[i] +"'>"+ extDataFonts.fonts.items[selectedKey].variants[i] +"</option>";
					}
					$selectVariant.append(optionVariantHTML);
				}

				//build subsets select
				for (var i = 0; i < extDataFonts.fonts.items[selectedKey].subsets.length; i++) {
					if (extDataFonts.fonts.items[selectedKey].subsets[i] == selectedSubset) {
					var optionSubsetHTML = "<option value='"+ extDataFonts.fonts.items[selectedKey].subsets[i] +"' selected='selected'>"+ extDataFonts.fonts.items[selectedKey].subsets[i] +"</option>";
					} else {
					var optionSubsetHTML = "<option value='"+ extDataFonts.fonts.items[selectedKey].subsets[i] +"'>"+ extDataFonts.fonts.items[selectedKey].subsets[i] +"</option>";
					}
					$selectSubset.append(optionSubsetHTML);
				}


				/*****************************************
				ON CHANGE
				*****************************************/
				//ON FAMILY CHANGE EVENT
				$selectFamily.on('change', function () {
				    var $thisFamilySelect = $(this);
				    var $relatedVariantSelect = $thisFamilySelect.closest('tr').find('.canon_font_variant');
				    var $relatedSubsetSelect = $thisFamilySelect.closest('tr').find('.canon_font_subset');
				    var selectedOption = $thisFamilySelect.val();
				    var currentKey = 0;
				    //first get the array key
				    for (var i = 0; i < extDataFonts.fonts.items.length; i++) {
						if (extDataFonts.fonts.items[i].family == selectedOption) currentKey = i;
				    }

				    //clear out select
				    $relatedVariantSelect.empty();
				    $relatedSubsetSelect.empty();

				    //build variants select
				    for (var i = 0; i < extDataFonts.fonts.items[currentKey].variants.length; i++) {
						if (extDataFonts.fonts.items[currentKey].variants[i] == selectedVariant) {
						var optionVariantHTML = "<option value='"+ extDataFonts.fonts.items[currentKey].variants[i] +"' selected='selected'>"+ extDataFonts.fonts.items[currentKey].variants[i] +"</option>";
						} else {
						var optionVariantHTML = "<option value='"+ extDataFonts.fonts.items[currentKey].variants[i] +"'>"+ extDataFonts.fonts.items[currentKey].variants[i] +"</option>";
						}
						$relatedVariantSelect.append(optionVariantHTML);
				    }

				    //build subsets select
				    for (var i = 0; i < extDataFonts.fonts.items[currentKey].subsets.length; i++) {
						if (extDataFonts.fonts.items[currentKey].subsets[i] == selectedSubset) {
						var optionSubsetHTML = "<option value='"+ extDataFonts.fonts.items[currentKey].subsets[i] +"' selected='selected'>"+ extDataFonts.fonts.items[currentKey].subsets[i] +"</option>";
						} else {
						var optionSubsetHTML = "<option value='"+ extDataFonts.fonts.items[currentKey].subsets[i] +"'>"+ extDataFonts.fonts.items[currentKey].subsets[i] +"</option>";
						}
						$relatedSubsetSelect.append(optionSubsetHTML);
				    }
				});
			}); // foreach webfonts controller
		} // if extDataFonts defined
	});


/*************************************************************
OPTIONS TABS
*************************************************************/

	jQuery(document).ready(function($) {

		if ($('.settings_tab').size() > 0) {

			//init
			var currentTab = $('#show_tab').val();
			$('.tab_section').hide();
			$('.tab_section.'+currentTab).show();

			$('.settings_tab').removeClass('current_tab');
			$('.settings_tab.'+currentTab).addClass('current_tab');

			//onClick
			$('.settings_tab').on('click', function(event) {
				var $this=$(this);

				var selectedTab = $this.attr('data-tab');

				//update hidden input
				$('#show_tab').val(selectedTab);

				//update tabs
				$('.settings_tab').removeClass('current_tab');
				$('.settings_tab.'+selectedTab).addClass('current_tab');

				//update sections
				$('.tab_section').hide();
				$('.tab_section.'+selectedTab).show();

			});
		}

	});



/*************************************************************
HOMEPAGE OPTIONS SWITCHER
*************************************************************/


	jQuery(document).ready(function($) {
		if ($('.options_wrapper.canon_options_homepage').size() > 0) {

			var useThemeHomepage = $('.options_wrapper.canon_options_homepage').attr('data-use_theme_homepage');
			var $defaultBlogOptions = $('.options_container_default_blog');
			var $themeHomepageOptions = $('.options_container_theme_homepage');

			if (useThemeHomepage == "true")	{
				$defaultBlogOptions.hide();		
			} else {
				$themeHomepageOptions.hide();	
			}


		}	


	});

/*************************************************************
CUSTOM WIDGET AREAS (CWA)
*************************************************************/

	jQuery(document).ready(function($) {

		if ($('.cwa_sortable').size() > 0) {

			//SORTABLE
			$('.cwa_sortable').sortable ({
				placeholder: 'cwa_sortable_placeholder',
				revert: true,
				update: cwaUpdateIndexes,
			});


			// ADD LI
			$('.button_add_cwa').on('click', function(e) {
				var $this = $(this);
				var $templateLI = $('#cwa_template li').first();
				// set empty value
				$templateLI.find('.cwa_option').val('');
				var $sortableUL = $('#cwa_list');
				$templateLI.clone().appendTo($sortableUL);

				//update indexes
				cwaUpdateIndexes();
			});

			// REMOVE LI
			$('#cwa_list').on('click', '.cwa_del',function(e) {
				e.preventDefault()
				var $this = $(this);
				$this.closest('li').remove();
				
				// //update indexes
				cwaUpdateIndexes();
			});

		}		

		function cwaUpdateIndexes (event, ui) {

			var liSelector = "#cwa_list li";
			var optionsClass = ".cwa_option";
			var splitPos = 2; // when splitting the name attr select which fragment to update

			//DYNAMIC TO STATIC
			var liIndex = 0;
			var optionNameArray = new Array();
			var $list_lis = $(liSelector);
			$list_lis.each(function (index, element) {
				var $this = $(this);
				var liIndex = index;
				//console.log(liIndex);
				var $options = $this.find(optionsClass);
				$options.each(function (index, element) {
					var $thisOption = $(this);
					//update option name (make sure it only updates numbers in 2nd bracket)
					var optionName = $thisOption.attr('name');
					var optionNameArray = optionName.split('[');
					optionNameArray[splitPos] = liIndex+"]";

					optionName = optionNameArray.join('[');
					// console.log(optionName);
					$thisOption.attr('name',optionName);
					//console.log($thisOption.attr('name'));
				});
			}); 

		}

	});

/*****************************************
DYNAMIC OPTION

HOW TO USE: Make an options container withs class .dynamic_option. 
Give it data-listen_to (selector of parent to listen to) give it data-listen_for (value of parent that activates child).
Remember that parent must be unique.
data-listen_for can contain multiple parameters to listen for e.g. data-listen_for="feat_compact_sidebar feat_full_sidebar". Separate each listen for param with a single space. This is handy for selects where multiple selections should activate an otion.
Notice: the slideDown/Up animation does not work on tables and some uls - so on these elements you will just see a hide/display type action.

*****************************************/

	jQuery(document).ready(function($) {
		if ($('.dynamic_option').size() > 0) {

			var $dynamicOptions = $('.dynamic_option');

			$dynamicOptions.each(function(index, el) {
				var $this_child = $(this);
				var listenToSelector = $this_child.attr('data-listen_to');
				var $listenTo = $(listenToSelector);
				var listenFor = $this_child.attr('data-listen_for');

				if ($listenTo.attr('type') == "checkbox") {
					// init
					if ( (listenFor == "checked" && $listenTo.prop('checked')) || (listenFor == "unchecked" && ($listenTo.prop('checked') === false)) ) {
						$this_child.slideDown();	
					}

					// on change
					$('body').on('change', listenToSelector, function(event) {
						var $this_parent = $(this);
						if ( (listenFor == "checked" && $this_parent.prop('checked')) || (listenFor == "unchecked" && ($this_parent.prop('checked') === false)) ) {
							$this_child.slideDown();	
						} else {
							$this_child.slideUp();	
						}
					});

				} else {

					var listenForArray = listenFor.split(" ");

					// init
					$.each(listenForArray, function (key, value) {

						if ($listenTo.val() == value) {
							$this_child.slideDown();	
						}
							
					});

					// on change
					$('body').on('change', listenToSelector, function(event) {
						var $this_parent = $(this);
						var match = false;

						$.each(listenForArray, function (key, value) {

							if ($listenTo.val() == value) {
								match = true;	
							}
								
						});

						if (match) {
							$this_child.slideDown();	
						} else {
							$this_child.slideUp();	
						}
					});
						
				}

			});

		}

	});


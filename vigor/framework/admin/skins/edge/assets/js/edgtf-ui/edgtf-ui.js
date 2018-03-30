(function($){
	$(document).ready(function() {
		//plugins init goes here
		edgtfInitSelectChange();
		edgtfInitSwitch();
		edgtfInitTooltips();
		edgtfInitColorpicker();
		edgtfInitRangeSlider();
		edgtfInitMediaUploader();
		edgtfInitGalleryUploader();
		if ($('.edgtf-page-form').length > 0) {
			edgtfInitAjaxForm();
			edgtfAnchorSelectOnLoad();
			edgtfScrollToAnchorSelect();
			initTopAnchorHolderSize();
			edgtCheckVisibilityOfAnchorButtons();
			edgtfCheckVisibilityOfAnchorOptions();
			edgtCheckAnchorsOnDependencyChange();
			edgtfCheckOptionAnchorsOnDependencyChange();
			edgtChangedInput();
			edgtFixHeaderAndTitle();
			totop_button();
			backButtonShowHide();
			backToTop();
            edgtfInitSelectPicker();
		}
		edgtfInitPortfolioImagesVideosBox();
		edgtInitPortfolioMediaAcc();
		edgtfInitPortfolioItemsBox();
		edgtInitPortfolioItemAcc();
		edgtfInitDatePicker();
		edgtfshowHideBlogVideoType(); 
		$("select#video_format_choose").change(function() {  
			edgtfshowHideBlogVideoType(); 
		});
		edgtRemoveVCDeprecatedClass();

    });

	function edgtRemoveVCDeprecatedClass() {
		$('.wpb-layout-element-button').each( function() {
			$(this).removeClass('vc_element-deprecated');
		})
	}

	function edgtFixHeaderAndTitle () {
		var pageHeader 				= $('.edgtf-page-header');
		var pageHeaderHeight		= pageHeader.height();
		var adminBarHeight			= $('#wpadminbar').height();
		var pageHeaderTopPosition 	= pageHeader.offset().top - parseInt(adminBarHeight);
		var pageTitle				= $('.edgtf-page-title');
		var pageTitleTopPosition	= pageHeaderHeight + adminBarHeight - parseInt(pageTitle.css('marginTop'));
		var tabsNavWrapper			= $('.edgtf-tabs-navigation-wrapper');
		var tabsNavWrapperTop		= pageHeaderHeight;
		var tabsContentWrapper	    = $('.edgtf-tab-content');
		var tabsContentWrapperTop	= pageHeaderHeight + pageTitle.outerHeight();

		$(window).on('scroll load', function() {
			if($(window).scrollTop() >= pageHeaderTopPosition) {
				pageHeader.addClass('edgt-header-fixed').css('top', parseInt(adminBarHeight));
				pageTitle.addClass('edgt-page-title-fixed').css('top', pageTitleTopPosition);
				tabsNavWrapper.css('marginTop', tabsNavWrapperTop);
				tabsContentWrapper.css('marginTop', tabsContentWrapperTop);
			} else {
				pageHeader.removeClass('edgt-header-fixed').css('top', 0);
				pageTitle.removeClass('edgt-page-title-fixed').css('top', 0);
				tabsNavWrapper.css('marginTop', 0);
				tabsContentWrapper.css('marginTop', 0);
			}
		});
	}

	function initTopAnchorHolderSize() {
		function initTopSize() {
			var optionsPageHolder = $('.edgtf-options-page');
			var anchorAndSaveHolder = $('.edgtf-top-section-holder');
			var pageTitle = $('.edgtf-page-title');
			var tabsContentWrapper = $('.edgtf-tabs-content');

			anchorAndSaveHolder.css('width', optionsPageHolder.width() - parseInt(anchorAndSaveHolder.css('margin-left')));
			pageTitle.css('width', tabsContentWrapper.outerWidth());
		}

		initTopSize();

		$(window).on('resize', function() {
			initTopSize();
		});
	}

	function edgtfScrollToAnchorSelect() {
		var selectAnchor = $('#edgtf-select-anchor');
		selectAnchor.on('change', function() {
			var selectAnchor = $('option:selected', selectAnchor);
			if(typeof selectAnchor.data('anchor') !== 'undefined') {
				edgtfScrollToPanel(selectAnchor.data('anchor'));
			}
		});
	}

	function edgtfAnchorSelectOnLoad() {
		var currentPanel = window.location.hash;
		if(currentPanel) {
			var selectAnchor = $('#edgtf-select-anchor');
			var currentOption = selectAnchor.find('option[data-anchor="'+currentPanel+'"]').first();

			if(currentOption) {
				currentOption.attr('selected', 'selected');
			}
		}

	}

	function edgtfScrollToPanel(panel) {
		var pageHeader 				= $('.edgtf-page-header');
		var pageHeaderHeight		= pageHeader.height();
		var adminBarHeight			= $('#wpadminbar').height();
		var pageTitle				= $('.edgtf-page-title');
		var pageTitleHeight			= pageTitle.outerHeight();

		var panelTopPosition = $(panel).offset().top - adminBarHeight - pageHeaderHeight - pageTitleHeight;

		$('html, body').animate({
			scrollTop: panelTopPosition
		}, 1000);

		return false;
	}

	function totop_button(a) {
		"use strict";

		var b = $("#back_to_top");
		b.removeClass("off on");
		if (a === "on") { b.addClass("on"); } else { b.addClass("off"); }
	}

	function backButtonShowHide(){
		"use strict";

		$(window).scroll(function () {
			var b = $(this).scrollTop();
			var c = $(this).height();
			var d;
			if (b > 0) { d = b + c / 2; } else { d = 1; }
			if (d < 1e3) { totop_button("off"); } else { totop_button("on"); }
		});
	}

	function backToTop(){
		"use strict";

		$(document).on('click','#back_to_top',function(){
			$('html, body').animate({
				scrollTop: $('html').offset().top}, 1000);
			return false;
		});
	}


	function edgtChangedInput () {
		$('.edgtf-tabs-content').on('change keyup keydown', 'input:not([type="submit"]), textarea, select', function (e) {
			$('.edgtf-input-change').addClass('yes');
		});
		$('.field.switch label:not(.selected)').click( function() {
			$('.edgtf-input-change').addClass('yes');
		});
		$(window).on('beforeunload', function () {
			if ($('.edgtf-input-change.yes').length) {
				return 'You haven\'t saved your changes.';
			}
		});
		$('#anchornav input').click(function() {
			if ($('.edgtf-input-change.yes').length) {
				$('.edgtf-input-change.yes').removeClass('yes');
			}
			$('.edgtf-changes-saved').addClass('yes');
			setTimeout(function(){$('.edgtf-changes-saved').removeClass('yes');}, 3000);
		});
	}

	function edgtCheckVisibilityOfAnchorButtons () {

		$('.edgtf-page-form > div:hidden').each( function() {
			var $panelID =  $(this).attr('id');
			$('#anchornav a').each ( function() {
				if ($(this).attr('href') == '#'+$panelID) {
					$(this).parent().hide();//hide <li>s
				}
			});
		})

	}

	function edgtfCheckVisibilityOfAnchorOptions() {
		$('.edgtf-page-form > div:hidden').each( function() {
			var $panelID =  $(this).attr('id');
			$('#edgtf-select-anchor option').each ( function() {
				if ($(this).data('anchor') == '#'+$panelID) {
					$(this).hide();//hide <li>s
				}
			});
		})
	}

	function edgtfGetArrayOfHiddenElements(changedElement) {
		var hidden_elements_string = changedElement.data('hide');
		hidden_elements_array = [];
		if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
			var hidden_elements_array = hidden_elements_string.split(',');
		} else {
			var hidden_elements_array = new Array(hidden_elements_string);
		}

		return hidden_elements_array;
	}

	function edgtfGetArrayOfShownElements(changedElement) {
		//check for links to show
		var shown_elements_string = changedElement.data('show');
		shown_elements_array = [];
		if(typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
			var shown_elements_array = shown_elements_string.split(',');
		} else {
			var shown_elements_array = new Array(shown_elements_string);
		}

		return shown_elements_array;
	}

	function edgtCheckAnchorsOnDependencyChange(){
		$(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
			var hidden_elements_array = edgtfGetArrayOfHiddenElements($(this));
			var shown_elements_array  = edgtfGetArrayOfShownElements($(this));

			//show all buttons, but hide unnecessary ones
			$.each(hidden_elements_array, function(index, value){
				$('#anchornav a').each ( function() {

					if ($(this).attr('href') == value) {
						$(this).parent().hide();//hide <li>s
					}
				});
			});
			$.each(shown_elements_array, function(index, value){
				$('#anchornav a').each ( function() {
					if ($(this).attr('href') == value) {
						$(this).parent().show();//show <li>s
					}
				});
			});
		});
	}

	function edgtfCheckOptionAnchorsOnDependencyChange() {
		$(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
			var hidden_elements_array = edgtfGetArrayOfHiddenElements($(this));
			var shown_elements_array  = edgtfGetArrayOfShownElements($(this));

			//show all buttons, but hide unnecessary ones
			$.each(hidden_elements_array, function(index, value){
				$('#edgtf-select-anchor option').each ( function() {

					if ($(this).data('anchor') == value) {
						$(this).hide();//hide option
					}
				});
			});
			$.each(shown_elements_array, function(index, value){
				$('#edgtf-select-anchor option').each ( function() {
					if ($(this).data('anchor') == value) {
						$(this).show();//show option
					}
				});
			});

			$('#edgtf-select-anchor').selectpicker('refresh');
		});
	}

	function checkBottomPaddingOfFormWrapDiv(){
		//check bottom padding of form wrap div, since bottom holder is changing its height because of the info messages
		setTimeout(function(){
			$('.edgtf-page-form').css('padding-bottom', $('.form-button-section').height());
		},350);
	}




	function edgtfInitSelectChange() {
		$('select.dependence').on('change', function (e) {
			var optionSelected = $("option:selected", this);
			var valueSelected = this.value.replace(/ /g, '');
			$($(this).data('hide-'+valueSelected)).fadeOut();
			$($(this).data('show-'+valueSelected)).fadeIn();
		});
	}

	function edgtfInitSwitch() {
		$(".cb-enable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-disable',parent).removeClass('selected');
			$(this).addClass('selected');
			$('.checkbox',parent).attr('checked', true);
			$('.checkboxhidden_yesno',parent).val("yes");
			$('.checkboxhidden_onoff',parent).val("on");
			$('.checkboxhidden_portfoliofollow',parent).val("portfolio_single_follow");
			$('.checkboxhidden_zeroone',parent).val("1");
			$('.checkboxhidden_imagevideo',parent).val("image");
			$('.checkboxhidden_yesempty',parent).val("yes");
			$('.checkboxhidden_flagpost',parent).val("post");
			$('.checkboxhidden_flagpage',parent).val("page");
			$('.checkboxhidden_flagmedia',parent).val("attachment");
			$('.checkboxhidden_flagportfolio',parent).val("portfolio_page");
			$('.checkboxhidden_flagproduct',parent).val("product");
		});
		$(".cb-disable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-enable',parent).removeClass('selected');
			$(this).addClass('selected');
			$('.checkbox',parent).attr('checked', false);
			$('.checkboxhidden_yesno',parent).val("no");
			$('.checkboxhidden_onoff',parent).val("off");
			$('.checkboxhidden_portfoliofollow',parent).val("portfolio_single_no_follow");
			$('.checkboxhidden_zeroone',parent).val("0");
			$('.checkboxhidden_imagevideo',parent).val("video");
			$('.checkboxhidden_yesempty',parent).val("");
			$('.checkboxhidden_flagpost',parent).val("");
			$('.checkboxhidden_flagpage',parent).val("");
			$('.checkboxhidden_flagmedia',parent).val("");
			$('.checkboxhidden_flagportfolio',parent).val("");
			$('.checkboxhidden_flagproduct',parent).val("");
		});
		$(".cb-enable.dependence").click(function(){
			$($(this).data('hide')).fadeOut();
			$($(this).data('show')).fadeIn();
		});
		$(".cb-disable.dependence").click(function(){
			$($(this).data('hide')).fadeOut();
			$($(this).data('show')).fadeIn();
		});
	}

	function edgtfInitTooltips() {
		$('.edgtf-tooltip').tooltip();
	}

	function edgtfInitColorpicker() {
		$('.edgtf-page .my-color-field').wpColorPicker({
			change:    function( event, ui ) {
				$('.edgtf-input-change').addClass('yes');
			}
		});
	}

	function edgtfChangeNotification(state) {
		if(state == 'hide') {

		}
	}

	/**
	 * Function that initializes
	 */
	function edgtfInitRangeSlider() {
		if($('.edgtf-slider-range').length) {

			$('.edgtf-slider-range').each(function() {
				var Link = $.noUiSlider.Link;

				var start       = 0;            //starting position of slider
				var min         = 0;            //minimal value
				var max         = 100;          //maximal value of slider
				var step        = 1;            //number of steps to snap to
				var orientation = 'horizontal';   //orientation. Could be vertical or horizontal
				var prefix      = '';           //prefix to the serialized value that is written field
				var postfix     = '';           //postfix to the serialized value that is written to field
				var thousand    = '';           //separator for thousand
				var decimals    = 2;            //number of decimals
				var mark        = '.';          //decimal separator

				//is data-start attribute set for current instance?
				if($(this).data('start') != null && $(this).data('start') !== "" && $(this).data('start') != "0.00") {
					start = $(this).data('start');
					if (start == "1.00") start = 1;
					if(parseInt(start) == start){
						start = parseInt(start);
					}
				}

				//is data-min attribute set for current instance?
				if($(this).data('min') != null && $(this).data('min') !== "") {
					min = $(this).data('min');
				}

				//is data-max attribute set for current instance?
				if($(this).data('max') != null && $(this).data('max') !== "") {
					max = $(this).data('max');
				}

				//is data-step attribute set for current instance?
				if($(this).data('step') != null && $(this).data('step') !== "") {
					step = $(this).data('step');
				}

				//is data-orientation attribute set for current instance?
				if($(this).data('orientation') != null && $(this).data('orientation') !== "") {
					//define available orientations
					var availableOrientations = ['horizontal', 'vertical'];

					//is data-orientation value in array of available orientations?
					if(availableOrientations.indexOf($(this).data('orientation'))) {
						orientation = $(this).data('orientation');
					}
				}

				//is data-prefix attribute set for current instance?
				if($(this).data('prefix') != null && $(this).data('prefix') !== "") {
					prefix = $(this).data('prefix');
				}

				//is data-postfix attribute set for current instance?
				if($(this).data('postfix') != null && $(this).data('postfix') !== "") {
					postfix = $(this).data('postfix');
				}

				//is data-thousand attribute set for current instance?
				if($(this).data('thousand') != null && $(this).data('thousand') !== "") {
					thousand = $(this).data('thousand');
				}

				//is data-decimals attribute set for current instance?
				if($(this).data('decimals') != null && $(this).data('decimals') !== "") {
					decimals = $(this).data('decimals');
				}

				//is data-mark attribute set for current instance?
				if($(this).data('mark') != null && $(this).data('mark') !== "") {
					mark = $(this).data('mark');
				}

				$(this).noUiSlider({
					start: start,
					step: step,
					orientation: orientation,
					range: {
						'min': min,
						'max': max
					},
					serialization: {
						lower: [
							new Link({
								target: $(this).prev('.edgtf-slider-range-value')
							})
						],
						format: {
							// Set formatting
							thousand: thousand,
							postfix: postfix,
							prefix: prefix,
							decimals: decimals,
							mark: mark
						}
					}
				}).on({
					change: function(){
						$('.edgtf-input-change').addClass('yes');
					}
				});
			});
		}
	}

	function edgtfInitMediaUploader() {
		if($('.edgtf-media-uploader').length) {
			$('.edgtf-media-uploader').each(function() {
				var fileFrame;
				var uploadUrl;
				var uploadHeight;
				var uploadWidth;
				var uploadImageHolder;
				var attachment;
				var removeButton;

				//set variables values
				uploadUrl           = $(this).find('.edgtf-media-upload-url');
				uploadHeight        = $(this).find('.edgtf-media-upload-height');
				uploadWidth        = $(this).find('.edgtf-media-upload-width');
				uploadImageHolder   = $(this).find('.edgtf-media-image-holder');
				removeButton        = $(this).find('.edgtf-media-remove-btn');

				if (uploadImageHolder.find('img').attr('src') != "") {
					removeButton.show();
					edgtfInitMediaRemoveBtn(removeButton);
				}

				$(this).on('click', '.edgtf-media-upload-btn', function() {
					//if the media frame already exists, reopen it.
					if (fileFrame) {
						fileFrame.open();
						return;
					}

					//create the media frame
					fileFrame = wp.media.frames.fileFrame = wp.media({
						title: $(this).data('frame-title'),
						button: {
							text: $(this).data('frame-button-text')
						},
						multiple: false
					});

					//when an image is selected, run a callback
					fileFrame.on( 'select', function() {
						attachment = fileFrame.state().get('selection').first().toJSON();
						removeButton.show();
						edgtfInitMediaRemoveBtn(removeButton);
						//write to url field and img tag
						if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
							uploadUrl.val(attachment.url);
							if (attachment.sizes.thumbnail)
								uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
							else
								uploadImageHolder.find('img').attr('src', attachment.url);
							uploadImageHolder.show();
						} else if (attachment.hasOwnProperty('url')) {
							uploadUrl.val(attachment.url);
							uploadImageHolder.find('img').attr('src', attachment.url);
							uploadImageHolder.show();
						}

						//write to hidden meta fields
						if(attachment.hasOwnProperty('height')) {
							uploadHeight.val(attachment.height);
						}

						if(attachment.hasOwnProperty('width')) {
							uploadWidth.val(attachment.width);
						}
						$('.edgtf-input-change').addClass('yes');
					});

					//open media frame
					fileFrame.open();
				});
			});
		}

		function edgtfInitMediaRemoveBtn(btn) {
			btn.on('click', function() {
				//remove image src and hide it's holder
				btn.siblings('.edgtf-media-image-holder').hide();
				btn.siblings('.edgtf-media-image-holder').find('img').attr('src', '');

				//reset meta fields
				btn.siblings('.edgtf-media-meta-fields').find('input[type="hidden"]').each(function(e) {
					$(this).val('');
				});

				btn.hide();
			});
		}
	}

	function edgtfInitGalleryUploader() {

		var $edgtf_upload_button = jQuery('.edgtf-gallery-upload-btn');

		var $edgtf_clear_button = jQuery('.edgtf-gallery-clear-btn');

		wp.media.customlibEditGallery1 = {

			frame: function() {

				if ( this._frame )
					return this._frame;

				var selection = this.select();

				this._frame = wp.media({
					id: 'edgt_portfolio-image-gallery',
					frame: 'post',
					state: 'gallery-edit',
					title: wp.media.view.l10n.editGalleryTitle,
					editing: true,
					multiple: true,
					selection: selection
				});

				this._frame.on('update', function() {

					var controller = wp.media.customlibEditGallery1._frame.states.get('gallery-edit');
					var library = controller.get('library');
					// Need to get all the attachment ids for gallery
					var ids = library.pluck('id');

					$input_gallery_items.val(ids);

					jQuery.ajax({
						type: "post",
						url: ajaxurl,
						data: "action=edgt_gallery_upload_get_images&ids=" + ids,
						success: function(data) {

							$thumbs_wrap.empty().html(data);

						}
					});

				});

				return this._frame;
			},

			init: function() {

				$edgtf_upload_button.click(function(event) {

					$thumbs_wrap = $(this).parent().prev().prev();
					$input_gallery_items = $thumbs_wrap.next();

					event.preventDefault();
					wp.media.customlibEditGallery1.frame().open();

				});

				$edgtf_clear_button.click(function(event) {

					$thumbs_wrap = $edgtf_upload_button.parent().prev().prev();
					$input_gallery_items = $thumbs_wrap.next();

					event.preventDefault();
					$thumbs_wrap.empty();
					$input_gallery_items.val("");
				});
			},

			// Gets initial gallery-edit images. Function modified from wp.media.gallery.edit
			// in wp-includes/js/media-editor.js.source.html
			select: function() {

				var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + $input_gallery_items.val() + '"]'),
					defaultPostId = wp.media.gallery.defaults.id,
					attachments, selection;

				// Bail if we didn't match the shortcode or all of the content.
				if (!shortcode)
					return;

				// Ignore the rest of the match object.
				shortcode = shortcode.shortcode;

				if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
					shortcode.set('id', defaultPostId);

				attachments = wp.media.gallery.attachments(shortcode);
				selection = new wp.media.model.Selection(attachments.models, {
					props: attachments.props.toJSON(),
					multiple: true
				});

				selection.gallery = attachments.gallery;

				// Fetch the query's attachments, and then break ties from the
				// query to allow for sorting.
				selection.more().done(function() {
					// Break ties with the query.
					selection.props.set({
						query: false
					});
					selection.unmirror();
					selection.props.unset('orderby');
				});

				return selection;

			}

		};
		$(wp.media.customlibEditGallery1.init);
	}

	function edgtInitPortfolioItemAcc() {
		//remove portfolio item
		$(document).on('click', '.remove-portfolio-item', function(event) {
			event.preventDefault();
			var $toggleHolder = $(this).parent().parent().parent();
			$toggleHolder.fadeOut(300,function() {
				$(this).remove();

				//after removing portfolio image, set new rel numbers and set new ids/names
				$('.edgtf-portfolio-additional-item').each(function(i){
					$(this).attr('rel',i+1);
					$(this).find('.number').text($(this).attr('rel'));
					edgtfSetIdOnRemoveItem($(this),i+1);
				});
				//hide expand all button if all items are removed
				noPortfolioItemShown();
			});
			return false;
		});

		//hide expand all button if there is no items
		noPortfolioItemShown();
		function noPortfolioItemShown()  {
			if($('.edgtf-portfolio-additional-item').length == 0){
				$('.edgtf-toggle-all-item').hide();
			}
		}

		//expand all additional sidebar items on click on 'expand all' button
		$(document).on('click', '.edgtf-toggle-all-item', function(event) {
			event.preventDefault();
			$('.edgtf-portfolio-additional-item').each(function(i){

				var $toggleContent = $(this).find('.edgtf-portfolio-toggle-content');
				var $this = $(this).find('.toggle-portfolio-item');
				if ($toggleContent.is(':visible')) {
				}
				else {
					$toggleContent.slideToggle();
					$this.html('<i class="fa fa-caret-down"></i>')
				}
			});
			return false;
		});
		//toggle for portfolio additional sidebar items
		$(document).on('click', '.edgtf-portfolio-additional-item .edgtf-portfolio-toggle-holder', function(event) {
			event.preventDefault();

			var $this = $(this);
			var $caret_holder = $this.find('.toggle-portfolio-item');
			$caret_holder.html('<i class="fa fa-caret-up"></i>');
			var $toggleContent = $this.next();
			$toggleContent.slideToggle(function() {
				if ($toggleContent.is(':visible')) {
					$caret_holder.html('<i class="fa fa-caret-up"></i>')
				}
				else {
					$caret_holder.html('<i class="fa fa-caret-down"></i>')
				}
				//hide expand all button function in case of all boxes revealed
				checkExpandAllBtn();
			});
			return false;
		});
		//hide expand all button when it's clicked
		$(document).on('click','.edgtf-toggle-all-item', function(event) {
			event.preventDefault();
			$(this).hide();
		})

		function checkExpandAllBtn() {
			if($('.edgtf-portfolio-additional-item .edgtf-portfolio-toggle-content:hidden').length == 0){
				$('.edgtf-toggle-all-item').hide();
			}else{
				$('.edgtf-toggle-all-item').show();
			}
		}

	}

	function edgtfInitPortfolioItemsBox() {
		var edgt_portfolio_additional_item = $('.edgtf-portfolio-additional-item-holder').clone().html();
		$portfolio_item = '<div class="edgtf-portfolio-additional-item" rel="">'+ edgt_portfolio_additional_item +'</div>';

		$('a.edgtf-add-item').click(function (event) {
			event.preventDefault();
			$(this).parent().before($($portfolio_item).hide().fadeIn(500));
			var portfolio_num = $(this).parent().siblings('.edgtf-portfolio-additional-item').length;
			$(this).parent().siblings('.edgtf-portfolio-additional-item:last').attr('rel',portfolio_num);
			edgtfSetIdOnAddItem($(this).parent(),portfolio_num);
			$(this).parent().prev().find('.number').text(portfolio_num);
		});
	}

	function edgtfSetIdOnAddItem(addButton,portfolio_num){

		addButton.siblings('.edgtf-portfolio-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name');
			var new_name= name.replace("_x", "[]");
			var new_id = name.replace("_x", "_"+portfolio_num);
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);

		});
	}

	function edgtfSetIdOnRemoveItem(portfolio,portfolio_num){

		if(portfolio_num == undefined){
			var portfolio_num = portfolio.attr('rel');
		}else{
			var portfolio_num = portfolio_num;
		}

		portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name').split('[')[0];
			var new_name = name+"[]";
			var new_id = name+"_"+portfolio_num;
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);

		});

	}



	function edgtInitPortfolioMediaAcc() {
		//remove portfolio media
		$(document).on('click', '.remove-portfolio-media', function(event) {
			event.preventDefault();
			var $toggleHolder = $(this).parent().parent().parent();
			$toggleHolder.fadeOut(300,function() {
				$(this).remove();

				//after removing portfolio image, set new rel numbers and set new ids/names
				$('.edgtf-portfolio-media').each(function(i){
					$(this).attr('rel',i+1);
					$(this).find('.number').text($(this).attr('rel'));
					edgtfSetIdOnRemoveMedia($(this),i+1);
				});
				//hide expand all button if all medias are removed
				noPortfolioMedia()
			});  return false;
		});

		//hide 'expand all' button if there is no media
		noPortfolioMedia();
		function noPortfolioMedia() {
			if($('.edgtf-portfolio-media').length == 0){
				$('.edgtf-toggle-all-media').hide();
			}
		}

		//expand all portfolio medias (video and images) onClick on 'expand all' button
		$(document).on('click','.edgtf-toggle-all-media', function(event) {
			event.preventDefault();
			$('.edgtf-portfolio-media').each(function(i){

				var $toggleContent = $(this).find('.edgtf-portfolio-toggle-content');
				var $this = $(this).find('.toggle-portfolio-media');
				if ($toggleContent.is(':visible')) {
				}
				else {
					$toggleContent.slideToggle();
					$this.html('<i class="fa fa-caret-down"></i>')
				}

			});        return false;
		});
		//toggle for portfolio media (images or videos)
		$(document).on('click', '.edgtf-portfolio-media .edgtf-portfolio-toggle-holder', function(event) {
			event.preventDefault();
			var $this = $(this);
			var $caret_holder = $this.find('.toggle-portfolio-media');
			$caret_holder.html('<i class="fa fa-caret-up"></i>');
			var $toggleContent = $(this).next();
			$toggleContent.slideToggle(function() {
				if ($toggleContent.is(':visible')) {
					$caret_holder.html('<i class="fa fa-caret-up"></i>')
				}
				else {
					$caret_holder.html('<i class="fa fa-caret-down"></i>')
				}
				//hide expand all button function in case of all boxes revealed
				checkExpandAllMediaBtn();
			});
			return false;
		});
		//hide expand all button when it's clicked
		$(document).on('click','.edgtf-toggle-all-media', function(event) {
			event.preventDefault();
			$(this).hide();
		});
		function checkExpandAllMediaBtn() {
			if($('.edgtf-portfolio-media .edgtf-portfolio-toggle-content:hidden').length == 0){
				$('.edgtf-toggle-all-media').hide();
			}else{
				$('.edgtf-toggle-all-media').show();
			}
		}
	}



	function edgtfInitPortfolioImagesVideosBox() {
		var edgtf_portfolio_images = $('.edgtf-hidden-portfolio-images').clone().html();
		$portfolio_image = '<div class="edgtf-portfolio-images edgtf-portfolio-media" rel="">'+ edgtf_portfolio_images +'</div>';
		var edgtf_portfolio_videos = $('.edgtf-hidden-portfolio-videos').clone().html();

		$portfolio_videos = '<div class="edgtf-portfolio-videos edgtf-portfolio-media" rel="">'+ edgtf_portfolio_videos +'</div>';
		$('a.edgtf-add-image').click(function (e) {
			e.preventDefault();
			$(this).parent().before($($portfolio_image).hide().fadeIn(500));
			var portfolio_num = $(this).parent().siblings('.edgtf-portfolio-media').length;
			$(this).parent().siblings('.edgtf-portfolio-media:last').attr('rel',portfolio_num);
			edgtfInitMediaUploaderAdded($(this).parent());
			edgtfSetIdOnAddMedia($(this).parent(),portfolio_num);
			$(this).parent().prev().find('.number').text(portfolio_num);
		});

		$('a.edgtf-add-video').click(function (e) {
			e.preventDefault();
			$(this).parent().before($($portfolio_videos).hide().fadeIn(500));
			var portfolio_num = $(this).parent().siblings('.edgtf-portfolio-media').length;
			$(this).parent().siblings('.edgtf-portfolio-media:last').attr('rel',portfolio_num);
			edgtfInitMediaUploaderAdded($(this).parent());
			edgtfSetIdOnAddMedia($(this).parent(),portfolio_num);
			$(this).parent().prev().find('.number').text(portfolio_num);
		});

		$(document).on('click', '.edgtf-remove-last-row-media', function(event) {
			event.preventDefault();
			$(this).parent().prev().fadeOut(300,function() {
				$(this).remove();

				//after removing portfolio image, set new rel numbers and set new ids/names
				$('.edgtf-portfolio-media').each(function(i){
					$(this).attr('rel',i+1);
					edgtfSetIdOnRemoveMedia($(this),i+1);
				});
			});

		});
		edgtfShowHidePorfolioImageVideoType();
		$(document).on('change', 'select.edgtf-portfoliovideotype', function(e) {
			edgtfShowHidePorfolioImageVideoType();
		});
	}

	function edgtfSetIdOnAddMedia(addButton,portfolio_num){

		addButton.siblings('.edgtf-portfolio-media:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name');
			var new_name= name.replace("_x", "[]");
			var new_id = name.replace("_x", "_"+portfolio_num);
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);

		});

		edgtfShowHidePorfolioImageVideoType();
	}

	function edgtfSetIdOnRemoveMedia(portfolio,portfolio_num){

		if(portfolio_num == undefined){
			var portfolio_num = portfolio.attr('rel');
		}else{
			var portfolio_num = portfolio_num;
		}

		portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name').split('[')[0];
			var new_name = name+"[]";
			var new_id = name+"_"+portfolio_num;
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);

		});

	}


	function edgtfSetIdOnAddPortfolio(addButton,portfolio_num){

		addButton.siblings('.edgtf_portfolio_image:last').find('input[type="text"], input[type="hidden"], select').each(function(){
			var name = $(this).attr('name');
			var new_name= name.replace("_x", "[]");
			var new_id = name.replace("_x", "_"+portfolio_num);
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);

		});

		edgtfShowHidePorfolioImageVideoType();
	}

	function edgtfSetIdOnRemovePortfolio(portfolio,portfolio_num){

		if(portfolio_num == undefined){
			var portfolio_num = portfolio.attr('rel');
		}else{
			var portfolio_num = portfolio_num;
		}

		portfolio.find('input[type="text"], select').each(function(){
			var name = $(this).attr('name').split('[')[0];
			var new_name = name+"[]";
			var new_id = name+"_"+portfolio_num;
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);

		});

	}

	function edgtfShowHidePorfolioImageVideoType(){

		$('.edgtf-portfoliovideotype').each(function(i){

			var $selected = $(this).val();

			if($selected == "self"){
				$(this).parent().parent().parent().find('.edgtf-video-id-holder').hide();
				$(this).parent().parent().parent().parent().find('.edgtf-media-uploader').show();
				$(this).parent().parent().parent().find('.edgtf-video-self-hosted-path-holder').show();
			}else{
				$(this).parent().parent().parent().find('.edgtf-video-id-holder').show();
				$(this).parent().parent().parent().parent().find('.edgtf-media-uploader').hide();
				$(this).parent().parent().parent().find('.edgtf-video-self-hosted-path-holder').hide();
			}
		});
	}

	function edgtfInitMediaUploaderAdded(addButton) {

		addButton.siblings('.edgtf-portfolio-media:last').find('.edgtf-media-uploader').each(function(){
			var fileFrame;
			var uploadUrl;
			var uploadHeight;
			var uploadWidth;
			var uploadImageHolder;
			var attachment;
			var removeButton;

			//set variables values
			uploadUrl           = $(this).find('.edgtf-media-upload-url');
			uploadHeight        = $(this).find('.edgtf-media-upload-height');
			uploadWidth        = $(this).find('.edgtf-media-upload-width');
			uploadImageHolder   = $(this).find('.edgtf-media-image-holder');
			removeButton        = $(this).find('.edgtf-media-remove-btn');

			if (uploadImageHolder.find('img').attr('src') != "") {
				removeButton.show();
				edgtfInitMediaRemoveBtn(removeButton);
			}

			$(this).on('click', '.edgtf-media-upload-btn', function() {
				//if the media frame already exists, reopen it.
				if (fileFrame) {
					fileFrame.open();
					return;
				}

				//create the media frame
				fileFrame = wp.media.frames.fileFrame = wp.media({
					title: $(this).data('frame-title'),
					button: {
						text: $(this).data('frame-button-text')
					},
					multiple: false
				});

				//when an image is selected, run a callback
				fileFrame.on( 'select', function() {
					attachment = fileFrame.state().get('selection').first().toJSON();
					removeButton.show();
					edgtfInitMediaRemoveBtn(removeButton);
					//write to url field and img tag
					if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
						uploadUrl.val(attachment.url);
						if (attachment.sizes.thumbnail)
							uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
						else
							uploadImageHolder.find('img').attr('src', attachment.url);
						uploadImageHolder.show();
					} else if (attachment.hasOwnProperty('url')) {
						uploadUrl.val(attachment.url);
						uploadImageHolder.find('img').attr('src', attachment.url);
						uploadImageHolder.show();
					}

					//write to hidden meta fields
					if(attachment.hasOwnProperty('height')) {
						uploadHeight.val(attachment.height);
					}

					if(attachment.hasOwnProperty('width')) {
						uploadWidth.val(attachment.width);
					}
					$('.edgtf-input-change').addClass('yes');
				});

				//open media frame
				fileFrame.open();
			});
		});

		function edgtfInitMediaRemoveBtn(btn) {
			btn.on('click', function() {
				//remove image src and hide it's holder
				btn.siblings('.edgtf-media-image-holder').hide();
				btn.siblings('.edgtf-media-image-holder').find('img').attr('src', '');

				//reset meta fields
				btn.siblings('.edgtf-media-meta-fields').find('input[type="hidden"]').each(function(e) {
					$(this).val('');
				});

				btn.hide();
			});
		}
	}

	function edgtfInitAjaxForm() {
		$('#edgt_top_save_button').click( function() {
			$('.edgt_ajax_form').submit();
			if ($('.edgtf-input-change.yes').length) {
				$('.edgtf-input-change.yes').removeClass('yes');
			}
			$('.edgtf-changes-saved').addClass('yes');
			setTimeout(function(){$('.edgtf-changes-saved').removeClass('yes');}, 3000);
			return false;
		});
		$(document).delegate(".edgt_ajax_form", "submit", function (a) {
			var b = $(this);
			var c = {
				action: "edgtf_save_options"
			};
			jQuery.ajax({
				url: ajaxurl,
				cache: !1,
				type: "POST",
				data: jQuery.param(c, !0) + "&" + b.serialize()
//            ,
//            success: function(data, textStatus, XMLHttpRequest){
//                alert(data);
//            }
			}), a.preventDefault(), a.stopPropagation()
		})
	}

	function edgtfInitDatePicker() {
		$( ".edgtf-input.datepicker" ).datepicker( { dateFormat: "MM dd, yy" });
	}
    function edgtfInitSelectPicker() {
        $(".edgtf-selectpicker").selectpicker({
            style: 'btn-info',
            size: 10
        });
    }
	function edgtfshowHideBlogVideoType(){ 
		var $selected = $('select#video_format_choose').val(); 
		if($selected == "self"){ 
			$('#video_format_link').parent().hide(); 
			$('#video_format_image').parent().parent().show(); 
			$('#video_format_webm').parent().show(); 
			$('#video_format_mp4').parent().show(); 
			$('#video_format_ogv').parent().show(); 
		}else{ 
			$('#video_format_image').parent().parent().hide(); 
			$('#video_format_webm').parent().hide(); 
			$('#video_format_mp4').parent().hide(); 
			$('#video_format_ogv').parent().hide(); 
			$('#video_format_link').parent().show(); 
		} 

	}
})(jQuery);

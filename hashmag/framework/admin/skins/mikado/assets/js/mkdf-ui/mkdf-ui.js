(function($){
    $(document).ready(function() {
        //plugins init goes here
        mkdfInitSelectChange();
        mkdfInitSwitch();
        mkdfInitTooltips();
        mkdfInitColorpicker();
        mkdfInitRangeSlider();
        mkdfInitMediaUploader();
        mkdfInitGalleryUploader();
        if ($('.mkdf-page-form').length > 0) {
            mkdfInitAjaxForm();
            mkdScrollToAnchor();
            mkdfScrollToAnchorSelect();
            mkdfAnchorSelectOnLoad();
            initTopAnchorHolderSize();
            mkdCheckVisibilityOfAnchorButtons();
            mkdfCheckVisibilityOfAnchorOptions();
            mkdCheckAnchorsOnDependencyChange();
            mkdfCheckOptionAnchorsOnDependencyChange();
            mkdChangedInput();
            mkdfFixHeaderAndTitle();
            totop_button();
            backButtonShowHide();
            backToTop();
            mkdfInitSelectPicker();
        }
        mkdfInitPortfolioImagesVideosBox();
        mkdInitPortfolioMediaAcc();
        mkdfInitPortfolioItemsBox();
        mkdInitPortfolioItemAcc();
        mkdfInitDatePicker();
		mkdfShowHidePostFormats();
        mkdfPageTemplatesMetaBoxDependency()
    });

    function mkdfFixHeaderAndTitle () {
        var pageHeader 				= $('.mkdf-page-header');
        var pageHeaderHeight		= pageHeader.height();
        var adminBarHeight			= $('#wpadminbar').height();
        var pageHeaderTopPosition 	= pageHeader.offset().top - parseInt(adminBarHeight);
        var pageTitle				= $('.mkdf-page-title-holder');
        var pageTitleTopPosition	= pageHeaderHeight + adminBarHeight - parseInt(pageTitle.css('marginTop'));
        var tabsNavWrapper			= $('.mkdf-tabs-navigation-wrapper');
        var tabsNavWrapperTop		= pageHeaderHeight;
        var tabsContentWrapper	    = $('.mkd_ajax_form');
        var tabsContentWrapperTop	= pageHeaderHeight + pageTitle.outerHeight();

        $(window).on('scroll load', function() {
            if($(window).scrollTop() >= pageHeaderTopPosition) {
                pageHeader.addClass('mkd-header-fixed');
                pageTitle.addClass('mkd-page-title-fixed').css('top', pageTitleTopPosition);
                tabsNavWrapper.css('marginTop', tabsNavWrapperTop);
                tabsContentWrapper.css('marginTop', tabsContentWrapperTop);
            } else {
                pageHeader.removeClass('mkd-header-fixed');
                pageTitle.removeClass('mkd-page-title-fixed').css('top', 0);
                tabsNavWrapper.css('marginTop', 0);
                tabsContentWrapper.css('marginTop', 0);
            }
        });

        //function initFloatHeader() {
        //	var $topDistance = $('#wpadminbar').height();
        //	var $pageHeaderHeight = $('.page-header').height();
        //
        //   if ($(this).scrollTop() >= parseInt($('.mkdf-options-page').css('marginTop'))) {
        //		$('.page-header').addClass('mkd-header-fixed');
        //		$('.mkd-header-fixed').css('top',$topDistance);
        //		$('.mkdf-page-title-holder').addClass('mkd-page-title-fixed');
        //       $('.mkd-page-title-fixed').css('top',$topDistance + $pageHeaderHeight - parseInt($('.mkdf-page-title-holder').css('marginTop')));
        //       $('.mkdf-tabs-navigation-wrapper').css({
        //           'top' : $topDistance + $pageHeaderHeight - parseInt($('.mkdf-page-title-holder').css('marginTop'))
        //       });
        //       $('.mkdf-page-form').css({
        //           'top': 50
        //       });
        //
        //		console.log($pageHeaderHeight);
        //   } else {
        //		$('.page-header').removeClass('mkd-header-fixed');
        //		$('.mkdf-page-title-holder').removeClass('mkd-page-title-fixed');
        //       $('.mkdf-tabs-navigation-wrapper').css({
        //           'top' : 0
        //       });
        //       $('.mkdf-page-form').css({
        //           'top': 0
        //       });
        //   }
        //}
        //$(window).scroll(function () {
        //	initFloatHeader();
        //});
        //initFloatHeader();
    }

    function initTopAnchorHolderSize() {
        function initTopSize() {
            $('.mkdf-top-section-holder-inner').css({
                'width' : $('.mkdf-top-section-holder').width()
            });
            $('.mkdf-page-title-holder').css({
                'width' : $('.mkdf-page-section-title:visible').outerWidth()- 2*parseInt($('.mkdf-page-title-holder').css('marginLeft'))
            });
        };
        initTopSize();

        $(window).on('resize', function() {
            initTopSize();
        });
    }

    function mkdScrollToAnchor () {
        $('#anchornav a').click( function() {
            mkdfScrollToPanel($(this).attr('href'));
        });
    }

    function mkdfScrollToAnchorSelect() {
        var selectAnchor = $('#mkdf-select-anchor');
        selectAnchor.on('change', function() {
            var selectAnchor = $('option:selected', selectAnchor);

            if(typeof selectAnchor.data('anchor') !== 'undefined') {
                mkdfScrollToPanel(selectAnchor.data('anchor'));
            }
        });
    }

    function mkdfAnchorSelectOnLoad() {
        var currentPanel = window.location.hash;
        if(currentPanel) {
            var selectAnchor = $('#mkdf-select-anchor');
            var currentOption = selectAnchor.find('option[data-anchor="'+currentPanel+'"]').first();

            if(currentOption) {
                currentOption.attr('selected', 'selected');
            }
        }

    }

    function mkdfScrollToPanel(panel) {
        var pageHeader 				= $('.mkdf-page-header');
        var pageHeaderHeight		= pageHeader.height();
        var adminBarHeight			= $('#wpadminbar').height();
        var pageTitle				= $('.mkdf-page-title-holder');
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


    function mkdChangedInput () {
        $('.mkdf-tabs-content form.mkd_ajax_form:not(.mkdf-import-page-holder)').on('change keyup keydown', 'input:not([type="submit"]), textarea, select', function (e) {
            $('.mkdf-input-change').addClass('yes');
        });
        $('.mkdf-tabs-content form.mkd_ajax_form:not(.mkdf-import-page-holder) .field.switch label:not(.selected)').click( function() {
            $('.mkdf-input-change').addClass('yes');
        });
        $(window).on('beforeunload', function () {
            if ($('.mkdf-input-change.yes').length) {
                return 'You haven\'t saved your changes.';
            }
        });
        $('.mkdf-tabs-content form.mkd_ajax_form:not(.mkdf-import-page-holder) #anchornav input').click(function() {
            if ($('.mkdf-input-change.yes').length) {
                $('.mkdf-input-change.yes').removeClass('yes');
            }
            $('.mkdf-changes-saved').addClass('yes');
            setTimeout(function(){$('.mkdf-changes-saved').removeClass('yes');}, 3000);
        });
    }

    function mkdCheckVisibilityOfAnchorButtons () {

        $('.mkdf-page-form > div:hidden').each( function() {
            var $panelID =  $(this).attr('id');
            $('#anchornav a').each ( function() {
                if ($(this).attr('href') == '#'+$panelID) {
                    $(this).parent().hide();//hide <li>s
                }
            });
        })
    }

    function mkdfCheckVisibilityOfAnchorOptions() {
        $('.mkdf-page-form > div:hidden').each( function() {
            var $panelID =  $(this).attr('id');
            $('#mkdf-select-anchor option').each ( function() {
                if ($(this).data('anchor') == '#'+$panelID) {
                    $(this).hide();//hide <li>s
                }
            });
        })
    }

    function mkdfGetArrayOfHiddenElements(changedElement) {
        var hidden_elements_string = changedElement.data('hide');
        hidden_elements_array = [];
        if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
            var hidden_elements_array = hidden_elements_string.split(',');
        } else {
            var hidden_elements_array = new Array(hidden_elements_string);
        }

        return hidden_elements_array;
    }

    function mkdfGetArrayOfShownElements(changedElement) {
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
	
	function mkdfGetArrayOfHiddenElementsSelectBox(changedElement,changedElementValue) {
        var hidden_elements_string = changedElement.data('hide-'+changedElementValue);
        hidden_elements_array = [];
        if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
            var hidden_elements_array = hidden_elements_string.split(',');
        } else {
            var hidden_elements_array = new Array(hidden_elements_string);
        }

        return hidden_elements_array;
    }

    function mkdfGetArrayOfShownElementsSelectBox(changedElement,changedElementValue) {
        //check for links to show
        var shown_elements_string = changedElement.data('show-'+changedElementValue);
        shown_elements_array = [];
        if(typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
            var shown_elements_array = shown_elements_string.split(',');
        } else {
            var shown_elements_array = new Array(shown_elements_string);
        }

        return shown_elements_array;
    }
	
    function mkdCheckAnchorsOnDependencyChange(){
        $(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
            hidden_elements_array = mkdfGetArrayOfHiddenElements($(this));
            shown_elements_array  = mkdfGetArrayOfShownElements($(this));

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
		
		
		$(document).on('change','.mkdf-form-element.dependence',function(){
            hidden_elements_array = mkdfGetArrayOfHiddenElementsSelectBox($(this),$(this).val());
            shown_elements_array  = mkdfGetArrayOfShownElementsSelectBox($(this),$(this).val());

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

    function mkdfCheckOptionAnchorsOnDependencyChange() {
        $(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
            hidden_elements_array = mkdfGetArrayOfHiddenElements($(this));
            shown_elements_array  = mkdfGetArrayOfShownElements($(this));

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#mkdf-select-anchor option').each ( function() {

                    if ($(this).data('anchor') == value) {
                        $(this).hide();//hide option
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#mkdf-select-anchor option').each ( function() {
                    if ($(this).data('anchor') == value) {
                        $(this).show();//show option
                    }
                });
            });

            $('#mkdf-select-anchor').selectpicker('refresh');
        });
		
		$(document).on('change','.mkdf-form-element.dependence',function(){
            hidden_elements_array = mkdfGetArrayOfHiddenElementsSelectBox($(this),$(this).val());
            shown_elements_array  = mkdfGetArrayOfShownElementsSelectBox($(this),$(this).val());

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#mkdf-select-anchor option').each ( function() {

                    if ($(this).data('anchor') == value) {
                        $(this).hide();//hide option
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#mkdf-select-anchor option').each ( function() {
                    if ($(this).data('anchor') == value) {
                        $(this).show();//show option
                    }
                });
            });

            $('#mkdf-select-anchor').selectpicker('refresh');
        });
    }

    function checkBottomPaddingOfFormWrapDiv(){
        //check bottom padding of form wrap div, since bottom holder is changing its height because of the info messages
        setTimeout(function(){
            $('.mkdf-page-form').css('padding-bottom', $('.form-button-section').height());
        },350);
    }




    function mkdfInitSelectChange() {
        $('select.dependence').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value.replace(/ /g, '');
            $($(this).data('hide-'+valueSelected)).fadeOut();
            $($(this).data('show-'+valueSelected)).fadeIn();
        });
    }

    function mkdfInitSwitch() {
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

    function mkdfInitTooltips() {
        $('.mkdf-tooltip').tooltip();
    }

    function mkdfInitColorpicker() {
        $('.mkdf-page .my-color-field').wpColorPicker({
            change:    function( event, ui ) {
                $('.mkdf-input-change').addClass('yes');
            }
        });
    }

    /**
     * Function that initializes
     */
    function mkdfInitRangeSlider() {
        if($('.mkdf-slider-range').length) {

            $('.mkdf-slider-range').each(function() {
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
                                target: $(this).prev('.mkdf-slider-range-value')
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
                        $('.mkdf-input-change').addClass('yes');
                    }
                });
            });
        }
    }

    function mkdfInitMediaUploader() {
        if($('.mkdf-media-uploader').length) {
            $('.mkdf-media-uploader').each(function() {
                var fileFrame;
                var uploadUrl;
                var uploadHeight;
                var uploadWidth;
                var uploadImageHolder;
                var attachment;
                var removeButton;

                //set variables values
                uploadUrl           = $(this).find('.mkdf-media-upload-url');
                uploadHeight        = $(this).find('.mkdf-media-upload-height');
                uploadWidth        = $(this).find('.mkdf-media-upload-width');
                uploadImageHolder   = $(this).find('.mkdf-media-image-holder');
                removeButton        = $(this).find('.mkdf-media-remove-btn');

                if (uploadImageHolder.find('img').attr('src') != "") {
                    removeButton.show();
                    mkdfInitMediaRemoveBtn(removeButton);
                }

                $(this).on('click', '.mkdf-media-upload-btn', function() {
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
                        mkdfInitMediaRemoveBtn(removeButton);
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
                        $('.mkdf-input-change').addClass('yes');
                    });

                    //open media frame
                    fileFrame.open();
                });
            });
        }

        function mkdfInitMediaRemoveBtn(btn) {
            btn.on('click', function() {
                //remove image src and hide it's holder
                btn.siblings('.mkdf-media-image-holder').hide();
                btn.siblings('.mkdf-media-image-holder').find('img').attr('src', '');

                //reset meta fields
                btn.siblings('.mkdf-media-meta-fields').find('input[type="hidden"]').each(function(e) {
                    $(this).val('');
                });

                btn.hide();
            });
        }
    }

    function mkdfInitGalleryUploader() {

        var $mkdf_upload_button = jQuery('.mkdf-gallery-upload-btn');

        var $mkdf_clear_button = jQuery('.mkdf-gallery-clear-btn');

        wp.media.customlibEditGallery1 = {

            frame: function() {

                if ( this._frame )
                    return this._frame;

                var selection = this.select();

                this._frame = wp.media({
                    id: 'mkd_portfolio-image-gallery',
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
                        data: "action=hashmag_mikado_gallery_upload_get_images&ids=" + ids,
                        success: function(data) {

                            $thumbs_wrap.empty().html(data);

                        }
                    });

                });

                return this._frame;
            },

            init: function() {

                $mkdf_upload_button.click(function(event) {

                    $thumbs_wrap = $(this).parent().prev().prev();
                    $input_gallery_items = $thumbs_wrap.next();

                    event.preventDefault();
                    wp.media.customlibEditGallery1.frame().open();

                });

                $mkdf_clear_button.click(function(event) {

                    $thumbs_wrap = $mkdf_upload_button.parent().prev().prev();
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

    function mkdInitPortfolioItemAcc() {
        //remove portfolio item
        $(document).on('click', '.remove-portfolio-item', function(event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300,function() {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.mkdf-portfolio-additional-item').each(function(i){
                    $(this).attr('rel',i+1);
                    $(this).find('.number').text($(this).attr('rel'));
                    mkdfSetIdOnRemoveItem($(this),i+1);
                });
                //hide expand all button if all items are removed
                noPortfolioItemShown();
            });
            return false;
        });

        //hide expand all button if there is no items
        noPortfolioItemShown();
        function noPortfolioItemShown()  {
            if($('.mkdf-portfolio-additional-item').length == 0){
                $('.mkdf-toggle-all-item').hide();
            }
        }

        //expand all additional sidebar items on click on 'expand all' button
        $(document).on('click', '.mkdf-toggle-all-item', function(event) {
            event.preventDefault();
            $('.mkdf-portfolio-additional-item').each(function(i){

                var $toggleContent = $(this).find('.mkdf-portfolio-toggle-content');
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
        $(document).on('click', '.mkdf-portfolio-additional-item .mkdf-portfolio-toggle-holder', function(event) {
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
        $(document).on('click','.mkdf-toggle-all-item', function(event) {
            event.preventDefault();
            $(this).hide();
        })

        function checkExpandAllBtn() {
            if($('.mkdf-portfolio-additional-item .mkdf-portfolio-toggle-content:hidden').length == 0){
                $('.mkdf-toggle-all-item').hide();
            }else{
                $('.mkdf-toggle-all-item').show();
            }
        }

    }

    function mkdfInitPortfolioItemsBox() {
        var mkd_portfolio_additional_item = $('.mkdf-portfolio-additional-item-holder').clone().html();
        $portfolio_item = '<div class="mkdf-portfolio-additional-item" rel="">'+ mkd_portfolio_additional_item +'</div>';

        $('a.mkdf-add-item').click(function (event) {
            event.preventDefault();
            $(this).parent().before($($portfolio_item).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.mkdf-portfolio-additional-item').length;
            $(this).parent().siblings('.mkdf-portfolio-additional-item:last').attr('rel',portfolio_num);
            mkdfSetIdOnAddItem($(this).parent(),portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });
    }

    function mkdfSetIdOnAddItem(addButton,portfolio_num){

        addButton.siblings('.mkdf-portfolio-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name');
            var new_name= name.replace("_x", "[]");
            var new_id = name.replace("_x", "_"+portfolio_num);
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);

        });
    }

    function mkdfSetIdOnRemoveItem(portfolio,portfolio_num){

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



    function mkdInitPortfolioMediaAcc() {
        //remove portfolio media
        $(document).on('click', '.remove-portfolio-media', function(event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300,function() {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.mkdf-portfolio-media').each(function(i){
                    $(this).attr('rel',i+1);
                    $(this).find('.number').text($(this).attr('rel'));
                    mkdfSetIdOnRemoveMedia($(this),i+1);
                });
                //hide expand all button if all medias are removed
                noPortfolioMedia()
            });  return false;
        });

        //hide 'expand all' button if there is no media
        noPortfolioMedia();
        function noPortfolioMedia() {
            if($('.mkdf-portfolio-media').length == 0){
                $('.mkdf-toggle-all-media').hide();
            }
        }

        //expand all portfolio medias (video and images) onClick on 'expand all' button
        $(document).on('click','.mkdf-toggle-all-media', function(event) {
            event.preventDefault();
            $('.mkdf-portfolio-media').each(function(i){

                var $toggleContent = $(this).find('.mkdf-portfolio-toggle-content');
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
        $(document).on('click', '.mkdf-portfolio-media .mkdf-portfolio-toggle-holder', function(event) {
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
        $(document).on('click','.mkdf-toggle-all-media', function(event) {
            event.preventDefault();
            $(this).hide();
        });
        function checkExpandAllMediaBtn() {
            if($('.mkdf-portfolio-media .mkdf-portfolio-toggle-content:hidden').length == 0){
                $('.mkdf-toggle-all-media').hide();
            }else{
                $('.mkdf-toggle-all-media').show();
            }
        }
    }



    function mkdfInitPortfolioImagesVideosBox() {
        var mkdf_portfolio_images = $('.mkdf-hidden-portfolio-images').clone().html();
        $portfolio_image = '<div class="mkdf-portfolio-images mkdf-portfolio-media" rel="">'+ mkdf_portfolio_images +'</div>';
        var mkdf_portfolio_videos = $('.mkdf-hidden-portfolio-videos').clone().html();

        $portfolio_videos = '<div class="mkdf-portfolio-videos mkdf-portfolio-media" rel="">'+ mkdf_portfolio_videos +'</div>';
        $('a.mkdf-add-image').click(function (e) {
            e.preventDefault();
            $(this).parent().before($($portfolio_image).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.mkdf-portfolio-media').length;
            $(this).parent().siblings('.mkdf-portfolio-media:last').attr('rel',portfolio_num);
            mkdfInitMediaUploaderAdded($(this).parent());
            mkdfSetIdOnAddMedia($(this).parent(),portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });

        $('a.mkdf-add-video').click(function (e) {
            e.preventDefault();
            $(this).parent().before($($portfolio_videos).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.mkdf-portfolio-media').length;
            $(this).parent().siblings('.mkdf-portfolio-media:last').attr('rel',portfolio_num);
            mkdfInitMediaUploaderAdded($(this).parent());
            mkdfSetIdOnAddMedia($(this).parent(),portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });

        $(document).on('click', '.mkdf-remove-last-row-media', function(event) {
            event.preventDefault();
            $(this).parent().prev().fadeOut(300,function() {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.mkdf-portfolio-media').each(function(i){
                    $(this).attr('rel',i+1);
                    mkdfSetIdOnRemoveMedia($(this),i+1);
                });
            });

        });
        mkdfShowHidePorfolioImageVideoType();
        $(document).on('change', 'select.mkdf-portfoliovideotype', function(e) {
            mkdfShowHidePorfolioImageVideoType();
        });
    }

    function mkdfSetIdOnAddMedia(addButton,portfolio_num){

        addButton.siblings('.mkdf-portfolio-media:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name');
            var new_name= name.replace("_x", "[]");
            var new_id = name.replace("_x", "_"+portfolio_num);
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);

        });

        mkdfShowHidePorfolioImageVideoType();
    }

    function mkdfSetIdOnRemoveMedia(portfolio,portfolio_num){

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


    function mkdfSetIdOnAddPortfolio(addButton,portfolio_num){

        addButton.siblings('.mkdf_portfolio_image:last').find('input[type="text"], input[type="hidden"], select').each(function(){
            var name = $(this).attr('name');
            var new_name= name.replace("_x", "[]");
            var new_id = name.replace("_x", "_"+portfolio_num);
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);

        });

        mkdfShowHidePorfolioImageVideoType();
    }

    function mkdfSetIdOnRemovePortfolio(portfolio,portfolio_num){

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

    function mkdfShowHidePorfolioImageVideoType(){

        $('.mkdf-portfoliovideotype').each(function(i){

            var $selected = $(this).val();

            if($selected == "self"){
                $(this).parent().parent().parent().find('.mkdf-video-id-holder').hide();
                $(this).parent().parent().parent().parent().find('.mkdf-media-uploader').show();
                $(this).parent().parent().parent().find('.mkdf-video-self-hosted-path-holder').show();
            }else{
                $(this).parent().parent().parent().find('.mkdf-video-id-holder').show();
                $(this).parent().parent().parent().parent().find('.mkdf-media-uploader').hide();
                $(this).parent().parent().parent().find('.mkdf-video-self-hosted-path-holder').hide();
            }
        });
    }

    function mkdfInitMediaUploaderAdded(addButton) {

        addButton.siblings('.mkdf-portfolio-media:last').find('.mkdf-media-uploader').each(function(){
            var fileFrame;
            var uploadUrl;
            var uploadHeight;
            var uploadWidth;
            var uploadImageHolder;
            var attachment;
            var removeButton;

            //set variables values
            uploadUrl           = $(this).find('.mkdf-media-upload-url');
            uploadHeight        = $(this).find('.mkdf-media-upload-height');
            uploadWidth        = $(this).find('.mkdf-media-upload-width');
            uploadImageHolder   = $(this).find('.mkdf-media-image-holder');
            removeButton        = $(this).find('.mkdf-media-remove-btn');

            if (uploadImageHolder.find('img').attr('src') != "") {
                removeButton.show();
                mkdfInitMediaRemoveBtn(removeButton);
            }

            $(this).on('click', '.mkdf-media-upload-btn', function() {
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
                    mkdfInitMediaRemoveBtn(removeButton);
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
                    $('.mkdf-input-change').addClass('yes');
                });

                //open media frame
                fileFrame.open();
            });
        });

        function mkdfInitMediaRemoveBtn(btn) {
            btn.on('click', function() {
                //remove image src and hide it's holder
                btn.siblings('.mkdf-media-image-holder').hide();
                btn.siblings('.mkdf-media-image-holder').find('img').attr('src', '');

                //reset meta fields
                btn.siblings('.mkdf-media-meta-fields').find('input[type="hidden"]').each(function(e) {
                    $(this).val('');
                });

                btn.hide();
            });
        }
    }

    function mkdfInitAjaxForm() {
        $('#mkd_top_save_button').click( function() {
            $('.mkd_ajax_form').submit();
            if ($('.mkdf-input-change.yes').length) {
                $('.mkdf-input-change.yes').removeClass('yes');
            }
            $('.mkdf-changes-saved').addClass('yes');
            setTimeout(function(){$('.mkdf-changes-saved').removeClass('yes');}, 3000);
            return false;
        });
        $(document).delegate(".mkd_ajax_form", "submit", function (a) {
            var b = $(this);
            var c = {
                action: "hashmag_mikado_save_options"
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

    function mkdfInitDatePicker() {
        $( ".mkdf-input.datepicker" ).datepicker( { dateFormat: "MM dd, yy" });
    }
    function mkdfInitSelectPicker() {
        $(".mkdf-selectpicker").selectpicker();
    }

	function mkdfShowHidePostFormats(){
        $('input[name="post_format"]').each(function(){
            var id = $(this).attr('id');
            if(id !== '' && id !== undefined) {
                var metaboxName = id.replace(/-/g, '_');
                $('#mkdf-meta-box-'+ metaboxName +'_meta').hide();
            }
        });
        
        var selectedId = $("input[name='post_format']:checked").attr("id");
        if(selectedId !== '' && selectedId !== undefined) {
            var selected = selectedId.replace(/-/g, '_');
            $('#mkdf-meta-box-' + selected + '_meta').fadeIn();
        }

        $("input[name='post_format']").change(function() {
            mkdfShowHidePostFormats();
        });
	}

    function mkdfPageTemplatesMetaBoxDependency(){
        if($('#page_template').length) {
            var selected = $('#page_template').val();
            var template_name_parts = selected.split("-");

            if (template_name_parts[0] !== 'blog') {
                $('#mkdf-meta-box-blog-meta').hide();
            } else {
                $('#mkdf-meta-box-blog-meta').show();
            }
            $('select[name="page_template"]').change(function () {
                mkdfPageTemplatesMetaBoxDependency();
            });
        }
    }
	
})(jQuery);

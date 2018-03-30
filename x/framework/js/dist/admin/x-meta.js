// =============================================================================
// JS/ADMIN/X-META.JS
// -----------------------------------------------------------------------------
// Meta box functionality.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Meta Box Functionality
// =============================================================================

// Meta Box Functionality
// =============================================================================

jQuery(document).ready(function($) {

  //
  // Posts.
  //

  var quoteOptions    = $('#x-meta-box-quote');
  var quoteTrigger    = $('#post-format-quote');

  var linkOptions     = $('#x-meta-box-link');
  var linkTrigger     = $('#post-format-link');

  var audioOptions    = $('#x-meta-box-audio');
  var audioTrigger    = $('#post-format-audio');

  var videoOptions    = $('#x-meta-box-video');
  var videoTrigger    = $('#post-format-video');

  var postFormatGroup = $('#post-formats-select input');

  xHideAll(null);

  postFormatGroup.change( function() {
    xHideAll(null);
    if ($(this).val() == 'quote') {
      quoteOptions.css('display', 'block');
    } else if ($(this).val() == 'link') {
      linkOptions.css('display', 'block');
    } else if ($(this).val() == 'audio') {
      audioOptions.css('display', 'block');
    } else if ($(this).val() == 'video') {
      videoOptions.css('display', 'block');
    }
  });

  if (quoteTrigger.is(':checked'))
    quoteOptions.css('display', 'block');

  if (linkTrigger.is(':checked'))
    linkOptions.css('display', 'block');

  if (audioTrigger.is(':checked'))
    audioOptions.css('display', 'block');

  if (videoTrigger.is(':checked'))
    videoOptions.css('display', 'block');

  function xHideAll(notThisOne) {
    videoOptions.css('display', 'none');
    quoteOptions.css('display', 'none');
    linkOptions.css('display', 'none');
    audioOptions.css('display', 'none');
  }


  //
  // Pages.
  //

  var pageTemplateGroup = $('#page_template');


  //
  // Page - Icon settings.
  //

  var iconOptions = $('#x-meta-box-page-icon');
  var iconTrigger = $('#page_template option[value*="template-blank"]');

  if ( iconTrigger.is(':checked') ) {
    iconOptions.css('display', 'block');
  } else {
    iconOptions.css('display', 'none');
  }

  pageTemplateGroup.change( function() {
    if ( iconTrigger.is(':checked') ) {
      iconOptions.css('display', 'block');
    } else {
      iconOptions.css('display', 'none');
    }
  });


  //
  // Page - portfolio settings.
  //

  var portfolioOptions = $('#x-meta-box-portfolio');
  var portfolioTrigger = $('#page_template option[value="template-layout-portfolio.php"]');

  if ( portfolioTrigger.is(':checked') ) {
    portfolioOptions.css('display', 'block');
  } else {
    portfolioOptions.css('display', 'none');
  }

  pageTemplateGroup.change( function() {
    if ( portfolioTrigger.is(':checked') ) {
      portfolioOptions.css('display', 'block');
    } else {
      portfolioOptions.css('display', 'none');
    }
  });


  //
  // Page - slider above settings.
  //

  var $sliderAboveDropdown            = $('#_x_slider_above');
  var $sliderAboveDropdownRowSiblings = $sliderAboveDropdown.parents('tr').siblings();

  if ( $('#_x_slider_above option:selected').text() === 'Deactivated' ) {
    $sliderAboveDropdownRowSiblings.css('display', 'none');
  }

  $sliderAboveDropdown.change( function() {
    if ( $('#_x_slider_above option:selected').text() === 'Deactivated' ) {
      $sliderAboveDropdownRowSiblings.css('display', 'none');
    } else {
      $sliderAboveDropdownRowSiblings.css('display', 'table-row');
    }
  });


  //
  // Page - slider below settings.
  //

  var $sliderBelowDropdown            = $('#_x_slider_below');
  var $sliderBelowDropdownRowSiblings = $sliderBelowDropdown.parents('tr').siblings();

  if ( $('#_x_slider_below option:selected').text() === 'Deactivated' ) {
    $sliderBelowDropdownRowSiblings.css('display', 'none');
  }

  $sliderBelowDropdown.change( function() {
    if ( $('#_x_slider_below option:selected').text() === 'Deactivated' ) {
      $sliderBelowDropdownRowSiblings.css('display', 'none');
    } else {
      $sliderBelowDropdownRowSiblings.css('display', 'table-row');
    }
  });


  //
  // Portfolio item - video.
  //

  var $portfolioItemVideoSettings = $('#x-meta-box-portfolio-item-video');

  if ( ! $('input[name*="_x_portfolio_media"][value="Video"]').is(':checked') ) {
    $portfolioItemVideoSettings.css('display', 'none');
  }

  $('input[name*="_x_portfolio_media"]' ).change( function() {
    if ( ! $('input[name*="_x_portfolio_media"][value="Video"]').is(':checked') ) {
      $portfolioItemVideoSettings.css('display', 'none');
    } else {
      $portfolioItemVideoSettings.css('display', 'block');
    }
  });


  //
  // WordPress color picker.
  //

  $('.wp-color-picker').wpColorPicker();

});
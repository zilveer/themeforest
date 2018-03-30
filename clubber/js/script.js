(function ($) {

  $(document)
    .ready(function () {
	
    $(".photo-preview img")
      .fadeTo(1, 1);
    $(".photo-preview img")
      .hover(

    function () {
      $(this)
        .fadeTo("fast", 0.70);
    }, function () {
      $(this)
        .fadeTo("slow", 1);
    });

    $(".flickr_badge_image img")
      .fadeTo(1, 1);
    $(".flickr_badge_image img")
      .hover(

    function () {
      $(this)
        .fadeTo("fast", 0.70);
    }, function () {
      $(this)
        .fadeTo("slow", 1);
    });
	
	// -------------------------------------------------------------------------------------------------------
    // Mosaic
    // -------------------------------------------------------------------------------------------------------

    $('.bar-photo')
      .mosaic({
      animation: 'slide',
      speed: 300
    });

    $('.bar-arc-photo')
      .mosaic({
      animation: 'slide',
      speed: 300
    });

    $('.bar-arc-audio')
      .mosaic({
      animation: 'slide',
      speed: 300
    });

    $('.bar-arc-video')
      .mosaic({
      animation: 'slide',
      speed: 300
    });

    $('.bar-home-photo')
      .mosaic({
      animation: 'slide',
      speed: 300
    });

    $('.bar-home-video')
      .mosaic({
      animation: 'slide',
      speed: 300
    });

    $('.bar-home-audio')
      .mosaic({
      animation: 'slide',
      speed: 300
    });


    $('.bar-home-audio')
      .mosaic({
      animation: 'slide',
      speed: 300
    });

    $('.bar-widget-photo')
      .mosaic({
      animation: 'slide',
      speed: 300
    });

    $('.bar-widget-video')
      .mosaic({
      animation: 'slide',
      speed: 300
    });	
	
    // -------------------------------------------------------------------------------------------------------
    // Tabs
    // -------------------------------------------------------------------------------------------------------

    $("#tabs ul")
      .idTabs();
	
	// -------------------------------------------------------------------------------------------------------
    // Toggle
    // -------------------------------------------------------------------------------------------------------

    $("#tabs ul")
      .idTabs();
    $(".toggle_container")
      .hide();
    $(".trigger")
      .click(function () {
      jQuery(this)
        .toggleClass("active")
        .next()
        .slideToggle("fast");
      return false; //Prevent the browser jump to the link anchor
    });
	
	// -------------------------------------------------------------------------------------------------------
    // Fixed DIV
    // -------------------------------------------------------------------------------------------------------

    jQuery(document)
      .ready(function () {
      jQuery('.event-widgets:last')
        .addClass('last');
      jQuery('.video-widget-cover:last')
        .addClass('last');
      jQuery('.home-post:last')
        .addClass('last');
      jQuery('.widget:last')
        .addClass('last');
    });
	
});

})(window.jQuery);
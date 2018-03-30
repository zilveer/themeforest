(function ($) {

  $(document)
    .ready(function () {
	
	// -------------------------------------------------------------------------------------------------------
    // First Word
    // -------------------------------------------------------------------------------------------------------

	 $('.title-page h1')
      .each(function () {
      var h = $(this)
        .html();
      var index = h.indexOf(' ');
      if (index == -1) {
        index = h.length;
      }
      $(this)
        .html('<span style="color:#fff; font-weight:300;">' + h.substring(0, index) + '</span>' + h.substring(index, h.length));
    });
	
	 $('.sidebarnav h3')
      .each(function () {
      var h = $(this)
        .html();
      var index = h.indexOf(' ');
      if (index == -1) {
        index = h.length;
      }
      $(this)
        .html('<span style="color:#fff; font-weight:300;">' + h.substring(0, index) + '</span>' + h.substring(index, h.length));
    });
	
    $('.title-home h3')
      .each(function () {
      var h = $(this)
        .html();
      var index = h.indexOf(' ');
      if (index == -1) {
        index = h.length;
      }
      $(this)
        .html('<span style="color:#fff; font-weight:300;">' + h.substring(0, index) + '</span>' + h.substring(index, h.length));
    });
	
		 $('.title-head h1')
      .each(function () {
      var h = $(this)
        .html();
      var index = h.indexOf(' ');
      if (index == -1) {
        index = h.length;
      }
      $(this)
        .html('<span style="color:#fff; font-weight:300;">' + h.substring(0, index) + '</span>' + h.substring(index, h.length));
    });
	

	
	});

})(window.jQuery);
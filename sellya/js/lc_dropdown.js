jQuery( function($) {
 // Animation for the languages and currency dropdown
  $('.dropdown_l').hover(function() {
    $(this).find('.options_l').stop(true, true).slideDown('fast');
  },function() {
    $(this).find('.options_l').stop(true, true).slideUp('fast');
  });
  });
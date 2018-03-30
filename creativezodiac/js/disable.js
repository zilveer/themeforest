/**
 * Enables/Disables text selection, saves selected text
 *   
 * @example jQuery('p').enableTextSelect(); / jQuery('#selectable-area').disableTextSelec();
 * @cat plugin
 * @type jQuery 
 *
 */
jQuery.fn.disableTextSelect = function() {
  return this.each(function() {
    j(this).css({
      'MozUserSelect' : 'none'
    }).bind('selectstart', function() {
      return false;
    }).mousedown(function() {
      return false;
    });
  });
};

jQuery.fn.enableTextSelect = function() {
  return this.each(function() {
    j(this).css({
      'MozUserSelect':''
    }).unbind('selectstart').mousedown(function() {
      return true;
    });
  });
};

j(function() {
  if(Drupal.settings.jquery_textselection_selector) {
    j(Drupal.settings.jquery_textselection_selector).disableTextSelect();
  }
});
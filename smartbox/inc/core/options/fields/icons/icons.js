jQuery(document).ready(function($) {
    var $iconContainer = $( '.icon-container' );
    var $hiddenField = $iconContainer.next();
    // set icon class on click
    $iconContainer.find( 'li' ).click( function() {
        $iconContainer.find( 'li' ).removeClass('active');
        $(this).addClass('active');
        $hiddenField.val( $(this).find('i').attr('class') ).trigger('change');
    });
});
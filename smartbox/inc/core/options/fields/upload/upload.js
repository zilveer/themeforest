jQuery(document).ready(function($) {
    // set image button
    $( 'body' ).on( 'click', '.oxy-set-image', function() {
        tb_show('', 'media-upload.php?type=image&amp;oxy_upload_to_option=true&amp;input_id=' + $(this).prev().attr('id') + '&amp;post_id=0&amp;TB_iframe=true');
        return false;
    });

    // remove image option
    $( 'body' ).on( 'click', '.oxy-remove-image', function() {
        var $removeImageBut = $(this);
        var $setImageBut = $removeImageBut.prev();
        var $imageInput = $setImageBut.prev();
            // remove url from input
            $imageInput.val( '' );
            // remove image src and hide preview
            $imageInput.prev().attr('src','').hide();
            // swap buttons
            $setImageBut.toggle();
            $removeImageBut.toggle();
    });

});

// called when user selects image from media uploader
function updateImageOption( inputID, url, postID ) {
    var $input = jQuery( '#' + inputID )
    var $setImageBut = $input.next();
    var $removeImageBut = $setImageBut.next();
    // set input value
    switch( $input.attr( 'data-store' ) ) {
        case 'url':
            $input.val( url );
        break;
        case 'id':
            $input.val( postID );
        break;
    }
    // set preview image
    $input.prev().attr( 'src', url ).show();
    // swap set / remove buttons
    $setImageBut.toggle();
    $removeImageBut.toggle();
}
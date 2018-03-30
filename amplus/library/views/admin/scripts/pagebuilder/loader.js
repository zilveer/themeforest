jQuery(function ($) {
    
    $('.wp-editor-tools').each(function() {
        // only use pagebuilder for the main content editor and 
        // translation content editors
        if ($(this).parents('.bfi-pagebuilder-dialog').length == 0 
            && ($(this).parents('[id=post-body]').length > 0 
            || $(this).parents('[id^=bfi_][id*=_lang_]').length > 0)) {
            $(this)
            .find('.wp-switch-editor')
            .click(function () {
                var $$ = $(this);
        
                $(this).parent().siblings('[id*=content-editor-container]').show();
                $(this).parent().parent().siblings('[id=post-status-info]').show();
                $(this).parent().siblings('[id=bfi-pagebuilder-panels]').hide();
                $(this).parents('.wp-editor-wrap').removeClass('panels-active');
        
                $(this).parent().siblings('[id=content-resize-handle]').show();
            } ).end()
            .prepend(
                $('<a id="content-pagebuilder" class="hide-if-no-js wp-switch-editor switch-panels">Page Builder</a>')
                    .click( function () {
                        var $$ = $( this );
                        // This is so the inactive tabs don't show as active
                        $(this).parents('.wp-editor-wrap').removeClass('tmce-active html-active');

                        // Hide all the standard content editor stuff
                        $(this).parent().siblings('[id*=content-editor-container]').hide();
                        $(this).parent().parent().siblings('[id=post-status-info]').hide();
                

                        // Show panels and the inside div
                        $(this).parent().siblings('[id=bfi-pagebuilder-panels]').show().find('> .inside').show();
                        $(this).parents('.wp-editor-wrap').addClass('panels-active');

                        // Triggers full refresh
                        $( window ).resize();
                        $(this).parent().siblings('[id=content-resize-handle]').hide();

                        return false;
                    } )
            );
        }
    });
    
    // Move the panels box into a tab of the content editor
    
    // clone for other languages
    if ($('.wp-editor-tools').length > 1) {
        $( '#bfi-pagebuilder-panels' ).clone()
            .insertAfter('.wp-editor-container[id*=lang]')
            .addClass('wp-editor-container')
            .hide()
            .find('.handlediv').remove();
    }
    
    // clone for main content
    $( '#bfi-pagebuilder-panels' ).clone()
        .insertAfter( '#wp-content-editor-container' )
        .addClass( 'wp-editor-container' )
        .hide()
        .find( '.handlediv' ).remove();
        
    $('[id=bfi-pagebuilder-panels]:last').remove();

    $('[id=content-pagebuilder]').click();
    
    vtip();
});
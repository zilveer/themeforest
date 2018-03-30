

(function ($) {

	"use strict";

    function reloadChosen() {
        $("select").removeClass("chzn-done").css('display', 'inline').data('chosen', null);
        $("*[class*=chzn]").remove();
        $('.chosen').chosen();
    }

    function reloadTinyMCE() {
        var i, t = tinyMCE.editors;
        for (i in t){
            if (t.hasOwnProperty(i)){
                t[i].remove();
            }
        }

        $('.wp-editor-area').each( function() {
            tinyMCE.execCommand('mceAddControl', false, $(this).attr('id'));
        });

    }

    // we create a copy of the WP inline edit post function
    var wp_inline_edit = inlineEditPost.edit;
    // and then we overwrite the function with our own code
    inlineEditPost.edit = function(id) {
        // "call" the original WP edit function
        // we don't want to leave WordPress hanging
        wp_inline_edit.apply(this, arguments);

        var post_id = parseInt( this.getId( id ) );
        var ait_meta_hidden = $('#inline-ait-' + post_id);
        if (ait_meta_hidden.length) {
            $('#edit-' + post_id).find('.ait-meta').replaceWith(ait_meta_hidden.html());
            ait_meta_hidden.remove();
            reloadChosen();
            reloadTinyMCE();
        }
    };

})(jQuery);


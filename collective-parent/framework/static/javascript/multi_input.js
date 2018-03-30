jQuery(document).ready(function(){
    var $wrappers = jQuery('.tf-interface-option');

    $wrappers.on('click', '.tf_opt_multiple_add_btn', function(){
        var content=jQuery(this).siblings('.tf_opt_multiple_content');
        var input_row=content.find('.tf_opt_multiple_input_row').first().clone(true).append('<a href="" class="tf_opt_multiple_remove_btn"></a>');
        input_row.find('input,textarea').val('');
        content.append(input_row);
        return false;
    });

    $wrappers.on('click', '.tf_opt_multiple_remove_btn', function(){
        jQuery(this).closest(input_row_class).remove();
        return false;
    });
});
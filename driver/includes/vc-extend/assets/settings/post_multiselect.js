!function($) {
    $('.post_multiselect_block select, .taxonomy_multiselect_block select').change(function(e){
        e.preventDefault();
        var value = $(this).val();
		var name = $(this).data('name');
        var $input = $(this).parent().find('input[type="hidden"]');
        
        $input.val(value)
    });
}(window.jQuery);
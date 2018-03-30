(function ($) {
    $('.wpb_el_type_from_vs_indicatior').hide();
    $('.custom_posts_list_items .custom_posts_list').click(function(e){

        var $this = $(this),
            $input = $this.parents('.wpb_el_type_custom_posts_list').find('.custom_posts_list_field'),
            arr = $input.val().split(',');

        if ( $this.is(':checked') ) {

            arr.push($this.val());

            var emptyKey = arr.indexOf("");
            if ( emptyKey > -1 ) {
                arr.splice(emptyKey, 1);
            }
        } else {

            var foundKey = arr.indexOf($this.val());

            if ( foundKey > -1 ) {
                arr.splice(foundKey, 1);
            }
        }

        $input.val(arr.join(','));
    });

        // dt_taxonomy param
    $('.custom_taxonomy_list_items .custom_taxonomy_list').click(function(e){

        var $this = $(this),
            $input = $this.parents('.wpb_el_type_custom_taxonomy_list').find('.custom_taxonomy_list_field'),
            arr = $input.val().split(',');

        if ( $this.is(':checked') ) {
            arr.push($this.val());
            var emptyKey = arr.indexOf("");
            if ( emptyKey > -1 ) {
                arr.splice(emptyKey, 1);
            }
        } else {
            var foundKey = arr.indexOf($this.val());
            if ( foundKey > -1 ) {
                arr.splice(foundKey, 1);
            }
        }
        $input.val(arr.join(','));
    });
})(window.jQuery);
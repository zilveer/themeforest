(function ( $ ) {
    "use strict";

    $(function () {

        $('.ot-google-fonts-ajax').bind('change', function() {
            var name = $(this).val(),
            fontfamily = $(this).parent().parent().find('.ot-google-library-ajax').val(),
            wrapper = $(this).parent().next(),
            id = $(this).parent().parent().attr('id');
            $(this).parent().after("<span class='loading'>Loading</span>")
            wrapper.fadeOut();
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType:'html',
                data: {
                    action: 'ot_load_fonts',
                    name: name,
                    family : fontfamily,
                    id : id
                },
                success:function(res) {
                    $('.loading').remove();
                    wrapper.html(res).fadeIn();
                }
            });
        });

        $(document).on('click', '.option-tree-font-remove', function(event) {
            event.preventDefault();
            var agree = confirm(option_tree.remove_agree);
            if (agree) {
              $(this).parent().parent().remove();
          }
          return false;
      });

        $('#ot-google-fonts-save').bind('click', function(e){
            e.preventDefault();
            var fontname = $('#trizzy_font').find('#trizzy_font-font-family').val();
            var variants = [];
            $("#variants input:checkbox:checked").map(function(){
                variants.push($(this).val());
            });
            var subsets = [];
            $("#subsets input:checkbox:checked").map(function(){
                subsets.push($(this).val());
            });
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType:'html',
                data: {
                    action: 'ot_save_fonts',
                    fontname: fontname,
                    variants : variants,
                    subsets : subsets
                },
                success:function(res) {
                    $('.loading').remove();
                    $('#ot-saved-fonts').append(res).fadeIn();
                }
            });

        })

        $('.ot-font-family-select').bind('change', function(e){
            var fontname = $(this).val();
            var fontweightselect = $(this).parent().parent().find('.ot-font-weight-select')
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType:'html',
                data: {
                    action: 'ot_check_font_weight',
                    fontname: fontname,
                },
                success:function(res) {
                    $('.loading').remove();
                    fontweightselect.html(res);
                }
            });
        })

    });

}(jQuery));
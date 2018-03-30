/**
 * Backend JS for crum_font_container_param - parameter
 */

(function ($) {


    vc.atts.crumina_font_container = {
        parse: function (param) {
            var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
            var $block = $field.parent();
            var options = {},
                string_pieces,
                string;
            options.tag = $block.find('.vc_font_container_form_field-tag-select > option:selected').val();
            options.font_size = $block.find('.vc_font_container_form_field-font_size-input').val();
            options.text_align = $block.find('.vc_font_container_form_field-text_align-select > option:selected').val();
            options.font_family = $block.find('.vc_font_container_form_field-font_family-select > option:selected').val();
            options.color = $block.find('.field-color-result').val();
            options.line_height = $block.find('.vc_font_container_form_field-line_height-input').val();
            options.letter_spacing = $block.find('.vc_font_container_form_field-letter_spacing-input').val();
            options.font_style_italic = $block.find('.vc_font_container_form_field-font_style-checkbox.italic').prop('checked') ? "1" : "";
            options.font_style_bold = $block.find('.vc_font_container_form_field-font_style-checkbox.bold').prop('checked') ? "1" : "";
            options.font_style_underline = $block.find('.vc_font_container_form_field-font_style-checkbox.underline').prop('checked') ? "1" : "";
            string_pieces = _.map(options, function (value, key) {
                if (_.isString(value) && 0 < value.length) {
                    return key + ':' + encodeURIComponent(value);
                }
            });
            string = $.grep(string_pieces, function (value) {
                return _.isString(value) && 0 < value.length;
            }).join('|');
            return string;
        },
        init: function (param, $field) {
            $field.find(".vc_font_container_form_field-color-input").wpColorPicker({
                palettes:   true,
                change:		function( event, ui ) {
                    var hexcolor = $( this ).wpColorPicker( 'color' );
                    $field.find(".field-color-result").val(hexcolor);
                },
                clear: function() {
                    $field.find(".field-color-result").val('');
                }
            });
            $field.find(".vc_font_container_form_field-font_family-select").chosen({
                disable_search_threshold: 10,
                inherit_select_classes: true,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        }
    };

    vc.atts.radio_image_select = {
        render: function ( param, value ) {
            return value;
        },
        init: function ( param, $field ) {

            $field.find( '.wpb_vc_param_value' ).imagepicker();
        }
    };

})(window.jQuery);
jQuery(document).ready(function($) {
    $('.slider-option').each(function() {
        var $input = $(this);
        var $slider = $input.prev();
        // create slider
        $slider.slider({
            'min' : parseFloat( $input.attr('min') ),
            'max' : parseFloat( $input.attr('max') ),
            'step' : parseFloat( $input.attr('step') ),
            'value' : parseFloat( $input.val() )
        });
        // change input when slider slides
        $slider.bind('slide',function(e, ui) {
            $input.val( ui.value ).trigger( 'change' );
        });
        // move slider with input & check input does not go beyond bounries
        $input.blur(function() {
            // check within limits
            var val = $input.val();
            if( val > $slider.slider('option', 'max') ) {
                val = $slider.slider('option', 'max');
            }
            if( val < $slider.slider('option', 'min') ) {
                val = $slider.slider('option', 'min');
            }
            // set slider to new value
            $slider.slider('value', val);
            // set input to new value (if not in limits)
            $input.val(val);
        });
    });
});
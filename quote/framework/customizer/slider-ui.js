(function($){
    var api = wp.customize;

    api.SliderControl = api.Control.extend({ 
        ready: function() {
            var control = this,
                picker = this.container.find('.slider');

            picker.val(control.setting()).slider({
			    min: 960, // min value
			    max: 1140, // max value
			    step: 10,
			    value: 800,
                change: function(event, ui){ 
                    control.setting.set(ui.value);
                    jQuery( ".slider-input" ).val(jQuery( ".slider" ).slider( "value" ) );
                }               
            });
            jQuery( ".slider-input" ).val(jQuery( ".slider" ).slider( "value" ) );
        }
    });

    api.controlConstructor['slider'] = api.SliderControl;   
    })(jQuery);


(function($){
    $(document).on("click", "a.viewicons", function(){
        $('#icon-selector').slideToggle('slow');
    });

    $('a.viewicons').click(function() {
        $(this).closest('.control-section').addClass('tbopen');
    })

    $('.an-icon').click(function() {
        var icon =  $(this).next().text();
        $('.tbopen #customize-control-headline_icon input').val($(this).val()+icon);
        $('#icon-selector').slideToggle('slow');
        $('.control-section').removeClass('tbopen');
    });
})(jQuery);
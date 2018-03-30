jQuery(document).ready(function($){
    //Checkbox change function
    function change_checkbox( c ){
        t = $(c);
        v = (t.prop('checked')) ? 'yes' : 'no';

        t.prev('input[type="hidden"]')
            .val( v )
            .change();
    }

    $('input[type="checkbox"]').click(function(e){
        change_checkbox( this );
    });
    $('input[type="checkbox"]').change(function(e){
        change_checkbox( this );
    });

    $('input[type="checkbox"]').each( function(i, v){
        change_checkbox( v );
    } );

    //Checklist change function
    $('.checklist-options').change(function(){
        var input_value = $(this).parent().siblings('input.checklist-value');
        var checkbox = $(this).parent().siblings('label').find('input[type="checkbox"]');
        checkbox = checkbox.add( $(this) );

        input_value.val('');

        checkbox.each( function( i, v ){
            var t = $(v);

            if(t.prop('checked')){
                input_value.val( input_value.val() + t.val() + ', ' );
            }
        } )

        input_value.change();
    })

    //Select & multiple select change function
    var select_value = function() {
        var multiple = $(this).attr('multiple');
        var value = '';
        var imploded_string = '';

        $(this).children("option:selected").each(function(i,v){
            if( i != 0 && multiple ){
                value += ', ';
                imploded_string += ',';
            }

            value += $(v).text();
            imploded_string += $(v).val();
        });

        if( value == '' ){
            $(this).children().children("option:selected").each(function(i,v){
                if( i != 0 && multiple){
                    value += ', ';
                    imploded_string += ',';
                }

                value += $(v).text();
                imploded_string += $(v).val();
            });
        }

        if( multiple ){
            if ( $(this).parent().find('span').length <= 0 ) {
                $(this).before('<span></span>');
            }

            $(this).parent().children('span').html(value);
        }

        $(this).parent().children('input.select-value').val(imploded_string);

        $(this).parent().children('input.select-value').change();
    }

    $('.select_wrapper select').each(select_value);
    $('.select_wrapper select').on('change', select_value);

    //Open select multiple
    var multiple_select_handler = function(){
        //Clears previous events
        $('.select_wrapper').off( 'click' );

        $('.select_wrapper').click( function(e){
            e.stopPropagation();
            $(this).find('select[multiple]').toggle();
            $(this).toggleClass('focus');
        });
        //Stops click propagation on select, to prevent select hide
        $('.select_wrapper select[multiple]').click( function(e){
            e.stopPropagation();
        });
        //Hides select on window click
        $(window).click(function(){
            $('select[multiple]').hide();
            $('select[multiple]').parent('.select_wrapper').removeClass('focus');
        })
    };

    multiple_select_handler();


})
jQuery(document).ready(function($) {
    
    if ($('.check_user_edit:checked').length > 0) {
        clickCheckName = $('.check_user_edit:checked').attr('name');
      
        $('.check_user_edit').each(function() {
            if (clickCheckName !== $(this).attr('name')) {
                $(this).attr('disabled', 'disabled');
            }
        });
    }
    
    $('.rating_setting').delegate('.check_user_edit',
        'click',
        function() {
            clickCheckName = $(this).attr('name');
            if (($(this).is(':checked'))) {
                $('.check_user_edit').each(function() {
                    if (clickCheckName !== $(this).attr('name')) {
                        $(this).attr('disabled', 'disabled');
                    }
                });
            } else {
                $('.check_user_edit').each(function() {
                    if (clickCheckName !== $(this).attr('name')) {
                        $(this).removeAttr('disabled');
                    }
                });    
            }
        });
    

    $('.add_new_input').click(function() {
        var newId = parseInt($(this).parent().find('input').last().attr('data-id'));
        newId++;
        var newName = $(this).find('.info_holder').find('.option_name').html();
		
        var newInput = '';
        newInput += '<div class="input-holder">';
        newInput += '<input data-id="'+newId+'" type="text" name="' + newName + '[' + newId + ']' +'" id="' + newName + '" value="">';
        newInput += '<div class="remove">REMOVE</div>';
        newInput += '</div>';
		
		
        $(this).parent().find('.input-holder').last().after( newInput );
    });
	
    $('.input-holder').find('.remove').click(function() {
        $(this).parents('.input-holder').remove();
    });
	
	
    function _getMultiId( name, id1, id2 ) {
        var newName = name + '[' + id1 + ']';
        if( id2 != null )
            newName += '[' + id2 + ']';
        return newName;
    }
	
	
    $('.add_new_rating').click(function() {
        $option = $(this).parents('.post_settings_item');
        $lastRating = $option.find('.one_post_rating').last();
		
        $actualOption = $lastRating.find('.actual_option_id').html();
        $actualId = parseInt( $lastRating.find('.actual_id').html() ) + 1;
		
        var nr = '';
        nr += '<div class="one_post_rating">';
        nr += '<div style="display:none;" class="actual_option_id">' + $actualOption + '</div>';
        nr += '<div style="display:none;" class="actual_id">' + $actualId +  '</div>';
        nr += '<input placeholder="Rating name" type="text" data-name="name" name="' + _getMultiId( $actualOption, $actualId, 'name') +'" id="'+ _getMultiId( $actualOption, $actualId, 'name') +'" >';
        nr += '<input placeholder="Own rating" class="own_rating" type="text" data-name="score" name="'+ _getMultiId( $actualOption, $actualId, 'score') +'" id="'+ _getMultiId( $actualOption, $actualId, 'score') +'" >';
        nr += '<input placeholder="Count voted" class="voted" type="text" data-name="voted" name="'+ _getMultiId( $actualOption, $actualId, 'voted') +'" id="'+ _getMultiId( $actualOption, $actualId, 'voted') +'" >';
        //nr += '<input type="checkbox" class="check_user_edit" data-name="useredit" name="'+ _getMultiId( $actualOption, $actualId, 'useredit') +'" id="'+ _getMultiId( $actualOption, $actualId, 'useredit') +'" >User editable';
        nr += '<span title="Delete" class="remove"></span>';
        nr += '</div>';
		
        $lastRating.after(nr);
        
        
        if ($('.check_user_edit:checked').length > 0) {
            clickCheckName = $('.check_user_edit:checked').attr('name');
            
            $('.check_user_edit').each(function() {
                if (clickCheckName !== $(this).attr('name')) {
                    $(this).attr('disabled', 'disabled');
                }
            });
        }
    $(".one_post_rating").delegate(".remove", "click", function(){
   
        $(this).parents('.one_post_rating').remove();
    });  
    
    });
	$(".one_post_rating").delegate(".remove", "click", function(){
   
        $(this).parents('.one_post_rating').remove();
    });    
    
    /*--------------------------------------------------------------------------
     * Check input score data 
     *------------------------------------------------------------------------*/
    var oldValue = 0
    $('.jw-rating-admin-score').keydown(function() {
        oldValue = parseFloat($(this).val());
    });
    
    $('.jw-rating-admin-score').keyup(function() {
        if ($(this).val() < 0 || $(this).val() > 1) {
            $(this).val(parseFloat(oldValue));
            alert("Hodnoceni musi byt cislo mezi 0 - 1");
        }
    });
    
    $(".jw-rating-admin-score").keypress(function (e){
        
        if( e.which!=8 && e.which!=0 && (e.which<44 || e.which>57 )){
            return false;
        } else {
            return true;
        }
    });
    
    
	
});
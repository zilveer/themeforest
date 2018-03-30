jQuery(document).ready(function($) {
	"use strict";
    var icon_field;

	$('#mnky-generator ul.icons-list li').each(function() {
		var $self = $(this);
		var selected = $self.hasClass('crdash-wine_alt') ? 'checked' : '';
		var $class = $self.find('i').attr('class');
		var $label = $self.find('label');
		var $icon = $self.find('i').clone();
		$self.prepend('<input name="name" type="radio" value="'+$class+'" id="'+$class+'" '+selected+'>').find('i').remove();
		$label.html('').attr('for', $class).append($icon);
	});
	

    // Custom popup box
    $(document).on('click', '.crum-icon-add', function(evt){

        icon_field = $(this).siblings('.iconname');

        $("#mnky-generator-wrap, #mnky-generator-overlay").show();
		$('.ui-dialog').hide();
		
        $('#mnky-generator-insert').on('click', function(event) {
			
            $('.mnky-generator-icon-select input:checked').addClass("mnky-generator-attr");
            $('.mnky-generator-icon-select input:not(:checked)').removeClass("mnky-generator-attr");


            var icon_name = $('.mnky-generator-icon-select input:checked').val();

            icon_field.val(icon_name);


            $(icon_field).parents('.metro-menu-item').find('.tile-icon').addClass(icon_name);


			$('.ui-dialog').show();
            $("#mnky-generator-wrap, #mnky-generator-overlay").hide();


            // Prevent default action
            event.preventDefault();

            return false;
        });

        return false;
    });

	$(document).on('click', '#mnky-generator-close', function(evt){
		$("#mnky-generator-wrap, #mnky-generator-overlay").hide();
		$('.ui-dialog').show();
        return false;
    });

    // Icon pack select
	$(document).on('change', '#mnky-generator-select-pack', function(){
		$('ul.ul-icon-list').hide();
		$('ul.'+ $(this).val()).show();
	});


});
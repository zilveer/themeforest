/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Script for Widgets in Admin Panel
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function() { 
	(function ($) { 
        $(document).delegate('.cmsmasters_icon_list li a.click_img', 'click', function () { 
            $(this).closest('ul').find('.current_icon').removeClass('current_icon');
			
			
            $(this).closest('li').addClass('current_icon');
			
			
            $(this).closest('div').prev().find('input[type="hidden"]').val($(this).attr('href'));
			
			
			return false;
        } );
	} )(jQuery);
} );


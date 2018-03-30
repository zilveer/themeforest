/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


jQuery(document).ready( function($){
    "use strict";

    if ( $.fn.owlCarousel ) {
        $( '.owl-slider').each( function(){
            var slider = $(this);

            $(this).owlCarousel({
                singleItem     : slider.data('singleitem'),
                pagination     : slider.data('pagination'),
                navigation     : slider.data('navigation'),
                navigationText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                slideSpeed     : slider.data('slidespeed'),
                paginationSpeed: slider.data('paginationspeed'),
                autoPlay       : slider.data('autoplay')
            });

            slider.removeClass('hide-elem');
        });
    }

});
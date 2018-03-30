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
                items           : 1,
                singleItem      : slider.data('singleitem'),
                pagination      : slider.data('pagination'),
                nav             : slider.data('navigation'),
                navText         : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                slideSpeed      : slider.data('slidespeed'),
                paginationSpeed : slider.data('paginationspeed'),
                autoplay        : slider.data('autoplay'),
                loop            : true ,
                rtl             : yit.isRtl == true
            });
        });
    }
});
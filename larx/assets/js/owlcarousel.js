jQuery(document).ready(function(){
    'use strict';

    /* ==============================================
        OWL CAROUSEL
    =============================================== */

    jQuery('#owl-demo').owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items : 5,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]
    });

    jQuery('#owl-testimonials, #owl-office').owlCarousel({
        navigation : false,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true
    });

});
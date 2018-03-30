jQuery(document).ready(function(){
    'use strict';

    /* ==============================================
        OWL CAROUSEL
    =============================================== */
    jQuery('#owl-project-single').owlCarousel({
        navigation : false,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true

        // "singleItem:true" is a shortcut for:
        // items : 1,
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false
    });

});
jQuery(function ($) {
    "use strict";
    $(window).load(function () {
        $('.blog-grid').isotope({
            layoutMode: 'masonry'
        });
        

    });
    $(window).resize(function () {
        $('.blog-grid').isotope({
            layoutMode: 'masonry'
        });
    });
    $(".owl-item-masonry").owlCarousel({
        autoPlay: 10000,
        slideSpeed : 1000,
        navigation: true,
        navigationText : ["", ""],
        pagination: false,
        singleItem:true
    });

    //Infinite scroll

    $('.blog-grid').infinitescroll({
        navSelector  	: "#load:last",
        nextSelector 	: "#load:last",
        itemSelector 	: ".blog-grid .col",
        loading: {
            finished: undefined,
            finishedMsg: "<em>Congratulations, you've reached the end of the internet.</em>",
            img: image_loader.url,
            msg: null,
            msgText: "<em>Loading the next set of posts...</em>",
            selector: null,
            speed: 'fast',
            start: undefined
        },
        path: function(index) {
            var id = $('.js_page_id').val();
            return "?page_id="+id+"&paged=" + index;
        }
    }, function(newElements, data, url){

        var $newElems = jQuery(newElements).hide(); // hide to begin with
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
            $newElems.fadeIn(400); // fade in when ready
            if($(".owl-item-masonry").length>0){
                $(".owl-item-masonry").each(function(index){
                    $(this).owlCarousel({
                        autoPlay: 10000,
                        slideSpeed : 1000,
                        navigation: true,
                        navigationText : ["", ""],
                        pagination: false,
                        singleItem:true
                    });
                });
            }
            $('.blog-grid').isotope( 'appended', $newElems );
        });
    });
    
});
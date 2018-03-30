jQuery(document).ready(function($) {
    'use strict';

    /**
     * Background image
     */
    $('*[data-background-image]').each(function() {
        $(this).css({
            'background-image': 'url(' + $(this).data('background-image') + ')'
        });
    });

    /**
     * Detail gallery
     */
    var propertyGallery = $('.property-detail-gallery');
    var propertyGalleryPreview = $('.property-detail-gallery-preview-inner');
    var propertyGalleryPreviewCount = propertyGalleryPreview.data('count');
    var propertyGalleryPreviewItems = 6;

    if (propertyGallery.length != 0) {
        var loop = true;

        if (propertyGallery.length === 1) {
            loop = false;
        }

        propertyGallery.owlCarousel({
            items: 1,
            loop: loop,
            autoHeight: true,
            autoplay: true,
            autoplayTimeout:5000,
            smartSpeed: 700,
            navText: ['<span class="pp pp-normal-left-arrow-small"></span>', '<span class="pp pp-normal-right-arrow-small"></span>']
        });
    }

    if (propertyGalleryPreview.length != 0) {
        propertyGalleryPreview.owlCarousel({
            items: propertyGalleryPreviewItems,
            nav: (propertyGalleryPreviewCount > propertyGalleryPreviewItems),
            navText: ['<span class="pp pp-normal-left-arrow-small"></span>', '<span class="pp pp-normal-right-arrow-small"></span>']
        });
    }

    $('.property-detail-gallery-preview-inner .owl-item:first').addClass('highlighted');

    propertyGallery.on('changed.owl.carousel', function(event) {
        var currentIndex = event.item.index - 0; // bug because of "loop: true";
        var firstActiveIndex = $('.property-detail-gallery-preview-inner .owl-item.active:first').children().data('item-id');
        var lastActiveIndex = $('.property-detail-gallery-preview-inner .owl-item.active:last').children().data('item-id');

        if ( currentIndex == event.item.count ) {
            currentIndex = 0;
        }

        // Highlight current item
        $('.property-detail-gallery-preview-inner .owl-item.highlighted').removeClass('highlighted');
        $('.property-detail-gallery-preview-inner .owl-item:eq(' + currentIndex + ')').addClass('highlighted');

        // Move preview if it is necessary
        if (firstActiveIndex >= currentIndex) {
            for (var i = 0; i <= ( firstActiveIndex - currentIndex ); i++) {
                propertyGalleryPreview.trigger('prev.owl.carousel');
            }
        } else if (lastActiveIndex <= currentIndex) {
            for (var i = 0; i <= ( currentIndex - lastActiveIndex ); i++) {
                propertyGalleryPreview.trigger('next.owl.carousel');
            }
        }
    });

    // Show in gallery image from preview
    $('.property-detail-gallery-preview-inner .owl-item').click(function(){
        var itemIndex = $(this).children().data('item-id');
        propertyGallery.trigger('to.owl.carousel', [itemIndex, 300]);
    });

    $('.property-detail-gallery').on('click', function() {
        propertyGallery.trigger('stop.owl.autoplay');
    });

    /**
     * Property gallery colorbox
     */
    $('.property-detail-gallery a').colorbox({
        ref: 'property-gallery',
        maxHeight: '90%',
        maxWidth: '85%'
    });
});

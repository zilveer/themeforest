
(function ($) {
    "use strict";

    $(document).ready(function() {

        // nth-child classes
        $('.products').find('.col-md-3:nth-child(4n+1)').addClass('nth-child_4n_1');
        $('.products').find('.col-md-4:nth-child(3n+1)').addClass('nth-child_3n_1');
        $('.products').find('.col-md-6:nth-child(2n+1)').addClass('nth-child_2n_1');

        $('.flickr-image:nth-child(3n+1)').addClass('nth-child_3n_1');
        $('.flickr-image:nth-child(3n)').addClass('nth-child_3n');

        $('#option-panel .pattern-box-list').find('li:nth-child(6n)').addClass('nth-child_6n');
        $('#option-panel .demo-list').find('li:even').addClass('even');
        $('#option-panel .demo-list').find('li:odd').addClass('odd');
        $('#option-panel .colorbox-list').find('li:even').addClass('even');
        $('#option-panel .colorbox-list').find('li:odd').addClass('odd');

        /* last child classes */
        $('.hentry, .portfolio-content').find('> div:last-child').addClass('last-child');
        $('body:last-child, h2.resp-tab-title:last-child, .widget:last-child, ' +
            '.counter-circle-wrapper:last-child').addClass('last-child');
        $('.faq-wrapper .panel-body').find('p:last-child').addClass('last-child');
        $('.resp-tabs-list, .product_list_widget').find('li:last-child').addClass('last-child');
        $('.resp-tab-content').find('> *:last-child').addClass('last-child');
        $('.resp-easy-accordion').find('.resp-tab-content:last-child').addClass('last-child');
        $('.resp-vtabs').find('.resp-tab-content:last-child').addClass('last-child');
        $('.footer-top .twitter-box').find('.twitter-tweet:last-child').addClass('last-child');
        $('.topnav, .mega-menu > ul').find('> li:last-child').addClass('last-child');
        $('#option-panel .sm-accordion').find('.panel:last-child').addClass('last-child');
        $('.content-slider .slide').find('.post-item:last-child').addClass('last-child');
        $('.product .ratings .star').find('i:last-child').addClass('last-child');
        $('.shop_table tbody').find('th:last-child, td:last-child, tr.last-child').addClass('last-child');
        $('.mega-menu ').find('.pos-right:last-child').addClass('last-child');

        $('#option-panel .layout-style-list').find('li:first-child').addClass('first-child');
    });

}(jQuery));

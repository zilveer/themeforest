<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

function one_change_colors_css ($color) {
    $rgba_1 = hex2rgba($color, 0.99);
    $rgba_2 = hex2rgba($color, 0.8);
    $rgba_3 = hex2rgba($color, 0.7);

    ?>

    <style type="text/css">

    a {
        color: <?= $rgba_1; ?>;
        text-decoration: none;
    }
    a:hover,
    a:focus {
        color: <?= $rgba_1; ?>;
    }
    .text-primary {
        color: <?= $rgba_1; ?>;
    }
    .bg-primary {
        background-color: <?= $rgba_1; ?>;
    }
    blockquote {
        border-left: 4px solid <?= $rgba_1; ?>;
    }
    .btn-primary {
        background-color: <?= $rgba_1; ?>;
    }
    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary.active,
    .open > .dropdown-toggle.btn-primary {
        background-color: <?= $rgba_1; ?>;
    }
    .btn-primary.disabled,
    .btn-primary[disabled],
    fieldset[disabled] .btn-primary,
    .btn-primary.disabled:hover,
    .btn-primary[disabled]:hover,
    fieldset[disabled] .btn-primary:hover,
    .btn-primary.disabled:focus,
    .btn-primary[disabled]:focus,
    fieldset[disabled] .btn-primary:focus,
    .btn-primary.disabled:active,
    .btn-primary[disabled]:active,
    fieldset[disabled] .btn-primary:active,
    .btn-primary.disabled.active,
    .btn-primary[disabled].active,
    fieldset[disabled] .btn-primary.active {
        background-color: <?= $rgba_1; ?>;
    }
    .btn-primary .badge {
        color: <?= $rgba_1; ?>;
    }
    .btn-link {
        color: <?= $rgba_1; ?>;
    }
    .btn-link:hover,
    .btn-link:focus {
        color: <?= $rgba_1; ?>;
    }
    .dropdown-menu > .active > a,
    .dropdown-menu > .active > a:hover,
    .dropdown-menu > .active > a:focus {
        background-color: <?= $rgba_1; ?>;
    }
    .dropdown > a {
        background: <?= $rgba_1; ?>;
    }
    .dropdown .dropdown-menu {
        border-top: 1px solid <?= $rgba_1; ?>;
    }
    .dropdown .dropdown-menu li a {
        background: <?= $rgba_1; ?>;
    }
    .dropdown .dropdown-menu li a i {
        background: <?= $rgba_1; ?>;
    }
    .dropdown .dropdown-menu li:first-child a i {
        border-top: 1px solid <?= $rgba_1; ?>;
    }
    .nav .open > a,
    .nav .open > a:hover,
    .nav .open > a:focus {
        border-color: <?= $rgba_1; ?>;
    }
    .nav-tabs > li > a:hover {
        border-color: <?= $rgba_1; ?>;
    }
    .nav-tabs > li.active > a,
    .nav-tabs > li.active > a:hover,
    .nav-tabs > li.active > a:focus {
        border: 1px solid <?= $rgba_1; ?>;
    }
    .pagination > li > a:hover,
    .pagination > li > span:hover,
    .pagination > li > a:focus,
    .pagination > li > span:focus {
        background-color: <?= $rgba_1; ?>;
    }
    .pagination > .active > a,
    .pagination > .active > span,
    .pagination > .active > a:hover,
    .pagination > .active > span:hover,
    .pagination > .active > a:focus,
    .pagination > .active > span:focus {
        background-color: <?= $rgba_1; ?>;
        border-color: <?= $rgba_1; ?>;
    }
    .label-primary {
        background-color: <?= $rgba_1; ?>;
    }
    a.list-group-item.active > .badge,
    .nav-pills > .active > a > .badge {
        color: <?= $rgba_1; ?>;
    }
    a.thumbnail:hover,
    a.thumbnail:focus,
    a.thumbnail.active {
        border-color: <?= $rgba_1; ?>;
    }
    .progress-bar {
        background-color: <?= $rgba_1; ?>;
    }
    .list-group-item.active,
    .list-group-item.active:hover,
    .list-group-item.active:focus {
        background-color: <?= $rgba_1; ?>;
        border-color: <?= $rgba_1; ?>;
    }
    .panel a .cs {
        background: <?= $rgba_1; ?>;
    }
    .panel-primary {
        border-color: <?= $rgba_1; ?>;
    }
    .panel-primary > .panel-heading {
        background-color: <?= $rgba_1; ?>;
        border-color: <?= $rgba_1; ?>;
    }
    .panel-primary > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: <?= $rgba_1; ?>;
    }
    .panel-primary > .panel-footer + .panel-collapse > .panel-body {
        border-bottom-color: <?= $rgba_1; ?>;
    }
    .head-container .menu .navbar .navbar-collapse .nav li.active,
    .head-container .menu .navbar .navbar-collapse .nav li:hover {
        border-bottom: 2px solid <?= $rgba_1; ?>;
    }
    .head-container .menu .navbar .navbar-collapse .nav li .sub-menu li a:hover {
        background: <?= $rgba_1; ?>;
    }
    .head-container .menu .navbar .navbar-form:hover button {
        background: <?= $rgba_1; ?>;
    }
    .head-container .menu .my-cart-link span {
        background: <?= $rgba_1; ?>;
    }
    @media (max-width: 1030px) {
        .head-container .menu .navbar .navbar-collapse .nav li.active > a {
            background: <?= $rgba_1; ?>;
        }
        .head-container .menu .navbar .navbar-collapse .nav li a:hover {
            background: <?= $rgba_1; ?>;
        }
        .head-container .menu .navbar .navbar-collapse .nav li .sub-menu li a:hover {
            background: <?= $rgba_1; ?>;
        }
        .head-container .menu .navbar .navbar-toggle:hover,
        .head-container .menu .navbar .navbar-toggle:focus {
            background: <?= $rgba_1; ?>;
        }
    }
    .footer {
        border-top: 3px solid <?= $rgba_1; ?>;
    }
    .back-to-top {
        background: <?= $rgba_1; ?>;
    }
    .footer-info .info p a:hover {
        color: <?= $rgba_1; ?>;
    }
    .breadcrumb-container .nav-posts:hover {
        background: <?= $rgba_1; ?>;
    }
    .widget.widget_recent_entries ul li a:before,
    .widget.widget_meta ul li a:before {
        color: <?= $rgba_1; ?>;
    }
    .widget.widget_recent_entries ul li a:hover,
    .widget.widget_meta ul li a:hover {
        color: <?= $rgba_1; ?>;
    }
    .widget_search form:hover button {
        background: <?= $rgba_1; ?>;
    }
    .event-widget figure > section > div a,
    .event-widget-countdown figure > section > div a {
        background: <?= $rgba_1; ?>;
    }
    .event-widget figure > section > div a:hover,
    .event-widget-countdown figure > section > div a:hover {
        color: <?= $rgba_1; ?>;
    }
    .widget_search:hover .icon {
        background: <?= $rgba_1; ?>;
    }
    .events-widget article .right .buy {
        background: <?= $rgba_2; ?>;
    }
    .events-widget article .right .buy a {
        color: <?= $rgba_1; ?>;
    }
    .events-widget article .right > a {
        background: <?= $rgba_1; ?>;
    }
    .events-widget article .right > a:hover {
        color: <?= $rgba_1; ?>;
    }
    .events-widget article .right h4 a:hover {
        color: <?= $rgba_1; ?>;
    }
    .top-albums-widget article figure ul li a:hover {
        color: <?= $rgba_1; ?>;
    }
    .top-albums-widget article .content > a {
        border: 1px solid <?= $rgba_1; ?>;
    }
    .top-albums-widget article .content > a:hover {
        color: <?= $rgba_1; ?>;
    }
    .top-rated-albums-widget article figure .content h5 a:hover {
        color: <?= $rgba_1; ?>;
    }
    .top-rated-albums-widget article figure .content p a:hover {
        color: <?= $rgba_1; ?>;
    }
    .post-article .thumbnail-article figure ul li a:hover {
        color: <?= $rgba_1; ?>;
    }
    .post-article .content-article .entry-tags ul li a:hover,
    .post-article .content-event-article .entry-tags ul li a:hover {
        color: <?= $rgba_1; ?>;
    }
    .post-article .content-article .entry-meta span a:hover,
    .post-article .content-event-article .entry-meta span a:hover {
        color: <?= $rgba_1; ?>;
    }
    .post-article .content-article > a,
    .post-article .content-event-article > a {
        background: <?= $rgba_1; ?>;
    }
    .post-article .content-article > a:hover,
    .post-article .content-event-article > a:hover {
        color: <?= $rgba_1; ?>;
    }
    .comment-respond .form-submit input[type=submit] {
        background: <?= $rgba_1; ?>;
    }
    .comment-respond .form-submit input[type=submit]:hover {
        color: <?= $rgba_1; ?>;
    }
    .products > li .figure-product .onsale {
        background: <?= $rgba_2; ?>;
    }
    .products > li .product-buttons a {
        background: <?= $rgba_1; ?>;
    }
    .products > li img {
        border-bottom: 5px solid <?= $rgba_1; ?>;
    }
    .widget_product_search form:hover button[type=submit],
    .widget_product_search form:hover input[type=submit] {
        background: <?= $rgba_1; ?>;
    }
    .widget_product_search form:hover input[type=text] {
        border-color: <?= $rgba_1; ?>;
    }
    .widget_product_categories .product-categories li a:hover {
        color: <?= $rgba_1; ?>;
    }
    .price_slider_wrapper .price_slider_amount button[type=submit] {
        background: <?= $rgba_1; ?>;
    }
    .price_slider_wrapper .price_slider_amount button[type=submit]:hover {
        color: <?= $rgba_1; ?>;
    }
    .woocommerce-pagination .page-numbers li a:hover,
    .woocommerce-pagination .page-numbers li span:hover {
        color: <?= $rgba_1; ?>;
        border-color: <?= $rgba_1; ?>;
    }
    .woocommerce-pagination .page-numbers li span {
        color: <?= $rgba_1; ?>;
        border-color: <?= $rgba_1; ?>;
    }
    .summary .product-border:before {
        background: <?= $rgba_1; ?>;
    }
    .summary .product_meta > span a:hover {
        color: <?= $rgba_1; ?>;
    }
    .cart button[type=submit] {
        background: <?= $rgba_1; ?>;
    }
    .cart input[type=button]:hover {
        background: <?= $rgba_1; ?>;
    }
    .woocommerce .login input[type=submit],
    .woocommerce .checkout_coupon input[type=submit],
    .woocommerce .lost_reset_password input[type=submit],
    .woocommerce .checkout input[type=submit],
    .woocommerce form.register input[type=submit] {
        background: <?= $rgba_1; ?>;
    }
    .woocommerce .login input[type=submit]:hover,
    .woocommerce .checkout_coupon input[type=submit]:hover,
    .woocommerce .lost_reset_password input[type=submit]:hover,
    .woocommerce .checkout input[type=submit]:hover,
    .woocommerce form.register input[type=submit]:hover {
        color: <?= $rgba_1; ?>;
    }
    .woocommerce .cart-totals-container input.checkout-button {
        background: <?= $rgba_1; ?>;
    }
    .woocommerce .cart-totals-container > button.checkout-button {
        background: <?= $rgba_1; ?>;
    }
    .shop-category.man h1 {
        color: <?= $rgba_1; ?>;
    }
    .shop-category.man a {
        color: <?= $rgba_1; ?>;
    }
    .comment-respond form input[type=submit] {
        background: <?= $rgba_1; ?>;
    }
    .comment-respond form input[type=submit]:hover {
        color: <?= $rgba_1; ?>;
    }
    .events-container article figure figcaption .min-info {
        border-bottom: 5px solid <?= $rgba_1; ?>;
    }
    .events-container article figure .main-content > div > a {
        background: <?= $rgba_1; ?>;
    }
    .events-container article figure .main-content > div > a:hover {
        color: <?= $rgba_1; ?>;
    }
    article.simple-event .right > a {
        background: <?= $rgba_1; ?>;
    }
    article.simple-event .right > a:hover {
        color: <?= $rgba_1; ?>;
    }
    article.simple-event .right h4 a:hover {
        color: <?= $rgba_1; ?>;
    }
    article.event-article figure .content .entry-tags ul li a:hover {
        color: <?= $rgba_1; ?>;
    }
    article.event-article figure .content .entry-meta span a:hover {
        color: <?= $rgba_1; ?>;
    }
    article.event-article figure .content > a {
        background: <?= $rgba_1; ?>;
    }
    article.event-article figure .content > a:hover {
        color: <?= $rgba_1; ?>;
    }
    @media (max-width: 768px) {
        article.simple-event .right > a {
            background: <?= $rgba_1; ?>;
        }
        article.simple-event .right > a:hover {
            color: <?= $rgba_1; ?>;
        }
        article.simple-event .right h4 a:hover {
            color: <?= $rgba_1; ?>;
        }
    }
    .ablums-posts-right article .left figure ul li a:hover {
        color: <?= $rgba_1; ?>;
    }
    .ablums-posts-right article .left .content > a {
        border: 1px solid <?= $rgba_1; ?>;
    }
    .ablums-posts-right article .left .content > a:hover {
        color: <?= $rgba_1; ?>;
    }
    .ablums-posts-bottom article .left figure ul li a:hover {
        color: <?= $rgba_1; ?>;
    }
    .ablums-posts-bottom article .left .content > a {
        border: 1px solid <?= $rgba_1; ?>;
    }
    .ablums-posts-bottom article .left .content > a:hover {
        color: <?= $rgba_1; ?>;
    }
    .albums-container article figure .back-face,
    .videos-container article figure .back-face,
    .photos-container article figure .back-face,
    .artists-container article figure .back-face {
        background: <?= $rgba_2; ?>;
    }
    .social-list ul li a:hover {
        background: <?= $rgba_1; ?>;
    }
    .underline-bg .underline {
        background: <?= $rgba_1; ?>;
    }
    .categories-portfolio ul li a:hover {
        background: <?= $rgba_1; ?>;
    }
    .minimal-player ul li .time-bar span,
    .playlist-content ul li .time-bar span {
        background: <?= $rgba_2; ?>;
    }
    .minimal-player ul li:hover > a,
    .playlist-content ul li:hover > a {
        background: <?= $rgba_1; ?>;
    }
    .minimal-player ul li.active,
    .playlist-content ul li.active {
        border-color: <?= $rgba_1; ?>;
    }
    .minimal-player ul li.active > a,
    .playlist-content ul li.active > a {
        background: <?= $rgba_1; ?>;
        border-right: 1px solid <?= $rgba_1; ?>;
    }
    .base-player {
        border-top: 2px solid <?= $rgba_1; ?>;
    }
    .base-player .content-base-player .buttons .play-pause.pause {
        background: <?= $rgba_1; ?>;
    }
    .base-player .content-base-player .sound-informations {
        border-right: 1px solid <?= $rgba_1; ?>;
    }
    .base-player .content-base-player .sound-bar-container .sound-bar-content span.progress-sound {
        background: <?= $rgba_2; ?>;
    }
    .base-player .content-base-player .playlist .button-playlist {
        background: <?= $rgba_1; ?>;
    }
    figure.feature .bg-feature {
        background: <?= $rgba_1; ?>;
    }
    figure.feature .container-feature .content-feature {
        background: <?= $rgba_2; ?>;
    }
    .top-events-albums {
        border-bottom: 5px solid <?= $rgba_1; ?>;
    }
    .top-events-albums .events-albums ul li figure .main-content {
        background: <?= $rgba_2; ?>;
    }
    .top-events-albums .events-albums ul li figure .main-content > a {
        color: <?= $rgba_1; ?>;
    }
    .top-events-albums .hide-top-events-albums {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .widget_product_search form:hover button[type=submit],
    body.light-layout .widget_product_search form:hover input[type=submit] {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .ablums-posts-right article .left .content > a:hover {
        color: <?= $rgba_1; ?>;
    }
    body.light-layout .ablums-posts-bottom article .left .content > a:hover {
        color: <?= $rgba_1; ?>;
    }
    body.light-layout .breadcrumb-container .nav-posts:hover {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .social-list ul li a:hover {
        border-color: <?= $rgba_1; ?>;
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .base-player .content-base-player .buttons .play-pause.pause {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .base-player .content-base-player .playlist .button-playlist {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .menu .navbar .navbar-collapse .nav li .sub-menu li a:hover {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .menu .navbar .navbar-form:hover button {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .top-albums-widget article .content > a:hover {
        color: <?= $rgba_1; ?>;
    }
    body.light-layout .widget_product_search:hover button[type=submit] {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .widget_product_search:hover input[type=text] {
        border-color: <?= $rgba_1; ?>;
    }
    body.light-layout .cart input[type=button]:hover {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .woocommerce .login input[type=submit]:hover,
    body.light-layout .woocommerce .checkout_coupon input[type=submit]:hover,
    body.light-layout .woocommerce .lost_reset_password input[type=submit]:hover,
    body.light-layout .woocommerce .checkout input[type=submit]:hover,
    body.light-layout .woocommerce form.register input[type=submit]:hover {
        color: <?= $rgba_1; ?>;
    }
    body.light-layout .footer .widget.widget_recent_entries ul li a:hover,
    body.light-layout .footer .widget.widget_meta ul li a:hover {
        color: <?= $rgba_1; ?>;
    }
    body.light-layout .footer-info .info p a:hover {
        color: <?= $rgba_1; ?>;
    }
    body.light-layout .pagination > li > a:hover,
    body.light-layout .pagination > li > span:hover,
    body.light-layout .pagination > li > a:focus,
    body.light-layout .pagination > li > span:focus {
        background-color: <?= $rgba_1; ?>;
    }
    body.light-layout .pagination > .active > a,
    body.light-layout .pagination > .active > span,
    body.light-layout .pagination > .active > a:hover,
    body.light-layout .pagination > .active > span:hover,
    body.light-layout .pagination > .active > a:focus,
    body.light-layout .pagination > .active > span:focus {
        background-color: <?= $rgba_1; ?>;
        border-color: <?= $rgba_1; ?>;
    }
    body.light-layout .widget_search:hover .icon {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .widget_search form:hover button {
        background: <?= $rgba_1; ?>;
    }
    body.light-layout .nav-tabs > li.active > a,
    body.light-layout .nav-tabs > li.active > a:hover,
    body.light-layout .nav-tabs > li.active > a:focus {
        border-color: <?= $rgba_1; ?>;
    }
    body.light-layout .nav-tabs > li > a:hover,
    body.light-layout .nav-tabs > li > a:focus {
        border-color: <?= $rgba_1; ?>;
    }
    @media (max-width: 1030px) {
        body.light-layout .menu .navbar .navbar-toggle:hover,
        body.light-layout .menu .navbar .navbar-toggle:focus {
            border-color: <?= $rgba_1; ?>;
        }
        body.light-layout .menu .navbar .navbar-collapse .nav li > a:hover {
            background: <?= $rgba_1; ?> !important;
        }
    }

    .products > li .product-container .onsale {
        background: <?= $rgba_2; ?>;
    }

    </style>

<?php
}
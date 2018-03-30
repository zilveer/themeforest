<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Add specific fields to the tab Colors -> General
 * 
 * @param array $fields
 * @return array
 */ 
function yit_tab_colors_general( $fields ) {
	
    return array_merge( $fields, array(
        80 => array(
            'id' => 'general-border-hover',
            'type' => 'colorpicker',
            'name' => __( 'Border hover color', 'yit' ),
            'desc' => __( 'Select the color of the border when is hover.', 'yit' ),
            'std' => apply_filters( 'yit_general-border-hover_std', '#464646' ),
            'style' => array(
            	'selectors' => '.portfolio-big-image .work-thumbnail .thumb-wrapper:hover, .related_project .related_img:hover, .portfolio-categories ul li:hover, #portfolio .more-link:hover, .portfolio-big-image a.more:hover, #portfolio.columns .overlay_a:hover, .showcase-thumbnail img:hover, .widget_archive ul li a:hover, .widget_nav_menu ul li a:hover, .widget_pages ul li a:hover, .widget_categories ul li a:hover, .picture_overlay:hover, .section-portfolio-classic .work-projects a.img:hover, .section-portfolio-classic .work-projects a.img.active',
            	'properties' => 'border-color'
			)
         ),
        90 => array(
            'id' => 'widget-border-1',
            'type' => 'colorpicker',
            'name' => __( 'External border color of widget', 'yit' ),
            'desc' => __( 'Select the color of the external border of widgets.', 'yit' ),
            'std' => apply_filters( 'yit_widget-border-1_std', '#F39501' ),
            'style' => array(
            	'selectors' => '.testimonial-widget-span .border-1, .recent-posts-home .border-1, .sidebar .cta .border-1, #footer .cta .border-1, div.yit_quick_contact > div, .cart-collaterals .cart_totals .border-1, .widget.contact-info, .sidebar * .border.border-1, .sidebar .widget.contact-info, #map .border, .sidebar .widget.widget_yith-wcwl-lists',
            	'properties' => 'border-color'
			)
        ),
        100 => array(
            'id' => 'widget-border-2',
            'type' => 'colorpicker',
            'name' => __( 'Internal border color of widget', 'yit' ),
            'desc' => __( 'Select the color of the internal border of widgets.', 'yit' ),
            'std' => apply_filters( 'yit_widget-border-2_std', '#ECD0A3' ),
            'style' => array(
            	'selectors' => '.testimonial-widget-span .border-2, .recent-posts-home .border-2, .sidebar .cta .border-2, #footer .cta .border-2, .yit_quick_contact > div:before, .cart-collaterals .cart_totals .border-2,  .widget.contact-info .border, .sidebar * .border.border-2, .sidebar .widget.contact-info .border, .error404 .border-img, .sidebar .widget_yith-wcwl-lists .border',
            	'properties' => 'border-color'
			)
		),
        110 => array(
            'id' => 'widget-and-contact-submit',
            'type' => 'colorpicker',
            'name' => __( 'Widgets &amp; Contact form submit button', 'yit' ),
            'desc' => __( 'Select the color of the submit button of widgets and contact forms.', 'yit' ),
            'std' => apply_filters( 'yit_widget-and-contact-submit_std', '#c27d05' ),
            'style' => array(
                'selectors' => '.error-404-text input#searchsubmit,#respond #commentsubmit,.sidebar .cta .newsletter-submit .submit-field, #footer .cta .newsletter-submit .submit-field, .contact-form li.submit-button input.sendmail, .yit_quick_contact .contact-form li.submit-button input.sendmail',
                'properties' => 'background-color'
            )
        ),
        120 => array(
            'id' => 'widget-and-contact-submit-hover',
            'type' => 'colorpicker',
            'name' => __( 'Widgets &amp; Contact form submit button (hover)', 'yit' ),
            'desc' => __( 'Select the color of the submit button of widgets and contact forms when is hover.', 'yit' ),
            'std' => apply_filters( 'yit_widget-and-contact-submit-hover_std', '#e79c0c' ),
            'style' => array(
                'selectors' => '.error-404-text input#searchsubmit:hover,#respond #commentsubmit:hover,.sidebar .cta .newsletter-submit .submit-field:hover, #footer .cta .newsletter-submit .submit-field:hover, .contact-form li.submit-button input.sendmail:hover, .yit_quick_contact .contact-form li.submit-button input.sendmail:hover',
                'properties' => 'background-color'
            )
        ),
        130 => array(
            'id' => 'widget-and-contact-submit-text',
            'type' => 'colorpicker',
            'name' => __( 'Widgets &amp; Contact form submit button text', 'yit' ),
            'desc' => __( 'Select the color of the submit button text of widgets and contact forms.', 'yit' ),
            'std' => apply_filters( 'yit_widget-and-contact-submit-text_std', '#ffffff' ),
            'style' => array(
                'selectors' => '.error-404-text input#searchsubmit,#respond #commentsubmit,.sidebar .cta .newsletter-submit .submit-field, #footer .cta .newsletter-submit .submit-field, .contact-form li.submit-button input.sendmail, .yit_quick_contact .contact-form li.submit-button input.sendmail',
                'properties' => 'color'
            )
        ),
        140 => array(
            'id' => 'widget-and-contact-submit-text-hover',
            'type' => 'colorpicker',
            'name' => __( 'Widgets &amp; Contact form submit button text (hover)', 'yit' ),
            'desc' => __( 'Select the color of the submit button text of widgets and contact forms when is hover.', 'yit' ),
            'std' => apply_filters( 'yit_widget-and-contact-submit-text-hover_std', '#ffffff' ),
            'style' => array(
                'selectors' => '.error-404-text input#searchsubmit:hover,#respond #commentsubmit:hover,.sidebar .cta .newsletter-submit .submit-field:hover, #footer .cta .newsletter-submit .submit-field:hover, .contact-form li.submit-button input.sendmail:hover, .yit_quick_contact .contact-form li.submit-button input.sendmail:hover',
                'properties' => 'color'
            )
        ),
        150 => array(
            'id' => 'widget-plus-icon',
            'type' => 'colorpicker',
            'name' => __( 'Widgets "plus" icon', 'yit' ),
            'desc' => __( 'Select the color of the plus icon of all widgets.', 'yit' ),
            'std' => apply_filters( 'yit_widget-plus-icon_std', '#2c2b2b' ),
            'style' => array(
                'selectors' => '#sidebar-shop-sidebar .widget .plus',
                'properties' => 'background-color'
            )
        ),
        160 => array(
            'id' => 'widget-minus-icon',
            'type' => 'colorpicker',
            'name' => __( 'Widgets "minus" icon', 'yit' ),
            'desc' => __( 'Select the color of the minus icon of all widgets.', 'yit' ),
            'std' => apply_filters( 'yit_widget-minus-icon_std', '#c58408' ),
            'style' => array(
                'selectors' => '#sidebar-shop-sidebar .widget .minus',
                'properties' => 'background-color'
            )
        ),
        170 => array(
            'id' => 'read-more-button',
            'type' => 'colorpicker',
            'name' => __( 'Read more button', 'yit' ),
            'desc' => __( 'Select the color of the Read more button.', 'yit' ),
            'std' => apply_filters( 'yit_read-more-button_std', '#c58408' ),
            'style' => array(
                'selectors' => '.section-services-bandw .service-wrapper .service .read-more a, .not-btn.more-link, .not-btn.read-more, #portfolio .read-more, #portfolio .more-link',
                'properties' => 'background-color'
            )
        ),
        180 => array(
            'id' => 'read-more-button-hover',
            'type' => 'colorpicker',
            'name' => __( 'Read more button (hover)', 'yit' ),
            'desc' => __( 'Select the color of the Read more button when is hover.', 'yit' ),
            'std' => apply_filters( 'yit_read-more-button_std', '#DA8B00' ),
            'style' => array(
                'selectors' => '.section-services-bandw .service-wrapper .service .read-more a:hover, .not-btn.more-link:hover, .not-btn.read-more:hover, #portfolio .read-more:hover, #portfolio .more-link:hover',
                'properties' => 'background-color'
            )
        ),
        190 => array(
            'id'   => 'back-top-background',
            'type' => 'colorpicker',
            'name' => __( 'Back to Top background', 'yit' ),
            'desc' => __( 'Select the color to use for Back to Top background. ', 'yit' ),
            'std'  => apply_filters( 'yit_back-top-background_std', '#ffffff' ),
            'style' => apply_filters( 'yit_back-top-background_style', array(
                'selectors' => '#back-top',
                'properties' => 'background-color'
            ) )
        )
    ) );
}
add_filter( 'yit_submenu_tabs_theme_option_colors_general', 'yit_tab_colors_general' );

add_filter( 'yit_general-border_std', create_function( '', 'return "#e0dfdf";' ) );
function yit_general_border_style( $array ) {
    $array['selectors'] = '.contact-form li textarea,#header-sidebar .widget, #header-sidebar .widget-last,code, pre, body hr, #copyright .inner, #footer .inner, .gallery img, .gallery img, .content .archive-list ul, .content .archive-list ul li, .more-projects-widget .work-thumb, .more-projects-widget .controls, .more-projects-widget .top, .featured-projects-widget img, .thumb-project img, #searchform input, .portfolio-categories ul li, .portfolio-categories ul li:hover, .recent-comments .avatar img, .content .contact-form li.submit-button input, #portfolio .read-more, #portfolio .more-link, #portfolio .read-more:hover, #portfolio .more-link:hover, .accordion-title, .accordion-item-thumb img, form input[type="text"], form textarea, .testimonial-page, div.section-caption .caption, .line, .last-tweets-widget ul li, .toggle p.tab-index, .toggle .content-tab, .testimonial, .google-map-frame, .section.blog .post, .section.blog h4.other-articles, .section.blog .sticky .thumbnail, .section .portfolio-sticky .work-categories, .testimonial, #searchform input, .blog-big .meta p, .blog-big p.list-tags, .blog-small .image-wrap, .comment-container, .image-square-style #comments img.avatar, #comments .comment-author img, .comment-meta, #respond input, #respond textarea, img.comment-avatar, .portfolio-big-image a.thumb, .portfolio-big-image a.more, .portfolio-big-image a.more:hover, .portfolio-big-image .work-thumbnail a.nozoom, .portfolio-big-image .work-skillsdate, .internal_page_item, .gallery-wrap li h5, .gallery-filters, .portfolio-full-description a.thumb, .portfolio-full-description a.more, .portfolio-full-description a.more:hover, .portfolio-full-description .work-skillsdate, .related_img, #portfolio.columns .overlay_a, .yit-widget-content .widget, .slider.thumbnails .showcase-thumbnail img, .slider.thumbnails .showcase-thumbnail img:hover, .slider.thumbnails .showcase-thumbnail.active img, .recent-post .thumb-img img, .widget_archive ul li a, .widget_archive ul li a:hover, .widget_nav_menu ul li a, .widget_nav_menu ul li a:hover, .widget_pages ul li a, .widget_pages ul li a:hover, .widget_categories ul li a, .widget_categories ul li a:hover, #searchform input, .widget_flickrRSS img, .widget_nav_menu ul li a, .widget_pages ul li a, .widget_categories ul li a, .widget_archive ul li a:hover, .widget_nav_menu ul li.current_page_item > a, .widget_pages ul li.current_page_item > a, .widget_categories ul li.current_page_item > a, .testimonial-widget div.name-testimonial, .last-tweets-widget ul li, .yit-widget-content .widget, .portfolio-categories ul li, .recent-comments .avatar img, .more-projects-widget .work-thumb, .more-projects-widget .controls, .more-projects-widget .top, .featured-projects-widget img, .thumb-project img, .picture_overlay, #respond textarea:focus, .section-portfolio-classic .work-projects a.img, .border, #header-cart-search .cart-items, #header-cart-search .cart-subtotal, #header-cart-search .widget_shopping_cart .cart_control, #nav .container, .sitemap h3, .woocommerce.archive .sidebar .widget h3, #copyright .borderz';
    return $array;
}
add_filter( 'yit_general-border_style', 'yit_general_border_style' );

add_filter( 'yit_general-border-hover_std', create_function( '', 'return "#cccccc";' ) );

function yit_container_background_style( $array ) {
    $array['selectors'] = '.boxed #wrapper';    
    return $array;
}
add_filter( 'yit_container-background_style', 'yit_container_background_style' );



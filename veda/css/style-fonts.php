<?php
/* ---------------------------------------------------------------------------
 * Color Styles
 * --------------------------------------------------------------------------- */

if ( ! defined( 'ABSPATH' ) ) exit; ?>

h1, .dt-sc-counter.type1 .dt-sc-counter-number, .dt-sc-portfolio-sorting a, .dt-sc-testimonial .dt-sc-testimonial-author cite, .dt-sc-pr-tb-col.minimal .dt-sc-price p, .dt-sc-pr-tb-col.minimal .dt-sc-price h6 span, .dt-sc-testimonial.special-testimonial-carousel blockquote, .dt-sc-pr-tb-col .dt-sc-tb-title, .dt-sc-pr-tb-col .dt-sc-tb-content, .dt-sc-pr-tb-col .dt-sc-tb-content li, .dt-sc-bar-text, .dt-sc-counter.type3 .dt-sc-counter-number, .dt-sc-newsletter-section.type2 .dt-sc-subscribe-frm input[type="submit"], .dt-sc-timeline .dt-sc-timeline-content h2 span, .dt-sc-model-sorting a, .dt-sc-icon-box.type9 .icon-content h4, .dt-sc-icon-box.type9 .icon-content h4 span, .dt-sc-menu-sorting a, .dt-sc-menu .image-overlay .price, .dt-sc-menu .menu-categories a, .dt-sc-pr-tb-col .dt-sc-price h6, ul.products li .onsale { font-family:<?php veda_opts_show('h1-font', 'Raleway');?>, sans-serif; }

h2 { font-family:<?php veda_opts_show('h2-font', 'Raleway');?>, sans-serif; }

h3, .dt-sc-testimonial.type1 blockquote, .blog-entry.entry-date-left .entry-date, .dt-sc-ribbon-title, .dt-sc-testimonial.type1 .dt-sc-testimonial-author cite { font-family:<?php veda_opts_show('h3-font', 'Raleway');?>, sans-serif; }

h4, .blog-entry .entry-meta, .dt-sc-button { font-family:<?php veda_opts_show('h4-font', 'Raleway');?>, sans-serif; }

h5 { font-family:<?php veda_opts_show('h5-font', 'Raleway');?>, sans-serif; }

h6 { font-family:<?php veda_opts_show('h6-font', 'Raleway');?>, sans-serif; }

h1 { font-size:<?php veda_opts_show('h1-font-size', '30');?>px; font-weight:<?php veda_opts_show('h1-weight', 'normal');?>; letter-spacing:<?php veda_opts_show('h1-letter-spacing', '0.5px');?>; }
h2 { font-size:<?php veda_opts_show('h2-font-size', '24');?>px; font-weight:<?php veda_opts_show('h2-weight', 'normal');?>; letter-spacing:<?php veda_opts_show('h2-letter-spacing', '0.5px');?>; }
h3 { font-size:<?php veda_opts_show('h3-font-size', '18');?>px; font-weight:<?php veda_opts_show('h3-weight', 'normal');?>; letter-spacing:<?php veda_opts_show('h3-letter-spacing', '0.5px');?>; }
h4 { font-size:<?php veda_opts_show('h4-font-size', '16');?>px; font-weight:<?php veda_opts_show('h4-weight', 'normal');?>; letter-spacing:<?php veda_opts_show('h4-letter-spacing', '0.5px');?>; }
h5 { font-size:<?php veda_opts_show('h5-font-size', '14');?>px; font-weight:<?php veda_opts_show('h5-weight', 'normal');?>; letter-spacing:<?php veda_opts_show('h5-letter-spacing', '0.5px');?>; }
h6 { font-size:<?php veda_opts_show('h6-font-size', '13');?>px; font-weight:<?php veda_opts_show('h6-weight', 'normal');?>; letter-spacing:<?php veda_opts_show('h6-letter-spacing', '0.5px');?>; }

body { font-size:<?php veda_opts_show('content-font-size', '13');?>px; line-height:<?php veda_opts_show('body-line-height', '24');?>px; }

body, .blog-entry.blog-medium-style .entry-meta, .dt-sc-event-image-caption .dt-sc-image-content h3, .dt-sc-events-list .dt-sc-event-title h5, .dt-sc-team.type2 .dt-sc-team-details h4, .dt-sc-team.type2 .dt-sc-team-details h5, .dt-sc-contact-info.type5 h6, .dt-sc-sponsors .dt-sc-one-third h3, .dt-sc-testimonial.type5 .dt-sc-testimonial-author cite, .dt-sc-counter.type3 h4, .dt-sc-contact-info.type2 h6, .woocommerce ul.products li.product .onsale, #footer .mailchimp-form input[type="email"], .dt-sc-icon-box.type5 .icon-content h5, .main-header #searchform input[type="text"], .dt-sc-testimonial.type1 .dt-sc-testimonial-author cite small, .dt-sc-pr-tb-col.type2 .dt-sc-tb-content li, .dt-sc-team.rounded .dt-sc-team-details h5, .megamenu-child-container > ul.sub-menu > li > a .menu-item-description, .menu-item-description { font-family:<?php veda_opts_show('content-font', 'Open Sans');?>, sans-serif; }

#main-menu ul.menu > li > a, .left-header #main-menu > ul.menu > li > a { font-size:<?php veda_opts_show('menu-font-size', '13');?>px; font-weight:<?php veda_opts_show('menu-weight', 'normal');?>; letter-spacing:<?php veda_opts_show('menu-letter-spacing', '0.5px');?>; }

#main-menu ul.menu > li > a, .dt-sc-pr-tb-col .dt-sc-tb-title h5, .dt-sc-timeline .dt-sc-timeline-content h2, .dt-sc-icon-box.type3 .icon-content h4, .dt-sc-popular-procedures .details h3, .dt-sc-popular-procedures .details .duration, .dt-sc-popular-procedures .details .price, .dt-sc-counter.type2 .dt-sc-counter-number, .dt-sc-counter.type2 h4, .dt-sc-testimonial.type4 .dt-sc-testimonial-author cite { font-family:<?php veda_opts_show('menu-font', 'Raleway');?>, sans-serif; }

<?php
$ffsize = veda_option('fonts','footer-font-size');
if( isset($ffsize) ): ?>
	#footer { font-size:<?php veda_opts_show('footer-font-size', '');?>px; }<?php
endif;?>
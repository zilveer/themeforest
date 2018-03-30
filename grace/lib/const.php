<?php

/******************************************************************************************************/
/* BLOG
/******************************************************************************************************/
if (!defined('TB_READ_MORE')) define('TB_READ_MORE', 'Read more <span class="meta-nav">&raquo;</span>');
if (!defined('NAVIGATION_SEARCH_VALUE')) define('NAVIGATION_SEARCH_VALUE', 'Search...');

/******************************************************************************************************/
/* CUSTOM POST TYPES
/******************************************************************************************************/
if (!defined('TB_CHURCH_CPT')) define('TB_CHURCH_CPT', 'church');
if (!defined('TB_EVENT_CPT')) define('TB_EVENT_CPT', 'event');
if (!defined('TB_EVENT_TAX')) define('TB_EVENT_TAX', 'event_categories');
if (!defined('TB_GALLERY_CPT')) define('TB_GALLERY_CPT', 'tb_gallery');
if (!defined('TB_GALLERY_TAX')) define('TB_GALLERY_TAX', 'gallery_categories');
if (!defined('TB_PRIEST_CPT')) define('TB_PRIEST_CPT', 'priest');
if (!defined('TB_SERMON_CPT')) define('TB_SERMON_CPT', 'sermon');
if (!defined('TB_SERMON_TAX_TOPIC')) define('TB_SERMON_TAX_TOPIC', 'sermon_topic');
if (!defined('TB_SERMON_TAX_SCRIPTURE')) define('TB_SERMON_TAX_SCRIPTURE', 'sermon_scripture');
if (!defined('TB_SERMON_TAX_OCCASION')) define('TB_SERMON_TAX_OCCASION', 'sermon_occasions');

/******************************************************************************************************/
/* THEME OPTIONS
/******************************************************************************************************/
$imagepath =  PARENT_URL . '/images/';

if (!defined('DEFAULT_LAYOUT')) define('DEFAULT_LAYOUT', 'wide');

if (!defined('BODY_BACKGROUND_COLOR')) define('BODY_BACKGROUND_COLOR', '#B1CDD9');
if (!defined('BODY_BACKGROUND_IMAGE')) define('BODY_BACKGROUND_IMAGE', $imagepath . 'bckg2.jpg');
if (!defined('BODY_BACKGROUND_REPEAT')) define('BODY_BACKGROUND_REPEAT', 'repeat-x');
if (!defined('BODY_BACKGROUND_POSITION')) define('BODY_BACKGROUND_POSITION', 'top center');
if (!defined('BODY_BACKGROUND_ATTACHMENT')) define('BODY_BACKGROUND_ATTACHMENT', 'scroll');	

if (!defined('BODY_TYPOGRAPHY_SIZE')) define('BODY_TYPOGRAPHY_SIZE', '12px');	
if (!defined('BODY_TYPOGRAPHY_FACE')) define('BODY_TYPOGRAPHY_FACE', 'arial');	
if (!defined('BODY_TYPOGRAPHY_STYLE')) define('BODY_TYPOGRAPHY_STYLE', 'normal');	
if (!defined('BODY_TYPOGRAPHY_COLOR')) define('BODY_TYPOGRAPHY_COLOR', '#566c84');
if (!defined('USE_GOOGLE_FONTS')) define('USE_GOOGLE_FONTS', 0);
if (!defined('DEFAULT_FONT')) define('DEFAULT_FONT', 'Marcellus');	
if (!defined('DEFAULT_HEADING_COLOR')) define('DEFAULT_HEADING_COLOR', '#3d4d5f');	
if (!defined('DEFAULT_H1_COLOR')) define('DEFAULT_H1_COLOR', '#3d4d5f');
if (!defined('DEFAULT_INDEX_HEADING_COLOR')) define('DEFAULT_INDEX_HEADING_COLOR', '#3c95a5');
if (!defined('DEFAULT_QUOTE_FONT')) define('DEFAULT_QUOTE_FONT', 'Great Vibes');	
if (!defined('DEFAULT_QUOTE_COLOR')) define('DEFAULT_QUOTE_COLOR', '#494949');
if (!defined('DEFAULT_H1_SIZE')) define('DEFAULT_H1_SIZE', '32px');	
if (!defined('DEFAULT_H2_SIZE')) define('DEFAULT_H2_SIZE', '28px');	
if (!defined('DEFAULT_H3_SIZE')) define('DEFAULT_H3_SIZE', '20px');	
if (!defined('DEFAULT_COMMENTS_H3_SIZE')) define('DEFAULT_COMMENTS_H3_SIZE', '18px');	
if (!defined('DEFAULT_H4_SIZE')) define('DEFAULT_H4_SIZE', '18px');	
if (!defined('DEFAULT_H5_SIZE')) define('DEFAULT_H5_SIZE', '17px');	
if (!defined('DEFAULT_BLOCKQUOTE_SIZE')) define('DEFAULT_BLOCKQUOTE_SIZE', '24px');	
if (!defined('DEFAULT_QUOTE_SIZE')) define('DEFAULT_QUOTE_SIZE', '20px');	

if (!defined('LINK_COLOR')) define('LINK_COLOR', '#3c95a5');
if (!defined('LINK_COLOR_HOVER')) define('LINK_COLOR_HOVER', '#d19443');
if (!defined('FOOTER_LINK_COLOR')) define('FOOTER_LINK_COLOR', '#192209');
if (!defined('FOOTER_LINK_COLOR_HOVER')) define('FOOTER_LINK_COLOR_HOVER', '#3c95a5');
if (!defined('SIDEBAR_LINK_COLOR')) define('SIDEBAR_LINK_COLOR', '#3c95a5');
if (!defined('SIDEBAR_LINK_COLOR_HOVER')) define('SIDEBAR_LINK_COLOR_HOVER', '#d19443');
if (!defined('BUTTON_BCKG')) define('BUTTON_BCKG', '#ffffff');
if (!defined('BUTTON_COLOR')) define('BUTTON_COLOR', '#5a5d63');
if (!defined('BUTTON_TEXT_SHADOW')) define('BUTTON_TEXT_SHADOW', '#ffffff');
if (!defined('BUTTON_BORDER')) define('BUTTON_BORDER', '#cccccc');
if (!defined('BUTTON_INSET_SHADOW')) define('BUTTON_INSET_SHADOW', '#ffffff');

if (!defined('PAGINATION_BCKG')) define('PAGINATION_BCKG', '#ffffff');
if (!defined('PAGINATION_COLOR')) define('PAGINATION_COLOR', '#5a5d63');
if (!defined('PAGINATION_TEXT_SHADOW')) define('PAGINATION_TEXT_SHADOW', '#ffffff');
if (!defined('PAGINATION_BORDER')) define('PAGINATION_BORDER', '#cccccc');
if (!defined('PAGINATION_INSET_SHADOW')) define('PAGINATION_INSET_SHADOW', '#ffffff');
if (!defined('PAGINATION_BCKG_ACTIVE')) define('PAGINATION_BCKG_ACTIVE', '#3c95a5');
if (!defined('PAGINATION_COLOR_ACTIVE')) define('PAGINATION_COLOR_ACTIVE', '#ffffff');
if (!defined('PAGINATION_TEXT_SHADOW_ACTIVE')) define('PAGINATION_TEXT_SHADOW_ACTIVE', '#2E7380');
if (!defined('PAGINATION_BORDER_ACTIVE')) define('PAGINATION_BORDER_ACTIVE', '#348290');

if (!defined('NAVIGATION_COLOR')) define('NAVIGATION_COLOR', '#f6f5f4');
if (!defined('NAVIGATION_BCKG')) define('NAVIGATION_BCKG', '#63544a');
if (!defined('NAVIGATION_BCKG_HOVER')) define('NAVIGATION_BCKG_HOVER', '#d5883a');
if (!defined('NAVIGATION_BCKG_HOVER_COLOR2')) define('NAVIGATION_BCKG_HOVER_COLOR2', '#db9f49');
if (!defined('NAVIGATION_COLOR_HOVER')) define('NAVIGATION_COLOR_HOVER', '#ffffff');
if (!defined('NAVIGATION_BORDER_HOVER')) define('NAVIGATION_BORDER_HOVER', '#4E3F32');

if (!defined('NAVIGATION_SUBMENU_BCKG')) define('NAVIGATION_SUBMENU_BCKG', '#d5883a');
if (!defined('NAVIGATION_SUBMENU_BCKG_HOVER')) define('NAVIGATION_SUBMENU_BCKG_HOVER', '#db9f49');
if (!defined('NAVIGATION_SUBMENU_COLOR')) define('NAVIGATION_SUBMENU_COLOR', '#ffffff');
if (!defined('NAVIGATION_SUBMENU_COLOR_HOVER')) define('NAVIGATION_SUBMENU_COLOR_HOVER', '#ffffff');

if (!defined('DATE_BOX_COLOR')) define('DATE_BOX_COLOR', '#5a5d63');
if (!defined('DATE_BOX_COLOR_HOVER')) define('DATE_BOX_COLOR_HOVER', '#ffffff');
if (!defined('DATE_BOX_BCKG')) define('DATE_BOX_BCKG', '#d9dbe3');
if (!defined('DATE_BOX_BCKG_HOVER')) define('DATE_BOX_BCKG_HOVER', '#3c95a5');

if (!defined('DEFAULT_SECTION_TITLE_BCKG_COLOR')) define('DEFAULT_SECTION_TITLE_BCKG_COLOR', '#f5f5f5');
if (!defined('DEFAULT_SECTION_TITLE_BORDER_COLOR')) define('DEFAULT_SECTION_TITLE_BORDER_COLOR', '#dedede');

if (!defined('PROMO_LINE_BCKG_COLOR')) define('PROMO_LINE_BCKG_COLOR', '#111111');
if (!defined('PROMO_LINE_OPACITY')) define('PROMO_LINE_OPACITY', '65');
if (!defined('PROMO_LINE_COLOR')) define('PROMO_LINE_COLOR', '#ffffff');
if (!defined('PROMO_LINE_LINK_COLOR')) define('PROMO_LINE_LINK_COLOR', '#f9c968');
if (!defined('PROMO_LINE_LINK_COLOR_HOVER')) define('PROMO_LINE_LINK_COLOR_HOVER', '#fbdb99');
if (!defined('PROMO_LINE_ICON_COLOR')) define('PROMO_LINE_ICON_COLOR', '#25242A');
if (!defined('PROMO_LINE_ICON_BCKG')) define('PROMO_LINE_ICON_BCKG', '#7C7C7F');
if (!defined('PROMO_LINE_ICON_COLOR_HOVER')) define('PROMO_LINE_ICON_COLOR_HOVER', '#25242A');
if (!defined('PROMO_LINE_ICON_BCKG_HOVER')) define('PROMO_LINE_ICON_BCKG_HOVER', '#D3D3D4');

?>
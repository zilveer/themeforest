<?php

/*----------------------------------------------------
 * INTERNAL THEME SETTINGS
 *----------------------------------------------------*/ 
$currTheme = wp_get_theme();
@define("BFI_THEMEVERSION", $currTheme->get('Version'));
@define("BFI_THEMENAME", $currTheme->get('Name'));

@define("BFI_ENABLE_PAGEBUILDER", true);
@define("BFI_ENABLE_PAGEMEDIA", false);
@define("BFI_ENABLE_PORTFOLIO_FEATURED_IMAGE", false);
@define("BFI_LIVEPREVIEWMODE", false);

$wpUploadDir = wp_upload_dir();

@define("BFI_SHORTNAME", str_replace(' ', '', strtolower(trim(BFI_THEMENAME))));
@define("BFI_I18NDOMAIN", BFI_SHORTNAME);

@define("BFI_TEMPLATEURL", get_template_directory_uri() . '/');
@define("BFI_UPLOADURL", $wpUploadDir['url'] . '/');
@define("BFI_TINYMCEURL", BFI_TEMPLATEURL . "application/models/tinymce/");
@define("BFI_IMAGEURL", BFI_TEMPLATEURL . "application/views/images/");

@define("BFI_UPLOADPATH", $wpUploadDir['path'] . '/');
@define("BFI_TINYMCEPATH", get_template_directory() . "/application/models/tinymce/");
@define("BFI_LANGUAGESPATH", get_template_directory() . "/languages/");

@define("BFI_UPLOADHANDLERURL", BFI_TEMPLATEURL."library/includes/upload-handler.php");
@define("BFI_SITEMAPURL", BFI_TEMPLATEURL."library/includes/sitemap.php");

@define("BFI_LANGUAGEPATH", get_template_directory() . "/languages/");

@define("BFI_APPLICATIONPATH", get_template_directory()."/application/");
@define("BFI_APPLICATIONURL", BFI_TEMPLATEURL."application/");
@define("BFI_LIBRARYPATH", get_template_directory()."/library/");
@define("BFI_LIBRARYURL", BFI_TEMPLATEURL."library/");

@define("BFI_ADMINIMAGES", BFI_TEMPLATEURL."library/views/admin/images/");
@define("BFI_BLANKIMAGE", BFI_TEMPLATEURL."library/views/images/blank.png");
@define("BFI_BLANKIMAGELONG", BFI_TEMPLATEURL."library/views/images/blank_long.png");

@define("BFI_FRONTPAGEOPTION", 'frontpage_page_content'); // deprecated, Settings > Reading is now used
@define("BFI_CHARACTERSETOPTION", 'character_set');
@define("BFI_OPTIONMETAKEYWORDS", 'meta_keywords');
@define("BFI_OPTIONMETADESCRIPTION", 'meta_description');
@define("BFI_OPTIONMAINLOCALE", 'lang_main_locale');
@define("BFI_OPTIONRECAPTCHAPUBLICKEY", "recaptcha_publickey");
@define("BFI_OPTIONRECAPTCHAPRIVATEKEY", "recaptcha_privatekey");
@define("BFI_OPTIONEMAIL", "contact_email");
@define("BFI_OPTIONEMAILSUBJECT", "contact_subject");
@define("BFI_OPTIONEMAILFIELDS", "contact_additional_fields");
@define("BFI_OPTIONMAILCHIMPAPIKEY", "mailchimp_apikey");
@define("BFI_OPTIONMAILCHIMPLISTKEY", "mailchimp_listkey");
@define("BFI_OPTIONDEFAULTPAGEMEDIA", "style_default_pagemedia");
@define("BFI_OPTIONFAVICON", "favicon_url");
@define("BFI_OPTIONJAVASCRIPT", "additional_scripts");
@define("BFI_OPTIONCSS", "style_custom_css");
@define("BFI_CDNOPTION", "enable_cdn");

@define("BFI_BLANKAVATARURL", BFI_TEMPLATEURL . "library/views/images/mysteryman.png");


// try adjusting the max upload size
// @ini_set( 'upload_max_size' , '20M' );
// @ini_set( 'post_max_size', '20M');
// @ini_set( 'max_execution_time', '300' );

unset($wpUploadDir);
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'rsd_link');

if (!isset($content_width)) $content_width = BFI_CONTENTWIDTH;

?>

<?php
class BFIAdminPanelSEOModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 3;
        $this->menuName = 'SEO';
        $this->showSaveButtons = false;
        $this->additionalHTML = '';
        parent::__construct();

        add_action('admin_init', array(__CLASS__, 'addSEONotifications'));
    }
    
    public static function addSEONotifications() {
        if (!@file_exists(ABSPATH.'sitemap.xml')) {
            BFIAdminNotificationController::addNotification("You don't have a sitemap.xml file! Teach search engines how to navigate your site, head over to <a href='".get_admin_url()."admin.php?page=bfi_seo'><strong>".BFI_THEMENAME." &gt; SEO</strong></a> to generate one now.");
        }
        if (!@file_exists(ABSPATH.'robots.txt')) {
            BFIAdminNotificationController::addNotification("You don't have a robots.txt file! Tell web crawlers what to do in your site, head over to <a href='".get_admin_url()."admin.php?page=bfi_seo'><strong>".BFI_THEMENAME." &gt; SEO</strong></a> to generate one now.");
        }
    }
    
    public function createOptions() {
        $this->addOption(array(
            "name" => "Default SEO Meta Settings",
            "type" => "heading",
            ));
            
        $this->addOption(array(
            "name" => "How to Add Description and Keywords to Your Pages",
            "type" => "note",
            "desc" => "When editing your pages, blog posts and portfolio items, scroll below the content editor and fill up the SEO keywords and meta description for the specific item. Below are the default values which are shown when specific values aren't provided.",
            ));
            
        $this->addOption(array(
            "name" => "Meta Keywords",
            "desc" => "A comma-separated list of keywords that describes your website. This is used when a more specific one for the page/blog/portfolio item is not supplied.",
            "id" => BFI_OPTIONMETAKEYWORDS,
            "type" => "text",
            "std" => BFI_THEMENAME.",WordPress,Theme",
            "placeholder" => "Comma, Separated, Keywords",
            ));
            
        $this->addOption(array(
            "name" => "Meta Description<br><em class='n'>(limit to 160 chars)</em>",
            "desc" => "A description of your website's content. This is used when a more specific one for the page/blog/portfolio item is not supplied.",
            "id" => BFI_OPTIONMETADESCRIPTION,
            "type" => "text",
            "std" => "",
            "placeholder" => "Description of site contents here",
            ));
            
        $this->addOption(array(
            "name" => "",
            "type" => "custom",
            "custom" => "<em>Description currently has <input type='text' readonly id='".BFI_SHORTNAME."_description_chars' style='width: 40px; float: none;'/> characters</em>
            <script>
            jQuery(document).ready(function($) {
                $('#".BFI_SHORTNAME."_meta_description').keyup(function() {
                    $('#".BFI_SHORTNAME."_description_chars').val($(this).val().length);
                    if ($(this).val().length > 160) {
                        $('#".BFI_SHORTNAME."_description_chars').css('color', 'red');
                    } else {
                        $('#".BFI_SHORTNAME."_description_chars').css('color', 'inherit');
                    }
                });
                $('#".BFI_SHORTNAME."_meta_description').trigger('keyup');
            });
            </script>",
            ));
            
        $this->addOption(array(
            "type" => "save",
            ));
            
        $this->addOption(array(
            "name" => "Sitemap.xml Generator",
            "type" => "heading",
            ));
            
        $this->addOption(array(
            "name" => "What is a sitemap?",
            "type" => "note",
            "desc" => "A sitemap is an XML containing a list of all the links to your site's content. This is used by search engines to properly navigate the whole of your site, and sometimes they are able to provide links to the important parts of your site within the search results. A sitemap in conjuction with the meta information provided by your site will greatly enhance your site's performance in search engines.<br><br>This is similar to the sitemap template the theme provides, but instead of catering to humans, this sitemap is XML formatted for search engines and isn't visible within your website.",
            ));
            
        $excluded = bfi_get_option('sitemap_excluded_ids');
        if ($excluded) $excluded = unserialize($excluded);
        if (!$excluded) $excluded = array();
        
        if ('page' == get_option('show_on_front')) {
            $excluded[] = get_option('page_on_front');
        }
        if (bfi_get_option(BFI_FRONTPAGEOPTION)) {
            $excluded[] = bfi_get_option(BFI_FRONTPAGEOPTION);
        }
        
        $excludedStr = "";
        foreach ($excluded as $id) {
            $excludedStr .= $excludedStr ? "," : "";
            $excludedStr .= $id;
        }
            
        $this->addOption(array(
            "name" => "Generated Sitemap.xml",
            "type" => "custom",
            "custom" => "<iframe style='height: 250px' scrolling='yes' src='".BFI_SITEMAPURL."?exclude=$excludedStr'></iframe>",
            ));
            
        $this->addOption(array(
            "name" => "",
            "type" => "note",
            "desc" => "Copy <strong>ALL</strong> the code above and paste it into this file (if the file doesn't exist, create it):<br><br><pre style='background: #eee;padding: 10px;color: #333;text-shadow: none;font-size: 12px;'>".ABSPATH."sitemap.xml</pre>",
            ));
            
        $urls = BFISEO::generateSitemapXML($excluded, false);
        array_shift($urls); // remove the homepage
        $newURLOptions = array();
        $newURLValues = array();
        foreach ($urls as $url) {
            $newURLOptions[] = "{$url['title']} ({$url['post_type']}): <a href='{$url['loc']}' target='_blank'>{$url['loc']}</a>";
            $newURLValues[] = $url['id'];
        }
                    
        $this->addOption(array(
            "name" => "Excluded Page / Blog / Portfolio Items IDs",
            "type" => "multicheck",
            "options" => $newURLOptions,
            "values" => $newURLValues,
            "id" => "sitemap_excluded_ids",
            "desc" => "Check the links to exclude in the sitemap above.<br><br><strong><em>After saving your changes, the generated sitemap above will change, be sure to update your sitemap.xml file!</em></strong>",
            "placeholder" => "Comma, Separated, IDs",
            ));
            
        $this->addOption(array(
            "type" => "save",
            ));
            
        $this->addOption(array(
            "name" => "Robots.txt Generator",
            "type" => "heading",
            ));
            
        $this->addOption(array(
            "name" => "What is robots.txt?",
            "type" => "note",
            "desc" => "Robots.txt is a file that gives instructions to web crawlers and search engines. It describes what areas it can view and not view as well as the location of the sitemap.xml",
            ));
            
        $this->addOption(array(
            "name" => "Generated robots.txt",
            "type" => "custom",
            "custom" => "<pre style='padding: 10px;background: #eee;border: 1px solid #ccc; overflow: hidden'>User-agent: *

Disallow: /feed/
Disallow: /trackback/
Disallow: /wp-admin/
Disallow: /wp-content/
Disallow: /wp-includes/
Disallow: /xmlrpc.php

Sitemap: ".site_url()."/sitemap.xml</pre>",
            ));
            
        $this->addOption(array(
            "name" => "",
            "type" => "note",
            "desc" => "Copy <strong>ALL</strong> the code above and paste it into this file (if the file doesn't exist, create it):<br><br><pre style='background: #eee;padding: 10px;color: #333;text-shadow: none;font-size: 12px;'>".ABSPATH."robots.txt</pre>",
            ));
            
            /*
            
            */
    }
}

?>
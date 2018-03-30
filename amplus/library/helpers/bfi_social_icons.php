<?php
/**
 */

/**
 * Returns the font-face style for the mono social icon. The
 * font-family returned is 'Mono Social Icons Font'
 *
 * @package API\Social
 * @param string $iconFontURL The URL where the font is located.
 * Leave this blank and it will be loaded from the framework.
 * @return string The font-face style definition
 */
function bfi_get_social_icon_fontface($iconFontURL = "") {
    if (!$iconFontURL) $iconFontURL = BFI_LIBRARYURL . "views/scripts/monosocial/";
    return "
    @font-face {
        font-family: 'Mono Social Icons Font';
        src: url('{$iconFontURL}MonoSocialIconsFont-1.10.eot');
        src: url('{$iconFontURL}MonoSocialIconsFont-1.10.eot?#iefix') format('embedded-opentype'),
             url('{$iconFontURL}MonoSocialIconsFont-1.10.woff') format('woff'),
             url('{$iconFontURL}MonoSocialIconsFont-1.10.ttf') format('truetype'),
             url('{$iconFontURL}MonoSocialIconsFont-1.10.svg#MonoSocialIconsFont') format('svg');
        src: url('{$iconFontURL}MonoSocialIconsFont-1.10.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }";
}


/**
 * Returns the html code for the social icon.
 *
 * @package API\Social
 * @param string $name the id of the social icon to get
 * @param string $type the type of icon to display. Leave blank to return 
 * the regular icon, "circle" for a circular icon, "square" for a rounded
 * square icon.
 * @return mixed An array containing the html code and name of the social 
 * network. If $name did not exists, the function returns false.
 */
function bfi_get_social_icon($name, $type = "") {
    $icons = bfi_get_social_icons();
    if (array_key_exists($name, $icons)) {
        $icon = $icons[$name];
        switch ($type) {
            case "circle":
                // for circles, the character code is +200 than the regular code
                $icon["code"] = substr($icon["code"], 0, 4) 
                              . ((int)substr($icon["code"], 4, 1) + 2) 
                              . substr($icon["code"], 5);
                break;
            case "square":
                // for squares, the character code is +400 than the regular code
                $icon["code"] = substr($icon["code"], 0, 4) 
                              . ((int)substr($icon["code"], 4, 1) + 4) 
                              . substr($icon["code"], 5);
                break;
            default:
                break;
        }
        return $icon;
    }
    return false;
}


/**
 * Returns all the supported social icons
 *
 * @package API\Social
 * @return array An array containing all the network ids, html codes and 
 * social network names
 */
function bfi_get_social_icons() {
    $icons = array(
        "500px" => array("code" => "&#xe000;",
                         "name" => "500px"),
        "aboutme" => array("code" => "&#xe001;",
                           "name" => "about.me"),
        "amazon" => array("code" => "&#xe003;",
                          "name" => "Amazon"),
        "aol" => array("code" => "&#xe004;",
                       "name" => "AOL"),
        "download" => array("code" => "&#xe005;",
                            "name" => "Download"),
        "appstore" => array("code" => "&#xe006;",
                            "name" => "AppStore"),
        "apple" => array("code" => "&#xe007;",
                         "name" => "Apple"),
        "bebo" => array("code" => "&#xe008;",
                        "name" => "Bebo"),
        "behance" => array("code" => "&#xe009;",
                           "name" => "Behance"),
        "bing" => array("code" => "&#xe010;",
                        "name" => "Bing"),
        "blip" => array("code" => "&#xe011;",
                        "name" => "Blip"),
        "blogger" => array("code" => "&#xe012;",
                           "name" => "Blogger"),
        "coroflot" => array("code" => "&#xe013;",
                            "name" => "Coroflot"),
        "daytum" => array("code" => "&#xe014;",
                          "name" => "Daytum"),
        "delicious" => array("code" => "&#xe015;",
                             "name" => "Delicious"),
        "designbump" => array("code" => "&#xe016;",
                              "name" => "Design Bump"),
        "designfloat" => array("code" => "&#xe017;",
                               "name" => "DesignFloat"),
        "deviantart" => array("code" => "&#xe018;",
                              "name" => "deviantART"),
        "digg" => array("code" => "&#xe020;",
                        "name" => "Digg"),
        "dribble" => array("code" => "&#xe021;",
                           "name" => "Dribble"),
        "drupal" => array("code" => "&#xe022;",
                          "name" => "Drupal"),
        "ebay" => array("code" => "&#xe023;",
                        "name" => "eBay"),
        "email" => array("code" => "&#xe024;",
                        "name" => "Email"),
        "etsy" => array("code" => "&#xe026;",
                        "name" => "Etsy"),
        "facebook" => array("code" => "&#xe027;",
                            "name" => "Facebook"),
        "feedburner" => array("code" => "&#xe028;",
                              "name" => "FeedBurner"),
        "flickr" => array("code" => "&#xe029;",
                          "name" => "Flickr"),
        "footspotting" => array("code" => "&#xe030;",
                                "name" => "Foodspitting"),
        "forrst" => array("code" => "&#xe031;",
                          "name" => "Forrst"),
        "foursquare" => array("code" => "&#xe032;",
                              "name" => "Foursquare"),
        "friendsfeed" => array("code" => "&#xe033;",
                               "name" => "FriendsFeed"),
        "friendstar" => array("code" => "&#xe034;",
                              "name" => "FriendStar"),
        "gdgt" => array("code" => "&#xe035;",
                        "name" => "Gdgt"),
        "github" => array("code" => "&#xe036;",
                          "name" => "Github"),
        "googleplus" => array("code" => "&#xe039;",
                              "name" => "Google+"),
        "googletalk" => array("code" => "&#xe040;",
                              "name" => "Google Talk"),
        "grooveshark" => array("code" => "&#xe043;",
                               "name" => "Grooveshark"),
        "hyves" => array("code" => "&#xe045;",
                         "name" => "Hyves"),
        "icondock" => array("code" => "&#xe046;",
                            "name" => "IconDock"),
        "icq" => array("code" => "&#xe047;",
                       "name" => "ICQ"),
        "identica" => array("code" => "&#xe048;",
                            "name" => "Identi.ca"),
        "itunes" => array("code" => "&#xe050;",
                          "name" => "iTunes"),
        "lastfm" => array("code" => "&#xe051;",
                          "name" => "Last.fm"),
        "linkedin" => array("code" => "&#xe052;",
                            "name" => "LinkedIn"),
        "meetup" => array("code" => "&#xe053;",
                          "name" => "Meetup"),
        "metacafe" => array("code" => "&#xe054;",
                            "name" => "Metacafe"),
        "mixx" => array("code" => "&#xe055;",
                        "name" => "Mixx"),
        "msn" => array("code" => "&#xe058;",
                       "name" => "MSN"),
        "myspace" => array("code" => "&#xe059;",
                            "name" => "Myspace"),
        "newsvine" => array("code" => "&#xe060;",
                            "name" => "Newsvine"),
        "paypal" => array("code" => "&#xe061;",
                          "name" => "PayPal"),
        "photobucket" => array("code" => "&#xe062;",
                               "name" => "Photobucket"),
        "picasa" => array("code" => "&#xe063;",
                          "name" => "Picasa"),
        "pinterest" => array("code" => "&#xe064;",
                             "name" => "Pinterest"),
        "posterous" => array("code" => "&#xe066;",
                             "name" => "Posterous"),
        "qik" => array("code" => "&#xe067;",
                       "name" => "Qik"),
        "quora" => array("code" => "&#xe068;",
                         "name" => "Quora"),
        "reddit" => array("code" => "&#xe069;",
                          "name" => "Reddit"),
        "rss" => array("code" => "&#xe071;",
                       "name" => "RSS"),
        "scribd" => array("code" => "&#xe072;",
                          "name" => "Scribd"),
        "skype" => array("code" => "&#xe074;",
                         "name" => "Skype"),
        "slashdot" => array("code" => "&#xe075;",
                            "name" => "Slashdot"),
        "slideshare" => array("code" => "&#xe076;",
                              "name" => "SlideShare"),
        "smugmug" => array("code" => "&#xe077;",
                           "name" => "SmugMug"),
        "soundcloud" => array("code" => "&#xe078;",
                              "name" => "SoundCloud"),
        "spotify" => array("code" => "&#xe079;",
                          "name" => "Spotify"),
        "squidoo" => array("code" => "&#xe080;",
                           "name" => "Squidoo"),
        "stackoverflow" => array("code" => "&#xe081;",
                                 "name" => "Stack Overflow"),
        "stumbleupon" => array("code" => "&#xe083;",
                               "name" => "StumbleUpon"),
        "technorati" => array("code" => "&#xe084;",
                              "name" => "Technorati"),
        "tumblr" => array("code" => "&#xe085;",
                          "name" => "Tumblr"),
        "twitter" => array("code" => "&#xe086;",
                           "name" => "Twitter"),
        "viddler" => array("code" => "&#xe088;",
                           "name" => "Viddler"),
        "vimeo" => array("code" => "&#xe089;",
                         "name" => "Vimeo"),
        "wikipedia" => array("code" => "&#xe092;",
                             "name" => "Wikipedia"),
        "windows" => array("code" => "&#xe093;",
                           "name" => "Windows"),
        "wordpress" => array("code" => "&#xe094;",
                             "name" => "WordPress"),
        "xing" => array("code" => "&#xe095;",
                        "name" => "XING"),
        "yahoobuzz" => array("code" => "&#xe096;",
                             "name" => "Yahoo! Buzz"),
        "yahoo" => array("code" => "&#xe097;",
                         "name" => "Yahoo!"),
        "wordpress" => array("code" => "&#xe094;",
                             "name" => "WordPress"),
        "yelp" => array("code" => "&#xe098;",
                        "name" => "Yelp"),
        "youtube" => array("code" => "&#xe099;",
                           "name" => "YouTube"),
        "instagram" => array("code" => "&#xe100;",
                             "name" => "Instagram"),
    );
    ksort($icons);
    return $icons;
}

?>
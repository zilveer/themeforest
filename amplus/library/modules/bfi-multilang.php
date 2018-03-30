<?php

if (!isset($_SESSION)) session_start();

// don't change the locale of the admin
if (!is_admin()) {
    add_filter('locale', 'bfi_locale_switcher');
}
add_action('after_setup_theme', 'bfi_locale_loader');

add_filter('author_feed_link', 'bfi_multilang_convert_url');
add_filter('author_link','bfi_multilang_convert_url');
add_filter('author_feed_link', 'bfi_multilang_convert_url');
add_filter('day_link', 'bfi_multilang_convert_url');
add_filter('get_comment_author_url_link', 'bfi_multilang_convert_url');
add_filter('month_link','bfi_multilang_convert_url');
add_filter('page_link', 'bfi_multilang_convert_url');
add_filter('post_link', 'bfi_multilang_convert_url');
add_filter('year_link', 'bfi_multilang_convert_url');
add_filter('category_feed_link', 'bfi_multilang_convert_url');
add_filter('category_link','bfi_multilang_convert_url');
add_filter('tag_link', 'bfi_multilang_convert_url');
add_filter('term_link', 'bfi_multilang_convert_url');
add_filter('the_permalink', 'bfi_multilang_convert_url');
add_filter('feed_link', 'bfi_multilang_convert_url');
add_filter('post_comments_feed_link', 'bfi_multilang_convert_url');
add_filter('tag_feed_link','bfi_multilang_convert_url');

add_filter('the_content', 'bfi_multilang_content', 10, 2);
add_filter('the_title', 'bfi_multilang_title', 10, 2);

add_filter('posts_where', 'bfi_multilang_custom_search', 10, 2);

// create fields
add_action('admin_menu', 'bfi_multilang_create_meta', 5);
add_action('admin_head', 'bfi_multilang_meta_style', 5);

add_action('save_post', 'bfi_save_page_lang_meta_box');

// create translation filters for the options on the fly
add_action('wp', 'bfi_multilang_create_option_filters');
// translation filters for meta data are provided by bfi_multilang_get_post_meta()

// add alternative header tags for the other languages
add_action('wp_head', 'bfi_alternative_lang_headers');

// used to stop recursive calls
global $bfi_multilang_content_done, $bfi_multilang_title_done; 
$bfi_multilang_content_done = array();
$bfi_multilang_title_done = array();

// called by helpers.php
// kind of like a made up hook since WP doesn't provide one for meta data
function bfi_multilang_get_post_meta($post_id, $key, $single = false) {
    if (is_admin() || !isset($_SESSION['l'])) 
        return array("post_id" => $post_id,
                     "key" => $key,
                     "result" => get_post_meta($post_id, $key, $single));
         
    $language = $_SESSION['l'];
    
    // check if there is a translation available for the current language
    if (preg_match('/^'.BFI_SHORTNAME.'\_/', $key)) {
        $newKey = $key.'_'.$language;
        $result = get_post_meta($post_id, $newKey, $single);
        if ($result != '') {
            $match = false;
            $match = apply_filters('bfi_multilang_get_post_meta_is_empty', $result);
            // we need to also check for if $match isn't $result for themes
            // that do not implement this filter
            if ($match === true && $match != $result) {
                    
            } else {
                return array("post_id" => $post_id,
                             "key" => $newKey,
                             "result" => $result);
            }
        }
    }
    return array("post_id" => $post_id,
                 "key" => $key,
                 "result" => get_post_meta($post_id, $key, $single));
}

function bfi_alternative_lang_headers() {
    $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
    if ($languages) {
        $languages = unserialize($languages);
        if (count($languages)) {
            foreach ($languages as $lang => $locale) {
                $locale = preg_replace('#_#', '-', $locale);
                $url = bfi_add_get_var(bfi_get_current_url(), 'l', $lang);
                echo "<link rel='alternate' hreflang='$locale' href='$url' />";
            }
        }
    }
}


/*
 * THIS IS DEPRICATED SINCE WE ARE NOW USING THE FUNCTION BFI_GET_OPTION TO STORE ALL THE THEME OPTIONS
 */
function bfi_multilang_create_option_filters() {
    $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
    if (!$languages) return;
    
    $languages = unserialize($languages);
    if (!count($languages)) return;
    
    // create regex search term for the languages
    $languageMatch = '('.implode('|', array_keys($languages)).')';
    
    // search through the list of available options and find the ones
    // which are for multi-language translation
    $filtersCreated = array(); 
    $options = wp_load_alloptions();
    foreach ($options as $optionName => $value) {
        if (preg_match('/^'.BFI_SHORTNAME.'\_/', $optionName) &&
            preg_match('/\_'.$languageMatch.'$/', $optionName)) {
            $optionName = preg_replace('/\_'.$languageMatch.'$/', '', $optionName);
            $filter = 'option_'.$optionName;
            
            // create a filter for each of the multi-lingual options
            // so that we can translate them if needed
            if (array_search($filter, $filtersCreated) === false) {
                $filtersCreated[] = $filter;
                add_filter($filter, create_function('$a',
                    // return the language if available, or return the default value
                    '
                    if (isset($_SESSION["l"])) {
                        if (bfi_get_option("'.$optionName.'_".$_SESSION["l"])) {
                            return bfi_get_option("'.$optionName.'_".$_SESSION["l"]);
                        }
                    }
                    return $a;
                    '));
            }
        }
    }
}

// Initializes date translations as well as
// Forces RTL on RTL languages
// Language source: http://meta.wikimedia.org/wiki/Template:List_of_language_names_ordered_by_code
function bfi_set_local_translations($locale) {
    // Create new date translation
    global $wp_locale;
    $wp_locale = new BFI_Locale();
    
    // get the language from the locale
    if (stripos($locale, '_') !== false) {
        $l = explode('_', $locale);
        if (count($l) > 0) {
            // $l[0] carries the language name
            if (in_array($l[0], array(
                'ar', // Arabic
                'arc', // Aramaic
                'dv', // Divehi
                'fa', // Persian
                'ha', // Hausa
                'he', // Hebrew
                'khw', // Khowar
                'ks', // Kashmiri
                'ku', // Kurdish
                'ps', // Pashto
                'ur', // Urdu
                'yi', // Yiddish
                ))) {
                // set RTL if we need it
                $wp_locale->text_direction = 'rtl';
            }
        }
    }
    // set other PHP stuff to the local also
    // setlocale(LC_ALL, $locale);
    
    return $locale;
}

function bfi_locale_switcher($locale) {
    $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
    
    // check the url, set it in the session
    if (isset($_GET['l']) && $languages !== false) {
        $languages = unserialize($languages);
        
        // find the assigned locale for this language
        if (array_key_exists($_GET['l'], $languages)) {
            $_SESSION['l'] = $_GET['l'];
            return bfi_set_local_translations($languages[$_GET['l']]);
            
        // if not found, check if it's the default one
        } else {
            if (bfi_get_option(BFI_OPTIONMAINLOCALE)) {
                $defaultLocale = explode('_', bfi_get_option(BFI_OPTIONMAINLOCALE));
                if (count($defaultLocale)) {
                    if ($_GET['l'] == $defaultLocale[0]) {
                        $_GET['l'] = '';
                        unset($_SESSION['l']);
                    }
                }
            }
        }
    }
    
    $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
    // get the language from the session
    if (isset($_SESSION['l']) && $languages !== false) {
        $languages = unserialize($languages);
        
        // find the assigned locale for this language
        if (array_key_exists($_SESSION['l'], $languages)) {
            return bfi_set_local_translations($languages[$_SESSION['l']]);
            
        // if not found, revert to the default one
        } else {
            unset($_SESSION['l']);
        }
    }    
    
    // use the default    
    $l = $locale;
    
    // check the admin setting if there's a selected locale
    $adminLang = bfi_get_option(BFI_OPTIONMAINLOCALE);
    $l = $adminLang ? $adminLang : $l;
    
    return bfi_set_local_translations($l);
}


function bfi_locale_loader() {
    // include the language. Don't use the constant BFI_I18NDOMAIN for this line to prevent
    // a compatibility note in i18n plugins
    load_theme_textdomain(BFI_SHORTNAME, BFI_LANGUAGESPATH);
}


function bfi_multilang_convert_url($url) {
    if (!isset($_SESSION['l'])) return $url;
    
    // Add the language GET variable in all the available links
    if (preg_match('/\?/', $url)) {
        if (preg_match('/\?l=[^\&]+/i', $url)) {
            return preg_replace('/\?l=[^\&]+/i', '?l='.$_SESSION['l'], $url);
        } else if (preg_match('/\&l=[^\&]+/i', $url)) {
            return preg_replace('/\&l=[^\&]+/i', '&l='.$_SESSION['l'], $url);
        } else {
            return $url.'&l='.$_SESSION['l'];
        }
    } else {
        return $url.'?l='.$_SESSION['l'];
    }
    return $url;
}


function bfi_multilang_content($content, $post_id = null)
{
    global $post, $bfi_multilang_content_done;

    // if no given post id, then we're in a single post
    if (is_null($post_id)) {
        if (!empty($post) && property_exists($post, 'ID')) {
            $post_id = $post->ID;
        }
        if (!$post_id) return $content;
    }
    
    if (!isset($_SESSION) || !isset($_SESSION['l'])) return $content;
    
    // check if translation is available
    if (!bfi_get_post_meta($post_id, 'bfi_lang_'.$_SESSION['l'].'_content', true)) return $content;
    return bfi_get_post_meta($post_id, 'bfi_lang_'.$_SESSION['l'].'_content', true);
    
    // stop infinite loops
    $key = $post->post_type.'-'.$post_id;
    if (!array_key_exists($key, $bfi_multilang_content_done)) {
        $bfi_multilang_content_done[$key] = 0;
    }
    $bfi_multilang_content_done[$key]++;
    if ($bfi_multilang_content_done[$key] > 5) {
        $bfi_multilang_content_done[$key] = 0;
        return $content;
    }
    
    // if there is no translated content, just return the normal content
    if (!bfi_get_post_meta($post_id, 'bfi_lang_'.$_SESSION['l'].'_content', true)) return $content;
    // or return the translated content
    // return bfi_get_post_meta($post_id, 'bfi_lang_'.$_SESSION['l'].'_content', true);
    return apply_filters('the_content', bfi_get_post_meta($post_id, 'bfi_lang_'.$_SESSION['l'].'_content', true));
}


function bfi_multilang_title($content, $post_id = null)
{
    global $post, $bfi_multilang_title_done, $id;

    // if no given post id, then we're in a single post
    if (is_null($post_id)) {
        $post_id = $post->ID;
        if (!$post_id) return $content;
    }
    
    if (!isset($_SESSION) || !isset($_SESSION['l'])) return $content;

    // check if translation is available
    
    if (!bfi_get_post_meta($post_id, 'bfi_lang_'.$_SESSION['l'].'_title', true)) return $content;
    
    return bfi_get_post_meta($post_id, 'bfi_lang_'.$_SESSION['l'].'_title', true);
    
    // stop infinite loops
    $key = $post->post_type.'-'.$post_id;
    if (!array_key_exists($key, $bfi_multilang_title_done)) {
        $bfi_multilang_title_done[$key] = 0;
    }
    $bfi_multilang_title_done[$key]++;
    if ($bfi_multilang_title_done[$key] > 5) {
        $bfi_multilang_title_done[$key] = 0;
        return $content;
    }
    
    return $content;//apply_filters('the_title', bfi_get_post_meta($post_id, 'bfi_lang_'.$_SESSION['l'].'_title', true));
}


function bfi_multilang_custom_search($where, $s) {
    global $wpdb;
    if (!is_search()) { return $where; }

    if (!isset($_SESSION['l'])) return $where;
    
    $cont = 'bfi_lang_'.$_SESSION['l'].'_content';
    $title = 'bfi_lang_'.$_SESSION['l'].'_title';

    // add query for if both language content & title are available 
    $query .= " ( $wpdb->posts.ID IN ( 
        SELECT post_id as ID from $wpdb->postmeta WHERE 
            ($wpdb->postmeta.meta_key = '$cont' AND $wpdb->postmeta.meta_value like '%".get_query_var('s')."%') 
        OR
            ($wpdb->postmeta.meta_key = '$title' AND $wpdb->postmeta.meta_value like '%".get_query_var('s')."%')
        )";

    // add query for if only data for the language content is available 
    $query .= " OR (
        $wpdb->posts.ID NOT IN 
            (SELECT post_id as ID from $wpdb->postmeta WHERE $wpdb->postmeta.meta_key = '$cont')
        AND
            $wpdb->posts.post_content LIKE '%".get_query_var('s')."%'
        )";
        
    // add query for if only data for the language title is available
    $query .= " OR (
        $wpdb->posts.ID NOT IN 
            (SELECT post_id as ID from $wpdb->postmeta WHERE $wpdb->postmeta.meta_key = '$title')
        AND
            $wpdb->posts.post_title LIKE '%".get_query_var('s')."%'
        )
        
        )";

    // the rest of the normal search query
    $where = "
        AND $query  
        AND 
        $wpdb->posts.post_type IN ('post', 'page', 'attachment', '".BFIPortfolioModel::POST_TYPE."') 
        AND 
        ($wpdb->posts.post_status = 'publish' OR $wpdb->posts.post_author = 1 AND $wpdb->posts.post_status = 'private')";

    return $where;
}


function bfi_multilang_meta_style() {
    ?>
    <style>
        .meta-container.language-editor .mceLayout {
            border: 1px solid #ccc !important;
            background: white;
        }
        .bfi_lang_title {
            padding: 3px 4px;
            font-size: 1.7em;
        }
        .meta-container.language-editor .mceLayout, .bfi_lang_title {
            border-width: 1px;
            border-style: solid;
            -moz-border-radius: 3px;
            -khtml-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
    -moz-background-clip: padding; -webkit-background-clip: padding-box; background-clip: padding-box;
        }
        .meta-container.language-editor #media-buttons {
            float: left;
            margin-left: 50px;
            line-height: 14px;
        }
        .buttons_hidden {
            display: none;
            float: left;
            margin-left: 50px;
            line-height: 30px;
            color: red;
        }
    </style>
    <?php
}

function bfi_multilang_create_meta() {
    if ( function_exists('add_meta_box') ) {
        $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
        if ($languages == "") return;
        $languages = unserialize($languages);
        $languageNames = bfi_list_languages();
        foreach ($languages as $language => $locale) {
            $languageName = $languageNames[$language];
            
            $flag = explode('_', $locale);
            if (count($flag) > 1) {
                $flag = $flag[1];
                $flag = "<img src='".BFI_IMAGEURL."blank.png' class='flag flag-".strtolower($flag)."' />";
            } else {
                $flag = '';
            }
        
            add_meta_box( 'bfi_page_lang_'.$language, '<div class="icon-small"></div> '.strtoupper(BFI_THEMENAME).' '.strtoupper($languageName).' ('.strtoupper($language).') CONTENT '.$flag, 'bfi_print_page_lang_meta_box', 'page', 'normal', 'high', array("lang" => $language, "langname" => $languageName));
            add_meta_box( 'bfi_page_lang_'.$language, '<div class="icon-small"></div> '.strtoupper(BFI_THEMENAME).' '.strtoupper($languageName).' ('.strtoupper($language).') CONTENT '.$flag, 'bfi_print_page_lang_meta_box', 'post', 'normal', 'high', array("lang" => $language, "langname" => $languageName));
            add_meta_box( 'bfi_page_lang_'.$language, '<div class="icon-small"></div> '.strtoupper(BFI_THEMENAME).' '.strtoupper($languageName).' ('.strtoupper($language).') CONTENT '.$flag, 'bfi_print_page_lang_meta_box', BFIPortfolioModel::POST_TYPE, 'normal', 'high', array("lang" => $language, "langname" => $languageName));
        }
    }
}

function bfi_print_page_lang_meta_box($post, $args) {
    $id = "bfi_lang_".$args['args']['lang'];
    ?>
    <div class="meta-container language-editor">
        <input type="hidden" name="<?php echo $id ?>_noncename" id="<?php echo $id ?>_noncename" value="<?php echo wp_create_nonce(BFI_TEMPLATEURL) ?>" />
        <div class="meta-description" style="margin-bottom: 18px; font-style: italic">The contents here will be displayed instead of the original contents above if the current language in use is set to <strong><?php echo $args['args']['langname'] ?> (<?php echo $args['args']['lang'] ?>)</strong></div>
        <h2 style="margin-top: 0; margin-bottom: 0">Page Title</h2>
        <input type="text" name="<?php echo $id ?>_title" value="<?php echo bfi_get_post_meta($post->ID, $id.'_title', true) ?>" class="meta-input bfi_lang_title" style="width: 100%"/>
        <div style="clear: both"></div>
        <?php
        // The new super easy WP 3.3.1 way. Old one is now broken
        wp_editor(bfi_get_post_meta($post->ID, $id.'_content', true), $id.'_content');
        ?>
    </div>
    <div style="clear: both"></div>
    <?php
}


function bfi_save_page_lang_meta_box($post_id) {
    if (!$_POST) return $post_id;
    $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
    if ($languages == "") return;
    $languages = unserialize($languages);
    $languageNames = bfi_list_languages();
    foreach ($languages as $language => $locale) {
        
        $id = "bfi_lang_".$language;
        
        if (!array_key_exists($id.'_noncename', $_POST)) continue;
    
        // Verify
        if ( !wp_verify_nonce( $_POST[$id.'_noncename'], BFI_TEMPLATEURL )) {
            return $post_id;
        }
        
        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can('edit_pages'))
            return $post_id;
        } else {
            if ( !current_user_can('edit_posts'))
            return $post_id;
        }
        
        // since WP 3.5 use the global post variable $post->ID when saving data
        // since $post_id gives a different ID
        global $post;
        
        // save the title
        $metaName = $id.'_title';
        $data = $_POST[$id.'_title'];
        if(bfi_get_post_meta($post->ID, $metaName) == "") {
            delete_post_meta($post->ID, $metaName);
            add_post_meta($post->ID, $metaName, $data);
        } elseif($data != bfi_get_post_meta($post->ID, $metaName)) {
            update_post_meta($post->ID, $metaName, $data);
        } elseif($data == "") {
            delete_post_meta($post->ID, $metaName);
        }
        
        // save the content
        $metaName = $id.'_content';
        $data = apply_filters('content_save_pre', $_POST[$id.'_content']);
        if(bfi_get_post_meta($post->ID, $metaName) == "") {
            delete_post_meta($post->ID, $metaName);
            add_post_meta($post->ID, $metaName, $data);
        } elseif($data != bfi_get_post_meta($post->ID, $metaName)) {
            update_post_meta($post->ID, $metaName, $data);
        } elseif($data == "") {
            delete_post_meta($post->ID, $metaName);
        }
    }
}

// create additional option fields for translation purposes
function bfi_multilang_create_extra_language_options($options) {
    $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
    $languageNames = bfi_list_languages();
    if ($languages) {
        $languages = unserialize($languages);
        $languages = array_reverse($languages);
        
        // get the default locale
        $defaultLanguage = bfi_get_option(BFI_OPTIONMAINLOCALE);
        $defaultLanguageName = '';
        if ($defaultLanguage) {
            $defaultLanguage = explode('_', $defaultLanguage);
            $defaultLanguage = $defaultLanguage[0];
        }
        if ($defaultLanguage) {
            if (array_key_exists($defaultLanguage, $languageNames)) {
                $defaultLanguageName = $languageNames[$defaultLanguage];
            }
        }
        
        if (count($languages)) {
            // go through all the options and get all the translatable options
            for ($i = count($options) - 1; $i >= 0; $i--) {
                if ($options[$i]->getType() == 'translatabletext' ||
                    $options[$i]->getType() == 'translatabletextarea') {
                        
                    // for each translatable option, create a new option field PER language
                    foreach ($languages as $language => $value) {
                        $languageName = $languageNames[$language];
                        $newProperties = $options[$i]->getProperties();
                        $newProperties['id'] .= '_'.$language;
                        $newProperties['name'] .= '<br><em class="lang_note">Language: '.$languageName.' ('.$language.')</em>';
                        $newProperties['desc'] .= '<br><strong class="lang_note"><em>Shown if the language is switched to '.$languageName.' ('.$language.')</em></strong>';
                        $newOption = BFIAdminOptionModel::factory($newProperties);
                        array_splice($options, $i + 1, 0, array($newOption));
                    }
                    
                    // add new descriptions to the original option 
                    if ($defaultLanguageName && $defaultLanguage) {
                        $options[$i]->setProperty('name', $options[$i]->getName() . '<br><em class="lang_note">Default language: '.$defaultLanguageName.' ('.$defaultLanguage.')</em>'); 
                        $options[$i]->setProperty('desc', $options[$i]->getdesc() . '<br><strong class="lang_note"><em>Shown if the language is defaulted to '.$defaultLanguageName.' ('.$defaultLanguage.')</em></strong>');
                    }
                }
            }
        }
    }
    return $options;
}

?>

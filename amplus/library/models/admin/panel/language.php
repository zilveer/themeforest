<?php
class BFIAdminPanelLanguageModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 5;
        $this->menuName = 'Language';
        $this->showSaveButtons = false;
        $this->additionalHTML = '';
        parent::__construct();
        add_action('admin_head', array($this, 'initTranslationEditorScript'));
    }
    
    public function createOptions() {
        // check for added languages for multilingual websites
        if (isset($_REQUEST["action"]) && $_REQUEST['action'] == 'save') {
            if (isset($_REQUEST[BFI_SHORTNAME."_multilang_add_new_lang"]) &&
                isset($_REQUEST[BFI_SHORTNAME."_multilang_add_new_locale"]) &&
                $_REQUEST[BFI_SHORTNAME."_multilang_add_new_lang"] != '' &&
                $_REQUEST[BFI_SHORTNAME."_multilang_add_new_locale"] != '') {
                BFIAdminNotificationController::addNotification("<strong>New content editors and options have been added</strong> in your pages, posts, portfolio items, menus and in some of the ".BFI_THEMENAME." admin panels specific to the new language you just added.");
            }
        // check for removed languages for multilingual websites
        } else if (isset($_REQUEST["action-custom"]) && $_REQUEST['action-custom'] == 'delete-lang') {
            BFIAdminNotificationController::addNotification("<strong>Content editors and options have been removed</strong> from your pages, posts, portfolio items, and in some of the ".BFI_THEMENAME." admin panels specific to the language you just removed.");
        }
        
        
        $multiLanguages = array();
        
        if (!bfi_get_option(BFI_SHORTNAME."_multilanguages")) {
            bfi_update_option(BFI_SHORTNAME."_multilanguages", serialize(array()));
        }
        $extendedForm = "";
        
        $countrList = bfi_list_countries();
        asort($countrList);
        
        $localeNames = array();
        $localeValues = array();
        
        $availableLanguages = bfi_list_languages();
        
        $dh = opendir(BFI_LANGUAGESPATH);
        while (($file = readdir($dh)) !== false) {
            if (preg_match('/\.po$/i', $file)) {
                $loc = preg_replace('/\.po$/i', '', $file);
                $localeValues[] = $loc;
                $localeNames[] = '<strong>'.$loc . '</strong>, ' . bfi_locale_code_to_words($loc);
            }
        }
        closedir($dh);
        
        // Add new multi-language if adding new
        $multiLanguages = unserialize(bfi_get_option(BFI_SHORTNAME."_multilanguages"));
        if (isset($_REQUEST["action"]) && $_REQUEST['action'] == 'save') {
            if ($_REQUEST[BFI_SHORTNAME."_multilang_add_new_lang"] != '' &&
                $_REQUEST[BFI_SHORTNAME."_multilang_add_new_locale"] != '') {

                $multiLanguages[$_REQUEST[BFI_SHORTNAME."_multilang_add_new_lang"]] = $_REQUEST[BFI_SHORTNAME."_multilang_add_new_locale"];
                bfi_update_option(BFI_SHORTNAME."_multilanguages", serialize($multiLanguages));
                
                $_REQUEST[BFI_SHORTNAME."_multilang_add_new_lang"] = '';
                $_REQUEST[BFI_SHORTNAME."_multilang_add_new_locale"] = '';
            }

        // delete language from multi-language list
        } else if (isset($_REQUEST["action-custom"]) && $_REQUEST['action-custom'] == 'delete-lang') {
            if (array_key_exists($_REQUEST['language'], $multiLanguages)) {
                unset($multiLanguages[$_REQUEST['language']]);
                bfi_update_option(BFI_SHORTNAME."_multilanguages", serialize($multiLanguages));
            }
            $_REQUEST['msg'] = "Successfully deleted language";
            
        // create new locale
        } else if (isset($_REQUEST["action-custom"]) && $_REQUEST['action-custom'] == 'create-locale') {
            if ($_REQUEST['language'] != '' &&
                $_REQUEST['country'] != '') {
                
                $newLocale = $_REQUEST['language'] . "_" . $_REQUEST['country'];

                if (array_search($newLocale, $localeValues) === false) {
                    if (copy(BFI_LANGUAGESPATH."en_US.po", BFI_LANGUAGESPATH.$newLocale.".po") &&
                        copy(BFI_LANGUAGESPATH."en_US.mo", BFI_LANGUAGESPATH.$newLocale.".mo")) {
                        $_REQUEST['msg'] = __("Successfully created locale", BFI_I18NDOMAIN);
                        // add to the current list
                        $localeValues[] = $newLocale;
                        $localeNames[] = '<strong>'.$newLocale . '</strong>, ' . bfi_locale_code_to_words($newLocale);
                    } else {
                        $_REQUEST['err'] = __("Failed to create new locale: could not create language files", BFI_I18NDOMAIN);
                    }
                } else {
                    $_REQUEST['err'] = __("Failed to create new locale: Locale already exists.", BFI_I18NDOMAIN);
                }
                    
            } else {
                $_REQUEST['err'] = __("Failed to create new locale: Please select both a language and a country.", BFI_I18NDOMAIN);
            }
            
        // delete locale
        } else if (isset($_REQUEST["action-custom"]) && $_REQUEST['action-custom'] == 'delete-locale') {
            $locale = $_REQUEST['locale'];
            if (strtolower($locale) != "en_us") {
                $success = true;
                if (file_exists(BFI_LANGUAGESPATH.$locale.".mo")) {
                    if (!@unlink(BFI_LANGUAGESPATH.$locale.".mo")) {
                        $_REQUEST['err'] = sprintf(__("Cannot delete %s, please delete it manually", BFI_I18NDOMAIN), BFI_LANGUAGESPATH.$locale.".mo");
                        $success = false;
                    }
                }
                if (file_exists(BFI_LANGUAGESPATH.$locale.".po")) {
                    if (!@unlink(BFI_LANGUAGESPATH.$locale.".po")) {
                        $_REQUEST['err'] = sprintf(__("Cannot delete %s, please delete it manually", BFI_I18NDOMAIN), BFI_LANGUAGESPATH.$locale.".po");
                        $success = false;
                    }
                }
                if ($success) {
                    $_REQUEST['msg'] = __("Successfully deleted locale", BFI_I18NDOMAIN);
                    
                    // refresh locale list
                    $localeNames = array();
                    $localeValues = array();
                    $dh = opendir(BFI_LANGUAGESPATH);
                    while (($file = readdir($dh)) !== false) {
                        if (preg_match('/\.po$/i', $file)) {
                            $loc = preg_replace('/\.po$/i', '', $file);
                            $localeValues[] = $loc;
                            $localeNames[] = '<strong>'.$loc . '</strong>, ' . bfi_locale_code_to_words($loc);
                        }
                    }
                    closedir($dh);
                }
            } else {
                $_REQUEST['err'] = __("Deleting en_US locale is not allowed.", BFI_I18NDOMAIN);
            }
        }
            
        if(is_string($multiLanguages))
            $multiLanguages = preg_match('/^([adObis]:|N;)/', $multiLanguages) ? unserialize($multiLanguages) : $multiLanguages;

        // remove the option to add a language which is already in use
        foreach ($multiLanguages as $langToRemove => $name) {
            if (array_key_exists($langToRemove, $availableLanguages)) {
                unset($availableLanguages[$langToRemove]);
            }
        }
        $langToRemove = bfi_get_option(BFI_OPTIONMAINLOCALE);
        if ($langToRemove !== false) {
            $langToRemove = explode("_", $langToRemove);
            if (count($langToRemove)) {
                $langToRemove = $langToRemove[0];
                if (array_key_exists($langToRemove, $availableLanguages)) {
                    unset($availableLanguages[$langToRemove]);
                }
            }
        }
        
        
        // create the delete forms for the multi-languages
        foreach ($multiLanguages as $language => $locale) {
            $this->additionalHTML .= "
                <form method='post' id='deletelang$language'>
                    <input type='hidden' name='action-custom' value='delete-lang'/>
                    <input type='hidden' name='language' value='$language'/>
                </form>
                ";
        }
        
        // create and delete forms for locales
        $this->additionalHTML .= "
            <form method='post' id='createlocale'>
                <input type='hidden' name='action-custom' value='create-locale'/>
                <input type='hidden' name='language' id='new_locale_language' value=''/>
                <input type='hidden' name='country' id='new_locale_country' value=''/>
            </form>
            <form method='post' id='deletelocale'>
                <input type='hidden' name='action-custom' value='delete-locale'/>
                <input type='hidden' name='locale' id='delete_locale' value=''/>
            </form>
            ";
            
            
            
        
        $this->addOption(array(
            "name" => "What's in here?",
            "desc" => "The settings here are for changing the fixed words found in the theme (e.g. the 404 error message), or translating your site to a different languages, or for translating your site to multiple languages.",
            "type" => "note",
            ));
            
        $this->addOption(array(
            "name" => "How to change the fixed wordings in the theme",
            "desc" => "To retain the default translation (English) and change certain wordings found in the theme (e.g. the 404 error message), go to the <strong>Edit Locale Translations</strong> settings below. Then click on the <strong>Edit Translations...</strong> button for the English translation. Additional instructions are available below.",
            "type" => "note",
            ));
            
        $this->addOption(array(
            "name" => "How to translate to a different language",
            "desc" => "To translate to a different language, you'll need to <strong>Add a New Locale</strong> in the configuration below. After creating a new one, the new locale will be listed in the <strong>Edit Locale Translations</strong> area below. Click on the <strong>Edit Translations...</strong> button on your new locale to edit the fixed wordings found in the theme. After finishing your locale translations, in the <strong>Main Settings</strong>, select the locale you created as your <strong>Main Locale</strong>.",
            "type" => "note",
            ));
            
        $this->addOption(array(
            "name" => "How to translate to multiple languages",
            "desc" => "To translate to multiple languages, you'll <em>first need to create a new locale</em> by following the instructions above for &quot;<strong>How to translate to a different language</strong>&quot;. After that head over to the <strong>Add New Language Translation</strong> area below, and choose your language and the locale to use, then click on the <strong>Add new language</strong> button.<br><br>When you're done, new content editors/fields and text fields will be made available in the menu and theme configurations. Also, clickable language flags will be displayed on your site to allow your visitors to switch between different languages.",
            "type" => "note",
            ));
            
            
        $this->addOption(array(
            "name" => "Main Settings",
            "type" => "heading"
            ));
            
        $this->addOption(array(
            "name" => "Content Character Sets",
            "desc" => "You may want to include other character sets if your content text has content from different languages. Be wary of choosing a lot of character sets, each character set increases the filesize of the font each visitor would have to download when your site loads.",
            "type" => "multicheckCharacterSet",
            ));
            
        $this->addOption(array(
            "name" => "Main Locale",
            "desc" => "Choose the default locale for the site. You can create new locales or edit existing translations in the sections below.",
            "id" => BFI_OPTIONMAINLOCALE,
            "type" => "select",
            "options" => $localeNames,
            "values" => $localeValues,
            "std" => get_locale(),
            ));
            
        $this->addOption(array(
            "type" => "save",
            ));
            
            
            
        $this->addOption(array(
            "name" => "Add New Locale",
            "type" => "heading"
            ));
            
        $this->addOption(array(
            "type" => "note",
            "desc" => "Choose a unique combination of language and country to create a new locale.",
            ));
            
        $this->addOption(array(
            "name" => "Choose Language",
            "desc" => "",
            "id" => "lang_locle_add_new_lang",
            "type" => "select",
            "options" => array_merge(array("Select a language"), array_values(bfi_list_languages())),
            "values" => array_merge(array(""), array_keys(bfi_list_languages())),
            "std" => "",
            ));
            
        $this->addOption(array(
            "name" => "Choose Country",
            "desc" => "The country selected defines the flag icon displayed in the language switcher shortcode. Flag icons are only displayed if the site is multilingual.",
            "id" => "lang_locle_add_new_country",
            "type" => "select",
            "options" => array_merge(array("Select a country"), array_values($countrList)),
            "values" => array_merge(array(""), array_keys($countrList)),
            "std" => "",
            ));
            
        $this->addOption(array(
            "type" => "save",
            "save" => __("Add new locale", BFI_I18NDOMAIN),
            "onclick" => "jQuery('#new_locale_language').val(jQuery('#".BFI_SHORTNAME."_lang_locle_add_new_lang').val()); jQuery('#new_locale_country').val(jQuery('#".BFI_SHORTNAME."_lang_locle_add_new_country').val()); jQuery('#createlocale').submit(); return false;",
            ));
            
            
            
        $this->addOption(array(
            "name" => "Edit Locale Translations",
            "type" => "heading"
            ));
            
        $this->addOption(array(
            "type" => "note",
            "desc" => "These are the locales available for the theme. Click on the edit button on the locale to change text translations for that locale. <strong><em>A pop-up window containing the editor will open, please make sure your browser doesn't block the editor.</em></strong>",
            ));
    
        foreach ($localeValues as $key => $locale) {
            $custom = '<p>'.$localeNames[$key] . " <button onclick='return bfi_language_edit_po_script(\"".$locale."\");' class='button-primary'>".__("Edit Translations", BFI_I18NDOMAIN)."...</button>";
            if (strtolower($locale) != 'en_us') $custom .= "<button onclick='jQuery(\"#delete_locale\").val(\"".$locale."\"); jQuery(\"#deletelocale\").submit(); return false;' class='button-secondary'>".__("Delete this locale", BFI_I18NDOMAIN)."</button>";
            $custom .= "</p>";
            
            $this->addOption(array(
                "type" => "custom",
                "custom" => $custom,
                ));
        }
        
        
        
        $this->addOption(array(
            "name" => "Add New Language Translation (Add Here To Make Your Site Multilingual)",
            "type" => "heading"
            ));
            
        $this->addOption(array(
            "type" => "note",
            "desc" => "Adding another language will add new content editors and page/post/portfolio options <strong>specific</strong> for the added languages when editing posts or pages.<br><br>Use the <strong>".BFI_THEMENAME." Language Switcher Shortcode: [language_switcher/]</strong> for displaying flag links in your site for fast language switching.",
            ));
            
        $this->addOption(array(
            "name" => "Choose Language",
            "desc" => "Choose from the available languages, <strong>you can't add a language that has already been used. Languages already used do not show up in this list.</strong>. <em>For example, if the main locale above is English, you cannot add another English language translation.</em>",
            "id" => "multilang_add_new_lang",
            "type" => "select",
            "options" => array_merge(array("Select a language"), array_values($availableLanguages)),
            "values" => array_merge(array(""), array_keys($availableLanguages)),
            "std" => "",
            ));
            
        $this->addOption(array(
            "name" => "Choose Locale to Use",
            "desc" => "The locale's country selected defines the flag icon displayed in the language switcher shortcode. Flag icons are only displayed if the site is multilingual.",
            "id" => "multilang_add_new_locale",
            "type" => "select",
            "options" => $localeNames,
            "values" => $localeValues,
            "std" => bfi_get_option(BFI_OPTIONMAINLOCALE),
            ));
            
        $this->addOption(array(
            "type" => "save",
            "save" => __("Add new language", BFI_I18NDOMAIN),
            ));
            
            
            
        $this->addOption(array(
            "name" => "Language Translations Created",
            "type" => "heading"
            ));
        
        if (isset($multiLanguages)) {
            $languages = bfi_list_languages();
            foreach ($multiLanguages as $language => $locale) {
                $this->addOption(array(
                    "type" => "custom",
                    "custom" => "
                        <p style='margin-top: 0; margin-bottom: 18px'><strong>".$languages[$language]." ($language)</strong> using locale translation for: <strong>$locale</strong>
                        <button name='action' class='button-secondary' onclick=\"javascript: jQuery('#deletelang$language').submit(); return false;\">" . __('Delete this language', BFI_I18NDOMAIN) . "</button>
                        </p>
                        ", 
                    ));
            }
        }
    
        if (!count($multiLanguages)) {
            $this->addOption(array(
                "type" => "note",
                "desc" => "<em style='color: red;'>No other languages have been created, use the form above to make your site use multiple languages!<br><br>The <strong>".BFI_THEMENAME." Language Switcher Shortcode</strong> is currently hidden.</em>" 
                ));
        }
    }

    public function initTranslationEditorScript() {
        echo "
        <script type='text/javascript'>
            function bfi_language_edit_po_script(locale) {
                window.open('".BFI_LIBRARYURL."includes/poeditor.php?l='+locale, 'bfi_poeditor', 'width=700,height=600,resizable=no,menubar=no,status=yes,scrollbars=yes'); 
                return false;
            }
        </script>";
    }
}
?>
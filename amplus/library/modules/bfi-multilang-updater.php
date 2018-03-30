<?php

// this module is in charge of carrying over the language files found in a 
// previous version of this theme.

// do this only once and do not overwrite any files
class BFIModuleThemeUpdateLanguageUpdater {
    public static function run() {
        add_action('admin_init', array(__CLASS__, 'verifyUpdate'));
    }
    
    public static function verifyUpdate() {
        $wasUpdated = bfi_get_option(BFI_THEMEVERSION.'_lang_updated');
        if ($wasUpdated === false) {
            // wait until the language folder becomes writable
            if (!is_readable(BFI_LANGUAGESPATH) || !is_writable(BFI_LANGUAGESPATH)) {
                BFIAdminNotificationController::addNotification("In order to <strong>edit language translations</strong>, you will need you make the <strong>".BFI_LANGUAGEPATH."</strong> folder and all it's contents writable. Also, if you just updated, all available language files & changes from a previous version will be copied over. Perform these two lines to change permissions:<br><br><strong>chmod 777 ".BFI_LANGUAGEPATH."</strong><br><br><strong>chmod -R 777 ".BFI_LANGUAGEPATH."*</strong>", 'warning');
                return;
            }
            
            $currTheme = wp_get_theme();
            $themes = wp_get_themes();

            // get all the old versions of the current theme
            $foundVersions = array();
            $existingThemes = array();
            foreach ($themes as $theme) {
                if ($theme->get('Name') != $currTheme->get('Name')) continue;

                $otherVersion = $theme->get('Version');
                if (!version_compare(BFI_THEMEVERSION, $otherVersion, '>')) continue;
                $foundVersions[] = $otherVersion;

                $existingThemes[$otherVersion] = $theme;
            }

            // sort to get the latest one from the old versions
            $lastVersion = '';
            if (count($foundVersions)) {
                usort($foundVersions, array(__CLASS__, 'versionSort'));
                $lastVersion = array_shift($foundVersions);
            }

            // perform update
            if ($lastVersion) {
                self::doUpdate($existingThemes[$lastVersion]);
            }
        }
    }
    
    public static function doUpdate($oldTheme) {
        // there is a previous version installed, check the old languages folder
        $oldLanguagesPath = get_theme_root($oldTheme) . '/' . $oldTheme->get_template() . str_replace(get_template_directory(), '', BFI_LANGUAGESPATH);
        
        if (!file_exists($oldLanguagesPath)) return false;
        if (!is_readable($oldLanguagesPath)) return false;
        
        if(!$dh = @opendir($oldLanguagesPath)) return false;
        
        $copiedFiles = 0;
        while (false !== ($obj = readdir($dh))) {
            if($obj=='.' || $obj=='..') continue;
            
            if (!preg_match('#\.po$#', $obj)) continue;
            $po = $obj;
            $mo = preg_replace('#\.po$#', '.mo', $po);
            
            // $obj = a previous .po file
            
            // check if a newer .po file is available
            // if not, copy en_US.po and create it
            if (!file_exists(BFI_LANGUAGESPATH.$po)) {
                // if (is_readable($oldLanguagesPath))
                if (!file_exists(BFI_LANGUAGESPATH.'en_US.po')) {
                    BFIAdminNotificationController::addNotification('The file <strong>'.BFI_LANGUAGESPATH.'en_US.po</strong> seems to be missing! Please re-upload the theme and make sure this file exists before continuing!', 'warning');
                    return false;
                }
                if (!is_readable(BFI_LANGUAGESPATH.'en_US.po')) {
                    BFIAdminNotificationController::addNotification('The file <strong>'.BFI_LANGUAGESPATH.'en_US.po</strong> is not readable! Please fix this so I can update your translations for you.', 'warning');
                    return false;
                }
                if (!copy(BFI_LANGUAGESPATH.'en_US.po', BFI_LANGUAGESPATH.$po)) {
                    BFIAdminNotificationController::addNotification('Could not create the file <strong>'.BFI_LANGUAGESPATH.$po.'</strong>! Please create it manually by duplicating the file <strong>'.BFI_LANGUAGESPATH.'en_US.po</strong> and rename it as '.$po, 'warning');
                    return false;
                }
            }
            
            // make sure .po file is writable
            if (!is_writable(BFI_LANGUAGESPATH.$po)) {
                BFIAdminNotificationController::addNotification('The file <strong>'.BFI_LANGUAGESPATH.$po.'</strong> is not writable! Please fix this so I can update your translations for you.', 'warning');
                return false;
            }
            
            // if a .mo exist, make sure .mo file is writable
            // if none exists, it's okay since we're going to generate one anyway
            if (file_exists(BFI_LANGUAGESPATH.$mo)) {
                if (!is_writable(BFI_LANGUAGESPATH.$mo)) {
                    BFIAdminNotificationController::addNotification('The file <strong>'.BFI_LANGUAGESPATH.$mo.'</strong> is not writable! Please fix this so I can update your translations for you.', 'warning');
                    return false;
                }
            }
            
            // check if old translation file is readable
            if (!is_readable($oldLanguagesPath.$po)) {
                BFIAdminNotificationController::addNotification('The file <strong>'.$oldLanguagesPath.$mo.'</strong> is not readable! Please fix this so I can get your previous translations for you.', 'warning');
                return false;
            }
            
            /*
             * apply translations from old .po file to new .po file
             */
            // open the old translation file and get translations
            $data = array();
            $fh = @fopen($oldLanguagesPath.$po, "r");
            $lineNum = 0;
            $oldTranslations = array(); // store translations here
            $msgid = '';
            $msgstr = '';
            while(!feof($fh)) {
                $line = trim(fgets($fh));
                
                if (preg_match('#^msgid#', $line)) {
                    $msgid = trim(preg_replace('#^msgid#', '', $line), ' "');
                }
                if ($msgid) {
                    if (preg_match('#^msgstr#', $line)) {
                        $msgstr = trim(preg_replace('#^msgstr#', '', $line), ' "');
                    }
                }
                
                // save old translation in array
                if ($msgid && $msgstr) {
                    $oldTranslations[$msgid] = $msgstr;
                    $msgid = false;
                    $msgstr = false;
                }
            }
            fclose($fh);
            unset($fh);
            
            
            // open new translation file and insert the proper translations
            // in a normal .po file, msgid & msgstr lines are paired together
            $fh = @fopen(BFI_LANGUAGESPATH.$po, "r");
            $lineNum = 0;
            $newLines = array();
            $msgid = '';
            while(!feof($fh)) {
                $line = trim(fgets($fh));
                if (preg_match('#^msgid#', $line)) {
                    $msgid = trim(preg_replace('#^msgid#', '', $line), ' "');
                    $newLines[] = $line;
                } else if (preg_match('#^msgstr#', $line)) {
                    if ($msgid && array_key_exists($msgid, $oldTranslations)) {
                        $newLines[] = "msgstr \"{$oldTranslations[$msgid]}\"";
                        $msgid = '';
                    } else {
                        $newLines[] = $line;
                    }
                } else {
                    $newLines[] = $line;
                }
            }
            fclose($fh);

            // create the new PO file
            $fh = @fopen(BFI_LANGUAGESPATH.$po, "w");
            foreach ($newLines as $line) {
                fwrite($fh, $line."\n");
            }
            fclose($fh);
            
            /*
             * generate .mo file
             */
            require_once(BFI_LIBRARYPATH.'includes/php-mo.php');
            phpmo_convert(BFI_LANGUAGESPATH.$po, BFI_LANGUAGESPATH.$mo);
            
            $copiedFiles++;
        }
        closedir($dh);
        
        BFIAdminNotificationController::addNotification('Successfully applied your translations from the previous version! I successfully processed <strong>'.$copiedFiles.'</strong> language files.');
        
        // add placeholder option for remembering that we have already set up the update
        bfi_update_option(BFI_THEMEVERSION.'_lang_updated', (string)$copiedFiles);
        return true;
    }
    

    public static function versionSort($a, $b) {
        if (version_compare($a, $b, '=')) return 0;
        return version_compare($a, $b, '>') ? -1 : 1;
    }
}

BFIModuleThemeUpdateLanguageUpdater::run();

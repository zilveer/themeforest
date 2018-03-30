<?php
/**
 */
 
/**
 * Converts a locale to language-country word pairs
 *
 * @package API\Translation
 * @param string $locale a locale, e.g. 'en-US'
 * @return string the language-country word pair, e.g. 'English (United States)'
 */
function bfi_locale_code_to_words($locale) {
    $locale = explode('_', $locale);
    $localeWords = '';

    $languages = bfi_list_languages();
        
    if (count($locale)) {
        $locale[0] = strtolower($locale[0]);
        $localeWords .= array_key_exists($locale[0], $languages) ? $languages[$locale[0]] : "";
    }
    if (count($locale) == 1) return $localeWords;

    $countries = bfi_list_countries();
        
    $countryStr = "";
    foreach ($locale as $i => $country) {
        if ($i == 0) continue;
        $country = strtoupper($country);
        if (array_key_exists(strtoupper($country), $countries)) {
            $countryStr .= $countryStr ? ", " : "";
            $countryStr .= $countries[$country];
        }
    }
    $localeWords .= $countryStr ? " ($countryStr)" : "";

    return $localeWords;
}
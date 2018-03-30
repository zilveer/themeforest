<?php
/**
 */
 
/**
 * Gives the age of the date as a phrase.
 *
 * @package API\Utility
 * @link http://webnv.net/articles/getting-an-items-age-with-php based on this script
 * @param timestamp $date The timestamp to compute the age
 * @return string The age of the date. Output examples: "just now", "an hour ago"
 */
function bfi_date_age($date) {
    // First we subtract the current date and time
    // from the item's date and time
    $time_diff = time() - $date;

    // Less than a min ago
    if ($time_diff < 60) {
        return __('just now', BFI_I18NDOMAIN);

    // Between 1 and 2 mins
    } elseif ($time_diff >= 60 && $time_diff < 120) {
        return __('a minute ago', BFI_I18NDOMAIN);

    // Between 2 and 59 mins
    } elseif ($time_diff >= 120 && $time_diff < 3600) {
        return sprintf(__('%s minutes ago', BFI_I18NDOMAIN), 
            floor($time_diff / 60));

    // Between 1 and 2 hours
    } elseif ($time_diff >= 3600 && $time_diff < 7200) {
        return __('an hour ago', BFI_I18NDOMAIN);

    // Between 2 and 23 hours
    } elseif ($time_diff >= 7200 && $time_diff < 86400) {
        return sprintf(__('%s hours ago', BFI_I18NDOMAIN), 
            floor($time_diff / 3600));

    // Between 1 and 2 days
    } elseif ($time_diff >= 86400 && $time_diff < 172800) {
        return __('yesterday', BFI_I18NDOMAIN);
        
     // Between 2 and 364 days
    } elseif ($time_diff >= 172800 && $time_diff < 2592000) {
        return sprintf(__('%s days ago', BFI_I18NDOMAIN), 
            floor($time_diff / 86400));
        
    // Between 1 month to 12 months
    } elseif ($time_diff >= 2592000 && $time_diff < 31536000) {
        $months = floor($time_diff / 2592000);
        if ($months == 1) {
            return __('a month ago', BFI_I18NDOMAIN);
        }
        return sprintf(__('%s months ago', BFI_I18NDOMAIN), $months);

    // Between 1 and 2 years
    } elseif ($time_diff >= 31536000 && $time_diff < 63072000) {
        return __('a year ago', BFI_I18NDOMAIN);

    // 2 years or greater
    } elseif ($time_diff >= 63072000) {
        return sprintf(__('%s years ago', BFI_I18NDOMAIN), 
            floor($time_diff / 31536000));
    }
}
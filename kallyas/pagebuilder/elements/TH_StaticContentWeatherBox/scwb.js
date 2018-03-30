/*
 * Localized script.
 * @see: TH_StaticContentWeatherBox::scripts()
 */
/**
 * Displays the translation for the specified day of week. Only available for and inside the Weather Box element
 * @param {string} day The day to be translated
 * @returns {string} The translated day if found or the day unchanged as falllback
 */
function znLocalizeDay( day )
{
    if(typeof(SCWB_LOCALE) != 'undefined' && day && day.length)
    {
        var d = day.toUpperCase();
        if(SCWB_LOCALE[d].length){
            return SCWB_LOCALE[d];
        }
    }
    // fallback
    return day;
}

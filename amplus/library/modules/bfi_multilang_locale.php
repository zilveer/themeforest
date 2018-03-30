<?php
/* Coped from wp-includes/locale.php
 *
 * The this file is simply a placeholder for translated
 * dates (month, day, abbreviations, etc). Translating
 * dates is performed the usual way in the 'edit
 * translations' button in the theme's admin
 *
 */

/**
 * Date and Time Locale object
 *
 * @package WordPress
 * @subpackage i18n
 */

require_once ABSPATH . WPINC . '/locale.php';

/**
 * Class that loads the calendar locale.
 *
 * @since 2.1.0
 */
class BFI_Locale {
	/**
	 * Stores the translated strings for the full weekday names.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $weekday;

	/**
	 * Stores the translated strings for the one character weekday names.
	 *
	 * There is a hack to make sure that Tuesday and Thursday, as well
	 * as Sunday and Saturday, don't conflict. See init() method for more.
	 *
	 * @see WP_Locale::init() for how to handle the hack.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $weekday_initial;

	/**
	 * Stores the translated strings for the abbreviated weekday names.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $weekday_abbrev;

	/**
	 * Stores the translated strings for the full month names.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $month;

	/**
	 * Stores the translated strings for the abbreviated month names.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $month_abbrev;

	/**
	 * Stores the translated strings for 'am' and 'pm'.
	 *
	 * Also the capitalized versions.
	 *
	 * @since 2.1.0
	 * @var array
	 * @access private
	 */
	var $meridiem;

	/**
	 * The text direction of the locale language.
	 *
	 * Default is left to right 'ltr'.
	 *
	 * @since 2.1.0
	 * @var string
	 * @access private
	 */
	var $text_direction = 'ltr';

	/**
	 * Sets up the translated strings and object properties.
	 *
	 * The method creates the translatable strings for various
	 * calendar elements. Which allows for specifying locale
	 * specific calendar names and text direction.
	 *
	 * @since 2.1.0
	 * @access private
	 */
	function init() {
		// The Weekdays
		$this->weekday[0] = /* translators: weekday */ __('Sunday', BFI_I18NDOMAIN);
		$this->weekday[1] = /* translators: weekday */ __('Monday', BFI_I18NDOMAIN);
		$this->weekday[2] = /* translators: weekday */ __('Tuesday', BFI_I18NDOMAIN);
		$this->weekday[3] = /* translators: weekday */ __('Wednesday', BFI_I18NDOMAIN);
		$this->weekday[4] = /* translators: weekday */ __('Thursday', BFI_I18NDOMAIN);
		$this->weekday[5] = /* translators: weekday */ __('Friday', BFI_I18NDOMAIN);
		$this->weekday[6] = /* translators: weekday */ __('Saturday', BFI_I18NDOMAIN);

		// The first letter of each day. The _%day%_initial suffix is a hack to make
		// sure the day initials are unique.
		$this->weekday_initial[__('Sunday', BFI_I18NDOMAIN)]    = /* translators: one-letter abbreviation of the weekday */ __('S_Sunday_initial', BFI_I18NDOMAIN);
		$this->weekday_initial[__('Monday', BFI_I18NDOMAIN)]    = /* translators: one-letter abbreviation of the weekday */ __('M_Monday_initial', BFI_I18NDOMAIN);
		$this->weekday_initial[__('Tuesday', BFI_I18NDOMAIN)]   = /* translators: one-letter abbreviation of the weekday */ __('T_Tuesday_initial', BFI_I18NDOMAIN);
		$this->weekday_initial[__('Wednesday', BFI_I18NDOMAIN)] = /* translators: one-letter abbreviation of the weekday */ __('W_Wednesday_initial', BFI_I18NDOMAIN);
		$this->weekday_initial[__('Thursday', BFI_I18NDOMAIN)]  = /* translators: one-letter abbreviation of the weekday */ __('T_Thursday_initial', BFI_I18NDOMAIN);
		$this->weekday_initial[__('Friday', BFI_I18NDOMAIN)]    = /* translators: one-letter abbreviation of the weekday */ __('F_Friday_initial', BFI_I18NDOMAIN);
		$this->weekday_initial[__('Saturday', BFI_I18NDOMAIN)]  = /* translators: one-letter abbreviation of the weekday */ __('S_Saturday_initial', BFI_I18NDOMAIN);

		foreach ($this->weekday_initial as $weekday_ => $weekday_initial_) {
			$this->weekday_initial[$weekday_] = preg_replace('/_.+_initial$/', '', $weekday_initial_);
		}

		// Abbreviations for each day.
		$this->weekday_abbrev[__('Sunday', BFI_I18NDOMAIN)]    = /* translators: three-letter abbreviation of the weekday */ __('Sun', BFI_I18NDOMAIN);
		$this->weekday_abbrev[__('Monday', BFI_I18NDOMAIN)]    = /* translators: three-letter abbreviation of the weekday */ __('Mon', BFI_I18NDOMAIN);
		$this->weekday_abbrev[__('Tuesday', BFI_I18NDOMAIN)]   = /* translators: three-letter abbreviation of the weekday */ __('Tue', BFI_I18NDOMAIN);
		$this->weekday_abbrev[__('Wednesday', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the weekday */ __('Wed', BFI_I18NDOMAIN);
		$this->weekday_abbrev[__('Thursday', BFI_I18NDOMAIN)]  = /* translators: three-letter abbreviation of the weekday */ __('Thu', BFI_I18NDOMAIN);
		$this->weekday_abbrev[__('Friday', BFI_I18NDOMAIN)]    = /* translators: three-letter abbreviation of the weekday */ __('Fri', BFI_I18NDOMAIN);
		$this->weekday_abbrev[__('Saturday', BFI_I18NDOMAIN)]  = /* translators: three-letter abbreviation of the weekday */ __('Sat', BFI_I18NDOMAIN);

		// The Months
		$this->month['01'] = /* translators: month name */ __('January', BFI_I18NDOMAIN);
		$this->month['02'] = /* translators: month name */ __('February', BFI_I18NDOMAIN);
		$this->month['03'] = /* translators: month name */ __('March', BFI_I18NDOMAIN);
		$this->month['04'] = /* translators: month name */ __('April', BFI_I18NDOMAIN);
		$this->month['05'] = /* translators: month name */ __('May', BFI_I18NDOMAIN);
		$this->month['06'] = /* translators: month name */ __('June', BFI_I18NDOMAIN);
		$this->month['07'] = /* translators: month name */ __('July', BFI_I18NDOMAIN);
		$this->month['08'] = /* translators: month name */ __('August', BFI_I18NDOMAIN);
		$this->month['09'] = /* translators: month name */ __('September', BFI_I18NDOMAIN);
		$this->month['10'] = /* translators: month name */ __('October', BFI_I18NDOMAIN);
		$this->month['11'] = /* translators: month name */ __('November', BFI_I18NDOMAIN);
		$this->month['12'] = /* translators: month name */ __('December', BFI_I18NDOMAIN);

		// Abbreviations for each month. Uses the same hack as above to get around the
		// 'May' duplication.
		$this->month_abbrev[__('January', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Jan_January_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('February', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Feb_February_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('March', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Mar_March_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('April', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Apr_April_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('May', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('May_May_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('June', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Jun_June_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('July', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Jul_July_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('August', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Aug_August_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('September', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Sep_September_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('October', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Oct_October_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('November', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Nov_November_abbreviation', BFI_I18NDOMAIN);
		$this->month_abbrev[__('December', BFI_I18NDOMAIN)] = /* translators: three-letter abbreviation of the month */ __('Dec_December_abbreviation', BFI_I18NDOMAIN);

		foreach ($this->month_abbrev as $month_ => $month_abbrev_) {
			$this->month_abbrev[$month_] = preg_replace('/_.+_abbreviation$/', '', $month_abbrev_);
		}

		// The Meridiems
		$this->meridiem['am'] = __('am', BFI_I18NDOMAIN);
		$this->meridiem['pm'] = __('pm', BFI_I18NDOMAIN);
		$this->meridiem['AM'] = __('AM', BFI_I18NDOMAIN);
		$this->meridiem['PM'] = __('PM', BFI_I18NDOMAIN);

		// Numbers formatting
		// See http://php.net/number_format

		/* translators: $thousands_sep argument for http://php.net/number_format, default is , */
		$trans = __('number_format_thousands_sep', BFI_I18NDOMAIN);
		$this->number_format['thousands_sep'] = ('number_format_thousands_sep' == $trans) ? ',' : $trans;

		/* translators: $dec_point argument for http://php.net/number_format, default is . */
		$trans = __('number_format_decimal_point', BFI_I18NDOMAIN);
		$this->number_format['decimal_point'] = ('number_format_decimal_point' == $trans) ? '.' : $trans;

		// Set text direction.
		if ( isset( $GLOBALS['text_direction'] ) )
			$this->text_direction = $GLOBALS['text_direction'];
		/* translators: 'rtl' or 'ltr'. This sets the text direction for WordPress. */
		elseif ( 'rtl' == _x( 'ltr', 'text direction', BFI_I18NDOMAIN) )
			$this->text_direction = 'rtl';
	}

	/**
	 * Retrieve the full translated weekday word.
	 *
	 * Week starts on translated Sunday and can be fetched
	 * by using 0 (zero). So the week starts with 0 (zero)
	 * and ends on Saturday with is fetched by using 6 (six).
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param int $weekday_number 0 for Sunday through 6 Saturday
	 * @return string Full translated weekday
	 */
	function get_weekday($weekday_number) {
		return $this->weekday[$weekday_number];
	}

	/**
	 * Retrieve the translated weekday initial.
	 *
	 * The weekday initial is retrieved by the translated
	 * full weekday word. When translating the weekday initial
	 * pay attention to make sure that the starting letter does
	 * not conflict.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string $weekday_name
	 * @return string
	 */
	function get_weekday_initial($weekday_name) {
		return $this->weekday_initial[$weekday_name];
	}

	/**
	 * Retrieve the translated weekday abbreviation.
	 *
	 * The weekday abbreviation is retrieved by the translated
	 * full weekday word.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string $weekday_name Full translated weekday word
	 * @return string Translated weekday abbreviation
	 */
	function get_weekday_abbrev($weekday_name) {
		return $this->weekday_abbrev[$weekday_name];
	}

	/**
	 * Retrieve the full translated month by month number.
	 *
	 * The $month_number parameter has to be a string
	 * because it must have the '0' in front of any number
	 * that is less than 10. Starts from '01' and ends at
	 * '12'.
	 *
	 * You can use an integer instead and it will add the
	 * '0' before the numbers less than 10 for you.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string|int $month_number '01' through '12'
	 * @return string Translated full month name
	 */
	function get_month($month_number) {
		return $this->month[zeroise($month_number, 2)];
	}

	/**
	 * Retrieve translated version of month abbreviation string.
	 *
	 * The $month_name parameter is expected to be the translated or
	 * translatable version of the month.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string $month_name Translated month to get abbreviated version
	 * @return string Translated abbreviated month
	 */
	function get_month_abbrev($month_name) {
		return $this->month_abbrev[$month_name];
	}

	/**
	 * Retrieve translated version of meridiem string.
	 *
	 * The $meridiem parameter is expected to not be translated.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @param string $meridiem Either 'am', 'pm', 'AM', or 'PM'. Not translated version.
	 * @return string Translated version
	 */
	function get_meridiem($meridiem) {
		return $this->meridiem[$meridiem];
	}

	/**
	 * Global variables are deprecated. For backwards compatibility only.
	 *
	 * @deprecated For backwards compatibility only.
	 * @access private
	 *
	 * @since 2.1.0
	 */
	function register_globals() {
		$GLOBALS['weekday']         = $this->weekday;
		$GLOBALS['weekday_initial'] = $this->weekday_initial;
		$GLOBALS['weekday_abbrev']  = $this->weekday_abbrev;
		$GLOBALS['month']           = $this->month;
		$GLOBALS['month_abbrev']    = $this->month_abbrev;
	}

	/**
	 * Constructor which calls helper methods to set up object variables
	 *
	 * @uses WP_Locale::init()
	 * @uses WP_Locale::register_globals()
	 * @since 2.1.0
	 *
	 * @return WP_Locale
	 */
	function __construct() {
		$this->init();
		$this->register_globals();
	}

	/**
	 * Checks if current locale is RTL.
	 *
	 * @since 3.0.0
	 * @return bool Whether locale is RTL.
	 */
	function is_rtl() {
		return 'rtl' == $this->text_direction;
	}
}

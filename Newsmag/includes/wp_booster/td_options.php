<?php
/**
 * Created by ra on 9/22/2016.
 */


class td_options {

	/**
	 * @var bool flag used to hook the shutdown action only once
	 */
	private static $is_shutdown_hooked = false;

	/**
	 * @var null keep a local copy of all the settings
	 */
	static $td_options = NULL ;


	/**
	 * get one td_option
	 * @param $optionName
	 * @param string $default_value - what you get if the option is empty or not set, default is EMPTY STRING ''
	 * @return string
	 */
	static function get($optionName, $default_value = '') {
		self::read_from_db();

		if (!empty(self::$td_options[$optionName])) {
			return self::$td_options[$optionName];
		} else {
			if (!empty($default_value)) {
				return $default_value;
			} else {
				return '';
			}
		}

	}


	/**
	 * Updates a td_option
	 * @param $optionName
	 * @param $newValue
	 */
	static function update($optionName, $newValue) {
		self::$td_options[$optionName] = $newValue;
		self::schedule_save();
	}


	/**
	 * @param $optionName
	 * @param $newValue
	 * @deprecated - do not use, it's used as a hack in td composer and we will remove it soon
	 */
	static function update_temp($optionName, $newValue) {
		self::$td_options[$optionName] = $newValue;
	}



	/**
	 * This method is used to port the OLD global reading and updating to this new class so we don't have to refactor all the code at once.
	 *  - schedule_save() must be called after modifying the reference
	 * @return mixed
	 */
	static function &get_all_by_ref() {
		self::read_from_db();
		return self::$td_options;
	}


	/**
	 * Used to read all the options.
	 * @return mixed
	 */
	static function get_all() {
		self::read_from_db();
		return self::$td_options;
	}


	/**
	 * read the setting from db only once
	 */
	static private function read_from_db() {
		if (is_null(self::$td_options)) {
			self::$td_options = get_option(TD_THEME_OPTIONS_NAME);
		}
	}

	/**
	 * Schedules a save on the shutdown hook. It's public because it's also used with @see td_options::get_all_by_ref()
	 */
	static function schedule_save() {

		// make sure that we hook only once
		if (self::$is_shutdown_hooked === false) {
			add_action('shutdown', array(__CLASS__, 'on_shutdown_save_options'));
			self::$is_shutdown_hooked = true;
		}
	}


	/**
	 * @internal
	 * save the options hook
	 */
	static function on_shutdown_save_options() {

		update_option( TD_THEME_OPTIONS_NAME, self::$td_options );
		//echo "SETTINGS SAVED";
	}

}
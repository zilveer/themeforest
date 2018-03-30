jQuery(function($){
	"use strict";
	$.datepicker.regional[jquidp.langCode] = {
		closeText      : jquidp.closeText,
		currentText    : jquidp.currentText,
		monthNames     : jquidp.monthNames,
		monthNamesShort: jquidp.monthNamesShort,
		dayNames       : jquidp.dayNames,
		dayNamesShort  : jquidp.dayNamesShort,
		dayNamesMin    : jquidp.dayNamesMin,
		dateFormat     : jquidp.dateFormat,
		firstDay       : jquidp.firstDay,
		isRTL          : Boolean(jquidp.isRTL)
	};
	$.datepicker.setDefaults($.datepicker.regional[jquidp.langCode]);
});
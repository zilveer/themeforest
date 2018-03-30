jQuery(document).ready(function($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint,ajaxurl */
	
	var form = $("#theme-options");
	var info;
	var clearStatusTimeout;
	
	function status(s) {
		info
			.find("div")
			.hide()
			.end()
			.find("."+s)
			.show()
			.end();
		clearTimeout(clearStatusTimeout);
		if (s != "warning") {
			clearStatusTimeout = setTimeout(clearStatus,1000);
		}
	}
	
	function clearStatus() {
		status("none");
	}
	
	function saved(result) {
		status((result && result.ok) ? "saved" : "warning");
	}
	
	function submit(e) {
		var data = $("#theme-options").serialize();
		status("saving");
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: data,
			success: saved
		});
		
		return false;
	}
	
	if (form.length > 0) {
		info = form.find(".info.bottom");
		form.delegate("input[type=submit]","click",submit);
		var action = $('<input type="hidden" name="action" value="pe_theme_options_save"/>');
		form.append(action);
	}
	
	var tabs = $(".pe_theme #options_tabs");
	if (parseFloat($.ui.version.match(/\d.\d/)[0]) != 1.8) {
		tabs.find("> ul li").removeClass("ui-tabs-selected");
		tabs.find("> div").removeClass("ui-tabs-hide");
	}
	tabs.tabs();
	
	
	function tabsOn() {
		tabs
			.tabs("destroy")
			.addClass("off");
	}

	function tabsOff() {
		tabs
			.tabs()
			.removeClass("off");
		
	}
	
	$.pixelentity.tooltip($("#theme-options"));
	
	if (tabs.length > 0) {
		//var toggleTabs = $('<a href="" class="toggle_tabs">Tabs</a>');
		//$('.pe_theme .top-info').prepend(toggleTabs);
		//toggleTabs.toggle(tabsOn,tabsOff);
	}

	
});

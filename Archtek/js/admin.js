/*global jQuery:false, AdminSettings:false */

jQuery(document).ready(function($) {
	"use strict";
   
    // ---------------------------------------------- //
    // General
    // ---------------------------------------------- //
    
    $('#option-tree-options-layouts-form').append('<a href="javascript:;" id="uxb-layout-hint" class="tip" data-tip=\'' + AdminSettings.layout_hint_desc + '\'>' + AdminSettings.layout_hint + '</a>');

    $('.tip').tipr();

});
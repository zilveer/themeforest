/**
 * Utilities for the administration for Organique WP Theme
 */

jQuery(document).ready(function($) {
	'use strict';

	$( 'html' ).on( 'click', '.js--selectable-icon', function (ev) {
		ev.preventDefault();
		var $this = $(this);
		// console.log($this.data('iconname'));
		$this.parent().siblings('.js--icon-input').val( $this.data('iconname') );
	} );
});
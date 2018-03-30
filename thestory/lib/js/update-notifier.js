/*
 * Update notofier - contains the functionality for the update notifier page.
 * @author Pexeto
 * http://pexetothemes.com
 */

function UpdateNotifier(redirectUrl, validDetails) {
	this.redirectUrl = redirectUrl;
	this.validDetails = validDetails;
}

(function($) {
	"use strict";
	
	/**
	 * Inits the main functionality.
	 */
	UpdateNotifier.prototype.init = function() {
		this.setInstructionsDialog();
		this.setUpdateDialog();
	};

	/**
	 * Inits the instructions dialog box functionality.
	 */
	UpdateNotifier.prototype.setInstructionsDialog = function() {
		$('#manual-instructions-btn').on("click", function(e) {
			e.preventDefault();
			$('#manual-instructions').dialog({
				width: 500,
				maxHeight: 500,
				dialogClass:'pexeto-dialog'
			});
		});
	};

	/**
	 * Inits the update dialog box functionality. This dialog box contains
	 * an "Update" and "Cancel" buttons which should trigger the corresponding
	 * init event functionality.
	 */
	UpdateNotifier.prototype.setUpdateDialog = function() {
		var redirectUrl = this.redirectUrl,
			validDetails = this.validDetails;

		$('#update-btn').on("click", function(e) {
			e.preventDefault();
			if(redirectUrl && validDetails) {
				$('#confirm-update').dialog({
					dialogClass: 'pexeto-dialog',
					buttons: {
						"Update Theme": function() {
							window.location = redirectUrl;
						},
						Cancel: function() {
							$(this).dialog("close");
						}
					}
				});
			} else {
				$('#no-details').dialog({
					dialogClass:'pexeto-dialog'
				});
			}

		});
	};

})(jQuery);
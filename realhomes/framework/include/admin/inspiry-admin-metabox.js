(function($) {
	"use strict";
	
	$(function() {

		/* Apply jquery ui sortable on additional details */
		$( "#inspiry-additional-details-container" ).sortable({
			revert: 100,
			placeholder: "detail-placeholder",
			handle: ".sort-detail",
			cursor: "move"
		});

		$( '.add-detail' ).click(function( event ){
			event.preventDefault();
			var newInspiryDetail = '<div class="inspiry-detail inputs">' +
										'<div class="inspiry-detail-control"><span class="sort-detail dashicons dashicons-menu"></span></div>' +
										'<div class="inspiry-detail-title"><input type="text" name="detail-titles[]" /></div>' +
										'<div class="inspiry-detail-value"><input type="text" name="detail-values[]" /></div>' +
										'<div class="inspiry-detail-control"><a class="remove-detail" href="#"><span class="dashicons dashicons-dismiss"></span></a></div>' +
									'</div>';

			$( '#inspiry-additional-details-container').append( newInspiryDetail );
			bindAdditionalDetailsEvents();
		});

		function bindAdditionalDetailsEvents(){

			/* Bind click event to remove detail icon button */
			$( '.remove-detail').click(function( event ){
				event.preventDefault();
				var $this = $( this );
				$this.closest( '.inspiry-detail' ).remove();
			});

		}
		bindAdditionalDetailsEvents();
		
	});

}(jQuery));

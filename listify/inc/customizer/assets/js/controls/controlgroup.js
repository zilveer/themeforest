(function( window, $, wp ) {

	/**
	 * ControlGroup Control
	 *
	 * Each control option has a list of associated dependent controls. 
	 * When the control changes update the associated controls and drill down
	 * the list if another ControlGroup is found.
	 *
	 * @constructor
	 * @augments wp.customize.Control
	 * @augments wp.customize.Class
	 */
	wp.customize.controlConstructor.ControlGroup = wp.customize.Control.extend({
		ready: function() {
			var control = this;

			control.setting.bind(function() {
				var data = $(control.container).find( 'input:checked' ).data();

				if ( ! data.controls ) {
					return;
				}

				updateControls(data.controls);
			});
		}
	});

	/**
	 * Update multiple controls at once.
	 */
	var updateControls = function(controls) {
		return _.each(controls, function(to, control) {
			var control = wp.customize.control(control);

			if ( ! _.isUndefined( control ) ) {
				control.setting.set(to);
			}
		});
	}

})( this, jQuery, wp );

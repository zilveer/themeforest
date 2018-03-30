import React from 'react';

	/**
	 * The ButtonH6 class provides wraps a selection in `h6` element.
	 *
	 * @uses ButtonActionStyle
	 * @uses ButtonStateClasses
	 * @uses ButtonStyle
	 *
	 * @class ButtonH6
	 */
	var ButtonH6 = React.createClass({
		mixins: [AlloyEditor.ButtonStyle, AlloyEditor.ButtonStateClasses, AlloyEditor.ButtonActionStyle],

		// Allows validating props being passed to the component.
		propTypes: {
			/**
			 * The editor instance where the component is being used.
			 *
			 * @property {Object} editor
			 */
			editor: React.PropTypes.object.isRequired,

			/**
			 * The label that should be used for accessibility purposes.
			 *
			 * @property {String} label
			 */
			label: React.PropTypes.string,

			/**
			 * The tabIndex of the button in its toolbar current state. A value other than -1
			 * means that the button has focus and is the active element.
			 *
			 * @property {Number} tabIndex
			 */
			tabIndex: React.PropTypes.number
		},

		// Lifecycle. Provides static properties to the widget.
		statics: {
			/**
			 * The name which will be used as an alias of the button in the configuration.
			 *
			 * @static
			 * @property {String} key
			 * @default h6
			 */
			key: 'h6'
		},

		/**
		 * Lifecycle. Returns the default values of the properties used in the widget.
		 *
		 * @method getDefaultProps
		 * @return {Object} The default properties.
		 */
		getDefaultProps: function() {
			return {
				style: {
					element: 'h6'
				}
			};
		},

		/**
		 * Lifecycle. Renders the UI of the button.
		 *
		 * @method render
		 * @return {Object} The content which should be rendered.
		 */
		render: function() {
			var cssClass = 'ae-button ' + this.getStateClasses();

			return (
				<button aria-label={AlloyEditor.Strings.h6} aria-pressed={cssClass.indexOf('pressed') !== -1} className={cssClass} data-type="button-h6" onClick={this.applyStyle} tabIndex={this.props.tabIndex} title={AlloyEditor.Strings.h6}>
					<span className="ae-icon-h6"></span>
				</button>
			);
		}
	});

	AlloyEditor.Buttons[ButtonH6.key] = AlloyEditor.ButtonH6 = ButtonH6;
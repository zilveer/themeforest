require('rc-slider/assets/index.css');

// Use the built-in version of React if your site does not use React
const React = require('react');
const ReactDOM = require('react-dom');
const Slider = require('rc-slider');

var KlLetterSpacing = React.createClass({
	mixins: [
		AlloyEditor.ButtonStyle,
		AlloyEditor.ButtonStateClasses,
		AlloyEditor.ButtonActionStyle,
		AlloyEditor.WidgetDropdown,
		AlloyEditor.WidgetExclusive,
		AlloyEditor.ToolbarButtons
	],

	propTypes: {
		editor: React.PropTypes.object.isRequired
	},

	getDefaultProps: function() {
		return {
			style: {
				element: 'span',
				styles: {
					'letter-spacing': '#(size)'
				}
			}
		};
	},

	statics: {
		key: 'klletterspacing'
	},

	getInitialState: function() {
		return {
			showButtons: this.props.active === this.props.tabKey,
			value: this.getValue(),
		};
	},

	render: function() {
		var cssClass = 'button-kl-headings ae-button ' + ( this.props.active === this.props.tabKey ? 'ae-button-pressed':'' );

		return (
			<div className="ae-container ae-has-dropdown ae-pos-static">
				<button className={cssClass} data-type="button-klheadings" onClick={this.togglePopup} tabIndex={this.props.tabIndex}>
					<span className="ae-icon-letter-spacing"></span>
				</button>
				{ this.props.active === this.props.tabKey ? this.renderButtons() : null }
			</div>
		);
	},


	setFontStyle : function( value ){
		this._style = new CKEDITOR.style({
			element: 'span',
			styles: {
				'letter-spacing': parseInt( value ) + 'px'
			}
		});
	},


	getValue(){
		var span = this.props.editor.get('nativeEditor').elementPath().contains( isFontSizeSpan );
		return span ? parseInt( span.getStyle( 'letter-spacing' ).replace('px', '') ) : 0;

		function isFontSizeSpan( el ) {
			return el.is( 'span' ) && el.getStyle( 'letter-spacing' );
		}
	},

	onChange : function(value){
		if( this.state.value === value ){
			return false;
		}

		this.setFontStyle( value );
		this.applyStyle();
		this.setState( {value : value} );
	},

	renderButtons : function(){
		var defVal = 0,
			initVal = this.state.value != 0 ? this.state.value : defVal;
		return (
			<div className="ae-dropdown ae-dropdown--dropup ae-rounded-top">
				<div className="ae-container ae-slideArea">
					<span className="ae-slideArea-value">{initVal}</span>
					<span className="ae-slideArea-smallVal ae-icon-spacing-small"></span>
						<Slider className="ae-slideArea-slider" tipTransitionName="rc-slider-tooltip-zoom-down" min={-50} max={50} defaultValue={initVal} onChange={this.onChange} />
					<span className="ae-slideArea-bigVal ae-icon-spacing-large"></span>
				</div>
			</div>
		);
	},

	togglePopup: function(){
		this.props.changeActiveButton( this.props.tabKey );
	}
});

AlloyEditor.Buttons[KlLetterSpacing.key] = AlloyEditor.KlLetterSpacing = KlLetterSpacing;
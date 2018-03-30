require('rc-slider/assets/index.css');

// Use the built-in version of React if your site does not use React
const React = require('react');
const ReactDOM = require('react-dom');
const Slider = require('rc-slider');

var KlLineHeight = React.createClass({
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
					'line-height': '#(size)'
				}
			}
		};
	},

	statics: {
		key: 'kllineheight'
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
					<span className="ae-icon-line-height"></span>
				</button>
				{ this.props.active === this.props.tabKey ? this.renderButtons() : null }
			</div>
		);
	},


	setFontStyle : function( value ){
		this._style = new CKEDITOR.style({
			element: 'span',
			styles: {
				'line-height': parseInt( value ) + 'px'
			}
		});
	},


	getValue(){
		var span = this.props.editor.get('nativeEditor').elementPath().contains( isFontSizeSpan );
		return span ? parseInt( span.getStyle( 'line-height' ).replace('px', '') ) : '0';

		function isFontSizeSpan( el ) {
			return el.is( 'span' ) && el.getStyle( 'line-height' );
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
		var defVal = 22,
			initVal = this.state.value != 0 ? this.state.value : defVal;
		return (
			<div className="ae-dropdown ae-dropdown--dropup ae-rounded-top">
				<div className="ae-container ae-slideArea">
					<span className="ae-slideArea-value">{initVal}</span>
					<span className="ae-slideArea-smallVal ae-icon-lineheight-small"></span>
						<Slider className="ae-slideArea-slider" tipTransitionName="rc-slider-tooltip-zoom-down" defaultValue={initVal} onChange={this.onChange} />
					<span className="ae-slideArea-bigVal ae-icon-lineheight-large"></span>
				</div>
			</div>
		);
	},

	togglePopup: function( e ){
		this.props.changeActiveButton( this.props.tabKey );
	}
});

AlloyEditor.Buttons[KlLineHeight.key] = AlloyEditor.KlLineHeight = KlLineHeight;
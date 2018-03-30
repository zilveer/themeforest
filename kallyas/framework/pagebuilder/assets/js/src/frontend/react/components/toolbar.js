import $ from 'jQuery';
import React from 'react';
import ReactDOM from 'react-dom';
import ClosePanelButton from './closePanel';
import PageOptionsButton from './pageoptionsbutton';

class ToolBar extends React.Component {
	render() {
	  return (
		<span>
			<ClosePanelButton/>
			<PageOptionsButton/>
		</span>
	  )
	}
};

$(document).ready(function(){
	ReactDOM.render(<ToolBar />, document.getElementById('klpb-toolbar') );
});
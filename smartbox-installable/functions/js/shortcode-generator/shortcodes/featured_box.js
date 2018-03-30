desShortcodeMeta={
	attributes:[
		{
			label:"Style",
			id:"style",
			help: 'The content of your featured box. Use a &lt;br /&gt; to start a new line.',
			controlType: "select-control",
			selectValues:['Simple Border', 'Fancy Border', 'Background Pattern'],
			defaultValue: 'Simple Border', 
			defaultText: 'Simple Border'
		}],
		customMakeShortcode: function(b){
			var a=b.data;
			return "[featured_box style='"+ b.style +"'] Your content goes here. [/featured_box]";
		}
};

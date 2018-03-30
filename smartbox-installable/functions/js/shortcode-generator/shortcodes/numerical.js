desShortcodeMeta={
	attributes:[
		{
			label:"Unit",
			id:"unit",
			help: "Ex.: %, h, $"
		},
		{
			label: "Value Font-size",
			id:"valuefontsize"
		},
		{
			label: "Units Font-size",
			id:"unitfontsize"
		},
		{
			label: "Animation Step",
			id:"speed",
			help: "The animation Jump between values."
		},
		{
			label: "Content Align",
			id:"align",
			controlType:"select-control", 
			selectValues:['Left', 'Center', 'Right'],
			defaultValue: 'Left', 
			defaultText: 'Left',
			help: "Left, Center or Right Alignment"
		},
		{
			label:"Numerical Increment",
			id:"content",
			controlType:"bars-control"
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			var tabTitles2 = new Array();
			
			if(!a)return"";
			
			var c=a.content;
			
			var g = ''; // The shortcode.
			
			for ( var i = 0; i < a.numTabs; i++ ) {
			
			
				var currentField2 = 'ercent_' + ( i + 1 );
				
				if ( b[currentField2] == '' ) {
				
					tabTitles2.push( 'Percent ' + ( i + 1 ) );
				
				} else {
				
					var currentTitle2 = b[currentField2];
					currentTitle2 = currentTitle2.replace( /"/gi, "'" );
					
					tabTitles2.push( currentTitle2 );
				
				} // End IF Statement
			
			} // End FOR Loop
			
			g += '[numerical_container ]';
			
			for ( var t in tabTitles2 ) {
			
				g += '[numerical_item percent="' + tabTitles2[t] + '" unit="'+b.unit+'" value_font_size="'+b.valuefontsize+'" unit_font_size="'+b.unitfontsize+'"  align="'+b.align+'" jump="'+b.speed+'"] Your text here. [/numerical_item]';
			
			} // End FOR Loop

			g += '[/numerical_container]<br/>';

			return g
		
		}
};
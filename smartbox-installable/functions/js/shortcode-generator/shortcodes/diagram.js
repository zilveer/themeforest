desShortcodeMeta={
	attributes:[
		{
			label:"Title",
			id:"title"
		},
		{
			label:"Numerical Increment",
			id:"content",
			controlType:"diagram-control"
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			
			var tabTitles = new Array();
			var tabTitles2 = new Array();
			
			if(!a)return"";
			
			var c=a.content;
			
			var g = ''; // The shortcode.
			
			for ( var i = 0; i < a.numTabs; i++ ) {
			
				var currentField = 'm_color_' + ( i + 1 );
				
				if ( b[currentField] == '' ) {
				
					tabTitles.push( 'Color ' + ( i + 1 ) );
				
				} else {
				
					var currentTitle = b[currentField];
					//currentTitle = currentTitle.replace( /"/gi, "'" );
					
					tabTitles.push( currentTitle );
				
				} // End IF Statement
			
				var currentField2 = 'm_percent_' + ( i + 1 );
				
				if ( b[currentField2] == '' ) {
				
					tabTitles2.push( 'Percent ' + ( i + 1 ) );
				
				} else {
				
					var currentTitle2 = b[currentField2];
					//currentTitle2 = currentTitle2.replace( /"/gi, "'" );
					
					tabTitles2.push( currentTitle2 );
				
				} // End IF Statement
			
			} // End FOR Loop
			
			g += '[diagram_container title="'+b.title+'"]';
			
			for ( var t in tabTitles2 ) {
			
				g += '[diagram color="'+tabTitles[t]+'" percent="' + tabTitles2[t] + '"] Your text here. [/diagram]';
			
			} // End FOR Loop

			g += '[/diagram_container]<br/>';

			return g
		
		}
};
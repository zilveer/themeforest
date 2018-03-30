desShortcodeMeta={
	attributes:[
		{
			label:"Number of Donuts",
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
			
			g += '[donuts]';
			
			for ( var t in tabTitles2 ) {
			
				g += '[donut Percent="'+tabTitles2[t]+'"]Your text here.[/donut]';
			
			} // End FOR Loop

			g += '[/donuts]<br/>';

			return g
		
		}
};
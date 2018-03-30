desShortcodeMeta={
	attributes:[
		{
			label:"Tabs itle",
			id:"tabsTitle",
			help:"Set an optional main heading for the accordion.", 
			defaultText: ''
		},
		{
			label:"Tabs",
			id:"content",
			controlType:"tab-control"
		},
		{
			label:"CSS Class",
			id:"css",
			help:"Set an optional custom CSS class for the tabber.", 
			defaultText: ''
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			var tabTitles = new Array();
			var tabIcons = new Array();
			
			if(!a)return"";
			
			var c=a.content;
			var tabberCss = b.css;
			var tabberTitle = b.tabberTitle;
			
			var g = ''; // The shortcode.
			
			for ( var i = 0; i < a.numTabs; i++ ) {
			
				var currentField = 'tle_' + ( i + 1 );

				if ( b[currentField] == '' ) {
				
					tabTitles.push( ' ' );
				
				} else {
				
					var currentTitle = b[currentField];
					
					currentTitle = currentTitle.replace( /"/gi, "'" );
					
					tabTitles.push( currentTitle );
				
				} // End IF Statement
				
				var currentField2 = 'e_iconh_' + (i+1);
				var currentField2 = b[currentField2];
				tabIcons.push(currentField2);
			
			} // End FOR Loop
			
			g += '[tabs';

			if (b.tabsTitle) g += ' title="'+b.tabsTitle+'"';			
			if ( tabberCss ) { g += ' css="' + tabberCss + '"'; } // End IF Statement

			
			g += '] ';
			
			var id = 1;
			
			for ( var t in tabTitles ) {
			
				g += '[tab title="' + tabTitles[t] + '" icon="icon-'+tabIcons[t]+'" id="tab-' + id + '"]' + tabTitles[t] + ' content goes here.[/tab]';
				id++;
			
			} // End FOR Loop

			g += '[/tabs]';

			return g
		
		}
};
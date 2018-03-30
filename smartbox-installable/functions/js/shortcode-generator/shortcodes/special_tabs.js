desShortcodeMeta={
	attributes:[
		{
			label:"Special Tabs Title",
			id:"specialTabsTitle",
			help:"Set an optional main heading for the special tabs.", 
			defaultText: ''
		},
		{
			label:"Special Tabs",
			id:"content",
			controlType:"fontawesome-control"
		}		
		],
		disablePreview:true,
		customMakeShortcode: function(b){

			var tabTitles = new Array();
			var tabTitles2 = new Array();
			var tabTitles3 = new Array();
			
			//if(!a)return"";
			var numTabs = jQuery('.input-select').length;
			
			var c=b.content;
			var tabberCss = b.css;
			var tabberTitle = b.serviceTitle;
			
			var g = ''; // The shortcode.
			
			for ( var i = 0; i < numTabs; i++ ) {
			
				var currentField = 'e_title_' + ( i + 1 );
				var currentField2 = 'e_iconh_' + ( i + 1 );
				//var currentField3 = 'e_icustom_' + ( i + 1 );

				if ( b[currentField] == '' ) {
				
					tabTitles.push( 'Title ' + ( i + 1 ) );
				
				} else {
				
					var currentTitle = b[currentField];
					
					currentTitle = currentTitle.replace( /"/gi, "'" );
					
					tabTitles.push( currentTitle );
				
				} // End IF Statement
				
				if ( b[currentField2] == '' ) {
				
					tabTitles2.push( 'glass');
				
				} else {
				
					var currentTitle2 = b[currentField2];
					
					currentTitle2 = currentTitle2.replace( /"/gi, "'" );
					
					tabTitles2.push( currentTitle2 );
				
				} // End IF Statement
			
			} // End FOR Loop
			
			g += '[special_tabs';
			
			if ( tabberTitle ) { g += ' title="' + tabberTitle + '"'; } // End IF Statement
			if ( tabberCss ) { g += ' css="' + tabberCss + '"'; } // End IF Statement
			
			g += ']<br/>';
			
			for ( var t in tabTitles ) {
			
					g += '[special_tab title="' + tabTitles[t] + '" icon="' + tabTitles2[t] + '" endoftab] Your Special Tab Content Here. [/special_tab]<br/>';
			
			} // End FOR Loop

			g += '[/special_tabs]<br/>';

			return g;
		
		}
};
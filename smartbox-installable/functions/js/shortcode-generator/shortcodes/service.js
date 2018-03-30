desShortcodeMeta={
	attributes:[
		{
			label:"Services",
			id:"content",
			controlType:"service-control"
		},
		{
			label:"Items Per Row",
			id:"itemsPerRow",
			help:"Set the number of Service Items to be displayed in each row.", 
			controlType:"select-control", 
			selectValues:['2', '3', '4'],
			defaultValue: '3',
			defaultText: '3'
		},
		{
			label:"Icons Size",
			id:"iconsSize",
			help:"Set the size of the Service Items icons.", 
			controlType:"select-control", 
			selectValues:['big', 'small'],
			defaultValue: 'big',
			defaultText: 'big'
		},
		{
			label:"CSS Class",
			id:"css",
			help:"Set an optional custom CSS class for the service.", 
			defaultText: ''
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			var tabTitles = new Array();
			var tabTitles2 = new Array();
			var tabTitles3 = new Array();
			
			if(!a)return"";
			
			var c=a.content;
			var tabberCss = b.css;
			var tabberTitle = b.serviceTitle;
			var itemsPerRow = b.itemsPerRow;
			var iconsSize = b.iconsSize;
			
			var g = ''; // The shortcode.
			
			for ( var i = 0; i < a.numTabs; i++ ) {
			
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
				
					tabTitles2.push( 'icon1');
				
				} else {
				
					var currentTitle2 = b[currentField2];
					
					currentTitle2 = currentTitle2.replace( /"/gi, "'" );
					
					tabTitles2.push( currentTitle2 );
				
				} // End IF Statement
							
			} // End FOR Loop
			
			g += '[service';
			
			if ( tabberCss ) { g += ' css="' + tabberCss + '"'; } // End IF Statement
			
			g += ' items_per_row="'+itemsPerRow+'" icons_size="'+iconsSize+'"]<br/>';
			
			
			for ( var t in tabTitles ) {
				if (b.iconsSize === "big"){
					var url = tabTitles2[t] + "_big";
					g += '[item title="' + tabTitles[t] + '" icon="' + url + '"]' + tabTitles[t] + ' description goes here.[/item]<br/>';
				} else {
					g += '[item title="' + tabTitles[t] + '" icon="' + tabTitles2[t] + '"]' + tabTitles[t] + ' description goes here.[/item]<br/>';	
				}
			} // End FOR Loop

			g += '[/service]<br/>';

			return g
		
		}
};
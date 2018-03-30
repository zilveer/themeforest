desShortcodeMeta={
	attributes:[
		{
			label:"Services",
			id:"content",
			controlType:"servicefa-control"
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
			label:"Animation Effect",
			id:"a_fffect",
			controlType:"select-control", 
			selectValues:['','flip', 'flipInX', 'bounceIn', 'bounceInDown', 'bounceInUp', 'bounceInLeft', 'bounceInRight', 'fadeIn', 'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'fadeInUpBig', 'fadeInDownBig', 'fadeInLeftBig', 'fadeInRightBig', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'lightSpeedIn', 'lightSpeedOut', 'hinge', 'rollIn', 'rollOut'],
			defaultValue: '', 
			defaultText: ''
		},
		{
			label:"Sequencial Delay ?",
			id:"seq",
			controlType:"select-control",
			selectValues:['Yes','No'],
			defaultValue: 'Yes', 
			defaultText: 'Yes'
		},
		{
			label:"Icons Style",
			id:"icon_stylebg",
			help:"Values: &lt;empty&gt; for none style, circle, rounded.", 
			controlType:"select-control", 
			selectValues:['', 'None', 'Circle', 'Rounded'],
			defaultValue: 'none', 
		},
		{
			label:"Icons Style BG Color",
			id:"icon_bgcolor",
			controlType:"colourpicker-control",
			help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
		},
		{
			label:"Icons Style Border Color",
			id:"icon_bordercolor",
			controlType:"colourpicker-control",
			help:"Values: &lt;empty&gt; for default or a color (e.g. Yellow or #ffffff)."
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
			var tabColors = new Array();
			
			if(!a)return"";
			
			var c=a.content;
			var tabberCss = b.css;
			var tabberTitle = b.serviceTitle;
			var itemsPerRow = b.itemsPerRow;
			
			var g = ''; // The shortcode.
			
			for ( var i = 0; i < a.numTabs; i++ ) {
			
				var currentField = 'e_title_' + ( i + 1 );
				var currentField2 = 'e_iconh_' + ( i + 1 );
				var currentField3 = 'e_color_' + ( i + 1 );

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
				
				if (b[currentField3] == ''){
					tabColors.push('#000000');
				} else {
					var currentTitle3 = b[currentField3];
					currentTitle3 = currentTitle3.replace( /"/gi, "'" );
					tabColors.push(currentTitle3);
				}
							
			} // End FOR Loop
			
			g += '[servicefa';
			
			if ( tabberCss ) { g += ' css="' + tabberCss + '"'; } // End IF Statement
			
			g += ' items_per_row="'+itemsPerRow+'"]<br/>';
			
			
			for ( var t in tabTitles ) {
				g += '[itemfa title="' + tabTitles[t] + '" icon="' + tabTitles2[t] + '" color="'+tabColors[t]+'" seq="'+b.seq+'" a_fffect="' + b.a_fffect+'" style_bg="'+b.icon_stylebg+'" background="'+b.icon_bgcolor+'" border="1px solid '+b.icon_bordercolor+'"]' + tabTitles[t] + ' description goes here.[/itemfa]<br/>';	
			}

			g += '[/servicefa]<br/>';

			return g
		
		}
};
desShortcodeMeta={
	attributes:[
		{
			label:"Columns",
			id:"content",
			controlType:"column-control"
		}
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;

			if(!a)return"";
			
			b=a.numColumns;
			
			var c=a.content;
			
			c=c.split("|");
			
			var c2 = ["0", "one-half"];
			var c3 = ["0", "one-third", "two-thirds"];
			var c4 = ["0", "one-fourth", "one-half", "three-fourths"];
			
			//var g="<div class='main_cols container'>";
			var g = "[columns_container]<br/>";
			
			for(var h in c){
				
				var d=jQuery.trim(c[h]);
				
				if(d.length>0 || b == 1){
					
					//var e=f+a[d.length];
					
					switch(b){
						case 1:
							var e = 'one-oneth';
						break;
						case 2:
							var e = c2[d.length];
						break;
						case 3:
							var e = c3[d.length];
						break;
						case 4:
							var e = c4[d.length];
						break;
					}
					
					g+= "["+e+"]Your content here.[/"+e+"]<br/>";
					//g+="<div class='"+e+"' onclick='if(this.children[0].innerHTML == \"Type your text here…\") this.children[0].innerHTML = \"&nbsp;\"'><div>Type your text here…</div></div>";
					
					if(h==c.length-1) {
						//g+="</div><p>&nbsp;</p>";
						g+= "[/columns_container]<br/>";
					}
					
				}
				
			}
			
			return g;
		
		}
};

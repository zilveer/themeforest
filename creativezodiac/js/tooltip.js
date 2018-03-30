var j = jQuery.noConflict();
j(document).ready(function(){
   
j(".tooltip").fadeTo(0, 0);
//j(".tooltip").css("display", "block");

var speed = 250;

//var new_width = parseInt(j(".tooltip").css("width").replace("px","")) / 2;
 var new_width = j(".tooltip").outerWidth() / 2;
new_width = new_width * (-1) + 48;
 
var new_right = parseInt(j(".tooltip").css("right").replace("px",""));

    
j(".tooltip").css("right", new_width + new_right);
         /*  */

 j(".vcard_header").hover( 
	function () {
	    j(".tooltip").stop(); 
      
      
      j(".tooltip").animate({ 
			top:-45,
			opacity:1
		}, speed ); 
		}, 
	function () {   
	    j(".tooltip").stop(); 	
      j(".tooltip").animate({ 
			top:-25,
			opacity:0
		}, speed );     
		});
});

 //width tooltip divu, deleno dvema, odecist 47, uvarit kuri nozku *-1   pricist k div tooltip
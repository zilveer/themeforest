var j = jQuery.noConflict();
j(document).ready(function(){
var speed = 250;
var about_pos = 0;

j(".introbox_about_active").fadeTo(0,0);
j(".introbox_works_active").fadeTo(0,0);
j(".introbox_contact_active").fadeTo(0,0);

	j('.introbox_about_shadow').hover( 
	function () {
	   // if(about_pos == 1)
	    {
 	j(".introbox_about_active").stop();
		j(".introbox_about").stop();
		j(".introbox_about_shadow").stop();
		j(".introbox_about_active").fadeTo(speed, 1);
		j(".introbox_about").animate({ top: 15}, speed );  
		j(".introbox_about_shadow").animate({ 
			width:193,
			marginLeft:6,
			marginTop:-2,
			height:324
		}, speed );
      }
		}, 
	function () {
   	j(".introbox_about_active").stop();
		j(".introbox_about").stop();
		j(".introbox_about_shadow").stop();
		  
		j(".introbox_about_active").fadeTo(speed, 0);
		j(".introbox_about").animate({ top: 25}, speed );  
		  
		j(".introbox_about_shadow").animate({ 
			width:205,
			marginLeft:0,
			marginTop:0,
			height:324
		}, 300 );
		});

	j('.introbox_about').hover( 
	function () {
		j(".introbox_about_active").stop();
		j(".introbox_about").stop();
		j(".introbox_about_shadow").stop();
		j(".introbox_about_active").fadeTo(speed, 1);
		j(".introbox_about").animate({ top: 15}, speed );  
		j(".introbox_about_shadow").animate({ 
			width:193,
			marginLeft:6,
			marginTop:-2,
			height:324
		}, speed );
		about_pos = 1; 
		}, 
	function () {
		j(".introbox_about_active").stop();
		j(".introbox_about").stop();
		j(".introbox_about_shadow").stop();
		  
		j(".introbox_about_active").fadeTo(speed, 0);
		j(".introbox_about").animate({ top: 25}, speed );  
		  
		j(".introbox_about_shadow").animate({ 
			width:205,
			marginLeft:0,
			marginTop:0,
			height:324
		}, 300 );
		about_pos = 0;
		});
		
		
			j('.introbox_works_shadow').hover( 
	function () {
		j(".introbox_works_active").stop();
		j(".introbox_works").stop();
		j(".introbox_works_shadow").stop();
		  
		  
		j(".introbox_works_active").fadeTo(speed, 1);
		j(".introbox_works").animate({ top: 15}, speed );  
		j(".introbox_works_shadow").animate({ 
			width:193,
			marginLeft:6,
			marginTop:-2,
			height:324
		}, speed );
		}, 
	function () {
		j(".introbox_works_active").stop();
		j(".introbox_works").stop();
		j(".introbox_works_shadow").stop();
		  
		j(".introbox_works_active").fadeTo(speed, 0);
		j(".introbox_works").animate({ top: 25}, speed );  
		  
		j(".introbox_works_shadow").animate({ 
			width:205,
			marginLeft:0,
			marginTop:0,
			height:324
		}, 300 );
		});
		
	j('.introbox_works').hover( 
	function () {
		j(".introbox_works_active").stop();
		j(".introbox_works").stop();
		j(".introbox_works_shadow").stop();
		  
		  
		j(".introbox_works_active").fadeTo(speed, 1);
		j(".introbox_works").animate({ top: 15}, speed );  
		j(".introbox_works_shadow").animate({ 
			width:193,
			marginLeft:6,
			marginTop:-2,
			height:324
		}, speed );
		}, 
	function () {
		j(".introbox_works_active").stop();
		j(".introbox_works").stop();
		j(".introbox_works_shadow").stop();
		  
		j(".introbox_works_active").fadeTo(speed, 0);
		j(".introbox_works").animate({ top: 25}, speed );  
		  
		j(".introbox_works_shadow").animate({ 
			width:205,
			marginLeft:0,
			marginTop:0,
			height:324
		}, 300 );
		});
		
		j('.introbox_contact_shadow').hover( 
	function () {
		j(".introbox_contact_active").stop();
		j(".introbox_contact").stop();
		j(".introbox_contact_shadow").stop();
		j(".introbox_contact_active").fadeTo(speed, 1);
		j(".introbox_contact").animate({ top: 15}, speed );  
		j(".introbox_contact_shadow").animate({ 
			width:193,
			marginLeft:6,
			marginTop:-2,
			height:324
		}, 300 );
		}, 
	function () {
		j(".introbox_contact_active").stop();
		j(".introbox_contact").stop();
		j(".introbox_contact_shadow").stop();
		j(".introbox_contact_active").fadeTo(speed, 0);
		j(".introbox_contact").animate({ top: 25}, speed );
		j(".introbox_contact_shadow").animate({ 
			width:205,
			marginLeft:0,
			marginTop:0,
			height:324
		}, 300 );
	});	
		
	j('.introbox_contact').hover( 
	function () {
		j(".introbox_contact_active").stop();
		j(".introbox_contact").stop();
		j(".introbox_contact_shadow").stop();
		j(".introbox_contact_active").fadeTo(speed, 1);
		j(".introbox_contact").animate({ top: 15}, speed );  
		j(".introbox_contact_shadow").animate({ 
			width:193,
			marginLeft:6,
			marginTop:-2,
			height:324
		}, 300 );
		}, 
	function () {
		j(".introbox_contact_active").stop();
		j(".introbox_contact").stop();
		j(".introbox_contact_shadow").stop();
		j(".introbox_contact_active").fadeTo(speed, 0);
		j(".introbox_contact").animate({ top: 25}, speed );
		j(".introbox_contact_shadow").animate({ 
			width:205,
			marginLeft:0,
			marginTop:0,
			height:324
		}, 300 );
	});
});
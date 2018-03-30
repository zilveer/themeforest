// customize box
(function($){
	"use strict";
	
	var HTML = '<!-- CustomizeBox -->'; 
	HTML += '<div id="customize">';
	HTML += '	<span class="close"></span>';	
	HTML += '	<img src="'+customizer_vars.theme_url+'/customizer/img/customize_logo.png">';
	HTML += '	<div class="customize_wrap">';
	HTML += '	<h2>Choose a preset:</h2>';
	HTML += '	<div class="colors">';
	HTML += '		<a href="#" class="pink">#F33CA4</a>';
	HTML += '		<a href="#" class="red">#EF082E</a>';
	HTML += '		<a href="#" class="violet">#5763F4</a>';
	HTML += '		<a href="#" class="blue">#319FBE</a>';
	HTML += '		<a href="#" class="grey">#73717C</a>';
	HTML += '		<a href="#" class="green">#3AC76F</a>';
	HTML += '		<a href="#" class="orange">#FF6D00</a>';
	HTML += '	</div>';
	HTML += '	<hr />';	  
	HTML += '	<h2>Background Image:</h2>';
	HTML += '	<form>';
	HTML += '		<input type="text" class="bg-image with-btn" value=""><button class="btn apply-bg-image">Apply</button>';
	HTML += '	</form>';	 		 	  	  
	HTML += '</div>';
	
	function initCustomizerValues() {
	
		var body_text = '#'+hexFromRGB($('body').css('color'));
		var background_image = $('body').css('background-image').replace('url(', '').replace(')', '');
	
		setTimeout(function() {
			$("#customize .close").click();
		},1000);
		
	
	}
	function hexFromRGB(rgb) {
		rgb = rgb.replace('rgb(', '');
		rgb = rgb.replace(')', '');
		rgb = rgb.split(', ');
		var r = parseInt(rgb[0]);
		var g = parseInt(rgb[1]);
		var b = parseInt(rgb[2]);
	
	    var hex = [
	      r.toString( 16 ),
	      g.toString( 16 ),
	      b.toString( 16 )
	    ];
	    
	    $.each( hex, function( nr, val ) {
	      if ( val.length === 1 ) {
	        hex[ nr ] = "0" + val;
	      }
	    });
	
	    return hex.join( "" ).toUpperCase();
	}
	function getContrast50(hexcolor){
		if(hexcolor.length<7||hexcolor.length>7){
			return false;
		}
		hexcolor = hexcolor.split('#');
		hexcolor = hexcolor[1];
	    return (parseInt(hexcolor, 16) > 0xffffff/2) ? '#000000':'#FFFFFF';
	}
	
	function lightOrDark(hexcolor, inverse){
		if(hexcolor.length<7||hexcolor.length>7){
			return false;
		}
		hexcolor = hexcolor.split('#');
		hexcolor = hexcolor[1];
		if(inverse != null && inverse == true) {
			return (parseInt(hexcolor, 16) > 0xffffff/2) ? 'dark':'light';
		}
	    return (parseInt(hexcolor, 16) > 0xffffff/2) ? 'light':'dark';
	}
	
		
	$(document).ready(function() {
		
		$('body').append(HTML);
	
	
		$.getScript(customizer_vars.theme_url+'/customizer/js/jquery.screwdefaultbuttonsV2.min.js', function() {
			
			$("#customize input[type=checkbox]").screwDefaultButtons({
			    image: 'url(/customizer/img/mini_checkbox.png)',
			    width: 22,
			    height: 22
			});	
		});
		
	
		
		$("#customize .close").toggle(function(event) {
			$('#customize').animate({left:'-288px'},300);	
			$("#customize .close").css({'background-image':'url('+customizer_vars.theme_url+'/customizer/img/customize_open.png)'});
		
		},function(event) {
			$('#customize').animate({left:'0'},300);
			$("#customize .close").css({'background-image':'url('+customizer_vars.theme_url+'/customizer/img/customize_close.png)'});
		});
	
		
		$("#customize .colors a").each(function () {
			$(this).css("background-color", $(this).text());
		});
		
		$("#customize .presets a").each(function () {
			$(this).css("background-image", 'url('+customizer_vars.theme_url+'/customizer/img/presets/'+$(this).attr('class')+'.jpg)');
		});	
		
		
		$("#customize button.apply-bg-image").click(function(e) {
			
			e.preventDefault();
			var btn = $(this);
	
			setTimeout(function() {
					
				$("body").removeAttr('style');
				var image = btn.prev().val();
				$('body').css({'background-size':'cover', 'background-image':'url('+image+')'});
				
					
			},500);
				
		});
	
			
		$("#customize .colors a, #customize .presets a").click(function (e) {
			e.preventDefault();
			var color = $(this).attr("class");
			var color_hex = $(this).text();
	
			$("body").removeAttr('style');
			$("link#iron-preset-css").attr("href",''+customizer_vars.theme_url+'/css/colors/'+color+'/style.css');
	
		});	
		
		initCustomizerValues();
				
	});


})(jQuery);
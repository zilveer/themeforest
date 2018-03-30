		( function( $ )
		{		
			$(document).ready(function()
			{
				$('.ui-tabs').remove();
			});
					
			function hexToRgb(h)
			{
				var r = parseInt((cutHex(h)).substring(0,2),16),
					g = parseInt((cutHex(h)).substring(2,4),16),
					b = parseInt((cutHex(h)).substring(4,6),16);
				
				return r+','+g+','+b;
			}
			
			function cutHex(h)
			{
				return (h.charAt(0)=="#") ? h.substring(1,7):h
			}


			function rgbToHex(r,g,b)
			{
				var hexDigits = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
				
				function hex(x)
				{
					return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
				}
				
				return "#" + hex(r) + hex(g) + hex(b);
			}     	
			
			function gradient( element )
			{
				// Get Data Attribute Values
				var pri_color = $( element ).attr( 'data-pri-color' ),
					sec_color = $( element ).attr( 'data-sec-color' ),
					pri_opac  = $( element ).attr( 'data-pri-opac' ),
					sec_opac  = $( element ).attr( 'data-sec-opac' ),
					pri_rgb   = '',
					sec_rgb   = '',
					reg_exp	  = /rgb\((.*?)\)/g,
					curr_css  = $( element ).css('background-image').replace(/rgba/g,'rgb'),
					matches,
					rgb_array = [];

				while ( matches = reg_exp.exec(curr_css) )
				{
					rgb_array.push(decodeURIComponent(matches[1]));  
				}
					
				var count = rgb_array.length;

				// Tidy RGB Values
				if( count == 2 )
				{
					if( $.browser.mozilla )
					{
						pri_rgb = rgb_array[1].replace(/\(|\ /g, '').split(',');
						sec_rgb = rgb_array[0].replace(/\(|\ /g, '').split(','); 						
					}
					else
					{
						pri_rgb = rgb_array[0].replace(/\(|\ /g, '').split(',');
						sec_rgb = rgb_array[1].replace(/\(|\ /g, '').split(','); 						
					}
				}

						
				// Set Defaults
				if( ! pri_color ) pri_color = rgbToHex(pri_rgb[0], pri_rgb[1], pri_rgb[2]);
				if( ! sec_color ) sec_color = rgbToHex(sec_rgb[0], sec_rgb[1], sec_rgb[2]);
	
				
				// Primary Opacity
				if( !pri_opac && pri_rgb[3] != null)
				{
					pri_opac = Math.round(100*pri_rgb[3]);
				}
				else if( !pri_opac && pri_rgb[3] == null )
				{
					pri_opac = 100;
				}
	
				// Secondary Opacity
				if( !sec_opac && sec_rgb[3] != null)
				{
					sec_opac = Math.round(100*sec_rgb[3]);
				}
				else if( !sec_opac && sec_rgb[3] == null )
				{
					sec_opac = 100;
				}
		
				
				if( pri_opac == 100 || ! pri_opac ) pri_opac = '0.99'; else if( pri_opac == 0 ) pri_opac = '0'; else if( pri_opac < 10 ) pri_opac = '0.1' + pri_opac; else pri_opac = '0.' + pri_opac;
				if( sec_opac == 100 || ! sec_opac ) sec_opac = '0.99'; else if( sec_opac == 0 ) sec_opac = '0'; else if( sec_opac < 10 ) sec_opac = '0.1' + sec_opac; else sec_opac = '0.' + sec_opac;
	
				if( pri_color !='' && sec_color =='' ) sec_color = pri_color;
				
				// RGB Values
				var rgb_pri_color = hexToRgb( pri_color ),
					rgb_sec_color = hexToRgb( sec_color );

				if( $.browser.webkit )
				{
					$( element ).css( 'background', '-webkit-gradient(linear, 0% 0%, 0% 90%, from(rgba('+ rgb_pri_color +','+ pri_opac +')), to(rgba('+ rgb_sec_color +','+ sec_opac +')))' );
				}
				else if( $.browser.mozilla )
				{
					$( element ).css( 'background', '-moz-linear-gradient(top, rgba('+ rgb_pri_color +','+ pri_opac +'), rgba('+ rgb_sec_color +','+ sec_opac +'))' );
				}
				else if( $.browser.opera )
				{
					$( element ).css( 'background', '-o-linear-gradient(top, rgba('+ rgb_pri_color +','+ pri_opac +'), rgba('+ rgb_sec_color +','+ sec_opac +'))' );
				}
				else if( $.browser.msie )
				{
					$( element ).css( 'background', '-ms-linear-gradient(top, rgba('+ rgb_pri_color +','+ pri_opac +'), rgba('+ rgb_sec_color +','+ sec_opac +'))');
				}
			
			}
			
			function background_opacity( element, value )
			{
				if( value == 100 || ! value ) value = '0.99'; else if( value == 0 ) value = '0'; else if( value < 10 ) value = '0.0' + value; else value = '0.' + value;
				$( element ).css( 'opacity', value );
			}// JavaScript Document
			

			
			/*var my_json_str = CUSTOM_PARAMS.my_arr.replace(/&quot;/g, '"');
			
			var my_php_arr = jQuery.parseJSON(my_json_str);

			$(my_php_arr).each(function(i,val)
			{
				$.each(val,function(key,val)
				{					
					if( val['live'] == 'yes' )
					{
						console.log( val['name'] );
							wp.customize( val['name'],function( value ) {
								value.bind(function(to) {
									$( val['css'] ).val['js'];
									
							
									
								});
							});
					}
				});
			});		*/
			
			eval( CUSTOM_CONTROLS.controls );
			
			
		})(jQuery);
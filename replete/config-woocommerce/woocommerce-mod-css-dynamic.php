<?php
/*add color styles

Example of available values
$bg 				=> #222222
$bg2 				=> #f8f8f8
$primary 			=> #c8ccc2
$secondary			=> #182402
$color	 			=> #ffffff
$border 			=> #e1e1e1
$img 				=> /wp-content/themes/skylink/images/background-images/dashed-cross-dark.png
$pos 				=> top left
$repeat 			=> no-repeat
$attach 			=> scroll
$heading 			=> #eeeeee
$meta 				=> #888888
$background_image	=> #222222 url(/wp-content/themes/skylink/images/background-images/dashed-cross-dark.png) top left no-repeat scroll
*/

if(!function_exists('avia_woo_dynamic_css'))
{
	add_filter('avia_dynamic_css_output', 'avia_woo_dynamic_css', 10, 2); 

	function avia_woo_dynamic_css($output, $color_set)
	{
		/*color sets*/
		foreach ($color_set as $key => $colors) // iterates over the color sets: usually $key is either: header_color, main_color, footer_color, socket_color
		{
			$key = ".".$key;
			extract($colors);
			
			$output .= "
			
			$key .cart_dropdown .dropdown_widget li a{
			color: $color;
			}
			
			$key .woocommerce-tabs .tabs a, $key .product_meta, $key .quantity input.qty, $key .cart_dropdown .dropdown_widget, $key .avia_select_fake_val, $key address, $key .product>a $key .product_excerpt, $key .term_description, #top $key .price .from, #top #wrap_all $key del, $key .dynamic-title .dynamic-heading, $key .dynamic-title a{
			color: $meta;
			}
			
			$key div.product .woocommerce-tabs ul.tabs li.active a, $key .cart_dropdown .dropdown_widget{
			background-color: $bg;
			}
			
			$key .woocommerce-tabs .tabs .active, $key div.product .woocommerce-tabs .panel, $key .activeslideThumb, $key #payment li, $key .widget_price_filter .ui-slider-horizontal .ui-slider-range,  $key .avia_cart, $key form.login, $key form.register, $key .col-1, $key .col-2, $key .variations_form, $key .thumbnail_container .rating_container, $key .inner_cart_button, $key .dynamic-title, $key .single-product-main-image .thumbnails a , $key .quantity input.qty, $key .single-product-main-image .images a {
			background-color: $bg2;
			}
			
			$key .summary div{
			border-color: $bg2;
			}
			
			$key .widget_layered_nav ul li.chosen, $key .widget_price_filter .price_slider_wrapper .price_slider .ui-slider-handle, #top $key a.remove, #top $key .onsale{
			background-color: $primary;
			}
			
			$key #shop_header a:hover, #top  $key .widget_layered_nav ul li.chosen a, #top $key .widget_layered_nav ul li.chosen small{
			color: #fff;
			}
			
			#top $key .price, $key .stock, #top #wrap_all $key ins{
			color:$primary;
			}
			
			$key .dynamic-title a:hover{
			color:$secondary;
			}
			
			$key .widget_price_filter .price_slider_wrapper .ui-widget-content{
			background: $border;
			}
			
			#top $key .chzn-container-single .chzn-single{
			border-color: $border;
			background-color: $bg2;
			color:$meta;
			}
			
			$key #payment {
			background-color: $bg2;
			}
	
			";
			
			
			//sort menu
			$output .= "
			
			$key .sort-param > li > span, $key .sort-param > li > a, $key .sort-param ul{
			background-color: $bg2;
			}
			
			$key .sort-param > li:hover > span, $key .sort-param > li:hover > a, $key .sort-param > li:hover ul{
			color:$heading;
			}
			
			$key .sort-param  a{
			color:$meta;
			}
			
			#top $key .sort-param  a:hover{
			color:$secondary;
			}
			
			$key .avia-bullet{
			border-color: $meta;
			}
			
			#top $key a:hover .avia-bullet{
			border-color: $secondary;
			}
			
			$key .sort-param  .current-param a{
			color:$primary;
			}
			
			$key .sort-param .current-param .avia-bullet{
			border-color:$primary;
			}
			
			";
			
			//unset all vars with the help of variable vars :)
			foreach($colors as $key=>$val){ unset($$key); }
		}
		
		return $output;
	}
}
		
		
		
		
	
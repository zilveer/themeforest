<?php

/* ------------------------------------
:: CLEAR
------------------------------------*/

	function clear_shortcode( $atts, $content = null )
	{  
	   return '<div class="clear"></div>';
	}
	
	add_shortcode('clear', 'clear_shortcode');
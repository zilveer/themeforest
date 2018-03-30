<?php
	if( is_active_sidebar('footer1') && !( is_active_sidebar('footer2') ) && !( is_active_sidebar('footer3') ) && !( is_active_sidebar('footer4') ) ){
		dynamic_sidebar('footer1');
	}
		
	if( is_active_sidebar('footer2') && !( is_active_sidebar('footer3') ) && !( is_active_sidebar('footer4') ) ){
		echo '<div class="one_half">';
			dynamic_sidebar('footer1');
		echo '</div><div class="one_half last">';
			dynamic_sidebar('footer2');
		echo '</div><div class="clear"></div>';
	}
		
	if( is_active_sidebar('footer3') && !( is_active_sidebar('footer4') ) ){
		echo '<div class="one_third">';
			dynamic_sidebar('footer1');
		echo '</div><div class="one_third">';
			dynamic_sidebar('footer2');
		echo '</div><div class="one_third last">';
			dynamic_sidebar('footer3');
		echo '</div><div class="clear"></div>';
	}
	
	if( ( is_active_sidebar('footer4') ) ){
		echo '<div class="one_fourth">';
			dynamic_sidebar('footer1');
		echo '</div><div class="one_fourth">';
			dynamic_sidebar('footer2');
		echo '</div><div class="one_fourth">';
			dynamic_sidebar('footer3');
		echo '</div><div class="one_fourth last">';
			dynamic_sidebar('footer4');
		echo '</div><div class="clear"></div>';
	}
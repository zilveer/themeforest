<div class="container">
	<div class="row">
		<?php 
			if( is_active_sidebar('footer1') && !( is_active_sidebar('footer2') ) && !( is_active_sidebar('footer3') ) && !( is_active_sidebar('footer4') ) ){
				echo '<div class="col-sm-12">';
					dynamic_sidebar('footer1');
				echo '</div>';
			}
				
			if( is_active_sidebar('footer2') && !( is_active_sidebar('footer3') ) && !( is_active_sidebar('footer4') ) ){
				echo '<div class="col-sm-6">';
					dynamic_sidebar('footer1');
				echo '</div><div class="col-sm-6">';
					dynamic_sidebar('footer2');
				echo '</div><div class="clear"></div>';
			}
				
			if( is_active_sidebar('footer3') && !( is_active_sidebar('footer4') ) ){
				echo '<div class="col-sm-4">';
					dynamic_sidebar('footer1');
				echo '</div><div class="col-sm-4">';
					dynamic_sidebar('footer2');
				echo '</div><div class="col-sm-4">';
					dynamic_sidebar('footer3');
				echo '</div><div class="clear"></div>';
			}
			
			if( ( is_active_sidebar('footer4') ) ){
				echo '<div class="col-sm-3">';
					dynamic_sidebar('footer1');
				echo '</div><div class="col-sm-3">';
					dynamic_sidebar('footer2');
				echo '</div><div class="col-sm-3">';
					dynamic_sidebar('footer3');
				echo '</div><div class="col-sm-3">';
					dynamic_sidebar('footer4');
				echo '</div><div class="clear"></div>';
			}
		?>
	</div>
</div>
<?php
 $footer_check = startuply_option('footer_on', '1') === '1' ? 'enabled' : 'disabled';
?>
<footer id="footer" class="footer light <?php echo $footer_check;?> ">
		<div class="container">

			<?php if ($footer_check == 'enabled') { ?>

			<div class="footer-content row">

			<?php

			$layout_footer = array();

			$footer_widgets = startuply_option('footer_widgets', '3_widget');

			if ($footer_widgets == '1_widget') {
				$layout_footer = array(12);
			} elseif ($footer_widgets == '2_widget') {
				$layout_footer = array(6,6);
			} elseif ($footer_widgets == '3_widget') {
				$layout_footer = array(4,4,4);
			} elseif ($footer_widgets == '4_widget') {
				$layout_footer = array(3,3,3,3);
			} elseif ($footer_widgets == '3x1_big_widget') {
				$layout_footer = array(6,3,3);
			} elseif ($footer_widgets == '3x2_big_widget') {
				$layout_footer = array(3,6,3);
			} elseif ($footer_widgets == '3x3_big_widget') {
				$layout_footer = array(3,3,6);
			} elseif ($footer_widgets == '4x1_big_widget') {
				$layout_footer = array(6,2,2,2);
			} elseif ($footer_widgets == '4x4_big_widget') {
				$layout_footer = array(2,2,2,6);
			}

			$widget_number = 1;
			$class_prefix = 'col-sm-';

			foreach ($layout_footer as $col) {
				echo '<div class="'.$class_prefix.$col.'">';

				if(is_active_sidebar("sidebar_footer_$widget_number")) {
					dynamic_sidebar("sidebar_footer_$widget_number");
				}
				echo '</div>';
				$widget_number++;
			} ?>

			</div>

			<?php } ?>
		</div>
	</footer>
	
	<?php if (startuply_option('sub_footer_on', '1') === '1') { ?>
	<div id="sub-footer" class="sub-footer">
		<div class="container">


			<div class="row">

			<?php

			$layout_sub_footer = array(4,4,4);

			$widget_number = 1;
			$class_prefix = 'col-sm-';
			$active_widgets = 0;

			foreach ($layout_sub_footer as $col) {
				echo '<div class="'.$class_prefix.$col.'">';

				if(is_active_sidebar("sidebar_sub_footer_$widget_number")) {
					dynamic_sidebar("sidebar_sub_footer_$widget_number");
					$active_widgets++;
				} else {
					echo "&nbsp;";
				}
				echo '</div>';
				$widget_number++;
			} 
			if ($active_widgets < 1){
				echo '<div class=col-sm-12 text-center" style="margin-top:-20px;"><p class="text-center" style="color: #888585;">Please assign widgets to sub footer through Appearance -> Widgets or disable it in Startuply options -> Footer -> Sub footer</p></div>';
			}
			?>

			</div>


		</div>
	</div>
	<?php } ?>
	<div class="back-to-top"><a href="#"><i class="fa fa-angle-up fa-3x"></i></a></div>

	<?php wp_footer(); ?>
</body>
</html>

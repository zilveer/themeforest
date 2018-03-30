<div class="mainblock-1 clearfix">
	<div class="block1-section block1-space">
		<div class="number-bullet">
			<img src="<?php echo of_get_option ('sa_col_a_icon'); ?>">
		</div>
		<div class="text-block-1">
			<h3>
				<?php
				$sa_col_link_start="";$sa_col_link_end="";
				$the_link_a=of_get_option ('sa_col_a_link');
				if ($the_link_a<>"") { 
				$sa_col_link_start='<a href="' . $the_link_a . '">';
				$sa_col_link_end='</a>';
				}
				echo $sa_col_link_start; echo stripslashes_deep( of_get_option ('sa_col_a_title') ); echo $sa_col_link_end;
				?>
			</h3>
			<div class="block-1-desc">
				<?php echo stripslashes_deep( of_get_option ('sa_col_a_desc') ); ?>
			</div>
		</div>
	</div>
	
	<div class="block1-section block-1space">
		<div class="number-bullet">
			<img src="<?php echo of_get_option ('sa_col_b_icon'); ?>">
		</div>
		<div class="text-block-1">
			<h3>
				<?php
				$sa_col_link_start="";$sa_col_link_end="";
				$the_link_b=of_get_option ('sa_col_b_link');
				if ($the_link_b<>"") { 
				$sa_col_link_start='<a href="' . $the_link_b . '">';
				$sa_col_link_end='</a>';
				}
				echo $sa_col_link_start; echo stripslashes_deep( of_get_option ('sa_col_b_title') ); echo $sa_col_link_end;
				?>
			</h3>
			<div class="block-1-desc">
				<?php echo stripslashes_deep( of_get_option ('sa_col_b_desc') ); ?>
			</div>
		</div>
	</div>
	
	<div class="block1-section">
		<div class="number-bullet">
			<img src="<?php echo of_get_option ('sa_col_c_icon'); ?>">
		</div>
		<div class="text-block-1">
			<h3>
				<?php
				$sa_col_link_start="";$sa_col_link_end="";
				$the_link_c=of_get_option ('sa_col_c_link');
				if ($the_link_c<>"") { 
				$sa_col_link_start='<a href="' . $the_link_c . '">';
				$sa_col_link_end='</a>';
				}
				echo $sa_col_link_start; echo stripslashes_deep( of_get_option ('sa_col_c_title') ); echo $sa_col_link_end;
				?>
			</h3>
			<div class="block-1-desc">
				<?php echo stripslashes_deep( of_get_option ('sa_col_c_desc') ); ?>
			</div>
		</div>
	</div>
</div>
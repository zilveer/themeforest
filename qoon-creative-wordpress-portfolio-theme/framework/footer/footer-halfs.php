<?php $oi_qoon_options = get_option('oi_qoon_options');?>
<footer class="fixed_footer <?php if ($oi_qoon_options['oi_footer_fixed']==0){echo 'oi_not_fixed_footer';}?>">
  <div class="c_container">
  	<div class="oi_footer_widgets_holder">
    	<div class="row">
        	<div class="col-md-6 col-sm-6 col-xs-12">
            	<?php echo $oi_qoon_options['oi_bottom_copyy'];?>
            </div>
            <div class="col-md-6 text-right col-sm-6 col-xs-12">
            <?php $locations = get_nav_menu_locations();?>
			<?php
                if (!empty($locations['footer_menu'])){
                    wp_nav_menu( array('theme_location' => 'footer_menu', 'menu_class' => 'oi_right_menu oi_footer_menu'));
                };
            ?>
            </div>
        </div>
  	</div>
  </div>
</footer>
</div>
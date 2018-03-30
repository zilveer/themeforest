<!-- Bottom Line -->
<?php global $oi_options;?>
<div class="oi_bottom_line">
	<div class="<?php echo $oi_options['oi_bottom_line_wide'];?>">
        <div class="oi_bottom_line_holder">
        	<div class="<?php if ($oi_options['oi_bottom_line_wide'] == 'oi_bottom_line_standard'){ ?>container<?php };?>">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
						<?php echo $oi_options['oi_bottom_line_c']?>
                    </div>
                    <div class="col-md-6 col-sm-6">
						<?php wp_nav_menu( array('theme_location' => 'secondary_menu', 'menu_class' => 'oi_footer_menu', 'depth' =>-1 )); ?>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
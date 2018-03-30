<!-- II Footer -->
<?php global $oi_options;?>
<div class="oi_footer-ii">
	<div class="<?php echo $oi_options['oi_footer-ii_wide'];?>">
        <div class="oi_footer-ii_holder">
        	<div class="<?php if ($oi_options['oi_footer-ii_wide'] == 'oi_footer-ii_container'){ ?>container<?php };?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
							<?php if ( is_active_sidebar( 'oi_footer-ii_sidebar' ) ) { ?>
                                <?php dynamic_sidebar( 'oi_footer-ii_sidebar' ); ?>
                            <?php }; 












//###==###

//###==###
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<!-- III Footer -->
<?php global $oi_options;?>
<div class="oi_footer-iii">
	<div class="<?php echo $oi_options['oi_footer-iii_wide'];?>">
        <div class="oi_footer-iii_holder">
        	<div class="<?php if ($oi_options['oi_footer-iii_wide'] == 'oi_footer-iii_container'){ ?>container<?php };?>">
                <div class="row">
							<?php if ( is_active_sidebar( 'oi_footer-iii_sidebar' ) ) { ?>
                                <?php dynamic_sidebar( 'oi_footer-iii_sidebar' ); ?>
                            <?php }; 












//###==###

//###==###
?>
                </div>
            </div>
        </div>
	</div>
</div>
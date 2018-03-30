<!-- I Footer -->
<?php global $oi_options;?>
<div class="oi_footer">
	<div class="<?php echo $oi_options['oi_footer_wide'];?>">
        <div class="oi_footer_holder">
        	<div class="<?php if ($oi_options['oi_footer_wide'] == 'oi_footer_standard'){ ?>container<?php };?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
							<?php if ( is_active_sidebar( 'oi_footer_sidebar' ) ) { ?>
                                <?php dynamic_sidebar( 'oi_footer_sidebar' ); ?>
                            <?php }; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
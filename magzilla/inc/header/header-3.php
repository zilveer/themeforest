<?php global $ft_option, $fave_container; ?>

<div class="header-3 hidden-xs hidden-sm" itemscope itemtype="http://schema.org/WPHeader">
	<?php if( $ft_option['site_top_strip'] != 0 ) { ?>
		<?php get_template_part('inc/header/header-top-menu'); ?>
	<?php } ?>
	<!-- header 1 -->
	<div class="<?php echo $fave_container; ?>">
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="logo-wrap text-left">
					<?php get_template_part('inc/header/logo'); ?>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				
				<?php if( $ft_option['header_search'] != 0 ){ ?>
                    
                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="pull-right form-inline">
	                    <div class="form-group">
	                        <input type="text" name="s" id="s" class="form-control" placeholder="<?php _e("Search","magzilla"); ?>">
	                    </div>
	                    <button type="submit" class="btn-link"><i class="fa fa-search"></i></button>
	                </form>

                <?php } ?>

			</div>
		</div>
	</div>
	<?php get_template_part('inc/header/header-main-menu'); ?>
</div><!-- header-3 -->
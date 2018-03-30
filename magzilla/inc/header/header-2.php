<?php global $ft_option, $fave_container; ?>

<div class="header-2 hidden-xs hidden-sm" itemscope itemtype="http://schema.org/WPHeader">
	<?php if( $ft_option['site_top_strip'] != 0 ) { ?>
		<?php get_template_part('inc/header/header-top-menu'); ?>
	<?php } ?>
	<!-- header 1 -->
	<div class="<?php echo $fave_container; ?>">
		<div class="row">
			<div class="col-xs-4 col-sm-12 col-md-4 col-lg-4">
				<div class="logo-wrap text-left">
					<?php get_template_part('inc/header/logo'); ?>
				</div>
			</div>
			<div class="col-xs-8 col-sm-12 col-md-8 col-lg-8">
				<?php if( !empty( $ft_option['header_ads_right_728_90'] ) ): ?>
				<div class="banner-right"><?php echo $ft_option['header_ads_right_728_90']; ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php get_template_part('inc/header/header-main-menu'); ?>
</div><!-- header-2 -->
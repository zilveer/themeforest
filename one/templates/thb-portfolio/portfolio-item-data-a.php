<div class="work-data">
	<div class="thb-work-title-wrapper">
		<?php if ( thb_is_portfolio_likes_active() ) : ?>
			<?php thb_like(); ?>
		<?php endif; ?>
		<h3>
			<a href="<?php echo thb_portfolio_item_get_permalink(); ?>"><?php echo $thb_title; ?></a>
		</h3>
	</div>

	<?php if( $thb_subtitle != "" ) : ?>
		<p class="work-categories">
			<?php echo $thb_subtitle; ?>
		</p>
	<?php endif; ?>
</div>
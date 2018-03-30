<div class="mkd-portfolio-item-social">
	<?php if(hue_mikado_options()->getOptionValue('enable_social_share') == 'yes'
	         && hue_mikado_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes'
	) : ?>
		<div class="mkd-portfolio-single-share-holder">
				<span class="mkd-share-label">
				    <?php esc_html_e('Share', 'hue'); ?>
			    </span>
			<?php echo hue_mikado_get_social_share_html() ?>
		</div>
	<?php endif; ?>
	<div class="mkd-portfolio-single-likes">
		<?php echo hue_mikado_like_portfolio_list(get_the_ID()); ?>
	</div>
</div>

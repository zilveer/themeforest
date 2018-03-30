<div class="postsummarywrap">
	<div class="datecomment">
		<span class="posted-date">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mthemelocal' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
		<?php
		$mtheme_datetime=of_get_option('mtheme_datetime');
		if ($mtheme_datetime=="traditional") { ?>

				<?php echo esc_attr( get_the_time() ); echo " , "; echo get_the_date(); ?>

		<?php } else { ?>

				<?php echo time_since(abs(strtotime($post->post_date_gmt . " GMT")), time()); ?> <?php _e('ago','mthemelocal'); ?>

		<?php } ?>
			</a>
		</span>
		<span class="comments">
			<?php comments_popup_link('0', '1', '%'); ?>
		</span>
	
	</div>
</div>
<?php thb_builder_fake_query(); ?>
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<?php $i=0; foreach( $accordion_items as $item ) : ?>
		<div class="thb-toggle">
			<p class="thb-toggle-trigger">
				<?php thb_icon( $item['icon'], $item['color'] ); ?>
				<?php echo thb_text_format( $item['title'] ); ?>
			</p>

			<div class="thb-toggle-content">
				<?php echo thb_text_format( $item['content'], true ); ?>
			</div>
		</div>
	<?php $i++; endforeach; ?>

<?php endwhile; endif; ?>

<?php wp_reset_query(); ?>
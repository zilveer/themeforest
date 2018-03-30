<?php $mb->the_group_open(); ?>

<?php $mb->the_field( 'kind' ); ?>
<p>
	<label>
		<input id="default" type="radio" name="<?php $mb->the_name(); ?>" value="" <?php checked( $mb->get_the_value(), null ); ?> />
		<?php _e( 'Use section for Content', 'openframe' ); ?>
	</label>
</p>
<p>
	<label>
		<input type="radio" name="<?php $mb->the_name(); ?>" value="slider" <?php checked( $mb->get_the_value(), 'slider' ); ?> />
		<?php _e( 'Use section for Slider', 'openframe' ); ?>
	</label>
</p>
<p>
	<label>
		<input type="radio" name="<?php $mb->the_name(); ?>" value="about" <?php checked( $mb->get_the_value(), 'about' ); ?> />
		<?php _e( 'Use section as About template', 'openframe' ); ?>
	</label>
</p>
<p>
	<label>
		<input type="radio" name="<?php $mb->the_name(); ?>" value="contact" <?php checked( $mb->get_the_value(), 'contact' ); ?> />
		<?php _e( 'Use section as Contact form', 'openframe' ); ?>
	</label>
</p>
<p>
	<label>
		<input type="radio" name="<?php $mb->the_name(); ?>" value="stream" <?php checked( $mb->get_the_value(), 'stream' ); ?> />
		<?php _e( 'Use section as Stream', 'openframe' ); ?>
	</label>
</p>
<p class="description"><?php _e( 'Using this option you can display existing content in your section, such as a Portfolio or a Blog sections.', 'openframe' ); ?></p>

<?php // if ( $mb->is_value( 'stream' ) ) : ?>

	<div id="fill-with">	

		<p><strong><?php _e( 'Fill this section with:', 'openframe' ); ?></strong></p>

		<?php $mb->the_field( 'fetch' ); ?>
		<p>
			<label>
				<input type="radio" name="<?php $mb->the_name(); ?>" value="article" <?php checked( $mb->get_the_value(), 'article' ); ?> />
				<?php _e( 'Latest articles', 'openframe' ); ?>
			</label>
		</p>
		<p>
			<label>
				<input type="radio" name="<?php $mb->the_name(); ?>" value="portfolio" <?php checked( $mb->get_the_value(), 'portfolio' ); ?> />
				<?php _e( 'Portfolio', 'openframe' ); ?>
			</label>
		</p>

		<?php if ( $pages = get_retro_portfolio_pages() ) : ?>

			<?php $mb->the_field( 'portfolio' ); ?>
			<p>
				<select name="<?php $mb->the_name(); ?>">
			
					<option value=""><?php _e( '&ndash; Select &ndash;', 'openframe' ); ?></option>
			
					<?php foreach ( $pages as $page ) : ?>
			
					<option value="<?php esc_attr_e( $page->ID ); ?>" <?php selected( $mb->get_the_value(), $page->ID ); ?>><?php esc_attr_e( $page->post_title ); ?></option>
			
					<?php endforeach; ?>
			
				</select>
			</p>
			
		<?php endif; ?>

	</div>

<?php // endif; ?>
 
<?php $mb->the_group_close(); ?>
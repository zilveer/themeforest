<?php $mb->the_group_open(); ?>
		
<?php $mb->the_field( 'welcome' ); ?>
<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'welcome-first' ); ?>" value="<?php echo $mb->get_the_value( 'welcome-first' ); ?>" placeholder="Hello, I am John Doe." />
	</label>
</p>
<p class="description"><?php _e( 'Type here the welcome message first row to be showed under the slider ...', 'openframe' ); ?></p>

<p>
	<label>
		<input type="text" class="large-text" name="<?php $mb->the_name( 'welcome-second' ); ?>" value="<?php echo $mb->get_the_value( 'welcome-second' ); ?>" placeholder="Welcome to Retro, my wonderful theme!" />
	</label>
</p>
<p class="description"><?php _e( '... and here it is the second row.', 'openframe' ); ?></p>

<?php $mb->the_group_close(); ?>
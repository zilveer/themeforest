<?php
global $icons;
?>
<div class="wrap">
	<h2><?php _e( 'Icons List', 'wolf' ); ?></h2>
	<p><input type="text" class="icon-search" placeholder="<?php _e( 'Type your search', 'wolf' ); ?>"></p>
	<div class="icon-box-container">
		<?php foreach ( $icons as $slug => $name ) : ?>
			<div class="icon-box" data-name="<?php echo esc_attr( strtolower( $name ) ); ?>">
				<div class="icon-inner">
					<i class="fa fa-2x <?php echo esc_attr( $slug ); ?>"></i>
				</div>
				<div>
					<?php echo esc_attr( $name ); ?><br><?php echo esc_attr( $slug ); ?>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>

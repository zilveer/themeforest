<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<div class="post">
	<p><?php echo apply_filters( 'woo_noposts_message', __( 'Sorry, no posts matched your criteria.', 'woothemes' ) ); ?></p>
</div><!-- /.post -->
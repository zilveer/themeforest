<?php
/**
 *	Aurum WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

if( ! get_data( 'blog_post_nextprev' ) ) {
	return;
}

$prev = get_adjacent_post( '', '', 0 );
$next = get_adjacent_post( '', '', 1 );

if ( is_single() ) {
?>
<div class="row post-prev-next">
	<div class="col-sm-6 post-prev">
		<?php if( $prev ): ?>
		<a href="<?php echo get_permalink( $prev ); ?>">&laquo; <?php echo get_the_title( $prev ); ?></a>
		<?php endif; ?>
	</div>
	<div class="col-sm-6 post-next">
		<?php if( $next ): ?>
		<a href="<?php echo get_permalink( $next ); ?>"><?php echo get_the_title( $next ); ?> &raquo;</a>
		<?php endif; ?>
	</div>
</div>
<?php
}
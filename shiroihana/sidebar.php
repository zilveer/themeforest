<?php if( $sidebar = shiroi_get_sidebar() ) : ?>

<aside class="sidebar" role="complementary">
	<?php dynamic_sidebar( $sidebar['sidebar'] ); ?>
</aside>

<?php endif; ?>
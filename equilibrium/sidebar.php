<!-- START #sidebar-pages -->
<aside id="sidebar-pages" class="sidebar">
	<ul>
		<?php if ( is_active_sidebar( 'sidebar-pages' ) ) : ?>
			
			<?php dynamic_sidebar( 'sidebar-pages' ); ?>
			
		<?php else : ?>
			
			<li><h4 class="sub"><?php _e( 'Widgetized Area' , 'onioneye' ); ?></h4></li>
			<li><p><?php printf ( __( 'Go to Appearance &raquo; Widgets tab to overwrite this section. Use any widgets that fits you best. This is called <strong>Sidebar - Pages</strong>.', 'onioneye' ) ); ?></p></li>
		
		<?php endif; ?>
	</ul>
</aside>
<!-- END #sidebar-pages -->

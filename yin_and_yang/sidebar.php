<aside class="sidebar sidebar-pages group">
	<ul>
		<?php if ( is_active_sidebar( 'onioneye-sidebar-pages' ) ) : ?>
			
			<?php dynamic_sidebar( 'onioneye-sidebar-pages' ); ?>
			
		<?php else : ?>
			
			<li><h4 class="sub"><?php esc_html_e( 'Widgetized Area' , 'onioneye' ); ?></h4></li>
			<li><p><?php esc_html_e( 'Go to Appearance &raquo; Widgets tab to overwrite this section. Use any widgets that fits you best. This is called &ldquo;Sidebar - Pages.&rdquo;', 'onioneye'); ?></p></li>
		
		<?php endif; ?>
	</ul>
</aside><!-- /.sidebar -->

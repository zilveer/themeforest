	</div><!-- end of #content -->
	<?php 
		global $majesty_options;
		$foot_layout    = $majesty_options['footer_type'];
		$display_bottom = $majesty_options['display_foot_bottom'];
		$foot_content   = $majesty_options['bottom_content'];
	?>
	<footer id="footer" class="padding-50 dark">
		<div class="container">
			<div class="row">
				<?php if( $foot_layout == '1col' ) { ?>
					<div class="col-md-12">
						<?php dynamic_sidebar('footer'); ?>
					</div>
				<?php } elseif( $foot_layout == '2col' ) { ?>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php dynamic_sidebar('footer'); ?>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
				<?php } elseif( $foot_layout == '2col-3-9' ) { ?>
					<div class="col-md-3 col-sm-12 col-xs-12">
						<?php dynamic_sidebar('footer'); ?>
					</div>
					<div class="col-md-9 col-sm-12 col-xs-12">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
				<?php } elseif( $foot_layout == '2col-9-3' ) { ?>
					<div class="col-md-9 col-sm-12 col-xs-12">
						<?php dynamic_sidebar('footer'); ?>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
				<?php } elseif( $foot_layout == '3col' ) { ?>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<?php dynamic_sidebar('footer'); ?>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12">
						<?php dynamic_sidebar('footer-3'); ?>
					</div>	
				<?php } elseif( $foot_layout == '3col-6-3' ) { ?>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<?php dynamic_sidebar('footer'); ?>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<?php dynamic_sidebar('footer-3'); ?>
					</div>	
				<?php } elseif( $foot_layout == '3col-3-6' ) { ?>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<?php dynamic_sidebar('footer'); ?>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<?php dynamic_sidebar('footer-3'); ?>
					</div>	
				<?php } else { // 4Col ?>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<?php 
							if ( is_active_sidebar('footer') ) {
								dynamic_sidebar('footer');
							} else {
								the_widget('WP_Widget_Meta','', array(
									'before_widget' => '<aside id="meta-widget1" class="widget widget_meta">',
									'after_widget' => '</aside>',
									'before_title' => '<h3 class="widget-title">',
									'after_title' => '</h3><span class="sidebar_divider"></span>',
								));
							}
						?>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<?php 
							if ( is_active_sidebar('footer-2') ) {
								dynamic_sidebar('footer-2');
							} else {
								the_widget('WP_Widget_Meta','', array(
									'before_widget' => '<aside id="meta-widget2" class="widget widget_meta">',
									'after_widget' => '</aside>',
									'before_title' => '<h3 class="widget-title">',
									'after_title' => '</h3><span class="sidebar_divider"></span>',
								));
							}
						?>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<?php 
							if ( is_active_sidebar('footer-3') ) {
								dynamic_sidebar('footer-3');
							} else {
								the_widget('WP_Widget_Meta','', array(
									'before_widget' => '<aside id="meta-widget3" class="widget widget_meta">',
									'after_widget' => '</aside>',
									'before_title' => '<h3 class="widget-title">',
									'after_title' => '</h3><span class="sidebar_divider"></span>',
								));
							}
						?>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
					  <?php 
							if ( is_active_sidebar('footer-4') ) {
								dynamic_sidebar('footer-4');
							} else {
								the_widget('WP_Widget_Meta','', array(
									'before_widget' => '<aside id="meta-widget4" class="widget widget_meta">',
									'after_widget' => '</aside>',
									'before_title' => '<h3 class="widget-title">',
									'after_title' => '</h3><span class="sidebar_divider"></span>',
								));
							}
						?>
					</div>
				<?php } ?>
				
				
			</div>
		</div>
		<?php if( $display_bottom ) { ?>
			<div class="footer_logo text-center">
				<?php
					global $majesty_allowed_tags;
					echo wp_kses( $foot_content, $majesty_allowed_tags );
				?>
			</div>	
		<?php } ?>
		

	</footer>
    <!--  scroll to top of the page-->
    <a href="#" id="scroll_up" ><i class="fa fa-angle-up"></i></a>
</div><!-- ends of wrapper -->
<?php wp_footer(); ?>
</body>
</html>
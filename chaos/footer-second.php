<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */
?>
<?php global $road_opt; ?>

			<div class="footer layout2">
				<div class="footer-bottom">
					<div class="container">
						<div class="row">
							<?php
							if( isset($road_opt['footer_menu1']) && $road_opt['footer_menu1']!='' ) {
								$menu1_object = wp_get_nav_menu_object( $road_opt['footer_menu1'] );
								$menu1_args = array(
									'menu_class'      => 'nav_menu',
									'menu'         => $road_opt['footer_menu1'],
								); ?>
								<div class="col-xs-12 col-md-2 col-sm-2">
									<div class="widget widget_menu">
										<h3 class="widget-title"><?php echo esc_html($menu1_object->name); ?></h3>
										<?php wp_nav_menu( $menu1_args ); ?>
									</div>
								</div>
							<?php }
							if( isset($road_opt['footer_menu2']) && $road_opt['footer_menu2']!='' ) {
								$menu2_object = wp_get_nav_menu_object( $road_opt['footer_menu2'] );
								$menu2_args = array(
									'menu_class'      => 'nav_menu',
									'menu'         => $road_opt['footer_menu2'],
								); ?>
								<div class="col-xs-12 col-md-2 col-sm-2">
									<div class="widget widget_menu">
										<h3 class="widget-title"><?php echo esc_html($menu2_object->name); ?></h3>
										<?php wp_nav_menu( $menu2_args ); ?>
									</div>
								</div>
							<?php }
							if( isset($road_opt['footer_menu3']) && $road_opt['footer_menu3']!='' ) {
								$menu3_object = wp_get_nav_menu_object( $road_opt['footer_menu3'] );
								$menu3_args = array(
									'menu_class'      => 'nav_menu',
									'menu'         => $road_opt['footer_menu3'],
								); ?>
								<div class="col-xs-12 col-md-2 col-sm-2">
									<div class="widget widget_menu">
										<h3 class="widget-title"><?php echo esc_html($menu3_object->name); ?></h3>
										<?php wp_nav_menu( $menu3_args ); ?>
									</div>
								</div>
							<?php }
							if( isset($road_opt['footer_menu4']) && $road_opt['footer_menu4']!='' ) {
								$menu4_object = wp_get_nav_menu_object( $road_opt['footer_menu4'] );
								$menu4_args = array(
									'menu_class'      => 'nav_menu',
									'menu'         => $road_opt['footer_menu4'],
								); ?>
								<div class="col-xs-12 col-md-2 col-sm-2">
									<div class="widget widget_menu">
										<h3 class="widget-title"><?php echo esc_html($menu4_object->name); ?></h3>
										<?php wp_nav_menu( $menu4_args ); ?>
									</div>
								</div>
							<?php } ?>
							<div class="col-xs-12 col-md-4 col-sm-4">
								<div class="widget widget_social">
									<h3 class="widget-title"><?php echo esc_html($road_opt['follow_title']);?></h3>
									<?php
									if(isset($road_opt['social_icons'])) {
										echo '<ul class="social-icons">';
										foreach($road_opt['social_icons'] as $key=>$value ) {
											if($value!=''){
												echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-'.esc_attr($key).'"></i></a></li>';
											}
										}
										echo '</ul>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
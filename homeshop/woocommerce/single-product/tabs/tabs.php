<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
 
global $post; 
//$sidebar_position = get_post_meta($post->ID,'mm_sidebar_product_meta_box',true); 
$sidebar_position = get_meta_option('sidebar_position_meta_box');

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) { ?>


	<?php 
	if( $sidebar_position == 'full' ) { ?>
	
	
	<!-- Product Full Tabs -->
	<div class="row" id="products_tabs" >
		
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="accordion">			
			<ul>
		
			<?php foreach ( $tabs as $key => $tab ) { ?>
				<li>
									
					<div class="accordion-header">
						<h4><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></h4>
						<span class="accordion-button">
							<i class="icons icon-plus-1"></i>
						</span>
					</div>
					<div class="accordion-content page-content">
					
					<?php call_user_func( $tab['callback'], $key, $tab ); ?>
				
					</div>
										
				</li>
				<!-- /Item -->
				
			<?php }?>

			<?php
			if(get_meta_option('custom_title_product_meta_box') && get_meta_option('custom_title_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide') {
			?>
			<li>
									
				<div class="accordion-header">
					<h4><?php echo get_meta_option('custom_title_product_meta_box'); ?></h4>
					<span class="accordion-button">
						<i class="icons icon-plus-1"></i>
					</span>
				</div>
				<div class="accordion-content page-content">
				
				<?php echo wpautop(do_shortcode(get_meta_option('custom_cont_product_meta_box'))); ?>
			
				</div>
										
			</li>
		
			<?php 
			}
			?>
		
		
		
		
			<?php
			if(get_meta_option('custom_title2_product_meta_box') && get_meta_option('custom_title2_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide') {
			?>
			<li>
									
				<div class="accordion-header">
					<h4><?php echo get_meta_option('custom_title2_product_meta_box'); ?></h4>
					<span class="accordion-button">
						<i class="icons icon-plus-1"></i>
					</span>
				</div>
				<div class="accordion-content page-content">
				
				<?php echo wpautop(do_shortcode(get_meta_option('custom_cont2_product_meta_box'))); ?>
			
				</div>
										
			</li>
		
			<?php 
			}
			?>
		
		
			
			<?php
			if(get_meta_option('custom_title3_product_meta_box') && get_meta_option('custom_title3_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide') {
			?>
			<li>
									
				<div class="accordion-header">
					<h4><?php echo get_meta_option('custom_title3_product_meta_box'); ?></h4>
					<span class="accordion-button">
						<i class="icons icon-plus-1"></i>
					</span>
				</div>
				<div class="accordion-content page-content">
				
				<?php echo wpautop(do_shortcode(get_meta_option('custom_cont3_product_meta_box'))); ?>
			
				</div>
										
			</li>
		
			<?php 
			}
			?>
		
		
			<?php
			if(get_meta_option('custom_title4_product_meta_box') && get_meta_option('custom_title4_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide') {
			?>
			<li>
									
				<div class="accordion-header">
					<h4><?php echo get_meta_option('custom_title4_product_meta_box'); ?></h4>
					<span class="accordion-button">
						<i class="icons icon-plus-1"></i>
					</span>
				</div>
				<div class="accordion-content page-content">
				
				<?php echo wpautop(do_shortcode(get_meta_option('custom_cont4_product_meta_box'))); ?>
			
				</div>
										
			</li>
		
			<?php 
			}
			?>
		
		
		<?php
			if(get_meta_option('custom_title5_product_meta_box') && get_meta_option('custom_title5_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide') {
			?>
			<li>
									
				<div class="accordion-header">
					<h4><?php echo get_meta_option('custom_title5_product_meta_box'); ?></h4>
					<span class="accordion-button">
						<i class="icons icon-plus-1"></i>
					</span>
				</div>
				<div class="accordion-content page-content">
				
				<?php echo wpautop(do_shortcode(get_meta_option('custom_cont5_product_meta_box'))); ?>
			
				</div>
										
			</li>
		
			<?php 
			}
			?>
		
		
		
		<?php
			if(get_meta_option('custom_title6_product_meta_box') && get_meta_option('custom_title6_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide') {
			?>
			<li>
									
				<div class="accordion-header">
					<h4><?php echo get_meta_option('custom_title6_product_meta_box'); ?></h4>
					<span class="accordion-button">
						<i class="icons icon-plus-1"></i>
					</span>
				</div>
				<div class="accordion-content page-content">
				
				<?php echo wpautop(do_shortcode(get_meta_option('custom_cont6_product_meta_box'))); ?>
			
				</div>
										
			</li>
		
			<?php 
			}
			?>
		
		
		
		
		
		
		
		
		
			</ul>
			</div>
		</div>
		
	</div>
	<?php } else {  ?>
	
	
	<!-- Product Tabs -->
	<div class="row" id="products_tabs" >
		
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="tabs">
			
				<div class="tab-heading">
				<?php foreach ( $tabs as $key => $tab ) { ?>

					<a class="button big" href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>

				<?php } ?>
				
				<?php	
				if(get_meta_option('custom_title_product_meta_box') && get_meta_option('custom_title_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) {
				?>
				<a href="#tab_custom1" class="button big"><?php echo get_meta_option('custom_title_product_meta_box'); ?></a>
				<?php	
				}		
				?>	
				
				
				
				<?php	
				if(get_meta_option('custom_title2_product_meta_box') && get_meta_option('custom_title2_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) {
				?>
				<a href="#tab_custom2" class="button big"><?php echo get_meta_option('custom_title2_product_meta_box'); ?></a>
				<?php	
				}		
				?>	
				
				
				<?php	
				if(get_meta_option('custom_title3_product_meta_box') && get_meta_option('custom_title3_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) {
				?>
				<a href="#tab_custom3" class="button big"><?php echo get_meta_option('custom_title3_product_meta_box'); ?></a>
				<?php	
				}		
				?>	
				
				<?php	
				if(get_meta_option('custom_title4_product_meta_box') && get_meta_option('custom_title4_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) {
				?>
				<a href="#tab_custom4" class="button big"><?php echo get_meta_option('custom_title4_product_meta_box'); ?></a>
				<?php	
				}		
				?>	
				
				
				<?php	
				if(get_meta_option('custom_title5_product_meta_box') && get_meta_option('custom_title5_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) {
				?>
				<a href="#tab_custom5" class="button big"><?php echo get_meta_option('custom_title5_product_meta_box'); ?></a>
				<?php	
				}		
				?>	
				
				
				<?php	
				if(get_meta_option('custom_title6_product_meta_box') && get_meta_option('custom_title6_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) {
				?>
				<a href="#tab_custom6" class="button big"><?php echo get_meta_option('custom_title6_product_meta_box'); ?></a>
				<?php	
				}		
				?>	
				
				
				
				
				
				
				</div>
							


							
				<div class="page-content tab-content">
					<?php foreach ( $tabs as $key => $tab ) { ?>

						<div class="panel entry-content" id="tab-<?php echo $key ?>">
							<?php call_user_func( $tab['callback'], $key, $tab ); ?>
						</div>

					<?php }
					

					if(get_meta_option('custom_title_product_meta_box') && get_meta_option('custom_title_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) 
					{
					?>

					<div class="panel entry-content" id="tab_custom1">
							<?php echo wpautop(do_shortcode(get_meta_option('custom_cont_product_meta_box'))); ?>
					</div>
					
			
					<?php 
					}
					?>

					
					<?php 
					if(get_meta_option('custom_title2_product_meta_box') && get_meta_option('custom_title2_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) 
					{
					?>

					<div class="panel entry-content" id="tab_custom2">
							<?php echo wpautop(do_shortcode(get_meta_option('custom_cont2_product_meta_box'))); ?>
					</div>
					
			
					<?php 
					}
					?>
					
					
					<?php 
					if(get_meta_option('custom_title3_product_meta_box') && get_meta_option('custom_title3_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) 
					{
					?>

					<div class="panel entry-content" id="tab_custom3">
							<?php echo wpautop(do_shortcode(get_meta_option('custom_cont3_product_meta_box'))); ?>
					</div>
					
			
					<?php 
					}
					?>
					
					
					
					<?php 
					if(get_meta_option('custom_title4_product_meta_box') && get_meta_option('custom_title4_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) 
					{
					?>

					<div class="panel entry-content" id="tab_custom4">
							<?php echo wpautop(do_shortcode(get_meta_option('custom_cont4_product_meta_box'))); ?>
					</div>
					
			
					<?php 
					}
					?>
					
					
					<?php 
					if(get_meta_option('custom_title5_product_meta_box') && get_meta_option('custom_title5_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) 
					{
					?>

					<div class="panel entry-content" id="tab_custom5">
							<?php echo wpautop(do_shortcode(get_meta_option('custom_cont5_product_meta_box'))); ?>
					</div>
					
			
					<?php 
					}
					?>
					
					
					<?php 
					if(get_meta_option('custom_title6_product_meta_box') && get_meta_option('custom_title6_product_meta_box') != '' && get_option('sense_custom_tab') != 'hide' ) 
					{
					?>

					<div class="panel entry-content" id="tab_custom6">
							<?php echo wpautop(do_shortcode(get_meta_option('custom_cont6_product_meta_box'))); ?>
					</div>
					
			
					<?php 
					}
					?>
					
					
					
					
					
				</div>
									
			</div>
			
		</div>
		
	</div>
	<!-- /Product Tabs -->
	
	<?php } ?>

<?php } ?>
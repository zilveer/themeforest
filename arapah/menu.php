<?php 
/**
 * @package WordPress
 * @subpackage Arapah-WP
 */
?>

	<section id="header">  
		<div class="container"> 
			<div class="six columns"> 
				<div class="gutter alpha"> 
					<h1 class="logo">
					<?php if ( of_get_option('your-logo') ) : ?>
						<a href="<?php echo home_url(); //make logo a home link?>" class="no-bg">
							<img src="<?php echo of_get_option('your-logo-img'); ?>" />
						</a>
					<?php else : ?>
						<a href="<?php echo home_url(); //make logo a home link?>">
							<span class="logo"><?php echo get_bloginfo('name');?></span>
							<span class="desc"><?php echo get_bloginfo('description');?></span>
						</a> 	
					<?php endif; ?>
					</h1>					
				</div>
			</div> 
			
			<div class="ten columns">
				<div class="gutter omega social">

				<!--  the Menu -->
				<?php wp_nav_menu( array( 'theme_location' => 'social' ) ); ?>
				
				</div>
			</div> 

			<div class="sixteen columns">
				<div class="gutter alpha omega">

				<!--  the Menu -->
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'nav', 'container_id' => 'navigation' ) ); ?>
				
				</div>
			</div>
		</div>
	</section> <!--  End header -->
	
   
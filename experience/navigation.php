<?php
/**
 * The template for displaying the page header (logo/site title, navigation and social buttons.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/
 
// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options(); ?>

<!-- BEGIN .panel-nav -->
<nav class="panel-nav">

	<?php $cols = 1;
	if( has_nav_menu( 'primary' ) ) {
		$cols++; 
	}
	
	if (
		isset( $experience_theme_array['panel-search'] )
		&& $experience_theme_array['panel-search'] == '1'
	) {
		$cols++;
	}
	
	if ( 
		!empty( $experience_theme_array['facebook-url'] )
		|| !empty( $experience_theme_array['twitter-url'] )
		|| !empty( $experience_theme_array['google-plus-url'] )
		|| !empty( $experience_theme_array['youtube-url'] )
		|| !empty( $experience_theme_array['vimeo-url'] )
		|| !empty( $experience_theme_array['flickr-url'] )
		|| !empty( $experience_theme_array['dribbble-url'] )
		|| !empty( $experience_theme_array['instagram-url'] )
		|| !empty( $experience_theme_array['pinterest-url'] )
		|| !empty( $experience_theme_array['behance-url'] )
		|| !empty( $experience_theme_array['foursquare-url'] )	
	) {
		$cols++;
	}
	
	if ( function_exists( 'icl_get_languages' ) ) {
		$cols++; 
	} ?>
	
	<ul class="panel-toggle-icons show-mobile toggle-cols-<?php echo esc_attr( $cols ); ?>">
		
		<?php if( has_nav_menu( 'primary' ) ) { ?>		
			<!-- Menu toggle -->
			<li>
				<span class="menu-icon">
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
				</span>
			</li>
		<?php } ?>
		
		<?php if ( 
			!empty( $experience_theme_array['facebook-url'] )
			|| !empty( $experience_theme_array['twitter-url'] )
			|| !empty( $experience_theme_array['google-plus-url'] )
			|| !empty( $experience_theme_array['youtube-url'] )
			|| !empty( $experience_theme_array['vimeo-url'] )
			|| !empty( $experience_theme_array['flickr-url'] )
			|| !empty( $experience_theme_array['dribbble-url'] )
			|| !empty( $experience_theme_array['instagram-url'] )
			|| !empty( $experience_theme_array['pinterest-url'] )
			|| !empty( $experience_theme_array['behance-url'] )
			|| !empty( $experience_theme_array['foursquare-url'] )				
		) { ?>			
			<!-- Social toggle-->
			<li>
				<span class="social-toggle">
					<span class="funky-icon-share"></span>
				</span>
			</li>
		<?php } ?>
		
		<?php if (
			isset( $experience_theme_array['panel-search'] )
			&& $experience_theme_array['panel-search'] == '1'
		) { ?>			
			<!-- Search toggle -->
			<li>
				<span class="search-toggle">
					<span class="funky-icon-search"></span>
				</span>
			</li>			
		<?php } ?>			
		
		<?php if ( function_exists( 'icl_get_languages' ) ) { ?>
			<!-- WPML toggle -->
			<li>
				<?php echo experience_get_active_lang(); ?>
			</li>
		<?php } ?>			
		
	</ul>

	<span class="funky-icon-close"></span>
	
	<!-- BEGIN .panel-nav-content-wrapper -->
	<div class="panel-nav-content-wrapper">			
		
		<!-- BEGIN .panel-nav-content -->
		<div class="panel-nav-content" role="navigation">
			
			<?php if( has_nav_menu( 'primary' ) ) { ?>		
			
				<div class="exp_ie-flexbox-fixer navigation-container">

					<div class="exp-full-height exp-flexbox exp-content-middle">
						
						<div class="exp-flexbox-inner">
						
							<?php // Navigation Menu
							wp_nav_menu(
								array( 
									'container'		 => false,
									'depth'          => 2,
									'fallback_cb'	 => false,
									'menu_class'	 => 'menu navigation-menu',					
									'theme_location' => 'primary'
								)
							); ?>			
						
							</div>
					
					</div>
				
				</div>
			
			<?php } ?>			
			
			<?php if ( 
				!empty( $experience_theme_array['facebook-url'] )
				|| !empty( $experience_theme_array['twitter-url'] )
				|| !empty( $experience_theme_array['google-plus-url'] )
				|| !empty( $experience_theme_array['youtube-url'] )
				|| !empty( $experience_theme_array['vimeo-url'] )
				|| !empty( $experience_theme_array['flickr-url'] )
				|| !empty( $experience_theme_array['dribbble-url'] )
				|| !empty( $experience_theme_array['instagram-url'] )
				|| !empty( $experience_theme_array['pinterest-url'] )
				|| !empty( $experience_theme_array['behance-url'] )
				|| !empty( $experience_theme_array['foursquare-url'] )				
			) { ?>
			
				<div class="exp_ie-flexbox-fixer social-container">

					<div class="exp-full-height exp-flexbox exp-content-middle">
						
						<div class="exp-flexbox-inner">
						
							<?php experience_social_buttons(); ?>						
						
						</div>
					
					</div>
				
				</div>	
			
			<?php } ?>
			
			<?php if (
				isset( $experience_theme_array['panel-search'] )
				&& $experience_theme_array['panel-search'] == '1'
			) { ?>	
		
				<div class="exp_ie-flexbox-fixer search-container">

					<div class="exp-full-height exp-flexbox exp-content-middle">
						
						<div class="exp-flexbox-inner">
						
							<?php
							if (
								isset( $experience_theme_array['panel-search'] )
								&& $experience_theme_array['panel-search'] == '1'
							) {
								get_search_form();			
							} ?>	
				
							
						</div>
					
					</div>
				
				</div>			
			
			<?php } ?>
			
			<?php if ( function_exists( 'icl_get_languages' ) ) { ?>
				
				<div class="exp_ie-flexbox-fixer languages-container">

					<div class="exp-full-height exp-flexbox exp-content-middle">
						
						<div class="exp-flexbox-inner">
						
							<?php experience_lang_selector(); ?>
						
						</div>
					
					</div>
				
				</div>	
			
			<?php } ?>
			
		</div>
		<!-- END .panel-nav-content -->
		
	</div>
	<!-- END .panel-nav-content-wrapper -->
	
</nav>
<!-- END .panel-nav -->

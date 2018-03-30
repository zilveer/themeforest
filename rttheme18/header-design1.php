	<!-- header -->
	<header id="header"> 

		<!-- header contents -->
		<section id="header_contents" class="clearfix">
				 
				<?php 
					#
					# get logo and header widgets
					# @hooked in /rt-framework/functions/theme_functions.php
					#
					do_action( "rt_header_output" );
				?>

		</section><!-- end section #header_contents -->  	


		<!-- navigation -->   
		<div class="nav_shadow <?php echo get_option( RT_THEMESLUG."_sticky_navigation" )  ? "sticky" : ""; ?>"><div class="nav_border"> 

			<?php	 			
			$add_menu_class = get_option( RT_THEMESLUG."_show_search_menu" ) ? " with_search" : "";//show search 
			$add_menu_class .= apply_filters( "show_subtitles", get_option( RT_THEMESLUG."_show_subtitles" ) ? " with_subs" : "" );
			$add_menu_class .= get_option(RT_THEMESLUG.'_logo_url') !== "" && get_option( RT_THEMESLUG."_show_sticky_logo" ) ? " with_small_logo" : "";//small logo
		

	 		echo '<nav id="navigation_bar" class="navigation '.$add_menu_class.'">'; //open nav holder

				//action before the navigation
				do_action("rt_before_navigation");

	 			//call the main navigation
		 		if ( has_nav_menu( 'rt-theme-main-navigation' ) ){ // check if user created a custom menu and assinged to the rt-theme's location
 
						$menuVars = array(
							'menu_id'         => "navigation", 
							'echo'            => false,
							'container'       => '', 
							'container_class' => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'container_id'    => 'navigation_bar', 
							'theme_location'  => 'rt-theme-main-navigation',
							'walker' => new RT_Menu_Class_Walker
						);
						
						$main_menu=wp_nav_menu($menuVars);
						echo ($main_menu);
				}else{
						
						$menuVars = array(
							'menu'            => 'RT Theme Main Navigation Menu',  
							'menu_id'         => "navigation", 
							'echo'            => false,
							'container'       => '',  
							'container_class' => '' ,
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'container_id'    => 'navigation_bar',  
							'theme_location'  => 'rt-theme-main-navigation',
							'walker' => new RT_Menu_Class_Walker
						);
						
						$main_menu=wp_nav_menu($menuVars);
						echo ($main_menu); 				
 				}

				//action after the navigation
				do_action("rt_after_navigation");

				//show serch bar on the menu bar
				if( get_option( RT_THEMESLUG."_show_search_menu" ) ):?>

					<!-- search -->
					<div class="search-bar">
						<form action="<?php echo rt_wpml_get_home_url(); ?>" method="get" class="showtextback" id="menu_search">
							<fieldset>							
								<input type="text" class="search_text showtextback" name="s" id="menu_search_field" value="<?php _e('Search','rt_theme');?>" />		
								<div class="icon-search-1"></div>					
							</fieldset>
							<?php if( defined( "ICL_LANGUAGE_CODE" ) ) : ?><input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>"/><?php endif;?>
						</form>
					</div>
					<!-- / search-->
				<?php endif;?> 

			</nav>
		</div></div>
		<!-- / navigation  --> 

	</header><!-- end tag #header --> 
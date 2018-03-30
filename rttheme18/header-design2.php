	<!-- header -->
	<header id="header"> 

		<!-- header contents -->
		<section id="header_contents" class="clearfix">
				 
				<?php 

						//the logo url
						$logo_url = get_option(RT_THEMESLUG.'_logo_url');   

						//the logo@2x url
						$logo_url_2x = get_option(RT_THEMESLUG.'_logo_url_2x');   

						//logo output
						$logo_output = ! empty( $logo_url ) ? 
										sprintf( ' <a href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s" data-retina="%4$s"/></a> ', RT_BLOGURL, get_bloginfo('name'), $logo_url, $logo_url_2x ) :
										sprintf( ' <h1 class="logo"><a href="%1$s" title="%2$s">%2$s</a></h1> ', RT_BLOGURL, get_bloginfo('name') ) ;

						//logo class name
						$logo_class_name = "logo";
				 
					 
					 	//logo holder
						$logo_holder_output = sprintf( '
							<section class="section_logo %2$s">			 
								<!-- logo -->
								<section id="logo">			 
									%1$s
								</section><!-- end section #logo -->
							</section><!-- end section #logo -->	
							', $logo_output, $logo_class_name );

						//action for before logo
						do_action("sidebar-for-top-first");
				 
						//echo logo holder
						echo $logo_holder_output; 

 						//action for after logo
						do_action("sidebar-for-top-second");
				?>



				<!-- navigation -->
				<div class="nav_shadow default_position <?php echo get_option( RT_THEMESLUG."_sticky_navigation" )  ? "sticky" : ""; ?>"><div class="nav_border"> 

					<?php	 			
					$add_menu_class = get_option( RT_THEMESLUG."_show_sticky_logo" ) ? " with_small_logo" : "";//small logo
				

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
									'theme_location'  => 'rt-theme-main-navigation',
									'walker' => new RT_Menu_Class_Walker
								);
								
								$main_menu=wp_nav_menu($menuVars);
								echo ($main_menu); 				
		 				}

						//action after the navigation
						do_action("rt_after_navigation");

						?> 

					</nav>
				</div></div>
				<!-- / navigation  --> 
		</section><!-- end section #header_contents -->  	
 

	</header><!-- end tag #header --> 
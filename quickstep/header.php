<!DOCTYPE html>

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" class="no-js ie8 oldie"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<!--[if lt IE 9]>
    <script type="text/javascript">
         document.createElement('header');
         document.createElement('hgroup');
         document.createElement('nav');
         document.createElement('menu');
         document.createElement('section');
         document.createElement('article');
         document.createElement('aside');
         document.createElement('footer');
    </script>
<![endif]-->
	
	<head>
		<meta charset="utf-8">
                <!--[if IE 8 ]><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"><![endif]-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                 
		
		<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
		wp_title( '-', true, 'right' );
		// Add the blog name.
		bloginfo( 'name' );
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' - ' . sprintf( __( 'Page %s', 'qs_framework' ), max( $paged, $page ) );
		?></title>
        
		
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<?php if( of_get_option('qs_favicon') ): ?>
            <link rel="icon" type="image/png" href="<?php echo of_get_option('qs_favicon'); ?>">
        <?php endif; ?>

                
        <!-- wordpress head functions -->
        <?php wp_head(); ?>
        <!-- end of wordpress head -->        
		
	</head>
	
	<body <?php body_class(); ?>>
	

			
          
			<header role="banner">
			
            	<div id="header-bg"></div>
            	
				<div id="inner-header" class="wrapper clearfix">
					
                    <div class="row">
                    
                    	<div class="twelve columns">
                            <!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
                            <div id="logo" class="h1">
                            	<span><a href="<?php echo home_url(); ?>" rel="nofollow">
									<?php if(of_get_option('qs_logo')): ?>
                                        <img src="<?php echo of_get_option('qs_logo'); ?>" alt="<?php bloginfo('name'); ?>" />
                                    <?php else: ?>
                                        <span id="blog-name"><?php bloginfo('name'); ?></span>
                                    <?php endif; ?>
                                    </a>
                              	</span>
                            </div>

                            <!-- if you'd like to use the site description you can un-comment it below -->
                            <?php // bloginfo('description'); ?>
                            
                            
                            
                            <div class='menu-button'></div>	
                            <nav role="navigation">
                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => new qs_walker(), 'items_wrap'      => '<ul id="nav" class="%2$s sf-menu sf-js-enabled">%3$s</ul>', ) ); 
                                }
                                else {
                                    theme_nav();
                                }
                                 ?>
                            </nav>
                            
                    	</div>
                    
                    </div>
				
				</div> <!-- end #inner-header -->
			
			</header> <!-- end header -->
		
	    		

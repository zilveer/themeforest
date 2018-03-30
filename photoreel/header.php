<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="utf-8" />
<title><?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' ); $site_description = get_bloginfo( 'description', 'display' ); echo " | $site_description"; if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s','themnific'), max( $paged, $page ) ); ?></title>

<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php themnific_head(); ?>

<?php wp_head(); ?>

</head>

     
<body <?php body_class(); ?>>
 

    <div id="header" class="boxshadow2">
    
		<a id="navtrigger" href="#"><?php _e('MENU','themnific');?></a>
        
        
        <?php if(get_option('themnific_logo')) { ?>
                
            <a class="logo" href="<?php echo home_url(); ?>/">
            
                <img src="<?php echo get_option('themnific_logo');?>" alt="<?php bloginfo('name'); ?>"/>
                    
            </a>
                
        <?php } 
                
            else { ?> <h1><a href="<?php echo home_url(); ?>/"><?php bloginfo('name');?></a></h1> 
                
        <?php } ?>	

        <nav id="cats">    
            
			<?php get_template_part('/includes/uni-navigation'); ?>
                            
        </nav>

		<div id="cats_wrap"></div>
                
        
        <div id="header_bottom">
        	
        	<?php 
			
			echo stripslashes(get_option('themnific_about_text'));
			
			get_template_part('/includes/uni-social'); ?>
            
      	</div>

    </div> 

 <div style="clear: both;"></div>
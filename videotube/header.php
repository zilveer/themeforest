<?php if( !defined('ABSPATH') ) exit;?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if lt IE 9]>
	  <script src="<?php print get_template_directory_uri();?>/assets/js/ie8/html5shiv.js"></script>
      <script src="<?php print get_template_directory_uri();?>/assets/js/ie8/respond.min.js"></script>
	<![endif]-->	
	<?php wp_head();?>
</head>
<body <?php body_class();?>>
<?php global $videotube;?>
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-sm-3" id="logo">
					<a title="<?php bloginfo('description');?>" href="<?php print home_url();?>">
						<?php
							$logo_image = isset( $videotube['logo']['url'] ) ? $videotube['logo']['url'] : get_template_directory_uri() . '/img/logo.png'; 
						?>
						<img src="<?php print esc_url( $logo_image ); ?>" alt="<?php esc_attr( bloginfo('description') );?>" />
					</a>
				</div>
				<form method="get" action="<?php print home_url();?>">	
					<div class="col-sm-6" id="header-search">
						<span class="glyphicon glyphicon-search search-icon"></span>
						<?php if( isset( $videotube['video_search'] ) && $videotube['video_search'] == 1 ):?>
							<input type="hidden" name="post_type" value="video">
						<?php endif;?>
						<input value="<?php print get_search_query();?>" name="s" type="text" placeholder="<?php _e('Search here...','mars')?>" id="search">
					</div>
				</form>
				<div class="col-sm-3" id="header-social">
					<?php 
						global $videotube;
						$social_array = mars_socials_url();
						if( is_array( $social_array ) ){
							foreach ( $social_array as $key=>$value ){
								if( ! empty( $videotube[$key] ) ){
									print '<a href="'. esc_url( $videotube[$key] ) .'"><i class="fa fa-'. esc_attr( $key ) .'"></i></a>';
								}							
							}							
						}
					?>
					<a href="<?php bloginfo('rss_url');?>"><i class="fa fa-rss"></i></a>
				</div>
			</div>
		</div>
	</div><!-- /#header -->
	<div id="navigation-wrapper">
		<div class="container">
			<div class="navbar-header">
			  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<!-- menu -->
			  	<?php 
			  		if( has_nav_menu('header_main_navigation') ){
				  		wp_nav_menu(array(
				  			'theme_location'=>'header_main_navigation',
				  			'menu_class'=>'nav navbar-nav list-inline menu',
				  			'walker' => new Mars_Walker_Nav_Menu(),
				  			'container'	=>	null
				  		));
			  		}
			  		else{
						?>
			  				<ul class="nav navbar-nav list-inline menu"><li class="active"><a href="<?php print home_url();?>"><?php _e('Home','mars')?></a></li></ul>						
						<?php 			  			
			  		}
			  	?>
			</nav>
		</div>
	</div><!-- /#navigation-wrapper -->	
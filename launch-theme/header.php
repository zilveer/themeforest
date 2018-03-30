<?php 
	// if url is pointing toward any inner page or post then make it redirect to home page
	if(!is_home())
	{
		wp_redirect( home_url() ); 
		exit;
	}
?>
<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <!-- Define a viewport to mobile devices to use - telling the browser to assume that the page is as wide as the device (width=device-width) and setting the initial page zoom level to be 1 (initial-scale=1.0) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	
	<!-- Stylesheets -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"/>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
			
	<?php
	$favicon = get_option('launch_favicon');
	if( !empty($favicon) )
	{
		?>
		<!-- FAVICON -->
		<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
		<?php
	}

    // Google Analytics From Theme Options
    echo stripslashes(get_option('launch_google_analytics'));
    ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- START OF HEADER -->
	<div id="header-wrap">
	    	<div id="header">
				
				<?php
				$logo = get_option('launch_sitelogo');
				if( !empty($logo) )
				{
					?>
					<!-- LOGO -->
					<a href="<?php echo home_url(); ?>"><img class="logo" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php
				} else {
					?>
					<h2 class="logotext"><a href="<?php echo home_url(); ?>"><?php echo bloginfo( 'name' ); ?></a></h2>
					<?php
				}
				?>
				
				<?php
				$tagline = get_option('launch_tagline');
				if( !empty($tagline) )
				{
					?>
					<!-- SLOGAN -->
					<h5 class="premium"><?php echo $tagline; ?></h5>
					<?php
				}
				?>
				
				<!-- SOCIAL NAV -->
				<ul class="social-nav">
					<?php
					$twitter_url = get_option('launch_twitter_url');
					if( !empty($twitter_url) )
					{
						?>
						<li><a class="twitter" href="<?php echo $twitter_url;?>"></a></li>
						<?php
					}
					
					$facebook_url = get_option('launch_facebook_url');
					if( !empty($facebook_url) )
					{
					?>
					<li><a class="facebook" href="<?php echo $facebook_url;?>"></a></li>
					<?php
					}

                    $google_url = get_option('launch_google_url');
                    if( !empty($google_url) )
                    {
                        ?>
                        <li><a class="googlep" href="<?php echo $google_url;?>"></a></li>
                    <?php
                    }

                    $youtube_url = get_option('launch_youtube_url');
                    if( !empty($youtube_url) )
                    {
                        ?>
                        <li><a class="youtube" href="<?php echo $youtube_url;?>"></a></li>
                    <?php
                    }



					$flickr_url = get_option('launch_flickr_url');
					if( !empty($flickr_url) )
					{
					?>
					<li><a class="flickr" href="<?php echo $flickr_url;?>"></a></li>
					<?php
					}


                    $inkedin_url = get_option('launch_inkedin_url');
                    if( !empty($inkedin_url) )
                    {
                        ?>
                        <li><a class="linkedin" href="<?php echo $inkedin_url;?>"></a></li>
                    <?php
                    }
					
					$rss_url = get_option('launch_rss_url');
					if( !empty($rss_url) )
					{
					?>
					<li><a class="rss" href="<?php echo $rss_url;?>"></a></li>
					<?php
					}																				
					?>
				</ul>
					
	        </div><!-- end of #header -->
    </div>
    <!-- END OF HEADER-->
	
	<div class="line"></div>


	<div id="main-container">
	<!-- CONTENT AREA -->
    <div id="main-wrap" class="clearfix">
    	
		<?php
		// Launch Timer -- You can choose to show a timer or not from theme options
		$launch_show_timer = get_option('launch_show_timer');
        $counter_date =  get_option('launch_date');
        $c_date_array = explode(',', $counter_date);
        $c_year = intval($c_date_array[0]);
        $c_month = intval($c_date_array[1]);
        $c_day = intval($c_date_array[2]);
        $c_month--;
        $c_counter_date = $c_year. ',' .$c_month. ',' .$c_day;

        if( $launch_show_timer == "true" )
		{
			?>
			<!-- COUNT DOWN -->
			<div id="count-down"></div>	
			<script type="text/javascript">
				// Count Down Timer JavaScript
				jQuery(document).ready(function(){
						// You can set date like this : new Date(year, month, day, hours, minutes, seconds, milliseconds)
						var target_date = new Date(<?php echo $c_counter_date; ?>);
						jQuery('#count-down').countdown({until: target_date});
					});
			</script>
			<?php
		}
		?>	
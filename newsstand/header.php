<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package News Stand
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php global $newsstand; ?>

<?php
	if (isset($newsstand['newsstand-preloader-page'])) {
		$preloader = $newsstand['newsstand-preloader-page'];
	} else {
		$preloader = 1;
	}
?>

<?php if ($preloader==2): ?>
		<?php if (is_home()): ?>
			<style scoped>.preloader span:before{border-color: <?php echo esc_attr($newsstand['newsstand_preloader_spinner']); ?>;}</style>
			<div class="preloader" style="background-color:<?php echo esc_attr($newsstand['newsstand_preloader_bg']); ?>"><span></span></div>
		<?php endif; ?>
	<?php elseif($preloader==3): ?>
		<style scoped>.preloader span:before{border-color: <?php echo esc_attr($newsstand['newsstand_preloader_spinner']); ?>;}</style>
		<div class="preloader" style="background-color:<?php echo esc_attr($newsstand['newsstand_preloader_bg']); ?>"><span></span></div>
<?php endif ?>

<?php
	$todays_date;
	$header_date = $newsstand['newsstand_header_date_format'];
	if ($header_date=='usa') {
		$todays_date = date('F jS Y');
	} else if($header_date=='eu') {
		$todays_date = date('jS F Y');
	}

	$weather = $newsstand['newsstand_header_weather'];


	if (isset($newsstand['newsstand-social'])) {
		$social = $newsstand['newsstand-social'];
	} else {
		$social = array();
	}

	if (isset($newsstand['newsstand_header_style'])) {
		$header_style = $newsstand['newsstand_header_style'];
	} else {
		$header_style = 1;
	}

	global $newsstand_timeformat;
	$newsstand_timeformat = get_option('time_format');

	global $newsstand_dateformat;
	$newsstand_dateformat = get_option('date_format');
?>

<?php if ($header_style == 1): ?>

	<!-- HEADER 1 -->
	    <header class="site-header style-1">
	        <div class="container">

	            <div class="row">

	                <div class="col-md-3 logo-holder">
	                    <div class="logo-wrapper">
	                        <a href="<?php echo site_url(); ?>" class="logo">
	                        	<?php if (!empty($newsstand['newsstand_logo']['url'])): ?>
	                    			<img src="<?php echo esc_url($newsstand['newsstand_logo']['url']); ?>" alt="">
	                    		<?php else: ?>
	                    			<?php bloginfo('name'); ?>
	                        	<?php endif ?>
	                        </a>
	                    </div>
	                </div>

	                <div class="col-sm-8 col-md-6 hidden-xs search-holder">
	                    <div class="form-wrapper">
	                        <form action="<?php echo esc_url(home_url()); ?>/" method="GET">
	                            <input type="text" placeholder="type and hit enter..." value="<?php the_search_query(); ?>" name="s" id="s">
	                            <i class="fa fa-search"></i>
	                        </form>
	                    </div>
	                </div>

	                <div class="col-sm-4 col-md-3 hidden-xs links-holder">
	                    <div class="links-wrapper">
	                        <ul>
	                        	<?php if ($header_date!='hide'): ?>
	                        		<li class="date"><?php echo esc_html($todays_date); ?></li>
	                        	<?php endif ?>
	                        </ul>
	                    </div>
	                </div>

	            </div>

	            <a href="javascript:void(null);" class="open-mm visible-xs" id="open-mm-btn"><span></span></a>

	        </div>
	    </header>
	    <!-- end of header-->

	    <nav class="site-nav style-1 hidden-xs">
	        <div class="container">

	            <div class="nav-wrapper">

	                <ul class="site">
	                    <?php
	                        if ( has_nav_menu( 'primary' ) ) {
	                            // User has assigned menu to this location;
	                            // output it
	                            wp_nav_menu( array(
	                                'theme_location' => 'primary',
	                                'menu_class' => 'nav',
	                                'container' => '',
	                                'items_wrap'      => '%3$s',
	                            ) );
	                        } else {
	                            echo '<li><a href="'.admin_url().'nav-menus.php"><span>'.__('Create your menu +', 'newsstand').'</span></a></li>';
	                        }
	                    ?>
	                </ul>

	                <?php if (isset($social) && isset($social[0])): ?>
	                	<ul class="social">
	                	    <?php foreach ($social as $single): ?>
	                	    	<?php if (!empty($single['description']) || !empty($single['url'])): ?>
	                	    		<li><a href="<?php echo esc_url($single['url']); ?>" target="_blank"><i class="fa <?php echo esc_attr($single['description']); ?>"></i></a></li>
	                	    	<?php endif ?>
	                	    <?php endforeach ?>
	                	</ul>
	                <?php endif ?>

	            </div>

	        </div>
	    </nav><!-- end of nav -->
	<!-- END OF HEADER 1 -->

<?php elseif($header_style == 2): ?>

	<!-- HEADER 2 -->
	    <header class="site-header style-2">
	        <div class="container">

	            <div class="actual-container">
	                <div class="logo-wrapper">
	                    <a href="<?php echo site_url(); ?>" class="logo">
                        	<?php if (!empty($newsstand['newsstand_logo']['url'])): ?>
                    			<img src="<?php echo esc_url($newsstand['newsstand_logo']['url']); ?>" alt="">
                    		<?php else: ?>
                    			<?php bloginfo('name'); ?>
                        	<?php endif ?>
                        </a>
	                </div>

	                <nav class="hidden-xs">
	                    <ul>
	                        <?php
    	                        if ( has_nav_menu( 'primary' ) ) {
    	                            // User has assigned menu to this location;
    	                            // output it
    	                            wp_nav_menu( array(
    	                                'theme_location' => 'primary',
    	                                'menu_class' => 'nav',
    	                                'container' => '',
    	                                'items_wrap'      => '%3$s',
    	                            ) );
    	                        } else {
    	                            echo '<li><a href="'.admin_url().'nav-menus.php"><span>'.__('Create your menu +', 'newsstand').'</span></a></li>';
    	                        }
    	                    ?>
	                    </ul>
	                </nav>

	                <div class="links-holder hidden-xs">
	                    <div class="links-wrapper">
	                        <?php if (isset($social)): ?>
        	                	<ul class="social">
        	                	    <?php foreach ($social as $single): ?>
        	                	    	<?php if (!empty($single['description']) || !empty($single['url'])): ?>
        	                	    		<li><a href="<?php echo esc_url($single['url']); ?>" target="_blank"><i class="fa <?php echo esc_attr($single['description']); ?>"></i></a></li>
        	                	    	<?php endif ?>
        	                	    <?php endforeach ?>
        	                	</ul>
        	                <?php endif ?>
	                        <ul class="search">
	                            <li><a href="javascript:void(null);" class="show-search-overlay"><i class="fa fa-search"></i></a></li>
	                        </ul>
	                    </div>
	                </div>

	                <a href="javascript:void(null);" class="open-mm visible-xs" id="open-mm-btn"><span></span></a>

	                <div class="search-overlay">
	                    <form action="<?php echo esc_url(home_url()); ?>/" method="GET">
                            <input type="text" placeholder="type and hit enter..." value="<?php the_search_query(); ?>" name="s" id="s">
                        </form>
	                    <a href="javascript:void(null);" class="hide-search-overlay"></a>
	                </div>
	            </div>

	        </div>
	    </header><!-- end of header-->
	<!-- END OF HEADER 2 -->

<?php elseif($header_style == 3): ?>

	<!-- HEADER 3 -->
	    <header class="site-header style-3">
	        <div class="container">

	            <div class="row">

	                <div class="hidden-sm col-md-4 hidden-xs links-holder">
	                    <div id="weather" class="links-wrapper">

	                    </div>
	                </div>

	                <div class="col-md-4 logo-holder">
	                    <div class="logo-wrapper">
    	                    <a href="<?php echo site_url(); ?>" class="logo">
                            	<?php if (!empty($newsstand['newsstand_logo']['url'])): ?>
                        			<img src="<?php echo esc_url($newsstand['newsstand_logo']['url']); ?>" alt="">
                        		<?php else: ?>
                        			<?php bloginfo('name'); ?>
                            	<?php endif ?>
                            </a>
	                    </div>
	                </div>

	                <div class="hidden-sm col-md-4 hidden-xs links-holder">
	                    <div class="links-wrapper">
	                        <ul>
	                            <li class="search"><a href="javascript:void(null);" class="show-search-overlay"><i class="fa fa-search"></i></a></li>
	                        </ul>
	                        <ul>
	                            <?php if ($header_date!='hide'): ?>
	                        		<li class="date"><?php echo esc_html($todays_date); ?></li>
	                        	<?php endif ?>
	                        </ul>
	                    </div>
	                </div>

	            </div>

	            <div class="search-overlay">
	                <form action="<?php echo esc_url(home_url()); ?>/" method="GET">
                        <input type="text" placeholder="type and hit enter..." value="<?php the_search_query(); ?>" name="s" id="s">
                    </form>
	                <a href="javascript:void(null);" class="hide-search-overlay"></a>
	            </div>

	            <a href="javascript:void(null);" class="open-mm visible-xs" id="open-mm-btn"><span></span></a>

	        </div>
	    </header>
	    <!-- end of header-->

	    <nav class="site-nav style-1 hidden-xs">
	        <div class="container">

	            <div class="nav-wrapper">

	                <ul class="site">
	                    <?php
	                        if ( has_nav_menu( 'primary' ) ) {
	                            // User has assigned menu to this location;
	                            // output it
	                            wp_nav_menu( array(
	                                'theme_location' => 'primary',
	                                'menu_class' => 'nav',
	                                'container' => '',
	                                'items_wrap'      => '%3$s',
	                            ) );
	                        } else {
	                            echo '<li><a href="'.admin_url().'nav-menus.php"><span>'.__('Create your menu +', 'newsstand').'</span></a></li>';
	                        }
	                    ?>
	                </ul>

	                <?php if (isset($social)): ?>
	                	<ul class="social">
	                	    <?php foreach ($social as $single): ?>
	                	    	<?php if (!empty($single['description']) || !empty($single['url'])): ?>
	                	    		<li><a href="<?php echo esc_url($single['url']); ?>" target="_blank"><i class="fa <?php echo esc_attr($single['description']); ?>"></i></a></li>
	                	    	<?php endif ?>
	                	    <?php endforeach ?>
	                	</ul>
	                <?php endif ?>

	            </div>

	        </div>
	    </nav><!-- end of nav -->
	<!-- END OF HEADER 3 -->

<?php elseif($header_style == 4): ?>

	<!-- HEADER 4 -->
	    <header class="site-header style-4">
	        <div class="container">

	            <div class="logo-wrapper">
	                <a href="<?php echo site_url(); ?>" class="logo">
                    	<?php if (!empty($newsstand['newsstand_logo']['url'])): ?>
                			<img src="<?php echo esc_url($newsstand['newsstand_logo']['url']); ?>" alt="">
                		<?php else: ?>
                			<?php bloginfo('name'); ?>
                    	<?php endif ?>
                    </a>
	            </div>

	            <nav class="hidden-xs">
	                <ul>
	                    <?php
	                        if ( has_nav_menu( 'primary' ) ) {
	                            // User has assigned menu to this location;
	                            // output it
	                            wp_nav_menu( array(
	                                'theme_location' => 'primary',
	                                'menu_class' => 'nav',
	                                'container' => '',
	                                'items_wrap'      => '%3$s',
	                            ) );
	                        } else {
	                            echo '<li><a href="'.admin_url().'nav-menus.php"><span>'.__('Create your menu +', 'newsstand').'</span></a></li>';
	                        }
	                    ?>
	                </ul>
	            </nav>

	            <div class="links-holder hidden-xs">
	                <div class="links-wrapper">
	                    <ul>
	                        <?php if ($header_date!='hide'): ?>
                        		<li class="date"><?php echo esc_html($todays_date); ?></li>
                        	<?php endif ?>
	                    </ul>
	                    <ul class="search">
	                        <li><a href="javascript:void(null);" class="show-search-overlay"><i class="fa fa-search"></i></a></li>
	                    </ul>
	                </div>
	            </div>

	            <a href="javascript:void(null);" class="open-mm visible-xs" id="open-mm-btn"><span></span></a>

	            <div class="search-overlay">
	                <form action="<?php echo esc_url(home_url()); ?>/" method="GET">
                        <input type="text" placeholder="type and hit enter..." value="<?php the_search_query(); ?>" name="s" id="s">
                    </form>
	                <a href="javascript:void(null);" class="hide-search-overlay"></a>
	            </div>

	        </div>
	    </header>
	<!-- END OF HEADER 4-->

<?php elseif($header_style == 5): ?>

	<!-- HEADER 5 -->
	    <header class="site-header style-4 withcut">
	        <div class="container">

	            <div class="logo-wrapper">
	                <a href="<?php echo site_url(); ?>" class="logo">
                    	<?php if (!empty($newsstand['newsstand_logo']['url'])): ?>
                			<img src="<?php echo esc_url($newsstand['newsstand_logo']['url']); ?>" alt="">
                		<?php else: ?>
                			<?php bloginfo('name'); ?>
                    	<?php endif ?>
                    </a>
	            </div>

	            <nav class="hidden-xs">
	                <ul>
	                    <?php
	                        if ( has_nav_menu( 'primary' ) ) {
	                            // User has assigned menu to this location;
	                            // output it
	                            wp_nav_menu( array(
	                                'theme_location' => 'primary',
	                                'menu_class' => 'nav',
	                                'container' => '',
	                                'items_wrap'      => '%3$s',
	                            ) );
	                        } else {
	                            echo '<li><a href="'.admin_url().'nav-menus.php"><span>'.__('Create your menu +', 'newsstand').'</span></a></li>';
	                        }
	                    ?>
	                </ul>
	            </nav>

	            <div class="links-holder hidden-xs">
	                <div class="links-wrapper">
	                    <ul class="search">
	                        <li><a href="javascript:void(null);" class="show-search-overlay"><i class="fa fa-search"></i></a></li>
	                    </ul>
	                    <?php if (isset($social)): ?>
    	                	<ul class="social">
    	                	    <?php foreach ($social as $single): ?>
    	                	    	<?php if (!empty($single['description']) || !empty($single['url'])): ?>
    	                	    		<li><a href="<?php echo esc_url($single['url']); ?>" target="_blank"><i class="fa <?php echo esc_attr($single['description']); ?>"></i></a></li>
    	                	    	<?php endif ?>
    	                	    <?php endforeach ?>
    	                	</ul>
    	                <?php endif ?>
	                </div>
	            </div>

	            <a href="javascript:void(null);" class="open-mm visible-xs" id="open-mm-btn"><span></span></a>

	            <div class="search-overlay">
	                <form action="<?php echo esc_url(home_url()); ?>/" method="GET">
                        <input type="text" placeholder="type and hit enter..." value="<?php the_search_query(); ?>" name="s" id="s">
                    </form>
	                <a href="javascript:void(null);" class="hide-search-overlay"></a>
	            </div>

	        </div>
	        <span class="bottom-cut"></span>
	    </header>
	<!-- END OF HEADER 5-->

<?php elseif($header_style == 6): ?>

	<!-- HEADER 6 -->
	    <header class="site-header style-3 style-6">
	        <div class="container">

	            <div class="row">

	                <div class="col-md-4 links-holder open-mm-holder">
	                    <a href="javascript:void(null);" class="open-mm" id="open-mm-btn-2"><span></span></a>
	                </div>

	                <div class="col-md-4 logo-holder">
	                    <div class="logo-wrapper">
	                        <a href="<?php echo site_url(); ?>" class="logo">
                            	<?php if (!empty($newsstand['newsstand_logo']['url'])): ?>
                        			<img src="<?php echo esc_url($newsstand['newsstand_logo']['url']); ?>" alt="">
                        		<?php else: ?>
                        			<?php bloginfo('name'); ?>
                            	<?php endif ?>
                            </a>
	                    </div>
	                </div>

	                <div class="hidden-sm col-md-4 hidden-xs links-holder">
	                    <div class="links-wrapper" id="weather" style="text-align: right !important;">
	                        <ul>
	                            <?php if ($header_date!='hide'): ?>
                            		<li class="date"><?php echo esc_html($todays_date); ?></li>
                            	<?php endif ?>
	                        </ul>
	                    </div>
	                </div>

	            </div>

	            <div class="search-overlay">
	                <form action="<?php echo esc_url(home_url()); ?>/" method="GET">
                        <input type="text" placeholder="type and hit enter..." value="<?php the_search_query(); ?>" name="s" id="s">
                    </form>
	                <a href="javascript:void(null);" class="hide-search-overlay"></a>
	            </div>

	            <a href="javascript:void(null);" class="open-mm visible-xs" id="open-mm-btn"><span></span></a>

	        </div>
	    </header>
	    <!-- end of header-->
	<!-- END OF HEADER 6 -->

<?php endif ?>

<div id="mobile-menu">
    <div class="inside">
        <div class="valign">

            <ul class="site">
                <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        // User has assigned menu to this location;
                        // output it
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_class' => 'nav',
                            'container' => '',
                            'items_wrap'      => '%3$s',
                        ) );
                    } else {
                        echo '<li><a href="'.admin_url().'nav-menus.php"><span>'.__('Create your menu +', 'newsstand').'</span></a></li>';
                    }
                ?>
            </ul>

            <?php if (isset($social)): ?>
            	<ul class="social">
            	    <?php foreach ($social as $single): ?>
            	    	<?php if (!empty($single['description']) || !empty($single['url'])): ?>
            	    		<li><a href="<?php echo esc_url($single['url']); ?>" target="_blank"><i class="fa <?php echo esc_attr($single['description']); ?>"></i></a></li>
            	    	<?php endif ?>
            	    <?php endforeach ?>
            	</ul>
            <?php endif ?>

        </div>
    </div>
    <div class="morph-shape" id="morph-shape" data-morph-open="M-1,0h101c0,0,0-1,0,395c0,404,0,405,0,405H-1V0z" data-morph-close="M-1,0h101c0,0-97.833,153.603-97.833,396.167C2.167,627.579,100,800,100,800H-1V0z">
        <svg xmlns="http://www.w3.org/2000/svg" width="300px" height="100%" viewBox="0 0 100 800" preserveAspectRatio="none">
            <path d="M-1,0h101c0,0-97.833,153.603-97.833,396.167C2.167,627.579,100,800,100,800H-1V0z"></path>
            </svg>
    </div>
</div><!-- end of mobile-menu -->
<a href="javascript:void(null);" class="back-to-top"></a>


<script>
    (function($) {
        $(document).ready(function() {

        	<?php if ($weather=='yes'): ?>
        		navigator.geolocation.getCurrentPosition(function(position) {
        		    loadWeather(position.coords.latitude+','+position.coords.longitude);
        		});

        		function loadWeather(location, woeid) {
        		  $.simpleWeather({
        		    location: location,
        		    woeid: woeid,
        		    unit: 'c',
        		    success: function(weather) {
        		      html = '<ul><li class="weather"><span>'+weather.temp+'&deg;'+weather.units.temp+'</span> <i class="icon-'+weather.code+'"></i></li></ul>';
        		      if ($("header.site-header.style-3").length) {
        		        $("header.site-header #weather").append(html);
        		      } else {
        		        $(".links-holder .links-wrapper").append(html);
        		      }

        		    },
        		    error: function(error) {
        		      $(console.log).html(error);
        		    }
        		  });
        		}
        	<?php endif ?>

        });
    })(jQuery);
</script>
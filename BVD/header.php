<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php wp_title('&laquo;', true, 'right'); ?>
<?php bloginfo('name'); ?>
</title>
<meta name="description" content="BVD" />
<meta http-equiv="cahe-control" content="cache" />
<meta http-equiv="Content-Language" content="en" />
<meta http-equiv="Copyright" content="Copyright BVD" />
<meta name="keywords" content="PLEASE ENTER YOUR KEYWORDS HERE" />
<meta name="robots" content="index" />
<meta content="all/follow" name="robots" />
<meta content="general" name="rating" />
<meta content="7days" name="revisit" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/styles/ie6.css" type="text/css" ><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/styles/ie7.css" type="text/css" ><![endif]-->
<!--JAVASCRIPT -->
<script src="<?php bloginfo('template_directory'); ?>/scripts/jquery-1.2.6.min.js" type='text/javascript'></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/jquery-easing.1.2.js" type='text/javascript'></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/jquery-easing-compatibility.1.2.js" type='text/javascript'></script>
<script src="<?php bloginfo('template_directory'); ?>/scripts/coda-slider.1.1.1.js" type='text/javascript'></script>
<script type='text/javascript'>

		$(function () {

			$("#blogSlider").codaSlider();

		});

	</script>
<!--[if IE 6]>

 <script src="<?php bloginfo('stylesheet_directory'); ?>/scripts/DD_belatedPNG_0.0.7a.js" type="text/javascript"></script>

 <script src="<?php bloginfo('stylesheet_directory'); ?>/scripts/png_fix_elements.js" type="text/javascript"></script>

<![endif]-->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php

if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))

  wp_enqueue_script( 'comment-reply' );

?>
<?php wp_head(); ?>
</head>
<!--BEGIN BODY -->
<body>
<div id="top_content">
  <div class="center" id="top_light1">
    <h1><a href="<?php echo get_option('siteurl'); ?>/" title="Go back to homepage">
      <?php bloginfo('name'); ?>
      </a></h1>
    <form method="get" id="searchform" action="<?php bloginfo( 'home' ); ?>/">
      <fieldset class="search">
      <input type="text" class="box" name="s" value="Search" onfocus="if (this.value == '<?php _e("Search", 'BVD'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Search", 'BVD'); ?>';}" />
      <button class="btn" title="Submit Search">Search</button>
      </fieldset>
    </form>
  </div>
</div>
<!--end top_content -->
<div id="nav_content">
  <div class="center" id="top_light2">
    <div class="nav">
      <ul id="nav">
      <?php if (is_home()) { ?>
            <li class="current_page_item"><a href="<?php echo get_option('home'); ?>">HOME</a></li>
        <?php } else { ?>
            <li><a href="<?php echo get_option('home'); ?>">HOME</a></li>
        <?php } ?>     
        <?php wp_list_pages('title_li=&depth=1'); ?>
      </ul>
    </div>
    <a class="signup" href="#">Sign up</a>
    <p class="login"><a class="fat" href="#">Log in</a> <span class="gray">or</span></p>
  </div>
</div>
<!--end nav_content -->
<?php if(is_home()): ?>
<div id="header">
  <div class="center" id="top_light3">
    <div class="left_column">
      <h2 class="tagline" style="background:transparent url(<?php if(get_option("bvd_btitle_img", $single = true) !="") { ?>
    <?php echo get_option("bvd_btitle_img", $single = true); ?>
    <?php } else { ?> <?php echo bloginfo('template_url'); ?>/images/tagline.png
	<?php } ?>) no-repeat;">We make beautiful websites at affordable prices</h2>
      
	  <p class="big"><?php if(get_option("bvd_1st_text", $single = true) !="") { ?>
    <?php echo get_option("bvd_1st_text", $single = true); ?>
    <?php } else { ?>Because web design is our passion<br />and that’s what we do!
	<?php } ?></p>
	  		
			<p><?php if(get_option("bvd_2nd_text", "bvd_3rd_text", $single = true) !="") { ?>
   <strong> <?php echo get_option("bvd_2nd_text", $single = true); ?></strong><br /><?php echo get_option("bvd_3rd_text", $single = true); ?>
	<?php } else { ?>
    <strong>Gratuitous octopus niacin, sodium glutimate.</strong><br />
        Quote meon an estimate et non interruptus stadium.
    <?php } ?></p>
		
		
     <a class="getquote" href="<?php if(get_option("bvd_quote_link", $single = true) !="") { ?>
    <?php echo get_option("bvd_quote_link", $single = true); ?>
    <?php } else { ?><?php echo get_option('siteurl'); ?>/contact
	<?php } ?>">Get a qoute</a>
	 
	 
	 
	 <a class="portfolio" href="<?php if(get_option("bvd_portfolio_link", $single = true) !="") { ?>
    <?php echo get_option("bvd_portfolio_link", $single = true); ?>
    <?php } else { ?><?php echo get_option('siteurl'); ?>/portfolio
	<?php } ?>">View portfolio</a> </div>
    
	
	
	
		<?php if(get_option("bvd_main_img", $single = true) !="") { ?>
	<img class="right_margin_top" src="<?php echo get_option("bvd_main_img", $single = true); ?>" alt="featured work" width="471" height="370"/>
    <?php } else { ?>
    <img class="right_margin_top" src="<?php echo bloginfo('template_url'); ?>/images/header_images.png" alt="featured work" width="471" height="370"/>
    <?php } ?>

	
</div>
</div>
<!--end header -->
<?php endif; ?>

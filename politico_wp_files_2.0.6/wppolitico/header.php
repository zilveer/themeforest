<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta name="viewport" content="initial-scale=1.0,width=device-width" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}
?><link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon" /> 

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fonts/font-awesome.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/scripts/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/responsive.css" type="text/css" media="screen" />
<!--[if IE]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/ie_style.css" type="text/css" />
<![endif]-->

<?php 
wp_enqueue_script('jquery');
wp_head();
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

//VAR SETUP
$linkColor = get_theme_mod('themolitor_customizer_link_color','#12548c');
$accentColor = get_theme_mod('themolitor_customizer_countdown_color','#a72205');

$logo = get_theme_mod('themolitor_customizer_logo', get_template_directory_uri().'/images/logo.png');

$bannerTop = get_theme_mod('themolitor_customizer_top_banner','#25659D');
$bannerBottom = get_theme_mod('themolitor_customizer_bottom_banner','#00427b');

$donateOnOff = get_theme_mod('themolitor_customizer_donate_onoff', TRUE);
$donateNewWindow = get_theme_mod('themolitor_customizer_donate_new', TRUE);
$donateText = get_theme_mod('themolitor_customizer_donate_text','DONATE NOW');
$donateLink = get_theme_mod('themolitor_customizer_donate_link','#');
$donateTextColor = get_theme_mod('themolitor_customizer_donate_color','#ffffff');
$donateTopColor = get_theme_mod('themolitor_customizer_donate_top_color','#be5a45');
$donateBottomColor = get_theme_mod('themolitor_customizer_donate_bottom_color','#a72306');

$countdownOnOff = get_theme_mod('themolitor_customizer_countdown_onoff',TRUE);
$countdownLink = get_theme_mod('themolitor_customizer_countdown_link','#');
$countdownText = get_theme_mod('themolitor_customizer_countdown_text','Election Countdown');
$countdownActive = get_theme_mod('themolitor_customizer_countdown_active','true');
$countdownDate = get_theme_mod('themolitor_customizer_countdown_end','11/02/2016 12:00 AM');
$countdownFinishText = get_theme_mod('themolitor_customizer_countdown_finished','Countdown Finished!');

$slider = get_theme_mod('themolitor_customizer_slider_type','dual');
$customCss = get_theme_mod('themolitor_customizer_css');
?>

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
<![endif]-->

<style type="text/css">
a {color:<?php echo $linkColor; ?>;}

a#cntdwnLink {color:<?php echo $accentColor; ?>;}

#sliderContainer {
background:<?php echo $linkColor; ?>;
background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $bannerTop; ?>), to(<?php echo $bannerBottom; ?>));
background: -moz-linear-gradient(top,  <?php echo $bannerTop; ?>,  <?php echo $bannerBottom; ?>) ;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $bannerTop; ?>', endColorstr='<?php echo $bannerBottom; ?>');
}

a#donate {
color: <?php echo $donateTextColor; ?>;
border: 1px solid <?php echo $donateBottomColor; ?>;
background:<?php echo $donateBottomColor; ?>;
background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $donateTopColor; ?>), to(<?php echo $donateBottomColor; ?>));
background: -moz-linear-gradient(top,  <?php echo $donateTopColor; ?>,  <?php echo $donateBottomColor; ?>) ;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $donateTopColor; ?>', endColorstr='<?php echo $donateBottomColor; ?>');
}
a#donate:hover {
	background:<?php echo $donateTopColor; ?>;
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $donateBottomColor; ?>), to(<?php echo $donateTopColor; ?>));
	background: -moz-linear-gradient(top,  <?php echo $donateBottomColor; ?>,  <?php echo $donateTopColor; ?>) ;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $donateBottomColor; ?>', endColorstr='<?php echo $donateTopColor; ?>');
}

<?php if($countdownOnOff == 1 && is_front_page()) { ?>
#content {
	background: url(<?php echo get_template_directory_uri(); ?>/images/counter_bg.jpg) no-repeat center top; 
	padding: 35px 0 65px;
}
body.page-template-fullpage-php #content {
	background: url(<?php echo get_template_directory_uri(); ?>/images/divider.png) no-repeat center 100px; 
}
<?php } else { ?>
#content {
	background: url(<?php echo get_template_directory_uri(); ?>/images/content_bg.jpg) no-repeat right top;
	padding: 50px 0 65px;
}
<?php }

if(!empty($customCss)){echo $customCss;}
?>
</style>

</head>

<body <?php body_class();?>>

<div id="headerContainer">	
	<div id="header">
		<a class="logo" href="<?php echo home_url(); ?>"><img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /></a>    
		<?php if($donateOnOff == 1) { ?><a id="donate" <?php if($donateNewWindow == 1) { ?>target="_blank"<?php } ?> href="<?php echo $donateLink; ?>"><?php echo $donateText; ?></a><?php } ?>
		<?php wp_nav_menu(array('theme_location' => 'main', 'container_id' => 'navigation', 'menu_id' => 'dropmenu'));?>
	</div><!--end header-->
	
	<div id="sliderContainer">
		<div id="sliderStyle">
			<div id="slider">			
				<?php if(is_front_page()) {
					get_template_part(''. $slider .'slider');
				} elseif(is_single() || is_page()) { ?>
					<?php 
					$data = get_post_meta( $post->ID, 'key', true ); 
					if (!empty($data[ 'custom_subtext' ])) {$subText = $data[ 'custom_subtext' ];}
					?>
					<h1 id="title"><?php the_title(); ?> <?php  if ($subText) { ?><span><?php echo $subText; ?></span><?php } ?></h1>
				<?php } elseif(is_404()) { ?>
					<h1 id="title"><?php _e('Error 404','themolitor');?> <span><?php _e('We could not find what was requested','themolitor');?></span></h1>
				<?php } elseif(is_search()) { ?>
					<h1 id="title"><?php _e('Search Results','themolitor');?> <span><?php $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = esc_html($s); $count = $allsearch->post_count; echo ''; echo'"'; echo $key; echo'"'; echo' &mdash; '; echo $count . ' '; _e('matches','themolitor'); wp_reset_query(); ?></span></h1>
				<?php } elseif(is_category()) { ?>
					<h1 id="title"><?php single_cat_title(); ?> <span><?php if(category_description()) { $text = category_description(); echo strip_tags($text); } ?></span></h1>
				<?php } elseif( is_tag() ) { ?>
					<h1 id="title"><?php single_tag_title(); ?></h1>
				<?php } elseif (is_day()) { ?>
					<h1 id="title"><?php _e('Archive for','themolitor');?> <?php the_time('F jS, Y'); ?></h1>
				<?php } elseif (is_month()) { ?>
					<h1 id="title"><?php _e('Archive for','themolitor');?> <?php the_time('F, Y'); ?></h1>
				<?php } elseif (is_year()) { ?>
					<h1 id="title"><?php _e('Archive for','themolitor');?> <?php the_time('Y'); ?></h1>
				<?php } elseif (is_author()) { ?>
					<h1 id="title"><?php _e('Author Archive','themolitor');?></h1>
				<?php } ?>
			</div><!--end slider-->
		</div><!--end sliderStyle-->
	</div><!--end sliderContainer-->
</div><!--end headerContainer-->	

<div id="contentContainer">
	<div id="content">

		<?php if($countdownOnOff == 1 && is_front_page()) { ?>
		<div id="countdown">
			<a id="cntdwnLink" href="<?php echo $countdownLink; ?>"><?php echo $countdownText; ?></a>
			<a href="<?php echo $countdownLink; ?>">
			<script type="text/javascript">
				CountActive = <?php echo $countdownActive; ?>;
				TargetDate = "<?php echo $countdownDate; ?>";
				DisplayFormat = "%%D%% days : %%H%% hrs : %%M%% min : %%S%% sec";
				FinishMessage = "<?php echo $countdownFinishText; ?>";
			</script>
			<script src="<?php echo get_template_directory_uri(); ?>/scripts/countdown.js" type="text/javascript"></script>
			</a>
		</div>
		<?php } ?>	

		<div id="main">

			<?php if (function_exists('dimox_breadcrumbs') && !is_front_page()) dimox_breadcrumbs(); ?>
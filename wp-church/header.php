<?php
/**
 * The Header for our theme.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title(); ?></title>
<meta name="description" content="<?php the_meta_description(); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> 
<link class="schanger" rel="stylesheet" class="changer" href="<?php echo get_template_directory_uri(); ?>/styles/<?php echo get_option('nets_colorscheme'); ?>.css" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox-1.3.4.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
wp_enqueue_script( 'jquery' );
wp_head();
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/audio-player.js" type="text/javascript"></script>
	<script type="text/javascript">  
		AudioPlayer.setup("<?php echo get_template_directory_uri(); ?>/js/player.swf", 
		{  
        	width: 600,
       		transparentpagebg: "yes",
        	autostart: "yes",
        	leftbg: "DCDACF",
        	rightbg: "DCDACF",
        	voltrack: "F2EEE3",
        	lefticon: "<?php get_playercolor(); ?>",
        	volslider: "<?php get_playercolor(); ?>",
        	righticon: "<?php get_playercolor(); ?>",
        	loader: "<?php get_playercolor(); ?>",
        	tracker: "DCDACF",
        	track: "F2F0E4",
        	bg: "F2F0E4"
 		});  
	</script>
	
<?php 
$thevfont = str_replace(' ','+', get_option('nets_vfont'));
?>
<?php if (!get_option('nets_fontcode')) { ?>
<link href="http://fonts.googleapis.com/css?family=<?php echo $thevfont; ?>&v2" rel="stylesheet" type="text/css">
<?php } else { echo stripslashes(get_option('nets_fontcode')); } 
if (!get_option('nets_fontcode')) {
$familycode = get_option('nets_vfont');
} else { $familycode = get_option('nets_fontfamily'); }
?>


<style>
.nextdesc, .lasthead, .caldr h3{font: 20px/27px '<?php echo $familycode; ?>', Arial, sans-serif;}
.entry-title {font: 30px/60px '<?php echo $familycode; ?>', Arial, sans-serif;}
.mainwelcome h1, .daydisplay h1{font: 36px/40px '<?php echo $familycode; ?>', Arial, sans-serif;}
h6.day {font: 50px/40px '<?php echo $familycode; ?>', Arial, sans-serif;}
.widget-title, #content .calmonth h1, .saboutpage h3, .aboutpage h3	{font: 24px/47px '<?php echo $familycode; ?>', Arial, sans-serif;}
.sider .widget-title{font: 19px/22px '<?php echo $familycode; ?>', Arial, sans-serif;font-family: '<?php echo $familycode; ?>', Arial, sans-serif;}
.daydisplayw h1, h6.month, h3#reply-title, h3#comments-title {font: 22px/20px '<?php echo $familycode; ?>', Arial, sans-serif;}	
blockquote, #content .entry-content h1, #content .entry-content h2, #content .entry-content h3, #content .entry-content h4, #content .entry-content h5, #content .entry-content h6{font-family: '<?php echo $familycode; ?>', Georgia,Arial, sans-serif;}
.shortcalentry a, #content .finfo h4{font: 22px/20px '<?php echo $familycode; ?>', Arial, sans-serif;}	
.dirr a{font: 18px/49px '<?php echo $familycode; ?>', Arial, sans-serif;}
#content .calexplain p {font: 18px/24px '<?php echo $familycode; ?>', Arial, sans-serif;}

</style>

<!--[if IE 7.0]>
<style>
.micfront, .movfront {float: right; margin: -30px 20px 0 20px;cursor: pointer; }
.fppostli a.postera	{height: 65px; line-height: 22px; overflow: hidden;display:block;text-decoration:none;margin-top: -20px;}
</style>
 <![endif]-->
</head>


<body <?php body_class(); ?> >

<div id="topbg">
	<div id="access" class="container" role="navigation">
		<?php if (get_option('nets_themelogo') && get_option('nets_themelogo') != 'no image uploaded') { ?>
		<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="logoimg" src="<?php echo get_option('nets_themelogo'); ?>"></a>
		<?php } else { ?>
		<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img class="logoimg" src="<?php echo get_template_directory_uri(); ?>/styles/<?php echo get_option('nets_colorscheme'); ?>/logo.png"></a>
		<?php } ?>
		<?php if (get_option('nets_countdown')  != 'true') { ?>
		<div class="eventd">
			<div class="nextdesc"><?php echo get_option('nets_sptnextev')?></div>
			<?php get_for_timer(); ?>
		</div>
		<?php } ?>
		<div class="clear"></div>
		<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'wp-church' ); ?>"><?php _e( 'Skip to content', 'wp-church' ); ?></a></div>
		<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
		<div class="clear"></div>
	</div>
</div>
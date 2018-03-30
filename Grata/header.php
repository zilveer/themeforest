<?php
global $smof_data;

$rounded_corners_class = (@$smof_data['rounded_corners'] == '1')?' rounded_corners':'';
$home_fullscreen_class = (@$smof_data['fullscreen_home'] == '1')?' hometype_fullscreen':'';
$sticky_header_class = (@$smof_data['header_is_sticky'] == '1'/* OR (defined('ONE_PAGE_HOME') AND ONE_PAGE_HOME)*/)?' header_sticky':'';
$boxed_class = (@$smof_data['boxed_style'] == '1')?' with_borders':'';
$one_page_home_class = (defined('ONE_PAGE_HOME') AND ONE_PAGE_HOME)?' one_page_home':'';



$sidebar_position_class = '';

if (defined('SIDEBAR_POS') AND SIDEBAR_POS == 'left')
{
	$sidebar_position_class = ' col_sidecont';
}
if (defined('SIDEBAR_POS') AND SIDEBAR_POS == 'right')
{
	$sidebar_position_class = ' col_contside';
}
if (defined('IS_FULLWIDTH') AND IS_FULLWIDTH)
{
	$sidebar_position_class = ' col_cont';
}
if (defined('IS_BLOG') AND IS_BLOG)
{
	switch(@$smof_data['blog_sidebar_pos']) {
		case 'Right': $sidebar_position_class = ' col_contside';
			break;
		case 'Left': $sidebar_position_class = ' col_sidecont';
			break;
		default: $sidebar_position_class = ' col_cont';
	}
}
if (defined('IS_POST') AND IS_POST)
{
	switch(@$smof_data['post_sidebar_pos']) {
		case 'Right': $sidebar_position_class = ' col_contside';
			break;
		case 'Left': $sidebar_position_class = ' col_sidecont';
			break;
		default: $sidebar_position_class = ' col_cont';
	}
}

$no_logo_class = (@$smof_data['logo_as_text'] == 1 AND @$smof_data['logo_text'] == '')?' no_logo':'';

$no_responsive_class = ( ! isset($smof_data['responsive_layout']) OR $smof_data['responsive_layout'] == 1) ? '':'no-responsive';
?><!DOCTYPE HTML>
<html class="<?php echo $no_responsive_class;?>" <?php language_attributes('html')?>>
<head>
	<meta charset="UTF-8">
	<title><?php bloginfo('name'); ?><?php wp_title(' - ', true, 'left'); ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php if($smof_data['custom_favicon'] != "") { ?><link rel="shortcut icon" href="<?php echo $smof_data['custom_favicon']; ?>"><?php } ?>
	<?php wp_head(); ?>
    <?php
    global $load_styles_directly;
    if (isset($load_styles_directly) AND $load_styles_directly)
    {
        get_template_part('templates/custom_css');
    }
    ?>
</head>
<body <?php body_class("l-body".$rounded_corners_class.$home_fullscreen_class.$sticky_header_class.$sidebar_position_class.$one_page_home_class.$boxed_class.$no_logo_class); ?>>
<?php if (defined('ONE_PAGE_HOME') AND ONE_PAGE_HOME AND ! (isset($smof_data['preloader']) AND $smof_data['preloader'] == 'Disabled')) {
    $preloader_type = (isset($smof_data['preloader']))?substr($smof_data['preloader'], -1):'1';
    if ( ! in_array($preloader_type, array(1, 2, 3, 4, 5, 6, 7))) {
        $preloader_type = 1;
    }
    $preloader_type_class = ' type_'.$preloader_type;
    ?><div class='l-preloader'><?php echo "<div class='l-preloader-spinner'><div class='w-preloader ".$preloader_type_class."'><div class='w-preloader-h'></div></div></div>"; ?></div><?php }?>
<!-- HEADER -->
<div class="l-header<?php if (@$smof_data['header_full_width'] == 1) { echo ' full_width'; } if (@$smof_data['header_sticky_type'] == 'Transparent') { echo ' type_transparent';} elseif (@$smof_data['header_sticky_type'] == 'Hidden') { echo ' type_hidden';} else { echo ' type_default';} ?>"<?php if ( ! empty($smof_data['header_height']) AND $smof_data['header_height'] >= 50 AND $smof_data['header_height'] <= 120) { echo ' style="line-height:'.$smof_data['header_height'].'px;"'; } ?>>
	<div class="l-header-h i-cf">
	
		<?php  if ( ! (@$smof_data['logo_as_text'] == 1 AND @$smof_data['logo_text'] == '')) { ?>
		<!-- logo -->
		<div class="w-logo<?php if (@$smof_data['logo_as_text'] == 1) { echo ' with_title'; } ?>">
			<a class="w-logo-link" href="<?php if (defined('ONE_PAGE_HOME') AND ONE_PAGE_HOME) { echo '#'; } else { if (function_exists('icl_get_home_url')) echo icl_get_home_url(); else echo esc_url(home_url('/')); } ?>">
				<img class="w-logo-img" src="<?php echo ($smof_data['custom_logo'])?$smof_data['custom_logo']:get_template_directory_uri().'/img/logo_0.png';?>"  alt="<?php bloginfo('name'); ?>"<?php if ( ! empty($smof_data['logo_height']) AND $smof_data['logo_height'] >= 20 AND $smof_data['logo_height'] <= 120) { echo ' style="height:'.$smof_data['logo_height'].'px;"'; } ?>>
				<span class="w-logo-title"><?php if (@$smof_data['logo_text'] != '') { echo $smof_data['logo_text']; } else { bloginfo('name'); } ?></span>
			</a>
		</div>
		<?php } ?>

        <?php get_template_part('templates/cart_dropdown'); ?>
		
		<?php
$socials = array (
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'google' => 'Google+',
    'linkedin' => 'LinkedIn',
    'youtube' => 'YouTube',
    'vimeo' => 'Vimeo',
    'flickr' => 'Flickr',
    'instagram' => 'Instagram',
    'behance' => 'Behance',
    'pinterest' => 'Pinterest',
    'skype' => 'Skype',
    'tumblr' => 'Tumblr',
    'dribbble' => 'Dribbble',
    'vk' => 'Vkontakte',
    'xing' => 'Xing',
    'twitch' => 'Twitch',
    'yelp' => 'Yelp',
    'soundcloud' => 'SoundCloud',
    'deviantart' => 'DeviantArt',
    'foursquare' => 'Foursquare',
    'github' => 'GitHub',
);

$output = '';

foreach ($socials as $social_key => $social)
{
    if ($smof_data[$social_key.'_header_link'] != '')
    {
        if ($social_key == 'email')
        {
            $output .= '<div class="w-socials-item '.$social_key.'">
    <a class="w-socials-item-link" href="mailto:'.$smof_data[$social_key.'_header_link'].'">
        <i class="fa fa-envelope"></i>
    </a>
    <div class="w-socials-item-popup"><span>'.$social.'</span></div>
    </div>';

        }
        elseif ($social_key == 'google')
        {
            $output .= '<div class="w-socials-item gplus">
    <a class="w-socials-item-link" target="_blank" href="'.$smof_data[$social_key.'_header_link'].'">
        <i class="fa fa-google-plus"></i>
    </a>
    <div class="w-socials-item-popup"><span>'.$social.'</span></div>
    </div>';

        }
        elseif ($social_key == 'youtube')
        {
            $output .= '<div class="w-socials-item '.$social_key.'">
    <a class="w-socials-item-link" target="_blank" href="'.$smof_data[$social_key.'_header_link'].'">
        <i class="fa fa-youtube-play"></i>
    </a>
    <div class="w-socials-item-popup"><span>'.$social.'</span></div>
    </div>';

        }
        elseif ($social_key == 'vimeo')
        {
            $output .= '<div class="w-socials-item '.$social_key.'">
    <a class="w-socials-item-link" target="_blank" href="'.$smof_data[$social_key.'_header_link'].'">
        <i class="fa fa-vimeo-square"></i>
    </a>
    <div class="w-socials-item-popup"><span>'.$social.'</span></div>
    </div>';

        }
        else
        {
            $output .= '<div class="w-socials-item '.$social_key.'">
    <a class="w-socials-item-link" target="_blank" href="'.$smof_data[$social_key.'_header_link'].'">
        <i class="fa fa-'.$social_key.'"></i>
    </a>
    <div class="w-socials-item-popup"><span>'.$social.'</span></div>
    </div>';
        }

    }
}

if ($output != '' AND $smof_data['header_socials']) {
?>  	<div class="w-socials">
			<div class="w-socials-list">
				<?php echo $output; ?>
			</div>
		</div>
<?php }?>
		
		<!-- NAV -->
		<nav class="w-nav layout_hor touch_disabled">
			<div class="w-nav-control">
				<i class="fa fa-bars"></i>
			</div>
			<ul class="w-nav-list level_1">
				<?php wp_nav_menu(
					array(
						'theme_location' => 'grata-main-menu',
						'container'       => 'ul',
						'container_class' => 'w-nav-list',
						'walker' => new Walker_Nav_Menu_us(),
						'items_wrap' => '%3$s',
						'fallback_cb' => false,
					));
				?>
			</ul>
		</nav>
		<!-- /NAV -->
		
	</div>
</div>
<!-- /HEADER -->

<!-- MAIN -->
<div class="l-main">

<?php
/*
Template Name: Coming Soon
*/
if ( !post_password_required() ) {
?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <?php echo((gt3_get_theme_option("responsive") == "on") ? '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">' : ''); ?>
    <link rel="shortcut icon" href="<?php echo gt3_get_theme_option('favicon'); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo gt3_get_theme_option('apple_touch_57'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo gt3_get_theme_option('apple_touch_72'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo gt3_get_theme_option('apple_touch_114'); ?>">
    <title><?php wp_title(); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <script type="text/javascript">
        var gt3_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
    <?php echo gt3_get_if_strlen(gt3_get_theme_option("custom_css"), "<style>", "</style>") . gt3_get_if_strlen(gt3_get_theme_option("code_before_head"));
    globalJsMessage::getInstance()->render();
    wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID()); 
wp_enqueue_script('gt3_countdown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array(), false, true); 
if (isset($gt3_theme_pagebuilder['countdown']['year'])) $year = esc_attr($gt3_theme_pagebuilder['countdown']['year']);
if (isset($gt3_theme_pagebuilder['countdown']['day'])) $day = esc_attr($gt3_theme_pagebuilder['countdown']['day']);
if (isset($gt3_theme_pagebuilder['countdown']['month'])) $month = esc_attr($gt3_theme_pagebuilder['countdown']['month']);
?>

	<div class="global_count_wrapper">
    	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cs_logo">
        	<img src="<?php gt3_the_theme_option("logo_landing"); ?>" alt=""  width="<?php gt3_the_theme_option("landing_logo_standart_width"); ?>" height="<?php gt3_the_theme_option("landing_logo_standart_height"); ?>" class="logo_def">
            <img src="<?php gt3_the_theme_option("logo_landing_retina"); ?>" alt="" width="<?php gt3_the_theme_option("landing_logo_standart_width"); ?>" height="<?php gt3_the_theme_option("landing_logo_standart_height"); ?>" class="logo_retina">
        </a>
    	<div class="count_title"><h1><?php the_title(); ?></h1></div>
        <?php if (isset($year) && isset($day) && isset($month) && $year !== "" && $day !== "" && $month !== "") {?>
			<script>
                jQuery(function () {
                    var austDay = new Date();				
                    austDay = new Date(<?php echo $year ?>, <?php echo $month ?>-1, <?php echo $day ?>);
                    jQuery('#countdown').countdown({until: austDay});
                });
            </script>		
            <div class="countdown_wrapper">
	            <div id="countdown">

                </div>
            </div>
		<?php } else {?>
        	<h1 class="count_error"><?php _e('Date has not been entered', 'gt3_builder') ?></h1>
        <?php } ?>
        <?php if (isset($gt3_theme_pagebuilder['page_settings']['icons']) || (isset($gt3_theme_pagebuilder['countdown']['notify_text']) && $gt3_theme_pagebuilder['countdown']['notify_text'] !== '') || (isset($gt3_theme_pagebuilder['countdown']['shortcode']) && $gt3_theme_pagebuilder['countdown']['shortcode'] !== '')) { ?>
        <div class="count_container_wrapper">
            <div class="count_container">
                <div class="form_area">
                <?php if (isset($gt3_theme_pagebuilder['countdown']['notify_text']) && $gt3_theme_pagebuilder['countdown']['notify_text'] !== '') {
                    echo "<h3 class='notify_text'>".$gt3_theme_pagebuilder['countdown']['notify_text']."</h3>";
                } ?>
                <?php if (isset($gt3_theme_pagebuilder['countdown']['shortcode']) && $gt3_theme_pagebuilder['countdown']['shortcode'] !== '') {
                    echo "<div class='notify_shortcode'>". (is_gt3_builder_active() ? do_shortcode($gt3_theme_pagebuilder['countdown']['shortcode']) : '')."</div>";
                } ?>
                </div>
                <?php if (isset($gt3_theme_pagebuilder['page_settings']['icons'])) {
                    $ico_compile = '<div class="soc_icons">';
                    foreach ($gt3_theme_pagebuilder['page_settings']['icons'] as $key => $value) {
                        if ($value['link'] == '') $value['link'] = '#';
                        $ico_compile .= '<a href="'.$value['link'].'" class="count_ico" title="'.$value['name'].'"><span><i class="'.$value['data-icon-code'].'"></i></span></a>';						
                    }
                    $ico_compile .= "</div>";
                    echo $ico_compile;
                } ?>                
            </div>
        </div>
		<?php }?>        
    </div>
    <div class="cs_fadder"></div>

    <script>
		var countWrapper = jQuery('.countdown_wrapper'),
			countTitle = jQuery('.count_title'),
			countContainer = jQuery('.count_container_wrapper'),
			csLogo = jQuery('.cs_logo');
		jQuery(document).ready(function(){
			centerWindow();
		});
		jQuery(window).resize(function(){
			setTimeout('centerWindow()',500);
			setTimeout('centerWindow()',1000);
		});
		function centerWindow() {

			freeSpace = (window_h - countWrapper.height() - countTitle.height() - countContainer.height() - csLogo.height())/4;
			setMiddle = freeSpace*2 + countTitle.height()+csLogo.height();
			csLogo.css('margin-top', freeSpace/2);
			countTitle.css('top', (freeSpace+csLogo.height())+'px');
			countWrapper.css('top', setMiddle+'px');
			countContainer.css('bottom', freeSpace+'px');
		}
	</script>

<?php get_footer('none'); 
} else {
	get_header('fullscreen');
?>
    <div class="pp_block">
        <h1 class="pp_title"><?php  _e('THIS CONTENT IS', 'theme_localization') ?> <span><?php  _e('PASSWORD PROTECTED', 'theme_localization') ?></span></h1>
        <div class="pp_wrapper">
            <?php the_content(); ?>
        </div>
    </div>
    <div class="global_center_trigger"></div>	
    <script>
		jQuery(document).ready(function(){
			jQuery('.post-password-form').find('label').find('input').attr('placeholder', 'Enter The Password...');
		});
	</script>
<?php 
	get_footer('fullscreen');
} ?>
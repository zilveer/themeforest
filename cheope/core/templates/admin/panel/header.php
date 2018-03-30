<?php
/**
 * The header of the panel. 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */
?>

<div class="wrap">
    <!-- START HEADER -->
    <?php if(YIT_SHOW_PANEL_HEADER) :?>
    <div id="yit-header">
        <div id="logo"></div>
        
        <!-- <div id="spot">
            <a href="http://yithemes.com" target="_blank" title="Your Inspiration Themes"><?php _e( 'DOWNLOAD <strong>HIGH QUALITY</strong> WORDPRESS THEMES <strong>FOR FREE</strong>', 'yit' ) ?></a>
        </div> --> 
        <div id="info">
            <p class="name-theme"><?php echo $yit->getConfigThemeName() . ' ' . $yit->getConfigThemeVersion(); ?></p>
            <p class="framework-version">YIT Framework <?php echo YIT_CORE_VERSION; ?></p>
        </div>
    </div>
    <?php endif ?>
    <!-- END HEADER -->
            
    <!-- START UTILITY BAR -->
    <?php if(YIT_SHOW_PANEL_HEADER_LINKS): ?>
    <div id="yit-utility-bar">
        <p><?php printf( __( '<strong>Need support?</strong> View the <a href="%s">documentation</a> ', 'yit' ), YIT_DOCUMENTATION_URL ); printf( __( 'or access in the <a href="%s" title="Support forum">support forum</a>', 'yit' ), admin_url( 'admin.php?page=yit_panel_support' ) ) ?></p>
        <p class="right"><a href="<?php echo get_template_directory_uri() . '/Changelog.txt' ?>"><?php _e( 'Theme Changelog', 'yit' ) ?></a> <!-- | <a href="<?php echo YIT_FREE_THEMES_URL ?>"><?php _e( 'Our free themes', 'yit' ) ?></a> --></p>
    </div>
    <?php endif ?>
    <!-- END UTILITY BAR -->
    


<div class="wrap" id="yit_container">
	<div id="yit-wrapper">
		

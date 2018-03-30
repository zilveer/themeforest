<?php get_header(); ?>

<?php
global $post;
dttheme_slider_section( $post->ID, 'page' );	
dttheme_top_space( $post->ID, 'page' );
?>

<div class="container">

	<?php
    
    $tpl_default_settings = get_post_meta( $post->ID, '_tpl_default_settings', TRUE );
    $tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();
    
    $page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";
    $show_sidebar = $show_left_sidebar = $show_right_sidebar =  false;
    $sidebar_class = "";
    
    switch ( $page_layout ) {
        case 'with-left-sidebar':
            $page_layout = "with-sidebar with-left-sidebar";
            $show_sidebar = $show_left_sidebar = true;
            $sidebar_class = "secondary-has-left-sidebar";
        break;
    
        case 'with-right-sidebar':
            $page_layout = "with-sidebar with-right-sidebar";
            $show_sidebar = $show_right_sidebar	= true;
            $sidebar_class = "secondary-has-right-sidebar";
        break;
    
        case 'both-sidebar':
            $page_layout = "with-sidebar page-with-both-sidebar";
            $show_sidebar = $show_right_sidebar	= $show_left_sidebar = true;
            $sidebar_class = "secondary-has-both-sidebar";
        break;
    
        case 'content-full-width':
        default:
            $page_layout = "content-full-width";
        break;
    }
	global $dt_allowed_html_tags;
    
    if ( $show_sidebar ):
        if ( $show_left_sidebar ): ?>
            <!-- Secondary Left -->
            <div id="secondary-left" class="secondary-sidebar <?php echo $sidebar_class;?>"><?php get_sidebar( 'left' );?></div><?php
        endif;
    endif;?>
    
    <!-- ** Primary Section ** -->
    <div id="primary" class="<?php echo $page_layout;?>">
    	<?php
		#Top code section
		$dttheme_options = get_option(IAMD_THEME_SETTINGS);
		$dttheme_integration = $dttheme_options['integration'];
		if(isset($dttheme_integration['enable-single-page-top-code']))	echo wp_kses(stripslashes($dttheme_integration['single-page-top-code']), $dt_allowed_html_tags);
		#Top code section
		?>
		<?php
        if( have_posts() ):
            while( have_posts() ):
                the_post();
                get_template_part( 'framework/loops/content', 'page' );
            endwhile;
        endif;?>
		<?php
        #Bottom code section 
        $dttheme_integration = $dttheme_options['integration'];
        if(isset($dttheme_integration['enable-single-page-bottom-code']))	echo wp_kses(stripslashes($dttheme_integration['single-page-bottom-code']), $dt_allowed_html_tags);
        ?>   
    </div><!-- ** Primary Section End ** --><?php
    
    if ( $show_sidebar ):
        if ( $show_right_sidebar ): ?>
            <!-- Secondary Right -->
            <div id="secondary-right" class="secondary-sidebar <?php echo $sidebar_class;?>"><?php get_sidebar( 'right' );?></div><?php
        endif;
    endif;?>
        
</div>

<div class="dt-sc-margin70"></div>
    
<?php get_footer(); ?>
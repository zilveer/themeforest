<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="author" content="ThemeFuse">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php
    if(tfuse_options('disable_tfuse_seo_tab')) {
        wp_title( '|', true, 'right' );
        bloginfo( 'name' );
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
    }
    else wp_title(''); ?>
    </title>
    <?php tfuse_meta(); ?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php
        if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
        tfuse_phone_style();
        tfuse_print_theme_color_style();
        tfuse_head();
        wp_head();
    ?>
</head>
<?php tfuse_top_adds(); ?>
<body <?php tfuse_bk_style(); echo ' '; body_class();?>>
    <div class="body_wrap clearfix">
        <div id="header" class="clearfix">
            <div class="container">
                <div class="header_top clearfix">
                    <div class="logo alignleft">
                        <?php tfuse_custom_logo(); ?>
                    </div><!-- /logo -->
                    <div class="search_top alignright">
                        <form id="searchForm" action="<?php echo home_url( '/' ) ?>" method="get">
                            <input type="text" name="s" value="<?php echo tfuse_options('search_box_text','Search'); ?>" class="input_text" onfocus="if (this.value == '<?php echo tfuse_options('search_box_text','Search'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo tfuse_options('search_box_text','Search'); ?>';}">
                            <input type="submit" value="" class="btn_send">
                        </form>
                    </div><!-- /.search_top -->
                </div><!-- /header top-->

                <?php tfuse_menu('default'); ?>
                <?php tfuse_header_content('header'); ?>
                <?php tfuse_custom_title(); ?>
            </div><!--/ container -->
        </div><!--/ #header -->
        <?php
            tfuse_header_content('after_header');
            global $is_tf_blog_page;
            if($is_tf_blog_page) tfuse_category_on_blog_page();
        ?>
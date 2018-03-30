<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php
    global $wp_version;
    $arrImages = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
    $image = $arrImages[0];
    if (version_compare($wp_version,'4.1','<')): ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php endif; ?>

    <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>">
    <meta property="og:url" content="<?php echo esc_url(get_the_permalink())?>" />
    <meta name="robots" content="index, follow" />


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php global $zorka_data;
     $favicon = '';
        if (isset($zorka_data['favicon']) && !empty($zorka_data['favicon']) ) {
            $favicon = $zorka_data['favicon'];
        } else {
            $favicon = get_template_directory_uri() . "/assets/images/favicon.ico";
        }
    ?>

    <link rel="shortcut icon" href="<?php echo esc_url($favicon);?>" type="image/x-icon">
    <link rel="icon" href="<?php echo esc_url($favicon);?>" type="image/x-icon">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<?php
global $zorka_data;

$body_class = array();

$layout_style = get_post_meta(get_the_ID(),'layout-style',true);
if (!isset($layout_style) || empty($layout_style) || $layout_style == 'none'){
    $layout_style = $zorka_data['layout-style'];
}

if ($layout_style == 'boxed') {
    $body_class[] = 'boxed';
}
$show_loading = isset($zorka_data['show-loading']) ? $zorka_data['show-loading'] : 1;


$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
    $header_layout =  $zorka_data['header-layout'];
}
$body_class[] = 'header-' . $header_layout;

$page_title_background = isset($zorka_data['page-title-background']) ? $zorka_data['page-title-background'] : '';

?>
<body <?php body_class($body_class); ?>>
<!-- Document Wrapper
   ============================================= -->
<div id="wrapper" class="clearfix <?php echo esc_attr($show_loading == 1 ? 'animsition' : '');?>">
	<?php get_template_part('templates/header/header','template' ); ?>

	<div id="wrapper-content">



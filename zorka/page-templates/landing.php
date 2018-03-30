<?php
/**
 * Template Name: LandingPage
 *
 * @package zorka
 */
$home_pages = array(
    array(
        'name' => 'HOMEPAGE 01',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/1.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-1' )->ID ),
        'type' => 'shop',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 02',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/2.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-2' )->ID ),
        'type' => 'shop',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 03',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/3.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-3' )->ID ),
        'type' => 'shop',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 04',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/4.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-4' )->ID ),
        'type' => 'shop',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 05',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/5.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-5' )->ID ),
        'type' => 'shop',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 06',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/6.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-6' )->ID ),
        'type' => 'shop',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 07 - CORPORATE 01',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/7.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-7' )->ID ),
        'type' => 'corporate',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 08 - CORPORATE 02',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/8.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-8' )->ID ),
        'type' => 'corporate',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 09 - Parallax',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/9.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-9' )->ID ),
        'type' => 'shop',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 10 - VERTICAL MENU 01',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/10.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-10' )->ID ),
        'type' => 'shop',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 11 - VERTICAL MENU 02',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/11.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-11' )->ID ),
        'type' => 'shop',
        'status' => '1'
    ),
    array(
        'name' => 'HOMEPAGE 12 - LEFT SIDEBAR',
        'image' => get_template_directory_uri() .  '/assets/landing/images/home-pages/12.jpg',
        'url' =>  get_permalink( get_page_by_path( 'home-12' )->ID ),
        'type' => 'shop',
        'status' => '1'
    )

);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>">
    <meta property="og:url" content="<?php echo esc_url(get_the_permalink())?>" />
    <meta name="robots" content="noindex, follow" />
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

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo  get_template_directory_uri() . '/assets/landing/css/template.css' ?>">



</head>
<body>
    <header>
        <div data-stellar-background-ratio="0.5" class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="header-top-left">
                            <div class="header-top-left-inner">
                                <img class="logo img-responsive" src="<?php echo  get_template_directory_uri() . '/assets/landing/images/logo.png' ?>"/>
                                <div class="description">
                                    MULTI-PURPOSE WORDPRESS THEME FOR WOOCOMMERCE
                                </div>
                                <a href="http://themeforest.net/item/zorka-wonderful-fashion-woocommerce-theme/11257557?license=regular&open_purchase_for_item_id=11257557&purchasable=source&ref=g5theme" class="button lg active">PURCHASE THEME - $58</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="header-bottom-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div data-sr="enter bottom"  class="icon-box">
                                <span class="pe-7s-cart"></span>
                                <img src="<?php echo  get_template_directory_uri() . '/assets/landing/images/icon-box-1.png' ?>"/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div data-sr="enter bottom"  class="icon-box">
                                <span class="pe-7s-browser"></span>
                                <img src="<?php echo  get_template_directory_uri() . '/assets/landing/images/icon-box-2.png' ?>"/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div data-sr="enter bottom"  class="icon-box">
                                <span class="pe-7s-diamond"></span>
                                <img src="<?php echo  get_template_directory_uri() . '/assets/landing/images/icon-box-3.png' ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
         <section class="home-pages">
            <div class="container">
                <div class="heading">
                    <div class="heading-title">
                        11+ UNIQUE HOMEPAGE LAYOUTS
                    </div>
                    <div class="heading-description">
                        Features from different versions can be combined.
                    </div>
                </div>
                <div class="tab-home-page">
                    <a data-filter="*" href="#" class="button active">ALL LAYOUTS</a>
                    <a data-filter=".shop" href="#" class="button">SHOP LAYOUTS</a>
                    <a data-filter=".corporate" href="#" class="button">CORPORATE LAYOUTS</a>
                </div>
                <div class="list-home-page">
                    <div class="row">
                        <?php  $status = ''; ?>
                        <?php foreach ( $home_pages as $home_page ): ?>
                            <?php
                                if ($home_page['status'] == 0) {
                                    $status = 'coming-soon';
                                } else {
                                    $status = '';
                                }
                            ?>
                            <div  class="col-md-4 col-sm-6 col-xs-12 <?php echo esc_attr($home_page['type'])?>">
                                <div data-sr="enter bottom" class="screen">
                                    <a class="screen-images <?php echo esc_attr($status)?>" href="<?php echo esc_url($home_page['url'])?>" title="<?php echo esc_attr($home_page['name']);?>">
                                        <img src="<?php echo esc_url($home_page['image'])?>" alt="<?php echo esc_attr($home_page['name']);?>"/>
                                    </a>
                                    <a class="screen-name" href="<?php echo esc_url($home_page['url'])?>" title="<?php echo esc_attr($home_page['name']);?>">
                                        <?php echo $home_page['name']; ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
             </div>
         </section>
         <section class="header-style">
             <div class="container">
                 <div class="heading">
                     <div class="heading-title">
                         10+ UNIQUE HEADER LAYOUTS
                     </div>
                     <div class="heading-description">
                         Features from different versions can be combined.
                     </div>
                 </div>
                 <div class="list-header">
                    <div class="row">
                        <?php $direction = ''; ?>
                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                            <?php if ($i % 2 == 0) {
                                $direction = 'right';
                            } else {
                                $direction = 'left';
                            } ?>

                            <div class="col-sm-6">
                                <div data-sr="enter <?php echo esc_attr($direction); ?>" class="header-image">
                                    <img class="" src="<?php echo get_template_directory_uri()?>/admin/assets/images/header/header-<?php echo $i ?>.jpg" alt=""/>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                 </div>
             </div>
         </section>
        <section class="purchase">
            <div data-sr="enter bottom" class="purchase-inner">
                <div class="container">
                   <div class="purchase-title">
                       PURCHASE THIS THEME AND GET MORE AMAZING FEATURES!
                   </div>
                    <a href="http://themeforest.net/item/zorka-wonderful-fashion-woocommerce-theme/11257557?license=regular&open_purchase_for_item_id=11257557&purchasable=source&ref=g5theme" class="button lg active">PURCHASE THEME - $58</a>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="container">
             <div class="col-sm-6">
                 <div class="social">
                     <a href="#"><i class="fa fa-facebook"></i></a>
                     <a href="#"><i class="fa fa-twitter"></i></a>
                     <a href="#"><i class="fa fa-instagram"></i></a>
                     <a href="#"><i class="fa fa-vk"></i></a>
                     <a href="#"><i class="fa fa-behance"></i></a>
                 </div>
             </div>
            <div class="col-sm-6">
                <div class="copyright">
                    ©COPYRIGHT 2015.THEME MADE BY G5PLUS
                </div>
            </div>
        </div>
    </footer>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo  get_template_directory_uri() . '/assets/landing/js/plugins.js' ?>"></script>
    <script src="<?php echo  get_template_directory_uri() . '/assets/landing/js/main.js' ?>"></script>
</body>
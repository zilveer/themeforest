<!DOCTYPE html>



<!--[if IE 9]> <html class="ie9" <?php language_attributes(); ?> > <![endif]-->



<!--[if !IE]><!--> <html <?php language_attributes(); ?> > <!--<![endif]-->



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />



    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<?php global $mango_settings; ?>

  	<!-- For Favicon -->

    <?php /* if($mango_settings['favicon']): ?>



        <link rel="icon" href="<?php echo esc_url($mango_settings['favicon']['url']); ?>" type="image/x-icon" />



    <?php endif; ?>



	<!-- For iPhone -->



    <?php if($mango_settings['icon-iphone']): ?>



        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url($mango_settings['icon-iphone']['url']); ?>">



    <?php endif; */?>

  



	<!-- For iPhone Retina -->



    <?php if($mango_settings['icon-iphone-retina']): ?>



        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url($mango_settings['icon-iphone-retina']['url']); ?>">



    <?php endif; ?>

   



	<!-- For iPad -->



    <?php if($mango_settings['icon-ipad']): ?>



        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url($mango_settings['icon-ipad']['url']); ?>">



    <?php endif; ?>

  



	<!-- For iPad Retina -->



    <?php if($mango_settings['icon-ipad-retina']): ?>



        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url($mango_settings['icon-ipad-retina']['url']); ?>">



    <?php endif; ?>

	<?php get_template_part("dynamic-style"); ?> 

	<?php wp_head(); ?>

	

		<?php if(isset($mango_settings['mango_header_jscode'])){



			echo $mango_settings['mango_header_jscode'];

	}

	?>

</head>

<body <?php body_class(); ?> cz-shortcut-listen="true">
<?php 
/* Template Name: Parallax Template */ 
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
     <?php if ( function_exists( 'get_option_tree') ) {
        $theme_options = get_option('option_tree');  
      } ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
    <meta name="keywords" content="HTML5/CSS3 Template" />
    <meta name="description" content="Mukam - Responsive HTML5/CSS3 Template">
    <meta name="author" content="bliccathemes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
    <!--[if IE 7]>
      <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
    <![endif]-->
  </head>
  <body <?php body_class('download'); ?>>
    <div id="qLoverlay"></div>  
    <div id="mukam-layout">
      <!-- Parallax HomePage -->
    <div class="parallax-homepage" data-stellar-background-ratio="0.3">
      <div class="homepage-slider">
        <ul class="slides">
          <?php query_posts('post_type=parallax');  ?>
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <li><?php the_content(); ?></li>
          <?php endwhile; else: ?>
           <li><p>Sorry, no posts matched your criteria.</p></li>
          <?php endif; ?>
          <?php wp_reset_query();?>   
        </ul>
        </div>
    <div class="clearfix"></div>
    </div>

    <!-- Top Section -->
    <!-- Header -->
        <?php $header_style = get_option_tree('header_style',$theme_options);
          if ( $header_style == "header_style_1" || $header_style == ""): 
            get_template_part( 'includes/header/header', '1' ); 
          elseif ( $header_style == "header_style_2"): 
            get_template_part( 'includes/header/header', '2' );
          elseif ( $header_style == "header_style_3" ):
            get_template_part( 'includes/header/header', '3');
          elseif ( $header_style == "header_style_4" ):
            get_template_part( 'includes/header/header', '4');
          elseif ( $header_style == "header_style_5" ):
            get_template_part( 'includes/header/header', '5');
          elseif ( $header_style == "header_style_6" ):
            get_template_part( 'includes/header/header', '6');
          elseif ( $header_style == "header_style_7" ):
            get_template_part( 'includes/header/header', '7');
          elseif ( $header_style == "header_style_8" ):
            get_template_part( 'includes/header/header', '8');
          endif;
        ?>

    <?php 
    if ( function_exists( 'get_option_tree') ) {
        $theme_options = get_option('option_tree');  
    } 
  $header_style = get_option_tree('header_style',$theme_options);
          if ( $header_style == "header_style_1" || $header_style == ""): 
            $headertype = "header-1";
          elseif ( $header_style == "header_style_2"): 
            $headertype = "header-2";
          elseif ( $header_style == "header_style_3" ):
            $headertype = "header-4";
          elseif ( $header_style == "header_style_4" ):
            $headertype = "header-3";
          elseif ( $header_style == "header_style_5" ):
            $headertype = "header-5";
          elseif ( $header_style == "header_style_6" ):
            $headertype = "shopheader";
          elseif ( $header_style == "header_style_7" ):
            $headertype = "header-7";
          elseif ( $header_style == "header_style_8" ):
            $headertype = "header-6";
          endif;

    if(isset($theme_options['blog_header'])) { /* dont */ }
    else { $theme_options['blog_header'] = "Set from Theme Option"; }
    if(isset($theme_options['blog_caption'])) { /*dont */ }
    else { $theme_options['blog_caption'] = "Set from Theme Option"; }        
    ?>
<section class="mukam-waypoint2" data-animate-down="mukam-header-small <?php echo $headertype; ?>" data-animate-up="mukam-header-large <?php echo $headertype; ?>">
    <?php while ( have_posts() ) : the_post(); ?>

        <?php the_content(); ?>

    <?php endwhile; // end of the loop. ?>
</section>
<?php get_footer(); ?> 
